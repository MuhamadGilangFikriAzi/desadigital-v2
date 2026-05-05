<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::query();

        if ($request->has('status') && in_array($request->status, ['0', '1'])) {
            $query->where('is_active', $request->status);
        }

        $news = $query->latest()->get();

        return view('news.index', compact('news'));
    }

    public function create()
    {
        $newsImages = NewsImage::where('news_id', 0)->get();
        return view('news.create', compact('newsImages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('title', 'content', 'is_active');

        $data['author'] = Auth::user()->name;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            Storage::disk('storage')->putFileAs('news', $image, $filename);
            $data['image'] = $filename;
        }
        if ($request->is_active == null) {
            $data['is_active'] = false;
        }
        $news = News::create($data);

        $images = $request->input('images', []);
        foreach ($images as $key => $imageData) {
            $desc = $imageData['desc'] ?? null;
            $tag  = $imageData['tag'] ?? null;
            $file = $request->file("images.$key.img");

            $fileName = null;
            if ($file) {
                $fileName = sprintf("%s-img-%d", $imageData['tag'], $key);
                Storage::disk('news')->putFileAs($data['title'], $file, $fileName);
            }

            NewsImage::create([
                'news_id' => $news->id,
                'desc'    => $desc,
                'tag'     => $tag,
                'img'     => $data['title'] . "/" . $fileName,
            ]);
        }

        return redirect()->route('news.index')->with('success', 'Berita berhasil ditambahkan');
    }

    public function show(News $news)
    {
        // dd($news);
        $newsImages = NewsImage::where('news_id', $news->id)->get();

        return view('news.show', compact('news', 'newsImages'));
    }

    public function edit(News $news)
    {
        $newsImages = NewsImage::where('news_id', $news->id)->get();

        return view('news.edit', compact('news', 'newsImages'));
    }


    public function update(Request $request, News $news)
    {
        // dd($request->file('image')->getMimeType());

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // dd($request);
        $data = $request->only('title', 'content', 'is_active');
        $data['author'] = Auth::user()->name;
        if ($request->hasFile('image')) {
            // Debug if needed
            // dd($request->file('image')->getMimeType());

            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            Storage::disk('storage')->putFileAs('news', $image, $filename);
            $data['image'] = $filename;
        }

        if ($request->is_active == null) {
            $data['is_active'] = false;
        }

        // dd($data);

        $news->update($data);

        $oldImages = NewsImage::where('news_id', $news->id)->get();

        // foreach ($oldImages as $old) {
        //     if ($old->img) {
        //         Storage::disk('news')->delete($old->img);
        //     }
        // }
        // dd($request);
        NewsImage::where('news_id', $news->id)->delete();

        /**
         * ======================
         * Insert gambar baru
         * ======================
         */
        $images = $request->input('images', []);
        foreach ($images as $key => $imageData) {
            $desc = $imageData['desc'] ?? null;
            $tag  = $imageData['tag'] ?? null;
            $file = $request->file("images.$key.img");
            // dd($file);
            $fileName = null;
            if ($file) {
                $fileName = sprintf("%s-img-%d", $tag, $key); // pakai tag, bukan title
                // dd($fileName);
                Storage::disk('news')->delete($data['title'] . "/" . $fileName);

                Storage::disk('news')->putFileAs($data['title'], $file, $fileName);

                $fileName = $data['title'] . "/" . $fileName;
            } else {
                // dd($imageData);
                $fileName = $imageData["oldImg"] ?? null;
            }
            // dd($fileName);
            NewsImage::create([
                'news_id' => $news->id,
                'desc'    => $desc,
                'tag'     => $tag,
                'img'     => $fileName,
            ]);
        }

        return redirect()->route('news.index')->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('news.index')->with('success', 'Berita berhasil dihapus');
    }
}
