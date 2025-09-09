<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Models\Kategorigaleri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function all_kategorigaleri() {
        $allKategoriGaleri = Kategorigaleri::where('aktif', '!=', 'N')->get();
        return view('frontend.all_galeri', compact('allKategoriGaleri'));
    }
    public function show($id)
    {
        // Ambil 5 berita terkait berdasarkan kategori_id, acak
        $relatedGaleris = Galeri::where('kategorigaleri_id', '=', $id)->get();
        // Kirim data ke view
        return view('frontend.masonry', compact('relatedGaleris'));
    }
}
