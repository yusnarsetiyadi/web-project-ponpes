@extends('alza_admin.alza_layouts.alza_template')

@section('alzacontent')
<div class="col-md-12 col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $title }}</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> terjadi masalah saat proses penginputan.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                {!! Form::model($guru, ['method' => 'PATCH', 'route' =>
                [config('pathadmin.admin_prefix').'gurus.update', $guru->id],'enctype' => 'multipart/form-data']) !!}
                <div class="form-body">
                    <div class="row">

                        <div class="col-12">
                            <div class="form-group"><label>nip</label><input name="nip" class="form-control"
                                    type="number" value="{{$guru->nip}}"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>nama_guru</label><input name="nama_guru" class="form-control"
                                    type="text" value="{{$guru->nama_guru}}"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>kontak</label><input name="kontak" class="form-control"
                                    type="text" value="{{$guru->kontak}}"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>alamat</label><textarea name="alamat" class="form-control"
                                    rows="10">{{$guru->alamat}}</textarea></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>keterangan</label><textarea name="keterangan"
                                    class="form-control" rows="10">{{$guru->keterangan}}</textarea></div>
                        </div>
                        <div class="col-12 d-flex justify-content-end border-top">
                            <button type="submit" class="btn btn-primary btn-sm mr-1 mb-1 mt-1">Proses</button>
                            <a class="btn btn-light-secondary btn-sm mr-1 mb-1 mt-1"
                                href="{{ route(config('pathadmin.admin_prefix').'gurus.index') }}"> Batal</a>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@once
@push('ext_css')
<style>
    .select2-container {
        width: 100% !important;
        /* Pastikan Select2 mengambil seluruh lebar elemen pembungkusnya */
    }

    .select2-selection--single {
        height: auto;
        /* Pastikan tingginya menyesuaikan isi */
        line-height: normal;
        /* Sesuaikan agar teks di dalam select lebih rapi */
    }
</style>
<link href="{{ url('/assets/css/select2.min.css') }}" rel="stylesheet" />
@endpush
@push('ext_scripts')
<script src="{{ url('/assets/js/select2.min.js') }}"></script>

@endpush
@endonce
@endsection
