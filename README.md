# e-RoadCheck

This repository contains the source code for the e-RoadCheck project.

## Local setup
1. Install XAMPP and start Apache + MySQL.
2. Create a MySQL database named `eroadcheck`.
3. Import the SQL from `database/schema.sql` and `database/seed.sql`.
4. Run `composer install` at the project root.
5. Configure the database in `.env` if needed.
6. Open the app in the browser using:
   - `http://localhost/e-roadcheck/public/`
   or if Apache points at the repository root:
   - `http://localhost/e-roadcheck/`

## Default login
- Username: `admin`
- Password: `password`
