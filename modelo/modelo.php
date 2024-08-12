<?php
// Model: Gestiona los datos de los vehículos
if (!function_exists('obtenerVehiculos')) {
function obtenerVehiculos() {
    return array(
        array("id" => 1, "nombre" => "Toyota Corolla", "precio" => 20000, "imagen" => "toyota-corolla.jpg"),
        array("id" => 2, "nombre" => "Honda Civic", "precio" => 25000, "imagen" => "honda-civic.jpg"),
        array("id" => 3, "nombre" => "Ford Focus", "precio" => 18000, "imagen" => "ford-focus.jpg"),
        array("id" => 4, "nombre" => "Nissan Sentra", "precio" => 22000, "imagen" => "nissan-sentra.jpg"),
        array("id" => 5, "nombre" => "Chevrolet Cruze", "precio" => 28000, "imagen" => "chevrolet-cruze.jpg"),
        array("id" => 6, "nombre" => "Mazda 3", "precio" => 21000, "imagen" => "mazda-3.png"),
        array("id" => 7, "nombre" => "Hyundai Elantra", "precio" => 19500, "imagen" => "hyundai-elantra.jpg"),
        array("id" => 8, "nombre" => "Kia Forte", "precio" => 18500, "imagen" => "kia-forte.jpg"),
        array("id" => 9, "nombre" => "Volkswagen Jetta", "precio" => 23000, "imagen" => "volkswagen-jetta.jpg"),
        array("id" => 10, "nombre" => "Subaru Impreza", "precio" => 24000, "imagen" => "subaru-impreza.jpg"),
        array("id" => 11, "nombre" => "BMW Serie 3", "precio" => 45000, "imagen" => "bmw-serie-3.jpg"),
        array("id" => 12, "nombre" => "Mercedes-Benz Clase C", "precio" => 50000, "imagen" => "mercedes-benz-clase-c.jpg"),
        array("id" => 13, "nombre" => "Audi A4", "precio" => 48000, "imagen" => "audi-a4.jpg"),
        array("id" => 14, "nombre" => "Tesla Model 3", "precio" => 55000, "imagen" => "tesla-model-3.jpg"),
        array("id" => 15, "nombre" => "Lexus IS", "precio" => 46000, "imagen" => "lexus-is.png"),
    );
}
}

if (!function_exists('obtenerVehiculoPorId')) {
function obtenerVehiculoPorId($id) {
    $vehiculos = obtenerVehiculos();
    foreach ($vehiculos as $vehiculo) {
        if ($vehiculo['id'] == $id) {
            return $vehiculo;
        }
    }
    return null;
}
}

if (!function_exists('obtenerTotalCarrito')) {
function obtenerTotalCarrito() {
    $total = 0;
    if (!empty($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $id => $cantidad) {
            $vehiculo = obtenerVehiculoPorId($id);
            if ($vehiculo) {
                $total += $vehiculo['precio'] * $cantidad;
            }
        }
    }
    return $total;
}
}
?>
