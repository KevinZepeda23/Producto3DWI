<?php
    // Incluir el archivo de conexión a la base de datos
    include('conexion.php');    

    // Escapar el valor del campo 'email' del formulario para prevenir inyecciones SQL
    $usu = mysqli_real_escape_string($conn, $_POST["email"]);
    // Obtener la contraseña del formulario
    $pass = $_POST["password"];
    // Obtener la respuesta del reCAPTCHA
    $captcha = $_POST['g-recaptcha-response'];

    // Clave secreta para validar el reCAPTCHA
    $secret = '6LcGb3YpAAAAAFau52oRtgzTjPfwlzEg2o4PcEYn';

    // Hacer una solicitud a la API de Google para verificar la respuesta del reCAPTCHA
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$captcha);
    // Decodificar la respuesta JSON de la API
    $response_data = json_decode($response);

    // Verificar si la validación del reCAPTCHA fue exitosa
    if ($response_data->success) {
        // Escapar nuevamente el valor del campo 'email' (redundante pero asegura que no haya problemas)
        $usu = mysqli_real_escape_string($conn, $_POST["email"]);
        // Obtener la contraseña del formulario
        $pass = $_POST["password"];

        // Encriptar la contraseña proporcionada por el usuario utilizando múltiples métodos de cifrado
        $pass_md5 = md5($pass); // Aplicar MD5
        $pass_crc32 = hash("crc32", $pass_md5); // Aplicar CRC32
        $pass_crypt = crypt($pass_crc32, 'salt'); // Aplicar Crypt con una sal
        $pass_sha1 = sha1($pass_crypt); // Aplicar SHA1

        // Preparar la consulta para obtener la contraseña encriptada almacenada en la base de datos
        $query = mysqli_prepare($conn, "SELECT Contraseña FROM usuarios WHERE Usuario = ?");
        // Vincular el parámetro de la consulta
        mysqli_stmt_bind_param($query, "s", $usu);
        // Ejecutar la consulta
        mysqli_stmt_execute($query);
        // Vincular el resultado de la consulta
        mysqli_stmt_bind_result($query, $pass_sha1_stored);
        // Obtener el resultado
        mysqli_stmt_fetch($query);

        // Comparar la contraseña encriptada proporcionada con la almacenada en la base de datos
        if ($pass_sha1_stored !== null && $pass_sha1 === $pass_sha1_stored) {
            // Inicio de sesión exitoso
            session_start();
            // Almacenar el nombre de usuario en la sesión
            $_SESSION['Usuario'] = $usu;
            // Redirigir al usuario a la página principal
            header("Location: /Producto3DWI/Producto3DWI/index.php");
            exit();
        } else {
            // Usuario o contraseña incorrectos
            echo "<script> alert('Usuario y/o contraseña Incorrectos.');window.location= '/Producto3DWI/Producto3DWI/login/index.html' </script>";
        }
    } else {
        // El reCAPTCHA no fue verificado correctamente
        echo "<script> alert('Error: Por favor, verifica que eres humano.');window.location= '/Producto3DWI/Producto3DWI/login/index.html' </script>";
    }
    // Fin del script PHP
?>
