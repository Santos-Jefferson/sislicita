<?php
require "conecta.php";
require_once "cabecalho_reduzido.php";
require_once "cabecalho_lote.php";
//print_r ($usuario);
//print_r ($senha);
//die;

// se o GET[order] for vazio, então será preenchido com um valor padrão
if(empty($_GET[order])) $_GET[order] = 'data';
if(empty($_GET[order2])) $_GET[order2] = 'hora';

//if($usuario == "admin"){

    $sql = "select * from codigo,lote,itens,subitens where codigo.id_cod=lote.id_cod and lote.id_lote=itens.id_lote and itens.id_itens=subitens.id_item and subitens.modelo_si LIKE '%{$_POST[itens]}%'
 ORDER BY {$_GET[order]} DESC, {$_GET[order2]} ASC";
    //}
    //else{
    
      //  $sql = "SELECT * FROM codigo WHERE licitante = '$usuario' and codigo LIKE '%{$_GET[codigo]}%' ORDER BY {$_GET[order]} DESC, {$_GET[order2]} ASC";
    //}
    
$res = mysql_query($sql) or die("Erro seleção - linha");

$v = 0; //conterá a somatória dos valores
$c = 0; //total de registros

//pega a primeira linha do resultado
$linha = mysql_fetch_assoc($res);

/*$sql2 = "SELECT * from lote WHERE id_cod = $linha[id_cod]";

$lotes2 = mysql_query($sql2) or die ("Erro seleção lotes2");

$linha_lote2 = mysql_fetch_assoc($lotes2);


$sql3 = "SELECT * from itens WHERE id_lote = $linha_lote2[id_lote]";

$lotes3 = mysql_query($sql3) or die ("Erro seleção lotes3");

$linha_lote3 = mysql_fetch_assoc($lotes3);
*/

//require_once "pes_rapida_cad_tudo.php";
?>
<table width="1020" align="center" class="A" border="1" cellpadding="2" cellspacing="0">
<tr class="">
    <td colspan="9">
        <b>LEGENDA TIPO:</b> AT = Aquisição Total, RP = Registro de Preços, DL = Dispensa Licitação, CC = Carta Convite
    </td>
</tr>
<!--</table>-->
<!--<table width="1020" align="center" class="A" border="1" cellpadding="2" cellspacing="0">-->
        <tr class="forms">
            <!--<th>Cod_int</th>-->
            <th align="center">Tipo</th>
            <th align="center"><a href="lista_licita_tudo.php?order=codigo">Cód. Licitação</a></th>
            <th align="center">Pregão n°</a></th>
            <th>Lote/Grupo</th>
            <th><a href="lista_licita_tudo.php?order=orgao">Órgão</a></th>
            <th><a href="lista_licita_tudo.php?order=data&order2=hora">Data</th>
            <th>Hora</th>
            <th><a href="lista_licita_tudo.php?order=licitante">Licitante</th>
            <th>Ação</th>
        </tr>
<?php
//enquanto houver linha
while($linha){
    $c ++;
    ?>
    <tr>
        <td align="left">&nbsp;<?php echo $linha[orgao]                          ?></td>
        <td align="center">&nbsp;<a href=lista_licita_tudo.php?codigo=<?php echo $linha[codigo];?>><?php echo $linha[codigo]                         ?></a></td>
        <td align="center">&nbsp;<?php
                        $data = $linha[data];
                        echo date('d/m/Y', strtotime($data))." "."/"." ".$linha[hora];          ?></td>
        <td align="center">&nbsp;<?php echo $linha[licitante]                      ?></td>
        <td align="center">&nbsp;<a href=cad_itens.php?id_cod=<?php echo $linha[id_cod];?>&id_lote=<?php echo $linha[id_lote];?>&lote=<?php echo $linha[lote];?>&codigo=<?php echo $linha[codigo];?>&licitante=<?php echo $linha[licitante];?>&data=<?php echo $linha[data];?>&hora=<?php echo $linha[hora];?>&orgao=<?php echo $linha[orgao];?>><?php echo $linha[lote]                           ?></td></a>

        <?php

            $sql2 = "SELECT * FROM codigo,lote,itens
                    WHERE codigo.id_cod='{$linha[id_cod]}' and lote.id_lote='{$linha[id_lote]}' and itens.id_itens='{$linha[id_itens]}' and codigo.id_cod=lote.id_cod and lote.id_lote=itens.id_lote ORDER BY orgao ASC, codigo ASC, lote ASC";


                //echo "$sql";
                //die;
                $res2 = mysql_query($sql2) or die("erro sql2");
                $linha2 = mysql_fetch_assoc($res2);
                $vo = 0;
                $ll = 0;

                while ($linha2){
               
                    $vo += $linha2[vofertado];
                    $ll += $linha2[lucro_liq];
                    //$linha2 = mysql_fetch_assoc($res2);
                    $linha2 = mysql_fetch_assoc($res2);
                }
                $lucrogeral += $ll;
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
        <td align="left">&nbsp;<?php echo $linha[historico]                           ?></td>
 </tr>

    
<?php
        //$lote = $linha[lote];
        //$vo += $linha[vofertado];
        //$ll += $linha[lucro_liq];
        
        
    
    $linha = mysql_fetch_assoc($res);
   }
  ?>
    <tr class="forms">
        <td colspan="6"><b>Total de registros:<?php echo $registros ?></td>
        <!--<td align="right"></td>-->
        <td colspan="3"><b>Total Lucro liquido:<?php
                                                    $number = $lucrogeral;
                                                    echo "R$" .number_format($number,2, ',','.');
                                                ?>
        </td>
        <!--<td colspan=""align="right">-->
        
    </tr><br>