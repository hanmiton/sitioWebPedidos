<?php

include("conexion_base.php");
session_start();
$sesion_usuario=$_SESSION['id_usuario'];

if (!isset($sesion_usuario)) {
   header('Location: index.php');
   break;
}

$id_usuario=$_GET['id_usuario'];
$nombre_usuario=$_GET['nombre_usuario'];
$nombre_rol=$_GET['nombre_rol'];


if (empty($_GET['mensaje']))
{
$mensaje="";
}
else
{
$mensaje=$_GET['mensaje'];
}


$id_numero='';
$numero_pedido='';
$fecha_pedido='';
$id_proveedor='';
$id_producto='';
$id_cliente='';
$cantidad_pedido='';
$id_ciudad='';

$nombre_proveedor='';
$nombre_producto='';
$nombre_cliente='';
$nombre_ciudad='';
$ss='';
$opcion='';
$asignado_pedido='0';
$estado_pedido='0';
$disabledbotones='disabled';
$disablednuevo='';
$disabledbuscar='';
$readonly='';

$Eliminar='Eliminar';

$id_chofer='1803817137';
$nombre_chofer='';
  
if (!empty($_GET['opcion']))
{
 
$opcion=$_GET['opcion'];

	
	if ($opcion=="Entregar Productos")
	
	{
	  
	   $id_cliente= $_GET['id_cliente'];
	   $id_ciudad= $_GET['id_ciudad'];
	   $id_chofer= $_GET['id_chofer'];
	   $numero_pedido=$_GET['numero_pedido'];
	   $nombre_cliente=$_GET['nombre_cliente'];
	   $nombre_ciudad=$_GET['nombre_ciudad'];
		
	}

if ($opcion=="Guardar")
	
	{
	  
	  $id_cliente= $_GET['id_cliente'];
	   $id_ciudad= $_GET['id_ciudad'];
	   $id_chofer= $_GET['id_chofer'];
	   $numero_pedido=$_GET['numero_pedido'];
	   $nombre_cliente=$_GET['nombre_cliente'];
	   $nombre_ciudad=$_GET['nombre_ciudad'];
		
	}


}



?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
<!--
.style2 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
}
.Estilo15 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.Estilo16 {
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
-->
</style>
</head>
<title>Untitled Document</title>
<style type="text/css">
<!--
.Estilo1 {font-family: Verdana, Arial, Helvetica, sans-serif}
-->
</style>

<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
}
.Estilo6 {
	font-size: 12px;
	font-weight: bold;
}
.Estilo12 {font-size: 12px; color: #000000; }
</style>


<link href="css/calendario.css" type="text/css" rel="stylesheet">
<script src="js/calendar.js" type="text/javascript"></script>
<script src="js/calendar-es.js" type="text/javascript"></script>
<script src="js/calendar-setup.js" type="text/javascript"></script>




<script language="JavaScript"> 
var mensaje = "<?php echo utf8_encode($mensaje) ?>";

window.onload = ver_mensaje
function ver_mensaje()
{
if(mensaje != ""){
alert(mensaje)
}
}

</script> 


<script type="text/javascript"> 
function calendario()
{
    Calendar.setup({ 
    inputField     :    "text_fecha",     // id del campo de texto 
    ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
    button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
}
</script> 
<body>


<table width="1361" height="605" border="0" align="left" cellpadding="0" cellspacing="0" background="imagenes/fondotabla8.png">
  <tr>
    <td height="129" colspan="2" valign="top"><img src="imagenes/logo_pedidos.png" width="1352" height="129" /></td>
  </tr>
  <tr>
    <td width="260" height="461" valign="top" background="imagenes/tabla.jpg"><table width="249" height="93" border="0" cellspacing="0" background="imagenes/tabla.jpg" valign="top">
      <tr>
        <td width="247" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td align="left" valign="top"><div align="center" class="Estilo1 Estilo6">
          <p align="center"><img src="imagenes/b_usuario.png" width="114" height="31" /></p>
          </div></td>
        </tr>
      <tr>
        <td align="left"><div align="center" class="Estilo12">
          <div align="center"><span class="Estilo1"><strong> 
            <?php  echo $id_usuario;?>
          </strong></span></div>
        </div></td>
        </tr>
      <tr>
        <td align="left"><div align="center" class="Estilo12">
          <div align="center"><span class="Estilo1"><strong>
            <?php  echo $nombre_usuario;?>
          </strong></span></div>
        </div></td>
      </tr>
      <tr>
        <td align="left"><div align="center" class="Estilo12">
          <div align="center"><span class="Estilo1 "><strong>
            <?php  echo $nombre_rol;?>
          </strong></span></div>
        </div></td>
      </tr>
      

      
    </table>
      <table width="249" border="0" cellspacing="0" background="imagenes/tabla.jpg" valign="top">
      <tr>
        <td width="247">&nbsp;</td>
      </tr>
      <tr>
        <td><img src="imagenes/perfiles.png" width="127" height="22" /></td>
      </tr>
	  
 <?php
$query = "SELECT nombre_perfil, boton_perfil,link_perfil FROM perfil INNER JOIN perfil_usuario ON perfil_usuario.id_perfil=perfil.id_perfil INNER JOIN rol ON rol.id_rol=perfil_usuario.id_rol INNER JOIN usuario ON usuario.id_rol=rol.id_rol WHERE id_usuario='".$id_usuario."'";
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

while ($line= mysql_fetch_array($result)) 
{
?>
      <tr>
        <td><a href="<?php echo($line['link_perfil']."?id_usuario=$id_usuario&nombre_usuario=$nombre_usuario&nombre_rol=$nombre_rol"); ?>"><img src="<?php echo('imagenes/'.$line['boton_perfil']); ?>" width="246" height="30" border="0" class="Estilo1" /></a></td>
      </tr>
<?php

 }
 mysql_free_result($result);
?>
    </table>
      <table width="249" height="42" border="0" cellspacing="0" background="imagenes/tabla.jpg" valign="top">
        <tr>
          <td height="21">&nbsp;</td>
        </tr>
        <tr>
          <td width="247" height="21"><div align="left"><a href="index.php"><img src="imagenes/bt_cerrarsesion.png" width="159" height="40" border="0" /></a></div></td>
        </tr>
      </table>
    <p>&nbsp;</p></td>
    <td width="1097" align="center" valign="top"><table width="1092" height="57" border="0" cellspacing="0" background="imagenes/tabla.jpg">
      <tr>
        <td width="273">&nbsp;</td>
        <td width="815"><img src="imagenes/m_gestionar_entrega.png" width="888" height="30" /></td>
      </tr>
    </table>
      <form id="form1" name="form1" enctype="multipart/form-data" method="post" action="ad_entrega.php">
        <table width="1072" height="47" border="0" cellspacing="0" background="imagenes/fondotabla4.png">
        <tr>
          <td height="21" colspan="3">&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td width="59">&nbsp;</td>
          <td colspan="3">&nbsp;</td>
          </tr>
        <tr>
          <td width="45">&nbsp;</td>
          <td width="150" height="21"><span class="Estilo15">Número Pedido </span></td>
          <td width="145"><span class="Estilo5">
            <input name="numero_pedido" type="text" id="numero_pedido" value ="<?php echo $numero_pedido; ?>"  size="10" readonly="readonly"/>
          </span></td>
          <td width="87"><span class="Estilo15">Conductor</span></td>
          <td width="154"><span class="Estilo5">
            <input name="id_chofer" type="text" id="id_chofer" value ="<?php echo $id_usuario; ?>"  size="10" readonly="readonly"/>
          </span></td>
          <td><span class="Estilo15">Cliente</span></td>
          <td width="116"><span class="Estilo5">
            <input name="nombre_cliente" type="text" id="nombre_cliente" value ="<?php echo $nombre_cliente; ?>"  size="10" readonly="readonly"/>
            <input name="id_cliente" type="hidden" id="id_cliente" value="<?php echo $id_cliente ?>"/>
          </span></td>
          <td width="128"><span class="Estilo15">Ciudad</span></td>
          <td width="170"><span class="Estilo5">
            <input name="nombre_ciudad" type="text" id="nombre_ciudad" value ="<?php echo $nombre_ciudad; ?>"  size="10" readonly="readonly"/>
            <input name="id_ciudad" type="hidden" id="id_ciudad" value="<?php echo $id_ciudad ?>"/>
          </span></td>
        </tr>
      </table>
        <table width="1072" height="42" border="0" cellspacing="0" background="imagenes/fondotabla4.png">

         
          <tr>
            <td class="Estilo12">&nbsp;</td>
            <td height="21" class="Estilo12"><span class="Estilo15">Proveedor</span></td>
            <td class="Estilo12"><span class="Estilo15">Producto</span></td>
            <td align="left" class="Estilo12"><span class="Estilo15">Cantidad</span></td>
            <td align="center" class="Estilo12"><span class="Estilo15">Estado</span></td>
            <td align="left" class="Estilo12"><span class="Estilo15">Acta</span></td>
          </tr>
		  
	      <?php
		

$query = "SELECT pedido.acta,nombre_ciudad,nombre_cliente,direccion_cliente,telefono_cliente,pedido.numero_pedido,proveedor.id_proveedor,nombre_proveedor,producto.id_producto,nombre_producto,cliente.id_cliente,nombre_cliente,ciudad.id_ciudad,nombre_ciudad,cantidad_pedido,fecha_pedido,estado_pedido FROM pedido INNER JOIN viaje ON viaje.numero_pedido=pedido.numero_pedido INNER JOIN proveedor ON proveedor.id_proveedor=pedido.id_proveedor INNER JOIN cliente ON cliente.id_cliente=pedido.id_cliente INNER JOIN producto ON producto.id_producto=pedido.id_producto INNER JOIN ciudad ON cliente.id_ciudad=ciudad.id_ciudad INNER JOIN chofer ON chofer.id_chofer=viaje.id_chofer WHERE  ciudad.id_ciudad='".$id_ciudad."' and  cliente.id_cliente='".$id_cliente."'" ;	
	
mysql_query("SET NAMES 'UTF8'");
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

while ($line= mysql_fetch_array($result)) 
{ 
$numero_pedido=$line['numero_pedido'];
$fecha_pedido=$line['fecha_pedido'];
?>
          <tr>
            <td width="43" class="Estilo12">&nbsp;</td>
            <td width="192" height="21" class="Estilo12"><span class="Estilo18 Estilo1">
              <label>
             
              <?php $id_ciudad=$line['id_ciudad']; $nombre_ciudad=$line['nombre_cliente']; echo $line['nombre_proveedor'] ?>
              </label>
            </span></td>
            <td width="319" class="Estilo12"><span class="Estilo5 Estilo18 Estilo1">
            
              <?php  $id_producto=$line['id_producto']; echo $line['nombre_producto'] ?>
            </span></td>
            <td width="177" align="left" class="Estilo12"><span class="Estilo5 Estilo18 Estilo1">
            
               <?php  $cantidad_pedido=$line['cantidad_pedido']; echo $line['cantidad_pedido'] ?>
            </span></td>
            <td width="146" align="center" class="Estilo12"><span class="Estilo5 Estilo18 Estilo1">
              <?php  $estado_pedido=$line['estado_pedido']; echo $line['estado_pedido'] ?>
            </span></td>
            <td width="104" class="Estilo12"><span class="Estilo1"><span class="Estilo5 Estilo18 Estilo1">
              <img src="data:image/jpg; base64,<?php echo base64_encode($line['acta']); ?>" width="50" height="50"/>
            </span></span></td>
            <td width="77" align="left" class="Estilo12">&nbsp;</td>
          </tr>
          <?php 
		
		  }
		  mysql_free_result($result);
		  ?>


        </table>
        <table width="1072" height="26" border="0" cellspacing="0" background="imagenes/fondotabla4.png">

  		

          <tr>
            <td width="47">&nbsp;</td>
            <td width="112" height="26"><label>Entregar</label></td>
            <td width="138"><input name="entrega" type="checkbox" id="entrega" value="<?php echo "1"; ?>" /></td>
            <td width="280">  </label>
  <label for="imagen"></label>
  <input name="acta" type="file" id="acta" size="5" maxlength="5" /></td>
            <td width="152"><input name="bt_opcion" type="submit" id="bt_opcion" value="Guardar" <?php //echo $disabledbotones; ?> /></td>
            <td width="145"><input name="id_usuario" type="hidden" id="id_usuario" value="<?php echo $id_usuario ?>"/>
                <input name="nombre_usuario" type="hidden" id="nombre_usuario" value="<?php echo $nombre_usuario?>"/>
                <input name="nombre_rol" type="hidden" id="nombre_rol" value="<?php echo $nombre_rol?>"/>            </td>
            <td width="104"><input name="cantidad" type="hidden" id="nombre_rol2" value="<?php echo $cantidad?>"/></td>
            <td width="78">&nbsp;</td>
          </tr>
        </table>
        <p>&nbsp;</p>
        <label></label>
      <p>&nbsp;</p>
    </form>
    <p>&nbsp;</p></td>
  </tr>
</table>
<p>&nbsp;</p>

</body>
</html>
