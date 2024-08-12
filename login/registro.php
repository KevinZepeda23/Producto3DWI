<?php
// Para iniciar sesión
include('conexion.php');	
$usu = mysqli_real_escape_string($conn, $_POST["email2"]);
$pass = $_POST["password2"];
$captcha = $_POST['g-recaptcha-response'];

$secret = '6LcGb3YpAAAAAFau52oRtgzTjPfwlzEg2o4PcEYn';

$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$captcha);
$response_data = json_decode($response);

if ($response_data->success)

    {
// Para registrar
include('conexion.php');

// Obtener el nombre de usuario y la contraseña del formulario
$usu = mysqli_real_escape_string($conn, $_POST["email2"]);
$pass = $_POST["password2"];

// Encriptar la contraseña con la secuencia de funciones especificada
$pass_md5 = md5($pass); // MD5
$pass_crc32 = hash("crc32", $pass_md5); // CRC32
$pass_crypt = crypt($pass_crc32, 'salt'); // Crypt
$pass_sha1 = sha1($pass_crypt); // SHA1

// Insertar el nuevo usuario en la base de datos con la contraseña encriptada
$queryregistrar = mysqli_prepare($conn, "INSERT INTO Usuarios (IDUsuario,Usuario, Contraseña) VALUES ('',?, ?)");
mysqli_stmt_bind_param($queryregistrar, "ss", $usu, $pass_sha1);

if(mysqli_stmt_execute($queryregistrar)) {
    echo "<script> alert('Usuario registrado. Inicia sesión con tus credenciales: $usu');window.location= 'index.html' </script>";
} else {
    echo "Error al registrar el usuario: " . mysqli_error($conn);
}
} else {
    // El reCAPTCHA no se ha verificado correctamente, muestra un mensaje de error
    echo "<script> alert('Error: Por favor, verifica que eres humano.');window.location= 'index.php' </script>";
}
?>
