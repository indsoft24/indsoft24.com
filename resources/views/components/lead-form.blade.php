<!-- Lead Form Modal -->
<div class="modal fade" id="leadFormModal" tabindex="-1" aria-labelledby="leadFormModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="leadFormModalLabel">
                    <i class="fas fa-paper-plane me-2"></i>Get Started Today
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted mb-3">Fill out the form below and we'll get back to you as soon as possible.</p>
                
                <form id="leadFormModalForm" action="{{ route('leads.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="source" value="cms">
                    <input type="hidden" name="website" value="" class="honeypot">
                    
                    <div class="mb-3">
                        <label for="lead_modal_name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="lead_modal_name" name="name" 
                               value="{{ old('name') }}" 
                               required 
                               pattern="[a-zA-Z\s]+"
                               placeholder="Enter your full name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="lead_modal_phone" class="form-label">Phone <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                               id="lead_modal_phone" name="phone" 
                               value="{{ old('phone') }}" 
                               required 
                               pattern="[0-9\+\-\s\(\)]+"
                               placeholder="Enter your phone number">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="lead_modal_email" class="form-label">Email (Optional)</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="lead_modal_email" name="email" 
                               value="{{ old('email') }}" 
                               placeholder="Enter your email address">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="lead_modal_service" class="form-label">Service <span class="text-danger">*</span></label>
                        <select class="form-select @error('service') is-invalid @enderror" 
                                id="lead_modal_service" name="service" required>
                            <option value="">Select a service</option>
                            <option value="web development" {{ old('service') == 'web development' ? 'selected' : '' }}>Web Development</option>
                            <option value="app development" {{ old('service') == 'app development' ? 'selected' : '' }}>App Development</option>
                            <option value="custom software" {{ old('service') == 'custom software' ? 'selected' : '' }}>Custom Software</option>
                            <option value="digital marketing" {{ old('service') == 'digital marketing' ? 'selected' : '' }}>Digital Marketing</option>
                            <option value="digital stores" {{ old('service') == 'digital stores' ? 'selected' : '' }}>Digital Stores</option>
                        </select>
                        @error('service')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="lead_modal_message" class="form-label">Message (Optional)</label>
                        <textarea class="form-control @error('message') is-invalid @enderror" 
                                  id="lead_modal_message" name="message" 
                                  rows="3" 
                                  placeholder="Tell us about your project...">{{ old('message') }}</textarea>
                        @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div id="leadFormModalMessage" class="alert d-none mb-3"></div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary" id="leadFormModalSubmit">
                            <i class="fas fa-paper-plane me-2"></i>Submit Request
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
<div class="card shadow-sm mb-4" id="leadFormCard">
    <div class="card-header bg-primary text-white">
        <h5 class="card-title mb-0">
            <i class="fas fa-paper-plane me-2"></i>Get Started Today
        </h5>
    </div>
    <div class="card-body">
        <p class="text-muted mb-3">Fill out the form below and we'll get back to you as soon as possible.</p>
        
        <form id="leadForm" action="{{ route('leads.store') }}" method="POST">
            @csrf
            <input type="hidden" name="source" value="cms">
            <input type="hidden" name="website" value="" class="honeypot">
            
            <div class="mb-3">
                <label for="lead_name" class="form-label">Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       id="lead_name" name="name" 
                       value="{{ old('name') }}" 
                       required 
                       pattern="[a-zA-Z\s]+"
                       placeholder="Enter your full name">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="lead_phone" class="form-label">Phone <span class="text-danger">*</span></label>
                <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                       id="lead_phone" name="phone" 
                       value="{{ old('phone') }}" 
                       required 
                       pattern="[0-9\+\-\s\(\)]+"
                       placeholder="Enter your phone number">
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="lead_email" class="form-label">Email (Optional)</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                       id="lead_email" name="email" 
                       value="{{ old('email') }}" 
                       placeholder="Enter your email address">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="lead_service" class="form-label">Service <span class="text-danger">*</span></label>
                <select class="form-select @error('service') is-invalid @enderror" 
                        id="lead_service" name="service" required>
                    <option value="">Select a service</option>
                    <option value="web development" {{ old('service') == 'web development' ? 'selected' : '' }}>Web Development</option>
                    <option value="app development" {{ old('service') == 'app development' ? 'selected' : '' }}>App Development</option>
                    <option value="custom software" {{ old('service') == 'custom software' ? 'selected' : '' }}>Custom Software</option>
                    <option value="digital marketing" {{ old('service') == 'digital marketing' ? 'selected' : '' }}>Digital Marketing</option>
                    <option value="digital stores" {{ old('service') == 'digital stores' ? 'selected' : '' }}>Digital Stores</option>
                </select>
                @error('service')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="lead_message" class="form-label">Message (Optional)</label>
                <textarea class="form-control @error('message') is-invalid @enderror" 
                          id="lead_message" name="message" 
                          rows="3" 
                          placeholder="Tell us about your project...">{{ old('message') }}</textarea>
                @error('message')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div id="leadFormMessage" class="alert d-none mb-3"></div>

            <button type="submit" class="btn btn-primary w-100" id="leadFormSubmit">
                <i class="fas fa-paper-plane me-2"></i>Submit Request
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
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
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
                    messageDiv.className = 'alert alert-success mb-3';
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
                    messageDiv.className = 'alert alert-danger mb-3';
                    messageDiv.textContent = data.message || 'Something went wrong. Please try again.';
                    messageDiv.classList.remove('d-none');
                    
                    // Show validation errors if any
                    if (data.errors) {
                        let errorText = data.message + '<ul class="mb-0 mt-2">';
                        for (let field in data.errors) {
                            errorText += '<li>' + data.errors[field][0] + '</li>';
                        }
                        errorText += '</ul>';
                        messageDiv.innerHTML = errorText;
                    }
                }
            })
            .catch(error => {
                messageDiv.className = 'alert alert-danger mb-3';
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
    const leadModal = document.getElementById('leadFormModal');
    
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

