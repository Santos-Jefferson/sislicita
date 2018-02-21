<?php
//session_start();
require "conecta.php";
require_once "cabecalho_reduzido.php";
require_once "cabecalho_lote.php";
include "css.php";
include "constantes.php";

$sql_uf = "SELECT * FROM codigo WHERE id_cod = {$_GET[id_cod]}";

$res_uf = mysql_query($sql_uf) or die("Erro seleção UF");

//pega a primeira linha do resultado
$linha_uf = mysql_fetch_assoc($res_uf);

//echo "$linha_uf[uf]";

//print_r ($_REQUEST);
// se o GET[order] for vazio, então será preenchido com um valor padrão
if(empty($_GET[order])) $_GET[order] = 'item';
    
$sql = "SELECT * FROM itens2 WHERE id_lote = {$_GET[id_lote]} order by {$_GET[order]}";

$res = mysql_query($sql) or die("Erro seleção");

$v = 0; //conterá a somatória dos valores
$c = 0; //total de registros

//pega a primeira linha do resultado
$linha = mysql_fetch_assoc($res);





$sql_coloc = "SELECT * FROM lote WHERE id_lote = {$_GET[id_lote]}";

$res_coloc = mysql_query($sql_coloc) or die("Erro seleção colocacao");

//pega a primeira linha do resultado
$linha_coloc = mysql_fetch_assoc($res_coloc);

//print_r ($_REQUEST);
//require_once "pes_rapida_cad_tudo.php";


//require "tab_cab_itens_tudo.php";
if (($linha_uf[uf]=="Rio de Janeiro - RJ") or ($linha_uf[uf]=="Minas Gerais - MG") or ($linha_uf[uf]=="Mato Grosso do Sul - MS")){
      $vsedex = 36.53;
    }
        elseif (($linha_uf[uf]=="Paraná - PR")){
        $vsedex = 14.20;
        }
        elseif (($linha_uf[uf]=="Rio Grande do Sul - RS") or ($linha_uf[uf]=="Santa Catarina - SC") or ($linha_uf[uf]=="São Paulo - SP")){
        $vsedex = 28.54;
        }
        elseif (($linha_uf[uf]=="Distrito Federal - DF") or ($linha_uf[uf]=="Espírito Santo - ES") or ($linha_uf[uf]=="Mato Grosso - MT")){
        $vsedex = 42.27;
        }
        elseif (($linha_uf[uf]=="Goiás - GO") or ($linha_uf[uf]=="Tocantins - TO")){
        $vsedex = 45.80;
        }
        elseif (($linha_uf[uf]=="Bahia - BA")){
        $vsedex = 49.22;
        }
        elseif (($linha_uf[uf]=="Alagoas - AL") or ($linha_uf[uf]=="Sergipe - SE")){
        $vsedex = 53.50;
        }
        elseif (($linha_uf[uf]=="Acre - AC") or ($linha_uf[uf]=="Amazonas - AM") or ($linha_uf[uf]=="Ceará - CE") or ($linha_uf[uf]=="Maranhão - MA") or ($linha_uf[uf]=="Pará - PA")
                or ($linha_uf[uf]=="Paraíba - PB") or ($linha_uf[uf]=="Pernambuco - PE")or ($linha_uf[uf]=="Piauí - PI")or ($linha_uf[uf]=="Rio Grande do Norte - RN") or ($linha_uf[uf]=="Rondônia - RO")){
        $vsedex = 58.85;
        }
        elseif (($linha_uf[uf]=="Amapá - AP")){
        $vsedex = 63.24;
        }
        elseif (($linha_uf[uf]=="Roraima - RR")){
        $vsedex = 69.12;
        }
            else{
                $vsedex = 0.00;
            }
                                               
//$vs = valores do sedex calculados de acordo com a tabela abaixo 21/04/2012
$vs=0;

//$cart = valor aproximado de gastos com cartório para envio de 1 documentação


    if (($linha_uf[uf]=="Rio de Janeiro - RJ") or ($linha_uf[uf]=="Minas Gerais - MG") or ($linha_uf[uf]=="Mato Grosso do Sul - MS")){
      $vs = "$vsedex" + "$cart";
    }
        elseif (($linha_uf[uf]=="Paraná - PR")){
        $vs = "$vsedex" + "$cart";
        }
        elseif (($linha_uf[uf]=="Rio Grande do Sul - RS") or ($linha_uf[uf]=="Santa Catarina - SC") or ($linha_uf[uf]=="São Paulo - SP")){
        $vs = "$vsedex" + "$cart";
        }
        elseif (($linha_uf[uf]=="Distrito Federal - DF") or ($linha_uf[uf]=="Espírito Santo - ES") or ($linha_uf[uf]=="Mato Grosso - MT")){
        $vs = "$vsedex" + "$cart";
        }
        elseif (($linha_uf[uf]=="Goiás - GO") or ($linha_uf[uf]=="Tocantins - TO")){
        $vs = "$vsedex" + "$cart";
        }
        elseif (($linha_uf[uf]=="Bahia - BA")){
        $vs = "$vsedex" + "$cart";
        }
        elseif (($linha_uf[uf]=="Alagoas - AL") or ($linha_uf[uf]=="Sergipe - SE")){
        $vs = "$vsedex" + "$cart";
        }
        elseif (($linha_uf[uf]=="Acre - AC") or ($linha_uf[uf]=="Amazonas - AM") or ($linha_uf[uf]=="Ceará - CE") or ($linha_uf[uf]=="Maranhão - MA") or ($linha_uf[uf]=="Pará - PA")
                or ($linha_uf[uf]=="Paraíba - PB") or ($linha_uf[uf]=="Pernambuco - PE")or ($linha_uf[uf]=="Piauí - PI")or ($linha_uf[uf]=="Rio Grande do Norte - RN") or ($linha_uf[uf]=="Rondônia - RO")){
        $vs = "$vsedex" + "$cart";
        }
        elseif (($linha_uf[uf]=="Amapá - AP")){
        $vs = "$vsedex" + "$cart";
        }
        elseif (($linha_uf[uf]=="Roraima - RR")){
        $vs = "$vsedex" + "$cart";
        }
            else{
                $vs = 0.00;
            }
//$vdocssedex=($vs+$cart);
?>



<br>
<table align="center" class="A" border="0" width="1010">
<table align="center" class="A" width="1000" border="1" cellpadding="3" cellspacing="0">
        
    <tr>
        <td class="forms" colspan="10" bgcolor="LemonChiffon" align="center"><strong>LISTAGEM LICITAÇÃO N°<a href="lista_licita_tudo.php?codigo=<?php echo $_GET[codigo];?>"><?php echo $_GET[codigo] ?></a> e LOTE/GRUPO N° <?php echo $_GET[lote] ?></td>
    </tr>
    
  <tr>
    <th width="" >TIPO</th>
    <th width="" >PREGÃO</th>  
    <th width="" >ÓRGÃO</th>
    <th width="" scope="col">CÓDIGO</th>
    <th width="" scope="col">DATA/HORA</th>
    <th width="" scope="col">LOTE/GRUPO</th>
    <th width="" scope="col">LICITANTE</th>
    <th >AÇÃO</th>
    <th >STATUS LOTE</th>
  </tr>
  <tr>
    <td align="center"><?php echo $linha_uf[tipo_licitacao] ?></td>
    <td align="center"><?php echo $linha_uf[pregao] ?></td>
    <td align="center"><?php echo $_GET[orgao]."/".$linha_uf[uf] ?></td>
    <td align="center"><?php echo $_GET[codigo] ?></td>
    <td align="center"><?php
                        $data = "$_GET[data]";
                        $hora = "$_GET[hora]";
                        echo date('d/m/Y', strtotime($data))." / ";
                        echo "$_GET[hora]";
                        ?>
    </td>
    <td align="center"><?php echo $_GET[lote] ?></td>
    <td align="center"><?php echo $_GET[licitante] ?></td>
    <td align="center">
            
            <a href="altera_lote.php?alterar=<?php echo $_GET[id_lote]; ?>&codigo=<?php echo $_GET[codigo]; ?>&lote=<?php echo $_GET[lote]; ?>&orgao=<?php echo $_GET[orgao]; ?>&data=<?php echo $_GET[data]; ?>&hora=<?php echo $_GET[hora]; ?>&licitante=<?php echo $_GET[licitante]; ?>&id_lote=<?php echo $_GET[id_lote]; ?>&id_itens=<?php echo $linha[id_itens]; ?>&id_cod=<?php echo $_GET[id_cod]; ?>"><img src="imagens/edit.png" border="0"/></a>
            <a href="conf_lote_exc.php?apagar=<?php echo $_GET[id_lote]; ?>&lote=<?php echo $_GET[lote];?>"><img src="imagens/delete.png" border="0"/></a>
             <a href="cad_contrato.php?id_itens=<?php echo $linha[id_itens];?>&id_lote=<?php echo $_GET[id_lote]; ?>&id_cod=<?php echo $_GET[id_cod]; ?>&codigo=<?php echo $_GET[codigo]; ?>&orgao=<?php echo $_GET[orgao]; ?>&pregao=<?php echo $_GET[pregao]; ?>&lote=<?php echo $_GET[lote]; ?>" title="Cad.Contrato"><img src="imagens/contrato.png" border="0"/></a>                
            <a href="cad_ne.php?id_itens=<?php echo $linha[id_itens];?>&id_lote=<?php echo $_GET[id_lote]; ?>&id_cod=<?php echo $_GET[id_cod]; ?>&vs=<?php echo $vs; ?>&vsedex=<?php echo $vsedex; ?>" title="Cad.NotaEmpenho"><img src="imagens/ne.png" border="0"/></a>                
            <a href="altera_cad_conc.php?id_itens=<?php echo $linha[id_itens];?>&id_lote=<?php echo $_GET[id_lote]; ?>&colocacao=<?php echo $linha_coloc[colocacao]; ?>&id_cod=<?php echo $_GET[id_cod]; ?>&vs=<?php echo $vs; ?>&vsedex=<?php echo $vsedex; ?>" title="Cad.Concorrência"><img src="imagens/botao-concorrencia.jpg" border="0"/></a>                
            
  
        </td>
        
            
    <td class="" align="center"><?php echo $linha_coloc[colocacao] ?></td>
    
  </tr>

  
<table align="center" class="A" width="1000" border="1" cellpadding="3" cellspacing="0">
      <br>
<tr align="center" class="forms">
    <th width="" >Item</th>
    <th width="" >Qtde</th>
    <th width="1000" colspan="" >Descrição dos itens</th>
    <th colspan="" >V. Mín. Item</th>
    <th colspan="" >V. Mín. Total</th>
    <th colspan="" >V. Ofertado/Ganho</th>
    <th colspan="" >Frete Item</th>
    <th colspan="" width="50" >Ação</th>
    
</tr>      
      
      
<?php


      
      
      

