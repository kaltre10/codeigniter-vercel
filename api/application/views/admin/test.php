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
            <h1 class="h3 mb-0 text-gray-800"><i class="far fa-file-alt"></i> TEST</h1>
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
                    <!-- <div class="col-auto">
                      <label class="sr-only">Hasta</label>
                      <div class="input-group mb-2">
                        <input type="date" class="form-control" value="<?php if($this->input->post('hasta')){ echo $this->input->post('hasta'); }else{ echo date("Y-m-d"); } ?>" name="hasta">
                      </div>
                    </div> -->
                    <div class="col-auto">
                      <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </div>
                  </div>
                </form>      
              </div>
            </div>
            <div class="card-body">     
              <div class="table-responsive">
                
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
        const apiQuery = async () => {
          const query = await fetch('Operaciones/operacionesAll', {
                                      method: 'POST',
                                      headers: {
                                      'Content-Type': 'application/json',
                                      },
                                      body: JSON.stringify({desde: "2022-06-27 00:00:00", hasta: "2022-06-27 23:59:59"})
                                    });
          const data = await query.json();
          const dataDB = data.sort((a,b) => a.id_operacion - b.id_operacion);
          
          formato(dataDB);
          

        }

        const formato = async (dataDB) => {

          

          let forma = {
                        "fecGeneracion": "2022-06-27T00:00:00-05:00",
                        "fecResumen": "2022-06-27T00:00:00-05:00",
                        "correlativo": "001",
                        "moneda": "PEN",
                        "company": {
                        "ruc": 20609364212,
                        "razonSocial": "EWFOREX",
                        "nombreComercial": "EWFOREX",
                        "address": {
                            "direccion": "Av del Ejército 768, Miraflores",
                            "provincia": "LIMA",
                            "departamento": "LIMA",
                            "distrito": "LIMA",
                            "ubigueo": "150101"
                          }
                        },
                        "details": []
                    }

          dataDB.forEach( d => {
            
            d.cliente = [];
            if(!d.cli_operacion && d.cli_operacion != 0){
              
            

              fetch('Clientes/get_cliente_id', {
                  method: 'POST',
                  headers: {
                  'Content-Type': 'application/json',
                  },
                  body: JSON.stringify(d.cli_operacion)
                })
              .then(res => res.json())
              .then(res => {

                switch(res[0].doc_cliente){
                  case "DNI":
                      d.cliente[0] = 1;
                      break;
                  case "CE":
                      d.cliente[0] = 4;
                      break;
                  case "RUC":
                      d.cliente[0] = 6;
                      break;
                  case "PAS":
                      d.cliente[0] = 7;
                      break;
                }

                d.cliente[1] = res[0].n_cliente;
                d.cliente[2] = res[0].nom_cliente;
              
              })
            } 

            if(d.cli_operacion.length === 1){
                d.cliente[0] = 0; //codigo o cliente general
                d.cliente[1] = "00000000";
                d.cliente[2] = "CLIENTE";
            }else{
                
                switch(d.cliente[0]){
                    case "DNI":
                        d.cliente[0] = 1;
                        break;
                    case "CE":
                        d.cliente[0] = 4;
                        break;
                    case "RUC":
                        d.cliente[0] = 6;
                        break;
                    case "PAS":
                      d.cliente[0] = 7;
                      break;
                }
            }
           
            forma.details.push({
              "tipoDoc": "03",
              "serieNro": `B001-${d.correlative_sunat}`,
              "estado": "1",
              "clienteTipo": "1",
              "clienteNro": "00000000",
              "total": d.rec_operacion,
              "mtoOperGravadas": 0,
              "mtoOperInafectas": 0,
              "mtoOperExoneradas": d.rec_operacion,
              "mtoOperExportacion": 0,
              "mtoOtrosCargos": 0,
              "mtoIGV": 0
            })
          })
          // console.log(forma)
          const response = await fetchApi(forma);
          const sunat = await response.json();
          console.log(sunat)
        }

        apiQuery();


        function fetchApi(data){
          return fetch('https://facturacion.apisperu.com/api/v1/summary/send', {
              method: 'POST',
              headers: {
              'Content-Type': 'application/json',
              'Authorization': "bearer "
              },
              body: JSON.stringify(data)
          })
        }
      </script>
<?= $footer; ?>