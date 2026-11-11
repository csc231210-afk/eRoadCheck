document.addEventListener('DOMContentLoaded', function () {
    const manualForm = document.getElementById('manualScanForm');
    const manualToken = document.getElementById('manualToken');
    if (manualForm && manualToken) {
        manualForm.addEventListener('submit', function (e) {
            const value = manualToken.value.trim();
            if (! value) return;
            if (value.includes('/verify/')) {
                const match = value.match(/verify\/([^/?]+)/);
                if (match) {
                    manualToken.value = match[1];
                }
            }
        });
    }
});
