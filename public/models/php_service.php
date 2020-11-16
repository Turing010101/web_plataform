<?php
include_once '../../admin/models/connection.php';
$objeto = new conexion();
$conexion = $objeto->conectar();
$_POST = json_decode(file_get_contents("php://input"), true);

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id_categoria = (isset($_POST['id_cat'])) ? $_POST['id_cat'] : '';
$id_trabajador = (isset($_POST['id_tbj'])) ? $_POST['id_tbj'] : '';

switch($opcion){
    case 1:
        $consulta = "CALL sp_read_services_workers('$id_categoria','$id_trabajador')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;
?>