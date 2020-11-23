<?php
require_once('../models/connection.php');
require __DIR__ .'/vendor/autoload.php';

$objeto = new conexion();
$conexion = $objeto->conectar();
session_start();

$id_cliente = $_GET['id_cliente'];
$id_contrato = $_GET['id_contrato'];

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

<div class="row" style="border-bottom: 2px solid #f5f5f5; padding-bottom: 3px;">
    <div style="float: left; width: 50%; padding-left: 12px; padding-top: -10px;">
        <img src="img/logotipo.png" width="90" height="90">
    </div>
    <div style="float: right; padding-right: 14px;">
        <div>
            <h6 class="text-right" style="padding: 0px; margin: 0px;">TRABAJOS.COM</h6>
            <h6 class="text-right" style="padding: 0px; margin: 0px;">EMPRESA DE SERVICIOS S.A DE C.V</h6>
            <h6 class="text-right" style="padding: 0px; margin: 0px;">Calle De La Revolución Mexicana</h6>
            <h6 class="text-right" style="padding: 0px; margin: 0px;">Huejutla Hidalgo, C.P 43000</h6>
            <h6 class="text-right" style="padding: 0px; margin: 0px;">trabajos.com@gmail.com</h6>
            <h6 class="text-right" style="padding: 0px; margin: 0px; margin-bottom: 12px;">5589 5548 55</h6>
        </div>
    </div>
</div>

<div style="margin-top: 12px;">
    <div style="width: 50%; float: left;">
        <h4 class="text-left" style="margin: 0px; padding-bottom: 20px;">CONTRATO #'.$id_contrato.'</h4>
        <h5 class="text-left" style="margin: 0px; font-weight: bold;">Cliente: '.$nombre_cliente.' </h5>
        <h5 class="text-left" style="margin: 0px; font-weight: bold;">RFC: '.$rfc_cliente.' </h5>
    </div> 
    <div style="width: 50%; float: right;">
        <h6 class="text-right" style="padding: 0px; margin: 0px;">Fecha de contrato: '.$fecha_contrato.'</h6>
        <h6 class="text-right" style="padding: 0px; margin: 0px; margin-bottom: 12px;">Modo de pago: '.$modo_pago.'</h6>
        <h2 class="text-right" style="padding: 0px; margin: 0px;">TOTAL $'.number_format($total,2,'.',',') .'</h2>
        <h4 class="text-right" style="padding: 0px; margin: 0px;">'.$estado.'</h4>
    </div>
</div>

<style type="text/css">
h2 {
color: #000000;
font: Arial bold 120% cursive;
}
h5 {
color: #041303;
font: Arial 100%;
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
<h6 class="text-right" style="padding: 0px;">Subtotal:    $'.$subtotal.'</h6>
<h6 class="text-right" style="padding: 0px;">Comisión:     '.$comision.'%</h6>
<h6 class="text-right" style="font-size: 13px; font-weight: bold;">Total:       $'.number_format($total,2,',','.').'</h6>';


$mpdf=new \Mpdf\Mpdf();

$css= file_get_contents('css/bootstrap.min.css');
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($thml);
$mpdf->Output('reporte.pdf','I'); 
exit;
?>