<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PdfCompressController extends Controller
{
    /**
     * Display the PDF Compressor page
     */
    public function index()
    {
        $metaDescription = 'Compress PDF files online for free. Reduce PDF file size without losing quality. Fast, secure, and easy-to-use PDF compressor by Indsoft24. No registration required.';
        $canonicalUrl = route('tools.pdf-compress');

        return view('tools.pdf-compress', compact('metaDescription', 'canonicalUrl'));
    }

    /**
     * Compress uploaded PDF file
     */
    public function compress(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pdf' => [
                'required',
                'file',
                'mimes:pdf,application/pdf',
                'max:102400', // 100MB max in kilobytes
            ],
            'quality' => 'nullable|in:low,medium,high', // Compression quality
            'target_size_kb' => 'nullable|integer|min:10|max:102400', // Target size in KB (10KB to 100MB)
        ], [
            'pdf.required' => 'Please upload a PDF file.',
            'pdf.file' => 'The uploaded file is not valid.',
            'pdf.mimes' => 'Only PDF files are allowed. The file must have a .pdf extension.',
            'pdf.max' => 'PDF file must not exceed 100MB.',
            'quality.in' => 'Invalid compression quality selected.',
            'target_size_kb.integer' => 'Target size must be a number.',
            'target_size_kb.min' => 'Target size must be at least 10KB.',
            'target_size_kb.max' => 'Target size must not exceed 100MB (102400KB).',
        ]);

        // Check if file upload was rejected by PHP before reaching Laravel
        if (!$request->hasFile('pdf') && $request->server('CONTENT_LENGTH') > 0) {
            $postMaxSize = ini_get('post_max_size');
            $uploadMaxSize = ini_get('upload_max_filesize');
            
            Log::error('File upload rejected by PHP', [
                'content_length' => $request->server('CONTENT_LENGTH'),
                'post_max_size' => $postMaxSize,
                'upload_max_filesize' => $uploadMaxSize,
                'php_upload_errors' => $_FILES ?? 'no $_FILES',
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'File upload was rejected. PHP post_max_size is set to ' . $postMaxSize . ' and upload_max_filesize is ' . $uploadMaxSize . '. Please increase these values in php.ini and restart your web server.',
            ], 422);
        }

        if ($validator->fails()) {
            Log::error('PDF Compression Validation Failed', [
                'errors' => $validator->errors()->all(),
                'request_data' => $request->except(['pdf']), // Don't log file content
                'file_size' => $request->hasFile('pdf') ? $request->file('pdf')->getSize() : 'no file',
                'file_mime' => $request->hasFile('pdf') ? $request->file('pdf')->getMimeType() : 'no file',
            ]);
            
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $pdf = $request->file('pdf');
            $quality = $request->input('quality', 'medium');
            $targetSizeKb = $request->input('target_size_kb');

            // Get original file info
            $originalPath = $pdf->getRealPath();
            $originalSize = filesize($originalPath);
            $originalName = pathinfo($pdf->getClientOriginalName(), PATHINFO_FILENAME);

            // Generate compressed PDF filename
            $filename = $originalName.'_compressed_'.time().'.pdf';
            $outputPath = storage_path('app/temp/'.$filename);

            // Ensure temp directory exists
            if (! file_exists(storage_path('app/temp'))) {
                mkdir(storage_path('app/temp'), 0755, true);
            }

            $compressedPath = null;
            $targetSizeBytes = $targetSizeKb ? ($targetSizeKb * 1024) : null;

            // If target size is specified, use iterative compression
            if ($targetSizeBytes && $targetSizeBytes < $originalSize) {
                $compressedPath = $this->compressToTargetSize($originalPath, $outputPath, $targetSizeBytes, $quality);
            } else {
                // Try Ghostscript first (most reliable for PDF compression)
                if ($this->isGhostscriptAvailable()) {
                    $compressedPath = $this->compressWithGhostscript($originalPath, $outputPath, $quality);
                }

                // Fallback to ImageMagick if Ghostscript failed or is not available
                if (! $compressedPath && extension_loaded('imagick')) {
                    $compressedPath = $this->compressWithImagick($originalPath, $outputPath, $quality);
                }
            }

            // If both methods failed, try basic compression using file optimization
            if (! $compressedPath || ! file_exists($compressedPath)) {
                $compressedPath = $this->compressBasic($originalPath, $outputPath, $quality);
            }

            // If all methods failed, return error with helpful message
            if (! $compressedPath || ! file_exists($compressedPath)) {
                $errorMessage = 'PDF compression requires Ghostscript or ImageMagick to be installed. ';
                $errorMessage .= 'Please install Ghostscript from https://www.ghostscript.com/download/gsdnld.html ';
                $errorMessage .= 'For Windows: Download and install Ghostscript, then restart your server. ';
                $errorMessage .= 'The tool will automatically detect Ghostscript if installed in standard locations.';

                return response()->json([
                    'success' => false,
                    'message' => $errorMessage,
                ], 500);
            }

            // Return compressed PDF
            return response()->download($compressedPath, $filename)->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            Log::error('PDF Compression Error: '.$e->getMessage());
            Log::error('Stack trace: '.$e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while compressing the PDF. Please ensure the PDF is not corrupted and try again.',
            ], 500);
        }
    }

    /**
     * Check if Ghostscript is available
     */
    private function isGhostscriptAvailable()
    {
        // Try standard 'gs' command
        $output = [];
        $returnVar = 0;
        @exec('gs --version 2>&1', $output, $returnVar);
        if ($returnVar === 0) {
            return true;
        }

        // Try common Windows paths
        $windowsPaths = [
            'C:\\Program Files\\gs\\gs*\\bin\\gswin64c.exe',
            'C:\\Program Files (x86)\\gs\\gs*\\bin\\gswin32c.exe',
            'C:\\Program Files\\Ghostscript\\bin\\gswin64c.exe',
            'C:\\Program Files (x86)\\Ghostscript\\bin\\gswin32c.exe',
        ];

        foreach ($windowsPaths as $pathPattern) {
            $matches = glob($pathPattern);
            if (! empty($matches)) {
                // Test if the executable works
                $testCommand = escapeshellarg($matches[0]).' --version 2>&1';
                @exec($testCommand, $testOutput, $testReturn);
                if ($testReturn === 0) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Get Ghostscript executable path
     */
    private function getGhostscriptPath()
    {
        // Try standard 'gs' command first
        $output = [];
        $returnVar = 0;
        @exec('gs --version 2>&1', $output, $returnVar);
        if ($returnVar === 0) {
            return 'gs';
        }

        // Try common Windows paths
        $windowsPaths = [
            'C:\\Program Files\\gs\\gs*\\bin\\gswin64c.exe',
            'C:\\Program Files (x86)\\gs\\gs*\\bin\\gswin32c.exe',
            'C:\\Program Files\\Ghostscript\\bin\\gswin64c.exe',
            'C:\\Program Files (x86)\\Ghostscript\\bin\\gswin32c.exe',
        ];

        foreach ($windowsPaths as $pathPattern) {
            $matches = glob($pathPattern);
            if (! empty($matches)) {
                // Test if the executable works
                $testCommand = escapeshellarg($matches[0]).' --version 2>&1';
                @exec($testCommand, $testOutput, $testReturn);
                if ($testReturn === 0) {
                    return $matches[0];
                }
            }
        }

        return 'gs'; // Fallback to 'gs' command
    }

    /**
     * Compress PDF using Ghostscript
     */
    private function compressWithGhostscript($inputPath, $outputPath, $quality)
    {
        try {
            // Set Ghostscript quality settings based on quality level
            $pdfSettings = match ($quality) {
                'low' => '/screen',      // Lowest quality, smallest size
                'medium' => '/ebook',     // Medium quality, balanced
                'high' => '/printer',     // Higher quality, larger size
                default => '/ebook',
            };

            // Get Ghostscript executable path
            $gsPath = $this->getGhostscriptPath();

            // Build Ghostscript command
            $command = sprintf(
                '%s -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dPDFSETTINGS=%s -dNOPAUSE -dQUIET -dBATCH -dDetectDuplicateImages=true -dCompressFonts=true -dCompressStreams=true -sOutputFile=%s %s 2>&1',
                escapeshellarg($gsPath),
                $pdfSettings,
                escapeshellarg($outputPath),
                escapeshellarg($inputPath)
            );

            $output = [];
            $returnVar = 0;
            @exec($command, $output, $returnVar);

            if ($returnVar === 0 && file_exists($outputPath) && filesize($outputPath) > 0) {
                return $outputPath;
            } else {
                Log::error('Ghostscript compression failed. Return code: '.$returnVar.', Output: '.implode("\n", $output));
            }
        } catch (\Exception $e) {
            Log::error('Ghostscript compression error: '.$e->getMessage());
        }

        return null;
    }

    /**
     * Compress PDF using ImageMagick
     */
    private function compressWithImagick($inputPath, $outputPath, $quality)
    {
        try {
            // Set compression quality based on selection
            $compressionQuality = match ($quality) {
                'low' => 50,
                'medium' => 75,
                'high' => 90,
                default => 75,
            };

            // Create Imagick object
            $imagick = new \Imagick;
            $imagick->setResolution(150, 150); // Lower resolution for compression
            $imagick->readImage($inputPath);

            // Set compression options
            $imagick->setImageCompression(\Imagick::COMPRESSION_JPEG);
            $imagick->setImageCompressionQuality($compressionQuality);
            $imagick->setImageFormat('pdf');

            // Optimize images
            $imagick->optimizeImageLayers();

            // Write compressed PDF
            $imagick->writeImages($outputPath, true);
            $imagick->clear();
            $imagick->destroy();

            if (file_exists($outputPath) && filesize($outputPath) > 0) {
                return $outputPath;
            }
        } catch (\Exception $e) {
            Log::error('ImageMagick compression error: '.$e->getMessage());
        }

        return null;
    }

    /**
     * Compress PDF to target size using iterative approach
     */
    private function compressToTargetSize($inputPath, $outputPath, $targetSizeBytes, $initialQuality = 'medium')
    {
        $maxIterations = 5;
        $currentQuality = $initialQuality;
        $currentPath = $inputPath;
        $tempFiles = [];

        // Quality progression for iterative compression
        $qualityLevels = ['high', 'medium', 'low'];
        $qualityIndex = array_search($initialQuality, $qualityLevels);
        if ($qualityIndex === false) {
            $qualityIndex = 1; // Default to medium
        }

        for ($iteration = 0; $iteration < $maxIterations; $iteration++) {
            // Determine quality for this iteration
            if ($iteration > 0 && $qualityIndex < count($qualityLevels) - 1) {
                $qualityIndex++;
                $currentQuality = $qualityLevels[$qualityIndex];
            }

            // Create unique temp path for this iteration
            $tempPath = storage_path('app/temp/temp_compress_'.time().'_'.$iteration.'.pdf');
            $tempFiles[] = $tempPath;

            // Try compression with current quality
            $compressedPath = null;
            if ($this->isGhostscriptAvailable()) {
                $compressedPath = $this->compressWithGhostscript($currentPath, $tempPath, $currentQuality);
            } elseif (extension_loaded('imagick')) {
                $compressedPath = $this->compressWithImagick($currentPath, $tempPath, $currentQuality);
            }

            if ($compressedPath && file_exists($compressedPath)) {
                $compressedSize = filesize($compressedPath);

                // If we reached or exceeded target size, we're done
                if ($compressedSize <= $targetSizeBytes) {
                    // Copy to final output path
                    copy($compressedPath, $outputPath);
                    // Cleanup temp files
                    $this->cleanupTempFiles($tempFiles, $currentPath, $inputPath);

                    return $outputPath;
                }

                // If this is better than previous, use it for next iteration
                if ($currentPath !== $inputPath && in_array($currentPath, $tempFiles)) {
                    @unlink($currentPath);
                }
                $currentPath = $compressedPath;
            } else {
                // Compression failed, break
                break;
            }
        }

        // If we have a compressed file, use it even if we didn't reach target
        if ($currentPath !== $inputPath && file_exists($currentPath)) {
            copy($currentPath, $outputPath);
            $this->cleanupTempFiles($tempFiles, $currentPath, $inputPath);

            return $outputPath;
        }

        // Cleanup
        $this->cleanupTempFiles($tempFiles, null, $inputPath);

        return null;
    }

    /**
     * Cleanup temporary files
     */
    private function cleanupTempFiles($tempFiles, $excludePath = null, $originalPath = null)
    {
        foreach ($tempFiles as $tempFile) {
            if (file_exists($tempFile) && $tempFile !== $excludePath && $tempFile !== $originalPath) {
                @unlink($tempFile);
            }
        }
    }

    /**
     * Basic compression using file optimization (last resort)
     * This is a minimal compression that may not work for all PDFs
     */
    private function compressBasic($inputPath, $outputPath, $quality)
    {
        try {
            // Read the PDF file
            $pdfContent = file_get_contents($inputPath);

            if ($pdfContent === false) {
                return null;
            }

            // Try to optimize by removing unnecessary whitespace and comments
            // This is a very basic approach and may not work for all PDFs
            $optimized = preg_replace('/\s+/', ' ', $pdfContent);
            $optimized = preg_replace('/%\s*[^\r\n]*/m', '', $optimized);

            // Only proceed if we actually reduced the size
            if (strlen($optimized) < strlen($pdfContent)) {
                file_put_contents($outputPath, $optimized);

                if (file_exists($outputPath) && filesize($outputPath) > 0) {
                    return $outputPath;
                }
            }
        } catch (\Exception $e) {
            Log::error('Basic compression error: '.$e->getMessage());
        }

        return null;
    }
}
