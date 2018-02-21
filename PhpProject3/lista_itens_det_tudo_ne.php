<?php
require "conecta.php";
//require_once "cabecalho_reduzido.php";
//require_once "cabecalho_lote.php";

//print_r ($_REQUEST);
// se o GET[order] for vazio, então será preenchido com um valor padrão
if(empty($_REQUEST[order])) $_REQUEST[order] = 'nome_subitem';
    
$sql = "SELECT * FROM subitens_ne2 WHERE id_itens_ne = {$_REQUEST[id_itens_ne]} order by {$_REQUEST[order]}";

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
        <td class="forms" colspan="9" bgcolor="LemonChiffon" align="center"><strong>LISTAGEM SUB-ITENS DO ITEM N° <?php echo $_GET[item] ?> e LOTE/GRUPO N° <?php echo $_GET[lote] ?></td>
    </tr>
    
  <tr>
                <th>QTDE</th>
                <th>SUB-ITENS</th>
                <th>MARCA</th>
                <th>MODELO/DESCRIÇÃO</th>
                <th>V.UNIT.CUSTO</th>
                <th>V.TOT.CUSTO</th>
                <th>OBS/FORNECEDOR</th>
                <th>RO?</th>
                <th>AÇÃO</th>
</tr>
      <?php

//enquanto houver linha
while($linha){
    $c++;                   //incrementa o total de linhas;
    $vtc += $linha[vunitcusto_si]*$linha[qtde_si];   //incrementa a $v o campo valor
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

<td>&nbsp;<a href="altera_sub_itens.php?alterar=<?php echo $linha[id_subitem]; ?>&lote=<?php echo $_GET[lote]; ?>&item=<?php echo $_GET[item]; ?>&id_item=<?php echo $_GET[id_item]; ?>&orgao=<?php echo $_GET[orgao]; ?>&data=<?php echo $_GET[data]; ?>&hora=<?php echo $_GET[hora]; ?>&licitante=<?php echo $_GET[licitante]; ?>&id_lote=<?php echo $_GET[id_lote]; ?>"><?php echo $linha[qtde_si] ?></a>
    </td>
    
    
    <td>&nbsp;<?php echo $linha[nome_subitem] ?></td>
    
    
    <td>&nbsp;<?php echo $linha[marca_si] ?></td>
   
    
    <td>&nbsp;<?php echo "$linha[modelo_si]"; ?></td>
   
    
    <td>&nbsp;<?php 
                $number = "$linha[vunitcusto_si]";
                echo "R$" .number_format($number,2, ',','.');
                ?>
    </td>
    
    <td>&nbsp;<?php 
                $number = $linha[vunitcusto_si]*$linha[qtde_si];
                echo "R$" .number_format($number,2, ',','.');
                
                ?>
    </td>
    <td>&nbsp;<?php echo $linha[forn_si] ?></td>
    <td>&nbsp;<?php echo $linha[ro_si] ?></td>
    
    <td align="center">
            
            <a href="altera_subitens_ne.php?alterar=<?php echo $linha[id_subitem_ne]; ?>&"><img src="imagens/edit.png" border="0"/></a>
            <a href="conf_subitens_exc.php?apagar=<?php echo "[$linha[sub_itens] $linha[marca_si] $linha[modelo_si];]"; ?>&id_item=<?php echo $linha[id_item]; ?>&id_subitem=<?php echo $linha[id_subitem]; ?>"><img src="imagens/delete.png" border="0"/></a>
        </td>
    
   <!-- <td align="center">&nbsp;<input type='button' value='Alterar'
               onclick='document.location.href="altera_subitens.php?alterar=<?php //echo $linha[id_subitem]; ?>"'> / 
                                 <input type='button' value='Excluir'
               onclick='document.location.href="conf_subitens_exc.php?apagar=<?php //echo "[$linha[sub_itens] $linha[marca_si] $linha[modelo_si];]"; ?>&id_item=<?php echo $linha[id_item]; ?>&id_subitem=<?php echo $linha[id_subitem]; ?>"'>
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
  
  
  <tr>
      <td colspan="9" ><br></td>
  </tr>
  <tr>
    <th class="forms" colspan="5" scope="row">TOTAL:</th>
    <!--<td>R$</td>
    <td>&nbsp;</td>
    <td>R$</td>
    <td>R$</td>-->
    <td colspan="4" align="left" class="debito"><?php 
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
        <td colspan="9">Total de sub-itens: <?php echo $c ?></td>
        
    </tr>
</table>
  <br><br>
</table>