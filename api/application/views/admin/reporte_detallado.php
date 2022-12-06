<?= $header; ?>
<body id="page-top">
<div id="print"></div>

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
            <h1 class="h3 mb-0 text-gray-800"><i class="far fa-file-alt"></i> Reporte Detallado</h1>
          </div>
        
            <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Lista de Operaciones</h6>
                <form action="" method="POST">
                  <div class="form-row align-items-center">
                     <div class="col">
												<p>Utilidad: <span id="utilidad"></span></p>
                        <a href="Excel?desde=<?= $this->input->post('desde') ?>&hasta=<?= $this->input->post('hasta') ?>&tipo=<?= $this->input->post('tipo') ?>&mayor=<?= $this->input->post('mayor') ?>&menor=<?= $this->input->post('menor') ?>">Excel</a>
                    </div>
                    <div class="col">
                      <label class="sr-only">Mayor a</label>
                      <input type="number" class="form-control mb-2" value="<?php if($this->input->post('mayor')){ echo $this->input->post('mayor'); }?>" name="mayor" placeholder="Mayor a">
                    </div>
                    <div class="col">
                      <label class="sr-only">Menos a</label>
                      <div class="input-group mb-2">
                        <input type="number" class="form-control" value="<?php if($this->input->post('menor')){ echo $this->input->post('menor'); }?>" name="menor" placeholder="Menor a">
                      </div>
                    </div>
                    <div class="col-auto">
                      <label class="sr-only">Tipo</label>
                      <select class="form-control mb-2" name="tipo">
                        <option value="">TODO</option>
                        <option value="COMPRA" <?php if($this->input->post('tipo') == "COMPRA"){ echo "selected"; }?>>COMPRA</option>
                        <option value="VENTA" <?php if($this->input->post('tipo') == "VENTA"){ echo "selected"; }?>>VENTA</option>
                      </select>
                    </div>
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
              <?php foreach ($operaciones as $key) : ?>
              <div class="table-responsive">
                <table class="table table-sm text-center table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tipo</th>
                      <th>Cantidad</th>
                      <th>Fecha</th>
                      <th>Cotizacion</th>
                      <th>Recibe</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr <?php echo ($key->status == 0) ? "class='text-danger font-weight-lighter' style='style=opacity: 0.8;'" : ""; ?>>
                      <td><?= $key->tip_operacion; ?></td>
                      <td><img style="width: 30px; height: 15px;" src="<?= base_url('assets/img/' . $key->div_operacion .'.png'); ?>"> <?= str_pad($key->mon_operacion, 4) . " " . $key->div_operacion; ?></td>
                      <td><?= $key->fec_operacion; ?></td>
                      <td><?= $key->cot_operacion; ?></td>
                      <td><img style="width: 30px; height: 15px;" src="<?= base_url('assets/img/' . $key->mon_rec_operacion .'.png'); ?>"> <?= str_pad($key->rec_operacion, 4) . " " . $key->mon_rec_operacion; ?></td>
                      <td rowspan="2" style="
    vertical-align: inherit;
