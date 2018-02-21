<?php
require "conecta.php";
require_once "cabecalho_reduzido.php";
require_once "cabecalho_lote.php";
require "selec_relatorio.php";
require "css.php";

/*if (empty($_REQUEST[order])){
    $_REQUEST[order]='data';
}
elseif (empty($_REQUEST[ascdesc])){
    $_REQUEST[ascdesc]=DESC;
}
*/

//QUERY TODOS EM TODOS
if ($_POST[licitante]=="Todos" and $_POST[status]=="Todos" and $_POST[ano]=="Todos"){
    $sql = "SELECT * FROM codigo,lote
                WHERE
                    codigo.id_cod=lote.id_cod
                        ORDER BY
                            tipo_licitacao DESC,
                            codigo ASC,
                            lote ASC";// and lote.colocacao='{$_POST[status]}' and codigo.licitante='{$_POST[licitante]}' ORDER BY data DESC, codigo ASC, lote ASC";
}

//QUERY RP VIGENTES TODOS
elseif ($_POST[licitante]=="Todos" and $_POST[status]=="RP Vigentes" and $_POST[ano]=="Todos"){
    
    $sql = "SELECT * FROM codigo,lote,itens2
                WHERE
                    codigo.id_cod=lote.id_cod and
                    lote.id_lote=itens2.id_lote and
                    codigo.tipo_licitacao='RP' and
                    lote.adj_data!='0000-00-00' and
                    lote.adj_data>=DATE_SUB(CURDATE(), INTERVAL 395 DAY)
                        ORDER BY
                            adj_data DESC,
                            lote ASC";
    
    
}


//QUERY TODOS RPS, TODOS ANOS POR LICITANTE
elseif ($_POST[licitante]=="$_POST[licitante]" and $_POST[status]=="RP Vigentes" and $_POST[ano]=="Todos"){
    $sql = "SELECT * FROM codigo,lote,itens2
                WHERE
                    codigo.id_cod=lote.id_cod and
                    lote.id_lote=itens2.id_lote and
                    codigo.licitante='{$_POST[licitante]}' and
                    codigo.tipo_licitacao='RP' and
                    lote.adj_data!='0000-00-00' and
                    lote.adj_data>=DATE_SUB(CURDATE(), INTERVAL 395 DAY)
                        ORDER BY
                            tipo_equip,
                            adj_data ASC,
                            lote ASC ";
}

//QUERY SOLICITADO PARCIAL TODOS LICITANTES, TODOS ANOS
elseif ($_POST[licitante]=="Todos" and $_POST[status]=="Solicitado Parcial" and $_POST[ano]=="Todos"){
    
    $sql = "SELECT * FROM codigo,lote,itens2
                WHERE
                    codigo.id_cod=lote.id_cod and
                    lote.id_lote=itens2.id_lote and
                    codigo.tipo_licitacao='RP' and
                    lote.colocacao='Solicitado Parcial' and
                    lote.adj_data!='0000-00-00' and
                    lote.adj_data>=DATE_SUB(CURDATE(), INTERVAL 395 DAY)
                        ORDER BY
                            adj_data DESC,
                            lote ASC";
}

//QUERY SOLICITADO PARCIAL, TODOS ANOS POR LICITANTE
elseif ($_POST[licitante]=="$_POST[licitante]" and $_POST[status]=="Solicitado Parcial" and $_POST[ano]=="Todos"){
    $sql = "SELECT * FROM codigo,lote,itens2
                WHERE
                    codigo.id_cod=lote.id_cod and
                    lote.id_lote=itens2.id_lote and
                    codigo.licitante='{$_POST[licitante]}' and
                    codigo.tipo_licitacao='RP' and
                    lote.colocacao='Solicitado Parcial' and
                    lote.adj_data!='0000-00-00' and
                    lote.adj_data>=DATE_SUB(CURDATE(), INTERVAL 395 DAY)
                        ORDER BY
                            tipo_equip,
                            adj_data ASC,
                            lote ASC ";
}

//QUERY PARA TODOS OS ANOS, TODOS LICITANTES, de acordo com o STATUS
elseif ($_POST[licitante]=="Todos" and $_POST[status]=="$_POST[status]" and $_POST[ano]=="Todos"){
    $sql = "SELECT * FROM codigo,lote
                WHERE
                    codigo.id_cod=lote.id_cod and
                    lote.colocacao='{$_POST[status]}' and
                    lote.adj_data!='0000-00-00' and
                    lote.adj_data>=DATE_SUB(CURDATE(), INTERVAL 395 DAY)
                        ORDER BY
                            data DESC,
                            tipo_licitacao ASC,
                            lote ASC";
}

