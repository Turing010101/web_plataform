<?php
include_once '../../admin/models/connection.php';
$objeto = new conexion();
$conexion = $objeto->conectar();
session_start();
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
      
switch ($opcion) {
    case 1:
        
        $tipo = (isset($_POST['cmb_tipo'])) ? $_POST['cmb_tipo'] : '';
        $usuario = (isset($_POST['txt_user'])) ? $_POST['txt_user'] : '';
        $contrasena = (isset($_POST['txt_pswd'])) ? $_POST['txt_pswd'] : '';

        $sql = "CALL sp_update_perfil_web('$usuario','$contrasena','$tipo')";
        $res = $conexion->prepare($sql);
        $res->execute();
        $res->closeCursor();

        $consulta = "CALL sp_read_login_web('$usuario','$contrasena','$tipo')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        
        if($data[0]['res']=='1'){

            $_SESSION['type']= $tipo;
            $_SESSION['user']= $usuario;
            $_SESSION['pswd']= $contrasena;
            $_SESSION['rfc'] = $data[0]['rfc'];
            if($_SESSION['type']==3){
            $_SESSION['id_client'] = $data[0]['id_cliente'];
            $_SESSION['id_contract'] = 0;
            }else{
             $_SESSION['id_worker']= $data[0]['id_trabajador'];
            }
        }
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;
