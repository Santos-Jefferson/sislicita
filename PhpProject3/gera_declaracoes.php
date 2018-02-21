<?php
require "conecta.php";
//require "cabecalho_html.php";
include('fpdf17/fpdf.php');
//print_r($_REQUEST);
//die;

$dec_nome=$_POST[dec_nome];

class MeuPDF extends FPDF {
    function Header()
        {
            $dec_nome=$_POST[dec_nome];
            $this->SetFont('Arial','B',12);
            $this->Cell(0, 10, utf8_decode('DECLARAÇÃO - ').' '.utf8_decode($dec_nome),1,1,'R');
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

$sql_uf = "SELECT * FROM codigo WHERE id_cod = {$_REQUEST[id_cod]}";
$res_uf = mysql_query($sql_uf) or die("Erro seleção UF");
//pega a primeira linha do resultado
$linha_uf = mysql_fetch_assoc($res_uf);

$dec_nome=$_POST[dec_nome];
$lugar="selec_dec_personalizado.php?rep_legal=$_POST[rep_legal]&id_cod=$_POST[id_cod]&orgao=$_POST[orgao]&pregao=$_POST[pregao]&codigo=$_POST[codigo]";
$lugar_oficio="selec_oficio.php?rep_legal=$_POST[rep_legal]&orgao=$_POST[orgao]&pregao=$_POST[pregao]&codigo=$_POST[codigo]";
if ($dec_nome=="Personalizado / Outros"){
    header("location:$lugar");
    die;
}
elseif ($dec_nome=="Ofício"){
    header("location:$lugar_oficio");
    die;
}

$orgao=$_POST[orgao];
$pregao=$_POST[pregao];
$codigo=$_POST[codigo];
$rep_legal=$_POST[rep_legal];
$ass_digital=$_POST[ass_digital];
if ($rep_legal=="Jefferson Santos"){
    $rg_rep_legal="8.257.708-4 SSP/PR";
    $cpf_rep_legal="041.754.989-07";
    }
    else{
        $rg_rep_legal="6.186.748-1 SSP/PR";
        $cpf_rep_legal="016.707.669-85";   
        }


$pdf->SetFont('Arial','',10);
$pdf->Cell(0, 6, utf8_decode('ORGÃO:').' '.utf8_decode($orgao),'0',1,'L');
$pdf->Cell(0, 6, utf8_decode('PREGÃO:').' '.utf8_decode($pregao),'0',1,'L');
$pdf->Cell(0, 6, utf8_decode('CÓDIGO BB/UASG:').' '.$codigo,'0',1,'L');
$pdf->Ln(5);
if ($dec_nome=="Trabalho de Menores / Menor Idade"){
    $dec_modelo="A Empresa - SANTOS & MAYER LTDA - EPP, inscrita no CNPJ nº 09.457.677/0001-28, por intermédio de seu representante legal o(a) Sr(a) $rep_legal, portador(a) da Carteira de Identidade nº $rg_rep_legal e do CPF nº $cpf_rep_legal, DECLARA, para fins do disposto no inciso V do art. 27 da Lei nº 8.666, de 21 de junho de 1993, acrescido pela Lei nº 9.854, de 27 de outubro de 1999, que não emprega menor de dezoito anos em trabalho noturno, perigoso ou insalubre e não emprega menor de dezesseis anos. 

Ressalva: emprega menor, a partir de quatorze anos, na condição de aprendiz (    ).";
}
elseif ($dec_nome=="Inexistência de Fato Superveniente Impeditivo"){
    $dec_modelo="A Empresa - SANTOS & MAYER LTDA - EPP, inscrita no CNPJ nº 09.457.677/0001-28, por intermédio de seu representante legal o(a) Sr(a) $rep_legal, portador(a) da Carteira de Identidade nº $rg_rep_legal e do CPF nº $cpf_rep_legal, DECLARA, sob as penas da lei, a INEXISTENCIA de fatos supervenientes, que impossibilitem sua participação neste Pregão Eletrônico em questão, pois que encontram-se satisfeitas as exigências previstas no art. 27 da Lei 8.666/93, e suas alterações.";
}

elseif ($dec_nome=="Idoneidade"){
    $dec_modelo="A Empresa - SANTOS & MAYER LTDA - EPP, inscrita no CNPJ nº 09.457.677/0001-28, por intermédio de seu representante legal o(a) Sr(a) $rep_legal, portador(a) da Carteira de Identidade nº $rg_rep_legal e do CPF nº $cpf_rep_legal, não foi DECLARADA INIDÔNEA para licitar com a Administração Pública, nos termos do inciso IV do artigo 87 da Lei 8.666, de 21 de junho de 1993 e suas alterações.";
}

elseif ($dec_nome=="Cumprimento Dos Requisitos De Habilitação"){
    $dec_modelo="A Empresa - SANTOS & MAYER LTDA - EPP, inscrita no CNPJ nº 09.457.677/0001-28, por intermédio de seu representante legal o(a) Sr(a) $rep_legal, portador(a) da Carteira de Identidade nº $rg_rep_legal e do CPF nº $cpf_rep_legal, DECLARA, , para fins do disposto no inciso VII do art. 4º da Lei nº 10.520, de 17 de julho de 2002, que cumpre plenamente os requisitos de habilitação e que sua proposta está em conformidade com as exigências do Edital.";
}
elseif ($dec_nome=="Elaboração Independente De Proposta"){
    $dec_modelo="A Empresa - Santos & Mayer LTDA - EPP, CNPJ nº 09.457.677/0001-28, sediada no endereço em epígrafe, neste ato representada por $ref_legal, devidamente constituído, doravante denominado Licitante, DECLARA, sob as penas da lei, em especial o art. 299 do Código Penal Brasileiro, que: 
I. a proposta apresentada para participar do pregão eletrônico $pregao foi elaborada de maneira independente pelo Licitante, e o conteúdo da proposta não foi, no todo ou em parte, direta ou indiretamente, informado, discutido ou recebido de qualquer outro participante potencial ou de fato do pregão eletrônico $pregao, por qualquer meio ou por qualquer pessoa; 
II. a intenção de apresentar a proposta elaborada para participar do pregão eletrônico $pregao, não foi informada, discutida ou recebida de qualquer outro participante potencial ou de fato do pregão eletrônico $pregao, por qualquer meio ou por qualquer pessoa; 
III. que não tentou, por qualquer meio ou por qualquer pessoa, influir na decisão de qualquer outro participante potencial ou de fato do pregão eletrônico $pregao quanto a participar ou não da referida licitação; 
IV. que o conteúdo da proposta apresentada para participar da do pregão eletrônico $pregao não será, no todo ou em parte, direta ou indiretamente, comunicado ou discutido com qualquer outro participante potencial ou de fato do pregão eletrônico $pregao antes da adjudicação do objeto da referida licitação; 
V. que o conteúdo da proposta apresentada para participar  do pregão eletrônico $pregao não foi, no todo ou em parte, direta ou indiretamente, informado, discutido ou recebido de qualquer integrante de(o) $orgao, antes da abertura oficial das propostas; e 
VI. que está plenamente ciente do teor e da extensão desta declaração e que detém plenos poderes e informações para firmá-la.";
}
elseif ($dec_nome=="Cadastramento de Domicílio Bancário"){
    $dec_modelo="Declaro para o fim de comprovação e pagamento dos devidos créditos, que nossos dados Bancários são os abaixo especificados:

Nome/Razão Social: SANTOS & MAYER LTDA - EPP

CNPJ/CPF:09.457.677/0001-28

DADOS BANCÁRIOS :
ag. 4500-4; cc 23763-9.
BANCO N°: 001.     
NOME DO BANCO: Banco do Brasil
";
}





elseif ($dec_nome=="Microempresa(Me) e Empresa de Pequeno Porte(Epp)"){
    $dec_modelo="A Empresa - SANTOS & MAYER LTDA - EPP, inscrita no CNPJ nº 09.457.677/0001-28, por intermédio de seu representante legal o(a) Sr(a) $rep_legal, portador(a) da Carteira de Identidade nº $rg_rep_legal e do CPF nº $cpf_rep_legal, DECLARA, para fins do disposto no Edital do Pregão Eletrônico nº $pregao, sob as sanções administrativas e sob as penas da Lei, que esta empresa na presente data, é considerada: (    ) MICROEMPRESA, conforme inciso I, do art. 3º da Lei Complementar Estadual nº 0044/2007; Decreto 5016/2011, (    ) EMPRESA DE PEQUENO PORTE, conforme inciso II, do art. 3º da Lei Complementar Estadual nº 0044/2007. Declara ainda, para atendimento do que dispõe o § 2º do art. 3º da Lei Complementar Estadual nº 0044/07, que a Empresa está excluída das vedações constantes do parágrafo 4º do artigo 3º da Lei Complementar nº 123, de 14 de dezembro de 2006 e do Decreto 6.204/2007.";
}

elseif ($dec_nome=="Declarações Conjuntas"){
    $dec_modelo="A Empresa - SANTOS & MAYER LTDA - EPP, inscrita no CNPJ nº 09.457.677/0001-28, por intermédio de seu representante legal o(a) Sr(a) $rep_legal, portador(a) da Carteira de Identidade nº $rg_rep_legal e do CPF nº $cpf_rep_legal, DECLARA sob as penas da Lei:

1) ATENDIMENTO AO ART. 27, INCISO V da LEI 8666/93, acrescido pela Lei no 9.854/99, que não emprega menor de dezoito anos em trabalho noturno, perigoso ou insalubre e não emprega menor de dezesseis anos;
( ) Ressalva: contrata menor, a partir de quatorze anos, na condição de aprendiz. (em caso
afirmativo, assinalar a ressalva acima)
2) DE INEXISTÊNCIA DE FATO IMPEDITIVO PARA A HABILITAÇÃO: que, até a presente data, inexiste(m) fato(s) impeditivo(s) para a sua habilitação, estando ciente da obrigatoriedade de declarar ocorrências posteriores;
3) CUMPRIMENTO DO ART. 4º, INCISO VII DA LEI 10.520/02, sob pena de aplicação das
penalidades legais cabíveis conforme previsto no Art. 7º da Lei 10.520/02, que atende plenamente os requisitos de habilitação constantes do Edital;
4) DE CONHECIMENTO DO INSTRUMENTO CONVOCATÓRIO: ter recebido todos os
documentos e informações, conhecer e acatar as condições para o cumprimento das obrigações objeto da Licitação;
5) DE INEXISTÊNCIA DE IMPEDIMENTO PARA A PARTICIPAÇÃO: que não incorre em nenhum dos casos relacionados no item 6.2 do edital;
6) DE ELABORAÇÃO INDEPENDENTE DE PROPOSTA: que a proposta apresentada foi elaborada de maneira independente, que não tentou influir na decisão de qualquer outro potencial participante desta licitação, e que com estes ou com outras pessoas não discutiu nem recebeu informações."
;
}

