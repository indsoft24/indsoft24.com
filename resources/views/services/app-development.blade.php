@extends('layouts.app')

@section('title', 'Mobile App Development Services & Pricing in India (2025) | IndSoft24')
@section('meta_description', 'Transparent mobile app development pricing in India. IndSoft24 offers affordable iOS & Android app development for startups, businesses, and enterprises.')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">

    <section class="achievement-badge text-white py-5" style="margin-top:72px">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-3">Mobile App Development Services & Price in India</h1>
            <p class="lead mb-4">
                From idea to launch, we build high-performance iOS and Android apps with transparent, value-driven pricing.
            </p>
            <a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:pointer"
                class="btn btn-warning btn-lg">Get a Free App Quote</a>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Our App Development Services</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100 text-center p-3">
                        <i class="bi bi-apple display-4 text-primary mb-3"></i>
                        <h5 class="fw-bold">Native iOS & Android Apps</h5>
                        <p class="text-muted">High-performance, secure, and scalable native apps built with Swift (iOS) and Kotlin (Android) for the best user experience.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100 text-center p-3">
                        <i class="bi bi-layers-fill display-4 text-success mb-3"></i>
                        <h5 class="fw-bold">Cross-Platform Development</h5>
                        <p class="text-muted">Cost-effective solutions using Flutter or React Native to build beautiful apps for both iOS and Android from a single codebase.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100 text-center p-3">
                        <i class="bi bi-palette-fill display-4 text-warning mb-3"></i>
                        <h5 class="fw-bold">App UI/UX Design</h5>
                        <p class="text-muted">Intuitive and engaging user interfaces designed to maximize usability, retention, and user satisfaction.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pricing-section bg-light py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Mobile App Development Pricing in India (2025)</h2>
            <p class="text-center text-muted mb-5">
                Choose a package that aligns with your vision. Transparent pricing for powerful mobile solutions.
            </p>

            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="pricing-card text-center h-100">
                        <div class="icon-box"><i class="bi bi-lightbulb"></i></div>
                        <h5 class="fw-bold mt-3">Simple / MVP App</h5>
                        <p class="text-muted">For validating ideas & startups</p>
                        <div class="price-tag"><span class="currency">₹</span>10,000 – 40,000</div>
                        <ul class="list-unstyled mt-3">
                            <li>✔ Single Platform (iOS or Android)</li>
                            <li>✔ 3-5 Screens</li>
                            <li>✔ Basic UI/UX Design</li>
                            <li>✔ User Login</li>
                        </ul>
                        <p class="fw-semibold mt-3">Maintenance: ₹2000 – ₹6000/year</p>
                        <a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:pointer" class="btn btn-outline-primary mt-3">Get Started</a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="pricing-card text-center h-100 featured">
                        <div class="icon-box"><i class="bi bi-building"></i></div>
                        <h5 class="fw-bold mt-3">Business App</h5>
                        <p class="text-muted">For growing businesses</p>
                        <div class="price-tag highlight"><span class="currency">₹</span>40,000 – 1,00,000</div>
                        <ul class="list-unstyled mt-3">
                            <li>✔ iOS & Android (Cross-Platform)</li>
                            <li>✔ 10-15 Screens</li>
                            <li>✔ Custom UI/UX & API Integration</li>
                            <li>✔ Admin Panel & Push Notifications</li>
                        </ul>
                        <p class="fw-semibold mt-3">Maintenance: ₹10,000 – ₹25,000/year</p>
                        <a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:pointer" class="btn btn-primary mt-3">Most Popular</a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="pricing-card text-center h-100">
                        <div class="icon-box"><i class="bi bi-gem"></i></div>
                        <h5 class="fw-bold mt-3">Enterprise App</h5>
                        <p class="text-muted">For large-scale solutions</p>
                        <div class="price-tag"><span class="currency">₹</span>10,00,000+</div>
                        <ul class="list-unstyled mt-3">
                            <li>✔ Native Performance</li>
                            <li>✔ Complex Backend & Integrations</li>
                            <li>✔ Real-time Features (Chat, GPS)</li>
                            <li>✔ Advanced Security & Scalability</li>
                        </ul>
                        <p class="fw-semibold mt-3">Maintenance: 15-20% of dev cost/year</p>
                        <a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:pointer" class="btn btn-outline-danger mt-3">Get Started</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">💡 App Development Costs You Should Know</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-4 border rounded shadow-sm h-100 text-center hover-shadow">
                        <i class="bi bi-cloud-arrow-up text-primary display-5 mb-3"></i>
                        <h5 class="fw-bold">App Store Publishing Fees</h5>
                        <p class="text-muted fw-semibold">Apple: $99/year | Google: $25 one-time</p>
                        <p class="small text-muted">Required fees to list your app on the Apple App Store and Google Play Store.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 border rounded shadow-sm h-100 text-center hover-shadow">
                        <i class="bi bi-server text-success display-5 mb-3"></i>
                        <h5 class="fw-bold">Backend Server & API Costs</h5>
                        <p class="text-muted fw-semibold">₹10,000 – ₹50,000+/year</p>
                        <p class="small text-muted">Costs for the server that powers your app, stores data, and handles user logic.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 border rounded shadow-sm h-100 text-center hover-shadow">
                        <i class="bi bi-plugin text-danger display-5 mb-3"></i>
                        <h5 class="fw-bold">Third-Party Service Integrations</h5>
                        <p class="text-muted fw-semibold">Varies (Monthly/Yearly)</p>
                        <p class="small text-muted">Costs for services like payment gateways (Stripe, Razorpay), maps, or SMS gateways.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 border rounded shadow-sm h-100 text-center hover-shadow">
                        <i class="bi bi-receipt text-warning display-5 mb-3"></i>
                        <h5 class="fw-bold">GST (Goods & Services Tax)</h5>
                        <p class="text-muted fw-semibold">18% (Applicable in India)</p>
                        <p class="small text-muted">As per Government of India, GST is applied on all IT services & invoices.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-light py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">App Development Technologies We Use</h2>
            <div class="row g-4 justify-content-center text-center">
                @php
                    $technologies = [
                        ['name' => 'Swift (iOS)', 'icon' => 'devicon-swift-plain colored'],
                        ['name' => 'Kotlin (Android)', 'icon' => 'devicon-kotlin-plain colored'],
                        ['name' => 'Flutter', 'icon' => 'devicon-flutter-plain colored'],
                        ['name' => 'React Native', 'icon' => 'devicon-react-original colored'],
                        ['name' => 'Node.js', 'icon' => 'devicon-nodejs-plain colored'],
                        ['name' => 'Firebase', 'icon' => 'devicon-firebase-plain colored'],
                        ['name' => 'MySQL', 'icon' => 'devicon-mysql-plain colored'],
                        ['name' => 'MongoDB', 'icon' => 'devicon-mongodb-plain colored'],
                        ['name' => 'AWS', 'icon' => 'devicon-amazonwebservices-original colored'],
                        ['name' => 'Docker', 'icon' => 'devicon-docker-plain colored'],
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
            <h2 class="fw-bold mb-3">Ready to Build Your App?</h2>
            <p class="text-muted mb-4">We provide clear pricing, complete transparency, and no hidden charges. Let’s get started today.</p>
            <a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:pointer"
                class="btn btn-primary btn-lg">Request a Free Consultation</a>
        </div>
    </section>

    @push('styles')
        <style>
            /* Remove border radius from hero section */
            .achievement-badge {
                border-radius: 0 !important;
            }

            .pricing-card { background: #fff; border-radius: 0; padding: 30px 20px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08); position: relative; overflow: hidden; transition: all 0.3s ease; }
            .pricing-card:hover { transform: translateY(-10px); box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15); }
            .pricing-card.featured { border: 2px solid #0d6efd; transform: scale(1.05); z-index: 2; }
            .icon-box { width: 70px; height: 70px; margin: 0 auto; border-radius: 0; background: #e9f2ff; display: flex; align-items: center; justify-content: center; font-size: 32px; color: #0d6efd; transition: all 0.3s ease; }
            .pricing-card:hover .icon-box { background: #0d6efd; color: #fff; }
            .price-tag { font-size: 1.5rem; font-weight: 700; margin: 15px 0; color: #333; position: relative; display: inline-block; padding: 5px 15px; border-radius: 0; background: #f8f9fa; }
            .price-tag.highlight { background: #0d6efd; color: #fff; }
            .price-tag .currency { font-size: 1rem; vertical-align: super; }
            .pricing-card ul li { margin: 8px 0; font-size: 0.95rem; }
            .hover-shadow { transition: all 0.3s ease-in-out; }
            .hover-shadow:hover { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1); }
            .card { border-radius: 0 !important; }
            .btn { border-radius: 0 !important; }
        </style>
    @endpush
@endsection