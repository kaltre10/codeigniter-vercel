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
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-user-plus" aria-hidden="true"></i> Crear Nuevo Cliente:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="guardar" action="<?= base_url('admin/Clientes/save_cliente'); ?>" method="POST">
					<div class="form-row">
						<div class="form-group col-12 col-md-6">
							<label for="recipient-name" class="col-form-label">*Tip Doc:</label>
							<select class="form-control" name="doc_cliente" required>
								<option value=""> - </option>
								<option value="RUC">RUC</option>
								<option value="DNI">DNI</option>
								<option value="CE">CE</option>
								<option value="PAS">PAS</option>
							</select>
						</div>
						<div class="form-group col-12 col-md-6">
							<label for="recipient-name" class="col-form-label">*N°:</label>
							<input type="text" pattern="[A-Za-z0-9]+" title="Solo letras o Números" class="form-control" name="n_cliente" required>
						</div>
					</div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">*Nombres y Apellidos:</label>
            <input type="text" pattern="[A-Za-z ]+" title="Solo letras" class="form-control" name="nom_cliente" required>
          </div>
					<div class="form-row">
						<div class="form-group col-12 col-md-6">
								<label for="recipient-name" class="col-form-label">País:</label>
								<select class="form-control" name="pais_cliente" required>
									<option value=""> - </option>
									<option value="Afganistán" id="AF">Afganistán</option>
									<option value="Albania" id="AL">Albania</option>
									<option value="Alemania" id="DE">Alemania</option>
									<option value="Andorra" id="AD">Andorra</option>
									<option value="Angola" id="AO">Angola</option>
									<option value="Anguila" id="AI">Anguila</option>
									<option value="Antártida" id="AQ">Antártida</option>
									<option value="Antigua y Barbuda" id="AG">Antigua y Barbuda</option>
									<option value="Antillas holandesas" id="AN">Antillas holandesas</option>
									<option value="Arabia Saudí" id="SA">Arabia Saudí</option>
									<option value="Argelia" id="DZ">Argelia</option>
									<option value="Argentina" id="AR">Argentina</option>
									<option value="Armenia" id="AM">Armenia</option>
									<option value="Aruba" id="AW">Aruba</option>
									<option value="Australia" id="AU">Australia</option>
									<option value="Austria" id="AT">Austria</option>
									<option value="Azerbaiyán" id="AZ">Azerbaiyán</option>
									<option value="Bahamas" id="BS">Bahamas</option>
									<option value="Bahrein" id="BH">Bahrein</option>
									<option value="Bangladesh" id="BD">Bangladesh</option>
									<option value="Barbados" id="BB">Barbados</option>
									<option value="Bélgica" id="BE">Bélgica</option>
									<option value="Belice" id="BZ">Belice</option>
									<option value="Benín" id="BJ">Benín</option>
									<option value="Bermudas" id="BM">Bermudas</option>
									<option value="Bhután" id="BT">Bhután</option>
									<option value="Bielorrusia" id="BY">Bielorrusia</option>
									<option value="Birmania" id="MM">Birmania</option>
									<option value="Bolivia" id="BO">Bolivia</option>
									<option value="Bosnia y Herzegovina" id="BA">Bosnia y Herzegovina</option>
									<option value="Botsuana" id="BW">Botsuana</option>
									<option value="Brasil" id="BR">Brasil</option>
									<option value="Brunei" id="BN">Brunei</option>
									<option value="Bulgaria" id="BG">Bulgaria</option>
									<option value="Burkina Faso" id="BF">Burkina Faso</option>
									<option value="Burundi" id="BI">Burundi</option>
									<option value="Cabo Verde" id="CV">Cabo Verde</option>
									<option value="Camboya" id="KH">Camboya</option>
									<option value="Camerún" id="CM">Camerún</option>
									<option value="Canadá" id="CA">Canadá</option>
									<option value="Chad" id="TD">Chad</option>
									<option value="Chile" id="CL">Chile</option>
									<option value="China" id="CN">China</option>
									<option value="Chipre" id="CY">Chipre</option>
									<option value="Ciudad estado del Vaticano" id="VA">Ciudad estado del Vaticano</option>
									<option value="Colombia" id="CO">Colombia</option>
									<option value="Comores" id="KM">Comores</option>
									<option value="Congo" id="CG">Congo</option>
									<option value="Corea" id="KR">Corea</option>
									<option value="Corea del Norte" id="KP">Corea del Norte</option>
									<option value="Costa del Marfíl" id="CI">Costa del Marfíl</option>
									<option value="Costa Rica" id="CR">Costa Rica</option>
									<option value="Croacia" id="HR">Croacia</option>
									<option value="Cuba" id="CU">Cuba</option>
									<option value="Dinamarca" id="DK">Dinamarca</option>
									<option value="Djibouri" id="DJ">Djibouri</option>
									<option value="Dominica" id="DM">Dominica</option>
									<option value="Ecuador" id="EC">Ecuador</option>
									<option value="Egipto" id="EG">Egipto</option>
									<option value="El Salvador" id="SV">El Salvador</option>
									<option value="Emiratos Arabes Unidos" id="AE">Emiratos Arabes Unidos</option>
									<option value="Eritrea" id="ER">Eritrea</option>
									<option value="Eslovaquia" id="SK">Eslovaquia</option>
									<option value="Eslovenia" id="SI">Eslovenia</option>
									<option value="España" id="ES">España</option>
									<option value="Estados Unidos" id="US">Estados Unidos</option>
									<option value="Estonia" id="EE">Estonia</option>
									<option value="c" id="ET">Etiopía</option>
									<option value="Ex-República Yugoslava de Macedonia" id="MK">Ex-República Yugoslava de Macedonia</option>
									<option value="Filipinas" id="PH">Filipinas</option>
									<option value="Finlandia" id="FI">Finlandia</option>
									<option value="Francia" id="FR">Francia</option>
									<option value="Gabón" id="GA">Gabón</option>
									<option value="Gambia" id="GM">Gambia</option>
									<option value="Georgia" id="GE">Georgia</option>
									<option value="Georgia del Sur y las islas Sandwich del Sur" id="GS">Georgia del Sur y las islas Sandwich del Sur</option>
									<option value="Ghana" id="GH">Ghana</option>
									<option value="Gibraltar" id="GI">Gibraltar</option>
									<option value="Granada" id="GD">Granada</option>
									<option value="Grecia" id="GR">Grecia</option>
									<option value="Groenlandia" id="GL">Groenlandia</option>
									<option value="Guadalupe" id="GP">Guadalupe</option>
									<option value="Guam" id="GU">Guam</option>
									<option value="Guatemala" id="GT">Guatemala</option>
									<option value="Guayana" id="GY">Guayana</option>
									<option value="Guayana francesa" id="GF">Guayana francesa</option>
									<option value="Guinea" id="GN">Guinea</option>
									<option value="Guinea Ecuatorial" id="GQ">Guinea Ecuatorial</option>
									<option value="Guinea-Bissau" id="GW">Guinea-Bissau</option>
									<option value="Haití" id="HT">Haití</option>
									<option value="Holanda" id="NL">Holanda</option>
									<option value="Honduras" id="HN">Honduras</option>
									<option value="Hong Kong R. A. E" id="HK">Hong Kong R. A. E</option>
									<option value="Hungría" id="HU">Hungría</option>
									<option value="India" id="IN">India</option>
									<option value="Indonesia" id="ID">Indonesia</option>
									<option value="Irak" id="IQ">Irak</option>
									<option value="Irán" id="IR">Irán</option>
									<option value="Irlanda" id="IE">Irlanda</option>
									<option value="Isla Bouvet" id="BV">Isla Bouvet</option>
									<option value="Isla Christmas" id="CX">Isla Christmas</option>
									<option value="Isla Heard e Islas McDonald" id="HM">Isla Heard e Islas McDonald</option>
									<option value="Islandia" id="IS">Islandia</option>
									<option value="Islas Caimán" id="KY">Islas Caimán</option>
									<option value="Islas Cook" id="CK">Islas Cook</option>
									<option value="Islas de Cocos o Keeling" id="CC">Islas de Cocos o Keeling</option>
									<option value="Islas Faroe" id="FO">Islas Faroe</option>
									<option value="Islas Fiyi" id="FJ">Islas Fiyi</option>
									<option value="Islas Malvinas Islas Falkland" id="FK">Islas Malvinas Islas Falkland</option>
									<option value="Islas Marianas del norte" id="MP">Islas Marianas del norte</option>
									<option value="Islas Marshall" id="MH">Islas Marshall</option>
									<option value="Islas menores de Estados Unidos" id="UM">Islas menores de Estados Unidos</option>
									<option value="Islas Palau" id="PW">Islas Palau</option>
									<option value="Islas Salomón" d="SB">Islas Salomón</option>
									<option value="Islas Tokelau" id="TK">Islas Tokelau</option>
									<option value="Islas Turks y Caicos" id="TC">Islas Turks y Caicos</option>
									<option value="Islas Vírgenes EE.UU." id="VI">Islas Vírgenes EE.UU.</option>
									<option value="Islas Vírgenes Reino Unido" id="VG">Islas Vírgenes Reino Unido</option>
									<option value="Israel" id="IL">Israel</option>
									<option value="Italia" id="IT">Italia</option>
									<option value="Jamaica" id="JM">Jamaica</option>
									<option value="Japón" id="JP">Japón</option>
									<option value="Jordania" id="JO">Jordania</option>
									<option value="Kazajistán" id="KZ">Kazajistán</option>
									<option value="Kenia" id="KE">Kenia</option>
									<option value="Kirguizistán" id="KG">Kirguizistán</option>
									<option value="Kiribati" id="KI">Kiribati</option>
									<option value="Kuwait" id="KW">Kuwait</option>
									<option value="Laos" id="LA">Laos</option>
									<option value="Lesoto" id="LS">Lesoto</option>
									<option value="Letonia" id="LV">Letonia</option>
									<option value="Líbano" id="LB">Líbano</option>
									<option value="Liberia" id="LR">Liberia</option>
									<option value="Libia" id="LY">Libia</option>
									<option value="Liechtenstein" id="LI">Liechtenstein</option>
									<option value="Lituania" id="LT">Lituania</option>
									<option value="Luxemburgo" id="LU">Luxemburgo</option>
									<option value="Macao R. A. E" id="MO">Macao R. A. E</option>
									<option value="Madagascar" id="MG">Madagascar</option>
									<option value="Malasia" id="MY">Malasia</option>
									<option value="Malawi" id="MW">Malawi</option>
									<option value="Maldivas" id="MV">Maldivas</option>
									<option value="Malí" id="ML">Malí</option>
									<option value="Malta" id="MT">Malta</option>
									<option value="Marruecos" id="MA">Marruecos</option>
									<option value="Martinica" id="MQ">Martinica</option>
									<option value="Mauricio" id="MU">Mauricio</option>
									<option value="Mauritania" id="MR">Mauritania</option>
									<option value="Mayotte" id="YT">Mayotte</option>
									<option value="México" id="MX">México</option>
									<option value="Micronesia" id="FM">Micronesia</option>
									<option value="Moldavia" id="MD">Moldavia</option>
									<option value="Mónaco" id="MC">Mónaco</option>
									<option value="Mongolia" id="MN">Mongolia</option>
									<option value="Montserrat" id="MS">Montserrat</option>
									<option value="Mozambique" id="MZ">Mozambique</option>
									<option value="Namibia" id="NA">Namibia</option>
									<option value="Nauru" id="NR">Nauru</option>
									<option value="Nepal" id="NP">Nepal</option>
									<option value="Nicaragua" id="NI">Nicaragua</option>
									<option value="Níger" id="NE">Níger</option>
									<option value="Nigeria" id="NG">Nigeria</option>
									<option value="Niue" id="NU">Niue</option>
									<option value="Norfolk" id="NF">Norfolk</option>
									<option value="Noruega" id="NO">Noruega</option>
									<option value="Nueva Caledonia" id="NC">Nueva Caledonia</option>
									<option value="Nueva Zelanda" id="NZ">Nueva Zelanda</option>
									<option value="Omán" id="OM">Omán</option>
									<option value="Panamá" id="PA">Panamá</option>
									<option value="Papua Nueva Guinea" id="PG">Papua Nueva Guinea</option>
									<option value="Paquistán" id="PK">Paquistán</option>
									<option value="Paraguay" id="PY">Paraguay</option>
									<option value="Perú" id="PE" selected>Perú</option>
									<option value="Pitcairn" id="PN">Pitcairn</option>
									<option value="Polinesia francesa" id="PF">Polinesia francesa</option>
									<option value="Polonia" id="PL">Polonia</option>
									<option value="Portugal" id="PT">Portugal</option>
									<option value="Puerto Rico" id="PR">Puerto Rico</option>
									<option value="Qatar" id="QA">Qatar</option>
									<option value="Reino Unido" id="UK">Reino Unido</option>
									<option value="República Centroafricana" id="CF">República Centroafricana</option>
									<option value="República Checa" id="CZ">República Checa</option>
									<option value="República de Sudáfrica" id="ZA">República de Sudáfrica</option>
									<option value="República Democrática del Congo Zaire" id="CD">República Democrática del Congo Zaire</option>
									<option value="República Dominicana" id="DO">República Dominicana</option>
									<option value="Reunión" id="RE">Reunión</option>
									<option value="Ruanda" id="RW">Ruanda</option>
									<option value="Rumania" id="RO">Rumania</option>
									<option value="Rusia" id="RU">Rusia</option>
									<option value="Samoa" id="WS">Samoa</option>
									<option value="Samoa occidental" id="AS">Samoa occidental</option>
									<option value="San Kitts y Nevis" id="KN">San Kitts y Nevis</option>
									<option value="San Marino" id="SM">San Marino</option>
									<option value="San Pierre y Miquelon" id="PM">San Pierre y Miquelon</option>
									<option value="San Vicente e Islas Granadinas" id="VC">San Vicente e Islas Granadinas</option>
									<option value="Santa Helena" id="SH">Santa Helena</option>
									<option value="Santa Lucía" id="LC">Santa Lucía</option>
									<option value="Santo Tomé y Príncipe" id="ST">Santo Tomé y Príncipe</option>
									<option value="Senegal" id="SN">Senegal</option>
									<option value="Serbia y Montenegro" id="YU">Serbia y Montenegro</option>
									<option value="Sychelles" id="SC">Seychelles</option>
									<option value="Sierra Leona" id="SL">Sierra Leona</option>
									<option value="Singapur" id="SG">Singapur</option>
									<option value="Siria" id="SY">Siria</option>
									<option value="Somalia" id="SO">Somalia</option>
									<option value="Sri Lanka" id="LK">Sri Lanka</option>
									<option value="Suazilandia" id="SZ">Suazilandia</option>
									<option value="Sudán" id="SD">Sudán</option>
									<option value="Suecia" id="SE">Suecia</option>
									<option value="Suiza" id="CH">Suiza</option>
									<option value="Surinam" id="SR">Surinam</option>
									<option value="Svalbard" id="SJ">Svalbard</option>
									<option value="Tailandia" id="TH">Tailandia</option>
									<option value="Taiwán" id="TW">Taiwán</option>
									<option value="Tanzania" id="TZ">Tanzania</option>
									<option value="Tayikistán" id="TJ">Tayikistán</option>
									<option value="Territorios británicos del océano Indico" id="IO">Territorios británicos del océano Indico</option>
									<option value="Territorios franceses del sur" id="TF">Territorios franceses del sur</option>
									<option value="Timor Oriental" id="TP">Timor Oriental</option>
									<option value="Togo" id="TG">Togo</option>
									<option value="Tonga" id="TO">Tonga</option>
									<option value="Trinidad y Tobago" id="TT">Trinidad y Tobago</option>
									<option value="Túnez" id="TN">Túnez</option>
									<option value="Turkmenistán" id="TM">Turkmenistán</option>
									<option value="Turquía" id="TR">Turquía</option>
									<option value="Tuvalu" id="TV">Tuvalu</option>
									<option value="Ucrania" id="UA">Ucrania</option>
									<option value="Uganda" id="UG">Uganda</option>
									<option value="Uruguay" id="UY">Uruguay</option>
									<option value="Uzbekistán" id="UZ">Uzbekistán</option>
									<option value="Vanuatu" id="VU">Vanuatu</option>
									<option value="Venezuela" id="VE">Venezuela</option>
									<option value="Vietnam" id="VN">Vietnam</option>
									<option value="Wallis y Futuna" id="WF">Wallis y Futuna</option>
									<option value="Yemen" id="YE">Yemen</option>
									<option value="Zambia" id="ZM">Zambia</option>
									<option value="Zimbabue" id="ZW">Zimbabue</option>
								</select>
						</div>
						<div class="form-group col-12 col-md-6">
								<label for="recipient-name" class="col-form-label">Ocupación:</label>
								<select class="form-control" name="ocu_cliente">
									<option value=""> - </option>
									<option value="001"> Ama de Casa </option>
									<option value="002"> Desempeado </option>
									<option value="003"> Empleado </option>
									<option value="004"> Empleador (A) </option>
									<option value="005"> Estudiante </option>
									<option value="006"> Jubilado (A)</option>
									<option value="007"> Miembro de las Fuerzas Armadas / Miembro del Clero </option>
									<option value="008"> Obrero (A) </option>
									<option value="009"> Trabajador (A) del Hogar </option>
									<option value="010"> Trabajador (A) Independiente </option>
									<option value="099"> No Declara </option>
								</select>
						</div>
						<div class="form-group">
							<label class="col-form-label">*Funcion Publica:</label>
							<select class="form-control" name="po_cliente" required>
									<option value="NO">NO</option>
									<option value="SI">SI</option>
								</select>
						</div>
					</div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>

 <!-- Modal Editar -->
 <div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-address-book" aria-hidden="true"></i> Modificar Cliente:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editar" action="<?= base_url('admin/Clientes/editar_cliente'); ?>" method="POST">
					<div class="form-row">
						<div class="form-group col-12 col-md-6">
							<label for="recipient-name" class="col-form-label">*Tip Doc:</label>
							<select id="editar-documento" class="form-control" name="doc_cliente" required>
								<option value=""> - </option>
								<option value="RUC">RUC</option>
								<option value="DNI">DNI</option>
								<option value="CE">CE</option>
								<option value="PAS">PAS</option>
							</select>
						</div>
						<div class="form-group col-12 col-md-6">
							<label for="recipient-name" class="col-form-label">*N°:</label>
							<input id="editar-number" type="number" min="0" class="form-control" name="n_cliente" required>
						</div>
					</div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">*Nombres y Apellidos:</label>
            <input id="editar-nombre" type="text" class="form-control" name="nom_cliente" required>
          </div>
					<div class="form-row">
						<div class="form-group col-12 col-md-6">
								<label for="recipient-name" class="col-form-label">País:</label>
								<select id="editar-pais" class="form-control" name="pais_cliente" required>
									<option value=""> - </option>
									<option value="Afganistán" id="AF">Afganistán</option>
									<option value="Albania" id="AL">Albania</option>
									<option value="Alemania" id="DE">Alemania</option>
									<option value="Andorra" id="AD">Andorra</option>
									<option value="Angola" id="AO">Angola</option>
									<option value="Anguila" id="AI">Anguila</option>
									<option value="Antártida" id="AQ">Antártida</option>
									<option value="Antigua y Barbuda" id="AG">Antigua y Barbuda</option>
									<option value="Antillas holandesas" id="AN">Antillas holandesas</option>
									<option value="Arabia Saudí" id="SA">Arabia Saudí</option>
									<option value="Argelia" id="DZ">Argelia</option>
									<option value="Argentina" id="AR">Argentina</option>
									<option value="Armenia" id="AM">Armenia</option>
									<option value="Aruba" id="AW">Aruba</option>
									<option value="Australia" id="AU">Australia</option>
									<option value="Austria" id="AT">Austria</option>
									<option value="Azerbaiyán" id="AZ">Azerbaiyán</option>
									<option value="Bahamas" id="BS">Bahamas</option>
									<option value="Bahrein" id="BH">Bahrein</option>
									<option value="Bangladesh" id="BD">Bangladesh</option>
									<option value="Barbados" id="BB">Barbados</option>
									<option value="Bélgica" id="BE">Bélgica</option>
									<option value="Belice" id="BZ">Belice</option>
									<option value="Benín" id="BJ">Benín</option>
									<option value="Bermudas" id="BM">Bermudas</option>
									<option value="Bhután" id="BT">Bhután</option>
									<option value="Bielorrusia" id="BY">Bielorrusia</option>
									<option value="Birmania" id="MM">Birmania</option>
									<option value="Bolivia" id="BO">Bolivia</option>
									<option value="Bosnia y Herzegovina" id="BA">Bosnia y Herzegovina</option>
									<option value="Botsuana" id="BW">Botsuana</option>
									<option value="Brasil" id="BR">Brasil</option>
									<option value="Brunei" id="BN">Brunei</option>
									<option value="Bulgaria" id="BG">Bulgaria</option>
									<option value="Burkina Faso" id="BF">Burkina Faso</option>
									<option value="Burundi" id="BI">Burundi</option>
									<option value="Cabo Verde" id="CV">Cabo Verde</option>
									<option value="Camboya" id="KH">Camboya</option>
									<option value="Camerún" id="CM">Camerún</option>
									<option value="Canadá" id="CA">Canadá</option>
									<option value="Chad" id="TD">Chad</option>
									<option value="Chile" id="CL">Chile</option>
									<option value="China" id="CN">China</option>
									<option value="Chipre" id="CY">Chipre</option>
									<option value="Ciudad estado del Vaticano" id="VA">Ciudad estado del Vaticano</option>
									<option value="Colombia" id="CO">Colombia</option>
									<option value="Comores" id="KM">Comores</option>
									<option value="Congo" id="CG">Congo</option>
									<option value="Corea" id="KR">Corea</option>
									<option value="Corea del Norte" id="KP">Corea del Norte</option>
									<option value="Costa del Marfíl" id="CI">Costa del Marfíl</option>
									<option value="Costa Rica" id="CR">Costa Rica</option>
									<option value="Croacia" id="HR">Croacia</option>
									<option value="Cuba" id="CU">Cuba</option>
									<option value="Dinamarca" id="DK">Dinamarca</option>
									<option value="Djibouri" id="DJ">Djibouri</option>
									<option value="Dominica" id="DM">Dominica</option>
									<option value="Ecuador" id="EC">Ecuador</option>
									<option value="Egipto" id="EG">Egipto</option>
									<option value="El Salvador" id="SV">El Salvador</option>
									<option value="Emiratos Arabes Unidos" id="AE">Emiratos Arabes Unidos</option>
									<option value="Eritrea" id="ER">Eritrea</option>
									<option value="Eslovaquia" id="SK">Eslovaquia</option>
									<option value="Eslovenia" id="SI">Eslovenia</option>
									<option value="España" id="ES">España</option>
									<option value="Estados Unidos" id="US">Estados Unidos</option>
									<option value="Estonia" id="EE">Estonia</option>
									<option value="c" id="ET">Etiopía</option>
									<option value="Ex-República Yugoslava de Macedonia" id="MK">Ex-República Yugoslava de Macedonia</option>
									<option value="Filipinas" id="PH">Filipinas</option>
									<option value="Finlandia" id="FI">Finlandia</option>
									<option value="Francia" id="FR">Francia</option>
									<option value="Gabón" id="GA">Gabón</option>
									<option value="Gambia" id="GM">Gambia</option>
									<option value="Georgia" id="GE">Georgia</option>
									<option value="Georgia del Sur y las islas Sandwich del Sur" id="GS">Georgia del Sur y las islas Sandwich del Sur</option>
									<option value="Ghana" id="GH">Ghana</option>
									<option value="Gibraltar" id="GI">Gibraltar</option>
									<option value="Granada" id="GD">Granada</option>
									<option value="Grecia" id="GR">Grecia</option>
									<option value="Groenlandia" id="GL">Groenlandia</option>
									<option value="Guadalupe" id="GP">Guadalupe</option>
									<option value="Guam" id="GU">Guam</option>
									<option value="Guatemala" id="GT">Guatemala</option>
									<option value="Guayana" id="GY">Guayana</option>
									<option value="Guayana francesa" id="GF">Guayana francesa</option>
									<option value="Guinea" id="GN">Guinea</option>
									<option value="Guinea Ecuatorial" id="GQ">Guinea Ecuatorial</option>
									<option value="Guinea-Bissau" id="GW">Guinea-Bissau</option>
									<option value="Haití" id="HT">Haití</option>
									<option value="Holanda" id="NL">Holanda</option>
									<option value="Honduras" id="HN">Honduras</option>
									<option value="Hong Kong R. A. E" id="HK">Hong Kong R. A. E</option>
									<option value="Hungría" id="HU">Hungría</option>
									<option value="India" id="IN">India</option>
									<option value="Indonesia" id="ID">Indonesia</option>
									<option value="Irak" id="IQ">Irak</option>
									<option value="Irán" id="IR">Irán</option>
									<option value="Irlanda" id="IE">Irlanda</option>
									<option value="Isla Bouvet" id="BV">Isla Bouvet</option>
									<option value="Isla Christmas" id="CX">Isla Christmas</option>
									<option value="Isla Heard e Islas McDonald" id="HM">Isla Heard e Islas McDonald</option>
									<option value="Islandia" id="IS">Islandia</option>
									<option value="Islas Caimán" id="KY">Islas Caimán</option>
									<option value="Islas Cook" id="CK">Islas Cook</option>
									<option value="Islas de Cocos o Keeling" id="CC">Islas de Cocos o Keeling</option>
									<option value="Islas Faroe" id="FO">Islas Faroe</option>
									<option value="Islas Fiyi" id="FJ">Islas Fiyi</option>
									<option value="Islas Malvinas Islas Falkland" id="FK">Islas Malvinas Islas Falkland</option>
									<option value="Islas Marianas del norte" id="MP">Islas Marianas del norte</option>
									<option value="Islas Marshall" id="MH">Islas Marshall</option>
									<option value="Islas menores de Estados Unidos" id="UM">Islas menores de Estados Unidos</option>
									<option value="Islas Palau" id="PW">Islas Palau</option>
									<option value="Islas Salomón" d="SB">Islas Salomón</option>
									<option value="Islas Tokelau" id="TK">Islas Tokelau</option>
									<option value="Islas Turks y Caicos" id="TC">Islas Turks y Caicos</option>
									<option value="Islas Vírgenes EE.UU." id="VI">Islas Vírgenes EE.UU.</option>
									<option value="Islas Vírgenes Reino Unido" id="VG">Islas Vírgenes Reino Unido</option>
									<option value="Israel" id="IL">Israel</option>
									<option value="Italia" id="IT">Italia</option>
									<option value="Jamaica" id="JM">Jamaica</option>
									<option value="Japón" id="JP">Japón</option>
									<option value="Jordania" id="JO">Jordania</option>
									<option value="Kazajistán" id="KZ">Kazajistán</option>
									<option value="Kenia" id="KE">Kenia</option>
									<option value="Kirguizistán" id="KG">Kirguizistán</option>
									<option value="Kiribati" id="KI">Kiribati</option>
									<option value="Kuwait" id="KW">Kuwait</option>
									<option value="Laos" id="LA">Laos</option>
									<option value="Lesoto" id="LS">Lesoto</option>
									<option value="Letonia" id="LV">Letonia</option>
									<option value="Líbano" id="LB">Líbano</option>
									<option value="Liberia" id="LR">Liberia</option>
									<option value="Libia" id="LY">Libia</option>
									<option value="Liechtenstein" id="LI">Liechtenstein</option>
									<option value="Lituania" id="LT">Lituania</option>
									<option value="Luxemburgo" id="LU">Luxemburgo</option>
									<option value="Macao R. A. E" id="MO">Macao R. A. E</option>
									<option value="Madagascar" id="MG">Madagascar</option>
									<option value="Malasia" id="MY">Malasia</option>
									<option value="Malawi" id="MW">Malawi</option>
									<option value="Maldivas" id="MV">Maldivas</option>
									<option value="Malí" id="ML">Malí</option>
									<option value="Malta" id="MT">Malta</option>
									<option value="Marruecos" id="MA">Marruecos</option>
									<option value="Martinica" id="MQ">Martinica</option>
									<option value="Mauricio" id="MU">Mauricio</option>
									<option value="Mauritania" id="MR">Mauritania</option>
									<option value="Mayotte" id="YT">Mayotte</option>
									<option value="México" id="MX">México</option>
									<option value="Micronesia" id="FM">Micronesia</option>
									<option value="Moldavia" id="MD">Moldavia</option>
									<option value="Mónaco" id="MC">Mónaco</option>
									<option value="Mongolia" id="MN">Mongolia</option>
									<option value="Montserrat" id="MS">Montserrat</option>
									<option value="Mozambique" id="MZ">Mozambique</option>
									<option value="Namibia" id="NA">Namibia</option>
									<option value="Nauru" id="NR">Nauru</option>
									<option value="Nepal" id="NP">Nepal</option>
									<option value="Nicaragua" id="NI">Nicaragua</option>
									<option value="Níger" id="NE">Níger</option>
									<option value="Nigeria" id="NG">Nigeria</option>
									<option value="Niue" id="NU">Niue</option>
									<option value="Norfolk" id="NF">Norfolk</option>
									<option value="Noruega" id="NO">Noruega</option>
									<option value="Nueva Caledonia" id="NC">Nueva Caledonia</option>
									<option value="Nueva Zelanda" id="NZ">Nueva Zelanda</option>
									<option value="Omán" id="OM">Omán</option>
									<option value="Panamá" id="PA">Panamá</option>
									<option value="Papua Nueva Guinea" id="PG">Papua Nueva Guinea</option>
									<option value="Paquistán" id="PK">Paquistán</option>
									<option value="Paraguay" id="PY">Paraguay</option>
									<option value="Perú" id="PE" selected>Perú</option>
									<option value="Pitcairn" id="PN">Pitcairn</option>
									<option value="Polinesia francesa" id="PF">Polinesia francesa</option>
									<option value="Polonia" id="PL">Polonia</option>
									<option value="Portugal" id="PT">Portugal</option>
									<option value="Puerto Rico" id="PR">Puerto Rico</option>
									<option value="Qatar" id="QA">Qatar</option>
									<option value="Reino Unido" id="UK">Reino Unido</option>
									<option value="República Centroafricana" id="CF">República Centroafricana</option>
									<option value="República Checa" id="CZ">República Checa</option>
									<option value="República de Sudáfrica" id="ZA">República de Sudáfrica</option>
									<option value="República Democrática del Congo Zaire" id="CD">República Democrática del Congo Zaire</option>
									<option value="República Dominicana" id="DO">República Dominicana</option>
									<option value="Reunión" id="RE">Reunión</option>
									<option value="Ruanda" id="RW">Ruanda</option>
									<option value="Rumania" id="RO">Rumania</option>
									<option value="Rusia" id="RU">Rusia</option>
									<option value="Samoa" id="WS">Samoa</option>
									<option value="Samoa occidental" id="AS">Samoa occidental</option>
									<option value="San Kitts y Nevis" id="KN">San Kitts y Nevis</option>
									<option value="San Marino" id="SM">San Marino</option>
									<option value="San Pierre y Miquelon" id="PM">San Pierre y Miquelon</option>
									<option value="San Vicente e Islas Granadinas" id="VC">San Vicente e Islas Granadinas</option>
									<option value="Santa Helena" id="SH">Santa Helena</option>
									<option value="Santa Lucía" id="LC">Santa Lucía</option>
									<option value="Santo Tomé y Príncipe" id="ST">Santo Tomé y Príncipe</option>
									<option value="Senegal" id="SN">Senegal</option>
									<option value="Serbia y Montenegro" id="YU">Serbia y Montenegro</option>
									<option value="Sychelles" id="SC">Seychelles</option>
									<option value="Sierra Leona" id="SL">Sierra Leona</option>
									<option value="Singapur" id="SG">Singapur</option>
									<option value="Siria" id="SY">Siria</option>
									<option value="Somalia" id="SO">Somalia</option>
									<option value="Sri Lanka" id="LK">Sri Lanka</option>
									<option value="Suazilandia" id="SZ">Suazilandia</option>
									<option value="Sudán" id="SD">Sudán</option>
									<option value="Suecia" id="SE">Suecia</option>
									<option value="Suiza" id="CH">Suiza</option>
									<option value="Surinam" id="SR">Surinam</option>
									<option value="Svalbard" id="SJ">Svalbard</option>
									<option value="Tailandia" id="TH">Tailandia</option>
									<option value="Taiwán" id="TW">Taiwán</option>
									<option value="Tanzania" id="TZ">Tanzania</option>
									<option value="Tayikistán" id="TJ">Tayikistán</option>
									<option value="Territorios británicos del océano Indico" id="IO">Territorios británicos del océano Indico</option>
									<option value="Territorios franceses del sur" id="TF">Territorios franceses del sur</option>
									<option value="Timor Oriental" id="TP">Timor Oriental</option>
									<option value="Togo" id="TG">Togo</option>
									<option value="Tonga" id="TO">Tonga</option>
									<option value="Trinidad y Tobago" id="TT">Trinidad y Tobago</option>
									<option value="Túnez" id="TN">Túnez</option>
									<option value="Turkmenistán" id="TM">Turkmenistán</option>
									<option value="Turquía" id="TR">Turquía</option>
									<option value="Tuvalu" id="TV">Tuvalu</option>
									<option value="Ucrania" id="UA">Ucrania</option>
									<option value="Uganda" id="UG">Uganda</option>
									<option value="Uruguay" id="UY">Uruguay</option>
									<option value="Uzbekistán" id="UZ">Uzbekistán</option>
									<option value="Vanuatu" id="VU">Vanuatu</option>
									<option value="Venezuela" id="VE">Venezuela</option>
									<option value="Vietnam" id="VN">Vietnam</option>
									<option value="Wallis y Futuna" id="WF">Wallis y Futuna</option>
									<option value="Yemen" id="YE">Yemen</option>
									<option value="Zambia" id="ZM">Zambia</option>
									<option value="Zimbabue" id="ZW">Zimbabue</option>
								</select>
						</div>
						<div class="form-group col-12 col-md-6">
								<label for="recipient-name" class="col-form-label">Ocupación:</label>
								<select id="editar-ocupacion" class="form-control" name="ocu_cliente">
									<option value=""> - </option>
									<option value="001"> Ama de Casa </option>
									<option value="002"> Desempeado </option>
									<option value="003"> Empleado </option>
									<option value="004"> Empleador (A) </option>
									<option value="005"> Estudiante </option>
									<option value="006"> Jubilado (A)</option>
									<option value="007"> Miembro de las Fuerzas Armadas / Miembro del Clero </option>
									<option value="008"> Obrero (A) </option>
									<option value="009"> Trabajador (A) del Hogar </option>
									<option value="010"> Trabajador (A) Independiente </option>
									<option value="099"> No Declara </option>
								</select>
						</div>
						<div class="form-group">
							<label class="col-form-label">*Funcion Publica:</label>
							<select id="editar-politico" class="form-control" name="po_cliente" required>
									<option value="NO">NO</option>
									<option value="SI">SI</option>
								</select>
						</div>
					</div>
        
      </div>
	  <input id="editar-id" type="hidden" name="id_cliente" /> 
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Modificar</button>
      </div>
      </form>
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
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-users"></i> Clientes</h1>
          </div>
        
          <div class="container-fluid">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Lista de clientes</h6>
             
                <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#exampleModal">
                <span class="icon text-white-50">
                  <i class="fa fa-plus" aria-hidden="true"></i>
                </span>
                <span class="text">Nuevo Cliente</span>
                </a>
              </div>
            </div>
            <div class="card-body"> 
              <div class="table-responsive">
                <table class="table table-bordered text-center display" id="table_clientes" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#ID</th>
                      <th>Tip Doc</th>
                      <th>N°</th>
                      <th>Nombre</th>
                      <th>País</th>
                      <th>Ocupación</th>
                      <th>Funcion Pública</th>
                      <th>Modificar</th>
                      <th>Eliminar</th>
                    </tr>
                  </thead>
                  <tbody>
										<?php
											$ocupacion = array(
												'001' => 'Ama de Casa',
												'002' => 'Desempeado',
												'003' => 'Empleado',
												'004' => 'Empleador (A)',
												'005' => 'Estudiante',
												'006' => 'Jubilado (A)',
												'007' => 'Miembro de las Fuerzas Armadas / Miembro del Clero',
												'008' => 'Obrero (A)',
												'009' => 'Trabajador (A) del Hogar',
												'010' => 'Trabajador (A) Independiente',
												'099' => 'No Declara',
											);
										?>
                    <?php foreach ($clientes as $key) : ?>
                    <form class="enviar" action="" method="POST">
                    <tr>
                      <td><?= $key->id_cliente; ?></td>
                      <td><?= $key->doc_cliente; ?></td>
                      <td><?= $key->n_cliente; ?></td>
                      <td><?= $key->nom_cliente; ?></td>
                      <td><?= $key->pais_cliente; ?></td>
                      <td><?= $ocupacion[$key->ocu_cliente]; ?></td>
                      <td><?= $key->po_cliente; ?></td>
					  <td>
                        <button onclick="showEditar(
								'<?= $key->id_cliente; ?>',
								'<?= $key->doc_cliente; ?>',
								'<?= $key->n_cliente; ?>',
								'<?= $key->nom_cliente; ?>',
								'<?= $key->pais_cliente; ?>',
								'<?= $key->ocu_cliente; ?>',
								'<?= $key->po_cliente; ?>',
							);" id="editar" type="button" class="btn btn-warning"><i class="fa fa-address-book" aria-hidden="true"></i></button></td>
                      <td>
                        <button onclick="enviar('<?= $key->id_cliente; ?>');" id="eliminar" type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                    </tr>
                    </form>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

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

        function enviar(id){
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
                          location.href="Clientes/delete/" + id;
                          //form.submit();
                      }
                    });
                  }
            });
        }  

		function showEditar(id, doc, number, nombre, pais, ocupacion, politico){
			Array.from(document.getElementById('editar-documento')).forEach( n => {
				( n.innerText == doc) ? n.setAttribute('selected', true) : n.removeAttribute('selected');
			})
			
			document.getElementById('editar-number').value = number;
			document.getElementById('editar-nombre').value = nombre;
			document.getElementById('editar-id').value = id;

			Array.from(document.getElementById('editar-pais')).forEach( n => {
				( n.innerText == pais) ? n.setAttribute('selected', true) : n.removeAttribute('selected');
			})

			Array.from(document.getElementById('editar-ocupacion')).forEach( n => {
				( n.value == ocupacion) ? n.setAttribute('selected', true) : n.removeAttribute('selected');
			})

			Array.from(document.getElementById('editar-politico')).forEach( n => {
				( n.innerText == politico) ? n.setAttribute('selected', true) : n.removeAttribute('selected');
			})

			$('#editarModal').modal();
		}
      </script>
<?= $footer; ?>
