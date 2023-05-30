<?php
include("../config/database.php");
session_start();// Iniciando Sesion
// Guardando la sesion
$user_check=$_SESSION['login_user_sys'];

$link = Conecta_DB_project();
// SQL Query para completar la informacion del usuario
$consulta = "select emailUsuario from usuario where emailUsuario='$user_check'";
$sql=mysqli_query($link,$consulta);

$row = mysqli_fetch_assoc($sql);
$login_session =$row['emailUsuario'];


if(!isset($login_session)){
    mysqli_close($link); // Cerrando la conexion
    header('Location: ../index.php'); // Redirecciona a la pagina de inicio
}

$queryGeneral = "CALL SP_OBTENER_DATOS_USUARIO('$login_session');";
$resultGeneral = mysqli_query($link, $queryGeneral);

if(mysqli_num_rows($resultGeneral) == 1){
  $row = mysqli_fetch_array($resultGeneral);
  
  $Clave =  $row['matriculaUsuario'];
  $Nombre =  $row['nombreUsuario'];
  $Apellido =  $row['apellidoUsuario'];
  $Facultad =  $row['facultadUsuario'];
  $Email =  $row['emailUsuario'];
  $Telefono =  $row['telefonoUsuario'];
  $Rol = $row['nombreRol'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.ico">
  <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
  <title>
    Unacar Eventos
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-200">
   <?php 
      require "Complements/Menu.php";
   ?>  

  <div class="main-content position-relative max-height-vh-100 h-100">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Juez</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Perfil</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Perfil</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline">
              
            </div>
          </div>
          <ul class="navbar-nav  justify-content-end">            
            <li class="nav-item d-flex align-items-center">
              <a href="#Juez" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none"><?php echo $login_session; ?></span>
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>            
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid px-2 px-md-4">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/CTI.png');">
        <span class="mask  bg-gradient-primary  opacity-6"></span>
      </div>
      <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="row gx-4 mb-2">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="../assets/img/bruce-mars.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
              <?php echo $Nombre . " " . $Apellido?>
              </h5>
              <p class="mb-0 font-weight-normal text-sm">
              <?php echo $Rol ?>
              </p>
            </div>
          </div>          
        </div>
        <div class="row">          
            
            <div class="col-12 col-xl-12">
              <div class="card card-plain h-100">
                
                <div class="card-body p-3">                  
                  
                  <ul class="list-group">
                  <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Codigo:</strong> &nbsp; <?php echo $Clave ?></li>
                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Nombre:</strong> &nbsp; <?php echo $Nombre ." " . $Apellido ?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Numero:</strong> &nbsp; <?php echo $Telefono ?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Correo:</strong> &nbsp;<?php echo $Email ?> </li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Facultad:</strong> &nbsp; <?php echo $Facultad ?> </li>
                  </ul>
                </div>
              </div>
            </div>
            
            
          </div>
        </div>
      </div>
    </div>    
  </div>
  <?php
    require "Complements/Config.php";
  ?>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
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
  <script src="../assets/js/material-dashboard.min.js?v=3.0.4"></script>
</body>

</html>