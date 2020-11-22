<?php
include_once 'connection.php';
$objeto = new conexion();
$conexion = $objeto->conectar();
session_start();
$_POST = json_decode(file_get_contents("php://input"), true);
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

$tipo = $_SESSION['type'];
$usuario = $_SESSION['user'];
$contrasena = $_SESSION['pswd'];
      
switch ($opcion) {             
    case 1:
        $consulta = "CALL sp_read_perfil_web('$usuario','$contrasena','$tipo')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    break;
    case 2:
        $consulta = "CALL sp_permisos_perfil_web('$usuario','$contrasena','$tipo')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;
