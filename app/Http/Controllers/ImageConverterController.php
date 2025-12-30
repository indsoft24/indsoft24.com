<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ImageConverterController extends Controller
{
    /**
     * Display the Image Format Converter page
     */
    public function index()
    {
        $metaDescription = 'Convert images between JPEG, JPG, PNG, and WEBP formats online for free. High-quality image format converter with batch processing. Fast, secure image conversion tool by Indsoft24.';
        $canonicalUrl = route('tools.image-converter');
        
        return view('tools.image-converter', compact('metaDescription', 'canonicalUrl'));
    }

    /**
     * Convert uploaded image to specified format
     */
    public function convert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,jpg,png,webp|max:10240', // 10MB max
            'format' => 'required|in:jpeg,jpg,png,webp',
            'quality' => 'nullable|integer|min:1|max:100',
        ], [
            'image.required' => 'Please upload an image file.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'Only JPEG, JPG, PNG, and WEBP images are allowed.',
            'image.max' => 'Image file must not exceed 10MB.',
            'format.required' => 'Please select an output format.',
            'format.in' => 'Invalid output format selected.',
            'quality.integer' => 'Quality must be a number.',
            'quality.min' => 'Quality must be at least 1.',
            'quality.max' => 'Quality must be at most 100.',
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
            $format = $request->input('format', 'jpg');
            $quality = $request->input('quality', $format === 'png' ? 95 : 90);

            // Get original filename without extension
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $imagePath = $image->getRealPath();
            $imageInfo = getimagesize($imagePath);
            
            if ($imageInfo === false) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unable to read image file. Please ensure the file is a valid image.',
                ], 422);
            }

            // Create image resource based on original format
            $sourceImage = null;
            $mimeType = $imageInfo['mime'];
            
            switch ($mimeType) {
                case 'image/jpeg':
                    $sourceImage = imagecreatefromjpeg($imagePath);
                    break;
                case 'image/png':
                    $sourceImage = imagecreatefrompng($imagePath);
                    break;
                case 'image/webp':
                    if (function_exists('imagecreatefromwebp')) {
                        $sourceImage = imagecreatefromwebp($imagePath);
                    } else {
                        return response()->json([
                            'success' => false,
                            'message' => 'WEBP format is not supported on this server.',
                        ], 500);
                    }
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

            // Handle transparency for PNG
            if ($format === 'png') {
                imagealphablending($sourceImage, false);
                imagesavealpha($sourceImage, true);
            }

            // Output image to buffer
            ob_start();
            
            switch ($format) {
                case 'jpeg':
                case 'jpg':
                    imagejpeg($sourceImage, null, $quality);
                    break;
                case 'png':
                    // PNG quality is 0-9, so we need to convert
                    $pngQuality = (int)(9 - ($quality / 100) * 9);
                    imagepng($sourceImage, null, $pngQuality);
                    break;
                case 'webp':
                    if (function_exists('imagewebp')) {
                        imagewebp($sourceImage, null, $quality);
                    } else {
                        imagedestroy($sourceImage);
                        return response()->json([
                            'success' => false,
                            'message' => 'WEBP format is not supported on this server.',
                        ], 500);
                    }
                    break;
            }
            
            $imageData = ob_get_contents();
            ob_end_clean();
            
            // Clean up
            imagedestroy($sourceImage);
            
            // Generate filename
            $filename = $originalName . '_converted.' . $format;
            
            // Return image as download
            return response($imageData)
                ->header('Content-Type', $this->getMimeType($format))
                ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
                ->header('Content-Length', strlen($imageData));
            
        } catch (\Exception $e) {
            Log::error('Image Conversion Error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while converting the image. Please ensure the image is not corrupted and try again.',
            ], 500);
        }
    }

    /**
     * Get MIME type for format
     */
    private function getMimeType($format)
    {
        $mimeTypes = [
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'webp' => 'image/webp',
        ];

        return $mimeTypes[$format] ?? 'image/jpeg';
    }
}

