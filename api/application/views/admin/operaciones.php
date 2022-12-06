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

				<!-- Modal -->
				<form id="form-ticket">
				<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Datos del Cliente</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
							<div class="form-row">
									<div class="form-group">
										<label class="col-form-label">Persona a Favor:</label>
										<select id="favor" class="form-control" name="favor_cliente" onchange="handleSelect()" required>
											<option value="001" selected>De si mismo</option>
											<option value="002">Persona Natural</option>
											<option value="003">Ente Juridico / Domiciliado en Peru</option>
											<option value="004">Ente Juridico / No domiciliado en Peru</option>
										</select>
									</div>
							</div>
							<div class="form-row">
									<div class="form-group col-12">
										<label class="col-form-label">*Ejecutante:</label>
										<input id="ejecutante" type="text" class="form-control col-12" placeholder="Ejecutante" name="ejecutante" readonly>
									</div>
							</div>
							<div class="form-row">
								<div class="form-group col-12">
										<label class="col-form-label">*Origen de Fondos:</label>
										<select id="origen" class="form-control" name="origen" required>
											<option value="001">Ahorros</option>
											<option value="002">Alquiler de Bienes Muebles</option>
											<option value="003">Alquiler de Bienes Inmuebles</option>
											<option value="004">Donacion/Sorteo</option>
											<option value="005">Ingreso por Trabajo Independiente</option>
											<option value="006">Ingreso por Trabajo Dependiente</option>
											<option value="007">Ingresos por regalia</option>
											<option value="008">Prestamos</option>
											<option value="009">Venta de Bien Mueble</option>
											<option value="010">Venta de Bien Inmueble</option>
											<option value="099" selected>Otros</option>
										</select>
									</div>
								</div>
							</div>
							
							<hr>

							<div class="form-row" id="show-ejecutante" style="display: none">
									<div class="form-group pl-4">
										<label class="col-form-label">Beneficiario:</label>
											<select id="beneficiario" name="beneficiario" class="custom-select select2-clientes selection-clientes col-12">
											<option value=""> -- </option>
											<?php foreach ($clientes as $key) : ?>
											<option value="<?= $key->id_cliente; ?>"><?php echo $key->doc_cliente . " - " . $key->n_cliente . "-" . $key->nom_cliente; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
							</div>
					
						

							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
								<button id="btn-click" type="button" class="btn btn-primary">Continuar</button>
							</div>
						</div>
					</div>
				</div>
				</form>


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
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-exchange-alt"></i> Operaciones</h1>
          </div>
          <div class="row">
            <div class="col-12 col-md-6">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <form id="guardar" class="form-inline" method="POST" action="">
                    <div class="form-group my-auto">
                      <label class="mr-2"><i class="fa fa-user mr-2" aria-hidden="true"></i>Cliente</label>
                      <select id="cliente" name="cli_operacion" class="custom-select select2-clientes selection-clientes">
                        <option selected value="0"> REGULAR</option>
                        <?php foreach ($clientes as $key) : ?>
                        <option value="<?= $key->id_cliente; ?>"><?php echo $key->doc_cliente . " - " . $key->n_cliente . "-" . $key->nom_cliente; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <a href="Clientes" class="btn btn-primary mt-2 ml-2"><i class="fa fa-user-plus" aria-hidden="true"></i></a>
                    </div>
                    
                </div>
                <div class="card-body">
                    <div class="form-row">
                      <div class="col-12 col-md-3 mb-3">
                        <label>Tipo</label>
                        <select id="tipo" name="tip_operacion" class="custom-select" onchange="cot(this.value);" required>
                          <option selected value="COMPRA">Compra</option>
                          <option value="VENTA">Venta</option>
                        </select>
                      </div>
                      <div class="col-12 col-md-3 mb-3">
                        <label>Monto</label>
                        <input id="monto" type="text" name="mon_operacion" min="0" class="form-control" value="" onkeypress="return soloNumeros(event)" autocomplete="off" required>
                      </div>
                      <div class="col-12 col-md-3 mb-3">
                        <label class="mr-2">Moneda</label>
                        <select id="seleccion" name="div_operacion" class="custom-select select2-monedas" style="width: 120px;" onchange="selected();" required>
                          <?php foreach ($divisas as $moneda): ?>
                          <option value="<?= $moneda->cod_divisa; ?>" <?= ($moneda->cod_divisa == 'USD') ? "selected" : ""; ?>><?= $moneda->cod_divisa; ?></option>
                        <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="col-12 col-md-3 my-auto">
                        <label class="mt-4"></label>
                          <div id="img" class="ml-3 mb-4"></div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-12 col-md-3 mb-3">
                        <label>Cotización</label>
                        <input type="text" name="cot_operacion" onkeypress="return soloNumeros(event)" id="cotizacion" class="form-control" value="" autocomplete="off" required>
                      </div>
                      <div class="col-12 col-md-3 mb-3">
                        <label id="rec">Recibe</label>
                        <input id="recibe" name="rec_operacion" type="numbre" class="form-control" readonly="readonly" required>
                      </div>
                      <div class="col-12 col-md-3 mb-3">
                        <label class="mr-2">Moneda</label>
                        <select id="seleccion_recibe" name="mon_rec_operacion" class="custom-select select2-monedas_recibe" style="width: 120px;" onchange="selected_recibe();" required>
                          <?php foreach ($divisas as $moneda): ?>
                          <option value="<?= $moneda->cod_divisa; ?>" <?= ($moneda->cod_divisa == 'PEN') ? "selected" : ""; ?>><?= $moneda->cod_divisa; ?></option>
                        <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="col-12 col-md-3 my-auto">
                        <label class="mt-4"></label>
                          <div id="img_recibe" class="ml-3 mb-4"></div>
                      </div>
                    </div>
                     <div class="form-row">
                      <div class="col-12 col-md-3 mb-3">
                        <label id="ent">Entrega</label>
                        <input type="numbre" onkeypress="return soloNumeros(event)" id="entrega" class="form-control" autocomplete="off">
                      </div>
                      <div class="col-12 col-md-3 mb-3">
                        <label id="vue">Vuelto</label>
                        <input id="vuelto" type="numbre" class="form-control" readonly="readonly" value="0" required>
                      </div>
                      
                        <div class="col-12 col-md-3 mt-4">
                       <button class="btn btn-warning mt-2" type="reset"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo</button>
                      </div>
                      <div class="col-12 col-md-3 mt-4">
