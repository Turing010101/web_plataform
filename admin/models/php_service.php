<?php
include_once 'connection.php';
$objeto = new conexion();
$conexion = $objeto->conectar();
session_start();

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id_trabajador =  $_SESSION['id_worker'];

switch ($opcion) {
    case 1:
        $nombre = (isset($_POST['txt_nombre'])) ? $_POST['txt_nombre'] : '';
        $descripcion = (isset($_POST['txt_descripcion'])) ? $_POST['txt_descripcion'] : '';
        $costo = (isset($_POST['txt_costo'])) ? $_POST['txt_costo'] : '';
        $categoria = (isset($_POST['cmb_categoria'])) ? $_POST['cmb_categoria'] : '';

        $consulta = "CALL sp_create_service_worker('$nombre','$descripcion','$costo','$categoria');";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = ($resultado->rowCount() == 1) ? array("msj" => "success") : array("msj" => "error");
        break;   
    case 2:
        $clave = (isset($_POST['clave_servicio'])) ? $_POST['clave_servicio'] : '';
        $nombre = (isset($_POST['txt_nombre'])) ? $_POST['txt_nombre'] : '';
        $descripcion = (isset($_POST['txt_descripcion'])) ? $_POST['txt_descripcion'] : '';
        $costo = (isset($_POST['txt_costo'])) ? $_POST['txt_costo'] : '';
        $categoria = (isset($_POST['cmb_categoria'])) ? $_POST['cmb_categoria'] : '';
    
        $consulta = "CALL sp_update_service_worker('$clave','$nombre','$descripcion','$costo','$categoria');";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = ($resultado->rowCount() == 1) ? array("msj" => "success") : array("msj" => "error");
        break;       
    case 3:
        $clave = (isset($_POST['clave_servicio'])) ? $_POST['clave_servicio'] : '';

        $consulta = "CALL sp_delete_service_worker('$clave');";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = ($resultado->rowCount()==1) ? array("msj"=>"success") : array("msj"=>"error");
        break;         
    case 4:
        $consulta = "CALL sp_read_service_worker('$id_trabajador')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 5:
        
        $consulta = "CALL sp_read_assing_category_worker('$id_trabajador')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;
