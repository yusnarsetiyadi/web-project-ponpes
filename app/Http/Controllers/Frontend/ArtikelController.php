<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    public function allartikel(Request $request) {
        $pagination  = 12;
        $beritas = Artikel::when($request->keyword, function ($query) use ($request) {
            $query->where('seo', 'like', "%{$request->keyword}%")
                  ->orWhere('judul', 'like', "%{$request->keyword}%");
        })
        ->when($request->kat, function ($query) use ($request) {
            $query->where('kategori_id', $request->kat); // Sesuaikan field 'kategori_id' dengan nama kolom kategori di tabel Artikel
        })
        ->where('kategori_id','!=','1')
        ->orderBy('id', 'DESC')
        ->paginate($pagination);
        $kategori = Kategori::where('aktif','=','Y')->where('id','!=','1')->get();
        $valuepage = (($beritas->currentPage() - 1) * $beritas->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $beritas->count()) . " Data dari ". $beritas->total(). " Data";
        return view('frontend.artikel',compact('beritas', 'valuepage', 'labelcount','kategori'));
    }

    public function allprogram(Request $request) {
        $pagination  = 12;
        $beritas = Artikel::when($request->keyword, function ($query) use ($request) {
            $query->where('seo', 'like', "%{$request->keyword}%")
                  ->orWhere('judul', 'like', "%{$request->keyword}%");
        })
        ->where('kategori_id','=','1')
        ->orderBy('id', 'DESC')
        ->paginate($pagination);
        $valuepage = (($beritas->currentPage() - 1) * $beritas->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $beritas->count()) . " Data dari ". $beritas->total(). " Data";
        return view('frontend.program',compact('beritas', 'valuepage', 'labelcount'));
    }


    public function show($seo)
    {
        // Ambil artikel berdasarkan SEO
        $artikel = Artikel::where('seo', '=', $seo)->firstOrFail();

        // Perbarui jumlah views
        $artikel->increment('view'); // Menambah 1 ke kolom views

        // Ambil 5 berita terkait berdasarkan kategori_id, acak
        $relatedArticles = Artikel::where('kategori_id', $artikel->kategori_id)
            ->where('id', '!=', $artikel->id) // Tidak termasuk artikel yang sedang dibuka
            ->inRandomOrder()
            ->take(5) // Ambil 5 berita secara acak
            ->get();

        // Kirim data ke view
        return view('frontend.detil_artikel', compact('artikel', 'relatedArticles'));
    }

    public function showProgram($seo)
    {
        // Ambil artikel berdasarkan SEO
        $artikel = Artikel::where('seo', '=', $seo)->firstOrFail();

        // Perbarui jumlah views
        $artikel->increment('view'); // Menambah 1 ke kolom views

        // Ambil 5 berita terkait berdasarkan kategori_id, acak
        $relatedArticles = Artikel::where('id', '=', $artikel->id) // Tidak termasuk artikel yang sedang dibuka
            ->inRandomOrder()
            ->take(5) // Ambil 5 berita secara acak
            ->get();

        // Kirim data ke view
        return view('frontend.detil_artikel', compact('artikel', 'relatedArticles'));
    }


}
