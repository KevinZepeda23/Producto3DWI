<?php
    require_once '../Global/conexion.php';

    class LoginUSU extends Conexion{

        public function Val_Usu($email,$password){
            $query= "SELECT * FROM Usuario WHERE Email='$email' AND Password='$password'";
            $row = $this->conexion_db->query($query);
            $ROL = $row->fetch_all(MYSQLI_ASSOC);
            foreach($ROL as $item){
                //$numRows = $row->num_rows;
                if($item['Id_status']==2){
                    //if(){
                        //$id=$item['RFC'];
                       // echo "<script> alert('¡ Bienvenido a AcuarioShop !');</script>";
                        return true;
                    //}
                }
    
                return false;

            }
           

        }
    }

?>