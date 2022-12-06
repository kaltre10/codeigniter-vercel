  <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url("admin/Admin_dashboard"); ?>">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">EWFOREX <sup>DIVISAS</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="<?= base_url("admin/Admin_dashboard"); ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url("admin/Divisas"); ?>">
          <i class="fas fa-coins"></i>
          <span>Divisas</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url("admin/Operaciones"); ?>">
          <i class="fas fa-exchange-alt"></i>
          <span>Operaciones</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url("admin/Clientes"); ?>">
          <i class="fas fa-users"></i>
          <span>Clientes</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url("admin/ent_sal"); ?>">
          <i class="fas fa-compress-arrows-alt"></i>
          <span>Salidas/Entradas</span></a>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="far fa-file-alt"></i>
          <span>Reportes</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Utilities:</h6>
            <a class="collapse-item" href="">General</a>
            <a class="collapse-item" href="">Detallado</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Addons
      </div>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url("Login/logout"); ?>">
          <i class="fas fa-door-open"></i>
          <span>Salir</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->