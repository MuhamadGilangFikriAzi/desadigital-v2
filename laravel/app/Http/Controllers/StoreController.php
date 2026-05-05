<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class StoreController extends Controller
{
    public function index(Request $request)
    {
        $query = Store::query();

        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        $stores = $query->latest()->paginate(10);

        return view('stores.index', compact('stores'));
    }


    public function create()
    {
        return view('stores.create');
    }

    public function store(Request $request)
    {
        // dd($request);

        $validated = $request->validate([
            'name' => 'required',
            'whatsapp_no' => 'nullable|string',
            'desc' => 'nullable|string',
            // 'img_store' => 'nullable|image|max:2048',
            'products.*.name_product' => 'required|string',
            'products.*.price' => 'required|numeric',
            'products.*.desc' => 'nullable|string',
            // 'products.*.img_product' => 'nullable|image|max:2048',
        ]);
        // Wrap everything in a transaction
        DB::beginTransaction();

        try {
            if ($request->hasFile('img_store')) {
                $image = $request->file('img_store');
                $filename = time() . '_' . $image->getClientOriginalName();
                Storage::disk('stores')->putFileAs('', $image, $filename);
                $validated['img_store'] = 'img/stores/' . $filename;
            }

            $store = Store::create($validated);

            // Simpan produk
            if (!empty($request->products)) {
                foreach ($request->products as $product) {
                    $productData = $product;

                    if (!empty($product['img_product']) && $product['img_product'] instanceof \Illuminate\Http\UploadedFile) {
                        $productImage = $product['img_product'];
                        $filename = time() . '_' . $productImage->getClientOriginalName();
                        Storage::disk('product')->putFileAs('', $productImage, $filename);
                        $productData['img_product'] = 'img/products/' . $filename;
                    }

                    $productData['store_id'] = $store->id;
                    Product::create($productData);
                }
            }

            DB::commit();

            return redirect()->route('stores.index')->with('success', 'Toko dan produk berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()])->withInput();
        }
    }

    public function edit($id)
    {
        $store = Store::findOrFail($id);
        return view('stores.edit', compact('store'));
    }

    // Update Store dan Produk
    public function update(Request $request, $id)
    {
        $store = Store::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string',
            'whatsapp_no' => 'nullable|string',
            'desc' => 'nullable|string',
            // 'img_store' => 'nullable|image|max:2048',
            'products' => 'nullable|array',
            'products.*.name_product' => 'required|string',
            'products.*.price' => 'required|numeric',
            'products.*.desc' => 'nullable|string',
            // 'products.*.img_product' => 'nullable|image|max:2048',
        ]);

        DB::beginTransaction();

        try {
            // Data store
            $storeData = collect($validated)->only(['name', 'whatsapp_no', 'desc'])->toArray();

            // Upload gambar store
            if ($request->hasFile('img_store')) {
                $image = $request->file('img_store');
                $filename = time() . '_' . $image->getClientOriginalName();
                Storage::disk('stores')->putFileAs('', $image, $filename);
                $storeData['img_store'] = 'img/stores/' . $filename;
            }

            $store->update($storeData);

            // Hapus semua produk lama
            Product::where('store_id', $store->id)->delete();

            // Create ulang produk
            if (!empty($request->products) && is_array($request->products)) {
                foreach ($request->products as $index => $product) {
                    $productData = [
                        'name_product' => $product['name_product'],
                        'price' => $product['price'],
                        'desc' => $product['desc'] ?? null,
                        'store_id' => $store->id,
                    ];

                    // Upload gambar produk
                    if ($request->hasFile("products.$index.img_product")) {
                        $productImage = $request->file("products.$index.img_product");
                        $filename = time() . '_' . $productImage->getClientOriginalName();
                        Storage::disk('product')->putFileAs('', $productImage, $filename);
                        $productData['img_product'] = 'img/products/' . $filename;
                    }

                    Product::create($productData);
                }
            }

            DB::commit();
            return redirect()->route('stores.index')->with('success', 'Toko dan produk berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal memperbarui data: ' . $e->getMessage()])->withInput();
        }
    }





    public function destroy($id)
    {
        $store = Store::findOrFail($id);
        $store->delete();

        return redirect()->route('stores.index')->with('success', 'Store deleted successfully.');
    }
}
