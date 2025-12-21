@extends('layouts.app')

@section('title', 'Custom Software Development Services & Pricing in India | IndSoft24')
@section('meta_description', 'Bespoke software development pricing in India. IndSoft24 builds custom ERP, CRM, and SaaS solutions to solve unique business challenges and improve efficiency.')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">

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
                <div class="shape shape-4"></div>
                <div class="shape shape-5"></div>
                <div class="shape shape-6"></div>
            </div>
            <!-- Animated grid pattern -->
            <div class="animated-grid"></div>
        </div>
        <div class="container text-center" style="position: relative; z-index: 3;">
            <h1 class="display-4 fw-bold mb-3">Custom Software Development Services</h1>
            <p class="lead mb-4">
                We build scalable, secure, and tailor-made software solutions that solve your unique business challenges.
            </p>
            <a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:pointer"
                class="btn btn-warning btn-lg">Get a Free Software Consultation</a>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Our Software Development Expertise</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100 text-center p-3">
                        <i class="bi bi-briefcase-fill display-4 text-primary mb-3"></i>
                        <h5 class="fw-bold">Enterprise Software Solutions</h5>
                        <p class="text-muted">Custom CRM, ERP, and internal tools designed to streamline your operations and boost productivity.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100 text-center p-3">
                        <i class="bi bi-cloud-arrow-up-fill display-4 text-success mb-3"></i>
                        <h5 class="fw-bold">SaaS Product Development</h5>
                        <p class="text-muted">Turn your vision into a market-ready Software-as-a-Service product with our end-to-end development expertise.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100 text-center p-3">
                        <i class="bi bi-plug-fill display-4 text-warning mb-3"></i>
                        <h5 class="fw-bold">API Development & Integration</h5>
                        <p class="text-muted">Secure, robust, and scalable APIs that connect your software ecosystem and enable seamless data exchange.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pricing-section bg-light py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Our Pricing Models</h2>
            <p class="text-center text-muted mb-5">
                Custom software requires a flexible approach. We offer models that provide clarity and value.
            </p>
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="pricing-card text-center h-100">
                        <div class="icon-box"><i class="bi bi-file-earmark-check"></i></div>
                        <h5 class="fw-bold mt-3">Fixed Price Project</h5>
                        <p class="text-muted">For well-defined projects</p>
                        <div class="price-tag">Starts at<br><span class="currency">₹</span>5,00,000+</div>
                        <ul class="list-unstyled mt-3">
                            <li>✔ Clearly Defined Scope</li>
                            <li>✔ Fixed Timeline & Budget</li>
                            <li>✔ Milestone-based Payments</li>
                            <li>✔ Ideal for MVPs</li>
                        </ul>
                        <a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:pointer" class="btn btn-outline-primary mt-3">Discuss Your Project</a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="pricing-card text-center h-100 featured">
                        <div class="icon-box"><i class="bi bi-clock-history"></i></div>
                        <h5 class="fw-bold mt-3">Time & Materials</h5>
                        <p class="text-muted">For complex & evolving projects</p>
                        <div class="price-tag highlight"><span class="currency">₹</span>2,500 – 4,000<br><small>/hour</small></div>
                        <ul class="list-unstyled mt-3">
                            <li>✔ Flexible Scope & Features</li>
                            <li>✔ Agile Development Sprints</li>
                            <li>✔ Pay for Hours Worked</li>
                            <li>✔ Maximum Transparency</li>
                        </ul>
                        <a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:pointer" class="btn btn-primary mt-3">Most Flexible</a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="pricing-card text-center h-100">
                        <div class="icon-box"><i class="bi bi-people-fill"></i></div>
                        <h5 class="fw-bold mt-3">Dedicated Team</h5>
                        <p class="text-muted">For long-term partnership</p>
                        <div class="price-tag">Custom Quote<br><small>Monthly Retainer</small></div>
                        <ul class="list-unstyled mt-3">
                            <li>✔ An Extension of Your Team</li>
                            <li>✔ Full-time Developers</li>
                            <li>✔ Complete Control Over Process</li>
                            <li>✔ Long-term Collaboration</li>
                        </ul>
                        <a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:pointer" class="btn btn-outline-danger mt-3">Hire a Team</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">💡 Factors Affecting Software Cost</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-4 border rounded shadow-sm h-100 text-center hover-shadow">
                        <i class="bi bi-puzzle text-primary display-5 mb-3"></i>
                        <h5 class="fw-bold">Project Complexity</h5>
                        <p class="small text-muted">The number of features, integrations, and complexity of business logic.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 border rounded shadow-sm h-100 text-center hover-shadow">
                        <i class="bi bi-code-braces text-success display-5 mb-3"></i>
                        <h5 class="fw-bold">Technology Stack</h5>
                        <p class="small text-muted">The choice of programming languages, frameworks, and databases.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 border rounded shadow-sm h-100 text-center hover-shadow">
                        <i class="bi bi-people text-danger display-5 mb-3"></i>
                        <h5 class="fw-bold">Team Composition</h5>
                        <p class="small text-muted">The size and experience level of the development, QA, and project management team.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 border rounded shadow-sm h-100 text-center hover-shadow">
                        <i class="bi bi-tools text-warning display-5 mb-3"></i>
                        <h5 class="fw-bold">Support & Maintenance</h5>
                        <p class="small text-muted">Ongoing costs for updates, bug fixes, and server management post-launch.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Technologies We Use</h2>
            <div class="row g-4 justify-content-center text-center">
                @php
                    $technologies = [
                        ['name' => 'Laravel', 'icon' => 'devicon-laravel-plain colored'],
                        ['name' => 'Node.js', 'icon' => 'devicon-nodejs-plain colored'],
                        ['name' => 'Python', 'icon' => 'devicon-python-plain colored'],
                        ['name' => 'Java', 'icon' => 'devicon-java-plain colored'],
                        ['name' => 'React.js', 'icon' => 'devicon-react-original colored'],
                        ['name' => 'Vue.js', 'icon' => 'devicon-vuejs-plain colored'],
                        ['name' => 'MySQL', 'icon' => 'devicon-mysql-plain colored'],
                        ['name' => 'PostgreSQL', 'icon' => 'devicon-postgresql-plain colored'],
                        ['name' => 'MongoDB', 'icon' => 'devicon-mongodb-plain colored'],
                        ['name' => 'AWS', 'icon' => 'devicon-amazonwebservices-original colored'],
                    ];
                @endphp
                @foreach ($technologies as $tech)
                    <div class="col-6 col-md-3 col-lg-2">
                        <div class="p-3 border rounded shadow-sm">
                            <i class="{{ $tech['icon'] }} display-4 mb-2"></i>
                            <p class="fw-semibold mb-0">{{ $tech['name'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-5 text-center bg-light">
        <div class="container">
            <h2 class="fw-bold mb-3">Have a Project in Mind?</h2>
            <p class="text-muted mb-4">Let's discuss how our custom software solutions can drive your business forward.</p>
            <a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:pointer"
                class="btn btn-primary btn-lg">Request a Free Consultation</a>
        </div>
    </section>

    @push('styles')
        <style>
            /* Animation Keyframes */
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            @keyframes pulse {
                0%, 100% {
                    transform: scale(1);
                }
                50% {
                    transform: scale(1.1);
                }
            }
            
            @keyframes float {
                0%, 100% {
                    transform: translateY(0px);
                }
                50% {
                    transform: translateY(-15px);
                }
            }
            
            @keyframes gradientShift {
                0%, 100% {
                    background-position: 0% 50%;
                }
                50% {
                    background-position: 100% 50%;
                }
            }
            
            @keyframes backgroundPulse {
                0%, 100% {
                    opacity: 1;
                    transform: scale(1);
                }
                50% {
                    opacity: 0.8;
                    transform: scale(1.1);
                }
            }
            
            @keyframes particlesFloat {
                0% {
                    transform: translate(0, 0) rotate(0deg);
                }
                33% {
                    transform: translate(30px, -30px) rotate(120deg);
                }
                66% {
                    transform: translate(-20px, 20px) rotate(240deg);
                }
                100% {
                    transform: translate(0, 0) rotate(360deg);
                }
            }
            
            @keyframes particlesOpacity {
                0%, 100% {
                    opacity: 0.4;
                }
                50% {
                    opacity: 0.6;
                }
            }
            
            @keyframes radialPulse {
                0%, 100% {
                    opacity: 0.6;
                    transform: scale(1);
                }
                50% {
                    opacity: 1;
                    transform: scale(1.2);
                }
            }
            
            @keyframes floatShape {
                0%, 100% {
                    transform: translate(0, 0) rotate(0deg) scale(1);
                    opacity: 0.8;
                }
                16% {
                    transform: translate(60px, -70px) rotate(60deg) scale(1.25);
                    opacity: 1;
                }
                33% {
                    transform: translate(-50px, 60px) rotate(120deg) scale(0.85);
                    opacity: 0.9;
                }
                50% {
                    transform: translate(70px, 50px) rotate(180deg) scale(1.2);
                    opacity: 1;
                }
                66% {
                    transform: translate(-40px, -60px) rotate(240deg) scale(0.9);
                    opacity: 0.85;
                }
                83% {
                    transform: translate(50px, 40px) rotate(300deg) scale(1.15);
                    opacity: 0.95;
                }
            }
            
            @keyframes gridMove {
                0% {
                    background-position: 0 0;
                }
                100% {
                    background-position: 50px 50px;
                }
            }
            
            @keyframes overlayShift {
                0%, 100% {
                    opacity: 1;
                    transform: translate(0, 0);
                }
                50% {
                    opacity: 0.8;
                    transform: translate(20px, -20px);
                }
            }
            
            /* Hero Section Animation */
            .achievement-badge {
                border-radius: 0 !important;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #ff6b9d 75%, #c44569 100%);
                background-size: 300% 300%;
                animation: gradientShift 10s ease infinite;
                position: relative;
                overflow: hidden;
            }
            
            .hero-background {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                z-index: 1;
                background: 
                    radial-gradient(circle at 20% 30%, rgba(46, 204, 113, 0.15) 0%, transparent 50%),
                    radial-gradient(circle at 80% 70%, rgba(52, 152, 219, 0.15) 0%, transparent 50%),
                    radial-gradient(circle at 50% 50%, rgba(240, 147, 251, 0.1) 0%, transparent 60%);
                animation: backgroundPulse 8s ease-in-out infinite;
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
                    radial-gradient(circle at 75% 75%, rgba(255, 255, 255, 0.1) 1.5px, transparent 1.5px),
                    radial-gradient(circle at 50% 50%, rgba(255, 255, 255, 0.08) 1px, transparent 1px),
                    radial-gradient(circle at 10% 60%, rgba(46, 204, 113, 0.15) 1px, transparent 1px),
                    radial-gradient(circle at 90% 40%, rgba(52, 152, 219, 0.15) 1px, transparent 1px);
                background-size: 120px 120px, 180px 180px, 250px 250px, 150px 150px, 200px 200px;
                background-position: 0 0, 60px 60px, 120px 120px, 30px 30px, 90px 90px;
                opacity: 0.5;
                animation: particlesFloat 25s linear infinite, particlesOpacity 6s ease-in-out infinite;
                will-change: transform, opacity;
                transform: translateZ(0);
            }
            
            .hero-particles::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: 
                    radial-gradient(circle at 15% 25%, rgba(46, 204, 113, 0.2) 0%, transparent 40%),
                    radial-gradient(circle at 85% 75%, rgba(52, 152, 219, 0.2) 0%, transparent 40%),
                    radial-gradient(circle at 50% 50%, rgba(240, 147, 251, 0.15) 0%, transparent 50%);
                animation: radialPulse 6s ease-in-out infinite;
            }
            
            .hero-gradient-overlay {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                z-index: 2;
                background: 
                    radial-gradient(circle at 30% 20%, rgba(255,255,255,0.15) 0%, transparent 50%),
                    radial-gradient(circle at 70% 80%, rgba(255,255,255,0.1) 0%, transparent 50%),
                    linear-gradient(135deg, transparent 0%, rgba(255,255,255,0.05) 50%, transparent 100%);
                animation: overlayShift 12s ease-in-out infinite;
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
                border: 1px solid rgba(255, 255, 255, 0.1);
                animation: floatShape 20s ease-in-out infinite;
            }
            
            .shape-1 {
                width: 150px;
                height: 150px;
                top: 10%;
                left: 5%;
                animation-delay: 0s;
                background: radial-gradient(circle, rgba(76, 175, 80, 0.4) 0%, rgba(76, 175, 80, 0.2) 50%, transparent 70%);
                border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
                box-shadow: 0 0 40px rgba(76, 175, 80, 0.5);
                border: 3px solid rgba(76, 175, 80, 0.3);
            }
            
            .shape-2 {
                width: 120px;
                height: 120px;
                top: 60%;
                right: 10%;
                animation-delay: 2s;
                background: radial-gradient(circle, rgba(33, 150, 243, 0.4) 0%, rgba(33, 150, 243, 0.2) 50%, transparent 70%);
                border-radius: 50%;
                transform: rotate(45deg);
                box-shadow: 0 0 35px rgba(33, 150, 243, 0.5);
                border: 3px solid rgba(33, 150, 243, 0.3);
            }
            
            .shape-3 {
                width: 180px;
                height: 180px;
                bottom: 15%;
                left: 15%;
                animation-delay: 4s;
                background: radial-gradient(circle, rgba(156, 39, 176, 0.4) 0%, rgba(156, 39, 176, 0.2) 50%, transparent 70%);
                border-radius: 20% 80% 80% 20% / 20% 20% 80% 80%;
                box-shadow: 0 0 45px rgba(156, 39, 176, 0.5);
                border: 3px solid rgba(156, 39, 176, 0.3);
            }
            
            .shape-4 {
                width: 100px;
                height: 100px;
                top: 30%;
                right: 20%;
                animation-delay: 1s;
                background: radial-gradient(circle, rgba(46, 204, 113, 0.1) 0%, transparent 70%);
                clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
            }
            
            .shape-5 {
                width: 90px;
                height: 90px;
                bottom: 30%;
                right: 5%;
                animation-delay: 3s;
                background: radial-gradient(circle, rgba(52, 152, 219, 0.12) 0%, transparent 70%);
                border-radius: 20%;
                transform: rotate(30deg);
            }
            
            .shape-6 {
                width: 110px;
                height: 110px;
                top: 50%;
                left: 2%;
                animation-delay: 5s;
                background: radial-gradient(circle, rgba(240, 147, 251, 0.1) 0%, transparent 70%);
                border-radius: 50%;
                clip-path: polygon(25% 0%, 100% 0%, 75% 100%, 0% 100%);
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
            
            .achievement-badge .container {
                position: relative;
                z-index: 3;
                animation: fadeInUp 1s ease-out;
            }
            
            /* Section Animations */
            section {
                animation: fadeInUp 0.8s ease-out;
                animation-fill-mode: both;
            }
            
            section:nth-of-type(1) { animation-delay: 0.1s; }
            section:nth-of-type(2) { animation-delay: 0.2s; }
            section:nth-of-type(3) { animation-delay: 0.3s; }
            section:nth-of-type(4) { animation-delay: 0.4s; }
            section:nth-of-type(5) { animation-delay: 0.5s; }

            .pricing-card { background: #fff; border-radius: 0; padding: 30px 20px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08); position: relative; overflow: hidden; transition: all 0.3s ease; }
            .pricing-card:hover { transform: translateY(-10px); box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15); }
            .pricing-card.featured { border: 2px solid #0d6efd; transform: scale(1.05); z-index: 2; }
            .icon-box { 
                width: 70px; 
                height: 70px; 
                margin: 0 auto; 
                border-radius: 0; 
                background: #e9f2ff; 
                display: flex; 
                align-items: center; 
                justify-content: center; 
                font-size: 32px; 
                color: #0d6efd; 
                transition: all 0.3s ease;
                animation: float 3s ease-in-out infinite;
            }
            .pricing-card:hover .icon-box { 
                background: #0d6efd; 
                color: #fff;
                animation: pulse 1s ease-in-out infinite;
            }
            
            /* Card Animations */
            .card {
                animation: fadeInUp 0.8s ease-out;
                animation-fill-mode: both;
            }
            
            .card:nth-child(1) { animation-delay: 0.1s; }
            .card:nth-child(2) { animation-delay: 0.2s; }
            .card:nth-child(3) { animation-delay: 0.3s; }
            
            /* Pricing Card Animations */
            .pricing-card {
                animation: fadeInUp 0.8s ease-out;
                animation-fill-mode: both;
            }
            
            .pricing-card:nth-child(1) { animation-delay: 0.1s; }
            .pricing-card:nth-child(2) { animation-delay: 0.2s; }
            .pricing-card:nth-child(3) { animation-delay: 0.3s; }
            
            /* Technology Icons Animation */
            .row > div {
                animation: fadeInUp 0.6s ease-out;
                animation-fill-mode: both;
            }
            
            .row > div:nth-child(1) { animation-delay: 0.1s; }
            .row > div:nth-child(2) { animation-delay: 0.15s; }
            .row > div:nth-child(3) { animation-delay: 0.2s; }
            .row > div:nth-child(4) { animation-delay: 0.25s; }
            .row > div:nth-child(5) { animation-delay: 0.3s; }
            .row > div:nth-child(6) { animation-delay: 0.35s; }
            .row > div:nth-child(7) { animation-delay: 0.4s; }
            .row > div:nth-child(8) { animation-delay: 0.45s; }
            .row > div:nth-child(9) { animation-delay: 0.5s; }
            .row > div:nth-child(10) { animation-delay: 0.55s; }
            .price-tag { font-size: 1.5rem; font-weight: 700; margin: 15px 0; color: #333; position: relative; display: inline-block; padding: 5px 15px; border-radius: 0; background: #f8f9fa; }
            .price-tag.highlight { background: #0d6efd; color: #fff; }
            .price-tag .currency { font-size: 1rem; }
            .pricing-card ul li { margin: 8px 0; font-size: 0.95rem; }
            .hover-shadow { transition: all 0.3s ease-in-out; }
            .hover-shadow:hover { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1); }
            .card { border-radius: 0 !important; }
            .btn { border-radius: 0 !important; }
        </style>
    @endpush
@endsection