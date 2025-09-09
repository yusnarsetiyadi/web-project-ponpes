<?php

namespace App\Http\Controllers\Santri;

use App\Http\Controllers\Controller;
use App\Models\FotoSantri;
use App\Models\Orangtuawali;
use App\Models\Pendidikanakhir;

use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;

class ProfileController extends Controller
{
    public function show()
    {
        $title = "Biodata Anda";
        $santri = Santri::where('id','=',Session::get('id'))->first();
        $santri_ortu = Orangtuawali::where('santri_id','=',Session::get('id'))->get();
        $santri_foto = FotoSantri::where('santri_id','=',Session::get('id'))->first();
        $santri_pen_akhir = Pendidikanakhir::where('santri_id','=',Session::get('id'))->get();
        return view('frontend.santri.profile', compact('title', 'santri','santri_pen_akhir','santri_ortu','santri_foto'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,PNG,JPG,JPEG,GIF|max:2048',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $fotoSantri = FotoSantri::where('santri_id', $id)->first();
        $file = $request->file('foto');

        if ($file) {
            // Hapus foto lama jika ada
            if ($fotoSantri && Storage::exists('public/fotosantri/' . $fotoSantri->foto)) {
                Storage::delete('public/fotosantri/' . $fotoSantri->foto);
            }

            // Simpan foto baru
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $pathfile = Storage::putFileAs('public/fotosantri', $file, $nama_file);
            $fotoBaru = basename($pathfile);

            if ($fotoSantri) {
                $fotoSantri->update(['foto' => $fotoBaru]);
            } else {
                FotoSantri::create(['santri_id' => $id, 'foto' => $fotoBaru]);
            }
        }

        return redirect()->back()->with('success', 'Foto berhasil diperbarui.');
    }


    public function storeWali(Request $request)
    {
        $validator = Validator::make($request->all(), ['santri_id' => 'required','nama' => 'required','pekerjaan' => 'required','penghasilan_perbulan' => 'required','kontak' => 'required',]);
		if($validator->fails()){
			return response()->json([
                'success' => false,
                'message' => 'Data orangtua/wali gagal disimpan.',
                'data' => $request->all
            ]);
		}

        $wali = Orangtuawali::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Data orangtua/wali berhasil disimpan.',
            'data' => $wali
        ]);
    }

    public function storePend(Request $request)
    {
        $validator = Validator::make($request->all(), ['santri_id' => 'required','nama_sekolah' => 'required','tahun_lulus' => 'required','nilai_rata_rata' => 'required',]);
		if($validator->fails()){
			return response()->json([
                'success' => false,
                'message' => 'Data orangtua/wali gagal disimpan.',
                'data' => $request->all
            ]);
		}

        $pendidikan = Pendidikanakhir::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Data orangtua/wali berhasil disimpan.',
            'data' => $pendidikan
        ]);
    }


    public function updatePass(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'password_konfirm' => 'required|same:password'
        ]);

		if($validator->fails()){
			return response()->json([
                'success' => false,
                'message' => 'Password gagal di ubah',
                'data' => $request->all()
            ]);
		}

        $santri = Santri::find($id);
        $input = $request->all();
        if($request->password!=''){
            $input['password'] = bcrypt($request->password);
            $input['pw_nohash'] = $request->password;
        }else{
            $input = Arr::except($input,['password','pw_nohash']);
        }

        $santri->update($input);
        return response()->json([
            'success' => true,
            'message' => 'Password berhasil di ubah. silahkan keluar dan login kembali',
            'data' => ""
        ]);
    }

}
