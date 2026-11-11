# e-RoadCheck Front Controller

The project has two entry points:

- `public/index.php` is the CodeIgniter 4 front controller and is the recommended Apache document root entry point.
- `index.php` at the repository root is a small convenience wrapper for local XAMPP setups that point Apache at the repository root.

For normal installation, install Composer dependencies, import `database/schema.sql`, configure `.env`, then open `http://localhost/e-roadcheck/public/`. For a safer setup, configure Apache's `DocumentRoot` to the project's `public` directory.
