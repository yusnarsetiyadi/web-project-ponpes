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
                    {!! Form::open(['route' => config('pathadmin.admin_prefix').'tagihans.store', 'method' => 'POST', 'class' => 'form form-vertical','enctype' => 'multipart/form-data']) !!}
                    <div class="form-body">
                        <div class="row">
                            
                            <div class="col-12"><div class="form-group"><label>santri_id</label><input name="santri_id" class="form-control" type="number" value="{{ old('santri_id') }}"></div></div><div class="col-12"><div class="form-group"><label>kategoribayaran_id</label><input name="kategoribayaran_id" class="form-control" type="number" value="{{ old('kategoribayaran_id') }}"></div></div><div class="col-12"><div class="form-group"><label>nominal</label><input name="nominal" class="form-control" type="text" value="{{ old('nominal') }}"></div></div><div class="col-12"><div class="form-group"><label>tingkatpendidikan</label><select name="tingkatpendidikan" class="form-control">
<option value="-">-- select --</option>
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
</select></div></div><div class="col-12"><div class="form-group"><label>bulan</label><input name="bulan" class="form-control" type="number" value="{{ old('bulan') }}"></div></div><div class="col-12"><div class="form-group"><label>tahun</label><input name="tahun" class="form-control" type="number" value="{{ old('tahun') }}"></div></div><div class="col-12"><div class="form-group"><label>status_pembyaran</label><select name="status_pembyaran" class="form-control">
<option value="-">-- select --</option>
	<option value="1">1</option>
	<option value="0">0</option>
</select></div></div>
                            <div class="col-12 d-flex justify-content-end border-top">
                                <button type="submit" class="btn btn-primary btn-sm mr-1 mb-1 mt-1">Proses</button>
                                <a class="btn btn-light-secondary btn-sm mr-1 mb-1 mt-1"
                                    href="{{ route(config('pathadmin.admin_prefix').'tagihans.index') }}"> Batal</a>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
