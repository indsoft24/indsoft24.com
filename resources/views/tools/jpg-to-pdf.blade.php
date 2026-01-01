@extends('layouts.app')

@section('title', 'Free JPG to PDF Converter Online - Convert Images to PDF | Indsoft24')

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
            <h1 class="display-4 fw-bold mb-3">Free JPG to PDF Converter</h1>
            <p class="lead mb-4">
                Convert your JPG, JPEG, and PNG images to PDF format instantly. Fast, secure, and completely free - no registration required.
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
                                <i class="bi bi-image display-4 text-primary mb-3"></i>
                                <h2 class="fw-bold">Convert Images to PDF</h2>
                                <p class="text-muted">Upload one or multiple images and convert them to a single PDF file</p>
                            </div>

                            <!-- Upload Form -->
                            <form id="convertForm" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <label for="images" class="form-label fw-semibold">Select Images (JPG, JPEG, PNG)</label>
                                    <input type="file" class="form-control" id="images" name="images[]" accept="image/jpeg,image/png" multiple required>
                                    <div class="form-text">You can upload up to 20 images at once. Maximum file size: 10MB per image.</div>
                                </div>

                                <!-- Preview Area -->
                                <div id="imagePreview" class="mb-4" style="display: none;">
                                    <h5 class="fw-semibold mb-3">Selected Images:</h5>
                                    <div id="previewContainer" class="row g-3"></div>
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
                                    <button type="submit" class="btn btn-primary btn-lg px-5" id="convertBtn">
                                        <i class="bi bi-file-earmark-pdf me-2"></i>Convert to PDF
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Indsoft24 Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-4">About Indsoft24 - Your Trusted Technology Partner</h2>
                    <p class="lead text-muted mb-4">
                        Indsoft24 is a leading software development company based in Noida, India, specializing in innovative digital solutions that transform businesses.
                    </p>
                    <p class="mb-4">
                        With over <strong>5+ years of experience</strong> and <strong>100+ successful projects</strong>, we have established ourselves as a trusted partner for businesses seeking cutting-edge technology solutions. Our expert team combines creativity with technical excellence to deliver products that exceed expectations.
                    </p>
                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <div class="text-center p-3 bg-white rounded shadow-sm">
                                <h3 class="text-primary fw-bold mb-0">100+</h3>
                                <p class="text-muted mb-0 small">Projects Delivered</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center p-3 bg-white rounded shadow-sm">
                                <h3 class="text-success fw-bold mb-0">50+</h3>
                                <p class="text-muted mb-0 small">Happy Clients</p>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('home') }}" class="btn btn-primary">Learn More About Us</a>
                </div>
                <div class="col-lg-6">
                    <div class="p-4">
                        <h4 class="fw-bold mb-3">Our Core Services</h4>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="p-3 bg-white rounded shadow-sm h-100">
                                    <i class="bi bi-window-stack display-6 text-primary mb-2"></i>
                                    <h6 class="fw-semibold">Web Development</h5>
                                    <p class="small text-muted mb-0">Custom websites and web applications built with modern technologies.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 bg-white rounded shadow-sm h-100">
                                    <i class="bi bi-phone display-6 text-success mb-2"></i>
                                    <h6 class="fw-semibold">App Development</h5>
                                    <p class="small text-muted mb-0">Native and cross-platform mobile applications for iOS and Android.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 bg-white rounded shadow-sm h-100">
                                    <i class="bi bi-code-slash display-6 text-warning mb-2"></i>
                                    <h6 class="fw-semibold">Software Development</h5>
                                    <p class="small text-muted mb-0">Tailored software solutions for specific business challenges.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 bg-white rounded shadow-sm h-100">
                                    <i class="bi bi-search display-6 text-danger mb-2"></i>
                                    <h6 class="fw-semibold">SEO Optimization</h5>
                                    <p class="small text-muted mb-0">Boost your online visibility with our SEO services.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Use Our Converter Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Why Use Our JPG to PDF Converter?</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-shield-check display-4 text-success mb-3"></i>
                        <h5 class="fw-bold">100% Secure</h5>
                        <p class="text-muted">All conversions are processed securely. Your images are never stored on our servers and are deleted immediately after conversion.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-lightning-charge display-4 text-warning mb-3"></i>
                        <h5 class="fw-bold">Fast & Efficient</h5>
                        <p class="text-muted">Convert multiple images to PDF in seconds. Our optimized conversion process ensures quick results without compromising quality.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-gift display-4 text-primary mb-3"></i>
                        <h5 class="fw-bold">Completely Free</h5>
                        <p class="text-muted">No hidden charges, no registration required. Use our converter as many times as you need, absolutely free.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-images display-4 text-info mb-3"></i>
                        <h5 class="fw-bold">Multiple Images</h5>
                        <p class="text-muted">Convert up to 20 images at once into a single PDF document. Perfect for creating photo albums or document collections.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-device-hdd display-4 text-danger mb-3"></i>
                        <h5 class="fw-bold">High Quality</h5>
                        <p class="text-muted">Maintains original image quality during conversion. Your PDFs will look crisp and professional.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-globe display-4 text-secondary mb-3"></i>
                        <h5 class="fw-bold">Works Everywhere</h5>
                        <p class="text-muted">Access our converter from any device - desktop, tablet, or mobile. Works on all modern browsers.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">How to Convert JPG to PDF</h2>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="text-center">
                        <div class="step-number bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; font-size: 24px; font-weight: bold;">1</div>
                        <h5 class="fw-semibold">Upload Images</h5>
                        <p class="text-muted small">Click the upload button and select your JPG, JPEG, or PNG images. You can select multiple images at once.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <div class="step-number bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; font-size: 24px; font-weight: bold;">2</div>
                        <h5 class="fw-semibold">Preview Images</h5>
                        <p class="text-muted small">Review your selected images. You can see thumbnails of all images before conversion.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <div class="step-number bg-warning text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; font-size: 24px; font-weight: bold;">3</div>
                        <h5 class="fw-semibold">Convert to PDF</h5>
                        <p class="text-muted small">Click the "Convert to PDF" button. Our system will process your images and create a PDF file.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <div class="step-number bg-danger text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; font-size: 24px; font-weight: bold;">4</div>
                        <h5 class="fw-semibold">Download PDF</h5>
                        <p class="text-muted small">Your PDF will be ready in seconds. Simply download it to your device.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Use Cases Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Common Use Cases</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="bi bi-file-earmark-pdf display-6 text-primary"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="fw-semibold">Document Archiving</h5>
                            <p class="text-muted mb-0">Convert scanned documents and photos into PDF format for easy archiving and sharing.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="bi bi-envelope-paper display-6 text-success"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="fw-semibold">Email Attachments</h5>
                            <p class="text-muted mb-0">Convert multiple images into a single PDF file to reduce email attachment size and simplify sharing.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="bi bi-printer display-6 text-warning"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="fw-semibold">Printing</h5>
                            <p class="text-muted mb-0">Create print-ready PDFs from images for professional documents and presentations.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="bi bi-cloud-upload display-6 text-info"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="fw-semibold">Cloud Storage</h5>
                            <p class="text-muted mb-0">Convert images to PDF before uploading to cloud storage services for better organization.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-5 bg-light">
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
        
        /* Preview Images */
        #previewContainer img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .preview-item {
            position: relative;
        }
        
        .preview-item .remove-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(220, 53, 69, 0.9);
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
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
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('convertForm');
            const fileInput = document.getElementById('images');
            const previewContainer = document.getElementById('previewContainer');
            const imagePreview = document.getElementById('imagePreview');
            const progressContainer = document.getElementById('progressContainer');
            const progressBar = document.getElementById('progressBar');
            const progressText = document.getElementById('progressText');
            const messageContainer = document.getElementById('messageContainer');
            const convertBtn = document.getElementById('convertBtn');
            
            let selectedFiles = [];
            
            // Handle file selection
            fileInput.addEventListener('change', function(e) {
                const files = Array.from(e.target.files);
                selectedFiles = files;
                
                if (files.length > 0) {
                    displayPreview(files);
                } else {
                    imagePreview.style.display = 'none';
                }
            });
            
            // Display preview of selected images
            function displayPreview(files) {
                previewContainer.innerHTML = '';
                imagePreview.style.display = 'block';
                
                files.forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const col = document.createElement('div');
                        col.className = 'col-md-3 col-sm-4 col-6';
                        
                        const previewItem = document.createElement('div');
                        previewItem.className = 'preview-item';
                        
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'img-fluid';
                        img.alt = file.name;
                        
                        const removeBtn = document.createElement('button');
                        removeBtn.type = 'button';
                        removeBtn.className = 'remove-btn';
                        removeBtn.innerHTML = '<i class="bi bi-x"></i>';
                        removeBtn.onclick = function() {
                            removeFile(index);
                        };
                        
                        previewItem.appendChild(img);
                        previewItem.appendChild(removeBtn);
                        col.appendChild(previewItem);
                        previewContainer.appendChild(col);
                    };
                    reader.readAsDataURL(file);
                });
            }
            
            // Remove file from selection
            function removeFile(index) {
                const dt = new DataTransfer();
                const files = Array.from(fileInput.files);
                files.splice(index, 1);
                
                files.forEach(file => dt.items.add(file));
                fileInput.files = dt.files;
                
                selectedFiles = Array.from(fileInput.files);
                
                if (selectedFiles.length > 0) {
                    displayPreview(selectedFiles);
                } else {
                    imagePreview.style.display = 'none';
                }
            }
            
            // Handle form submission
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                if (selectedFiles.length === 0) {
                    showMessage('Please select at least one image.', 'danger');
                    return;
                }
                
                // Validate file sizes
                const maxSize = 10 * 1024 * 1024; // 10MB
                for (let file of selectedFiles) {
                    if (file.size > maxSize) {
                        showMessage(`File "${file.name}" exceeds 10MB limit.`, 'danger');
                        return;
                    }
                }
                
                // Show progress
                progressContainer.style.display = 'block';
                progressBar.style.width = '30%';
                progressText.textContent = 'Uploading images...';
                convertBtn.disabled = true;
                messageContainer.innerHTML = '';
                
                // Create FormData
                const formData = new FormData();
                selectedFiles.forEach(file => {
                    formData.append('images[]', file);
                });
                
                try {
                    // Simulate progress
                    progressBar.style.width = '60%';
                    progressText.textContent = 'Converting to PDF...';
                    
                    const response = await fetch('{{ route("tools.jpg-to-pdf.convert") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: formData
                    });
                    
                    if (response.ok) {
                        progressBar.style.width = '100%';
                        progressText.textContent = 'Downloading PDF...';
                        
                        // Get filename from response
                        const contentDisposition = response.headers.get('Content-Disposition');
                        const filename = contentDisposition 
                            ? contentDisposition.split('filename=')[1].replace(/"/g, '')
                            : 'converted.pdf';
                        
                        // Download the PDF
                        const blob = await response.blob();
                        const url = window.URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.href = url;
                        a.download = filename;
                        document.body.appendChild(a);
                        a.click();
                        window.URL.revokeObjectURL(url);
                        document.body.removeChild(a);
                        
                        showMessage('PDF converted and downloaded successfully!', 'success');
                        
                        // Reset form
                        setTimeout(() => {
                            form.reset();
                            imagePreview.style.display = 'none';
                            progressContainer.style.display = 'none';
                            selectedFiles = [];
                        }, 2000);
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

