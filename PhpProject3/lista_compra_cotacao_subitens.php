<?php

require "conecta.php";
require_once "cabecalho_reduzido_sem_teste.php";
require_once "cabecalho_lote.php";
//require_once "cabecalho.php";
require_once "css.php";

//print_r ($usuario);
//print_r ($senha);
//die;

$sql = "select * from subitens_ne2,itens_ne,notaempenho where subitens_ne2.id_itens_ne=itens_ne.id_itens_ne and itens_ne.id_ne=notaempenho.id_ne and notaempenho.status_ne='Em cotação' and subitens_ne2.modelo_si!='' order by modelo_si";
$res = mysql_query($sql) or die('erro lista compra cotação');
$linha = mysql_fetch_array($res);
?>
<table width="1000" align="center" class="A" border="1" cellpadding="2" cellspacing="0">
    <!--</table>-->
<!--<table width="1020" align="center" class="A" border="1" cellpadding="2" cellspacing="0">-->
    <tr class="forms">
            
        <th colspan="11" bgcolor="yellow" align="center">PRODUTOS PARA COMPRA - EM COTAÇÃO - <a href="lista_compra_cotacao_imp.php">IMPRESSÃO</a></th>
        </tr>
        
        <tr class="">
            <!--<th>Cod_int</th>-->
            <th align="center">QTDE TOTAL</th>
            <th align="center">DESCRIÇÃO</th>
            <th align="center">VALOR UNIT. PROPOSTA</th>
            <th align="center">FORN</th>
            
        </t>
<?php
//enquanto houver linha
while($linha){
    $c++;                   //incrementa o total de linhas;
    $qtde_total = $linha[qtde]*$linha[qtde_si];
    $v+= $qtde_total*$linha[vunitcusto_si];
    
    ?>
    
     <tr>
         <td align="center">&nbsp;
             <?php
                 echo "<a href='cad_ne.php'>$qtde_total";
             
             ?>
         </td>
         <td align="center">&nbsp;
             <?php
                echo "$linha[nome_subitem]/$linha[marca_si]/$linha[modelo_si]";
                
             ?>
                    </td>
         <td width="80" align="right">&nbsp;<?php echo "R$"." ".number_format($linha[vunitcusto_si],2, ',','.');                    ?></td>
         <td width="80" align="center">&nbsp;<?php echo $linha[forn_si]                   ?></td>
         
<?php

    $linha = mysql_fetch_array($res);
}
?>
    <tr>
        <td colspan="2">Total de registros: <?php echo $c ?></td>
        <td colspan="2" align="right">Total: <?php echo "R$"." ".number_format($v,2, ',','.');?></td>
    
    <br>
    </tr><br>
    
 <?php
require "lista_compra_cotacao_itens.php";
 
?>













