@extends('layouts.app')

@section('title', 'Free Online Tools - PDF, Image, Document Converters | Indsoft24')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<!-- Hero Section -->
<section class="achievement-badge text-white py-5" style="margin-top:72px; position: relative; overflow: hidden;">
    <!-- Background Animations -->
    <div class="hero-background">
        <div class="hero-particles"></div>
        <div class="hero-gradient-overlay"></div>
        <!-- Floating geometric shapes -->
        <div class="floating-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
        <!-- Animated grid pattern -->
        <div class="animated-grid"></div>
    </div>
    <div class="container text-center" style="position: relative; z-index: 3;">
        <h1 class="display-4 fw-bold mb-3">Free Online Tools</h1>
        <p class="lead mb-4">
            Powerful, free tools to convert, compress, and manage your files. No registration required. Fast, secure, and easy to use.
        </p>
    </div>
</section>

<!-- Tools Grid Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">All Available Tools</h2>
            <p class="text-muted lead">Choose from our collection of free online tools</p>
        </div>

        <!-- Image Tools Section -->
        <div class="mb-5">
            <h3 class="fw-bold mb-4">
                <i class="bi bi-image text-primary me-2"></i>Image Tools
            </h3>
            <div class="row g-4">
                <!-- JPG to PDF -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 tool-card d-flex flex-column">
                        <div class="card-body p-4 d-flex flex-column flex-grow-1">
                            <div class="text-center mb-3">
                                <div class="tool-icon bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                    <i class="bi bi-file-earmark-pdf" style="font-size: 2.5rem;"></i>
                                </div>
                                <h4 class="fw-bold">JPG to PDF</h4>
                            </div>
                            <p class="text-muted text-center mb-4 flex-grow-1">
                                Convert JPG, JPEG, and PNG images to PDF format. Perfect for creating documents from images.
                            </p>
                            <div class="text-center mt-auto">
                                <a href="{{ route('tools.jpg-to-pdf') }}" class="btn btn-primary">
                                    <i class="bi bi-arrow-right-circle me-2"></i>Use Tool
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image Converter -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 tool-card d-flex flex-column">
                        <div class="card-body p-4 d-flex flex-column flex-grow-1">
                            <div class="text-center mb-3">
                                <div class="tool-icon bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                    <i class="bi bi-arrow-left-right" style="font-size: 2.5rem;"></i>
                                </div>
                                <h4 class="fw-bold">Image Converter</h4>
                            </div>
                            <p class="text-muted text-center mb-4 flex-grow-1">
                                Convert images between JPEG, PNG, WEBP formats with customizable quality settings.
                            </p>
                            <div class="text-center mt-auto">
                                <a href="{{ route('tools.image-converter') }}" class="btn btn-primary">
                                    <i class="bi bi-arrow-right-circle me-2"></i>Use Tool
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image Compress -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 tool-card d-flex flex-column">
                        <div class="card-body p-4 d-flex flex-column flex-grow-1">
                            <div class="text-center mb-3">
                                <div class="tool-icon bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                    <i class="bi bi-file-earmark-zip" style="font-size: 2.5rem;"></i>
                                </div>
                                <h4 class="fw-bold">Image Compressor</h4>
                            </div>
                            <p class="text-muted text-center mb-4 flex-grow-1">
                                Compress and optimize images to reduce file size while maintaining quality. Supports all major formats.
                            </p>
                            <div class="text-center mt-auto">
                                <a href="{{ route('tools.image-compress') }}" class="btn btn-primary">
                                    <i class="bi bi-arrow-right-circle me-2"></i>Use Tool
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PDF Tools Section -->
        <div class="mb-5">
            <h3 class="fw-bold mb-4">
                <i class="bi bi-file-earmark-pdf text-danger me-2"></i>PDF Tools
            </h3>
            <div class="row g-4">
                <!-- PDF to Image -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 tool-card d-flex flex-column">
                        <div class="card-body p-4 d-flex flex-column flex-grow-1">
                            <div class="text-center mb-3">
                                <div class="tool-icon bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                    <i class="bi bi-image" style="font-size: 2.5rem;"></i>
                                </div>
                                <h4 class="fw-bold">PDF to Image</h4>
                            </div>
                            <p class="text-muted text-center mb-4 flex-grow-1">
                                Convert PDF pages to images (JPG, PNG). Extract images from PDF documents easily.
                            </p>
                            <div class="text-center mt-auto">
                                <a href="{{ route('tools.pdf-to-image') }}" class="btn btn-primary">
                                    <i class="bi bi-arrow-right-circle me-2"></i>Use Tool
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PDF Compress -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 tool-card d-flex flex-column">
                        <div class="card-body p-4 d-flex flex-column flex-grow-1">
                            <div class="text-center mb-3">
                                <div class="tool-icon bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                    <i class="bi bi-file-earmark-zip" style="font-size: 2.5rem;"></i>
                                </div>
                                <h4 class="fw-bold">PDF Compress</h4>
                            </div>
                            <p class="text-muted text-center mb-4 flex-grow-1">
                                Reduce PDF file size without losing quality. Perfect for sharing and uploading large PDF files.
                            </p>
                            <div class="text-center mt-auto">
                                <a href="{{ route('tools.pdf-compress') }}" class="btn btn-primary">
                                    <i class="bi bi-arrow-right-circle me-2"></i>Use Tool
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PDF Lock -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 tool-card d-flex flex-column">
                        <div class="card-body p-4 d-flex flex-column flex-grow-1">
                            <div class="text-center mb-3">
                                <div class="tool-icon bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                    <i class="bi bi-lock-fill" style="font-size: 2.5rem;"></i>
                                </div>
                                <h4 class="fw-bold">PDF Lock</h4>
                            </div>
                            <p class="text-muted text-center mb-4 flex-grow-1">
                                Add password protection to your PDF files. Secure your documents with encryption.
                            </p>
                            <div class="text-center mt-auto">
                                <a href="{{ route('tools.pdf-lock') }}" class="btn btn-primary">
                                    <i class="bi bi-arrow-right-circle me-2"></i>Use Tool
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PDF Unlock -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 tool-card d-flex flex-column">
                        <div class="card-body p-4 d-flex flex-column flex-grow-1">
                            <div class="text-center mb-3">
                                <div class="tool-icon bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                    <i class="bi bi-unlock-fill" style="font-size: 2.5rem;"></i>
                                </div>
                                <h4 class="fw-bold">PDF Unlock</h4>
                            </div>
                            <p class="text-muted text-center mb-4 flex-grow-1">
                                Remove password protection from PDF files. Unlock protected PDF documents easily.
                            </p>
                            <div class="text-center mt-auto">
                                <a href="{{ route('tools.pdf-unlock') }}" class="btn btn-primary">
                                    <i class="bi bi-arrow-right-circle me-2"></i>Use Tool
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Document Tools Section -->
        <div class="mb-5">
            <h3 class="fw-bold mb-4">
                <i class="bi bi-file-earmark-text text-success me-2"></i>Document Tools
            </h3>
            <div class="row g-4">
                <!-- DOC to PDF -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 tool-card d-flex flex-column">
                        <div class="card-body p-4 d-flex flex-column flex-grow-1">
                            <div class="text-center mb-3">
                                <div class="tool-icon bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                    <i class="bi bi-file-earmark-pdf" style="font-size: 2.5rem;"></i>
                                </div>
                                <h4 class="fw-bold">DOC to PDF</h4>
                            </div>
                            <p class="text-muted text-center mb-4 flex-grow-1">
                                Convert Word documents (DOC, DOCX) to PDF format. Perfect for sharing documents.
                            </p>
                            <div class="text-center mt-auto">
                                <a href="{{ route('tools.doc-to-pdf') }}" class="btn btn-primary">
                                    <i class="bi bi-arrow-right-circle me-2"></i>Use Tool
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">Why Choose Our Tools?</h2>
            <p class="text-muted lead">All our tools are completely free and easy to use</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="text-center p-4">
                    <div class="feature-icon bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="bi bi-shield-check" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold">100% Free</h5>
                    <p class="text-muted">All tools are completely free to use. No hidden charges, no subscriptions required.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-4">
                    <div class="feature-icon bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="bi bi-lightning-charge" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold">Fast Processing</h5>
                    <p class="text-muted">All conversions and compressions are processed quickly. No long waiting times.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-4">
                    <div class="feature-icon bg-info text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="bi bi-lock-fill" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold">Secure & Private</h5>
                    <p class="text-muted">Your files are processed securely. Files are deleted immediately after processing.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-4">
                    <div class="feature-icon bg-warning text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="bi bi-phone" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold">Mobile Friendly</h5>
                    <p class="text-muted">All tools work perfectly on mobile devices. Use anywhere, anytime.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-4">
                    <div class="feature-icon bg-danger text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="bi bi-x-circle" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold">No Registration</h5>
                    <p class="text-muted">Use all tools without creating an account. No email required, no sign-up needed.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-4">
                    <div class="feature-icon bg-secondary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="bi bi-star-fill" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold">High Quality</h5>
                    <p class="text-muted">Maintain original quality while converting or compressing files. Professional results.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-5">
    <div class="container text-center">
        <h2 class="fw-bold mb-3">Need Custom Software Solutions?</h2>
        <p class="lead text-muted mb-4">
            At Indsoft24, we specialize in creating custom software solutions tailored to your business needs. 
            From web development to mobile apps, we've got you covered.
        </p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:pointer" class="btn btn-primary btn-lg">
                <i class="bi bi-chat-dots me-2"></i>Get Free Consultation
            </a>
            <a href="{{ route('services.index') }}" class="btn btn-outline-primary btn-lg">
                <i class="bi bi-briefcase me-2"></i>View Our Services
            </a>
        </div>
    </div>
