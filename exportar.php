<?php


$tipo = $_GET['t'];


if($tipo == "excel") 
{
$extension = ".xls";
}

if($tipo == "word") 
{
$extension = ".docx";
}




    require_once 'reporte_pedidos_excel.php';
    
    header("Content-type: application/vnd.ms-$tipo");
    header("Content-Disposition: attachment; filename=reporte_pedidos_excel$extension");
    header("Pragma: no-cache");
    header("Expires: 0");    

?>