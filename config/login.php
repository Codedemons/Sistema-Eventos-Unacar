<?php
session_start(); // Iniciando sesion

if (!isset($_POST['submit'])){
    $usuarios = !empty($_POST['email']) ? $_POST['email'] : '';
    $passwords = !empty($_POST['pass']) ? $_POST['pass'] : '';    
    
    include '../config/database.php';
        
        $link = Conecta_DB_project();
        
        $consulta ="SELECT * FROM usuario where emailUsuario='$usuarios' and Pass ='$passwords'";
        

        $result = mysqli_query(Conecta_DB_project(), $consulta);
        $filas=mysqli_fetch_array($result);

        if($filas['idRol']=='R01'){ //administrador            
            $_SESSION['login_user_sys']=$usuarios;                                    
            header("location:../admin/home.php");             
        }else
        if($filas['idRol']=='R02'){ //cliente
            $_SESSION['login_user_sys']=$usuarios;
            header("location:../Equipo/home.php");
        }
        if($filas['idRol']=='R03'){ //cliente
            $_SESSION['login_user_sys']=$usuarios;
            header("location:../Juez/home.php");
        }
        else{
            echo "<script> alert('Datos incorrectos');window.location.href='../index.php';</script>";
        }
            
        if(!mysqli_query($link,$consulta)){
            die('Error');
        }
    
}

?>