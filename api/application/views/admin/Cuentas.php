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
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus" aria-hidden="true"></i> Crear Nueva Cuenta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="guardar" action="<?= base_url('admin/Cuentas/save_cuenta'); ?>"  method="POST" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group col-12 col-md-6">
              <label class="col-form-label">Nombre de cuenta (solo letras o números):</label>
              <input type="text" pattern="[A-Za-z0-9 ]+" maxlength="50" class="form-control" name="nom_cuenta" autocomplete="off" required>
            </div>
            <div class="form-group col-12 col-md-6">
              <label class="col-form-label">Descripción (solo letras o números)</label>
              <input type="text" pattern="[A-Za-z0-9 ]+" maxlength="100" class="form-control" name="des_cuenta" autocomplete="off" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-12 col-md-6">
              <label class="col-form-label">Moneda:</label>
              <select class="form-control select2-divisas" name="id_divisa" required>
                <option value=""> - </option>
              <?php foreach ($divisas as $key) : ?>
                <option value="<?= $key->id_divisa; ?>" <?php echo ($key->id_divisa == 10) ? "selected" : ""; ?> > <?= $key->cod_divisa; ?> - <?= $key->nom_divisa; ?></option>
              <?php endforeach; ?>
            </select>
            </div>
            <div class="form-group col-12 col-md-6">
              <label class="col-form-label">Caja:</label>
              <select class="form-control" name="id_caja" required>
                <?php foreach ($cajas as $key) : ?>
                <option value="<?= $key->id_caja; ?>" <?php echo ($key->id_caja == 1) ? "selected" : ""; ?> > <?= $key->nom_caja; ?></option>
              <?php endforeach; ?>
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
            <h1 class="h3 mb-0 text-gray-800"><i class="fa fa-cubes" aria-hidden="true"></i></i> Cuentas</h1>
          </div>

        <div class="col-12 col-md-11">
             <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Lista de Cuentas</h6>
                <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#exampleModal">
                <span class="icon text-white-50">
                  <i class="fa fa-plus" aria-hidden="true"></i>
                </span>
                <span class="text">Nueva Cuenta</span>
                </a>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered text-center" id="" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nombre</th>
                      <th>Descripción</th>
                      <th>Moneda</th>
                      <th>Saldo</th>
                      <th>Caja</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($cuentas as $key) : ?>
                    <form id="edit_cuenta" action="<?= base_url("admin/Cuentas/editar_cuentas"); ?>" method="POST">
                    <tr>
                      <td><?= $key->id_cuenta; ?></td>
                      <td><?= $key->nom_cuenta; ?></td>
                      <td><?= $key->des_cuenta; ?></td>
                      <td> <img  src="<?= base_url('assets/img/' . "$key->cod_divisa" . '.png'); ?>"> <?= $key->cod_divisa; ?></td>
                      <td class="w-25">
                        <div class="form-group mx-auto">
                          <input class="form-control" step="0.01" id="cantidad" type="number" value="<?= $key->sal_cuenta; ?>" autocomplete="off">
                        </div>
                        </td>
                      <td><?= $key->nom_caja; ?></td>
                      <td>
                        <div class="d-flex justify-content-around">
                          <script>
                            let cantidad = document.getElementById('cantidad');

                          </script>
                          <button onclick="update_cuenta('<?= $key->id_cuenta; ?>', cantidad.value);" type="button" class="btn btn-primary btn-circle btn-sm"><i class="far fa-edit" aria-hidden="true"></i></button>
                          
                          <button onclick="delete_cuenta('<?= $key->id_cuenta; ?>')" type="button" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></button>
                        </div>
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

        function delete_cuenta(id){
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
                          location.href="Cuentas/delete_cuenta/" + id;
                          //form.submit();
                      }
                    });
                  }
            });
          
        }  

        function update_cuenta(id, cantidad){
            cantidad = parseFloat(cantidad);
            swal({
            title: "Actualizar los datos?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((aceptado) => {
                  // //VERIFICANDO LOS DATOS ENVIADOS
                  if (aceptado){     
                    swal("Actualizado con exito!", {
                      icon: "success",   
                      buttons: {
                        defeat: "ok",
                      }, 
                    })
                    .then((value) => {
                      switch (value) {
                        default:
                          location.href="Cuentas/update_cuenta/" + id + "/" + cantidad;
                          //form.submit();
                      }
                    });
                  }
            });
          
        }  
      </script>
<?= $footer; ?>