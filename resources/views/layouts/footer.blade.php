<footer class="sticky-footer bg-white">
    <div class="container my-auto">
      <div class="copyright text-center my-auto">
        <span>Pika>_ © by <a href="https://www.instagram.com/cho_aryant/">ekoAryanto</a> 2024</span>
      </div>
    </div>
  </footer>
  @section('scripts')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
  $(document).ready(function() {
      // Menampilkan modal dengan barcode preview dan deskripsi
      $('.barcode-link').click(function(e) {
          e.preventDefault(); // Mencegah tindakan default dari link

          // Ambil data dari link
          var productCode = $(this).data('product-code');
          var description = $(this).data('description');
          var barcodeHtml = $(this).html();

          // Ubah isi modal sesuai dengan data
          $('#barcodeModal .modal-body').html('<div class="text-center">' + barcodeHtml + '</div><div class="text-center">' + productCode + '</div><p>' + description + '</p>');

          // Tampilkan modal
          $('#barcodeModal').modal('show');
      });

      // Menangani klik pada tombol next
      $('#nextButton').on('click touchstart', function() {
          // Pindah ke modal berikutnya
          var $nextModal = $('#barcodeModal').next('.modal');
          if ($nextModal.length > 0) {
              $('#barcodeModal').modal('hide');
              $nextModal.modal('show');
          }
      });

      // Menangani klik pada tombol prev
      $('#prevButton').on('click touchstart', function() {
          // Pindah ke modal sebelumnya
          var $prevModal = $('#barcodeModal').prev('.modal');
          if ($prevModal.length > 0) {
              $('#barcodeModal').modal('hide');
              $prevModal.modal('show');
          }
      });
  });
  </script>
  @endsection


