<?php

namespace App\Http\Controllers;

use App\Models\Aparatur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AparaturController extends Controller
{
    public function index()
    {
        $aparatur = Aparatur::all();
        return view('aparatur.index', compact('aparatur'));
    }

    public function create()
    {
        return view('aparatur.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'photo' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
            'position' => 'required|max:255',
        ]);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $filename = time() . '_' . $image->getClientOriginalName();
            Storage::disk('aparatur')->putFileAs('img', $image, $filename);
            $photoPath = $filename;
        }

        $data = [
            'name' => $request->name,
            'position' => $request->position,
            'photo' => $photoPath ?? null,
            'is_active' => $request->has('is_active'),
        ];
        Aparatur::create($data);

        return redirect()->route('aparatur.index')->with('success', 'Aparatur desa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $aparatur = Aparatur::findOrFail($id);
        return view('aparatur.edit', compact('aparatur'));
    }

    public function update(Request $request, $id)
    {
        // dd($request);

        $this->validate($request, [
            'name' => 'required|max:255',
            'photo' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
            'position' => 'required|max:255',
        ]);
        $aparatur = Aparatur::findOrFail($id);

        if ($request->hasFile('photo')) {
            // Menghapus foto lama jika ada
            $filePath = 'img/' . $request->photo; // Path to the file you want to delete
            if (Storage::disk('aparatur')->exists($filePath)) {
                Storage::disk('aparatur')->delete($filePath);
            }

            $image = $request->file('photo');
            $filename = time() . '_' . $image->getClientOriginalName();
            Storage::disk('aparatur')->putFileAs('img', $image, $filename);
            $photoPath = $filename;

            $aparatur->photo = $photoPath;
        }

        $data = [
            'name' => $request->name,
            'position' => $request->position,
            'is_active' => $request->has('is_active'),
        ];

        $aparatur->update($data);

        return redirect()->route('aparatur.index')->with('success', 'Aparatur desa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $aparatur = Aparatur::findOrFail($id);

        // Menghapus foto jika ada
        if ($aparatur->photo) {
            $filePath = 'img/' . $request->photo; // Path to the file you want to delete

            if (Storage::disk('aparatur')->exists($filePath)) {
                Storage::disk('aparatur')->delete($filePath);
            }
        }

        $aparatur->delete();

        return redirect()->route('aparatur.index')->with('success', 'Aparatur desa berhasil dihapus.');
    }
}
