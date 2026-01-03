<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ImageToPdfController extends Controller
{
    /**
     * Display the JPG to PDF converter page
     */
    public function index()
    {
        $metaDescription = 'Convert JPG, JPEG, and PNG images to PDF online for free. Fast, secure, and easy-to-use image to PDF converter by Indsoft24. No registration required, unlimited conversions.';
        $canonicalUrl = route('tools.jpg-to-pdf');

        return view('tools.jpg-to-pdf', compact('metaDescription', 'canonicalUrl'));
    }

    /**
     * Convert uploaded JPG images to PDF
     */
    public function convert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'images' => 'required|array|min:1|max:20',
            'images.*' => 'required|image|mimes:jpeg,jpg,png|max:10240', // 10MB max per image
        ], [
            'images.required' => 'Please upload at least one image.',
            'images.array' => 'Invalid file format.',
            'images.min' => 'Please upload at least one image.',
            'images.max' => 'You can upload maximum 20 images at once.',
            'images.*.image' => 'All files must be images.',
            'images.*.mimes' => 'Only JPG, JPEG, and PNG images are allowed.',
            'images.*.max' => 'Each image must not exceed 10MB.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        try {
            // Check if GD library is available
            if (!extension_loaded('gd')) {
                return response()->json([
                    'success' => false,
                    'message' => 'GD library is not available on this server. Please contact the administrator.',
                ], 500);
            }

            $images = $request->file('images');

            // Ensure TCPDF is loaded - use fully qualified namespace
            if (! class_exists('\TCPDF')) {
                // Try to load TCPDF if not autoloaded
                $tcpdfPath = base_path('vendor/tecnickcom/tcpdf/tcpdf.php');
                if (file_exists($tcpdfPath)) {
                    require_once $tcpdfPath;
                } else {
                    throw new \Exception('TCPDF library is not available. Please run: composer require tecnickcom/tcpdf');
                }
            }

            // Create new PDF document using fully qualified class name
            $pdf = new \TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

            // Remove default header/footer
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);

            // Set auto page breaks
            $pdf->SetAutoPageBreak(false, 0);

            // Set margins
            $pdf->SetMargins(0, 0, 0);

            $tempFiles = [];

            foreach ($images as $image) {
                // Validate image
                if (! $image->isValid()) {
                    continue;
                }

                // Get image path
                $imagePath = $image->getRealPath();
                $imageInfo = getimagesize($imagePath);

                if ($imageInfo === false) {
                    continue;
                }
                
                // Compress/resize image before adding to PDF
                $compressedImagePath = $this->compressImage($imagePath, $imageInfo);
                if ($compressedImagePath === false) {
                    // If compression fails, use original image
                    $compressedImagePath = $imagePath;
                } else {
                    // Track compressed files for cleanup
                    $tempFiles[] = $compressedImagePath;
                }
                
                // Get compressed image dimensions
                $compressedInfo = getimagesize($compressedImagePath);
                $imageWidth = $compressedInfo[0];
                $imageHeight = $compressedInfo[1];
                
                // Calculate PDF page size to fit image (maintain aspect ratio)
                $pageWidth = $pdf->getPageWidth();
                $pageHeight = $pdf->getPageHeight();

                // Calculate scaling to fit page
                $scaleX = ($pageWidth - 20) / $imageWidth; // 10mm margin on each side
                $scaleY = ($pageHeight - 20) / $imageHeight;
                $scale = min($scaleX, $scaleY);

                $pdfWidth = $imageWidth * $scale;
                $pdfHeight = $imageHeight * $scale;

                // Add a new page
                $pdf->AddPage();

                // Center the image on the page
                $x = ($pageWidth - $pdfWidth) / 2;
                $y = ($pageHeight - $pdfHeight) / 2;

                // Add image to PDF
                $pdf->Image($compressedImagePath, $x, $y, $pdfWidth, $pdfHeight, '', '', '', false, 300, '', false, false, 0);
            }
            
            // Clean up compressed temporary files
            foreach ($tempFiles as $tempFile) {
                if (file_exists($tempFile)) {
                    @unlink($tempFile);
                }
            }

            // Generate PDF filename
            $filename = 'converted_'.time().'.pdf';
            $pdfPath = storage_path('app/temp/'.$filename);

            // Ensure temp directory exists
            if (! file_exists(storage_path('app/temp'))) {
                mkdir(storage_path('app/temp'), 0755, true);
            }

            // Save PDF
            $pdf->Output($pdfPath, 'F');

            // Return PDF as download
            return response()->download($pdfPath, $filename)->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            Log::error('PDF Conversion Error: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while converting images to PDF. Please try again.',
            ], 500);
        }
    }

    /**
     * Compress and resize image to reduce file size
     * 
     * @param string $imagePath Original image path
     * @param array $imageInfo Image information from getimagesize()
     * @return string|false Path to compressed image or false on failure
     */
    private function compressImage($imagePath, $imageInfo)
    {
        try {
            $maxWidth = 2000;  // Maximum width in pixels
            $maxHeight = 2000; // Maximum height in pixels
            $jpegQuality = 85; // JPEG quality (0-100)
            $pngQuality = 9;   // PNG compression level (0-9, 9 = maximum compression)
            
            $originalWidth = $imageInfo[0];
            $originalHeight = $imageInfo[1];
            $mimeType = $imageInfo['mime'];
            
            // Calculate new dimensions maintaining aspect ratio
            $ratio = min($maxWidth / $originalWidth, $maxHeight / $originalHeight);
            $newWidth = (int)($originalWidth * $ratio);
            $newHeight = (int)($originalHeight * $ratio);
            
            // If image is already smaller than max dimensions, still compress for file size reduction
            if ($ratio >= 1) {
                $newWidth = $originalWidth;
                $newHeight = $originalHeight;
            }
            
            // Create image resource based on MIME type
            $sourceImage = null;
            switch ($mimeType) {
                case 'image/jpeg':
                    $sourceImage = @imagecreatefromjpeg($imagePath);
                    break;
                case 'image/png':
                    $sourceImage = @imagecreatefrompng($imagePath);
                    break;
                default:
                    return false;
            }
            
            if (!$sourceImage) {
                return false;
            }
            
            // Create new image with new dimensions
            $compressedImage = imagecreatetruecolor($newWidth, $newHeight);
            
            // Preserve transparency for PNG
            if ($mimeType === 'image/png') {
                imagealphablending($compressedImage, false);
                imagesavealpha($compressedImage, true);
                $transparent = imagecolorallocatealpha($compressedImage, 255, 255, 255, 127);
                imagefilledrectangle($compressedImage, 0, 0, $newWidth, $newHeight, $transparent);
            }
            
            // Resize image
            imagecopyresampled(
                $compressedImage,
                $sourceImage,
                0, 0, 0, 0,
                $newWidth,
                $newHeight,
                $originalWidth,
                $originalHeight
            );
            
            // Create temporary file for compressed image
            $tempDir = storage_path('app/temp');
            if (!file_exists($tempDir)) {
                mkdir($tempDir, 0755, true);
            }
            
            $compressedPath = $tempDir . '/compressed_' . uniqid() . '_' . time() . '.jpg';
            
            // Save compressed image as JPEG (smaller file size)
            imagejpeg($compressedImage, $compressedPath, $jpegQuality);
            
            // Clean up
            imagedestroy($sourceImage);
            imagedestroy($compressedImage);
            
            return $compressedPath;
            
        } catch (\Exception $e) {
            Log::error('Image compression error: ' . $e->getMessage());
            return false;
        }
    }
}