"><button class="btn btn-warning" type="button" onclick="anular(
																													'<?= $key->id_operacion; ?>',
																													'<?= $key->correlative_sunat; ?>',
																													'<?= $key->fec_operacion; ?>',
																													'<?= $key->mon_rec_operacion; ?>',
																													'<?= str_pad($key->mon_operacion, 4); ?>',
																													'<?= $key->doc_cliente; ?>',
																													'<?= $key->n_cliente; ?>',
																													'<?= $key->tip_operacion; ?>',
																													'<?= $key->utilidad_emitida; ?>',
																													'<?= $key->rec_operacion; ?>',
																													);" <?php echo ($key->status == 0) ? "disabled" : ""; ?> title="Anular"><i class="fa fa-exclamation" aria-hidden="true"></i></button></td>

                      <?php if($key->report == 0 && $key->status == 1){ ?>
                        <td rowspan="2" style="vertical-align: inherit; cursor: pointer"><button class="btn" style="color: tomato;" type="button"
                 
                        onclick="report('<?= $key->id_operacion; ?>');" title="No reportado a sunat, Reportar Ahora"><i class="fa fa-exclamation-triangle fa-2x"></i></button></td>

                      <?php }elseif($key->report == 1 && $key->status == 1){ ?>
                        <td rowspan="2" style="vertical-align: inherit; color: #27ae60; cursor: pointer" onclick="pdf('<?= $key->id_operacion; ?>');" title="Descargar PDF"><i class="fa fa-file fa-2x" aria-hidden="true"></i></td>

                        <td rowspan="2" style="vertical-align: inherit; color: #27ae60; cursor: pointer;" title="Reportado Correctamente (click para reimprimir)" onclick="reImprimir(event);"><i class="fa fa-check-square fa-2x" aria-hidden="true"></i></td>
                        <?php } ?>

                    </tr>
										
                    <tr <?php echo ($key->status == 0) ? "class='text-danger font-weight-lighter'" : ""; ?>>
											<td colspan="1">N° Operacion: #<?= $key->id_operacion; ?></td>
                      <td colspan="1">Correlativo: <?= $key->correlative_sunat; ?></td>
                      <td colspan="1">Usuario: <?= $key->nom_usuario; ?></td>
											<td colspan="1">Utilidad: <?= $key->utilidad_emitida; ?></td>
                      <td colspan="1">Cliente: <?= $key->nom_cliente; ?><br>
                        <?php if ($key->nom_cliente != "REGULAR"): ?>
                        <?= "<b>" . $key->doc_cliente . "</b>: $key->n_cliente"; ?>
                        <?php endif;?>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div><hr>
              <?php endforeach; ?>
                  
              
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->
      <script>

				function getGanancia(){
					const data = JSON.parse('<?php echo json_encode($operaciones); ?>');
					const suma = data.filter( d => (d.status == 1)).map( d => d.utilidad_emitida)
													 .reduce((acum, act) => Number(acum) + Number(act), 0 )
					const $utilidad = document.getElementById('utilidad');
					$utilidad.textContent = suma.toFixed(2);
				}

				getGanancia();

         function report(id){
            fetch('Operaciones/check_operacion_id', {
              method: 'POST',
              headers: {
              'Content-Type': 'application/json',
              },
              body: JSON.stringify(Number(id))
            })
            .then(res => res.json())
            .then(res => {
              swal({
                  title: "Repotar Ahora?",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
              })
              .then((aceptado) => {
                    //VERIFICANDO LOS DATOS ENVIADOS
                    if (aceptado){     
                      swal("Guardando y Reportando...!", {
                        icon: "info",   
                        buttons: false, 
                      })
                      
                      let data = formatJSON(res);
											//obtener cotizacion actial de la divisa
											let cotizaciones = JSON.parse('<?php echo json_encode($cotizaciones); ?>');
											//calcular promedio
											let promedio = cotizaciones.filter( m => m.codigo == data.moneda)[0].cotizacion;
											data.promedio = promedio;
                      data.correlativo = res.correlative_sunat; //add correlativo
                     
                      getToken(res)
                          .then(respuesta => {
														
                            if(respuesta.sunatResponse.success){

                              //actualizar report de la operacion
                              fetch('Operaciones/update_operacion', {
                                  method: 'POST',
                                  headers: {
                                  'Content-Type': 'application/json',
                                  },
                                body: JSON.stringify(Number(data.id_operacion))
                              })

                              swal("Reportado correctamente a la Sunat!", {
                                icon: "success",   
                                buttons: {
                                  defeat: "ok",
                                }, 
                              })
                              .then((value) => {
                                switch (value) {
                                  default:
                                  location.reload()
                                  //form.submit();
                                }
                              });

                            }else{
                              swal({
                                title: "Ha ocurrido un problema con sunat!",
                                text: "Verifique su conexion a internet o intente más tarde!",
                                icon: "warning",   
                                buttons: {
                                  defeat: "ok",
                                }, 
                              })
                            }
                          })
                          .catch(err =>{
                            swal({
                                title: "Ha ocurrido un problema con sunat!",
                                text: "Verifique su conexion a internet o intente más tarde!",
                                icon: "warning",   
                                buttons: {
                                  defeat: "ok",
                                }, 
                              })
                          })
                    }
                  });

            })
         }

				 function anular(id, correlativo, fecha, moneda, monto, docCliente, numCliente, tipo, utilidad, total){
    
                swal({
                  title: "Seguro desea Anular?",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                .then((aceptado) => {
									
                  //VERIFICANDO LOS DATOS ENVIADOS
                  if (aceptado){

										//reportamos anulacion a sunat solo ventas
										// if(tipo == "VENTA"){
											
											swal("Reportando Baja de Boleta...!", {
                          icon: "info",   
                          buttons: false, 
                        })
										sendBaja(correlativo, fecha, moneda, monto, docCliente, numCliente, utilidad, tipo, total)
                      .then(res => res.json())   
                      .then(res => {
                        //  console.log(res);
												// return;
                        if(res.sunatResponse.success){
                          
                           swal("Anulado con exito!", {
                              icon: "success",   
                              buttons: {
                                defeat: "ok",
                              }, 
                            })
                            .then((value) => {
                              switch (value) {
                                default:
                                location.href="Reporte_detallado/anular/" + id;
                                //form.submit();
                              }

                            });
                        }
                      }) 
                      .catch(err => {
                        swal({
                            title: "Error al reportar Baja!",
                            text: "se ha producido un error al reportar la baja de la boleta por favor verifique su internet o intente más tarde...!",
                            icon: "warning",   
                            buttons: {
                              defeat: "ok",
                            }, 
                          })
                      })  
											
										}
										// else{
											
										// 	swal("Anulado con exito!", {
										// 		icon: "success",   
										// 		buttons: {
										// 			defeat: "ok",
										// 		}, 
										// 	})
										// 	.then((value) => {
										// 		switch (value) {
										// 			default:
										// 			location.href="Reporte_detallado/anular/" + id;
										// 			//form.submit();
										// 		}
										// 	});
										// }
                  
                  // }
            });
        }

        function formatJSON(data){
          //ajustamos los datos para el JSON antes
          // de enviarlo y reportar a sunat
          data.clienteID = data.cli_operacion;
          data.cotizacion = data.cot_operacion;
          data.moneda = data.div_operacion;
          data.moneda_recibe = data.mon_rec_operacion;
          data.monto = data.mon_operacion;
          data.recibe = data.rec_operacion;
          return data;
        }

        function pdf(id) {
          swal({
                  title: "Descargar PDF?",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
              })
              .then( async (aceptado) => {
                if(aceptado){
                  const query = await fetch('Operaciones/check_operacion_id', {
                                            method: 'POST',
                                            headers: {
                                            'Content-Type': 'application/json',
                                            },
                                            body: JSON.stringify(Number(id))
                                          })
                  const operation = await query.json();
                  const queryPDF = await configJsonPdf(operation);
                  const pdfResponse = await queryPDF.blob();
                  createPDF(pdfResponse);
                }
              })
        }

        const createPDF = (dataAPi) => {
          let objectURL = URL.createObjectURL(dataAPi);
          let link = document.createElement('a');
          document.body.appendChild(link); 
          link.href = objectURL;
          link.download = "Boleta";
          link.click();
          window.URL.revokeObjectURL(objectURL);
          link.remove();
        }  

				function reImprimir(event){
					swal({
                  title: "Reimprimir?",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                .then( async (aceptado) => {
									if(aceptado){
										let nodo1 = event.target.parentNode.parentNode.childNodes;
										let nodo2 = event.target.parentNode.parentNode.nextSibling.nextSibling.childNodes;
										let tipo = nodo1[1].textContent;
										let fecha = nodo1[5].textContent;
										let clienteArray = nodo2[7].textContent || [];
										let cliente;
										let documento;
										let numDocumento;
										if(clienteArray.split(":")[1].trim().split(" ").slice(0, -1)[0] && clienteArray.split(":")[1].trim().split(" ").slice(0, -1)[1]){
											cliente = clienteArray.split(":")[1].trim().split(" ").slice(0, -1)[0] + " " + clienteArray.split(":")[1].trim().split(" ").slice(0, -1)[1] + " " + clienteArray.split(":")[1].trim().split(" ").slice(0, -1)[2] + " " + clienteArray.split(":")[1].trim().split(" ").slice(0, -1)[3];

											documento = clienteArray.split(":")[1].trim().split(" ").slice(-1)[0] || "";
											numDocumento = clienteArray.split(":")[2].split(" ")[1] || "";
										}else{
											cliente = "REGULAR";
											documento = "n/a";
											numDocumento = "n/a";
										}
										
										let amountSend = nodo1[3].textContent.split(" ").filter(e => e != "")[0];
										let moneySend = nodo1[3].textContent.split(" ").filter(e => e != "")[1];
										let correlativo = nodo2[3].textContent.split(":")[1].trim();
										let cotizacion = nodo1[7].textContent;
										let amounRec = nodo1[9].textContent.split(" ").filter(e => e != "")[0];
										let moneyRec = nodo1[9].textContent.split(" ").filter(e => e != "")[1];
									
										const format = `
											<div></br> 
												<div>
													Casa de Cambios ${config.nombreComercial}</br>
													${config.direccion}
												<span class="separador">
													<span>Telf: </span><span class="left"> ${config.telefono}</span>
												</span>
												<span class="separador">
												<span>RUC: </span><span class="left"> ${config.ruc}</span>
												</span>
												-------------------------------------</br>
												BOLETA DE VENTA ELECTRONICA (COPIA)</br>
												-------------------------------------</br></div>
												<div class="left">
													<span>Fecha: </span><span>${fecha}</span></br>
													<span>Ticket n: </span><span> ${config.serieBoleta}-${String(correlativo)}</span></br>
													<span>Nombre: </span><span>${String(cliente)}</span></br>
													<span>DOC: </span><span>${String(documento)} ${String(numDocumento)}</span></br>
													<span>Direccion: </span><span>LIMA</span></br>
													<span>Operacion: </span><span>${tipo} de ${moneySend}</span></br>
												</div>
												-------------------------------------
												<div class="left">
													<span>Monto:</span><span> ${amountSend} ${moneySend}</span></br>                   
													<span>Tipo de Cambio:<span/> ${cotizacion}<span></span>
												</div>
												-------------------------------------
												<div class="left">
													<span>Total: </span><span> ${amounRec} ${moneyRec}</span></br>                   
													<span>Usuario: caja<span/><span></span>
												</div>
												<div class="footer"></br>
												Representacion impresa de la boleta
												electronica</br>
												Para consultar el documento ingrese
												a https://https://ww1.sunat.gob.pe/ol-ti-itconsultaunificadalibre/consultaUnificadaLibre/consulta</br>
												</div>

												!Gracias por su preferencia!</br></br>
												-------------------------------------</br>
												---------------------------------------</br>
											</div></br>  `;
											// console.log(format)
											printTicket(format)
									}
									
								})
					
				}

				function printTicket(data){
					const div = document.getElementById('print');
        	const modal = document.createElement('div');
        	modal.classList.add('modal_print');
					modal.innerHTML = data;
					div.appendChild(modal);
        	window.print();
        	modal.remove();
				}
      </script>
			
      <script src="<?= base_url("assets/js/numeroAletras.js"); ?>"></script>
      <script src="<?= base_url("assets/js/boleta-electronica.js"); ?>"></script>
<?= $footer; ?>
