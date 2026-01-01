@extends('layouts.app')

@section('title', 'Free DOC to PDF Converter Online - Convert Word to PDF | Indsoft24')

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
            <h1 class="display-4 fw-bold mb-3">Free DOC to PDF Converter</h1>
            <p class="lead mb-4">
                Convert Word documents (DOC, DOCX) to PDF online. Fast, secure, and easy-to-use document converter. Completely free - no registration required.
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
                                <i class="bi bi-file-earmark-word display-4 text-primary mb-3"></i>
                                <h2 class="fw-bold">Convert DOC/DOCX to PDF</h2>
                                <p class="text-muted">Upload your Word document and convert it to PDF format</p>
                            </div>

                            @if(!$isAvailable)
                            <!-- Coming Soon Message -->
                            <div class="alert alert-warning text-center" role="alert">
                                <i class="bi bi-clock-history display-6 mb-3 d-block"></i>
                                <h4 class="alert-heading">Coming Soon!</h4>
                                <p class="mb-2">DOC to PDF conversion feature is currently being set up on the server.</p>
                                <p class="mb-0">
                                    <strong>Status:</strong> 
                                    @if(!$isLibreOfficeAvailable && !$isPandocAvailable)
                                        LibreOffice and Pandoc are not installed. Please contact your hosting provider to install LibreOffice (recommended) for document conversion.
                                    @elseif(!$isLibreOfficeAvailable)
                                        LibreOffice is not installed. Pandoc is available but may have limitations. Please contact your hosting provider to install LibreOffice for best results.
                                    @endif
                                </p>
                                <hr>
                                <p class="mb-0 small">
                                    <strong>Installation Required:</strong> The server needs LibreOffice installed to enable DOC/DOCX to PDF conversion. 
                                    Contact your hosting provider with the installation guide in <code>SERVER_INSTALLATION.md</code>
                                </p>
                            </div>
                            @endif

                            <!-- Upload Form -->
                            <form id="convertForm" enctype="multipart/form-data" @if(!$isAvailable) style="opacity: 0.5; pointer-events: none;" @endif>
                                @csrf
                                <div class="mb-4">
                                    <label for="doc" class="form-label fw-semibold">Select Word Document</label>
                                    <input type="file" class="form-control" id="doc" name="doc" accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" required>
                                    <div class="form-text">Supported formats: DOC, DOCX. Maximum file size: 100MB</div>
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
                                    <p class="text-center mt-2 mb-0" id="progressText">Preparing conversion...</p>
                                </div>

                                <!-- Error/Success Messages -->
                                <div id="messageContainer" class="mb-4"></div>

                                <!-- Convert Button -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-lg px-5" id="convertBtn" @if(!$isAvailable) disabled @endif>
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
                    <h2 class="fw-bold mb-4">Why Use Our DOC to PDF Converter?</h2>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            <strong>100% Free:</strong> Convert unlimited documents without any cost
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            <strong>Secure:</strong> All files are processed securely and deleted after conversion
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            <strong>Fast:</strong> Quick conversion process with high-quality output
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            <strong>No Registration:</strong> Start converting immediately without creating an account
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            <strong>Privacy:</strong> Your documents are never stored or shared
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <h3 class="fw-bold mb-4">How to Convert DOC to PDF</h3>
                    <ol>
                        <li class="mb-2">Click "Select Word Document" and choose your DOC or DOCX file</li>
                        <li class="mb-2">Wait for the file to upload (up to 100MB)</li>
                        <li class="mb-2">Click "Convert to PDF" button</li>
                        <li class="mb-2">Wait for the conversion process to complete</li>
                        <li class="mb-2">Download your converted PDF file</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="text-center">
                        <i class="bi bi-shield-check display-4 text-primary mb-3"></i>
                        <h4 class="fw-bold">Secure Conversion</h4>
                        <p class="text-muted">Your documents are processed securely and automatically deleted after conversion.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="text-center">
                        <i class="bi bi-lightning-charge display-4 text-primary mb-3"></i>
                        <h4 class="fw-bold">Fast Processing</h4>
                        <p class="text-muted">Quick conversion with high-quality PDF output preserving your document formatting.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="text-center">
                        <i class="bi bi-infinity display-4 text-primary mb-3"></i>
                        <h4 class="fw-bold">Unlimited Conversions</h4>
                        <p class="text-muted">Convert as many documents as you need without any limits or restrictions.</p>
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
            const form = document.getElementById('convertForm');
            const fileInput = document.getElementById('doc');
            const fileInfo = document.getElementById('fileInfo');
            const fileName = document.getElementById('fileName');
            const fileSize = document.getElementById('fileSize');
            const progressContainer = document.getElementById('progressContainer');
            const progressBar = document.getElementById('progressBar');
            const progressText = document.getElementById('progressText');
            const messageContainer = document.getElementById('messageContainer');
            const convertBtn = document.getElementById('convertBtn');
            
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
                    showMessage('Please select a Word document.', 'danger');
                    return;
                }
                
                // Validate file type
                const allowedTypes = ['application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                const allowedExtensions = ['.doc', '.docx'];
                const fileExtension = '.' + file.name.split('.').pop().toLowerCase();
                
                if (!allowedTypes.includes(file.type) && !allowedExtensions.includes(fileExtension)) {
                    showMessage('Please select a valid DOC or DOCX file.', 'danger');
                    return;
                }
                
                // Validate file size (100MB)
                const maxSize = 100 * 1024 * 1024;
                if (file.size > maxSize) {
                    showMessage('File size exceeds 100MB limit.', 'danger');
                    return;
                }
                
                // Show progress
                progressContainer.style.display = 'block';
                progressBar.style.width = '30%';
                progressText.textContent = 'Uploading document...';
                convertBtn.disabled = true;
                messageContainer.innerHTML = '';
                
                // Create FormData
                const formData = new FormData();
                formData.append('doc', file);
                
                try {
                    // Simulate progress
                    progressBar.style.width = '60%';
                    progressText.textContent = 'Converting to PDF...';
                    
                    const response = await fetch('{{ route("tools.doc-to-pdf.convert") }}', {
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
                        
                        showMessage('Document converted and downloaded successfully!', 'success');
                        
                        // Reset form
                        setTimeout(() => {
                            form.reset();
                            fileInfo.style.display = 'none';
                            progressContainer.style.display = 'none';
                        }, 2000);
                    } else {
                        const errorData = await response.json();
                        let errorMessage = errorData.message || 'An error occurred during conversion. Please try again.';
                        
                        // Show detailed validation errors if available
                        if (errorData.errors && typeof errorData.errors === 'object') {
                            const errorMessages = [];
                            for (const key in errorData.errors) {
                                if (errorData.errors[key]) {
                                    errorMessages.push(...errorData.errors[key]);
                                }
                            }
                            if (errorMessages.length > 0) {
                                errorMessage = errorMessages.join('<br>');
                            }
                        }
                        
                        showMessage(errorMessage, 'danger');
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

