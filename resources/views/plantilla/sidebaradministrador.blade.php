<!-- código referente todo al administrador, parte izquierda-->
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
            <i class="nav-icon fas fa-building"></i>
            <p>
              Almacén
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right">2</span>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li @click="menu=1" class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Categorías</p>
              </a>
            </li>
            <li @click="menu=2" class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Productos</p>
              </a>
            </li>
          </ul>
        </li>
        <!--
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-shopping-bag"></i>
            <p>
              Compras
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li @click="menu=3" class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Compras</p>
              </a>
            </li>
            <li @click="menu=4" class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Proveedores</p>
              </a>
            </li>

          </ul>
        </li>-->

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              Gestiones
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right">4</span>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li @click="menu=5" class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Ventas</p>
              </a>
            </li>
            <li @click="menu=15" class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pedidos</p>
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
            <i class="nav-icon fas fa-unlock-alt"></i>
            <p>
              Acceso
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li @click="menu=7" class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Usuario</p>
              </a>
            </li>
            <li @click="menu=8" class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Roles</p>
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
            <!--
            <li @click="menu=9" class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Reporte Compras</p>
              </a>
            </li>-->
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
        <li class="nav-header">INDICADORES</li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>
              Pre Test
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right">2</span>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li @click="menu=13" class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Indicador 1</p>
              </a>
            </li>
            <li @click="menu=14" class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Indicador 2</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>
              Pos Test
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right">2</span>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li @click="menu=11" class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Indicador 1</p>
              </a>
            </li>
            <li @click="menu=12" class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Indicador 2</p>
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