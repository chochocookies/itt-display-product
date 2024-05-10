@extends('layouts.app')

@section('title', 'Create Product')

@section('contents')
    <hr />
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="title" class="form-control" placeholder="Modis">
            </div>
            <div class="col">
                <input type="text" name="price" class="form-control" placeholder="PLU">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="product_code" class="form-control" placeholder="Product Code">
            </div>
            <div class="col">
                <textarea class="form-control" name="description" placeholder="Descriptoin"></textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
    </form>
@endsection
