<?php

namespace App\Http\Controllers;

class ToolsController extends Controller
{
    /**
     * Display the tools index page
     */
    public function index()
    {
        $metaDescription = 'Free online tools by Indsoft24. Convert JPG to PDF, compress images, convert PDF to images, compress PDFs, lock/unlock PDFs, convert DOC to PDF, and more. All tools are free, fast, and secure.';
        $canonicalUrl = route('tools.index');
        
        return view('tools.index', compact('metaDescription', 'canonicalUrl'));
    }
}

