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
                {!! Form::model($program, ['method' => 'PATCH', 'route' =>
                [config('pathadmin.admin_prefix').'programs.update', $program->id],'enctype' => 'multipart/form-data'])
                !!}
                <div class="form-body">
                    <div class="row">

                        <input type="hidden" name="kategori_id" value="{{$program->kategori_id}}">

                        <div class="col-12">
                            <div class="form-group"><label>seo</label><input name="seo" class="form-control" type="text"
                                    value="{{$program->seo}}"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>judul</label><input name="judul" class="form-control"
                                    type="text" value="{{$program->judul}}"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>gambar</label><input name="gambar" class="form-control"
                                    type="file"><input type="hidden" name="imagenow" class="form-control"
                                    value="{{$program->gambar}}"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>keterangan</label><textarea name="keterangan"
                                    class="form-control" rows="10" id="body">{{$program->keterangan}}</textarea></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>status</label><select name="status" class="form-control">
                                    <option value="darft" {!! (($program->status == 'darft') ? 'selected' : '')
                                        !!}>darft</option>
                                    <option value="publish" {!! (($program->status == 'publish') ? 'selected' : '')
                                        !!}>publish</option>
                                </select></div>
                        </div>
                        <div class="col-12 d-flex justify-content-end border-top">
                            <button type="submit" class="btn btn-primary btn-sm mr-1 mb-1 mt-1">Proses</button>
                            <a class="btn btn-light-secondary btn-sm mr-1 mb-1 mt-1"
                                href="{{ route(config('pathadmin.admin_prefix').'programs.index') }}"> Batal</a>
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
