<?php
include_once 'connection.php';
$objeto = new conexion();
$conexion = $objeto->conectar();
session_start();
$status=false;
$extension_image = array("png","jpeg","jpg");

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id_trabajador =  $_SESSION['id_worker'];
       
switch ($opcion) {
    case 1:
        $foto_servicio = $_FILES["img_servicio"];
        $filename_servicio = $_FILES["img_servicio"]["name"];
        $surcepat_servicio = $_FILES["img_servicio"]["tmp_name"];

        $extension_servicio = pathinfo($filename_servicio, PATHINFO_EXTENSION);

        $id_servicio = (isset($_POST['clave_servicio'])) ? $_POST['clave_servicio'] : '';
        
        if ((in_array($extension_servicio,$extension_image))) {
            $status = true;
        }
        if ($status) {

            $sql = "CALL sp_read_last_id_service_image();";
            $res = $conexion->prepare($sql);
            $res->execute();
            $row=$res->fetchAll(PDO::FETCH_ASSOC);
            $res->closeCursor();
            $id_row=$row[0]['clave'];

            $name_img_servicio=  $id_row.'_servicio.' .$extension_servicio;

            $ruta_servicio = '../views/img/service/'  .$name_img_servicio;
           
            $consulta = "CALL sp_create_service_image('$id_servicio','$name_img_servicio');";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data = ($resultado->rowCount() == 1) ? array("msj" => "success") : array("msj" => "error");
  
            move_uploaded_file($surcepat_servicio,$ruta_servicio);
           
        } else {
            $data = array("msj" => "errimg");
        }
        break;       
    case 3:
        $id_img_servicio = (isset($_POST['id_registro'])) ? $_POST['id_registro'] : '';
        $servicio = (isset($_POST['img_servicio'])) ? $_POST['img_servicio'] : '';

        $consulta = "CALL sp_delete_service_image('$id_img_servicio');";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = ($resultado->rowCount()==1) ? array("msj"=>"success") : array("msj"=>"error");
        
        unlink('../views/img/service/'.$servicio);
        break;         
    case 4:
            
        $consulta = "CALL sp_read_service_worker('$id_trabajador')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 5:
                
        $consulta = "CALL sp_read_service_image('$id_trabajador')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;
