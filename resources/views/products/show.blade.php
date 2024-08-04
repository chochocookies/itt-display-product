@extends('layouts.app')

@section('title', 'Show Product')

@section('contents')
<div class="row">
    <div class="col mb-3">
        {!! DNS1D::getBarcodeHTML($product->product_code, 'C128') !!}
    </div>
</div>
 <!-- Tombol Edit dan Delete -->
 <div class="row">
    <div class="col mb-3">
        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
        </form>
    </div>
</div>
    <hr />
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" placeholder="Title" value="{{ $product->title }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Price</label>
            <input type="text" name="price" class="form-control" placeholder="Price" value="{{ $product->price }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Product Code</label>
            <input type="text" name="product_code" class="form-control" placeholder="Product Code" value="{{ $product->product_code }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" placeholder="Description" readonly>{{ $product->description }}</textarea>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Rak</label>
            <input type="text" name="rak" class="form-control" placeholder="Rak" value="{{ $product->rak }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Shelf</label>
            <input type="text" name="shelf" class="form-control" placeholder="Shelf" value="{{ $product->shelf }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Baris</label>
            <input type="text" name="baris" class="form-control" placeholder="Baris" value="{{ $product->baris }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Created At</label>
            <input type="text" name="created_at" class="form-control" placeholder="Created At" value="{{ $product->created_at }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Updated At</label>
            <input type="text" name="updated_at" class="form-control" placeholder="Updated At" value="{{ $product->updated_at }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <a href="https://www.klikindomaret.com/search/?key={{ $product->price }}" class="btn btn-secondary" target="_blank">
                Lihat di klikindomaret.com
            </a>
        </div>
    </div>



@endsection
