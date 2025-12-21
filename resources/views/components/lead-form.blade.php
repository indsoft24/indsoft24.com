<!-- Lead Form Modal -->
<div class="modal fade" id="leadFormModal" tabindex="-1" aria-labelledby="leadFormModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered compact-lead-modal">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white compact-modal-header">
                <h5 class="modal-title mb-0 fw-semibold" id="leadFormModalLabel" style="font-size: 1rem;">
                    <i class="fas fa-paper-plane me-2"></i>Get Started
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body compact-modal-body">
                <p class="text-muted mb-3" style="font-size: 0.875rem;">Fill out the form below and we'll get back to you soon.</p>
                
                <form id="leadFormModalForm" action="{{ route('leads.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="source" value="cms">
                    <input type="hidden" name="website" value="" class="honeypot">
                    
                    <div class="mb-3">
                        <label for="lead_modal_name" class="form-label small fw-semibold mb-1">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="lead_modal_name" name="name" 
                               value="{{ old('name') }}" 
                               required 
                               pattern="[a-zA-Z\s]+"
                               placeholder="Full name">
                        @error('name')
                            <div class="invalid-feedback small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="lead_modal_phone" class="form-label small fw-semibold mb-1">Phone <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                               id="lead_modal_phone" name="phone" 
                               value="{{ old('phone') }}" 
                               required 
                               pattern="[0-9\+\-\s\(\)]+"
                               placeholder="Phone number">
                        @error('phone')
                            <div class="invalid-feedback small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="lead_modal_email" class="form-label small fw-semibold mb-1">Email <span class="text-muted small">(Optional)</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="lead_modal_email" name="email" 
                               value="{{ old('email') }}" 
                               placeholder="Email address">
                        @error('email')
                            <div class="invalid-feedback small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="lead_modal_service" class="form-label small fw-semibold mb-1">Service <span class="text-danger">*</span></label>
                        <select class="form-select @error('service') is-invalid @enderror" 
                                id="lead_modal_service" name="service" required>
                            <option value="">Select service</option>
                            <option value="web development" {{ old('service') == 'web development' ? 'selected' : '' }}>Web Development</option>
                            <option value="app development" {{ old('service') == 'app development' ? 'selected' : '' }}>App Development</option>
                            <option value="custom software" {{ old('service') == 'custom software' ? 'selected' : '' }}>Custom Software</option>
                            <option value="digital marketing" {{ old('service') == 'digital marketing' ? 'selected' : '' }}>Digital Marketing</option>
                            <option value="digital stores" {{ old('service') == 'digital stores' ? 'selected' : '' }}>Digital Stores</option>
                        </select>
                        @error('service')
                            <div class="invalid-feedback small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="lead_modal_message" class="form-label small fw-semibold mb-1">Message <span class="text-muted small">(Optional)</span></label>
                        <textarea class="form-control @error('message') is-invalid @enderror" 
                                  id="lead_modal_message" name="message" 
                                  rows="2" 
                                  placeholder="Tell us about your project...">{{ old('message') }}</textarea>
                        @error('message')
                            <div class="invalid-feedback small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div id="leadFormModalMessage" class="alert d-none mb-3 small"></div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary fw-semibold" id="leadFormModalSubmit">
                            <i class="fas fa-paper-plane me-1"></i>Submit
                        </button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Maybe Later
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Inline Lead Form Card -->
<div class="card shadow-sm mb-4 compact-lead-card" id="leadFormCard">
    <div class="card-header bg-primary text-white compact-card-header">
        <h5 class="card-title mb-0 fw-semibold" style="font-size: 1rem;">
            <i class="fas fa-paper-plane me-2"></i>Get Started
        </h5>
    </div>
    <div class="card-body compact-card-body">
        <p class="text-muted mb-3" style="font-size: 0.875rem;">Fill out the form below and we'll get back to you soon.</p>
        
        <form id="leadForm" action="{{ route('leads.store') }}" method="POST">
            @csrf
            <input type="hidden" name="source" value="cms">
            <input type="hidden" name="website" value="" class="honeypot">
            
            <div class="mb-3">
                <label for="lead_name" class="form-label small fw-semibold mb-1">Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       id="lead_name" name="name" 
                       value="{{ old('name') }}" 
                       required 
                       pattern="[a-zA-Z\s]+"
                       placeholder="Full name">
                @error('name')
                    <div class="invalid-feedback small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="lead_phone" class="form-label small fw-semibold mb-1">Phone <span class="text-danger">*</span></label>
                <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                       id="lead_phone" name="phone" 
                       value="{{ old('phone') }}" 
                       required 
                       pattern="[0-9\+\-\s\(\)]+"
                       placeholder="Phone number">
                @error('phone')
                    <div class="invalid-feedback small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="lead_email" class="form-label small fw-semibold mb-1">Email <span class="text-muted small">(Optional)</span></label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                       id="lead_email" name="email" 
                       value="{{ old('email') }}" 
                       placeholder="Email address">
                @error('email')
                    <div class="invalid-feedback small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="lead_service" class="form-label small fw-semibold mb-1">Service <span class="text-danger">*</span></label>
                <select class="form-select @error('service') is-invalid @enderror" 
                        id="lead_service" name="service" required>
                    <option value="">Select service</option>
                    <option value="web development" {{ old('service') == 'web development' ? 'selected' : '' }}>Web Development</option>
                    <option value="app development" {{ old('service') == 'app development' ? 'selected' : '' }}>App Development</option>
                    <option value="custom software" {{ old('service') == 'custom software' ? 'selected' : '' }}>Custom Software</option>
                    <option value="digital marketing" {{ old('service') == 'digital marketing' ? 'selected' : '' }}>Digital Marketing</option>
                    <option value="digital stores" {{ old('service') == 'digital stores' ? 'selected' : '' }}>Digital Stores</option>
                </select>
                @error('service')
                    <div class="invalid-feedback small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="lead_message" class="form-label small fw-semibold mb-1">Message <span class="text-muted small">(Optional)</span></label>
                <textarea class="form-control @error('message') is-invalid @enderror" 
                          id="lead_message" name="message" 
                          rows="2" 
                          placeholder="Tell us about your project...">{{ old('message') }}</textarea>
                @error('message')
                    <div class="invalid-feedback small">{{ $message }}</div>
                @enderror
            </div>

            <div id="leadFormMessage" class="alert d-none mb-3 small"></div>

            <button type="submit" class="btn btn-primary w-100 fw-semibold" id="leadFormSubmit">
                <i class="fas fa-paper-plane me-1"></i>Submit
            </button>
        </form>
    </div>
