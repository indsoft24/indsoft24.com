@extends('layouts.app')

@section('title', 'Free Image Compressor Online - Compress JPEG, PNG, WEBP, GIF | Indsoft24')

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
            <h1 class="display-4 fw-bold mb-3">Free Image Compressor</h1>
            <p class="lead mb-4">
                Compress and optimize images online for free. Reduce file size while maintaining quality. Supports JPEG, JPG, PNG, WEBP, and GIF formats.
            </p>
        </div>
    </section>

    <!-- Compressor Tool Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <i class="bi bi-file-earmark-zip display-4 text-success mb-3"></i>
                                <h2 class="fw-bold">Compress Images</h2>
                                <p class="text-muted">Upload your image and compress it to reduce file size</p>
                            </div>

                            <!-- Upload Form -->
                            <form id="compressForm" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <label for="image" class="form-label fw-semibold">Select Image File</label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/jpeg,image/jpg,image/png,image/webp,image/gif" required>
                                    <div class="form-text">Supported formats: JPEG, JPG, PNG, WEBP, GIF. Maximum file size: 10MB.</div>
                                </div>

                                <!-- Compression Settings -->
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label for="quality" class="form-label fw-semibold">Quality <span id="qualityValue" class="badge bg-primary">85</span>%</label>
                                        <input type="range" class="form-range" id="quality" name="quality" min="10" max="100" value="85" oninput="document.getElementById('qualityValue').textContent = this.value">
                                        <div class="form-text">Lower quality = smaller file size</div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="max_width" class="form-label fw-semibold">Max Width (px)</label>
                                        <input type="number" class="form-control" id="max_width" name="max_width" value="2000" min="100" max="5000">
                                        <div class="form-text">Maximum image width in pixels</div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="max_height" class="form-label fw-semibold">Max Height (px)</label>
                                        <input type="number" class="form-control" id="max_height" name="max_height" value="2000" min="100" max="5000">
                                        <div class="form-text">Maximum image height in pixels</div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-check mt-4 pt-3">
                                            <input class="form-check-input" type="checkbox" id="preserve_format" name="preserve_format" value="1">
                                            <label class="form-check-label" for="preserve_format">
                                                Preserve Original Format
                                            </label>
                                        </div>
                                        <div class="form-text">If unchecked, images will be converted to JPEG for better compression</div>
                                    </div>
                                </div>

                                <!-- Preview Area -->
                                <div id="imagePreview" class="mb-4" style="display: none;">
                                    <h5 class="fw-semibold mb-3">Image Preview:</h5>
                                    <div class="text-center">
                                        <img id="previewImg" src="" alt="Preview" class="img-fluid rounded shadow-sm" style="max-height: 300px;">
                                    </div>
                                    <div class="alert alert-info mt-3">
                                        <i class="bi bi-info-circle me-2"></i>
                                        <span id="imageInfo">Image loaded successfully</span>
                                    </div>
                                </div>

                                <!-- Progress Bar -->
                                <div id="progressContainer" class="mb-4" style="display: none;">
                                    <div class="progress" style="height: 25px;">
                                        <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%">0%</div>
                                    </div>
                                    <p class="text-center mt-2 mb-0" id="progressText">Compressing image...</p>
                                </div>

                                <!-- Error/Success Messages -->
                                <div id="messageContainer" class="mb-4"></div>

                                <!-- Compress/Download Button -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success btn-lg px-5" id="compressBtn">
                                        <i class="bi bi-file-earmark-zip me-2"></i>Compress Image
                                    </button>
                                    <button type="button" class="btn btn-primary btn-lg px-5" id="downloadBtn" style="display: none;">
                                        <i class="bi bi-download me-2"></i>Download Compressed Image
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">How to Compress Images</h2>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="text-center">
                        <div class="step-number bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; font-size: 24px; font-weight: bold;">1</div>
                        <h5 class="fw-semibold">Upload Image</h5>
                        <p class="text-muted small">Select your image file from your device. All common formats are supported.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <div class="step-number bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; font-size: 24px; font-weight: bold;">2</div>
                        <h5 class="fw-semibold">Adjust Settings</h5>
                        <p class="text-muted small">Choose quality level and maximum dimensions to optimize compression.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <div class="step-number bg-warning text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; font-size: 24px; font-weight: bold;">3</div>
                        <h5 class="fw-semibold">Compress</h5>
                        <p class="text-muted small">Click compress and wait a few seconds for processing.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <div class="step-number bg-danger text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; font-size: 24px; font-weight: bold;">4</div>
                        <h5 class="fw-semibold">Download</h5>
                        <p class="text-muted small">Download your compressed image with reduced file size.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Why Compress Images?</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-speedometer2 display-4 text-success mb-3"></i>
                        <h5 class="fw-bold">Faster Loading</h5>
                        <p class="text-muted">Compressed images load faster on websites and applications, improving user experience.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-cloud-upload display-4 text-primary mb-3"></i>
                        <h5 class="fw-bold">Save Bandwidth</h5>
                        <p class="text-muted">Reduce bandwidth usage and storage costs with smaller image files.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-envelope-check display-4 text-warning mb-3"></i>
                        <h5 class="fw-bold">Easy Sharing</h5>
                        <p class="text-muted">Smaller files are easier to share via email or messaging apps.</p>
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
            background: linear-gradient(135deg, #28a745 0%, #20c997 25%, #17a2b8 50%, #007bff 75%, #6610f2 100%);
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
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('compressForm');
            const fileInput = document.getElementById('image');
            const imagePreview = document.getElementById('imagePreview');
            const previewImg = document.getElementById('previewImg');
            const imageInfo = document.getElementById('imageInfo');
            const progressContainer = document.getElementById('progressContainer');
            const progressBar = document.getElementById('progressBar');
            const progressText = document.getElementById('progressText');
            const messageContainer = document.getElementById('messageContainer');
            const compressBtn = document.getElementById('compressBtn');
            const downloadBtn = document.getElementById('downloadBtn');
            
            let compressedImageBlob = null;
            let compressedFilename = 'compressed_image.jpg';
            
            // Handle file selection
            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        imagePreview.style.display = 'block';
                        
                        // Get file size
                        const fileSize = (file.size / 1024).toFixed(2);
                        const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
                        imageInfo.textContent = `File: ${file.name} | Size: ${fileSize} KB (${fileSizeMB} MB)`;
                        
                        // Reset to compress mode
                        resetToCompressMode();
                    };
                    reader.readAsDataURL(file);
                } else {
                    imagePreview.style.display = 'none';
                }
            });
            
            // Function to switch to compress mode
            function resetToCompressMode() {
                compressBtn.style.display = 'inline-block';
                downloadBtn.style.display = 'none';
                compressedImageBlob = null;
                compressedFilename = 'compressed_image.jpg';
            }
            
            // Handle download button click
            downloadBtn.addEventListener('click', function() {
                if (compressedImageBlob) {
                    const url = window.URL.createObjectURL(compressedImageBlob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = compressedFilename;
                    document.body.appendChild(a);
                    a.click();
                    window.URL.revokeObjectURL(url);
                    document.body.removeChild(a);
                }
            });
            
            // Handle form submission
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                const file = fileInput.files[0];
                if (!file) {
                    showMessage('Please select an image file.', 'danger');
                    return;
                }
                
                // Validate file size
                const maxSize = 10 * 1024 * 1024; // 10MB
                if (file.size > maxSize) {
                    showMessage('File size exceeds 10MB limit.', 'danger');
                    return;
                }
                
                // Show progress
                progressContainer.style.display = 'block';
                progressBar.style.width = '30%';
                progressText.textContent = 'Compressing image...';
                compressBtn.disabled = true;
                messageContainer.innerHTML = '';
                
                // Create FormData
                const formData = new FormData();
                formData.append('image', file);
                formData.append('quality', document.getElementById('quality').value);
                formData.append('max_width', document.getElementById('max_width').value);
                formData.append('max_height', document.getElementById('max_height').value);
                formData.append('preserve_format', document.getElementById('preserve_format').checked ? '1' : '0');
                
                try {
                    progressBar.style.width = '60%';
                    progressText.textContent = 'Uploading and compressing...';
                    
                    const response = await fetch('{{ route("tools.image-compress.compress") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: formData
                    });
                    
                    if (response.ok) {
                        progressBar.style.width = '100%';
                        progressText.textContent = 'Compression complete!';
                        
                        // Get filename from response
                        const contentDisposition = response.headers.get('Content-Disposition');
                        compressedFilename = contentDisposition 
                            ? contentDisposition.split('filename=')[1].replace(/"/g, '')
                            : 'compressed_image.jpg';
                        
                        // Store compressed image blob for download
                        compressedImageBlob = await response.blob();
                        
                        // Get compression stats
                        const originalSize = response.headers.get('X-Original-Size');
                        const compressedSize = response.headers.get('X-Compressed-Size');
                        const compressionRatio = response.headers.get('X-Compression-Ratio');
                        
                        // Hide compress button and show download button
                        compressBtn.style.display = 'none';
                        downloadBtn.style.display = 'inline-block';
                        
                        const originalSizeKB = (originalSize / 1024).toFixed(2);
                        const compressedSizeKB = (compressedSize / 1024).toFixed(2);
                        const savedKB = ((originalSize - compressedSize) / 1024).toFixed(2);
                        
                        showMessage(`Image compressed successfully! Original: ${originalSizeKB} KB → Compressed: ${compressedSizeKB} KB (${compressionRatio}% reduction, saved ${savedKB} KB). Click download to save.`, 'success');
                        
                        // Hide progress after a short delay
                        setTimeout(() => {
                            progressContainer.style.display = 'none';
                            progressBar.style.width = '0%';
                        }, 1500);
                    } else {
                        if (response.status === 413) {
                            showMessage('File size is too large. Please try with a smaller image.', 'danger');
                        } else {
                            try {
                                const error = await response.json();
                                showMessage(error.message || 'An error occurred during compression.', 'danger');
                            } catch (parseError) {
                                showMessage('An error occurred during compression. Please try again.', 'danger');
                            }
                        }
                        resetToCompressMode();
                    }
                } catch (error) {
                    console.error('Compression error:', error);
                    showMessage('An error occurred. Please try again.', 'danger');
                    resetToCompressMode();
                } finally {
                    compressBtn.disabled = false;
                    if (!compressedImageBlob) {
                        progressContainer.style.display = 'none';
                        progressBar.style.width = '0%';
                    }
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

