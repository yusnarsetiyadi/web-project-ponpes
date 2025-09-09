@extends('layouts.pdf')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Tagihan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }
        .title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">Laporan Tagihan Santri</div>
        <table>
            <thead>
                <tr>
                    <th class="text-center" width="20">No</th>
                    <th>Santri</th>
                    <th>Tagihan</th>
                    <th>Nominal</th>
                    <th>Jurusan</th>
                    <th>Tingkat Pendidikan</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Status Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tagihans as $key => $tagihan)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $tagihan->santri->nama_lengkap }}</td>
                    <td>{{ $tagihan->pembayaran->nama }}</td>
                    <td>{{ number_format($tagihan->nominal, 0, ',', '.') }}</td>
                    <td>{{ $tagihan->santri->jurusan->nama }}</td>
                    <td>
                        @if ($tagihan->tingkatpendidikan == 1) SD
                        @elseif ($tagihan->tingkatpendidikan == 2) SMP
                        @else SMA
                        @endif
                    </td>
                    <td>{{ $tagihan->bulan }}</td>
                    <td>{{ $tagihan->tahun }}</td>
                    <td>
                        @if ($tagihan->status_pembayaran == '1')
                            <span class="text-success">LUNAS</span>
                        @else
                            <span class="text-danger">BELUM LUNAS</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
@endsection
