<?php
    include_once "../Classes/Metodo_session.php";
    if(isset($_POST['submit'])){
            $email = $_POST['email'];
            $password = $_POST['password'];

            if(empty($email) || empty($password))
            {
                echo '<div class="alert alert-danger">Nombre de usuario o contraseña vacio </div> ';
            }
            else
            {
                $user = new LoginUSU;

                if($user->Val_Usu($email,$password)){
                    session_start();
                    $_SESSION['usuario'] = $email;
                    header("Location: ../welcome.php");
                }else{
                echo '<div class="alert alert-danger">Usuario no existe</div>';
                }
            }

        }
?>