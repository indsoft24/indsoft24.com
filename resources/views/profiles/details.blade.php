<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Single File Portfolio</title>

<!-- Bootstrap cdn -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- font awesome cdn -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

    :root {
        --sidebar-width: 230px; /* Sidebar width */
    }

    body {
        font-family: Arial, sans-serif;
        overflow-x: hidden;
        background: #fff;
    }


    .typing-text span {
    opacity: 0;
    transform: translateY(20px);
    display: inline-block;
    animation: wordFade 0.7s ease forwards;
     }
     
     .typing-text span:nth-child(1) { animation-delay: 0.5s; }
     .typing-text span:nth-child(2) { animation-delay: 1s; }
     .typing-text span:nth-child(3) { animation-delay: 1.5s; }
     
     @keyframes wordFade {
         to {
             opacity: 1;
             transform: translateY(0);
         }
     }

    .sidebar-link {
        color: #fff;
        background: transparent;
        transition: all 0.3s ease;
    }
    
    .sidebar-link:hover,
    .sidebar-link.active {
        background-color: #0dcaf0 !important;
        color: #000 !important;
        padding-left: 25px;
    }
    
    .sidebar-link i {
        transition: transform 0.3s ease;
    }
    
    .sidebar-link:hover i,
    .sidebar-link.active i {
        transform: scale(1.2);
    }


    .section-title {
    font-size: 30px;
    margin-bottom: 10px;
    color: #0d1b2a;
    position: relative;
    }
    
    #about {
        padding-top: 60px;
      }
      
          /* About header */
      .about-header {
          display: flex;
          justify-content: space-between;
          align-items: center;
      }
      
      /* Contact Button */
      .contact-btn {
          padding: 8px 18px;
          background: #00c9ff;
          border: none;
          border-radius: 6px;
          font-weight: 600;
          cursor: pointer;
      }
      
      /* Popup overlay */
      .contact-popup {
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background: rgba(0,0,0,0.6);
          display: none;
          align-items: center;
          justify-content: center;
          z-index: 999;
      }
      
      /* Popup box */
      .popup-box {
          background: #fff;
          width: 400px;
          padding: 25px;
          border-radius: 10px;
          position: relative;
      }
      
      .popup-box form {
          display: flex;
          flex-direction: column;
          gap: 12px;
      }
      
      .popup-box input,
      .popup-box textarea {
          padding: 10px;
          border: 1px solid #ccc;
          border-radius: 6px;
      }
      
      /* Close button */
      .close-btn {
          position: absolute;
          top: 10px;
          right: 14px;
          font-size: 22px;
          cursor: pointer;
      }
      
    
    .content {
        margin-left: var(--sidebar-width);
        padding: 50px 40px;
        position: relative;
        z-index: 5;
        background: #fff;
    }
    
    
    .section-title::after {
        content: "";
        width: 60px;
        height: 4px;
        background: #00bcd4;
        display: block;
        margin-top: 6px;
        border-radius: 2px;
    }
    

    .popup-box {
    animation: scaleUp 0.3s ease;
}

