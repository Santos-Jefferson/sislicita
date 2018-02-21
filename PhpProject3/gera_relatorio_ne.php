<?php
require "conecta.php";
require_once "cabecalho_reduzido.php";
require_once "cabecalho_lote.php";
require_once "selec_relatorio_ne.php";
include "css.php";
include "lib_datas.php";
include "constantes.php";
//print_r ($_POST[buscarne]);
//print_r ($_POST[status_ne]);
//print_r ($_POST[licitante]);
//print_r ($_POST[status_comissao]);
//die;


if (!empty($_POST[buscarne])){
    $sql = "SELECT * FROM codigo,lote,notaempenho
        WHERE (codigo.codigo LIKE '%{$_POST[buscarne]}%' or codigo.pregao LIKE '%{$_POST[buscarne]}%' or notaempenho.num_ne LIKE '%{$_POST[buscarne]}%' or codigo.orgao LIKE '%{$_POST[buscarne]}%' or codigo.licitante LIKE '%{$_POST[buscarne]}%') and (codigo.id_cod=lote.id_cod and lote.id_lote=notaempenho.id_lote)";
}

elseif ($_POST[status_ne]=="Todos" and $_POST[licitante]=="Todos" and $_POST[status_comissao]=="Todos" and $_POST[ano_ref]=="Todos" and $_POST[mes_ref]=="Todos"){
    $sql = "SELECT * FROM codigo,lote,notaempenho
       WHERE codigo.id_cod=lote.id_cod and lote.id_lote=notaempenho.id_lote";// ORDER BY financeiro.data_pgto ASC";

}
elseif ($_POST[status_ne]=="Todos" and $_POST[licitante]=="Todos" and $_POST[status_comissao]=="Todos" and $_POST[ano_ref]=="$_POST[ano_ref]" and $_POST[mes_ref]=="$_POST[mes_ref]"){
    $sql = "SELECT * FROM codigo,lote,notaempenho,financeiro
       WHERE codigo.id_cod=lote.id_cod and lote.id_lote=notaempenho.id_lote and financeiro.id_ne=notaempenho.id_ne and (YEAR(financeiro.data_pgto) = '{$_POST[ano_ref]}') and (MONTH(financeiro.data_pgto) = '{$_POST[mes_ref]}') ORDER BY financeiro.data_pgto ASC";

}

elseif ($_POST[status_ne]=="$_POST[status_ne]" and $_POST[licitante]=="Todos" and $_POST[status_comissao]=="Todos" and $_POST[ano_ref]=="$_POST[ano_ref]" and $_POST[mes_ref]=="Todos"){
    $sql = "SELECT * FROM codigo,lote,notaempenho,financeiro
       WHERE codigo.id_cod=lote.id_cod and lote.id_lote=notaempenho.id_lote and financeiro.id_ne=notaempenho.id_ne and (YEAR(financeiro.data_pgto) = '{$_POST[ano_ref]}') and notaempenho.status_ne='{$_POST[status_ne]}' ORDER BY financeiro.data_pgto ASC";

}



elseif ($_POST[status_ne]=="Todos" and $_POST[licitante]=="Todos" and $_POST[status_comissao]=="$_POST[status_comissao]"){
    $sql = "SELECT * FROM codigo,lote,notaempenho,financeiro
       WHERE codigo.id_cod=lote.id_cod and lote.id_lote=notaempenho.id_lote and notaempenho.id_ne=financeiro.id_ne and financeiro.status_comissao='$_POST[status_comissao]' ORDER BY orgao ASC, codigo ASC, lote ASC";

}

elseif ($_POST[status_ne]=="Todos" and $_POST[licitante]=="$_POST[licitante]" and $_POST[status_comissao]=="$_POST[status_comissao]"){
    $sql = "SELECT * FROM codigo,lote,notaempenho,financeiro
       WHERE codigo.id_cod=lote.id_cod and lote.id_lote=notaempenho.id_lote and notaempenho.id_ne=financeiro.id_ne and codigo.licitante='$_POST[licitante]' ORDER BY orgao ASC, codigo ASC, lote ASC";

}

elseif ($_POST[status_ne]=="$_POST[status_ne]" and $_POST[licitante]=="Todos" and $_POST[status_comissao]=="Todos"){
    $sql = "SELECT * FROM codigo,lote,notaempenho
       WHERE codigo.id_cod=lote.id_cod and lote.id_lote=notaempenho.id_lote and notaempenho.status_ne='$_POST[status_ne]' ORDER BY data_rec_ne ASC, codigo ASC, lote ASC";

}

