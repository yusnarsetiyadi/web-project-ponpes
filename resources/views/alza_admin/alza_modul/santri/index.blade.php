@extends('alza_admin.alza_layouts.alza_template')

@section('alzacontent')
<div class="col-md-12 col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $title }}
                <a class="btn btn-primary btn-sm float-right"
                    href="{{ url('/'.config('pathadmin.admin_name').'/export/santri') }}">Export Excel</a>
                @can('santri-create')
                <a class="btn btn-success btn-sm float-right"
                    href="{{ route(config('pathadmin.admin_prefix').'santris.create') }}"> Tambah
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
                            value="{!! !empty(Request::get('keyword')) ? Request::get('keyword') : '' !!}">
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th class="text-center" width="20">No</th>
                                <th>Foto Profil</th>
                                <th>Nama lengkap</th>
                                <th>Username</th>
                                <th>Tempat lahir</th>
                                <th>Tanggal lahir</th>
                                <th>Jenis kelamin</th>
                                <th>Jurusan</th>
                                <th>Tingkat</th>
                                <th>No Telepon</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th width="50px">Password</th>
                                <th>Orangtua/Wali</th>
                                <th>Pendidikan</th>
                                <th width="280" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($santris as $key => $santri)
                            <tr>
                                <td>
                                    <center>{{ $key + 1 + $valuepage }}</center>
                                </td>
                                <td>
                                    @if($santri->fotoSantri && $santri->fotoSantri->foto)
                                        <img src="{{ asset('storage/fotosantri/' . $santri->fotoSantri->foto) }}" alt="Foto Santri" width="60">
                                    @else
                                        <small>Belum ada foto</small>
                                    @endif
                                </td>
                                <td>{{$santri->nama_lengkap}}</td>
                                <td>{{$santri->username}}</td>
                                <td>{{$santri->tempat_lahir}}</td>
                                <td>{{$santri->tanggal_lahir}}</td>
                                <td>{{$santri->jenis_kelamin}}</td>
                                <td>{{$santri->jurusan->nama}}</td>
                                <td>
                                    @if ($santri->tingkat_pendidikan==1)
                                        SD
                                    @elseif ($santri->tingkat_pendidikan==2)
                                        SMP
                                    @else
                                        SMA
                                    @endif
                                </td>
                                <td>{{$santri->no_telepon}}</td>
                                <td>{{$santri->email}}</td>
                                <td>{{$santri->alamat}}</td>
                                <td width="50px"><span class="masked-password">{{ $santri->pw_nohash }}</span></td>
                                {{-- <td width="50px"><span class="masked-password">{{ substr(str_repeat('*', strlen($santri->password)),0,8) }}</span></td> --}}
                                <td>

                                    @forelse ($santri->ortu()->get() as $ortu)
                                        <span>{{$ortu->nama}}</span>
                                        <br>
                                        <small>{{$ortu->kontak}}</small>
                                        <br>
                                    @empty
                                        <span><a href="{{route(config('pathadmin.admin_prefix').'orangtuawalis.create',['santri'=>$santri->id])}}">Tambah Ortu/Wali</a></span>
                                    @endforelse

                                    @if ($santri->ortu()->get()->count() > 0 )
                                        <span><a href="{{route(config('pathadmin.admin_prefix').'orangtuawalis.index',['santri'=>$santri->id])}}" title="ubah data orang tua / wali"><i class="fas fa-edit"></i></a></span>
                                    @endif
                                </td>
                                <td>
                                    @forelse ($santri->pendidikan()->get() as $pen)
                                        <span>{{$pen->nama_sekolah}} ({{$pen->tahun_lulus}})</span>
                                    @empty
                                    <span><a href="{{route(config('pathadmin.admin_prefix').'pendidikanakhirs.create',['santri'=>$santri->id])}}">Tambah Riwayat Pendidikan</a></span>
                                    @endforelse

                                    @if ($santri->pendidikan()->get()->count() > 0 )
                                        <span><a href="{{route(config('pathadmin.admin_prefix').'pendidikanakhirs.index',['santri'=>$santri->id])}}" title="ubah data riwayat pendidikan akhir"><i class="fas fa-edit"></i></a></span>
                                    @endif
                                </td>
                                <td>
                                    <center>
                                        @can('santri-edit')
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route(config('pathadmin.admin_prefix').'santris.edit', $santri->id) }}">Ubah</a>
                                        @endcan
                                        @can('santri-delete')
                                        {!! Form::open(['method' => 'DELETE', 'route' =>
                                        [config('pathadmin.admin_prefix').'santris.destroy', $santri->id], 'style' =>
                                        'display:inline']) !!}
                                        {!! Form::submit('Hapus', ['class' => 'btn btn-danger btn-sm']) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </center>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p class="pt-1">{{ $labelcount }}</p>
                </div>
                {{ $santris->appends(['keyword' => Request::get('keyword')])->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

@endsection
