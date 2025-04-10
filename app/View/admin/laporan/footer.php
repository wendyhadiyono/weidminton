    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="<?= BASEURL ?>/js/bootstrap.bundle.min.js"></script>
    <script>
    function convertHTMLToImageAndShowModal(elementId, scaleFactor = 2) {
        const elementToCapture = document.getElementById(elementId);
        const previewImage = document.getElementById('gambarPratinjau');
        const downloadLink = document.getElementById('linkUnduh');
        const imagePreviewModal = new bootstrap.Modal(document.getElementById('modalPratinjau'));

        if (!elementToCapture) {
            console.error("Element dengan ID yang diberikan tidak ditemukan.");
            return;
        }

        html2canvas(elementToCapture, {scale: scaleFactor})
            .then(canvas => {
                const imageDataURL = canvas.toDataURL('image/png');
                previewImage.src = imageDataURL;
                downloadLink.href = imageDataURL;
                imagePreviewModal.show();
            })
            .catch(error => {
                console.error("Terjadi kesalahan saat membuat gambar:", error);
            });
    }

    document.addEventListener('DOMContentLoaded', () => {
        const captureButton = document.getElementById('tombolUnduh');
        if (captureButton) {
            captureButton.addEventListener('click', () => {
                convertHTMLToImageAndShowModal('laporan', 3);
            });
        }
    });
    </script>
</body>
</html>