</div>

<style>
    .honeypot {
        position: absolute;
        left: -9999px;
        opacity: 0;
        pointer-events: none;
    }

    /* Compact Lead Form Modal Styles */
    .compact-lead-modal .modal-dialog {
        max-width: 550px;
        margin: 1rem auto;
    }

    .compact-lead-modal .modal-content {
        max-height: 90vh;
        overflow-y: auto;
        border-radius: 8px;
        /* Hide scrollbar but keep scrolling functionality */
        scrollbar-width: none; /* Firefox */
        -ms-overflow-style: none; /* IE and Edge */
    }

    .compact-lead-modal .modal-content::-webkit-scrollbar {
        display: none; /* Chrome, Safari, Opera */
    }

    .compact-modal-header {
        padding: 0.75rem 1.25rem;
    }

    .compact-modal-header .modal-title {
        font-size: 1rem;
    }

    .compact-modal-body {
        padding: 1.25rem;
        font-size: 0.9rem;
    }

    .compact-modal-body .form-label {
        font-size: 0.85rem;
        margin-bottom: 0.4rem;
    }

    .compact-modal-body .form-control,
    .compact-modal-body .form-select {
        font-size: 0.9rem;
        padding: 0.5rem 0.75rem;
        line-height: 1.5;
    }

    .compact-modal-body .btn {
        font-size: 0.9rem;
        padding: 0.5rem 0.75rem;
    }

    .compact-modal-body .btn:not(.btn-sm) {
        padding: 0.5rem 1rem;
    }

    .compact-modal-body textarea {
        resize: vertical;
        min-height: 70px;
    }

    .compact-modal-body .alert {
        padding: 0.6rem 0.75rem;
        font-size: 0.85rem;
        margin-bottom: 0.75rem;
    }

    /* Compact Inline Card Styles */
    .compact-lead-card .compact-card-header {
        padding: 0.75rem 1.25rem;
    }

    .compact-lead-card .compact-card-header .card-title {
        font-size: 1rem;
    }

    .compact-card-body {
        padding: 1.25rem;
        font-size: 0.9rem;
    }

    .compact-card-body .form-label {
        font-size: 0.85rem;
        margin-bottom: 0.4rem;
    }

    .compact-card-body .form-control,
    .compact-card-body .form-select {
        font-size: 0.9rem;
        padding: 0.5rem 0.75rem;
        line-height: 1.5;
    }

    .compact-card-body .btn {
        font-size: 0.9rem;
        padding: 0.5rem 0.75rem;
    }

    .compact-card-body .btn:not(.btn-sm) {
        padding: 0.5rem 1rem;
    }

    .compact-card-body textarea {
        resize: vertical;
        min-height: 70px;
    }

    .compact-card-body .alert {
        padding: 0.6rem 0.75rem;
        font-size: 0.85rem;
        margin-bottom: 0.75rem;
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
        .compact-lead-modal .modal-dialog {
            max-width: 95%;
            margin: 0.5rem auto;
        }

        .compact-modal-body,
        .compact-card-body {
            padding: 0.75rem;
        }
    }

    /* Ensure modal doesn't exceed viewport height */
    @media (max-height: 700px) {
        .compact-lead-modal .modal-content {
            max-height: 85vh;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Ensure modal sits directly under <body> so Bootstrap z-index behaves consistently
    let leadModal = document.getElementById('leadFormModal');
    if (leadModal && leadModal.parentElement !== document.body) {
        document.body.appendChild(leadModal);
    }

    // Common form submission handler
    function handleFormSubmit(form, submitBtn, messageDiv, modal = null) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Disable submit button
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Submitting...';
            
            // Hide previous messages
            messageDiv.classList.add('d-none');
            
            // Get form data
            const formData = new FormData(form);
            
            // Submit via AJAX
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    messageDiv.className = 'alert alert-success mb-3 small';
                    messageDiv.textContent = data.message || 'Thank you! We will contact you soon.';
                    messageDiv.classList.remove('d-none');
                    
                    // Reset form
                    form.reset();
                    
                    // If modal, close it after 2 seconds
                    if (modal) {
                        setTimeout(() => {
                            const bsModal = bootstrap.Modal.getInstance(modal);
                            if (bsModal) {
                                bsModal.hide();
                            }
                        }, 2000);
                    } else {
                        // Scroll to message for inline form
                        messageDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    }
                } else {
                    messageDiv.className = 'alert alert-danger mb-3 small';
                    messageDiv.textContent = data.message || 'Something went wrong. Please try again.';
                    messageDiv.classList.remove('d-none');
                    
                    // Show validation errors if any
                    if (data.errors) {
                        let errorText = data.message + '<ul class="mb-0 mt-2 small">';
                        for (let field in data.errors) {
                            errorText += '<li>' + data.errors[field][0] + '</li>';
                        }
                        errorText += '</ul>';
                        messageDiv.innerHTML = errorText;
                    }
                }
            })
            .catch(error => {
                messageDiv.className = 'alert alert-danger mb-3 small';
                messageDiv.textContent = 'An error occurred. Please try again later.';
                messageDiv.classList.remove('d-none');
            })
            .finally(() => {
                // Re-enable submit button
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Submit Request';
            });
        });
    }
    
    // Handle inline form
    const form = document.getElementById('leadForm');
    const submitBtn = document.getElementById('leadFormSubmit');
    const messageDiv = document.getElementById('leadFormMessage');
    
    if (form && submitBtn && messageDiv) {
        handleFormSubmit(form, submitBtn, messageDiv);
    }
    
    // Handle modal form
    const modalForm = document.getElementById('leadFormModalForm');
    const modalSubmitBtn = document.getElementById('leadFormModalSubmit');
    const modalMessageDiv = document.getElementById('leadFormModalMessage');
    leadModal = document.getElementById('leadFormModal');
    
    if (modalForm && modalSubmitBtn && modalMessageDiv) {
        handleFormSubmit(modalForm, modalSubmitBtn, modalMessageDiv, leadModal);
    }
    
    // Auto-popup modal after page load (only on CMS pages)
    // Shows on every page refresh
    if (window.location.pathname.startsWith('/cms/') && leadModal) {
        // Wait 2 seconds after page load before showing modal
        setTimeout(function() {
            try {
                const bsModal = new bootstrap.Modal(leadModal, {
                    backdrop: 'static',
                    keyboard: false
                });
                bsModal.show();
            } catch (error) {
                console.error('Error showing lead form modal:', error);
            }
        }, 2000); // 2 seconds delay
    }
});
</script>

