@extends('alza_admin.alza_layouts.alza_template')

@section('alzacontent')

<div class="col-md-12 col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $title }}</h4>
        </div>
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
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
                {!! Form::open(['route' => config('pathadmin.admin_prefix').'gurus.store', 'method' => 'POST', 'class'
                => 'form form-vertical','enctype' => 'multipart/form-data']) !!}
                <div class="form-body">
                    <div class="row">

                        <div class="col-12">
                            <div class="form-group"><label>nip</label><input name="nip" class="form-control"
                                    type="number" value="{{ old('nip') }}"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>nama_guru</label><input name="nama_guru" class="form-control"
                                    type="text" value="{{ old('nama_guru') }}"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>kontak</label><input name="kontak" class="form-control"
                                    type="text" value="{{ old('kontak') }}"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>alamat</label><textarea name="alamat" class="form-control"
                                    rows="10">{{ old('alamat') }}</textarea></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>keterangan</label><textarea name="keterangan"
                                    class="form-control" rows="10">{{ old('keterangan') }}</textarea></div>
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
    }

    .select2-selection--single {
        height: auto;
        line-height: normal;
    }
</style>
<link href="{{ url('/assets/css/select2.min.css') }}" rel="stylesheet" />
@endpush
@push('ext_scripts')
<script src="{{ url('/assets/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        // Inisialisasi Select2 untuk alamat tinggal
        $('#tinggal_provinsi').select2({ width: '100%' });
        $('#tinggal_kota').select2({ width: '100%' });
        $('#tinggal_kecamatan').select2({ width: '100%' });
        $('#tinggal_desa').select2({ width: '100%' });

        // Mengambil data provinsi dari API
        $.ajax({
            url: `{{ url('/'.config('pathadmin.admin_name').'/wilayah/prov') }}`,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $.each(data.data, function(key, value) {
                    $('#tinggal_provinsi').append('<option value="' + value.id + '">' + value.text + '</option>');
                });
            }
        });

        // Mengambil data kota berdasarkan provinsi_id
        $('#tinggal_provinsi').on('change', function() {
            var provinsiId = $(this).val();
            $('#tinggal_kota').empty().append('<option value="">Pilih Kota</option>');
            $('#tinggal_kecamatan').empty().append('<option value="">Pilih Kecamatan</option>');
            $('#tinggal_desa').empty().append('<option value="">Pilih Desa</option>');

            if (provinsiId) {
                $.ajax({
                    url: `{{ url('/'.config('pathadmin.admin_name').'/wilayah/${provinsiId}/kabkot') }}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $.each(data.data, function(key, value) {
                            $('#tinggal_kota').append('<option value="' + value.id + '">' + value.text + '</option>');
                        });
                    }
                });
            }
        });

        // Mengambil data kecamatan berdasarkan kota_id
        $('#tinggal_kota').on('change', function() {
            var kotaId = $(this).val();
            $('#tinggal_kecamatan').empty().append('<option value="">Pilih Kecamatan</option>');
            $('#tinggal_desa').empty().append('<option value="">Pilih Desa</option>');

            if (kotaId) {
                $.ajax({
                    url: `{{ url('/'.config('pathadmin.admin_name').'/wilayah/${kotaId}/kec') }}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $.each(data.data, function(key, value) {
                            $('#tinggal_kecamatan').append('<option value="' + value.id + '">' + value.text + '</option>');
                        });
                    }
                });
            }
        });

        // Mengambil data desa berdasarkan kecamatan_id
        $('#tinggal_kecamatan').on('change', function() {
            var kecamatanId = $(this).val();
            $('#tinggal_desa').empty().append('<option value="">Pilih Desa</option>');

            if (kecamatanId) {
                $.ajax({
                    url: `{{ url('/'.config('pathadmin.admin_name').'/wilayah/${kecamatanId}/desa') }}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $.each(data.data, function(key, value) {
                            $('#tinggal_desa').append('<option value="' + value.id + '">' + value.text + '</option>');
                        });
                    }
                });
            }
        });

        // Notifikasi error/success
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}', 'Error');
            @endforeach
        @endif

        @if (session('success'))
            toastr.success('{{ session('success') }}', 'Sukses');
        @endif

        @if (session('error'))
            toastr.error('{{ session('error') }}', 'Error');
        @endif
    });
</script>
@endpush
@endonce
@endsection
