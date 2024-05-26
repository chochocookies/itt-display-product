@extends('layouts.app')

@section('title', 'Create Product')

@section('contents')
<div class="container">
    <h2>Create Product</h2>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="rak">Rak:</label>
            <input type="text" class="form-control" id="rak" name="rak" required>
        </div>
        <div class="form-group">
            <label for="shelf">Shelf:</label>
            <input type="text" class="form-control" id="shelf" name="shelf" required>
        </div>
        <div class="form-group">
            <label for="baris">Baris:</label>
            <input type="text" class="form-control" id="baris" name="baris" required>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" class="form-control" id="price" name="price" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="product_code">Product Code:</label>
            <input type="text" class="form-control" id="product_code" name="product_code" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