@keyframes scaleUp {
    from { transform: scale(0.8); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}

    
    .about-desc {
        font-size: 16px;
        color: #333;
        margin-bottom: 30px;
        line-height: 1.6;
    }
    
    .about-container {
        display: flex;
        gap: 40px;
        align-items: flex-start;
        flex-wrap: nowrap;
    
    }
    
    .about-img img {
        width: 350px;
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    }
    
    .about-info h3 {
        font-size: 22px;
        margin-bottom: 10px;
        color: #071018;
    }
    
    .about-small {
        color: #555;
        margin-bottom: 20px;
        margin-top: 20px;
    }
    
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 14px 30px;
    }
    
    .info-grid span {
        font-weight: bold;
        color: #071018;
    }
    
    .hidden {
        opacity: 0;
        transform: translateY(60px);
        transition: all 0.9s ease-out;
    }
    
    .show {
        opacity: 1;
        transform: translateY(0);
    }
    
    /* Image Left Slide */
    .about-img {
        transform: translateX(-90px);
    }
    .about-img.show {
        transform: translateX(0);
    }
    
    /* Text Right Slide */
    .about-info {
        transform: translateX(90px);
    }
    .about-info.show {
        transform: translateX(0);
    }
    
    
    /* Facts Section */
    .facts {
        padding: 60px 0;
        
    }
    
    .facts-down {
        display: flex;
    }
    
    .facts-desc {
        display: flex;
        font-size: 15px;
        color: #555;
        margin-bottom: 40px;
        line-height: 1.6;
    }
    
    .facts-box {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        flex-wrap: wrap;
    }
    
    .fact-item {
        text-align: flex;
        flex-wrap: wrap;
        flex: 1;
        min-width: 180px;
    }
    
    .fact-icon {
        font-size: 45px;
        margin-bottom: 8px;
        color: #00bcd4;
    }
    
    .fact-item h3 {
        font-size: 32px;
        color: #071018;
        margin-bottom: 5px;
    }
    
    .fact-item p {
        font-size: 14px;
        font-weight: bold;
        color: #0d1b2a;
    }
    
    
    /* Skills Section */
    .skills {
        padding: 60px 0;
    }
    
    .skills-desc {
        font-size: 15px;
        color: #555;
        margin-bottom: 40px;
        line-height: 1.6;
    }
    
    .skills-container {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 25px 60px;
    }
    
    .skill-box {
        width: 100%;
    }
    
    .skill-title {
        display: flex;
        justify-content: space-between;
        font-size: 13px;
        font-weight: bold;
        color: #071018;
        margin-bottom: 6px;
    }
    
    .progress-bar {
        width: 100%;
        height: 10px;
        background: #e6eef7;
        border-radius: 10px;
        overflow: hidden;
    }
    
    .progress {
        height: 100%;
        background: #00bcd4;
        width: 0; /* Will animate */
        border-radius: 10px;
        transition: width 1.2s ease-in-out;
    }
    
    /* Resume Section */
    .resume {
        padding: 60px 0;
    }
    
    .resume-desc {
        font-size: 15px;
        color: #444;
        margin-bottom: 30px;
        line-height: 1.6;
    }
    
    .resume-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
    }
    
    .resume-heading {
        font-size: 22px;
        margin-bottom: 15px;
        color: #071018;
        font-weight: bold;
    }
    
    .resume-box {
        margin-bottom: 25px;
        padding-left: 15px;
        border-left: 3px solid #00bcd4;
    }
    
    .resume-box h4 {
        font-size: 17px;
        font-weight: bold;
        color: #071018;
    }
    
    .resume-box .year,
    .resume-box .company {
        display: block;
        font-size: 13px;
        font-weight: bold;
        color: #00bcd4;
    }
    
    .project-list li {
        margin-bottom: 10px;
        font-size: 14px;
        color: #333;
    }
    
    /* Responsive */
    @media(max-width: 768px) {
        .resume-container {
            grid-template-columns: 1fr;
        }
    }
    
    /* Portfolio Section */
    .portfolio {
        padding: 60px 0;
    }
    
    .portfolio-desc {
        color: #555;
        margin-bottom: 25px;
        font-size: 15px;
    }
    
    .portfolio-filter {
        margin-bottom: 30px;
    }
    
    .portfolio-filter button {
        background: none;
        border: none;
        font-size: 15px;
        color: #071018;
        cursor: pointer;
        margin-right: 18px;
        padding: 6px 14px;
        border-radius: 20px;
        border: 1px solid transparent;
        transition: 0.3s;
    }
    
    .portfolio-filter button:hover,
    .portfolio-filter .active {
        color: #fff;
        background: #00bcd4;
        border-color: #00bcd4;
    }
    
    .portfolio-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
        gap: 20px;
    }
    
    .portfolio-item {
        overflow: hidden;
        cursor: pointer;
    }
    
    .portfolio-item img {
        width: 100%;
        display: block;
        transition: 0.3s;
        border-radius: 10px;
    }
    
    .portfolio-item:hover img {
        transform: scale(1.05);
    }
    
    /* Contact Section */
    .contact {
        padding: 60px 0;
    }
    
    .contact-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        margin-top: 30px;
    }
    
    .contact-info .info-box {
        margin-bottom: 20px;
    }
    
    .contact-info h4 {
        font-size: 16px;
        font-weight: bold;
        color: #071018;
    }
    
    .contact-info p {
        color: #333;
        font-size: 14px;
    }
    
    .map-box {
        margin-top: 20px;
        border-radius: 6px;
        overflow: hidden;
    }
    
    /* Contact Form */
    .contact-form form {
        width: 100%;
    }
    
    .form-group {
        display: flex;
        gap: 20px;
        margin-bottom: 15px;
    }
    
    .form-group input {
        flex: 1;
    }
    
    .full-input,
    .form-group input,
    textarea {
        width: 100%;
        padding: 12px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 14px;
        outline: none;
    }
    
    textarea {
        height: 150px;
        resize: none;
        margin-top: 10px;
    }
    
    .btn-message {
        background: #00bcd4;
        color: #fff;
        padding: 12px 25px;
        border: none;
        font-size: 15px;
        border-radius: 6px;
        margin-top: 15px;
        cursor: pointer;
        transition: 0.3s;
    }
    
    .btn-message:hover {
        background: #0099ad;
    }
    
    /* Responsive */
    @media(max-width: 900px) {
        .contact-container {
            grid-template-columns: 1fr;
        }
    }
    
    
