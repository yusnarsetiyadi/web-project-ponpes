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
                    {!! Form::open(['route' => config('pathadmin.admin_prefix').'kategoris.store', 'method' => 'POST', 'class' => 'form form-vertical','enctype' => 'multipart/form-data']) !!}
                    <div class="form-body">
                        <div class="row">
                            
                            <div class="col-12"><div class="form-group"><label>seo</label><input name="seo" class="form-control" type="text" value="{{ old('seo') }}"></div></div><div class="col-12"><div class="form-group"><label>nama</label><input name="nama" class="form-control" type="text" value="{{ old('nama') }}"></div></div><div class="col-12"><div class="form-group"><label>keterangan</label><input name="keterangan" class="form-control" type="text" value="{{ old('keterangan') }}"></div></div><div class="col-12"><div class="form-group"><label>aktif</label><select name="aktif" class="form-control">
<option value="-">-- select --</option>
	<option value="Y">Y</option>
	<option value="N">N</option>
</select></div></div>
                            <div class="col-12 d-flex justify-content-end border-top">
                                <button type="submit" class="btn btn-primary btn-sm mr-1 mb-1 mt-1">Proses</button>
                                <a class="btn btn-light-secondary btn-sm mr-1 mb-1 mt-1"
                                    href="{{ route(config('pathadmin.admin_prefix').'kategoris.index') }}"> Batal</a>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
