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

  error_reporting(0);
  

  $queryGeneral = "SELECT * from parametro ";
  $resultGeneral = mysqli_query(Conecta_DB_project(), $queryGeneral);

  if(isset($_GET['idParametro'])){ 
    $codigo = $_GET['idParametro'];
    
    $querys = "SELECT * FROM parametro WHERE idParametro = '$codigo'";
    $results = mysqli_query(Conecta_DB_project(), $querys);

    if(mysqli_num_rows($results) == 1){
        $row = mysqli_fetch_array($results);

        $codigo = $row['idParametro'];
        $nombre = $row['nombreParametro'];
        $caracteristica = $row['caracteristicaParametro'];
    }
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

<body class="g-sidenav-show  bg-gray-200">
  <?php 
    require 'Complements/Menu.php';
  ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Rubricas</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Rubricas<h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline">            
              <label class="form-label">Buscar</label>
              <input type="text" id="buscar" class="form-control">            
            </div>
          </div>
          <ul class="navbar-nav  justify-content-end">            
            <li class="nav-item d-flex align-items-center">
              <a href="#Admin" class="nav-link text-body font-weight-bold px-0">
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

    

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-lg-8">
          <div class="row">
            <div class="col-md-12 mb-lg-0 mb-4">
            <form method="post" name="form" action="../config/crudParametro.php">
              <div class="card mt-4">
                <div class="card-header pb-0 p-3">
                  <div class="row">
                    <div class="col-6 d-flex align-items-center">
                      <h6 class="mb-0">Rúbricas</h6>
                    </div>
                    <div class="col-6 text-end">                        
                      <a href="../admin/Rubrica.php" class="btn bg-gradient-dark mb-0 material-icons opacity-10">autorenew</a>                      
                      <input type="submit" class="btn bg-gradient-dark mb-0 material-icons opacity-10" name="send" value="edit">                      
                      <input type="submit" class="btn bg-gradient-dark mb-0 material-icons opacity-10" name="update" value="add" >                      
                      
                    </div>
                  </div>
                </div>
              
                <div class="card-body p-3">
                  <div class="row">
                    <div class="col-md-6 mb-md-0 mb-4">                                            
                      <div class="input-group input-group-outline mb-3 card  border card-plain border-radius-lg d-flex align-items-center flex-row">
                      <label class="form-label">Codigo</label>
                      <input type="text" class="form-control card card-body border card-plain border-radius-lg d-flex align-items-center cursor-pointer flex-row"" name="Codigo" value="<?php echo $row['idParametro'] ?>" readonly>
                    </div>

                    </div>
                    <div class="col-md-6">
                    <div class="input-group input-group-outline mb-3 card  border card-plain border-radius-lg d-flex align-items-center flex-row">
                      <label class="form-label">Nombre</label>
                      <input type="text" class="form-control card card-body border card-plain border-radius-lg d-flex align-items-center cursor-pointer flex-row""  name="Nombre"  value="<?php echo $row['nombreParametro'] ?>" required>
                    </div>  

                    </div>
                    <div class="col-md-6 mb-md-0 mb-6">
                    <div class="input-group input-group-outline mb-3 card  border card-plain border-radius-lg d-flex align-items-center flex-row">
                      <label class="form-label">Caracteristica</label>
                      <input type="text" class="form-control card card-body border card-plain border-radius-lg d-flex align-items-center cursor-pointer flex-row"" name="Caracteristica"  value="<?php echo $row['caracteristicaParametro'] ?>" required>
                    </div>  
                  </div>
                </div>

              </form>
              </div>
            </div>
          </div>
        </div>
        
      </div>
      <br>
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Rúbricas</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table id="tabla" class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Codigo</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nombre</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Caracteristica</th>                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Editar</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Eliminar</th>                      
                    </tr>
                  </thead>
                  <tbody>

                  <?php
                      foreach ($resultGeneral as $rowGeneral) {
                  ?>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">                          
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?php echo $rowGeneral['idParametro']; ?></h6>                          
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php echo $rowGeneral['nombreParametro']; ?></p>                        
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php echo $rowGeneral['caracteristicaParametro']; ?></p>                        
                      </td>

                      <td class="align-middle text-center">
                        <a class="btn btn-link text-dark px-3 mb-0" href="Rubrica.php?idParametro=<?php echo $rowGeneral['idParametro']?>"><i class="material-icons me-2">edit</i></a>
                      </td>
                      <td class="align-middle text-center">
                      <a class="btn btn-link text-danger text-gradient px-3 mb-0" name=""  href="../config/crudParametro.php?idParametro=<?php echo $rowGeneral['idParametro']?>"><i class="material-icons me-2">delete</i></a>
                      </td>
                    </tr>
                  <?php
                    }
                  ?>  
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <footer class="footer py-4  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                Hecho en
                <a href="https://www.unacar.mx/" class="font-weight-bold" target="_blank">Eventos Unacar</a>
                Para la web.
              </div>
            </div>            
          </div>
        </div>
      </footer>
    </div>
  </main>
  <?php
    require "Complements/Config.php";
  ?>
  <!--   Core JS Files   -->
  <script src="../assets/js/tabla.js"></script>
  <script src="../assets/js/estado.js"></script>
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
