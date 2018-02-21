<?php
header('charset=utf8_decode');
include('fpdf17/fpdf.php');
//iconv("UTF-8", "ISO-8859-1", "£");
class PDF extends FPDF
{
function Header()
{
$this->SetFont('Arial','B',12);
$this->Cell(0, 10, utf8_decode('PROPOSTA COMERCIAL'),1,1,'R');
$this->SetFont('Arial','B',10);
$this->Cell(0,10,utf8_decode('DADOS DA PROPONENTE:'),0,1,'R');
$this->SetFont('Arial','',8);
$this->Cell(0,3,utf8_decode('Razão Social: SANTOS & MAYER LTDA - EPP'),0,1,'R');
$this->SetFont('Arial','',8);
$this->Cell(0,3, 'CNPJ: 09.457.677/0001-28',0,1,'R');
$this->SetFont('Arial','',8);
$this->Cell(0,3, 'IE: 904.354.82-10',0,1,'R');
$this->SetFont('Arial','',8);
$this->Cell(0,3, utf8_decode('Endereço: Rua Maestro Francisco Antonelo, 1452,loja 01, Fanny, Curitiba - PR, CEP: 81030-100'),0,1,'R');
$this->SetFont('Arial','',8);
$this->Cell(0,3, utf8_decode('Fone/Email: (41) 3049-5522 / 3049-5521 / 3569-4182 - contato@maestroinformatica.net'),0,1,'R');

$this->SetFont('Arial','',8);
$this->Cell(0,3, utf8_decode('Dados Pgto: Banco Santander (033), Agencia: 3731, C.Corrente: 130019026'),0,1,'R');
$this->SetFont('Arial','',8);
$this->Cell(0,3, utf8_decode('Enquadramento: Empresa de Pequeno Porte (EPP)'),'B',1,'R');
$this->Ln(10);
$this->Image('imagens/logo.jpg',5,8,70);
$this->SetFont('Arial','',12);
$this->Cell(0, 10, utf8_decode('Proposta a Prefeitura Municipal de Curitiba-PR, Cód./Uasg: 488100, Pregão 001/2013'),'B',1,'L');

}
function Footer()
{
$this->SetY(-15);
$this->SetFont('Arial','I',10);
$this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}
// muda fonte e coloca em negrito
$pdf->SetFont('Arial', 'B', 7);

// largura padrão das colunas
$largura = 40;
// altura padrão das linhas das colunas
$altura = 6;

// criando os cabeçalhos para 5 colunas
$pdf->Cell($largura, $altura, 'Codigo', 1, 0, 'L');
$pdf->Cell($largura, $altura, 'Nome', 1, 0, 'L');
$pdf->Cell($largura, $altura, 'E-mail', 1, 0, 'L');
$pdf->Cell($largura, $altura, 'Telefone', 1, 0, 'L');
$pdf->Cell($largura, $altura, 'Ativo', 1, 0, 'C');

// pulando a linha
$pdf->Ln($altura);

// tirando o negrito
$pdf->SetFont('Arial', '', 7);

// montando a tabela com os dados (presumindo que a consulta já foi feita)
for($i=1;$i<=10;$i++)

	$pdf->Cell($largura, $altura, $i['codusuario'], 1, 0, 'L');
	$pdf->Cell($largura, $altura, $i['nome'], 1, 0, 'L');
	$pdf->Cell($largura, $altura, $i['email'], 1, 0, 'L');
	$pdf->Cell($largura, $altura, $i['telefne'], 1, 0, 'L');
	$pdf->Cell($largura, $altura, $i['ativo'], 1, 0, 'C');
	$pdf->Ln($altura);


// exibindo o PDF
$pdf->Output('exercicio2.pdf');
?>