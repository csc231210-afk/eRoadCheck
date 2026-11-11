<?php $this->extend('layouts/main'); ?>
<?php $this->section('content'); ?>
<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <strong>Verification history</strong>
    </div>
    <div class="card-body p-0">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>Result</th>
                    <th>Summary</th>
                    <th>Verified</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($logs)): ?>
                    <tr><td colspan="3">No verification history available.</td></tr>
                <?php else: ?>
                    <?php foreach ($logs as $log): ?>
                        <tr>
                            <td><?= esc($log['result']) ?></td>
                            <td><?= esc($log['summary'] ?? 'Completed') ?></td>
                            <td><?= esc($log['verified_at']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $this->endSection(); ?>