</style>

</head>
<body>

<!-- Sidebar -->
<div class="position-fixed top-0 start-0 vh-100 bg-dark text-white p-3" style="width:230px; z-index:1050;">

    <!-- Profile -->
    <div class="text-center">
        <img src="images/profiles/profile.png" class="rounded-circle border border-4 mb-2" width="80" height="80" alt="Profile" >
        <h5 class="mt-2">Ravi Roushan</h5>
    </div>

    <!-- Social Links -->
    <div class="d-flex justify-content-center gap-2 my-3">
        <a class="btn btn-secondary btn-sm rounded-circle" href="https://twitter.com/" target="_blank">
            <i class="fab fa-twitter"></i>
        </a>
        <a class="btn btn-secondary btn-sm rounded-circle" href="https://linkedin.com/" target="_blank">
            <i class="fab fa-linkedin-in"></i>
        </a>
        <a class="btn btn-secondary btn-sm rounded-circle" href="https://github.com/" target="_blank">
            <i class="fab fa-github"></i>
        </a>
        <a class="btn btn-secondary btn-sm rounded-circle" href="https://facebook.com/" target="_blank">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a class="btn btn-secondary btn-sm rounded-circle" href="https://instagram.com/" target="_blank">
            <i class="fab fa-instagram"></i>
        </a>
    </div>

        <ul class="list-group list-group-flush border-0 mt-4">

    <a href="#home"
       class="list-group-item list-group-item-action bg-dark text-white d-flex gap-2 border-0 sidebar-link">
        <i class="fa-regular fa-house"></i> Home
    </a>

    <a href="#about"
       class="list-group-item list-group-item-action bg-dark text-white d-flex gap-2 border-0 sidebar-link">
        <i class="fa-regular fa-user"></i> About
    </a>

    <a href="#resume"
       class="list-group-item list-group-item-action bg-dark text-white d-flex gap-2 border-0 sidebar-link">
        <i class="fa-regular fa-file"></i> Resume
    </a>

    <a href="#portfolio"
       class="list-group-item list-group-item-action bg-dark text-white d-flex gap-2 border-0 sidebar-link">
        <i class="fa-regular fa-address-book"></i> Portfolio
    </a>

    <a href="#services"
       class="list-group-item list-group-item-action bg-dark text-white d-flex gap-2 border-0 sidebar-link">
        <i class="fa-solid fa-server"></i> Services
    </a>

    <a href="#contact"
       class="list-group-item list-group-item-action bg-dark text-white d-flex gap-2 border-0 sidebar-link">
        <i class="fa-regular fa-envelope"></i> Contact
    </a>

