
<?php
include("conexion_base.php");

$link =conectar_mysql();
// Recibo los datos de la imagen
$nombre_img = $_FILES['imagen']['name'];
$tipo = $_FILES['imagen']['type'];
$tamano = $_FILES['imagen']['size'];
 
//Si existe imagen y tiene un tama�o correcto
if (($nombre_img == !NULL) && ($_FILES['imagen']['size'] <= 200000)) 
{
   //indicamos los formatos que permitimos subir a nuestro servidor
   if (($_FILES["imagen"]["type"] == "image/gif")
   || ($_FILES["imagen"]["type"] == "image/jpeg")
   || ($_FILES["imagen"]["type"] == "image/jpg")
   || ($_FILES["imagen"]["type"] == "image/png"))
   {
      // Ruta donde se guardar�n las im�genes que subamos
      $directorio = $_SERVER['DOCUMENT_ROOT'].'/intranet/uploads/';
      // Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
      move_uploaded_file($_FILES['imagen']['tmp_name'],$directorio.$nombre_img);
	  
	  /* en pasos anteriores deber�amos tener una conexi�n abierta a nuestra base de 
datos para ejecutar nuestra sentencia SQL */
 
/* con la siguiente sentencia le asignamos a nuestro campo de la tabla ruta_imagen 
el nombre de nuestra imagen */
 
$query = "INSERT into imagenes(imagen) values('".$nombre_img."')";
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
 
/* volvemos a la p�gina principal para cargar la imagen que hemos subido */
header("Location: paginaperfil.php");

    } 
    else 
    {
       //si no cumple con el formato
       echo "No se puede subir una imagen con ese formato ";
    }
} 
else 
{
   //si existe la variable pero se pasa del tama�o permitido
   if($nombre_img == !NULL) echo "La imagen es demasiado grande "; 
}
?>