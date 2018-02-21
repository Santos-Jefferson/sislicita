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
    $this->Cell(0,5,utf8_decode('DADOS DA PROPONENTE:'),0,1,'R');
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
    $this->Cell(0,4, utf8_decode('Dados Pgto: Banco do Brasil (001), Agencia: 4500-4, C.Corrente: 23763-9'),0,1,'R');
    $this->SetFont('Arial','',8);
    $this->Cell(0,4, utf8_decode('Enquadramento: Empresa de Pequeno Porte (EPP)'),'B',1,'R');

    $this->Image('imagens/logo.jpg',5,8,70);
    
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
$tipo_entrega=$_POST[tipo_entrega];
$prazo_pagamento=$_POST[prazo_pagamento];
$local_entrega=$_POST[local_entrega];
$linha_adic_1=$_POST[linha_adic_1];
$linha_adic_2=$_POST[linha_adic_2];
$rep_legal=$_POST[rep_legal];
$ass_digital=$_POST[ass_digital];
if ($rep_legal=="Jefferson Santos"){
    $rg_rep_legal="8.257.708-4 SSP/PR";
    $cpf_rep_legal="041.754.989-07";
    }
    elseif($rep_legal=="Vinicius de Quadros Mayer"){
        $rg_rep_legal="6.186.748-1 SSP/PR";
        $cpf_rep_legal="016.707.669-85";   
        }
        else{
        $rg_rep_legal="7.050.500-2 SSP/PR";
        $cpf_rep_legal="042.564.759-58";   
        }

// largura padrão das colunas
//$largura = 40;
// altura padrão das linhas das colunas
$altura = 4;
//$pdf->MultiCell(0,5,utf8_decode('A SANTOS & MAYER COM. DE EQUIP. DE INFO. LTDA ME, vem por meio de seu representante legal, apresentar a sua proposta comercial referente ao pregão em epígrafe, de acordo com o disposto no Termo de Referência do Edital.'),0,2);
//$pdf->MultiCell(0,5,utf8_decode(''),0,2);
//$pdf->MultiCell(0,5,utf8_decode('Considerando as informações contidas no Termo de Referência, parte integrante do Edital, e;'),0,2);
//$pdf->MultiCell(0,5,utf8_decode('Considerando as demais condições estabelecidas no referido Edital e seus anexos, propomos:'),0,2);
//$pdf->MultiCell(0,5,utf8_decode(''),0,2);
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
$res = mysql_query($sql) or die("Erro seleção linha");
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
                                    
                                    $descricao.=("$linha2[qtde_si]-$linha2[nome_subitem] MARCA: $linha2[marca_si] / MODELO: $linha2[modelo_si]\n");
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

$pdf->Cell(0,5, utf8_decode('LICITANTE RESPONSÁVEL:').' '.utf8_decode($licitante).';',0,1,'l');
$pdf->Cell(0,5, utf8_decode('VALIDADE DA PROPOSTA:').' '.utf8_decode($val_proposta).' '.('Dias').';',0,1,'l');
$pdf->Cell(0,5, utf8_decode('GARANTIA:').' '.utf8_decode($gar_proposta).' '.('Meses').' '.utf8_decode($tipo_garantia).';',0,1,'l');
$pdf->Cell(0,5, utf8_decode('PRAZO DE ENTREGA:').' '.utf8_decode($prazo_entrega).' '.utf8_decode($tipo_entrega).';',0,1,'l');
$pdf->MultiCell(0,5,utf8_decode('LOCAL DE ENTREGA:').' '.utf8_decode($local_entrega).';',0,2);
$pdf->Cell(0,5, utf8_decode('PRAZO DE PAGAMENTO:').' '.utf8_decode($prazo_pagamento).' '.('Dias').'.',0,1,'l');
$pdf->Ln(0); 

$pdf->MultiCell(0,5, utf8_decode("- Declaramos que os equipamentos ofertados são novos e estão em fase normal de fabricação e que no(s) preço(s) proposto(s) já se acham incluídos todos os tributos, encargos sociais, preços públicos, fretes, embalagens, transportes, descarregamento, garantia, seguros e outros que porventura possam recair sobre o objeto da licitação."),0,1);
//$pdf->MultiCell(0,5, utf8_decode("- Declaramos que os equipamentos ofertados são novos e estão em fase normal de fabricação."),0,1);
$pdf->MultiCell(0,5, utf8_decode($linha_adic_1),0,1);
$pdf->MultiCell(0,5, utf8_decode($linha_adic_2),0,1);
//$pdf->MultiCell(0,5, utf8_decode($linha_adic_3),0,1);
//$pdf->MultiCell(0,5, utf8_decode($linha_adic_4),0,1);
//$pdf->MultiCell(0,5, utf8_decode($linha_adic_5),0,1);


