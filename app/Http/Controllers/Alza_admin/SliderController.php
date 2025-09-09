<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;


class SliderController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:slider-list|slider-create|slider-edit|slider-delete', ['only' => ['index','show']]);
         $this->middleware('permission:slider-create', ['only' => ['create','store']]);
         $this->middleware('permission:slider-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:slider-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Semua Record Banner";
        $pagination  = 10;
        $sliders = Slider::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query->where('judul', 'like', "%{$request->keyword}%")->where('keterangan', 'like', "%{$request->keyword}%");
            })->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($sliders->currentPage() - 1) * $sliders->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $sliders->count()) . " Data dari ". $sliders->total(). " Data";
        return view('alza_admin.alza_modul.slider.index', compact('sliders', 'valuepage', 'labelcount','title'));
    }

    public function create()
    {
        $title = "Tambah Record Banner";

        return view('alza_admin.alza_modul.slider.create',compact('title'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'gambar' => 'required|mimes:jpg,jpeg,webp,png,gif'
        ]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

		$file = $request->file('gambar');
		$input = $request->all();
		if (file_exists($file)) {
			$nama_file = $file->getClientOriginalName();
			$pathfile = Storage::putFileAs(
				'public/slider',
				$file,
				time()."_".$nama_file,
			);
            $input['gambar'] = basename($pathfile);
		}else{
            $input = Arr::except($input,['gambar']);
        }


        Slider::create($input);
        return redirect()->route(config('pathadmin.admin_prefix').'sliders.index')->with('success','Data berhasi diproses');
    }

    public function show(Slider $slider)
    {
        //
    }

    public function edit($id)
    {
        $title = "Ubah Record Banner";
        $slider = Slider::find($id);

        return view('alza_admin.alza_modul.slider.edit',compact('title','slider'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'gambar' => 'required|mimes:jpg,jpeg,webp,png,gif'
        ]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        $slider = Slider::find($id);
		$file = $request->file('gambar');
		$input = $request->except('imagenow');
		if (file_exists($file)) {
            if (Storage::exists('public/slider/' . $slider->gambar)) {
                Storage::delete('public/slider/' . $slider->gambar);
            }

			Storage::disk('public')->delete('upload/'.$request->imagenow);
			$nama_file = $file->getClientOriginalName();
			$pathfile = Storage::putFileAs(
				'public/slider',
				$file,
				time()."_".$nama_file,
			);
			$input['gambar'] = basename($pathfile);
		}else{
			$input = Arr::except($input,['gambar','imagenow']);
		}

        $slider->update($input);
        return redirect()->route(config('pathadmin.admin_prefix').'sliders.index')->with('success','Data berhasi diproses');
    }

    public function destroy(Slider $slider)
    {

        if (Storage::exists('public/slider/' . $slider->gambar)) {
            Storage::delete('public/slider/' . $slider->gambar);
        }

        $slider->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'sliders.index')->with('success','Data berhasi diproses');
    }
}
