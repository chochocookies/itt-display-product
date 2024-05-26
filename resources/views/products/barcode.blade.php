@extends('layouts.app')

@section('title', 'Barcode for ' . $product->title)

@section('contents')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Barcode for {{ $product->title }}</h6>
        </div>
        <div class="card-body">
            <div class="text-center">
                {!! $barcode !!}
                <p>Product Code: {{ $product->product_code }}</p>
            </div>
        </div>
    </div>
@endsection
