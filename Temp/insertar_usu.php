<?php 
    require_once "../Global/conexion.php";
    require_once "../Classes/Metodos_Usuarios.php";

    $rfc=$_POST['txtRFC'];
    $nom=$_POST['txtNom'];
    $ape=$_POST['txtApe'];
    $mail=$_POST['txtmail'];
    $pass=$_POST['txtpass'];
    $tel=$_POST['numtel'];
    $nombre=$_FILES['Foto']['name'];
    $guardado=$_FILES['Foto']['tmp_name'];
    
    $route = "assets/img/IMG_Profile".$nombre;
	
    move_uploaded_file($guardado,$route);
    

    $datos=array(
        $rfc,$nombre,$nom,$ape,$mail,$pass,$tel
    );

    $obj=new Metodos_USU();

    if($obj->insert_USU($datos)==1){
        header("location:../index.php");
    }
    else{
        echo "fallo al insertar";
    }

?>