//QUERY PARA TODOS OS ANOS
elseif ($_POST[licitante]=="$_POST[licitante]" and $_POST[status]=="$_POST[status]" and $_POST[ano]=="Todos"){
    $sql = "SELECT * FROM codigo,lote
                WHERE
                    codigo.id_cod=lote.id_cod and
                    lote.colocacao='{$_POST[status]}' and
                    codigo.licitante='{$_POST[licitante]}'
                        ORDER BY
                            data DESC,
                            tipo_licitacao ASC,
                            lote ASC";
}


//QUERY PARA TODOS OS LICITANTES
elseif ($_POST[licitante]=="Todos" and $_POST[status]=="$_POST[status]" and $_POST[ano]=="$_POST[ano]"){
    $sql = "SELECT * FROM codigo,lote
                WHERE
                    codigo.id_cod=lote.id_cod and
                    lote.colocacao='{$_POST[status]}' and
                    YEAR(codigo.data)='{$_POST[ano]}'
                        ORDER BY
                            data DESC,
                            tipo_licitacao ASC,
                            lote ASC";
}

//QUERY SEM NENHUM PREDEFINIDO
elseif ($_POST[licitante]=="$_POST[licitante]" and $_POST[status]=="$_POST[status]" and $_POST[ano]=="$_POST[ano]"){
    $sql = "SELECT * FROM codigo,lote
                WHERE
                    codigo.id_cod=lote.id_cod and
                    lote.colocacao='{$_POST[status]}' and
                    codigo.licitante='{$_POST[licitante]}' and
                    YEAR(codigo.data)='{$_POST[ano]}'
                        ORDER BY
                            data DESC,
                            tipo_licitacao ASC,
                            lote ASC";
}

//QUERY ELSE
else {
    $sql = "SELECT * FROM codigo,lote
                WHERE
                    codigo.id_cod=lote.id_cod and
                    codigo.licitante='{$_POST[licitante]}'
                        ORDER BY
                            tipo_licitacao DESC,
                            codigo ASC,
                            lote ASC";
}

//$sql = "SELECT codigo.*,lote.*,itens.*,subitens.* FROM
  //      codigo,lote,itens,subitens
    //    WHERE codigo.id_cod=lote.id_cod and lote.id_lote=itens.id_lote and itens.id_itens=subitens.id_item and lote.colocacao = 'arrematado'"
      //  ;
//echo "$sql";
//die;

//QUERY PARA PEGAR SALDO DE QUANTIDADES DAS RPS 




$res = mysql_query($sql) or die("erro");

//$res_qtde = mysql_query_($sql_qtde_disp_ata) or die("erro qtde ata");
$linha = mysql_fetch_assoc($res);

$registros = 0;
$lucrogeral = 0;

//echo "teste123";
//die;

?>
<br>
<table width="1020" align="center" class="A" border="1" cellpadding="2" cellspacing="0">
        <tr class="forms">
            <!--<th>Cod_int</th>-->
            <th align="center">Órgão</a></th>
            <th align="center">Código</th>
            <!--<th align="center">Data/Hora (Disputa)</a></th>-->
            <th align="center">Data (Adjudicação)</a></th>
            <!--<th align="center">Licitante</th>-->
            <!--<th align="center">Tipo Equip.</th>-->
            <th align="center">Lote/Grupo</th>
            <th align="center">AT/RP</th>
            <th align="center"><font color="blue">Qtde</th>
            <th align="center"><font color="blue">Descrição</th>
            <!--<th align="center">Status</th>-->
            <th align="center"><font color="blue">V.Ofert / V.M.O</th>
            <th align="center"><font color="blue">Lucro liquido</th>
            <th align="center">Porc Lucro</th>
            <th align="center"><font color="red">Qtde Saldo</th>
            <th align="center"><font color="red">V. Ofertado Saldo</th>
            <th align="center"><font color="red">Lucro Líquido Saldo</th>
            <!--<th align="center">Concorrente</th>
            <th align="center">Marca/Modelo</th>
            <th align="center">Valor/(% DIF)</th>-->
            
            <!--<th align="center">V. Ganho/Ofertado</th>
            <th align="center">Lucro Líquido</th>-->
            
            <!--<th align="center">Histórico/OBS</th>-->
       </tr>
       
