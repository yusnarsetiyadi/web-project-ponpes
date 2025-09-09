<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;


class ArtikelController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:artikel-list|artikel-create|artikel-edit|artikel-delete', ['only' => ['index','show']]);
         $this->middleware('permission:artikel-create', ['only' => ['create','store']]);
         $this->middleware('permission:artikel-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:artikel-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Semua Record Artikel";
        $pagination  = 10;
        $artikels = Artikel::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query->where('seo', 'like', "%{$request->keyword}%")->where('judul', 'like', "%{$request->keyword}%");
            })
            ->where('kategori_id','!=','1')
            ->orderBy('id', 'DESC')
            ->paginate($pagination);
        $valuepage = (($artikels->currentPage() - 1) * $artikels->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $artikels->count()) . " Data dari ". $artikels->total(). " Data";
        return view('alza_admin.alza_modul.artikel.index', compact('artikels', 'valuepage', 'labelcount','title'));
    }

    public function create()
    {
        $title = "Tambah Record Artikel";
        $kategori = Kategori::where('aktif','Y')->get();
        return view('alza_admin.alza_modul.artikel.create',compact('title','kategori'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['judul' => 'required','keterangan' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

		$file = $request->file('gambar');
		$input = $request->all();
		if (file_exists($file)) {
			$nama_file = $file->getClientOriginalName();
			$pathfile = Storage::putFileAs(
				'public/artikel',
				$file,
				time()."_".$nama_file,
			);
            $input['gambar'] = basename($pathfile);
		}else{
            $input = Arr::except($input,['gambar']);
        }


        Artikel::create($input);
        return redirect()->route(config('pathadmin.admin_prefix').'artikels.index')->with('success','Data berhasi diproses');
    }

    public function show(Artikel $artikel)
    {
        //
    }

    public function edit($id)
    {
        $title = "Ubah Record Artikel";
        $artikel = Artikel::find($id);
        $kategori = Kategori::where('aktif','Y')->get();
        return view('alza_admin.alza_modul.artikel.edit',compact('title','artikel','kategori'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), ['judul' => 'required','keterangan' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        $artikel = Artikel::find($id);
		$file = $request->file('gambar');
		$input = $request->except('imagenow');
		if (file_exists($file)) {

            if (Storage::exists('public/artikel/' . $artikel->gambar)) {
                Storage::delete('public/artikel/' . $artikel->gambar);
            }

			Storage::disk('public')->delete('upload/'.$request->imagenow);
			$nama_file = $file->getClientOriginalName();
			$pathfile = Storage::putFileAs(
				'public/artikel',
				$file,
				time()."_".$nama_file,
			);
			$input['gambar'] = basename($pathfile);
		}else{
			$input = Arr::except($input,['gambar','imagenow']);
		}

        $artikel->update($input);
        return redirect()->route(config('pathadmin.admin_prefix').'artikels.index')->with('success','Data berhasi diproses');
    }

    public function destroy(Artikel $artikel)
    {
        if (Storage::exists('public/artikel/' . $artikel->gambar)) {
            Storage::delete('public/artikel/' . $artikel->gambar);
        }
        $artikel->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'artikels.index')->with('success','Data berhasi diproses');
    }
}
