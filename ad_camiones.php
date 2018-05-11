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

$id_camion=$_REQUEST['text_placa'];
$marca_camion=$_REQUEST['text_marca'];
$modelo_camion=$_REQUEST['text_modelo'];
$descripcion_camion=$_REQUEST['text_descripcion'];
$disponible_camion=$_REQUEST['text_disponible'];
$opcion =$_REQUEST['bt_opcion'];

/////////validar datos //////////////////////////////


switch($opcion) {
case 'Nuevo':
header("Location: administrar_camiones.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=Ingrese un nuevo camión");
break;
case 'Guardar':

	
	
	$id_camion1="";
	$marca_camion1="";
	$modelo_camion1="";
	$descripcion_camion1="";
	
	if (validar_idcamion($id_camion)==false)
	 {
	  $id_camion1="Placa;";
	 }
	  
	 if (validar_marca($marca_camion)==false)
	 {
	  $marca_camion1="Marca;";
	 }
	   if (validar_modelo($modelo_camion)==false)
	 {
	  $modelo_camion1="Modelo;";
	 }
	
	if (validar_descripcion($descripcion_camion)==false)
	 {
	  $descripcion_camion1="Descripción;";
	 }
	
	
	
	
	
	
    $query = "SELECT id_camion,marca_camion  FROM camion WHERE id_camion='".$id_camion."'";
	mysql_query("SET NAMES 'UTF8'");
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	while ($line= mysql_fetch_array($result))
	{
		 $nombre1=$line['marca_camion'];
	}
	if (empty($nombre1))
	{
	
		if ((validar_idcamion($id_camion)==true) && (validar_marca($marca_camion)==true) && (validar_modelo($modelo_camion)==true) && (validar_descripcion($descripcion_camion)==true))
			{ 
			$query = "INSERT INTO camion(id_camion,marca_camion,modelo_camion,descripcion_camion,disponible_camion) VALUES ('".$id_camion."','".$marca_camion."','".$modelo_camion."','".$descripcion_camion."','".$disponible_camion."')";
			$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
			mysql_free_result($result);
			header("Location: administrar_camiones.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=Datos ingresados correctamente");
			}
			else
			{
			header("Location: administrar_camiones.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&id_camion=".$id_camion."&marca_camion=".$marca_camion."&modelo_camion=".$modelo_camion."&descripcion_camion=".$descripcion_camion."&disponible_camion=".$disponible_camion."&mensaje=Datos mal Ingresados: ".$id_camion1." ".$marca_camion1." ".$modelo_camion1." ".$descripcion_camion1." ");
			}
	
	}
	else
	{
	mysql_free_result($result);
    header("Location: administrar_camiones.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=El camión ya existe");
	}
break;

case 'Modificar':

$id_camion1="";
	$marca_camion1="";
	$modelo_camion1="";
	$descripcion_camion1="";
	
	if (validar_idcamion($id_camion)==false)
	 {
	  $id_camion1="Placa;";
	 }
	  
	 if (validar_marca($marca_camion)==false)
	 {
	  $marca_camion1="Marca;";
	 }
	   if (validar_modelo($modelo_camion)==false)
	 {
	  $modelo_camion1="Modelo;";
	 }
	
	if (validar_descripcion($descripcion_camion)==false)
	 {
	  $descripcion_camion1="Descripción;";
	 }
	





	 $query = "SELECT id_camion,marca_camion  FROM camion WHERE id_camion='".$id_camion."'";
	mysql_query("SET NAMES 'UTF8'");
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	while ($line= mysql_fetch_array($result))
	{
		 $nombre1=$line['marca_camion'];
	}
	
	if (empty($nombre1))
	{
	header("Location: administrar_camiones.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=No existe el camión");
	mysql_free_result($result);
	break;
	}
	
	
		if ((validar_idcamion($id_camion)==true) && (validar_marca($marca_camion)==true) && (validar_modelo($modelo_camion)==true) && (validar_descripcion($descripcion_camion)==true))
			{ 
			
	
		$query = "UPDATE camion SET marca_camion='".$marca_camion."', modelo_camion='".$modelo_camion."', descripcion_camion='".$descripcion_camion."', disponible_camion='".$disponible_camion."' WHERE id_camion='".$id_camion."'";
		mysql_query("SET NAMES 'UTF8'");
		$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
		mysql_free_result($result);
	
		header("Location: administrar_camiones.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=Datos modificados correctamente");
		break;
		}
		else
			{
			header("Location: administrar_camiones.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&id_camion=".$id_camion."&marca_camion=".$marca_camion."&modelo_camion=".$modelo_camion."&descripcion_camion=".$descripcion_camion."&disponible_camion=".$disponible_camion."&mensaje=Datos mal Ingresados: ".$id_camion1." ".$marca_camion1." ".$modelo_camion1." ".$descripcion_camion1." ");
			break;
			}

case 'Buscar':

	$query = "SELECT id_camion,marca_camion,modelo_camion,descripcion_camion,disponible_camion  FROM camion WHERE id_camion='".$id_camion."'";
	mysql_query("SET NAMES 'UTF8'");
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	
	while ($line= mysql_fetch_array($result))
	{
		 $id_camion=$line['id_camion'];
		 $marca_camion=$line['marca_camion'];
		 $modelo_camion=$line['modelo_camion'];
		 $descripcion_camion=$line['descripcion_camion'];
		 $disponible_camion=$line['disponible_camion'];
		 $id_camion1=$line['id_camion'];
	}
	
	if (empty($id_camion1))
	{
	header("Location: administrar_camiones.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=No existe el camión");
	mysql_free_result($result);
	break;
	}
	else
	{
	header("Location: administrar_camiones.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&id_camion=".$id_camion."&marca_camion=".$marca_camion."&modelo_camion=".$modelo_camion."&descripcion_camion=".$descripcion_camion."&disponible_camion=".$disponible_camion."");
	}
	mysql_free_result($result);
break;


case 'Eliminar':


	$query = "SELECT id_camion,marca_camion,modelo_camion,descripcion_camion,disponible_camion  FROM camion WHERE id_camion='".$id_camion."'";
	mysql_query("SET NAMES 'UTF8'");
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	while ($line= mysql_fetch_array($result))
	{
		 $nombre1=$line['marca_camion'];
	}
	if (empty($nombre1))
	{
	header("Location: administrar_camiones.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=No existe el camión");
	mysql_free_result($result);
	}
	else
	{
    $query = "DELETE FROM camion WHERE id_camion='".$id_camion."'";
	mysql_query("SET NAMES 'UTF8'");
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
    header("Location: administrar_camiones.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=Camión eliminado correctamente");
	}
	mysql_free_result($result);
	break;
	

}
?>

