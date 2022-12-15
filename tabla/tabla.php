<div class="row">
  <div class="col-12">
    <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Clasificacion</h6>
              </div>
            </div>

                <?php 
                      
                $queryGeneral = "SELECT * from evento where statusEvento = 'ACTIVO'";
                $resultGeneral = mysqli_query(Conecta_DB_project(), $queryGeneral);
                

 

                $queryGeneral = "SELECT * from evento where statusEvento = 'ACTIVO'";
                $resultGeneral = mysqli_query(Conecta_DB_project(), $queryGeneral);
                
                //SELECT * FROM evento 
                $queryGen = "SELECT * FROM evento INNER JOIN equipo ON evento.idEvento = equipo.idEvento where statusEvento = 'ACTIVO'";
                $resultGen = mysqli_query(Conecta_DB_project(), $queryGeneral);

                foreach ($resultGeneral as $rowGeneral) {
                  
                //for ($i = 0; $i < intval($cant); $i++) {
                  $i = 0; 
                  
                   echo '
                                <div class="card-body px-0 pb-2">
                                <div class="table-responsive p-0">
                                <h6 class="text-centes text-capitalize ps-3"> ';  echo $rowGeneral['nombreEvento'] .' </h6>
                                  <table class="table align-items-center mb-0">
                                    <thead>
                                      <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Equipos</th>
                                  
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Calificacion</th>
                                        
                                        
                                      </tr>
                                    </thead>
                                    <tbody> 
                                    '; 
                                  $codigo = $rowGeneral['idEvento'];
                                  $queryGen = "SELECT * FROM evento INNER JOIN equipo ON evento.idEvento = equipo.idEvento where statusEvento = 'ACTIVO' and  evento.idEvento = '$codigo' ";
                                  $resultGen = mysqli_query(Conecta_DB_project(), $queryGen);

                                  
                                  foreach ($resultGen as $rowGen) {
                                    $cod = $rowGen['idEquipo'];
                                    //$queryGens = "SELECT avg(calificaciones.calificacion) as prom FROM (((calificaciones INNER JOIN parametro ON calificaciones.idParametro = parametro.idParametro) INNER JOIN equipo ON calificaciones.idEquipo = equipo.idEquipo)INNER JOIN evento ON calificaciones.idEvento = evento.idEvento ) where statusEvento = 'ACTIVO' and evento.idEvento = '115' and equipo.idEquipo = 'E02'";
                                    
                                    $que = "SELECT avg(calificaciones.calificacion) as prom FROM (((calificaciones INNER JOIN parametro ON calificaciones.idParametro = parametro.idParametro) INNER JOIN equipo ON calificaciones.idEquipo = equipo.idEquipo)INNER JOIN evento ON calificaciones.idEvento = evento.idEvento ) where statusEvento = 'ACTIVO' and evento.idEvento = '$codigo' and equipo.idEquipo = '$cod'";                                    
                                     
                                     $resul = mysqli_query(Conecta_DB_project(), $que); 
                                     
                                     if(mysqli_num_rows($resul) == 1){
                                       $rowi = mysqli_fetch_array($resul);                                       
                                       
                                     }

                                    $i++;
                                    echo '
                                      <tr>                                        
                                        <td>
                                          <div class="d-flex px-2 py-1">
                                            <div>
                                            <h6 class="mb-0 text-sm">';  echo $i . ".- ".'</h6>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                              <h6 class="mb-0 text-sm">';  echo $rowGen['nombreEquipo'] .'</h6>                            
                                            </div>
                                          </div>
                                        </td>
                                        
                                        <td class="align-middle text-center text-sm">
                                              <h6 class="mb-0 text-sm">';  echo $rowi['prom'] .'</h6>
                                        </td>                      
                                      </tr> 
                                    ';  
                                   }
                                    
                                    echo '
                                    </tbody>
                                  </table>
                                </div>
                              </div>';
                        //}
                     }  ?>                   
    </div>
  </div>
</div>