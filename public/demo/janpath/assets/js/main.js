// ===================================
// Date Display
// ===================================
function displayCurrentDate() {
  const dateElement = document.getElementById("currentDate");
  if (dateElement) {
    const options = {
      weekday: "long",
      year: "numeric",
      month: "long",
      day: "numeric",
    };
    const today = new Date();
    dateElement.textContent = today.toLocaleDateString("hi-IN", options);
  }
}

// ===================================
// Sticky Navbar
// ===================================
function initStickyNavbar() {
  const navbar = document.getElementById("navbar");
  if (!navbar) return;

  let lastScroll = 0;

  window.addEventListener("scroll", () => {
    const currentScroll = window.pageYOffset;

    if (currentScroll <= 0) {
      navbar.classList.remove("scroll-up");
      return;
    }

    if (
      currentScroll > lastScroll &&
      !navbar.classList.contains("scroll-down")
    ) {
      // Scrolling down
      navbar.classList.remove("scroll-up");
      navbar.classList.add("scroll-down");
    } else if (
      currentScroll < lastScroll &&
      navbar.classList.contains("scroll-down")
    ) {
      // Scrolling up
      navbar.classList.remove("scroll-down");
      navbar.classList.add("scroll-up");
    }

    lastScroll = currentScroll;
  });
}

// ===================================
// Mobile Menu Toggle
// ===================================
function initMobileMenu() {
  const mobileMenuToggle = document.getElementById("mobileMenuToggle");
  const navMenu = document.getElementById("navMenu");

  if (mobileMenuToggle && navMenu) {
    mobileMenuToggle.addEventListener("click", () => {
      navMenu.classList.toggle("active");
      mobileMenuToggle.classList.toggle("active");
    });

    // Close menu when clicking outside
    document.addEventListener("click", (e) => {
      if (!navMenu.contains(e.target) && !mobileMenuToggle.contains(e.target)) {
        navMenu.classList.remove("active");
        mobileMenuToggle.classList.remove("active");
      }
    });
  }
}

// ===================================
// Search Functionality
// ===================================
function initSearch() {
  const searchBtn = document.getElementById("searchBtn");

  if (searchBtn) {
    searchBtn.addEventListener("click", () => {
      // Create search modal or redirect to search page
      const searchQuery = prompt("खोजें:");
      if (searchQuery) {
        console.log("Searching for:", searchQuery);
        // Implement search functionality here
        // window.location.href = `search.html?q=${encodeURIComponent(searchQuery)}`;
      }
    });
  }
}

// ===================================
// Back to Top Button
// ===================================
function initBackToTop() {
  const backToTopBtn = document.getElementById("backToTop");

  if (backToTopBtn) {
    window.addEventListener("scroll", () => {
      if (window.pageYOffset > 300) {
        backToTopBtn.classList.add("visible");
      } else {
        backToTopBtn.classList.remove("visible");
      }
    });

    backToTopBtn.addEventListener("click", () => {
      window.scrollTo({
        top: 0,
        behavior: "smooth",
      });
    });
  }
}

// ===================================
// News Ticker Animation
// ===================================
function initNewsTicker() {
  const tickerContent = document.querySelector(".ticker-content");

  if (tickerContent) {
    // Clone ticker items for seamless loop
    const tickerItems = tickerContent.innerHTML;
    tickerContent.innerHTML += tickerItems;
  }
}

// ===================================
// Lazy Loading Images
// ===================================
function initLazyLoading() {
  const images = document.querySelectorAll("img[data-src]");

  const imageObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const img = entry.target;
        img.src = img.dataset.src;
        img.removeAttribute("data-src");
        observer.unobserve(img);
      }
    });
  });

  images.forEach((img) => imageObserver.observe(img));
}

// ===================================
// Language Selector
// ===================================
function initLanguageSelector() {
  const languageSelect = document.getElementById("languageSelect");

  if (languageSelect) {
    // Load saved language preference
    const savedLanguage = localStorage.getItem("preferredLanguage") || "hi";
    languageSelect.value = savedLanguage;

    // Apply language on load
    applyLanguage(savedLanguage);

    languageSelect.addEventListener("change", (e) => {
      const selectedLanguage = e.target.value;

      // Save preference
      localStorage.setItem("preferredLanguage", selectedLanguage);

      // Apply language
      applyLanguage(selectedLanguage);

      // Visual feedback
      showLanguageChangeNotification(selectedLanguage);
    });
  }
}

function applyLanguage(lang) {
  // Update HTML lang attribute
  document.documentElement.lang = lang;

  // You can add more language-specific changes here
  // For example, changing text content, date formats, etc.

  console.log("Language changed to:", lang === "hi" ? "हिन्दी" : "English");
}

function showLanguageChangeNotification(lang) {
  // Create notification element
  const notification = document.createElement("div");
  notification.style.cssText = `
        position: fixed;
        top: 80px;
        right: 20px;
        background: linear-gradient(135deg, #c41e3a 0%, #9a1829 100%);
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        z-index: 10000;
        font-weight: 600;
        animation: slideInRight 0.3s ease;
    `;

  notification.textContent =
    lang === "hi" ? "✓ भाषा बदल दी गई: हिन्दी" : "✓ Language changed: English";

  document.body.appendChild(notification);

  // Add animation
  const style = document.createElement("style");
  style.textContent = `
        @keyframes slideInRight {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    `;
  document.head.appendChild(style);

  // Remove after 3 seconds
  setTimeout(() => {
    notification.style.animation = "slideInRight 0.3s ease reverse";
    setTimeout(() => {
      notification.remove();
      style.remove();
    }, 300);
  }, 3000);
}

