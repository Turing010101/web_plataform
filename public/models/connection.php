<?php
    class conexion{
        public static function conectar(){
            define('server', 'localhost');
            define('bd', 'bd_trabajos_com');
            define('user', 'root');
            define('password', '');	
            $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');			
            try{
                $conexion = new PDO("mysql:host=".server."; dbname=".bd, user, password, $opciones);
                return $conexion;
            }catch (Exception $e){
                die("El error de Conexión es: ". $e->getMessage());
            }
        }
}
?>