<?php

require "conecta.php";
require_once "cabecalho_reduzido_sem_teste.php";
require_once "cabecalho_lote.php";
//require_once "cabecalho.php";
require_once "css.php";

//print_r ($usuario);
//print_r ($senha);
//die;

$sql_i = "select * from itens_ne,notaempenho where itens_ne.id_ne=notaempenho.id_ne and notaempenho.status_ne='Em cotação' and itens_ne.modelo_item!='' order by modelo_item";
$res_i = mysql_query($sql_i) or die('erro lista compra cotação');
$linha_i = mysql_fetch_array($res_i);
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
while($linha_i){
    $d++;                   //incrementa o total de linhas;
    $qtde_total_i = $linha_i[qtde];
    $v_i+= $qtde_total_i*$linha_i[vunitcusto];
    
    ?>
    
     <tr>
         <td align="center">&nbsp;
             <?php
                 echo $qtde_total_i;
             
             ?>
         </td>
         <td align="center">&nbsp;
             <?php
             if(empty($linha_i[modelo_item])){
             echo VAZIO;    
             }
             else{
                echo "$linha_i[nome_item]/$linha_i[marca_item]/$linha_i[modelo_item]";
             }

             ?>
                    </td>
         <td width="80" align="right">&nbsp;<?php echo "R$"." ".number_format($linha_i[vunitcusto],2, ',','.');                    ?></td>
         <td width="80" align="center">&nbsp;<?php echo $linha_i[forn]                   ?></td>
         
<?php

    $linha_i = mysql_fetch_array($res_i);
}
?>
    <tr>
        <td colspan="2">Total de registros: <?php echo $d ?></td>
        <td colspan="2" align="right">Total: <?php echo "R$"." ".number_format($v_i,2, ',','.');?></td>
        
    
    <br>
    </tr><br>













