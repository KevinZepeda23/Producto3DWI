<?php
// Conexión a la base de datos
try {
    $pdo = new PDO('mysql:host=localhost;dbname=producto3', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error de conexión: ' . $e->getMessage();
    exit();
}

function obtenerVehiculos() {
    global $pdo;
    $stmt = $pdo->query('SELECT * FROM vehiculos');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function obtenerVehiculoPorId($id) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM vehiculos WHERE id = ?');
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function obtenerTotalCarrito() {
    global $pdo;
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

function guardarCompra($usuario_id) {
    global $pdo;
    $total = obtenerTotalCarrito();
    $stmt = $pdo->prepare('INSERT INTO compras (usuario_id, total) VALUES (?, ?)');
    $stmt->execute([$usuario_id, $total]);
    $compra_id = $pdo->lastInsertId();
    
    foreach ($_SESSION['carrito'] as $id => $cantidad) {
        $vehiculo = obtenerVehiculoPorId($id);
        if ($vehiculo) {
            $stmt = $pdo->prepare('INSERT INTO detalles_compra (compra_id, vehiculo_id, cantidad, precio) VALUES (?, ?, ?, ?)');
            $stmt->execute([$compra_id, $id, $cantidad, $vehiculo['precio']]);
        }
    }
    
    // Vaciar el carrito después de guardar la compra
    $_SESSION['carrito'] = array();
}
?>
