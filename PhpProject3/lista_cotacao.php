<?php
require "conecta.php";
require "cabecalho_html.php";

include "css.php";
include "constantes.php";

//print_r ($_REQUEST);
// se o GET[order] for vazio, então será preenchido com um valor padrão
if(empty($_GET[order])) $_GET[order] = 'item';
    
$sql = "SELECT * FROM subitens_ne2,itens_ne,notaempenho WHERE subitens_ne2.id_itens_ne=itens_ne.id_itens_ne and itens_ne.id_ne=notaempenho.id_ne and status_ne='Em cotação'order by modelo_item";

$res = mysql_query($sql) or die("Erro seleção lista_itens_ne_tudo");

$v = 0; //conterá a somatória dos valores
$c = 0; //total de registros

//pega a primeira linha do resultado
$linha = mysql_fetch_assoc($res);

?>



<br>
<table align="center" class="A" border="0" width="1010">

  <table align="center" class="A" width="1000" border="1" cellpadding="3" cellspacing="0">
      
<tr align="center" class="forms">
    <th width="" >Item</th>
    <th width="" >Qtde</th>
    <th colspan="" >Descrição do Item</th>
    <th width="" >V.unit.custo</th>
    <th colspan="" width="" >V.tot.custo</th>
    
    
</tr>
      
      <?php

//enquanto houver linha
while($linha){
    
    
    $c++;                   //incrementa o total de linhas;
    $vmo += $linha[vminofertar];    //incrementa a $v o campo valor
    $ca += $linha[custo_aprox];    //incrementa a $v o campo valor
    $ll += $linha[lucro_liq];    //incrementa a $v o campo valor
    $vc += ($linha[vunitcusto]*$linha[qtde]);    //incrementa a $v o campo valor
    $vo += ($linha[vitem]*$linha[qtde]);    //incrementa a $v o campo valor
    //$vmo += $linha[vminofertar];    //incrementa a $v o campo valor
    //$vmo += $linha[vminofertar];    //incrementa a $v o campo valor
    //$imposto = "6,75/100";
    
    

    //mostra a linha
    //$linha agora é um vetor com as posições:
    //$linha[cod], $linha[nome], $linha[valor], etc...

//  Declarado aqui as variáveis que irão compor as colunas para utilizar na hora 
//  do pregão (criado as fórmulas para adicionar ao banco)
//  chama o arquivo que contem as variáveis
//require "var_formulas.php"

?>
      
  

<tr align="center">
    
   
<td>&nbsp;<?php echo $linha[item] ?>
    </td>
    
    <td>&nbsp;<?php  echo $linha[qtde];?>
    </td>
    
    <td colspan="" align="left">&nbsp;<?php
    
                            $sql2 = "SELECT * FROM subitens_ne2 WHERE id_itens_ne = $linha[id_itens_ne]";
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

                                    ?>
    </td>
                            
    <td>&nbsp;<?php
                            
                            
                        $sql3 = "SELECT * FROM subitens_ne2 WHERE id_itens_ne = $linha[id_itens_ne]";
                        $res3 = mysql_query($sql3) or die("Erro seleção linha3");
                        $linha3 = mysql_fetch_assoc($res3);
                        $soma = 0;              
                        if (empty($linha3[vunitcusto_si])){
                                $number = "$linha[vunitcusto]";
                                echo "R$" .number_format($number,2, ',','.');}
                            else{
                                //$soma = 0;                
                                while($linha3){
                                    //echo "<br>$linha3[vunitcusto_si]<br>";
                                    $soma += ($linha3[vunitcusto_si]*$linha3[qtde_si]);
                                    //echo $soma;
                                    
                                    $linha3 = mysql_fetch_assoc($res3);
                                    
                                    //echo $soma;
                                    }
                                    echo "R$" .number_format($soma,2, ',','.');
                                }
                        
                ?>
    </td>
    <td>&nbsp;<?php
                            
    
                $vuc = ($linha[vunitcusto]*$linha[qtde]);
                echo "R$" .number_format($vuc,2, ',','.');
                //echo $linha[vofertado]
                
                ?>
    </td>
</tr>


  <tr align="center">
    
    
    <!--<td>&nbsp;<?php 
                $number = "$linha[vfrete]";
                echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?>
    </td>
    <td>&nbsp;<?php 
                $number = ($linha[vofertado]*$porc_sn/100);
                echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?>
    </td>-->
    <!--<td class="custo_aprox">&nbsp;<?php 
                $number = "$linha[custo_aprox]";
                echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?>
    </td>
    <td class="lucro_liq">&nbsp;<?php 
                $number = "$linha[lucro_liq]";
                echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?>
    </td>
    -->
    
    <!--<td class="lucro_liq">&nbsp;<?php 
                $number = ($linha[vminofertar]-$linha[custo_aprox]);
                echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?>
    </td>-->
    <!--<td class="vminofertar">&nbsp;<?php 
                $number = "$linha[vminofertar]";
                echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?>
    </td>-->
    
    <!--<td class="vminitem">&nbsp;<?php 
                $number = "$linha[vminitem]";
                echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?>
    </td>-->
    <!--<td>&nbsp;<?php 
                $number = "$linha[porc_lucro]";
                echo number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?>
    </td>-->
    
    
  
    <!--<td><input type='button' value='Excluir'
               onclick='document.location.href="conf_itens_exc.php?apagar=<?php //echo $linha[item]; ?>"'>
    </td>-->
    
  </tr>
  
  <?php
//require "tab_cont_itens_tudo.php";

    //pega a próxima linha
    $linha = mysql_fetch_assoc($res);
}



