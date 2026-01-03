@extends('layouts.app')

@section('title', 'Our Team - IndSoft24 | Expert Developers & Digital Solutions Team')

@section('meta')
<meta name="description" content="Meet the expert team at Indsoft24 providing website development, app development, digital marketing, and creative services. Plus, enjoy our free blog posting platform.">
<meta name="keywords" content="Indsoft24 team, website developers, app developers, digital marketing experts, software development team">
@endsection

@push('styles')
<style>
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
    
    .team-header-enhanced {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 60px 0;
        
        animation: fadeInUp 1s ease-out;
    }
    
    .team-benefits {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 20px;
        padding: 40px;
        margin: 40px 0;
    }
    
    .benefit-badge {
        display: inline-block;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 8px 20px;
        border-radius: 25px;
        font-size: 0.9rem;
        font-weight: 600;
        margin: 5px;
    }
</style>
@endpush

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<!-- Team Header -->
<section class="team-header-enhanced text-white">
    <div class="container text-center">
        <h1 class="fw-bold display-4 mb-3" style="text-shadow: 0 2px 20px rgba(0,0,0,0.3);">Meet Our <span class="text-warning">Expert Team</span></h1>
        <p class="lead fs-4 mb-3" style="opacity: 0.95;">
            Our team is a diverse group of passionate innovators, developers, designers, and strategists committed to building cutting-edge solutions.
        </p>
        <p class="fs-5 mb-0" style="opacity: 0.9;">
            We deliver world-class website development, app development, digital marketing, and creative services
        </p>
    </div>
</section>

<!-- Team Members -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Our Experts</h2>
        <div class="row g-4">

            <!-- Team Members Array -->
            @php
            $teamMembers = [
                [
                    'name' => 'Ravi Roushan',
                    'role' => 'Software Developer',
                    'image' => 'ravi.jpeg',
                    'description' => 'MCA graduate from Banaras Hindu University with expertise in web, mobile, and software development. Completed 50+ projects using PHP, Laravel, React, and MySQL, delivering high-quality solutions with precision and passion.',
                    'socials' => [
                        ['icon'=>'linkedin','url'=>'https://www.linkedin.com/in/ravi-roushan-1810rs/','color'=>'primary'],
                        ['icon'=>'github','url'=>'https://github.com/raviroushan1818','color'=>'dark'],
                        ['icon'=>'twitter','url'=>'https://x.com/raviroushan1820','color'=>'info'],
                    ]
                ],
                [
                    'name' => 'Bibhu Prasad De',
                    'role' => 'Software Developer',
                    'image' => 'default.png',
                    'description' => 'Highly accomplished Full-Stack Developer with a Master of Computer Application from Banaras Hindu University, offering comprehensive expertise across the MERN stack (React, Node.js, Express, MongoDB) and PHP. Proficient in DevOps (Docker, Kubernetes, AWS) and adept at building and integrating robust REST APIs and secure payment gateways.',
                    'socials' => [
                        ['icon'=>'linkedin','url'=>'https://www.linkedin.com/in/bibhu-de/','color'=>'primary'],
                        ['icon'=>'github','url'=>'https://github.com/DeBibhu562/','color'=>'dark'],
                    ]
                ],
                [
                    'name' => 'Roshni Khan',
                    'role' => 'Blog & Article Expert',
                    'image' => 'roshni.jpeg',
                    'description' => 'Focused on creating intuitive blogs and bring two years of experience in content writing and blog creation, with a strong ability to craft engaging and well-structured content. I am passionate about reading diverse articles and books, which helps me stay informed and continuously improve my writing skills.',
                    'socials' => [
                        ['icon'=>'linkedin','url'=>'#','color'=>'primary'],
                        ['icon'=>'dribbble','url'=>'#','color'=>'danger'],
                    ]
                ],
            ];
            @endphp

            <!-- Render Team Members -->
            @foreach($teamMembers as $member)
            <div class="col-md-4">
                <div class="card team-card border-0 shadow-sm text-center overflow-hidden">
                    <img src="{{ asset('images/team/'.$member['image']) }}" class="card-img-top rounded-circle mx-auto mt-3" 
                         alt="{{ $member['name'] }}" style="width: 150px; height:150px; object-fit:cover; border:5px solid #2ecc71;">
                    <div class="card-body">
                        <h5 class="fw-bold">{{ $member['name'] }}</h5>
                        <p class="text-primary fw-semibold">{{ $member['role'] }}</p>
                        <p class="text-muted small">{{ $member['description'] }}</p>
                        <!-- Social Icons Below Description -->
                        <div class="social-links mt-3">
                            @foreach($member['socials'] as $social)
                                <a href="{{ $social['url'] }}" class="text-{{ $social['color'] }} me-3 fs-5"><i class="bi bi-{{ $social['icon'] }}"></i></a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>

