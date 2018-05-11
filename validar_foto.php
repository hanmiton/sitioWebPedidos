
<?php
include("conexion_base.php");

// Recibo los datos de la imagen
$nombre_acta = $_REQUEST['text_nombre'];
$acta = $_FILES['acta']['name'];
$ruta = $_FILES['acta']['tmp_name'];
$destino="actas/".$acta;
 
 
 /*
 //copy($ruta,$destino);
 move_uploaded_file($ruta,$destino);
 $bytesarchivo=file_get_contents($destino);
 
 $fp = fopen ($destino, 'r');
if ($fp)

{
	$datos = fread ($fp, filesize ($destino)); // cargo la imagen
	fclose($fp);

$datos = base64_encode ($datos);

 $query = "INSERT actas(nombre, acta) VALUES ('".$nombre_acta."','".$datos."')";
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
	mysql_free_result($result);
	
	}
	header("Location:prueba1.php");
	*/
	
	
	$foto=mysql_real_escape_string(file_get_contents($ruta));
	$query = "INSERT actas(nombre, acta) VALUES ('".$nombre_acta."','".$foto."')";
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
	mysql_free_result($result);
	
	
	header("Location:prueba1.php");
	
	
	
//
?>