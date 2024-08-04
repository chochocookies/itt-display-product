@extends('layouts.app')

@section('title', 'Select a Title Products')

@section('contents')
<div class="row">
    <div id="titleButtons" class="col-12 d-flex flex-wrap justify-content-center">
        <!-- Buttons will be inserted here -->
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Mendapatkan judul unik dan membuat tombol
    $.ajax({
        url: '{{ route('products.titles') }}',
        type: 'GET',
        success: function(data) {
            var titleButtons = $('#titleButtons');
            data.forEach(function(title) {
                var button = $('<button class="btn btn-outline-secondary m-2 flex-item"></button>').text(title.title);
                button.click(function() {
                    window.location.href = '{{ route('products.index') }}?title=' + title.title;
                });
                titleButtons.append(button);
            });
        }
    });
});
</script>
@endpush
