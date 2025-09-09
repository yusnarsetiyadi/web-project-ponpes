<?php

namespace App\Exports;

use App\Models\Santri;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SantriExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Santri::with(['jurusan', 'pendidikan', 'ortu'])
            ->get()
            ->map(function ($user) {
                $tingkatPendidikan = [
                    1 => 'SD',
                    2 => 'SMP',
                    3 => 'SMA',
                ];

                $tingkatDipilih = $tingkatPendidikan[$user->tingkat_pendidikan] ?? 'Tidak Diketahui';
                return [
                    'nama_lengkap'               => $user->nama_lengkap,
                    'username'                   => $user->username,
                    'tempat_lahir'               => $user->tempat_lahir,
                    'tanggal_lahir'              => $user->tanggal_lahir,
                    'jenis_kelamin'              => $user->jenis_kelamin,
                    'email'                      => $user->email,
                    'tingkat'                    => $tingkatDipilih, // Relasi jurusan
                    'jurusan'                    => $user->jurusan->nama, // Relasi jurusan
                    'alasan'                     => $user->alasan, // Relasi jurusan
                    'pendidikan_akhir'           => $user->pendidikan->pluck('nama_sekolah')->implode(', ') ?? 'N/A', // Relasi pendidikan akhir
                    'orang_tua_wali'             => $user->ortu->pluck('nama')->implode(', ') ?? 'N/A', // Relasi orang tua wali
                    'created_at'                 => $user->created_at,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Nama Lengkap',
            'Username',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Email',
            'Tingkat Pendidikan',
            'Jurusan',
            'Alasan',
            'Pendidikan Terakhir',
            'Orang Tua/Wali',
            'Tanggal Dibuat',
        ];
    }

}
