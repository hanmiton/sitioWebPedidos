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


if (empty($_GET['numero_pedido']))
{

$numero_pedido='';
$fecha_pedido='';
$id_proveedor='';
$id_producto='';
$id_cliente='';
$cantidad_pedido='';
$peso_pedido='';
}
else
{
$numero_pedido=$_GET['numero_pedido'];

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
<body>
<table width="991" border="1" align="left" cellspacing="0">
<table width="991" border="1" align="left" cellspacing="0">
  <tr>
    <td colspan="2" valign="top"><img src="imagenes/logo_pedidos.png" width="1352" height="129" /></td>
  </tr>
  <tr>
    <td width="262" height="463" valign="top"><table width="247" height="93" border="0" cellspacing="0" valign="top">
      <tr>
        <td valign="top">&nbsp;</td>
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
      <table width="248" border="0" valign="top" cellspacing="0">
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><img src="imagenes/perfiles.png" width="127" height="22" /></td>
      </tr>
	  
 <?php
$query = "SELECT nombre_perfil, boton_perfil,link_perfil FROM perfil INNER JOIN perfil_usuario ON perfil_usuario.id_perfil=perfil.id_perfil INNER JOIN rol ON rol.id_rol=perfil_usuario.id_rol INNER JOIN usuario ON usuario.id_rol=rol.id_rol WHERE id_usuario='".$id_usuario."'";
mysql_query("SET NAMES 'UTF8'");
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

while ($line= mysql_fetch_array($result)) 
{
?>
      <tr>
        <td><a href="<?php echo($line['link_perfil']."?id_usuario=$id_usuario&nombre_usuario=$nombre_usuario&nombre_rol=$nombre_rol"); ?>"><img src="<?php echo('imagenes/'.$line['boton_perfil']); ?>" width="246" height="30" border="0" class="Estilo1" /></a></td>
      </tr>
<?php

 }
?>
    </table>
      <table width="249" height="42" border="0" cellspacing="0" valign="top">
        <tr>
          <td height="21">&nbsp;</td>
        </tr>
        <tr>
          <td width="247" height="21"><div align="left"><a href="index.php"><img src="imagenes/bt_cerrarsesion.png" width="159" height="40" border="0" /></a></div></td>
        </tr>
      </table>
  <p>&nbsp;</p></td>
    <table width="1092" height="57" border="0" cellspacing="0">
      <tr>
        <td width="273">&nbsp;</td>
        <td width="815"><img src="imagenes/m_gestionar_pedidos.png" width="888" height="30" /></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <form id="form1" name="form1" method="get" action="ad_pedidos.php">
      <table width="890" height="230" border="0" background="imagenes/fondotabla4.png">
        <tr>
          <td colspan="2">&nbsp;</td>
          <td width="84">&nbsp;</td>
          <td width="70">&nbsp;</td>
          <td width="282">&nbsp;</td>
          <td width="65">&nbsp;</td>
        </tr>
        
        <tr>
          <td height="21"><span class="Estilo15">Numero Pedido </span></td>
          <td><span class="Estilo5">
            <input name="text_numero" type="text" id="text_numero" value ="<?php echo $numero_pedido ?>" size="10"  readonly="readonly"/>
            <input name="bt_opcion" type="submit" id="bt_opcion" value="Nuevo" />
          </span></td>
          <td colspan="2"><span class="Estilo15">Fecha Pedido </span></td>
          <td><span class="Estilo5">
            <input name="text_fecha" type="text" id="text_fecha" value ="2017-02-01" size="15" />
          </span></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td height="21"><span class="Estilo15">Proveedor</span></td>
          <td><span class="Estilo15">Producto</span></td>
          <td><span class="Estilo15">Cantidad</span></td>
          <td><span class="Estilo15">Peso</span></td>
          <td><span class="Estilo15">Cliente</span></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
		
		<td><select name="text_proveedor" class="Estilo12" id="text_proveedor">
          <?php $query = "SELECT id_proveedor, nombre_proveedor FROM proveedor";
		mysql_query("SET NAMES 'UTF8'");
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
while ($line= mysql_fetch_array($result)) 
{
?>
          <option value="<?php echo $line['id_proveedor'];?>"> <?php echo $line['nombre_proveedor'];?></option>
          <?php

 }
?>
        </select></td>
		  <td><select name="text_producto" class="Estilo12" id="text_producto">
		  
 <?php $query = "SELECT id_producto, nombre_producto FROM producto";
mysql_query("SET NAMES 'UTF8'");
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
while ($line= mysql_fetch_array($result)) 
{
?>
<option value="<?php echo $line['id_producto'];?>"> <?php echo $line['nombre_producto'];?></option>
      
<?php

 }
?>         
          </select></td>
          <td><span class="Estilo5">
            <input name="text_cantidad" type="text" id="text_cantidad" value ="<?php  ?>" size="5" maxlength="10" />
          </span></td>
          <td><span class="Estilo5">
            <input name="text_peso" type="text" id="text_peso" value ="<?php  ?>" size="5" maxlength="10" />
          </span></td>
		  
          <td><select name="text_cliente" class="Estilo12" id="text_cliente">
		  
	<?php $query = "SELECT id_cliente, nombre_cliente, direccion_cliente,nombre_ciudad FROM cliente INNER JOIN ciudad ON ciudad.id_ciudad=cliente.id_ciudad";
mysql_query("SET NAMES 'UTF8'");
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
while ($line= mysql_fetch_array($result)) 
{
?>
<option value="<?php echo $line['id_cliente'];?>"> <?php echo $line['nombre_cliente']." / ".$line['nombre_ciudad'];?></option>
      
<?php

 }
?>        	  
		  
          </select></td>
          <td><input name="bt_opcion" type="submit" id="bt_opcion" value="Guardar" /></td>
        </tr>
		  <?php $query = "SELECT id_pedido,nombre_proveedor,nombre_producto,nombre_cliente,nombre_ciudad,cantidad_pedido,peso_pedido,fecha_pedido FROM pedido INNER JOIN proveedor ON proveedor.id_proveedor=pedido.id_proveedor INNER JOIN cliente ON cliente.id_cliente=pedido.id_cliente INNER JOIN producto ON producto.id_producto=pedido.id_producto INNER JOIN ciudad ON cliente.id_ciudad=ciudad.id_ciudad WHERE numero_pedido='".$numero_pedido."'";
mysql_query("SET NAMES 'UTF8'");
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
while ($line= mysql_fetch_array($result)) 
{ ?>
        <tr>
		
		
		
          <td class="Estilo12"><span class="Estilo18 Estilo1">
            <label>
              <input name="id_usuario22" type="hidden" id="id_usuario2" value="<?php echo $id_usuario ?>"/>
              <?php $id_pedido=$line['id_pedido']; echo $line['nombre_proveedor'] ?>              </label>
          </span></td>
          <td class="Estilo12"><span class="Estilo5 Estilo18 Estilo1">
            <input name="id_usuario222" type="hidden" id="id_usuario22" value="<?php echo $id_usuario ?>"/>
			<?php echo $line['nombre_producto'] ?>
          </span></td>
          <td class="Estilo12"><span class="Estilo5 Estilo18 Estilo1">
             <input name="id_usuario223" type="hidden" id="id_usuario222" value="<?php echo $id_usuario ?>"/>
			 	<?php echo $line['cantidad_pedido'] ?>
          </span></td>
          <td class="Estilo12"><span class="Estilo5 Estilo18 Estilo1">
            <input name="id_usuario224" type="hidden" id="id_usuario223" value="<?php echo $id_usuario ?>"/>
			<?php echo $line['peso_pedido'] ?>
          </span></td>
          <td class="Estilo12"><span class="Estilo5 Estilo18 Estilo1">
            <input name="id_usuario225" type="hidden" id="id_usuario224" value="<?php echo $id_usuario ?>"/>
			<?php echo $line['nombre_cliente']."/".$line['nombre_ciudad'] ?>
          
		  </span></td>
 <td><a href="<?php echo("ad_pedidos.php?id_usuario=$id_usuario&nombre_usuario=$nombre_usuario&nombre_rol=$nombre_rol&id_pedido=$id_pedido&text_opcion=Eliminar"); ?>"> Eliminar    </a>    </td>
          
		  </span></td>
        </tr>
		  
		  <?php 
		  }
		  ?>
		  
        <tr>
          <td colspan="6">&nbsp;</td>
        </tr>
        <tr>
          <td width="177"><label><span class="Estilo3 Estilo16 Estilo1">
            <?php // echo $mensaje;?>
            </span>          </label></td>
          <td width="186"><input name="bt_opcion" type="submit" id="bt_opcion" value="Guardar" /></td>
          <td><input name="bt_opcion" type="submit" id="bt_opcion" value="Cancelar" /></td>
          <td>&nbsp;</td>
          <td><input name="id_usuario" type="hidden" id="id_usuario" value="<?php echo $id_usuario ?>"/>
            <input name="nombre_usuario" type="hidden" id="nombre_usuario" value="<?php echo $nombre_usuario?>"/>
            <input name="nombre_rol" type="hidden" id="nombre_rol" value="<?php echo $nombre_rol?>"/></td>
          <td><strong><a href="<?php echo "mostrar_usuarios.php?id_usuario=$id_usuario&nombre_usuario=$nombre_usuario&nombre_rol=$nombre_rol"; ?>">Mostrar</a></strong></td>
        </tr>
      </table>
      <p>&nbsp;</p>
      <label></label>
      <p>&nbsp;</p>
    </form>


</body>
</html>
