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
                    {!! Form::model($akunbank, ['method' => 'PATCH', 'route' => [config('pathadmin.admin_prefix').'akunbanks.update', $akunbank->id],'enctype' => 'multipart/form-data']) !!}
                    <div class="form-body">
                        <div class="row">

                            <div class="col-12"><div class="form-group"><label>norek</label><input name="norek" class="form-control" type="text" value="{{$akunbank->norek}}"></div></div><div class="col-12"><div class="form-group"><label>atas_nama</label><input name="atas_nama" class="form-control" type="text" value="{{$akunbank->atas_nama}}"></div></div><div class="col-12"><div class="form-group"><label>nama_bank</label><input name="nama_bank" class="form-control" type="text"class="form-control" value="{{$akunbank->nama_bank}}"></div></div><div class="col-12"><div class="form-group"><label>aktif</label><select name="aktif" class="form-control">
	<option value="Y" {!! (($akunbank->aktif == 'Y') ? 'selected' : '') !!}>Y</option>
	<option value="N" {!! (($akunbank->aktif == 'N') ? 'selected' : '') !!}>N</option>
</select></div></div>
                            <div class="col-12 d-flex justify-content-end border-top">
                                <button type="submit" class="btn btn-primary btn-sm mr-1 mb-1 mt-1">Proses</button>
                                <a class="btn btn-light-secondary btn-sm mr-1 mb-1 mt-1"
                                    href="{{ route(config('pathadmin.admin_prefix').'akunbanks.index') }}"> Batal</a>
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
            <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/summernote.min.css') }}">
        @endpush
        @push('ext_scripts')
            {{-- <script src="{{ url('app-assets/js/jquery-3.5.1.js') }}"></script> --}}
            <script src="{{ url('app-assets/js/summernote.js') }}"></script>
            <script>
                $(document).ready(function() {
                    $('#body').summernote({
                        height: '300px'
                    });
                });
            </script>
        @endpush
    @endonce
@endsection
