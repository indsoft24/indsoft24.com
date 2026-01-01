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

        return view('tools.pdf-lock', compact('metaDescription', 'canonicalUrl'));
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

            // Try qpdf first (best for password protection)
            if ($this->isQpdfAvailable()) {
                $lockedPath = $this->lockWithQpdf($originalPath, $outputPath, $password);
            }

            // Fallback to Ghostscript if qpdf is not available
            if (! $lockedPath && $this->isGhostscriptAvailable()) {
                $lockedPath = $this->lockWithGhostscript($originalPath, $outputPath, $password);
            }

            // If both methods failed, return error
            if (! $lockedPath || ! file_exists($lockedPath)) {
                return response()->json([
                    'success' => false,
                    'message' => 'PDF locking requires qpdf or Ghostscript to be installed. Please install qpdf from https://qpdf.sourceforge.io/ or Ghostscript from https://www.ghostscript.com/download/gsdnld.html and ensure it is available in your system PATH.',
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
            // Ghostscript doesn't directly support password protection
            // We'll use a workaround with PDF encryption
            $gsPath = $this->getGhostscriptPath();

            // Note: Ghostscript has limited PDF encryption support
            // This is a basic implementation
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

            if ($returnVar === 0 && file_exists($outputPath) && filesize($outputPath) > 0) {
                return $outputPath;
            }
        } catch (\Exception $e) {
            Log::error('Ghostscript lock error: '.$e->getMessage());
        }

        return null;
    }
}