</section>

@endsection

@push('styles')
    <style>
        /* Hero Section Animation */
        .achievement-badge {
            border-radius: 0 !important;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #ff6b9d 75%, #c44569 100%);
            background-size: 300% 300%;
            animation: gradientShift 10s ease infinite;
            position: relative;
            overflow: hidden;
        }
        
        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        .hero-background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1;
        }
        
        .hero-particles {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 2;
            background-image: 
                radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.12) 2px, transparent 2px),
                radial-gradient(circle at 75% 75%, rgba(255, 255, 255, 0.1) 1.5px, transparent 1.5px);
            background-size: 120px 120px, 180px 180px;
            opacity: 0.5;
        }
        
        .hero-gradient-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 2;
            background: radial-gradient(circle at 30% 20%, rgba(255,255,255,0.15) 0%, transparent 50%);
        }
        
        .floating-shapes {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 2;
            overflow: hidden;
            pointer-events: none;
        }
        
        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
        }
        
        .shape-1 {
            width: 150px;
            height: 150px;
            top: 10%;
            left: 5%;
            animation: floatShape 20s ease-in-out infinite;
        }
        
        .shape-2 {
            width: 120px;
            height: 120px;
            top: 60%;
            right: 10%;
            animation: floatShape 20s ease-in-out infinite 2s;
        }
        
        .shape-3 {
            width: 180px;
            height: 180px;
            bottom: 15%;
            left: 15%;
            animation: floatShape 20s ease-in-out infinite 4s;
        }
        
        @keyframes floatShape {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(30px, -30px) rotate(180deg); }
        }
        
        .animated-grid {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1;
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: gridMove 20s linear infinite;
            opacity: 0.4;
        }
        
        @keyframes gridMove {
            0% { background-position: 0 0; }
            100% { background-position: 50px 50px; }
        }
        
        /* Tool Cards */
        .tool-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 10px;
        }
        
        .tool-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
        }
        
        .tool-icon {
            transition: transform 0.3s ease;
        }
        
        .tool-card:hover .tool-icon {
            transform: scale(1.1);
        }
        
        .feature-icon {
            transition: transform 0.3s ease;
        }
        
        .feature-icon:hover {
            transform: scale(1.1);
        }
        
        /* Card Styling */
        .card {
            border-radius: 10px;
        }
        
        /* Button Styling */
        .btn {
            border-radius: 5px;
        }
    </style>
@endpush

