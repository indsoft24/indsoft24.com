@extends('layouts.app')

@section('title', 'Verify Email - Indsoft24.com')

@section('content')
<div class="verification-container">
    <div class="verification-card">
        <div class="verification-header">
            <div class="verification-icon">
                <i class="fas fa-envelope-open"></i>
            </div>
            <h1>Verify Your Email Address</h1>
            <p>We've sent a verification link to your email address</p>
        </div>
        
        <div class="verification-content">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
            @endif
            
            <div class="verification-info">
                <h3>What's next?</h3>
                <ol>
                    <li>Check your email inbox (and spam folder)</li>
                    <li>Click the verification link in the email</li>
                    <li>Your account will be activated automatically</li>
                </ol>
            </div>
            
            <div class="verification-actions">
                <form method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i>
                        Resend Verification Email
                    </button>
                </form>
                
                <a href="{{ route('home') }}" class="btn btn-secondary">
                    <i class="fas fa-home"></i>
                    Back to Home
                </a>
            </div>
            
            <div class="verification-help">
                <h4>Need help?</h4>
                <p>If you're having trouble receiving the email, please:</p>
                <ul>
                    <li>Check your spam/junk folder</li>
                    <li>Make sure the email address is correct</li>
                    <li>Wait a few minutes and try again</li>
                    <li>Contact our support team if the problem persists</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
.verification-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.verification-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
    overflow: hidden;
    max-width: 500px;
    width: 100%;
}

.verification-header {
    background: linear-gradient(135deg, #3498db, #2ecc71);
    color: white;
    padding: 40px 30px;
    text-align: center;
}

.verification-icon {
    width: 80px;
    height: 80px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 2rem;
}

.verification-header h1 {
    margin: 0 0 10px;
    font-size: 2rem;
    font-weight: 700;
}

.verification-header p {
    margin: 0;
    opacity: 0.9;
    font-size: 1.1rem;
}

.verification-content {
    padding: 40px 30px;
}

.alert {
    padding: 15px 20px;
    border-radius: 10px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: 500;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-error {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.verification-info {
    margin: 30px 0;
}

.verification-info h3 {
    color: #2c3e50;
    margin-bottom: 15px;
    font-size: 1.3rem;
}

.verification-info ol {
    color: #666;
    line-height: 1.8;
    padding-left: 20px;
}

.verification-info li {
    margin-bottom: 8px;
}

.verification-actions {
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin: 30px 0;
}

.btn {
    padding: 15px 25px;
    border: none;
    border-radius: 50px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    text-align: center;
}

.btn-primary {
    background: linear-gradient(135deg, #3498db, #2ecc71);
    color: white;
    box-shadow: 0 8px 25px rgba(52, 152, 219, 0.3);
}

.btn-primary:hover {
    background: linear-gradient(135deg, #2980b9, #27ae60);
    transform: translateY(-2px);
    box-shadow: 0 12px 35px rgba(52, 152, 219, 0.4);
}

.btn-secondary {
    background: transparent;
    color: #666;
    border: 2px solid #e9ecef;
}

.btn-secondary:hover {
    background: #f8f9fa;
    border-color: #3498db;
    color: #3498db;
}

.verification-help {
    background: #f8f9fa;
    padding: 25px;
    border-radius: 15px;
    margin-top: 30px;
}

.verification-help h4 {
    color: #2c3e50;
    margin-bottom: 15px;
    font-size: 1.1rem;
}

.verification-help p {
    color: #666;
    margin-bottom: 15px;
}

.verification-help ul {
    color: #666;
    line-height: 1.6;
    padding-left: 20px;
}

.verification-help li {
    margin-bottom: 5px;
}

@media (max-width: 480px) {
    .verification-container {
        padding: 10px;
    }
    
    .verification-header {
        padding: 30px 20px;
    }
    
    .verification-content {
        padding: 30px 20px;
    }
    
    .verification-header h1 {
        font-size: 1.5rem;
    }
    
    .verification-icon {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
    }
}
</style>
@endsection
