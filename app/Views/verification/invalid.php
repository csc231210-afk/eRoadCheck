<?php $this->extend('layouts/main'); ?>
<?php $this->section('content'); ?>
<div class="card shadow-sm border-0">
    <div class="card-body">
        <h3 class="mb-3 text-danger"><?= esc($message) ?></h3>
        <a href="/e-roadcheck/officer/scan" class="btn btn-primary">Back to scanner</a>
    </div>
</div>
<?php $this->endSection(); ?>
