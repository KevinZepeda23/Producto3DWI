<?php
// Conexión a la base de datos
try {
    // Crear una nueva conexión a la base de datos usando PDO
    $pdo = new PDO('mysql:host=localhost;dbname=producto3', 'root', '');
    // Configurar el modo de error para que lance excepciones
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Capturar cualquier error de conexión y mostrar el mensaje de error
    echo 'Error de conexión: ' . $e->getMessage();
    // Salir del script si hay un error de conexión
    exit();
}

/**
 * Obtener todos los vehículos de la base de datos.
 *
 * @return array Un arreglo asociativo de vehículos.
 */
function obtenerVehiculos() {
    global $pdo;
    // Ejecutar una consulta para seleccionar todos los registros de la tabla 'vehiculos'
    $stmt = $pdo->query('SELECT * FROM vehiculos');
    // Obtener todos los resultados como un arreglo asociativo
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Obtener un vehículo específico por su ID.
 *
 * @param int $id El ID del vehículo a obtener.
 * @return array|null Un arreglo asociativo del vehículo, o null si no se encuentra.
 */
function obtenerVehiculoPorId($id) {
    global $pdo;
    // Preparar una consulta para seleccionar un vehículo basado en su ID
    $stmt = $pdo->prepare('SELECT * FROM vehiculos WHERE id = ?');
    // Ejecutar la consulta con el ID proporcionado
    $stmt->execute([$id]);
    // Obtener el resultado como un arreglo asociativo
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * Calcular el total del carrito de compras.
 *
 * @return float El total del carrito.
 */
function obtenerTotalCarrito() {
    global $pdo;
    $total = 0;
    // Verificar si el carrito no está vacío
    if (!empty($_SESSION['carrito'])) {
        // Iterar sobre los elementos del carrito
        foreach ($_SESSION['carrito'] as $id => $cantidad) {
            // Obtener los detalles del vehículo basado en su ID
            $vehiculo = obtenerVehiculoPorId($id);
            if ($vehiculo) {
                // Calcular el total basado en el precio del vehículo y la cantidad
                $total += $vehiculo['precio'] * $cantidad;
            }
        }
    }
    // Devolver el total calculado
    return $total;
}

/**
 * Guardar la compra en la base de datos.
 *
 * @param int $usuario_id El ID del usuario que realiza la compra.
 */
function guardarCompra($usuario_id) {
    global $pdo;
    
    // Verificar si el carrito está vacío
    if (empty($_SESSION['carrito'])) {
        return; // Salir si el carrito está vacío
    }
    
    // Obtener el total del carrito
    $total = obtenerTotalCarrito();
    // Preparar una consulta para insertar una nueva compra en la tabla 'compras'
    $stmt = $pdo->prepare('INSERT INTO compras (usuario_id, total) VALUES (?, ?)');
    // Ejecutar la consulta con el ID del usuario y el total
    $stmt->execute([$usuario_id, $total]);
    // Obtener el ID de la última compra insertada
    $compra_id = $pdo->lastInsertId();
    
    // Iterar sobre los elementos del carrito para guardar los detalles de la compra
    foreach ($_SESSION['carrito'] as $id => $cantidad) {
        // Obtener los detalles del vehículo basado en su ID
        $vehiculo = obtenerVehiculoPorId($id);
        if ($vehiculo) {
            // Preparar una consulta para insertar los detalles de la compra en la tabla 'detalles_compra'
            $stmt = $pdo->prepare('INSERT INTO detalles_compra (compra_id, vehiculo_id, cantidad, precio) VALUES (?, ?, ?, ?)');
            // Ejecutar la consulta con los detalles de la compra
            $stmt->execute([$compra_id, $id, $cantidad, $vehiculo['precio']]);
        }
    }
    
    // Vaciar el carrito después de guardar la compra
    $_SESSION['carrito'] = array();
}
?>