//enquanto houver linha
$vmo=0;            
$vmo2=0;            
$vmo3=0;            
while($linha){
    
//echo "$linha[vofertado];</br>";
    
    
                             
                        $sql_te = "SELECT * FROM frete_medidas WHERE tipo_equip='$linha[tipo_equip]'";
                        $res_te = mysql_query($sql_te) or die("Erro seleção frete_medidas");
                        $linha_te = mysql_fetch_assoc($res_te);
                        
                        //TRANSPORTADORAS - calculo do valor cubado, retirado das medias aproximadas do material cotado
                        $valor_cubado=($linha[qtde]*$linha_te[alt_equip]*$linha_te[larg_equip]*$linha_te[comp_equip])*300;
                        $valor_real=$linha[qtde]*$linha_te[peso_equip];
                        $vf=0;
                        $vf_final=0;
                        if ($valor_cubado>=$valor_real){
                            $vf=$valor_cubado;
                        }
                        else{
                            $vf=$valor_real;
                        }
                        //echo "$vf</br>";
                        //$vf=110;
                        
                        //PAC - CORREIOS - calculo do valor cubado, retirado das medias aproximadas do material cotado
                        $valor_cubado_pac=($linha[qtde]*$linha_te[alt_equip]*$linha_te[larg_equip]*$linha_te[comp_equip])/0.006;
                        $valor_real_pac=$linha[qtde]*$linha_te[peso_equip];
                        $vf_pac=0;
                        $vf_final_pac=0;
                        if ($valor_cubado_pac>=$valor_real_pac){
                            $vf_pac=$valor_cubado_pac;
                        }
                        else{
                            $vf_pac=$valor_real_pac;
                        }
                        //echo "<br>$vf_pac</br>";
                        //$vf=110;
                        //$vf_final=0;
                        
                            //CALCULO FRETE - BASE CORREIOS
                          //CALCULO LOCAL - FRETE SISLICITA - TABELA CORREIOS ABRIL 2012.
                        if      ((($linha_uf[uf]=="Paraná - PR")) and
                                    (($vf_pac>=0.1) and ($vf_pac<=1))){
                                        $vf_final_pac = ((8.37)+($linha[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Paraná - PR")) and
                                    (($vf_pac>1) and ($vf_pac<=5))){
                                        $vf_final_pac = ((12.58)+($linha[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Paraná - PR")) and
                                    (($vf_pac>5) and ($vf_pac<=10))){
                                        $vf_final_pac = ((15.46)+($linha[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Paraná - PR")) and
                                    (($vf_pac>=10) and ($vf_pac<=20))){
                                        $vf_final_pac = ((21.98)+($linha[vofertado]*1/100));
                                        }
                        elseif ((($linha_uf[uf]=="Paraná - PR")) and
                                    (($vf_pac>20) and ($vf_pac<=30))){
                                        $vf_final_pac = ((30.04)+($linha[vofertado]*1/100));
                                        }
                         elseif ((($linha_uf[uf]=="Paraná - PR")) and
                                    (($vf_pac>30))){
                                        $vf_final_pac = (30.04+((($vf_final_pac-30)/5)*4.77)+($linha[vofertado]*1/100));
                                        }
                                        //echo $vf_final_pac;
                                        
//CALCULO FRETE - BASE CORREIOS
                          //CALCULO FAIXA 1 - FRETE SISLICITA - TABELA CORREIOS ABRIL 2012.
                        if      ((($linha_uf[uf]=="São Paulo - SP") or
                                 ($linha_uf[uf]=="Santa Catarina - SC") or
                                 ($linha_uf[uf]=="Rio Grande do Sul - RS")) and
                                    (($vf_pac>=0.1) and ($vf_pac<=1))){
                                        $vf_final_pac = ((10.82)+($linha[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="São Paulo - SP") or
                                 ($linha_uf[uf]=="Santa Catarina - SC") or
                                 ($linha_uf[uf]=="Rio Grande do Sul - RS")) and
                                    (($vf_pac>1) and ($vf_pac<=5))){
                                        $vf_final_pac = ((16.24)+($linha[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="São Paulo - SP") or
                                 ($linha_uf[uf]=="Santa Catarina - SC") or
                                 ($linha_uf[uf]=="Rio Grande do Sul - RS")) and
                                    (($vf_pac>5) and ($vf_pac<=10))){
                                        $vf_final_pac = ((23.46)+($linha[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="São Paulo - SP") or
                                 ($linha_uf[uf]=="Santa Catarina - SC") or
                                 ($linha_uf[uf]=="Rio Grande do Sul - RS")) and
                                    (($vf_pac>10) and ($vf_pac<=20))){
                                        $vf_final_pac = ((38.84)+($linha[vofertado]*1/100));
                                        }
                        elseif ((($linha_uf[uf]=="São Paulo - SP") or
                                 ($linha_uf[uf]=="Santa Catarina - SC") or
                                 ($linha_uf[uf]=="Rio Grande do Sul - RS")) and
                                    (($vf_pac>20) and ($vf_pac<=30))){
                                        $vf_final_pac = ((55.70)+($linha[vofertado]*1/100));
                                        }
                         elseif ((($linha_uf[uf]=="São Paulo - SP") or
                                 ($linha_uf[uf]=="Santa Catarina - SC") or
                                 ($linha_uf[uf]=="Rio Grande do Sul - RS")) and
                                    (($vf_pac>=30))){
                                        $vf_final_pac = (55.70+((($vf_final_pac-30)/5)*8.86)+($linha[vofertado]*1/100));
                                        }
                                        //echo $vf_final_pac; 
                                        
//CALCULO FRETE - BASE CORREIOS
                          //CALCULO FAIXA 2 - FRETE SISLICITA - TABELA CORREIOS ABRIL 2012.
                        if      ((($linha_uf[uf]=="Minas Gerais - MG") or
                                 ($linha_uf[uf]=="Mato Grosso do Sul - MS") or
                                 ($linha_uf[uf]=="Rio de Janeiro - RJ")) and
                                    (($vf_pac>=0.1) and ($vf_pac<=1))){
                                        $vf_final_pac = ((12.02)+($linha[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Minas Gerais - MG") or
                                 ($linha_uf[uf]=="Mato Grosso do Sul - MS") or
                                 ($linha_uf[uf]=="Rio de Janeiro - RJ")) and
                                    (($vf_pac>1) and ($vf_pac<=5))){
                                        $vf_final_pac = ((18.06)+($linha[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Minas Gerais - MG") or
                                 ($linha_uf[uf]=="Mato Grosso do Sul - MS") or
                                 ($linha_uf[uf]=="Rio de Janeiro - RJ")) and
                                    (($vf_pac>5) and ($vf_pac<=10))){
                                        $vf_final_pac = ((27.42)+($linha[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Minas Gerais - MG") or
                                 ($linha_uf[uf]=="Mato Grosso do Sul - MS") or
                                 ($linha_uf[uf]=="Rio de Janeiro - RJ")) and
                                    (($vf_pac>10) and ($vf_pac<=20))){
                                        $vf_final_pac = ((46.82)+($linha[vofertado]*1/100));
                                        }
                        elseif ((($linha_uf[uf]=="Minas Gerais - MG") or
                                 ($linha_uf[uf]=="Mato Grosso do Sul - MS") or
                                 ($linha_uf[uf]=="Rio de Janeiro - RJ")) and
                                    (($vf_pac>20) and ($vf_pac<=30))){
                                        $vf_final_pac = ((67.55)+($linha[vofertado]*1/100));
                                        }
                         elseif ((($linha_uf[uf]=="Minas Gerais - MG") or
                                 ($linha_uf[uf]=="Mato Grosso do Sul - MS") or
                                 ($linha_uf[uf]=="Rio de Janeiro - RJ")) and
                                    (($vf_pac>=30))){
                                        $vf_final_pac = (67.55+((($vf_final_pac-30)/5)*10.70)+($linha[vofertado]*1/100));
                                        }
                                        //echo $vf_final_pac;    
                                        
//CALCULO FRETE - BASE CORREIOS
                          //CALCULO FAIXA 3 - FRETE SISLICITA - TABELA CORREIOS ABRIL 2012.
                        if      ((($linha_uf[uf]=="Distrito Federal - DF") or
                                 ($linha_uf[uf]=="Espírito Santo - ES") or
                                 ($linha_uf[uf]=="Mato Grosso - MT")) and
                                    (($vf_pac>=0.1) and ($vf_pac<=1))){
                                        $vf_final_pac = ((13.32)+($linha[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Distrito Federal - DF") or
                                 ($linha_uf[uf]=="Espírito Santo - ES") or
                                 ($linha_uf[uf]=="Mato Grosso - MT")) and
                                    (($vf_pac>1) and ($vf_pac<=5))){
                                        $vf_final_pac = ((20.01)+($linha[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Distrito Federal - DF") or
                                 ($linha_uf[uf]=="Espírito Santo - ES") or
                                 ($linha_uf[uf]=="Mato Grosso - MT")) and
                                    (($vf_pac>5) and ($vf_pac<=10))){
                                        $vf_final_pac = ((30.39)+($linha[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Distrito Federal - DF") or
                                 ($linha_uf[uf]=="Espírito Santo - ES") or
                                 ($linha_uf[uf]=="Mato Grosso - MT")) and
                                    (($vf_pac>10) and ($vf_pac<=20))){
                                        $vf_final_pac = ((51.89)+($linha[vofertado]*1/100));
                                        }
                        elseif ((($linha_uf[uf]=="Distrito Federal - DF") or
                                 ($linha_uf[uf]=="Espírito Santo - ES") or
                                 ($linha_uf[uf]=="Mato Grosso - MT")) and
                                    (($vf_pac>20) and ($vf_pac<=30))){
                                        $vf_final_pac = ((74.86)+($linha[vofertado]*1/100));
                                        }
                         elseif ((($linha_uf[uf]=="Distrito Federal - DF") or
                                 ($linha_uf[uf]=="Espírito Santo - ES") or
                                 ($linha_uf[uf]=="Mato Grosso - MT")) and
                                    (($vf_pac>=30))){
                                        $vf_final_pac = (74.86+((($vf_final_pac-30)/5)*11.86)+($linha[vofertado]*1/100));
                                        }
                                        //echo $vf_final_pac; 
                                        
                                        
//CALCULO FRETE - BASE CORREIOS
                          //CALCULO FAIXA 4 - FRETE SISLICITA - TABELA CORREIOS ABRIL 2012.
                        if      ((($linha_uf[uf]=="Goiás - GO") or
                                 ($linha_uf[uf]=="Tocantins - TO")) and
                                    (($vf_pac>=0.1) and ($vf_pac<=1))){
                                        $vf_final_pac = ((14.74)+($linha[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Goiás - GO") or
                                 ($linha_uf[uf]=="Tocantins - TO")) and
                                    (($vf_pac>1) and ($vf_pac<=5))){
                                        $vf_final_pac = ((22.19)+($linha[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Goiás - GO") or
                                 ($linha_uf[uf]=="Tocantins - TO")) and
                                    (($vf_pac>5) and ($vf_pac<=10))){
                                        $vf_final_pac = ((36.37)+($linha[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Goiás - GO") or
                                 ($linha_uf[uf]=="Tocantins - TO")) and
                                    (($vf_pac>10) and ($vf_pac<=20))){
                                        $vf_final_pac = ((65.34)+($linha[vofertado]*1/100));
                                        }
                        elseif ((($linha_uf[uf]=="Goiás - GO") or
                                 ($linha_uf[uf]=="Tocantins - TO")) and
                                    (($vf_pac>20) and ($vf_pac<=30))){
                                        $vf_final_pac = ((94.92)+($linha[vofertado]*1/100));
                                        }
                         elseif ((($linha_uf[uf]=="Goiás - GO") or
                                 ($linha_uf[uf]=="Tocantins - TO")) and
                                    (($vf_pac>=30))){
                                        $vf_final_pac = (94.92+((($vf_final_pac-30)/5)*14.79)+($linha[vofertado]*1/100));
                                        }
                                        //echo $vf_final_pac;  
                                        
                                        
//CALCULO FRETE - BASE CORREIOS
                          //CALCULO FAIXA 5 - FRETE SISLICITA - TABELA CORREIOS ABRIL 2012.
                        if      ((($linha_uf[uf]=="Bahia - BA")) and
                                    (($vf_pac>=0.1) and ($vf_pac<=1))){
                                        $vf_final_pac = ((16.56)+($linha[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Bahia - BA")) and
                                    (($vf_pac>1) and ($vf_pac<=5))){
                                        $vf_final_pac = ((24.94)+($linha[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Bahia - BA")) and
                                    (($vf_pac>5) and ($vf_pac<=10))){
                                        $vf_final_pac = ((40.87)+($linha[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Bahia - BA")) and
                                    (($vf_pac>10) and ($vf_pac<=20))){
                                        $vf_final_pac = ((73.43)+($linha[vofertado]*1/100));
                                        }
                        elseif ((($linha_uf[uf]=="Bahia - BA")) and
                                    (($vf_pac>20) and ($vf_pac<=30))){
                                        $vf_final_pac = ((106.68)+($linha[vofertado]*1/100));
                                        }
                         elseif ((($linha_uf[uf]=="Bahia - BA")) and
                                    (($vf_pac>=30))){
                                        $vf_final_pac = (106.68+((($vf_final_pac-30)/5)*16.63)+($linha[vofertado]*1/100));
                                        }
                                        //echo $vf_final_pac;  
                                        
                                        
                                        
//CALCULO FRETE - BASE CORREIOS
                          //CALCULO FAIXA 6 - FRETE SISLICITA - TABELA CORREIOS ABRIL 2012.
                        if      ((($linha_uf[uf]=="Alagoas - AL") or
                                 ($linha_uf[uf]=="Sergipe - SE")) and
                                    (($vf_pac>=0.1) and ($vf_pac<1))){
                                        $vf_final_pac = ((17.64)+($linha[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Alagoas - AL") or
                                 ($linha_uf[uf]=="Sergipe - SE")) and
                                    (($vf_pac>=1) and ($vf_pac<5))){
                                        $vf_final_pac = ((26.57)+($linha[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Alagoas - AL") or
                                 ($linha_uf[uf]=="Sergipe - SE")) and
                                    (($vf_pac>=5) and ($vf_pac<10))){
                                        $vf_final_pac = ((43.53)+($linha[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Alagoas - AL") or
                                 ($linha_uf[uf]=="Sergipe - SE")) and
                                    (($vf_pac>=10) and ($vf_pac<20))){
                                        $vf_final_pac = ((78.22)+($linha[vofertado]*1/100));
                                        }
                        elseif ((($linha_uf[uf]=="Alagoas - AL") or
                                 ($linha_uf[uf]=="Sergipe - SE")) and
                                    (($vf_pac>=20) and ($vf_pac<30))){
                                        $vf_final_pac = ((113.63)+($linha[vofertado]*1/100));
                                        }
                         elseif ((($linha_uf[uf]=="Alagoas - AL") or
                                 ($linha_uf[uf]=="Sergipe - SE")) and
                                    (($vf_pac>=30))){
                                        $vf_final_pac = (113.63+((($vf_final_pac-30)/5)*17.71)+($linha[vofertado]*1/100));
                                        }
                                        //echo $vf_final_pac; 
                                        
                                        
                                        //CALCULO FRETE - BASE CORREIOS
                          //CALCULO FAIXA 7 - FRETE SISLICITA - TABELA CORREIOS ABRIL 2012.
                                        
                        if      ((($linha_uf[uf]=="Acre - AC") or
                                 ($linha_uf[uf]=="Amazonas - AM") or
                                 ($linha_uf[uf]=="Ceará - CE") or
                                 ($linha_uf[uf]=="Maranhão - MA") or
                                 ($linha_uf[uf]=="Pará - PA") or
                                 ($linha_uf[uf]=="Paraíba - PB") or
                                 ($linha_uf[uf]=="Pernambuco - PE") or
                                 ($linha_uf[uf]=="Piauí - PI") or
                                 ($linha_uf[uf]=="Rio Grande do Norte - RN") or
                                 ($linha_uf[uf]=="Rondônia - RO")) and
                                    (($vf_pac>=0.1) and ($vf_pac<=1))){
                                        $vf_final_pac = ((19.74)+($linha[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Acre - AC") or
                                 ($linha_uf[uf]=="Amazonas - AM") or
                                 ($linha_uf[uf]=="Ceará - CE") or
                                 ($linha_uf[uf]=="Maranhão - MA") or
                                 ($linha_uf[uf]=="Pará - PA") or
                                 ($linha_uf[uf]=="Paraíba - PB") or
                                 ($linha_uf[uf]=="Pernambuco - PE") or
                                 ($linha_uf[uf]=="Piauí - PI") or
                                 ($linha_uf[uf]=="Rio Grande do Norte - RN") or
                                 ($linha_uf[uf]=="Rondônia - RO")) and
                                    (($vf_pac>1) and ($vf_pac<=5))){
                                        $vf_final_pac = ((29.44)+($linha[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Acre - AC") or
                                 ($linha_uf[uf]=="Amazonas - AM") or
                                 ($linha_uf[uf]=="Ceará - CE") or
                                 ($linha_uf[uf]=="Maranhão - MA") or
                                 ($linha_uf[uf]=="Pará - PA") or
                                 ($linha_uf[uf]=="Paraíba - PB") or
                                 ($linha_uf[uf]=="Pernambuco - PE") or
                                 ($linha_uf[uf]=="Piauí - PI") or
                                 ($linha_uf[uf]=="Rio Grande do Norte - RN") or
                                 ($linha_uf[uf]=="Rondônia - RO")) and
                                    (($vf_pac>5) and ($vf_pac<=10))){
                                        $vf_final_pac = ((51.19)+($linha[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Acre - AC") or
                                 ($linha_uf[uf]=="Amazonas - AM") or
                                 ($linha_uf[uf]=="Ceará - CE") or
                                 ($linha_uf[uf]=="Maranhão - MA") or
                                 ($linha_uf[uf]=="Pará - PA") or
                                 ($linha_uf[uf]=="Paraíba - PB") or
                                 ($linha_uf[uf]=="Pernambuco - PE") or
                                 ($linha_uf[uf]=="Piauí - PI") or
                                 ($linha_uf[uf]=="Rio Grande do Norte - RN") or
                                 ($linha_uf[uf]=="Rondônia - RO")) and
                                    (($vf_pac>10) and ($vf_pac<=20))){
                                        $vf_final_pac = ((94.71)+($linha[vofertado]*1/100));
                                        }
                        elseif ((($linha_uf[uf]=="Acre - AC") or
                                 ($linha_uf[uf]=="Amazonas - AM") or
                                 ($linha_uf[uf]=="Ceará - CE") or
                                 ($linha_uf[uf]=="Maranhão - MA") or
                                 ($linha_uf[uf]=="Pará - PA") or
                                 ($linha_uf[uf]=="Paraíba - PB") or
                                 ($linha_uf[uf]=="Pernambuco - PE") or
                                 ($linha_uf[uf]=="Piauí - PI") or
                                 ($linha_uf[uf]=="Rio Grande do Norte - RN") or
                                 ($linha_uf[uf]=="Rondônia - RO")) and
                                    (($vf_pac>20) and ($vf_pac<=30))){
                                        $vf_final_pac = ((138.22)+($linha[vofertado]*1/100));
                                        }
                         elseif ((($linha_uf[uf]=="Acre - AC") or
                                 ($linha_uf[uf]=="Amazonas - AM") or
                                 ($linha_uf[uf]=="Ceará - CE") or
                                 ($linha_uf[uf]=="Maranhão - MA") or
                                 ($linha_uf[uf]=="Pará - PA") or
                                 ($linha_uf[uf]=="Paraíba - PB") or
                                 ($linha_uf[uf]=="Pernambuco - PE") or
                                 ($linha_uf[uf]=="Piauí - PI") or
                                 ($linha_uf[uf]=="Rio Grande do Norte - RN") or
                                 ($linha_uf[uf]=="Rondônia - RO")) and
                                    (($vf_pac>=30))){
                                        $vf_final_pac = (138.22+((($vf_final_pac-30)/5)*21.76)+($linha[vofertado]*1/100));
                                        }
                                        
                                        //echo "<br>$vf_pac<br>"; 
                                        //echo "<br>$vf_final_pac<br>"; 
                                        
//CALCULO FRETE - BASE CORREIOS
                          //CALCULO FAIXA 8 - FRETE SISLICITA - TABELA CORREIOS ABRIL 2012.
                        if      ((($linha_uf[uf]=="Amapá - AP")) and
                                    (($vf_pac>=0.1) and ($vf_pac<=1))){
                                        $vf_final_pac = ((21.62)+($linha[vofertado]*1/100));
                                        }
                        elseif   ((($linha_uf[uf]=="Amapá - AP")) and
                                    (($vf_pac>1) and ($vf_pac<=5))){
                                        $vf_final_pac = ((32.23)+($linha[vofertado]*1/100));
                                        }
                        elseif   ((($linha_uf[uf]=="Amapá - AP")) and
                                    (($vf_pac>5) and ($vf_pac<=10))){
                                        $vf_final_pac = ((56.06)+($linha[vofertado]*1/100));
                                        }
                        elseif   ((($linha_uf[uf]=="Amapá - AP")) and
                                    (($vf_pac>10) and ($vf_pac<=20))){
                                        $vf_final_pac = ((103.71)+($linha[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Amapá - AP")) and
                                    (($vf_pac>20) and ($vf_pac<=30))){
                                        $vf_final_pac = ((151.35)+($linha[vofertado]*1/100));
                                        }
                         elseif  ((($linha_uf[uf]=="Amapá - AP")) and
                                    (($vf_pac>=30))){
                                        $vf_final_pac = (151.35+((($vf_final_pac-30)/5)*23.82)+($linha[vofertado]*1/100));
                                        }
                                        //echo $vf_final_pac;
                                        
                                        //CALCULO FRETE - BASE CORREIOS
                          //CALCULO FAIXA 9 - FRETE SISLICITA - TABELA CORREIOS ABRIL 2012.
                        if      ((($linha_uf[uf]=="Roraima - RR")) and
                                    (($vf_pac>=0.1) and ($vf_pac<=1))){
                                        $vf_final_pac = ((22.87)+($linha[vofertado]*1/100));
                                        }
                        elseif   ((($linha_uf[uf]=="Roraima - RR")) and
                                    (($vf_pac>1) and ($vf_pac<=5))){
                                        $vf_final_pac = ((34.10)+($linha[vofertado]*1/100));
                                        }
                        elseif   ((($linha_uf[uf]=="Roraima - RR")) and
                                    (($vf_pac>5) and ($vf_pac<=10))){
                                        $vf_final_pac = ((59.31)+($linha[vofertado]*1/100));
                                        }
                        elseif   ((($linha_uf[uf]=="Roraima - RR")) and
                                    (($vf_pac>10) and ($vf_pac<=20))){
                                        $vf_final_pac = ((109.72)+($linha[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Roraima - RR")) and
                                    (($vf_pac>20) and ($vf_pac<=30))){
                                        $vf_final_pac = ((160.13)+($linha[vofertado]*1/100));
                                        }
                         elseif  ((($linha_uf[uf]=="Roraima - RR")) and
                                    (($vf_pac>=30))){
                                        $vf_final_pac = (160.13+((($vf_final_pac-30)/5)*25.21)+($linha[vofertado]*1/100));
                                        }
                                        //echo $vf_final_pac;
                                        
                        
                        
                        //$vf=32;
                        //CALCULO REGIAL NORTE - FRETE SISLICITA - TABELA TRANSPAULO 2012.
                        if       ((($linha_uf[uf]=="Acre - AC") or
                                 ($linha_uf[uf]=="Amazonas - AM") or
                                 ($linha_uf[uf]=="Amapá - AP") or
                                 ($linha_uf[uf]=="Pará - PA") or
                                 ($linha_uf[uf]=="Rondônia - RO") or
                                 ($linha_uf[uf]=="Roraima - RR") or
                                 ($linha_uf[uf]=="Ceará - CE") or
                                 ($linha_uf[uf]=="Maranhão - MA") or
                                 ($linha_uf[uf]=="Tocantins - TO")) and
                                    (($vf>=0.1) and ($vf<=30))){
                                        $vf_final = ((80.50 + 3.66 + 2.67)+($linha[vofertado]*0.5/100)+($linha[vofertado]*0.3/100))*1.3;
                                        }
                                                                     
                         elseif (       (($linha_uf[uf]=="Acre - AC") or
                                        ($linha_uf[uf]=="Amazonas - AM") or
                                        ($linha_uf[uf]=="Amapá - AP") or
                                        ($linha_uf[uf]=="Pará - PA") or
                                        ($linha_uf[uf]=="Rondônia - RO") or
                                        ($linha_uf[uf]=="Roraima - RR") or
                                        ($linha_uf[uf]=="Ceará - CE") or
                                        ($linha_uf[uf]=="Maranhão - MA") or
                                        ($linha_uf[uf]=="Tocantins - TO")) and
                                            (($vf>=31) and ($vf<=50))){
                                                $vf_final = ((100.63 + 3.66 + 2.67)+($linha[vofertado]*0.5/100)+($linha[vofertado]*0.3/100))*1.3;
                                                }
                          elseif (      (($linha_uf[uf]=="Acre - AC") or
                                        ($linha_uf[uf]=="Amazonas - AM") or
                                        ($linha_uf[uf]=="Amapá - AP") or
                                        ($linha_uf[uf]=="Pará - PA") or
                                        ($linha_uf[uf]=="Rondônia - RO") or
                                        ($linha_uf[uf]=="Roraima - RR") or
                                        ($linha_uf[uf]=="Ceará - CE") or
                                        ($linha_uf[uf]=="Maranhão - MA") or
                                        ($linha_uf[uf]=="Tocantins - TO")) and
                                            (($vf>=50) and ($vf<=100))){
                                                $vf_final = ((120.75 + 3.66 + 2.67)+($linha[vofertado]*0.5/100)+($linha[vofertado]*0.3/100))*1.3;
                                                }
                         elseif (       (($linha_uf[uf]=="Acre - AC") or
                                        ($linha_uf[uf]=="Amazonas - AM") or
                                        ($linha_uf[uf]=="Amapá - AP") or
                                        ($linha_uf[uf]=="Pará - PA") or
                                        ($linha_uf[uf]=="Rondônia - RO") or
                                        ($linha_uf[uf]=="Roraima - RR") or
                                        ($linha_uf[uf]=="Ceará - CE") or
                                        ($linha_uf[uf]=="Maranhão - MA") or
                                        ($linha_uf[uf]=="Tocantins - TO")) and
                                           (($vf>100))){
                                                $vf_final = ((($vf*0.805) + 3.66 + 2.67)+($linha[vofertado]*0.5/100)+($linha[vofertado]*0.3/100))*1.3;
                                                }
                                                //echo "<br>$vf<br>";
                                                //echo "<br>$vf_final<br>";
                         //CALCULO REGIAL CENTRO-OESTE - FRETE SISLICITA - TABELA TRANSPAULO 2012.                       
                         if       ((($linha_uf[uf]=="Goiás - GO") or
                                 ($linha_uf[uf]=="Distrito Federal - DF") or
                                 ($linha_uf[uf]=="Mato Grosso - MT") or
                                 ($linha_uf[uf]=="Mato Grosso do Sul - MS")) and
                                    (($vf>=0) and ($vf<=30))){
                                        $vf_final = ((40.25 + 3.66 + 2.67)+($linha[vofertado]*0.2/100)+($linha[vofertado]*0.2/100));
                                        }
                                                                     
                         elseif (       (($linha_uf[uf]=="Goiás - GO") or
                                        ($linha_uf[uf]=="Distrito Federal - DF") or
                                        ($linha_uf[uf]=="Mato Grosso - MT") or
                                        ($linha_uf[uf]=="Mato Grosso do Sul - MS")) and
                                           (($vf>=31) and ($vf<=50))){
                                               $vf_final = ((48.88 + 3.66 + 2.67)+($linha[vofertado]*0.2/100)+($linha[vofertado]*0.2/100));
                                               }
                          elseif (      (($linha_uf[uf]=="Goiás - GO") or
                                        ($linha_uf[uf]=="Distrito Federal - DF") or
                                        ($linha_uf[uf]=="Mato Grosso - MT") or
                                        ($linha_uf[uf]=="Mato Grosso do Sul - MS")) and
                                           (($vf>=51) and ($vf<=100))){
                                               $vf_final = ((57.50 + 3.66 + 2.67)+($linha[vofertado]*0.2/100)+($linha[vofertado]*0.2/100));
                                               }
                         elseif (       (($linha_uf[uf]=="Goiás - GO") or
                                        ($linha_uf[uf]=="Distrito Federal - DF") or
                                        ($linha_uf[uf]=="Mato Grosso - MT") or
                                        ($linha_uf[uf]=="Mato Grosso do Sul - MS")) and
                                           (($vf>=100))){
                                               $vf_final = ((($vf*0.345) + 3.66 + 2.67)+($linha[vofertado]*0.2/100)+($linha[vofertado]*0.2/100));
                                               }
                                               
                        //CALCULO REGIAL SUDESTE - FRETE SISLICITA - TABELA TRANSPAULO 2012.                       
                         if       ((($linha_uf[uf]=="Minas Gerais - MG") or
                                 ($linha_uf[uf]=="Espírito Santo - ES") or
                                 ($linha_uf[uf]=="São Paulo - SP") or
                                 ($linha_uf[uf]=="Rio de Janeiro - RJ")) and
                                    (($vf>=0) and ($vf<=30))){
                                        $vf_final = ((35.65 + 3.66 + 2.67)+($linha[vofertado]*0.2/100)+($linha[vofertado]*0.2/100));
                                        }
                                                                     
                         elseif (       (($linha_uf[uf]=="Minas Gerais - MG") or
                                 ($linha_uf[uf]=="Espírito Santo - ES") or
                                 ($linha_uf[uf]=="São Paulo - SP") or
                                 ($linha_uf[uf]=="Rio de Janeiro - RJ")) and
                                           (($vf>=31) and ($vf<=50))){
                                               $vf_final = ((41.98 + 3.66 + 2.67)+($linha[vofertado]*0.2/100)+($linha[vofertado]*0.2/100));
                                               }
                          elseif (      (($linha_uf[uf]=="Minas Gerais - MG") or
                                 ($linha_uf[uf]=="Espírito Santo - ES") or
                                 ($linha_uf[uf]=="São Paulo - SP") or
                                 ($linha_uf[uf]=="Rio de Janeiro - RJ")) and
                                           (($vf>=51) and ($vf<=100))){
                                               $vf_final = ((48.30 + 3.66 + 2.67)+($linha[vofertado]*0.2/100)+($linha[vofertado]*0.2/100));
                                               }
                         elseif (       (($linha_uf[uf]=="Minas Gerais - MG") or
                                 ($linha_uf[uf]=="Espírito Santo - ES") or
                                 ($linha_uf[uf]=="São Paulo - SP") or
                                 ($linha_uf[uf]=="Rio de Janeiro - RJ")) and
                                           (($vf>=100))){
                                                $vf_final = ((52.90+((($vf-100)*0.44) + 3.66 + 2.67)+($linha[vofertado]*0.20/100)+($linha[vofertado]*0.15/100)+($linha[vofertado]*0.15/100))*1.088);
                                               } 
                                               
                         //CALCULO REGIAL SUL - FRETE SISLICITA - TABELA TRANSPAULO 2012.                       
                         if       ((($linha_uf[uf]=="Paraná - PR") or
                                 ($linha_uf[uf]=="Santa Catarina - SC") or
                                 ($linha_uf[uf]=="Rio Grande do Sul - RS")) and
                                    (($vf>=0.1) and ($vf<=30))){
                                        $vf_final = ((24.73 + 3.66 + 2.67)+($linha[vofertado]*0.2/100)+($linha[vofertado]*0.2/100));
                                        }
                                                                     
                         elseif (       (($linha_uf[uf]=="Paraná - PR") or
                                 ($linha_uf[uf]=="Santa Catarina - SC") or
                                 ($linha_uf[uf]=="Rio Grande do Sul - RS")) and
                                           (($vf>=31) and ($vf<=50))){
                                               $vf_final = ((28.46 + 3.66 + 2.67)+($linha[vofertado]*0.2/100)+($linha[vofertado]*0.2/100));
                                               }
                          elseif (      (($linha_uf[uf]=="Paraná - PR") or
                                 ($linha_uf[uf]=="Santa Catarina - SC") or
                                 ($linha_uf[uf]=="Rio Grande do Sul - RS")) and
                                           (($vf>=51) and ($vf<=100))){
                                               $vf_final = ((32.20 + 3.66 + 2.67)+($linha[vofertado]*0.2/100)+($linha[vofertado]*0.2/100));
                                               }
                         elseif (       (($linha_uf[uf]=="Paraná - PR") or
                                 ($linha_uf[uf]=="Santa Catarina - SC") or
                                 ($linha_uf[uf]=="Rio Grande do Sul - RS")) and
                                           (($vf>=100))){
                                               $vf_final = ((52.90+((($vf-100)*0.30) + 3.66 + 2.67)+($linha[vofertado]*0.10/100)+($linha[vofertado]*0.1/100)+($linha[vofertado]*0.1/100))*1.05);
                                               }
                                               //echo "<br>$vf_final<br>";
                                               
                         //CALCULO REGIAL NORDESTE - FRETE SISLICITA - TABELA TRANSPAULO 2012.                       
                         if       ((($linha_uf[uf]=="Alagoas - AL") or
                                 ($linha_uf[uf]=="Bahia - BA") or
                                 ($linha_uf[uf]=="Ceará - CE") or
                                 ($linha_uf[uf]=="Maranhão - MA") or
                                 ($linha_uf[uf]=="Paraíba - PB") or
                                 ($linha_uf[uf]=="Pernambuco - PE") or
                                 ($linha_uf[uf]=="Piauí - PI") or
                                 ($linha_uf[uf]=="Rio Grande do Norte - RN") or
                                 ($linha_uf[uf]=="Sergipe - SE")) and
                                    (($vf>=0.1) and ($vf<30))){
                                        $vf_final = ((43.76 + 3.66 + 2.67)+($linha[vofertado]*0.2/100)+($linha[vofertado]*0.2/100));
                                        }
                                                                     
                         elseif (       (($linha_uf[uf]=="Alagoas - AL") or
                                 ($linha_uf[uf]=="Bahia - BA") or
                                 ($linha_uf[uf]=="Ceará - CE") or
                                 ($linha_uf[uf]=="Maranhão - MA") or
                                 ($linha_uf[uf]=="Paraíba - PB") or
                                 ($linha_uf[uf]=="Pernambuco - PE") or
                                 ($linha_uf[uf]=="Piauí - PI") or
                                 ($linha_uf[uf]=="Rio Grande do Norte - RN") or
                                 ($linha_uf[uf]=="Sergipe - SE")) and
                                           (($vf>=30) and ($vf<50))){
                                               $vf_final = ((56.94 + 3.66 + 2.67)+($linha[vofertado]*0.2/100)+($linha[vofertado]*0.2/100));
                                               }
                          elseif (      (($linha_uf[uf]=="Alagoas - AL") or
                                 ($linha_uf[uf]=="Bahia - BA") or
                                 ($linha_uf[uf]=="Ceará - CE") or
                                 ($linha_uf[uf]=="Maranhão - MA") or
                                 ($linha_uf[uf]=="Paraíba - PB") or
                                 ($linha_uf[uf]=="Pernambuco - PE") or
                                 ($linha_uf[uf]=="Piauí - PI") or
                                 ($linha_uf[uf]=="Rio Grande do Norte - RN") or
                                 ($linha_uf[uf]=="Sergipe - SE")) and
                                           (($vf>=50) and ($vf<100))){
                                               $vf_final = ((89.87 + 3.66 + 2.67)+($linha[vofertado]*0.2/100)+($linha[vofertado]*0.2/100));
                                               }
                         elseif (       (($linha_uf[uf]=="Alagoas - AL") or
                                 ($linha_uf[uf]=="Bahia - BA") or
                                 ($linha_uf[uf]=="Ceará - CE") or
                                 ($linha_uf[uf]=="Maranhão - MA") or
                                 ($linha_uf[uf]=="Paraíba - PB") or
                                 ($linha_uf[uf]=="Pernambuco - PE") or
                                 ($linha_uf[uf]=="Piauí - PI") or
                                 ($linha_uf[uf]=="Rio Grande do Norte - RN") or
                                 ($linha_uf[uf]=="Sergipe - SE")) and
                                           (($vf>=100))){
                                               $vf_final = ((($vf*0.659) + 3.66 + 2.67)+($linha[vofertado]*0.2/100)+($linha[vofertado]*0.2/100));
                                               }
                                               

/*
echo "$vf_pac</br>";                                                 
echo "$vf_final_pac</br>";  

echo "$vf</br>";  
echo "$vf_final</br>";  
*/
                                               
                                               
//echo "$vs"-"$cart";
  //echo "$linha_uf[uf]";

    //mostra a linha
    //$linha agora é um vetor com as posições:
    //$linha[cod], $linha[nome], $linha[valor], etc...

//  Declarado aqui as variáveis que irão compor as colunas para utilizar na hora 
//  do pregão (criado as fórmulas para adicionar ao banco)
//  chama o arquivo que contem as variáveis
//require "var_formulas.php"
                  //incrementa o total de linhas;    

$vtotcusto=$linha[qtde]*$linha[vunitcusto];
//$vf_final_pac=1;
if (($vf_final>=$vf_final_pac) and ($vf_pac<60)){
        $vfrete=$vf_final_pac;
        $tipo_vfrete="PAC - Correios";
        }
        else{
            $vfrete=$vf_final;
            $tipo_vfrete="Transportadora";
            }

//$vfrete=$vf_final_pac;
//echo substr($linha_uf[uf],-2);

if (substr($linha_uf[uf],-2)=="AC"){
    $difaliq=$difaliq_ac;
    }
if (substr($linha_uf[uf],-2)=="AL"){
    $difaliq=$difaliq_al;
    }
if (substr($linha_uf[uf],-2)=="AM"){
    $difaliq=$difaliq_am;
    }
if (substr($linha_uf[uf],-2)=="AP"){
    $difaliq=$difaliq_ap;
    }
if (substr($linha_uf[uf],-2)=="BA"){
    $difaliq=$difaliq_ba;
    }
if (substr($linha_uf[uf],-2)=="CE"){
    $difaliq=$difaliq_ce;
    }
if (substr($linha_uf[uf],-2)=="DF"){
    $difaliq=$difaliq_df;
    }
if (substr($linha_uf[uf],-2)=="ES"){
    $difaliq=$difaliq_es;
    }
if (substr($linha_uf[uf],-2)=="GO"){
    $difaliq=$difaliq_go;
    }
if (substr($linha_uf[uf],-2)=="MA"){
    $difaliq=$difaliq_ma;
    }
if (substr($linha_uf[uf],-2)=="MS"){
    $difaliq=$difaliq_ms;
    }
if (substr($linha_uf[uf],-2)=="MT"){
    $difaliq=$difaliq_mt;
    }
if (substr($linha_uf[uf],-2)=="PA"){
    $difaliq=$difaliq_pa;
    }
if (substr($linha_uf[uf],-2)=="PB"){
    $difaliq=$difaliq_pb;
    }
if (substr($linha_uf[uf],-2)=="PE"){
    $difaliq=$difaliq_pe;
    }
if (substr($linha_uf[uf],-2)=="PI"){
    $difaliq=$difaliq_pi;
    }
if (substr($linha_uf[uf],-2)=="RN"){
    $difaliq=$difaliq_rn;
    }
if (substr($linha_uf[uf],-2)=="RO"){
    $difaliq=$difaliq_ro;
    }
if (substr($linha_uf[uf],-2)=="RR"){
    $difaliq=$difaliq_rr;
    }
if (substr($linha_uf[uf],-2)=="SE"){
    $difaliq=$difaliq_se;
    }
if (substr($linha_uf[uf],-2)=="TO"){
    $difaliq=$difaliq_to;
    }
if (substr($linha_uf[uf],-2)=="MG"){
    $difaliq=$difaliq_mg;
    }
if (substr($linha_uf[uf],-2)=="RJ"){
    $difaliq=$difaliq_rj;
    }
if (substr($linha_uf[uf],-2)=="RS"){
    $difaliq=$difaliq_rs;
    }
if (substr($linha_uf[uf],-2)=="SC"){
    $difaliq=$difaliq_sc;
    }
if (substr($linha_uf[uf],-2)=="SP"){
    $difaliq=$difaliq_sp;
    }
  
            
/*if (($linha_uf[uf]=="Ceará - CE")or($linha_uf[uf]=="Mato Grosso do Sul - MS")or($linha_uf[uf]=="Mato Grosso - MT")){
    $porc_ceara=10;
    }
    else{
        $porc_ceara=0;
        }            
*/          
$vimposto=($linha[vofertado]*($porc_sn+$linha_uf[perc_icms]+$difaliq)/100);

       
//echo "$vtotcusto<br/>";
//echo "$vo</br>";
//echo "<br>$vfrete<br/>";
//echo "$vimposto<br/>";
//echo "$porc_lucro<br/>";
//echo "$vs<br/>";        
//echo "$c<br/>";
if ($linha[vofertado]!=0){        
    $custo_aprox=($vtotcusto+$vfrete+$vimposto);
    //echo "$custo_aprox<br/>";
    }
    else{
        $custo_aprox=0;
        //echo "$custo_aprox<br/>";
    }
  
$vminofertar=($custo_aprox*$porc_lucro)+($custo_aprox);
$vminofertar2=($custo_aprox*$porc_lucro2)+($custo_aprox);
$vminofertar3=($custo_aprox*$porc_lucro3)+($custo_aprox);
$vminitem=($vminofertar/$linha[qtde]);
//echo "$vminofertar</br>";
//echo "$vminitem</br></br>";
if ($custo_aprox==0){
    $mensagem_custo="informar valor a ofertar";
}

$lucro_liq=$linha[vofertado]-$custo_aprox;
$c++; 
$vo += $linha[vofertado];    //incrementa a $v o campo valor
 

?>
      
  

<tr align="center">
    
   
<td>&nbsp;<?php echo $linha[item] ?>
    </td>
    
    <td>&nbsp;<?php echo $linha[qtde] ?></td>
    <td colspan="" align="left">&nbsp;<?php
    
    
                            $sql2 = "SELECT * FROM subitens2 WHERE id_item = $linha[id_itens] order by id_subitem";
                            $res2 = mysql_query($sql2) or die("Erro seleção linha2");
                            $linha2 = mysql_fetch_assoc($res2);
                            
                            if (empty($linha2[id_subitem])) 
                                echo "$linha[nome_item] MARCA: $linha[marca_item] / MODELO: $linha[modelo_item] / $linha[produto]";
                            else{
                            
                                while($linha2){
                            
                                    echo "$linha2[qtde_si]-$linha2[nome_subitem] MARCA: $linha2[marca_si] / MODELO: $linha2[modelo_si]<br><hr>";
                                    
                                    $linha2 = mysql_fetch_assoc($res2);
                                    }
                            }
                            
                 //echo $vf;  
                 
                                    ?>
    </td>
                            
    <td colspan="">&nbsp;<?php
    
                        $sql3 = "SELECT * FROM subitens2 WHERE id_item = $linha[id_itens]";
                        $res3 = mysql_query($sql3) or die("Erro seleção linha2");
                        $linha3 = mysql_fetch_assoc($res3);
                        $soma = 0;
                        
                        
                        if ((empty($linha3[vunitcusto_si]))
                                and (isset($mensagem_custo))){
                                    echo "<strong>$mensagem_custo";
                                    }
                        if ((empty($linha3[vunitcusto_si]))
                                and (!isset($mensagem_custo))){
                                    $number = "$vminitem";
                                    echo "R$" .number_format($number,2, ',','.');
                                    }
                                    
                            else{
                                $soma_si=0;
                                while($linha3){
                                    $soma_si += ($linha3[vunitcusto_si]*$linha3[qtde_si]);
                                    $linha3 = mysql_fetch_assoc($res3);
                                    //echo $soma_si;
                                    }
                                    
                                    $vtotcusto=($soma_si*$linha[qtde]);
                                    
                                    if ($linha[vofertado]!=0){        
                                        $custo_aprox=($vtotcusto+$vfrete+$vimposto);
                                        //echo "$custo_aprox<br/>";
                                        }
                                        else{
                                            $custo_aprox=0;
                                            //echo "$custo_aprox<br/>";
                                        }

                                    $vminofertar=($custo_aprox*$porc_lucro)+($custo_aprox);
                                    $vminitem=($vminofertar/$linha[qtde]);
                                    $vminofertar2=($custo_aprox*$porc_lucro2)+($custo_aprox);
                                    $vminitem=($vminofertar/$linha[qtde]);
                                    $vminofertar3=($custo_aprox*$porc_lucro3)+($custo_aprox);
                                    $vminitem=($vminofertar/$linha[qtde]);

                                    if ($custo_aprox==0){
                                        $mensagem_custo="informar valor a ofertar";
                                    }
                                    //echo "$custo_aprox<br/>";
                                    //$lucro_liq=$linha[vofertado]-$custo_aprox;

                                    //$c++; 
                                    //$vmo += $vminofertar;    //incrementa a $v o campo valor
                                    //$ca += $custo_aprox;    //incrementa a $v o campo valor
                                    //$ll += $lucro_liq;    //incrementa a $v o campo valor
                                    //$vo += $linha[vofertado];    //incrementa a $v o campo valor
                                    //$vmo += $linha[vminofertar];    //incrementa a $v o campo valor
                                    //$vmo += $linha[vminofertar];    //incrementa a $v o campo valor
                                    $number_si=$vminitem;
                                    echo "R$" .number_format($number_si,2, ',','.');
                                }
                                                        
                                                    
                                                
                                    ?>
        
    </td>
    <td colspan="">&nbsp;<?php
    
                        $sql3 = "SELECT * FROM subitens2 WHERE id_item = $linha[id_itens]";
                        $res3 = mysql_query($sql3) or die("Erro seleção linha2");
                        $linha3 = mysql_fetch_assoc($res3);
                        $soma = 0;
                        
                        //if (empty($linha3[vunitcusto_si])){
                               if ((empty($linha3[vunitcusto_si]))
                                and (isset($mensagem_custo))){
                                    echo "<strong>$mensagem_custo";
                                    }
                                if ((empty($linha3[vunitcusto_si]))
                                and (!isset($mensagem_custo))){
                                    $number = $vminitem*$linha[qtde];
                                    echo "R$" .number_format($number,2, ',','.');
                                    }   
                                else{
                                
                                while($linha3){
                                    //$soma = 0;    
                                    $soma = ($number_si*$linha[qtde]);
                                    //echo $soma;
                                    $linha3 = mysql_fetch_assoc($res3);
                                    //echo $soma;
                                    }
                                    echo "R$" .number_format($soma,2, ',','.');
                                }
                                                        
                                                    
                                                
                                    ?>
        
    </td>
    <td colspan="">&nbsp;<?php
    
                        $sql3 = "SELECT * FROM subitens2 WHERE id_item = $linha[id_itens]";
                        $res3 = mysql_query($sql3) or die("Erro seleção linha2");
                        $linha3 = mysql_fetch_assoc($res3);
                        $soma = 0;              
                        //if (empty($linha3[vunitcusto_si])){
                                if (isset($mensagem_custo)){
                                    echo "<strong>$mensagem_custo";
                                }
                                else{
                                $number = $linha[vofertado];
                                echo "R$" .number_format($number,2, ',','.');
                                }
                            /*else{

                                while($linha3){
                                    //$soma = 0;    
                                    $soma += "$linha3[vtotcusto_si]";
                                    //echo $soma;
                                    
                                    $linha3 = mysql_fetch_assoc($res3);
                                    
                                    //echo $soma;
                                    }
                                    echo "R$" .number_format($soma,2, ',','.');
                                }*/
                                                        
                                                    
                                                
                                    ?>
        
    </td>
    <td colspan="">
        <?php
                    $number = "$vfrete";
                    echo "R$" .number_format($number,2, ',','.')."</br>($linha[tipo_equip])"."$tipo_vfrete";
                    
                    //echo $linha[vofertado]
                    ?>
    </td>
    
    <td align="center">
            
            <a href="altera_itens2.php?alterar=<?php echo $linha[id_itens]; ?>&tipo_licitacao=<?php echo $_GET[tipo_licitacao]; ?>&pregao=<?php echo $_GET[pregao]; ?>&codigo=<?php echo $_GET[codigo]; ?>&lote=<?php echo $_GET[lote]; ?>&orgao=<?php echo $_GET[orgao]; ?>&data=<?php echo $_GET[data]; ?>&hora=<?php echo $_GET[hora]; ?>&licitante=<?php echo $_GET[licitante]; ?>&id_lote=<?php echo $_GET[id_lote]; ?>&id_itens=<?php echo $linha[id_itens]; ?>&id_cod=<?php echo $_GET[id_cod]; ?>"><img src="imagens/edit.png" border="0"/></a>
            <a href="conf_itens_exc2.php?apagar=<?php echo $linha[id_itens]; ?>&item=<?php echo $linha[item];?>&id_cod=<?php echo $_GET[id_cod];?>&id_lote=<?php echo $_GET[id_lote];?>"><img src="imagens/delete.png" border="0"/></a>
            <a href="selec_copia_subitens.php?&id_cod=<?php echo $_GET[id_cod];?>&codigo=<?php echo $linha_uf[codigo];?>&id_lote=<?php echo $_GET[id_lote];?>&id_item_novo=<?php echo $linha[id_itens];?>"><img src="imagens/ne.png" title="Copiar Subitens" border="0"/></a>
        </td>
        
    
        
    
</tr>


  
    
   
  <?php
//require "tab_cont_itens_tudo.php";
  
    //pega a próxima linha
    $linha = mysql_fetch_assoc($res);
    $vmo+=$vminofertar;
    $vmo2+=$vminofertar2;
    $vmo3+=$vminofertar3;
    $ca += $custo_aprox;    //incrementa a $v o campo valor
    $ll += $lucro_liq;    //incrementa a $v o campo valor
    
    
 
}


if(empty($_GET[order])) $_GET[order] = 'item';
$sql = "SELECT * FROM itens2 WHERE id_lote = {$_GET[id_lote]} order by {$_GET[order]}";
$res = mysql_query($sql) or die("Erro seleção");
$v = 0; //conterá a somatória dos valores
$c = 0; //total de registros
//pega a primeira linha do resultado
$linha = mysql_fetch_assoc($res);
?>

<tr>
        <td>
            <a href="selec_declaracoes.php?orgao=<?php echo $linha_uf[orgao];?>&id_cod=<?php echo $linha_uf[id_cod];?>&pregao=<?php echo $linha_uf[pregao];?>&codigo=<?php echo $linha_uf[codigo];?>&lote=<?php echo $linha_coloc[lote];?>" target="_blank">DECLARAÇÕES</a>
        </td>
        <td>
            <a href="selec_proposta.php?orgao=<?php echo $linha_uf[orgao];?>&id_cod=<?php echo $linha_uf[id_cod];?>&pregao=<?php echo $linha_uf[pregao];?>&codigo=<?php echo $linha_uf[codigo];?>&lote=<?php echo $linha_coloc[lote];?>&licitante=<?php echo $linha_uf[licitante];?>&id_itens=<?php echo $linha[id_itens];?>&id_lote=<?php echo $linha[id_lote];?>" target="_blank">PROPOSTA</a>
        </td>
        <td>
            <a href="selec_proposta_semid.php?orgao=<?php echo $linha_uf[orgao];?>&id_cod=<?php echo $linha_uf[id_cod];?>&pregao=<?php echo $linha_uf[pregao];?>&codigo=<?php echo $linha_uf[codigo];?>&lote=<?php echo $linha_coloc[lote];?>&licitante=<?php echo $linha_uf[licitante];?>&id_itens=<?php echo $linha[id_itens];?>&id_lote=<?php echo $linha[id_lote];?>" target="_blank">PROPOSTA SEM ID</a>
        </td>
        <td>
            <a href="selec_certidoes.php" target="_blank">CERTIDÕES</a>
        </td>
        <td>
            <a href="lancar_info_adicionais.php?orgao=<?php echo $linha_uf[orgao];?>&id_cod=<?php echo $linha_uf[id_cod];?>&pregao=<?php echo $linha_uf[pregao];?>&codigo=<?php echo $linha_uf[codigo];?>&lote=<?php echo $linha_coloc[lote];?>&licitante=<?php echo $linha_uf[licitante];?>&id_itens=<?php echo $linha[id_itens];?>&id_lote=<?php echo $linha[id_lote];?>" target="_blank">LANÇAR INF. ADICIONAIS</a>
        </td>
        <td colspan="12" align="center">
            <a href="prep_docs.php?orgao=<?php echo $linha_uf[orgao];?>&id_cod=<?php echo $linha_uf[id_cod];?>&pregao=<?php echo $linha_uf[pregao];?>&tipo_licitacao=<?php echo $linha_uf[tipo_licitacao];?>&data=<?php echo $linha_uf[data];?>&hora=<?php echo $linha_uf[hora];?>&codigo=<?php echo $linha_uf[codigo];?>&lote=<?php echo $linha_coloc[lote];?>&licitante=<?php echo $linha_uf[licitante];?>&id_itens=<?php echo $linha[id_itens];?>&id_lote=<?php echo $linha[id_lote];?>" target="_blank">PREPARAR PASTA E DOCUMENTOS</a>
        </td>
    </tr>
    <?php
                $sql="SELECT * FROM proposta WHERE id_lote='$linha_coloc[id_lote]'";
                $res=mysql_query($sql) or die("erro seleção proposta");
                $prop= mysql_fetch_assoc($res);
                
            ?>
 
    <tr>
        <td colspan="3">
            <center><b>PROPOSTAS GERADAS
        </td>
        <td>
            <?php
                if(isset($prop[validade_prop])){
                    echo "<center><b>SIM <a href='altera_proposta.php?orgao=$linha_uf[orgao]&id_cod=$linha_uf[id_cod]&pregao=$linha_uf[pregao]&codigo=$linha_uf[codigo]&lote=$linha_coloc[lote]&licitante=$linha_uf[licitante]&id_itens=$linha[id_itens]&id_lote=$linha[id_lote]'><img src=imagens/edit.png></a>";
                                        
                }
                else{
                    echo "<center><b>NÃO";
                }
                ?>
                
        </td>
        
    </tr>
  
    




<tr align="center">
      
      
       <tr>
        <td colspan="19">Total de itens: <?php echo $c ?></td>
        
    </tr>
    </table>
<?php


  
  
  
  





  
  
  ?>
  
  <table align="center" class="A" width="900" border="1" cellpadding="3" cellspacing="0">
      <br>  
    <tr>
        <th align="right"class="" colspan="0" scope="row">CUSTO APROXIMADO:</th>
        <!--<td>R$</td>
        <td>&nbsp;</td>
        <td>R$</td>
        <td>R$</td>-->
        <td align="right" class=""><?php
        if($linha_uf[tipo_licitacao]=="DL"){
                    $number = ($ca);
                    echo "R$" .number_format($number,2, ',','.');
                    $ca_final=$number;
                    }
                    else{
                    $number = ($ca+$vs+$vsedex);
                    echo "R$" .number_format($number,2, ',','.');
                    $ca_final=$number;
                    }
                    //echo $linha[vofertado]
                    ?>
        </td>
        <th align="right"class="" colspan="0" scope="row">VALOR GANHO/OFERTADO:</th>
    
    
    <!--<td align="right" class="greenyellow"><?php 
                //$number = "$vo";
                //echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?>
    </td>-->
    <td align="right" class=""><?php 
                $number = ($vo);
                echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?>
    </td>
    <th align="right" class="green2" colspan="0" scope="row">VALOR MÍNIMO A OFERTAR(17%):</th>
    
    <td align="right" class="green2"><?php
    if ((($vmo-$ca)>=$lucro_min_at_dl) and (($linha_uf[tipo_licitacao]=="DL") or ($linha_uf[tipo_licitacao]=="CC"))){
        $number = ($vmo);
        echo "R$" .number_format($number,2, ',','.');
        $vmo_final=$number;
    
                $sql_vmo = "SELECT * FROM lote_vmo WHERE id_lote = {$linha_coloc[id_lote]}";
                $res_vmo = mysql_query($sql_vmo) or die("Erro seleção");

                if (mysql_num_rows($res_vmo)){                    
                    $sql = "UPDATE lote_vmo SET lote_vmo1='{$vmo_final}'
                            WHERE id_lote='{$linha_coloc[id_lote]}'";
                }
                else{
                    $sql = "INSERT into lote_vmo (lote_vmo1,id_lote)
                       VALUES ( '{$vmo_final}','{$linha_coloc[id_lote]}' )";
                }
                //echo $sql;
                mysql_query($sql) or die("Erro gravando - vmo final!");
                

    }
        elseif ((($vmo-$ca)<$lucro_min_at_dl) and (($linha_uf[tipo_licitacao]=="DL") or ($linha_uf[tipo_licitacao]=="CC"))){
            $number = ($ca_final+$lucro_min_at_dl);
            echo "R$" .number_format($number,2, ',','.');
            $vmo_final=$number;
    
                $sql_vmo = "SELECT * FROM lote_vmo WHERE id_lote = {$linha_coloc[id_lote]}";
                $res_vmo = mysql_query($sql_vmo) or die("Erro seleção");

                if (mysql_num_rows($res_vmo)){                    
                    $sql = "UPDATE lote_vmo SET lote_vmo1='{$vmo_final}'
                            WHERE id_lote='{$linha_coloc[id_lote]}'";
                }
                else{
                    $sql = "INSERT into lote_vmo (lote_vmo1,id_lote)
                       VALUES ( '{$vmo_final}','{$linha_coloc[id_lote]}' )";
                }
                //echo $sql;
                mysql_query($sql) or die("Erro gravando - vmo final!");
                

    }
        elseif ((($vmo-$ca)>=$lucro_min_rp) and (($linha_uf[tipo_licitacao]=="RP"))){
            $number = ($vmo+$vs+$vsedex);
            echo "R$" .number_format($number,2, ',','.');
            $vmo_final=$number;
    
                $sql_vmo = "SELECT * FROM lote_vmo WHERE id_lote = {$linha_coloc[id_lote]}";
                $res_vmo = mysql_query($sql_vmo) or die("Erro seleção");

                if (mysql_num_rows($res_vmo)){                    
                    $sql = "UPDATE lote_vmo SET lote_vmo1='{$vmo_final}'
                            WHERE id_lote='{$linha_coloc[id_lote]}'";
                }
                else{
                    $sql = "INSERT into lote_vmo (lote_vmo1,id_lote)
                       VALUES ( '{$vmo_final}','{$linha_coloc[id_lote]}' )";
                }
                //echo $sql;
                mysql_query($sql) or die("Erro gravando - vmo final!");
                

    }
        elseif ((($vmo-$ca)<$lucro_min_rp) and (($linha_uf[tipo_licitacao]=="RP"))){
            $number = ($ca_final+$lucro_min_rp);
            echo "R$" .number_format($number,2, ',','.');
            $vmo_final=$number;
    
                $sql_vmo = "SELECT * FROM lote_vmo WHERE id_lote = {$linha_coloc[id_lote]}";
                $res_vmo = mysql_query($sql_vmo) or die("Erro seleção");

                if (mysql_num_rows($res_vmo)){                    
                    $sql = "UPDATE lote_vmo SET lote_vmo1='{$vmo_final}'
                            WHERE id_lote='{$linha_coloc[id_lote]}'";
                }
                else{
                    $sql = "INSERT into lote_vmo (lote_vmo1,id_lote)
                       VALUES ( '{$vmo_final}','{$linha_coloc[id_lote]}' )";
                }
                //echo $sql;
                mysql_query($sql) or die("Erro gravando - vmo final!");
                

    }
        elseif ((($vmo-$ca)>=$lucro_min_at_dl) and (($linha_uf[tipo_licitacao]=="AT"))){
            $number = ($vmo+$vs+$vsedex);
            echo "R$" .number_format($number,2, ',','.');
            $vmo_final=$number;
    
                $sql_vmo = "SELECT * FROM lote_vmo WHERE id_lote = {$linha_coloc[id_lote]}";
                $res_vmo = mysql_query($sql_vmo) or die("Erro seleção");

                if (mysql_num_rows($res_vmo)){                    
                    $sql = "UPDATE lote_vmo SET lote_vmo1='{$vmo_final}'
                            WHERE id_lote='{$linha_coloc[id_lote]}'";
                }
                else{
                    $sql = "INSERT into lote_vmo (lote_vmo1,id_lote)
                       VALUES ( '{$vmo_final}','{$linha_coloc[id_lote]}' )";
                }
                //echo $sql;
                mysql_query($sql) or die("Erro gravando - vmo final!");
                

    }
        elseif ((($vmo-$ca)<$lucro_min_at_dl) and (($linha_uf[tipo_licitacao]=="AT"))){
            $number = ($ca_final+$lucro_min_at_dl);
            echo "R$" .number_format($number,2, ',','.');
            $vmo_final=$number;
    
                $sql_vmo = "SELECT * FROM lote_vmo WHERE id_lote = {$linha_coloc[id_lote]}";
                $res_vmo = mysql_query($sql_vmo) or die("Erro seleção");

                if (mysql_num_rows($res_vmo)){                    
                    $sql = "UPDATE lote_vmo SET lote_vmo1='{$vmo_final}'
                            WHERE id_lote='{$linha_coloc[id_lote]}'";
                }
                else{
                    $sql = "INSERT into lote_vmo (lote_vmo1,id_lote)
                       VALUES ( '{$vmo_final}','{$linha_coloc[id_lote]}' )";
                }
                //echo $sql;
                mysql_query($sql) or die("Erro gravando - vmo final!");
                

    }

                ?>
    </td>
    
    
    </tr>
    <tr>
        <Td>
        <td>
        <td>
        <td>
    
     <th align="right" class="orange" colspan="0" scope="row">VALOR MÍNIMO A OFERTAR(13%):</th>
    
    <td align="right" class="orange"><?php
    if ((($vmo2-$ca)>=$lucro_min_at_dl) and (($linha_uf[tipo_licitacao]=="DL") or ($linha_uf[tipo_licitacao]=="CC"))){
        $number = ($vmo2);
        echo "R$" .number_format($number,2, ',','.');
        $vmo_final=$number;
    
                $sql_vmo = "SELECT * FROM lote_vmo WHERE id_lote = {$linha_coloc[id_lote]}";
                $res_vmo = mysql_query($sql_vmo) or die("Erro seleção");

                if (mysql_num_rows($res_vmo)){                    
                    $sql = "UPDATE lote_vmo SET lote_vmo2='{$vmo_final}'
                            WHERE id_lote='{$linha_coloc[id_lote]}'";
                }
                else{
                    $sql = "INSERT into lote_vmo (lote_vmo2,id_lote)
                       VALUES ( '{$vmo_final}','{$linha_coloc[id_lote]}' )";
                }
                //echo $sql;
                mysql_query($sql) or die("Erro gravando - vmo final!");
                

    }
        elseif ((($vmo2-$ca)<$lucro_min_at_dl) and (($linha_uf[tipo_licitacao]=="DL") or ($linha_uf[tipo_licitacao]=="CC"))){
            $number = ($ca_final+$lucro_min_at_dl);
            echo "R$" .number_format($number,2, ',','.');
            $vmo_final=$number;
    
                $sql_vmo = "SELECT * FROM lote_vmo WHERE id_lote = {$linha_coloc[id_lote]}";
                $res_vmo = mysql_query($sql_vmo) or die("Erro seleção");

                if (mysql_num_rows($res_vmo)){                    
                    $sql = "UPDATE lote_vmo SET lote_vmo2='{$vmo_final}'
                            WHERE id_lote='{$linha_coloc[id_lote]}'";
                }
                else{
                    $sql = "INSERT into lote_vmo (lote_vmo2,id_lote)
                       VALUES ( '{$vmo_final}','{$linha_coloc[id_lote]}' )";
                }
                //echo $sql;
                mysql_query($sql) or die("Erro gravando - vmo final!");
                

    }
        elseif ((($vmo2-$ca)>=$lucro_min_rp) and (($linha_uf[tipo_licitacao]=="RP"))){
            $number = ($vmo2+$vs+$vsedex);
            echo "R$" .number_format($number,2, ',','.');
            $vmo_final=$number;
    
                $sql_vmo = "SELECT * FROM lote_vmo WHERE id_lote = {$linha_coloc[id_lote]}";
                $res_vmo = mysql_query($sql_vmo) or die("Erro seleção");

                if (mysql_num_rows($res_vmo)){                    
                    $sql = "UPDATE lote_vmo SET lote_vmo2='{$vmo_final}'
                            WHERE id_lote='{$linha_coloc[id_lote]}'";
                }
                else{
                    $sql = "INSERT into lote_vmo (lote_vmo2,id_lote)
                       VALUES ( '{$vmo_final}','{$linha_coloc[id_lote]}' )";
                }
                //echo $sql;
                mysql_query($sql) or die("Erro gravando - vmo final!");
                

    }
        elseif ((($vmo2-$ca)<$lucro_min_rp) and (($linha_uf[tipo_licitacao]=="RP"))){
            $number = ($ca_final+$lucro_min_rp);
            echo "R$" .number_format($number,2, ',','.');
            $vmo_final=$number;
    
                $sql_vmo = "SELECT * FROM lote_vmo WHERE id_lote = {$linha_coloc[id_lote]}";
                $res_vmo = mysql_query($sql_vmo) or die("Erro seleção");

                if (mysql_num_rows($res_vmo)){                    
                    $sql = "UPDATE lote_vmo SET lote_vmo2='{$vmo_final}'
                            WHERE id_lote='{$linha_coloc[id_lote]}'";
                }
                else{
                    $sql = "INSERT into lote_vmo (lote_vmo2,id_lote)
                       VALUES ( '{$vmo_final}','{$linha_coloc[id_lote]}' )";
                }
                //echo $sql;
                mysql_query($sql) or die("Erro gravando - vmo final!");
                

    }
        elseif ((($vmo2-$ca)>=$lucro_min_at_dl) and (($linha_uf[tipo_licitacao]=="AT"))){
            $number = ($vmo2+$vs+$vsedex);
            echo "R$" .number_format($number,2, ',','.');
            $vmo_final=$number;
    
                $sql_vmo = "SELECT * FROM lote_vmo WHERE id_lote = {$linha_coloc[id_lote]}";
                $res_vmo = mysql_query($sql_vmo) or die("Erro seleção");

                if (mysql_num_rows($res_vmo)){                    
                    $sql = "UPDATE lote_vmo SET lote_vmo2='{$vmo_final}'
                            WHERE id_lote='{$linha_coloc[id_lote]}'";
                }
                else{
                    $sql = "INSERT into lote_vmo (lote_vmo2,id_lote)
                       VALUES ( '{$vmo_final}','{$linha_coloc[id_lote]}' )";
                }
                //echo $sql;
                mysql_query($sql) or die("Erro gravando - vmo final!");
                

    }
        elseif ((($vmo2-$ca)<$lucro_min_at_dl) and (($linha_uf[tipo_licitacao]=="AT"))){
            $number = ($ca_final+$lucro_min_at_dl);
            echo "R$" .number_format($number,2, ',','.');
            $vmo_final=$number;
    
                $sql_vmo = "SELECT * FROM lote_vmo WHERE id_lote = {$linha_coloc[id_lote]}";
                $res_vmo = mysql_query($sql_vmo) or die("Erro seleção");

                if (mysql_num_rows($res_vmo)){                    
                    $sql = "UPDATE lote_vmo SET lote_vmo2='{$vmo_final}'
                            WHERE id_lote='{$linha_coloc[id_lote]}'";
                }
                else{
                    $sql = "INSERT into lote_vmo (lote_vmo2,id_lote)
                       VALUES ( '{$vmo_final}','{$linha_coloc[id_lote]}' )";
                }
                //echo $sql;
                mysql_query($sql) or die("Erro gravando - vmo final!");
                

    }

                ?>
    </td>
    
    
    </tr>
    
    <tr>
        <Td>
        <td>
        <td>
        <td>
    
     <th align="right" class="red" colspan="0" scope="row">VALOR MÍNIMO A OFERTAR(10%):</th>
    
    <td align="right" class="red"><?php
    if ((($vmo3-$ca)>=$lucro_min_at_dl) and (($linha_uf[tipo_licitacao]=="DL") or ($linha_uf[tipo_licitacao]=="CC"))){
        $number = ($vmo3);
        echo "R$" .number_format($number,2, ',','.');
        $vmo_final=$number;
    
                $sql_vmo = "SELECT * FROM lote_vmo WHERE id_lote = {$linha_coloc[id_lote]}";
                $res_vmo = mysql_query($sql_vmo) or die("Erro seleção");

                if (mysql_num_rows($res_vmo)){                    
                    $sql = "UPDATE lote_vmo SET lote_vmo3='{$vmo_final}'
                            WHERE id_lote='{$linha_coloc[id_lote]}'";
                }
                else{
                    $sql = "INSERT into lote_vmo (lote_vmo3,id_lote)
                       VALUES ( '{$vmo_final}','{$linha_coloc[id_lote]}' )";
                }
                //echo $sql;
                mysql_query($sql) or die("Erro gravando - vmo final!");
                

    }
        elseif ((($vmo3-$ca)<$lucro_min_at_dl) and (($linha_uf[tipo_licitacao]=="DL") or ($linha_uf[tipo_licitacao]=="CC"))){
            $number = ($ca_final+$lucro_min_at_dl);
            echo "R$" .number_format($number,2, ',','.');
            $vmo_final=$number;
    
                $sql_vmo = "SELECT * FROM lote_vmo WHERE id_lote = {$linha_coloc[id_lote]}";
                $res_vmo = mysql_query($sql_vmo) or die("Erro seleção");

                if (mysql_num_rows($res_vmo)){                    
                    $sql = "UPDATE lote_vmo SET lote_vmo3='{$vmo_final}'
                            WHERE id_lote='{$linha_coloc[id_lote]}'";
                }
                else{
                    $sql = "INSERT into lote_vmo (lote_vmo3,id_lote)
                       VALUES ( '{$vmo_final}','{$linha_coloc[id_lote]}' )";
                }
                //echo $sql;
                mysql_query($sql) or die("Erro gravando - vmo final!");
                

    }
        elseif ((($vmo3-$ca)>=$lucro_min_rp) and (($linha_uf[tipo_licitacao]=="RP"))){
            $number = ($vmo3+$vs+$vsedex);
            echo "R$" .number_format($number,2, ',','.');
            $vmo_final=$number;
    
                $sql_vmo = "SELECT * FROM lote_vmo WHERE id_lote = {$linha_coloc[id_lote]}";
                $res_vmo = mysql_query($sql_vmo) or die("Erro seleção");

                if (mysql_num_rows($res_vmo)){                    
                    $sql = "UPDATE lote_vmo SET lote_vmo3='{$vmo_final}'
                            WHERE id_lote='{$linha_coloc[id_lote]}'";
                }
                else{
                    $sql = "INSERT into lote_vmo (lote_vmo3,id_lote)
                       VALUES ( '{$vmo_final}','{$linha_coloc[id_lote]}' )";
                }
                //echo $sql;
                mysql_query($sql) or die("Erro gravando - vmo final!");
                

    }
        elseif ((($vmo3-$ca)<$lucro_min_rp) and (($linha_uf[tipo_licitacao]=="RP"))){
            $number = ($ca_final+$lucro_min_rp);
            echo "R$" .number_format($number,2, ',','.');
            $vmo_final=$number;
    
                $sql_vmo = "SELECT * FROM lote_vmo WHERE id_lote = {$linha_coloc[id_lote]}";
                $res_vmo = mysql_query($sql_vmo) or die("Erro seleção");

                if (mysql_num_rows($res_vmo)){                    
                    $sql = "UPDATE lote_vmo SET lote_vmo3='{$vmo_final}'
                            WHERE id_lote='{$linha_coloc[id_lote]}'";
                }
                else{
                    $sql = "INSERT into lote_vmo (lote_vmo3,id_lote)
                       VALUES ( '{$vmo_final}','{$linha_coloc[id_lote]}' )";
                }
                //echo $sql;
                mysql_query($sql) or die("Erro gravando - vmo final!");
                

    }
        elseif ((($vmo3-$ca)>=$lucro_min_at_dl) and (($linha_uf[tipo_licitacao]=="AT"))){
            $number = ($vmo3+$vs+$vsedex);
            echo "R$" .number_format($number,2, ',','.');
            $vmo_final=$number;
    
                $sql_vmo = "SELECT * FROM lote_vmo WHERE id_lote = {$linha_coloc[id_lote]}";
                $res_vmo = mysql_query($sql_vmo) or die("Erro seleção");

                if (mysql_num_rows($res_vmo)){                    
                    $sql = "UPDATE lote_vmo SET lote_vmo3='{$vmo_final}'
                            WHERE id_lote='{$linha_coloc[id_lote]}'";
                }
                else{
                    $sql = "INSERT into lote_vmo (lote_vmo3,id_lote)
                       VALUES ( '{$vmo_final}','{$linha_coloc[id_lote]}' )";
                }
                //echo $sql;
                mysql_query($sql) or die("Erro gravando - vmo final!");
                

    }
        elseif ((($vmo3-$ca)<$lucro_min_at_dl) and (($linha_uf[tipo_licitacao]=="AT"))){
            $number = ($ca_final+$lucro_min_at_dl);
            echo "R$" .number_format($number,2, ',','.');
            $vmo_final=$number;
    
                $sql_vmo = "SELECT * FROM lote_vmo WHERE id_lote = {$linha_coloc[id_lote]}";
                $res_vmo = mysql_query($sql_vmo) or die("Erro seleção");

                if (mysql_num_rows($res_vmo)){                    
                    $sql = "UPDATE lote_vmo SET lote_vmo3='{$vmo_final}'
                            WHERE id_lote='{$linha_coloc[id_lote]}'";
                }
                else{
                    $sql = "INSERT into lote_vmo (lote_vmo3,id_lote)
                       VALUES ( '{$vmo_final}','{$linha_coloc[id_lote]}' )";
                }
                //echo $sql;
                mysql_query($sql) or die("Erro gravando - vmo final!");
                

    }

                ?>
    </td>
    
    
    </tr>
    
    <tr>
        <td colspan="2"><b><font color="red">Diferencial Aliquota(60%) para
                            <?php
                            echo substr($linha_uf[uf],-2); echo " - ";
                            $number_difaliq = $vo*$difaliq/100;
                            echo "R$" .number_format($number_difaliq,2, ',','.'); 
                                   
                                    ?>
            
        </td>
        
        <th align="right"class="" colspan="0" scope="row">Lucro Líquido-VO:</th>
    
        <td align="right" class="">
                <?php
                    //if ($ll == 400 or > 400){ 
                     //   $number = $vo;
                
                       // elseif ($ll < 400){
                if($linha_uf[tipo_licitacao]=="DL"){
                            $number = ($vo-$ca);
                
                    echo "R$" .number_format($number,2, ',','.');
                    $lucrovo=$number = ($vo-$ca);
                    //if (empty($linha[lucro_liquido]) or ($linha[lucro_liquido]=="0")){
                    $sql = "UPDATE itens2 SET lucro_liquido='{$number}'
                WHERE id_itens='{$linha[id_itens]}'";
                    mysql_query($sql) or die("Erro gravando - lucro_liquido");
                //echo $linha[vofertado]
                //}
                }
                else{
                      $number = ($vo-$ca-$vs-$vsedex);
                      $lucrovo=$number = ($vo-$ca-$vs-$vsedex);
                
                
                        //}
                   // }
                    echo "R$" .number_format($number,2, ',','.');
                    //if (empty($linha[lucro_liquido]) or ($linha[lucro_liquido]=="0")){
                    $sql = "UPDATE itens2 SET lucro_liquido='{$number}'
                WHERE id_itens='{$linha[id_itens]}'";
                    mysql_query($sql) or die("Erro gravando - lucro_liquido");
                //echo $linha[vofertado]
                //}
                }
                
                ?>
    </td>
              <th align="right"class="" colspan="0" scope="row">Lucro Líquido-VM:</th>
    
    <td align="right" class="">
                <?php
                    /*echo "$vmo<br>";
                    echo "$vmo_final<br>";
                    echo "$ca<br>";*/
                    echo "R$" .number_format(($vmo_final-$ca_final),2, ',','.');

                ?>
    </td>
    
        
    </tr>
    <tr>
        <td colspan="2"><b><font color="red">Diferencial Aliquota(40%) para
                            <?php
                            echo PR; echo " - ";
                            $number_difaliqor = $vo*($difaliq-2)/100;
                            echo "R$" .number_format($number_difaliqor,2, ',','.'); 
                                   
                                    ?>
            
        </td>
        
        <th align="right"class="" colspan="0" scope="row">Margem % VO:</th>
    
        <td align="right" class="">
                <?php
                    /*echo "$vmo<br>";
                    echo "$vmo_final<br>";
                    echo "$ca<br>";*/
                    $porcvo=($lucrovo*100)/$vo;
                    echo number_format($porcvo,2, ',','.')."%";

                ?>
    </td>
              <th align="right"class="" colspan="0" scope="row">Margem % VM:</th>
    
    <td align="right" class="">
                <?php
                    /*echo "$vmo<br>";
                    echo "$vmo_final<br>";
                    echo "$ca<br>";*/
                    $lucrovm=($vmo_final-$ca_final);
                    $porcvm=($lucrovm*100)/$vmo_final;
                    echo number_format($porcvm,2, ',','.')."%";

                ?>
    </td>
    
        
    </tr>
    
    
        
      
</table>
  
<!--
<table align="center" class="A" width="900" border="1" cellpadding="3" cellspacing="0">
      <br>  
    <tr>
        <th align="right"class="" colspan="0" scope="row">ITEM</th>
        <th align="right"class="" colspan="0" scope="row">QTDE</th>
        <th align="right"class="" colspan="0" scope="row">MIN. ITEM</th>
        <th align="right"class="" colspan="0" scope="row">MIN. TOTAL</th>
    </TR>
    
    
    <tr>
        
        <td>&nbsp;<?php echo $linha[item] ?></td>
        <td>&nbsp;<?php echo $linha[qtde] ?></td>
        <td>&nbsp;<?php echo $linha[qtde] ?></td>
        
    </tr>
    
    
        
      
</table>-->


  </table>
  <br><br>
</table>

