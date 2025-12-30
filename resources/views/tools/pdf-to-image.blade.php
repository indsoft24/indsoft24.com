@extends('layouts.app')

@section('title', 'Free PDF to Image Converter - Convert PDF to JPG, PNG, WEBP Online | Indsoft24')

@section('content')
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
            <h1 class="display-4 fw-bold mb-3">PDF to Image Converter - Extract Pages as Images</h1>
            <p class="lead mb-4">
                Convert PDF documents to high-quality JPG, PNG, or WEBP images instantly. Extract individual pages or entire PDFs with our free online converter.
            </p>
        </div>
    </section>

    <!-- Converter Tool Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <i class="bi bi-file-earmark-pdf display-4 text-danger mb-3"></i>
                                <h2 class="fw-bold">Convert PDF to Images</h2>
                                <p class="text-muted">Upload your PDF and extract pages as high-quality images in your preferred format</p>
                            </div>

                            <!-- Upload Form -->
                            <form id="convertForm" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="pdf" class="form-label fw-semibold">Select PDF File</label>
                                        <input type="file" class="form-control" id="pdf" name="pdf" accept="application/pdf" required>
                                        <div class="form-text">Maximum file size: 50MB. All pages will be converted by default.</div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="format" class="form-label fw-semibold">Output Format</label>
                                        <select class="form-select" id="format" name="format" required>
                                            <option value="jpg" selected>JPG / JPEG</option>
                                            <option value="png">PNG</option>
                                            <option value="webp">WEBP</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="quality" class="form-label fw-semibold">Image Quality</label>
                                        <input type="range" class="form-range" id="quality" name="quality" min="1" max="100" value="90" oninput="document.getElementById('qualityValue').textContent = this.value">
                                        <div class="form-text text-center">
                                            <span id="qualityValue">90</span>% Quality
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="pages" class="form-label fw-semibold">Pages (Optional)</label>
                                        <input type="text" class="form-control" id="pages" name="pages" placeholder="e.g., 1,3,5 or leave empty for all">
                                        <div class="form-text">Specify page numbers (comma-separated) or leave empty for all pages</div>
                                    </div>
                                </div>

                                <!-- Preview Area -->
                                <div id="pdfPreview" class="mb-4 mt-4" style="display: none;">
                                    <h5 class="fw-semibold mb-3">PDF Preview:</h5>
                                    <div class="alert alert-info">
                                        <i class="bi bi-info-circle me-2"></i>
                                        <span id="pdfInfo">PDF loaded successfully</span>
                                    </div>
                                </div>

                                <!-- Progress Bar -->
                                <div id="progressContainer" class="mb-4" style="display: none;">
                                    <div class="progress" style="height: 25px;">
                                        <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%">0%</div>
                                    </div>
                                    <p class="text-center mt-2 mb-0" id="progressText">Preparing conversion...</p>
                                </div>

                                <!-- Error/Success Messages -->
                                <div id="messageContainer" class="mb-4"></div>

                                <!-- Convert Button -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-danger btn-lg px-5" id="convertBtn">
                                        <i class="bi bi-download me-2"></i>Convert PDF to Images
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Convert PDF to Images Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-4">Why Convert PDF to Image Format?</h2>
                    <p class="lead text-muted mb-4">
                        Converting PDF documents to image formats like JPG, PNG, or WEBP offers numerous advantages for digital workflows, content creation, and document management.
                    </p>
                    <div class="mb-4">
                        <h5 class="fw-semibold mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i>Universal Compatibility</h5>
                        <p class="text-muted">Image formats are supported by virtually every device, application, and platform. Convert PDF to JPG or PNG for maximum compatibility across all systems.</p>
                    </div>
                    <div class="mb-4">
                        <h5 class="fw-semibold mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i>Easy Sharing & Embedding</h5>
                        <p class="text-muted">Images can be easily embedded in websites, presentations, social media posts, and email communications without requiring PDF readers.</p>
                    </div>
                    <div class="mb-4">
                        <h5 class="fw-semibold mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i>Content Extraction</h5>
                        <p class="text-muted">Extract specific pages or visual content from PDF documents for use in graphic design, web development, or content creation projects.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-4 bg-white rounded shadow-sm">
                        <h4 class="fw-bold mb-3">Supported Formats</h4>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="p-3 border rounded h-100">
                                    <i class="bi bi-file-earmark-image display-6 text-primary mb-2"></i>
                                    <h6 class="fw-semibold">JPG / JPEG</h6>
                                    <p class="small text-muted mb-0">Best for photographs and complex images. Smaller file sizes with good quality.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 border rounded h-100">
                                    <i class="bi bi-image display-6 text-info mb-2"></i>
                                    <h6 class="fw-semibold">PNG</h6>
                                    <p class="small text-muted mb-0">Perfect for images with transparency. Lossless compression for high quality.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 border rounded h-100">
                                    <i class="bi bi-filetype-webp display-6 text-success mb-2"></i>
                                    <h6 class="fw-semibold">WEBP</h6>
                                    <p class="small text-muted mb-0">Modern format with superior compression. Ideal for web use and faster loading.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 border rounded h-100">
                                    <i class="bi bi-stack display-6 text-warning mb-2"></i>
                                    <h6 class="fw-semibold">Batch Conversion</h6>
                                    <p class="small text-muted mb-0">Convert all pages at once or select specific pages. Download as ZIP for multiple images.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Key Benefits of Our PDF to Image Converter</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-speedometer2 display-4 text-primary mb-3"></i>
                        <h5 class="fw-bold">Lightning Fast</h5>
                        <p class="text-muted">Convert PDF pages to images in seconds. Our optimized processing engine handles large documents efficiently.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-hd display-4 text-success mb-3"></i>
                        <h5 class="fw-bold">High Resolution</h5>
                        <p class="text-muted">Extract images at 300 DPI resolution, ensuring crisp, clear output suitable for printing and professional use.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-shield-lock display-4 text-warning mb-3"></i>
                        <h5 class="fw-bold">100% Secure</h5>
                        <p class="text-muted">Your PDF files are processed securely and automatically deleted after conversion. No data is stored or shared.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-sliders display-4 text-info mb-3"></i>
                        <h5 class="fw-bold">Customizable Quality</h5>
                        <p class="text-muted">Adjust image quality from 1% to 100% to balance file size and image clarity according to your needs.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-list-ol display-4 text-danger mb-3"></i>
                        <h5 class="fw-bold">Selective Page Extraction</h5>
                        <p class="text-muted">Choose specific pages to convert or extract all pages at once. Perfect for large documents.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-cloud-download display-4 text-secondary mb-3"></i>
                        <h5 class="fw-bold">Easy Download</h5>
                        <p class="text-muted">Single images download directly. Multiple pages are automatically packaged in a convenient ZIP file.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Use Cases Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Common Use Cases for PDF to Image Conversion</h2>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="bi bi-globe display-6 text-primary"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="fw-semibold">Web Development</h5>
                            <p class="text-muted mb-0">Convert PDF designs to images for website integration, creating image galleries, or displaying document previews.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="bi bi-instagram display-6 text-danger"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="fw-semibold">Social Media Content</h5>
                            <p class="text-muted mb-0">Extract pages from PDF documents to create engaging social media posts, stories, or infographics.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="bi bi-presentation display-6 text-warning"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="fw-semibold">Presentations</h5>
                            <p class="text-muted mb-0">Convert PDF slides to images for PowerPoint, Google Slides, or other presentation software.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="bi bi-palette display-6 text-info"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="fw-semibold">Graphic Design</h5>
                            <p class="text-muted mb-0">Extract visual elements from PDFs for use in design projects, editing, or creative work.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="bi bi-archive display-6 text-success"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="fw-semibold">Document Archiving</h5>
                            <p class="text-muted mb-0">Convert important PDF documents to image format for long-term archival and backup purposes.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="bi bi-envelope-paper display-6 text-secondary"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="fw-semibold">Email Attachments</h5>
                            <p class="text-muted mb-0">Convert PDF pages to images for easier email sharing, especially when recipients may not have PDF readers.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">How to Convert PDF to Images - Simple Steps</h2>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="text-center">
                        <div class="step-number bg-danger text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; font-size: 24px; font-weight: bold;">1</div>
                        <h5 class="fw-semibold">Upload PDF</h5>
                        <p class="text-muted small">Select your PDF file from your device. Our converter supports PDFs up to 50MB in size.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <div class="step-number bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; font-size: 24px; font-weight: bold;">2</div>
                        <h5 class="fw-semibold">Choose Format</h5>
                        <p class="text-muted small">Select your preferred output format: JPG for photos, PNG for transparency, or WEBP for web optimization.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <div class="step-number bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; font-size: 24px; font-weight: bold;">3</div>
                        <h5 class="fw-semibold">Set Options</h5>
                        <p class="text-muted small">Adjust image quality and optionally specify which pages to convert (leave empty for all pages).</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <div class="step-number bg-warning text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; font-size: 24px; font-weight: bold;">4</div>
                        <h5 class="fw-semibold">Download Images</h5>
                        <p class="text-muted small">Get your converted images instantly. Single page downloads directly, multiple pages come as a ZIP file.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SEO Content Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 class="fw-bold mb-4">Professional PDF to Image Conversion Services</h2>
                    <div class="content-section">
                        <p class="lead text-muted mb-4">
                            Our free PDF to image converter is designed for professionals, content creators, and businesses who need to extract visual content from PDF documents. Whether you're converting PDF to JPG for web use, extracting pages as PNG images for design work, or creating WEBP files for modern web applications, our tool delivers high-quality results.
                        </p>
                        
                        <h3 class="fw-bold mt-4 mb-3">Best Practices for PDF to Image Conversion</h3>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i><strong>Choose the Right Format:</strong> Use JPG for photographs and complex images, PNG for images requiring transparency, and WEBP for web optimization with smaller file sizes.</li>
                            <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i><strong>Quality Settings:</strong> For print purposes, use 95-100% quality. For web use, 80-90% provides a good balance between quality and file size.</li>
                            <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i><strong>Page Selection:</strong> Convert only the pages you need to save processing time and reduce file sizes when working with large PDF documents.</li>
                            <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i><strong>Resolution:</strong> Our converter extracts images at 300 DPI, which is suitable for both screen display and high-quality printing.</li>
                        </ul>

                        <h3 class="fw-bold mt-4 mb-3">Technical Specifications</h3>
                        <p class="text-muted mb-3">
                            Our PDF to image converter supports all standard PDF formats and can extract pages as:
                        </p>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-file-earmark-image text-primary me-2"></i><strong>JPG/JPEG:</strong> Ideal for photographs, supports quality adjustment from 1-100%, smaller file sizes</li>
                            <li class="mb-2"><i class="bi bi-image text-info me-2"></i><strong>PNG:</strong> Lossless compression, supports transparency, perfect for graphics and illustrations</li>
                            <li class="mb-2"><i class="bi bi-filetype-webp text-success me-2"></i><strong>WEBP:</strong> Modern format with superior compression, 25-35% smaller than JPEG at same quality</li>
                        </ul>

                        <h3 class="fw-bold mt-4 mb-3">About Indsoft24 - Your Technology Partner</h3>
                        <p class="text-muted mb-3">
                            Indsoft24 is a leading software development company based in Noida, India, specializing in creating innovative digital solutions. With over <strong>5+ years of experience</strong> and <strong>100+ successful projects</strong>, we provide cutting-edge technology services including web development, mobile app development, custom software solutions, and SEO services.
                        </p>
                        <p class="text-muted mb-4">
                            Our team of expert developers and designers is committed to delivering high-quality solutions that drive business growth. We combine technical excellence with creative innovation to help businesses transform their digital presence.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-5">
        <div class="container text-center">
            <h2 class="fw-bold mb-3">Need Custom Software Development Services?</h2>
            <p class="lead text-muted mb-4">
                At Indsoft24, we specialize in building custom software solutions, web applications, and mobile apps tailored to your business needs. 
                Let's discuss how we can help transform your ideas into reality.
            </p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:pointer" class="btn btn-danger btn-lg">
                    <i class="bi bi-chat-dots me-2"></i>Get Free Consultation
                </a>
                <a href="{{ route('services.index') }}" class="btn btn-outline-danger btn-lg">
                    <i class="bi bi-briefcase me-2"></i>Explore Our Services
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
            background: linear-gradient(135deg, #dc3545 0%, #c82333 25%, #bd2130 50%, #a71e2a 75%, #8b1a22 100%);
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
        
        /* Card Styling */
        .card {
            border-radius: 0;
        }
        
        /* Progress Bar */
        .progress {
            border-radius: 0;
        }
        
        /* Button Styling */
        .btn {
            border-radius: 0;
        }

        /* Form Range Styling */
        .form-range {
            cursor: pointer;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('convertForm');
            const fileInput = document.getElementById('pdf');
            const pdfPreview = document.getElementById('pdfPreview');
            const pdfInfo = document.getElementById('pdfInfo');
            const progressContainer = document.getElementById('progressContainer');
            const progressBar = document.getElementById('progressBar');
            const progressText = document.getElementById('progressText');
            const messageContainer = document.getElementById('messageContainer');
            const convertBtn = document.getElementById('convertBtn');
            
            // Handle file selection
            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    if (file.type !== 'application/pdf') {
                        showMessage('Please select a valid PDF file.', 'danger');
                        fileInput.value = '';
                        pdfPreview.style.display = 'none';
                        return;
                    }
                    
                    if (file.size > 50 * 1024 * 1024) {
                        showMessage('PDF file size must not exceed 50MB.', 'danger');
                        fileInput.value = '';
                        pdfPreview.style.display = 'none';
                        return;
                    }
                    
                    pdfInfo.textContent = `PDF loaded: ${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)`;
                    pdfPreview.style.display = 'block';
                } else {
                    pdfPreview.style.display = 'none';
                }
            });
            
            // Handle form submission
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                if (!fileInput.files || fileInput.files.length === 0) {
                    showMessage('Please select a PDF file.', 'danger');
                    return;
                }
                
                // Show progress
                progressContainer.style.display = 'block';
                progressBar.style.width = '30%';
                progressText.textContent = 'Uploading PDF...';
                convertBtn.disabled = true;
                messageContainer.innerHTML = '';
                
                // Create FormData
                const formData = new FormData();
                formData.append('pdf', fileInput.files[0]);
                formData.append('format', document.getElementById('format').value);
                formData.append('quality', document.getElementById('quality').value);
                const pagesValue = document.getElementById('pages').value.trim();
                if (pagesValue) {
                    formData.append('pages', pagesValue);
                }
                
                try {
                    // Simulate progress
                    progressBar.style.width = '60%';
                    progressText.textContent = 'Converting PDF to images...';
                    
                    const response = await fetch('{{ route("tools.pdf-to-image.convert") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: formData
                    });
                    
                    if (response.ok) {
                        progressBar.style.width = '90%';
                        progressText.textContent = 'Preparing download...';
                        
                        // Get filename from response
                        const contentDisposition = response.headers.get('Content-Disposition');
                        const filename = contentDisposition 
                            ? contentDisposition.split('filename=')[1].replace(/"/g, '')
                            : 'converted.zip';
                        
                        // Download the file
                        const blob = await response.blob();
                        const url = window.URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.href = url;
                        a.download = filename;
                        document.body.appendChild(a);
                        a.click();
                        window.URL.revokeObjectURL(url);
                        document.body.removeChild(a);
                        
                        showMessage('PDF converted successfully! Your images are downloading.', 'success');
                        
                        // Reset form after delay
                        setTimeout(() => {
                            form.reset();
                            pdfPreview.style.display = 'none';
                            progressContainer.style.display = 'none';
                        }, 3000);
                    } else {
                        const error = await response.json();
                        showMessage(error.message || 'An error occurred during conversion.', 'danger');
                    }
                } catch (error) {
                    showMessage('An error occurred. Please try again.', 'danger');
                } finally {
                    convertBtn.disabled = false;
                    progressContainer.style.display = 'none';
                    progressBar.style.width = '0%';
                }
            });
            
            // Show message
            function showMessage(message, type) {
                messageContainer.innerHTML = `
                    <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                        ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                `;
            }
        });
    </script>
@endpush

