// Mobile Sidebar Toggle
const navToggle = document.getElementById("nav-toggle");
const mobileSidebar = document.getElementById("mobile-sidebar");
const sidebarClose = document.getElementById("sidebar-close");
const sidebarOverlay = document.getElementById("sidebar-overlay");

if (navToggle && mobileSidebar) {
  navToggle.addEventListener("click", () => {
    mobileSidebar.classList.add("active");
    document.body.style.overflow = "hidden";
  });
}

if (sidebarClose) {
  sidebarClose.addEventListener("click", () => {
    mobileSidebar.classList.remove("active");
    document.body.style.overflow = "";
  });
}

if (sidebarOverlay) {
  sidebarOverlay.addEventListener("click", () => {
    mobileSidebar.classList.remove("active");
    document.body.style.overflow = "";
  });
}

// Sidebar Dropdown Toggle
document.querySelectorAll(".sidebar-dropdown-toggle").forEach((toggle) => {
  toggle.addEventListener("click", function (e) {
    e.preventDefault();
    e.stopPropagation();

    const dropdown = this.closest(".sidebar-dropdown");
    const isActive = dropdown.classList.contains("active");

    // Close all other dropdowns
    document.querySelectorAll(".sidebar-dropdown").forEach((item) => {
      if (item !== dropdown) {
        item.classList.remove("active");
      }
    });

    // Toggle current dropdown
    if (isActive) {
      dropdown.classList.remove("active");
    } else {
      dropdown.classList.add("active");
    }
  });
});

// Close sidebar when clicking on sidebar items
document
  .querySelectorAll(".sidebar-item, .sidebar-dropdown-item")
  .forEach((item) => {
    item.addEventListener("click", function () {
      if (!this.closest(".sidebar-dropdown-toggle")) {
        setTimeout(() => {
          mobileSidebar.classList.remove("active");
          document.body.style.overflow = "";
        }, 300);
      }
    });
  });

// Mobile Dropdown Toggle
document
  .querySelectorAll(".nav-item.dropdown .dropdown-toggle")
  .forEach((toggle) => {
    toggle.addEventListener("click", function (e) {
      // Only handle on mobile (screen width <= 768px)
      if (window.innerWidth <= 768) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();

        const dropdown = this.closest(".nav-item.dropdown");
        const dropdownMenu = dropdown.querySelector(".dropdown-menu");
        const isActive = this.classList.contains("active");

        // Close all dropdowns first
        document.querySelectorAll(".nav-item.dropdown").forEach((item) => {
          const itemToggle = item.querySelector(".dropdown-toggle");
          const itemMenu = item.querySelector(".dropdown-menu");
          itemToggle.classList.remove("active");
          itemToggle.setAttribute("aria-expanded", "false");
          itemMenu.classList.remove("show");
        });

        // Toggle current dropdown if it wasn't active
        if (!isActive) {
          this.classList.add("active");
          this.setAttribute("aria-expanded", "true");
          dropdownMenu.classList.add("show");
        }
      }
    });

    // Prevent Bootstrap dropdown on mobile
    toggle.addEventListener("show.bs.dropdown", function (e) {
      if (window.innerWidth <= 768) {
        e.preventDefault();
        e.stopPropagation();
      }
    });
  });

// Close mobile menu when clicking on a link (but not dropdown toggles)
document.querySelectorAll(".nav-link:not(.dropdown-toggle)").forEach((link) => {
  link.addEventListener("click", () => {
    if (window.innerWidth <= 768) {
      navMenu.classList.remove("active");
      navToggle.classList.remove("active");
    }
  });
});

// Close mobile menu when clicking on dropdown items
document.querySelectorAll(".dropdown-item").forEach((item) => {
  item.addEventListener("click", () => {
    if (window.innerWidth <= 768) {
      navMenu.classList.remove("active");
      navToggle.classList.remove("active");
      // Close all dropdowns
      document.querySelectorAll(".nav-item.dropdown").forEach((dropdown) => {
        dropdown.querySelector(".dropdown-toggle").classList.remove("active");
        dropdown.querySelector(".dropdown-menu").classList.remove("show");
      });
    }
  });
});

// Close dropdowns when clicking outside on mobile
document.addEventListener("click", (e) => {
  if (window.innerWidth <= 768) {
    if (!e.target.closest(".nav-item.dropdown")) {
      document.querySelectorAll(".nav-item.dropdown").forEach((dropdown) => {
        dropdown.querySelector(".dropdown-toggle").classList.remove("active");
        dropdown.querySelector(".dropdown-menu").classList.remove("show");
      });
    }
  }
});

// Smooth scrolling removed for performance - using instant scroll
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute("href"));
    if (target) {
      target.scrollIntoView({
        behavior: "auto",
        block: "start",
      });
    }
  });
});

// Navbar is now always sticky - auto-hide functionality disabled
// Keeping navbar always visible for better user experience

// Counter animation for stats
function animateCounters() {
  const counters = document.querySelectorAll(".stat-number[data-count]");
  counters.forEach((counter) => {
    const target = parseInt(counter.getAttribute("data-count"));
    const increment = target / 60;
    let current = 0;
    const updateCounter = () => {
      if (current < target) {
        current += increment;
        counter.textContent = Math.ceil(current);
        requestAnimationFrame(updateCounter);
      } else {
        counter.textContent = target;
      }
    };
    updateCounter();
  });
}

// Trigger counter animation when stats section is visible
const statsObserver = new IntersectionObserver(
  (entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        animateCounters();
        statsObserver.unobserve(entry.target);
      }
    });
  },
  { threshold: 0.5 }
);

document.addEventListener("DOMContentLoaded", () => {
  const statsSection = document.querySelector(".stats-grid");
  if (statsSection) {
    statsObserver.observe(statsSection);
  }
});

// Form submission handling
const contactForm = document.querySelector(".contact-form");
if (contactForm) {
  contactForm.addEventListener("submit", (e) => {
    // Let Laravel handle the form submission
  });
}
