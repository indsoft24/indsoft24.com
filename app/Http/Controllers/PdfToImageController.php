<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class PdfToImageController extends Controller
{
    /**
     * Display the PDF to Image converter page
     */
    public function index()
    {
        $metaDescription = 'Convert PDF to JPG, PNG, and WEBP images online for free. Extract pages from PDF documents as high-quality images instantly. Fast, secure PDF to image converter by Indsoft24.';
        $canonicalUrl = route('tools.pdf-to-image');
        
        return view('tools.pdf-to-image', compact('metaDescription', 'canonicalUrl'));
    }

    /**
     * Convert uploaded PDF to images
     */
    public function convert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pdf' => 'required|mimes:pdf|max:51200', // 50MB max
            'format' => 'required|in:jpg,png,webp',
            'quality' => 'nullable|integer|min:1|max:100',
            'pages' => 'nullable|string', // Comma-separated page numbers or 'all'
        ], [
            'pdf.required' => 'Please upload a PDF file.',
            'pdf.mimes' => 'Only PDF files are allowed.',
            'pdf.max' => 'PDF file must not exceed 50MB.',
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
            // Check if Imagick is available
            if (!extension_loaded('imagick')) {
                return response()->json([
                    'success' => false,
                    'message' => 'ImageMagick extension is not available on this server. Please contact the administrator.',
                ], 500);
            }

            $pdf = $request->file('pdf');
            $format = $request->input('format', 'jpg');
            $quality = $request->input('quality', $format === 'png' ? 95 : 90);
            $pagesInput = $request->input('pages', 'all');

            // Get PDF path
            $pdfPath = $pdf->getRealPath();
            $pdfName = pathinfo($pdf->getClientOriginalName(), PATHINFO_FILENAME);

            // Create Imagick object
            $imagick = new \Imagick();
            $imagick->setResolution(300, 300); // High resolution
            $imagick->readImage($pdfPath);
            
            // Get total pages
            $totalPages = $imagick->getNumberImages();

            // Determine which pages to convert
            $pagesToConvert = [];
            if ($pagesInput === 'all' || empty($pagesInput)) {
                $pagesToConvert = range(0, $totalPages - 1);
            } else {
                $pageNumbers = array_map('trim', explode(',', $pagesInput));
                foreach ($pageNumbers as $pageNum) {
                    $pageIndex = (int)$pageNum - 1; // Convert to 0-based index
                    if ($pageIndex >= 0 && $pageIndex < $totalPages) {
                        $pagesToConvert[] = $pageIndex;
                    }
                }
            }

            if (empty($pagesToConvert)) {
                return response()->json([
                    'success' => false,
                    'message' => 'No valid pages selected for conversion.',
                ], 422);
            }

            // Set output format and quality
            $imagick->setImageFormat($format);
            if ($format === 'jpg' || $format === 'jpeg') {
                $imagick->setImageCompressionQuality($quality);
            } elseif ($format === 'webp') {
                $imagick->setImageCompressionQuality($quality);
            } elseif ($format === 'png') {
                $imagick->setImageCompressionQuality($quality);
            }

            // Create temp directory
            $tempDir = storage_path('app/temp/pdf-to-image-' . time());
            if (!file_exists($tempDir)) {
                mkdir($tempDir, 0755, true);
            }

            $convertedFiles = [];
            
            // Convert each page
            foreach ($pagesToConvert as $pageIndex) {
                $imagick->setIteratorIndex($pageIndex);
                $imagick->setImageBackgroundColor(new \ImagickPixel('white'));
                $imagick->setImageAlphaChannel(\Imagick::ALPHACHANNEL_REMOVE);
                
                $filename = $pdfName . '_page_' . ($pageIndex + 1) . '.' . $format;
                $filePath = $tempDir . '/' . $filename;
                
                $imagick->writeImage($filePath);
                $convertedFiles[] = [
                    'path' => $filePath,
                    'name' => $filename,
                ];
            }

            $imagick->clear();
            $imagick->destroy();

            // If multiple files, create a ZIP archive
            if (count($convertedFiles) > 1) {
                $zipPath = $tempDir . '/' . $pdfName . '_converted.zip';
                $zip = new ZipArchive();
                
                if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {
                    foreach ($convertedFiles as $file) {
                        $zip->addFile($file['path'], $file['name']);
                    }
                    $zip->close();
                    
                    // Delete individual image files
                    foreach ($convertedFiles as $file) {
                        if (file_exists($file['path'])) {
                            unlink($file['path']);
                        }
                    }
                    
                    // Return ZIP file
                    return response()->download($zipPath, $pdfName . '_converted.zip')
                        ->deleteFileAfterSend(true);
                } else {
                    // Fallback: return first image if ZIP creation fails
                    $firstFile = $convertedFiles[0];
                    return response()->download($firstFile['path'], $firstFile['name'])
                        ->deleteFileAfterSend(true);
                }
            } else {
                // Single file: return directly
                $file = $convertedFiles[0];
                return response()->download($file['path'], $file['name'])
                    ->deleteFileAfterSend(true);
            }
            
        } catch (\Exception $e) {
            \Log::error('PDF to Image Conversion Error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while converting PDF to images. Please ensure the PDF is not corrupted and try again.',
            ], 500);
        }
    }
}

