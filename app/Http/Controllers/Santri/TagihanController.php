<?php

namespace App\Http\Controllers\Santri;

use App\Http\Controllers\Controller;
use App\Models\Akunbank;
use App\Models\Kategoribayaran;
use App\Models\Santri;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class TagihanController extends Controller
{
    public function belum(Request $request)
    {
        $banks = Akunbank::where('aktif','Y')->get();
        $title = "Semua Record Tagihan";
        $pagination  = 10;
        $tagihans = Tagihan::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
            })
            ->where('santri_id','=', Session::get('id'))
            ->where('status_pembyaran','!=','1')
            ->orderBy('id', 'ASC')
            ->paginate($pagination);
        $valuepage = (($tagihans->currentPage() - 1) * $tagihans->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $tagihans->count()) . " Data dari ". $tagihans->total(). " Data";
        return view('frontend.santri.tagihan', compact('tagihans', 'valuepage', 'labelcount','title','banks'));
    }

    public function lunas(Request $request)
    {
        $title = "Semua Record Pelunasan Tagihan";
        $pagination  = 10;
        $tagihans = Tagihan::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query;
            })
            ->where('santri_id','=', Session::get('id'))
            ->where('status_pembyaran','1')
            ->orderBy('id', 'ASC')
            ->paginate($pagination);
        $valuepage = (($tagihans->currentPage() - 1) * $tagihans->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $tagihans->count()) . " Data dari ". $tagihans->total(). " Data";
        return view('frontend.santri.tagihanlunas', compact('tagihans', 'valuepage', 'labelcount','title'));
    }
}
