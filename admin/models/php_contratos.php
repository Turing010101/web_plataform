<?php
include_once 'connection.php';
$objeto = new conexion();
$conexion = $objeto->conectar();
session_start();
$_POST = json_decode(file_get_contents("php://input"), true);

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id_tipo =$_SESSION['type'];

if($id_tipo==3){
    $id_user = $_SESSION['id_client'];
}else{
    $id_user = $_SESSION['id_worker'];
}

switch($opcion){
    case 1:
        $consulta = "CALL sp_read_contratos_web('$id_tipo','$id_user');";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2:
        $id_contrato = (isset($_POST['id_contrato'])) ? $_POST['id_contrato'] : '';

        $consulta = "CALL sp_read_contratos_user_web('$id_contrato');";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;
?>