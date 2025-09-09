@extends('alza_admin.alza_layouts.alza_template')
@section('alzacontent')
    <div class="col-lg-12">
        <div class="row row-sm">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body pd-b-0">
                        <h6 class="card-body-title tx-12 tx-spacing-2 mg-b-20 tx-success">Guru</h6>
                        <h2 class="tx-lato tx-inverse">{{$guru}}</h2>

                    </div><!-- card-body -->
                    <div id="rs1" class="ht-50 ht-sm-70 mg-r--1"></div>
                </div><!-- card -->
            </div><!-- col-6 -->

            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body pd-b-0">
                        <h6 class="card-body-title tx-12 tx-spacing-2 mg-b-20 tx-primary">Santri</h6>
                        <h2 class="tx-lato tx-inverse">{{$santri}}</h2>

                    </div><!-- card-body -->
                    <div id="rs2" class="ht-50 ht-sm-70 mg-r--1"></div>
                </div><!-- card -->
            </div><!-- col-6 -->


            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body pd-b-0">
                        <h6 class="card-body-title tx-12 tx-spacing-2 mg-b-20 tx-warning">Calon Santri</h6>
                        <h2 class="tx-lato tx-inverse">{{$calonsantri}}</h2>

                    </div><!-- card-body -->
                    <div id="rs2" class="ht-50 ht-sm-70 mg-r--1"></div>
                </div><!-- card -->
            </div><!-- col-6 -->

            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body pd-b-0">
                        <h6 class="card-body-title tx-12 tx-spacing-2 mg-b-20 tx-danger">Berita</h6>
                        <h2 class="tx-lato tx-inverse">{{$berita}}</h2>

                    </div><!-- card-body -->
                    <div id="rs2" class="ht-50 ht-sm-70 mg-r--1"></div>
                </div><!-- card -->
            </div><!-- col-6 -->
        </div><!-- row -->

    </div><!-- col-8 -->
@endsection
