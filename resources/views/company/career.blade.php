@extends('layouts.app')

@section('title', 'Careers at IndSoft24 - Join Our Team')

@section('content')
<section class="bg-light py-5" style="margin-top:50px">
    <div class="container text-center">
        <h1 class="fw-bold display-5 mb-3">Careers at <span class="text-primary">IndSoft24</span></h1>
        <p class="lead text-muted">
            We are more than just a software company — we are a family of innovators, problem-solvers, and dreamers who love building technology that makes life easier.  
            If you are passionate about technology, growth, and creativity, we’d love to have you on our team.
        </p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-4">Why Work With Us?</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <i class="bi bi-lightbulb-fill text-warning display-4 mb-3"></i>
                        <h5 class="fw-bold">Innovative Projects</h5>
                        <p class="text-muted">Work on cutting-edge technologies in web, mobile, and software development with clients across the globe.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <i class="bi bi-people-fill text-primary display-4 mb-3"></i>
                        <h5 class="fw-bold">Collaborative Culture</h5>
                        <p class="text-muted">Join a friendly, open, and supportive work environment where teamwork and creativity thrive.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <i class="bi bi-bar-chart-line-fill text-success display-4 mb-3"></i>
                        <h5 class="fw-bold">Growth Opportunities</h5>
                        <p class="text-muted">We value your career journey. Get mentorship, skill-building opportunities, and leadership pathways.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-light py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-4">Open Positions</h2>
        <div class="row g-4">
            <!-- Job 1 -->
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h4 class="fw-bold">Frontend Developer (React / Vue)</h4>
                        <p class="text-muted">We’re looking for a creative frontend developer with expertise in React.js or Vue.js to build stunning user experiences.</p>
                        <ul class="text-muted">
                            <li>2+ years of experience</li>
                            <li>Strong in JavaScript, HTML, CSS</li>
                            <li>Good understanding of REST APIs</li>
                        </ul>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#applyModal">Apply Now</button>
                    </div>
                </div>
            </div>
            <!-- Job 2 -->
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h4 class="fw-bold">Backend Developer (Laravel / Node.js)</h4>
                        <p class="text-muted">Looking for a problem solver who loves building robust backends and working with databases.</p>
                        <ul class="text-muted">
                            <li>2+ years of experience</li>
                            <li>Proficiency in Laravel or Node.js</li>
                            <li>Strong SQL/NoSQL knowledge</li>
                        </ul>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#applyModal">Apply Now</button>
                    </div>
                </div>
            </div>
            <!-- Job 3 -->
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h4 class="fw-bold">Mobile App Developer (Flutter / React Native)</h4>
                        <p class="text-muted">We need a passionate mobile developer to build cross-platform apps with intuitive user experiences.</p>
                        <ul class="text-muted">
                            <li>1–3 years of experience</li>
                            <li>Hands-on with Flutter / React Native</li>
                            <li>Knowledge of publishing apps on Play Store & App Store</li>
                        </ul>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#applyModal">Apply Now</button>
                    </div>
                </div>
            </div>
            <!-- Job 4 -->
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h4 class="fw-bold">Content Writer / Blogger</h4>
                        <p class="text-muted">We’re seeking a storyteller who can create engaging blogs, articles, and tech content for our audience.</p>
                        <ul class="text-muted">
                            <li>Excellent writing & editing skills</li>
                            <li>Tech background preferred but not mandatory</li>
                            <li>SEO knowledge is a plus</li>
                        </ul>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#applyModal">Apply Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Application Modal -->
<div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="applyModalLabel">Apply for a Position</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="careerForm" action="{{ route('career.apply') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Position</label>
                        <select name="position" class="form-select" required>
                            <option value="" disabled selected>Select Position</option>
                            <option>Frontend Developer</option>
                            <option>Backend Developer</option>
                            <option>Mobile App Developer</option>
                            <option>Content Writer / Blogger</option>
                            <option>Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Upload Resume (PDF/DOC)</label>
                        <input type="file" name="resume" class="form-control" accept=".pdf,.doc,.docx" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Message / Cover Letter</label>
                        <textarea name="message" class="form-control" rows="4" placeholder="Tell us why you’d be a great fit..."></textarea>
                    </div>
                </div>
                 <div class="modal-footer">
        <button type="submit" id="careerSubmitBtn" class="btn btn-primary">Submit Application</button>
    </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const careerForm = document.getElementById("careerForm");
    const submitBtn = document.getElementById("careerSubmitBtn");

    careerForm.addEventListener("submit", function (e) {
        e.preventDefault();

        let formData = new FormData(careerForm);

        submitBtn.disabled = true;
        submitBtn.textContent = "Submitting...";

        fetch(careerForm.action, {
            method: "POST",
            body: formData,
            headers: { "X-Requested-With": "XMLHttpRequest" }
        })
        .then(response => response.json())
        .then(data => {
            toastr[data.success ? "success" : "error"](data.message || "Something went wrong.");
            if (data.success) {
                careerForm.reset();
                let modal = bootstrap.Modal.getInstance(document.getElementById('applyModal'));
                modal.hide();
            }
        })
        .catch(() => {
            toastr.error("An error occurred. Please try again.");
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.textContent = "Submit Application";
        });
    });
});
</script>
@endpush

