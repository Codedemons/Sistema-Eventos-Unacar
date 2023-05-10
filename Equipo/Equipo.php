<?php
  include("../config/database.php");
  
  session_start();// Iniciando Sesion
  // Guardando la sesion
  $user_check=$_SESSION['login_user_sys'];
  
  $link = Conecta_DB_project();
  // SQL Query para completar la informacion del usuario
  $consulta = "select matriculaUsuario,emailUsuario from usuario where emailUsuario='$user_check'";
  $sql=mysqli_query($link,$consulta);
  
  $rowy = mysqli_fetch_assoc($sql);
  $login_session =$rowy['emailUsuario'];
  
  
  if(!isset($login_session)){
      mysqli_close($link); // Cerrando la conexion
      header('Location: ../index.php'); // Redirecciona a la pagina de inicio
  }
  error_reporting(0);



 $idJefeCreador =$rowy['matriculaUsuario'];


  $verIntegrantes = !empty($_GET['idEquipo']) ? $_GET['idEquipo'] : '';

 $queryMisEquipos = "SELECT idEquipo, nombreEquipo, nombreEvento,descripcionEvento FROM equipo JOIN evento ON evento.idEvento = equipo.idEvento WHERE idJefeCreador ='$idJefeCreador';";
 $resultMisEquipos = mysqli_query(Conecta_DB_project(), $queryMisEquipos);

 $queryIntegrantesEquipo= "SELECT * FROM `usuario` JOIN equipo_usuario ON equipo_usuario.matriculaUsuario = usuario.matriculaUsuario WHERE idEquipo = '$verIntegrantes'"; 
 $resultIntegrantesEquipo = mysqli_query(Conecta_DB_project(), $queryIntegrantesEquipo);


 

 if(!isset($_GET['editarDatos'])){ 
      $codigo = $_GET['matriculaUsuario'];
      


      $queryDatos = "SELECT * FROM usuario WHERE matriculaUsuario = '$codigo'";
      $resultDAtos = mysqli_query(Conecta_DB_project(), $queryDatos);



      if(mysqli_num_rows($resultDAtos) == 1){
          $rowDatos = mysqli_fetch_array($resultDAtos);

          $matricula = $rowDatos['matriculaUsuario'];
          $nombre = $rowDatos['nombreUsuario'];
          $apellido = $rowDatos['apellidoUsuario'];
          $facultad = $rowDatos['facultadUsuario'];
          $email = $rowDatos['emailUsuario'];
          $telefono = $rowDatos['telefonoUsuario'];
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
   require "Complements/Menu.php";
  ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Equipo</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Equipo</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Equipo</h6>
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
              <a href="#Equipo" class="nav-link text-body font-weight-bold px-0">
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
            <form method="post" name="form" action="../config/CrudIntegrante.php">
              <div class="card mt-4">
                <div class="card-header pb-0 p-3">
                  <div class="row">
                    <div class="col-6 d-flex align-items-center">
                      <h6 class="mb-0">REGISTRO</h6>
                    </div>
                    <div class="col-6 text-end">                        
                      <a href="../equipo/equipo.php" class="btn bg-gradient-dark mb-0 text-sm material-icons opacity-10">autorenew</a>                      
                      <input type="submit" class="btn bg-gradient-dark mb-0 text-sm material-icons opacity-10" name="send" value="edit">                      
                      <input type="submit" class="btn bg-gradient-dark mb-0 text-sm material-icons opacity-10" name="update" value="add" >                      
                      
                    </div>
                  </div>
                </div>
              
                <div class="card-body p-3">
                  <div class="row">
                    <div class="col-md-6 mb-md-0 mb-4">                                            
                      <div class="input-group input-group-outline mb-3 card  border card-plain border-radius-lg d-flex align-items-center flex-row">
                      <label class="form-label">Matricula</label>
                      <input type="text" class="form-control card card-body border card-plain border-radius-lg d-flex align-items-center cursor-pointer flex-row"" name="Matricula" value="<?php echo $rowDatos['matriculaUsuario'] ?>" requiered>
                    </div>

                    </div>
                    <div class="col-md-6">
                    <div class="input-group input-group-outline mb-3 card  border card-plain border-radius-lg d-flex align-items-center flex-row">
                      <label class="form-label">Correo</label>
                      <input type="email" class="form-control card card-body border card-plain border-radius-lg d-flex align-items-center cursor-pointer flex-row""  name="Correo"  value="<?php echo $rowDatos['emailUsuario'] ?>" required>
                    </div>  

                    </div>
                    <div class="col-md-6 mb-md-0 mb-6">
                    <div class="input-group input-group-outline mb-3 card  border card-plain border-radius-lg d-flex align-items-center flex-row">
                      <label class="form-label">Nombre</label>
                      <input type="text" class="form-control card card-body border card-plain border-radius-lg d-flex align-items-center cursor-pointer flex-row"" name="Nombre"  value="<?php echo $rowDatos['nombreUsuario'] ?>" required>
                    </div>

                    </div>
                    <div class="col-md-6 mb-md-0 mb-6">
                    <div class="input-group input-group-outline mb-3 card  border card-plain border-radius-lg d-flex align-items-center flex-row">
                      <label class="form-label">Facultad</label>
                      <input type="text" class="form-control card card-body border card-plain border-radius-lg d-flex align-items-center cursor-pointer flex-row"" name="Facultad"  value="<?php echo $rowDatos['facultadUsuario'] ?>" required>
                    </div>

                    </div>
                    <div class="col-md-6 mb-md-0 mb-6">
                    <div class="input-group input-group-outline mb-3 card  border card-plain border-radius-lg d-flex align-items-center flex-row">
                      <label class="form-label">Apellido</label>
                      <input type="text" class="form-control card card-body border card-plain border-radius-lg d-flex align-items-center cursor-pointer flex-row"" name="Apellido"  value="<?php echo $rowDatos['apellidoUsuario'] ?>" required>
                    </div>


                    </div>
                    <div class="col-md-6 mb-md-0 mb-6">
                    <div class="input-group input-group-outline mb-3 card  border card-plain border-radius-lg d-flex align-items-center flex-row">
                      <label class="form-label">Teléfono</label>
                      <input type="num" class="form-control card card-body border card-plain border-radius-lg d-flex align-items-center cursor-pointer flex-row"" name="Telefono"  value="<?php echo $rowDatos['telefonoUsuario'] ?>" required>
                    </div>

                    </div>     
                    <div class="col-md-6">
                      <div class="input-group input-group-outline mb-3 card  border card-plain border-radius-lg d-flex align-items-center flex-row">                      
                        <select name="equipo" class="form-control" id="equipo">
                        <option value="">MIS EQUIPOS</option>

                       <?php
                       $queryEquipo = "SELECT idEquipo,nombreEquipo FROM evento JOIN equipo ON equipo.idEvento = evento.idEvento WHERE idJefeCreador= '$idJefeCreador'";
                        $resultEquipo = mysqli_query(Conecta_DB_project(), $queryEquipo);
                        while($rowsEquipo = mysqli_fetch_assoc($resultEquipo)){
                      ?>

                       ?>
                        <option value="<?php echo $rowsEquipo["idEquipo"]; ?>"><?php echo $rowsEquipo["nombreEquipo"] ?></option>
                      <?php } ?>
                      </select>
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
          
        </div>
      </div>

      <div class="col-md-6 mt-4">
          <div class="card">
            <div class="card-header pb-0 px-3">
              <h6 class="mb-0">MIS EQUIPOS</h6>
            </div>
            <div class="card-body pt-4 p-3">
              <table id="tabla" class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">EQUIPO</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">EVENTO</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">    Ver integrantes</th>
                    </tr>
                  </thead>
                  <tbody>

                  <?php
                      foreach ($resultMisEquipos as $rowMisEquipos) {
                  ?>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">                          
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?php echo $rowMisEquipos['nombreEquipo']; ?></h6>                          
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php echo $rowMisEquipos['nombreEvento']; ?></p>                        
                      </td>
                      
                      <td class="align-middle text-center">
                      <a class="btn btn-link text-danger text-gradient px-3 mb-0" name="ver"  href="../equipo/equipo.php?idEquipo=<?php echo $rowMisEquipos['idEquipo']?>"><i class="material-icons text-sm me-2">search</i>VER</a>
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

        <div class="col-md-6 mt-4">
          <div class="card">
            <div class="card-header pb-0 px-3">
              <h6 class="mb-0">INTEGRANTES</h6>
            </div>
            <div class="card-body pt-4 p-3">
              <ul class="list-group">
                <?php
                  foreach ($resultIntegrantesEquipo as $rowIntegrantesEquipo) {
                ?>
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">

                    <span class="mb-2 text-xs">MATRICULA: <span class="text-dark ms-sm-2 font-weight-bold"><?php echo $rowIntegrantesEquipo['matriculaUsuario']; ?></span></span>
                    <span class="mb-2 text-xs">NOMBRE: <span class="text-dark ms-sm-2 font-weight-bold"><?php echo $rowIntegrantesEquipo['nombreUsuario']; ?></span></span>
                    <span class="mb-2 text-xs">APELLIDO: <span class="text-dark ms-sm-2 font-weight-bold"><?php echo $rowIntegrantesEquipo['apellidoUsuario']; ?></span></span>
                    <span class="mb-2 text-xs">FACULTAD: <span class="text-dark ms-sm-2 font-weight-bold"><?php echo $rowIntegrantesEquipo['facultadUsuario']; ?></span></span>
                    <span class="mb-2 text-xs">CORREO: <span class="text-dark ms-sm-2 font-weight-bold"><?php echo $rowIntegrantesEquipo['emailUsuario']; ?></span></span>
                    <span class="mb-2 text-xs">TELÉFONO: <span class="text-dark ms-sm-2 font-weight-bold"><?php echo $rowIntegrantesEquipo['telefonoUsuario']; ?></span></span>
                  </div>
                  <div class="ms-auto text-end">
                  <a class="btn btn-link text-dark px-3 mb-0" id="editarDatos" href="../equipo/equipo.php?matriculaUsuario=<?php echo $rowIntegrantesEquipo['matriculaUsuario']?>"><i class="material-icons text-sm me-2">edit</i>Editar</a>
                    
                  </div>
                </li>
                <?php } ?>
              </ul>
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
  <script src="../assets/js/core/popper.min.js"></script>  
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <script>
    var ctx = document.getElementById("chart-bars").getContext("2d");

    new Chart(ctx, {
      type: "bar",
      data: {
        labels: ["M", "T", "W", "T", "F", "S", "S"],
        datasets: [{
          label: "Sales",
          tension: 0.4,
          borderWidth: 0,
          borderRadius: 4,
          borderSkipped: false,
          backgroundColor: "rgba(255, 255, 255, .8)",
          data: [50, 20, 10, 22, 50, 10, 40],
          maxBarThickness: 6
        }, ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: 'rgba(255, 255, 255, .2)'
            },
            ticks: {
              suggestedMin: 0,
              suggestedMax: 500,
              beginAtZero: true,
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
              color: "#fff"
            },
          },
          x: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: 'rgba(255, 255, 255, .2)'
            },
            ticks: {
              display: true,
              color: '#f8f9fa',
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });


    var ctx2 = document.getElementById("chart-line").getContext("2d");

    new Chart(ctx2, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Mobile apps",
          tension: 0,
          borderWidth: 0,
          pointRadius: 5,
          pointBackgroundColor: "rgba(255, 255, 255, .8)",
          pointBorderColor: "transparent",
          borderColor: "rgba(255, 255, 255, .8)",
          borderColor: "rgba(255, 255, 255, .8)",
          borderWidth: 4,
          backgroundColor: "transparent",
          fill: true,
          data: [50, 40, 300, 320, 500, 350, 200, 230, 500],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: 'rgba(255, 255, 255, .2)'
            },
            ticks: {
              display: true,
              color: '#f8f9fa',
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#f8f9fa',
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });

    var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");

    new Chart(ctx3, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Mobile apps",
          tension: 0,
          borderWidth: 0,
          pointRadius: 5,
          pointBackgroundColor: "rgba(255, 255, 255, .8)",
          pointBorderColor: "transparent",
          borderColor: "rgba(255, 255, 255, .8)",
          borderWidth: 4,
          backgroundColor: "transparent",
          fill: true,
          data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: 'rgba(255, 255, 255, .2)'
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#f8f9fa',
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#f8f9fa',
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
  </script>
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