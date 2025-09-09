<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ Alzaget::title() }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('assets/lib/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/alza.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    {{-- <link href="{{ asset('fonts/LivIconsEvo/LivIconsEvo.css') }}" rel="stylesheet" />
    <link href="{{ asset('fonts/boxicons/css/boxicons.css') }}" rel="stylesheet" /> --}}
    <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet" />
    @stack('ext_css')
</head>

<body>

    <!-- ##### SIDEBAR LOGO ##### -->
    <div class="az-sideleft-header">
        @include('alza_admin.alza_layouts.alza_sidelogo')
        <!-- input-group -->
    </div><!-- az-sideleft-header -->

    <!-- ##### SIDEBAR MENU ##### -->
    <div class="az-sideleft">
        @include('alza_admin.alza_layouts.alza_sidemenu')
    </div><!-- az-sideleft -->

    <!-- ##### HEAD PANEL ##### -->
    <div class="az-headpanel">
        @include('alza_admin.alza_layouts.alza_navbartop')
        <!-- az-headpanel-right -->
    </div><!-- az-headpanel -->
    <div class="az-breadcrumb">
        <nav class="breadcrumb w-100">
            <a class="breadcrumb-item" href="{{ asset('' . config('pathadmin.admin_name') . '/home') }}">Home</a>
            <span class="breadcrumb-item active">Dashboard</span>
            <marquee scrolldelay="400" style="display: block;margin-left: 10px;">
                {{ Alzaget::greeting() }}. Selamat Datang Kembali Dihalaman Administrator!
            </marquee>
        </nav>
    </div><!-- az-breadcrumb -->

    <!-- ##### MAIN PANEL ##### -->
    <div class="az-mainpanel">
        <div class="az-pagetitle">
            <h5>Admin Panel</h5>
        </div><!-- az-pagetitle -->

        <div class="az-pagebody pb-5">
            <div class="row row-sm">
                @yield('alzacontent')
                <!-- col-4 -->
            </div><!-- row -->
        </div><!-- az-pagebody -->

        <div class="az-footer bg-dark w-100 py-1">
            @include('alza_admin.alza_layouts.alza_footer')
        </div><!-- az-footer -->
    </div><!-- az-mainpanel -->

    <script src="{{ asset('assets/lib/jquery/jquery.js') }}"></script>
    {{-- <script src="{{ asset('fonts/LivIconsEvo/js/LivIconsEvo.Tools.js') }}"></script>
    <script src="{{ asset('fonts/LivIconsEvo/js/LivIconsEvo.defaults.js') }}"></script>
    <script src="{{ asset('fonts/LivIconsEvo/js/LivIconsEvo.min.js') }}"></script> --}}
    <script src="{{ asset('fontawesome/js/all.min.js') }}"></script>
    <script src="{{ asset('assets/lib/popper.js/popper.js') }}"></script>
    <script src="{{ asset('assets/lib/bootstrap/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js') }}"></script>
    <script src="{{ asset('assets/lib/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/lib/d3/d3.js') }}"></script>
    <script src="{{ asset('assets/js/alza.js') }}"></script>
    <script src="{{ asset('assets/js/ResizeSensor.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/custom.js') }}"></script> --}}
    @stack('ext_scripts')
</body>

</html>
