<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class CareerController extends Controller
{
    // Show career page
    public function index()
    {
        return view('company.career');
    }

    // Handle application
    public function apply(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email',
            'phone'    => 'required|string|max:20',
            'position' => 'required|string',
            'resume'   => 'required|mimes:pdf,doc,docx|max:2048',
            'message'  => 'nullable|string'
        ]);

        // Save resume
        $resumePath = $request->file('resume')->store('resumes', 'public');

        // Optionally: Save in DB
        // CareerApplication::create([...]);

        // Send email notification (optional)
        Mail::raw("New Job Application from {$request->name} for {$request->position}", function ($mail) use ($request, $resumePath) {
            $mail->to('indsoft24@gmail.com') // change to your HR email
                 ->subject("New Career Application - {$request->position}")
                 ->attach(storage_path("app/public/{$resumePath}"));
        });

        // Response (for modal AJAX)
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Your application has been submitted successfully! Our HR team will contact you soon.'
            ]);
        }

        return redirect()->back()->with('success', 'Application submitted successfully!');
    }
}
