# Indsoft24.com - Professional Web Application

A modern, responsive website for Indsoft24.com built with Laravel framework, optimized for production deployment.

## 🚀 Quick Start

### Prerequisites

- **PHP 8.1+** with extensions: BCMath, Ctype, cURL, DOM, Fileinfo, JSON, Mbstring, OpenSSL, PCRE, PDO, Tokenizer, XML
- **Composer** for dependency management
- **Web Server** (Apache/Nginx) for production

### Development Setup

1. **Install dependencies:**
   ```bash
   composer install
   ```

2. **Generate application key:**
   ```bash
   php artisan key:generate
   ```

3. **Start development server:**
   ```bash
   php artisan serve
   ```

4. **Visit:** `http://localhost:8000`

### Production Setup

**For Linux/Mac:**
```bash
chmod +x production-setup.sh
./production-setup.sh
```

**For Windows:**
```cmd
production-setup.bat
```

## ✨ Features

- **🎨 Modern Design**: Clean, professional UI with smooth animations
- **📱 Responsive**: Mobile-first design that works on all devices
- **📧 Contact Form**: Secure form with Gmail SMTP integration
- **🔒 Security**: Comprehensive protection against spam, XSS, and CSRF
- **⚡ Performance**: Optimized for fast loading and caching
- **🎯 SEO Ready**: Proper meta tags and semantic HTML structure

## 🛡️ Security Features

- ✅ **CSRF Protection** - Laravel's built-in CSRF tokens
- ✅ **Rate Limiting** - 5 submissions per IP per 5 minutes
- ✅ **Spam Detection** - Server-side keyword and pattern filtering
- ✅ **Malicious Content Filtering** - XSS and injection protection
- ✅ **Honeypot Protection** - Bot detection with hidden fields
- ✅ **Input Validation** - Comprehensive form validation
- ✅ **Email Security** - Gmail SMTP with app password authentication

## 📧 Email Configuration

The contact form sends emails to `indsoft24@gmail.com` using Gmail SMTP.

## 📁 Project Structure

```
indsoft/
├── app/
│   ├── Http/Controllers/
│   │   ├── ContactController.php    # Contact form handling with security
│   │   └── HomeController.php       # Home page controller
│   └── Providers/                   # Service providers
├── config/                          # Configuration files
├── database/
│   └── database.sqlite              # SQLite database
├── public/
│   ├── css/styles.css               # Optimized stylesheet
│   ├── js/script.js                 # JavaScript with AJAX
│   ├── images/Indsoft24.png         # Company logo
│   └── index.php                    # Application entry point
├── resources/views/
│   ├── home.blade.php               # Home page template
│   └── layouts/app.blade.php        # Main layout
├── routes/web.php                   # Web routes
├── storage/                         # Logs and cache
├── DEPLOYMENT.md                    # Production deployment guide
├── production-setup.sh              # Linux/Mac setup script
└── production-setup.bat             # Windows setup script
```

## 🚀 Production Deployment

### Quick Deployment

1. **Run production setup:**
   ```bash
   ./production-setup.sh  # Linux/Mac
   # or
   production-setup.bat  # Windows
   ```

2. **Configure web server** (see `DEPLOYMENT.md`)

3. **Set up SSL certificate**

4. **Configure domain DNS**

### Manual Optimization

```bash
# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Cache for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Optimize Composer
composer install --optimize-autoloader --no-dev
```

## 🔧 Development Commands

```bash
# Start development server
php artisan serve --host=127.0.0.1 --port=8000

# Clear specific caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate
```

## 📊 Performance Features

- **View Caching** - Blade templates cached for production
- **Route Caching** - Routes cached for faster routing
- **Config Caching** - Configuration cached for performance
- **Asset Optimization** - Minified CSS and JavaScript
- **Database Optimization** - SQLite for simple deployment
- **Image Optimization** - Optimized logo and assets

## 🌐 Browser Support

- ✅ Chrome 90+
- ✅ Firefox 88+
- ✅ Safari 14+
- ✅ Edge 90+
- ✅ Mobile browsers (iOS Safari, Chrome Mobile)

## 📞 Support & Contact

**Technical Support:**
- **Email**: indsoft24@gmail.com
- **Website**: https://indsoft24.com

**Business Inquiries:**
- **Services**: Custom Software Development, Web Development, Mobile Apps
- **Location**: Noida, Uttar Pradesh, India
- **Hours**: Mon-Fri 9AM-6PM IST

## 📄 License

This project is proprietary software developed for Indsoft24.com.

---

**🚀 Ready for Production Deployment!**

*Built with Laravel 10, optimized for performance and security.*