<?php
require "conecta.php";
require_once "cabecalho_reduzido.php";
require_once "cabecalho_lote.php";
include "css.php";



//print_r ($_REQUEST);
// se o GET[order] for vazio, então será preenchido com um valor padrão
if(empty($_GET[order])) $_GET[order] = 'item';
    
$sql = "SELECT * FROM itens WHERE id_lote = {$_GET[id_lote]} order by {$_GET[order]}";

$res = mysql_query($sql) or die("Erro seleção");

$v = 0; //conterá a somatória dos valores
$c = 0; //total de registros

//pega a primeira linha do resultado
$linha = mysql_fetch_assoc($res);

//print_r ($_REQUEST);
//require_once "pes_rapida_cad_tudo.php";


//require "tab_cab_itens_tudo.php";
?>



<br>
<table align="center" class="A" border="0" width="1010">
<table align="center" class="A" width="1000" border="1" cellpadding="3" cellspacing="0">
    
    <tr>
        <td class="forms" colspan="0" bgcolor="LemonChiffon" align="center"><strong>LISTAGEM LICITAÇÃO N° <?php echo $_GET[codigo] ?> e LOTE/GRUPO N° <?php echo $_GET[lote] ?></td>
    </tr>
    
  <tr>
    <th width="377" >ÓRGÃO</th>
    <th width="132" scope="col">CÓDIGO</th>
    <th width="132" scope="col">DATA/HORA</th>
    <th width="132" scope="col">LOTE/GRUPO</th>
    <th width="213" scope="col">LICITANTE</th>
  </tr>
  <tr>
    <td align="center"><?php echo $_GET[orgao] ?></td>
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
  </tr>
  
  <table align="center" class="A" width="1000" border="1" cellpadding="3" cellspacing="0">
      
      <?php

