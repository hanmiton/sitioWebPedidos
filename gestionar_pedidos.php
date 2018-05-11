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
$total_pedido='';
$cantidad=0;
$nombre1=0;
$nombre2='';
$Total='';

$Eliminar='Eliminar';
  
if (!empty($_GET['opcion']))
{
 
$opcion=$_GET['opcion'];

	if ($opcion=="Registrar")
	
	{
	   
	   
	   $id_proveedor=$_GET['id_proveedor'];
	   $id_producto=$_GET['id_producto'];
	   $id_cliente= $_GET['id_cliente'];
	   $numero_pedido=$_GET['numero_pedido'];
	   $fecha_pedido=$_GET['fecha_pedido'];
	   $estado_pedido=$_GET['estado_pedido'];
	   $asignado_pedido= $_GET['asignado_pedido'];
	   
	   $disablednuevo='disabled';
	   $disabledbuscar='disabled';
	   $disabledbotones='';
	   $readonly="readonly";
		
	}
	
	if ($opcion=="Buscar")
	{
	
		$numero_pedido=$_GET['numero_pedido'];
		$fecha_pedido=$_GET['fecha_pedido'];
		$estado_pedido=$_GET['estado_pedido'];
		$asignado_pedido= $_GET['asignado_pedido'];
		$Eliminar="";
	

	}
	
	
	if ($opcion=="Nuevo")
	{
	   $numero_pedido=$_GET['numero_pedido'];
	   $disablednuevo='disabled';
	   $disabledbuscar='disabled';
	   $disabledbotones='';
	   $readonly="readonly";
	}
	
	if ($opcion=="Cancelar")
	{
	   $numero_pedido=$_GET['numero_pedido'];
	   $disablednuevo='';
	   $disabledbuscar='';
	   $disabledbotones='disabled';
	    $readonly="";
	}
	
	if ($opcion=="Guardar")
	{
	   $numero_pedido=$_GET['numero_pedido'];
	   $disablednuevo='';
	   $disabledbuscar='';
	   $disabledbotones='disabled';
	    $readonly="";
	}
	
	if ($opcion=="Eliminar")
	
	{
	   $id_proveedor=$_GET['id_proveedor'];
	   $id_producto=$_GET['id_producto'];
	   $id_cliente= $_GET['id_cliente'];
	   $numero_pedido=$_GET['numero_pedido'];
	   $fecha_pedido=$_GET['fecha_pedido'];
	   $estado_pedido=$_GET['estado_pedido'];
	   $asignado_pedido= $_GET['asignado_pedido'];
	   
	   $disablednuevo='disabled';
	   $disabledbuscar='disabled';
	   $disabledbotones='';
	   $readonly="readonly";
		
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
var mensaje = "<?php echo $mensaje ?>";
window.onload = ver_mensaje
function ver_mensaje(){
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
<table width="991" border="0" align="left" cellspacing="0" background="imagenes/fondotabla8.png">
  <tr>
    <td colspan="2" valign="top"><img src="imagenes/logo_pedidos.png" width="1352" height="129" /></td>
  </tr>
  <tr>
    <td width="262" height="463" valign="top" background="imagenes/tabla.jpg"><table width="249" height="93" border="0" cellspacing="0" background="imagenes/tabla.jpg" valign="top">
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
        <td width="815"><img src="imagenes/m_gestionar_pedidos.png" width="888" height="30" /></td>
      </tr>
    </table>
      <form id="form1" name="form1" method="get" action="ad_pedidos.php">
        <br />
        <table width="1072" height="149" border="1" cellspacing="0" bordercolor="#EAEAEA" background="imagenes/fondotabla4.png">
          <tr>
            <td height="21" colspan="8">&nbsp;</td>
          </tr>
          <tr>
            <td width="47">&nbsp;</td>
            <td width="181" height="21"><span class="Estilo15">Número Pedido </span></td>
            <td width="256"><span class="Estilo5">
              <input name="text_numero" type="text" id="text_numero" value ="<?php echo $numero_pedido ?>" size="10"  <?php echo $readonly; ?>/>
              <input name="bt_opcion" type="submit" id="bt_opcion" value="Buscar" <?php echo $disabledbuscar; ?> />
              <input name="bt_opcion" type="submit" id="bt_opcion" value="Nuevo"  <?php echo $disablednuevo; ?>>
            </span></td>
            <td width="93"><span class="Estilo15">Fecha Pedido </span></td>
            <td width="151"><span class="Estilo5">
              <input name="text_fecha" type="text" id="text_fecha" value ="<?php echo $fecha_pedido ?>"  size="10" readonly="readonly"/>
              <img src="ima/calendario.png" width="16" height="16" border="0" title="Fecha Inicial" id="lanzador" onclick="calendario()" /></span></td>
            <td width="98"><span class="Estilo15">Asignado</span></td>
            <td colspan="2"><span class="Estilo5">
              <input name="text_asignado" type="text" id="text_asignado" value ="<?php echo $asignado_pedido; ?>" size="5" maxlength="10" readonly="readonly"/>
            </span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td height="21"><span class="Estilo15">Proveedor</span></td>
            <td align="center"><span class="Estilo15">Producto</span></td>
            <td colspan="2" align="center"><span class="Estilo15">Cliente</span></td>
            <td align="center"><span class="Estilo15">Cantidad</span></td>
            <td align="center"><span class="Estilo15">Estado</span></td>
            <td><input name="bt_opcion" type="submit" id="bt_opcion" value="Cancelar" <?php echo $disabledbotones; ?> /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td height="21"><select name="text_proveedor" class="Estilo12" id="text_proveedor">
                <option value="<?php echo $id_proveedor?>">
                <?php 
		  
		  
		  $query = "SELECT nombre_proveedor FROM proveedor WHERE id_proveedor='".$id_proveedor."'";
		mysql_query("SET NAMES 'UTF8'");
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
while ($line= mysql_fetch_array($result)) 
{
		  $nombre_proveedor=$line['nombre_proveedor'];
		  
		  }
		   mysql_free_result($result);
		  echo $nombre_proveedor?>
                </option>
                <?php $query = "SELECT id_proveedor, nombre_proveedor FROM proveedor";
		mysql_query("SET NAMES 'UTF8'");
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
while ($line= mysql_fetch_array($result)) 
{
?>
                <option value="<?php echo $line['id_proveedor'];?>"> <?php echo $line['nombre_proveedor'];?></option>
                <?php

 }
 mysql_free_result($result);
?>
            </select></td>
            <td><select name="text_producto" class="Estilo12" id="select2">
                <option value="<?php echo $id_producto?>">
                <?php 
			
	  
		  
		  $query = "SELECT nombre_producto FROM producto WHERE id_producto='".$id_producto."'";
		mysql_query("SET NAMES 'UTF8'");
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
while ($line= mysql_fetch_array($result)) 
{
		  $nombre_producto=$line['nombre_producto'];
		  
		  }
		   mysql_free_result($result);
		  echo $nombre_producto?>
                </option>
              
            
            
              
              
			
			
			
			?>
                <?php $query = "SELECT id_producto, nombre_producto FROM producto";
mysql_query("SET NAMES 'UTF8'");
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
while ($line= mysql_fetch_array($result)) 
{
?>
                <option value="<?php echo $line['id_producto'];?>"> <?php echo $line['nombre_producto'];?></option>
                <?php

 }
 mysql_free_result($result);
?>
            </select></td>
            <td colspan="2"><select name="text_cliente" class="Estilo12" id="select3">
                <option value="<?php echo $id_cliente?>">
                <?php 
			
		  $query = "SELECT nombre_cliente,nombre_ciudad FROM cliente INNER JOIN ciudad ON cliente.id_ciudad=ciudad.id_ciudad WHERE id_cliente='".$id_cliente."'";
		mysql_query("SET NAMES 'UTF8'");
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
while ($line= mysql_fetch_array($result)) 
{
		  $nombre_cliente=$line['nombre_cliente'];
		  $nombre_ciudad=$line['nombre_ciudad'];
		  $ss=" / ";
		  }
		   mysql_free_result($result);
		  echo $nombre_ciudad.$ss.$nombre_cliente;
		  
		  ?>
                </option>
                <?php $query = "SELECT id_cliente, nombre_cliente, direccion_cliente,nombre_ciudad FROM cliente INNER JOIN ciudad ON ciudad.id_ciudad=cliente.id_ciudad order by nombre_ciudad ";
mysql_query("SET NAMES 'UTF8'");
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
while ($line= mysql_fetch_array($result)) 
{
?>
                <option value="<?php echo $line['id_cliente'];?>"> <?php echo $line['nombre_ciudad']." / ".$line['nombre_cliente'];?></option>
                <?php

 }
 mysql_free_result($result);
?>
            </select></td>
            <td><span class="Estilo5">
              <input name="text_cantidad" type="text" id="text_cantidad" value ="<?php  ?>" size="8" maxlength="10" />
            </span></td>
            <td><span class="Estilo5">
              <input name="text_estado" type="text" id="text_estado" value ="<?php echo $estado_pedido; ?>" size="5" maxlength="10" readonly="readonly" />
            </span></td>
            <td><span class="Estilo5">
              <input name="bt_opcion" type="submit" id="bt_opcion" value="Registrar" <?php echo $disabledbotones; ?>/>
            </span></td>
          </tr>
          <?php
		
if (($opcion=="Buscar") || ($opcion=="Eliminar") || ($opcion=="Registrar"))
{
		
		 $query = "SELECT id_pedido,numero_pedido,proveedor.id_proveedor,nombre_proveedor,producto.id_producto,nombre_producto,cliente.id_cliente,nombre_cliente,nombre_ciudad,cantidad_pedido,fecha_pedido, estado_pedido FROM pedido INNER JOIN proveedor ON proveedor.id_proveedor=pedido.id_proveedor INNER JOIN cliente ON cliente.id_cliente=pedido.id_cliente INNER JOIN producto ON producto.id_producto=pedido.id_producto INNER JOIN ciudad ON cliente.id_ciudad=ciudad.id_ciudad WHERE numero_pedido='".$numero_pedido."' ORDER BY producto.nombre_producto,cliente.nombre_cliente";
mysql_query("SET NAMES 'UTF8'");
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

while ($line= mysql_fetch_array($result)) 
{ 
$numero_pedido=$line['numero_pedido'];
$fecha_pedido=$line['fecha_pedido'];
$nombre2=$line['id_producto'];
?>
          <?php 
			//echo "Total";
			if ($cantidad>0) 
			{
			

				if ($nombre1!=$nombre2)
				
				{
			 
					$query1 = "SELECT SUM(cantidad_pedido) as total_pedido FROM pedido INNER JOIN producto ON producto.id_producto=pedido.id_producto WHERE pedido.numero_pedido='".$numero_pedido."' and producto.id_producto='".$nombre1."' ";
					mysql_query("SET NAMES 'UTF8'");
					$result1 = mysql_query($query1) or die('Consulta fallida: ' . mysql_error());
					while ($line1= mysql_fetch_array($result1)) 
					{ 
					$total_pedido=$line1['total_pedido'];
					
					}
					mysql_free_result($result1);
					if (!empty($total_pedido))
					{
					$Total='Total';
					}
				  
	
?>
          <tr>
            <td>&nbsp;</td>
            <td height="21" class="Estilo12"><span class="Estilo1"><strong><?php echo $Total; ?></strong></span></td>
            <td>&nbsp;</td>
            <td colspan="2">&nbsp;</td>
            <td align="right" class="Estilo12"><span class="Estilo1"><strong><?php echo $total_pedido; ?></strong></span></td>
            <td align="center">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <?php 
		
		  }
  		  }
		 $nombre1=$nombre2;  
		$cantidad=$cantidad+1;

		 ?>
          <tr>
            <td class="Estilo12"><span class="Estilo5 Estilo18 Estilo1"></span></td>
            <td height="21" class="Estilo12"><span class="Estilo5 Estilo18 Estilo1">
              <?php $id_proveedor=$line['id_proveedor']; echo $line['nombre_proveedor'] ?>
            </span></td>
            <td class="Estilo12"><span class="Estilo5 Estilo18 Estilo1">
              <?php $id_producto=$line['id_producto']; echo $line['nombre_producto'] ?>
            </span></td>
            <td colspan="2" class="Estilo12"><span class="Estilo5 Estilo18 Estilo1">
              <?php $id_cliente=$line['id_cliente']; echo $line['nombre_ciudad'] ."/". $line['nombre_cliente']?>
            </span></td>
            <td align="right" class="Estilo12"><span class="Estilo5 Estilo18 Estilo1">
              <?php $cantidad_pedido=$line['cantidad_pedido']; echo $line['cantidad_pedido'] ?>
            </span></td>
            <td align="center" class="Estilo12"><span class="Estilo1">
              <?php $estado_pedido=$line['estado_pedido']; echo $line['estado_pedido'] ?>
            </span></td>
            <td class="Estilo12"><span class="Estilo1"><strong><a href="<?php echo "ad_pedidos.php?id_usuario=$id_usuario&nombre_usuario=$nombre_usuario&nombre_rol=$nombre_rol&text_numero=$numero_pedido&text_proveedor=$id_proveedor&text_producto=$id_producto&text_cliente=$id_cliente&text_cantidad=$cantidad_pedido&text_fecha=$fecha_pedido&text_asignado=$asignado_pedido&text_estado=$estado_pedido&bt_opcion=Eliminar"; ?>"><?php echo $Eliminar; ?></a></strong></span></td>
          </tr>
          <?php 
       }
}
?>
          <?php 
			//echo "Total";
			
					$query1 = "SELECT SUM(cantidad_pedido) as total_pedido FROM pedido INNER JOIN producto ON producto.id_producto=pedido.id_producto WHERE pedido.numero_pedido='".$numero_pedido."' and producto.id_producto='".$nombre2."' ";
					mysql_query("SET NAMES 'UTF8'");
					$result1 = mysql_query($query1) or die('Consulta fallida: ' . mysql_error());
					while ($line1= mysql_fetch_array($result1)) 
					{ 
					$total_pedido=$line1['total_pedido'];
					
					}
					mysql_free_result($result1);
					if (!empty($total_pedido))
					{
					$Total='Total';
					}
				  
	
?>
          <tr>
            <td><span class="Estilo1"></span></td>
            <td height="21" class="Estilo12"><span class="Estilo1"><strong><?php echo $Total; ?></strong></span></td>
            <td><span class="Estilo1"></span></td>
            <td colspan="2"><span class="Estilo1"></span></td>
            <td align="right" class="Estilo12"><span class="Estilo1"><strong><?php echo $total_pedido; ?></strong></span></td>
            <td align="center"><span class="Estilo1"></span></td>
            <td><span class="Estilo1">
              <input name="nombre_rol" type="hidden" id="nombre_rol" value="<?php echo $nombre_rol?>"/>
              <input name="nombre_usuario" type="hidden" id="nombre_usuario" value="<?php echo $nombre_usuario?>"/>
              <input name="id_usuario" type="hidden" id="id_usuario" value="<?php echo $id_usuario ?>"/>
            </span></td>
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
