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
            <h1 class="h3 mb-0 text-gray-800"><i class="far fa-file-alt"></i> Utilidad</h1>
          </div>
        
            <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <div class="d-flex justify-content-between">
                <form action="" method="POST">
                  <div class="form-row align-items-center">
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
              </div>
            </div>
            
            <div class="card-body">    

            <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Ganancias</div>
                      <!-- <div class="h5 mb-0 font-weight-bold text-gray-800"><span class="text-success">S/. <?= str_pad(round($ganancia, 4) , 4); ?></span></div> -->
											<div class="h5 mb-0 font-weight-bold text-gray-800"><span class="text-success" id="gananciaTotal"></span></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-money-bill-wave fa-2x  text-gray-300" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Gastos</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><span class="text-danger">S/. -<span id="gastos"><?= $gastos; ?></span></span></div>
                        </div> 
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>  

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total</div>
                      <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">S/.<span class="<?php if(($ganancia - $gastos) > 0) { echo "text-success";}else{ echo "text-danger";} ?>"><?= $ganancia - $gastos; ?></span></div> -->
											<div class="h5 mb-0 font-weight-bold text-gray-800">S/.<span id="total" class="<?php if(($ganancia - $gastos) > 0) { echo "text-success";}else{ echo "text-danger";} ?>"></span></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            </div> 

						<p>Registro Diario por dia:</p>
						<div class="table-responsive">
                <table class="table table-sm text-center table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Fecha</th>
                      <th>Ganancia</th>
                      <th>Gasto</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>

						<!-- eliminar ultimo elemento del array -->
						<?php //unset($dataDays[count($dataDays) - 1]); ?>
				
						<?php foreach($dataDays as $key) : ?>
							
						<?php if($key['ganancia'] == 0 && $key['gasto'] == 0){
							continue;
						}?>
              
                    <tr>
											<th><?= date("Y-m-d",strtotime($key['fecha'])); ?></th>
											<th class="gananciaItems"><?= $key['ganancia']; ?></th>
											<th><?= $key['gasto']; ?></th>
											<th><?=  $key['ganancia'] - $key['gasto']; ?></th>
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
			<script>
				let gananciaTotal = document.getElementById('gananciaTotal');
				let gananciaItems = document.querySelectorAll('.gananciaItems');
				let gastos = document.getElementById('gastos').textContent;
				let total = document.getElementById('total');
				let valueGananciaTotal = Object.values(gananciaItems)
												.map( e => e.textContent )
												.reduce((act, acum) => Number(act) + Number(acum), 0);
				gananciaTotal.textContent = `S/. ${(valueGananciaTotal).toFixed(2)}`;
				total.textContent = (Number(valueGananciaTotal) - Number(gastos)).toFixed(2);
			</script>
      <script src="<?= base_url("assets/js/numeroAletras.js"); ?>"></script>
      <script src="<?= base_url("assets/js/boleta-electronica.js"); ?>"></script>
<?= $footer; ?>
