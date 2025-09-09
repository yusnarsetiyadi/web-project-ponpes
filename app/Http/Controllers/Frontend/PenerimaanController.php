<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Santri;
use App\Models\Orangtuawali;
use App\Models\Pendidikanakhir;
use Illuminate\Support\Facades\Hash;

class PenerimaanController extends Controller
{
    public function formPenerimaan() {
        $jurusan = Jurusan::all();
        return view('frontend.penerimaan',compact('jurusan'));
    }
    public function postData(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'alasan' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan,-',
            'tingkat_pendidikan' => 'required|in:1,2,3',
            'jurusan_id' => 'nullable|integer|exists:jurusan,id',
            'no_telepon' => 'required|string|max:25',
            'email' => 'required|email|unique:santri,email',
            'alamat' => 'required|string|max:500', // <--- tambahkan ini
            'orangtua.*.nama' => 'required|string|max:255',
            'orangtua.*.pekerjaan' => 'required|string|max:255',
            'orangtua.*.penghasilan_perbulan' => 'required|string|max:255',
            'orangtua.*.kontak' => 'required|string|max:255',
            'pendidikan.*.nama_sekolah' => 'required|string|max:255',
            'pendidikan.*.tahun_lulus' => 'required|string|max:4',
            'pendidikan.*.nilai_rata_rata' => 'required|string|max:255',
        ]);
        

        DB::beginTransaction();

        try {
            // Simpan data santri
            $santri = new Santri();
            $santri->nama_lengkap = $request->nama_lengkap;
            $santri->tempat_lahir = $request->tempat_lahir;
            $santri->tanggal_lahir = $request->tanggal_lahir;
            $santri->jenis_kelamin = $request->jenis_kelamin;
            $santri->jurusan_id = $request->jurusan_id;
            $santri->alamat = $request->alamat; // <-- Tambahkan baris ini
            $santri->no_telepon = $request->no_telepon;
            $santri->email = $request->email;
            $santri->password = Hash::make('123456');
            $santri->pw_nohash = '123456';
            $santri->alasan = $request->alasan;
            $santri->save();
            

            // Simpan data orangtua/wali secara dinamis
            if ($request->has('orangtua_wali')) {
                foreach ($request->orangtua_wali as $orangtuaData) {
                    $orangtua = new Orangtuawali();
                    $orangtua->santri_id = $santri->id;
                    $orangtua->nama = $orangtuaData['nama'];
                    $orangtua->pekerjaan = $orangtuaData['pekerjaan'];
                    $orangtua->penghasilan_perbulan = $orangtuaData['penghasilan_perbulan'];
                    $orangtua->kontak = $orangtuaData['kontak'];
                    $orangtua->save();
                }
            }

            // Simpan data pendidikan akhir secara dinamis
            if ($request->has('pendidikan_akhir')) {
                foreach ($request->pendidikan_akhir as $pendidikanData) {
                    $pendidikan = new Pendidikanakhir();
                    $pendidikan->santri_id = $santri->id;
                    $pendidikan->nama_sekolah = $pendidikanData['nama_sekolah'];
                    $pendidikan->tahun_lulus = $pendidikanData['tahun_lulus'];
                    $pendidikan->nilai_rata_rata = $pendidikanData['nilai_rata_rata'];
                    $pendidikan->save();
                }
            }

            DB::commit();

            return redirect('/proses/penerimaan/berhasil')->with('success', 'Registrasi berhasil!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data.'])->withInput();
        }
    }

    public function getData(){
        return view('frontend.penerimaanberhasil');
    }
}
