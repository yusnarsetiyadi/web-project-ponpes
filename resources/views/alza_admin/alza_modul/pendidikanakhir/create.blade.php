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
                {!! Form::open(['route' => config('pathadmin.admin_prefix').'pendidikanakhirs.store', 'method' =>
                'POST', 'class' => 'form form-vertical','enctype' => 'multipart/form-data']) !!}
                <div class="form-body">
                    <div class="row">
                        <input type="hidden" name="santri_id" value="{{Request::get("santri")}}">
                        <div class="col-12">
                            <div class="form-group"><label>nama_sekolah</label><input name="nama_sekolah"
                                    class="form-control" type="text" value="{{ old('nama_sekolah') }}"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>tahun_lulus</label><input name="tahun_lulus"
                                    class="form-control" type="number" value="{{ old('tahun_lulus') }}"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>nilai_rata_rata</label><input name="nilai_rata_rata"
                                    class="form-control" type="text" value="{{ old('nilai_rata_rata') }}"></div>
                        </div>
                        <div class="col-12 d-flex justify-content-end border-top">
                            <button type="submit" class="btn btn-primary btn-sm mr-1 mb-1 mt-1">Proses</button>
                            <a class="btn btn-light-secondary btn-sm mr-1 mb-1 mt-1"
                                href="{{ route(config('pathadmin.admin_prefix').'pendidikanakhirs.index') }}"> Batal</a>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection