<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<form action="validar_foto.php" enctype="multipart/form-data" method="post">
  <label for="imagen">nombre </label>
  <label>
  <input name="text_nombre" type="text" id="text_nombre" />
  </label>
  <label for="imagen"><br />
  Imagen:</label>
  <p><input id="acta" name="acta" size="30" type="file" />
    <input type="submit" value="Enviar" />
</p>
  <p>&nbsp;  </p>
</form>

<table width="200" border="1">
  <tr>
     <td>id</td>
    <td>Nombre</td>
    <td>Acta</td>
	</tr>
	 <tr>
	   <?php
	   include("conexion_base.php");
	   
	   $query = "select id,nombre,acta from actas";
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
	
	while  ($line= mysql_fetch_array($result))
	{
	?>
		
	
     <td><?php echo $line['id']; ?></td>
     <td><?php echo $line['nombre']; ?></td>
     <td> <img src="data:image/jpg; base64,<?php echo base64_encode($line['acta']); ?>" width="100" height="100"/></td>
 

  </tr>
  <?php
  }
	
	mysql_free_result($result);
	
	
	    ?>
</table>
</body>
</html>
