@extends('layouts.app')

@section('title', 'Edit Product')

@section('contents')
    <hr />
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Modis</label>
                <input type="text" name="title" class="form-control" placeholder="Modis" value="{{ $product->title }}" >
            </div>
            <div class="col mb-3">
                <label class="form-label">PLU</label>
                <input type="text" name="price" class="form-control" placeholder="Plu" value="{{ $product->price }}" >
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Product Code</label>
                <input type="text" name="product_code" class="form-control" placeholder="Barcode" value="{{ $product->product_code }}" >
            </div>
            <div class="col mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" placeholder="Descriptoin" >{{ $product->description }}</textarea>
            </div>
        </div>
        <button class="btn btn-warning btn-sm">Update</button>
    </form>
@endsection
