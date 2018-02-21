<?php
//session_start();
require "conecta.php";
include "css.php";
include "constantes.php";

$sql_uf = "SELECT * FROM codigo WHERE id_cod = {$linha[id_cod]}";

$res_uf = mysql_query($sql_uf) or die("Erro seleção UF");

//pega a primeira linha do resultado
$linha_uf = mysql_fetch_assoc($res_uf);

echo "$linha_uf[uf]";

//print_r ($_REQUEST);
// se o GET[order] for vazio, então será preenchido com um valor padrão
if(empty($_GET[order])) $_GET[order] = 'item';
    
$sql = "SELECT * FROM itens2 WHERE id_lote = {$linha[id_lote]} order by {$_GET[order]}";

$res = mysql_query($sql) or die("Erro seleção linha");

$v = 0; //conterá a somatória dos valores
$c = 0; //total de registros

//pega a primeira linha do resultado
$linha4= mysql_fetch_assoc($res);





$sql_coloc = "SELECT * FROM lote WHERE id_lote = {$linha4[id_lote]}";

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
      

//enquanto houver linha
$vmo=0;            
$vmo2=0;            
$vmo3=0;            
while($linha){
    
//echo "$linha4[vofertado];</br>";
    
    
                             
                        $sql_te = "SELECT * FROM frete_medidas WHERE tipo_equip='$linha4[tipo_equip]'";
                        $res_te = mysql_query($sql_te) or die("Erro seleção frete_medidas");
                        $linha_te = mysql_fetch_assoc($res_te);
                        
                        //TRANSPORTADORAS - calculo do valor cubado, retirado das medias aproximadas do material cotado
                        $valor_cubado=($linha4[qtde]*$linha_te[alt_equip]*$linha_te[larg_equip]*$linha_te[comp_equip])*300;
                        $valor_real=$linha4[qtde]*$linha_te[peso_equip];
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
                        $valor_cubado_pac=($linha4[qtde]*$linha_te[alt_equip]*$linha_te[larg_equip]*$linha_te[comp_equip])/0.006;
                        $valor_real_pac=$linha4[qtde]*$linha_te[peso_equip];
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
                                        $vf_final_pac = ((8.37)+($linha4[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Paraná - PR")) and
                                    (($vf_pac>1) and ($vf_pac<=5))){
                                        $vf_final_pac = ((12.58)+($linha4[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Paraná - PR")) and
                                    (($vf_pac>5) and ($vf_pac<=10))){
                                        $vf_final_pac = ((15.46)+($linha4[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Paraná - PR")) and
                                    (($vf_pac>=10) and ($vf_pac<=20))){
                                        $vf_final_pac = ((21.98)+($linha4[vofertado]*1/100));
                                        }
                        elseif ((($linha_uf[uf]=="Paraná - PR")) and
                                    (($vf_pac>20) and ($vf_pac<=30))){
                                        $vf_final_pac = ((30.04)+($linha4[vofertado]*1/100));
                                        }
                         elseif ((($linha_uf[uf]=="Paraná - PR")) and
                                    (($vf_pac>30))){
                                        $vf_final_pac = (30.04+((($vf_final_pac-30)/5)*4.77)+($linha4[vofertado]*1/100));
                                        }
                                        //echo $vf_final_pac;
                                        
//CALCULO FRETE - BASE CORREIOS
                          //CALCULO FAIXA 1 - FRETE SISLICITA - TABELA CORREIOS ABRIL 2012.
                        if      ((($linha_uf[uf]=="São Paulo - SP") or
                                 ($linha_uf[uf]=="Santa Catarina - SC") or
                                 ($linha_uf[uf]=="Rio Grande do Sul - RS")) and
                                    (($vf_pac>=0) and ($vf_pac<=1))){
                                        $vf_final_pac = ((10.82)+($linha4[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="São Paulo - SP") or
                                 ($linha_uf[uf]=="Santa Catarina - SC") or
                                 ($linha_uf[uf]=="Rio Grande do Sul - RS")) and
                                    (($vf_pac>1) and ($vf_pac<=5))){
                                        $vf_final_pac = ((16.24)+($linha4[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="São Paulo - SP") or
                                 ($linha_uf[uf]=="Santa Catarina - SC") or
                                 ($linha_uf[uf]=="Rio Grande do Sul - RS")) and
                                    (($vf_pac>5) and ($vf_pac<=10))){
                                        $vf_final_pac = ((23.46)+($linha4[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="São Paulo - SP") or
                                 ($linha_uf[uf]=="Santa Catarina - SC") or
                                 ($linha_uf[uf]=="Rio Grande do Sul - RS")) and
                                    (($vf_pac>10) and ($vf_pac<=20))){
                                        $vf_final_pac = ((38.84)+($linha4[vofertado]*1/100));
                                        }
                        elseif ((($linha_uf[uf]=="São Paulo - SP") or
                                 ($linha_uf[uf]=="Santa Catarina - SC") or
                                 ($linha_uf[uf]=="Rio Grande do Sul - RS")) and
                                    (($vf_pac>20) and ($vf_pac<=30))){
                                        $vf_final_pac = ((55.70)+($linha4[vofertado]*1/100));
                                        }
                         elseif ((($linha_uf[uf]=="São Paulo - SP") or
                                 ($linha_uf[uf]=="Santa Catarina - SC") or
                                 ($linha_uf[uf]=="Rio Grande do Sul - RS")) and
                                    (($vf_pac>=30))){
                                        $vf_final_pac = (55.70+((($vf_final_pac-30)/5)*8.86)+($linha4[vofertado]*1/100));
                                        }
                                        //echo $vf_final_pac; 
                                        
//CALCULO FRETE - BASE CORREIOS
                          //CALCULO FAIXA 2 - FRETE SISLICITA - TABELA CORREIOS ABRIL 2012.
                        if      ((($linha_uf[uf]=="Minas Gerais - MG") or
                                 ($linha_uf[uf]=="Mato Grosso do Sul - MS") or
                                 ($linha_uf[uf]=="Rio de Janeiro - RJ")) and
                                    (($vf_pac>=0) and ($vf_pac<=1))){
                                        $vf_final_pac = ((12.02)+($linha4[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Minas Gerais - MG") or
                                 ($linha_uf[uf]=="Mato Grosso do Sul - MS") or
                                 ($linha_uf[uf]=="Rio de Janeiro - RJ")) and
                                    (($vf_pac>1) and ($vf_pac<=5))){
                                        $vf_final_pac = ((18.06)+($linha4[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Minas Gerais - MG") or
                                 ($linha_uf[uf]=="Mato Grosso do Sul - MS") or
                                 ($linha_uf[uf]=="Rio de Janeiro - RJ")) and
                                    (($vf_pac>5) and ($vf_pac<=10))){
                                        $vf_final_pac = ((27.42)+($linha4[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Minas Gerais - MG") or
                                 ($linha_uf[uf]=="Mato Grosso do Sul - MS") or
                                 ($linha_uf[uf]=="Rio de Janeiro - RJ")) and
                                    (($vf_pac>10) and ($vf_pac<=20))){
                                        $vf_final_pac = ((46.82)+($linha4[vofertado]*1/100));
                                        }
                        elseif ((($linha_uf[uf]=="Minas Gerais - MG") or
                                 ($linha_uf[uf]=="Mato Grosso do Sul - MS") or
                                 ($linha_uf[uf]=="Rio de Janeiro - RJ")) and
                                    (($vf_pac>20) and ($vf_pac<=30))){
                                        $vf_final_pac = ((67.55)+($linha4[vofertado]*1/100));
                                        }
                         elseif ((($linha_uf[uf]=="Minas Gerais - MG") or
                                 ($linha_uf[uf]=="Mato Grosso do Sul - MS") or
                                 ($linha_uf[uf]=="Rio de Janeiro - RJ")) and
                                    (($vf_pac>=30))){
                                        $vf_final_pac = (67.55+((($vf_final_pac-30)/5)*10.70)+($linha4[vofertado]*1/100));
                                        }
                                        //echo $vf_final_pac;    
                                        
//CALCULO FRETE - BASE CORREIOS
                          //CALCULO FAIXA 3 - FRETE SISLICITA - TABELA CORREIOS ABRIL 2012.
                        if      ((($linha_uf[uf]=="Distrito Federal - DF") or
                                 ($linha_uf[uf]=="Espírito Santo - ES") or
                                 ($linha_uf[uf]=="Mato Grosso - MT")) and
                                    (($vf_pac>=0) and ($vf_pac<=1))){
                                        $vf_final_pac = ((13.32)+($linha4[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Distrito Federal - DF") or
                                 ($linha_uf[uf]=="Espírito Santo - ES") or
                                 ($linha_uf[uf]=="Mato Grosso - MT")) and
                                    (($vf_pac>1) and ($vf_pac<=5))){
                                        $vf_final_pac = ((20.01)+($linha4[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Distrito Federal - DF") or
                                 ($linha_uf[uf]=="Espírito Santo - ES") or
                                 ($linha_uf[uf]=="Mato Grosso - MT")) and
                                    (($vf_pac>5) and ($vf_pac<=10))){
                                        $vf_final_pac = ((30.39)+($linha4[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Distrito Federal - DF") or
                                 ($linha_uf[uf]=="Espírito Santo - ES") or
                                 ($linha_uf[uf]=="Mato Grosso - MT")) and
                                    (($vf_pac>10) and ($vf_pac<=20))){
                                        $vf_final_pac = ((51.89)+($linha4[vofertado]*1/100));
                                        }
                        elseif ((($linha_uf[uf]=="Distrito Federal - DF") or
                                 ($linha_uf[uf]=="Espírito Santo - ES") or
                                 ($linha_uf[uf]=="Mato Grosso - MT")) and
                                    (($vf_pac>20) and ($vf_pac<=30))){
                                        $vf_final_pac = ((74.86)+($linha4[vofertado]*1/100));
                                        }
                         elseif ((($linha_uf[uf]=="Distrito Federal - DF") or
                                 ($linha_uf[uf]=="Espírito Santo - ES") or
                                 ($linha_uf[uf]=="Mato Grosso - MT")) and
                                    (($vf_pac>=30))){
                                        $vf_final_pac = (74.86+((($vf_final_pac-30)/5)*11.86)+($linha4[vofertado]*1/100));
                                        }
                                        //echo $vf_final_pac; 
                                        
                                        
//CALCULO FRETE - BASE CORREIOS
                          //CALCULO FAIXA 4 - FRETE SISLICITA - TABELA CORREIOS ABRIL 2012.
                        if      ((($linha_uf[uf]=="Goiás - GO") or
                                 ($linha_uf[uf]=="Tocantins - TO")) and
                                    (($vf_pac>=0) and ($vf_pac<=1))){
                                        $vf_final_pac = ((14.74)+($linha4[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Goiás - GO") or
                                 ($linha_uf[uf]=="Tocantins - TO")) and
                                    (($vf_pac>1) and ($vf_pac<=5))){
                                        $vf_final_pac = ((22.19)+($linha4[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Goiás - GO") or
                                 ($linha_uf[uf]=="Tocantins - TO")) and
                                    (($vf_pac>5) and ($vf_pac<=10))){
                                        $vf_final_pac = ((36.37)+($linha4[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Goiás - GO") or
                                 ($linha_uf[uf]=="Tocantins - TO")) and
                                    (($vf_pac>10) and ($vf_pac<=20))){
                                        $vf_final_pac = ((65.34)+($linha4[vofertado]*1/100));
                                        }
                        elseif ((($linha_uf[uf]=="Goiás - GO") or
                                 ($linha_uf[uf]=="Tocantins - TO")) and
                                    (($vf_pac>20) and ($vf_pac<=30))){
                                        $vf_final_pac = ((94.92)+($linha4[vofertado]*1/100));
                                        }
                         elseif ((($linha_uf[uf]=="Goiás - GO") or
                                 ($linha_uf[uf]=="Tocantins - TO")) and
                                    (($vf_pac>=30))){
                                        $vf_final_pac = (94.92+((($vf_final_pac-30)/5)*14.79)+($linha4[vofertado]*1/100));
                                        }
                                        //echo $vf_final_pac;  
                                        
                                        
//CALCULO FRETE - BASE CORREIOS
                          //CALCULO FAIXA 5 - FRETE SISLICITA - TABELA CORREIOS ABRIL 2012.
                        if      ((($linha_uf[uf]=="Bahia - BA")) and
                                    (($vf_pac>=0) and ($vf_pac<=1))){
                                        $vf_final_pac = ((16.56)+($linha4[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Bahia - BA")) and
                                    (($vf_pac>1) and ($vf_pac<=5))){
                                        $vf_final_pac = ((24.94)+($linha4[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Bahia - BA")) and
                                    (($vf_pac>5) and ($vf_pac<=10))){
                                        $vf_final_pac = ((40.87)+($linha4[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Bahia - BA")) and
                                    (($vf_pac>10) and ($vf_pac<=20))){
                                        $vf_final_pac = ((73.43)+($linha4[vofertado]*1/100));
                                        }
                        elseif ((($linha_uf[uf]=="Bahia - BA")) and
                                    (($vf_pac>20) and ($vf_pac<=30))){
                                        $vf_final_pac = ((106.68)+($linha4[vofertado]*1/100));
                                        }
                         elseif ((($linha_uf[uf]=="Bahia - BA")) and
                                    (($vf_pac>=30))){
                                        $vf_final_pac = (106.68+((($vf_final_pac-30)/5)*16.63)+($linha4[vofertado]*1/100));
                                        }
                                        //echo $vf_final_pac;  
                                        
                                        
                                        
//CALCULO FRETE - BASE CORREIOS
                          //CALCULO FAIXA 6 - FRETE SISLICITA - TABELA CORREIOS ABRIL 2012.
                        if      ((($linha_uf[uf]=="Alagoas - AL") or
                                 ($linha_uf[uf]=="Sergipe - SE")) and
                                    (($vf_pac>=0) and ($vf_pac<1))){
                                        $vf_final_pac = ((17.64)+($linha4[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Alagoas - AL") or
                                 ($linha_uf[uf]=="Sergipe - SE")) and
                                    (($vf_pac>=1) and ($vf_pac<5))){
                                        $vf_final_pac = ((26.57)+($linha4[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Alagoas - AL") or
                                 ($linha_uf[uf]=="Sergipe - SE")) and
                                    (($vf_pac>=5) and ($vf_pac<10))){
                                        $vf_final_pac = ((43.53)+($linha4[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Alagoas - AL") or
                                 ($linha_uf[uf]=="Sergipe - SE")) and
                                    (($vf_pac>=10) and ($vf_pac<20))){
                                        $vf_final_pac = ((78.22)+($linha4[vofertado]*1/100));
                                        }
                        elseif ((($linha_uf[uf]=="Alagoas - AL") or
                                 ($linha_uf[uf]=="Sergipe - SE")) and
                                    (($vf_pac>=20) and ($vf_pac<30))){
                                        $vf_final_pac = ((113.63)+($linha4[vofertado]*1/100));
                                        }
                         elseif ((($linha_uf[uf]=="Alagoas - AL") or
                                 ($linha_uf[uf]=="Sergipe - SE")) and
                                    (($vf_pac>=30))){
                                        $vf_final_pac = (113.63+((($vf_final_pac-30)/5)*17.71)+($linha4[vofertado]*1/100));
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
                                        $vf_final_pac = ((19.74)+($linha4[vofertado]*1/100));
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
                                        $vf_final_pac = ((29.44)+($linha4[vofertado]*1/100));
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
                                        $vf_final_pac = ((51.19)+($linha4[vofertado]*1/100));
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
                                        $vf_final_pac = ((94.71)+($linha4[vofertado]*1/100));
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
                                        $vf_final_pac = ((138.22)+($linha4[vofertado]*1/100));
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
                                        $vf_final_pac = (138.22+((($vf_final_pac-30)/5)*21.76)+($linha4[vofertado]*1/100));
                                        }
                                        
                                        //echo "<br>$vf_pac<br>"; 
                                        //echo "<br>$vf_final_pac<br>"; 
                                        
//CALCULO FRETE - BASE CORREIOS
                          //CALCULO FAIXA 8 - FRETE SISLICITA - TABELA CORREIOS ABRIL 2012.
                        if      ((($linha_uf[uf]=="Amapá - AP")) and
                                    (($vf_pac>=0) and ($vf_pac<=1))){
                                        $vf_final_pac = ((21.62)+($linha4[vofertado]*1/100));
                                        }
                        elseif   ((($linha_uf[uf]=="Amapá - AP")) and
                                    (($vf_pac>1) and ($vf_pac<=5))){
                                        $vf_final_pac = ((32.23)+($linha4[vofertado]*1/100));
                                        }
                        elseif   ((($linha_uf[uf]=="Amapá - AP")) and
                                    (($vf_pac>5) and ($vf_pac<=10))){
                                        $vf_final_pac = ((56.06)+($linha4[vofertado]*1/100));
                                        }
                        elseif   ((($linha_uf[uf]=="Amapá - AP")) and
                                    (($vf_pac>10) and ($vf_pac<=20))){
                                        $vf_final_pac = ((103.71)+($linha4[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Amapá - AP")) and
                                    (($vf_pac>20) and ($vf_pac<=30))){
                                        $vf_final_pac = ((151.35)+($linha4[vofertado]*1/100));
                                        }
                         elseif  ((($linha_uf[uf]=="Amapá - AP")) and
                                    (($vf_pac>=30))){
                                        $vf_final_pac = (151.35+((($vf_final_pac-30)/5)*23.82)+($linha4[vofertado]*1/100));
                                        }
                                        //echo $vf_final_pac;
                                        
                                        //CALCULO FRETE - BASE CORREIOS
                          //CALCULO FAIXA 9 - FRETE SISLICITA - TABELA CORREIOS ABRIL 2012.
                        if      ((($linha_uf[uf]=="Roraima - RR")) and
                                    (($vf_pac>=0) and ($vf_pac<=1))){
                                        $vf_final_pac = ((22.87)+($linha4[vofertado]*1/100));
                                        }
                        elseif   ((($linha_uf[uf]=="Roraima - RR")) and
                                    (($vf_pac>1) and ($vf_pac<=5))){
                                        $vf_final_pac = ((34.10)+($linha4[vofertado]*1/100));
                                        }
                        elseif   ((($linha_uf[uf]=="Roraima - RR")) and
                                    (($vf_pac>5) and ($vf_pac<=10))){
                                        $vf_final_pac = ((59.31)+($linha4[vofertado]*1/100));
                                        }
                        elseif   ((($linha_uf[uf]=="Roraima - RR")) and
                                    (($vf_pac>10) and ($vf_pac<=20))){
                                        $vf_final_pac = ((109.72)+($linha4[vofertado]*1/100));
                                        }
                        elseif  ((($linha_uf[uf]=="Roraima - RR")) and
                                    (($vf_pac>20) and ($vf_pac<=30))){
                                        $vf_final_pac = ((160.13)+($linha4[vofertado]*1/100));
                                        }
                         elseif  ((($linha_uf[uf]=="Roraima - RR")) and
                                    (($vf_pac>=30))){
                                        $vf_final_pac = (160.13+((($vf_final_pac-30)/5)*25.21)+($linha4[vofertado]*1/100));
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
                                        $vf_final = ((80.50 + 3.66 + 2.67)+($linha4[vofertado]*0.5/100)+($linha4[vofertado]*0.3/100))*1.3;
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
                                                $vf_final = ((100.63 + 3.66 + 2.67)+($linha4[vofertado]*0.5/100)+($linha4[vofertado]*0.3/100))*1.3;
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
                                                $vf_final = ((120.75 + 3.66 + 2.67)+($linha4[vofertado]*0.5/100)+($linha4[vofertado]*0.3/100))*1.3;
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
                                                $vf_final = ((($vf*0.805) + 3.66 + 2.67)+($linha4[vofertado]*0.5/100)+($linha4[vofertado]*0.3/100))*1.3;
                                                }
                                                //echo "<br>$vf<br>";
                                                //echo "<br>$vf_final<br>";
                         //CALCULO REGIAL CENTRO-OESTE - FRETE SISLICITA - TABELA TRANSPAULO 2012.                       
                         if       ((($linha_uf[uf]=="Goiás - GO") or
                                 ($linha_uf[uf]=="Distrito Federal - DF") or
                                 ($linha_uf[uf]=="Mato Grosso - MT") or
                                 ($linha_uf[uf]=="Mato Grosso do Sul - MS")) and
                                    (($vf>=0) and ($vf<=30))){
                                        $vf_final = ((40.25 + 3.66 + 2.67)+($linha4[vofertado]*0.2/100)+($linha4[vofertado]*0.2/100));
                                        }
                                                                     
                         elseif (       (($linha_uf[uf]=="Goiás - GO") or
                                        ($linha_uf[uf]=="Distrito Federal - DF") or
                                        ($linha_uf[uf]=="Mato Grosso - MT") or
                                        ($linha_uf[uf]=="Mato Grosso do Sul - MS")) and
                                           (($vf>=31) and ($vf<=50))){
                                               $vf_final = ((48.88 + 3.66 + 2.67)+($linha4[vofertado]*0.2/100)+($linha4[vofertado]*0.2/100));
                                               }
                          elseif (      (($linha_uf[uf]=="Goiás - GO") or
                                        ($linha_uf[uf]=="Distrito Federal - DF") or
                                        ($linha_uf[uf]=="Mato Grosso - MT") or
                                        ($linha_uf[uf]=="Mato Grosso do Sul - MS")) and
                                           (($vf>=51) and ($vf<=100))){
                                               $vf_final = ((57.50 + 3.66 + 2.67)+($linha4[vofertado]*0.2/100)+($linha4[vofertado]*0.2/100));
                                               }
                         elseif (       (($linha_uf[uf]=="Goiás - GO") or
                                        ($linha_uf[uf]=="Distrito Federal - DF") or
                                        ($linha_uf[uf]=="Mato Grosso - MT") or
                                        ($linha_uf[uf]=="Mato Grosso do Sul - MS")) and
                                           (($vf>=100))){
                                               $vf_final = ((($vf*0.345) + 3.66 + 2.67)+($linha4[vofertado]*0.2/100)+($linha4[vofertado]*0.2/100));
                                               }
                                               
                        //CALCULO REGIAL SUDESTE - FRETE SISLICITA - TABELA TRANSPAULO 2012.                       
                         if       ((($linha_uf[uf]=="Minas Gerais - MG") or
                                 ($linha_uf[uf]=="Espírito Santo - ES") or
                                 ($linha_uf[uf]=="São Paulo - SP") or
                                 ($linha_uf[uf]=="Rio de Janeiro - RJ")) and
                                    (($vf>=0) and ($vf<=30))){
                                        $vf_final = ((35.65 + 3.66 + 2.67)+($linha4[vofertado]*0.2/100)+($linha4[vofertado]*0.2/100));
                                        }
                                                                     
                         elseif (       (($linha_uf[uf]=="Minas Gerais - MG") or
                                 ($linha_uf[uf]=="Espírito Santo - ES") or
                                 ($linha_uf[uf]=="São Paulo - SP") or
                                 ($linha_uf[uf]=="Rio de Janeiro - RJ")) and
                                           (($vf>=31) and ($vf<=50))){
                                               $vf_final = ((41.98 + 3.66 + 2.67)+($linha4[vofertado]*0.2/100)+($linha4[vofertado]*0.2/100));
                                               }
                          elseif (      (($linha_uf[uf]=="Minas Gerais - MG") or
                                 ($linha_uf[uf]=="Espírito Santo - ES") or
                                 ($linha_uf[uf]=="São Paulo - SP") or
                                 ($linha_uf[uf]=="Rio de Janeiro - RJ")) and
                                           (($vf>=51) and ($vf<=100))){
                                               $vf_final = ((48.30 + 3.66 + 2.67)+($linha4[vofertado]*0.2/100)+($linha4[vofertado]*0.2/100));
                                               }
                         elseif (       (($linha_uf[uf]=="Minas Gerais - MG") or
                                 ($linha_uf[uf]=="Espírito Santo - ES") or
                                 ($linha_uf[uf]=="São Paulo - SP") or
                                 ($linha_uf[uf]=="Rio de Janeiro - RJ")) and
                                           (($vf>=100))){
                                                $vf_final = ((52.90+((($vf-100)*0.44) + 3.66 + 2.67)+($linha4[vofertado]*0.20/100)+($linha4[vofertado]*0.15/100)+($linha4[vofertado]*0.15/100))*1.088);
                                               } 
                                               
                         //CALCULO REGIAL SUL - FRETE SISLICITA - TABELA TRANSPAULO 2012.                       
                         if       ((($linha_uf[uf]=="Paraná - PR") or
                                 ($linha_uf[uf]=="Santa Catarina - SC") or
                                 ($linha_uf[uf]=="Rio Grande do Sul - RS")) and
                                    (($vf>=0) and ($vf<=30))){
                                        $vf_final = ((24.73 + 3.66 + 2.67)+($linha4[vofertado]*0.2/100)+($linha4[vofertado]*0.2/100));
                                        }
                                                                     
                         elseif (       (($linha_uf[uf]=="Paraná - PR") or
                                 ($linha_uf[uf]=="Santa Catarina - SC") or
                                 ($linha_uf[uf]=="Rio Grande do Sul - RS")) and
                                           (($vf>=31) and ($vf<=50))){
                                               $vf_final = ((28.46 + 3.66 + 2.67)+($linha4[vofertado]*0.2/100)+($linha4[vofertado]*0.2/100));
                                               }
                          elseif (      (($linha_uf[uf]=="Paraná - PR") or
                                 ($linha_uf[uf]=="Santa Catarina - SC") or
                                 ($linha_uf[uf]=="Rio Grande do Sul - RS")) and
                                           (($vf>=51) and ($vf<=100))){
                                               $vf_final = ((32.20 + 3.66 + 2.67)+($linha4[vofertado]*0.2/100)+($linha4[vofertado]*0.2/100));
                                               }
                         elseif (       (($linha_uf[uf]=="Paraná - PR") or
                                 ($linha_uf[uf]=="Santa Catarina - SC") or
                                 ($linha_uf[uf]=="Rio Grande do Sul - RS")) and
                                           (($vf>=100))){
                                               $vf_final = ((52.90+((($vf-100)*0.30) + 3.66 + 2.67)+($linha4[vofertado]*0.10/100)+($linha4[vofertado]*0.1/100)+($linha4[vofertado]*0.1/100))*1.05);
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
                                        $vf_final = ((43.76 + 3.66 + 2.67)+($linha4[vofertado]*0.2/100)+($linha4[vofertado]*0.2/100));
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
                                               $vf_final = ((56.94 + 3.66 + 2.67)+($linha4[vofertado]*0.2/100)+($linha4[vofertado]*0.2/100));
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
                                               $vf_final = ((89.87 + 3.66 + 2.67)+($linha4[vofertado]*0.2/100)+($linha4[vofertado]*0.2/100));
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
                                               $vf_final = ((($vf*0.659) + 3.66 + 2.67)+($linha4[vofertado]*0.2/100)+($linha4[vofertado]*0.2/100));
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
    //$linha4agora é um vetor com as posições:
    //$linha4[cod], $linha4[nome], $linha4[valor], etc...

//  Declarado aqui as variáveis que irão compor as colunas para utilizar na hora 
//  do pregão (criado as fórmulas para adicionar ao banco)
//  chama o arquivo que contem as variáveis
//require "var_formulas.php"
                  //incrementa o total de linhas;    

$vtotcusto=$linha4[qtde]*$linha4[vunitcusto];
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
$vimposto=($linha4[vofertado]*($porc_sn+$linha_uf[perc_icms]+$difaliq)/100);

       
//echo "$vtotcusto<br/>";
//echo "$vo</br>";
//echo "<br>$vfrete<br/>";
//echo "$vimposto<br/>";
//echo "$porc_lucro<br/>";
//echo "$vs<br/>";        
//echo "$c<br/>";
if ($linha4[vofertado]!=0){        
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
$vminitem=($vminofertar/$linha4[qtde]);
//echo "$vminofertar</br>";
//echo "$vminitem</br></br>";
if ($custo_aprox==0){
    $mensagem_custo="informar valor a ofertar";
}

$lucro_liq=$linha4[vofertado]-$custo_aprox;
$c++; 
$vo += $linha4[vofertado];    //incrementa a $v o campo valor
 

    
    
                            $sql2 = "SELECT * FROM subitens2 WHERE id_item = $linha4[id_itens] order by id_subitem";
                            $res2 = mysql_query($sql2) or die("Erro seleção linha5");
                            $linha5= mysql_fetch_assoc($res2);
                            
                            if (empty($linha5[id_subitem])) 
                                echo "$linha4[nome_item] MARCA: $linha4[marca_item] / MODELO: $linha4[modelo_item] / $linha4[produto]";
                            else{
                            
                                while($linha5){
                            
                                    echo "$linha5[qtde_si]-$linha5[nome_subitem] MARCA: $linha5[marca_si] / MODELO: $linha5[modelo_si]<br><hr>";
                                    
                                    $linha5= mysql_fetch_assoc($res2);
                                    }
                            }
                            
                 //echo $vf;  
                 
    
                        $sql3 = "SELECT * FROM subitens2 WHERE id_item = $linha4[id_itens]";
                        $res3 = mysql_query($sql3) or die("Erro seleção linha5");
                        $linha6 = mysql_fetch_assoc($res3);
                        $soma = 0;
                        
                        
                        if ((empty($linha6[vunitcusto_si]))
                                and (isset($mensagem_custo))){
                                    echo "<strong>$mensagem_custo";
                                    }
                        if ((empty($linha6[vunitcusto_si]))
                                and (!isset($mensagem_custo))){
                                    $number = "$vminitem";
                                    echo "R$" .number_format($number,2, ',','.');
                                    }
                                    
                            else{
                                $soma_si=0;
                                while($linha6){
                                    $soma_si += ($linha6[vunitcusto_si]*$linha4[qtde_si]);
                                    $linha6 = mysql_fetch_assoc($res3);
                                    //echo $soma_si;
                                    }
                                    
                                    $vtotcusto=($soma_si*$linha4[qtde]);
                                    
                                    if ($linha4[vofertado]!=0){        
                                        $custo_aprox=($vtotcusto+$vfrete+$vimposto);
                                        //echo "$custo_aprox<br/>";
                                        }
                                        else{
                                            $custo_aprox=0;
                                            //echo "$custo_aprox<br/>";
                                        }

                                    $vminofertar=($custo_aprox*$porc_lucro)+($custo_aprox);
                                    $vminitem=($vminofertar/$linha4[qtde]);
                                    $vminofertar2=($custo_aprox*$porc_lucro2)+($custo_aprox);
                                    $vminitem=($vminofertar/$linha4[qtde]);
                                    $vminofertar3=($custo_aprox*$porc_lucro3)+($custo_aprox);
                                    $vminitem=($vminofertar/$linha4[qtde]);

                                    if ($custo_aprox==0){
                                        $mensagem_custo="informar valor a ofertar";
                                    }
                                    //echo "$custo_aprox<br/>";
                                    //$lucro_liq=$linha4[vofertado]-$custo_aprox;

                                    //$c++; 
                                    //$vmo += $vminofertar;    //incrementa a $v o campo valor
                                    //$ca += $custo_aprox;    //incrementa a $v o campo valor
                                    //$ll += $lucro_liq;    //incrementa a $v o campo valor
                                    //$vo += $linha4[vofertado];    //incrementa a $v o campo valor
                                    //$vmo += $linha4[vminofertar];    //incrementa a $v o campo valor
                                    //$vmo += $linha4[vminofertar];    //incrementa a $v o campo valor
                                    $number_si=$vminitem;
                                    echo "R$" .number_format($number_si,2, ',','.');
                                }
                                                        
                                                    
    
                        $sql3 = "SELECT * FROM subitens2 WHERE id_item = $linha4[id_itens]";
                        $res3 = mysql_query($sql3) or die("Erro seleção linha5");
                        $linha6 = mysql_fetch_assoc($res3);
                        $soma = 0;
                        
                        //if (empty($linha6[vunitcusto_si])){
                               if ((empty($linha6[vunitcusto_si]))
                                and (isset($mensagem_custo))){
                                    echo "<strong>$mensagem_custo";
                                    }
                                if ((empty($linha6[vunitcusto_si]))
                                and (!isset($mensagem_custo))){
                                    $number = $vminitem*$linha4[qtde];
                                    echo "R$" .number_format($number,2, ',','.');
                                    }   
                                else{
                                
                                while($linha6){
                                    //$soma = 0;    
                                    $soma = ($number_si*$linha4[qtde]);
                                    //echo $soma;
                                    $linha6 = mysql_fetch_assoc($res3);
                                    //echo $soma;
                                    }
                                    echo "R$" .number_format($soma,2, ',','.');
                                }
                                                        
                                                    
    
                        $sql3 = "SELECT * FROM subitens2 WHERE id_item = $linha4[id_itens]";
                        $res3 = mysql_query($sql3) or die("Erro seleção linha5");
                        $linha6 = mysql_fetch_assoc($res3);
                        $soma = 0;              
                        //if (empty($linha6[vunitcusto_si])){
                                if (isset($mensagem_custo)){
                                    echo "<strong>$mensagem_custo";
                                }
                                else{
                                $number = $linha4[vofertado];
                                echo "R$" .number_format($number,2, ',','.');
                                }
                            /*else{

                                while($linha6){
                                    //$soma = 0;    
                                    $soma += "$linha6[vtotcusto_si]";
                                    //echo $soma;
                                    
                                    $linha6 = mysql_fetch_assoc($res3);
                                    
                                    //echo $soma;
                                    }
                                    echo "R$" .number_format($soma,2, ',','.');
                                }*/
                                                        
                    $number = "$vfrete";
                    echo "R$" .number_format($number,2, ',','.')."</br>($linha4[tipo_equip])"."$tipo_vfrete";
                    
                    //echo $linha4[vofertado]
//require "tab_cont_itens_tudo.php";
  
    //pega a próxima linha
    $linha4= mysql_fetch_assoc($res);
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

$linha4= mysql_fetch_assoc($res);
                $sql="SELECT * FROM proposta WHERE id_lote='$linha_coloc[id_lote]'";
                $res=mysql_query($sql) or die("erro seleção proposta");
                $prop= mysql_fetch_assoc($res);
                

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
                    //echo $linha4[vofertado]
 
                $number = ($vo);
                echo "R$" .number_format($number,2, ',','.');
                //echo $linha4[vofertado]

    if ((($vmo3-$ca)>=$lucro_min_at_dl) and (($linha_uf[tipo_licitacao]=="DL") or ($linha_uf[tipo_licitacao]=="CC"))){
        $number = ($vmo3);
        echo "R$" .number_format($number,2, ',','.');
        $vmo_final=$number;
        }
        elseif ((($vmo3-$ca)<$lucro_min_at_dl) and (($linha_uf[tipo_licitacao]=="DL") or ($linha_uf[tipo_licitacao]=="CC"))){
            $number = ($ca_final+$lucro_min_at_dl);
            echo "R$" .number_format($number,2, ',','.');
            $vmo_final=$number;            
            }
        elseif ((($vmo3-$ca)>=$lucro_min_rp) and (($linha_uf[tipo_licitacao]=="RP"))){
            $number = ($vmo3+$vs+$vsedex);
            echo "R$" .number_format($number,2, ',','.');
            $vmo_final=$number;
            }
        elseif ((($vmo3-$ca)<$lucro_min_rp) and (($linha_uf[tipo_licitacao]=="RP"))){
            $number = ($ca_final+$lucro_min_rp);
            echo "R$" .number_format($number,2, ',','.');
            $vmo_final=$number;
            }
        elseif ((($vmo3-$ca)>=$lucro_min_at_dl) and (($linha_uf[tipo_licitacao]=="AT"))){
            $number = ($vmo3+$vs+$vsedex);
            echo "R$" .number_format($number,2, ',','.');
            $vmo_final=$number;
            }
        elseif ((($vmo3-$ca)<$lucro_min_at_dl) and (($linha_uf[tipo_licitacao]=="AT"))){
            $number = ($ca_final+$lucro_min_at_dl);
            echo "R$" .number_format($number,2, ',','.');
            $vmo_final=$number;
            }
                ?>