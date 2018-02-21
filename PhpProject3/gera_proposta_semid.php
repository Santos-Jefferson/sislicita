<?php
//print_r($_REQUEST);
//die;
require "conecta.php";
require "GExtenso.php";
header('charset=utf8_decode');
include('fpdf17/fpdf.php');
//iconv("UTF-8", "ISO-8859-1", "£");
class MeuPDF extends FPDF
{
function Header()
{
$this->SetFont('Arial','B',12);
$this->Cell(0, 5, utf8_decode('PROPOSTA COMERCIAL'),1,1,'C');
$this->SetFont('Arial','B',10);
/*$this->Cell(0,5,utf8_decode('DADOS DA PROPONENTE:'),0,1,'R');
$this->SetFont('Arial','',8);
$this->Cell(0,3,utf8_decode('Razão Social: Santos & Mayer com. de equip. de info. LTDA ME'),0,1,'R');
$this->SetFont('Arial','',8);
$this->Cell(0,3, 'CNPJ: 09.457.677/0001-28',0,1,'R');
$this->SetFont('Arial','',8);
$this->Cell(0,3, 'IE: 904.354.82-10',0,1,'R');
$this->SetFont('Arial','',8);
$this->Cell(0,3, utf8_decode('Endereço: Rua Maestro Francisco Antonelo, 1452,loja 01, Fanny, Curitiba - PR, CEP: 81030-100'),0,1,'R');
$this->SetFont('Arial','',8);
$this->Cell(0,3, utf8_decode('Fone/Email: (41) 3049-5522 / 3049-5521 / 3569-4182 - contato@maestroinformatica.net'),0,1,'R');

$this->SetFont('Arial','',8);
$this->Cell(0,4, utf8_decode('Dados Pgto: Banco Santander (033), Agencia: 3731, C.Corrente: 13001926'),0,1,'R');
$this->SetFont('Arial','',8);
$this->Cell(0,4, utf8_decode('Enquadramento: Empresa de Pequeno Porte (EPP)'),'B',1,'R');

$this->Image('imagens/logo.jpg',5,8,70);*/

$this->Ln(2);
$this->SetFont('Arial','',12);



}


function Footer()
{
$this->SetY(-15);
$this->SetFont('Arial','I',10);
$this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

$pdf=new MeuPDF('l','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
///////////////////////////////////////////////////////////////////////////






$orgao=$_POST[orgao];
$pregao=$_POST[pregao];
$codigo=$_POST[codigo];
$lote=$_POST[lote];
$licitante=$_POST[licitante];
$val_proposta=$_POST[val_proposta];
$gar_proposta=$_POST[gar_proposta];
$tipo_garantia=$_POST[tipo_garantia];
$prazo_entrega=$_POST[prazo_entrega];
$prazo_pagamento=$_POST[prazo_pagamento];
$local_entrega=$_POST[local_entrega];
$linha_adic_1=$_POST[linha_adic_1];
$linha_adic_2=$_POST[linha_adic_2];
$rep_legal=$_POST[rep_legal];
if ($rep_legal=="Jefferson Santos"){
    $rg_rep_legal="8.257.708-4 SSP/PR";
    $cpf_rep_legal="041.754.989-07";
    }
    else{
        $rg_rep_legal="6.186.748-1 SSP/PR";
        $cpf_rep_legal="016.707.669-85";   
        }

// largura padrão das colunas
//$largura = 40;
// altura padrão das linhas das colunas
$altura = 4;
$pdf->MultiCell(0,5,utf8_decode('Proposta à').' '.utf8_decode($orgao).','.' '.utf8_decode('Cód./Uasg:').' '.$codigo.utf8_decode(', Pregão: ').utf8_decode($pregao),0,2);
$pdf->Ln(0);
$pdf->SetFont('Arial','B',10);
$pdf->cell(15,10,('LOTE ').$lote,0,1,'C');
$pdf->Cell(10, $altura, 'ITEM', 1, 0, 'C');
$pdf->Cell(7, $altura, 'UN', 1, 0, 'C');
$pdf->Cell(12, $altura, 'QTDE', 1, 0, 'C');
$pdf->Cell(35, $altura, 'MARCA', 1, 0, 'C');
$pdf->Cell(30, $altura, 'VALOR UNIT.', 1, 0, 'C');
$pdf->Cell(30, $altura, 'VALOR TOTAL', 1, 0, 'C');
$pdf->Cell(156,$altura, utf8_decode('DESCRIÇÃO/MODELO'), 1, 0, 'C');
//$pdf->Ln(10);

// pulando a linha
$pdf->Ln($altura);

// tirando o negrito
$pdf->SetFont('Arial', '', 7);


$sql_uf = "SELECT * FROM codigo WHERE id_cod = {$_REQUEST[id_cod]}";
$res_uf = mysql_query($sql_uf) or die("Erro seleção UF");
//pega a primeira linha do resultado
$linha_uf = mysql_fetch_assoc($res_uf);
// se o GET[order] for vazio, então será preenchido com um valor padrão
//print_r($_REQUEST);
//if(empty($_GET[order])) $_GET[order] = 'item';
$sql_coloc = "SELECT * FROM lote WHERE id_lote = {$_REQUEST[id_lote]}";
$res_coloc = mysql_query($sql_coloc) or die("Erro seleção colocacao");
//pega a primeira linha do resultado
$linha_coloc = mysql_fetch_assoc($res_coloc);


$sql = "SELECT * FROM itens2 WHERE id_lote = {$_REQUEST[id_lote]} order by item";
$res = mysql_query($sql) or die("Erro seleção");
$v = 0; //conterá a somatória dos valores
$c = 0; //total de registros
//pega a primeira linha do resultado
$linha = mysql_fetch_assoc($res);


$vo=0;
while ($linha){
    $vo += $linha[vofertado];
    $sql2 = "SELECT * FROM subitens2 WHERE id_item = $linha[id_itens] order by id_subitem";
                            $res2 = mysql_query($sql2) or die("Erro seleção linha2");
                            $linha2 = mysql_fetch_assoc($res2);
                            
                            if (empty($linha2[id_subitem])){ 
                                $descricao=("$linha[nome_item] MARCA: $linha[marca_item] / MODELO: $linha[modelo_item] / $linha[produto]");
                                $marca=("$linha[marca_item]");
                            }
                            else{
                               
                                while($linha2){
                                    
                                    $descricao.="$linha2[qtde_si]-$linha2[nome_subitem] MARCA: $linha2[marca_si] / MODELO: $linha2[modelo_si]\n";
                                    $marca="Ver Descrição/Modelo";
                                    //$descricao++;
                                    $linha2 = mysql_fetch_assoc($res2);   
                                    
                                }
                            
                            }
                            
	$pdf->Cell(10, $altura, $linha[item], 1, 0, 'C');
        $pdf->Cell(7, $altura, 'un.', 1, 0, 'C');
	$pdf->Cell(12, $altura, $linha[qtde], 1, 0, 'C');
        $pdf->Cell(35, $altura, utf8_decode($marca), 1, 0, 'C');
        $pdf->Cell(30, $altura, ("R$".' '.number_format(($linha[vofertado]/$linha[qtde]),2, ',','.')), 1, 0, 'R');
        $pdf->Cell(30, $altura, ("R$".' '.number_format(($linha[vofertado]),2, ',','.')), 1, 0, 'R');
        $pdf->MultiCell(156,$altura,utf8_decode($descricao),1,2);
	$pdf->Ln($altura);
        
        
                                
        
$linha = mysql_fetch_assoc($res);
$descricao="";
}


//mysql_free_result($res);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(250, $altura, 'VALOR TOTAL', 1, 0, 'C');
$pdf->Cell(30, $altura, ("R$".' '.number_format($vo,2, ',','.')), 1, 1, 'C');
$pdf->Cell(0,5,utf8_decode('Valor por Extenso:').' '.utf8_decode(GExtenso::moeda($vo).' '.'e centavos acima.'),0,1,'l');
$pdf->Ln(2);


$pdf->SetFont('Arial','',8);

//$pdf->Cell(0,5, utf8_decode('Licitante responsável:').' '.utf8_decode($licitante).';',0,1,'l');
$pdf->Cell(0,5, utf8_decode('VALIDADE DA PROPOSTA:').' '.utf8_decode($val_proposta).' '.('Dias').';',0,1,'l');
$pdf->Cell(0,5, utf8_decode('GARANTIA:').' '.utf8_decode($gar_proposta).' '.('Meses').' '.utf8_decode($tipo_garantia).';',0,1,'l');
$pdf->Cell(0,5, utf8_decode('PRAZO DE ENTREGA:').' '.utf8_decode($prazo_entrega).' '.utf8_decode($tipo_entrega).';',0,1,'l');
$pdf->MultiCell(0,5,utf8_decode('LOCAL DE ENTREGA:').' '.utf8_decode($local_entrega).';',0,2);
$pdf->Cell(0,5, utf8_decode('PRAZO DE PAGAMENTO:').' '.utf8_decode($prazo_pagamento).' '.('Dias').'.',0,1,'l');
$pdf->Ln(0);

$pdf->MultiCell(0,5, utf8_decode($linha_adic_1),0,1);
$pdf->MultiCell(0,5, utf8_decode($linha_adic_2),0,1);
//$pdf->MultiCell(0,5, utf8_decode($linha_adic_3),0,1);
//$pdf->MultiCell(0,5, utf8_decode($linha_adic_4),0,1);
//$pdf->MultiCell(0,5, utf8_decode($linha_adic_5),0,1);


//$pdf->Ln(10);

//$pdf->SetFont('Arial','',12);
//$pdf->ln(10);
$data = strftime("%d/%m/%Y");
$pdf->Cell(0,10, $data,0,1,'C');
$pdf->ln(0);

//$pdf->Cell(0,4, utf8_decode($rep_legal),0,1,'R');
//$pdf->Cell(0,4, utf8_decode('Diretor de Tecnologia'),0,1,'R');
//$pdf->Cell(0,4, utf8_decode('CPF:').' '.$cpf_rep_legal,0,1,'R');
//$pdf->Cell(0,4, utf8_decode('RG:').' '.$rg_rep_legal,0,1,'R');









//$pdf->SetFont('Arial','',12);
//for($i=1;$i<=10;$i++)
//$pdf->Cell(0,10,'Imprimindo linha '.$i,1,1);
$pdf->Output();




?>