<!-- Benefits Section -->
<section class="py-5">
    <div class="container">
        <div class="team-benefits">
            <div class="text-center mb-4">
                <h2 class="display-5 fw-bold text-primary mb-3">What Our Team Delivers</h2>
                <p class="lead text-muted">Expert solutions across all digital domains</p>
            </div>
            <div class="row g-4 mb-4">
                <div class="col-md-6 col-lg-3 text-center">
                    <i class="fas fa-globe fa-3x text-primary mb-3"></i>
                    <h5 class="fw-bold">Website Development</h5>
                    <p class="text-muted small mb-0">Professional, responsive websites</p>
                </div>
                <div class="col-md-6 col-lg-3 text-center">
                    <i class="fas fa-mobile-alt fa-3x text-success mb-3"></i>
                    <h5 class="fw-bold">App Development</h5>
                    <p class="text-muted small mb-0">Android & iOS applications</p>
                </div>
                <div class="col-md-6 col-lg-3 text-center">
                    <i class="fas fa-chart-line fa-3x text-info mb-3"></i>
                    <h5 class="fw-bold">Digital Marketing</h5>
                    <p class="text-muted small mb-0">SEO, Ads, Content Marketing</p>
                </div>
                <div class="col-md-6 col-lg-3 text-center">
                    <i class="fas fa-blog fa-3x text-warning mb-3"></i>
                    <h5 class="fw-bold">Free Blog Platform</h5>
                    <p class="text-muted small mb-0">Post for free, earn money</p>
                </div>
            </div>
            <div class="text-center">
                <p class="mb-3">We also offer: Software Development, Social Media Marketing, Creative Services, and more!</p>
                <div>
                    <span class="benefit-badge">Software Development</span>
                    <span class="benefit-badge">Social Media Marketing</span>
                    <span class="benefit-badge">Creative Services</span>
                    <span class="benefit-badge">SEO Services</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Optional CTA Section -->
<section class="bg-light py-5 text-center">
    <div class="container">
        <h2 class="fw-bold mb-3">Want to Join Our Team?</h2>
        <p class="text-muted mb-4">We are always looking for talented individuals. Check our careers page and apply today!</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('career.index') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-briefcase me-2"></i>View Careers
            </a>
            @auth
                <a href="{{ route('user.blog.create') }}" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-blog me-2"></i>Start Blogging
                </a>
            @else
                <a href="{{ route('auth.google') }}" class="btn btn-outline-primary btn-lg">
                    <i class="fab fa-google me-2"></i>Start Free Blogging
                </a>
            @endauth
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
/* Card Hover Effects */
.team-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.team-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.2);
}

/* Profile Image Hover Zoom */
.team-card img {
    transition: transform 0.3s ease;
}
.team-card:hover img {
    transform: scale(1.05);
}

/* Social Icons Hover */
.social-links a {
    transition: transform 0.2s;
}
.social-links a:hover {
    transform: scale(1.3);
}
</style>
@endpush
