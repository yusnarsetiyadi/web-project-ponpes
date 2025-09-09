@extends('alza_admin.alza_layouts.alza_template')

@section('alzacontent')
<div class="col-md-12 col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $title }}
                @can('guru-create')
                <a class="btn btn-success btn-sm float-right"
                    href="{{ route(config('pathadmin.admin_prefix').'gurus.create') }}"> Tambah
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
                                <th>Nip</th>
                                <th>Nama_guru</th>
                                <th>Kontak</th>
                                <th>Alamat</th>
                                <th>Keterangan</th>

                                <th width="280" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gurus as $key => $guru)
                            <tr>
                                <td>
                                    <center>{{ $key + 1 + $valuepage }}</center>
                                </td>
                                <td>{{$guru->nip}}</td>
                                <td>{{$guru->nama_guru}}</td>
                                <td>{{$guru->kontak}}</td>
                                <td>{{$guru->alamat}}</td>
                                <td>{{$guru->keterangan}}</td>
                                <td>
                                    <center>
                                        @can('guru-edit')
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route(config('pathadmin.admin_prefix').'gurus.edit', $guru->id) }}">Ubah</a>
                                        @endcan
                                        @can('guru-delete')
                                        {!! Form::open(['method' => 'DELETE', 'route' =>
                                        [config('pathadmin.admin_prefix').'gurus.destroy', $guru->id], 'style' =>
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
                {{ $gurus->appends(['keyword' => Request::get('keyword')])->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

@endsection
