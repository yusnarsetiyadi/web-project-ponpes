<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{Alzaget::title()}} - Dashboard Santri</title>
  <!-- UIkit 3 CSS -->
  <link rel="stylesheet" href="{{ asset('uikit/css/uikit.min.css') }}" />
  <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary-color: #1e6a3c;
      --primary-light: #eaf6ef;
      --primary-dark: #134728;
      --secondary-color: #f39c12;
      --secondary-light: #fef5e7;
      --accent-color: #3498db;
      --light-color: #f8f9fa;
      --dark-color: #2c3e50;
      --danger-color: #e74c3c;
      --success-color: #2ecc71;
      --gray-100: #f7fafc;
      --gray-200: #edf2f7;
      --gray-300: #e2e8f0;
      --gray-400: #cbd5e0;
      --gray-500: #a0aec0;
      --text-color: #3d444e;
      --border-radius: 10px;
      --box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
      --transition: all 0.25s ease;
    }
    
    body {
      font-family: 'Nunito', sans-serif;
      background-color: #f5f7fb;
      color: var(--text-color);
      margin: 0;
      padding: 0;
      overflow-x: hidden;
    }
    
    /* Navbar Styles */
    .uk-navbar-container {
      background-color: rgb(16, 85, 15);
      color: white;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
      border-bottom: none;
      padding: 0 25px;
      height: 70px;
    }

    .uk-navbar-item,
    .uk-navbar-nav > li > a {
      color: white !important;
      font-size: 0.95rem;
      font-weight: 600;
      text-transform: none;
      transition: var(--transition);
      position: relative;
    }
    
    .uk-navbar-nav > li > a:hover {
      color: var(--primary-color) !important;
    }
    
    .uk-navbar-nav > li.uk-active > a:after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 15px;
      right: 15px;
      height: 3px;
      background-color: var(--primary-color);
      border-radius: 3px 3px 0 0;
    }
    
    .uk-button-login {
      background-color: var(--primary-color);
      color: white;
      border-radius: 30px;
      padding: 0 20px;
      font-weight: 600;
      transition: var(--transition);
      box-shadow: 0 4px 10px rgba(30, 106, 60, 0.2);
      text-transform: none;
      height: 40px;
      line-height: 40px;
    }
    
    .uk-button-login:hover {
      background-color: var(--primary-dark);
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 6px 15px rgba(30, 106, 60, 0.3);
    }
    
    .uk-logo {
      font-weight: 700;
      display: flex;
      align-items: center;
    }
    
    .uk-logo span {
      color: var(--primary-color);
      margin-left: 5px;
    }
    
    /* Dashboard Layout */
    .dashboard-container {
      display: flex;
      min-height: calc(100vh - 70px);
      width: 100%;
    }
    
    /* Sidebar Navigation */
    .sidebar {
      width: 280px;
      background: white;
      box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
      z-index: 100;
      height: calc(100vh - 70px);
      position: fixed;
      left: 0;
      top: 70px;
      overflow-y: auto;
    }
    
    .sidebar-header {
      background: linear-gradient(120deg, var(--primary-color), var(--primary-dark));
      color: white;
      padding: 25px 20px;
      text-align: center;
      position: relative;
    }
    
    .sidebar-header h4 {
      margin: 0;
      color: white !important;
      font-weight: 700;
      font-size: 18px;
      letter-spacing: 0.5px;
    }
    
    .sidebar-menu {
      padding: 10px 0;
      margin: 0;
      list-style: none;
    }
    
    .sidebar-menu li {
      transition: var(--transition);
    }
    
    .sidebar-menu li a {
      display: flex;
      align-items: center;
      padding: 12px 20px;
      color: var(--text-color);
      text-decoration: none;
      transition: var(--transition);
      border-left: 3px solid transparent;
    }
    
    .sidebar-menu li a:hover {
      background-color: var(--primary-light);
      color: var(--primary-color);
    }
    
    .sidebar-menu li a i {
      margin-right: 10px;
      width: 20px;
      text-align: center;
      color: var(--gray-500);
      font-size: 16px;
      transition: var(--transition);
    }
    
    .sidebar-menu li a:hover i {
      color: var(--primary-color);
    }
    
    .sidebar-menu li.active a {
      background-color: var(--primary-light);
      color: var(--primary-color);
      font-weight: 600;
      border-left: 3px solid var(--primary-color);
    }
    
    .sidebar-menu li.active a i {
      color: var(--primary-color);
    }
    
    /* Quick Stats in Sidebar */
    .sidebar-stats {
      padding: 15px;
    }
    
    /* Main Content Area */
    .main-content-wrapper {
      flex: 1;
      margin-left: 280px;
      width: calc(100% - 280px);
      padding: 25px;
      transition: var(--transition);
    }
    
    .main-content {
      background: white;
      border-radius: var(--border-radius);
      box-shadow: var(--box-shadow);
      padding: 25px;
      min-height: calc(100vh - 170px);
    }
    
    .page-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
      padding-bottom: 15px;
      border-bottom: 1px solid var(--gray-200);
    }
    
    .page-header h2 {
      margin: 0;
      color: var(--dark-color);
      font-weight: 700;
      font-size: 24px;
    }
    
    .page-date {
      color: var(--gray-500);
      font-size: 14px;
      display: flex;
      align-items: center;
    }
    
    .page-date i {
      margin-right: 6px;
    }
    
    /* Cards */
    .stat-card {
      background: white;
      border-radius: var(--border-radius);
      box-shadow: var(--box-shadow);
      padding: 20px;
      margin-bottom: 20px;
      transition: var(--transition);
      border: 1px solid var(--gray-200);
    }
    
    .stat-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 20px rgba(0, 0, 0, 0.1);
    }
    
    .stat-card .icon {
      width: 60px;
      height: 60px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 15px;
      background: linear-gradient(120deg, var(--primary-color), var(--primary-dark));
      box-shadow: 0 5px 15px rgba(30, 106, 60, 0.2);
    }
    
    .stat-card .icon i {
      font-size: 26px;
      color: white;
    }
    
    .stat-card h3 {
      margin: 0 0 8px 0;
      font-size: 16px;
      color: var(--gray-500);
      font-weight: 600;
    }
    
    .stat-card p {
      margin: 0;
      font-size: 24px;
      font-weight: 700;
      color: var(--dark-color);
    }
    
    /* Dashboard Cards */
    .dashboard-card {
      background: white;
      border-radius: var(--border-radius);
      box-shadow: var(--box-shadow);
      overflow: hidden;
      margin-bottom: 25px;
      transition: var(--transition);
      height: 100%;
    }
    
    .dashboard-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
    }
    
    .dashboard-card-header {
      padding: 20px;
      background-color: var(--primary-light);
      border-bottom: 1px solid var(--gray-200);
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    
    .dashboard-card-header h3 {
      margin: 0;
      font-size: 18px;
      font-weight: 700;
      color: var(--primary-color);
    }
    
    .dashboard-card-body {
      padding: 20px;
    }
    
    /* Modal */
    .uk-modal-dialog {
      border-radius: var(--border-radius);
      overflow: hidden;
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }
    
    .uk-modal-header {
      background: linear-gradient(120deg, var(--primary-color), var(--primary-dark));
      color: white;
      padding: 20px 30px;
    }
    
    .uk-modal-title {
      margin: 0;
      font-weight: 700;
      color: white;
      font-size: 22px;
    }
    
    .uk-modal-body {
      padding: 30px;
    }
    
    .uk-modal-footer {
      background-color: var(--gray-100);
      padding: 15px 30px;
      border-top: 1px solid var(--gray-200);
    }
    
    /* Buttons */
    .uk-button-primary {
      background: linear-gradient(120deg, var(--primary-color), var(--primary-dark));
      color: white;
      border-radius: 30px;
      font-weight: 600;
      transition: var(--transition);
      text-transform: none;
      padding: 0 25px;
      box-shadow: 0 5px 15px rgba(30, 106, 60, 0.15);
    }
    
    .uk-button-primary:hover {
      background: linear-gradient(120deg, var(--primary-dark), var(--primary-dark));
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(30, 106, 60, 0.25);
    }
    
    .uk-button-secondary {
      background: linear-gradient(120deg, var(--secondary-color), #e67e22);
      color: white;
      border-radius: 30px;
      font-weight: 600;
      transition: var(--transition);
      text-transform: none;
      padding: 0 25px;
      box-shadow: 0 5px 15px rgba(243, 156, 18, 0.15);
    }
    
    .uk-button-secondary:hover {
      background: linear-gradient(120deg, #e67e22, #d35400);
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(243, 156, 18, 0.25);
      color: white;
    }
    
    .uk-button-default {
      background-color: white;
      color: var(--text-color);
      border: 1px solid var(--gray-300);
      border-radius: 30px;
      font-weight: 600;
      transition: var(--transition);
      text-transform: none;
    }
    
    .uk-button-default:hover {
      background-color: var(--gray-100);
      color: var(--dark-color);
      border-color: var(--gray-400);
    }
    
    /* Form Elements */
    .uk-form-label {
      font-weight: 600;
      font-size: 14px;
      color: var(--dark-color);
      margin-bottom: 6px;
      display: block;
    }
    
    .uk-input, 
    .uk-select, 
    .uk-textarea {
      border-radius: 8px;
      border: 1px solid var(--gray-300);
      padding: 10px 15px;
      transition: var(--transition);
      background-color: var(--gray-100);
    }
    
    .uk-input:focus, 
    .uk-select:focus, 
    .uk-textarea:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(30, 106, 60, 0.1);
      background-color: white;
    }
    
    /* Tables */
    .uk-table {
      border-collapse: separate;
      border-spacing: 0;
      width: 100%;
    }
    
    .uk-table th {
      background-color: var(--primary-light);
      color: var(--primary-color);
      font-weight: 700;
      padding: 15px;
      font-size: 14px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      border-top: 1px solid var(--gray-200);
      border-bottom: 1px solid var(--gray-200);
    }
    
    .uk-table th:first-child {
      border-left: 1px solid var(--gray-200);
      border-top-left-radius: 8px;
    }
    
    .uk-table th:last-child {
      border-right: 1px solid var(--gray-200);
      border-top-right-radius: 8px;
    }
    
    .uk-table td {
      padding: 15px;
      border-bottom: 1px solid var(--gray-200);
      vertical-align: middle;
    }
    
    .uk-table tr:last-child td:first-child {
      border-bottom-left-radius: 8px;
      border-left: 1px solid var(--gray-200);
    }
    
    .uk-table tr:last-child td:last-child {
      border-bottom-right-radius: 8px;
      border-right: 1px solid var(--gray-200);
    }
    
    .uk-table td:first-child {
      border-left: 1px solid var(--gray-200);
    }
    
    .uk-table td:last-child {
      border-right: 1px solid var(--gray-200);
    }
    
    .uk-table-hover tbody tr:hover {
      background-color: var(--primary-light);
    }
    
    /* Status Badges */
    .status-badge {
      display: inline-block;
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    
    .status-pending {
      background-color: #FEF3C7;
      color: #92400E;
    }
    
    .status-completed {
      background-color: #D1FAE5;
      color: #065F46;
    }
    
    .status-cancel {
      background-color: #FEE2E2;
      color: #991B1B;
    }
    
    /* Notification */
    .uk-notification-message {
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      padding: 15px 20px;
    }
    
    .uk-notification-message-primary {
      background-color: var(--primary-light);
      border-left: 4px solid var(--primary-color);
    }
    
    .uk-notification-message-success {
      background-color: #D1FAE5;
      border-left: 4px solid #065F46;
    }
    
    .uk-notification-message-danger {
      background-color: #FEE2E2;
      border-left: 4px solid #991B1B;
    }
    
    /* Profile Section */
    .profile-header {
      display: flex;
      align-items: center;
      margin-bottom: 30px;
    }
    
    .profile-avatar {
      width: 100px;
      height: 100px;
      background-color: var(--primary-light);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 20px;
      box-shadow: 0 8px 16px rgba(30, 106, 60, 0.15);
      border: 5px solid white;
    }
    
    .profile-avatar i {
      font-size: 40px;
      color: var(--primary-color);
    }
    
    .profile-info h3 {
      margin: 0 0 5px 0;
      font-weight: 700;
      color: var(--dark-color);
    }
    
    .profile-info p {
      margin: 0;
      color: var(--gray-500);
      font-size: 16px;
    }
    
    /* Mobile Sidebar Toggle */
    .sidebar-toggle {
      display: none;
      position: fixed;
      bottom: 20px;
      right: 20px;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background: var(--primary-color);
      color: white;
      justify-content: center;
      align-items: center;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
      z-index: 1000;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 960px) {
      .sidebar {
        transform: translateX(-280px);
        transition: transform 0.3s ease;
      }
      
      .sidebar.active {
        transform: translateX(0);
      }
      
      .main-content-wrapper {
        margin-left: 0;
        width: 100%;
      }
      
      .sidebar-toggle {
        display: flex;
      }
      
      .page-header {
        flex-direction: column;
        align-items: flex-start;
      }
      
      .page-date {
        margin-top: 10px;
      }
    }
    
    /* Animation */
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    .fadeIn {
      animation: fadeIn 0.3s ease forwards;
    }
    
    /* Utils */
    .bg-gradient-primary {
      background: linear-gradient(120deg, var(--primary-color), var(--primary-dark));
    }
    
    .bg-gradient-secondary {
      background: linear-gradient(120deg, var(--secondary-color), #e67e22);
    }
    
    .text-primary {
      color: var(--primary-color) !important;
    }
    
    .text-secondary {
      color: var(--secondary-color) !important;
    }
    
    .text-accent {
      color: var(--accent-color) !important;
    }
    
    .text-success {
      color: var(--success-color) !important;
    }
    
    .text-danger {
      color: var(--danger-color) !important;
    }
    
    .border-primary {
      border-color: var(--primary-color) !important;
    }
    
    .progress-bar {
      height: 10px;
      background-color: var(--gray-200);
      border-radius: 5px;
      overflow: hidden;
      margin-top: 8px;
    }
    
    .progress-value {
      height: 100%;
      border-radius: 5px;
      background: linear-gradient(to right, var(--primary-color), var(--accent-color));
      transition: width 0.5s ease;
    }
  </style>
  @stack('scriptcss')
</head>
<body>
  @include('frontend.nav')

  @php
      $santri = Auth::guard('santris')->check();
  @endphp
  @if ( $santri && Request::segment(1) == 'santri' )
    <div class="dashboard-container">
      <!-- Sidebar Navigation -->
      <div class="sidebar" id="dashboard-sidebar">
        <div class="sidebar-header">
          <h4>Menu Santri</h4>
        </div>
        <ul class="sidebar-menu">
          <li class="{{ Request::is('santri/home') ? 'active' : '' }}">
            <a href="{{url('/santri/home')}}">
              <i class="fas fa-th-large"></i> Dashboard
            </a>
          </li>
          <li class="{{ Request::is('santri/profile') ? 'active' : '' }}">
            <a href="{{url('/santri/profile')}}">
              <i class="fas fa-user-circle"></i> Profil Saya
            </a>
          </li>
          <li class="{{ Request::is('santri/tagihan') ? 'active' : '' }}">
            <a href="{{url('/santri/tagihan')}}">
              <i class="fas fa-file-invoice"></i> Tagihan
            </a>
          </li>
          <li class="{{ Request::is('santri/pelunasan/tagihan') ? 'active' : '' }}">
            <a href="{{url('/santri/pelunasan/tagihan')}}">
              <i class="fas fa-credit-card"></i> Pembayaran
            </a>
          </li>
          <li>
            <a href="#change-password" uk-toggle>
              <i class="fas fa-lock"></i> Ganti Password
            </a>
          </li>
        </ul>
      
        <!-- Quick Stats -->
        <div class="sidebar-stats">
          <div class="stat-card">
            <div class="icon">
              <i class="fas fa-book-open"></i>
            </div>
            <h3>Program Tahfidz</h3>
            <p>30 Juz</p>
            <div class="progress-bar">
              <div class="progress-value" style="width: 75%;"></div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Main Content Area -->
      <div class="main-content-wrapper">
        <div class="main-content fadeIn">
          <div class="page-header">
            <h2>@yield('page-title', 'Dashboard Santri')</h2>
            <div class="page-date">
              <i class="far fa-calendar-alt"></i> {{ now()->format('l, d F Y') }}
            </div>
          </div>
          
          @yield('contentx')
        </div>
      </div>

      <!-- Mobile Sidebar Toggle -->
      <a href="#" class="sidebar-toggle" id="toggle-sidebar">
        <i class="fas fa-bars"></i>
      </a>
    </div>
  @else
    <div class="uk-width-1-1 uk-padding">
      @yield('content')
    </div>
  @endif

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

  <!-- UIkit JS -->
  <script src="{{ asset('assets/lib/jquery/jquery.js') }}"></script>
  <script src="{{ asset('uikit/js/uikit.min.js') }}"></script>
  <script src="{{ asset('uikit/js/uikit-icons.min.js') }}"></script>

  <script>
    $(document).ready(function() {
      // Password change submission
      $('#submit-change-password').click(function() {
        // Ambil data dari input
        let password = $('input[name="password"]').val();
        let password_konfirm = $('input[name="password_konfirm"]').val();
        
        // Validasi
        if(password.length < 6) {
          UIkit.notification({
            message: '<span uk-icon="icon: warning"></span> Password minimal 6 karakter',
            status: 'danger',
            pos: 'top-center'
          });
          return;
        }
        
        if(password !== password_konfirm) {
          UIkit.notification({
            message: '<span uk-icon="icon: warning"></span> Password dan konfirmasi password tidak sama',
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
                message: '<span uk-icon="icon: check"></span> ' + response.message, 
                status: 'success',
                pos: 'top-center'
              });
              UIkit.modal('#change-password').hide();
              $('input[name="password"]').val('');
              $('input[name="password_konfirm"]').val('');
            } else {
              UIkit.notification({
                message: '<span uk-icon="icon: warning"></span> ' + response.message, 
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
              message: '<span uk-icon="icon: warning"></span> ' + errorMsg, 
              status: 'danger',
              pos: 'top-center'
            });
          },
          complete: function() {
            $('#submit-change-password').prop('disabled', false).text('Simpan Perubahan');
          }
        });
      });
      
      // Mobile sidebar toggle
      $('#toggle-sidebar').click(function(e) {
        e.preventDefault();
        $('#dashboard-sidebar').toggleClass('active');
      });
      
      // Add animation to cards
      $('.stat-card, .dashboard-card').each(function(i) {
          setTimeout(function() {
            $('.stat-card, .dashboard-card').eq(i).addClass('fadeIn');
          }, i * 100);
        });
      });
    });
  </script>
  
  @stack('script')
</body>
</html>