/*
elseif ($_POST[licitante]=="Todos" and $_POST[status_comissao]=="Todos"){
    $sql = "SELECT * FROM codigo,lote,notaempenho,financeiro
       WHERE notaempenho.status_ne='{$_POST[status_ne]}' and codigo.id_cod=lote.id_cod and lote.id_lote=notaempenho.id_lote and notaempenho.id_ne=financeiro.id_ne ORDER BY orgao ASC, codigo ASC, lote ASC";
}
elseif ($_POST[status_ne]=="Todos" and $_POST[licitante]=="Todos"){
    $sql = "SELECT * FROM codigo,lote,notaempenho,financeiro
       WHERE financeiro.status_comissao='{$_POST[status_comissao]}' and codigo.id_cod=lote.id_cod and lote.id_lote=notaempenho.id_lote and notaempenho.id_ne=financeiro.id_ne ORDER BY orgao ASC, codigo ASC, lote ASC";
}
elseif ($_POST[status_ne]=="Todos" and $_POST[status_comissao]=="Todos"){
    $sql = "SELECT * FROM codigo,lote,notaempenho,financeiro
       WHERE codigo.licitante='{$_POST[licitante]}' and codigo.id_cod=lote.id_cod and lote.id_lote=notaempenho.id_lote and notaempenho.id_ne=financeiro.id_ne ORDER BY orgao ASC, codigo ASC, lote ASC";
}

elseif ($_POST[status_ne]=="Todos"){
    $sql = "SELECT * FROM codigo,lote,notaempenho,financeiro
       WHERE codigo.licitante='{$_POST[licitante]}' and financeiro.status_comissao='{$_POST[status_comissao]}' and codigo.id_cod=lote.id_cod and lote.id_lote=notaempenho.id_lote and notaempenho.id_ne=financeiro.id_ne ORDER BY orgao ASC, codigo ASC, lote ASC";
}
elseif ($_POST[licitante]=="Todos"){
    $sql = "SELECT * FROM codigo,lote,notaempenho,financeiro
       WHERE notaempenho.status_ne='{$_POST[status_ne]}' and financeiro.status_comissao='{$_POST[status_comissao]}' and codigo.id_cod=lote.id_cod and lote.id_lote=notaempenho.id_lote and notaempenho.id_ne=financeiro.id_ne ORDER BY orgao ASC, codigo ASC, lote ASC";
}
elseif ($_POST[status_comissao]=="Todos"){
    $sql = "SELECT * FROM codigo,lote,notaempenho,financeiro
       WHERE notaempenho.status_ne='{$_POST[status_ne]}' and codigo.licitante='{$_POST[licitante]}' and codigo.id_cod=lote.id_cod and lote.id_lote=notaempenho.id_lote and notaempenho.id_ne=financeiro.id_ne ORDER BY orgao ASC, codigo ASC, lote ASC";
}

*/
else{

$sql = "SELECT * FROM codigo,lote,notaempenho,financeiro
       WHERE financeiro.status_comissao='{$_POST[status_comissao]}' and notaempenho.status_ne='{$_POST[status_ne]}' and codigo.licitante='{$_POST[licitante]}' and codigo.id_cod=lote.id_cod and lote.id_lote=notaempenho.id_lote and notaempenho.id_ne=financeiro.id_ne ORDER BY data_pgto";
}
//$sql = "SELECT codigo.*,lote.*,itens.*,subitens.* FROM
  //      codigo,lote,itens,subitens
    //    WHERE codigo.id_cod=lote.id_cod and lote.id_lote=itens.id_lote and itens.id_itens=subitens.id_item and lote.colocacao = 'arrematado'"
      //  ;
//echo "$sql";
//die;
$res = mysql_query($sql) or die("erro");
$linha = mysql_fetch_assoc($res);
$registros = 0;
$llg = 0;

//print_r($linha);
//die;

