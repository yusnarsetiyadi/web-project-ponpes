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
                {!! Form::model($orangtuawali, ['method' => 'PATCH', 'route' =>
                [config('pathadmin.admin_prefix').'orangtuawalis.update', $orangtuawali->id],'enctype' =>
                'multipart/form-data']) !!}
                <div class="form-body">
                    <div class="row">
                        <input type="hidden" name="santri_id" value="{{$orangtuawali->santri_id}}">
                        <div class="col-12">
                            <div class="form-group"><label>nama</label><input name="nama" class="form-control"
                                    type="text" value="{{$orangtuawali->nama}}"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>pekerjaan</label><input name="pekerjaan" class="form-control"
                                    type="text" value="{{$orangtuawali->pekerjaan}}"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>penghasilan_perbulan</label><input
                                    name="penghasilan_perbulan" class="form-control" type="text"
                                    value="{{$orangtuawali->penghasilan_perbulan}}"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>kontak</label><input name="kontak" class="form-control"
                                    type="number" value="{{$orangtuawali->kontak}}"></div>
                        </div>
                        <div class="col-12 d-flex justify-content-end border-top">
                            <button type="submit" class="btn btn-primary btn-sm mr-1 mb-1 mt-1">Proses</button>
                            <a class="btn btn-light-secondary btn-sm mr-1 mb-1 mt-1"
                                href="{{ route(config('pathadmin.admin_prefix').'orangtuawalis.index') }}"> Batal</a>
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