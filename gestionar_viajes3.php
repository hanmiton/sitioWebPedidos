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

$numero_pedido='';
$id_camion='';
$id_chofer='';
$id_ayudante='';
$marca_camion='';
$nombre_chofer='';
$nombre_ayudante='';
$fecha_salida='';
$fecha_llegada='';
$disablednuevo='';
$disabledcerrar='';
$disabledbotones='disabled';
$disabledbotonpedido='disabled';


if (!empty($_GET['opcion']))
{
 
 $opcion=$_GET['opcion'];
 if ($opcion=="Nuevo Viaje")
 {
 	$disablednuevo='disabled';
	$disabledcerrar='disabled';
	$disabledbotones='';
 }
 
 if ($opcion=="Asignar")
 {
 
    $numero_pedido=$_GET['numero_pedido'];
  	$id_chofer=$_GET['id_chofer'];
	$id_camion=$_GET['id_camion'];
	$id_ayudante= $_GET['id_ayudante'];
	$fecha_salida=$_GET['fecha_salida'];
	$fecha_llegada=$_GET['fecha_llegada'];
	$disablednuevo='disabled';
	$disabledcerrar='disabled';
	$disabledbotones='';
}
  
 if ($opcion=="Cancelar")
  {
 
    $disablednuevo='';
	$disabledcerrar='';
	$disabledbotones='';
 }
 
 if ($opcion=="Cerrar Viaje")
  {
 
    $disablednuevo='disabled';
	$disabledcerrar='disabled';
	$disabledbotonpedido='disabled';
	
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
    inputField     :    "text_fechas",     // id del campo de texto 
    ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
    button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 

}

function calendario1()
{
    Calendar.setup({ 
    inputField     :    "text_fechal",     // id del campo de texto 
    ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
    button     :    "lanzador1"     // el id del botón que lanzará el calendario 
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
        <td width="815"><img src="imagenes/m_gestionar_viajes.png" width="888" height="30" /></td>
      </tr>
    </table>
      <form id="form1" name="form1" method="get" action="ad_viajes.php">
        <table width="1066" height="21" border="0" cellspacing="0" background="imagenes/fondotabla4.png">
        
        <tr>
          <td width="14">&nbsp;</td>
          <td width="14"><input name="bt_opcion" type="submit" id="bt_opcion" value="Nuevo Viaje" <?php echo $disablednuevo; ?> /></td>
          <td width="14">&nbsp;</td>
          <td width="323" height="21">&nbsp;</td>
          <td width="161">&nbsp;</td>
          <td width="170">&nbsp; </td>
          <td width="130">&nbsp;</td>
          <td width="135">&nbsp;</td>
          <td width="59">&nbsp;</td>
          <td width="26">&nbsp;</td>
          </tr>

      </table>
        <table width="1066" height="47" border="0" cellspacing="0" background="imagenes/fondotabla4.png">
          
          <tr>
            <td width="13">&nbsp;</td>
            <td width="74"><span class="Estilo15">Pedido</span></td>
            <td width="288" height="21"><span class="Estilo15">Conductor</span></td>
            <td width="158"><span class="Estilo15">Camión</span></td>
            <td width="167"><span class="Estilo15">Ayudante</span></td>
            <td width="128"><span class="Estilo15">Fecha Salida </span></td>
            <td width="133"><span class="Estilo15">Fecha Llegada </span></td>
            <td width="59">&nbsp;</td>
            <td width="28">&nbsp;</td>
          </tr>
 
          <tr>
            <td>&nbsp;</td>
            <td><select name="text_pedido" class="Estilo12" id="text_pedido">
              <?php $query = "SELECT numero_pedido FROM pedido WHERE asignado_pedido='0' group by numero_pedido";
		mysql_query("SET NAMES 'UTF8'");
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
while ($line= mysql_fetch_array($result)) 
{
?>
              <option value="<?php echo $line['numero_pedido'];?>"> <?php echo $line['numero_pedido'];?></option>
              <?php

 }
 mysql_free_result($result);
?>
            </select></td>
            <td height="26"><select name="text_chofer" class="Estilo12" id="select4">
                <?php $query = "SELECT id_chofer, nombre_chofer FROM chofer WHERE disponible_chofer='1'";
		mysql_query("SET NAMES 'UTF8'");
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
while ($line= mysql_fetch_array($result)) 
{
?>
                <option value="<?php echo $line['id_chofer'];?>"> <?php echo $line['nombre_chofer'];?></option>
                <?php

 }
 mysql_free_result($result);
?>
            </select></td>
            <td><select name="text_camion" class="Estilo12" id="select5">
                <?php $query = "SELECT id_camion, marca_camion FROM camion  WHERE disponible_camion='1' ";
mysql_query("SET NAMES 'UTF8'");
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
while ($line= mysql_fetch_array($result)) 
{
?>
                <option value="<?php echo $line['id_camion'];?>"> <?php echo $line['marca_camion'];?></option>
                <?php

 }
 mysql_free_result($result);
?>
            </select></td>
            <td><select name="text_ayudante" class="Estilo12" id="select6">
                <?php $query = "SELECT id_ayudante, nombre_ayudante FROM ayudante  WHERE disponible_ayudante='1'";
mysql_query("SET NAMES 'UTF8'");
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
while ($line= mysql_fetch_array($result)) 
{
?>
                <option value="<?php echo $line['id_ayudante'];?>"> <?php echo $line['nombre_ayudante'];?></option>
                <?php

 }
 mysql_free_result($result);
?>
            </select></td>
            <td><span class="Estilo5">
              <input name="text_fechas" type="text" id="text_fechas" value ="<?php echo $fecha_salida ?>" size="6"  readonly="readonly"/>
              <img src="ima/calendario.png" width="16" height="16" border="0" title="Fecha Inicial" id="lanzador" onclick="calendario()" /></span></td>
            <td><span class="Estilo5">
              <input name="text_fechal" type="text" id="text_fechal" value ="<?php echo $fecha_llegada ?>" size="6"  readonly="readonly"/>
              <img src="ima/calendario.png" width="16" height="16" border="0" title="Fecha Inicial" id="lanzador1" onclick="calendario1()" /></span></td>
            <td><input name="bt_opcion" type="submit" id="bt_opcion" value="Asignar" <?php echo $disabledbotones; ?> /></td>
            <td>&nbsp;</td>
          </tr>
        </table>
		
		

        <table width="1066" height="21" border="0" cellspacing="0" background="imagenes/fondotabla4.png">
<?php $query = "SELECT numero_pedido, chofer.id_chofer,nombre_chofer, camion.id_camion,marca_camion, ayudante.id_ayudante,nombre_ayudante, fecha_salida,fecha_llegada FROM viaje INNER JOIN chofer ON chofer.id_chofer=viaje.id_chofer INNER JOIN camion ON camion.id_camion=viaje.id_camion INNER JOIN ayudante ON ayudante.id_ayudante=viaje.id_ayudante WHERE  numero_pedido='".$numero_pedido."' AND camion.id_camion='".$id_camion."' AND ayudante.id_ayudante='".$id_ayudante."'  AND chofer.id_chofer='".$id_chofer."' ";
		mysql_query("SET NAMES 'UTF8'");
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
while ($line= mysql_fetch_array($result)) 
{
?>
          <tr>
            <td width="13" class="Estilo12">&nbsp;</td>
            <td width="74" class="Estilo12"><span class="Estilo1">
              <?php //echo $id_chofer;
       	  
		  echo $line['numero_pedido'];
		  
		  ?>
            </span></td>
            <td width="288" height="21" class="Estilo12"><span class="Estilo1">
              <?php //echo $id_camion;
         
					
		  echo $line['nombre_chofer'];
		  
		  ?>
            </span></td>
            <td width="158" class="Estilo12"><span class="Estilo1">
              <?php //echo $id_camion;
         
			
		   echo $line['marca_camion'];
		  ?>
            </span> </td>
            <td width="167" class="Estilo12"><span class="Estilo1">
              <?php //echo $id_ayudante;
          
			
		    echo $line['nombre_ayudante'];
		  ?>
            </span> </td>
            <td width="128" class="Estilo12"><span class="Estilo1"><?php echo $fecha_salida; ?></span></td>
            <td width="133" class="Estilo12"><span class="Estilo1"><?php echo $fecha_llegada; ?></span></td>
            <td width="59" class="Estilo12"><span class="Estilo1"><strong><a href="<?php echo "ad_viajes.php?id_usuario=$id_usuario&nombre_usuario=$nombre_usuario&nombre_rol=$nombre_rol&text_pedido=$numero_pedido&text_chofer=$id_chofer&text_camion=$id_camion&text_ayudante=$id_ayudante&text_fechas=$fecha_salida&text_fechal=$fecha_llegada&bt_opcion=Eliminar"; ?>">Eliminar</a></strong></span></td>
            <td width="28" class="Estilo12"><span class="Estilo1"></span></td>
          </tr>
		   <?php 
		   
		   }
		   mysql_free_result($result);
		  ?>
		  
        </table>
		
		
        <table width="1066" height="26" border="0" cellspacing="0" background="imagenes/fondotabla4.png">

          <tr>
            <td width="13">&nbsp;</td>
            <td width="74">&nbsp;</td>
            <td width="288" height="26"><label><span class="Estilo3 Estilo16 Estilo1">
              <?php // echo $mensaje;?>
            </span> </label></td>
            <td width="158"><input name="bt_opcion" type="submit" id="bt_opcion" value="Guardar" <?php echo $disabledbotones; ?> /></td>
            <td width="167"><input name="bt_opcion" type="submit" id="bt_opcion" value="Cancelar" <?php echo $disabledbotones; ?> /></td>
            <td width="128">&nbsp;</td>
            <td width="133"><input name="id_usuario" type="hidden" id="id_usuario" value="<?php echo $id_usuario ?>"/>
                <input name="nombre_usuario" type="hidden" id="nombre_usuario" value="<?php echo $nombre_usuario?>"/>
                <input name="nombre_rol" type="hidden" id="nombre_rol" value="<?php echo $nombre_rol?>"/></td>
            <td width="59">&nbsp;</td>
            <td width="28">&nbsp;</td>
          </tr>
        </table>
      
        <table width="1066" height="21" border="0" cellspacing="0" background="imagenes/fondotabla4.png">
          <tr>
            <td width="14">&nbsp;</td>
            <td width="14"><input name="bt_opcion" type="submit" id="bt_opcion" value="Cerrar Viaje" <?php echo $disabledcerrar; ?> /></td>
            <td width="14">&nbsp;</td>
            <td width="323" height="21">&nbsp;</td>
            <td width="161">&nbsp;</td>
            <td width="170">&nbsp;</td>
            <td width="130">&nbsp;</td>
            <td width="135">&nbsp;</td>
            <td width="59">&nbsp;</td>
            <td width="26">&nbsp;</td>
          </tr>
        </table>
        <table width="1066" height="49" border="0" cellspacing="0" background="imagenes/fondotabla4.png">
          <tr>
            <td>&nbsp;</td>
            <td><select name="text_pedido1" class="Estilo12" id="select">
              <?php $query = "SELECT viaje.numero_pedido FROM viaje INNER JOIN pedido ON viaje.numero_pedido=pedido.numero_pedido WHERE pedido.asignado_pedido='1' GROUP BY viaje.numero_pedido";
		mysql_query("SET NAMES 'UTF8'");
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
while ($line= mysql_fetch_array($result)) 
{
?>
              <option value="<?php echo $line['numero_pedido'];?>"> <?php echo $line['numero_pedido'];?></option>
              <?php

 }
 mysql_free_result($result);
?>
            </select></td>
            <td height="26"><input name="bt_opcion" type="submit" id="bt_opcion" value="Buscar" <?php echo $disabledbotones; ?> /></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td width="13">&nbsp;</td>
            <td width="74"><span class="Estilo15">Pedido</span></td>
            <td width="288" height="21"><span class="Estilo15">Conductor</span></td>
            <td width="158"><span class="Estilo15">Camión</span></td>
            <td width="167"><span class="Estilo15">Ayudante</span></td>
            <td width="128"><span class="Estilo15">Fecha Salida </span></td>
            <td width="133"><span class="Estilo15">Fecha Llegada </span></td>
            <td width="59">&nbsp;</td>
            <td width="28">&nbsp;</td>
          </tr>
		  
		  <?php $query = "SELECT numero_pedido, chofer.id_chofer,nombre_chofer, camion.id_camion,marca_camion, ayudante.id_ayudante,nombre_ayudante, fecha_salida,fecha_llegada FROM viaje INNER JOIN chofer ON chofer.id_chofer=viaje.id_chofer INNER JOIN camion ON camion.id_camion=viaje.id_camion INNER JOIN ayudante ON ayudante.id_ayudante=viaje.id_ayudante WHERE  numero_pedido='".$numero_pedido."' AND camion.id_camion='".$id_camion."' AND ayudante.id_ayudante='".$id_ayudante."'  AND chofer.id_chofer='".$id_chofer."' ";
		mysql_query("SET NAMES 'UTF8'");
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
while ($line= mysql_fetch_array($result)) 
{
?>
          
		  
	  <?php

 }
 mysql_free_result($result);
?>	  
        </table>
        <table width="1066" height="21" border="0" cellspacing="0" background="imagenes/fondotabla4.png">
          <?php $query = "SELECT numero_pedido, chofer.id_chofer,nombre_chofer, camion.id_camion,marca_camion, ayudante.id_ayudante,nombre_ayudante, fecha_salida,fecha_llegada FROM viaje INNER JOIN chofer ON chofer.id_chofer=viaje.id_chofer INNER JOIN camion ON camion.id_camion=viaje.id_camion INNER JOIN ayudante ON ayudante.id_ayudante=viaje.id_ayudante WHERE  numero_pedido='".$numero_pedido."' AND camion.id_camion='".$id_camion."' AND ayudante.id_ayudante='".$id_ayudante."'  AND chofer.id_chofer='".$id_chofer."' ";
		mysql_query("SET NAMES 'UTF8'");
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
while ($line= mysql_fetch_array($result)) 
{
?>
          <tr>
            <td width="13" class="Estilo12">&nbsp;</td>
            <td width="74" class="Estilo12"><span class="Estilo1">
              <?php //echo $id_chofer;
       	  
		  echo $line['numero_pedido'];
		  
		  ?>
            </span></td>
            <td width="288" height="21" class="Estilo12"><span class="Estilo1">
              <?php //echo $id_camion;
         
					
		  echo $line['nombre_chofer'];
		  
		  ?>
            </span></td>
            <td width="158" class="Estilo12"><span class="Estilo1">
              <?php //echo $id_camion;
         
			
		   echo $line['marca_camion'];
		  ?>
            </span> </td>
            <td width="167" class="Estilo12"><span class="Estilo1">
              <?php //echo $id_ayudante;
          
			
		    echo $line['nombre_ayudante'];
		  ?>
            </span> </td>
            <td width="128" class="Estilo12"><span class="Estilo1"><?php echo $fecha_salida; ?></span></td>
            <td width="133" class="Estilo12"><span class="Estilo1"><?php echo $fecha_llegada; ?></span></td>
            <td width="59" class="Estilo12"><span class="Estilo1"><strong><a href="<?php echo "ad_viajes.php?id_usuario=$id_usuario&nombre_usuario=$nombre_usuario&nombre_rol=$nombre_rol&text_pedido=$numero_pedido&text_chofer=$id_chofer&text_camion=$id_camion&text_ayudante=$id_ayudante&text_fechas=$fecha_salida&text_fechal=$fecha_llegada&bt_opcion=Eliminar"; ?>">Eliminar</a></strong></span></td>
            <td width="28" class="Estilo12"><span class="Estilo1"></span></td>
          </tr>
          <?php 
		   
		   }
		   mysql_free_result($result);
		  ?>
        </table>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>
      </form>
    <p>&nbsp;</p></td>
  </tr>
</table>
<p>&nbsp;</p>

</body>
</html>
