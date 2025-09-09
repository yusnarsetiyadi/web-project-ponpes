@extends('alza_admin.alza_layouts.alza_template')

@section('alzacontent')
<div class="col-md-12 col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $title }}
            </h4>
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
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
                <div class="row">
                    <div class="col-12">
                        <form action="{{ url('/'.config('pathadmin.admin_name').'/generate-proccess') }}" method="POST">
                            @csrf
                            @method('POST')

                            <div class="form-group"><label>Kategori/Jenis</label><select name="kategoribayaran_id" class="form-control">
                                <option value="-- PILIH --">-- PILIH --</option>
                                @foreach ($kategoripembayaran as $row)
                                    <option value="{{ $row->id }}" {!! old('kategoribayaran_id') == $row->id ? 'selected' : '' !!}> {{ $row->nama }}</option>
                                @endforeach
                            </select></div>

                            <div class="form-group"><label>tingkat</label><select name="tingkatpendidikan" class="form-control">
                                <option value="-">-- select --</option>
                                <option value="1">SD</option>
                                <option value="2">SMP</option>
                                <option value="3">SMA</option>
                            </select></div>

                            <div class="form-group">
                                <label for="periode_bulan">Periode Bulan</label>
                                <select class="form-control" id="periode_bulan" name="bulan" required>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ old('bulan') == $i ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::createFromFormat('m', $i)->format('F') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="periode_tahun">Periode Tahun</label>
                                <select class="form-control" id="periode_tahun" name="tahun" required>
                                    @for ($i = now()->year; $i >= now()->year - 10; $i--)
                                        <option value="{{ $i }}" {{ old('tahun') == $i ? 'selected' : '' }}>
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Generate</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
