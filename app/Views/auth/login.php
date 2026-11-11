<?php $this->extend('layouts/main'); ?>
<?php $this->section('content'); ?>
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h3 class="text-center mb-4">e-RoadCheck Login</h3>
                <form method="post" action="/e-roadcheck/login">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" value="<?= old('username') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Sign In</button>
                </form>
                <div class="small text-muted mt-3">Demo admin credentials: admin / admin123</div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>
