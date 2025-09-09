<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{Alzaget::title()}} - Dashboard Santri</title>
  <!-- UIkit 3 CSS -->
  <link rel="stylesheet" href="{{ asset('uikit/css/uikit.min.css') }}" />
  <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary-color: #024d09;
      --secondary-color: #e69500;
      --accent-color: #0e9b1c;
      --light-color: #f8f9fa;
      --dark-color: #343a40;
      --danger-color: #dc3545;
      --success-color: #28a745;
    }
    
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f5f7fa;
      color: #4a5568;
      line-height: 1.6;
    }
    
    /* Navbar Styles */
   
    
    .uk-navbar-container {
      background-color: #024d09; /* Warna hijau tua */
      border-bottom: orange 4px solid;
    }

    .uk-card-body-green {
      border: #024d09 1px solid;
    }

    .uk-navbar-item,
    .uk-navbar-nav > li > a {
      color: #fff !important;
      font-size: 1rem;
      font-weight: 500;
    }
    .uk-navbar-nav > li > a:hover,
    .uk-active > a {
      color: #f5bd02 !important; /* Warna kuning saat aktif/hover */
    }
    .uk-button-login {
      background-color: #ffa500; /* Warna oranye */
      color: #fff;
      border-radius: 20px;
      padding: 5px 15px;
      transition: background-color 0.3s;
    }
    .uk-button-login:hover {
      background-color: #e69500;
      color: #fff;
    }
    
    
    /* Sidebar Navigation */
    .sidebar {
      background: white;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
      padding: 0;
      overflow: hidden;
    }
    
    .sidebar-header {
      background-color: var(--primary-color);
      color: white;
      padding: 20px;
      text-align: center;
    }
    
    .sidebar-header h4 {
      margin: 0;
      font-weight: 600;
    }
    
    .sidebar-menu {
      padding: 0;
      margin: 0;
      list-style: none;
    }
    
    .sidebar-menu li {
      border-bottom: 1px solid #edf2f7;
      transition: all 0.3s ease;
    }
    
    .sidebar-menu li:last-child {
      border-bottom: none;
    }
    
    .sidebar-menu li a {
      display: flex;
      align-items: center;
      padding: 15px 20px;
      color: #4a5568;
      text-decoration: none;
      transition: all 0.3s ease;
    }
    
    .sidebar-menu li a:hover {
      background-color: #f7fafc;
      color: var(--primary-color);
      padding-left: 25px;
    }
    
    .sidebar-menu li a i {
      margin-right: 10px;
      width: 20px;
      text-align: center;
      color: var(--primary-color);
    }
    
    .sidebar-menu li.active a {
      background-color: rgba(2, 77, 9, 0.1);
      color: var(--primary-color);
      font-weight: 500;
      border-left: 4px solid var(--primary-color);
    }
    
    /* Main Content Area */
    .main-content {
      background: white;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
      padding: 25px;
      min-height: calc(100vh - 120px);
    }
    
    .page-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
      padding-bottom: 15px;
      border-bottom: 1px solid #edf2f7;
    }
    
    .page-header h2 {
      margin: 0;
      color: var(--primary-color);
      font-weight: 600;
    }
    
    /* Cards */
    .stat-card {
      background: white;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
      padding: 20px;
      margin-bottom: 20px;
      transition: transform 0.3s ease;
    }
    
    .stat-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    }
    
    .stat-card .icon {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 15px;
    }
    
    .stat-card .icon i {
      font-size: 24px;
      color: white;
    }
    
    .stat-card h3 {
      margin: 0 0 5px 0;
      font-size: 18px;
      color: var(--dark-color);
    }
    
    .stat-card p {
      margin: 0;
      font-size: 24px;
      font-weight: 600;
      color: var(--primary-color);
    }
    
    /* Modal */
    .uk-modal-dialog {
      border-radius: 8px;
      overflow: hidden;
    }
    
    .uk-modal-header {
      background-color: var(--primary-color);
      color: white;
      padding: 20px;
    }
    
    .uk-modal-title {
      margin: 0;
      font-weight: 600;
    }
    
    .uk-modal-body {
      padding: 25px;
    }
    
    /* Buttons */
    .uk-button-primary {
      background-color: var(--primary-color);
      border-radius: 6px;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    
    .uk-button-primary:hover {
      background-color: #013a06;
      transform: translateY(-2px);
    }
    
    .uk-button-secondary {
      background-color: var(--secondary-color);
      color: white;
      border-radius: 6px;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    
    .uk-button-secondary:hover {
      background-color: #d68900;
      color: white;
      transform: translateY(-2px);
    }
    
    /* Form Elements */
    .uk-input, .uk-select {
      border-radius: 6px;
      border: 1px solid #e2e8f0;
      padding: 10px 15px;
      transition: all 0.3s ease;
    }
    
    .uk-input:focus, .uk-select:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(2, 77, 9, 0.2);
    }
    
    /* Responsive Adjustments */
    @media (max-width: 960px) {
      .sidebar {
        margin-bottom: 20px;
      }
    }
    
    /* Utility Classes */
    .text-primary {
      color: var(--primary-color) !important;
    }
    
    .bg-primary {
      background-color: var(--primary-color) !important;
    }
    
    .text-secondary {
      color: var(--secondary-color) !important;
    }
    
    .bg-secondary {
      background-color: var(--secondary-color) !important;
    }
    
    .rounded {
      border-radius: 8px !important;
    }
    
    .shadow {
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05) !important;
    }
  </style>
  @stack('scriptcss')
