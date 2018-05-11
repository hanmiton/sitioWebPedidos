<?php 
 
 
include("conexion_base.php");
$numero_pedido=$_REQUEST['numero_pedido'];
$fecha_pedido=$_REQUEST['fecha_pedido'];
$menu=0;
$cantidad='';
$Total='';
 

$tipo = $_GET['t'];

if($tipo == "excel") 
{
$extension = ".xls";
}

if($tipo == "word") 
{
$extension = ".doc";
}


?>
    
<h1>Transporte de Carga Pesada LE & MA</h1>
<p>Número de Pedido: <?php echo $numero_pedido?> </p> 

<p>Fecha de Pedido: <?php echo $fecha_pedido?> </p> 
<table >
											<thead>
												<tr>
													
													<th>Proveedor</th>
													<th>Producto</th>
													<th >Cliente</th>

													<th>Cantidad</th>
													<th >Estado</th>
												</tr>
											</thead>

											
											
											    <?php

		
		 $query = "SELECT id_pedido,numero_pedido,proveedor.id_proveedor,nombre_proveedor,producto.id_producto,nombre_producto,cliente.id_cliente,nombre_cliente,nombre_ciudad,cantidad_pedido,fecha_pedido, estado_pedido FROM pedido INNER JOIN proveedor ON proveedor.id_proveedor=pedido.id_proveedor INNER JOIN cliente ON cliente.id_cliente=pedido.id_cliente INNER JOIN producto ON producto.id_producto=pedido.id_producto INNER JOIN ciudad ON cliente.id_ciudad=ciudad.id_ciudad WHERE numero_pedido='".$numero_pedido."' ORDER BY producto.nombre_producto,cliente.nombre_cliente";
mysql_query("SET NAMES 'UTF8'");
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

?>

<?php if ($menu==0)

{
?>


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
													

													<td> <?php echo $Total; ?>   </td>
													<td> </td>
													<td></td>
													<td><?php echo $total_pedido; ?></td>

													<td >	</td>
												</tr>
		 <?php 
		
		  }
  		  }
		 $nombre1=$nombre2;  
		$cantidad=$cantidad+1;

		 ?>
		 
		 <tr>
		 
		 	
													<td> <?php $id_proveedor=$line['id_proveedor']; echo utf8_decode($line['nombre_proveedor']) ?></td>
													<td> <?php $id_producto=$line['id_producto']; echo utf8_decode($line['nombre_producto'] )?></td>
													<td ><?php $id_cliente=$line['id_cliente']; echo utf8_decode($line['nombre_ciudad']) ."/". utf8_decode($line['nombre_cliente'])?></td>

													<td > <?php $cantidad_pedido=$line['cantidad_pedido']; echo $line['cantidad_pedido'] ?></td>
													<td > <?php $estado_pedido=$line['estado_pedido']; echo $line['estado_pedido'] ?></th>
											  </tr>
		 
		           <?php 
       
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
												

													<td> <?php echo $Total; ?>   </td>
													<td> </td>
													<td ></td>
													<td><?php echo $total_pedido; ?></td>

													<td >	</td>
												</tr>
											</tbody>
										</table>  
										
										<?php
										
										    header("Content-type: application/vnd.ms-$tipo");
    header("Content-Disposition: attachment; filename=reporte_pedidos_excel$extension");
    header("Pragma: no-cache");
    header("Expires: 0");    
										?>