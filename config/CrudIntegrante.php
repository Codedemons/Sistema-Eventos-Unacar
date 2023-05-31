<?php
    error_reporting(0);
    
    if (!isset($_POST['send'])){
        $codigo = !empty($_POST['Matricula']) ? $_POST['Matricula'] : '';
        $name = !empty($_POST['Nombre']) ? $_POST['Nombre'] : '';
        $name2 = !empty($_POST['Apellido']) ? $_POST['Apellido'] : '';
        $proviene= !empty($_POST['Facultad']) ? $_POST['Facultad'] : '';
        $email = !empty($_POST['Correo']) ? $_POST['Correo'] : '';
        $phone = !empty($_POST['Telefono']) ? $_POST['Telefono'] : '';
        $rol = !empty($_POST['Rol']) ? $_POST['Rol'] : '';
        $equipo = !empty($_POST['equipo']) ? $_POST['equipo'] : '';

        
            include 'database.php';
            $link = Conecta_DB_project();
            $query = "INSERT INTO  usuario (matriculaUsuario, idRol, nombreUsuario, apellidoUsuario, facultadUsuario, emailUsuario, Pass, telefonoUsuario) VALUES ('$codigo','R03','$name','$name2','$proviene','$email','0','$phone')";


            echo $query;
            
            $result = mysqli_query(Conecta_DB_project(), $query);
            
            $queryPertenencia = "INSERT INTO equipo_usuario(idEquipo, matriculaUsuario) VALUES ('$equipo','$codigo')";
             $resultPertenencia = mysqli_query(Conecta_DB_project(), $queryPertenencia);
            echo $queryPertenencia;

            echo "<script> alert('Los datos se han insertado de manera correcta');window.location.href='../equipo/Equipo.php';</script>";


                
            if(!mysqli_query($link,$consulta)){
                die('No se pudo agregar el registro');
            }
        
    }


       
    if (!isset($_POST['update'])){
        $codigo = !empty($_POST['Matricula']) ? $_POST['Matricula'] : '';
        $name = !empty($_POST['Nombre']) ? $_POST['Nombre'] : '';
        $name2 = !empty($_POST['Apellido']) ? $_POST['Apellido'] : '';
        $proviene= !empty($_POST['Facultad']) ? $_POST['Facultad'] : '';
        $email = !empty($_POST['Correo']) ? $_POST['Correo'] : '';
        $phone = !empty($_POST['Telefono']) ? $_POST['Telefono'] : '';
        $rol = !empty($_POST['Rol']) ? $_POST['Rol'] : '';
        $equipo = !empty($_POST['equipo']) ? $_POST['equipo'] : '';

       
            include 'database.php';
            $link = Conecta_DB_project();
            $query = "UPDATE usuario SET matriculaUsuario = '$codigo', nombreUsuario = '$name', apellidoUsuario = '$name2' , facultadUsuario = '$proviene' , emailUsuario = '$email', telefonoUsuario = '$phone' WHERE matriculaUsuario = '$codigo'";
            $result = mysqli_query(Conecta_DB_project(), $query);
            echo "<script> alert('Los datos se han modificado de manera correcta');window.location.href='../equipo/equipo.php';</script>";
                
            if(!mysqli_query($link,$consulta)){
                die('No se pudo modificar el registro');
            }
    }
    

   /* if (isset($_POST['delete'])){                    
            include 'database.php';
            $link = Conecta_DB_project();
            $codigo = !empty($_POST['Matricula']) ? $_POST['Matricula'] : '';         

            $query = "DELETE FROM usuario WHERE matriculaUsuario = '$codigo'";        
            $result = mysqli_query(Conecta_DB_project(), $query);        
        
            if(mysqli_query($link,$consulta)){
               echo "<script> alert('Los datos se han eliminado de manera correcta');window.location.href='../equipo/equipo.php';</script>";
               echo $codigo;
            }else{
                die('No se pudo modificar el registro');
            }
    }*/

?>
