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

        // Check if Ghostscript is available (primary), QPDF optional
        $isGhostscriptAvailable = $this->isGhostscriptAvailable();
        $isQpdfAvailable = $this->isQpdfAvailable();
        $isAvailable = $isGhostscriptAvailable || $isQpdfAvailable;

        return view('tools.pdf-lock', compact(
            'metaDescription', 'canonicalUrl',
            'isAvailable', 'isGhostscriptAvailable', 'isQpdfAvailable'
        ));
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
                'max:102400', // 100MB
            ],
            'password' => 'required|string|min:1|max:255',
            'confirm_password' => 'required|same:password',
        ], [
            'pdf.required' => 'Please upload a PDF file.',
            'pdf.file' => 'The uploaded file is not valid.',
            'pdf.mimes' => 'Only PDF files are allowed.',
            'pdf.max' => 'PDF file must not exceed 100MB.',
            'password.required' => 'Please enter a password.',
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

            $originalPath = $pdf->getRealPath();
            $originalName = pathinfo($pdf->getClientOriginalName(), PATHINFO_FILENAME);

            $filename = $originalName.'_locked_'.time().'.pdf';
            $outputPath = storage_path('app/temp/'.$filename);

            if (! file_exists(storage_path('app/temp'))) {
                mkdir(storage_path('app/temp'), 0755, true);
            }

            $lockedPath = null;

            // Ghostscript first
            if ($this->isGhostscriptAvailable()) {
                $lockedPath = $this->lockWithGhostscript($originalPath, $outputPath, $password);
            }

            // Fallback FPDI
            if (! $lockedPath && $this->isFpdiAvailable()) {
                $lockedPath = $this->lockWithFpdi($originalPath, $outputPath, $password);
            }

            // Fallback QPDF
            if (! $lockedPath && $this->isQpdfAvailable()) {
                $lockedPath = $this->lockWithQpdf($originalPath, $outputPath, $password);
            }

            if (! $lockedPath || ! file_exists($lockedPath)) {
                return response()->json([
                    'success' => false,
                    'message' => 'PDF locking failed. Ghostscript is installed, but there may be a server restriction preventing execution.',
                ], 500);
            }

            return response()->download($lockedPath, $filename)->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            Log::error('PDF Lock Error: '.$e->getMessage());
            Log::error('Stack trace: '.$e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while locking the PDF. Please ensure the PDF is not corrupted.',
            ], 500);
        }
    }

    /**
     * Check if FPDI is available
     */
    private function isFpdiAvailable()
    {
        return false; // Disabled until proper libraries installed
    }

    /**
     * Check if QPDF is available
     */
    private function isQpdfAvailable()
    {
        return $this->runCommand('/bin/qpdf --version')['success'];
    }

    /**
     * Check if Ghostscript is available
     */
    private function isGhostscriptAvailable()
    {
        return $this->runCommand('/bin/gs --version')['success'];
    }

    /**
     * Run a shell command safely using proc_open()
     */
    private function runCommand($command)
    {
        $pipes = [];
        $process = @proc_open($command, [1 => ['pipe', 'w'], 2 => ['pipe', 'w']], $pipes);

        if (!is_resource($process)) {
            return ['success' => false, 'output' => []];
        }

        $output = stream_get_contents($pipes[1]);
        fclose($pipes[1]);
        fclose($pipes[2]);

        $returnVar = proc_close($process);

        return [
            'success' => $returnVar === 0 && !empty(trim($output)),
            'output' => explode("\n", trim($output))
        ];
    }

    /**
     * Get Ghostscript path
     */
    private function getGhostscriptPath()
    {
        return '/bin/gs';
    }

    /**
     * Lock PDF using QPDF
     */
    private function lockWithQpdf($inputPath, $outputPath, $password)
    {
        $command = sprintf(
            '/bin/qpdf --encrypt %s %s 256 -- %s %s',
            escapeshellarg($password),
            escapeshellarg($password),
            escapeshellarg($inputPath),
            escapeshellarg($outputPath)
        );

        $result = $this->runCommand($command);

        return $result['success'] && file_exists($outputPath) && filesize($outputPath) > 0
            ? $outputPath
            : null;
    }

    /**
     * Lock PDF using Ghostscript
     */
   private function lockWithGhostscript($inputPath, $outputPath, $password)
{
    $command = sprintf(
        '/bin/gs -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dNOPAUSE -dBATCH ' .
        '-sOwnerPassword=%s -sUserPassword=%s ' .
        '-sOutputFile=%s %s 2>&1',
        escapeshellarg($password),
        escapeshellarg($password),
        escapeshellarg($outputPath),
        escapeshellarg($inputPath)
    );

    $output = [];
    $returnVar = 0;

    exec($command, $output, $returnVar);

    if ($returnVar === 0 && file_exists($outputPath) && filesize($outputPath) > 0) {
        return $outputPath;
    }

    return null;
}

    /**
     * Lock PDF using FPDI (currently disabled)
     */
    private function lockWithFpdi($inputPath, $outputPath, $password)
    {
        return null;
    }
}