//$pdf->Ln(10);

//$pdf->SetFont('Arial','',12);
//$pdf->ln(10);
if ($linha_uf[modalidade]=="Presencial"){
    $data = (date('d/m/Y', strtotime($linha_uf[data])));;
}
else{
$data = strftime("%d/%m/%Y");
}
$pdf->Cell(0,10, "Curitiba,".' '.$data,0,1,'C');
$pdf->ln(0);

if ($ass_digital == "Sim")
{
    if ($rep_legal == "Jefferson Santos")
    {
        $pdf->Image('imagens/ass_jeff_2.png',185,155,110);
    }
    if ($rep_legal == "Vinicius de Quadros Mayer")
    {
        $pdf->Image('imagens/ass_vini.png',185,155,110);
    }
}
else
{
    $pdf->Cell(0,4, utf8_decode('______________________'),0,1,'R');
    $pdf->Cell(0,4, utf8_decode($rep_legal),0,1,'R');
    $pdf->Cell(0,4, utf8_decode('Diretor de Tecnologia'),0,1,'R');
    $pdf->Cell(0,4, utf8_decode('CPF:').' '.$cpf_rep_legal,0,1,'R');
    $pdf->Cell(0,4, utf8_decode('RG:').' '.$rg_rep_legal,0,1,'R');
}












//$pdf->SetFont('Arial','',12);
//for($i=1;$i<=10;$i++)
//$pdf->Cell(0,10,'Imprimindo linha '.$i,1,1);
$pdf->Output();




//se é um alterar cadastro, utiliza a instrução UPDATE, se for cadastro novo, INSERT.
        //isset = existe ou não existe (se existe post[cod], então faz update. se não existe, faz cadastro novo
/*$sql = "SELECT * FROM proposta WHERE id_proposta = {$_POST[id_proposta]} and id_lote = {$_POST[id_lote]}";
$res = mysql_query($sql) or die("Erro seleção");

if (mysql_num_rows($res)) {//and !isset($_POST[id_proposta])){
    
    require_once "validacao_cad_itens.php";
    die;
   
 }*/
    if(isset($_POST[id_proposta])){
        $sql =
        "UPDATE proposta SET validade_prop='$validade_prop',
            garantia_prop='$gar_proposta',tipo_garantia='$tipo_garantia',
            prazo_entrega='$prazo_entrega',tipo_entrega='$tipo_entrega',
            prazo_pgto='$prazo_pagamento',local_entrega='$local_entrega',
            linha_adic_1='$linha_adic_1',linha_adic_2='$linha_adic_2',rep_legal='$rep_legal'
                WHERE id_proposta='{$_POST[id_proposta]}'";
            
    //volta para a seleção e alteração
    //$lugar= ('cad_itens.php'
            //p?id_lote=echo $_POST[id_lote];
              //  &lote=echo $_POST[lote];
                //&codigo=echo $_POST[codigo];
           //     );
}
    else {
    $sql = "INSERT into proposta (validade_prop,garantia_prop,tipo_garantia,prazo_entrega,tipo_entrega,prazo_pgto,local_entrega,linha_adic_1,linha_adic_2,rep_legal,id_lote)
                       VALUES ( '$val_proposta','$gar_proposta',
                                '$tipo_garantia','$prazo_entrega',
                                '$tipo_entrega','$prazo_pagamento',
                                '$local_entrega','$linha_adic_1',
                                '$linha_adic_2','$rep_legal',
                                '{$_POST[id_lote]}'
                               )";
    $lugar=('lista_itens_tudo.php');
    }

//echo $sql;die;
mysql_query($sql) or die("Erro gravando - proposta!");

//require_once "$lugar";


//header mexe com cabeçahos do APACHE, não pode haver HTML antes do HEADER, pois o mesmo pode não funcionar.
//die;
//header mexe com cabeçahos do APACHE, não pode haver HTML antes do HEADER, pois o mesmo pode não funcionar.
//header ("location:precad_licita.php");

        
?>
