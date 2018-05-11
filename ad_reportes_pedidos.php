<?php
// Conectando, seleccionando la base de datos
include("conexion_base.php");

session_start();
$sesion_usuario=$_SESSION['id_usuario'];
if (!isset($sesion_usuario)) {
   header('Location: index.php');
   break;
}

////////parametros//////////////

$id_usuario=$_REQUEST['id_usuario'];
$nombre_usuario=$_REQUEST['nombre_usuario'];
$nombre_rol=$_REQUEST['nombre_rol'];

////////// formulario //////////////////////

$numero_pedido=$_REQUEST['text_numero'];
//$fecha_pedido=$_GET['text_fecha'];



$opcion =$_REQUEST['bt_opcion'];
/////////validar datos //////////////////////////////


switch($opcion) {

	
	
case 'Buscar':
  
   
$query = "SELECT numero_pedido,estado_pedido, asignado_pedido,fecha_pedido FROM pedido WHERE numero_pedido='".$numero_pedido."' GROUP BY (estado_pedido)";
mysql_query("SET NAMES 'UTF8'");
$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());

while ($line= mysql_fetch_array($result))
	{
		 $estado=$line['numero_pedido'];
		 $estado_pedido=$line['estado_pedido'];
		 $asignado_pedido=$line['asignado_pedido'];
		 $fecha_pedido=$line['fecha_pedido'];
	}

if (empty($estado))
{
header("Location: reporte_pedidos.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&numero_pedido=".$numero_pedido."&fecha_pedido=&asignado_pedido=0&estado_pedido=0&opcion=Buscar&mensaje=");
mysql_free_result($result);
break;
}
else
{
header("Location: reporte_pedidos.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&numero_pedido=".$numero_pedido."&fecha_pedido=".$fecha_pedido."&asignado_pedido=".$asignado_pedido."&estado_pedido=".$estado_pedido."&opcion=Buscar");
mysql_free_result($result);
break;
}
		

	
	
case 'Buscar1':
  
   
$query = "SELECT numero_pedido,estado_pedido, asignado_pedido,fecha_pedido FROM pedido WHERE numero_pedido='".$numero_pedido."' GROUP BY (estado_pedido)";
mysql_query("SET NAMES 'UTF8'");
$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());

while ($line= mysql_fetch_array($result))
	{
		 $estado=$line['numero_pedido'];
		 $estado_pedido=$line['estado_pedido'];
		 $asignado_pedido=$line['asignado_pedido'];
		 $fecha_pedido=$line['fecha_pedido'];
	}

if (empty($estado))
{
header("Location: reporte_pedidos_elaborados.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&numero_pedido=".$numero_pedido."&fecha_pedido=&asignado_pedido=0&estado_pedido=0&opcion=Buscar1&mensaje=");
mysql_free_result($result);
break;
}
else
{
header("Location: reporte_pedidos_elaborados.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&numero_pedido=".$numero_pedido."&fecha_pedido=".$fecha_pedido."&asignado_pedido=".$asignado_pedido."&estado_pedido=".$estado_pedido."&opcion=Buscar1");
mysql_free_result($result);
break;
}

case 'Buscar2':
  
   
$query = "SELECT numero_pedido,estado_pedido, asignado_pedido,fecha_pedido FROM pedido WHERE numero_pedido='".$numero_pedido."' GROUP BY (estado_pedido)";
mysql_query("SET NAMES 'UTF8'");
$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());

while ($line= mysql_fetch_array($result))
	{
		 $estado=$line['numero_pedido'];
		 $estado_pedido=$line['estado_pedido'];
		 $asignado_pedido=$line['asignado_pedido'];
		 $fecha_pedido=$line['fecha_pedido'];
	}

if (empty($estado))
{
header("Location: reporte_pedidos_entregados.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&numero_pedido=".$numero_pedido."&fecha_pedido=&asignado_pedido=0&estado_pedido=0&opcion=Buscar2&mensaje=");
mysql_free_result($result);
break;
}
else
{
header("Location: reporte_pedidos_entregados.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&numero_pedido=".$numero_pedido."&fecha_pedido=".$fecha_pedido."&asignado_pedido=".$asignado_pedido."&estado_pedido=".$estado_pedido."&opcion=Buscar2");
mysql_free_result($result);
break;
}


	
}
?>