//require_once "rel_licita.php";

//echo '<br>';
?>
  
  
  <!--<table align="center" class="A" width="1000" border="1" cellpadding="3" cellspacing="0">-->
    
    <tr>
    <!--<th class="forms" colspan="0" scope="row">CUSTO TOTAL DA NE:</th>
    <td>R$</td>
    <td>&nbsp;</td>
    <td>R$</td>
    <td>R$</td>
    <td align="right" class="debito"><?php 
    
                            
    
                           
                $number = "$ca";
                echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                       
                ?>
    </td>
    -->
    <td></td>
    <td></td>
    <td></td>
    <th class="forms" colspan="0" scope="row">VALOR CUSTO:</th>
    
    <td align="right" class="green"><?php
                            
    
    
                $number = "$vc";
                echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                                
                ?>
    </td>
    <td></td>
    
    <th class="forms" colspan="0" scope="row">VALOR EMPENHO:</th>
    
    
    <!--<td align="right" class="greenyellow"><?php 
                //$number = "$vo";
                //echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?>
    </td>-->
    <td align="right" class="green"><?php 
                $number = "$vo";
                echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?>
    </td>
    <td></td>
    <!--<th class="forms" colspan="0" scope="row">L.LIQ.MIN.OFERTAR:</th>
    
    <td align="right" class="credito">
                <?php
                    //if ($ll == 400 or > 400){ 
                     //   $number = $vo;
                
                       // elseif ($ll < 400){
                            $number = ($vmo - $ca);
                        //}
                   // }
                    echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?>
    </td>
    -->
    
    <!--<th class="forms" colspan="0" scope="row">V.MIN.OFERTAR:</th>
    
    
    <!--<td align="right" class="greenyellow"><?php 
                //$number = "$vo";
                //echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?>
    </td>
    <td align="right" class="yellow"><?php 
                $number = "$vmo";
                echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?>
    </td>
    -->
    
    
  </tr>


    <tr>
        <td colspan="19">Total de itens: <?php echo $c ?></td>
        
    </tr>
    
</table>
    <table align="center">
        
    </table>
  </table>
  
</table>
