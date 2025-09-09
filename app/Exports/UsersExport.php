<?php

namespace App\Exports;

use App\Models\Santri;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Santri::with(['jurusan', 'pendidikanakhir', 'orangtuaaali'])
            ->get()
            ->map(function ($user) {
                $tingkatPendidikan = [
                    1 => 'SD',
                    2 => 'SMP',
                    3 => 'SMA',
                ];

                $tingkatDipilih = $tingkatPendidikan[$user->jurusan_id] ?? 'Tidak Diketahui';
                return [
                    'nama_lengkap'               => $user->nama_lengkap,
                    'tempat_lahir'               => $user->tempat_lahir,
                    'tanggal_lahir'              => $user->tanggal_lahir,
                    'jenis_kelamin'              => $user->jenis_kelamin,
                    'email'                      => $user->email,
                    'jurusan'                    => $tingkatDipilih, // Relasi jurusan
                    'alasan'                     => $user->alasan, // Relasi jurusan
                    'pendidikan_akhir'           => $user->pendidikanAkhir->nama ?? 'N/A', // Relasi pendidikan akhir
                    'orang_tua_wali'             => $user->orangTuaWali->nama ?? 'N/A', // Relasi orang tua wali
                    'created_at'                 => $user->created_at,
                ];
            });
    }

}
