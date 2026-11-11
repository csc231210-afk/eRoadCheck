<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'e-RoadCheck') ?></title>
    <link rel="stylesheet" href="/e-roadcheck/public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/e-roadcheck/public/assets/css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/e-roadcheck/">e-RoadCheck</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (session('user_id')): ?>
                        <li class="nav-item"><a class="nav-link" href="/e-roadcheck/<?= session('role') === 'admin' ? 'admin/dashboard' : 'officer/dashboard' ?>"><?= esc(session('full_name')) ?></a></li>
                        <li class="nav-item"><a class="nav-link" href="/e-roadcheck/logout">Logout</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="/e-roadcheck/login">Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container my-4">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('errors')): ?>
            <?php foreach (session()->getFlashdata('errors') as $err): ?>
                <div class="alert alert-danger"><?= esc($err) ?></div>
            <?php endforeach; ?>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
    </main>

    <footer class="bg-dark text-light py-3 mt-5">
        <div class="container text-center">&copy; <?= date('Y') ?> e-RoadCheck</div>
    </footer>

    <script src="/e-roadcheck/public/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/e-roadcheck/public/assets/js/app.js"></script>
</body>
</html>
