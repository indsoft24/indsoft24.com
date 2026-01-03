<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ImageCompressorController extends Controller
{
    /**
     * Display the Image Compressor page
     */
    public function index()
    {
        $metaDescription = 'Compress and optimize images online for free. Reduce image file size while maintaining quality. Supports JPEG, JPG, PNG, WEBP, and GIF formats. Fast, secure image compression tool by Indsoft24.';
        $canonicalUrl = route('tools.image-compress');
        
        return view('tools.image-compress', compact('metaDescription', 'canonicalUrl'));
    }

    /**
     * Compress uploaded image
     */
    public function compress(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,jpg,png,webp,gif|max:10240', // 10MB max
            'quality' => 'nullable|integer|min:10|max:100',
            'max_width' => 'nullable|integer|min:100|max:5000',
            'max_height' => 'nullable|integer|min:100|max:5000',
            'preserve_format' => 'nullable|boolean',
        ], [
            'image.required' => 'Please upload an image file.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'Only JPEG, JPG, PNG, WEBP, and GIF images are allowed.',
            'image.max' => 'Image file must not exceed 10MB.',
            'quality.integer' => 'Quality must be a number.',
            'quality.min' => 'Quality must be at least 10.',
            'quality.max' => 'Quality must be at most 100.',
            'max_width.integer' => 'Maximum width must be a number.',
            'max_width.min' => 'Maximum width must be at least 100 pixels.',
            'max_width.max' => 'Maximum width must be at most 5000 pixels.',
            'max_height.integer' => 'Maximum height must be a number.',
            'max_height.min' => 'Maximum height must be at least 100 pixels.',
            'max_height.max' => 'Maximum height must be at most 5000 pixels.',
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

            $image = $request->file('image');
            $quality = $request->input('quality', 85);
            $maxWidth = $request->input('max_width', 2000);
            $maxHeight = $request->input('max_height', 2000);
            $preserveFormat = $request->input('preserve_format', false);

            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $imagePath = $image->getRealPath();
            $imageInfo = getimagesize($imagePath);
            
            if ($imageInfo === false) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unable to read image file. Please ensure the file is a valid image.',
                ], 422);
            }

            $originalWidth = $imageInfo[0];
            $originalHeight = $imageInfo[1];
            $mimeType = $imageInfo['mime'];

            // Create image resource based on original format
            $sourceImage = null;
            switch ($mimeType) {
                case 'image/jpeg':
                    $sourceImage = @imagecreatefromjpeg($imagePath);
                    break;
                case 'image/png':
                    $sourceImage = @imagecreatefrompng($imagePath);
                    break;
                case 'image/webp':
                    if (function_exists('imagecreatefromwebp')) {
                        $sourceImage = @imagecreatefromwebp($imagePath);
                    } else {
                        return response()->json([
                            'success' => false,
                            'message' => 'WEBP format is not supported on this server.',
                        ], 500);
                    }
                    break;
                case 'image/gif':
                    $sourceImage = @imagecreatefromgif($imagePath);
                    break;
                default:
                    return response()->json([
                        'success' => false,
                        'message' => 'Unsupported image format.',
                    ], 422);
            }

            if (!$sourceImage) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create image resource.',
                ], 500);
            }

            // Calculate new dimensions maintaining aspect ratio
            $ratio = min($maxWidth / $originalWidth, $maxHeight / $originalHeight);
            $newWidth = (int)($originalWidth * $ratio);
            $newHeight = (int)($originalHeight * $ratio);

            // If image is already smaller than max dimensions, keep original size
            if ($ratio >= 1) {
                $newWidth = $originalWidth;
                $newHeight = $originalHeight;
            }

            // Create new image with new dimensions
            $compressedImage = imagecreatetruecolor($newWidth, $newHeight);

            // Preserve transparency for PNG and GIF
            if ($mimeType === 'image/png' || $mimeType === 'image/gif') {
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

            // Determine output format
            $outputFormat = $preserveFormat ? $mimeType : 'image/jpeg';
            $outputExtension = $preserveFormat ? $this->getExtensionFromMime($mimeType) : 'jpg';

            // Output image to buffer
            ob_start();
            
            switch ($outputFormat) {
                case 'image/jpeg':
                    imagejpeg($compressedImage, null, $quality);
                    break;
                case 'image/png':
                    $pngQuality = (int)(9 - ($quality / 100) * 9);
                    imagepng($compressedImage, null, $pngQuality);
                    break;
                case 'image/webp':
                    if (function_exists('imagewebp')) {
                        imagewebp($compressedImage, null, $quality);
                    } else {
                        imagedestroy($sourceImage);
                        imagedestroy($compressedImage);
                        return response()->json([
                            'success' => false,
                            'message' => 'WEBP format is not supported on this server.',
                        ], 500);
                    }
                    break;
                case 'image/gif':
                    imagegif($compressedImage, null);
                    break;
            }
            
            $imageData = ob_get_contents();
            ob_end_clean();
            
            // Clean up
            imagedestroy($sourceImage);
            imagedestroy($compressedImage);
            
            // Generate filename
            $filename = $originalName . '_compressed.' . $outputExtension;
            
            // Calculate compression stats
            $originalSize = filesize($imagePath);
            $compressedSize = strlen($imageData);
            $compressionRatio = round((1 - $compressedSize / $originalSize) * 100, 2);
            
            // Return image as download
            return response($imageData)
                ->header('Content-Type', $outputFormat)
                ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
                ->header('Content-Length', strlen($imageData))
                ->header('X-Original-Size', $originalSize)
                ->header('X-Compressed-Size', $compressedSize)
                ->header('X-Compression-Ratio', $compressionRatio);
            
        } catch (\Exception $e) {
            Log::error('Image Compression Error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while compressing the image. Please ensure the image is not corrupted and try again.',
            ], 500);
        }
    }

    /**
     * Get file extension from MIME type
     */
    private function getExtensionFromMime($mimeType)
    {
        $mimeTypes = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/webp' => 'webp',
            'image/gif' => 'gif',
        ];

        return $mimeTypes[$mimeType] ?? 'jpg';
    }
}

