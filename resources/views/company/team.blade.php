@extends('layouts.app')

@section('title', 'Our Team - IndSoft24')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<!-- Team Header -->
<section class="achievement-badge text-white py-5" style="margin-top:72px">
    <div class="container text-center">
        <h1 class="fw-bold display-5 mb-3">Meet Our <span class="text-warning">Team</span></h1>
        <p class="lead">
            Our team is a diverse group of passionate innovators, developers, designers, and strategists committed to building cutting-edge solutions.
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

<!-- Optional CTA Section -->
<section class="bg-light py-5 text-center">
    <div class="container">
        <h2 class="fw-bold mb-3">Want to Join Our Team?</h2>
        <p class="text-muted mb-4">We are always looking for talented individuals. Check our careers page and apply today!</p>
        <a href="{{ route('career.index') }}" class="btn btn-primary btn-lg">View Careers</a>
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
