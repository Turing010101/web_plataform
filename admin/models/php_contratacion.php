<?php
include_once 'connection.php';
$objeto = new conexion();
$conexion = $objeto->conectar();
session_start();
$_POST = json_decode(file_get_contents("php://input"), true);

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id_cliente = $_SESSION['id_client'];
$id_contrato = $_SESSION['id_contract'];

switch($opcion){
    case 1:
        $consulta = "CALL sp_read_my_details('$id_cliente','$id_contrato');";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2:
        $id = (isset($_POST['id'])) ? $_POST['id'] : '';
        $consulta = "CALL sp_delete_my_details('$id');";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = ($resultado->rowCount()==1) ? array("msj"=>"success") : array("msj"=>"error");
        break;  
    case 3:
        $consulta = "CALL sp_read_subtotal_details('$id_cliente','$id_contrato');";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 4:
        $subtotal = (isset($_POST['subtotal'])) ? $_POST['subtotal'] : '';

        $consulta = "CALL sp_pay_contract_client('$id_cliente','$id_contrato','$subtotal');";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        if($resultado->rowCount()==1){
            $data =  array("msj"=>"success");
            $_SESSION['id_contract']=0;
        }else{
            $data =  array("msj"=>"error");
        }
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;
?>