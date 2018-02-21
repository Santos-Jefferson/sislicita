<?php
require "conecta.php";
require_once "cabecalho_reduzido.php";
require_once "cabecalho_lote.php";
require "selec_relatorio.php";


//if ($_POST[licitante]=="Todos" and $_POST[status]=="Todos"){
    $sql = "SELECT * FROM codigo,lote,itens2,subitens2
       WHERE codigo.id_cod=lote.id_cod and lote.id_lote=itens2.id_lote and itens2.id_itens=subitens2.id_item and subitens2.ro_si='Sim' ORDER BY data DESC, codigo ASC, lote ASC";// and lote.colocacao='{$_POST[status]}' and codigo.licitante='{$_POST[licitante]}' ORDER BY data DESC, codigo ASC, lote ASC";
//}
/*
elseif ($_POST[licitante]=="Todos" and $_POST[status]=="$_POST[status]"){
    $sql = "SELECT * FROM codigo,lote
       WHERE codigo.id_cod=lote.id_cod and lote.colocacao='{$_POST[status]}' ORDER BY data DESC, codigo ASC, lote ASC";
}

elseif ($_POST[licitante]=="$_POST[licitante]" and $_POST[status]=="$_POST[status]"){
    $sql = "SELECT * FROM codigo,lote
       WHERE codigo.id_cod=lote.id_cod and lote.colocacao='{$_POST[status]}' and codigo.licitante='{$_POST[licitante]}' ORDER BY data DESC, codigo ASC, lote ASC";
}

else {
    $sql = "SELECT * FROM codigo,lote
       WHERE codigo.id_cod=lote.id_cod and codigo.licitante='{$_POST[licitante]}' ORDER BY data DESC, codigo ASC, lote ASC";
}
*/
//$sql = "SELECT codigo.*,lote.*,itens.*,subitens.* FROM
  //      codigo,lote,itens,subitens
    //    WHERE codigo.id_cod=lote.id_cod and lote.id_lote=itens.id_lote and itens.id_itens=subitens.id_item and lote.colocacao = 'arrematado'"
      //  ;
//echo "$sql";
//die;
$res = mysql_query($sql) or die("erro");
$linha = mysql_fetch_assoc($res);
$registros = 0;
$lucrogeral = 0;

//print_r($linha);
//die;

?>
<br>
<table width="1020" align="center" class="A" border="1" cellpadding="2" cellspacing="0">
        <tr class="forms">
            <!--<th>Cod_int</th>-->
            <th align="center">Órgão</a></th>
            <th align="center">Código</th>
            <th align="center">Data/Hora (Disputa)</a></th>
            <th align="center">Licitante</th>
            <th align="center">Lote/Grupo</th>
            <th align="center">V.Ofert/Ganho</th>
            <th align="center">Lucro liquido</th>
            <!--<th align="center">Item</th>-->
            <!--<th align="center">V. Ganho/Ofertado</th>
            <th align="center">Lucro Líquido</th>-->
            <th align="center">Status</th>
            <!--<th align="center">Histórico/OBS</th>-->
       </tr>
       
<?php
while($linha){
    $registros ++;
    ?>
    <tr>
        <td align="left">&nbsp;<!--<a href="historico.php" target="popupwindow" onclick='window.open("historico.php", "popupwindow", "scrollbars=yes,width=700,height=250");return true'>--><?php echo $linha[orgao]                          ?><!--</a>--></td>
        <td align="center">&nbsp;<a href=lista_licita_tudo.php?codigo=<?php echo $linha[codigo];?>><?php echo $linha[codigo]                         ?></a></td>
        <td align="center">&nbsp;<?php
                        $data = $linha[data];
                        echo date('d/m/Y', strtotime($data))." "."/"." ".$linha[hora];          ?></td>
        <td align="center">&nbsp;<?php echo $linha[licitante]                      ?></td>
        <td align="center">&nbsp;<a href=cad_itens2.php?id_cod=<?php echo $linha[id_cod];?>&id_lote=<?php echo $linha[id_lote];?>&lote=<?php echo $linha[lote];?>&codigo=<?php echo $linha[codigo];?>&licitante=<?php echo $linha[licitante];?>&data=<?php echo $linha[data];?>&hora=<?php echo $linha[hora];?>&orgao=<?php echo $linha[orgao];?>><?php echo $linha[lote]                           ?></td></a>

        <?php

            $sql2 = "SELECT * FROM codigo,lote,itens2
                    WHERE codigo.id_cod='{$linha[id_cod]}' and lote.id_lote='{$linha[id_lote]}' and codigo.id_cod=lote.id_cod and lote.id_lote=itens2.id_lote and lote.colocacao='{$_POST[status]}' ORDER BY orgao ASC, codigo ASC, lote ASC";


                //echo "$sql";
                //die;
                $res2 = mysql_query($sql2) or die("erro sql2");
                $linha2 = mysql_fetch_assoc($res2);
                $vo = 0;
                $ll = 0;

                while ($linha2){
               
                    $vo += $linha2[vofertado];
                    $ll += $linha2[voewer];
                    //$linha2 = mysql_fetch_assoc($res2);
                    $linha2 = mysql_fetch_assoc($res2);
                }
                $lucrogeral += $ll;
                $vogeral += $vo;
                
                ?>
        <td align="center">&nbsp;<?php
                                    $number="$vo";
                                    echo "R$" .number_format($number,2, ',','.');
                                    ?>
        </td>
        <td align="center">&nbsp;<?php
                                    $number="$ll";
                                    echo "R$" .number_format($number,2, ',','.');
                                    ?>
        </td>


        <!--<td align="center">&nbsp;<?php //echo $linha[item]                           ?></td>-->
        
        <!--<td align="right">&nbsp;<?php 
                //$number = "$vo";
                //echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?></td>
        <td align="right">&nbsp;<?php 
                //$number = "$ll";
                //echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?></td>-->
        <td align="center">&nbsp;<?php echo $linha[colocacao]                           ?></td>
        <!--<td align="left">&nbsp;<?php //echo $linha[historico]                           ?></td>-->
 </tr>

    
<?php
        //$lote = $linha[lote];
        //$vo += $linha[vofertado];
        //$ll += $linha[lucro_liq];
        
        
    
    $linha = mysql_fetch_assoc($res);
   }
  ?>
    <tr class="forms">
        <td colspan="5"><b>Total de registros:<?php echo $registros ?></td>
        <!--<td align="right"></td>-->
        <td colspan=""><b>Total V. Ofertado:<?php
                                                    $number = $vogeral;
                                                    echo "R$" .number_format($number,2, ',','.');
                                                ?>
        </td>
        <td colspan=""><b>Total Lucro liquido:<?php
                                                    $number = $lucrogeral;
                                                    echo "R$" .number_format($number,2, ',','.');
                                                ?>
        </td>
        <!--<td colspan=""align="right">-->
        
    </tr><br><?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
