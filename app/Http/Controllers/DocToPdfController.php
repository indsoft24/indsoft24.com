<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class DocToPdfController extends Controller
{
    /**
     * Display the DOC to PDF converter page
     */
    public function index()
    {
        $metaDescription = 'Convert Word documents (DOC, DOCX) to PDF online for free. Fast, secure, and easy-to-use document to PDF converter by Indsoft24. No registration required.';
        $canonicalUrl = route('tools.doc-to-pdf');

        // Check if conversion tools are available
        $isLibreOfficeAvailable = $this->isLibreOfficeAvailable();
        $isPandocAvailable = $this->isPandocAvailable();
        $isAvailable = $isLibreOfficeAvailable || $isPandocAvailable;

        return view('tools.doc-to-pdf', compact('metaDescription', 'canonicalUrl', 'isAvailable', 'isLibreOfficeAvailable', 'isPandocAvailable'));
    }

    /**
     * Convert uploaded DOC/DOCX file to PDF
     */
    public function convert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doc' => [
                'required',
                'file',
                'mimes:doc,docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'max:102400', // 100MB max
            ],
        ], [
            'doc.required' => 'Please upload a Word document.',
            'doc.file' => 'The uploaded file is not valid.',
            'doc.mimes' => 'Only DOC and DOCX files are allowed.',
            'doc.max' => 'Document file must not exceed 100MB.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        try {
            $doc = $request->file('doc');

            // Get original file info
            $originalPath = $doc->getRealPath();
            $originalName = pathinfo($doc->getClientOriginalName(), PATHINFO_FILENAME);

            // Generate PDF filename
            $filename = $originalName.'_converted_'.time().'.pdf';
            $outputPath = storage_path('app/temp/'.$filename);

            // Ensure temp directory exists
            if (! file_exists(storage_path('app/temp'))) {
                mkdir(storage_path('app/temp'), 0755, true);
            }

            $pdfPath = null;

            // Try LibreOffice first (best for DOC/DOCX conversion)
            if ($this->isLibreOfficeAvailable()) {
                $pdfPath = $this->convertWithLibreOffice($originalPath, $outputPath);
            }

            // Fallback to Pandoc if LibreOffice is not available
            if (! $pdfPath && $this->isPandocAvailable()) {
                $pdfPath = $this->convertWithPandoc($originalPath, $outputPath);
            }

            // If both methods failed, return error
            if (! $pdfPath || ! file_exists($pdfPath)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Document conversion requires LibreOffice or Pandoc to be installed. Please contact your hosting provider to install LibreOffice (recommended) or Pandoc.',
                ], 500);
            }

            // Return converted PDF
            return response()->download($pdfPath, $filename)->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            Log::error('DOC to PDF Conversion Error: '.$e->getMessage());
            Log::error('Stack trace: '.$e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while converting the document. Please ensure the document is not corrupted and try again.',
            ], 500);
        }
    }

    /**
     * Check if LibreOffice is available
     */
    private function isLibreOfficeAvailable()
    {
        $output = [];
        $returnVar = 0;
        @exec('libreoffice --version 2>&1', $output, $returnVar);

        return $returnVar === 0;
    }

    /**
     * Check if Pandoc is available
     */
    private function isPandocAvailable()
    {
        $output = [];
        $returnVar = 0;
        @exec('pandoc --version 2>&1', $output, $returnVar);

        return $returnVar === 0;
    }

    /**
     * Get LibreOffice executable path
     */
    private function getLibreOfficePath()
    {
        return 'libreoffice';
    }

    /**
     * Convert DOC/DOCX to PDF using LibreOffice
     */
    private function convertWithLibreOffice($inputPath, $outputPath)
    {
        try {
            $loPath = $this->getLibreOfficePath();
            $outputDir = dirname($outputPath);

            // LibreOffice command to convert to PDF
            // --headless: Run without GUI
            // --convert-to pdf: Convert to PDF format
            // --outdir: Output directory
            $command = sprintf(
                '%s --headless --convert-to pdf --outdir %s %s 2>&1',
                escapeshellarg($loPath),
                escapeshellarg($outputDir),
                escapeshellarg($inputPath)
            );

            $output = [];
            $returnVar = 0;
            @exec($command, $output, $returnVar);

            // LibreOffice creates output file with same name but .pdf extension
            $inputBasename = pathinfo($inputPath, PATHINFO_FILENAME);
            $expectedOutputPath = $outputDir.'/'.$inputBasename.'.pdf';

            // Check if file was created
            if ($returnVar === 0 && file_exists($expectedOutputPath) && filesize($expectedOutputPath) > 0) {
                // Rename to desired output filename
                if ($expectedOutputPath !== $outputPath) {
                    rename($expectedOutputPath, $outputPath);
                }

                return $outputPath;
            }

            // If LibreOffice failed, log the output for debugging
            if ($returnVar !== 0 && ! empty($output)) {
                Log::error('LibreOffice conversion failed', [
                    'return_code' => $returnVar,
                    'output' => implode("\n", $output),
                ]);
            }
        } catch (\Exception $e) {
            Log::error('LibreOffice conversion error: '.$e->getMessage());
        }

        return null;
    }

    /**
     * Convert DOC/DOCX to PDF using Pandoc
     */
    private function convertWithPandoc($inputPath, $outputPath)
    {
        try {
            // Pandoc command to convert to PDF
            // Requires LaTeX or wkhtmltopdf for PDF output
            $command = sprintf(
                'pandoc -f docx -t pdf -o %s %s 2>&1',
                escapeshellarg($outputPath),
                escapeshellarg($inputPath)
            );

            $output = [];
            $returnVar = 0;
            @exec($command, $output, $returnVar);

            // Check if file was created and has content
            if ($returnVar === 0 && file_exists($outputPath) && filesize($outputPath) > 0) {
                return $outputPath;
            }

            // If Pandoc failed, log the output for debugging
            if ($returnVar !== 0 && ! empty($output)) {
                Log::error('Pandoc conversion failed', [
                    'return_code' => $returnVar,
                    'output' => implode("\n", $output),
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Pandoc conversion error: '.$e->getMessage());
        }

        return null;
    }
}

