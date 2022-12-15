<?php
    error_reporting(0);
    
    if (!isset($_POST['send'])){
        $nombre = !empty($_POST['Nombre']) ? $_POST['Nombre'] : '';
        $caracteristica = !empty($_POST['Caracteristica']) ? $_POST['Caracteristica'] : '';

        if($nombre&&$caracteristica){
            include 'database.php';
            $link = Conecta_DB_project();
            $query = "INSERT INTO parametro (idParametro, nombreParametro, caracteristicaParametro) 
                VALUES ('$codigo', '$nombre', '$caracteristica')";
            
            $result = mysqli_query(Conecta_DB_project(), $query);
            echo "<script> alert('Los datos se han insertado de manera correcta');window.location.href='../admin/Rubrica.php';</script>";
                
            if(!mysqli_query($link,$consulta)){
                die('No se pudo agregar el registro');
            }
        }
    }
        
    if (!isset($_POST['update'])){
        $codigo = !empty($_POST['Codigo']) ? $_POST['Codigo'] : '';
        $nombre = !empty($_POST['Nombre']) ? $_POST['Nombre'] : '';
        $caracteristica = !empty($_POST['Caracteristica']) ? $_POST['Caracteristica'] : '';

        if($codigo&&$nombre&&$caracteristica){
            include 'database.php';
            $link = Conecta_DB_project();

            $query = "UPDATE parametro SET nombreParametro = '$nombre', caracteristicaParametro = '$caracteristica'
                WHERE idParametro = '$codigo'";

            $result = mysqli_query(Conecta_DB_project(), $query);
            echo "<script> alert('Los datos se han modificado de manera correcta');window.location.href='../admin/Rubrica.php';</script>";
                
            if(!mysqli_query($link,$consulta)){
                die('No se pudo modificar el registro');
            }
        }
    }
    
    if (!isset($_GET['delete'])){                    
        include 'database.php';
        $link = Conecta_DB_project();
        $idParametro = $_GET['idParametro'];           

        $query = "DELETE FROM parametro WHERE idParametro = '$idParametro'";        
        $result = mysqli_query($link, $query);           
        
        if(mysqli_query($link,$query)){
            echo "<script> alert('Los datos se han eliminado de manera correcta');window.location.href='../admin/Rubrica.php';</script>";
        }else{
            die('No se pudo modificar el registro');
        }
    }
?>
