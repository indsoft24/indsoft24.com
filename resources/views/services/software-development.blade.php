@extends('layouts.app')

@section('title', 'Custom Software Development Services & Pricing in India | IndSoft24')
@section('meta_description', 'Bespoke software development pricing in India. IndSoft24 builds custom ERP, CRM, and SaaS solutions to solve unique business challenges and improve efficiency.')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">

    <section class="achievement-badge text-white py-5" style="margin-top:72px">
        <div class="container text-center">
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
            .pricing-card { background: #fff; border-radius: 20px; padding: 30px 20px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08); position: relative; overflow: hidden; transition: all 0.3s ease; }
            .pricing-card:hover { transform: translateY(-10px); box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15); }
            .pricing-card.featured { border: 2px solid #0d6efd; transform: scale(1.05); z-index: 2; }
            .icon-box { width: 70px; height: 70px; margin: 0 auto; border-radius: 50%; background: #e9f2ff; display: flex; align-items: center; justify-content: center; font-size: 32px; color: #0d6efd; transition: all 0.3s ease; }
            .pricing-card:hover .icon-box { background: #0d6efd; color: #fff; }
            .price-tag { font-size: 1.5rem; font-weight: 700; margin: 15px 0; color: #333; position: relative; display: inline-block; padding: 5px 15px; border-radius: 8px; background: #f8f9fa; }
            .price-tag.highlight { background: #0d6efd; color: #fff; }
            .price-tag .currency { font-size: 1rem; }
            .pricing-card ul li { margin: 8px 0; font-size: 0.95rem; }
            .hover-shadow { transition: all 0.3s ease-in-out; }
            .hover-shadow:hover { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1); }
        </style>
    @endpush
@endsection