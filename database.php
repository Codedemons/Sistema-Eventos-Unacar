<?php
 // Dirección o IP del servidor MySQL
 $host = "localhost";
 // Puerto del servidor MySQL
 $puerto = "3306";
 // Nombre de usuario del servidor MySQL
 $usuario = "root";
 // Contraseña del usuario
 $contrasena = "";
 // Nombre de la base de datos
 $baseDeDatos ="eventofci";

 // Nombre de la tabla a trabajar
// $tabla = "empleado";

 function Conecta_DB_project()
 {
    global $host, $puerto, $usuario, $contrasena, $baseDeDatos;

    if (!($link = mysqli_connect($host.":".$puerto, $usuario, $contrasena))) 
      { 
          echo "Error conectando a la base de datos.<br>"; 
         exit(); 
      }
    else
    {
       //echo "Listo, estamos conectados.<br>";
    }
    if (!mysqli_select_db($link, $baseDeDatos)) 
    { 
       echo "Error seleccionando la base de datos.<br>"; 
       exit(); 
    }
    else
    {
       //echo "Obtuvimos la base de datos $baseDeDatos sin problema.<br>";
    }
 return $link; 
 } 

// $link = Conecta_DB_proyecto();

// mysqli_close($link);

Conecta_DB_project();
?>