?>
<br>
<table width="1020" align="center" class="A" border="1" cellpadding="2" cellspacing="0">
    <tr class="">
        <td COLSPAN="2">
            <b><font size="6"> <?php echo "STATUS:";?>
        </td>
        <td colspan="8">
            <b><font size="6"><?php
                    if ($_POST[status_ne]=="Todos"){
                        echo "Todos";
                    }
                    else {
                        echo $linha[status_ne];
                        
                    }
            ?>
            
            
        </td>
        
    </tr>
    <tr class="">
        <td COLSPAN="2">
            <b><font size="6"> <?php echo "LICITANTE:";?>
        </td>
        <td colspan="8">
            <b><font size="6"><?php
                    if ($_POST[licitante]=="Todos"){
                        echo "Todos";
                    }
                    else {
                        echo $linha[licitante];
                        
                    }
            ?>
            
            
        </td>
        
    </tr>
        <tr class="forms">
            
            <!--<th>Cod_int</th>-->
            <th align="center">Código</th>
            <th align="center">Pregão</a></th>
            <th align="center">Número NE</th>
            <th align="center">Órgão</th>
            <th align="center">Data Limite Entrega</th>
            <th align="center">Valor Empenhado</th>
            <th align="center">Lucro Liquido NE</th>
            <th align="center">Comissão Licitante</th>
            <th align="center">Data Recbto Órgão</th>
            <th align="center">Status Comissão</th>
            
            <!--<th align="center">Lucro liquido</th>-->
            <!--<th align="center">Item</th>-->
            <!--<th align="center">V. Ganho/Ofertado</th>
            <th align="center">Lucro Líquido</th>-->
            <!--<th align="center">Status</th>-->
            <!--<th align="center">Histórico/OBS</th>-->
       </tr>
       
