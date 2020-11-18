<?php
require_once('../models/connection.php');
require __DIR__ .'/vendor/autoload.php';

$objeto = new conexion();
$conexion = $objeto->conectar();
session_start();

$id_cliente = $_SESSION['id_client'];
$id_contrato = $_SESSION['id_contract'];

$sql = "CALL sp_read_contract_client('$id_cliente','$id_contrato');";
$res = $conexion->prepare($sql);
$res->execute();
$row=$res->fetchAll(PDO::FETCH_ASSOC);
$res->closeCursor();

$id_contrato = $row[0]['id_contrato'];
$rfc_cliente = $row[0]['rfc_cliente'];
$nombre_cliente = $row[0]['nombre_cliente'];
$subtotal = $row[0]['subtotal'];;
$comision = $row[0]['comision'];
$total = $row[0]['total'];
$estado = $row[0]['estado'];
$modo_pago = $row[0]['modo_pago'];
$fecha_contrato = $row[0]['fecha_contrato'];

$consulta = "CALL sp_read_my_details('$id_cliente','$id_contrato');";
$resultado = $conexion->prepare($consulta);
$resultado->execute();


$thml='

<div class="text-left"> 
<img src="img/logotipo.png" width="100" height="100">
<h4 class="text-left">CONTRATO #'.$id_contrato.'</h4>
<h5 class="text-left">Cliente: '.$nombre_cliente.' </h5>
<h5 class="text-left">RFC: '.$rfc_cliente.' </h5>
<div>
    <h6 class="text-right">Trabajos.com</h6>
    <h6 class="text-right">Calle De La Revolución Mexicana</h6>
    <h6 class="text-right">Huejutla Hidalgo, C.P 43000</h6>
    <h6 class="text-right">trabajos.com@gmail.com</h6>
    <h6 class="text-right">5589 5548 55</h6>
</div>
<h6 class="text-right">Fecha de contrato: '.$fecha_contrato.'</h6>
<h6 class="text-right">Modo de pago: '.$modo_pago.'</h6>
<h2 class="text-right">TOTAL $'.$total.'</h2>
<h4 class="text-right">'.$estado.'</h4>
</div>

<style type="text/css">
h2 {
color: #000000;
font: Arial bold 120% cursive;
}
h5 {
color: #041303;
font: Arial bold 100%;
}

#tabla {
font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
border-collapse: collapse;
width: 100%;
}

#tabla td, #tabla th {
border: 1px solid #ddd;
padding: 5px;
}

#tabla tr:nth-child(even){
    background-color:  #DEB887;
}

#tabla tr:hover {
    background-color:  #CD5C5C;
}

#tabla th {
text-align: center;
background-color: #4FCAF1;
color: black;
}   
</style>
<hr>
<table id="tabla" class="table table-striped table-condensed table-hover table-bordered"> 
<thead>
<tr>
    <th>Servicio</th>
    <th>Precio</th>
    <th>Categoría</th>
    <th>Trabajador</th>
    <th>Total</th>
</tr>
</thead>
<tbody>';
while($fila=$resultado->fetch(PDO::FETCH_ASSOC))
{
$thml.=' <tr>
<td>'.$fila['servicio'].'</td>
<td>$'.$fila['servicio_precio'].'</td>
<td>'.$fila['categoria'].'</td>
<td>'.$fila['trabajador'].'</td>
<td>$'.$fila['total'].'</td>
</tr>'; 
}
$thml.='</tbody>
</table>
<h6 class="text-right">Subtotal:    $'.$subtotal.'</h6>
<h6 class="text-right">Comisión:     '.$comision.'%</h6>
<h6 class="text-right">Total:       $'.$total.'</h6>';


$mpdf=new \Mpdf\Mpdf();

$css= file_get_contents('css/bootstrap.min.css');
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($thml);
$mpdf->Output('reporte.pdf','I'); 
exit;
?>