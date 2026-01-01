@extends('layouts.app')

@section('title', 'Free PDF Unlock Tool Online - Remove PDF Password Protection | Indsoft24')

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
            <h1 class="display-4 fw-bold mb-3">Free PDF Unlock Tool</h1>
            <p class="lead mb-4">
                Remove password protection from PDF files. Unlock your PDF documents instantly. Fast, secure, and completely free - no registration required.
            </p>
        </div>
    </section>

    <!-- Unlock Tool Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <i class="bi bi-unlock display-4 text-primary mb-3"></i>
                                <h2 class="fw-bold">Unlock PDF Files</h2>
                                <p class="text-muted">Upload your password-protected PDF and remove the password protection</p>
                            </div>

                            <!-- Upload Form -->
                            <form id="unlockForm" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <label for="pdf" class="form-label fw-semibold">Select PDF File</label>
                                    <input type="file" class="form-control" id="pdf" name="pdf" accept="application/pdf" required>
                                    <div class="form-text">Maximum file size: 50MB</div>
                                </div>

                                <div class="mb-4">
                                    <label for="password" class="form-label fw-semibold">PDF Password (if protected)</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter PDF password (optional)">
                                    <div class="form-text">If your PDF is password-protected, enter the password here. Leave blank if the PDF is not password-protected.</div>
                                </div>

                                <!-- File Info -->
                                <div id="fileInfo" class="mb-4" style="display: none;">
                                    <div class="alert alert-info">
                                        <strong>File:</strong> <span id="fileName"></span><br>
                                        <strong>Size:</strong> <span id="fileSize"></span>
                                    </div>
                                </div>

                                <!-- Progress Bar -->
                                <div id="progressContainer" class="mb-4" style="display: none;">
                                    <div class="progress" style="height: 25px;">
                                        <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%">0%</div>
                                    </div>
                                    <p class="text-center mt-2 mb-0" id="progressText">Preparing unlock process...</p>
                                </div>

                                <!-- Error/Success Messages -->
                                <div id="messageContainer" class="mb-4"></div>

                                <!-- Unlock Button -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-lg px-5" id="unlockBtn">
                                        <i class="bi bi-unlock me-2"></i>Unlock PDF
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
                        With over <strong>5+ years of experience</strong> and <strong>100+ successful projects</strong>, we have established ourselves as a trusted partner for businesses seeking cutting-edge technology solutions.
                    </p>
                    <a href="{{ route('home') }}" class="btn btn-primary">Learn More About Us</a>
                </div>
                <div class="col-lg-6">
                    <div class="p-4">
                        <h4 class="fw-bold mb-3">Our Core Services</h4>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="p-3 bg-white rounded shadow-sm h-100">
                                    <i class="bi bi-window-stack display-6 text-primary mb-2"></i>
                                    <h6 class="fw-semibold">Web Development</h6>
                                    <p class="small text-muted mb-0">Custom websites and web applications built with modern technologies.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 bg-white rounded shadow-sm h-100">
                                    <i class="bi bi-phone display-6 text-success mb-2"></i>
                                    <h6 class="fw-semibold">App Development</h6>
                                    <p class="small text-muted mb-0">Native and cross-platform mobile applications for iOS and Android.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Use Our Unlock Tool Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Why Use Our PDF Unlock Tool?</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-shield-check display-4 text-success mb-3"></i>
                        <h5 class="fw-bold">100% Secure</h5>
                        <p class="text-muted">All unlock operations are processed securely. Your PDFs are never stored on our servers and are deleted immediately after processing.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-lightning-charge display-4 text-warning mb-3"></i>
                        <h5 class="fw-bold">Fast & Efficient</h5>
                        <p class="text-muted">Unlock PDF files in seconds. Our optimized process ensures quick results without compromising file integrity.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-gift display-4 text-primary mb-3"></i>
                        <h5 class="fw-bold">Completely Free</h5>
                        <p class="text-muted">No hidden charges, no registration required. Use our unlock tool as many times as you need, absolutely free.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">How to Unlock PDF Files</h2>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="text-center">
                        <div class="step-number bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; font-size: 24px; font-weight: bold;">1</div>
                        <h5 class="fw-semibold">Upload PDF</h5>
                        <p class="text-muted small">Click the upload button and select your password-protected PDF file. Maximum file size: 50MB.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <div class="step-number bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; font-size: 24px; font-weight: bold;">2</div>
                        <h5 class="fw-semibold">Enter Password</h5>
                        <p class="text-muted small">If your PDF is password-protected, enter the password. Leave blank if the PDF is not protected.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <div class="step-number bg-warning text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; font-size: 24px; font-weight: bold;">3</div>
                        <h5 class="fw-semibold">Unlock PDF</h5>
                        <p class="text-muted small">Click the "Unlock PDF" button. Our system will process your file and remove password protection.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <div class="step-number bg-danger text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; font-size: 24px; font-weight: bold;">4</div>
                        <h5 class="fw-semibold">Download</h5>
                        <p class="text-muted small">Your unlocked PDF will be ready in seconds. Simply download it to your device.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
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
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 20% 50%, rgba(120, 119, 198, 0.3), transparent 50%),
                        radial-gradient(circle at 80% 80%, rgba(255, 119, 198, 0.3), transparent 50%),
                        radial-gradient(circle at 40% 20%, rgba(120, 219, 255, 0.3), transparent 50%);
            animation: particleMove 15s ease-in-out infinite;
        }
        
        @keyframes particleMove {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(20px, 20px); }
        }
        
        .hero-gradient-overlay {
            position: absolute;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(147, 51, 234, 0.1) 100%);
        }
        
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
        }
        
        .shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
        }
        
        .shape-1 {
            width: 200px;
            height: 200px;
            background: #3b82f6;
            top: 10%;
            left: 10%;
            animation: floatShape 15s ease-in-out infinite;
        }
        
        .shape-2 {
            width: 150px;
            height: 150px;
            background: #9333ea;
            top: 60%;
            right: 15%;
            animation: floatShape 20s ease-in-out infinite 2s;
        }
        
        .shape-3 {
            width: 100px;
            height: 100px;
            background: #10b981;
            bottom: 20%;
            left: 20%;
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
        
        .card {
            border-radius: 0;
        }
        
        .progress {
            border-radius: 0;
        }
        
        .btn {
            border-radius: 0;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('unlockForm');
            const fileInput = document.getElementById('pdf');
            const fileInfo = document.getElementById('fileInfo');
            const fileName = document.getElementById('fileName');
            const fileSize = document.getElementById('fileSize');
            const progressContainer = document.getElementById('progressContainer');
            const progressBar = document.getElementById('progressBar');
            const progressText = document.getElementById('progressText');
            const messageContainer = document.getElementById('messageContainer');
            const unlockBtn = document.getElementById('unlockBtn');
            
            // Handle file selection
            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    fileName.textContent = file.name;
                    fileSize.textContent = formatFileSize(file.size);
                    fileInfo.style.display = 'block';
                } else {
                    fileInfo.style.display = 'none';
                }
            });
            
            // Format file size
            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
            }
            
            // Handle form submission
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                const file = fileInput.files[0];
                if (!file) {
                    showMessage('Please select a PDF file.', 'danger');
                    return;
                }
                
                // Validate file size (50MB)
                const maxSize = 50 * 1024 * 1024;
                if (file.size > maxSize) {
                    showMessage('File size exceeds 50MB limit.', 'danger');
                    return;
                }
                
                // Show progress
                progressContainer.style.display = 'block';
                progressBar.style.width = '30%';
                progressText.textContent = 'Uploading PDF...';
                unlockBtn.disabled = true;
                messageContainer.innerHTML = '';
                
                // Create FormData
                const formData = new FormData();
                formData.append('pdf', file);
                const password = document.getElementById('password').value;
                if (password) {
                    formData.append('password', password);
                }
                
                try {
                    // Simulate progress
                    progressBar.style.width = '60%';
                    progressText.textContent = 'Unlocking PDF...';
                    
                    const response = await fetch('{{ route("tools.pdf-unlock.unlock") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: formData
                    });
                    
                    if (response.ok) {
                        progressBar.style.width = '100%';
                        progressText.textContent = 'Downloading unlocked PDF...';
                        
                        // Get filename from response
                        const contentDisposition = response.headers.get('Content-Disposition');
                        const filename = contentDisposition 
                            ? contentDisposition.split('filename=')[1].replace(/"/g, '')
                            : 'unlocked.pdf';
                        
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
                        
                        showMessage('PDF unlocked and downloaded successfully!', 'success');
                        
                        // Reset form
                        setTimeout(() => {
                            form.reset();
                            fileInfo.style.display = 'none';
                            progressContainer.style.display = 'none';
                        }, 2000);
                    } else {
                        const error = await response.json();
                        showMessage(error.message || 'An error occurred during unlock. Please ensure the password is correct if the PDF is protected.', 'danger');
                    }
                } catch (error) {
                    showMessage('An error occurred. Please try again.', 'danger');
                } finally {
                    unlockBtn.disabled = false;
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

