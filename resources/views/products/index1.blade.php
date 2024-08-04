@extends('layouts.app')

@section('title', 'List Product')

@section('contents')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="{{ route('products.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add Product
        </a>
    </div>

    <!-- Filter Rak -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="minRak">Min Rak</label>
                        <select id="minRak" class="form-control">
                            <option value="">Select Min Rak</option>
                            @foreach($raks as $rak)
                                <option value="{{ $rak }}">{{ $rak }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4 align-content-center">
                    <div class="form-group">
                        <label for="maxRak">Max Rak</label>
                        <select id="maxRak" class="form-control">
                            <option value="">Select Max Rak</option>
                            @foreach($raks as $rak)
                                <option value="{{ $rak }}">{{ $rak }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button id="filterRakBtn" class="btn btn-primary">Filter Rak</button>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Product List for "{{ $title }}"</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered display responsive nowrap" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Product Code</th>
                            <th>Description</th>
                            <th>Rak</th>
                            <th>Shelf</th>
                            <th>Baris</th>
                            <th>Price</th>
                            <th>Title</th>
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

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>

    <script>
$(document).ready(function() {
    function initializeDataTable(minRak, maxRak) {
        var urlParams = new URLSearchParams(window.location.search);
        var title = urlParams.get('title');

        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            pageLength: 25,
            ajax: {
                url: '{{ route('products.data') }}',
                type: 'GET',
                data: function(d) {
                    d.title = title;
                    d.minRak = minRak; // Tambahkan parameter minRak
                    d.maxRak = maxRak; // Tambahkan parameter maxRak
                },
            },
            columns: [
                {
                    data: 'product_code',
                    name: 'product_code',
                    render: function(data, type, row) {
                        return '<svg class="barcode" jsbarcode-format="CODE128" jsbarcode-value="' + data + '" jsbarcode-textmargin="0" jsbarcode-height="50" jsbarcode-width="2"></svg>';
                    }
                    // { data: 'description', name: 'description'  },
                },
                { data: 'description', name: 'description'  },
                { data: 'rak', name: 'rak' },
                { data: 'shelf', name: 'shelf' },
                { data: 'baris', name: 'baris' },
                { data: 'price', name: 'price' },
                { data: 'title', name: 'title' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
            drawCallback: function(settings) {
                JsBarcode(".barcode").init();
            },
            destroy: true // Tambahkan opsi ini agar DataTable dapat diinisialisasi ulang
        });
    }

    // Inisialisasi DataTable pertama kali tanpa filter rak
    initializeDataTable(null, null);

    // Event listener untuk tombol filter
    $('#filterRakBtn').click(function() {
        var minRak = $('#minRak').val();
        var maxRak = $('#maxRak').val();
        $('#dataTable').DataTable().clear().destroy(); // Hancurkan DataTable yang ada sebelum menginisialisasi ulang
        initializeDataTable(minRak, maxRak); // Inisialisasi DataTable dengan filter rak
    });
});

    </script>
@endpush
