<?php $this->extend('layouts/main'); ?>
<?php $this->section('content'); ?>
<div class="card shadow-sm border-0">
    <div class="card-body">
        <h3 class="mb-3">Scan QR code</h3>
        <form id="manualScanForm" method="get" action="/e-roadcheck/verify">
            <div class="row g-3 align-items-end">
                <div class="col-md-10">
                    <label class="form-label">Verification token</label>
                    <input class="form-control" type="text" name="token" id="manualToken" placeholder="Paste QR code token or URL here">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Verify</button>
                </div>
            </div>
        </form>

        <div class="mt-4">
            <div id="qr-reader" style="width: 100%; max-width: 500px; margin: 0 auto;"></div>
            <div id="scan-status" class="text-muted mt-2">Waiting for camera or uploaded QR image...</div>
        </div>
    </div>
</div>

<script src="/e-roadcheck/public/assets/vendor/html5-qrcode/html5-qrcode.min.js"></script>
<script src="/e-roadcheck/public/assets/js/qr-scanner.js"></script>
<?php $this->endSection(); ?>
