<?php $this->extend('layouts/main'); ?>
<?php $this->section('content'); ?>
<div class="row">
    <div class="col-md-12">
        <h2 class="mb-3">Administrator Dashboard</h2>
        <div class="row g-3">
            <?php foreach ($stats as $key => $value): ?>
                <div class="col-md-3">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <div class="text-muted text-uppercase small"><?= esc(str_replace('_', ' ', $key)) ?></div>
                            <h3 class="mt-2 mb-0"><?= esc($value) ?></h3>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="card shadow-sm border-0 mt-4">
            <div class="card-header bg-white">
                <strong>Recent verification activity</strong>
            </div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Officer</th>
                            <th>Result</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($recent)): ?>
                            <tr><td colspan="3">No verification activity yet.</td></tr>
                        <?php else: ?>
                            <?php foreach ($recent as $log): ?>
                                <tr>
                                    <td><?= esc($log['officer_name'] ?? 'System') ?></td>
                                    <td><?= esc($log['result']) ?></td>
                                    <td><?= esc($log['verified_at']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>