//enquanto houver linha
while($linha){
    $c++;                   //incrementa o total de linhas;
    $vmo += $linha[vminofertar];    //incrementa a $v o campo valor
    $ca += $linha[custo_aprox];    //incrementa a $v o campo valor
    $ll += $linha[lucro_liq];    //incrementa a $v o campo valor
    $vo += $linha[vofertado];    //incrementa a $v o campo valor
    //$vmo += $linha[vminofertar];    //incrementa a $v o campo valor
    //$vmo += $linha[vminofertar];    //incrementa a $v o campo valor

    //mostra a linha
    //$linha agora é um vetor com as posições:
    //$linha[cod], $linha[nome], $linha[valor], etc...

//  Declarado aqui as variáveis que irão compor as colunas para utilizar na hora 
//  do pregão (criado as fórmulas para adicionar ao banco)
//  chama o arquivo que contem as variáveis
//require "var_formulas.php"

?>
      
  <tr align="center" class="forms">
    <th width="20" >Item</th>
    <th width="20" >Qtde</th>
    <th colspan="6" >Descrição do Item</th>
    <th width="50" >V.unit.custo</th>
    <th colspan="" width="50" >V.tot.custo</th>
    <th colspan="" width="50" >Alterar/Excluir</th>
</tr>

<tr align="center">
    
   
<td>&nbsp;<?php echo $linha[item] ?>
    </td>
    
    <td>&nbsp;<?php echo $linha[qtde] ?></td>
    <td colspan="6">&nbsp;<?php
    
    
                            $sql2 = "SELECT * FROM subitens WHERE id_item = $linha[id_itens]";
                            $res2 = mysql_query($sql2) or die("Erro seleção linha2");
                            $linha2 = mysql_fetch_assoc($res2);
                            
                            if (empty($linha2[id_subitem])) echo $linha[produto];
                            else{
                            
                                while($linha2){
                            
                                    echo "$linha2[qtde_si]-$linha2[sub_itens] MARCA: $linha2[marca_si] / MODELO: $linha2[modelo_si], ";
                                    
                                    $linha2 = mysql_fetch_assoc($res2);
                                    }
                            }
                                    ?>
    </td>
                            
    <td>&nbsp;<?php

                        $sql3 = "SELECT * FROM subitens WHERE id_item = $linha[id_itens]";
                        $res3 = mysql_query($sql3) or die("Erro seleção linha2");
                        $linha3 = mysql_fetch_assoc($res3);
                        $soma = 0;              
                        if (empty($linha3[vunitcusto_si])){
                                $number = "$linha[vunitcusto]";
                                echo "R$" .number_format($number,2, ',','.');}
                            else{

                                while($linha3){
                                    //$soma = 0;    
                                    $soma += "$linha3[vtotcusto_si]";
                                    //echo $soma;
                                    
                                    $linha3 = mysql_fetch_assoc($res3);
                                    
                                    //echo $soma;
                                    }
                                    echo "R$" .number_format($soma,2, ',','.');
                                }
                ?>
    </td>
    <td>&nbsp;<?php 
                $number = "$linha[vtotcusto]";
                echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?>
    </td>
    
        <td rowspan="1" align="center">&nbsp;<input type='button' value='Alterar'
               onclick='document.location.href="altera_itens.php?alterar=<?php echo $linha[id_itens]; ?>&codigo=<?php echo $_GET[codigo]; ?>&lote=<?php echo $_GET[lote]; ?>&orgao=<?php echo $_GET[orgao]; ?>&data=<?php echo $_GET[data]; ?>&hora=<?php echo $_GET[hora]; ?>&licitante=<?php echo $_GET[licitante]; ?>&id_lote=<?php echo $_GET[id_lote]; ?>&id_itens=<?php echo $linha[id_itens]; ?>&id_cod=<?php echo $_GET[id_cod]; ?>"'><br>
                                 <input type='button' value='Excluir'
               onclick='document.location.href="conf_itens_exc.php?apagar=<?php echo $linha[id_itens]; ?>&item=<?php echo $linha[item];?>"'>
        </td>
                
    
</tr>

<tr align="center" class="forms">
    <th width="20" >Fornecedor.</th>
    <th width="20" >V.Frete</th>
    <th width="" >V.Imposto.</th>
    <th width="" >Custo Aprox.</th>
    <th width="" >Lucro Liq.</th>
    <th width="" >V.Ofertado</th>
    <th width="" >L.Liq.Min.Ofertar</th>
    <th width="" >V.Min.Ofertar</th>
    <th width="" >V.Item</th>
    <th width="50" >V.Min.Item</th>
    <th colspan="" width="50" >%</th>
    <!--<th>Ação</th>-->
    
    
</tr>


  <tr align="center">
    
    <td>&nbsp;<?php
    
    
                            $sql2 = "SELECT * FROM subitens WHERE id_item = $linha[id_itens]";
                            $res2 = mysql_query($sql2) or die("Erro seleção linha2");
                            $linha2 = mysql_fetch_assoc($res2);
                            
                            if (empty($linha2[id_subitem])) echo $linha[forn];
                            else{
                            
                                while($linha2){
                            
                                    echo "$linha2[obs_si], ";
                                    
                                    $linha2 = mysql_fetch_assoc($res2);
                                    }
                            }
                                    ?></td>
    <td>&nbsp;<?php 
                $number = "$linha[vfrete]";
                echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?>
    </td>
    <td>&nbsp;<?php 
                $number = "$linha[imposto]";
                echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?>
    </td>
    <td class="custo_aprox">&nbsp;<?php 
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
    <td class="vofertado">&nbsp;<?php 
                $number = "$linha[vofertado]";
                echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?>
        
    </td>
    <td class="lucro_liq">&nbsp;<?php 
                $number = ($linha[vminofertar]-$linha[custo_aprox]);
                echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?>
    </td>
    <td class="vminofertar">&nbsp;<?php 
                $number = "$linha[vminofertar]";
                echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?>
    </td>
    <td>&nbsp;<?php 
                $number = "$linha[vitem]";
                echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?>
    </td>
    <td class="vminofertar">&nbsp;<?php 
                $number = "$linha[vminitem]";
                echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?>
    </td>
    <td>&nbsp;<?php 
                $number = "$linha[porc_lucro]";
                echo number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?>
    </td>
    
    
  
    <!--<td><input type='button' value='Excluir'
               onclick='document.location.href="conf_itens_exc.php?apagar=<?php //echo $linha[item]; ?>"'>
    </td>-->
    
  </tr>
  
  <tr>
      <td colspan="11" bgcolor="black"></td>
  </tr>
  <?php
//require "tab_cont_itens_tudo.php";

    //pega a próxima linha
    $linha = mysql_fetch_assoc($res);
}



//require_once "rel_licita.php";

//echo '<br>';
?>
  
  
  <table align="center" class="A" width="1000" border="1" cellpadding="3" cellspacing="0">
    
    <tr>
    <th class="forms" colspan="0" scope="row">CUSTO APROXIMADO:</th>
    <!--<td>R$</td>
    <td>&nbsp;</td>
    <td>R$</td>
    <td>R$</td>-->
    <td align="right" class="debito"><?php 
                $number = "$ca";
                echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?>
    </td>
    
    <th class="forms" colspan="0" scope="row">L.LIQ.OFERTADO:</th>
    
    <td align="right" class="credito">
                <?php
                    //if ($ll == 400 or > 400){ 
                     //   $number = $vo;
                
                       // elseif ($ll < 400){
                            $number = "$ll";
                        //}
                   // }
                    echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?>
    </td>
    
    
    <th class="forms" colspan="0" scope="row">V.OFERTADO:</th>
    
    
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
    
    <th class="forms" colspan="0" scope="row">L.LIQ.MIN.OFERTAR:</th>
    
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
    
    
    <th class="forms" colspan="0" scope="row">V.MIN.OFERTAR:</th>
    
    
    <!--<td align="right" class="greenyellow"><?php 
                //$number = "$vo";
                //echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?>
    </td>-->
    <td align="right" class="yellow"><?php 
                $number = "$vmo";
                echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?>
    </td>
    
    
  </tr>


    <tr>
        <td colspan="19">Total de itens: <?php echo $c ?></td>
        
    </tr>
</table>
  </table>
  <br><br>
</table>
