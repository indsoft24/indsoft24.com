@extends('layouts.app')

@section('title', 'Verify Your Email')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4>Email Verification</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <p>We've sent a 6-digit OTP to <strong>{{ session('email_for_verification') }}</strong>. Please enter it below to complete your subscription.</p>

                    <form action="{{ route('newsletter.verify.otp') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="otp" class="form-label">Enter OTP</label>
                            <input type="text" class="form-control" name="otp" id="otp" required autofocus>
                        </div>
                        <button type="submit" class="btn btn-primary">Verify and Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection