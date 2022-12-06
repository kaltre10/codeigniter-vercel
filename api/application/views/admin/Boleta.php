<?= $header; ?>
<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">

  <?= $nav; ?>

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
            <h1 class="h3 mb-0 text-gray-800"><i class="fa fa-list-alt" aria-hidden="true"></i> Boleta Electrónica</h1>
          </div>

        <div class="col-12 col-md-11">
             <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Datos</h6>
              </div>
            </div>
            
            <div class="card-body">
            <form id="guardar" action="<?= base_url('admin/Boleta/save_token'); ?>"  method="POST" enctype="multipart/form-data">
              <div class="form-row">
                <div class="form-group col-12">
                  <label class="col-form-label">Token</label>
                  <textarea name="token" class="form-control" rows="3" placeholder="bearer [token apisperu]"><?php
                    if($boleta[0]->token){
                      echo $boleta[0]->token;
                    }
                    ?></textarea>
                </div>
              </div>
              </div>
              <div class="modal-footer">
                <input type="submit" onclick="guardar()" class="btn btn-success" value="Guardar">
            </form>
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

        function delete_caja(id){
          if (id == 1) {
            swal({
              title: "Disculpe! la caja principal no se puede eliminar",
              icon: "error",
              dangerMode: true,
            })
          }else{
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
                          location.href="Cajas/delete_caja/" + id;
                          //form.submit();
                      }
                    });
                  }
            });
          }
          
        }  
      </script>
<?= $footer; ?>
