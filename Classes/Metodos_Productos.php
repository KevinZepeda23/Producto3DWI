<?php
    require_once 'Global/conexion.php';

    class DevuelveProductos extends Conexion{

    public function __construct(){
        /*Llamamos al constructor de la clase padre mediante el uso de parent lo que nos permite ejecutar el constructor de
        la clase conexión y el código extra que agreguemos en esta función que lo hereda*/
        parent::__construct();
    }

    public function get_productos(){
        $resultado = $this->conexion_db->query('SELECT * FROM Productos');
        //creamos un array asociativo que contendrá toda la información que estamos demandando de la mase de datos.
        $productos = $resultado->fetch_all(MYSQLI_ASSOC);
        //pedimos que nos devuelva el array
        return $productos;
    }
    public function insert_productos($datos){
        $resultado = $this->conexion_db->query('INSERT INTO ');
        return $resultado;
    }
    }
?>