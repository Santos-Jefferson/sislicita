<?php
require "conecta.php";
include('fpdf17/fpdf.php');
//print_r($_REQUEST);
//die;
$dec_nome=$_POST[dec_nome];


class MeuPDF extends FPDF {
    function Header()
        {
            $dec_nome=$_POST[dec_nome];
            $this->SetFont('Arial','B',12);
            $this->Cell(0, 10, utf8_decode('OFÍCIO À(AO) ').' '.utf8_decode($_POST[orgao]),1,1,'R');
            $this->SetFont('Arial','B',10);
            $this->Cell(0,10,utf8_decode('DADOS DA PROPONENTE:'),0,1,'R');
            $this->SetFont('Arial','',8);
            $this->Cell(0,3,utf8_decode('Razão Social: Santos & Mayer LTDA - EPP'),0,1,'R');
            $this->SetFont('Arial','',8);
            $this->Cell(0,3, 'CNPJ: 09.457.677/0001-28',0,1,'R');
            $this->SetFont('Arial','',8);
            $this->Cell(0,3, 'IE: 904.354.82-10',0,1,'R');
            $this->SetFont('Arial','',8);
            $this->Cell(0,3, utf8_decode('Endereço: Rua Maestro Francisco Antonelo, 1452,loja 01, Fanny, Curitiba - PR, CEP: 81030-100'),0,1,'R');
            $this->SetFont('Arial','',8);
            $this->Cell(0,3, utf8_decode('Fone/Email: (41) 3049-5522 / 3049-5521 / 3569-4182 - contato@maestroinformatica.net'),'B',1,'R');
            $this->Ln(5);
            $this->Image('imagens/logo.jpg',5,8,50);
            }

    function Footer() {
            $this->SetY(-15);
            $this->SetFont('Arial','I',10);
            $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
            }
}


$pdf=new MeuPDF('p','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$lugar_oficio="selec_oficio.php?rep_legal=$_POST[rep_legal]&orgao=$_POST[orgao]&pregao=$_POST[pregao]&codigo=$_POST[codigo]";
if ($dec_nome=="Ofício"){
    header ("location:$lugar_oficio");
    die;
}

$orgao=$_POST[orgao];
$pregao=$_POST[pregao];
$codigo=$_POST[codigo];
$rep_legal=$_POST[rep_legal];
if ($rep_legal=="Jefferson Santos"){
    $rg_rep_legal="8.257.708-4 SSR/PR";
    $cpf_rep_legal="041.754.989-07";
    }
    else{
        $rg_rep_legal="6.186.748-1 SSP/PR";
        $cpf_rep_legal="016.707.669-85";   
        }


$pdf->SetFont('Arial','B',10);
$pdf->Cell(0, 6, utf8_decode('ORGÃO:').' '.utf8_decode($orgao),'0',1,'L');
$pdf->Cell(0, 6, utf8_decode('PREGÃO:').' '.utf8_decode($pregao),'0',1,'L');
$pdf->Cell(0, 6, utf8_decode('CÓDIGO BB/UASG:').' '.$codigo,'0',1,'L');
$pdf->Cell(0, 6, utf8_decode('REFERENTE:').' '.utf8_decode($dec_nome),'B',1,'L');
$pdf->Ln(5);



$data = strftime("%d/%m/%Y");

$pdf->SetFont('Arial','',10);
$dec_modelo="                    A Empresa - SANTOS & MAYER LTDA - EPP, inscrita no CNPJ nº 09.457.677/0001-28, por intermédio de seu representante legal o(a) Sr(a) $rep_legal, portador(a) da Carteira de Identidade nº $rg_rep_legal e do CPF nº $cpf_rep_legal, $_REQUEST[conteudo_dec]";
$pdf->MultiCell(0, 7, utf8_decode($dec_modelo),0,1);

$pdf->ln(5);
$pdf->Cell(0,10, "Curitiba,".' '.$data,0,1,'C');
$pdf->ln(10);

$pdf->Cell(0,5, utf8_decode($rep_legal),0,1,'R');
$pdf->Cell(0,5, utf8_decode('Diretor de Tecnologia'),0,1,'R');
//$pdf->Cell(0,7, utf8_decode('CPF:').' '.$cpf_rep_legal,0,1,'l');
//$pdf->Cell(0,7, utf8_decode('RG:').' '.$rg_rep_legal,0,1,'l');

$pdf->Output();




?>