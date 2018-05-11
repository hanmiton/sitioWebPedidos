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

$cantidad=$_REQUEST['cantidad'];

$opcion =$_REQUEST['bt_opcion'];
/////////validar datos //////////////////////////////


switch($opcion) {



	

	
case 'Buscar':
  


header("Location: elaborar_rutas.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&numero_pedido=".$numero_pedido."&opcion=Buscar");
mysql_free_result($result);
break;

			
case 'Guardar Ruta':
  
  $mismos=0;
  for ($i=1;$i<=$cantidad;$i++)
		{
			for ($j=1;$j<=$cantidad;$j++)
			{
			    if ($i!=$j)
				{
				   if ($_REQUEST['listaruta'.$j]==$_REQUEST['listaruta'.$i])
				   {
				     $mismos=1;
					 break;
				   }
				}
			}
		}
  
  if ($mismos==0)
  {
  
for ($i=1;$i<=$cantidad;$i++)
		{
		$orden_ruta=$_REQUEST['listaruta'.$i];
		$id_cliente=$_REQUEST['id_cliente'.$i];
		$id_ciudad=$_REQUEST['id_ciudad'.$i];
		$id_chofer=$_REQUEST['id_chofer'.$i];
		echo $id_ciudad." ";
		echo $id_chofer." ";
		echo $id_cliente." ";
$query = "UPDATE pedido as pedido1 inner join viaje as viaje1 ON viaje1.numero_pedido=pedido1.numero_pedido INNER JOIN proveedor as proveedor1 ON proveedor1.id_proveedor=pedido1.id_proveedor INNER JOIN cliente as cliente1 ON cliente1.id_cliente=pedido1.id_cliente INNER JOIN producto as producto1 ON producto1.id_producto=pedido1.id_producto INNER JOIN ciudad as ciudad1 ON cliente1.id_ciudad=ciudad1.id_ciudad INNER JOIN chofer as chofer1 ON chofer1.id_chofer=viaje1.id_chofer SET  pedido1.orden_ruta='".$orden_ruta."' where pedido1.numero_pedido='".$numero_pedido."' and cliente1.id_cliente='".$id_cliente."' and ciudad1.id_ciudad='".$id_ciudad."'  and chofer1.id_chofer='".$id_chofer."'";
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
mysql_free_result($result);
		
		}
		

header("Location: elaborar_rutas.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&numero_pedido=".$numero_pedido."&opcion=Guardar Ruta&mensaje=Ruta guardada correctamente");
}
else
{
header("Location: elaborar_rutas.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&numero_pedido=".$numero_pedido."&opcion=Guardar Ruta&mensaje=Eliga el orden de la ruta correctamente");
}

break;

	
}
?>

