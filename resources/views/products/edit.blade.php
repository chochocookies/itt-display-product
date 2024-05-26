@extends('layouts.app')

@section('title', 'Edit Product')

@section('contents')
    <hr />
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="form-group">
            <label for="rak">Rak:</label>
            <input type="text" class="form-control" id="rak" name="rak">
        </div>
        <div class="form-group">
            <label for="shelf">Shelf:</label>
            <input type="text" class="form-control" id="shelf" name="shelf">
        </div>
        <div class="form-group">
            <label for="baris">Baris:</label>
            <input type="text" class="form-control" id="baris" name="baris">
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" class="form-control" id="price" name="price">
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="form-group">
            <label for="product_code">Product Code:</label>
            <input type="text" class="form-control" id="product_code" name="product_code">
        </div>
        <button class="btn btn-warning btn-sm">Update</button>
    </form>
@endsection
