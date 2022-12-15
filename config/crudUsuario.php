<?php
    error_reporting(0);
    
    if (!isset($_POST['send'])){
        $matricula = !empty($_POST['Matricula']) ? $_POST['Matricula'] : '';
        $rol = !empty($_POST['Rol']) ? $_POST['Rol'] : '';
        $nombre = !empty(strtoupper($_POST['Nombre'])) ? strtoupper($_POST['Nombre']) : '';
        $apellido = !empty(strtoupper($_POST['Apellido'])) ? strtoupper($_POST['Apellido']) : '';
        $facultad = !empty(strtoupper($_POST['Facultad'])) ? strtoupper($_POST['Facultad']) : '';
        $email = !empty(strtoupper($_POST['Correo'])) ? strtoupper($_POST['Correo']) : '';
        $pass = !empty($_POST['Contrasena']) ? $_POST['Contrasena'] : '';
        $telefono = !empty($_POST['Telefono']) ? $_POST['Telefono'] : '';

        if($matricula&&$rol&&$nombre&&$apellido&&$facultad&&$email&&$pass&&$telefono){
            include 'database.php';
            $link = Conecta_DB_project();
            $query = "INSERT INTO usuario (matriculaUsuario, idRol, nombreUsuario, apellidoUsuario, facultadUsuario, emailUsuario, Pass, telefonoUsuario) 
                VALUES ('$matricula', '$rol', '$nombre', '$apellido', '$facultad', '$email', '$pass', '$telefono')";
            $result = mysqli_query(Conecta_DB_project(), $query);

            if($rol == 'R03'){
                $queryJuez = "INSERT INTO juez (idJuez, nombreJuez, apellidoJuez, facultadJuez) 
                    VALUES ('$matricula', '$nombre', '$apellido', '$facultad')";
                $result = mysqli_query(Conecta_DB_project(), $queryJuez);
            }

            echo "<script> alert('Los datos se han insertado de manera correcta');window.location.href='../admin/Usuarios.php';</script>";
                
            if(!mysqli_query($link,$consulta)){
                die('No se pudo agregar el registro');
            }
        }
    }

    if (!isset($_POST['update'])){
        $matricula = !empty($_POST['Matricula']) ? $_POST['Matricula'] : '';
        $rol = !empty($_POST['Rol']) ? $_POST['Rol'] : '';
        $nombre = !empty(strtoupper($_POST['Nombre'])) ? strtoupper($_POST['Nombre']) : '';
        $apellido = !empty(strtoupper($_POST['Apellido'])) ? strtoupper($_POST['Apellido']) : '';
        $facultad = !empty(strtoupper($_POST['Facultad'])) ? strtoupper($_POST['Facultad']) : '';
        $email = !empty(strtoupper($_POST['Correo'])) ? strtoupper($_POST['Correo']) : '';
        $pass = !empty($_POST['Contrasena']) ? $_POST['Contrasena'] : '';
        $telefono = !empty($_POST['Telefono']) ? $_POST['Telefono'] : '';

        if($matricula&&$rol&&$nombre&&$apellido&&$facultad&&$email&&$pass&&$telefono){
            include 'database.php';
            $link = Conecta_DB_project();
            $query = "UPDATE usuario SET idRol = '$rol', nombreUsuario = '$nombre', apellidoUsuario = '$apellido', facultadUsuario = '$facultad', 
                emailUsuario = '$email', Pass = '$pass', telefonoUsuario = '$telefono' WHERE matriculaUsuario = '$matricula'";
            $result = mysqli_query(Conecta_DB_project(), $query);

            if($rol == 'R03'){
                $queryJuez = "UPDATE juez SET nombreJuez = '$nombre', apellidoJuez = '$apellido', facultadJuez = '$facultad'
                    WHERE idJuez = '$matricula'";
                $result = mysqli_query(Conecta_DB_project(), $queryJuez);
            }

            echo "<script> alert('Los datos se han modificado de manera correcta');window.location.href='../admin/Usuarios.php';</script>";
                
            if(!mysqli_query($link,$consulta)){
                die('No se pudo modificar el registro');
            }
        }
    }

    if (!isset($_GET['delete'])){            
        include 'database.php';
        $link = Conecta_DB_project();
        $matricula = $_GET['matriculaUsuario'];
        $rol = $_GET['idRol'];

        $query = "DELETE FROM usuario WHERE matriculaUsuario = '$matricula'";  
        $result = mysqli_query($link, $query);          
        
        if($rol == 'R03'){
            $queryJuez = "DELETE FROM juez WHERE idJuez = '$matricula'";
            $result = mysqli_query(Conecta_DB_project(), $queryJuez);
        }
    
        if(mysqli_query($link,$query))
            echo "<script> alert('Los datos se han eliminado de manera correcta');window.location.href='../admin/Usuarios.php';</script>";
        else
            die('No se pudo modificar el registro');
    }
?>
