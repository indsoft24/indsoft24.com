<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactTestLead;   // 🔥 THIS LINE WAS MISSING

class ContactTestLeadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        ContactTestLead::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return response()->json([
            'message' => 'Message sent successfully'
        ], 200);
    }
}
