<?php
require ("conecta.php");
require_once("pdf.php");
function PDFClientes() {
    $pdf = new PDF('L'); // relatório em orientação "paisagem"

    $pdf->SetName("Listagem de Clientes");
    $pdf->Open();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 10);
    $result = mysql_query("SELECT * from codigo");
    while ( $row = mysql_fetch_array($result) ) {
          $pdf->Cell(10, 5, $row[codigo], 0, 0);
          $pdf->Cell(80, 5, $row[codigo], 0, 0);
          $pdf->Cell(75, 5, $row[codigo]." ".$row[codigo].", ".$row[codigo], 0, 0);
          $pdf->Cell(40, 5, $row[codigo], 0, 0);
          $pdf->Cell(25, 5, $row[codigo], 0, 0);
          $pdf->Cell(20, 5, $row[codigo], 0, 0);
          $pdf->Cell(30, 5, $row[codigo], 0, 1);
    }
    $pdf->Output();
}
PDFClientes();
?>