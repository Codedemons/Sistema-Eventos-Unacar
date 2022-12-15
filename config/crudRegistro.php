<?php
    /*error_reporting(0);*/
     
        $Codigo = !empty($_POST['CodigoUser']) ? $_POST['CodigoUser'] : '';
        $Nombre = !empty($_POST['NombreUser']) ? $_POST['NombreUser'] : '';
        $Apellido = !empty($_POST['ApellidoUser']) ? $_POST['ApellidoUser'] : '';
        $Clave = !empty($_POST['ClaveUser']) ? $_POST['ClaveUser'] : '';
        $Facultad = !empty($_POST['FacultadUser']) ? $_POST['FacultadUser'] : '';
        $Rol = !empty($_POST['RolUser']) ? $_POST['RolUser'] : '';
        $Telefono = !empty($_POST['TelefonoUser']) ? $_POST['TelefonoUser'] : '';
        $Correo = !empty($_POST['CorreoUser']) ? $_POST['CorreoUser'] : '';


    
           include 'database.php';
            $link = Conecta_DB_project();
            $query = "INSERT INTO usuario (matriculaUsuario, idRol, nombreUsuario, apellidoUsuario, facultadUsuario,emailUsuario,Pass,telefonoUsuario) VALUES ('$Codigo','$Rol','$Nombre','$Apellido','$Facultad','$Correo','$Clave','$Telefono')";
            $result = mysqli_query($link, $query);
            echo "<script> alert('Los datos se han insertado de manera correcta');window.location.href='../sign-in.php';</script>";
            if(!mysqli_query($link,$query)){
                die('No se pudo agregar el registro');
            }
?>