</ul>
</div>


<!-- HERO SECTION -->
<section id="home"
    class="vh-100 d-flex align-items-center justify-content-center text-center text-white position-relative"
    style="
        margin-left:230px;
        width: calc(100% - 230px);
        background:url('images/profiles/Hero.png') no-repeat top center / cover;
    "
>

    <!-- Overlay -->
    <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"
         style="pointer-events:none; z-index:1;"></div>

    <!-- Content -->
    <div class="position-relative" style="z-index:2;">

        <p class="d-flex justify-content-center gap-2 fs-4 fw-bold text-info typing-text">
            <span>Full</span>
            <span>Stack</span>
            <span>Developer</span>
        </p>
    </div>

</section>


<!-- Content -->
<div class="content">
<section id="about" class="about">
    

    <div class="about-header">
    <h2 class="section-title hidden">About</h2>
    <button class="contact-btn" onclick="openContact()">Contact</button>
    </div>
    <div id="contactPopup" class="contact-popup">
        <div class="popup-box hidden">
            <span class="close-btn" onclick="closeContact()">×</span>
    
            <h3>Contact Me</h3>
    
            <form id="contactForm">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <textarea name="message" placeholder="Your Message" required></textarea>
                <button type="submit">Send Message</button>
                <p id="contactMsg"></p>
            </form>
            
        </div>
    </div>
    

    <p class="about-desc hidden">
        A dedicated software developer with a strong academic foundation in computer applications,
        experienced in building high-quality websites and scalable full-stack applications using 
        HTML, CSS, JavaScript, PHP and MySQL. Passionate about problem solving and smart automation.
    </p>

    <div class="about-container">

        <!-- Left Image -->
        <div class="about-img hidden">
            <img src="images/profiles/about.png" alt="My Photo">
        </div>

        <!-- Right Info -->
        <div class="about-info hidden">
            <h3>Full Stack Developer & Software Engineer</h3>
            <p class="about-small">
                Experienced in both front-end & back-end development with strong 
                collaboration skills and successful delivery of 10+ projects.
            </p>

            <div class="info-grid">
                <p><span>Birthday:</span> 03 Nov 2000</p>
                <p><span>Age:</span> 23</p>
                <p><span>Phone:</span> +91 9576683153</p>
                <p><span>City:</span> New Delhi, India</p>
                <p><span>Degree:</span> Master’s in Computer Application</p>
                <p><span>Freelance:</span> Available</p>
            </div>

            <p class="about-small">
                With extensive experience in HTML, CSS, JavaScript, AJAX, PHP, and MySQL, I have successfully integrated payment gateways, SMS, and WhatsApp APIs into various projects. My proficiency also includes developing custom APIs for CRM systems, ensuring seamless data exchange and process automation. I am committed to delivering high-quality software solutions tailored to client needs, demonstrating strong organizational and leadership abilities in all my projects.
            </p>
        </div>
    </div>
</section>

<section id="facts" class="facts">
    <div id="facts-up" class="facts-up hidden">
       <h2 class="section-title">Facts</h2>
       <p class="facts-desc">
           Throughout my career, I have consistently demonstrated a commitment to excellence in software development. 
           Here are some key facts about my professional journey:
       </p>
    </div>
    <div id="facts-down" class="facts-down hidden">
    <div class="fact-item">
       <div class="fact-icon">😊</div>
       <h3 class="counter" data-target="10">0</h3>
       <p>Happy Clients</p>
     </div>

    <div class="fact-item">
        <div class="fact-icon">📝</div>
        <h3 class="counter" data-target="15">0</h3>
        <p>Projects Delivered</p>
    </div>

   <div class="fact-item">
       <div class="fact-icon">🎧</div>
       <h3 class="counter" data-target="5000">0</h3>
       <p>Hours of Coding</p>
   </div>

  <div class="fact-item">
      <div class="fact-icon">👥</div>
      <h3 class="counter" data-target="10">0</h3>
      <p>10+ Certification Earned</p>
  </div>
