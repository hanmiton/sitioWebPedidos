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


$numero_pedido='';
$id_chofer='';
$id_camion='';
$id_ayudante='';
$fecha_salida='';
$fecha_llegada='';
$numero_pedido1='';

if (!empty($_REQUEST['text_pedido']))
{
$numero_pedido=$_REQUEST['text_pedido'];
}
if (!empty($_REQUEST['text_chofer']))
{
$id_chofer=$_REQUEST['text_chofer'];
}
if (!empty($_REQUEST['text_camion']))
{
$id_camion=$_REQUEST['text_camion'];
}
if (!empty($_REQUEST['text_ayudante']))
{
$id_ayudante=$_REQUEST['text_ayudante'];
}
if (!empty($_REQUEST['text_pedido1']))
{
$numero_pedido1=$_REQUEST['text_pedido1'];
}
$fecha_salida=$_REQUEST['text_fechas'];
$fecha_llegada=$_REQUEST['text_fechal'];


$opcion =$_REQUEST['bt_opcion'];
/////////validar datos //////////////////////////////


switch($opcion) {
case 'Asignar Viaje':

 
header("Location: gestionar_viajes.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&numero_pedido=".$numero_pedido."&fecha_pedido=".$fecha_pedido."&opcion=Asignar Viaje&mensaje=Asigne un nuevo viaje");
break;

case 'Elaborar':

	if (empty($fecha_salida) || empty($fecha_llegada) || empty($id_chofer) || empty($id_camion) || empty($id_ayudante) || empty($numero_pedido)) 
	{
	$fecha_salida='';
	$fecha_llegada='';
	header("Location: elaborar_viajes.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&numero_pedido=".$numero_pedido."&id_chofer=".$id_chofer."&id_camion=".$id_camion."&id_ayudante=".$id_ayudante."&fecha_salida=".$fecha_salida."&fecha_llegada=".$fecha_llegada."&opcion=Elaborar&mensaje=Datos mal Ingresados");
	break;
	}
  

	
  	$query = "INSERT INTO viaje(numero_pedido, id_chofer, id_camion,id_ayudante,fecha_salida,fecha_llegada) VALUES ('".$numero_pedido."','".$id_chofer."','".$id_camion."','".$id_ayudante."',date('".$fecha_salida."'),date('".$fecha_llegada."'))";
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	mysql_free_result($result);
	
	
	$query = "UPDATE pedido SET asignado_pedido='1' WHERE numero_pedido='".$numero_pedido."'";
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	mysql_free_result($result);
	
	
	
	
	$query = "UPDATE chofer SET disponible_chofer='0' WHERE id_chofer='".$id_chofer."'";
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	mysql_free_result($result);
	

	$query = "UPDATE camion SET disponible_camion='0' WHERE id_camion='".$id_camion."'";
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	mysql_free_result($result);
	

	$query = "UPDATE ayudante SET disponible_ayudante='0' WHERE id_ayudante='".$id_ayudante."'";
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	mysql_free_result($result);
	
	
	header("Location: elaborar_viajes.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&numero_pedido=".$numero_pedido."&id_chofer=".$id_chofer."&id_camion=".$id_camion."&id_ayudante=".$id_ayudante."&fecha_salida=".$fecha_salida."&fecha_llegada=".$fecha_llegada."&opcion=Elaborar");
		break;


case 'Eliminar':

    $query = "DELETE FROM viaje WHERE id_chofer='".$id_chofer."' and id_camion='".$id_camion."' and id_ayudante='".$id_ayudante."'  and numero_pedido='".$numero_pedido."'";
	mysql_query("SET NAMES 'UTF8'");
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	mysql_free_result($result);
	
	$query = "UPDATE pedido SET asignado_pedido='0' WHERE numero_pedido='".$numero_pedido."'";
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	mysql_free_result($result);
	
	
	
		$query = "UPDATE chofer SET disponible_chofer='1' WHERE id_chofer='".$id_chofer."'";
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	mysql_free_result($result);
	

	$query = "UPDATE camion SET disponible_camion='1' WHERE id_camion='".$id_camion."'";
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	mysql_free_result($result);
	

	$query = "UPDATE ayudante SET disponible_ayudante='1' WHERE id_ayudante='".$id_ayudante."'";
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	mysql_free_result($result);
	
	
    header("Location: elaborar_viajes.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&numero_pedido=".$numero_pedido."&opcion=Eliminar");
	
	break;
	
	
	case 'Cerrar':
	
	
	

$query = "SELECT COUNT(estado_pedido) as cantidad_estados_pedido FROM pedido INNER JOIN viaje ON viaje.numero_pedido=pedido.numero_pedido  INNER JOIN cliente ON cliente.id_cliente=pedido.id_cliente INNER JOIN producto ON producto.id_producto=pedido.id_producto INNER JOIN ciudad ON cliente.id_ciudad=ciudad.id_ciudad INNER JOIN chofer ON chofer.id_chofer=viaje.id_chofer WHERE  pedido.numero_pedido='".$numero_pedido."'" ;	
	
mysql_query("SET NAMES 'UTF8'");
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

while ($line= mysql_fetch_array($result)) 
{ 
$cantidad_estados_pedido=$line['cantidad_estados_pedido'];

}
	mysql_free_result($result);
	
$query = "SELECT COUNT(estado_pedido) as cantidad_estados_entregados FROM pedido INNER JOIN viaje ON viaje.numero_pedido=pedido.numero_pedido  INNER JOIN cliente ON cliente.id_cliente=pedido.id_cliente INNER JOIN producto ON producto.id_producto=pedido.id_producto INNER JOIN ciudad ON cliente.id_ciudad=ciudad.id_ciudad INNER JOIN chofer ON chofer.id_chofer=viaje.id_chofer WHERE  pedido.numero_pedido='".$numero_pedido."' and pedido.estado_pedido='1'" ;	
	
mysql_query("SET NAMES 'UTF8'");
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

while ($line= mysql_fetch_array($result)) 
{ 
$cantidad_estados_entregados=$line['cantidad_estados_entregados'];

}
	mysql_free_result($result);
	
	
	if ($cantidad_estados_pedido==$cantidad_estados_entregados)
	{
	

  $query = "UPDATE viaje SET estado_viaje='1' WHERE id_chofer='".$id_chofer."' and id_camion='".$id_camion."' and id_ayudante='".$id_ayudante."'  and numero_pedido='".$numero_pedido."'";
  
  
	mysql_query("SET NAMES 'UTF8'");
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	mysql_free_result($result);

	
	$query = "UPDATE chofer SET disponible_chofer='1' WHERE id_chofer='".$id_chofer."'";
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	mysql_free_result($result);
	

	$query = "UPDATE camion SET disponible_camion='1' WHERE id_camion='".$id_camion."'";
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	mysql_free_result($result);
	

	$query = "UPDATE ayudante SET disponible_ayudante='1' WHERE id_ayudante='".$id_ayudante."'";
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	mysql_free_result($result);
	
	
    header("Location: elaborar_viajes.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&numero_pedido=".$numero_pedido."&opcion=Eliminar&mensaje=Viaje cerrado Correctamente");
	}
	else
	{
	
	 header("Location: elaborar_viajes.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&numero_pedido=".$numero_pedido."&opcion=Eliminar&mensaje=No se puede cerrar el viaje 'Debe entregar todo el pedido'");
	}
	
	break;
	
	

case 'Cancelar':
    
    header("Location: elaborar_viajes.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&opcion=Cancelar");

	break;
	

	
	case 'Buscar':
  
 header("Location: elaborar_viajes.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&numero_pedido1=".$numero_pedido1."&opcion=Buscar");
	mysql_free_result($result);
	break;
	
	
	case 'Cerrar Viaje':

header("Location: elaborar_viajes.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&opcion=Cerrar Viaje&mensaje=Cierre un viaje");
break;
	
}
?>

