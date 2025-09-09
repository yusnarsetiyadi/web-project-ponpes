<?php

namespace App\Http\Controllers\Alza_admin;

use App\Helpers\AlzaHelpers;
use App\Http\Controllers\Controller;
use App\Models\Halaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;


class HalamanController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:halaman-list|halaman-create|halaman-edit|halaman-delete', ['only' => ['index','show']]);
         $this->middleware('permission:halaman-create', ['only' => ['create','store']]);
         $this->middleware('permission:halaman-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:halaman-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Semua Record Halaman";
        $pagination  = 10;
        $halamans = Halaman::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query->where('seo', 'like', "%{$request->keyword}%")->where('judul', 'like', "%{$request->keyword}%")->where('keterangan', 'like', "%{$request->keyword}%")->where('aktif', 'like', "%{$request->keyword}%");
            })->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($halamans->currentPage() - 1) * $halamans->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $halamans->count()) . " Data dari ". $halamans->total(). " Data";
        return view('alza_admin.alza_modul.halaman.index', compact('halamans', 'valuepage', 'labelcount','title'));
    }

    public function create()
    {
        $title = "Tambah Record Halaman";

        return view('alza_admin.alza_modul.halaman.create',compact('title'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['judul' => 'required|min:3','keterangan' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

		$file = $request->file('gambar');
		$input = $request->all();
        $input['seo'] = $request->input('seo') == '' ? AlzaHelpers::seo_title($request->input('judul')) : AlzaHelpers::seo_title($request->input('seo'));
		if (file_exists($file)) {

			$nama_file = $file->getClientOriginalName();
			$pathfile = Storage::putFileAs(
				'public/halaman',
				$file,
				time()."_".$nama_file,
			);
            $input['gambar'] = basename($pathfile);
		}else{
            $input = Arr::except($input,'gambar');
        }


        Halaman::create($input);
        return redirect()->route(config('pathadmin.admin_prefix').'halamans.index')->with('success','Data berhasi diproses');
    }

    public function show(Halaman $halaman)
    {
        //
    }

    public function edit($id)
    {
        $title = "Ubah Record Halaman";
        $halaman = Halaman::find($id);
        return view('alza_admin.alza_modul.halaman.edit',compact('title','halaman'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), ['judul' => 'required|min:3','keterangan' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        $halaman = Halaman::find($id);
		$file = $request->file('gambar');
		$input = $request->except('imagenow');

		if (file_exists($file)) {

            if (Storage::exists('public/halaman/' . $halaman->gambar)) {
                Storage::delete('public/halaman/' . $halaman->gambar);
            }

			$nama_file = $file->getClientOriginalName();
			$pathfile = Storage::putFileAs(
				'public/halaman',
				$file,
				time()."_".$nama_file,
			);
			$input['gambar'] = basename($pathfile);
		}else{
			$input = Arr::except($input,'gambar');
		}

        $halaman->update($input);
        return redirect()->route(config('pathadmin.admin_prefix').'halamans.index')->with('success','Data berhasi diproses');
    }

    public function destroy(Halaman $halaman)
    {
        $halaman->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'halamans.index')->with('success','Data berhasi diproses');
    }
}
