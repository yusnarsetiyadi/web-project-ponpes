@extends('alza_admin.alza_layouts.alza_template')

@section('alzacontent')
@php
    $bulan = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    ];
@endphp
<div class="col-md-12 col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $title }}
                @can('tagihan-create')
                <a class="btn btn-success btn-sm float-right"
                    href="{{ route(config('pathadmin.admin_prefix').'tagihans.create') }}"> Tambah
                    Baru</a>
                @endcan
            </h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
                <div class="float-right mb-1">
                    <form action="" method="get">
                        <input type="search" name="keyword" class="form-control" placeholder="Pencarian..."
                            value="{{ Request::get('keyword') ?? '' }}">
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
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
                                <th>Status_pembyaran</th>
                                <th width="280" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tagihans as $key => $tagihan)
                            <tr>
                                <td class="text-center">
                                    {{ $key + 1 + $valuepage }}
                                </td>
                                <td>{{ optional($tagihan->santri)->nama_lengkap ?? '-' }}</td>
                                <td>{{ optional($tagihan->pembayaran)->nama ?? '-' }}</td>
                                <td>{{ $tagihan->nominal }}</td>
                                <td>{{ optional(optional($tagihan->santri)->jurusan)->nama ?? '-' }}</td>
                                <td>
                                    @if ($tagihan->tingkatpendidikan == 1)
                                        SD
                                    @elseif ($tagihan->tingkatpendidikan == 2)
                                        SMP
                                    @else
                                        SMA
                                    @endif
                                </td>
                                <td>{{ $bulan[(int)($tagihan->bulan ?? 0)] ?? '-' }}</td>
                                <td>{{ $tagihan->tahun }}</td>
                                <td><span class="text-danger">BELUM BAYAR</span></td>
                                <td class="text-center">
                                    @can('tagihan-edit')
                                    <form style="display:inline" action="{{ url('/'.config('pathadmin.admin_name').'/proses/'.$tagihan->id.'/bayar') }}" method="post">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-primary btn-sm">Bayar</button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p class="pt-1">{{ $labelcount }}</p>
                </div>
                {{ $tagihans->appends(['keyword' => Request::get('keyword')])->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

@endsection
