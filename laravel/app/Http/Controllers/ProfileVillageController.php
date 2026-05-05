<?php

namespace App\Http\Controllers;

use App\Models\Aparatur;
use App\Models\Comment;
use App\Models\News;
use App\Models\NewsImage;
use App\Models\Store;
use App\Models\TemplateSurat;
use App\Models\VillageData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileVillageController extends Controller
{
    public function index()
    {
        $jPendudukData = VillageData::where('title', 'Jumlah penduduk menurut jenis kelamin')->first();
        $jumlahPenduduk = $jPendudukData ? $jPendudukData->details()->sum('value') : 0;

        $jKKData = VillageData::where('title', 'Jumlah Kepala Keluarga (KK)')->first();
        $jumlahKK = $jKKData ? $jKKData->details()->sum('value') : 0;

        $jSekolahNegriData = VillageData::where('title', 'Jumlah Sekolah Negri')->first();
        $jumlahSekolahNegri = $jSekolahNegriData ? $jSekolahNegriData->details()->sum('value') : 0;

        $jSekolahSwastaData = VillageData::where('title', 'Jumlah Sekolah Swasta')->first();
        $jumlahSekolahSwasta = $jSekolahSwastaData ? $jSekolahSwastaData->details()->sum('value') : 0;

        $jumlahAparatur = Aparatur::count();

        $villageProfile = VillageData::where('title', 'Profile Desa')->first();
        $villageVision = VillageData::where('title', 'Visi')->first();
        $villageMission = VillageData::where('title', 'Misi')->first();
        $villageHistory = VillageData::where('title', 'Sejarah')->first();
        $villageService = VillageData::where('title', 'Pelayanan')->first();

        $templateSurat = TemplateSurat::all();
        $store = Store::all();
        $news = News::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('profilevillage.home', compact(
            'villageProfile',
            'villageVision',
            'villageMission',
            'villageHistory',
            'jumlahPenduduk',
            'jumlahAparatur',
            'jumlahKK',
            'jumlahSekolahNegri',
            'jumlahSekolahSwasta',
            'villageService',
            'templateSurat',
            'store',
            'news'
        ));
    }

    public function newsIndex()
    {
        $news = News::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('profilevillage.news', compact('news'));
    }

    public function newsShow(News $news)
    {
        $comments = $news->comments()->orderBy('created_at', 'desc')->get();
        $newsImages = NewsImage::where('news_id', $news->id)->get();

        return view('profilevillage.news_detail', compact('news', 'comments', 'newsImages'));
    }

    public function storeComment(Request $request)
    {
        $request->validate([
            'news_id' => 'required|exists:news,id',
            'name' => 'required|string|max:100',
            'email' => 'nullable|email|max:100',
            'comment' => 'required|string',
        ]);

        Comment::create($request->only(['news_id', 'name', 'comment']));

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
    }

    public function contactIndex()
    {
        $villageProfile = VillageData::where('title', 'Profile Desa')->first();
        return view('profilevillage.contact', compact('villageProfile'));
    }

    public function sendContactForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'message' => 'required|string',
        ]);

        // Simpan ke session, atau kirim email (belum diimplementasi)
        return redirect()->back()->with('success', 'Pesan berhasil dikirim!');
    }

    public function apbDesaIndex()
    {
        return view('profilevillage.keuangan.APBDesa');
    }

    public function profilevillage()
    {
        $villageProfile = VillageData::where('title', 'Profile Desa')->first();
        $villageVision = VillageData::where('title', 'Visi')->first();
        $villageMission = VillageData::where('title', 'Misi')->first();
        $villageHistory = VillageData::where('title', 'Sejarah')->first();

        return view('profilevillage.profilevillage', compact(
            'villageProfile',
            'villageVision',
            'villageMission',
            'villageHistory'
        ));
    }

    public function demografi()
    {
        $jPendudukData = VillageData::where('title', 'Jumlah penduduk menurut jenis kelamin')->first();
        $jumlahPenduduk = $jPendudukData ? $jPendudukData->details()->sum('value') : 0;

        $jKKData = VillageData::where('title', 'Jumlah Kepala Keluarga (KK)')->first();
        $jumlahKK = $jKKData ? $jKKData->details()->sum('value') : 0;

        $jSekolahNegriData = VillageData::where('title', 'Jumlah Sekolah Negri')->first();
        $jumlahSekolahNegri = $jSekolahNegriData ? $jSekolahNegriData->details()->sum('value') : 0;

        $jSekolahSwastaData = VillageData::where('title', 'Jumlah Sekolah Swasta')->first();
        $jumlahSekolahSwasta = $jSekolahSwastaData ? $jSekolahSwastaData->details()->sum('value') : 0;

        $demografi = VillageData::where('title', 'Demografi')->get();

        return view('profilevillage.demografi', compact(
            'jumlahPenduduk',
            'jumlahKK',
            'jumlahSekolahNegri',
            'jumlahSekolahSwasta',
            'demografi'
        ));
    }

    public function monografi()
    {
        $villageProfile = VillageData::where('title', 'Profile Desa')->first();
        $villageVision = VillageData::where('title', 'Visi')->first();
        $villageMission = VillageData::where('title', 'Misi')->first();
        $villageHistory = VillageData::where('title', 'Sejarah')->first();

        return view('profilevillage.monografi', compact(
            'villageProfile',
            'villageVision',
            'villageMission',
            'villageHistory'
        ));
    }

    public function visimisi()
    {
        $villageVision = VillageData::where('title', 'Visi')->first();
        $villageMission = VillageData::where('title', 'Misi')->first();

        return view('profilevillage.visimisi', compact('villageVision', 'villageMission'));
    }

    public function sejarah()
    {
        $villageHistory = VillageData::where('title', 'Sejarah')->first();
        return view('profilevillage.sejarah', compact('villageHistory'));
    }

    public function pelayanan()
    {
        $templateSurat = TemplateSurat::all();
        return view('profilevillage.pelayanan', compact('templateSurat'));
    }

    public function villageMapIndex()
    {
        $villageProfile = VillageData::where('title', 'Profile Desa')->first();
        return view('profilevillage.villagemap', compact('villageProfile'));
    }

    public function pasarDesa()
    {
        $stores = Store::all();
        return view('profilevillage.pasardesa', compact('stores'));
    }

    public function showPasarDesa($id)
    {
        $store = Store::with('products')->findOrFail($id);
        return view('profilevillage.showpasardesa', compact('store'));
    }

    public function commentstore(Request $request)
    {
        return $this->storeComment($request);
    }
}
