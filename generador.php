<?php

/* incluimos primeramente el archivo que contiene la clase fpdf */

include ('fpdf/fpdf.php');

/* tenemos que generar una instancia de la clase */

$pdf = new FPDF();

$pdf->AddPage();

/* seleccionamos el tipo, estilo y tamaño de la letra a utilizar */

$pdf->SetFont('Arial', 'B', 12);

$pdf->Write (7,"REPORTES DE PEDIDOS  ","");

$pdf->Ln();

$pdf->Cell(40,6,"Número de Pedido: ",0,0,'C');
$pdf->Write (6,1);

$pdf->Ln(); //salto de linea

$pdf->Cell(40,6,"Proveedor",1,0,'C');
$pdf->Cell(40,6,"Producto",1,0,'C');
$pdf->Cell(50,6,"Cliente",1,0,'C');
$pdf->Cell(30,6,"Cantidad",1,0,'C');
$pdf->Cell(30,6,"Estado",1,0,'C');

$pdf->Ln();//ahora salta 15 lineas
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40,6,"Proveedor",1,0,'L');
$pdf->Cell(40,6,"Producto",1,0,'L');
$pdf->Cell(50,6,"Cliente",1,0,'L');
$pdf->Cell(30,6,"Cantidad",1,0,'R');
$pdf->Cell(30,6,"Estado",1,0,'C');


$pdf->SetTextColor('255','0','0');//para imprimir en rojo
$pdf->Ln();
$pdf->Multicell(190,7,$_POST['tel']."\n",1,"R");

$pdf->Line(0,160,300,160);//impresión de linea

$pdf->Output("prueba.pdf",'F');

echo "<script language='javascript'>window.open('prueba.pdf','_self');</script>";//paral archivo pdf generado

exit;

?>
