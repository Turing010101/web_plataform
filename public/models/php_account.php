<?php
include_once '../../admin/models/connection.php';
$objeto = new conexion();
$conexion = $objeto->conectar();
session_start();
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
      
switch ($opcion) {
    case 1:
        $usuario = (isset($_POST['txt_user'])) ? $_POST['txt_user'] : '';
        $correo = (isset($_POST['txt_email'])) ? $_POST['txt_email'] : '';
        $contrasena = (isset($_POST['txt_pswd'])) ? $_POST['txt_pswd'] : '';

        $consulta = "CALL sp_create_account_people('$usuario','$correo','$contrasena');";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        if($resultado->rowCount() == 1){

            $_SESSION['type']= 3;
            $_SESSION['user']= $usuario;
            $_SESSION['pswd']= $contrasena;

            $data= array("msj" => "success");

        }else{
            $data= array("msj" => "error");
        }
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;
