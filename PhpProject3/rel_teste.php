<?php
require "conecta.php";
require_once "cabecalho_reduzido.php";
require_once "cabecalho_lote.php";

$sql = "SELECT * FROM codigo,lote,itens
       WHERE codigo.id_cod=lote.id_cod and lote.id_lote=itens.id_lote and lote.colocacao={$_GET[order]} ORDER BY colocacao ASC, codigo ASC, lote ASC";

//$sql = "SELECT codigo.*,lote.*,itens.*,subitens.* FROM
  //      codigo,lote,itens,subitens
    //    WHERE codigo.id_cod=lote.id_cod and lote.id_lote=itens.id_lote and itens.id_itens=subitens.id_item and lote.colocacao = 'arrematado'"
      //  ;
//echo "$sql";
//die;
$res = mysql_query($sql) or die("erro");
$linha = mysql_fetch_assoc($res);

//print_r($linha);
//die;

?>
<br>
<table width="1020" align="center" class="A" border="1" cellpadding="2" cellspacing="0">
        <tr>
            <!--<th>Cod_int</th>-->
            <th align="center">Órgão</a></th>
            <th align="center">Código</th>
            <th align="center">Data/Hora (Disputa)</a></th>
            <th align="center">Licitante</th>
            <th align="center">Lote/Grupo</th>
            <th align="center">Item</th>
            <!--<th align="center">V. Ganho/Ofertado</th>
            <th align="center">Lucro Líquido</th>-->
            <th align="center">Status</th>
       </tr>
       
<?php
while($linha){
    ?>
    <tr>
        <td align="left">&nbsp;<?php echo $linha[orgao]                          ?></td>
        <td align="center">&nbsp;<?php echo $linha[codigo]                         ?></td>
        <td align="center">&nbsp;<?php
                        $data = $linha[data];
                        echo date('d/m/Y', strtotime($data))." "."/"." ".$linha[hora];          ?></td>
        <td align="center">&nbsp;<?php echo $linha[licitante]                      ?></td>
        <td align="center">&nbsp;<?php echo $linha[lote]                           ?></td>
        <td align="center">&nbsp;<?php echo $linha[item]                           ?></td>
        
        <!--<td align="right">&nbsp;<?php 
                $number = "$vo";
                //echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?></td>
        <td align="right">&nbsp;<?php 
                $number = "$ll";
                //echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?></td>-->
        <td align="center">&nbsp;<?php echo $linha[colocacao]                           ?></td>
 </tr>
    
<?php
        //$lote = $linha[lote];
        //$vo += $linha[vofertado];
        //$ll += $linha[lucro_liq];
        
        
    
    $linha = mysql_fetch_assoc($res);
    }
  ?>