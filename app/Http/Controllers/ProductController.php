<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search  = $request->get('query');
        $perPage = (int) $request->get('size', 10);

        $query = Product::query();

        if ($search) {
            $query->where('nama', 'like', "%{$search}%")
                ->orWhere('harga', 'like', "%{$search}%")
                ->orWhere('stok', 'like', "%{$search}%");
        }

        $products = $query
            ->paginate($perPage)
            ->appends([
                'search' => $search,
                'size'   => $perPage,
            ]);

        return view('pages.product', compact('products', 'search', 'perPage'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();
        $product = Product::create($validated);

        return redirect()->route('products.index')
            ->with('success', "Product “{$product->nama}” berhasil ditambahkan.");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();

        $product->update($validated);

        return redirect()->route('products.index')->with('success', "Data produk berhasil diperbarui.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Product::destroy($product->id);

        return redirect()->back()->with('success', "Product berhasil dihapus.");
    }
}
