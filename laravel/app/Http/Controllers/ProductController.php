<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create($store_id)
    {
        $store = Store::findOrFail($store_id);
        return view('products.create', compact('store'));
    }

    public function store(Request $request, $store_id)
    {
        $store = Store::findOrFail($store_id);

        $validated = $request->validate([
            'name_product' => 'required|string|max:255',
            'price' => 'required|numeric',
            'desc' => 'nullable|string',
            'img_product' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('img_product')) {
            $validated['img_product'] = $request->file('img_product')->store('products', 'public');
        }

        $validated['store_id'] = $store->id;
        Product::create($validated);

        return redirect()->route('stores.products.index', $store_id)->with('success', 'Produk berhasil ditambahkan');
    }
}
