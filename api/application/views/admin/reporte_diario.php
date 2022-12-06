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
            <h1 class="h3 mb-0 text-gray-800"><i class="far fa-file-alt"></i> Reporte Diario</h1>
          </div>
        
            <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"></h6>
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
							<p>Total del <?php if($this->input->post('desde')){ echo $this->input->post('desde'); }else{ echo date("Y-m-d"); } ?> hasta <?php if($this->input->post('hasta')){ echo $this->input->post('hasta'); }else{ echo date("Y-m-d"); } ?></p>
              <div class="table-responsive">
                <table class="table table-sm table-hover" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Codigo</th>
                      <th>Tipo</th>
                      <th>Compras</th>
                      <th>Valor (PEN)</th>
                      <th>Promedio</th>
                      <th>Ventas</th>
                      <th>Valor (PEN)</th>
                      <th>Promedio</th>
                    </tr>
                  </thead>
                  <tbody>  
              <?php $suma_gastos_compra = 0; 
                    $total_gastos_compra = 0;
                    $suma_gastos_venta = 0;
                    $total_gastos_venta = 0;
              ?>     
              <?php foreach ($divisas as $key) : ?>
                <?php if ( $key['compras'] == 0 && $key['ventas'] == 0 ){
                  continue;
                } 
						
								?>
                    <tr>
                      <td><img style="width: 30px; height: 15px;" src="<?= base_url('assets/img/' . $key['codigo'] .'.png'); ?>"> <?= $key['codigo']; ?> </td>
                      <td><?= $key['nombre']; ?></td>
                      <td><?= str_pad($key['compras'], 4); ?></td>
                      <td><?= str_pad($key['gastos_compra'], 4); ?></td>
                      <?php $suma_gastos_compra = $suma_gastos_compra + $key['gastos_compra']; ?>
                      <td><?php  if($key['gastos_compra']){
                        echo str_pad(round($key['gastos_compra'] / $key['compras'] , 6), 6);
                      }  ?></td>
                      <td><?= str_pad($key['ventas'], 4); ?></td>
                      <td><?= str_pad($key['gastos_venta'], 4); ?></td>
                      <?php $suma_gastos_venta = $suma_gastos_venta + $key['gastos_venta']; ?>
                      <td><?php if ($key['gastos_venta']) {
                        echo str_pad(round($key['gastos_venta'] / $key['ventas'], 6), 6);
                      } ?></td>
                    </tr>
              <?php endforeach; ?>
                    <tr>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th class="font-weight-bold"><?= str_pad(round($suma_gastos_compra, 4), 4); ?></th>
                      <th></th>
                      <th></th>
                      <th class="font-weight-bold"><?= str_pad(round($suma_gastos_venta, 4), 4); ?></th>
                      <th></th>
                    </tr>
                  </tbody>
                </table>
              </div>  
              
							<!-- table resumen por dia -->

							<!-- eliminar ultimo elemento del array -->
							<?php unset($arrayFechas[count($arrayFechas) - 1]); ?>
							

							<?php 
								$i = 0;
								$repeatDate = array();
							?>

							<?php foreach ($arrayFechas as $f) : ?>
							<?php

								if(count($repeatDate) > 0 && $repeatDate[$i - 1] == $f){
									continue;
								}
								
								array_push($repeatDate, $f);
								$i++;
								
							?>
							<?php if(count($arrayFechas) == 1){ continue;} ?>
								<p><?php echo $f ?></p>

								<table class="table table-sm table-hover" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Codigo</th>
                      <th>Tipo</th>
                      <th>Compras</th>
                      <th>Valor (PEN)</th>
                      <th>Promedio</th>
                      <th>Ventas</th>
                      <th>Valor (PEN)</th>
                      <th>Promedio</th>
                    </tr>
                  </thead>
                  <tbody>
										<!-- eliminar ultimo elemento del array -->

										<?php foreach ($arrayDays as $key) : ?>
											<?php if($key['fecha'] != $f){
												continue;
											} ?>
											
									
											<tr>
												<td><img style="width: 30px; height: 15px;" src="<?= base_url('assets/img/' . $key['codigo'] .'.png'); ?>"> <?= $key['codigo']; ?> </td>
												<td><?= $key['nombre']; ?></td>
												<td><?= str_pad($key['compras'], 4); ?></td>
												<td><?= str_pad($key['gastos_compra'], 4); ?></td>
												<td><?php  if($key['gastos_compra']){
													echo str_pad(round($key['gastos_compra'] / $key['compras'] , 4), 4);
												}  ?></td>
												<td><?= str_pad($key['ventas'], 4); ?></td>
												<td><?= str_pad($key['gastos_venta'], 4); ?></td>
												<td><?php if ($key['gastos_venta']) {
													echo str_pad(round($key['gastos_venta'] / $key['ventas'], 4), 4);
												} ?></td>
                    	</tr>
										<?php endforeach; ?>
									</tbody>
								</table>   


							<?php endforeach; ?>
							<!-- <?php foreach ($arrayDays as $key) : ?>

								
							<div>
							<table class="table table-sm table-hover" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Codigo</th>
                      <th>Tipo</th>
                      <th>Compras</th>
                      <th>Valor (PEN)</th>
                      <th>Promedio</th>
                      <th>Ventas</th>
                      <th>Valor (PEN)</th>
                      <th>Promedio</th>
                    </tr>
                  </thead>
                  <tbody>     
             
               
                    <tr>
                      <td><img style="width: 30px; height: 15px;" src="<?= base_url('assets/img/' . $key['codigo'] .'.png'); ?>"> <?= $key['codigo']; ?> </td>
                      <td><?= $key['nombre']; ?></td>
                      <td><?= str_pad($key['compras'], 4); ?></td>
                      <td><?= str_pad($key['gastos_compra'], 4); ?></td>
                      <td><?php  if($key['gastos_compra']){
                        echo str_pad(round($key['gastos_compra'] / $key['compras'] , 4), 4);
                      }  ?></td>
                      <td><?= str_pad($key['ventas'], 4); ?></td>
                      <td><?= str_pad($key['gastos_venta'], 4); ?></td>
                      <td><?php if ($key['gastos_venta']) {
                        echo str_pad(round($key['gastos_venta'] / $key['ventas'], 4), 4);
                      } ?></td>
                    </tr>
              
									</tbody>
                </table>
							</div>
							<?php endforeach; ?> -->
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->
<?= $footer; ?>
