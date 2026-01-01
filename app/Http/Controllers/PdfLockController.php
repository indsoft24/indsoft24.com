<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PdfLockController extends Controller
{
    /**
     * Display the PDF Lock page
     */
    public function index()
    {
        $metaDescription = 'Lock PDF files online for free. Add password protection to PDF documents instantly. Fast, secure, and easy-to-use PDF lock tool by Indsoft24. No registration required.';
        $canonicalUrl = route('tools.pdf-lock');
        
        // Check if Ghostscript is available (primary method, qpdf is optional)
        $isGhostscriptAvailable = $this->isGhostscriptAvailable();
        $isQpdfAvailable = $this->isQpdfAvailable();
        $isAvailable = $isGhostscriptAvailable || $isQpdfAvailable;

        return view('tools.pdf-lock', compact('metaDescription', 'canonicalUrl', 'isAvailable', 'isGhostscriptAvailable', 'isQpdfAvailable'));
    }

    /**
     * Lock (add password to) uploaded PDF file
     */
    public function lock(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pdf' => [
                'required',
                'file',
                'mimes:pdf,application/pdf',
                'max:102400', // 100MB max
            ],
            'password' => 'required|string|min:1|max:255',
            'confirm_password' => 'required|same:password',
        ], [
            'pdf.required' => 'Please upload a PDF file.',
            'pdf.file' => 'The uploaded file is not valid.',
            'pdf.mimes' => 'Only PDF files are allowed. The file must have a .pdf extension.',
            'pdf.max' => 'PDF file must not exceed 100MB.',
            'password.required' => 'Please enter a password.',
            'password.min' => 'Password must be at least 1 character.',
            'password.max' => 'Password must not exceed 255 characters.',
            'confirm_password.required' => 'Please confirm the password.',
            'confirm_password.same' => 'Password confirmation does not match.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $pdf = $request->file('pdf');
            $password = $request->input('password');

            // Get original file info
            $originalPath = $pdf->getRealPath();
            $originalName = pathinfo($pdf->getClientOriginalName(), PATHINFO_FILENAME);

            // Generate locked PDF filename
            $filename = $originalName.'_locked_'.time().'.pdf';
            $outputPath = storage_path('app/temp/'.$filename);

            // Ensure temp directory exists
            if (! file_exists(storage_path('app/temp'))) {
                mkdir(storage_path('app/temp'), 0755, true);
            }

            $lockedPath = null;

            // Try Ghostscript first (already available on server)
            if ($this->isGhostscriptAvailable()) {
                $lockedPath = $this->lockWithGhostscript($originalPath, $outputPath, $password);
            }

            // Fallback to FPDI (PHP library) if Ghostscript failed
            if (! $lockedPath && $this->isFpdiAvailable()) {
                $lockedPath = $this->lockWithFpdi($originalPath, $outputPath, $password);
            }

            // Fallback to qpdf if both above failed (optional)
            if (! $lockedPath && $this->isQpdfAvailable()) {
                $lockedPath = $this->lockWithQpdf($originalPath, $outputPath, $password);
            }

            // If all methods failed, return error
            if (! $lockedPath || ! file_exists($lockedPath)) {
                return response()->json([
                    'success' => false,
                    'message' => 'PDF locking requires Ghostscript to be installed. Ghostscript is already installed on your server, but there may be an issue with the conversion. Please try again or contact support.',
                ], 500);
            }

            // Return locked PDF
            return response()->download($lockedPath, $filename)->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            Log::error('PDF Lock Error: '.$e->getMessage());
            Log::error('Stack trace: '.$e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while locking the PDF. Please ensure the PDF is not corrupted and try again.',
            ], 500);
        }
    }

    /**
     * Check if FPDI is available
     */
    private function isFpdiAvailable()
    {
        return class_exists('setasign\Fpdi\Fpdi');
    }

    /**
     * Check if qpdf is available
     */
    private function isQpdfAvailable()
    {
        $output = [];
        $returnVar = 0;
        @exec('qpdf --version 2>&1', $output, $returnVar);

        return $returnVar === 0;
    }

    /**
     * Check if Ghostscript is available
     */
    private function isGhostscriptAvailable()
    {
        $output = [];
        $returnVar = 0;
        @exec('gs --version 2>&1', $output, $returnVar);

        return $returnVar === 0;
    }

    /**
     * Get Ghostscript executable path
     */
    private function getGhostscriptPath()
    {
        return 'gs';
    }

    /**
     * Lock PDF using qpdf
     */
    private function lockWithQpdf($inputPath, $outputPath, $password)
    {
        try {
            // Build qpdf command to encrypt PDF
            $command = sprintf(
                'qpdf --encrypt %s %s 256 -- %s %s 2>&1',
                escapeshellarg($password),
                escapeshellarg($password), // User password and owner password are the same
                escapeshellarg($inputPath),
                escapeshellarg($outputPath)
            );

            $output = [];
            $returnVar = 0;
            @exec($command, $output, $returnVar);

            if ($returnVar === 0 && file_exists($outputPath) && filesize($outputPath) > 0) {
                return $outputPath;
            }
        } catch (\Exception $e) {
            Log::error('qpdf lock error: '.$e->getMessage());
        }

        return null;
    }

    /**
     * Lock PDF using Ghostscript
     */
    private function lockWithGhostscript($inputPath, $outputPath, $password)
    {
        try {
            $gsPath = $this->getGhostscriptPath();

            // Ghostscript PDF encryption with password protection
            // -sOwnerPassword: Owner password (for permissions)
            // -sUserPassword: User password (to open the file)
            // -dEncryptionR: Encryption revision (4 = AES 128-bit)
            // -dPermissions: PDF permissions (-300 = no printing, no copying, no modifying)
            $command = sprintf(
                '%s -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dNOPAUSE -dQUIET -dBATCH -sOwnerPassword=%s -sUserPassword=%s -dEncryptionR=4 -dPermissions=-300 -sOutputFile=%s %s 2>&1',
                escapeshellarg($gsPath),
                escapeshellarg($password),
                escapeshellarg($password),
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

            // If Ghostscript failed, log the output for debugging
            if ($returnVar !== 0 && ! empty($output)) {
                Log::error('Ghostscript lock failed', [
                    'return_code' => $returnVar,
                    'output' => implode("\n", $output),
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Ghostscript lock error: '.$e->getMessage());
        }

        return null;
    }

    /**
     * Lock PDF using FPDI (PHP library - no command-line tools needed)
     */
    private function lockWithFpdi($inputPath, $outputPath, $password)
    {
        try {
            // FPDI with TCPDF for password protection
            if (! class_exists('setasign\Fpdi\Fpdi') || ! class_exists('TCPDF')) {
                return null;
            }

            // Create FPDI instance
            $pdf = new \setasign\Fpdi\Fpdi();
            
            // Set password protection
            $pdf->SetProtection(['print', 'copy'], $password, $password);
            
            // Import pages from source PDF
            $pageCount = $pdf->setSourceFile($inputPath);
            
            for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                $templateId = $pdf->importPage($pageNo);
                $size = $pdf->getTemplateSize($templateId);
                
                $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
                $pdf->useTemplate($templateId);
            }
            
            // Save to output file
            $pdf->Output('F', $outputPath);
            
            // Check if file was created and has content
            if (file_exists($outputPath) && filesize($outputPath) > 0) {
                return $outputPath;
            }
        } catch (\Exception $e) {
            Log::error('FPDI lock error: '.$e->getMessage());
        }

        return null;
    }
}
