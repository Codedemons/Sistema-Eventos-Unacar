<?php
    error_reporting(0);
    
    if (!isset($_POST['send'])){
        $codigo = !empty($_POST['Codigo']) ? $_POST['Codigo'] : '';
        $nombre = !empty($_POST['Nombre']) ? $_POST['Nombre'] : '';
        $descripcion = !empty($_POST['Descripcion']) ? $_POST['Descripcion'] : '';
        $status = !empty($_POST['status']) ? $_POST['status'] : '';

        if($codigo&&$nombre&&$descripcion){
            include 'database.php';
            $link = Conecta_DB_project();
            $query = "INSERT INTO evento (idEvento, matriculaUsuario, nombreEvento, descripcionEvento, statusEvento) VALUES ('$codigo','190038','$nombre','$descripcion','$status')";
            
            $result = mysqli_query(Conecta_DB_project(), $query);
            echo "<script> alert('Los datos se han insertado de manera correcta');window.location.href='../admin/Evento.php';</script>";
                
            if(!mysqli_query($link,$consulta)){
                die('No se pudo agregar el registro');
            }
        }
    }
        
    if (!isset($_POST['update'])){
        $codigo = !empty($_POST['Codigo']) ? $_POST['Codigo'] : '';
        $nombre = !empty($_POST['Nombre']) ? $_POST['Nombre'] : '';
        $descripcion = !empty($_POST['Descripcion']) ? $_POST['Descripcion'] : '';
        $status = !empty($_POST['status']) ? $_POST['status'] : '';

        if($codigo&&$nombre&&$descripcion){
            include 'database.php';
            $link = Conecta_DB_project();
            $query = "UPDATE evento SET nombreEvento = '$nombre', descripcionEvento = '$descripcion', statusEvento = '$status' WHERE idEvento = '$codigo'";
            $result = mysqli_query(Conecta_DB_project(), $query);
            echo "<script> alert('Los datos se han modificado de manera correcta');window.location.href='../admin/Evento.php';</script>";
                
            if(!mysqli_query($link,$consulta)){
                die('No se pudo modificar el registro');
            }
        }
    }
    

    if (!isset($_GET['delete'])){                    
            include 'database.php';
            $link = Conecta_DB_project();
            $idEvento = $_GET['idEvento'];           

            $query = "DELETE FROM evento WHERE idEvento = '$idEvento'";        
            $result = mysqli_query($link, $query);           
        
            if(mysqli_query($link,$query)){
                echo "<script> alert('Los datos se han eliminado de manera correcta');window.location.href='../admin/Evento.php';</script>";
            }else{
                die('No se pudo modificar el registro');
            }
        
    }

?>
