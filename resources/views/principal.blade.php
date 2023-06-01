<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Industrias Ordoñez</title>
  <!--Protegre nuestra aplicación-->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js">

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Id for Channel Notification -->   
  <meta name="userId" content="{{ Auth::check() ? Auth::user()->id : ''}}">  
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="css/plantilla.css">
  
  <!--ICONO EN LA PESTAÑA-->
  <link rel="shortcut icon" href="img/icono-guty.ico">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<style>
  table, td, th {  
    border: 1px solid #ddd !important;
    text-align: center !important;
  }

  table {
    border-collapse: collapse !important;
    width: 100% !important;
  }
  table thead tr{
    background-color: #117a8b !important;
  }
  th, td {
    padding: 14px !important;
  }
</style>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <div id="app">
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        @if(Auth::check())
          @if (Auth::user()->idrol != 4)
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
          </ul>
          @endif
        @endif

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">

          <!-- Notifications Dropdown Menu -->
          <notification :notifications="notifications"></notification>
          <!-- Messages Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="fas fa-power-off"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <div class="dropdown-item">
                <!-- Empezar mensaje -->
                <div class="media">
                  <img src="img/avatars/8.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      Usuario: {{Auth::user()->usuario}}
                      <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm">Miembro desde 2019</p>
                    <p class="text-sm text-muted"><i class="fa fa-circle text-success mr-1"></i> En Linea</p>
                  </div>
                </div>
                <!-- Mensaje terminado -->
              </div>
              <div class="dropdown-divider"></div>
              <div>
                <a href="{{ route('logout') }}" class="dropdown-item dropdown-footer" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-power-off"></i><span> Cerrar Sesión</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                </form>
              </div>


            </div>
          </li>
            
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      @if(Auth::check())
        @if (Auth::user()->idrol == 1)
            @include('plantilla.sidebaradministrador')
        @elseif (Auth::user()->idrol == 2)
            @include('plantilla.sidebarvendedor')
        @elseif (Auth::user()->idrol == 3)
            @include('plantilla.sidebaralmacenero')
        @else

        @endif

      @endif

      <!-- Content Wrapper. Contains page content -->
      <div>
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        @yield('contenido')
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
          <b>Version</b> 3.0.0
        </div>
        <strong>Copyright &copy; 2020 <a href="·">Industrias Ordoñez S.A.C.</a>.</strong> All rights
        reserved.
      </footer>
  </div>

  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="js/app.js"></script>
<script src="js/plantilla.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7"></script>

<!--
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>-->

</body>

</html>

@if(Auth::check())
  @if (Auth::user()->idrol == 4)
    <!--<style>
      .main-header{
        margin-left: 0px !important;
      }
    </style>-->
    <script>
      $( document ).ready(function() {
        $(".content-wrapper").removeClass("content-wrapper");
        //$(".main-header").css('margin-left: 0px');
        $(".main-header").css("cssText", "margin-left: 0px !important");
        $(".main-footer").css("cssText", "margin-left: 0px !important");
      });
    </script>

  @endif

@endif
