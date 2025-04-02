# Terhost.com - E-commerce Discount Code Platform (Source Code)

## Description

This repository contains the source code for Terhost.com, a web application designed to sell discount codes (vouchers) for various popular e-commerce platforms. Users can register, top up their account balance via multiple methods (Bank Transfer, Momo, Scratch Cards), purchase available voucher codes, and view their purchase history. The application also includes an administration panel for managing users, products (voucher codes and categories), orders, system settings, and payment gateway configurations.

**Disclaimer:** This codebase appears to be built using procedural PHP without a major framework like Laravel or Symfony. It contains numerous backup/old files and potentially uses unofficial APIs for payment integrations. Significant security review, refactoring, and cleanup are likely required before deploying this in a production environment. A database schema file (`.sql`) is not included in the provided folder and is necessary for setup.

## Core Features

### User Features
* Account Registration & Login
* Password Reset Functionality
* Profile Management (View info, balance, potentially change password)
* Account Top-up:
    * Automated Bank Transfer (TPBank, MBBank via Cron Job verification)
    * Automated Momo Wallet (via Cron Job verification)
    * Scratch Card (via third-party API integration)
* Browse and Purchase Discount Codes/Vouchers
* View Purchase History
* View Activity Log
* Submit Support Tickets

### Admin Features (via `/admin` panel)
* Admin Dashboard (Statistics: Revenue, Users, Orders, etc.)
* User Management (View, Edit, Ban, Add/Deduct Balance)
* Category Management (Main and Sub-categories for vouchers)
* Product/Voucher Management (Add/Edit/Delete voucher types, Add/Manage individual codes, Hide/Show)
* Order History Management
* Payment/Deposit History Management
* Support Ticket Management (View/Reply/Close tickets)
* System Settings (Site name, logo, maintenance mode)
* Payment Gateway Settings (Configure API keys, bank details, scratch card rates for TPBank, MBBank, Momo, Napthe)
* Login History Viewing

## Technology Stack

* **Backend:**
    * **Language:** PHP (Procedural style)
    * **Database:** MySQL / MariaDB (Inferred, requires schema)
    * **Email:** PHPMailer
    * **QR Code:** PHP QR Code library
    * **APIs:** Integrations for TPBank, MBBank, Momo, Napthe (TheSieuRe/Gachthe) - likely via Cron Jobs and direct API calls.
* **Frontend:**
    * **Markup/Styling:** HTML5, CSS3
    * **JavaScript:** Vanilla JS, heavily reliant on **jQuery**
    * **Frameworks/Templates:**
        * **Bootstrap 4.6.1** (User Interface)
        * **AdminLTE 3.2.0** (Admin Panel Interface)
    * **Libraries:** SweetAlert2, Font Awesome 4.7.0, Ionicons, various AdminLTE plugins (DataTables, Chart.js, etc.)
* **Server:** Apache or Nginx (Typical for PHP hosting)
* **OS:** Linux (Typical for hosting)

## Setup Instructions (Basic Guide - Requires Adaptation)

**Prerequisites:**
* Web Server (Apache or Nginx) with PHP enabled (Version compatibility needs checking, likely PHP 7.x)
* MySQL or MariaDB Database Server
* PHP extensions: `mysqli` or `pdo_mysql`, `gd` (for captcha/qr code), `curl` (for APIs), `mbstring`.
* Ability to configure Cron Jobs on the server.
* Valid API credentials for TPBank, MBBank, Momo, and a Scratch Card provider (e.g., TheSieuRe) if enabling automated payments.

**Steps:**

1.  **Clone Repository:**
    ```bash
    git clone <repository-url> terhost
    cd terhost
    ```
2.  **Database Setup:**
    * Create a new database (e.g., `terhost_db`) and a database user with appropriate privileges on your MySQL/MariaDB server.
    * **Crucially, a `.sql` database schema file is MISSING from this repository.** You will need to either:
        * Manually create the database tables based on the inferred structure described in analysis reports or by examining the SQL queries within the PHP code (time-consuming and error-prone).
        * Obtain the correct `.sql` schema file from the original source/developer.
    * Once you have the schema, import it into your newly created database:
        ```bash
        mysql -u your_db_user -p your_db_name < path/to/schema.sql
        ```
3.  **Configure Database Connection:**
    * Edit the file `core/database.php`.
    * Update the database host (`$db_host`), username (`$db_user`), password (`$db_pass`), and database name (`$db_name`) variables with your actual credentials.
4.  **Web Server Configuration:**
    * Configure your Apache Virtual Host or Nginx server block.
    * Set the document root to the main directory of the cloned project (the `terhost` folder).
    * Ensure the web server has read/write permissions for potential cache or upload directories if needed (requires code inspection).
    * You might need URL rewriting rules (e.g., in `.htaccess` for Apache if clean URLs are expected, though none is present in the root), but the current structure seems to rely on query parameters (`index.php?page=...`).
5.  **Configure Payment APIs & System Settings:**
    * Log in to the Admin Panel (default credentials need to be known or set directly in the database `users` table after importing the schema). The admin login path is likely via `/admin` or potentially the main login checking for admin level.
    * Navigate to the relevant settings pages (e.g., System Settings, Payment Settings, TPBank Settings, etc. - paths likely `/admin/setting-*.php`).
    * Enter valid API keys, tokens, account details, partner IDs, and desired configurations for the site and payment gateways you intend to use. **Warning:** Review how these credentials are stored and consider more secure methods than potentially saving them directly in settings.
6.  **Set Up Cron Jobs:**
    * Identify the Cron Job scripts located in the `/auth/` subdirectories (e.g., `auth/tpbank/cronjob-tpbank.php`, `auth/@apimomo/cron.php`, `auth/@apimbbank/cron.php`).
    * Configure your server's cron scheduler (`crontab -e` on Linux) to execute these scripts at regular intervals (e.g., every 1-5 minutes) using the appropriate PHP executable path.
    * Example `crontab` entry (adjust path and frequency):
        ```crontab
        */5 * * * * /usr/bin/php /path/to/terhost/auth/tpbank/cronjob-tpbank.php > /dev/null 2>&1
        */5 * * * * /usr/bin/php /path/to/terhost/auth/@apimomo/cron.php > /dev/null 2>&1
        # Add entries for other cron scripts
        ```
    * Ensure the scripts have execute permissions and the web server user running the cron job has necessary permissions.
7.  **File Permissions:** Ensure the web server has appropriate read permissions for all project files and potentially write permissions for specific directories if caching or file uploads are implemented (requires code review).
8.  **Access Site:** Open your web browser and navigate to the URL configured in your web server setup.

## Directory Structure Overview
