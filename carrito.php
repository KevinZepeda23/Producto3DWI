<?php
    include 'templates/header2.php ';

?>
<?php
require 'modelo/modelo.php'; // Asegúrate de tener la conexión al modelo para obtener los vehículos

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Tu Carrito de Compras</h1>
    <ul>
        <?php
        if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $id => $cantidad) {
                $vehiculo = obtenerVehiculoPorId($id);
                echo "<li>" . $vehiculo['nombre'] . " x " . $cantidad . " ($" . number_format($vehiculo['precio'] * $cantidad, 2) . ")";
                echo " <a href='controlador.php?accion=eliminar&id=" . $id . "'>Eliminar</a></li>";
            }
            echo "<li><strong>Total: $" . number_format(obtenerTotalCarrito(), 2) . "</strong></li>";
        } else {
            echo "<li>Carrito vacío</li>";
        }
        ?>
    </ul>

    <!-- Formulario para PayPal -->
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
        <!-- Especificar la URL de retorno y de notificación -->
        <input type="hidden" name="return" value="http://localhost/Producto3DWI/index.php" />
        <input type="hidden" name="notify_url" value="URL_DE_NOTIFICACION" />

        <!-- Configuración básica -->
        <input type="hidden" name="cmd" value="_cart">
        <input type="hidden" name="upload" value="1">
        <input type="hidden" name="business" value="utp0146906@alumno.utpuebla.edu.mx">

        <?php
        $i = 1;
        foreach ($_SESSION['carrito'] as $id => $cantidad) {
            $vehiculo = obtenerVehiculoPorId($id);
            echo "<input type='hidden' name='item_name_$i' value='" . $vehiculo['nombre'] . "'>";
            echo "<input type='hidden' name='amount_$i' value='" . $vehiculo['precio'] . "'>";
            echo "<input type='hidden' name='quantity_$i' value='" . $cantidad . "'>";
            $i++;
        }
        ?>
        
        <input type="submit" value="Pagar con PayPal">
    </form>
</body>
</html>




<?php
    include 'templates/footer.php';

?>