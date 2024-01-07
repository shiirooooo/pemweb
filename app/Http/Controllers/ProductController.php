<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $product = new Product();

        if ($request->has('category')) {
            $product = $product->where('category', 'like', "%{$request->category}%");
        }

        return view('products.index', [
            'products' => $product->get(),
            'foods' => Product::where('category', 'Makanan')->count(),
            'drinks' => Product::where('category', 'Minuman')->count(),
            'total' => Product::count(),
        ]);
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
        $product = $request->validate([
            'name' => 'required|string',
            'category' => 'required|in:Makanan,Minuman',
            'stock' => 'required|integer',
            'price' => 'required|integer',
            'photo' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        $hashName = $request->file('photo')->hashName();
        $product['photo'] = $request->file('photo')->move('images/products', $hashName);

        DB::beginTransaction();
        try {
            Product::create($product);
            DB::commit();
            Alert::success('Berhasil menambahkan menu');

            return redirect()->route('products.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Gagal menambahkan menu');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', [
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $productUpdate = $request->validate([
            'name' => 'required|string',
            'category' => 'required|in:Makanan,Minuman',
            'stock' => 'required|integer',
            'price' => 'required|integer',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        if ($request->hasFile('photo')) {
            if ($product->photo) {
                unlink($product->photo);
            }

            $hashName = $request->file('photo')->hashName();
            $productUpdate['photo'] = $request->file('photo')->move('images/products', $hashName);
        }

        DB::beginTransaction();
        try {
            $product->update($productUpdate);
            DB::commit();
            Alert::success('Berhasil mengubah menu');

            return redirect()->route('products.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Gagal mengubah menu');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        DB::beginTransaction();
        try {
            if ($product->photo) {
                unlink($product->photo);
            }
            $product->delete();
            DB::commit();
            Alert::success('Berhasil menghapus menu');

            return redirect()->route('products.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Gagal menghapus menu');

            return redirect()->back()->withInput();
        }
    }
}
