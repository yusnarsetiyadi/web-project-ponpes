<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Guru;
use App\Models\Santri;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $guru = Guru::count();
        $santri = Santri::where('diterima','1')->count();
        $calonsantri = Santri::where('diterima','0')->count();
        $berita = Artikel::count();
        return view('home', compact('guru','santri','calonsantri','berita'));
    }
}
