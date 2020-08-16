<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CNS - CAJA NACIONAL DE SALUD</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('css/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('css/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('css/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('css/summernote-bs4.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  {{-- Libreria que nos permite realizar Notiticaciones --}}
  <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.css') }}">
  <!-- CSC propio de la pagina -->
  <link rel="stylesheet" href="{{ asset('css/page.css') }}">
  {{-- Tipo de Letra --}}
  <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap-duallistbox.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              Christian René Cárdenas Sánchez <span class="caret"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Cerrar Sesion
              </a>
              <form id="logout-form" action="#" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          </li>
        </ul>    
      </nav>
      <!-- /.navbar -->
      
      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ url('home') }}" class="brand-link">
          <img src="{{ asset('images/LogoLight.png') }}" alt="Empresa" class="brand-image img-circle elevation-3">
          <span class="brand-text font-weight-light">Caja Nacional de Salud</span>
        </a>
        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
              
                <li class="nav-header"><strong>MENU PRINCIPAL</strong></li>
                <li class="nav-item">
                  <a href="{{ url('nuevo') }}" class="nav-link">
                    <i class="fas fa-plus"></i> <p>Nuevo Form.</p>
                  </a>
                </li>              
              
                <li class="nav-item">
                  <a href="{{ url('buscar') }}" class="nav-link">
                    <i class="fas fa-search"></i> <p>Buscar Form.</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ url('buscar') }}" class="nav-link">
                    <i class="far fa-file-alt"></i> <p>Reporte</p>
                  </a>
                </li>

            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>
      
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            @yield('content')
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
  <!-- ./wrapper -->
<!-- jQuery -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('js/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('js/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('js/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('js/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('js/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--  <script src="{{ asset('js/dashboard.js') }}"></script>  --}}
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('js/demo.js') }}"></script>
{{--  Libreria que nos permite realizar Notiticaciones  --}}
<script src="{{ asset('js/toastr.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.js') }}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{ asset('js/jquery.bootstrap-duallistbox.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('js/select2.full.min.js') }}"></script>

@toastr_render
<script>
  $(document).ready(function(){
    @yield('extra')
  });
</script>
</body>
</html>