<?php
while($linha){
    $registros ++;
    ?>
    <tr>
        
        <td align="center">&nbsp;<a href=lista_licita_tudo.php?codigo=<?php echo $linha[codigo];?>><?php echo $linha[codigo]                         ?></a></td>
        <td align="center">&nbsp;<?php
                        echo $linha[pregao];
                        //echo date('d/m/Y', strtotime($data))." "."/"." ".$linha[hora];          ?></td>
        <td align="center">&nbsp;<a href="relatorio_ne_tudo.php?id_lote=<?php echo $linha[id_lote]; ?>&id_cod=<?php echo $linha[id_cod];?>&num_ne=<?php echo $linha[num_ne]; ?>&id_ne=<?php echo $linha[id_ne];?>"><?php echo $linha[num_ne]                      ?></a>  </td>
        <td align="center">&nbsp;<?php echo $linha[orgao];?></td>        <?php
/*
            $sql2 = "SELECT * FROM codigo,lote,itens
                    WHERE codigo.id_cod='{$linha[id_cod]}' and lote.id_lote='{$linha[id_lote]}' and codigo.id_cod=lote.id_cod and lote.id_lote=itens.id_lote and lote.colocacao='{$_POST[status]}' ORDER BY orgao ASC, codigo ASC, lote ASC";


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
                $lucrogeral += $ll;*/
                ?>
        
        
        <td align="center">&nbsp;
            <?php
                    
                    $data_inicial = $linha[data_rec_ne];
                    $nova_data = SomarData($data_inicial,$linha[prazo_ent_ne]);
                    echo date('d/m/Y', strtotime($nova_data));
                    //echo inverte_data($nova_data);    
    
                    //print "$linha[data_rec_ne]";
                    //$nextdate = addDayIntoDate($linha[data_rec_ne],20);
                    //echo date('d/m/Y', strtotime($nextdate));
                    //echo "$_GET[hora]"
                    //print $nextdate."<br>";
                    //echo date('d/m/Y', strtotime($linha[data_rec_ne]));
              ?>    
        </td>
        
        
        
        
        
        
        <?php
                $sql_valor = "SELECT * FROM notaempenho,itens_ne WHERE notaempenho.id_ne=itens_ne.id_ne and notaempenho.id_ne={$linha[id_ne]}";
                $res_valor= mysql_query($sql_valor) or die ("erro res_valor");
                $linha_valor=  mysql_fetch_array($res_valor);
                
                $sql_exp = "SELECT * FROM notaempenho,expedicao WHERE notaempenho.id_ne=expedicao.id_ne and notaempenho.id_ne={$linha[id_ne]}";
                $res_exp= mysql_query($sql_exp) or die ("erro res_valor");
                $linha_exp=  mysql_fetch_array($res_exp);
                $vf=$linha_exp[vfrete_exp];
                
                $sql_finan = "SELECT * FROM notaempenho,financeiro WHERE notaempenho.id_ne=financeiro.id_ne and notaempenho.id_ne={$linha[id_ne]}";
                $res_finan= mysql_query($sql_finan) or die ("erro res_valor");
                $linha_finan=  mysql_fetch_array($res_finan);
                $dp=$linha_finan[data_pgto];
                
                $vuc=0;
                $vi=0;
                
                
            while ($linha_valor){
                //$vuc=0;
                //$vi=0;
                $vuc +=($linha_valor[qtde]*$linha_valor[vunitcusto]);
                $vi +=($linha_valor[qtde]*$linha_valor[vitem]);
                
                $linha_valor=mysql_fetch_array($res_valor);
            }
            
            ?>
        
        
        <td align="right">
            <?php
                $number=$vi;
                echo "R$" .number_format($number,2, ',','.');
            ?>
        </td>
        
        <td align="right">
            <?php
            $vimposto=0;       
                        if (($linha[uf]=="Ceará - CE")or($linha[uf]=="Mato Grosso do Sul - MS")or($linha[uf]=="Mato Grosso - MT")){
                        $porc_ceara=10;
                            }
                            else{
                                $porc_ceara=0;
                                }            
                        $vimposto=($vi*($porc_sn+$linha_cod_lote[perc_icms]+$porc_ceara)/100);
            
            
            $sql2= "SELECT * FROM cad_produto_baixa WHERE id_ne = {$linha[id_ne]}";
                            $res2= mysql_query($sql2) or die("Erro seleção listagem cad_produto_baixa em lista_itens_ne_tudo");
                            $linha_cad_baixa = mysql_fetch_assoc($res2);
                            $soma = 0;
                            $valor_custo_total = 0;
                            if(($linha_cad_baixa) and !empty($linha_cad_baixa)){
                                    while($linha_cad_baixa){
                                    $valor_custo_total += ($linha_cad_baixa[valor_custo_prod]*$linha_cad_baixa[qtde_baixa]);    
                                    $number=$vi-($valor_custo_total+($vimposto)+$vf);
                                    $ll=$number;
                                    $linha_cad_baixa = mysql_fetch_assoc($res2);
                                    }
                                    echo "R$" .number_format($number,2, ',','.');
                            }
                                else{
            
            
                $number=$vi-($vuc+($vimposto)+$vf);
                $ll=$number;
                echo "R$" .number_format($number,2, ',','.');
                }
            ?>
        </td>
        
        <td align="right">
            <?php
                $number=$ll*4/100;
                echo "R$" .number_format($number,2, ',','.');
            ?>
        </td>
        
        <td align="center">
            <?php
            
            if ((empty($dp)) or ($dp=="0000-00-00")){
                echo "";
            }
                else{
                    echo date('d/m/Y', strtotime($dp));
                }
            
            
            ?>
        </td>
        <td align="center">
            <?php
            if (($linha[status_ne]=="Cancelada") or ($linha[status_ne]=="Aguardando Parecer Órgão")){
                echo $linha[status_ne];
            }
            else{
                echo $linha_finan[status_comissao];
            }
            ?>
            
        </td>
        
         
 </tr>

    
<?php
    //lucro liquido geral para o relatório (ultima linha)    
    $vot +=$vi;
    $llg +=$ll;
    
    $linha = mysql_fetch_assoc($res);
   }
  ?>
    <tr class="forms">
        <td colspan="6"><b>Total de registros:<?php echo $registros ?></td>
        <!--<td align="right"></td>-->
        <td align="right" colspan="9">  <b>Total Geral(Faturamento):<?php
                                                    $number = $vot;
                                                    echo "R$" .number_format($number,2, ',','.');
                                                    
                                                ?>
            
                                        <br><br>Total Lucro Líquido:<?php   
                                                    $number = $llg;
                                                    echo "R$" .number_format($number,2, ',','.');
                                                    
                                                ?>
                                        <br><br>Total Comissões Pagas/A Pagar:<?php
                                                    $number = $llg*4/100;
                                                    echo "R$" .number_format($number,2, ',','.');
                                                    
                                                ?>
                                        <br><br>Média % Lucro:<?php
                                                    $number = ($llg*100)/$vot;
                                                    echo number_format($number,2, ',','.')."%";
                                                    
                                                ?>
        </td>
        <!--<td colspan=""align="right">-->
        
    </tr><br>