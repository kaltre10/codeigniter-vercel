<?= $header; ?>
<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">

  <?= $nav; ?>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="guardar" action="<?= base_url('admin/Usuarios/save_usuario'); ?>"  method="POST">
          <div class="form-row">
            <div class="form-group col-12 col-md-6">
              <label class="col-form-label">Nombre de Usuario:</label>
              <input type="text" pattern="[A-Za-z0-9 ]+" maxlength="50" class="form-control" name="nom_usuario" autocomplete="off" required>
            </div>
            <div class="form-group col-12 col-md-6">
              <label class="col-form-label">Clave de Usuario:</label>
              <input type="text" maxlength="50" class="form-control" name="pas_usuario" autocomplete="off" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-12 col-md-6">
              <label class="col-form-label">Caja:</label>
              <select class="form-control" name="id_caja" required>
                <option value=""> - </option>
                <?php foreach ($cajas as $key) : ?>
                <option value="<?= $key->id_caja; ?>"><?= $key->nom_caja; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group col-12 col-md-6">
              <label class="col-form-label">Rol:</label>
              <select class="form-control" name="niv_usuario" required>
                <option value="0">Administrador</option>
                <option value="1" selected>Operador</option>
              </select>
            </div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <input type="submit" onclick="guardar()" class="btn btn-success" value="Guardar">
        </form>
      </div>
    </div>
  </div>
</div>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Nav Item - Alerts -->
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->session->nombre_usuario; ?></span>
              </a>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><i class="fa fa-users" aria-hidden="true"></i> Usuarios</h1>
          </div>

        <div class="col-12 col-md-8">
             <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Usuarios disponibles</h6>
                <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#exampleModal">
                <span class="icon text-white-50">
                  <i class="fa fa-plus" aria-hidden="true"></i>
                </span>
                <span class="text">Nuevo Usuario</span>
                </a>
              </div>
            </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered text-center" id="" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#Id</th>
                      <th>Nombre</th>
                      <th>Clave</th>
                      <th>Rol</th>
                      <th>Caja</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($usuarios as $key) : ?>
                    <form id="edit_div" action="<?= base_url("admin/Usuarios/editar_usuario"); ?>" method="POST">
                    <tr>
                      <td><?= $key->id_usuario; ?></td>
                      <td><?= $key->nom_usuario; ?></td>
                      <td><?= $key->pas_usuario; ?></td>
                      <td><?php echo ($key->niv_usuario == 0) ? "Administrador" : "Operador"; ?>
                      </td>
                      <td><?= $key->nom_caja; ?></td>
                      <td>
                          <button onclick="delete_usuario('<?= $key->id_usuario; ?>')" type="button" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></button>
                      </td>
                    </tr>
                    </form>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
         
        </div>

       
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->
      <script>
        function guardar(){
          $("#guardar").on('submit', function(evt){
            evt.preventDefault(); 
            let form = evt.target; 
                swal({
                  title: "Seguro desea Registrar?",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                .then((aceptado) => {
                  //VERIFICANDO LOS DATOS ENVIADOS
                  if (aceptado){     
                   swal("Realizado con exito!", {
                      icon: "success",   
                      buttons: {
                        defeat: "ok",
                      }, 
                    })
                    .then((value) => {
                      switch (value) {
                        default:
                          form.submit();
                      }

                    });
                  }
            });
          });
        }

        function delete_usuario(id){
          swal({
            title: "Seguro desea Eliminar?",
            icon: "error",
            buttons: true,
            dangerMode: true,
          })
          .then((aceptado) => {
                  // //VERIFICANDO LOS DATOS ENVIADOS
                  if (aceptado){     
                    swal("Eliminado con exito!", {
                      icon: "success",   
                      buttons: {
                        defeat: "ok",
                      },
                    })
                    .then((value) => {
                      switch (value) {
                        default:
                          location.href="Usuarios/delete_usuario/" + id;
                          //form.submit();
                      }
                    });
                  }
            });
        }  
      </script>
<?= $footer; ?>