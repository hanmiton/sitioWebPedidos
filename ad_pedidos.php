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
$fecha_pedido=$_REQUEST['text_fecha'];
$id_proveedor=$_REQUEST['text_proveedor'];
$id_producto=$_REQUEST['text_producto'];
$id_cliente=$_REQUEST['text_cliente'];
$cantidad_pedido=$_REQUEST['text_cantidad'];
$asignado_pedido=$_REQUEST['text_asignado'];
$estado_pedido=$_REQUEST['text_estado'];



$opcion =$_REQUEST['bt_opcion'];
/////////validar datos //////////////////////////////


switch($opcion) {
case 'Nuevo':

 $query = "SELECT MAX(numero_pedido) AS numero_maximo FROM pedido ";
	mysql_query("SET NAMES 'UTF8'");
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	while ($line= mysql_fetch_array($result))
	{
		 $numero_maximo=$line['numero_maximo'];
		 $numero_pedido=$numero_maximo+1;
	}
	mysql_free_result($result);
header("Location: elaborar_pedidos.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&numero_pedido=".$numero_pedido."&fecha_pedido=".$fecha_pedido."&opcion=Nuevo&mensaje=Ingrese un nuevo Pedido");
break;


case 'Registrar':

	if (empty($fecha_pedido) || empty($cantidad_pedido) || empty($id_proveedor) || empty($id_producto) || empty($id_cliente)) 
	{
	$fecha_pedido1="";
	$cantidad_pedido1="";
	$id_proveedor1="";
	$id_producto1="";
	$id_cliente1="";
	
	 if (empty($fecha_pedido))
	 {
	  $fecha_pedido1="Fecha;";
	 }
	  if (empty($cantidad_pedido))
	 {
	 $cantidad_pedido1="Cantidad;";
	 }
	 
	  if (empty($id_proveedor))
	 {
	 $id_proveedor1="Proveedor;";
	 }
	   if (empty($id_producto))
	 {
	 $id_producto1="Producto;";
	 }
	 
	  if (empty($id_cliente))
	 {
	 $id_cliente1="Cliente;";
	 }
	 
	 
	 
	header("Location: elaborar_pedidos.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&numero_pedido=".$numero_pedido."&fecha_pedido=".$fecha_pedido."&id_proveedor=".$id_proveedor."&id_producto=".$id_producto."&id_cliente=".$id_cliente."&asignado_pedido=".$asignado_pedido."&estado_pedido=".$estado_pedido."&opcion=Registrar&mensaje=Datos mal Ingresados: ".$fecha_pedido1." ".$cantidad_pedido1." ".$id_producto1." ".$id_cliente1." ".$id_producto1."");
	break;
	}
  
  $query = "select id_proveedor,id_producto,id_cliente,numero_pedido,fecha_pedido from pedido where numero_pedido='".$numero_pedido."' and   id_proveedor='".$id_proveedor."' and id_producto='".$id_producto."' and id_cliente='".$id_cliente."'";
	mysql_query("SET NAMES 'UTF8'");
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	
	while ($line= mysql_fetch_array($result))
	{
		 $nombre1=$line['id_proveedor'];
	}
	
	if (!empty($nombre1))
	{
header("Location: elaborar_pedidos.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&numero_pedido=".$numero_pedido."&fecha_pedido=".$fecha_pedido."&id_proveedor=".$id_proveedor."&id_producto=".$id_producto."&id_cliente=".$id_cliente."&asignado_pedido=".$asignado_pedido."&estado_pedido=".$estado_pedido."&opcion=Registrar&mensaje=El Pedido ya existe");
mysql_free_result($result);
	break;
	}
	
  	$query = "INSERT INTO pedido(numero_pedido, id_proveedor, id_producto,id_cliente,cantidad_pedido,fecha_pedido) VALUES ('".$numero_pedido."','".$id_proveedor."','".$id_producto."','".$id_cliente."','".$cantidad_pedido."',date('".$fecha_pedido."'))";
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	mysql_free_result($result);
	
	
	header("Location: elaborar_pedidos.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&numero_pedido=".$numero_pedido."&fecha_pedido=".$fecha_pedido."&id_proveedor=".$id_proveedor."&id_producto=".$id_producto."&id_cliente=".$id_cliente."&asignado_pedido=".$asignado_pedido."&estado_pedido=".$estado_pedido."&opcion=Registrar");
	mysql_free_result($result);
		
		break;


case 'Eliminar':

    $query = "DELETE FROM pedido WHERE id_proveedor='".$id_proveedor."' and id_cliente='".$id_cliente."' and id_producto='".$id_producto."'  and numero_pedido='".$numero_pedido."' and fecha_pedido=date('".$fecha_pedido."')";
	mysql_query("SET NAMES 'UTF8'");
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
    header("Location: elaborar_pedidos.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&numero_pedido=".    $numero_pedido."&fecha_pedido=".$fecha_pedido."&id_proveedor=".$id_proveedor."&id_producto=".$id_producto."&id_cliente=".$id_cliente."&asignado_pedido=".$asignado_pedido."&estado_pedido=".$estado_pedido."&opcion=Eliminar");
	mysql_free_result($result);
	break;
	

case 'Aceptar':
    //$query = "DELETE FROM pedido WHERE numero_pedido='".$numero_pedido."' and fecha_pedido=date('".$fecha_pedido."')";
	//mysql_query("SET NAMES 'UTF8'");
	//$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
    header("Location: elaborar_pedidos.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&numero_pedido=".$numero_pedido."&opcion=Aceptar");
	//mysql_free_result($result);
	break;
	
	/////////////guardar todo el pedido /////////
	
	case 'Guardar':
    $query = "UPDATE pedido SET opcion_pedido='1' WHERE id_proveedor='".$id_proveedor."' AND id_cliente='".$id_cliente."' AND id_producto='".$id_producto."'  AND numero_pedido='".$numero_pedido."'";
	mysql_query("SET NAMES 'UTF8'");
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
    header("Location: elaborar_pedidos.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&numero_pedido=".$numero_pedido."&fecha_pedido=".$fecha_pedido."&opcion=Guardar&mensaje=Pedido guardado correctamente");
	mysql_free_result($result);
	break;
	
	
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
header("Location: elaborar_pedidos.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&numero_pedido=".$numero_pedido."&fecha_pedido=&asignado_pedido=0&estado_pedido=0&opcion=Buscar&mensaje=No existe el pedido");
mysql_free_result($result);
break;
}
else
{
header("Location: elaborar_pedidos.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&numero_pedido=".$numero_pedido."&fecha_pedido=".$fecha_pedido."&asignado_pedido=".$asignado_pedido."&estado_pedido=".$estado_pedido."&opcion=Buscar");
mysql_free_result($result);
break;
}
		

	
}
?>

