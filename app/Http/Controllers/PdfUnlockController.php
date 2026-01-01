<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PdfUnlockController extends Controller
{
    /**
     * Display the PDF Unlock page
     */
    public function index()
    {
        $metaDescription = 'Unlock PDF files online for free. Remove password protection from PDF documents instantly. Fast, secure, and easy-to-use PDF unlock tool by Indsoft24. No registration required.';
        $canonicalUrl = route('tools.pdf-unlock');

        return view('tools.pdf-unlock', compact('metaDescription', 'canonicalUrl'));
    }

    /**
     * Unlock (remove password from) uploaded PDF file
     */
    public function unlock(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pdf' => [
                'required',
                'file',
                'mimes:pdf,application/pdf',
                'max:102400', // 100MB max
            ],
            'password' => 'nullable|string|max:255', // Optional password if PDF is password-protected
        ], [
            'pdf.required' => 'Please upload a PDF file.',
            'pdf.file' => 'The uploaded file is not valid.',
            'pdf.mimes' => 'Only PDF files are allowed. The file must have a .pdf extension.',
            'pdf.max' => 'PDF file must not exceed 100MB.',
            'password.max' => 'Password must not exceed 255 characters.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        try {
            $pdf = $request->file('pdf');
            $password = $request->input('password', '');

            // Get original file info
            $originalPath = $pdf->getRealPath();
            $originalName = pathinfo($pdf->getClientOriginalName(), PATHINFO_FILENAME);

            // For password-protected PDFs: Try Imagick first (if available), then qpdf (optional)
            if (! empty($password)) {
                // Try Imagick first (works with password-protected PDFs)
                if (extension_loaded('imagick')) {
                    $unlockedPath = $this->unlockWithImagick($originalPath, $password);

                    if ($unlockedPath && file_exists($unlockedPath)) {
                        $filename = $originalName.'_unlocked_'.time().'.pdf';

                        return response()->download($unlockedPath, $filename)->deleteFileAfterSend(true);
                    }
                }

                // Fallback to qpdf if Imagick failed (optional, not required)
                if ($this->isQpdfAvailable()) {
                    $unlockedPath = $this->unlockWithQpdf($originalPath, $password);

                    if ($unlockedPath && file_exists($unlockedPath)) {
                        $filename = $originalName.'_unlocked_'.time().'.pdf';

                        return response()->download($unlockedPath, $filename)->deleteFileAfterSend(true);
                    }
                }
            }

            // For non-password-protected PDFs: Try Ghostscript first (already available), then others
            if (empty($password)) {
                // Try Ghostscript first (already available on server)
                if ($this->isGhostscriptAvailable()) {
                    $unlockedPath = $this->unlockWithGhostscript($originalPath, '');

                    if ($unlockedPath && file_exists($unlockedPath)) {
                        $filename = $originalName.'_unlocked_'.time().'.pdf';

                        return response()->download($unlockedPath, $filename)->deleteFileAfterSend(true);
                    }
                }

                // Try Imagick without password
                if (extension_loaded('imagick')) {
                    $unlockedPath = $this->unlockWithImagick($originalPath, '');

                    if ($unlockedPath && file_exists($unlockedPath)) {
                        $filename = $originalName.'_unlocked_'.time().'.pdf';

                        return response()->download($unlockedPath, $filename)->deleteFileAfterSend(true);
                    }
                }

                // Fallback to qpdf if others failed (optional, not required)
                if ($this->isQpdfAvailable()) {
                    $unlockedPath = $this->unlockWithQpdf($originalPath, '');

                    if ($unlockedPath && file_exists($unlockedPath)) {
                        $filename = $originalName.'_unlocked_'.time().'.pdf';

                        return response()->download($unlockedPath, $filename)->deleteFileAfterSend(true);
                    }
                }
            }

            // Determine error message based on whether password was provided
            if (! empty($password)) {
                // Check what tools are available
                $hasImagick = extension_loaded('imagick');
                $hasQpdf = $this->isQpdfAvailable();

                if (! $hasImagick && ! $hasQpdf) {
                    $errorMessage = 'Unable to unlock password-protected PDF. The ImageMagick PHP extension is recommended for password-protected PDFs. Please contact your hosting provider to install the ImageMagick PHP extension, or ensure the password is correct.';
                } else {
                    $errorMessage = 'Unable to unlock password-protected PDF. Please ensure the password is correct. If the issue persists, the PDF may use encryption that is not supported.';
                }
            } else {
                $errorMessage = 'Unable to unlock PDF. The PDF may already be unlocked, or it may require a password. If the PDF is password-protected, please provide the password.';
            }

            return response()->json([
                'success' => false,
                'message' => $errorMessage,
            ], 422);

        } catch (\Exception $e) {
            Log::error('PDF Unlock Error: '.$e->getMessage());
            Log::error('Stack trace: '.$e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while unlocking the PDF. Please ensure the PDF is not corrupted and try again.',
            ], 500);
        }
    }

    /**
     * Check if Ghostscript is available
     */
    private function isGhostscriptAvailable()
    {
        $output = [];
        $returnVar = 0;
        @exec('gs --version', $output, $returnVar);

        return $returnVar === 0;
    }

    /**
     * Check if qpdf is available
     */
    private function isQpdfAvailable()
    {
        $output = [];
        $returnVar = 0;
        @exec('qpdf --version', $output, $returnVar);

        return $returnVar === 0;
    }

    /**
     * Unlock PDF using Ghostscript
     */
    private function unlockWithGhostscript($inputPath, $password)
    {
        try {
            // Ghostscript cannot handle password-protected PDFs
            // If password is provided, skip Ghostscript and try other methods
            if (! empty($password)) {
                return null;
            }

            $outputPath = storage_path('app/temp/unlocked_'.time().'_'.uniqid().'.pdf');

            // Ensure temp directory exists
            if (! file_exists(storage_path('app/temp'))) {
                mkdir(storage_path('app/temp'), 0755, true);
            }

            // Build command - Ghostscript will attempt to unlock non-password-protected PDFs
            $command = sprintf(
                'gs -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dNOPAUSE -dQUIET -dBATCH -sOutputFile=%s %s 2>&1',
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
                Log::error('Ghostscript unlock failed', [
                    'return_code' => $returnVar,
                    'output' => implode("\n", $output),
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Ghostscript unlock error: '.$e->getMessage());
        }

        return null;
    }

    /**
     * Unlock PDF using Imagick
     */
    private function unlockWithImagick($inputPath, $password)
    {
        try {
            $imagick = new \Imagick;

            // Set password if provided
            if (! empty($password)) {
                $imagick->setOption('pdf:password', $password);
            }

            $outputPath = storage_path('app/temp/unlocked_'.time().'_'.uniqid().'.pdf');

            // Ensure temp directory exists
            if (! file_exists(storage_path('app/temp'))) {
                mkdir(storage_path('app/temp'), 0755, true);
            }

            // Read PDF with password if needed
            // This may throw an exception if password is wrong or PDF is corrupted
            try {
                $imagick->readImage($inputPath);
            } catch (\ImagickException $e) {
                // If reading fails, it's likely a password issue or corrupted PDF
                $imagick->clear();
                $imagick->destroy();
                Log::error('Imagick readImage failed', [
                    'error' => $e->getMessage(),
                    'has_password' => ! empty($password),
                ]);

                return null;
            }

            $imagick->setImageFormat('pdf');

            try {
                $imagick->writeImages($outputPath, true);
            } catch (\ImagickException $e) {
                Log::error('Imagick writeImages failed', ['error' => $e->getMessage()]);
                $imagick->clear();
                $imagick->destroy();

                return null;
            }

            $imagick->clear();
            $imagick->destroy();

            // Check if file was created and has content
            if (file_exists($outputPath) && filesize($outputPath) > 0) {
                return $outputPath;
            }
        } catch (\ImagickException $e) {
            Log::error('Imagick unlock error: '.$e->getMessage());
        } catch (\Exception $e) {
            Log::error('Imagick unlock error: '.$e->getMessage());
        }

        return null;
    }

    /**
     * Unlock PDF using qpdf
     */
    private function unlockWithQpdf($inputPath, $password)
    {
        try {
            $outputPath = storage_path('app/temp/unlocked_'.time().'_'.uniqid().'.pdf');

            // Ensure temp directory exists
            if (! file_exists(storage_path('app/temp'))) {
                mkdir(storage_path('app/temp'), 0755, true);
            }

            // Build command
            $command = sprintf(
                'qpdf --decrypt %s %s 2>&1',
                escapeshellarg($inputPath),
                escapeshellarg($outputPath)
            );

            // If password is provided, use password option
            if (! empty($password)) {
                $command = sprintf(
                    'qpdf --password=%s --decrypt %s %s 2>&1',
                    escapeshellarg($password),
                    escapeshellarg($inputPath),
                    escapeshellarg($outputPath)
                );
            }

            $output = [];
            $returnVar = 0;
            @exec($command, $output, $returnVar);

            // Check if file was created and has content
            if ($returnVar === 0 && file_exists($outputPath) && filesize($outputPath) > 0) {
                return $outputPath;
            }

            // If qpdf failed, log the output for debugging
            if ($returnVar !== 0 && ! empty($output)) {
                Log::error('qpdf unlock failed', [
                    'return_code' => $returnVar,
                    'output' => implode("\n", $output),
                ]);
            }
        } catch (\Exception $e) {
            Log::error('qpdf unlock error: '.$e->getMessage());
        }

        return null;
    }
}
