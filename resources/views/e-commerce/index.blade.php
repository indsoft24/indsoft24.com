@extends('layouts.app')

@section('title', 'Coming Soon | Buy & Sell Online in India | indsoft24.com')
@section('meta_description', '{{ config("app.name") }} is launching soon! A user-friendly e-commerce marketplace where you can buy or sell anything with minimal documentation, secure payments, and fast delivery across India.')

@section('content')
<!-- Hero Section -->
<section class="text-white py-5 achievement-badge" style="margin-top:72px;">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3">🚀 {{ env("app.name") }} is Coming Soon</h1>
        <p class="lead mb-4">India’s next big <strong>Buy & Sell Marketplace</strong> — simple, fast, and secure.</p>
        <a data-bs-toggle="modal" data-bs-target="#notifyMeModal" class="btn btn-warning btn-lg">Get Early Access</a>
    </div>
</section>

<!-- Categories Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Shop by Categories</h2>
        <div class="row g-4 text-center">
            @php
                $categories = [
                    ['Electronics', 'fa-solid fa-mobile-screen-button'],
                    ['Fashion', 'fa-solid fa-shirt'],
                    ['Home & Kitchen', 'fa-solid fa-couch'],
                    ['Beauty', 'fa-solid fa-wand-magic-sparkles'],
                    ['Sports', 'fa-solid fa-football'],
                    ['Books', 'fa-solid fa-book-open']
                ];
            @endphp

            @foreach ($categories as $cat)
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="p-4 border rounded shadow-sm hover-shadow h-100 d-flex flex-column align-items-center">
                        <i class="{{ $cat[1] }} fa-3x mb-3 text-primary"></i>
                        <h6 class="fw-bold">{{ $cat[0] }}</h6>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


<!-- Product Teasers -->
@php
    $products = [
        ['Smartphone', '15,999', 'images/product/mobile.jpg'],
        ['Sneakers', '1,299', 'images/product/shoes.jpg'],
        ['Mixer Grinder', '2,499', 'images/product/mixer.jpg'],
        ['Wrist Watch', '3,999', 'images/product/watch.jpg'],
    ];
@endphp

<div class="row g-4">
    @foreach ($products as $p)
        <div class="col-6 col-md-3">
            <div class="card shadow-sm border-0 h-100 hover-shadow">
                <div style="position:relative;">
                    <img 
                        src="{{ asset($p[2]) }}" 
                        alt="{{ $p[0] }}" 
                        class="card-img-top"
                        style="height:250px; object-fit:cover; border-top-left-radius:12px; border-top-right-radius:12px;">
                    <span style="position:absolute; top:10px; left:10px; background:#ffcc00; color:#111; font-weight:600; padding:5px 12px; border-radius:20px; font-size:13px;">
                        Coming Soon
                    </span>
                </div>
                <div class="card-body text-center">
                    <h6 class="fw-bold">{{ $p[0] }}</h6>
                    <p class="text-muted">₹{{ $p[1] }}</p>
                    <button disabled class="btn btn-sm btn-outline-secondary rounded-pill">Notify Me</button>
                </div>
            </div>
        </div>
    @endforeach
</div>


<!-- Countdown + Newsletter -->
<section class="pricing-section py-5">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">We’re Launching Soon!</h2>
        <p class="text-muted mb-4">Join now to receive <strong>exclusive launch discounts</strong> and early access.</p>

        <div id="countdown" class="d-flex justify-content-center gap-3 mb-4"></div>

        <form action="{{ route('newsletter.subscribe') }}" method="post" class="d-flex flex-column flex-sm-row justify-content-center gap-2">
            @csrf
            <input type="email" name="email" class="form-control form-control-lg w-50" placeholder="Enter your email" required>
            <button type="submit" class="btn btn-primary btn-lg">Notify Me</button>
        </form>
    </div>
</section>

<!-- CTA -->
<section class="py-5 text-center bg-light">
    <div class="container">
        <h2 class="fw-bold mb-3">Stay Tuned for India’s Most User-Friendly Marketplace</h2>
        <p class="text-muted mb-4">From mobiles to fashion, from home needs to books — everything at one place.</p>
        <a data-bs-toggle="modal" data-bs-target="#notifyMeModal" class="btn btn-warning btn-lg">Join the Waitlist</a>
    </div>
</section>
@endsection

@push('styles')
<style>
/* Countdown */
#countdown .box {
    background: #fff;
    border-radius: 12px;
    padding: 20px;
    min-width: 90px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
}
#countdown .number {
    font-size: 1.5rem;
    font-weight: 700;
}
#countdown .label {
    font-size: 0.85rem;
    color: #6c757d;
}
/* Hover Effect */
.hover-shadow { transition: all 0.3s ease-in-out; }
.hover-shadow:hover { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(0,0,0,0.15); }
</style>
@endpush

@push('scripts')
<script>
(function () {
    const launchDate = new Date("2025-12-31T00:00:00").getTime();
    const countdown = document.getElementById("countdown");
    function updateCountdown() {
        const now = new Date().getTime();
        const diff = launchDate - now;
        if (diff <= 0) {
            countdown.innerHTML = "<h4 class='text-success'>🎉 We are Live!</h4>";
            return;
        }
        const d = Math.floor(diff / (1000*60*60*24));
        const h = Math.floor((diff % (1000*60*60*24)) / (1000*60*60));
        const m = Math.floor((diff % (1000*60*60)) / (1000*60));
        const s = Math.floor((diff % (1000*60)) / 1000);
        countdown.innerHTML = `
            <div class="box"><div class="number">${d}</div><div class="label">Days</div></div>
            <div class="box"><div class="number">${h}</div><div class="label">Hours</div></div>
            <div class="box"><div class="number">${m}</div><div class="label">Mins</div></div>
            <div class="box"><div class="number">${s}</div><div class="label">Secs</div></div>
        `;
    }
    updateCountdown();
    setInterval(updateCountdown, 1000);
})();
</script>
@endpush
