<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marsorbit Entertainment | Digital & Celebrity Management</title>
    <meta name="description" content="Marsorbit Entertainment - Premier Youtube Channel Management, Audio Streaming, and Celebrity Management Services.">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Montserrat:wght@700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* --- CSS VARIABLES & RESET --- */
        :root {
            --primary-color: #0a0f1c; /* Deep Navy/Black */
            --secondary-color: #151b2b; /* Lighter Navy */
            --accent-color: #e31e24; /* Red Accent (Brand) or use #d4af37 for Gold */
            --text-light: #f4f4f4;
            --text-gray: #a0a0a0;
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
            --transition: all 0.3s ease;
            --container-width: 1200px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--primary-color);
            color: var(--text-light);
            line-height: 1.6;
            overflow-x: hidden;
        }

        a { text-decoration: none; color: inherit; transition: var(--transition); }
        ul { list-style: none; }
        img { max-width: 100%; height: auto; display: block; }

        /* --- UTILITY CLASSES --- */
        .container {
            max-width: var(--container-width);
            margin: 0 auto;
            padding: 0 20px;
        }
        .section-padding { padding: 80px 0; }
        .text-center { text-align: center; }
        .heading-wrapper { margin-bottom: 50px; text-align: center; }
        .section-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 15px;
            background: linear-gradient(to right, #fff, #a0a0a0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .section-subtitle {
            color: var(--accent-color);
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .btn {
            display: inline-block;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            cursor: pointer;
            transition: var(--transition);
            border: 2px solid transparent;
        }

        .btn-primary {
            background-color: var(--accent-color);
            color: white;
            box-shadow: 0 4px 15px rgba(227, 30, 36, 0.4);
        }

        .btn-primary:hover {
            background-color: transparent;
            border-color: var(--accent-color);
            color: var(--accent-color);
            transform: translateY(-3px);
        }

        .btn-outline {
            border-color: #fff;
            color: #fff;
        }
        .btn-outline:hover {
            background-color: #fff;
            color: var(--primary-color);
        }

        /* --- HEADER --- */
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            background: rgba(10, 15, 28, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--glass-border);
            padding: 15px 0;
        }

        .nav-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.5rem;
            font-weight: 800;
            color: white;
        }
        .logo span { color: var(--accent-color); }

        .nav-menu {
            display: flex;
            gap: 30px;
        }

        .nav-link {
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--text-light);
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: var(--accent-color);
            transition: var(--transition);
        }

        .nav-link:hover::after { width: 100%; }

        .mobile-toggle { display: none; font-size: 1.5rem; cursor: pointer; }

        /* --- HERO SECTION --- */
        .hero {
            height: 100vh;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1492684223066-81342ee5ff30?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80') no-repeat center center/cover;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 800px;
            padding: 20px;
            animation: fadeInUp 1s ease forwards;
        }

        .hero h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 3.5rem;
            margin-bottom: 20px;
            line-height: 1.2;
        }
        
        .hero p {
            font-size: 1.2rem;
            color: #ddd;
            margin-bottom: 30px;
        }

        /* --- ABOUT SUMMARY --- */
        .intro-section {
            background-color: var(--secondary-color);
            position: relative;
        }

        .intro-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: center;
        }

        .intro-text p { margin-bottom: 20px; color: var(--text-gray); }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 30px;
        }

        .stat-item h3 { color: var(--accent-color); font-size: 2rem; }
        .stat-item span { font-size: 0.9rem; text-transform: uppercase; }

        .intro-img {
            position: relative;
            border-radius: 10px;
            overflow: hidden;
        }
        .intro-img::before {
            content: '';
            position: absolute;
            top: 20px;
            left: -20px;
            width: 100%;
            height: 100%;
            border: 2px solid var(--accent-color);
            z-index: -1;
            border-radius: 10px;
        }

        /* --- SERVICES --- */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .service-card {
            background: var(--secondary-color);
            padding: 40px 30px;
            border-radius: 15px;
            border: 1px solid var(--glass-border);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent, rgba(227, 30, 36, 0.05));
            z-index: -1;
            opacity: 0;
            transition: var(--transition);
        }

        .service-card:hover {
            transform: translateY(-10px);
            border-color: var(--accent-color);
        }
        .service-card:hover::before { opacity: 1; }

        .service-icon {
            font-size: 2.5rem;
            color: var(--accent-color);
            margin-bottom: 20px;
        }

        .service-card h3 { font-size: 1.5rem; margin-bottom: 15px; }
        .service-card p { color: var(--text-gray); font-size: 0.95rem; margin-bottom: 20px; }

        .service-link {
            color: var(--text-light);
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        .service-link:hover { color: var(--accent-color); gap: 10px; }

        /* --- WHY US --- */
        .why-us {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
        }
        
        .feature-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .feature-item {
            text-align: center;
            padding: 20px;
        }
        .feature-item i {
            font-size: 3rem;
            color: var(--accent-color);
            margin-bottom: 20px;
            opacity: 0.8;
        }
        .feature-item h4 { margin-bottom: 10px; font-size: 1.2rem; }
        .feature-item p { color: var(--text-gray); font-size: 0.9rem; }

        /* --- TESTIMONIALS --- */
        .testimonial-container {
            background: var(--secondary-color);
            padding: 40px;
            border-radius: 20px;
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
            position: relative;
        }

        .testimonial-text {
            font-size: 1.2rem;
            font-style: italic;
            margin-bottom: 20px;
            color: #ddd;
        }
        .client-name {
            font-weight: 700;
            color: var(--accent-color);
        }
        .testimonial-nav {
            margin-top: 20px;
        }
        .testimonial-nav button {
            background: none;
            border: 1px solid var(--text-gray);
            color: var(--text-light);
            padding: 5px 15px;
            cursor: pointer;
            border-radius: 50%;
            margin: 0 5px;
            transition: var(--transition);
        }
        .testimonial-nav button:hover {
            background: var(--accent-color);
            border-color: var(--accent-color);
        }

        /* --- FOOTER --- */
        footer {
            background-color: #05080f;
            padding-top: 80px;
            border-top: 1px solid var(--glass-border);
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
            margin-bottom: 50px;
        }

        .footer-col h4 {
            color: #fff;
            margin-bottom: 25px;
            font-size: 1.2rem;
            position: relative;
            padding-bottom: 10px;
        }

        .footer-col h4::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background-color: var(--accent-color);
        }

        .footer-links li { margin-bottom: 15px; }
        .footer-links a { color: var(--text-gray); font-size: 0.95rem; }
        .footer-links a:hover { color: var(--accent-color); padding-left: 5px; }

        .contact-info li {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            color: var(--text-gray);
        }
        .contact-info i { color: var(--accent-color); margin-top: 5px; }

        .copyright {
            border-top: 1px solid rgba(255,255,255,0.05);
            padding: 20px 0;
            text-align: center;
            font-size: 0.9rem;
            color: #666;
        }

        /* --- RESPONSIVE --- */
        @media (max-width: 991px) {
            .hero h1 { font-size: 2.5rem; }
            .intro-grid { grid-template-columns: 1fr; }
            .intro-img { display: none; } /* Simplify layout on mobile */
        }

        @media (max-width: 768px) {
            .nav-menu {
                position: fixed;
                top: 70px;
                right: -100%;
                width: 80%;
                height: 100vh;
                background-color: var(--secondary-color);
                flex-direction: column;
                padding: 50px;
                transition: 0.4s;
            }
            .nav-menu.active { right: 0; }
            .mobile-toggle { display: block; }
            .section-title { font-size: 2rem; }
        }

        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <header>
        <div class="container nav-wrapper">
            <div class="logo">Mars<span>orbit</span></div>
            <div class="mobile-toggle" id="mobile-toggle">
                <i class="fas fa-bars"></i>
            </div>
            <ul class="nav-menu" id="nav-menu">
                <li><a href="#" class="nav-link">Home</a></li>
                <li><a href="#about" class="nav-link">About Us</a></li>
                <li><a href="#services" class="nav-link">Services</a></li>
                <li><a href="#testimonials" class="nav-link">Clients</a></li>
                <li><a href="#contact" class="btn btn-primary">Request Quote</a></li>
            </ul>
        </div>
    </header>

    <section class="hero">
        <div class="hero-content container">
            <span class="section-subtitle">Welcome to Marsorbit</span>
            <h1>Elevating Brands to <br><span>Global Stardom</span></h1>
            <p>We are a premier digital entertainment company specializing in Celebrity Management, YouTube Growth, and Audio Streaming technologies.</p>
            <div class="hero-btns">
                <a href="#services" class="btn btn-primary">Explore Services</a>
                <a href="#contact" class="btn btn-outline">Contact Us</a>
            </div>
        </div>
    </section>

    <section id="about" class="section-padding intro-section">
        <div class="container">
            <div class="intro-grid">
                <div class="intro-text">
                    <span class="section-subtitle">From The Get Go</span>
                    <h2 class="section-title">Driving Digital Excellence</h2>
                    <p>Marsorbit Entertainment is a young, energetic, and enterprising digital services company. Our motto is to inspire, entertain, and create a positive impact on business growth.</p>
                    <p>We act as a catalyst that drives creativity to entertain audiences across the globe, working closely with Google, YouTube, AdSense, and major media houses to deliver top-tier content distribution.</p>
                    
                    <div class="stats-grid">
                        <div class="stat-item">
                            <h3>10+</h3>
                            <span>Years Exp.</span>
                        </div>
                        <div class="stat-item">
                            <h3>500+</h3>
                            <span>Projects</span>
                        </div>
                        <div class="stat-item">
                            <h3>24/7</h3>
                            <span>Support</span>
                        </div>
                    </div>
                </div>
                <div class="intro-img">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Marsorbit Team">
                </div>
            </div>
        </div>
    </section>

    <section id="services" class="section-padding">
        <div class="container">
            <div class="heading-wrapper">
                <span class="section-subtitle">What We Do</span>
                <h2 class="section-title">Our Expertise</h2>
            </div>
            
            <div class="services-grid">
                <div class="service-card">
                    <i class="fab fa-youtube service-icon"></i>
                    <h3>YouTube Management</h3>
                    <p>We understand the nitty-gritty of managing channels. From content strategy to monetization and analytics, we help creators grow.</p>
                    <a href="#" class="service-link">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="service-card">
                    <i class="fas fa-music service-icon"></i>
                    <h3>Audio Streaming</h3>
                    <p>Handling the technical nuances of music distribution across major platforms globally to ensure your art reaches everyone.</p>
                    <a href="#" class="service-link">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="service-card">
                    <i class="fas fa-star service-icon"></i>
                    <h3>Celebrity Management</h3>
                    <p>Expert handling of celebrity profiles across digital platforms, ensuring brand safety, growth, and maximized engagement.</p>
                    <a href="#" class="service-link">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="service-card">
                    <i class="fas fa-shield-alt service-icon"></i>
                    <h3>Copyright / DMCA</h3>
                    <p>Protecting rights owners from piracy by limiting distribution of unlicensed content on all video sharing platforms.</p>
                    <a href="#" class="service-link">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="service-card">
                    <i class="fas fa-bullhorn service-icon"></i>
                    <h3>Digital Marketing</h3>
                    <p>Strategic social media management, SEO, and PPC campaigns designed to drive traffic, visibility, and leads.</p>
                    <a href="#" class="service-link">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="service-card">
                    <i class="fas fa-palette service-icon"></i>
                    <h3>Graphics & Design</h3>
                    <p>Transform your brand identity with creative logo designing and visual masterpieces that captivate audiences.</p>
                    <a href="#" class="service-link">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding why-us">
        <div class="container">
            <div class="heading-wrapper">
                <span class="section-subtitle">Why Choose Marsorbit?</span>
                <h2 class="section-title">The Marsorbit Advantage</h2>
            </div>
            
            <div class="feature-list">
                <div class="feature-item">
                    <i class="fas fa-rocket"></i>
                    <h4>One Stop Solution</h4>
                    <p>From development to marketing, we offer a complete bouquet of services to handle every aspect of your digital presence.</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-globe"></i>
                    <h4>Worldwide Distribution</h4>
                    <p>We connect clients directly with decision-makers globally, eliminating hierarchy and ensuring instant solutions.</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-users"></i>
                    <h4>Our Culture</h4>
                    <p>An energetic, innovative environment where our client-centric team invests in creating positive business impacts.</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-chart-line"></i>
                    <h4>Proven Results</h4>
                    <p>Collaborations with Google and a decade of experience ensure we deliver effective business solutions.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="testimonials" class="section-padding">
        <div class="container">
            <div class="heading-wrapper">
                <h2 class="section-title">What Our Clients Say</h2>
            </div>
            
            <div class="testimonial-container">
                <i class="fas fa-quote-left" style="font-size: 2rem; color: var(--accent-color); margin-bottom: 20px;"></i>
                <div id="testimonial-text" class="testimonial-text">"Marsorbit Entertainment has the expertise to manage celebrity accounts with respect to their profiles across the digital platforms. Best celebrity management company in India."</div>
                <div id="testimonial-author" class="client-name">- Khesari Lal Yadav</div>
                
                <div class="testimonial-nav">
                    <button onclick="prevSlide()"><i class="fas fa-chevron-left"></i></button>
                    <button onclick="nextSlide()"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </div>
    </section>

    <footer id="contact">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <div class="logo" style="margin-bottom: 20px;">Mars<span>orbit</span></div>
                    <p style="color: var(--text-gray); font-size: 0.9rem;">
                        A leading Digital Distribution & content monetisation company delivering effective business solutions worldwide.
                    </p>
                </div>

                <div class="footer-col">
                    <h4>Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="#">Home</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#testimonials">Testimonials</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Services</h4>
                    <ul class="footer-links">
                        <li><a href="#">Channel Management</a></li>
                        <li><a href="#">Audio Streaming</a></li>
                        <li><a href="#">Brand Promotion</a></li>
                        <li><a href="#">App Development</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Contact Us</h4>
                    <ul class="contact-info">
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <span>70/555, Motilal Nagar 3, M.G. Road, Goregaon West, Mumbai - 400104</span>
                        </li>
                        <li>
                            <i class="fas fa-phone-alt"></i>
                            <span>+91 92609 14094</span>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <span>info@marsentertainment.co.in</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="copyright">
                <p>&copy; 2016 - 2024 Marsorbit Entertainment. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile Menu Toggle
        const mobileToggle = document.getElementById('mobile-toggle');
        const navMenu = document.getElementById('nav-menu');

        mobileToggle.addEventListener('click', () => {
            navMenu.classList.toggle('active');
            const icon = mobileToggle.querySelector('i');
            if (navMenu.classList.contains('active')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });

        // Simple Testimonial Slider
        const testimonials = [
            { text: "Marsorbit Entertainment has the expertise to manage celebrity accounts with respect to their profiles. Best celebrity management company in India.", author: "Khesari Lal Yadav" },
            { text: "Best Services provided for our digital growth. Highly professional team.", author: "Pramod Premi Yadav" },
            { text: "Great Work and amazing support for content creators.", author: "Ritesh Pandey" }
        ];

        let currentSlide = 0;
        const textEl = document.getElementById('testimonial-text');
        const authorEl = document.getElementById('testimonial-author');

        function updateSlide() {
            textEl.style.opacity = 0;
            setTimeout(() => {
                textEl.innerText = `"${testimonials[currentSlide].text}"`;
                authorEl.innerText = `- ${testimonials[currentSlide].author}`;
                textEl.style.opacity = 1;
            }, 300);
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % testimonials.length;
            updateSlide();
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + testimonials.length) % testimonials.length;
            updateSlide();
        }

        // Sticky Header Effect
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            header.classList.toggle('scrolled', window.scrollY > 50);
        });
    </script>
</body>
</html>