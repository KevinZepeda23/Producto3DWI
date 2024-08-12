<?php 
    require_once '../Global/conexion.php';

    class Metodos_USU extends Conexion{

        public function __construct(){
            /*Llamamos al constructor de la clase padre mediante el uso de parent lo que nos permite ejecutar el constructor de
            la clase conexión y el código extra que agreguemos en esta función que lo hereda*/
            parent::__construct();
        }
    
        public function get_USU($email){
            $resultado = $this->conexion_db->query("SELECT * FROM Usuario WHERE Email='$email' ");
            //creamos un array asociativo que contendrá toda la información que estamos demandando de la mase de datos.
            $Usuarios = $resultado->fetch_all(MYSQLI_ASSOC);
            //pedimos que nos devuelva el array
            return $Usuarios;
        }
        public function insert_USU($datos){
            $resultado = $this->conexion_db->query("INSERT INTO Usuario(RFC,Foto,Nombre,Apellidos,Email,Password,Tel,Id_status) VALUES('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]','$datos[6]',2)");
            return $resultado;
        }
    }
?>