@extends('layouts.app')

@push('styles')
<style>
/* Blog-specific styles */
body {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}

.navbar {
    background: rgba(255, 255, 255, 0.95) !important;
    backdrop-filter: blur(10px);
    box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
}

.footer {
    margin-top: 0 !important;
}
</style>
@endpush
