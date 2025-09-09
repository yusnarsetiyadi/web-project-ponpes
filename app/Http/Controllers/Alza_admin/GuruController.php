<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;


class GuruController extends Controller
{
    function __construct()
    {
        //  $this->middleware('permission:guru-list|guru-create|guru-edit|guru-delete', ['only' => ['index','show']]);
        //  $this->middleware('permission:guru-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:guru-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:guru-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Semua Record Guru";
        $pagination  = 10;
        $gurus = Guru::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query->where('nip', 'like', "%{$request->keyword}%")->where('nama_guru', 'like', "%{$request->keyword}%")->where('kontak', 'like', "%{$request->keyword}%");
            })->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($gurus->currentPage() - 1) * $gurus->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $gurus->count()) . " Data dari ". $gurus->total(). " Data";
        return view('alza_admin.alza_modul.guru.index', compact('gurus', 'valuepage', 'labelcount','title'));
    }

    public function create()
    {
        $title = "Tambah Record Guru";

        return view('alza_admin.alza_modul.guru.create',compact('title'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nip' => 'required|numeric|unique:guru,nip',
            'nama_guru' => 'required|min:3',
            'kontak' => 'required',
            'alamat' => 'required',
            'keterangan' => 'nullable'
        ]);

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $input = $request->all();


            // Mapping nama field dari form ke database
            $data = [
                'nip' => $input['nip'],
                'nama_guru' => $input['nama_guru'],
                'kontak' => $input['kontak'],
                'alamat' => $input['alamat'],
                'keterangan' => $input['keterangan'] ?? null
            ];


            Guru::create($data);

            return redirect()
                ->route(config('pathadmin.admin_prefix').'gurus.index')
                ->with('success', 'Data guru berhasil ditambahkan');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: '.$e->getMessage())
                ->withInput();
        }
    }

    public function show(Guru $guru)
    {
        //
    }

    public function edit($id)
    {
        $title = "Ubah Record Guru";
        $guru = Guru::find($id);

        return view('alza_admin.alza_modul.guru.edit',compact('title','guru'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), ['nip' => 'required','nama_guru' => 'required|min:3','kontak' => 'required','alamat' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        $guru = Guru::find($id);
		$file = $request->file('foto');
		$input = $request->except('imagenow');
		if (file_exists($file)) {

            if (Storage::exists('public/foto_guru/' . $guru->foto)) {
                Storage::delete('public/foto_guru/' . $guru->foto);
            }

			Storage::disk('public')->delete('upload/'.$request->imagenow);
			$nama_file = $file->getClientOriginalName();
			$pathfile = Storage::putFileAs(
				'public/foto_guru',
				$file,
				time()."_".$nama_file,
			);
			$input['foto'] = basename($pathfile);
		}else{
            $input = Arr::except($input,['foto','imagenow']);
        }

        $guru->update($input);
        return redirect()->route(config('pathadmin.admin_prefix').'gurus.index')->with('success','Data berhasi diproses');
    }

    public function destroy(Guru $guru)
    {
        // Periksa apakah file ada dan hapus file jika ada
        if (!empty($guru->foto) && Storage::disk('public')->exists('foto_guru/' . $guru->foto)) {
            Storage::disk('public')->delete('foto_guru/' . $guru->foto);
        }

        // Hapus data dari database
        $guru->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'gurus.index')->with('success','Data berhasi diproses');
    }
}
