<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{

    public function create()
    {
        if (auth()->user()->shop) {
            return redirect()->route('admin.dashboard');
        }

        return view('shop.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'store_name' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);

        Shop::create([
            'user_id' => auth()->id(),
            'store_name' => $request->store_name,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        return redirect()->route('admin.dashboard');
    }


    public function profile()
{
    $shop = auth()->user()->shop;

    if (!$shop) {
        $shop = \App\Models\Shop::create([
            'user_id' => auth()->id(),
            'store_name' => '',
            'address' => '',
            'phone' => '',
        ]);
    }

    return view('admin.profile', compact('shop'));
}


   public function updateProfile(Request $request)
{
    $shop = auth()->user()->shop;

    $data = $request->validate([
        'store_name' => 'required',
        'address' => 'required',
        'phone' => 'required',
        'photo' => 'image|mimes:jpg,png,jpeg|max:2048'
    ]);

    if ($request->hasFile('photo')) {

        $image = $request->file('photo');
        $name = time().'.'.$image->getClientOriginalExtension();

        $image->move(public_path('uploads'), $name);

        $data['photo'] = $name;
    }

    $shop->update($data);

    return back()->with('success','Profil berhasil diupdate');
}
}