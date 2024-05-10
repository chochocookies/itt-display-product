@extends('layouts.app')

@section('title', 'Home Product')

@section('contents')
    <div class="row">
        @foreach($products as $rs)
            <div class="col-6 col-md-4">
            </div>
        @endforeach
    </div>
    <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm ">Add</a>
    <div class="container-fluid">
    </div>
    <div class="d-flex align-items-center justify-content-between mt-3">
        <form action="{{ route('products') }}" method="GET" class="form-inline">
            <select name="modis" class="form-control mr-2 small mb-2">
                <option value="">Modis</option>
                @foreach($modis as $m)
                <option value="{{ $m }}" {{ request('modis') == $m ? 'selected' : '' }}>{{ $m }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-secondary btn-sm mb-2">Filter</button>
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
                    <th class="text-sm">#</th>
                    <th class="text-sm">Modis</th>
                    <th class="text-sm">PLU</th>
                    <th class="text-sm">Product Code</th>
                    <th class="text-sm">Description</th>
                    <th class="text-sm">Action</th>
                </tr>
            </thead>
            <tbody>
                @if($products->count() > 0)
                    @foreach($products as $rs)
                        <tr>
                            <th scope="row" class="align-middle text-xs">{{ $loop->iteration }}</th>
                            <td class="align-middle text-xs">{{ $rs->title }}</td>
                            <td class="align-middle text-xs">{{ $rs->price }}</td>
                            <td class="align-middle text-xs">
                                @if ($rs->product_code)
                                <a href="#" class="barcode-link text-xs"
                                data-toggle="modal"
                                data-target="#barcodeModal{{$rs->id}}"
                                data-product-code="{{ $rs->product_code }}"
                                data-description="{{ $rs->description }}">
                                 {!! DNS1D::getBarcodeHTML($rs->product_code, 'C128', 2, 50) !!}
                             </a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="barcodeModal{{$rs->id}}" tabindex="-1" role="dialog" aria-labelledby="barcodeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header justify-center align-content-center">
                                                    <h5 class="modal-title" id="barcodeModalLabel">{{ $rs->description }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body align-items-md-center">
                                                    {!! DNS1D::getBarcodeHTML($rs->product_code, 'C128', 2, 50) !!}
                                                    <h6 class="mt-1">{{ $rs->product_code }}</h6>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" id="prevButton" class="btn btn-primary">Previous</button>
                                                    <button type="button" id="nextButton" class="btn btn-primary">Next</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                    </div>
                                @else
                                    (No barcode)
                                @endif
                            </td>
                            <td class="align-middle text-xs">{{ $rs->description }}</td>
                            <td class="align-middle text-xs">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('products.show', $rs->id) }}" type="button" class="btn btn-secondary text-xs">Detail</a>
                                    <a href="{{ route('products.edit', $rs->id)}}" type="button" class="btn btn-warning text-xs">Edit</a>
                                    <form action="{{ route('products.destroy', $rs->id) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger text-xs m-0">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <th scope="row" class="text-center text-sm" colspan="6">Product not found</th>
                    </tr>
                @endif
            </tbody>

        </table>
    </div>
    <div class="d-flex justify-content-center mt-4 mb-1">
        {{ $products->links() }}
    </div>

@endsection
