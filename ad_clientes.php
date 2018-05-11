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

$id_cliente=$_REQUEST['text_cedula'];
$nombre_cliente=$_REQUEST['text_nombre'];
$direccion_cliente=$_REQUEST['text_direccion'];
$telefono_cliente=$_REQUEST['text_telefono'];
$id_ciudad=$_REQUEST['text_ciudad'];
$opcion =$_REQUEST['bt_opcion'];

/////////validar datos //////////////////////////////


switch($opcion) {
case 'Nuevo':
header("Location: administrar_clientes.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=Ingrese un nuevo cliente");
break;
case 'Guardar':

	if (empty($id_cliente) || empty($nombre_cliente) || empty($telefono_cliente) ||  empty($direccion_cliente) ||  empty($id_ciudad)) 
	
	
	
	$id_cliente1="";
	$nombre_cliente1="";
	$telefono_cliente1="";
	$direccion_cliente1="";
		
	if (validar_idcliente($id_cliente)==false)
	 {
	  $id_cliente1="Id Cliente;";
	 }
	  
	 if (validar_nombre($nombre_cliente)==false)
	 {
	  $nombre_cliente1="Nombres;";
	 }
	   if (validar_direccion($direccion_cliente)==false)
	 {
	  $direccion_cliente1="Dirección;";
	 }
	
	if (validar_telefono($telefono_cliente)==false)
	 {
	  $telefono_cliente1="Teléfono;";
	 }
	 if (validar_ciudad($id_ciudad)==false)
	 {
	  $ciudad_cliente1="Ciudad;";
	 }
	
	
	
	
    $query = "SELECT id_cliente,nombre_cliente,direccion_cliente,telefono_cliente FROM cliente WHERE id_cliente='".$id_cliente."'";
	mysql_query("SET NAMES 'UTF8'");
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	while ($line= mysql_fetch_array($result))
	{
		 $nombre1=$line['nombre_cliente'];
	}
	if (empty($nombre1))
	{
	
		
	if ((validar_idcliente($id_cliente)==true) && (validar_telefono($telefono_cliente)==true) && (validar_direccion($direccion_cliente)==true) && (validar_nombre($nombre_cliente)==true) && (validar_ciudad($id_ciudad)==true))
		{ 
			$query = "INSERT INTO cliente(id_cliente, nombre_cliente, direccion_cliente,telefono_cliente,id_ciudad) VALUES ('".$id_cliente."','".$nombre_cliente."','".$direccion_cliente."','".$telefono_cliente."','".$id_ciudad."')";
			$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
			mysql_free_result($result);
			header("Location: administrar_clientes.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=Datos ingresados correctamente");
			}
			else
			{
			
			header("Location: administrar_clientes.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&id_cliente=".$id_cliente."&nombre_cliente=".$nombre_cliente."&direccion_cliente=".$direccion_cliente."&telefono_cliente=".$telefono_cliente."&id_ciudad=".$id_ciudad."&nombre_ciudad=".$nombre_ciudad."&mensaje=Datos mal Ingresados: ".$id_cliente1." ".$nombre_cliente1." ".$direccion_cliente1." ".$telefono_cliente1." ".$ciudad_cliente1." ");
		break;
			}
	
	}
	else
	{
	mysql_free_result($result);
    header("Location: administrar_clientes.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=El cliente ya existe");
	}
break;
case 'Modificar':


$id_cliente1="";
	$nombre_cliente1="";
	$telefono_cliente1="";
	$direccion_cliente1="";
		
	if (validar_idcliente($id_cliente)==false)
	 {
	  $id_cliente1="Id Cliente;";
	 }
	  
	 if (validar_nombre($nombre_cliente)==false)
	 {
	  $nombre_cliente1="Nombres;";
	 }
	   if (validar_direccion($direccion_cliente)==false)
	 {
	  $direccion_cliente1="Dirección;";
	 }
	
	if (validar_telefono($telefono_cliente)==false)
	 {
	  $telefono_cliente1="Teléfono;";
	 }
	 if (validar_ciudad($id_ciudad)==false)
	 {
	  $ciudad_cliente1="Ciudad;";
	 }
	
	
	$query = "SELECT id_cliente,nombre_cliente,direccion_cliente,telefono_cliente FROM cliente WHERE id_cliente='".$id_cliente."'";
	mysql_query("SET NAMES 'UTF8'");
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	while ($line= mysql_fetch_array($result))
	{
		 $nombre1=$line['nombre_cliente'];
	}
	
	if (empty($nombre1))
	{
	header("Location: administrar_usuarios.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=No existe el cliente");
	mysql_free_result($result);
	break;
	}
	
	
		
	if ((validar_idcliente($id_cliente)==true) && (validar_telefono($telefono_cliente)==true) && (validar_direccion($direccion_cliente)==true) && (validar_nombre($nombre_cliente)==true) && (validar_ciudad($id_ciudad)==true))
		{ 
		
		$query = "UPDATE cliente SET nombre_cliente='".$nombre_cliente."', direccion_cliente='".$direccion_cliente."', telefono_cliente='".$telefono_cliente."', id_ciudad='".$id_ciudad."' WHERE id_cliente='".$id_cliente."'";
		mysql_query("SET NAMES 'UTF8'");
		$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
		mysql_free_result($result);
			
		header("Location: administrar_clientes.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=Datos modificados correctamente");
		break;
		}
		
		else
			{
			
			header("Location: administrar_clientes.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&id_cliente=".$id_cliente."&nombre_cliente=".$nombre_cliente."&direccion_cliente=".$direccion_cliente."&telefono_cliente=".$telefono_cliente."&id_ciudad=".$id_ciudad."&nombre_ciudad=".$nombre_ciudad."&mensaje=Datos mal Ingresados: ".$id_cliente1." ".$nombre_cliente1." ".$direccion_cliente1." ".$telefono_cliente1." ".$ciudad_cliente1." ");
		break;
			}
		

case 'Buscar':

	$query = "SELECT id_cliente,nombre_cliente,direccion_cliente,telefono_cliente,ciudad.id_ciudad,nombre_ciudad  FROM cliente INNER JOIN ciudad ON cliente.id_ciudad=ciudad.id_ciudad WHERE cliente.id_cliente='".$id_cliente."'";
	mysql_query("SET NAMES 'UTF8'");
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	
	while ($line= mysql_fetch_array($result))
	{
		 $id_cliente=$line['id_cliente'];
		 $nombre_cliente=$line['nombre_cliente'];
		 $direccion_cliente=$line['direccion_cliente'];
		 $telefono_cliente=$line['telefono_cliente'];
		 $id_ciudad=$line['id_ciudad'];
		 $nombre_ciudad=$line['nombre_ciudad'];
		 $ud_usu1=$line['id_cliente'];
	}
	
	if (empty($ud_usu1))
	{
	header("Location: administrar_clientes.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=No existe el cliente");
	mysql_free_result($result);
	break;
	}
	else
	{
	header("Location: administrar_clientes.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&id_cliente=".$id_cliente."&nombre_cliente=".$nombre_cliente."&direccion_cliente=".$direccion_cliente."&telefono_cliente=".$telefono_cliente."&id_ciudad=".$id_ciudad."&nombre_ciudad=".$nombre_ciudad."");
	}
	mysql_free_result($result);
break;


case 'Eliminar':


	$query = "SELECT id_cliente,nombre_cliente,direccion_cliente,telefono_cliente FROM cliente WHERE id_cliente='".$id_cliente."'";
	mysql_query("SET NAMES 'UTF8'");
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	while ($line= mysql_fetch_array($result))
	{
		 $nombre1=$line['nombre_cliente'];
	}
	if (empty($nombre1))
	{
	header("Location: administrar_clientes.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=No existe el cliente");
	mysql_free_result($result);
	}
	else
	{
    $query = "DELETE FROM cliente WHERE id_cliente='".$id_cliente."'";
	mysql_query("SET NAMES 'UTF8'");
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
    header("Location: administrar_clientes.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=Cliente eliminado correctamente");
	}
	mysql_free_result($result);
	break;
	

}
?>

