<section class="blog-cta-section py-5 my-5 position-relative overflow-hidden">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="cta-content">
                    <div class="cta-badge mb-3 animate-fade-in">
                        <span class="badge bg-warning text-dark px-3 py-2">
                            <i class="fas fa-gift me-2"></i>100% Free to Start
                        </span>
                    </div>
                    <h2 class="cta-title mb-4 animate-slide-up">
                        <i class="fas fa-pen-fancy text-primary me-3"></i>
                        Write Your Blog & Earn Money on Indsoft24
                    </h2>
                    <p class="cta-description lead mb-4 animate-fade-in-delay">
                        Share your thoughts, expertise, and stories with thousands of readers. 
                        Start blogging for free and monetize your content. Join our community of writers today!
                    </p>
                    
                    <div class="cta-features mb-4 animate-slide-up-delay">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="feature-item d-flex align-items-center">
                                    <div class="feature-icon me-3">
                                        <i class="fas fa-check-circle text-success"></i>
                                    </div>
                                    <span class="text-dark">Free to Post</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="feature-item d-flex align-items-center">
                                    <div class="feature-icon me-3">
                                        <i class="fas fa-dollar-sign text-success"></i>
                                    </div>
                                    <span class="text-dark">Earn Money</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="feature-item d-flex align-items-center">
                                    <div class="feature-icon me-3">
                                        <i class="fas fa-users text-primary"></i>
                                    </div>
                                    <span class="text-dark">Large Audience</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="feature-item d-flex align-items-center">
                                    <div class="feature-icon me-3">
                                        <i class="fas fa-chart-line text-info"></i>
                                    </div>
                                    <span class="text-dark">Track Performance</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Step-by-Step Instructions -->
                    <div class="cta-steps animate-fade-in-delay-2">
                        <h4 class="mb-4 text-dark">
                            <i class="fas fa-list-ol text-primary me-2"></i>How to Get Started:
                        </h4>
                        <div class="steps-container">
                            <div class="step-item mb-3">
                                <div class="step-number">1</div>
                                <div class="step-content">
                                    <h6 class="mb-1 text-dark">
                                        <i class="fab fa-google text-danger me-2"></i>Login with Google (One Click)
                                    </h6>
                                    <p class="text-muted mb-0 small">Click the Google login button to instantly access your account</p>
                                </div>
                            </div>
                            <div class="step-item mb-3">
                                <div class="step-number">2</div>
                                <div class="step-content">
                                    <h6 class="mb-1 text-dark">
                                        <i class="fas fa-folder-open text-primary me-2"></i>Go to "My Blog" Section
                                    </h6>
                                    <p class="text-muted mb-0 small">Navigate to the "My Blog" section from the menu</p>
                                </div>
                            </div>
                            <div class="step-item mb-3">
                                <div class="step-number">3</div>
                                <div class="step-content">
                                    <h6 class="mb-1 text-dark">
                                        <i class="fas fa-edit text-success me-2"></i>Create Your Blog Easily
                                    </h6>
                                    <p class="text-muted mb-0 small">Click "Create" and start writing your first blog post</p>
                                </div>
                            </div>
                            <div class="step-item mb-4">
                                <div class="step-number">4</div>
                                <div class="step-content">
                                    <h6 class="mb-1 text-dark">
                                        <i class="fas fa-eye text-info me-2"></i>See Your Own Blog
                                    </h6>
                                    <p class="text-muted mb-0 small">View and manage all your published blogs in one place</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="cta-buttons">
                            @auth
                                <a href="{{ route('user.blog.create') }}" class="btn btn-primary btn-lg me-3 mb-2 mb-md-0 cta-btn-primary">
                                    <i class="fas fa-plus-circle me-2"></i>Start Writing Now
                                </a>
                                <a href="{{ route('user.blog.index') }}" class="btn btn-outline-primary btn-lg mb-2 mb-md-0">
                                    <i class="fas fa-book me-2"></i>My Blogs
                                </a>
                            @else
                                <a href="{{ route('auth.google') }}" class="btn btn-primary btn-lg me-3 mb-2 mb-md-0 cta-btn-primary">
                                    <i class="fab fa-google me-2"></i>Login with Google
                                </a>
                                <a href="{{ route('blog.index') }}" class="btn btn-outline-primary btn-lg mb-2 mb-md-0">
                                    <i class="fas fa-eye me-2"></i>View Blogs
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="cta-visual animate-float">
                    <div class="cta-card-wrapper position-relative">
                        <div class="cta-card-main shadow-lg">
                            <div class="card-header-gradient">
                                <i class="fas fa-blog fa-3x text-white"></i>
                            </div>
                            <div class="card-body p-4">
                                <h5 class="text-dark mb-4">Simple Steps to Success</h5>
                                <div class="quick-steps">
                                    <div class="quick-step-item d-flex align-items-center mb-3">
                                        <div class="quick-step-icon me-3">
                                            <i class="fab fa-google text-danger"></i>
                                        </div>
                                        <div class="quick-step-text">
                                            <strong class="text-dark">Login</strong>
                                            <small class="text-muted d-block">One Click</small>
                                        </div>
                                    </div>
                                    <div class="quick-step-item d-flex align-items-center mb-3">
                                        <div class="quick-step-icon me-3">
                                            <i class="fas fa-folder text-primary"></i>
                                        </div>
                                        <div class="quick-step-text">
                                            <strong class="text-dark">My Blog</strong>
                                            <small class="text-muted d-block">Navigate</small>
                                        </div>
                                    </div>
                                    <div class="quick-step-item d-flex align-items-center mb-3">
                                        <div class="quick-step-icon me-3">
                                            <i class="fas fa-edit text-success"></i>
                                        </div>
                                        <div class="quick-step-text">
                                            <strong class="text-dark">Create</strong>
                                            <small class="text-muted d-block">Write & Publish</small>
                                        </div>
                                    </div>
                                    <div class="quick-step-item d-flex align-items-center">
                                        <div class="quick-step-icon me-3">
                                            <i class="fas fa-chart-line text-info"></i>
                                        </div>
                                        <div class="quick-step-text">
                                            <strong class="text-dark">Earn</strong>
                                            <small class="text-muted d-block">Monetize Content</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Floating Elements -->
                        <div class="floating-icon floating-icon-1">
                            <i class="fas fa-coins text-warning"></i>
                        </div>
                        <div class="floating-icon floating-icon-2">
                            <i class="fas fa-heart text-danger"></i>
                        </div>
                        <div class="floating-icon floating-icon-3">
                            <i class="fas fa-star text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Animated Background Elements -->
    <div class="cta-bg-shapes">
        <div class="bg-shape bg-shape-1"></div>
        <div class="bg-shape bg-shape-2"></div>
        <div class="bg-shape bg-shape-3"></div>
    </div>
