<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use App\Models\Akunbank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;

class AkunbankController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:akunbank-list|akunbank-create|akunbank-edit|akunbank-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:akunbank-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:akunbank-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:akunbank-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Semua Record Akun Bank";
        $pagination = 10;

        $akunbanks = Akunbank::when($request->keyword, function ($query) use ($request) {
            $query->where('norek', 'like', "%{$request->keyword}%")
                  ->orWhere('atas_nama', 'like', "%{$request->keyword}%")
                  ->orWhere('nama_bank', 'like', "%{$request->keyword}%");
        })->orderBy('id', 'ASC')->paginate($pagination);

        $valuepage = (($akunbanks->currentPage() - 1) * $akunbanks->perPage());
        $labelcount = "Menampilkan " . ($valuepage + 1) . " sampai " . ($valuepage + $akunbanks->count()) . " Data dari " . $akunbanks->total() . " Data";

        return view('alza_admin.alza_modul.akunbank.index', compact('akunbanks', 'valuepage', 'labelcount', 'title'));
    }

    public function create()
    {
        $title = "Tambah Record Akun Bank";
        return view('alza_admin.alza_modul.akunbank.create', compact('title'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'norek' => 'required',
            'atas_nama' => 'required',
            'nama_bank' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $input = $request->all();
        Akunbank::create($input);

        return redirect()->route(config('pathadmin.admin_prefix') . 'akunbanks.index')->with('success', 'Data berhasil diproses');
    }

    public function show(Akunbank $akunbank)
    {
        //
    }

    public function edit($id)
    {
        $title = "Ubah Record Akun Bank";
        $akunbank = Akunbank::findOrFail($id);

        return view('alza_admin.alza_modul.akunbank.edit', compact('title', 'akunbank'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'norek' => 'required',
            'atas_nama' => 'required',
            'nama_bank' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $akunbank = Akunbank::findOrFail($id);
        $input = $request->all();

        $akunbank->update($input);

        return redirect()->route(config('pathadmin.admin_prefix') . 'akunbanks.index')->with('success', 'Data berhasil diproses');
    }

    public function destroy(Akunbank $akunbank): RedirectResponse
    {
        $akunbank->delete();
        return redirect()->route(config('pathadmin.admin_prefix') . 'akunbanks.index')->with('success', 'Data berhasil diproses');
    }
}
