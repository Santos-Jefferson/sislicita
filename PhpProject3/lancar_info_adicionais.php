<?php


//session_start();
require "conecta.php";
require_once "cabecalho_reduzido.php";
//require_once "cabecalho_lote.php";
include "css.php";
include "constantes.php";

$sql = "SELECT * FROM itens WHERE id_lote = {$_REQUEST[id_lote]}";
$res = mysql_query($sql) or die("Erro seleção itens e lote - frete");
$v = 0; //conterá a somatória dos valores
$c = 0; //total de registros
//pega a primeira linha do resultado
$linha = mysql_fetch_assoc($res);

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
        
  
  
  <table align="center" class="A" width="1000" border="1" cellpadding="3" cellspacing="0">
      <br>
<tr align="center" class="forms">
    <th width="20" >Item</th>
    <th width="20" >Qtde</th>
    <th colspan="6" >Descrição dos itens</th>
    
</tr>      
      
      
<?php


      
      
      

//enquanto houver linha
$vmo=0;            
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
                                    (($vf_pac>=0) and ($vf_pac<=1))){
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
                                    (($vf_pac>=0) and ($vf_pac<=1))){
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
                                    (($vf_pac>=0) and ($vf_pac<=1))){
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
                                    (($vf_pac>=0) and ($vf_pac<=1))){
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
                                    (($vf_pac>=0) and ($vf_pac<=1))){
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
                                    (($vf_pac>=0) and ($vf_pac<=1))){
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
                                    (($vf_pac>=0) and ($vf_pac<1))){
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
                                    (($vf_pac>=0) and ($vf_pac<=1))){
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
                                    (($vf_pac>=0) and ($vf_pac<=1))){
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
                                    (($vf_pac>=0) and ($vf_pac<=1))){
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
                                    (($vf>=0) and ($vf<=30))){
                                        $vf_final = ((80.50 + 3.66 + 2.67)+($linha[vofertado]*0.5/100)+($linha[vofertado]*0.3/100));
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
                                                $vf_final = ((100.63 + 3.66 + 2.67)+($linha[vofertado]*0.5/100)+($linha[vofertado]*0.3/100));
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
                                                $vf_final = ((120.75 + 3.66 + 2.67)+($linha[vofertado]*0.5/100)+($linha[vofertado]*0.3/100));
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
                                                $vf_final = ((($vf*0.805) + 3.66 + 2.67)+($linha[vofertado]*0.5/100)+($linha[vofertado]*0.3/100));
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
                                    (($vf>=0) and ($vf<=30))){
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
                                               $vf_final = ((52.90+((($vf-100)*0.44) + 3.66 + 2.67)+($linha[vofertado]*0.20/100)+($linha[vofertado]*0.15/100)+($linha[vofertado]*0.15/100))*1.088);
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
                                    (($vf>=0) and ($vf<30))){
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
            
if (($linha_uf[uf]=="Ceará - CE")or($linha_uf[uf]=="Mato Grosso do Sul - MS")or($linha_uf[uf]=="Mato Grosso - MT")){
    $porc_ceara=10;
    }
    else{
        $porc_ceara=0;
        }            
            
$vimposto=($linha[vofertado]*($porc_sn+$linha_uf[perc_icms]+$porc_ceara)/100);

       
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
    <td colspan="6" align="left">&nbsp;<?php
    
    
                            $sql2 = "SELECT * FROM subitens2 WHERE id_item = $linha[id_itens] order by id_subitem";
                            $res2 = mysql_query($sql2) or die("Erro seleção linha2");
                            $linha2 = mysql_fetch_assoc($res2);
                            
                            if (empty($linha2[id_subitem])) 
                                echo "$linha[nome_item] MARCA: $linha[marca_item] / MODELO: $linha[modelo_item] / $linha[produto]<br>";
                            else{
                            
                                while($linha2){
                            
                                    echo "$linha2[qtde_si]-$linha2[nome_subitem] MARCA: $linha2[marca_si] / MODELO: $linha2[modelo_si]<br>";
                                    
                                    $linha2 = mysql_fetch_assoc($res2);
                                    }
                            }
                            
                 //echo $vf;  
                 
                                    ?>
    </td>
                            
    
    
        
    
        
    
</tr>


  
    
   
  <?php
//require "tab_cont_itens_tudo.php";
  
    //pega a próxima linha
    $linha = mysql_fetch_assoc($res);
    $vmo+=$vminofertar;
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
    <th align="right" class="yellow" colspan="0" scope="row">VALOR MÍNIMO A OFERTAR:</th>
    
    <td align="right" class="yellow"><?php
    if ((($vmo-$ca)>=$lucro_min_at_dl) and (($linha_uf[tipo_licitacao]=="DL") or ($linha_uf[tipo_licitacao]=="CC"))){
        $number = ($vmo);
        echo "R$" .number_format($number,2, ',','.');
        $vmo_final=$number;
        }
        elseif ((($vmo-$ca)<$lucro_min_at_dl) and (($linha_uf[tipo_licitacao]=="DL") or ($linha_uf[tipo_licitacao]=="CC"))){
            $number = ($ca_final+$lucro_min_at_dl);
            echo "R$" .number_format($number,2, ',','.');
            $vmo_final=$number;            
            }
        elseif ((($vmo-$ca)>=$lucro_min_rp) and (($linha_uf[tipo_licitacao]=="RP"))){
            $number = ($vmo+$vs+$vsedex);
            echo "R$" .number_format($number,2, ',','.');
            $vmo_final=$number;
            }
        elseif ((($vmo-$ca)<$lucro_min_rp) and (($linha_uf[tipo_licitacao]=="RP"))){
            $number = ($ca_final+$lucro_min_rp);
            echo "R$" .number_format($number,2, ',','.');
            $vmo_final=$number;
            }
        elseif ((($vmo-$ca)>=$lucro_min_at_dl) and (($linha_uf[tipo_licitacao]=="AT"))){
            $number = ($vmo+$vs+$vsedex);
            echo "R$" .number_format($number,2, ',','.');
            $vmo_final=$number;
            }
        elseif ((($vmo-$ca)<$lucro_min_at_dl) and (($linha_uf[tipo_licitacao]=="AT"))){
            $number = ($ca_final+$lucro_min_at_dl);
            echo "R$" .number_format($number,2, ',','.');
            $vmo_final=$number;
            }

                ?>
    </td>
    </tr>
    <tr>
        <td colspan="2">
            
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
                    //if (empty($linha[lucro_liquido]) or ($linha[lucro_liquido]=="0")){
                    $sql = "UPDATE itens2 SET lucro_liquido='{$number}'
                WHERE id_itens='{$linha[id_itens]}'";
                    mysql_query($sql) or die("Erro gravando - lucro_liquido");
                //echo $linha[vofertado]
                //}
                }
                else{
                      $number = ($vo-$ca-$vs-$vsedex);
                
                
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
                
                    /*
                    if ((($linha_uf[tipo_licitacao]=="AT") or ($linha_uf[tipo_licitacao]=="DL") or ($linha_uf[tipo_licitacao]=="CC")) and ((($vmo-$ca)>=300))){
                        $number = ($vmo-$ca);
                        echo "R$" .number_format($number,2, ',','.');
                        }
                        elseif (($linha_uf[tipo_licitacao]=="RP") and ((($vmo-$ca)>=1200))){
                            $number = ($vmo-$ca);
                            echo "R$" .number_format($number,2, ',','.');
                            }
                        elseif ((($linha_uf[tipo_licitacao]=="AT") or ($linha_uf[tipo_licitacao]=="DL") or ($linha_uf[tipo_licitacao]=="CC")) and ((($vmo-$ca)<300))){
                            $number = ($vmo-$ca);
                            echo "R$" .number_format($lucro_min_at_dl,2, ',','.');
                        }
                        elseif (($linha_uf[tipo_licitacao]=="RP") and ((($vmo-$ca)<1200))){
                            $number = ($vmo-$ca);
                            echo "R$" .number_format($lucro_min_rp,2, ',','.');
                            }*/
                        
                  
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
