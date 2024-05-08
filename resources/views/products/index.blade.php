@extends('layouts.app')

@section('title', 'Home Product')

@section('contents')
    <div class="row">
        @foreach($product as $rs)
            <div class="col-6 col-md-4">
                <!-- Konten setiap produk -->
            </div>
        @endforeach
    </div>

    <div class="d-flex align-items-center justify-content-between mt-3">
        <h4 class="mb-0">List Product</h4>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Add</a>
        <form action="{{ route('products') }}" method="GET" class="form-inline">
            <select name="modis" class="form-control mr-2">
                <option value="">Modis</option>
                @foreach($modis as $m)
                    <option value="{{ $m }}" {{ request('modis') == $m ? 'selected' : '' }}>{{ $m }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-secondary">Filter</button>
        </form>
    </div>

    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-primary">
                <tr>
                    <th class="small">#</th>
                    <th class="small">Modis</th>
                    <th class="small">PLU</th>
                    <th class="small">Product Code</th>
                    <th class="small">Description</th>
                    <th class="small">Action</th>
                </tr>
            </thead>
            <tbody>
                @if($product->count() > 0)
                    @foreach($product as $rs)
                        <tr>
                            <td class="align-middle small">{{ $loop->iteration }}</td>
                            <td class="align-middle small">{{ $rs->title }}</td>
                            <td class="align-middle small">{{ $rs->price }}</td>
                            <td class="align-middle small">
                                @if ($rs->product_code)
                                    <a href="#" class="barcode-link" data-product-code="{{ $rs->product_code }}">
                                        {!! DNS1D::getBarcodeHTML($rs->product_code, 'C128', 2, 50) !!}
                                    </a>
                                @else
                                    (No barcode)
                                @endif
                            </td>
                            <td class="align-middle small">{{ $rs->description }}</td>
                            <td class="align-middle">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('products.show', $rs->id) }}" type="button" class="btn btn-secondary btn-sm">Detail</a>
                                    <a href="{{ route('products.edit', $rs->id)}}" type="button" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('products.destroy', $rs->id) }}" method="POST" type="button" class="btn btn-danger btn-sm p-0" onsubmit="return confirm('Delete?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger m-0">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center small" colspan="5">Product not found</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
