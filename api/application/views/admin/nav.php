  <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url("admin/Admin_dashboard"); ?>">
        <div class="sidebar-brand-icon rotate-n-1">
          <i class="fas fa-hand-holding-usd"></i>
        </div>
        <div class="sidebar-brand-text mx-1"><sup>DIVISAS</sup></div>
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
            <a class="collapse-item" href="<?= base_url("admin/Reporte_general"); ?>">General</a>
            <a class="collapse-item" href="<?= base_url("admin/Reporte_detallado"); ?>">Detallado</a>
            <a class="collapse-item" href="<?= base_url("admin/Reporte_diario"); ?>">Diario</a>
            <a class="collapse-item" href="<?= base_url("admin/Utilidad"); ?>">Utilidad</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Addons
      </div>
      <?php if($this->session->userdata('rango') == 0) { ?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitie" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fa fa-cog" aria-hidden="true"></i>
          <span>Configuración</span></a>
        <div id="collapseUtilitie" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Utilities:</h6>
            <a class="collapse-item" href="<?= base_url('admin/Cajas'); ?>"><i class="fa fa-window-restore" aria-hidden="true"></i> Cajas</a>
            <a class="collapse-item" href="<?= base_url('admin/Cuentas'); ?>"><i class="fa fa-cubes" aria-hidden="true"></i> Cuentas</a>
            <a class="collapse-item" href="<?= base_url('admin/Categorias'); ?>"><i class="fa fa-tag" aria-hidden="true"></i> Categorias</a>
            <a class="collapse-item" href="<?= base_url('admin/Usuarios'); ?>"><i class="fa fa-users" aria-hidden="true"></i> Usuarios</a>
            <a class="collapse-item" href="<?= base_url('admin/Boleta'); ?>"><i class="fa fa-list-alt" aria-hidden="true"></i> Boleta Electrónica</a>
            <span style="cursor: pointer;" class="collapse-item" href="" onclick="cerrar_dia();"><i class="fas fa-calendar-check"></i> Cierre del Dia</span>
            <span style="cursor: pointer; text-decoration: line-through;" class="collapse-item" href="" onclick="anular_cierre();"><i class="fas fa-calendar-times"></i> Anular Cierre</span>
          </div>
        </div>
      </li>
      <?php } ?>
      <li class="nav-item">
        <button class="nav-link" style="background: #2d54c6;border: 0 solid;" type="button" onclick="cerrar_session()">
          <i class="fas fa-door-open"></i>
          <span>Salir</span></button>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
    <script>
    function cerrar_dia(){
          swal({
            title: "Cerrar Dia?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((aceptado) => {
                  // //VERIFICANDO LOS DATOS ENVIADOS
                  if (aceptado){     
                    swal("Procesado con Exito!", {
                      icon: "success",   
                      buttons: {
                        defeat: "ok",
                      },
                    })
                    .then((value) => {
                      switch (value) {
                        default:
                          location.href="Cierre/save_cierre";
                          //form.submit();
                      }
                    });
                  }
            });
        }  
        function anular_cierre(){
          swal({
            title: "Anular Cierre?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((aceptado) => {
                  // //VERIFICANDO LOS DATOS ENVIADOS
                  if (aceptado){     
                    swal("Procesado con Exito!", {
                      icon: "success",   
                      buttons: {
                        defeat: "ok",
                      },
                    })
                    .then((value) => {
                      switch (value) {
                        default:
                          location.href="Cierre/anular_cierre";
                          //form.submit();
                      }
                    });
                  }
            });
        }  
  </script>
