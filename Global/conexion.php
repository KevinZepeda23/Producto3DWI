<?php   
    require_once 'config.php';//accedemos a la información que hay dentro de config.php

    class Conexion{

        protected $conexion_db;

        public function __construct(){

            $this->conexion_db = new mysqli(SERVIDOR,USUARIO,PASSWORD,BD);

            //En caso de que la conexion no tenga exito.
            if( $this->conexion_db->connect_errno) {

                echo "Fallo al conectar a MySQL:" . $this->conexion_db->connect_error;
                return;
            }
            $this->conexion_db->set_charset(DB_CHARSET);
        }
    }
?> 