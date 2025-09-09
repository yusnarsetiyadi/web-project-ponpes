<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Halaman;
use Illuminate\Http\Request;

class HalamanController extends Controller
{
    public function show($seo)
    {
        // Ambil artikel berdasarkan SEO
        $artikel = Halaman::where('seo', '=', $seo)->firstOrFail();
        // Ambil 5 berita terkait berdasarkan kategori_id, acak
        $relatedArticles = Halaman::where('id', '!=', $artikel->id)->get();
        // Kirim data ke view
        return view('frontend.halaman', compact('artikel', 'relatedArticles'));
    }

}
