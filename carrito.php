<?php
session_start();
require 'modelo/modelo.php';
include 'templates/header2.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <script src="https://www.paypal.com/sdk/js?client-id=AXmFuqJYbPQ0DRZKaTdVsxQtj5j2bC2DMWpt_wJywqWjPWfa8u4OsZ61Ia_dSZqDKChzg2dJLrrU68Er"></script>
</head>
<body>
    <h1>Tu Carrito de Compras</h1>
    <ul>
        <?php
        if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $id => $cantidad) {
                $vehiculo = obtenerVehiculoPorId($id);
                echo "<li>" . $vehiculo['nombre'] . " x " . $cantidad . " ($" . number_format($vehiculo['precio'] * $cantidad, 2) . ")";
                echo " <a href='controlador/controlador.php?accion=eliminar&id=" . $id . "'>Eliminar</a></li>";
            }
            echo "<li><strong>Total: $" . number_format(obtenerTotalCarrito(), 2) . "</strong></li>";
        } else {
            echo "<li>Carrito vacío</li>";
        }
        ?>
    </ul>

    <!-- Contenedor para el botón de PayPal -->
    <div id="paypal-button-container"></div>

    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?php echo number_format(obtenerTotalCarrito(), 2); ?>'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    alert('Gracias por su compra, ' + details.payer.name.given_name);
                    // Redirige al usuario a la página de confirmación o al inicio
                    window.location.href = 'http://localhost/Producto3DWI/Producto3DWI/index.php?paypal_payment_complete=1';
                });
            }
        }).render('#paypal-button-container');
    </script>
</body>
</html>

<?php
include 'templates/footer.php';
?>
