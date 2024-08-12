<?php
// Iniciar la sesión para el manejo de datos del usuario
session_start();

// Incluir el archivo que contiene funciones relacionadas con el modelo de datos
require 'modelo/modelo.php';

// Incluir el archivo de encabezado de la plantilla
include 'templates/header2.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Especificar el conjunto de caracteres utilizado en la página -->
    <meta charset="UTF-8">
    <!-- Hacer que la página se ajuste al ancho del dispositivo y establecer el nivel de zoom inicial -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Título de la página que se mostrará en la pestaña del navegador -->
    <title>Carrito de Compras</title>
    <!-- Incluir el SDK de PayPal para el procesamiento de pagos -->
    <script src="https://www.paypal.com/sdk/js?client-id=AXmFuqJYbPQ0DRZKaTdVsxQtj5j2bC2DMWpt_wJywqWjPWfa8u4OsZ61Ia_dSZqDKChzg2dJLrrU68Er"></script>
</head>
<body>
    <!-- Título principal de la página -->
    <h1>Tu Carrito de Compras</h1>
    <!-- Lista de productos en el carrito -->
    <ul>
        <?php
        // Verificar si la sesión contiene elementos en el carrito
        if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
            // Recorrer cada ítem en el carrito
            foreach ($_SESSION['carrito'] as $id => $cantidad) {
                // Obtener la información del vehículo utilizando su ID
                $vehiculo = obtenerVehiculoPorId($id);
                // Mostrar el nombre del vehículo, la cantidad y el precio total por ítem
                echo "<li>" . $vehiculo['nombre'] . " x " . $cantidad . " ($" . number_format($vehiculo['precio'] * $cantidad, 2) . ")";
                // Proporcionar un enlace para eliminar el ítem del carrito
                echo " <a href='controlador/controlador.php?accion=eliminar&id=" . $id . "'>Eliminar</a></li>";
            }
            // Mostrar el total de la compra
            echo "<li><strong>Total: $" . number_format(obtenerTotalCarrito(), 2) . "</strong></li>";
        } else {
            // Mostrar un mensaje si el carrito está vacío
            echo "<li>Carrito vacío</li>";
        }
        ?>
    </ul>

    <!-- Contenedor para el botón de PayPal -->
    <div id="paypal-button-container"></div>

    <!-- Script para configurar el botón de PayPal y manejar el proceso de pago -->
    <script>
        paypal.Buttons({
            // Crear la orden de PayPal
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?php echo number_format(obtenerTotalCarrito(), 2); ?>'
                        }
                    }]
                });
            },
            // Acción a realizar cuando el pago es aprobado
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Mostrar un mensaje de agradecimiento al usuario
                    alert('Gracias por su compra, ' + details.payer.name.given_name);
                    // Redirigir al usuario a la página de confirmación o al inicio
                    window.location.href = 'http://localhost/Producto3DWI/Producto3DWI/index.php?paypal_payment_complete=1';
                });
            }
        }).render('#paypal-button-container'); // Renderizar el botón de PayPal en el contenedor especificado
    </script>
</body>
</html>

<?php
// Incluir el archivo de pie de página de la plantilla
include 'templates/footer.php';
?>
