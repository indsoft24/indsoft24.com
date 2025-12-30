@extends('layouts.app')

@section('title', 'Free Image Format Converter - Convert JPEG, PNG, WEBP Online | Indsoft24')

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
            <h1 class="display-4 fw-bold mb-3">Image Format Converter - JPEG, PNG, WEBP</h1>
            <p class="lead mb-4">
                Convert images between JPEG, JPG, PNG, and WEBP formats instantly. High-quality conversion with customizable compression settings. Free, fast, and secure.
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
                                <i class="bi bi-image display-4 text-info mb-3"></i>
                                <h2 class="fw-bold">Convert Image Formats</h2>
                                <p class="text-muted">Upload your image and convert it to your preferred format with quality control</p>
                            </div>

                            <!-- Upload Form -->
                            <form id="convertForm" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="image" class="form-label fw-semibold">Select Image File</label>
                                        <input type="file" class="form-control" id="image" name="image" accept="image/jpeg,image/jpg,image/png,image/webp" required>
                                        <div class="form-text">Supported formats: JPEG, JPG, PNG, WEBP. Maximum file size: 10MB.</div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="format" class="form-label fw-semibold">Convert To</label>
                                        <select class="form-select" id="format" name="format" required>
                                            <option value="jpeg">JPEG / JPG</option>
                                            <option value="png">PNG</option>
                                            <option value="webp">WEBP</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="quality" class="form-label fw-semibold">Image Quality</label>
                                        <input type="range" class="form-range" id="quality" name="quality" min="1" max="100" value="90" oninput="document.getElementById('qualityValue').textContent = this.value">
                                        <div class="form-text text-center">
                                            <span id="qualityValue">90</span>% Quality
                                        </div>
                                    </div>
                                </div>

                                <!-- Preview Area -->
                                <div id="imagePreview" class="mb-4 mt-4" style="display: none;">
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
                                    <p class="text-center mt-2 mb-0" id="progressText">Preparing conversion...</p>
                                </div>

                                <!-- Error/Success Messages -->
                                <div id="messageContainer" class="mb-4"></div>

                                <!-- Convert Button -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-info btn-lg px-5" id="convertBtn">
                                        <i class="bi bi-arrow-repeat me-2"></i>Convert Image Format
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Convert Image Formats Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-4">Why Convert Image Formats?</h2>
                    <p class="lead text-muted mb-4">
                        Different image formats serve different purposes. Converting between formats helps optimize file sizes, improve website performance, and ensure compatibility across platforms and applications.
                    </p>
                    <div class="mb-4">
                        <h5 class="fw-semibold mb-3"><i class="bi bi-speedometer2 text-info me-2"></i>Optimize File Sizes</h5>
                        <p class="text-muted">Convert to WEBP for up to 30% smaller file sizes compared to JPEG, improving website loading speeds and reducing bandwidth usage.</p>
                    </div>
                    <div class="mb-4">
                        <h5 class="fw-semibold mb-3"><i class="bi bi-shield-check text-success me-2"></i>Maintain Quality</h5>
                        <p class="text-muted">Preserve image quality while reducing file size. Our converter maintains high-quality output with customizable compression settings.</p>
                    </div>
                    <div class="mb-4">
                        <h5 class="fw-semibold mb-3"><i class="bi bi-check-circle text-primary me-2"></i>Universal Compatibility</h5>
                        <p class="text-muted">Convert images to formats compatible with your specific needs - JPEG for photos, PNG for transparency, WEBP for modern web optimization.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-4 bg-white rounded shadow-sm">
                        <h4 class="fw-bold mb-3">Supported Formats</h4>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="p-3 border rounded h-100">
                                    <i class="bi bi-file-earmark-image display-6 text-warning mb-2"></i>
                                    <h6 class="fw-semibold">JPEG / JPG</h6>
                                    <p class="small text-muted mb-0">Best for photographs. Lossy compression with adjustable quality. Widely supported.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 border rounded h-100">
                                    <i class="bi bi-image display-6 text-primary mb-2"></i>
                                    <h6 class="fw-semibold">PNG</h6>
                                    <p class="small text-muted mb-0">Lossless compression. Supports transparency. Perfect for graphics and logos.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 border rounded h-100">
                                    <i class="bi bi-filetype-webp display-6 text-success mb-2"></i>
                                    <h6 class="fw-semibold">WEBP</h6>
                                    <p class="small text-muted mb-0">Modern format with superior compression. 25-35% smaller than JPEG at same quality.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 border rounded h-100">
                                    <i class="bi bi-arrows-angle-contract display-6 text-danger mb-2"></i>
                                    <h6 class="fw-semibold">Quality Control</h6>
                                    <p class="small text-muted mb-0">Adjustable quality from 1% to 100% to balance file size and image clarity.</p>
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
            <h2 class="text-center fw-bold mb-5">Key Benefits of Our Image Format Converter</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-lightning-charge display-4 text-warning mb-3"></i>
                        <h5 class="fw-bold">Instant Conversion</h5>
                        <p class="text-muted">Convert images in seconds. Our optimized processing engine handles conversions quickly and efficiently.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-hd display-4 text-info mb-3"></i>
                        <h5 class="fw-bold">High Quality Output</h5>
                        <p class="text-muted">Maintain image quality during conversion. Advanced algorithms preserve visual fidelity while optimizing file size.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-shield-lock display-4 text-success mb-3"></i>
                        <h5 class="fw-bold">100% Secure</h5>
                        <p class="text-muted">Your images are processed securely and automatically deleted after conversion. No data is stored or shared.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-sliders display-4 text-primary mb-3"></i>
                        <h5 class="fw-bold">Customizable Quality</h5>
                        <p class="text-muted">Fine-tune image quality from 1% to 100% to achieve the perfect balance between file size and visual quality.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-arrow-left-right display-4 text-danger mb-3"></i>
                        <h5 class="fw-bold">Bidirectional Conversion</h5>
                        <p class="text-muted">Convert between any supported formats - JPEG to PNG, PNG to WEBP, WEBP to JPEG, and more.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-gift display-4 text-secondary mb-3"></i>
                        <h5 class="fw-bold">Completely Free</h5>
                        <p class="text-muted">No hidden charges, no registration required. Use our converter as many times as you need, absolutely free.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Use Cases Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Common Use Cases for Image Format Conversion</h2>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="bi bi-globe display-6 text-primary"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="fw-semibold">Web Development</h5>
                            <p class="text-muted mb-0">Convert images to WEBP format for faster website loading, improved SEO rankings, and better user experience.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="bi bi-phone display-6 text-success"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="fw-semibold">Mobile App Development</h5>
                            <p class="text-muted mb-0">Optimize images for mobile applications by converting to appropriate formats that reduce app size and improve performance.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="bi bi-palette display-6 text-warning"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="fw-semibold">Graphic Design</h5>
                            <p class="text-muted mb-0">Convert between formats for different design requirements - PNG for transparency, JPEG for photos, WEBP for web graphics.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="bi bi-envelope-paper display-6 text-info"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="fw-semibold">Email Marketing</h5>
                            <p class="text-muted mb-0">Reduce email attachment sizes by converting images to optimized formats, ensuring faster email delivery.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="bi bi-cloud-upload display-6 text-danger"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="fw-semibold">Cloud Storage</h5>
                            <p class="text-muted mb-0">Optimize images before uploading to cloud storage services to save space and reduce upload times.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="bi bi-printer display-6 text-secondary"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="fw-semibold">Print & Publishing</h5>
                            <p class="text-muted mb-0">Convert images to print-ready formats with appropriate quality settings for professional publications.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Format Comparison Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Image Format Comparison Guide</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-file-earmark-image display-4 text-warning mb-3"></i>
                            <h5 class="fw-bold">JPEG / JPG</h5>
                            <ul class="list-unstyled text-start mt-3">
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Best for photographs</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Lossy compression</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Smaller file sizes</li>
                                <li class="mb-2"><i class="bi bi-x-circle text-danger me-2"></i>No transparency support</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Universal compatibility</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-image display-4 text-primary mb-3"></i>
                            <h5 class="fw-bold">PNG</h5>
                            <ul class="list-unstyled text-start mt-3">
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Lossless compression</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Transparency support</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Perfect for graphics</li>
                                <li class="mb-2"><i class="bi bi-x-circle text-danger me-2"></i>Larger file sizes</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Widely supported</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-filetype-webp display-4 text-success mb-3"></i>
                            <h5 class="fw-bold">WEBP</h5>
                            <ul class="list-unstyled text-start mt-3">
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Superior compression</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>25-35% smaller than JPEG</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Transparency support</li>
                                <li class="mb-2"><i class="bi bi-x-circle text-danger me-2"></i>Limited browser support (older browsers)</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Ideal for modern web</li>
                            </ul>
                        </div>
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
                    <h2 class="fw-bold mb-4">Professional Image Format Conversion Services</h2>
                    <div class="content-section">
                        <p class="lead text-muted mb-4">
                            Our free image format converter is designed for web developers, graphic designers, content creators, and businesses who need to optimize images for different platforms and use cases. Whether you're converting JPEG to PNG for transparency, PNG to WEBP for web optimization, or WEBP to JPEG for compatibility, our tool delivers high-quality results instantly.
                        </p>
                        
                        <h3 class="fw-bold mt-4 mb-3">Best Practices for Image Format Conversion</h3>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i><strong>Choose the Right Format:</strong> Use JPEG for photographs, PNG for graphics with transparency, and WEBP for modern web optimization with smaller file sizes.</li>
                            <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i><strong>Quality Settings:</strong> For web use, 80-90% quality provides excellent balance. For print, use 95-100% quality. For maximum compression, 60-75% is often sufficient.</li>
                            <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i><strong>File Size Optimization:</strong> Convert to WEBP format to reduce file sizes by 25-35% compared to JPEG while maintaining similar visual quality.</li>
                            <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i><strong>Transparency Needs:</strong> Use PNG format when you need transparent backgrounds. PNG supports full alpha channel transparency.</li>
                        </ul>

                        <h3 class="fw-bold mt-4 mb-3">Technical Specifications</h3>
                        <p class="text-muted mb-3">
                            Our image format converter supports all major image formats and provides:
                        </p>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-file-earmark-image text-warning me-2"></i><strong>JPEG/JPG:</strong> Quality range 1-100%, lossy compression, ideal for photographs, maximum file size 10MB</li>
                            <li class="mb-2"><i class="bi bi-image text-primary me-2"></i><strong>PNG:</strong> Lossless compression, supports transparency, perfect for graphics and logos, quality range 1-100%</li>
                            <li class="mb-2"><i class="bi bi-filetype-webp text-success me-2"></i><strong>WEBP:</strong> Modern format with superior compression, 25-35% smaller than JPEG, supports transparency, quality range 1-100%</li>
                        </ul>

                        <h3 class="fw-bold mt-4 mb-3">About Indsoft24 - Your Technology Partner</h3>
                        <p class="text-muted mb-3">
                            Indsoft24 is a leading software development company based in Noida, India, specializing in creating innovative digital solutions. With over <strong>5+ years of experience</strong> and <strong>100+ successful projects</strong>, we provide cutting-edge technology services including:
                        </p>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-window-stack text-primary me-2"></i><strong>Web Development:</strong> Custom websites and web applications built with modern technologies like Laravel, React, and Vue.js</li>
                            <li class="mb-2"><i class="bi bi-phone text-success me-2"></i><strong>Mobile App Development:</strong> Native and cross-platform mobile applications for iOS and Android using Flutter and React Native</li>
                            <li class="mb-2"><i class="bi bi-code-slash text-warning me-2"></i><strong>Custom Software Development:</strong> Tailored software solutions including ERP, CRM, and SaaS applications</li>
                            <li class="mb-2"><i class="bi bi-search text-info me-2"></i><strong>SEO Services:</strong> Comprehensive SEO optimization to improve search engine rankings and drive organic traffic</li>
                        </ul>
                        <p class="text-muted mb-4">
                            Our team of expert developers and designers is committed to delivering high-quality solutions that drive business growth. We combine technical excellence with creative innovation to help businesses transform their digital presence and achieve their goals.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">How to Convert Image Formats - Simple Steps</h2>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="text-center">
                        <div class="step-number bg-info text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; font-size: 24px; font-weight: bold;">1</div>
                        <h5 class="fw-semibold">Upload Image</h5>
                        <p class="text-muted small">Select your image file (JPEG, PNG, or WEBP) from your device. Maximum file size: 10MB.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <div class="step-number bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; font-size: 24px; font-weight: bold;">2</div>
                        <h5 class="fw-semibold">Choose Format</h5>
                        <p class="text-muted small">Select your desired output format: JPEG for photos, PNG for transparency, or WEBP for optimization.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <div class="step-number bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; font-size: 24px; font-weight: bold;">3</div>
                        <h5 class="fw-semibold">Set Quality</h5>
                        <p class="text-muted small">Adjust image quality from 1% to 100% to balance file size and visual quality according to your needs.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <div class="step-number bg-warning text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; font-size: 24px; font-weight: bold;">4</div>
                        <h5 class="fw-semibold">Download Result</h5>
                        <p class="text-muted small">Get your converted image instantly. Download the file in your chosen format with optimized quality.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-5 bg-light">
        <div class="container text-center">
            <h2 class="fw-bold mb-3">Need Custom Software Development Services?</h2>
            <p class="lead text-muted mb-4">
                At Indsoft24, we specialize in building custom software solutions, web applications, and mobile apps tailored to your business needs. 
                Let's discuss how we can help transform your ideas into reality.
            </p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:pointer" class="btn btn-info btn-lg">
                    <i class="bi bi-chat-dots me-2"></i>Get Free Consultation
                </a>
                <a href="{{ route('services.index') }}" class="btn btn-outline-info btn-lg">
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
            background: linear-gradient(135deg, #0dcaf0 0%, #0aa2c0 25%, #087990 50%, #065e73 75%, #044255 100%);
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
            const fileInput = document.getElementById('image');
            const imagePreview = document.getElementById('imagePreview');
            const previewImg = document.getElementById('previewImg');
            const imageInfo = document.getElementById('imageInfo');
            const progressContainer = document.getElementById('progressContainer');
            const progressBar = document.getElementById('progressBar');
            const progressText = document.getElementById('progressText');
            const messageContainer = document.getElementById('messageContainer');
            const convertBtn = document.getElementById('convertBtn');
            
            // Handle file selection
            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    if (!file.type.match('image.*')) {
                        showMessage('Please select a valid image file.', 'danger');
                        fileInput.value = '';
                        imagePreview.style.display = 'none';
                        return;
                    }
                    
                    if (file.size > 10 * 1024 * 1024) {
                        showMessage('Image file size must not exceed 10MB.', 'danger');
                        fileInput.value = '';
                        imagePreview.style.display = 'none';
                        return;
                    }
                    
                    // Show preview
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        imageInfo.textContent = `Image loaded: ${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)`;
                        imagePreview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    imagePreview.style.display = 'none';
                }
            });
            
            // Handle form submission
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                if (!fileInput.files || fileInput.files.length === 0) {
                    showMessage('Please select an image file.', 'danger');
                    return;
                }
                
                // Show progress
                progressContainer.style.display = 'block';
                progressBar.style.width = '30%';
                progressText.textContent = 'Uploading image...';
                convertBtn.disabled = true;
                messageContainer.innerHTML = '';
                
                // Create FormData
                const formData = new FormData();
                formData.append('image', fileInput.files[0]);
                formData.append('format', document.getElementById('format').value);
                formData.append('quality', document.getElementById('quality').value);
                
                try {
                    // Simulate progress
                    progressBar.style.width = '60%';
                    progressText.textContent = 'Converting image format...';
                    
                    const response = await fetch('{{ route("tools.image-converter.convert") }}', {
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
                            : 'converted.' + document.getElementById('format').value;
                        
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
                        
                        showMessage('Image converted successfully! Your file is downloading.', 'success');
                        
                        // Reset form after delay
                        setTimeout(() => {
                            form.reset();
                            imagePreview.style.display = 'none';
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

