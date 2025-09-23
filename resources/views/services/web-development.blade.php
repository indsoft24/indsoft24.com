@extends('layouts.app')

@section('title', 'Website Development Services & Pricing in India (2025) | IndSoft24')
@section('meta_description',
    'Transparent website development pricing in India including domain, hosting, server, SSL,
    GST, and maintenance. IndSoft24 offers affordable web development services for startups, businesses, and enterprises.')

@section('content')
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">

    <!-- Hero Section -->
    <section class="achievement-badge text-white py-5" style="margin-top:72px">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-3">Website Development & Pricing in India</h1>
            <p class="lead mb-4">
                At IndSoft24, we believe in transparent pricing. No hidden costs — only clear packages and real value.
            </p>
            <a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:pointer"
                class="btn btn-warning btn-lg">Get a Free Quote</a>
        </div>
    </section>

    <!-- Services Overview -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Our Web Development Services</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100 text-center p-3">
                        <i class="bi bi-window-stack display-4 text-primary mb-3"></i>
                        <h5 class="fw-bold">Custom Website Development</h5>
                        <p class="text-muted">Tailor-made websites with modern UI/UX, scalable backend, and clean code
                            quality.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100 text-center p-3">
                        <i class="bi bi-phone display-4 text-success mb-3"></i>
                        <h5 class="fw-bold">Mobile Responsive Design</h5>
                        <p class="text-muted">Seamless experience across desktop, tablet, and mobile for better engagement.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100 text-center p-3">
                        <i class="bi bi-speedometer2 display-4 text-warning mb-3"></i>
                        <h5 class="fw-bold">SEO & Performance Optimization</h5>
                        <p class="text-muted">Websites designed to rank better on Google with faster load speeds and SEO
                            compliance.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="pricing-section bg-light py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Website Development Pricing in India (2025)</h2>
            <p class="text-center text-muted mb-5">
                Choose a package that fits your needs. Transparent pricing, no hidden charges, only value!
            </p>

            <div class="row g-4 justify-content-center">
                <!-- Basic Website -->
                <div class="col-md-4">
                    <div class="pricing-card text-center h-100">
                        <div class="icon-box">
                            <i class="bi bi-window-stack"></i>
                        </div>
                        <h5 class="fw-bold mt-3">Basic Website</h5>
                        <p class="text-muted">For blogs & portfolios</p>
                        <div class="price-tag">
                            <span class="currency">₹</span>8,000 – 25,000
                        </div>
                        <ul class="list-unstyled mt-3">
                            <li>✔ 1–5 Pages</li>
                            <li>✔ Mobile-Friendly</li>
                            <li>✔ Contact Form</li>
                            <li>✔ Basic SEO</li>
                        </ul>
                        <p class="fw-semibold mt-3">Maintenance: ₹3,000 – ₹8,000/year</p>
                        <a href="#" class="btn btn-outline-primary mt-3">Get Started</a>
                    </div>
                </div>

                <!-- Business Website -->
                <div class="col-md-4">
                    <div class="pricing-card text-center h-100 featured">
                        <div class="icon-box">
                            <i class="bi bi-building"></i>
                        </div>
                        <h5 class="fw-bold mt-3">Business Website</h5>
                        <p class="text-muted">For startups & SMEs</p>
                        <div class="price-tag highlight">
                            <span class="currency">₹</span>25,000 – 75,000
                        </div>
                        <ul class="list-unstyled mt-3">
                            <li>✔ 5–15 Pages</li>
                            <li>✔ Responsive Design</li>
                            <li>✔ Social Media Integration</li>
                            <li>✔ SEO Ready</li>
                        </ul>
                        <p class="fw-semibold mt-3">Maintenance: ₹8,000 – ₹15,000/year</p>
                        <a href="#" class="btn btn-primary mt-3">Most Popular</a>
                    </div>
                </div>

                <!-- E-commerce Website -->
                <div class="col-md-4">
                    <div class="pricing-card text-center h-100">
                        <div class="icon-box">
                            <i class="bi bi-cart-check"></i>
                        </div>
                        <h5 class="fw-bold mt-3">E-commerce Website</h5>
                        <p class="text-muted">For online stores</p>
                        <div class="price-tag">
                            <span class="currency">₹</span>1,50,000 – 5,00,000+
                        </div>
                        <ul class="list-unstyled mt-3">
                            <li>✔ Product Catalog</li>
                            <li>✔ Secure Payments</li>
                            <li>✔ Inventory Management</li>
                            <li>✔ SEO & Analytics</li>
                        </ul>
                        <p class="fw-semibold mt-3">Maintenance: ₹30,000 – ₹60,000/year</p>
                        <a href="#" class="btn btn-outline-danger mt-3">Get Started</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Additional Costs Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">💡 Additional Costs You Should Know</h2>
            <div class="row g-4">

                <!-- Domain Registration -->
                <div class="col-md-6">
                    <div class="p-4 border rounded shadow-sm h-100 text-center hover-shadow">
                        <i class="bi bi-globe2 text-primary display-5 mb-3"></i>
                        <h5 class="fw-bold">Domain Registration</h5>
                        <p class="text-muted fw-semibold">₹500 – ₹1,500/year</p>
                        <p class="small text-muted">Your unique online identity (<code>.com</code>, <code>.in</code>,
                            <code>.org</code>). Essential for every website.
                        </p>
                    </div>
                </div>

                <!-- Web Hosting -->
                <div class="col-md-6">
                    <div class="p-4 border rounded shadow-sm h-100 text-center hover-shadow">
                        <i class="bi bi-hdd-network text-success display-5 mb-3"></i>
                        <h5 class="fw-bold">Web Hosting</h5>
                        <p class="text-muted fw-semibold">₹2,000 – ₹1,00,000+/year</p>
                        <ul class="small text-muted list-unstyled">
                            <li>✔ Shared Hosting: ₹2,000 – ₹5,000/year</li>
                            <li>✔ VPS Hosting: ₹10,000 – ₹30,000/year</li>
                            <li>✔ Dedicated Hosting: ₹30,000 – ₹1,00,000+/year</li>
                        </ul>
                        <p class="small text-muted">Hosting ensures your website runs 24/7 on a secure server.</p>
                    </div>
                </div>

                <!-- SSL Certificate -->
                <div class="col-md-6">
                    <div class="p-4 border rounded shadow-sm h-100 text-center hover-shadow">
                        <i class="bi bi-shield-lock text-danger display-5 mb-3"></i>
                        <h5 class="fw-bold">SSL Certificate</h5>
                        <p class="text-muted fw-semibold">₹1,000 – ₹5,000/year</p>
                        <p class="small text-muted">Secures your website with HTTPS, builds trust, and improves Google
                            ranking.</p>
                    </div>
                </div>

                <!-- GST -->
                <div class="col-md-6">
                    <div class="p-4 border rounded shadow-sm h-100 text-center hover-shadow">
                        <i class="bi bi-receipt text-warning display-5 mb-3"></i>
                        <h5 class="fw-bold">GST (Goods & Services Tax)</h5>
                        <p class="text-muted fw-semibold">18% (Applicable in India)</p>
                        <p class="small text-muted">As per Government of India, GST is applied on all IT services &
                            invoices.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Development Process -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Our Development Process</h2>
            <div class="row g-4 text-center">
                <div class="col-md-3">
                    <div class="p-3">
                        <i class="bi bi-clipboard-check display-4 text-primary mb-3"></i>
                        <h5>Requirement Analysis</h5>
                        <p class="text-muted">We understand your goals and gather detailed requirements for a successful
                            project.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3">
                        <i class="bi bi-pencil-square display-4 text-success mb-3"></i>
                        <h5>Design & Prototyping</h5>
                        <p class="text-muted">UI/UX design with wireframes & interactive prototypes to preview your
                            website.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3">
                        <i class="bi bi-code-slash display-4 text-warning mb-3"></i>
                        <h5>Development</h5>
                        <p class="text-muted">Clean, scalable code built with PHP, Laravel, React, and modern frameworks.
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3">
                        <i class="bi bi-rocket display-4 text-danger mb-3"></i>
                        <h5>Launch & Support</h5>
                        <p class="text-muted">We launch your website with security checks and provide ongoing support.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Technologies Section -->
    <section class="bg-light py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Technologies We Use</h2>
            <div class="row g-4 justify-content-center text-center">
                @php
                    $technologies = [
                        ['name' => 'Laravel', 'icon' => 'devicon-laravel-plain colored'],
                        ['name' => 'React.js', 'icon' => 'devicon-react-original colored'],
                        ['name' => 'Vue.js', 'icon' => 'devicon-vuejs-plain colored'],
                        ['name' => 'Flutter', 'icon' => 'devicon-flutter-plain colored'],
                        ['name' => 'Node.js', 'icon' => 'devicon-nodejs-plain colored'],
                        ['name' => 'HTML5', 'icon' => 'devicon-html5-plain colored'],
                        ['name' => 'CSS3', 'icon' => 'devicon-css3-plain colored'],
                        ['name' => 'JavaScript', 'icon' => 'devicon-javascript-plain colored'],
                        ['name' => 'MySQL', 'icon' => 'devicon-mysql-plain colored'],
                        ['name' => 'MongoDB', 'icon' => 'devicon-mongodb-plain colored'],
                    ];
                @endphp
                @foreach ($technologies as $tech)
                    <div class="col-6 col-md-3 col-lg-2">
                        <div class="p-3 border rounded shadow-sm">
                            <i class="{{ $tech['icon'] }} display-4 mb-2"></i>
                            <p class="fw-semibold">{{ $tech['name'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- Benefits Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Why Choose IndSoft24?</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="p-3 text-center border rounded shadow-sm h-100">
                        <i class="bi bi-award display-4 text-warning mb-3"></i>
                        <h5>Quality Assurance</h5>
                        <p class="text-muted">We deliver bug-free websites with rigorous testing and quality checks.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 text-center border rounded shadow-sm h-100">
                        <i class="bi bi-people display-4 text-primary mb-3"></i>
                        <h5>Expert Team</h5>
                        <p class="text-muted">Our experienced developers, designers, and strategists bring your vision to
                            life.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 text-center border rounded shadow-sm h-100">
                        <i class="bi bi-clock-history display-4 text-success mb-3"></i>
                        <h5>Timely Delivery</h5>
                        <p class="text-muted">We respect deadlines and ensure your website is delivered on time.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-5 text-center bg-light">
        <div class="container">
            <h2 class="fw-bold mb-3">Ready to Build Your Website?</h2>
            <p class="text-muted mb-4">We provide clear pricing, complete transparency, and no hidden charges. Let’s get
                started today.</p>
            <a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:pointer"
                class="btn btn-primary btn-lg">Request a Free Consultation</a>
        </div>
    </section>

@endsection
@push('styles')
    <style>
        /* Pricing Section */
        .pricing-section {
            background: linear-gradient(135deg, #f9fafb, #f1f3f6);
        }

        .pricing-card {
            background: #fff;
            border-radius: 20px;
            padding: 30px 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .pricing-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .pricing-card.featured {
            border: 2px solid #0d6efd;
            transform: scale(1.05);
            z-index: 2;
        }

        .icon-box {
            width: 70px;
            height: 70px;
            margin: 0 auto;
            border-radius: 50%;
            background: #e9f2ff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: #0d6efd;
            transition: all 0.3s ease;
        }

        .pricing-card:hover .icon-box {
            background: #0d6efd;
            color: #fff;
        }

        .price-tag {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 15px 0;
            color: #333;
            position: relative;
            display: inline-block;
            padding: 5px 15px;
            border-radius: 8px;
            background: #f8f9fa;
        }

        .price-tag.highlight {
            background: #0d6efd;
            color: #fff;
        }

        .price-tag .currency {
            font-size: 1rem;
            vertical-align: super;
        }

        ul li {
            margin: 8px 0;
            font-size: 0.95rem;
        }

        .btn {
            border-radius: 25px;
            padding: 8px 20px;
            font-weight: 600;
        }

        .hover-shadow {
            transition: all 0.3s ease-in-out;
        }

        .hover-shadow:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        /* Hover Effects */
        .card:hover,
        .p-4:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
        }
    </style>
@endpush