elseif ($dec_nome=="Ofício"){
    $dec_modelo="A Empresa - SANTOS & MAYER LTDA - EPP, inscrita no CNPJ nº 09.457.677/0001-28, por intermédio de seu representante legal o(a) Sr(a) $rep_legal, portador(a) da Carteira de Identidade nº $rg_rep_legal e do CPF nº $cpf_rep_legal, $_REQUEST[conteudo_dec]";

}

else {
    $dec_modelo="A Empresa - SANTOS & MAYER LTDA - EPP, inscrita no CNPJ nº 09.457.677/0001-28, por intermédio de seu representante legal o(a) Sr(a) $rep_legal, portador(a) da Carteira de Identidade nº $rg_rep_legal e do CPF nº $cpf_rep_legal, $_REQUEST[conteudo_dec]";
}

$pdf->MultiCell(0, 7, utf8_decode($dec_modelo),1,1);


if ($linha_uf[modalidade]=="Presencial"){
    $data = (date('d/m/Y', strtotime($linha_uf[data])));;
}
else{

$data = strftime("%d/%m/%Y");
}
$pdf->SetFont('Arial','',10);
$pdf->ln(5);
$pdf->Cell(0,10, "Curitiba,".' '.$data,0,1,'C');
$pdf->ln(10);

if ($ass_digital == "Sim")
{
    if ($rep_legal == "Jefferson Santos")
    {
        $pdf->Image('imagens/ass_jeff_2.png',95,230,110);
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

$pdf->Output();

?>