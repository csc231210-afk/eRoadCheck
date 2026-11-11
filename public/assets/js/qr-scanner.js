const qrReader = document.getElementById('qr-reader');
const statusBox = document.getElementById('scan-status');
if (qrReader && statusBox) {
    const html5QrCode = new Html5Qrcode('qr-reader');
    const cameraConfig = { facingMode: 'environment' };
    Html5Qrcode.getCameras().then(devices => {
        if (devices && devices.length) {
            html5QrCode.start(
                { facingMode: 'environment' },
                { fps: 10, qrbox: { width: 250, height: 250 } },
                decodedText => {
                    statusBox.textContent = 'QR code detected. Verifying...';
                    const token = decodedText.includes('/verify/') ? decodedText.split('/verify/')[1].split(/[?&#]/)[0] : decodedText;
                    window.location.href = '/e-roadcheck/verify/' + token;
                },
                () => {}
            ).catch(() => {
                statusBox.textContent = 'Camera access is unavailable. Use the manual verification field instead.';
            });
        } else {
            statusBox.textContent = 'No camera available. Use the manual verification token field.';
        }
    }).catch(() => {
        statusBox.textContent = 'Camera permission was not granted. Use the manual verification field instead.';
    });
}
