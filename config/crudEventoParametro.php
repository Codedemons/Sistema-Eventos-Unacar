
<?php
    /*error_reporting(0);*/
    
    if (isset($_POST['eventoP'])){

        $eventoUnir = !empty($_POST['eventoId']) ? $_POST['eventoId'] : '';
        $parametroUnir = !empty($_POST['parametroId']) ? $_POST['parametroId'] : '';
            

        include 'database.php';
        $link = Conecta_DB_project();
        $query = "INSERT INTO eventoparametro (idEvento, idParametro) VALUES ('$eventoUnir','$parametroUnir')";
                
        $result = mysqli_query(Conecta_DB_project(), $query);
        echo "<script> alert('Los datos se han insertado de manera correcta');window.location.href='../admin/Evento.php';</script>";
                    
        if(!mysqli_query($link,$consulta)){
            die('No se pudo agregar el registro');
        }
    }



     if (!isset($_GET['deleteEP'])){

            include 'database.php';
            $link = Conecta_DB_project();
            $idEP = $_GET['idEventoParametro'];  


            $query = "DELETE FROM eventoparametro WHERE idEventoParametro = '$idEP'";        
            $result = mysqli_query($link, $query);           
        
            if(mysqli_query($link,$query)){
                echo "<script> alert('Los datos se han eliminado de manera correcta');window.location.href='../admin/Evento.php';</script>";
            }else{
                die('No se pudo modificar el registro');
            }
        
    }

    
?>


