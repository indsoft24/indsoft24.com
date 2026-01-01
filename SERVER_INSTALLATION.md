# Server Installation Guide for PDF Tools

This guide explains how to install qpdf, Ghostscript, and LibreOffice on your Linux production server.

## Option 1: Install qpdf (Recommended for PDF Lock/Unlock)

### For Ubuntu/Debian:
```bash
sudo apt-get update
sudo apt-get install qpdf
```

### For CentOS/RHEL/Fedora:
```bash
# CentOS/RHEL 7/8
sudo yum install qpdf

# CentOS/RHEL 9 / Fedora
sudo dnf install qpdf
```

### For Amazon Linux:
```bash
sudo yum install qpdf
```

### Verify Installation:
```bash
qpdf --version
```

## Option 2: Install Ghostscript (Works for Compression)

### For Ubuntu/Debian:
```bash
sudo apt-get update
sudo apt-get install ghostscript
```

### For CentOS/RHEL/Fedora:
```bash
# CentOS/RHEL 7/8
sudo yum install ghostscript

# CentOS/RHEL 9 / Fedora
sudo dnf install ghostscript
```

### For Amazon Linux:
```bash
sudo yum install ghostscript
```

### Verify Installation:
```bash
gs --version
```

## Option 3: Install Both (Recommended)

For best functionality, install both tools:

```bash
# Ubuntu/Debian
sudo apt-get update
sudo apt-get install qpdf ghostscript

# CentOS/RHEL/Fedora
sudo yum install qpdf ghostscript
# OR
sudo dnf install qpdf ghostscript
```

## Verify Both Are Working

After installation, verify both tools are accessible:

```bash
qpdf --version
gs --version
```

Both commands should return version information without errors.

## Option 3: Install LibreOffice (For DOC/DOCX to PDF Conversion)

### For Ubuntu/Debian:
```bash
sudo apt-get update
sudo apt-get install libreoffice
```

### For CentOS/RHEL/Fedora:
```bash
# CentOS/RHEL 7/8
sudo yum install libreoffice

# CentOS/RHEL 9 / Fedora
sudo dnf install libreoffice
```

### For Amazon Linux:
```bash
sudo yum install libreoffice
```

### Verify Installation:
```bash
libreoffice --version
```

## Option 4: Install All Tools (Recommended)

For best functionality, install all tools:

```bash
# Ubuntu/Debian
sudo apt-get update
sudo apt-get install qpdf ghostscript libreoffice

# CentOS/RHEL/Fedora
sudo yum install qpdf ghostscript libreoffice
# OR
sudo dnf install qpdf ghostscript libreoffice
```

## Verify All Tools Are Working

After installation, verify all tools are accessible:

```bash
qpdf --version
gs --version
libreoffice --version
```

All commands should return version information without errors.

## For cPanel/Shared Hosting (Jailshell Environment)

If you're on shared hosting with cPanel and see "jailshell" in terminal:

### Current Status Check:
```bash
# Check what's available
gs --version    # Ghostscript (usually available)
qpdf --version  # qpdf (may not be available)
```

### If you see "jailshell: qpdf: command not found":

**You cannot install packages directly in jailshell.** You have two options:

#### Option 1: Contact Your Hosting Provider (Recommended)
1. **Submit a support ticket** to your hosting provider
2. **Request installation of qpdf** for your account
3. **Provide this information:**
   - You need `qpdf` package installed
   - It's required for PDF password protection features
   - Request it to be added to your account's PATH
   - Mention: "I need qpdf installed for my Laravel application's PDF lock feature"

#### Option 2: Use What's Available
Since **Ghostscript is already installed**, these features will work:
- ✅ **PDF Compression** - Will work with Ghostscript
- ✅ **PDF Unlock** - Will work with Ghostscript (for password-protected PDFs)
- ❌ **PDF Lock** - Requires qpdf (contact hosting provider)

### Try These Commands First:

1. **Check if qpdf exists in a different location:**
   ```bash
   find /usr -name qpdf 2>/dev/null
   find /usr/local -name qpdf 2>/dev/null
   find /opt -name qpdf 2>/dev/null
   ```

2. **Check if ImageMagick PHP extension is available:**
   ```bash
   php -m | grep -i imagick
   ```
   If ImageMagick PHP extension is available, it can be used as a fallback for compression.

3. **Check which PHP extensions are available:**
   ```bash
   php -m
   ```

### Sample Support Ticket to Hosting Provider:

```
Subject: Request to Install qpdf Package

Hello,

I need the qpdf package installed on my account for my Laravel application.

Current status:
- Ghostscript is installed and working (gs --version returns 9.25)
- qpdf is not available (jailshell: qpdf: command not found)

I need qpdf for PDF password protection features in my application. 
Please install qpdf and ensure it's available in my account's PATH.

Thank you!
```

### After Hosting Provider Installs qpdf:

1. **Verify installation:**
   ```bash
   qpdf --version
   ```

2. **Clear Laravel cache:**
   ```bash
   php artisan optimize:clear
   ```

3. **Test the PDF tools on your website**

## For Docker/Container Deployments

Add to your Dockerfile:

```dockerfile
# For Debian/Ubuntu based images
RUN apt-get update && apt-get install -y qpdf ghostscript && rm -rf /var/lib/apt/lists/*

# For Alpine based images
RUN apk add --no-cache qpdf ghostscript
```

## Troubleshooting

### If commands are not found after installation:

1. **Check if they're in PATH:**
   ```bash
   which qpdf
   which gs
   ```

2. **If not found, add to PATH or create symlinks:**
   ```bash
   # Find installation location
   find /usr -name qpdf 2>/dev/null
   find /usr -name gs 2>/dev/null
   ```

3. **Restart PHP-FPM after installation:**
   ```bash
   sudo systemctl restart php-fpm
   # OR
   sudo service php-fpm restart
   ```

## Testing After Installation

Once installed, test the tools from your Laravel application:

1. Visit: `https://yourdomain.com/tools/pdf-compress`
2. Try uploading a PDF
3. If you see the error about tools not being installed, check:
   - PHP-FPM has been restarted
   - Tools are in system PATH
   - Web server user has permission to execute them

## Quick Installation Script

Save this as `install-pdf-tools.sh` and run it:

```bash
#!/bin/bash

# Detect OS
if [ -f /etc/os-release ]; then
    . /etc/os-release
    OS=$ID
else
    echo "Cannot detect OS"
    exit 1
fi

# Install based on OS
case $OS in
    ubuntu|debian)
        sudo apt-get update
        sudo apt-get install -y qpdf ghostscript
        ;;
    centos|rhel|fedora)
        if command -v dnf &> /dev/null; then
            sudo dnf install -y qpdf ghostscript
        else
            sudo yum install -y qpdf ghostscript
        fi
        ;;
    *)
        echo "Unsupported OS: $OS"
        exit 1
        ;;
esac

# Verify installation
echo "Verifying installation..."
qpdf --version && echo "✓ qpdf installed" || echo "✗ qpdf not found"
gs --version && echo "✓ Ghostscript installed" || echo "✗ Ghostscript not found"

# Restart PHP-FPM if available
if command -v systemctl &> /dev/null; then
    sudo systemctl restart php-fpm 2>/dev/null || true
fi

echo "Installation complete!"
```

Make it executable and run:
```bash
chmod +x install-pdf-tools.sh
sudo ./install-pdf-tools.sh
```

