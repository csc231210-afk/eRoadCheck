# e-RoadCheck

This repository contains the source code for the e-RoadCheck project: a QR code-based driver's license and vehicle document verification system for road safety enforcement.

## Tech stack
- CodeIgniter 4
- PHP
- MySQL/MariaDB
- Bootstrap 5
- html5-qrcode
- chillerlan/php-qrcode

## Local setup
1. Install XAMPP and start Apache + MySQL.
2. Create a database named `eroadcheck`.
3. Import `database/schema.sql`.
4. Run `composer install` in the project root.
5. Configure `.env` with your local database values.
6. Open the app in the browser at `http://localhost/e-roadcheck/`.

## Default admin login
- Username: `admin`
- Password: `admin123`

## Notes
This is a prototype project for academic development and demonstration. It does not connect to government systems or official payment gateways.
