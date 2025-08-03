# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is the website for Launchpad Manager, a macOS application that allows users to organize their Launchpad icons. The site is built with PHP and includes:

- Product landing pages and feature descriptions
- Download system with version tracking
- License management and payment processing through PayPal
- User analytics via PostHog and Google Analytics

## Architecture

### Frontend Structure
- `index.php` - Main entry point that redirects to home.php
- `header.php` / `footer.php` - Shared layout components with navigation
- Page-specific PHP files: `home.php`, `features.php`, `buy.php`, `help.php`, `faq.php`, `contact.php`
- CSS styling in `css/xom.css`
- Images and assets in `images/` directory

### Download System
- `download.php` - Serves the latest version DMG file from `app/latest/`
- `download_yosemite.php` - Handles downloads for older macOS versions
- Version directories (`app/1.0.3/`, `app/1.0.4/`, etc.) contain DMG files
- Download counter tracked in `count.txt`

### License Management (yosemite/ directory)
- `config.php` - Database and payment configuration
- `pro/check.php` - License validation API endpoint
- `pro/pay.php`, `pro/success.php` - PayPal payment flow
- `pro/upgrade.php` - Handles license upgrades
- MySQL databases: `lmyosemite` (current), `launchpadmanager` (legacy)

### Dependencies
- **PostHog**: Analytics and user tracking
- **SendGrid**: Email services
- **PayPal**: Payment processing

## Key Development Commands

This is a PHP-based website without a traditional build system. Development workflow:

### Dependency Management
```bash
composer install          # Install PHP dependencies
composer update           # Update dependencies
```

### Docker Development (Recommended)
```bash
# Start the application with Docker
docker-compose up -d

# Stop the application
docker-compose down

# View logs
docker-compose logs -f web
```

- Website accessible at: http://localhost:8080
- phpMyAdmin accessible at: http://localhost:8081
- MySQL runs on port 3306

### Manual Local Development
- Requires PHP web server and MySQL database
- Database credentials: root/z3bral0 (configured for local development)
- Environment variables needed: PAYPAL_URL, PAYPAL_RECEIVER, OWN_SERVER
- Copy `.env.example` to `.env` and configure values

### File Structure Notes
- All PHP files use `defined('WEBPAGE') or header("Location: /");` security check
- Navigation state managed via WEBPAGE constant
- Download files served with proper MIME types and file transfer headers
- License validation uses HMAC-SHA1 with secret key '%gebebor%'

## Security Considerations
- Contains hardcoded API keys and database credentials (should be moved to environment variables)
- SQL queries use mysqli_escape_string() for basic protection
- License validation system prevents unauthorized usage
- Download counter uses file locking to prevent race conditions

## Database Schema
- `licenses` table: license keys, remaining activations
- `users` table: machine_id to license_key mapping
- Separate databases for current and legacy license systems