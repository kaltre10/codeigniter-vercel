<?= $header ?>
    <div class="container">
      <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
          <div class="text-center">
            <a href="#"><h1>EXCHANGE</h1></a>
          </div> 
          <div class="card card-signin my-5 shadow mb-1 bg-white">
            <div class="card-body">
            	<nav aria-label="breadcrumb">
      				  <ol class="breadcrumb">
      				    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
      				  </ol>
      				</nav>
              <h5 class="card-title text-center my-4">Iniciar Sesión</h5>
              <form id="form_login" class="form-signin" action="Login/validate" method="POST">
                <div id="html_element"></div>
                <div class="form-label-group" id="email">
                  <label>Dirección de correo electrónico</label>
                  <input type="text" name="email" class="form-control" placeholder="" autocomplete="off" autofocus>
                  <div class="invalid-feedback"></div>
                </div>
                <div class="form-label-group" id="password">
                  <label>Contraseña</label>
                  <input type="password" name="password" class="form-control" placeholder="" autocomplete="off">
                  <div class="invalid-feedback"></div>
                </div>
                <br />
                <div class="form-group">
                  <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Ingresar</button>
                </div>
                <div class="form-group" id="alert">
      
                </div>
                <hr class="my-4">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    
<?= $footer ?>
