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
                <form action="{{ route(config('pathadmin.admin_prefix').'kategoribayarans.update', $kategoribayaran->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-body">
                    <div class="row">

                        <div class="col-12">
                            <div class="form-group"><label>nama</label><input name="nama" class="form-control"
                                    type="text" value="{{$kategoribayaran->nama}}"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>nominal</label><input name="nominal" class="form-control"
                                    type="text" value="{{$kategoribayaran->nominal}}"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>tingkat</label><select name="tingkat" class="form-control">
                                    <option value="1" {!! (($kategoribayaran->tingkat == '1') ? 'selected' : '') !!}>SD
                                    </option>
                                    <option value="2" {!! (($kategoribayaran->tingkat == '2') ? 'selected' : '') !!}>SMP
                                    </option>
                                    <option value="3" {!! (($kategoribayaran->tingkat == '3') ? 'selected' : '') !!}>SMA
                                    </option>
                                </select></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>aktif</label><select name="aktif" class="form-control">
                                    <option value="Y" {!! (($kategoribayaran->aktif == 'Y') ? 'selected' : '') !!}>Y
                                    </option>
                                    <option value="N" {!! (($kategoribayaran->aktif == 'N') ? 'selected' : '') !!}>N
                                    </option>
                                </select></div>
                        </div>
                        <div class="col-12 d-flex justify-content-end border-top">
                            <button type="submit" class="btn btn-primary btn-sm mr-1 mb-1 mt-1">Proses</button>
                            <a class="btn btn-light-secondary btn-sm mr-1 mb-1 mt-1"
                                href="{{ route(config('pathadmin.admin_prefix').'kategoribayarans.index') }}"> Batal</a>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