</section>

<style>
/* Blog CTA Section Styles */
.blog-cta-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 50%, #f8f9fa 100%);
    background-size: 200% 200%;
    animation: gradientShift 8s ease infinite;
    position: relative;
    border-radius: 20px;
    margin: 60px 0;
}

.blog-cta-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 30%, rgba(52, 152, 219, 0.08) 0%, transparent 50%),
        radial-gradient(circle at 80% 70%, rgba(46, 204, 113, 0.08) 0%, transparent 50%);
    border-radius: 20px;
    z-index: 0;
}

.blog-cta-section .container {
    position: relative;
    z-index: 1;
}

@keyframes gradientShift {
    0%, 100% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
}

/* CTA Content Animations */
.animate-fade-in {
    animation: fadeIn 0.8s ease-out;
}

.animate-slide-up {
    animation: slideUp 0.8s ease-out;
}

.animate-fade-in-delay {
    animation: fadeIn 1s ease-out 0.2s both;
}

.animate-slide-up-delay {
    animation: slideUp 1s ease-out 0.4s both;
}

.animate-fade-in-delay-2 {
    animation: fadeIn 1.2s ease-out 0.6s both;
}

.animate-float {
    animation: float 3s ease-in-out infinite;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-20px);
    }
}

/* CTA Title */
.cta-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2c3e50;
    line-height: 1.2;
}

@media (max-width: 768px) {
    .cta-title {
        font-size: 2rem;
    }
}

.cta-description {
    color: #6c757d;
    font-size: 1.1rem;
}

/* Feature Items */
.feature-item {
    padding: 10px;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.feature-item:hover {
    background: rgba(52, 152, 219, 0.1);
    transform: translateX(5px);
}

.feature-icon {
    font-size: 1.5rem;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(52, 152, 219, 0.1);
    border-radius: 50%;
}

/* CTA Buttons */
.cta-btn-primary {
    background: linear-gradient(135deg, #3498db, #2ecc71);
    border: none;
    padding: 12px 30px;
    font-weight: 600;
    box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.cta-btn-primary::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.5s;
}

.cta-btn-primary:hover::before {
    left: 100%;
}

.cta-btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
}

/* CTA Visual Card */
.cta-card-wrapper {
    perspective: 1000px;
}

.cta-card-main {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    transform-style: preserve-3d;
    transition: transform 0.3s ease;
}

.cta-card-main:hover {
    transform: rotateY(5deg) rotateX(5deg);
}

.card-header-gradient {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 30px;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.card-header-gradient::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, transparent 70%);
    animation: rotate 10s linear infinite;
}