</div>
</section>

<section id="skills" class="skills">
    <h2 class="section-title">Skills</h2>
    <p class="skills-desc ">
        Skills combines technical expertise with practical experience in HTML, CSS,
        JavaScript, AJAX, PHP, and MySQL. Known for problem-solving, teamwork,
        and consistently delivering high-quality software solutions.
    </p>

    <div class="skills-container hidden">

        <div class="skill-box">
            <div class="skill-title">
    

            </div>
            <div class="progress-bar"><div class="progress" data-progress="90"></div></div>
        </div>

        <div class="skill-box">
            <div class="skill-title">
                <span>CSS</span><span>90%</span>
            </div>
            <div class="progress-bar"><div class="progress" data-progress="90"></div></div>
        </div>

        <div class="skill-box">
            <div class="skill-title">
                <span>JAVASCRIPT</span><span>75%</span>
            </div>
            <div class="progress-bar"><div class="progress" data-progress="75"></div></div>
        </div>

        <div class="skill-box">
            <div class="skill-title ">
                <span>PHP</span><span>80%</span>
            </div>
            <div class="progress-bar"><div class="progress" data-progress="80"></div></div>
        </div>

        <div class="skill-box">
            <div class="skill-title">
                <span>JAVA</span><span>75%</span>
            </div>
            <div class="progress-bar"><div class="progress" data-progress="75"></div></div>
        </div>

        <div class="skill-box">
            <div class="skill-title">
                <span>REACT</span><span>80%</span>
            </div>
            <div class="progress-bar"><div class="progress" data-progress="80"></div></div>
        </div>

        <div class="skill-box">
            <div class="skill-title">
                <span>MYSQL</span><span>80%</span>
            </div>
            <div class="progress-bar"><div class="progress" data-progress="80"></div></div>
        </div>

        <div class="skill-box">
            <div class="skill-title">
                <span>AJAX</span><span>60%</span>
            </div>
            <div class="progress-bar"><div class="progress" data-progress="60"></div></div>
        </div>

        <div class="skill-box">
            <div class="skill-title">
                <span>APIs HANDLING FOR CRM</span><span>100%</span>
            </div>
            <div class="progress-bar"><div class="progress" data-progress="100"></div></div>
        </div>

        <div class="skill-box">
            <div class="skill-title">
                <span>APIs HANDLING FOR SMS</span><span>100%</span>
            </div>
            <div class="progress-bar"><div class="progress" data-progress="100"></div></div>
        </div>

        <div class="skill-box">
            <div class="skill-title">
                <span>WORDPRESS/CMS</span><span>90%</span>
            </div>
            <div class="progress-bar"><div class="progress" data-progress="90"></div></div>
        </div>

        <div class="skill-box">
            <div class="skill-title">
                <span>PHOTOSHOP</span><span>55%</span>
            </div>
            <div class="progress-bar"><div class="progress" data-progress="55"></div></div>
        </div>
    </div>
</section>

