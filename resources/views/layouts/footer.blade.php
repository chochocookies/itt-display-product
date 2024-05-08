<footer class="sticky-footer bg-white">
    <div class="container my-auto">
      <div class="copyright text-center my-auto">
        <span>Pika>_ © by <a href="https://www.instagram.com/cho_aryant/">ekoAryanto</a> 2024</span>
      </div>
    </div>
  </footer>
  <script>
        document.querySelectorAll('.barcode-link').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Menahan aksi default dari link

            const barcodeCarouselInner = document.getElementById('barcodeCarouselInner');
            barcodeCarouselInner.innerHTML = '';

            const productCode = this.dataset.productCode;
            const barcodeImgUrl = `/generate-barcode/${productCode}`;

            const barcodeItem = document.createElement('div');
            barcodeItem.classList.add('carousel-item');
            barcodeItem.innerHTML = `
                <img src="${barcodeImgUrl}" class="d-block mx-auto w-full" style="max-width: 100%;" alt="Barcode Image">
            `;
            barcodeCarouselInner.appendChild(barcodeItem);

            const firstItem = barcodeCarouselInner.querySelector('.carousel-item');
            firstItem.classList.add('active');

            const barcodeModal = new bootstrap.Modal(document.getElementById('barcodeModal'));
            barcodeModal.show();
        });
    });
  </script>