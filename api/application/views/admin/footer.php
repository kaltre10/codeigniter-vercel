
    </div>
    <!-- End of Content Wrapper -->

  </div>
  <script>

    function cerrar_session(){
          swal({
            title: "Cerrar Sesion?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((aceptado) => {
                  // //VERIFICANDO LOS DATOS ENVIADOS
                  if (aceptado){     
                    swal("Hasta Pronto!", {
                      icon: "success",   
                      buttons: {
                        defeat: "ok",
                      },
                    })
                    .then((value) => {
                      switch (value) {
                        default:
                          location.href="../Login/logout";
                          //form.submit();
                      }
                    });
                  }
            });
        }  
        function cierre_ejecutado(){
          swal({
            title: "Cierre ya se ha ejecutado",
            text: "Anule el cierre para realizar alguna acción",
            icon: "warning",
            dangerMode: true,
          })
        }  
        
  </script>
  <!-- End of Page Wrapper -->
  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url("vendor/jquery/jquery.min.js"); ?>"></script>
  <script src="<?= base_url("vendor/datatables/jquery.dataTables.js."); ?>"></script>
  <script src="<?= base_url("vendor/datatables/dataTables.bootstrap4.js"); ?>"></script>
  <script src="<?= base_url("vendor/bootstrap/js/bootstrap.bundle.min.js"); ?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url("vendor/jquery-easing/jquery.easing.min.js"); ?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url("assets/js/sb-admin-2.min.js"); ?>"></script>

  <!-- Page level plugins -->
  <script src="<?= base_url("vendor/chart.js/Chart.min.js"); ?>"></script>

  <!-- Page level custom scripts -->
  <script src="<?= base_url("assets/js/demo/chart-area-demo.js"); ?>"></script>
  <!-- <script src="<?= base_url("assets/js/demo/chart-pie-demo.js"); ?>"></script> -->
  <script src="<?=  base_url("assets/select2-4.0.13/dist/js/select2.min.js"); ?>"></script>
  <script>


		
			

    $(document).ready(function() {
			
		if(document.getElementById("table_sal_ent")){
			console.log("okok")
			$('#table_sal_ent').DataTable()
		}
		

		if(document.getElementById("table_clientes")){
			$('#table_clientes').DataTable({
				language: {
					"decimal": "",
					"emptyTable": "No hay información",
					"info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
					"infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
					"infoFiltered": "(Filtrado de _MAX_ total entradas)",
					"infoPostFix": "",
					"thousands": ",",
					"lengthMenu": "Mostrar _MENU_ Entradas",
					"loadingRecords": "Cargando...",
					"processing": "Procesando...",
					"search": "Buscar:",
					"zeroRecords": "Sin resultados encontrados",
					"paginate": {
							"first": "Primero",
							"last": "Ultimo",
							"next": "Siguiente",
							"previous": "Anterior"
					}
			},
			});
		}

    $('.select2-divisas').select2();
    $('.select2-categorias').select2();
    $('.select2-monedas').select2();
    $('.select2-clientes').select2();
    $('.select2-monedas_recibe').select2();
	
   });		
     
  </script>
</body>
  <?php if (isset($_GET['err'])) {
    echo "<script>cierre_ejecutado();</script>";
  } ?>
</html>
