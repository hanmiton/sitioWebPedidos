<?php

/* incluimos primeramente el archivo que contiene la clase fpdf */

include ('fpdf/fpdf.php');
include("conexion_base.php");
$numero_pedido=$_REQUEST['numero_pedido'];
$fecha_pedido=$_REQUEST['fecha_pedido'];
$estado_pedido=$_REQUEST['estado_pedido'];
 $asignado_pedido=$_REQUEST['asignado_pedido'];
$menu=0;
$cantidad='';
$Total='';

/* tenemos que generar una instancia de la clase */

$pdf = new FPDF();


$pdf->AddPage ('P', 'Letter');

/* seleccionamos el tipo, estilo y tamaño de la letra a utilizar */

$pdf->SetFont('Arial', 'B', 10);

$pdf->Write (7,"Transporte de Carga Pesada LE&MA ","B");

$pdf->Ln();

$pdf->Cell(40,6,"Número de Pedido: ",0,0,'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Write (6,$numero_pedido);
$pdf->Ln();

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40,6,"Fecha de Pedido: ",0,0,'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Write (6,$fecha_pedido);

$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40,6,"Estado de Pedido: ",0,0,'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Write (6,estado_pedido($estado_pedido));

$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40,6,"Pedido Asignado: ",0,0,'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Write (6,asignado_pedido($asignado_pedido));

$pdf->Ln(); //salto de linea

$query = "SELECT id_pedido,numero_pedido,proveedor.id_proveedor,nombre_proveedor,producto.id_producto,nombre_producto,cliente.id_cliente,nombre_cliente,nombre_ciudad,cantidad_pedido,fecha_pedido, estado_pedido FROM pedido INNER JOIN proveedor ON proveedor.id_proveedor=pedido.id_proveedor INNER JOIN cliente ON cliente.id_cliente=pedido.id_cliente INNER JOIN producto ON producto.id_producto=pedido.id_producto INNER JOIN ciudad ON cliente.id_ciudad=ciudad.id_ciudad WHERE numero_pedido='".$numero_pedido."' ORDER BY producto.nombre_producto,cliente.nombre_cliente";
mysql_query("SET NAMES 'UTF8'");
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

if ($menu==0)

{
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40,6,"Proveedor",1,0,'C');
$pdf->Cell(50,6,"Producto",1,0,'C');
$pdf->Cell(50,6,"Cliente",1,0,'C');
$pdf->Cell(20,6,"Cantidad",1,0,'C');


$menu=1;
}

while ($line= mysql_fetch_array($result)) 
{ 
$numero_pedido=$line['numero_pedido'];
$fecha_pedido=$line['fecha_pedido'];
$nombre2=$line['id_producto'];

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
				  $pdf->Ln(); 
	$pdf->Cell(40,6,$Total,1,0,'L');
$pdf->Cell(50,6,"",1,0,'C');
$pdf->Cell(50,6,"",1,0,'C');
$pdf->Cell(20,6,$total_pedido,1,0,'R');


 }
}
		 $nombre1=$nombre2;  
		$cantidad=$cantidad+1;

$pdf->Ln();//ahora salta 15 lineas
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(40,6,utf8_decode($line['nombre_proveedor']),1,0,'L');
$pdf->Cell(50,6,utf8_decode($line['nombre_producto']),1,0,'L');
$pdf->Cell(50,6,utf8_decode($line['nombre_ciudad'])."/".utf8_decode($line['nombre_cliente']),1,0,'L');
$pdf->Cell(20,6,$line['cantidad_pedido'],1,0,'R');

}


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
					
					
					$pdf->Ln(); 
	$pdf->Cell(40,6,$Total,1,0,'L');
$pdf->Cell(50,6,"",1,0,'C');
$pdf->Cell(50,6,"",1,0,'C');
$pdf->Cell(20,6,$total_pedido,1,0,'R');

					


$pdf->Output("reporte_pedidos.pdf",'D');

echo "<script language='javascript'> window.open('reporte_pedidos.pdf','_blank'); </script>";//paral archivo pdf generado

exit;

?>
