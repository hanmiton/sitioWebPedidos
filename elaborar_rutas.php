<?php

include("conexion_base.php");
session_start();
$sesion_usuario=$_SESSION['id_usuario'];

if (!isset($sesion_usuario)) {
   header('Location: index.php');
   break;
}

$id_usuario=$_REQUEST['id_usuario'];
$nombre_usuario=$_REQUEST['nombre_usuario'];
$nombre_rol=$_REQUEST['nombre_rol'];


if (empty($_REQUEST['mensaje']))
{
$mensaje="";
}
else
{
$mensaje=$_REQUEST['mensaje'];
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
$id_chofer='';
$nombre_chofer='';
$cantidad=0;
  
if (!empty($_REQUEST['opcion']))
{
 
$opcion=$_REQUEST['opcion'];

	if ($opcion=="Registrar")
	
	{
	   
	   
	   $id_proveedor=$_REQUEST['id_proveedor'];
	   $id_producto=$_REQUEST['id_producto'];
	   $id_cliente= $_REQUEST['id_cliente'];
	   $numero_pedido=$_REQUEST['numero_pedido'];
	   $fecha_pedido=$_REQUEST['fecha_pedido'];
	   $estado_pedido=$_REQUEST['estado_pedido'];
	   $asignado_pedido= $_REQUEST['asignado_pedido'];
	   
	   $disablednuevo='disabled';
	   $disabledbuscar='disabled';
	   $disabledbotones='';
	   $readonly="readonly";
		
	}
	
	if ($opcion=="Buscar")
	{
	
		$numero_pedido=$_REQUEST['numero_pedido'];
		$Eliminar="";
	

	}
	
	if ($opcion=="Guardar Ruta")
	{
	
		$numero_pedido=$_REQUEST['numero_pedido'];
		$Eliminar="";
	

	}
	
	
	if ($opcion=="Nuevo")
	{
	   $numero_pedido=$_REQUEST['numero_pedido'];
	   $disablednuevo='disabled';
	   $disabledbuscar='disabled';
	   $disabledbotones='';
	   $readonly="readonly";
	}
	
	if ($opcion=="Cancelar")
	{
	   $numero_pedido=$_REQUEST['numero_pedido'];
	   $disablednuevo='';
	   $disabledbuscar='';
	   $disabledbotones='disabled';
	    $readonly="";
	}
	
	if ($opcion=="Guardar")
	{
	   $numero_pedido=$_REQUEST['numero_pedido'];
	   $disablednuevo='';
	   $disabledbuscar='';
	   $disabledbotones='disabled';
	    $readonly="";
	}
	
	if ($opcion=="Eliminar")
	
	{
	   $id_proveedor=$_REQUEST['id_proveedor'];
	   $id_producto=$_REQUEST['id_producto'];
	   $id_cliente= $_REQUEST['id_cliente'];
	   $numero_pedido=$_REQUEST['numero_pedido'];
	   $fecha_pedido=$_REQUEST['fecha_pedido'];
	   $estado_pedido=$_REQUEST['estado_pedido'];
	   $asignado_pedido= $_REQUEST['asignado_pedido'];
	   
	   $disablednuevo='disabled';
	   $disabledbuscar='disabled';
	   $disabledbotones='';
	   $readonly="readonly";
		
	}

}



?>



<!DOCTYPE html>
<html lang="es">
	

<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Sistema GEPL&M</title>
	



<style type="text/css">
body{background-color:#8DD7F8;background-image:url(http://image.geoipview.com/bk_all.png);}
#footer{color:#fff;background-image:url(http://image.geoipview.com/bk_footer.png);background-position:0px 0px;background-repeat:no-repeat}
#iparea{width:765px;height:530px;padding:0px 0px 0px 0px;margin-top:10px}
#iparea{text-align:center}
#ipinfo{clear:both;width:765px;margin:0px 0px 0px 0px;text-align:center}
#ipinfo_l{text-align:left;width:280px;padding:0px;float:left;color:#333}
#ipinfo_r{text-align:left;width:478px;padding:0px;float:right}
#ipinfo_234{height:60;text-align:center;margin:10px 0px 10px 0px}
#yourip{margin:5px 0px 0px 9px;color:#444;text-align:center}
#ipinfo_form_show{height:300px;background-image:url(http://image.geoipview.com/bk_left.png);background-position:0px 0px;background-repeat:repeat-x}
#ipinfo_form{padding:20px 0px 0px 0px}
#ipinfo_show{margin:14px 0px 0px 0px}
.show1{text-align:right}
.ip{color:#3A5F96}
.show2{font-weight:bold}
#ipinfo_res_link{color:#3A5F96;margin:0px 0px 0px 10px}
#ipinfo_res_link A{color:#3A5F96;Text-Decoration:none}
#ipinfo_res_link A:hover{color:#0000ff;Text-Decoration:underline}
#mymap_box{border:1px #1FB3EE solid;padding:4px}
#mymap,#mymap_t,#mymap_b{width:468px;padding:0px 0px 0px 0px;text-align:center}
#mymap{height:400px;margin:2px 0px 2px 0px}
#mymap_b,#mymap_t{height:62}
#mymap_b{border-top:1px #1FB3EE solid}
#mymap_t{border-bottom:1px #1FB3EE solid}
#loading{color:#999;font-size:32px;line-height:32px;}
#input_box{font-size:10px;background-color:#FEFFEC}
#input_btn{height:32px;font-size:18px}
.DarkLines{background-color:#1D9DD9}
.FieldTitle{background-color:#1D9DD9;color:#fff;vertical-align:middle;text-align:center;padding:0px}
.FieldBody{background-color:#fff;color:#000;padding:0px}
</style>
<script src="http://maps.google.com/maps?file=api&amp;hl=es&amp;v=2&amp;key=
AIzaSyAaqgXrZg7H8F4SE_Q5le6t-ZgOLYQYKN8" type="text/javascript"></script>
<script type="text/javascript">
function load_map(pi_bData) 
{
  init_height();
  if ( pi_bData )
  {
    if (GBrowserIsCompatible()) 
    {
      var map = new GMap2(document.getElementById("mymap"));
      map.addControl(new GLargeMapControl());
      map.addControl(new GMapTypeControl());
      map.setCenter(new GLatLng(-0.21670000255108, -78.5), 8);
      var marker = new GMarker(new GLatLng(-0.21670000255108, -78.5));
      //marker.html = "<div style='text-align:left'><b>Tu IP</b>: 186.46.91.219<br><b>Ciudad</b>: Quito, Ecuador</div>";
      GEvent.addListener(marker, "click", function() {marker.openInfoWindowHtml(marker.html); });
      map.addOverlay(marker);
     // marker.openInfoWindowHtml(marker.html);
    }
  }
}
</script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="distribution" content="Global">
<meta name="Classification" content="Software">
<meta name="robots" content="ALL">
<style type="text/css">

</style>
<script type="text/javascript">
function init_height(){
	var hl = document.getElementById("ipinfo_l").offsetHeight;
	var hr = document.getElementById("ipinfo_r").offsetHeight;
	var h = hl > hr ? hl : hr;
	document.getElementById("ipinfo_l").style.height = h + "px";
	document.getElementById("ipinfo_r").style.height = h + "px";
}
</script>




			<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Form Elements - Ace Admin</title>

		<meta name="description" content="Common form elements and layouts" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="responsiweb.com/dist/css/bootstrap.min.css" />
		<link rel="stylesheet" href="maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="responsiweb.com/dist/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="responsiweb.com/dist/css/chosen.min.css" />
		<link rel="stylesheet" href="responsiweb.com/dist/css/bootstrap-datepicker3.min.css" />
		<link rel="stylesheet" href="responsiweb.com/dist/css/bootstrap-timepicker.min.css" />
		<link rel="stylesheet" href="responsiweb.com/dist/css/daterangepicker.min.css" />
		<link rel="stylesheet" href="responsiweb.com/dist/css/bootstrap-datetimepicker.min.css" />
		<link rel="stylesheet" href="responsiweb.com/dist/css/colorpicker.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

		<!-- ace styles -->
		<link rel="stylesheet" href="responsiweb.com/dist/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		
		<script src="dist/js/ace-extra.min.js"></script>
</head>

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



 
	<body class="no-skin" onLoad="load_map(1)" onUnload="GUnload()">
		<div id="navbar" class="navbar navbar-default">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-container" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>				</button>

				<div class="navbar-header pull-left">
					<a href="#" class="navbar-brand">
						<small>
							
							<img src="imagenes/logo_pedidos.png" width="1310" height="120" >						</small>					</a>				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						

					

						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="responsiweb.com/dist/avatars/usuario.png" alt="Usuario" />
								<span class="user-info">
									<small>Bienvendio,</small>
									<?php  echo $nombre_usuario;?>	</span>

								<i class="ace-icon fa fa-caret-down"></i>							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="perfil.php<?php echo "?id_usuario=$id_usuario&nombre_usuario=$nombre_usuario&nombre_rol=$nombre_rol&perfil=1"; ?>">
										<i class="ace-icon fa fa-user"></i>
										Perfil
									</a>							</li>

								<li class="divider"></li>

								<li>
									<a href="index.php">
										<i class="ace-icon fa fa-power-off"></i>
										Salir									</a>								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>

	<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar                  responsive">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
				  <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>				  </div>
			  </div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
				  
				   <?php if ($nombre_rol=="Administrador") 
				  
				  {
				  
				  ?>
							<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> Administrar</span>

							<b class="arrow fa fa-angle-down"></b>						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="administrar_usuarios.php<?php echo "?id_usuario=$id_usuario&nombre_usuario=$nombre_usuario&nombre_rol=$nombre_rol"; ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Usuarios							</a>

								<b class="arrow"></b>							</li>

							<li class="">
								<a href="administrar_conductores.php<?php echo "?id_usuario=$id_usuario&nombre_usuario=$nombre_usuario&nombre_rol=$nombre_rol"; ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Conductores							</a>

								<b class="arrow"></b>							</li>
								
								<li class="">
								<a href="administrar_clientes.php<?php echo "?id_usuario=$id_usuario&nombre_usuario=$nombre_usuario&nombre_rol=$nombre_rol"; ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Clientes						</a>

								<b class="arrow"></b>							</li>
								
								<li class="">
								<a href="administrar_camiones.php<?php echo "?id_usuario=$id_usuario&nombre_usuario=$nombre_usuario&nombre_rol=$nombre_rol"; ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Camiones						</a>

								<b class="arrow"></b>							</li>
								<li class="">
								<a href="administrar_ayudantes.php<?php echo "?id_usuario=$id_usuario&nombre_usuario=$nombre_usuario&nombre_rol=$nombre_rol"; ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Ayudantes						</a>

								<b class="arrow"></b>							</li>
						</ul>
					</li>
					
					
					<?php 
}
?>

  <?php if (($nombre_rol=="Administrador") ||   ($nombre_rol=="Secretaria"))
				  
				  {
				  
				  ?>
					<li class="active open">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-file-o"></i>
							<span class="menu-text"> Elaborar</span>

							<b class="arrow fa fa-angle-down"></b>						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="elaborar_pedidos.php<?php echo "?id_usuario=$id_usuario&nombre_usuario=$nombre_usuario&nombre_rol=$nombre_rol"; ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Pedidos								</a>

								<b class="arrow"></b>							</li>

							<li class="">
								<a href="elaborar_viajes.php<?php echo "?id_usuario=$id_usuario&nombre_usuario=$nombre_usuario&nombre_rol=$nombre_rol"; ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Viajes					</a>

								<b class="arrow"></b>							</li>

							<li class="active">
								<a href="elaborar_rutas.php<?php echo "?id_usuario=$id_usuario&nombre_usuario=$nombre_usuario&nombre_rol=$nombre_rol"; ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Rutas					</a>

								<b class="arrow"></b>							</li>

						</ul>
					</li>
					
	<?php 
}
?>

		
		
		 <?php if (($nombre_rol=="Administrador") ||   ($nombre_rol=="Chofer"))
				  
				  {
				  
				  ?>		
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text"> Entregar </span>

							<b class="arrow fa fa-angle-down"></b>						</a>

						<b class="arrow"></b>
						
						<ul class="submenu">
							<li class="">
								<a href="entregar_pedidos.php<?php echo "?id_usuario=$id_usuario&nombre_usuario=$nombre_usuario&nombre_rol=$nombre_rol"; ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Pedidos								</a>

								<b class="arrow"></b>							</li>
	                  </ul>
					  
<?php 
}
?>		

		  
  <?php if (($nombre_rol=="Administrador") ||   ($nombre_rol=="Secretaria"))
				  
				  {
				  
				  ?>					  
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list-alt"></i>
							<span class="menu-text"> Reportes </span>

							<b class="arrow fa fa-angle-down"></b>						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="reporte_pedidos.php<?php echo "?id_usuario=$id_usuario&nombre_usuario=$nombre_usuario&nombre_rol=$nombre_rol"; ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Todos los Pedidos								</a>

								<b class="arrow"></b>							</li>

							<li class="">
								<a href="reporte_pedidos_elaborados.php<?php echo "?id_usuario=$id_usuario&nombre_usuario=$nombre_usuario&nombre_rol=$nombre_rol"; ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Pedidos Elaborados					</a>

								<b class="arrow"></b>							</li>

							<li class="">
								<a href="reporte_pedidos_entregados.php<?php echo "?id_usuario=$id_usuario&nombre_usuario=$nombre_usuario&nombre_rol=$nombre_rol"; ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Pedidos Entregados					</a>

								<b class="arrow"></b>							</li>
						</ul>
					</li>
					
					<?php 
}
?>	
					
					
					
					
</ul>
			    <!-- /.nav-list -->
<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
				
		  </div>
				<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
								<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								
								<a href="#">Elaborar</a>							</li>
							<li class="active">Rutas</li>
						
						</ul><!-- /.breadcrumb -->
		
					</div>

					<div class="page-content">
					  <div class="page-header">
							<h1>
								Elaborar Rutas </h1>
					  </div>
						
						
								
									

						<div class="row">
							<div class="col-xs-12">
											
								<form class="form-horizontal" role="form" method="POST"  action="ad_rutas.php">
								  <div class="row">
								<div class="col-xs-12">
											
								<table id="simple-table" class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
																							
													<th width="12%">Pedido
													  <select name="numero_pedido"  id="numero_pedido">
			  
			 <?php if (!empty($numero_pedido))
			 {?>
			   <option value="<?php echo $numero_pedido;?>"> <?php  echo $numero_pedido;?></option>
			 <?php }?>
                <?php $query = "SELECT viaje.numero_pedido FROM viaje INNER JOIN chofer ON viaje.id_chofer=chofer.id_chofer INNER JOIN pedido ON pedido.numero_pedido=viaje.numero_pedido WHERE pedido.asignado_pedido='1' AND viaje.estado_viaje='0' GROUP BY pedido.numero_pedido";
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
              </select>
													  <span class="hidden-480">
													  <input name="bt_opcion" type="submit" id="bt_opcion" value="Buscar">
												      <input name="id_usuario" type="hidden" id="id_usuario" value="<?php echo $id_usuario ?>"/>
												      <input name="nombre_usuario" type="hidden" id="nombre_usuario" value="<?php echo $nombre_usuario?>"/>
												      <input name="nombre_rol" type="hidden" id="nombre_rol" value="<?php echo $nombre_rol?>"/>
												  </span></th>
												</tr>
											</thead>

											<tbody>
											
											
											
										</tbody>
										</table>
							</div><!-- /.page-content -->
				</div>				
											
											
									<div class="row">
								<div class="col-xs-12">
											
								<table id="simple-table" class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
																							
													<th>Ciudad</th>
													<th>Cliente</th>
													<th class="hidden-480">Dirección</th>

													<th>Orden de Ruta </th>
													<th class="hidden-480">Ruta</th>

													<th class="hidden-480"><span class="Estilo5">
													  <input name="bt_opcion" type="submit" id="bt_opcion" value="Guardar Ruta" <?php echo $disabledbuscar; ?> />
													</span></th>
												</tr>
											</thead>

											<tbody>
								
								
 <?php if (($opcion=="Buscar") || ($opcion=="Guardar Ruta"))
{
		
		 $query = "SELECT nombre_ciudad,nombre_cliente,direccion_cliente,telefono_cliente,pedido.numero_pedido,proveedor.id_proveedor,nombre_proveedor,producto.id_producto,nombre_producto,cliente.id_cliente,nombre_cliente,ciudad.id_ciudad,nombre_ciudad,cantidad_pedido,fecha_pedido,estado_pedido,orden_ruta,chofer.id_chofer FROM pedido INNER JOIN viaje ON viaje.numero_pedido=pedido.numero_pedido INNER JOIN proveedor ON proveedor.id_proveedor=pedido.id_proveedor INNER JOIN cliente ON cliente.id_cliente=pedido.id_cliente INNER JOIN producto ON producto.id_producto=pedido.id_producto INNER JOIN ciudad ON cliente.id_ciudad=ciudad.id_ciudad INNER JOIN chofer ON chofer.id_chofer=viaje.id_chofer WHERE viaje.estado_viaje='0' and pedido.numero_pedido='".$numero_pedido."'  GROUP BY nombre_ciudad,nombre_cliente ORDER BY orden_ruta";
mysql_query("SET NAMES 'UTF8'");
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

while ($line= mysql_fetch_array($result)) 
{ 
$numero_pedido=$line['numero_pedido'];
$fecha_pedido=$line['fecha_pedido'];
$cantidad=$cantidad+1;
?>
          <tr>
		  
		   <td >
              <?php $id_ciudad=$line['id_ciudad']; $nombre_ciudad=$line['nombre_ciudad']; echo $line['nombre_ciudad'] ?>
            
              <input name="<?php echo "id_ciudad".$cantidad ?>" type="hidden" id="<?php echo "id_ciudad".$cantidad ?>" value="<?php echo $line['id_ciudad']?>"/>
			  
			  </td>
            <td height="26">
             <?php $id_cliente=$line['id_cliente']; $nombre_cliente=$line['nombre_cliente']; echo $line['nombre_cliente'] ?>
             
              <input name="<?php echo "id_cliente".$cantidad ?>" type="hidden" id="<?php echo "id_cliente".$cantidad ?>" value="<?php echo $line['id_cliente']?>"/>          </td>
            <td>
             <?php  echo $line['direccion_cliente']?>
              <span class="Estilo5">
              <input name="<?php echo "id_chofer".$cantidad ?>" type="hidden" id="<?php echo "id_chofer".$cantidad ?>" value="<?php echo $line['id_chofer']?>"/>           </td>
            <td>
              <?php  echo $line['orden_ruta']?>    <input name="cantidad" type="hidden" id="cantidad" value="<?php echo $cantidad?>"/></td>
            <td align="center">
           <select name="<?php echo "listaruta".$cantidad ?>" id="<?php echo "listaruta".$cantidad ?>">
			<?php  $query1 = "SELECT COUNT(nombre_ciudad) AS cantidad_ciudades FROM pedido INNER JOIN viaje ON viaje.numero_pedido=pedido.numero_pedido INNER JOIN proveedor ON proveedor.id_proveedor=pedido.id_proveedor INNER JOIN cliente ON cliente.id_cliente=pedido.id_cliente INNER JOIN producto ON producto.id_producto=pedido.id_producto INNER JOIN ciudad ON cliente.id_ciudad=ciudad.id_ciudad INNER JOIN chofer ON chofer.id_chofer=viaje.id_chofer WHERE viaje.estado_viaje='0' AND pedido.numero_pedido='".$numero_pedido."' ";
			mysql_query("SET NAMES 'UTF8'");
$result1 = mysql_query($query1) or die('Consulta fallida: ' . mysql_error());
$cantidad_ciudades=0;
while ($line1= mysql_fetch_array($result1)) 
{ 
$cantidad_ciudades=$line1['cantidad_ciudades'];
}
		
		
		for ($i=1;$i<=$cantidad_ciudades;$i++)
		{

			 ?>
             
              
                <option value=" <?php  echo $i ?>"><?php  echo $i ?></option>
			  
              
			
			<?php 
			}
			 mysql_free_result($result1);
				
			 ?>
			 </select>
             </td>
           
          </tr>
											
				 <?php 
		
		  }
		  mysql_free_result($result);
		  ?>
          <?php 
		}
		?>							
										</tbody>
										</table>
							</div><!-- /.page-content -->
				</div>				
											
											
											
											
							  </form>
									
						  </div>
					  </div>
					  
					  
					  
					  
					  







<div id=bt>
  <div id=iparea>
<div id="ipinfo">
<div id="ipinfo_l">
  <a href="http://www.huntermonitoreo.com" target="_blank"><img src="imagenes/hounter.png" width="138" height="45" border="0" /></a></div>

<div id="ipinfo_r">
  <div id="mymap_box">
    <div id="mymap">
    <br><br><br><br><br><br><center><span id="loading">Cargando...</span></center>
    <noscript><br><p><b>

	
	</p></noscript>
  </div>
  </div>
</div>
  
</div>
</div>

</div>














											

					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Transportes</span>
							LE & MA 2016-2017
						</span>

						<span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
							</a>
						</span>
					</div>
				</div>
			</div>

		    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse"> <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i> </a></div>

		<script src="ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>


		<script type="text/javascript">
			window.jQuery || document.write("<script src='responsiweb.com/dist/js/jquery.min.js'>"+"<"+"/script>");
		</script>


		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='responsiweb.com/dist/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="dist/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="responsiweb.com/dist/js/jquery-ui.custom.min.js"></script>
		<script src="responsiweb.com/dist/js/jquery.ui.touch-punch.min.js"></script>
		<script src="responsiweb.com/dist/js/jquery.easypiechart.min.js"></script>
		<script src="responsiweb.com/dist/js/jquery.sparkline.min.js"></script>
		<script src="responsiweb.com/dist/js/flot/jquery.flot.min.js"></script>
		<script src="responsiweb.com/dist/js/flot/jquery.flot.pie.min.js"></script>
		<script src="responsiweb.com/dist/js/flot/jquery.flot.resize.min.js"></script>

		<!-- ace scripts -->
		<script src="responsiweb.com/dist/js/ace-elements.min.js"></script>
		<script src="responsiweb.com/dist/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				$('.easy-pie-chart.percentage').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
					var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
					var size = parseInt($(this).data('size')) || 50;
					$(this).easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: parseInt(size/10),
						animate: ace.vars['old_ie'] ? false : 1000,
						size: size
					});
				})
			
				$('.sparkline').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
					$(this).sparkline('html',
									 {
										tagValuesAttribute:'data-values',
										type: 'bar',
										barColor: barColor ,
										chartRangeMin:$(this).data('min') || 0
									 });
				});
			

			  $.resize.throttleWindow = false;
			
			  var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
			  var data = [
				{ label: "social networks",  data: 38.7, color: "#68BC31"},
				{ label: "search engines",  data: 24.5, color: "#2091CF"},
				{ label: "ad campaigns",  data: 8.2, color: "#AF4E96"},
				{ label: "direct traffic",  data: 18.6, color: "#DA5430"},
				{ label: "other",  data: 10, color: "#FEE074"}
			  ]
			  function drawPieChart(placeholder, data, position) {
			 	  $.plot(placeholder, data, {
					series: {
						pie: {
							show: true,
							tilt:0.8,
							highlight: {
								opacity: 0.25
							},
							stroke: {
								color: '#fff',
								width: 2
							},
							startAngle: 2
						}
					},
					legend: {
						show: true,
						position: position || "ne", 
						labelBoxBorderColor: null,
						margin:[-30,15]
					}
					,
					grid: {
						hoverable: true,
						clickable: true
					}
				 })
			 }
			 drawPieChart(placeholder, data);
			


			 placeholder.data('chart', data);
			 placeholder.data('draw', drawPieChart);
			
			
			  //pie chart tooltip example
			  var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
			  var previousPoint = null;
			
			  placeholder.on('plothover', function (event, pos, item) {
				if(item) {
					if (previousPoint != item.seriesIndex) {
						previousPoint = item.seriesIndex;
						var tip = item.series['label'] + " : " + item.series['percent']+'%';
						$tooltip.show().children(0).text(tip);
					}
					$tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
				} else {
					$tooltip.hide();
					previousPoint = null;
				}
				
			 });
			
				/////////////////////////////////////
				$(document).one('ajaxloadstart.page', function(e) {
					$tooltip.remove();
				});
			
			
			
			
				var d1 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d1.push([i, Math.sin(i)]);
				}
			
				var d2 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d2.push([i, Math.cos(i)]);
				}
			
				var d3 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.2) {
					d3.push([i, Math.tan(i)]);
				}
				
			
				var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});
				$.plot("#sales-charts", [
					{ label: "Domains", data: d1 },
					{ label: "Hosting", data: d2 },
					{ label: "Services", data: d3 }
				], {
					hoverable: true,
					shadowSize: 0,
					series: {
						lines: { show: true },
						points: { show: true }
					},
					xaxis: {
						tickLength: 0
					},
					yaxis: {
						ticks: 10,
						min: -2,
						max: 2,
						tickDecimals: 3
					},
					grid: {
						backgroundColor: { colors: [ "#fff", "#fff" ] },
						borderWidth: 1,
						borderColor:'#555'
					}
				});
			
			
				$('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('.tab-content')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			
			
				$('.dialogs,.comments').ace_scroll({
					size: 300
			    });
				

				var agent = navigator.userAgent.toLowerCase();
				if(ace.vars['touch'] && ace.vars['android']) {
				  $('#tasks').on('touchstart', function(e){
					var li = $(e.target).closest('#tasks li');
					if(li.length == 0)return;
					var label = li.find('label.inline').get(0);
					if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
				  });
				}
			
				$('#tasks').sortable({
					opacity:0.8,
					revert:true,
					forceHelperSize:true,
					placeholder: 'draggable-placeholder',
					forcePlaceholderSize:true,
					tolerance:'pointer',
					stop: function( event, ui ) {
						//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
						$(ui.item).css('z-index', 'auto');
					}
					}
				);
				$('#tasks').disableSelection();
				$('#tasks input:checkbox').removeAttr('checked').on('click', function(){
					if(this.checked) $(this).closest('li').addClass('selected');
					else $(this).closest('li').removeClass('selected');
				});
			
			
				//show the dropdowns on top or bottom depending on window height and menu position
				$('#task-tab .dropdown-hover').on('mouseenter', function(e) {
					var offset = $(this).offset();
			
					var $w = $(window)
					if (offset.top > $w.scrollTop() + $w.innerHeight() - 100) 
						$(this).addClass('dropup');
					else $(this).removeClass('dropup');
				});
			
			})
		</script>
	</body>
</html>
