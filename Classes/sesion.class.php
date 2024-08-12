<?php
    require_once '../Global/conexion.php';

    class sesion extends Conexion{

        function __construct() {
            session_start ();
        }
        public function set($nombre, $valor) {
            $_SESSION [$nombre] = $valor;
        }
        public function get($nombre) {
            if (isset ( $_SESSION [$nombre] )) {
                return $_SESSION [$nombre];
            } else {
                return false;
            }
        }
        public function elimina_variable($nombre) {
            unset ( $_SESSION [$nombre] );
        }
        public function termina_sesion() {
            $_SESSION = array();
            session_destroy ();
        }
        public function validarUsuario($email, $password)
        {
            $consulta = "SELECT Password FROM Usuario WHERE Email = '$email';";
            
            $result = $this->conexion_db->query($consulta);
            
            
            if($result->num_rows > 0)
            {
                $fila = $result->fetch_assoc();
                if( strcmp($password,$fila["Password"]) == 0 )
                    return true;						
                else					
                    return false;
            }
            else
                    return false;
        }
    }
?>