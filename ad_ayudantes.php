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

$id_ayudante=$_REQUEST['text_cedula'];
$nombre_ayudante=$_REQUEST['text_nombre'];
$direccion_ayudante=$_REQUEST['text_direccion'];
$telefono_ayudante=$_REQUEST['text_telefono'];
$disponible_ayudante=$_REQUEST['text_disponible'];
$opcion =$_REQUEST['bt_opcion'];

/////////validar datos //////////////////////////////


switch($opcion) {
case 'Nuevo':
header("Location: administrar_ayudantes.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=Ingrese un nuevo ayudante");
break;
case 'Guardar':

		
	$id_ayudante1="";
	$nombre_ayudante1="";
	$direccion_ayudante1="";
	$telefono_ayudante1="";
	
	
	if (validar_cedula($id_ayudante)==false)
	 {
	  $id_ayudante1="Cédula;";
	 }
	  
	 if (validar_nombre($nombre_ayudante)==false)
	 {
	  $nombre_ayudante1="Nombres;";
	 }
	   if (validar_direccion($direccion_ayudante)==false)
	 {
	  $direccion_ayudante1="Dirección;";
	 }
	
	if (validar_telefono($telefono_ayudante)==false)
	 {
	  $telefono_ayudante1="Teléfono;";
	 }
	
	
    $query = "SELECT id_ayudante,nombre_ayudante  FROM ayudante WHERE id_ayudante='".$id_ayudante."'";
	mysql_query("SET NAMES 'UTF8'");
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	while ($line= mysql_fetch_array($result))
	{
		 $nombre1=$line['nombre_ayudante'];
	}
	if (empty($nombre1))
	{
	
		if ((validar_cedula($id_ayudante)==true) && (validar_telefono($telefono_ayudante)==true) && (validar_direccion($direccion_ayudante)==true) && (validar_nombre($nombre_ayudante)==true))
		{ 
	
			$query = "INSERT INTO ayudante(id_ayudante,nombre_ayudante,direccion_ayudante,telefono_ayudante,disponible_ayudante) VALUES ('".$id_ayudante."','".$nombre_ayudante."','". $direccion_ayudante."','".$telefono_ayudante."','".$disponible_ayudante."')";
			$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
			mysql_free_result($result);
			header("Location: administrar_ayudantes.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=Datos ingresados correctamente");
		}
		else
		{
		header("Location: administrar_ayudantes.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&id_ayudante=".$id_ayudante."&nombre_ayudante=".$nombre_ayudante."&direccion_ayudante=".$direccion_ayudante."&telefono_ayudante=".$telefono_ayudante."&disponible_ayudante=".$disponible_ayudante."&mensaje=Datos mal Ingresados: ".$id_ayudante1." ".$nombre_ayudante1." ".$direccion_ayudante1." ".$telefono_ayudante1." ");
		}
			
	
	}
	else
	{
	mysql_free_result($result);
    header("Location: administrar_ayudantes.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=El ayudante ya existe");
	}
break;
case 'Modificar':


    $id_ayudante1="";
	$nombre_ayudante1="";
	$direccion_ayudante1="";
	$telefono_ayudante1="";
	
	if (validar_cedula($id_ayudante)==false)
	 {
	  $id_ayudante1="Cédula;";
	 }
	  
	 if (validar_nombre($nombre_ayudante)==false)
	 {
	  $nombre_ayudante1="Nombres;";
	 }
	   if (validar_direccion($direccion_ayudante)==false)
	 {
	  $direccion_ayudante1="Dirección;";
	 }
	
	if (validar_telefono($telefono_ayudante)==false)
	 {
	  $telefono_ayudante1="Teléfono;";
	 }
	
  	 $query = "SELECT id_ayudante,nombre_ayudante  FROM ayudante WHERE id_ayudante='".$id_ayudante."'";
	mysql_query("SET NAMES 'UTF8'");
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	while ($line= mysql_fetch_array($result))
	{
		 $nombre1=$line['nombre_ayudante'];
	}
	
	if (empty($nombre1))
	{
	header("Location: administrar_ayudantes.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=No existe el ayudante");
	mysql_free_result($result);
	break;
	}
	
	
	if ((validar_cedula($id_ayudante)==true) && (validar_telefono($telefono_ayudante)==true) && (validar_direccion($direccion_ayudante)==true) && (validar_nombre($nombre_ayudante)==true))
		{ 
	
	$query = "UPDATE ayudante SET nombre_ayudante='".$nombre_ayudante."', direccion_ayudante='".$direccion_ayudante."', telefono_ayudante='".$telefono_ayudante."', disponible_ayudante='".$disponible_ayudante."' WHERE id_ayudante='".$id_ayudante."'";
	mysql_query("SET NAMES 'UTF8'");
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	mysql_free_result($result);

	header("Location: administrar_ayudantes.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=Datos modificados correctamente");
	break;
	}
	else
		{
		header("Location: administrar_ayudantes.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&id_ayudante=".$id_ayudante."&nombre_ayudante=".$nombre_ayudante."&direccion_ayudante=".$direccion_ayudante."&telefono_ayudante=".$telefono_ayudante."&disponible_ayudante=".$disponible_ayudante."&mensaje=Datos mal Ingresados: ".$id_ayudante1." ".$nombre_ayudante1." ".$direccion_ayudante1." ".$telefono_ayudante1." ");
		break;
		}
	

case 'Buscar':

	$query = "SELECT id_ayudante,nombre_ayudante,direccion_ayudante,telefono_ayudante,disponible_ayudante  FROM ayudante WHERE id_ayudante='".$id_ayudante."'";
	mysql_query("SET NAMES 'UTF8'");
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	
	while ($line= mysql_fetch_array($result))
	{
		 $id_ayudante=$line['id_ayudante'];
		 $nombre_ayudante=$line['nombre_ayudante'];
		 $direccion_ayudante=$line['direccion_ayudante'];
		 $telefono_ayudante=$line['telefono_ayudante'];
		 $disponible_ayudante=$line['disponible_ayudante'];
		 $id_ayudante1=$line['id_ayudante'];
	}
	
	if (empty($id_ayudante1))
	{
	header("Location: administrar_ayudantes.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=No existe el ayudante");
	mysql_free_result($result);
	break;
	}
	else
	{
	header("Location: administrar_ayudantes.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&id_ayudante=".$id_ayudante."&nombre_ayudante=".$nombre_ayudante."&direccion_ayudante=".$direccion_ayudante."&telefono_ayudante=".$telefono_ayudante."&disponible_ayudante=".$disponible_ayudante."");
	}
	mysql_free_result($result);
break;


case 'Eliminar':


	$query = "SELECT id_ayudante,nombre_ayudante,direccion_ayudante,telefono_ayudante,disponible_ayudante  FROM ayudante WHERE id_ayudante='".$id_ayudante."'";
	mysql_query("SET NAMES 'UTF8'");
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	while ($line= mysql_fetch_array($result))
	{
		 $nombre1=$line['nombre_ayudante'];
	}
	if (empty($nombre1))
	{
	header("Location: administrar_ayudantes.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=No existe el ayudante");
	mysql_free_result($result);
	}
	else
	{
    $query = "DELETE FROM ayudante WHERE id_ayudante='".$id_ayudante."'";
	mysql_query("SET NAMES 'UTF8'");
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
    header("Location: administrar_ayudantes.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=Ayudante eliminado correctamente");
	}
	mysql_free_result($result);
	break;
	

}
?>

