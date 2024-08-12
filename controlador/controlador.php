<?php
require __DIR__ . '/../modelo/modelo.php';

 // Asegúrate de iniciar la sesión

// Inicializa el carrito si no está definido
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

// Agregar un vehículo al carrito
if (isset($_GET['accion']) && $_GET['accion'] == 'agregar') {
    $id = intval($_GET['id']);
    if (isset($_SESSION['carrito'][$id])) {
        $_SESSION['carrito'][$id]++;
    } else {
        $_SESSION['carrito'][$id] = 1;
    }
    header("Location: /Producto3DWI/Producto3DWI/shop.php");
    exit();
}

// Eliminar un vehículo del carrito
if (isset($_GET['accion']) && $_GET['accion'] == 'eliminar') {
    $id = intval($_GET['id']);
    if (isset($_SESSION['carrito'][$id])) {
        $_SESSION['carrito'][$id]--;
        if ($_SESSION['carrito'][$id] <= 0) {
            unset($_SESSION['carrito'][$id]);
        }
    }
    header("Location: /Producto3DWI/Producto3DWI/carrito.php");
    exit();
}

// Manejar la compra después del pago con PayPal
if (isset($_POST['paypal_payment_complete']) && $_POST['paypal_payment_complete'] == '1') {
    $usuario_id = 1; // Asigna un ID de usuario según tu lógica
    guardarCompra($usuario_id);
    header("Location: /Producto3DWI/Producto3DWI/index.php");
    exit();
}
?>
