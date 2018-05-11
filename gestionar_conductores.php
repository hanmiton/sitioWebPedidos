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


if (empty($_GET['id_chofer']))
{

$id_chofer="";
$nombre_chofer="";
$direccion_chofer="";
$telefono_chofer="";
$disponible_chofer="1";

}
else
{
$id_chofer=$_GET['id_chofer'];
$nombre_chofer=$_GET['nombre_chofer'];
$direccion_chofer=$_GET['direccion_chofer'];
$telefono_chofer=$_GET['telefono_chofer'];
$disponible_chofer=$_GET['disponible_chofer'];
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
<table width="991" border="0" align="left" cellspacing="0" background="imagenes/fondotabla8.png">
  <tr>
    <td colspan="2" valign="top"><img src="imagenes/logo_pedidos.png" width="1352" height="129" /></td>
  </tr>
  <tr>
    <td width="262" height="463" align="left" valign="top" background="imagenes/tabla.jpg"><table width="249" height="93" border="0" cellspacing="0" background="imagenes/tabla.jpg" valign="top">
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
    <td width="1090" align="center" valign="top"><table width="1092" height="57" border="0" cellspacing="0" background="imagenes/tabla.jpg">
      <tr>
        <td width="273">&nbsp;</td>
        <td width="815"><img src="imagenes/m_gestionar_conductores.png" width="888" height="30" /></td>
      </tr>
    </table>
      <form id="form1" name="form1" method="get" action="ad_conductores.php">
        <br />
      <table width="590" height="178" border="1" cellspacing="0" bordercolor="#EAEAEA" background="imagenes/fondotabla4.png">
        <tr>
          <td colspan="6">&nbsp;</td>
          </tr>
        <tr>
          <td width="74"><span class="Estilo15">Cédula</span></td>
          <td colspan="2"><label>
            <input name="text_cedula" type="text" id="text_cedula" value ="<?php echo $id_chofer ?>" />
            <span class="Estilo5">*</span></label></td>
          <td colspan="3"><input name="bt_opcion" type="submit" id="bt_opcion" value="Buscar" /></td>
          </tr>
        <tr>
          <td><span class="Estilo15">Nombre</span></td>
          <td colspan="5"><input name="text_nombre" type="text" id="text_nombre" value ="<?php echo $nombre_chofer ?>" size="40" />
            <span class="Estilo5">*</span></td>
          </tr>
        <tr>
          <td><span class="Estilo15">Dirección</span></td>
          <td colspan="5"><input name="text_direccion" type="text" id="text_direccion" value ="<?php echo $direccion_chofer?>" size="40"/>
              <span class="Estilo5"> *</span></td>
          </tr>
        <tr>
          <td><span class="Estilo15">Teléfono</span></td>
          <td colspan="5"><input name="text_telefono" type="text" id="text_telefono" value ="<?php echo $telefono_chofer?>" size="20" maxlength="10"/>
            <span class="Estilo5">*</span></td>
          </tr>
        <tr>
          <td><span class="Estilo15">Disponible</span></td>
          <td colspan="5"><label><span class="Estilo5"> 
            <input name="text_disponible" type="text" id="text_disponible" value ="<?php echo $disponible_chofer?>" size="5" maxlength="5" readonly="readonly"/>
          </span></label>
            <input name="id_usuario" type="hidden" id="cedula" value="<?php echo $id_usuario ?>"/>
              <input name="nombre_usuario" type="hidden" id="nombre" value="<?php echo $nombre_usuario?>"/>
              <input name="nombre_rol" type="hidden" id="nombre2" value="<?php echo $nombre_rol?>"/></td>
          </tr>
        
        <tr>
          <td>&nbsp;</td>
          <td width="104"><label>
            <input name="bt_opcion" type="submit" id="bt_opcion" value="Nuevo" />
          </label></td>
          <td width="123"><input name="bt_opcion" type="submit" id="bt_opcion" value="Guardar" /></td>
          <td width="103"><input name="bt_opcion" type="submit" id="bt_opcion" value="Modificar" /></td>
          <td width="92"><input name="bt_opcion" type="submit" id="bt_opcion" value="Eliminar" /></td>
          <td width="68"><span class="Estilo1 Estilo12 Estilo4"><strong><a href="<?php echo "mostrar_conductores.php?id_usuario=$id_usuario&nombre_usuario=$nombre_usuario&nombre_rol=$nombre_rol"; ?>">Mostrar</a></strong></span></td>
        </tr>
      </table>
      <label></label>
      <p>&nbsp;</p>
    </form>
    <p></p></td>
  </tr>
</table>
<p>&nbsp;</p>

</body>
</html>
