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

$opcion='';
$nombre1='';
$nombre2='';
$Total='';
$numero_pedido='';
$fecha_pedido='';
$estado_pedido='';
$cantidad='';
$Eliminar='';
$menu=0;

if (empty($_GET['mensaje']))
{
$mensaje="";
}
else
{
$mensaje=$_GET['mensaje'];
}

if (!empty($_GET['opcion']))
{
 
$opcion=$_GET['opcion'];

	if ($opcion=="Consultar")
	
	{
	   
	   
	   $numero_pedido=$_GET['numero_pedido'];
	   $fecha_pedido=$_GET['fecha_pedido'];
	   $estado_pedido=$_GET['estado_pedido'];
		
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
.Estilo25 {
	font-size: 12px;
	color: #000000;
	font-weight: bold;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.Estilo26 {color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;}
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
        <td width="815"><img src="imagenes/m_reportes1.png" width="888" height="30" /></td>
      </tr>
    </table>
      
        <br />
        <table width="1066" height="31" border="1" cellspacing="0" bordercolor="#EAEAEA" background="imagenes/fondotabla4.png">
          <tr>
            <td height="23" colspan="3" align="center"><span class="Estilo15"><a href="<?php echo "reportes_pedidos.php?id_usuario=$id_usuario&nombre_usuario=$nombre_usuario&nombre_rol=$nombre_rol"; ?>">Pedidos </a></span></td>
            <td width="264" height="23" align="center"><span class="Estilo15"><a href="<?php echo "reportes_viajes.php?id_usuario=$id_usuario&nombre_usuario=$nombre_usuario&nombre_rol=$nombre_rol"; ?>">Viajes</a></span></td>
            <td width="251" height="23" align="center"><span class="Estilo15"><a href="<?php echo "reportes_rutas.php?id_usuario=$id_usuario&nombre_usuario=$nombre_usuario&nombre_rol=$nombre_rol"; ?>">Rutas</a></span></td>
            <td width="310" height="23" align="center"><span class="Estilo5"><span class="Estilo15"><a href="<?php echo "reportes_entregas.php?id_usuario=$id_usuario&nombre_usuario=$nombre_usuario&nombre_rol=$nombre_rol"; ?>">Entregas</a></span></span></td>
          </tr>
          
          

        </table>
        <table width="1066" height="31" border="1" cellspacing="0" bordercolor="#EAEAEA" background="imagenes/fondotabla9.png">
          <tr>
            <td height="23" align="center"><span class="Estilo1"><strong>PEDIDOS</strong></span></td>
          </tr>
        </table>
        <form id="form1" name="form1" method="get" action="ad_reportes_pedidos.php">
          <table width="1066" height="28" border="1" cellspacing="0" bordercolor="#EAEAEA" background="imagenes/fondotabla9.png">
            <tr>
              <td width="283" height="26" align="center" class="Estilo1"><span class="Estilo12"><strong>Número de Pedido<span class="Estilo5">
                <input name="text_numero" type="text" id="text_numero" value ="<?php echo $numero_pedido ?>" size="10"  />
              </span></strong></span></td>
              <td width="307" height="26" align="center" class="Estilo1"><span class="Estilo12"><strong>Fecha de Pedido<span class="Estilo5">
                <input name="text_fecha" type="text" id="text_fecha" value ="<?php echo $fecha_pedido ?>"  size="10" readonly="readonly"/>
                <img src="ima/calendario.png" width="16" height="16" border="0" title="Fecha Inicial" id="lanzador" onclick="calendario()" /></span></strong></span></td>
              <td width="311" align="center"><span class="Estilo1"><span class="Estilo12"><strong>Estado de Pedido</strong></span>
                <select name="estado_pedido" id="estado_pedido">
                  <option value="ENTREGADO">1</option>
                  <option value="PENDIENTE">0</option>
                </select>
              </span></td>
              <td width="147" align="center"><input name="bt_opcion" type="submit" id="bt_opcion" value="Consultar" />
                <span class="Estilo1">
                <input name="nombre_rol" type="hidden" id="nombre_rol" value="<?php echo $nombre_rol?>"/>
                <input name="nombre_usuario" type="hidden" id="nombre_usuario" value="<?php echo $nombre_usuario?>"/>
                <input name="id_usuario" type="hidden" id="id_usuario" value="<?php echo $id_usuario ?>"/>
                </span> </td></tr>
          </table>
      </form>
       
        <table width="941" height="170" border="1" cellspacing="0" bordercolor="#EAEAEA" background="imagenes/fondotabla4.png">
          <?php
		
if ($opcion=="Consultar")
{
		
		 $query = "SELECT id_pedido,numero_pedido,proveedor.id_proveedor,nombre_proveedor,producto.id_producto,nombre_producto,cliente.id_cliente,nombre_cliente,nombre_ciudad,cantidad_pedido,fecha_pedido, estado_pedido FROM pedido INNER JOIN proveedor ON proveedor.id_proveedor=pedido.id_proveedor INNER JOIN cliente ON cliente.id_cliente=pedido.id_cliente INNER JOIN producto ON producto.id_producto=pedido.id_producto INNER JOIN ciudad ON cliente.id_ciudad=ciudad.id_ciudad WHERE numero_pedido='".$numero_pedido."' ORDER BY producto.nombre_producto,cliente.nombre_cliente";
mysql_query("SET NAMES 'UTF8'");
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

?>

<?php if ($menu==0)

{
?>
  <tr>
    <td height="21" colspan="5" align="right" class="Estilo25"><span class="Estilo25"><a href="<?php echo "reporte_pedidos_pdf.php?id_usuario=$id_usuario&nombre_usuario=$nombre_usuario&nombre_rol=$nombre_rol&text_numero=$numero_pedido"; ?>"><img src="imagenes/excel.png" width="60" height="21" /></a><span class="Estilo15"><a href="<?php echo "reporte_pedidos_pdf.php?id_usuario=$id_usuario&nombre_usuario=$nombre_usuario&nombre_rol=$nombre_rol&numero_pedido=$numero_pedido&fecha_pedido=$fecha_pedido&estado_pedido=$estado_pedido"; ?>"> <img src="imagenes/pdf.png" width="60" height="20" /></a></span></td>
  </tr>
  <tr>
    <td height="21" colspan="5" align="left" ><span class="Estilo25"><strong>Número de Pedido: </strong></span><span class="Estilo26"><?php echo $numero_pedido ?></span> </td>
    </tr>
  <tr>
    <td height="21" colspan="5" align="left" ><span class="Estilo25"><strong>Fecha de Pedido: </strong></span><span class="Estilo26"><?php echo $fecha_pedido ?></span></td>
    </tr>
  
  <tr>
            <td width="181" height="21" align="center" class="Estilo12"><span class="Estilo15">Proveedor</span></td>
            <td width="256" align="center"><span class="Estilo15">Producto</span></td>
            <td width="244" align="center"><span class="Estilo15">Cliente</span></td>
            <td width="98" align="center" class="Estilo12"><span class="Estilo15">Cantidad</span></td>
            <td width="152" align="center"><span class="Estilo15">Estado  </span></td>
          </tr>
<?php
$menu=1;
}
?>
<?php
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
            <td width="181" height="21" class="Estilo12"><span class="Estilo1"><strong><?php echo $Total; ?></strong></span></td>
            <td width="256">&nbsp;</td>
            <td width="244">&nbsp;</td>
            <td width="98" align="right" class="Estilo12"><span class="Estilo1"><strong><?php echo $total_pedido; ?></strong></span></td>
            <td width="152" align="center">&nbsp;</td>
          </tr>
          <?php 
		
		  }
  		  }
		 $nombre1=$nombre2;  
		$cantidad=$cantidad+1;

		 ?>
          <tr>
            <td height="21" class="Estilo12"><span class="Estilo5 Estilo18 Estilo1">
              <?php $id_proveedor=$line['id_proveedor']; echo $line['nombre_proveedor'] ?>
            </span></td>
            <td class="Estilo12"><span class="Estilo5 Estilo18 Estilo1">
              <?php $id_producto=$line['id_producto']; echo $line['nombre_producto'] ?>
            </span></td>
            <td class="Estilo12"><span class="Estilo5 Estilo18 Estilo1">
              <?php $id_cliente=$line['id_cliente']; echo $line['nombre_ciudad'] ."/". $line['nombre_cliente']?>
            </span></td>
            <td align="right" class="Estilo12"><span class="Estilo5 Estilo18 Estilo1">
              <?php $cantidad_pedido=$line['cantidad_pedido']; echo $line['cantidad_pedido'] ?>
            </span></td>
            <td align="center" class="Estilo12"><span class="Estilo1">
              <?php $estado_pedido=$line['estado_pedido']; echo $line['estado_pedido'] ?>
            </span></td>
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
            <td height="21" class="Estilo12"><span class="Estilo1"><strong><?php echo $Total; ?></strong></span></td>
            <td><span class="Estilo1"></span></td>
            <td><span class="Estilo1"></span></td>
            <td align="right" class="Estilo12"><span class="Estilo1"><strong><?php echo $total_pedido; ?></strong></span></td>
            <td align="center"><span class="Estilo1"></span></td>
          </tr>
      </table>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <label></label>
  
      <p></p></td>
  </tr>
</table>
<p>&nbsp;</p>


<map name="Map" id="Map"><area shape="poly" coords="210,28" href="#" /></map></body>
</html>