<!-- Resume Section -->
<section id="resume" class="resume">
    <h2 class="section-title">Resume</h2>

    <p class="resume-desc hidden">
        Passionate and motivated Full Stack Developer with hands-on experience in building secure,
        scalable and high-performance web applications. Aiming to contribute expertise in both
        frontend and backend development.
    </p>

    <div class="resume-container hidden">

        <!-- Left Column - Education -->
        <div class="resume-left">
            <h3 class="resume-heading">Education</h3>

            <div class="resume-box">
                <h4>Master of Computer Applications</h4>
                <span class="year">2021 - 2023</span>
                <p> Banaras Hindu University, Varanasi </p>
            </div>

            <div class="resume-box">
                <h4>Bachelor of Science</h4>
                <span class="year">2017 - 2020</span>
                <p> L.N.M.U University, Darbhanga </p>
            </div>

            <div class="resume-box">
                <h4>Intermediate</h4>
                <span class="year">2015 - 2017</span>
                <p> M.L.S.M College, Darbhanga </p>
            </div>

            <div class="resume-box">
                <h4>Matriculation</h4>
                <span class="year">2014 - 2015</span>
                <p> M.E. School, Darbhanga </p>
            </div>
        </div>

        <!-- Right Column - Experience -->
        <div class="resume-right">
            <h3 class="resume-heading hidden">Professional Experience</h3>

            <div class="resume-box">
                <h4>Full Stack Developer</h4>
                <span class="company">Violet India Pvt. Ltd.</span>
                <span class="year">2024 - Present</span>
                <p>Front-end/back-end development, API integrations, and UI/UX improvements.</p>
            </div>

            <div class="resume-box">
                <h4>Full Stack Developer (Internship)</h4>
                <span class="company">Technoface, Noida</span>
                <span class="year">2023 - 2023</span>
                <p>Individually handled multiple website projects under tight deadlines.</p>
            </div>

            <h3 class="resume-heading">Projects</h3>

            <ul class="project-list">
                <li><strong>Employee Management System</strong> — PHP/JS/Bootstrap based CRM</li>
                <li><strong>Registration Website</strong> — Multi-user forms + dashboards</li>
                <li><strong>Blogs CMS</strong> — Custom backend, admin panel & frontend</li>
                <li><strong>WordPress Websites</strong> — Business sites + eCommerce</li>
            </ul>
        </div>

    </div>
</section>

<!-- Portfolio Section -->
<section id="portfolio" class="portfolio">
    <h2 class="section-title">Glimpses of Project</h2>
    <p class="portfolio-desc">
        Here, I have attached all the glimpses of my project which may show the skills I admired.
    </p>

    <!-- Filter Buttons -->
    <div class="portfolio-filter">
        <button class="active" data-filter="all">ALL</button>
        <button data-filter="software">SOFTWARE</button>
        <button data-filter="web">WEB</button>
        <button data-filter="landing">LANDING PAGE</button>
    </div>

    <!-- Portfolio Grid -->
    <div class="portfolio-container hidden">

    </div>
</section>
 
<!-- Contact Section -->
<section id="contact" class="contact">
    <h2 class="section-title">Contact</h2>

    <div class="contact-container hidden">

        <!-- Left Contact Info -->
        <div class="contact-info hidden">

            <div class="info-box">
                <h4>Location:</h4>
                <p>U39, gali No 3, Uttam Nagar, New Delhi</p>
            </div>

            <div class="info-box">
                <h4>Email:</h4>
                <p>raviroushan1820@gmail.com</p>
            </div>

            <div class="info-box">
                <h4>Call:</h4>
                <p>+91 9576683153</p>
            </div>

            <!-- Embedded Google Map -->
            <div class="map-box">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3503.051282836088!2d77.0637816753982!3d28.59640358638739!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d046b723b9e0d%3A0x3f2e4cfddd3bfdf!2sUttam%20Nagar%2C%20Delhi!5e0!3m2!1sen!2sin!4v1706800000000!5m2!1sen!2sin" 
                width="100%" height="230" style="border:0;" allowfullscreen="" loading="lazy">
                </iframe>
            </div>

        </div>

        <!-- Right Contact Form -->
        <div class="contact-form hidden">
            <form>
                <div class="form-group">
                    <input type="text" placeholder="Your Name" required>
                    <input type="email" placeholder="Your Email" required>
                </div>

                <input type="text" placeholder="Subject" class="full-input" required>

                <textarea placeholder="Message" required></textarea>

                <button type="submit" class="btn-message">Send Message</button>
            </form>
        </div>

    </div>
