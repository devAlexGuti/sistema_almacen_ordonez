<!-- código referente todo el vendedor, parte izquierda-->
    <!-- Con este código el menú sale oscuro -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- código referente al logo -->
  <a href="#" class="brand-link">
    <img src="img/logo-guty.jpeg"
        alt="AdminLTE Logo"
        class="brand-image img-circle elevation-3"
        style="opacity: .8">
    <span class="brand-text font-weight-light">SISTEMA ORDOÑEZ</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="img/avatars/8.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Usuario: {{Auth::user()->usuario}}</a>
        <a href="#" style="font-size: 11px !important;"><i class="fa fa-circle text-success"></i> En Linea</a>
      </div>
    </div>

   <!-- código del Menu Sidebar que abarca de dashboard hasta post test -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <li @click="menu=0" class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              Gestiones
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right">3</span>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li @click="menu=5" class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Ventas</p>
              </a>
            </li>

            <li @click="menu=6" class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Clientes</p>
              </a>
            </li>
            <li @click="menu=17" class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Despacho</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-database"></i>
            <p>
              Reportes
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

            <!--  código para reporte de ventas-->
            <li @click="menu=16" class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Reporte Ventas</p>
              </a>
            </li>
            <!--  código para reporte de pedidos-->
            <li @click="menu=10" class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Reporte Pedidos</p>
              </a>
            </li>
          </ul>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>