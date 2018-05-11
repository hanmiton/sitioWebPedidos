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

$id_chofer=$_REQUEST['text_cedula'];
$nombre_chofer=$_REQUEST['text_nombre'];
$direccion_chofer=$_REQUEST['text_direccion'];
$telefono_chofer=$_REQUEST['text_telefono'];
$disponible_chofer=$_REQUEST['text_disponible'];
$opcion =$_REQUEST['bt_opcion'];

/////////validar datos //////////////////////////////


switch($opcion) {
case 'Nuevo':
header("Location: administrar_conductores.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=Ingrese un nuevo chofer");
break;
case 'Guardar':

	
	$id_chofer1="";
	$nombre_chofer1="";
	$direccion_chofer1="";
	$telefono_chofer1="";
	
	
	if (validar_cedula($id_chofer)==false)
	 {
	  $id_chofer1="Cédula;";
	 }
	  
	 if (validar_nombre($nombre_chofer)==false)
	 {
	  $nombre_chofer1="Nombres;";
	 }
	   if (validar_direccion($direccion_chofer)==false)
	 {
	  $direccion_chofer1="Dirección;";
	 }
	
	if (validar_telefono($telefono_chofer)==false)
	 {
	  $telefono_chofer1="Teléfono;";
	 }
	
	
	
    $query = "SELECT id_chofer,nombre_chofer  FROM chofer WHERE id_chofer='".$id_chofer."'";
	mysql_query("SET NAMES 'UTF8'");
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	while ($line= mysql_fetch_array($result))
	{
		 $nombre1=$line['nombre_chofer'];
	}
	if (empty($nombre1))
	{
	
	if ((validar_cedula($id_chofer)==true) && (validar_telefono($telefono_chofer)==true) && (validar_direccion($direccion_chofer)==true) && (validar_nombre($nombre_chofer)==true))
		{ 
	
	
				$query = "INSERT INTO chofer(id_chofer,nombre_chofer,direccion_chofer,telefono_chofer,disponible_chofer) VALUES ('".$id_chofer."','".$nombre_chofer."','".$direccion_chofer."','".$telefono_chofer."','".$disponible_chofer."')";
				$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
				mysql_free_result($result);
				header("Location: administrar_conductores.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=Datos ingresados correctamente");
		}
		else
		{
		header("Location: administrar_conductores.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&id_chofer=".$id_chofer."&nombre_chofer=".$nombre_chofer."&direccion_chofer=".$direccion_chofer."&telefono_chofer=".$telefono_chofer."&disponible_chofer=".$disponible_chofer."&mensaje=Datos mal Ingresados: ".$id_chofer1." ".$nombre_chofer1." ".$direccion_chofer1." ".$telefono_chofer1." ");
		}		
	
	}
	else
	{
	mysql_free_result($result);
    header("Location: administrar_conductores.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=El conductor ya existe");
	}
break;
case 'Modificar':


$id_chofer1="";
	$nombre_chofer1="";
	$direccion_chofer1="";
	$telefono_chofer1="";
	
	
	if (validar_cedula($id_chofer)==false)
	 {
	  $id_chofer1="Cédula;";
	 }
	  
	 if (validar_nombre($nombre_chofer)==false)
	 {
	  $nombre_chofer1="Nombres;";
	 }
	   if (validar_direccion($direccion_chofer)==false)
	 {
	  $direccion_chofer1="Dirección;";
	 }
	
	if (validar_telefono($telefono_chofer)==false)
	 {
	  $telefono_chofer1="Teléfono;";
	 }
	
	


	
	 $query = "SELECT id_chofer,nombre_chofer  FROM chofer WHERE id_chofer='".$id_chofer."'";
	mysql_query("SET NAMES 'UTF8'");
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	while ($line= mysql_fetch_array($result))
	{
		 $nombre1=$line['nombre_chofer'];
	}
	
	if (empty($nombre1))
	{
	header("Location: administrar_conductores.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=No existe el chofer");
	mysql_free_result($result);
	break;
	}
	
	
	if ((validar_cedula($id_chofer)==true) && (validar_telefono($telefono_chofer)==true) && (validar_direccion($direccion_chofer)==true) && (validar_nombre($nombre_chofer)==true))
		{ 
	
	$query = "UPDATE chofer SET nombre_chofer='".$nombre_chofer."', direccion_chofer='".$direccion_chofer."', telefono_chofer='".$telefono_chofer."', disponible_chofer='".$disponible_chofer."' WHERE id_chofer='".$id_chofer."'";
	mysql_query("SET NAMES 'UTF8'");
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	mysql_free_result($result);
    

	header("Location: administrar_conductores.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=Datos modificados correctamente");
	break;
	}
	else
	{
	
	header("Location: administrar_conductores.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&id_chofer=".$id_chofer."&nombre_chofer=".$nombre_chofer."&direccion_chofer=".$direccion_chofer."&telefono_chofer=".$telefono_chofer."&disponible_chofer=".$disponible_chofer."&mensaje=Datos mal Ingresados: ".$id_chofer1." ".$nombre_chofer1." ".$direccion_chofer1." ".$telefono_chofer1." ");
	break;
	}







case 'Buscar':

	$query = "SELECT id_chofer,nombre_chofer,direccion_chofer,telefono_chofer,disponible_chofer  FROM chofer WHERE id_chofer='".$id_chofer."'";
	mysql_query("SET NAMES 'UTF8'");
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	
	while ($line= mysql_fetch_array($result))
	{
		 $id_chofer=$line['id_chofer'];
		 $nombre_chofer=$line['nombre_chofer'];
		 $direccion_chofer=$line['direccion_chofer'];
		 $telefono_chofer=$line['telefono_chofer'];
		 $disponible_chofer=$line['disponible_chofer'];
		 $id_chofer1=$line['id_chofer'];
	}
	
	if (empty($id_chofer1))
	{
	header("Location: administrar_conductores.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=No existe el chofer");
	mysql_free_result($result);
	break;
	}
	else
	{
	header("Location: administrar_conductores.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&id_chofer=".$id_chofer."&nombre_chofer=".$nombre_chofer."&direccion_chofer=".$direccion_chofer."&telefono_chofer=".$telefono_chofer."&disponible_chofer=".$disponible_chofer."");
	}
	mysql_free_result($result);
break;


case 'Eliminar':


	$query = "SELECT id_chofer,nombre_chofer,direccion_chofer,telefono_chofer,disponible_chofer  FROM chofer WHERE id_chofer='".$id_chofer."'";
	mysql_query("SET NAMES 'UTF8'");
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	while ($line= mysql_fetch_array($result))
	{
		 $nombre1=$line['nombre_chofer'];
	}
	if (empty($nombre1))
	{
	header("Location: administrar_conductores.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=No existe el chofer");
	mysql_free_result($result);
	}
	else
	{
    $query = "DELETE FROM chofer WHERE id_chofer='".$id_chofer."'";
	mysql_query("SET NAMES 'UTF8'");
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
    header("Location: administrar_conductores.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=Chofer eliminado correctamente");
	}
	mysql_free_result($result);
	break;
	

}
?>

