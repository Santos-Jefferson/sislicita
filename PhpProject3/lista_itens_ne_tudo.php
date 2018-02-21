<?php
require "conecta.php";
require "cabecalho_html.php";
//require_once "cabecalho_lote.php";
include "css.php";
include "constantes.php";
//require "lista_itens_ne_tudo.php";
//require "lista_itens_ne_baixa_tudo.php";







//print_r ($_REQUEST);
// se o GET[order] for vazio, então será preenchido com um valor padrão
if(empty($_GET[order])) $_GET[order] = 'item';
    
$sql = "SELECT * FROM itens_ne WHERE id_lote = {$_REQUEST[id_lote]} and id_ne = {$_REQUEST[id_ne]} order by {$_GET[order]}";

$res = mysql_query($sql) or die("Erro seleção lista_itens_ne_tudo");

$v = 0; //conterá a somatória dos valores
$c = 0; //total de registros

//pega a primeira linha do resultado
$linha = mysql_fetch_assoc($res);


$sql_coloc = "SELECT * FROM lote WHERE id_lote = {$_REQUEST[id_lote]}";

$res_coloc = mysql_query($sql_coloc) or die("Erro seleção colocacao");

//pega a primeira linha do resultado
$linha_coloc = mysql_fetch_assoc($res_coloc);

//print_r ($_REQUEST);
//require_once "pes_rapida_cad_tudo.php";


//require "tab_cab_itens_tudo.php";
$sql2= "SELECT * FROM cad_produto_baixa WHERE id_ne = {$_REQUEST[id_ne]} and id_itens_ne = {$linha[id_itens_ne]}";
$res2= mysql_query($sql2) or die("Erro seleção listagem cad_produto_baixa em lista_itens_ne_tudo");
$linha_cad_baixa = mysql_fetch_assoc($res2);

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
    <th width="100" >Fornecedor.</th>
    <th width="" >V.Unit.Item</th>
    <th width="" >Valor Total</th>
    <th colspan="" width="70" >Ação</th>
    
    
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
    
                                
                                $sql2= "SELECT * FROM cad_produto_baixa WHERE id_ne = {$_REQUEST[id_ne]} and id_itens_ne = {$linha[id_itens_ne]}";
                                $res2= mysql_query($sql2) or die("Erro seleção listagem cad_produto_baixa em lista_itens_ne_tudo");
                                $linha_cad_baixa = mysql_fetch_assoc($res2);
                                if(($linha_cad_baixa) and !empty($linha_cad_baixa)){
                                
                                    while($linha_cad_baixa){
                                    echo "$linha_cad_baixa[desc_prod_baixa]<br><hr>";
                                    $linha_cad_baixa = mysql_fetch_assoc($res2);
                                }
                            }
                                else{
                                    
                                
                            //print_r ($_REQUEST);
                            //echo $linha[id_itens];die;
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
}
                                    ?>
    </td>
                            
    <td>&nbsp;<?php
                            
                            $sql2= "SELECT * FROM cad_produto_baixa WHERE id_ne = {$_REQUEST[id_ne]} and id_itens_ne = {$linha[id_itens_ne]}";
                            $res2= mysql_query($sql2) or die("Erro seleção listagem cad_produto_baixa em lista_itens_ne_tudo");
                            $linha_cad_baixa = mysql_fetch_assoc($res2);
                            if(($linha_cad_baixa) and !empty($linha_cad_baixa)){
                                
                                    while($linha_cad_baixa){
                                    $soma += ($linha_cad_baixa[valor_custo_prod]);//*$linha_cad_baixa[qtde_baixa]);
                                    $valor_custo_total =+($linha_cad_baixa[valor_custo_prod]*$linha_cad_baixa[qtde_baixa]);
                                    $linha_cad_baixa = mysql_fetch_assoc($res2);
                                    }
                                    echo "R$" .number_format($soma,2, ',','.');
                            }
                                else{

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
                        }
                ?>
    </td>
    <td>&nbsp;<?php
                            $sql2= "SELECT * FROM cad_produto_baixa WHERE id_ne = {$_REQUEST[id_ne]} and id_itens_ne = {$linha[id_itens_ne]}";
                                $res2= mysql_query($sql2) or die("Erro seleção listagem cad_produto_baixa em lista_itens_ne_tudo");
                                $linha_cad_baixa = mysql_fetch_assoc($res2);
                                 $soma = 0;
                            if(($linha_cad_baixa) and !empty($linha_cad_baixa)){
                                
                                    while($linha_cad_baixa){
                                    $soma += ($linha_cad_baixa[valor_custo_prod]*$linha_cad_baixa[qtde_baixa]);
                                    $linha_cad_baixa = mysql_fetch_assoc($res2);
                                    }
                                    echo "R$" .number_format($soma,2, ',','.');
                            }
                                else{
    
                $vuc = ($linha[vunitcusto]*$linha[qtde]);
                echo "R$" .number_format($vuc,2, ',','.');
                //echo $linha[vofertado]
                }
                ?>
    </td>
    <td>&nbsp;<?php
                            $sql2= "SELECT * FROM cad_produto_baixa WHERE id_ne = {$_REQUEST[id_ne]} and id_itens_ne = {$linha[id_itens_ne]}";
                            $res2= mysql_query($sql2) or die("Erro seleção listagem cad_produto_baixa em lista_itens_ne_tudo");
                            $linha_cad_baixa = mysql_fetch_assoc($res2);
                            $soma = 0;
                            if(($linha_cad_baixa) and !empty($linha_cad_baixa)){
                                
                                    
                                    echo "Baixa Estoque OK";
                            }
                                else{
    
    
                            $sql2= "SELECT * FROM cad_produto_baixa WHERE id_ne = {$_REQUEST[id_ne]} and id_itens_ne = {$linha[id_itens_ne]}";
                            $res2 = mysql_query($sql2) or die("Erro seleção linha2");
                            $linha2 = mysql_fetch_assoc($res2);
                            
                            if (empty($linha2[id_subitem]))
                                echo "$linha[forn] - RO: $linha[ro_item]";
                            else{
                            
                                while($linha2){
                            
                                    echo "$linha2[forn_si] - RO: $linha2[ro_item],";
                                    
                                    $linha2 = mysql_fetch_assoc($res2);
                                    }
                            }
                                }
                                    ?></td>
    
    <td>&nbsp;<?php 
                $number = "$linha[vitem]";
                echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?>
    </td>
    <td class="vofertado">&nbsp;<?php 
                $number = $linha[vitem]*$linha[qtde];
                echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?>
        
    </td>
    <td align="center">
            
            <a href="copia_subitens_ne.php?id_lote=<?php echo $linha[id_lote]; ?>&id_cod=<?php echo $_GET[id_cod];?>&id_itens=<?php echo $linha[id_itens];?>&id_itens_ne=<?php echo $linha[id_itens_ne];?>"><img src="imagens/copiar.png" border="0"/></a>
            <a href="altera_itens_ne.php?alterar=<?php echo $linha[id_itens_ne]; ?>&id_ne=<?php echo $_REQUEST[id_ne]; ?>&tipo_licitacao=<?php echo $_GET[tipo_licitacao]; ?>&num_ne=<?php echo $_GET[num_ne]; ?>&pregao=<?php echo $_GET[pregao]; ?>&codigo=<?php echo $_GET[codigo]; ?>&lote=<?php echo $_GET[lote]; ?>&orgao=<?php echo $_GET[orgao]; ?>&data=<?php echo $_GET[data]; ?>&hora=<?php echo $_GET[hora]; ?>&licitante=<?php echo $_GET[licitante]; ?>&id_lote=<?php echo $_REQUEST[id_lote]; ?>&id_cod=<?php echo $_GET[id_cod]; ?>"><img src="imagens/edit.png" border="0"/></a>
            <a href="conf_itens_exc_ne.php?apagar=<?php echo $linha[id_itens_ne]; ?>&id_lote=<?php echo $linha[id_lote];?>&id_cod=<?php echo $_REQUEST[id_cod];?>&id_ne=<?php echo $_GET[id_ne]; ?>&num_ne=<?php echo $_GET[num_ne]; ?>&item=<?php echo $linha[item];?>"><img src="imagens/delete.png" border="0"/></a>
        </td>
        
    
        
    
