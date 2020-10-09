<?php
include_once 'connection.php';
$objeto = new conexion();
$conexion = $objeto->conectar();

$_POST = json_decode(file_get_contents("php://input"), true);

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$id_trabajador = (isset($_POST['clave_trabajador'])) ? $_POST['clave_trabajador'] : '';
$id_categoria = (isset($_POST['clave_categoria'])) ? $_POST['clave_categoria'] : '';
$estado = (isset($_POST['opc_estado'])) ? $_POST['opc_estado'] : '';

switch($opcion){
    case 1:
        $consulta = "CALL sp_createAssignCategory('$id_trabajador','$id_categoria','$estado');";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();             
        $data = ($resultado->rowCount()==1) ? array("msj"=>"success") : array("msj"=>"error");
        break;
    case 2:
        $consulta = "CALL sp_updateAssignCategory('$id','$id_trabajador','$id_categoria','$estado'); ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = ($resultado->rowCount()==1) ? array("msj"=>"success") : array("msj"=>"error");
        break;        
    case 3:
        $consulta = "CALL sp_deleteAssignCategory('$id');";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = ($resultado->rowCount()==1) ? array("msj"=>"success") : array("msj"=>"error");
        break;         
    case 4:
        $consulta = "CALL sp_readDocument()";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;
?>