<?php
include_once 'connection.php';
$objeto = new conexion();
$conexion = $objeto->conectar();
session_start();
$status=false;
$extension_image = array("png","jpeg","jpg");
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
      
switch ($opcion) {
    case 1:
        $id_user = (isset($_POST['clave_usuario'])) ? $_POST['clave_usuario'] : '';
        $nombre_img = (isset($_POST['nom_img'])) ? $_POST['nom_img'] : '';
        $rfc = (isset($_POST['txt_rfc'])) ? $_POST['txt_rfc'] : '';
        $rfc_before = (isset($_POST['rfc_antes'])) ? $_POST['rfc_antes'] : '';
        $nombre = (isset($_POST['txt_nombre'])) ? $_POST['txt_nombre'] : '';
        $ap_paterno = (isset($_POST['txt_ap_paterno'])) ? $_POST['txt_ap_paterno'] : '';
        $ap_materno = (isset($_POST['txt_ap_materno'])) ? $_POST['txt_ap_materno'] : '';
        $sexo = (isset($_POST['cmb_sexo'])) ? $_POST['cmb_sexo'] : '';
        $tel_personal = (isset($_POST['txt_tel_personal'])) ? $_POST['txt_tel_personal'] : '';
        $tel_conocido = (isset($_POST['txt_tel_conocido'])) ? $_POST['txt_tel_conocido'] : '';
        $localidad = (isset($_POST['txt_localidad'])) ? $_POST['txt_localidad'] : '';
        $nombre_calle = (isset($_POST['txt_nombre_calle'])) ? $_POST['txt_nombre_calle'] : '';
        $numero_calle = (isset($_POST['txt_numero_calle'])) ? $_POST['txt_numero_calle'] : '';
        $municipio = (isset($_POST['txt_municipio'])) ? $_POST['txt_municipio'] : '';
        $estado = (isset($_POST['txt_estado'])) ? $_POST['txt_estado'] : '';
        $cp = (isset($_POST['txt_cp'])) ? $_POST['txt_cp'] : '';
        $email = (isset($_POST['txt_email'])) ? $_POST['txt_email'] : '';
        $usuario = (isset($_POST['txt_usuario'])) ? $_POST['txt_usuario'] : '';
        $_SESSION['user']= $usuario;
        $filename_user = $_FILES["img_usuario"]["name"];

        if($filename_user==""){
            $consulta = "CALL sp_update_new_user_without_img('$id_user','$rfc','$rfc_before','$nombre','$ap_paterno','$ap_materno','$sexo','$tel_personal','$tel_conocido','$email','$localidad','$nombre_calle','$numero_calle','$municipio','$estado','$cp','$usuario');";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $resultado->closeCursor();
            $data = ($resultado->rowCount() == 1) ? array("msj" => "success") : array("msj" => "success");
         }else
         {
            $surcepat_user = $_FILES["img_usuario"]["tmp_name"];
            $extension_user = pathinfo($filename_user, PATHINFO_EXTENSION);

            if ((in_array($extension_user,$extension_image))) {
                $status = true;
            }
            if ($status) {
                $name_img_usuario=  $id_user.'_usuario.' .$extension_user;
                $ruta_usuario = '../views/img/users/'  .$name_img_usuario;
               
                $consulta = "CALL sp_update_new_user_with_img('$id_user','$rfc','$rfc_before','$name_img_usuario','$nombre','$ap_paterno','$ap_materno','$sexo','$tel_personal','$tel_conocido','$email','$localidad','$nombre_calle','$numero_calle','$municipio','$estado','$cp','$usuario');";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $resultado->closeCursor();
                $data = ($resultado->rowCount() == 1) ? array("msj" => "success") : array("msj" => "success");
                
                if($nombre_img!='0_user.png'){
                    unlink('../views/img/users/'.$nombre_img);
                }
                move_uploaded_file($surcepat_user,$ruta_usuario);
               
            } else {
                $data = array("msj" => "errimg");
            }

         }
         if($_SESSION['type']= 3){

            $sql = "CALL sp_read_id_client('$rfc');";
            $res = $conexion->prepare($sql);
            $res->execute();
            $row=$res->fetchAll(PDO::FETCH_ASSOC);

            $_SESSION['id_client']=$row[0]['id_cliente'];
            $_SESSION['id_contract'] = 0;
         }

        break;               
    case 2:
        $email = (isset($_POST['correo'])) ? $_POST['correo'] : '';
            
        $consulta = "CALL sp_read_new_user('$email')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:
        $rfc = (isset($_POST['rfc'])) ? $_POST['rfc'] : '';

        $consulta = "CALL sp_perfil_contratante('$rfc');";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = ($resultado->rowCount()==1) ? array("msj"=>"success") : array("msj"=>"nosuccess");
        break;
    case 4:
        $rfc = (isset($_POST['rfc'])) ? $_POST['rfc'] : '';
    
        $consulta = "CALL sp_perfil_trabajador('$rfc');";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $resultado->closeCursor();

        if($resultado->rowCount()==1){

            $sql = "CALL sp_read_id_worker('$rfc');";
            $res = $conexion->prepare($sql);
            $res->execute();
            $row=$res->fetchAll(PDO::FETCH_ASSOC);

            $_SESSION['id_worker']=$row[0]['id_trabajador'];
            $_SESSION['type']=4;

            $data =  array("msj"=>"success");
           
        }else{
            $data = array("msj"=>"nosuccess");
        }
        break;
    case 5:
        $rfc = (isset($_POST['rfc'])) ? $_POST['rfc'] : '';
                
        $consulta = "CALL sp_perfil_contratante_buscar('$rfc')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 6:
        $rfc = (isset($_POST['rfc'])) ? $_POST['rfc'] : '';
                    
        $consulta = "CALL sp_perfil_trabajador_buscar('$rfc')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 7:
        $rfc = (isset($_POST['rfc'])) ? $_POST['rfc'] : '';
                    
        $consulta = "CALL sp_read_datos_trabajador('$rfc')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 8:  
        $rfc = (isset($_POST['rfc'])) ? $_POST['rfc'] : '';
        $estado = (isset($_POST['cmb_estado_trabajador'])) ? $_POST['cmb_estado_trabajador'] : '';
        $experiencia = (isset($_POST['txt_experiencia'])) ? $_POST['txt_experiencia'] : '';

        $consulta = "CALL sp_update_datos_trabajador('$rfc','$estado','$experiencia');";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = ($resultado->rowCount() == 1) ? array("msj" => "success") : array("msj" => "error");
        break;
    case 9:  
        $rfc = (isset($_POST['rfc'])) ? $_POST['rfc'] : '';
        $contrasena_actual = (isset($_POST['txt_contrasena_actual'])) ? $_POST['txt_contrasena_actual'] : '';
        $contrasena_nueva = (isset($_POST['txt_contrasena_nueva'])) ? $_POST['txt_contrasena_nueva'] : '';

        $consulta = "CALL sp_change_password('$rfc','$contrasena_actual','$contrasena_nueva');";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        if($resultado->rowCount() == 1){
            $data = array("msj" => "success");
            $_SESSION['pswd']= $contrasena_nueva;
        }else{
            $data = array("msj" => "error");
        }
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;
