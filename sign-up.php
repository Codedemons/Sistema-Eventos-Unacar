<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.ico">
  <link rel="icon" type="image/png" href="assets/img/favicon.ico">
  <title>
    Unacar Eventos
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
</head>

<body class="">  
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-7 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('assets/img/edificios.jpeg'); background-size: cover;">
              <span class="mask bg-gradient-dark opacity-4 border-radius-lg"></span>
              </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-0">
              <div class="card card-plain">
                <div class="card-header">
                  <h4 class="font-weight-bolder">Registro</h4>
                  <p class="mb-0">Rellena los siguientes datos</p>
                </div>
                <div class="card-body">
                 <form method="post" name="form" action="config/crudRegistro.php">
                    <div class="input-group input-group-outline mb-2">
                      <label class="form-label">Matricula</label>
                      <input type="number" class="form-control" name="CodigoUser" required>
                    </div>
                    <div class="input-group input-group-outline mb-2">
                      <label class="form-label">Nombre</label>
                      <input type="text" class="form-control" name="NombreUser" required>
                      
                    </div>
                    <div class="input-group input-group-outline mb-2">
                      <label class="form-label">Apellido</label>
                      <input type="text" class="form-control" name="ApellidoUser" required>
                    </div>
                    <div class="input-group input-group-outline mb-2">
                      <label class="form-label">Contreseña</label>
                      <input type="password" class="form-control" name="ClaveUser" required>
                    </div>
                    <div class="input-group input-group-outline mb-2">
                      <label class="form-label">Facultad</label>
                      <input type="text" class="form-control" name="FacultadUser" required>
                    </div>
                    <div class="input-group input-group-outline mb-2">                                            
                      <select class="form-control" name="RolUser">
                     
                      <option value="R01" >Juez</option>
                      <option value="R02" >Capitan de equipo</option>
                    </select>
                    </div>                    
                    <div class="input-group input-group-outline mb-2">
                      <label class="form-label">Telefono</label>
                      <input type="tel" class="form-control" name="TelefonoUser" required>
                    </div>
                    <div class="input-group input-group-outline mb-2">
                      <label class="form-label">Correo</label>
                      <input type="email" class="form-control" name="CorreoUser" required>
                    </div>
                    <div class="form-check form-check-info text-start ps-0">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                      <label class="form-check-label" for="flexCheckDefault">
                        Aceptas los<a href="javascript:;" class="text-dark font-weight-bolder">Terminos y condiciones</a>
                      </label>
                    </div>
                    <div class="text-center">
                      <input type="submit" class="btn bg-gradient-dark mb-0 text-sm " value="&nbsp;&nbsp; Registrar ">    
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-2 text-sm mx-auto">
                    Ya tienes una cuenta?
                    <a href="sign-in.php" class="text-primary text-gradient font-weight-bold">Acceder</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!--   Core JS Files   -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.min.js?v=3.0.4"></script>
</body>

</html>