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
        // Note: qpdf and Ghostscript cannot convert DOC/DOCX - they only work with PDF files
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
     * Note: qpdf and Ghostscript cannot convert DOC/DOCX to PDF - they only work with PDF files
     */
    private function isLibreOfficeAvailable()
    {
        // Try common paths for LibreOffice (similar to how PDF lock checks for tools)
        $paths = [
            '/usr/bin/libreoffice',
            '/usr/local/bin/libreoffice',
            '/usr/bin/soffice',
            '/usr/local/bin/soffice',
        ];
        
        // Try to find LibreOffice in /opt (common installation location)
        $optPaths = glob('/opt/libreoffice*/program/soffice');
        if ($optPaths) {
            $paths = array_merge($paths, $optPaths);
        }
        
        // Also try without path (in case it's in PATH)
        $paths[] = 'libreoffice';
        $paths[] = 'soffice';
        
        foreach ($paths as $path) {
            // Try --version first (for libreoffice command)
            $result = $this->runCommand($path . ' --version 2>&1');
            if ($result['success']) {
                return true;
            }
            
            // Try --help as fallback (for soffice)
            $result = $this->runCommand($path . ' --help 2>&1');
            if ($result['success']) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Check if Pandoc is available
     */
    private function isPandocAvailable()
    {
        // Try common paths for Pandoc
        $paths = ['/usr/bin/pandoc', '/usr/local/bin/pandoc', 'pandoc'];
        
        foreach ($paths as $path) {
            $result = $this->runCommand($path . ' --version');
            if ($result['success']) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Run a shell command safely using proc_open()
     */
    private function runCommand($command)
    {
        $pipes = [];
        $process = @proc_open($command, [1 => ['pipe', 'w'], 2 => ['pipe', 'w']], $pipes);

        if (!is_resource($process)) {
            return ['success' => false, 'output' => []];
        }

        $output = stream_get_contents($pipes[1]);
        fclose($pipes[1]);
        fclose($pipes[2]);

        $returnVar = proc_close($process);

        return [
            'success' => $returnVar === 0 && !empty(trim($output)),
            'output' => explode("\n", trim($output))
        ];
    }

    /**
     * Get LibreOffice executable path
     */
    private function getLibreOfficePath()
    {
        // Try common paths for LibreOffice (same as availability check)
        $paths = [
            '/usr/bin/libreoffice',
            '/usr/local/bin/libreoffice',
            '/usr/bin/soffice',
            '/usr/local/bin/soffice',
        ];
        
        // Try to find LibreOffice in /opt (common installation location)
        $optPaths = glob('/opt/libreoffice*/program/soffice');
        if ($optPaths) {
            $paths = array_merge($paths, $optPaths);
        }
        
        // Also try without path (in case it's in PATH)
        $paths[] = 'libreoffice';
        $paths[] = 'soffice';
        
        foreach ($paths as $path) {
            // Try --version first (for libreoffice command)
            $result = $this->runCommand($path . ' --version 2>&1');
            if ($result['success']) {
                return $path;
            }
            
            // Try --help as fallback (for soffice)
            $result = $this->runCommand($path . ' --help 2>&1');
            if ($result['success']) {
                return $path;
            }
        }
        
        return 'libreoffice'; // Fallback
    }

    /**
     * Get Pandoc executable path
     */
    private function getPandocPath()
    {
        // Try common paths for Pandoc
        $paths = ['/usr/bin/pandoc', '/usr/local/bin/pandoc', 'pandoc'];
        
        foreach ($paths as $path) {
            $result = $this->runCommand($path . ' --version');
            if ($result['success']) {
                return $path;
            }
        }
        
        return 'pandoc'; // Fallback
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

            $result = $this->runCommand($command);

            // LibreOffice creates output file with same name but .pdf extension
            $inputBasename = pathinfo($inputPath, PATHINFO_FILENAME);
            $expectedOutputPath = $outputDir.'/'.$inputBasename.'.pdf';

            // Check if file was created
            if ($result['success'] && file_exists($expectedOutputPath) && filesize($expectedOutputPath) > 0) {
                // Rename to desired output filename
                if ($expectedOutputPath !== $outputPath) {
                    rename($expectedOutputPath, $outputPath);
                }

                return $outputPath;
            }

            // If LibreOffice failed, log the output for debugging
            if (!$result['success'] && !empty($result['output'])) {
                Log::error('LibreOffice conversion failed', [
                    'output' => implode("\n", $result['output']),
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
            $pandocPath = $this->getPandocPath();
            
            // Pandoc command to convert to PDF
            // Requires LaTeX or wkhtmltopdf for PDF output
            $command = sprintf(
                '%s -f docx -t pdf -o %s %s 2>&1',
                escapeshellarg($pandocPath),
                escapeshellarg($outputPath),
                escapeshellarg($inputPath)
            );

            $result = $this->runCommand($command);

            // Check if file was created and has content
            if ($result['success'] && file_exists($outputPath) && filesize($outputPath) > 0) {
                return $outputPath;
            }

            // If Pandoc failed, log the output for debugging
            if (!$result['success'] && !empty($result['output'])) {
                Log::error('Pandoc conversion failed', [
                    'output' => implode("\n", $result['output']),
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Pandoc conversion error: '.$e->getMessage());
        }

        return null;
    }
}