</head>
<body>
  @include('frontend.nav')

  <div class="uk-container uk-container-expand uk-padding-remove-horizontal uk-margin-remove" uk-height-viewport="expand: true">

    @php
        $santri = Auth::guard('santris')->check();
    @endphp
    @if ( $santri && Request::segment(1) == 'santri' )
        <div uk-grid>
            <!-- Sidebar Navigation -->
            <div class="uk-width-1-4@m">
                <div class="sidebar">
                    <div class="sidebar-header">
                        <h4>Menu Santri</h4>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="{{ Request::is('santri/home') ? 'active' : '' }}">
                            <a href="{{url('/santri/home')}}">
                                <i class="fas fa-home"></i> Dashboard
                            </a>
                        </li>
                        <li class="{{ Request::is('santri/profile') ? 'active' : '' }}">
                            <a href="{{url('/santri/profile')}}">
                                <i class="fas fa-user"></i> Profil Saya
                            </a>
                        </li>
                        <li class="{{ Request::is('santri/tagihan') ? 'active' : '' }}">
                            <a href="{{url('/santri/tagihan')}}">
                                <i class="fas fa-file-invoice-dollar"></i> Tagihan
                            </a>
                        </li>
                        <li class="{{ Request::is('santri/pelunasan/tagihan') ? 'active' : '' }}">
                            <a href="{{url('/santri/pelunasan/tagihan')}}">
                                <i class="fas fa-money-bill-wave"></i> Pembayaran
                            </a>
                        </li>
                        <li>
                            <a href="#change-password" uk-toggle>
                                <i class="fas fa-key"></i> Ganti Password
                            </a>
                        </li>
                       
                    </ul>
                </div>
                
                <!-- Quick Stats -->
                <div class="uk-margin-top">
                    <div class="stat-card">
                        <div class="icon bg-primary">
                            <i class="fas fa-book"></i>
                        </div>
                        <h3>Program Tahfidz</h3>
                        <p>30 Juz</p>
                    </div>
                </div>
            </div>
            
            <!-- Main Content Area -->
            <div class="uk-width-3-4@m">
                <div class="main-content">
                    <div class="page-header">
                        <h2>@yield('page-title', 'Dashboard Santri')</h2>
                        <div class="uk-text-muted">
                            <i class="far fa-calendar-alt"></i> {{ now()->format('l, d F Y') }}
                        </div>
                    </div>
                    
                    @yield('contentx')
                </div>
            </div>
        </div>
    @else
        <div uk-height-viewport="expand: true">
            @yield('content')
        </div>
    @endif
  </div>

  <!-- Change Password Modal -->
  <div id="change-password" uk-modal>
    <div class="uk-modal-dialog">
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Ganti Password</h2>
        </div>
        <div class="uk-modal-body">
            <div uk-grid>
                <input type="hidden" name="id" value="{{Session::get('id')}}">
                <div class="uk-width-1-1 uk-margin">
                    <label class="uk-form-label">Password Baru</label>
                    <div class="uk-inline uk-width-1-1">
                        <span class="uk-form-icon" uk-icon="icon: lock"></span>
                        <input class="uk-input" name="password" type="password" placeholder="Masukkan password baru" required>
                    </div>
                </div>
                <div class="uk-width-1-1 uk-margin">
                    <label class="uk-form-label">Konfirmasi Password</label>
                    <div class="uk-inline uk-width-1-1">
                        <span class="uk-form-icon" uk-icon="icon: lock"></span>
                        <input class="uk-input" name="password_konfirm" type="password" placeholder="Konfirmasi password baru" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Batal</button>
            <button class="uk-button uk-button-primary" type="button" id="submit-change-password">Simpan Perubahan</button>
        </div>
    </div>
  </div>
   @include('frontend.footer')
  <!-- UIkit JS -->
  <script src="{{ asset('assets/lib/jquery/jquery.js') }}"></script>
  <script src="{{ asset('uikit/js/uikit.min.js') }}"></script>
  <script src="{{ asset('uikit/js/uikit-icons.min.js') }}"></script>

  <script>
    $(document).ready(function() {
        $('#submit-change-password').click(function() {
            // Ambil data dari input
            let password = $('input[name="password"]').val();
            let password_konfirm = $('input[name="password_konfirm"]').val();
            
            // Validasi
            if(password.length < 6) {
                UIkit.notification({
                    message: 'Password minimal 6 karakter',
                    status: 'danger',
                    pos: 'top-center'
                });
                return;
            }
            
            if(password !== password_konfirm) {
                UIkit.notification({
                    message: 'Password dan konfirmasi password tidak sama',
                    status: 'danger',
                    pos: 'top-center'
                });
                return;
            }
            
            let data = {
                id: $('input[name="id"]').val(),
                password: password,
                password_konfirm: password_konfirm,
                _token: '{{ csrf_token() }}'
            };

            // Kirim data via AJAX
            $.ajax({
                url: "{{ url('/santri/update-password/'.Session::get('id')) }}",
                method: 'POST',
                data: data,
                beforeSend: function() {
                    $('#submit-change-password').prop('disabled', true).html('<span uk-spinner></span> Memproses...');
                },
                success: function(response) {
                    if(response.success){
                        UIkit.notification({
                            message: response.message, 
                            status: 'success',
                            pos: 'top-center'
                        });
                        UIkit.modal('#change-password').hide();
                        $('input[name="password"]').val('');
                        $('input[name="password_konfirm"]').val('');
                    } else {
                        UIkit.notification({
                            message: response.message, 
                            status: 'danger',
                            pos: 'top-center'
                        });
                    }
                },
                error: function(xhr) {
                    let errorMsg = 'Terjadi kesalahan. Silakan coba lagi.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    UIkit.notification({
                        message: errorMsg, 
                        status: 'danger',
                        pos: 'top-center'
                    });
                },
                complete: function() {
                    $('#submit-change-password').prop('disabled', false).text('Simpan Perubahan');
                }
            });
        });
    });
  </script>
  @stack('scriptjs')
</body>
</html>