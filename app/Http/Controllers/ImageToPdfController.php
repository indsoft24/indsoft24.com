<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use TCPDF;

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
            'images.*.mimes' => 'Only JPEG and PNG images are allowed.',
            'images.*.max' => 'Each image must not exceed 10MB.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        try {
            $images = $request->file('images');
            
            // Create new PDF document
            $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
            
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
                if (!$image->isValid()) {
                    continue;
                }
                
                // Get image path
                $imagePath = $image->getRealPath();
                $imageInfo = getimagesize($imagePath);
                
                if ($imageInfo === false) {
                    continue;
                }
                
                // Get image dimensions
                $imageWidth = $imageInfo[0];
                $imageHeight = $imageInfo[1];
                
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
                $pdf->Image($imagePath, $x, $y, $pdfWidth, $pdfHeight, '', '', '', false, 300, '', false, false, 0);
            }
            
            // Generate PDF filename
            $filename = 'converted_' . time() . '.pdf';
            $pdfPath = storage_path('app/temp/' . $filename);
            
            // Ensure temp directory exists
            if (!file_exists(storage_path('app/temp'))) {
                mkdir(storage_path('app/temp'), 0755, true);
            }
            
            // Save PDF
            $pdf->Output($pdfPath, 'F');
            
            // Return PDF as download
            return response()->download($pdfPath, $filename)->deleteFileAfterSend(true);
            
        } catch (\Exception $e) {
            \Log::error('PDF Conversion Error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while converting images to PDF. Please try again.',
            ], 500);
        }
    }
}