@keyframes rotate {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

/* Quick Steps in Card */
.quick-steps {
    padding: 10px 0;
}

.quick-step-item {
    padding: 12px;
    border-radius: 10px;
    transition: all 0.3s ease;
    background: rgba(248, 249, 250, 0.5);
}

.quick-step-item:hover {
    background: rgba(52, 152, 219, 0.1);
    transform: translateX(5px);
}

.quick-step-icon {
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: white;
    border-radius: 50%;
    font-size: 1.3rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.quick-step-item:hover .quick-step-icon {
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.quick-step-text strong {
    display: block;
    font-size: 0.95rem;
    margin-bottom: 2px;
}

.quick-step-text small {
    font-size: 0.8rem;
}

/* Floating Icons */
.floating-icon {
    position: absolute;
    font-size: 2rem;
    opacity: 0.7;
    z-index: 2;
}

.floating-icon-1 {
    top: 10%;
    right: 10%;
    animation: floatIcon 4s ease-in-out infinite;
}

.floating-icon-2 {
    bottom: 20%;
    left: 5%;
    animation: floatIcon 5s ease-in-out infinite 0.5s;
}

.floating-icon-3 {
    top: 50%;
    right: 5%;
    animation: floatIcon 6s ease-in-out infinite 1s;
}

@keyframes floatIcon {
    0%, 100% {
        transform: translateY(0) rotate(0deg);
    }
    50% {
        transform: translateY(-20px) rotate(180deg);
    }
}

/* Background Shapes */
.cta-bg-shapes {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 0;
    overflow: hidden;
    border-radius: 20px;
}

.bg-shape {
    position: absolute;
    border-radius: 50%;
    opacity: 0.1;
    animation: pulse 4s ease-in-out infinite;
}

.bg-shape-1 {
    width: 200px;
    height: 200px;
    background: linear-gradient(135deg, #3498db, #2ecc71);
    top: -50px;
    left: -50px;
    animation-delay: 0s;
}

.bg-shape-2 {
    width: 150px;
    height: 150px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    bottom: -30px;
    right: -30px;
    animation-delay: 1s;
}

.bg-shape-3 {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, #f093fb, #f5576c);
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    animation-delay: 2s;
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
        opacity: 0.1;
    }
    50% {
        transform: scale(1.2);
        opacity: 0.2;
    }
}

/* Step-by-Step Instructions */
.cta-steps {
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
}

.steps-container {
    position: relative;
    padding-left: 20px;
}

.steps-container::before {
    content: '';
    position: absolute;
    left: 25px;
    top: 0;
    bottom: 0;
    width: 3px;
    background: linear-gradient(180deg, #3498db, #2ecc71);
    border-radius: 2px;
}

.step-item {
    display: flex;
    align-items: flex-start;
    position: relative;
    padding-left: 50px;
    transition: all 0.3s ease;
}

.step-item:hover {
    transform: translateX(5px);
}

.step-item:hover .step-number {
    transform: scale(1.1);
    box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
}

.step-number {
    position: absolute;
    left: 0;
    top: 0;
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #3498db, #2ecc71);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.1rem;
    box-shadow: 0 2px 10px rgba(52, 152, 219, 0.3);
    transition: all 0.3s ease;
    z-index: 2;
}

.step-content h6 {
    font-weight: 600;
    font-size: 1rem;
    margin-bottom: 5px;
}

.step-content p {
    font-size: 0.9rem;
    line-height: 1.5;
}

/* Responsive Design */
@media (max-width: 768px) {
    .blog-cta-section {
        margin: 40px 0;
        padding: 40px 0 !important;
    }
    
    .cta-title {
        font-size: 1.75rem;
    }
    
    .cta-steps {
        padding: 20px;
    }
    
    .step-item {
        padding-left: 45px;
    }
    
    .step-number {
        width: 35px;
        height: 35px;
        font-size: 1rem;
    }
    
    .cta-buttons {
        display: flex;
        flex-direction: column;
    }
    
    .cta-btn-primary {
        width: 100%;
        margin-right: 0 !important;
        margin-bottom: 10px;
    }
    
    .floating-icon {
        display: none;
    }
}
</style>

