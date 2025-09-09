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
                {!! Form::open(['route' => config('pathadmin.admin_prefix').'events.store', 'method' => 'POST', 'class'
                => 'form form-vertical','enctype' => 'multipart/form-data']) !!}
                <div class="form-body">
                    <div class="row">

                        <div class="col-12">
                            <div class="form-group"><label>seo</label><input name="seo" class="form-control" type="text"
                                    value="{{ old('seo') }}"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>judul</label><input name="judul" class="form-control"
                                    type="text" value="{{ old('judul') }}"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>gambar</label><input name="gambar" class="form-control"
                                    type="file" value="{{ old('gambar') }}"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>keterangan</label><textarea name="keterangan"
                                    class="form-control" rows="10" id="body">{{ old('keterangan') }}</textarea></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>tanggal_mulai</label><input name="tanggal_mulai"
                                    class="form-control" type="date" value="{{ old('tanggal_mulai') }}"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>tanggal_berakhir</label><input name="tanggal_berakhir"
                                    class="form-control" type="date" value="{{ old('tanggal_berakhir') }}"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>aktif</label><select name="aktif" class="form-control">
                                    <option value="-">-- select --</option>
                                    <option value="Y">Y</option>
                                    <option value="N">N</option>
                                </select></div>
                        </div>
                        <div class="col-12 d-flex justify-content-end border-top">
                            <button type="submit" class="btn btn-primary btn-sm mr-1 mb-1 mt-1">Proses</button>
                            <a class="btn btn-light-secondary btn-sm mr-1 mb-1 mt-1"
                                href="{{ route(config('pathadmin.admin_prefix').'events.index') }}"> Batal</a>
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
<link rel="stylesheet" type="text/css" href="{{ url('assets/css/summernote.min.css') }}">
@endpush
@push('ext_scripts')
<script src="{{ url('assets/js/summernote.min.js') }}"></script>
<script>
    $(document).ready(function() {
            $('#body').summernote({
                height: '300px'
                , toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']]
                    , ['font', ['strikethrough', 'superscript', 'subscript']]
                    , ['fontsize', ['fontsize']]
                    , ['color', ['color']]
                    , ['para', ['ul', 'ol', 'paragraph']]
                    , ['height', ['height']]
                    , ['view', ['fullscreen', 'codeview']]
                , ]
            , });
        });

</script>
@endpush
@endonce
@endsection
