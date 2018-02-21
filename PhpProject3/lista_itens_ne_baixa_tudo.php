<?php
require "conecta.php";
//require_once "cabecalho_reduzido.php";
//require_once "cabecalho_lote.php";

//print_r ($_REQUEST);
// se o GET[order] for vazio, então será preenchido com um valor padrão
if(empty($_REQUEST[order])) $_REQUEST[order] = 'desc_prod_baixa';
    
$sql = "SELECT * FROM cad_produto_baixa WHERE id_ne = {$_REQUEST[id_ne]} and id_itens_ne = {$_REQUEST[id_itens_ne]} order by {$_REQUEST[order]}";

$res = mysql_query($sql) or die("Erro seleção lista itens det tudo");

$v = 0; //conterá a somatória dos valores
$c = 0; //total de registros

//pega a primeira linha do resultado
$linha = mysql_fetch_assoc($res);

//print_r ($_REQUEST);
//require_once "pes_rapida_cad_tudo.php";


//require "tab_cab_itens_tudo.php";
?>



<br><br>

<table align="center" class="A" width="1000" border="1" cellpadding="3" cellspacing="0">
    
    <tr>
        <td class="forms" colspan="5" bgcolor="LemonChiffon" align="center"><strong>BAIXAS DO ESTOQUE / PRODUTOS ENCAMINHADOS</td>
    </tr>
    
  <tr>
                <th>QTDE BAIXADA</th>
                <th>DESCRIÇÃO / PRODUTOS</th>
                <th>VALOR UNITÁRIO CUSTO</th>
                <th>VALOR TOTAL CUSTO</th>
                <th>AÇÃO</th>
</tr>
      <?php

//enquanto houver linha
while($linha){
    $c++;                   //incrementa o total de linhas;
    $vtc += $linha[valor_custo_prod]*$linha[qtde_baixa];   //incrementa a $v o campo valor
    //$ca += $linha[custo_aprox];    //incrementa a $v o campo valor
    //$ll += $linha[lucro_liq];    //incrementa a $v o campo valor
    //$vo += $linha[vofertado];    //incrementa a $v o campo valor
    

    //mostra a linha
    //$linha agora é um vetor com as posições:
    //$linha[cod], $linha[nome], $linha[valor], etc...

//  Declarado aqui as variáveis que irão compor as colunas para utilizar na hora 
//  do pregão (criado as fórmulas para adicionar ao banco)
//  chama o arquivo que contem as variáveis
//require "var_formulas.php"

?>
      
 
<tr align="center">

    <td>&nbsp;<?php echo $linha[qtde_baixa] ?></td>
    <td>&nbsp;<?php echo $linha[desc_prod_baixa] ?></td>
    <td>&nbsp;<?php echo "R$"." ".number_format($linha[valor_custo_prod],2, ',','.');                         ?></td>
    <td>&nbsp;<?php 
                $number = $linha[valor_custo_prod]*$linha[qtde_baixa];
                echo "R$" .number_format($number,2, ',','.');
                
                ?>
    </td>
    <td align="center">
            
            <!--<a href="altera_subitens_ne.php?alterar=<?php echo $linha[id_subitem_ne]; ?>"><img src="imagens/edit.png" border="0"/></a>-->
            <a href="conf_itens_ne_baixa.php?apagar=<?php echo $linha[id_cad_prod_baixa]; ?>&id_ne=<?php echo $linha[id_ne];?>&id_itens_ne=<?php echo $_REQUEST[id_itens_ne];?>&num_ne=<?php echo $_REQUEST[num_ne];?>&desc_prod_baixa=<?php echo $linha[desc_prod_baixa];?>&id_cad_prod=<?php echo $linha[id_cad_prod];?>"><img src="imagens/delete.png" border="0"/></a>
    </td>
 </tr>

  <?php
//require "tab_cont_itens_tudo.php";

    //pega a próxima linha
    $linha = mysql_fetch_assoc($res);
}
//require_once "rel_licita.php";

//echo '<br>';
?>
  
  
  <tr>
      <td colspan="5" ><br></td>
  </tr>
  <tr>
    <th class="forms" colspan="3" scope="row">TOTAL:</th>
    <!--<td>R$</td>
    <td>&nbsp;</td>
    <td>R$</td>
    <td>R$</td>-->
    <td colspan="1" align="left" class="debito"><?php 
                $number = $vtc;
                echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?>
    </td>
  </tr>
    
    <!--
    <th align="right" class="forms" colspan="">
        APAGAR SUB-ITEM N°:
    </th>
    <form action="conf_sub_itens_exc.php" method="POST">
    <td align="center" class="apagar_itens" colspan="0">
        <input type="text" name="sub_item_exc" size="3" maxlength="3" value="">
    <td colspan="2" align="center" class="apagar_itens">
        <input type="submit" value="Apagar"> 
    </td>
    
  </tr>
    -->

    <tr>
        <td colspan="4">Total de sub-itens: <?php echo $c ?></td>
        
    </tr>
</table>
  <br><br>
</table>