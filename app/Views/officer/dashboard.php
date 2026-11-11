<?php $this->extend('layouts/main'); ?>
<?php $this->section('content'); ?>
<div class="row">
    <div class="col-md-12">
        <h2 class="mb-3">Enforcement Officer Dashboard</h2>
        <div class="row g-3">
            <div class="col-md-4">
                <a class="btn btn-primary btn-lg w-100" href="/e-roadcheck/officer/scan">Scan QR Code</a>
            </div>
            <div class="col-md-4">
                <a class="btn btn-outline-primary btn-lg w-100" href="/e-roadcheck/officer/history">Verification History</a>
            </div>
            <div class="col-md-4">
                <a class="btn btn-outline-secondary btn-lg w-100" href="/e-roadcheck/verify">Manual Verification</a>
            </div>
        </div>

        <div class="card shadow-sm border-0 mt-4">
            <div class="card-header bg-white"><strong>Recent activity</strong></div>
            <div class="card-body">
                <?php if (empty($recent)): ?>
                    <p class="text-muted mb-0">No recent verification records.</p>
                <?php else: ?>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($recent as $log): ?>
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <strong><?= esc($log['result']) ?></strong>
                                    <small><?= esc($log['verified_at']) ?></small>
                                </div>
                                <small><?= esc($log['summary'] ?? 'Verification completed') ?></small>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>
