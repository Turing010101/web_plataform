<?php
include_once 'connection.php';
$objeto = new conexion();
$conexion = $objeto->conectar();
session_start();
$status=false;
$extension_image = array("png","jpeg","jpg");

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id_trabajador = $_SESSION['id_worker'];

switch ($opcion) {
    case 1:

        $foto_credencial = $_FILES["img_credencial"];
        $filename_credencial = $_FILES["img_credencial"]["name"];
        $surcepat_credencial = $_FILES["img_credencial"]["tmp_name"];

        $foto_certificado = $_FILES["img_certificado"];
        $filename_certificado = $_FILES["img_certificado"]["name"];
        $surcepat_certificado = $_FILES["img_certificado"]["tmp_name"];

        $foto_comprobante = $_FILES["img_comprobante"];
        $filename_comprobante = $_FILES["img_comprobante"]["name"];
        $surcepat_comprobante = $_FILES["img_comprobante"]["tmp_name"];

        $extension_credencial = pathinfo($filename_credencial, PATHINFO_EXTENSION);
        $extension_certificado = pathinfo($filename_certificado, PATHINFO_EXTENSION);
        $extension_comprobante = pathinfo($filename_comprobante, PATHINFO_EXTENSION);
        
        if ((in_array($extension_credencial,$extension_image)) && (in_array($extension_certificado,$extension_image)) && (in_array($extension_comprobante,$extension_image))) {
            $status = true;
        }
        if ($status) {

            $sql = "CALL sp_read_last_id_document_worker();";
            $res = $conexion->prepare($sql);
            $res->execute();
            $row=$res->fetchAll(PDO::FETCH_ASSOC);
            $res->closeCursor();
            $id_row=$row[0]['clave'];

            $name_img_credencial=  $id_row.'_credencial.' .$extension_credencial;
            $name_img_certificado= $id_row.'_certificado.'.$extension_certificado;
            $name_img_comprobante= $id_row.'_comprobante.'.$extension_comprobante;
            

            $ruta_credencial = '../views/img/document/'  .$name_img_credencial;
            $ruta_certificado = '../views/img/document/' .$name_img_certificado;
            $ruta_comprobante = '../views/img/document/' .$name_img_comprobante;
           
            $consulta = "CALL sp_create_document_from_wroker('$name_img_credencial','$name_img_certificado','$name_img_comprobante','$id_trabajador');";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data = ($resultado->rowCount() == 1) ? array("msj" => "success") : array("msj" => "error");
  
            move_uploaded_file($surcepat_credencial,$ruta_credencial);
            move_uploaded_file($surcepat_certificado,$ruta_certificado);
            move_uploaded_file($surcepat_comprobante,$ruta_comprobante);
           
        } else {
            $data = array("msj" => "errimg");
        }
        break;       
    case 3:
        $id_documento = (isset($_POST['id_registro'])) ? $_POST['id_registro'] : '';
        $credencial = (isset($_POST['img_credencial'])) ? $_POST['img_credencial'] : '';
        $certificado = (isset($_POST['img_certificado'])) ? $_POST['img_certificado'] : '';
        $comprobante = (isset($_POST['img_comprobante'])) ? $_POST['img_comprobante'] : '';

        $consulta = "CALL sp_detele_document_from_wroker('$id_documento');";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = ($resultado->rowCount()==1) ? array("msj"=>"success") : array("msj"=>"error");
        
        unlink('../views/img/document/'.$credencial);
        unlink('../views/img/document/'.$certificado);
        unlink('../views/img/document/'.$comprobante);
        break;         
    case 4:
        $consulta = "CALL sp_read_document_from_wroker_web('$id_trabajador')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;
