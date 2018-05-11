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

$numero_pedido=$_REQUEST['numero_pedido'];
$id_chofer=$_REQUEST['id_chofer'];
$id_ciudad=$_REQUEST['id_ciudad'];
$id_cliente=$_REQUEST['id_cliente'];
$nombre_cliente=$_REQUEST['nombre_cliente'];
$nombre_ciudad=$_REQUEST['nombre_ciudad'];

$nombre_chofer=$nombre_usuario;

$opcion =$_REQUEST['bt_opcion'];
/////////validar datos //////////////////////////////


switch($opcion) {



case 'Guardar':



if(isset($_REQUEST['entrega']))
{
       $entrega=1;
       $acta = $_FILES['acta']['name'];
        $ruta = $_FILES['acta']['tmp_name'];

        $foto=mysql_real_escape_string(file_get_contents($ruta));

		$query = "UPDATE pedido as pedido1 inner join viaje as viaje1 ON viaje1.numero_pedido=pedido1.numero_pedido INNER JOIN proveedor as proveedor1 ON proveedor1.id_proveedor=pedido1.id_proveedor INNER JOIN cliente as cliente1 ON cliente1.id_cliente=pedido1.id_cliente INNER JOIN producto as producto1 ON producto1.id_producto=pedido1.id_producto INNER JOIN ciudad as ciudad1 ON cliente1.id_ciudad=ciudad1.id_ciudad INNER JOIN chofer as chofer1 ON chofer1.id_chofer=viaje1.id_chofer SET  pedido1.estado_pedido='1', pedido1.acta='".$foto."' where pedido1.numero_pedido='".$numero_pedido."' and cliente1.id_cliente='".$id_cliente."' and ciudad1.id_ciudad='".$id_ciudad."'  and chofer1.id_chofer='".$id_chofer."'";

$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
mysql_free_result($result);


header("Location: entregar_pedidos1.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&numero_pedido=". $numero_pedido."&id_cliente=".$id_cliente."&id_chofer=".$id_chofer."&nombre_chofer=".$nombre_chofer."&id_cliente=".$id_cliente."&id_ciudad=".$id_ciudad."&nombre_cliente=".$nombre_cliente."&nombre_ciudad=".$nombre_ciudad."&opcion=Guardar&entregado=checked&mensaje=Pedido Entregado");

}

else
{


	$query = "UPDATE pedido as pedido1 inner join viaje as viaje1 ON viaje1.numero_pedido=pedido1.numero_pedido INNER JOIN proveedor as proveedor1 ON proveedor1.id_proveedor=pedido1.id_proveedor INNER JOIN cliente as cliente1 ON cliente1.id_cliente=pedido1.id_cliente INNER JOIN producto as producto1 ON producto1.id_producto=pedido1.id_producto INNER JOIN ciudad as ciudad1 ON cliente1.id_ciudad=ciudad1.id_ciudad INNER JOIN chofer as chofer1 ON chofer1.id_chofer=viaje1.id_chofer SET  pedido1.estado_pedido='0', pedido1.acta=NULL where pedido1.numero_pedido='".$numero_pedido."' and cliente1.id_cliente='".$id_cliente."' and ciudad1.id_ciudad='".$id_ciudad."'  and chofer1.id_chofer='".$id_chofer."'";

$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
mysql_free_result($result);
header("Location: entregar_pedidos1.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&numero_pedido=". $numero_pedido."&id_cliente=".$id_cliente."&id_chofer=".$id_chofer."&id_cliente=".$id_cliente."&id_ciudad=".$id_ciudad."&nombre_cliente=".$nombre_cliente."&nombre_ciudad=".$nombre_ciudad."&opcion=Guardar&entregado=&mensaje=");
}

	break;
	

	case 'Buscar':
  


header("Location: entregar_pedidos.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&numero_pedido=".$numero_pedido."&id_chofer=".$id_chofer."&opcion=Buscar");
mysql_free_result($result);
break;

		

	
}
?>

