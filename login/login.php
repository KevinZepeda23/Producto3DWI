<?php
    // Para iniciar sesión
    include('conexion.php');    
    $usu = mysqli_real_escape_string($conn, $_POST["email"]);
    $pass = $_POST["password"];
    $captcha = $_POST['g-recaptcha-response'];

    $secret = '6LcGb3YpAAAAAFau52oRtgzTjPfwlzEg2o4PcEYn';

    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$captcha);
    $response_data = json_decode($response);

    if ($response_data->success) {
        // Obtener los valores del formulario
        $usu = mysqli_real_escape_string($conn, $_POST["email"]);
        $pass = $_POST["password"];

        // Encriptar la contraseña proporcionada por el usuario
        $pass_md5 = md5($pass); // MD5
        $pass_crc32 = hash("crc32", $pass_md5); // CRC32
        $pass_crypt = crypt($pass_crc32, 'salt'); // Crypt
        $pass_sha1 = sha1($pass_crypt); // SHA1

        // Consultar la contraseña encriptada del usuario
        $query = mysqli_prepare($conn, "SELECT Contraseña FROM usuarios WHERE Usuario = ?");
        mysqli_stmt_bind_param($query, "s", $usu);
        mysqli_stmt_execute($query);
        mysqli_stmt_bind_result($query, $pass_sha1_stored);
        mysqli_stmt_fetch($query);

        if ($pass_sha1_stored !== null && $pass_sha1 === $pass_sha1_stored) {
            // Inicio de sesión exitoso
            session_start();
            $_SESSION['Usuario'] = $usu;
            // Redirigir a la ruta deseada
            header("Location: /Producto3DWI/Producto3DWI/index.php");
            exit();
        } else {
            // Usuario o contraseña incorrectos
            echo "<script> alert('Usuario y/o contraseña Incorrectos.');window.location= '/Producto3DWI/Producto3DWI/login/index.html' </script>";
        }
    } else {
        // reCAPTCHA no verificado correctamente
        echo "<script> alert('Error: Por favor, verifica que eres humano.');window.location= '/Producto3DWI/Producto3DWI/login/index.html' </script>";
    }
?>