// ===================================
// Smooth Scroll for Anchor Links
// ===================================
function initSmoothScroll() {
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      const href = this.getAttribute("href");
      if (href !== "#" && href !== "") {
        e.preventDefault();
        const target = document.querySelector(href);
        if (target) {
          target.scrollIntoView({
            behavior: "smooth",
            block: "start",
          });
        }
      }
    });
  });
}

// ===================================
// Article Card Animations
// ===================================
function initCardAnimations() {
  const cards = document.querySelectorAll(
    ".news-card, .video-card, .featured-article"
  );

  const cardObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = "0";
          entry.target.style.transform = "translateY(20px)";

          setTimeout(() => {
            entry.target.style.transition = "all 0.6s ease";
            entry.target.style.opacity = "1";
            entry.target.style.transform = "translateY(0)";
          }, 100);

          cardObserver.unobserve(entry.target);
        }
      });
    },
    {
      threshold: 0.1,
    }
  );

  cards.forEach((card) => cardObserver.observe(card));
}

// ===================================
// View Counter (Simulated)
// ===================================
function updateViewCounts() {
  const viewElements = document.querySelectorAll(".views");

  viewElements.forEach((element) => {
    // Simulate view count updates
    const currentViews = element.textContent;
    // You can implement real-time view count updates here
  });
}

// ===================================
// Time Ago Formatter
// ===================================
function formatTimeAgo() {
  const timeElements = document.querySelectorAll(".time");

  timeElements.forEach((element) => {
    const timeText = element.textContent;
    // Keep the existing Hindi time format
    // You can implement dynamic time updates here if needed
  });
}

// ===================================
// Ad Placeholder Click Handler
// ===================================
function initAdPlaceholders() {
  const adPlaceholders = document.querySelectorAll(".ad-placeholder");

  adPlaceholders.forEach((ad) => {
    ad.addEventListener("click", () => {
      console.log("Ad clicked");
      // Implement ad click tracking here
    });
  });
}

// ===================================
// Video Player Initialization
// ===================================
function initVideoPlayers() {
  const videoCards = document.querySelectorAll(".video-card");

  videoCards.forEach((card) => {
    const playButton = card.querySelector(".play-button");
    if (playButton) {
      playButton.addEventListener("click", () => {
        console.log("Video play clicked");
        // Implement video player modal or redirect to video page
        // You can integrate with YouTube, Vimeo, or custom video player
      });
    }
  });
}

// ===================================
// Dropdown Menu Enhancement
// ===================================
function initDropdowns() {
  const dropdowns = document.querySelectorAll(".dropdown");

  dropdowns.forEach((dropdown) => {
    const link = dropdown.querySelector("a");
    const menu = dropdown.querySelector(".dropdown-menu");

    if (link && menu) {
      // Touch device support
      link.addEventListener("click", (e) => {
        if (window.innerWidth <= 768) {
          e.preventDefault();
          dropdown.classList.toggle("active");
        }
      });
    }
  });
}

// ===================================
// Performance Optimization
// ===================================
function optimizePerformance() {
  // Debounce scroll events
  let scrollTimeout;
  window.addEventListener("scroll", () => {
    if (scrollTimeout) {
      window.cancelAnimationFrame(scrollTimeout);
    }
    scrollTimeout = window.requestAnimationFrame(() => {
      // Scroll-based operations
    });
  });

  // Preload critical images
  const criticalImages = document.querySelectorAll(
    ".featured-image img, .news-image img"
  );
  criticalImages.forEach((img) => {
    const src = img.getAttribute("src");
    if (src) {
      const preloadLink = document.createElement("link");
      preloadLink.rel = "preload";
      preloadLink.as = "image";
      preloadLink.href = src;
      document.head.appendChild(preloadLink);
    }
  });
}

// ===================================
// Analytics Tracking
// ===================================
function initAnalytics() {
  // Track page view
  console.log("Page viewed:", window.location.pathname);

  // Track article clicks
  const articleLinks = document.querySelectorAll(
    ".news-card a, .featured-article a"
  );
  articleLinks.forEach((link) => {
    link.addEventListener("click", () => {
      console.log("Article clicked:", link.textContent);
      // Implement analytics tracking here (Google Analytics, etc.)
    });
  });
}

// ===================================
// Initialize All Functions
// ===================================
document.addEventListener("DOMContentLoaded", () => {
  displayCurrentDate();
  initStickyNavbar();
  initMobileMenu();
  initSearch();
  initBackToTop();
  initNewsTicker();
  initLazyLoading();
  initLanguageSelector();
  initSmoothScroll();
  initCardAnimations();
  updateViewCounts();
  formatTimeAgo();
  initAdPlaceholders();
  initVideoPlayers();
  initDropdowns();
  optimizePerformance();
  initAnalytics();

  console.log("भारत न्यूज़ - Website initialized successfully!");
});

// ===================================
// Handle Page Visibility
// ===================================
document.addEventListener("visibilitychange", () => {
  if (document.hidden) {
    console.log("Page hidden");
  } else {
    console.log("Page visible");
    // Refresh content if needed
  }
});

// ===================================
// Service Worker Registration (Optional)
// ===================================
if ("serviceWorker" in navigator) {
  window.addEventListener("load", () => {
    // Uncomment to enable service worker
    // navigator.serviceWorker.register('/sw.js')
    //     .then(registration => console.log('SW registered:', registration))
    //     .catch(error => console.log('SW registration failed:', error));
  });
}
