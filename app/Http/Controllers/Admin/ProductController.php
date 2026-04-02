<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    // tampil produk milik user
    public function index()
    {
        $products = Product::where('user_id', auth()->id())->get();

        return view('admin.products', compact('products'));
    }


    // form tambah produk
    public function create()
    {
        return view('admin.product_create');
    }


    // simpan produk + upload foto
    public function store(Request $request)
    {
        $request->validate([
    'name' => 'required',
    'price' => 'required|numeric',
    'stock' => 'required|numeric',
    'image' => 'required|image|mimes:jpg,png,jpeg,webp|max:2048'
]);

        // upload gambar
        $imageName = null;

        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();

            $request->image->move(public_path('products'), $imageName);
        }

        Product::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imageName,
        ]);

        return redirect()->route('admin.products');
    }

    public function edit($id)
{
    $product = Product::findOrFail($id);

    return view('admin.product_edit', compact('product'));
}


public function update(Request $request,$id)
{
    $product = Product::findOrFail($id);

    $product->update([
        'name'=>$request->name,
        'price'=>$request->price,
        'stock'=>$request->stock
    ]);

    return redirect()->route('admin.products');
}


public function delete($id)
{
    $product = Product::findOrFail($id);

    $product->delete();

    return redirect()->route('admin.products');
}
}