<?php
while($linha){
    $registros ++;
    ?>
    <tr>
        <td align="left"><!--<a href="historico.php" target="popupwindow" onclick='window.open("historico.php", "popupwindow", "scrollbars=yes,width=700,height=250");return true'>--><?php echo $linha[orgao]                          ?><!--</a>--></td>
        <td align="center"><a href=lista_licita_tudo.php?codigo=<?php echo $linha[codigo];?>><?php echo $linha[codigo]                         ?></a></td>
        <!--<td align="center">&nbsp;<?php
                        $data = $linha[data];
                        echo date('d/m/Y', strtotime($data))." "."/"." ".$linha[hora];          ?></td>-->
        <td align="center"><?php
                        if (!empty($linha[adj_data]) and ($linha[adj_data]!="0000-00-00")){
                        $data = $linha[adj_data];
                        echo date('d/m/Y', strtotime($data));
                        }
                        else{
                            echo "";
                        }
                        ?>
        
        </td>
        
        <!--<td align="center">&nbsp;<?php echo $linha[licitante]                      ?></td>-->
        <!--<td align="center">&nbsp;<?php echo $linha[tipo_equip]."/".$linha[marca_item]                      ?></td>-->
        <td align="center"><a href=cad_itens2.php?id_cod=<?php echo $linha[id_cod];?>&id_lote=<?php echo $linha[id_lote];?>&lote=<?php echo $linha[lote];?>&codigo=<?php echo $linha[codigo];?>&licitante=<?php echo $linha[licitante];?>&data=<?php echo $linha[data];?>&hora=<?php echo $linha[hora];?>&orgao=<?php echo $linha[orgao];?>><?php echo $linha[lote]                           ?></td></a>
        <td align="center"><?php echo $linha[tipo_licitacao]                      ?></td>
        
        
        <!--<td align="center">&nbsp;<?php echo $linha[colocacao]                           ?></td>-->
        <?php
            //QUERY PARA SELECIONAR OS SALDOS DOS ATAS DE REGISTRO DE PREÇOS
            $sql_saldo = "SELECT itens2.qtde AS qtde_lote,itens_ne.qtde AS qtde_ne,lote,orgao,(itens2.qtde-itens_ne.qtde) AS saldo FROM codigo,lote,itens2,itens_ne
                            WHERE
                                codigo.id_cod=lote.id_cod and
                                lote.id_lote=itens2.id_lote and
                                codigo.id_cod='{$linha[id_cod]}' and
                                lote.id_lote='{$linha[id_lote]}' and
                                itens2.id_lote=itens_ne.id_lote and
                                codigo.tipo_licitacao='RP' and
                                lote.adj_data!='0000-00-00' and
                                lote.adj_data>=DATE_SUB(CURDATE(), INTERVAL 395 DAY)
                                    GROUP BY
                                        itens_ne.id_lote";
                                    
        
        

            $sql2 = "SELECT * FROM codigo,lote,itens2
                    WHERE codigo.id_cod='{$linha[id_cod]}' and lote.id_lote='{$linha[id_lote]}' and codigo.id_cod=lote.id_cod and lote.id_lote=itens2.id_lote
                    GROUP BY lote
                    ORDER BY orgao ASC, codigo ASC, lote ASC";
                    
            if (($_POST[status]=="A receber Ata/Contrato") or ($_POST[status]=="A receber NE") or ($_POST[status]=="A receber Pgto")) {
            $sql3 = "SELECT * FROM lote,cad_concorrencia_2adj,lote_vmo
                    WHERE lote.id_lote='{$linha[id_lote]}' and lote.id_lote=cad_concorrencia_2adj.id_lote and lote.id_lote=lote_vmo.id_lote
                    ORDER BY lote ASC";                    
            }
            else if ($_POST[status]=="Arquivado"){
            $sql3 = "SELECT * FROM lote,cad_concorrencia_adj,lote_vmo
                    WHERE lote.id_lote='{$linha[id_lote]}' and lote.id_lote=cad_concorrencia_adj.id_lote and lote.id_lote=lote_vmo.id_lote
                    ORDER BY lote ASC";                    
                   
            }
            else {
            $sql3 = "SELECT * FROM lote,cad_concorrencia_2adj,lote_vmo
                    WHERE lote.id_lote='{$linha[id_lote]}' and lote.id_lote=cad_concorrencia_2adj.id_lote
                    ORDER BY lote ASC";                    
            }

                //echo "$sql";
                //die;
                $res_saldo = mysql_query($sql_saldo) or die("erro sql saldo");
                $linha_saldo = mysql_fetch_assoc($res_saldo);
            
            
                $res2 = mysql_query($sql2) or die("erro sql2");
                $res3 = mysql_query($sql3) or die("erro sql3");
                $linha2 = mysql_fetch_assoc($res2);
                $linha3 = mysql_fetch_assoc($res3);
                $vo = 0;
                $ll = 0;
                $pl = 0;
                
                //print_r($res2);

                while ($linha2){
               
                    $vo += $linha2[vofertado];
                    $ll += $linha2[lucro_liquido];
                    $pl += (($linha2[lucro_liquido]/$linha2[vofertado])*100);
                    
                    //include "lista_itens_minimos_teste.php";
                    
                    //$linha2 = mysql_fetch_assoc($res2);
                        echo "<td align='center'>$linha2[qtde]</td>";
                        echo "<td align='center'>$linha2[tipo_equip]</td>";
                    
                    
                    
                    $lucrogeral += $ll;
                    $vogeral += $vo;
                    $plucro += $pl;
                    
                    
                ?>
        <td align="center"><?php
                                    $number="$vo";
                                    echo "R$" .number_format($number,2, ',','.');
                                    $number_vmo="$linha3[lote_vmo3]";
                                    echo "/"."R$" .number_format($number_vmo,2, ',','.');
                                    
                                    ?>
        </td>
        <td align="center"><?php
                                    $number="$ll";
                                    echo "R$" .number_format($number,2, ',','.');
                                    
                                    ?>
        </td>
        
        <td align="center"><?php
                                    $number=(($ll/$vo)*100);
                                    echo number_format($number,2, ',','.')."%";
                                    ?>
        </td>
        <td align="center"><?php
                            while ($linha_saldo){
                    
                                    echo $linha_saldo[saldo];
                                    ?>
        </td>
        <td align="center"><?php
                                    $number=(($vo/$linha2[qtde])*$linha_saldo[saldo]);
                                    echo "R$" .number_format($number,2, ',','.');
                                    $vo_saldo = $number;
                                    ?>
        </td>
        <td align="center"><?php
                                    $number=($ll/$linha2[qtde])*$linha_saldo[saldo];
                                    echo "R$" .number_format($number,2, ',','.');
                                    $ll_saldo = $number;
                                    
                                    $llgeral_saldo += $ll_saldo;
                                    $vogeral_saldo += $vo_saldo;
                                    $linha_saldo = mysql_fetch_assoc($res_saldo);
    }
                                    ?>
        </td>
        
        <!--<td align="center"><?php echo $linha3[emp_2adj].$linha3[emp_adj]?></td>
        <td align="center"><?php echo $linha3[mar_2adj]." ".$linha3[mod_2adj].$linha3[mar_adj]." ".$linha3[mod_adj]?></td>
        <td align="center"><?php
                                //echo "$_POST[status]";
                                if($_POST[status]=="A receber Ata/Contrato")
                                {
                                    $number=($linha3[val_2adj]*$linha2[qtde]);
                                    $numberdif=($linha3[lote_vmo3]-(($linha3[val_2adj]*$linha2[qtde])));
                                    $numberperc=(($numberdif/$linha3[lote_vmo3])*100);
                                    
                                    echo "R$" .number_format($number,2, ',','.')."\n".
                                         "%" .number_format($numberperc,2, ',','.');
                                }
                                else if ($_POST[status]=="Arquivado")
                                {
                                    $number=($linha3[val_adj]*$linha2[qtde]);
                                    $numberdif=($linha3[lote_vmo3]-(($linha3[val_adj]*$linha2[qtde])));
                                    $numberperc=(($numberdif/$linha3[lote_vmo3])*100);
                                    
                                    echo "R$" .number_format($number,2, ',','.')."\n".
                                         "%" .number_format($numberperc,2, ',','.');
                                }
                                    
                                    ?>
        </td>-->
        
        <?php
     
        $linha2 = mysql_fetch_assoc($res2);
        
    }
?>
</tr>
   
<?php


    $linha3 = mysql_fetch_assoc($res3);    
    $linha = mysql_fetch_assoc($res);
}
?>
    <tr class="forms">
        <td colspan="7" align="right"><b>Total de registros:<?php echo $registros ?> / TOTAIS: </td>
        <!--<td align="right"></td>-->
        <td colspan=""><b><font color="blue"><?php
                                                    $number = $vogeral;
                                                    echo "R$" .number_format($number,2, ',','.');
                                                ?>
        </td>
        <td colspan=""><b><font color="blue"><?php
                                                    $number = $lucrogeral;
                                                    echo "R$" .number_format($number,2, ',','.');
                                                ?>
                
        <td colspan=""><b><font color="blue"><?php
                                                   $number=($plucro/$registros);
                                                    echo number_format($number,2, ',','.')."%";
                                                ?>                
        </td>
        <td colspan="" align="right"><b>TOTAIS: </td>
        <!--<td align="right"></td>-->
        <td colspan=""><b><font color="red"><?php
                                                    $number = $vogeral_saldo;
                                                    echo "R$" .number_format($number,2, ',','.');
                                                ?>
        </td>
        <td colspan=""><b><font color="red"><?php
                                                    $number = $llgeral_saldo;
                                                    echo "R$" .number_format($number,2, ',','.');
                                                ?>
        <!--<td colspan="3" align="center"><b>ANÁLISE DA CONCORRÊNCIA
        </td>
        <td colspan=""align="right">-->
        
    </tr><br>