</section>



</div>

</body>
<script>
/* ================= CONTACT POPUP (GLOBAL FUNCTIONS) ================= */
function openContact() {
    document.getElementById("contactPopup").style.display = "flex";
}

function closeContact() {
    document.getElementById("contactPopup").style.display = "none";
}

/* ================= MAIN DOM LOADED ================= */
document.addEventListener("DOMContentLoaded", () => {

    /* ===== ESC KEY CLOSE POPUP ===== */
    document.addEventListener("keydown", function(e){
        if(e.key === "Escape"){
            closeContact();
        }
    });


    document.getElementById("contactForm").addEventListener("submit", function(e){
    e.preventDefault();

    let formData = new FormData(this);

    fetch("/contact", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body: formData
    })
    .then(res => {
        if (!res.ok) throw new Error("Network error");
        return res.json();
    })
    .then(data => {
        document.getElementById("contactMsg").innerText = data.message;
        document.getElementById("contactMsg").style.color = "green";
        this.reset();
        setTimeout(closeContact, 1500);
    })
    .catch(err => {
        document.getElementById("contactMsg").innerText = "Something went wrong";
        document.getElementById("contactMsg").style.color = "red";
    });
});


    /* ================= COUNTER ================= */
    const counters = document.querySelectorAll(".counter");
    const speed = 100;

    const animateCounters = () => {
        counters.forEach(counter => {
            const update = () => {
                const target = +counter.getAttribute("data-target");
                const current = +counter.innerText;
                const increment = target / speed;

                if (current < target) {
                    counter.innerText = Math.ceil(current + increment);
                    setTimeout(update, 20);
                } else {
                    counter.innerText = target;
                }
            };
            update();
        });
    };

    const counterObserver = new IntersectionObserver(entries => {
        if (entries[0].isIntersecting) {
            animateCounters();
            counterObserver.disconnect();
        }
    });

    const factsSection = document.querySelector(".facts");
    if (factsSection) counterObserver.observe(factsSection);

    /* ================= SKILLS BAR ================= */
    const skillObserver = new IntersectionObserver(entries => {
        if (entries[0].isIntersecting) {
            document.querySelectorAll(".progress").forEach(bar => {
                bar.style.width = bar.getAttribute("data-progress") + "%";
            });
            skillObserver.disconnect();
        }
    });

    const skillsSection = document.querySelector(".skills");
    if (skillsSection) skillObserver.observe(skillsSection);

    /* ================= PORTFOLIO FILTER ================= */
    const filterButtons = document.querySelectorAll('.portfolio-filter button');
    const portfolioItems = document.querySelectorAll('.portfolio-item');

    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelector('.portfolio-filter .active')?.classList.remove('active');
            btn.classList.add('active');

            const filter = btn.getAttribute('data-filter');

            portfolioItems.forEach(item => {
                item.style.display =
                    filter === 'all' || item.classList.contains(filter)
                        ? 'block'
                        : 'none';
            });
        });
    });

    /* ================= ACTIVE SIDEBAR MENU ================= */
    const sections = document.querySelectorAll("section[id]");
    const navLinks = document.querySelectorAll(".sidebar-link");

    function updateActiveMenu() {
        let current = "";

        sections.forEach(section => {
            if (window.scrollY >= section.offsetTop - 200) {
                current = section.getAttribute("id");
            }
        });

        navLinks.forEach(link => {
            link.classList.remove("active");
            if (link.getAttribute("href") === "#" + current) {
                link.classList.add("active");
            }
        });
    }

    window.addEventListener("scroll", updateActiveMenu);

    /* ================= SCROLL ANIMATION ================= */
    const elements = document.querySelectorAll('.hidden');
    const revealObserver = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('show');
            }
        });
    });

    elements.forEach(el => revealObserver.observe(el));
});
</script>


</html>
