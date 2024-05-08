<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Product;
use Milon\Barcode\DNS1D;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::orderBy('created_at', 'DESC');
    
        if ($request->has('modis') && $request->input('modis') !== '') {
            $query->where('title', $request->input('modis'));
        }
    
        $product = $query->get();
        $modis = Product::select('title')->distinct()->pluck('title')->toArray();
    
        return view('products.index', compact('product', 'modis'));
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
        Product::create($request->all());
 
        return redirect()->route('products')->with('success', 'Product added successfully');

    }
  
    public function generateBarcode($id)
    {
        $product = Product::findOrFail($id);
        $barcode = DNS1D::getBarcodeHTML($product->product_code, 'C128');

        return view('products.barcode', compact('barcode', 'product'));
    }

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
        $product = Product::findOrFail($id);
  
        $product->update($request->all());
  
        return redirect()->route('products')->with('success', 'product updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
  
        $product->delete();
  
        return redirect()->route('products')->with('success', 'product deleted successfully');
    }
}