@extends('layouts.app')

@section('title', 'List Product')

@section('contents')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="{{ route('products.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add Product
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Product List for "{{ $title }}"</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive"> <!-- Tambahkan div ini -->
                <table class="table table-bordered display responsive nowrap" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Rak</th>
                            <th>Shelf</th>
                            <th>Baris</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Product Code</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Data akan dimasukkan di sini oleh DataTables --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    function initializeDataTable() {
        var urlParams = new URLSearchParams(window.location.search);
        var title = urlParams.get('title');

        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            pageLength: 25, // Tampilkan 25 data secara default
            ajax: {
                url: '{{ route('products.data') }}',
                type: 'GET',
                data: function(d) {
                    d.title = title;
                },
            },
            columns: [
                { data: 'title', name: 'title' },
                { data: 'rak', name: 'rak' },
                { data: 'shelf', name: 'shelf' },
                { data: 'baris', name: 'baris' },
                { data: 'price', name: 'price' },
                { data: 'description', name: 'description' },
                {
                    data: 'product_code',
                    name: 'product_code',
                    render: function(data, type, row) {
                        return '<svg class="barcode" jsbarcode-format="CODE128" jsbarcode-value="' + data + '" jsbarcode-textmargin="0" jsbarcode-height="50" jsbarcode-width="2"></svg>';
                    }
                },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
            drawCallback: function(settings) {
                JsBarcode(".barcode").init(); // Inisialisasi JsBarcode setiap kali tabel digambar ulang
            }
        });
    }

    // Hancurkan DataTable yang ada sebelum menginisialisasi ulang
    if ($.fn.DataTable.isDataTable('#dataTable')) {
        $('#dataTable').DataTable().clear().destroy();
    }

    // Inisialisasi DataTable
    initializeDataTable();
});
</script>
@endpush
