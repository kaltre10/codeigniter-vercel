<?= $header; ?>
<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

  <?= $nav; ?>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<<<<<<< HEAD
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear Nueva Salida/Entrada</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="enviar" action="<?= base_url('admin/Ent_sal/save_ent_sal'); ?>" method="POST">
          <div class="form-row">
            <div class="form-group col-6">
              <label class="col-form-label">Tipo:</label>
              <select class="form-control" name="tip_ent_sal" required>
                <option value=""> - </option>
                <option value="Salida">Salida</option>
                <option value="Entrada">Entrada</option>
              </select>
            </div>
            <div class="form-group col-6">
              <label for="recipient-name" class="col-form-label">Cantidad:</label>
              <input type="number" step="any" min="0" class="form-control" name="can_ent_sal" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-6">
              <label class="col-form-label">Moneda:</label>
                <select class="form-control select2-divisas" name="id_divisa" required>
                  <option value=""> - </option>
                  <?php foreach ($divisas as $key) : ?>
                  <option value="<?= $key->id_divisa; ?>"> <?php echo $key->cod_divisa . " - " . $key->nom_divisa; ?> </option>
                  <?php endforeach; ?>
                </select>
           
            </div>
            <div class="form-group col-6">
              <label class="col-form-label">Categoria:</label>
              <select class="form-control select2-categorias" name="id_categoria" required>
                  <option value=""> - </option>
                  <?php foreach ($categorias as $key) : ?>
                  <option value="<?= $key->id_categoria; ?>"> <?php echo $key->nom_categoria; ?> </option>
                  <?php endforeach; ?>
                </select>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-form-label">Descripción:</label>
            <textarea class="form-control" maxlength="50" name="des_ent_sal" required></textarea>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button onclick="guardar();" type="submit" class="btn btn-success">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>
=======
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Crear Nueva Salida/Entrada</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="enviar" action="<?= base_url('admin/Ent_sal/save_ent_sal'); ?>" method="POST">
						<div class="form-row">
							<div class="form-group col-6">
								<label class="col-form-label">Tipo:</label>
								<select class="form-control" name="tip_ent_sal" required>
									<option value=""> - </option>
									<option value="Salida">Salida</option>
									<option value="Entrada">Entrada</option>
								</select>
							</div>
							<div class="form-group col-6">
								<label for="recipient-name" class="col-form-label">Cantidad:</label>
								<input type="number" step="any" min="0" class="form-control" name="can_ent_sal" required>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-6">
								<label class="col-form-label">Moneda:</label>
									<select class="form-control select2-divisas" name="id_divisa" required>
										<option value=""> - </option>
										<?php foreach ($divisas as $key) : ?>
										<option value="<?= $key->id_divisa; ?>"> <?php echo $key->cod_divisa . " - " . $key->nom_divisa; ?> </option>
										<?php endforeach; ?>
									</select>
						
							</div>
							<div class="form-group col-6">
								<label class="col-form-label">Categoria:</label>
								<select class="form-control select2-categorias" name="id_categoria" required>
										<option value=""> - </option>
										<?php foreach ($categorias as $key) : ?>
										<option value="<?= $key->id_categoria; ?>"> <?php echo $key->nom_categoria; ?> </option>
										<?php endforeach; ?>
									</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-form-label">Descripción:</label>
							<textarea class="form-control" maxlength="50" name="des_ent_sal" required></textarea>
						</div>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button onclick="guardar();" type="submit" class="btn btn-success">Guardar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
>>>>>>> master

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
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-compress-arrows-alt"></i> Salidas y Entradas</h1>
          </div>
        
            <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Lista de entradas y salidas</h6>
                <form action="" method="POST">
                  <div class="form-row align-items-center">
                    <!-- <div class="col-auto">
                      <label class="sr-only">Tipo</label>
                      <select class="form-control mb-2" name="tipo">
                        <option value="">TODO</option>
                        <option value="COMPRA" <?php if($this->input->post('tipo') == "COMPRA"){ echo "selected"; }?>>COMPRA</option>
                        <option value="VENTA" <?php if($this->input->post('tipo') == "VENTA"){ echo "selected"; }?>>VENTA</option>
                      </select>
                    </div> -->
                    <div class="col-auto">
                      <label class="sr-only">Desde</label>
                      <input type="date" class="form-control mb-2" value="<?php if($this->input->post('desde')){ echo $this->input->post('desde'); }else{ echo date("Y-m-d"); } ?>" name="desde">
                    </div>
                    <div class="col-auto">
                      <label class="sr-only">Hasta</label>
                      <div class="input-group mb-2">
                        <input type="date" class="form-control" value="<?php if($this->input->post('hasta')){ echo $this->input->post('hasta'); }else{ echo date("Y-m-d"); } ?>" name="hasta">
                      </div>
                    </div>
                    <div class="col-auto">
                      <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </div>
                  </div>
                </form>      
                <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#exampleModal">
                <span class="icon text-white-50">
                  <i class="fa fa-plus" aria-hidden="true"></i>
                </span>
                <span class="text">Salidas/Entradas</span>
                </a>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
<<<<<<< HEAD
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
=======
                <table id="table_sal_ent" class="table table-bordered text-center display" width="100%" cellspacing="0">
>>>>>>> master
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Fecha</th>
                      <th>Usuario</th>
                      <th>Tipo</th>
                      <th>Cantidad</th>
                      <th>Moneda</th>
                      <th>Categoria</th>
                      <th>Descripcion</th>
<<<<<<< HEAD
=======
											<th></th>
>>>>>>> master
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($ent_sal as $key) : ?>
                    <tr  <?php echo ($key->sta_ent_sal == 0) ? "class='text-danger font-weight-lighter'" : ""; ?>>
                      <td><?= $key->id_ent_sal; ?></td>
                      <td><?= $key->fec_ent_sal; ?></td>
                      <td><?= $key->nom_usuario; ?></td>
                      <td><?= $key->tip_ent_sal; ?></td>
                      <td><?= number_format($key->can_ent_sal, 2); ?></td>
                      <td><img style="width: 30px; height: 15px;" src="<?= base_url('assets/img/' . $key->cod_divisa .'.png'); ?>"> <?= $key->cod_divisa; ?></td>
                      <td><?= $key->nom_categoria; ?></td>
                      <td><?= $key->des_ent_sal; ?></td>
                      <td><button class="btn btn-danger" type="button" onclick="anular('<?= $key->id_ent_sal; ?>');" <?php echo ($key->sta_ent_sal == 0) ? "disabled" : ""; ?>><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                    </tr>
                  <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->
<<<<<<< HEAD
      <script>
=======
			
      <script>
				
>>>>>>> master
        function guardar(){
          $("#enviar").on('submit', function(evt){
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

         function anular(id){
                swal({
                  title: "Seguro desea Anular?",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                .then((aceptado) => {
                  //VERIFICANDO LOS DATOS ENVIADOS
                  if (aceptado){     
                   swal("Anulado con exito!", {
                      icon: "success",   
                      buttons: {
                        defeat: "ok",
                      }, 
                    })
                    .then((value) => {
                      switch (value) {
                        default:
                        location.href="Ent_sal/anular_ent_sal/" + id;
                        //form.submit();
                      }

                    });
                  }
            });

        }
<<<<<<< HEAD
      </script>
<?= $footer; ?>
=======

			

      </script>
<?= $footer; ?>
>>>>>>> master
