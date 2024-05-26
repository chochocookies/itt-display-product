<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Yajra\DataTables\DataTables;
use Milon\Barcode\DNS1D;

class ProductController extends Controller
{
    public function data(Request $request)
    {
        $title = $request->query('title', '');

        $products = Product::query();

        if ($title) {
            $products->where('title', $title);
        }

        return DataTables::of($products)
            ->addColumn('action', function ($product) {
                return '<a href="'.route('products.show', $product->id).'" class="btn btn-primary">View</a>';
            })
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = $request->query('title', ''); // Jika tidak ada title yang dikirim, default ke string kosong
        // \Log::info('Title from URL:', ['title' => $title]); // Tambahkan logging untuk debugging
        return view('products.index', compact('title'));
    }

    // public function index()
    // {
    //     return view('products.index');
    // }
    // public function index(Request $request)
    // {
    //     $title = $request->query('title', ''); // Jika tidak ada title yang dikirim, default ke string kosong
    //     return view('products.index', compact('title'));
    // }

    /**
     * Get data for DataTables.
     */
    // public function data(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $query = Product::query();
    //         return DataTables::of($query)
    //             ->addColumn('action', function($row) {
    //                 $editUrl = route('products.edit', $row->id);
    //                 $deleteUrl = route('products.destroy', $row->id);
    //                 return '
    //                     <a href="'.$editUrl.'" class="btn btn-sm btn-primary">Edit</a>
    //                     <form action="'.$deleteUrl.'" method="POST" style="display:inline;">
    //                         '.csrf_field().'
    //                         '.method_field('DELETE').'
    //                         <button type="submit" class="btn btn-sm btn-danger">Delete</button>
    //                     </form>
    //                 ';
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }
    // }
    // public function data()
    // {
    //     $products = Product::select(['id', 'title', 'rak', 'shelf', 'baris', 'price', 'description', 'product_code']);

    //     return DataTables::of($products)
    //         ->addColumn('action', function ($product) {
    //             return '<a href="'.route('products.show', $product->id).'" class="btn btn-primary">View</a>';
    //         })
    //         ->make(true);
    // }

    public function getUniqueTitles()
    {
        $titles = Product::select('title')->distinct()->get();
        return response()->json($titles);
    }
    public function getTitles()
    {
        $titles = Product::select('title')->distinct()->get();
        return response()->json($titles);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'rak' => 'required|string|max:255',
            'shelf' => 'required|string|max:255',
            'baris' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'description' => 'required|string',
            'product_code' => 'required|string|max:255|unique:products,product_code',
        ]);

        // Simpan data ke database
        Product::create($validatedData);

        return redirect()->route('products.index')->with('success', 'Product added successfully');
    }


    /**
     * Generate barcode for a specific product.
     */
    // public function generateBarcode($id)
    // {
    //     $product = Product::findOrFail($id);
    //     $barcode = DNS1D::getBarcodeHTML($product->product_code, 'C128');

    //     return view('products.barcode', compact('barcode', 'product'));
    // }
    // public function generateBarcode($id)
    // {
    //     $product = Product::findOrFail($id);
    //     $barcode = DNS1D::getBarcodeHTML($product->product_code, 'C128');

    //     return view('products.barcode', compact('barcode', 'product'));
    // }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'rak' => 'required|string|max:255',
            'shelf' => 'required|string|max:255',
            'baris' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'product_code' => 'required|string|max:255',
        ]);

        $product = Product::findOrFail($id);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }

    public function dashboard()
    {
        $titles = Product::distinct()->pluck('title'); // Mengambil judul unik dari database
        return view('dashboard', compact('titles'));
    }
}
