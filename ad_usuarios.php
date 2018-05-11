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

$id_usu=$_REQUEST['text_cedula'];
$nombre_usu=$_REQUEST['text_nombre'];
$password_usu=$_REQUEST['text_password'];
$email_usu=$_REQUEST['text_email'];
$rol_usu=$_REQUEST['text_rol'];
$opcion =$_REQUEST['bt_opcion'];

/////////validar datos //////////////////////////////


switch($opcion) {
case 'Nuevo':
header("Location: administrar_usuarios.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=Ingrese un nuevo usuario");
break;
case 'Guardar':



    
	
	$id_usu1="";
	$nombre_usu1="";
	$password_usu1="";
	$rol_usu1="";
	
	
	if (validar_cedula($id_usu)==false)
	 {
	  $id_usu1="Cédula;";
	 }
	  
	 if (validar_nombre($nombre_usu)==false)
	 {
	  $nombre_usu1="Nombres;";
	 }
	   if (validar_password($password_usu)==false)
	 {
	  $password_usu1="Password;";
	 }
	
	if (validar_email($email_usu)==false)
	 {
	  $email_usu1="Email;";
	 }
	 
	 if (validar_rol($rol_usu)==false)
	 {
	  $rol_usu1="Rol de Usuario;";
	 }
	
	
    $query = "SELECT id_usuario,nombre_usuario,password_usuario,id_rol FROM usuario WHERE id_usuario='".$id_usu."'";
	mysql_query("SET NAMES 'UTF8'");
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	while ($line= mysql_fetch_array($result))
	{
		 $nombre1=$line['nombre_usuario'];
	}
	if (empty($nombre1))
	{
	
		if ((validar_cedula($id_usu)==true) && (validar_nombre($nombre_usu)==true) && (validar_password($password_usu)==true) && (validar_email($email_usu)==true) && (validar_rol($rol_usu)==true) )
			{ 
			$query = "INSERT INTO usuario(id_usuario, nombre_usuario, password_usuario,email_usuario,id_rol) VALUES ('".$id_usu."','".$nombre_usu."','".$password_usu."','".$email_usu."','".$rol_usu."')";
			$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
			mysql_free_result($result);
			header("Location: administrar_usuarios.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=Datos ingresados correctamente");
			
			}
			else
			{
				header("Location: administrar_usuarios.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&id_usu=".$id_usu."&nombre_usu=".$nombre_usu."&password_usu=".$password_usu."&email_usu=".$email_usu."&rol_usu=".$rol_usu."&nombre_rol_usu=".$nombre_rol_usu."&mensaje=Datos mal Ingresados: ".$id_usu1." ".$nombre_usu1." ".$password_usu1." ".$email_usu1." ".$rol_usu1." ");
			}
			
	}
	else
	{
	mysql_free_result($result);
    header("Location: administrar_usuarios.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=El usuario ya existe");
	}
break;
case 'Modificar':


	$id_usu1="";
	$nombre_usu1="";
	$password_usu1="";
	$rol_usu1="";
	
	
	if (validar_cedula($id_usu)==false)
	 {
	  $id_usu1="Cédula;";
	 }
	  
	 if (validar_nombre($nombre_usu)==false)
	 {
	  $nombre_usu1="Nombres;";
	 }
	   if (validar_password($password_usu)==false)
	 {
	  $password_usu1="Password;";
	 }
	
	if (validar_email($email_usu)==false)
	 {
	  $email_usu1="Email;";
	 }
	 
	 if (validar_rol($rol_usu)==false)
	 {
	  $rol_usu1="Rol de Usuario;";
	 }




	
	$query = "SELECT id_usuario,nombre_usuario,password_usuario,id_rol FROM usuario WHERE id_usuario='".$id_usu."'";
	mysql_query("SET NAMES 'UTF8'");
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	while ($line= mysql_fetch_array($result))
	{
		 $nombre1=$line['nombre_usuario'];
	}
	
	if (empty($nombre1))
	{
	header("Location: administrar_usuarios.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=No existe el usuario");
	mysql_free_result($result);
	break;
	}
	
	
	if ((validar_cedula($id_usu)==true) && (validar_nombre($nombre_usu)==true) && (validar_password($password_usu)==true) && (validar_email($email_usu)==true) && (validar_rol($rol_usu)==true) )
			{ 
			
	
		$query = "UPDATE usuario SET nombre_usuario='".$nombre_usu."', password_usuario='".$password_usu."', email_usuario='".$email_usu."', id_rol='".$rol_usu."' WHERE id_usuario='".$id_usu."'";
		mysql_query("SET NAMES 'UTF8'");
		$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
			
			header("Location: administrar_usuarios.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=Datos modificados correctamente");
			break;
			
	}
	else
	{
	
	
	
header("Location: administrar_usuarios.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&id_usu=".$id_usu."&nombre_usu=".$nombre_usu."&password_usu=".$password_usu."&email_usu=".$email_usu."&rol_usu=".$rol_usu."&nombre_rol_usu=".$nombre_rol_usu."&mensaje=Datos mal Ingresados: ".$id_usu1." ".$nombre_usu1." ".$password_usu1." ".$email_usu1." ".$rol_usu1." ");
	}
			
			

case 'Buscar':

	$query = "SELECT id_usuario,nombre_usuario,password_usuario,email_usuario,usuario.id_rol,nombre_rol  FROM usuario INNER JOIN rol ON usuario.id_rol=rol.id_rol WHERE usuario.id_usuario='".$id_usu."'";
	mysql_query("SET NAMES 'UTF8'");
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	
	while ($line= mysql_fetch_array($result))
	{
		 $id_usu=$line['id_usuario'];
		 $nombre_usu=$line['nombre_usuario'];
		 $password_usu=$line['password_usuario'];
		 $email_usu=$line['email_usuario'];
		 $rol_usu=$line['id_rol'];
		 $nombre_rol_usu=$line['nombre_rol'];
		 $ud_usu1=$line['id_usuario'];
	}
	
	if (empty($ud_usu1))
	{
	header("Location: administrar_usuarios.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=No existe el usuario");
	mysql_free_result($result);
	break;
	}
	else
	{
	header("Location: administrar_usuarios.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&id_usu=".$id_usu."&nombre_usu=".$nombre_usu."&password_usu=".$password_usu."&email_usu=".$email_usu."&rol_usu=".$rol_usu."&nombre_rol_usu=".$nombre_rol_usu."");
	}
	mysql_free_result($result);
break;


case 'Eliminar':


	$query = "SELECT id_usuario,nombre_usuario,password_usuario,id_rol FROM usuario WHERE id_usuario='".$id_usu."'";
	mysql_query("SET NAMES 'UTF8'");
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
	while ($line= mysql_fetch_array($result))
	{
		 $nombre1=$line['nombre_usuario'];
	}
	if (empty($nombre1))
	{
	header("Location: administrar_usuarios.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=No existe el usuario");
	mysql_free_result($result);
	}
	else
	{
    $query = "DELETE FROM usuario WHERE id_usuario='".$id_usu."'";
	mysql_query("SET NAMES 'UTF8'");
	$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
    header("Location: administrar_usuarios.php?id_usuario=".$id_usuario."&nombre_usuario=".$nombre_usuario."&nombre_rol=".$nombre_rol."&mensaje=Usuario eliminado correctamente");
	}
	mysql_free_result($result);
	break;
	

}
?>

