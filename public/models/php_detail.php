<?php
include_once '../../admin/models/connection.php';
$objeto = new conexion();
$conexion = $objeto->conectar();
session_start();
$_POST = json_decode(file_get_contents("php://input"), true);

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id_service = (isset($_POST['id_svc'])) ? $_POST['id_svc'] : '';

switch($opcion){
    case 1:
        $consulta = "CALL sp_read_services_detalle('$id_service')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2:
        $price_service = (isset($_POST['id_price'])) ? $_POST['id_price'] : '';

        if(isset($_SESSION['user'])){
            if($_SESSION['type']==3){
            $cliente = $_SESSION['id_client'];
            $tipo_pago = 3;
            $fecha = date("Y-m-d H:i:s");

            $clave_contrato= $_SESSION['id_contract'];
            
            if($clave_contrato==0){

            $consulta = "CALL sp_create_contract('$fecha','$cliente','$tipo_pago');";	
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 
            $resultado->closeCursor();

            $sql = "CALL sp_read_my_contract('$cliente','$fecha');";
            $res = $conexion->prepare($sql);
            $res->execute();
            $row=$res->fetchAll(PDO::FETCH_ASSOC);
            $res->closeCursor();
            $clave_contrato = $row[0]['id_contrato'];

            $_SESSION['id_contract'] = $clave_contrato;

            $consul= "CALL sp_create_bill('$clave_contrato','$id_service','$price_service','1');";	
            $resul = $conexion->prepare($consul);
            $resul->execute(); 

            $data = array("msj" => "true");

            }else{

            $consul= "CALL sp_create_bill('$clave_contrato','$id_service','$price_service','1');";	
            $resul = $conexion->prepare($consul);
            $resul->execute(); 
    
            $data = array("msj" => "true");
            }
        }else{
            $data = array("msj" => "trj");
        } 

        }else{
            $data = array("msj" => "false");
        }
         break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;
