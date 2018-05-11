
<?PHP // Abro el archivo de imagen para cargar sus contenidos
include("conexion_base.php");
$link =conectar_mysql();
$archivo = 'D:/d1.jpg';

$fp = fopen ($archivo, 'r');
if ($fp){
$datos = fread ($fp, filesize ($archivo)); // cargo la imagen
fclose($fp);

// averiguo su tipo mime
$tipo_mime = 'image/jpeg';
$isize = getimagesize($archivo);
if ($isize)
$tipo_mime = $isize['mime'];

// La guardamos en la BD
$datos = base64_encode ($datos);
$query = "INSERT INTO imagenes (imagen, tipo) VALUES ('".$datos."', '".$tipo_mime."')";
$result = mysql_query($query) or die('Ingreso fallido: ' . mysql_error());
if (!$result)
echo "Error al ejecutar la consulta ($sql)\n";
}
else
echo "Error al abrir el archivo";
?>