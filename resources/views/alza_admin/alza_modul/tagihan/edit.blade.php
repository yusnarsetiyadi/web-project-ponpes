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
                    {!! Form::model($tagihan, ['method' => 'PATCH', 'route' => [config('pathadmin.admin_prefix').'tagihans.update', $tagihan->id],'enctype' => 'multipart/form-data']) !!}
                    <div class="form-body">
                        <div class="row">
                            
                            <div class="col-12"><div class="form-group"><label>santri_id</label><input name="santri_id" class="form-control" type="number" value="{{$tagihan->santri_id}}"></div></div><div class="col-12"><div class="form-group"><label>kategoribayaran_id</label><input name="kategoribayaran_id" class="form-control" type="number" value="{{$tagihan->kategoribayaran_id}}"></div></div><div class="col-12"><div class="form-group"><label>nominal</label><input name="nominal" class="form-control" type="text" value="{{$tagihan->nominal}}"></div></div><div class="col-12"><div class="form-group"><label>tingkatpendidikan</label><select name="tingkatpendidikan" class="form-control">
	<option value="1" {!! (($tagihan->tingkatpendidikan == '1') ? 'selected' : '') !!}>1</option>
	<option value="2" {!! (($tagihan->tingkatpendidikan == '2') ? 'selected' : '') !!}>2</option>
	<option value="3" {!! (($tagihan->tingkatpendidikan == '3') ? 'selected' : '') !!}>3</option>
</select></div></div><div class="col-12"><div class="form-group"><label>bulan</label><input name="bulan" class="form-control" type="number" value="{{$tagihan->bulan}}"></div></div><div class="col-12"><div class="form-group"><label>tahun</label><input name="tahun" class="form-control" type="number" value="{{$tagihan->tahun}}"></div></div><div class="col-12"><div class="form-group"><label>status_pembyaran</label><select name="status_pembyaran" class="form-control">
	<option value="1" {!! (($tagihan->status_pembyaran == '1') ? 'selected' : '') !!}>1</option>
	<option value="0" {!! (($tagihan->status_pembyaran == '0') ? 'selected' : '') !!}>0</option>
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