<<<<<<< HEAD
=======

>>>>>>> master
                        <button class="btn btn-success mt-2" type="submit" onclick="guardar();"><i class="fa fa-check" aria-hidden="true"></i> Guardar</button>
                      </div>    
                    </div>
                    <div class="d-flex flex-row-reverse bd-highlight">
                    </div>
                  </form>
                 </div>
              </div>
            </div>
            <div class="col-12 col-md-6">
             <!-- Basic Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                </div>
                <div class="card-body">
                  <!-- Background Gradient Utilities -->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 id="titulo_resultado" class="m-0 font-weight-bold text-primary"></h6>
                  </div>
                  <div class="card-body">
                    <div class="px-3 py-5 bg-gradient-primary text-white text-center"><span id="cod_recibe"></span><span id="mostrar_resultado" class="display-4">0.00</span></div>
                  </div>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
        
      </div>
							
      <script>

		function guardar(){
		  let cotizaciones = JSON.parse('<?php echo json_encode($cotizaciones); ?>');
          let monto = document.getElementById('monto').value;
          monto = parseFloat(monto);
          let cotizacion = document.getElementById('cotizacion').value;
          cotizacion = parseFloat(cotizacion);
          let recibe = document.getElementById('recibe').value;
          recibe = parseFloat(recibe);
          let tipo = document.getElementById('tipo').value;
          let moneda = document.getElementById('seleccion').value;
          let moneda_recibe = document.getElementById('seleccion_recibe').value;
		  
		  let promedio = cotizaciones.filter( m => m.codigo == moneda)[0]?.cotizacion;
		  if(!promedio){
			promedio = 0;
		  }

		  if(promedio == 0 && tipo == "VENTA"){
			  const divisas = JSON.parse('<?php echo json_encode($divisas); ?>');
			  const promedioLocal = divisas.filter( m => m.cod_divisa == moneda)[0]?.com_divisa;
			  promedio = promedioLocal;
		  }

		  let cotizacionToSol = 0;
		  //si la moneda no es USD se calcula para valorizar a soles
		  if(moneda !== 'USD' && moneda_recibe != 'PEN'){
			// console.log("arriba")
			cotizacionToSol = cotizacion * cotizaciones.filter( m => m.codigo == "USD")[0]?.cotizacion;
		  }else{
			// console.log("akja")
			cotizacionToSol = cotizacion;
		  }
			// console.log("[cotizacionToSol]", cotizacionToSol)
		  
          //obtener datos del cliente
          let selectCliente = document.getElementById('cliente');
    
          let clienteText = selectCliente.options[selectCliente.selectedIndex].text;
          const clienteArray = clienteText.split("-");

          let cliente = clienteArray.map( c => c.trim());

          let clienteID = selectCliente.value;

		//   console.log(cotizacionToSol, cotizacion)
		  //ganancia de ticket
		 
		//   let gananciaTicket = (cotizacion - promedio) * monto;
		  let gananciaTicket = (cotizacionToSol - promedio) * monto;

		  if(tipo === "COMPRA"){
			gananciaTicket = 0;
		  }

          var data = { monto, cotizacion, recibe, tipo, moneda, moneda_recibe, cliente, clienteID, promedio, gananciaTicket, cotizacionToSol }
			
			$("#guardar").on('submit', function(evt){
            evt.preventDefault(); 
            if(monto <= 0 || cotizacion <= 0 || recibe <= 0) {
              swal({
                title: "Error en los Datos",
                icon: "error",
                buttons: true,
                dangerMode: true,
              })
              return;
            }
						
						//verificar monto mayor a 5000
						checkAmount(monto, moneda)
						.then(res => {
							if(res){
								if(!clienteArray[1]){
									swal({
												title: "Cantidad mayor a 5000 USD requiere ejecutante",
												icon: "warning",
												buttons: true,
												dangerMode: true,
											});
								}else{
									
									document.getElementById('ejecutante').value = `${clienteArray[0]} - ${clienteArray[1]} - ${clienteArray[2]}`;
									data.checkAmount = true;
                  document.getElementById('btn-click').addEventListener('click', () => handleOperations(evt, monto, cotizacion, recibe, data))


									$('#myModal').modal()


								}
							}else{
								data.checkAmount = false;
								handleOperations(evt, monto, cotizacion, recibe, data);
							}
							
						}) 
     
          });
        }

      async function printTicket(data){
				
        const div = document.getElementById('print');
        const modal = document.createElement('div');
        modal.classList.add('modal_print');
        
        let date = new Date();
        let fechaBoleta = `${date.getDate()}-${date.getMonth() + 1}-${date.getFullYear()}  ${date.getHours()}:${date.getMinutes()}:${date.getSeconds()}`;

        //config cliente
        if(!data.cliente && data.clienteID == 0){
          data.cliente = ["REGULAR"];
        }

        if(data.clienteID != 0){
          data.cliente = [];

          await fetch('Clientes/get_cliente_id', {
              method: 'POST',
              headers: {
              'Content-Type': 'application/json',
              },
              body: JSON.stringify(data.clienteID)
            })
          .then(res => res.json())
          .then(res => {
						
            switch(res[0].doc_cliente){
              case "DNI":
                  data.cliente[0] = "DNI";
                  break;
              case "CE":
                  data.cliente[0] = "CE";
                  break;
              case "RUC":
                  data.cliente[0] = "RUC";
                  break;
              case "PAS":
                  data.cliente[0] = "PAS";
                  break;
            }

            data.cliente[1] = res[0].n_cliente;
            data.cliente[2] = res[0].nom_cliente;
            data.cliente[3] = res[0].pais_cliente;
            data.cliente[4] = res[0].ocu_cliente;
            data.cliente[5] = res[0].po_cliente;
						
          })
        } 
				
        if(data.cliente.length === 1){
            data.cliente[0] = "N/";
            data.cliente[1] = "N/";
            data.cliente[2] = "CLIENTE";
        }else{
            
            switch(data.cliente[0]){
                case "DNI":
                    data.cliente[0] = "DNI";
                    break;
                case "CE":
                    data.cliente[0] = "CE";
                    break;
                case "RUC":
                    data.cliente[0] = "RUC";
                    break;
                case "PAS":
                  data.cliente[0] = "PAS";
                  break;
            }
        }
				
        //tipo
        if(data.tipo == 'COMPRA'){
            tipo = "Compra de ";
        }else{
            tipo = "Venta de ";
        }

        // console.log("data: ", data)
        // console.log(data)

				if(!data.checkAmount){
					modal.innerHTML = `
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
							BOLETA DE VENTA ELECTRONICA</br>
							-------------------------------------</br></div>
							<div class="left">
								<span>Fecha: </span><span>${fechaBoleta}</span></br>
								<span>Ticket n: </span><span> ${config.serieBoleta}-${String(data.correlativo)}</span></br>
								<span>Nombre: </span><span>${String(data.cliente[2])}</span></br>
								<span>DOC: </span><span>${String(data.cliente[0])} ${String(data.cliente[1])}</span></br>
								<span>Direccion: </span><span>LIMA</span></br>
								<span>Operacion: </span><span>${tipo} ${data.moneda}</span></br>
							</div>
							-------------------------------------
							<div class="left">
								<span>Monto:</span><span> ${data.monto} ${data.moneda}</span></br>                   
								<span>Tipo de Cambio:<span/> ${data.cotizacion}<span></span>
							</div>
							-------------------------------------
							<div class="left">
								<span>Total: </span><span> ${data.recibe} ${data.moneda_recibe}</span></br>                   
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
						</div></br>   
						`;
				}else{
					let selectFavor = document.getElementById('favor');
					let selectedOrigen = document.getElementById('origen').value;
					const arrayOrigen = {
							"001": "Ahorros",
							"002": "Alquiler de Bienes Muebles",
							"003": "Alquiler de Bienes Inmuebles",
							"004": "Donacion/Sorteo",
							"005": "Ingreso por Trabajo Independiente",
							"006": "Ingreso por Trabajo Dependiente",
							"007": "Ingresos por regalia",
							"008": "Prestamos",
							"009": "Venta de Bien Mueble",
							"010": "Venta de Bien Inmueble",
							"099": "Otros"
					}
					
          let favorText = selectFavor.options[selectFavor.selectedIndex].text;
					let beneficiario = document.getElementById('beneficiario');
					let beneficiarioText = beneficiario.options[beneficiario.selectedIndex].text;
					const beneficiarioArray = beneficiarioText.split("-");

					let divBeneficiario = '';

					if(String(beneficiarioArray[2]) != ''){
						divBeneficiario= 
							`<span>R. Social: </span><span>${String(beneficiarioArray[2])}</span></br>
							 <span>DOC: </span><span>${String(beneficiarioArray[0])} ${String(beneficiarioArray[1])}</span></br>`;
					}
							

					modal.innerHTML = `
						<div>
							<div>Declaración Jurada de conocimiento </br>
								del ejecutante bajo el regimen ${config.regimen}
								</br></br>
								Casa de Cambios ${config.nombreComercial}</br>
								${config.direccion}
							<span class="separador">
								<span>Telf: </span><span class="left"> ${config.telefono}</span>
							</span>
							<span class="separador">
							<span>RUC: </span><span class="left"> ${config.ruc}</span>
							</span>
							-------------------------------------</br>
							BOLETA DE VENTA ELECTRONICA</br>
							-------------------------------------</br></div>
							<div class="left">
								<span>Fecha: </span><span>${fechaBoleta}</span></br>
								<span>Ticket n: </span><span> ${config.serieBoleta}-${String(data.correlativo)}</span></br>
								<span><b>Ejecutante:</b></span></br>
								<span>Por el presente documento declaro bajo juramento lo siguiente:</span></br>
								<span>Nombre: </span><span>${String(data.cliente[2])}</span></br>
								<span>DOC: </span><span>${String(data.cliente[0])} ${String(data.cliente[1])}</span></br>
								<span>Pais: </span><span>${String(data.cliente[3])}</span></br>
								<span>Ocupación: </span><span>${String(data.cliente[4])}</span></br>
								<span>Funcion Politica: </span><span>${String(data.cliente[5])}</span></br>
							</div>
							-------------------------------------
							<div class="left">
								<span><b>Beneficiario:</b></span></br>
								<span>Operacion a favor de: </span><span>${favorText}</span></br>
								${divBeneficiario}
							</div>
							-------------------------------------</br>
							<span>Origen del dinero involucrado: </br>
							${arrayOrigen[selectedOrigen]}</span></br>
							-------------------------------------
							<div class="left">
								<span><b>Propósito de la Operacion:</b></span></br>
								<span>${tipo} de moneda extranjera</span></br>
								<span>Cantidad:</span><span> ${data.monto} ${data.moneda}</span></br> 
								<span>Valor: </span><span> ${data.recibe} ${data.moneda_recibe}</span></br>
								<span>Tipo de Cambio:<span/> ${data.cotizacion}<span></span>                   
								<span>Usuario: caja<span/><span></span>
							</div>
							<div class="footer"></br>
							Afirmo y ratifico todo lo manifestado en </br>
							la presente Declaracion Jurada.
							</br>
							Firma:
							</br>
							-------------------------------------</br>
							</div></br>
							!Gracias por su preferencia!</br>
							</br>-------------------------------------</br>
							---------------------------------------</br>
						</div></br>   
						`;
				}
     
        div.appendChild(modal);
        window.print();
        modal.remove();
		// location.reload();
      }

	async function checkAmount(amount, money){
		let contizacionAmount = await getCotizacionDivisa(money);
		let queryUsd = await fetch('Operaciones/get_divisas');
		let contizacionUsd = await queryUsd.json();
		contizacionUsd = contizacionUsd.filter(d => d.cod_divisa === 'USD')[0];
		contizacionUsd = contizacionUsd.com_divisa;
		// console.log(contizacionAmount , contizacionUsd)
		let checkCantidad = (contizacionAmount / contizacionUsd) * amount;
		// console.log(checkCantidad);
		if(checkCantidad >= 5000){
			checkCantidad = true;
		}else{
			checkCantidad = false;
		}
		return checkCantidad;
	}

		//Obtener divisas para calcular el equivalente en usd mayor a 5000
		const getCotizacionDivisa = async (divisa) => {
			const query = await fetch('Operaciones/get_divisas');
			const dataDivisas = await query.json();
			const cotizacion = dataDivisas.filter(d => d.cod_divisa === divisa)[0];
			return cotizacion.com_divisa;
		}

		const handleSelect = () => {
			const favor = document.getElementById('favor');
			if(favor.value == '003' || favor.value == '004'){
				document.getElementById('show-ejecutante').style.display = 'block';
			}else{
				document.getElementById('show-ejecutante').style.display = 'none';
			}
		}

		const handleOperations = (evt, monto, cotizacion, recibe, data ) => {

		let beneficiario = document.getElementById('beneficiario');
		let beneficiarioText = beneficiario.options[beneficiario.selectedIndex].text;
		const beneficiarioArray = beneficiarioText.split("-");
		const favor = document.getElementById('favor');
		// console.log(beneficiarioArray[2], favor.value)
		if(favor.value == '003' || favor.value == '004'){
			if(beneficiarioArray[2] === ''){
				swal({
					title: "Beneficiario es Obligatorio",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				});
				return;
			}
			
		}
						
						

									let form = evt.target; 
										swal({
											title: "Registrar?",
											icon: "warning",
											buttons: true,
											dangerMode: true,
										})
										.then((aceptado) => {
											//VERIFICANDO LOS DATOS ENVIADOS
											if (aceptado){
											
												// console.log(data.gananciaTicket)
												swal("Guardando y Reportando...!", {
													icon: "info",   
													buttons: false, 
												})
												
												fetch('Operaciones/save_operacion', {
													method: 'POST',
													headers: {
													'Content-Type': 'application/json',
													},
													body: JSON.stringify(data)
												})
												// .then( lastOperation => lastOperation.json())
												// .then(lastOperation => console.log(lastOperation))
												.then( res => {

													document.getElementById('monto').value = 0;
													document.getElementById('recibe').value = 0;
													document.getElementById('mostrar_resultado').textContent = 0;
													// document.getElementById('cliente').option = 0;
											
													return res.json();
												})
												.then(async res => {
													
													//consultamos el ultimo correlativo
													// para asignarlo al nuevo
													const queryCorrelativo = await fetch('Operaciones/check_operacion_id', {
																														method: 'POST',
																														headers: {
																														'Content-Type': 'application/json',
																														},
																														body: JSON.stringify(res)
																													});
													const latestCorrelativo = await queryCorrelativo.json();
																
													//add correlativo actual
													data.correlativo = Number(latestCorrelativo.correlative_sunat);
																																					//si es compra colocar correlativo interno 
													// if(data.tipo == "COMPRA"){
													// 	data.correlativo = Number(latestCorrelativo.id_operacion);
													// }																							
													
													//print
													printTicket(data);
																								
													getToken(data)
														.then(respuesta => {
															console.log(respuesta)
															if(respuesta.sunatResponse.success){

																//verificar si es compra o venta para mostrar mensaje
																
																if(respuesta.sunatResponse.tipo == "COMPRA"){
																	swal("Guardado Correctamente!", {
																		icon: "success",   
																		buttons: {
																			defeat: "ok",
																		}, 
																	})
																}else{
																	swal("Reportado correctamente a la Sunat!", {
																		icon: "success",   
																		buttons: {
																			defeat: "ok",
																		}, 
																	})
																}
																
			
																//actualizar report de la operacion
																fetch('Operaciones/update_operacion', {
																		method: 'POST',
																		headers: {
																		'Content-Type': 'application/json',
																		},
																	body: JSON.stringify(res)
																});
																

															}else{

																swal({
																	title: "Ha ocurrido un problema con sunat!",
																	text: "Debe volver a enviar desde reportes detallados",
																	icon: "warning",   
																	buttons: {
																		defeat: "ok",
																	}, 
																})


															}
														})
														.catch(err => {
															
															swal({
																	title: "Ha ocurrido un problema con sunat!",
																	text: "Se ha guardado en la BASE DE DATOS esta operación correctamente, pero no se ha reportado a sunat esta operacion, Debe volver a enviar desde reportes detallados",
																	icon: "warning",   
																	buttons: {
																		defeat: "ok",
																	}, 
																})
														})
												})

											}

										})

                    $('#myModal').modal('hide')
			}
      </script>

      <!-- End of Main Content -->
      <script src="<?= base_url("assets/js/numeroAletras.js"); ?>"></script>
      <script src="<?= base_url("assets/js/boleta-electronica.js"); ?>"></script>
      <script src="<?= base_url("assets/js/operaciones/formulario.js"); ?>"></script>
<?= $footer; ?>
