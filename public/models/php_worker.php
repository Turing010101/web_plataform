<?php
include_once '../../admin/models/connection.php';
$objeto = new conexion();
$conexion = $objeto->conectar();
$_POST = json_decode(file_get_contents("php://input"), true);

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id_categoria = (isset($_POST['id_cat'])) ? $_POST['id_cat'] : '';

switch($opcion){
    case 1:
        $consulta = "CALL sp_read_workers_web('$id_categoria')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;
?>