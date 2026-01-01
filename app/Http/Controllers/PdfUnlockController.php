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
            
            // Check if Ghostscript is available (best option for unlocking)
            if ($this->isGhostscriptAvailable()) {
                $unlockedPath = $this->unlockWithGhostscript($originalPath, $password);
                
                if ($unlockedPath && file_exists($unlockedPath)) {
                    $filename = $originalName . '_unlocked_' . time() . '.pdf';
                    return response()->download($unlockedPath, $filename)->deleteFileAfterSend(true);
                }
            }
            
            // Fallback: Try with Imagick
            if (extension_loaded('imagick')) {
                $unlockedPath = $this->unlockWithImagick($originalPath, $password);
                
                if ($unlockedPath && file_exists($unlockedPath)) {
                    $filename = $originalName . '_unlocked_' . time() . '.pdf';
                    return response()->download($unlockedPath, $filename)->deleteFileAfterSend(true);
                }
            }
            
            // If both methods fail, try with qpdf if available
            if ($this->isQpdfAvailable()) {
                $unlockedPath = $this->unlockWithQpdf($originalPath, $password);
                
                if ($unlockedPath && file_exists($unlockedPath)) {
                    $filename = $originalName . '_unlocked_' . time() . '.pdf';
                    return response()->download($unlockedPath, $filename)->deleteFileAfterSend(true);
                }
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Unable to unlock PDF. The PDF may not be password-protected, or the password is incorrect. Please ensure you have the correct password if the PDF is protected.',
            ], 500);
            
        } catch (\Exception $e) {
            Log::error('PDF Unlock Error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
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
            $outputPath = storage_path('app/temp/unlocked_' . time() . '.pdf');
            
            // Ensure temp directory exists
            if (!file_exists(storage_path('app/temp'))) {
                mkdir(storage_path('app/temp'), 0755, true);
            }
            
            // Build command with password if provided
            $command = sprintf(
                'gs -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dNOPAUSE -dQUIET -dBATCH -sOutputFile=%s %s',
                escapeshellarg($outputPath),
                escapeshellarg($inputPath)
            );
            
            // If password is provided, we need to use pdftk or qpdf instead
            // Ghostscript doesn't handle passwords directly
            if (!empty($password)) {
                return null;
            }
            
            $output = [];
            $returnVar = 0;
            @exec($command . ' 2>&1', $output, $returnVar);
            
            if ($returnVar === 0 && file_exists($outputPath)) {
                return $outputPath;
            }
        } catch (\Exception $e) {
            Log::error('Ghostscript unlock error: ' . $e->getMessage());
        }
        
        return null;
    }

    /**
     * Unlock PDF using Imagick
     */
    private function unlockWithImagick($inputPath, $password)
    {
        try {
            $imagick = new \Imagick();
            
            // Set password if provided
            if (!empty($password)) {
                $imagick->setOption('pdf:password', $password);
            }
            
            $imagick->readImage($inputPath);
            $imagick->setImageFormat('pdf');
            
            $outputPath = storage_path('app/temp/unlocked_' . time() . '.pdf');
            
            // Ensure temp directory exists
            if (!file_exists(storage_path('app/temp'))) {
                mkdir(storage_path('app/temp'), 0755, true);
            }
            
            $imagick->writeImages($outputPath, true);
            $imagick->clear();
            $imagick->destroy();
            
            if (file_exists($outputPath)) {
                return $outputPath;
            }
        } catch (\Exception $e) {
            Log::error('Imagick unlock error: ' . $e->getMessage());
        }
        
        return null;
    }

    /**
     * Unlock PDF using qpdf
     */
    private function unlockWithQpdf($inputPath, $password)
    {
        try {
            $outputPath = storage_path('app/temp/unlocked_' . time() . '.pdf');
            
            // Ensure temp directory exists
            if (!file_exists(storage_path('app/temp'))) {
                mkdir(storage_path('app/temp'), 0755, true);
            }
            
            // Build command
            $command = sprintf(
                'qpdf --decrypt %s %s',
                escapeshellarg($inputPath),
                escapeshellarg($outputPath)
            );
            
            // If password is provided, use password option
            if (!empty($password)) {
                $command = sprintf(
                    'qpdf --password=%s --decrypt %s %s',
                    escapeshellarg($password),
                    escapeshellarg($inputPath),
                    escapeshellarg($outputPath)
                );
            }
            
            $output = [];
            $returnVar = 0;
            @exec($command . ' 2>&1', $output, $returnVar);
            
            if ($returnVar === 0 && file_exists($outputPath)) {
                return $outputPath;
            }
        } catch (\Exception $e) {
            Log::error('qpdf unlock error: ' . $e->getMessage());
        }
        
        return null;
    }
}