</tr>

<tr align="center" class="forms">
    
    <!--<th width="20" >V.Frete</th>-->
    <!--<th width="" >V.Imposto.</th>-->
    <!--<th width="" >Custo Aprox.</th>-->
    <!--<th width="" >Lucro Liq.</th>-->
    
    <!--<th width="" >L.Liq.Min.Ofertar</th>-->
    <!--<th width="" >V.Min.Ofertar</th>-->
    
    <!--<th width="50" >V.MIN.ITEM</th>-->
    <!--<th colspan="" width="50" >%</th>-->
    <!--<th>Ação</th>-->
    
    
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
  <tr>
        <td width="1010" colspan="10" align="center" bgcolor="#FFFF00" class="A" scope="col">
            <input type='button' value='LANÇAR PRODUTOS - BAIXA DE ESTOQUE'
               onclick='document.location.href="cad_itens_ne_baixa.php?id_itens_ne=<?php echo $linha[id_itens_ne];?>&id_ne=<?php echo $linha[id_ne]; ?>&num_ne=<?php echo $_REQUEST[num_ne]; ?>"'>
            <input type='button' value='TROCA PRODUTO - ENTRADA ESTOQUE'
               onclick='document.location.href="cad_entrada_prod2.php?id_itens_ne=<?php echo $linha[id_itens_ne];?>&id_ne=<?php echo $linha[id_ne]; ?>&num_ne=<?php echo $_REQUEST[num_ne]; ?>"'>
            
        </td>
            
    </tr>
  
  <!--<tr>
      <td colspan="11" bgcolor="black"></td>
  </tr>-->
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
                            $sql2= "SELECT * FROM cad_produto_baixa WHERE id_ne = {$_REQUEST[id_ne]}";
                            $res2= mysql_query($sql2) or die("Erro seleção listagem cad_produto_baixa em lista_itens_ne_tudo");
                            $linha_cad_baixa = mysql_fetch_assoc($res2);
                            $valor_custo_total = 0;
                            if(($linha_cad_baixa) and !empty($linha_cad_baixa)){
                                    while($linha_cad_baixa){
                                    $valor_custo_total += ($linha_cad_baixa[valor_custo_prod]*$linha_cad_baixa[qtde_baixa]);
                                    $linha_cad_baixa = mysql_fetch_assoc($res2);
                                    }
                                    echo "R$" .number_format($valor_custo_total,2, ',','.');
                            }
                                else{
    
    
    
                $number = "$vc";
                echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                                }
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
