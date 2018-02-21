<?php
require ("cabecalho_reduzido.php");
require ("cabecalho_lote.php");
require "cabecalho_html.php";
require "conecta.php";
include "css.php";
include "lib_datas.php";
include "constantes.php";
//print_r($_REQUEST);die;

   
$sql_cod_lote = "SELECT * FROM codigo,lote,notaempenho
                    WHERE codigo.id_cod={$_REQUEST[id_cod]} and
                          lote.id_lote={$_REQUEST[id_lote]} and
                          notaempenho.id_lote={$_REQUEST[id_lote]} and
                          notaempenho.id_ne={$_REQUEST[id_ne]}
                          ";
$res_cod_lote = mysql_query($sql_cod_lote) or die("Erro seleção - res_ne");
$linha_cod_lote = mysql_fetch_assoc($res_cod_lote);
//echo sql_cod_lote;die;

$sql = "SELECT * FROM itens_ne where id_lote = {$_REQUEST[id_lote]}";
$res = mysql_query($sql) or die("Erro seleção - res_ne");
$linha = mysql_fetch_assoc($res);


?>



<br>
<table align="center" class="A" border="1" width="1010">
<table align="center" class="A" width="1010" border="0" cellpadding="3" cellspacing="0">
    
       
    <tr>
        <td class="forms" colspan="9" bgcolor="LemonChiffon" align="center"><strong><h2>LISTAGEM LICITAÇÃO N°<a href="lista_licita_tudo.php?codigo=<?php echo $linha_cod_lote[codigo];?>"><?php echo $linha_cod_lote[codigo] ?></a> e LOTE/GRUPO N° <?php echo $linha_cod_lote[lote] ?></h2></td>
    </tr>
    
  <tr>
    <th width="" >TIPO</th>
    <!--<th width="" scope="col">CÓDIGO</th>-->
    <th width="" >PREGÃO</th>  
    <th width="" >ÓRGÃO</th>
    <!--<th width="" scope="col">DATA/HORA</th>-->
    <!--<th width="" scope="col">LOTE/GRUPO</th>-->
    <th width="" scope="col">LICITANTE</th>
    <!--<th >AÇÃO</th>-->
    <th >STATUS LOTE</th>
    <th >NÚM NE</th>
    
  </tr>
  <tr>
    <td align="center"><?php echo $linha_cod_lote[tipo_licitacao] ?></td>
    <!--<td align="center"><?php //echo $linha_cod_lote[codigo] ?></td>-->
    <td align="center"><?php echo $linha_cod_lote[pregao] ?></td>
    <td align="center"><?php echo $linha_cod_lote[orgao] ?></td>
    
    
    <td align="center"><?php echo $linha_cod_lote[licitante] ?></td>
    
    <td class="" align="center"><?php echo $linha_cod_lote[colocacao] ?></td>
    <td class="" align="center"><?php echo $_GET[num_ne] ?><a href="cad_ne.php?id_itens=<?php echo $linha[id_itens];?>&id_lote=<?php echo $linha_cod_lote[id_lote]; ?>&id_cod=<?php echo $linha_cod_lote[id_cod]; ?>"><img src="imagens/ne.png" border="0"/></a>                </td>
    
  </tr>
  
  </table><BR><BR>
</table>
    
<table align="center" class="A" width="1010" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="3"><div align="center">
      <h2>DATAS E PREVISÕES</h2>
    </div></td>
  </tr>
  <tr>
    <td width="187"><strong>Data Proposta:</strong></td>
    <td width="605" colspan="2"><?php
                        $data = "$linha_cod_lote[data_proposta]";
                        echo date('d/m/Y', strtotime($data));
                        ?></td>
  </tr>
  <tr>
    <td><strong>Data Recebimento NE:</strong></td>
    <td colspan="2"><?php
                        $data = "$linha_cod_lote[data_rec_ne]";
                        echo date('d/m/Y', strtotime($data));
                        ?></td>
  </tr>
  <tr>
    <td><strong>Previsão de Entrega:</strong></td>
    <td colspan="2"><?php
                    
                    $data_inicial = $linha_cod_lote[data_rec_ne];
                    $nova_data = SomarData($data_inicial,$linha_cod_lote[prazo_ent_ne]);
                    echo date('d/m/Y', strtotime($nova_data));    
    
                    //print "$linha[data_rec_ne]";
                    //$nextdate = addDayIntoDate($linha[data_rec_ne],20);
                    //echo date('d/m/Y', strtotime($nextdate));
                    //echo "$_GET[hora]"
                    //print $nextdate."<br>";
                    //echo date('d/m/Y', strtotime($linha[data_rec_ne]));
              ?></td>
  </tr>
</table>
  <table align="center" class="A" width="1010" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="7"><div align="center">
      <h2>DESCRIÇÃO PRODUTOS / EQUIPAMENTOS</h2>
    </div></td>
  </tr>
  <tr>
  
  <?php
  
  require "lista_itens_ne_tudo.php";

  ?>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
</table>

<?php
$sql = "SELECT * FROM notaempenho,expedicao
                    WHERE notaempenho.id_ne=expedicao.id_ne
                    and notaempenho.id_ne={$linha_cod_lote[id_ne]}
                          ";
$res = mysql_query($sql) or die("Erro seleção - res_ne");
$linha2 = mysql_fetch_assoc($res);

?>

<table align="center" class="A" width="1010" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="3"><div align="center">
      <h2>DADOS DE EXPEDIÇÃO</h2>
    </div></td>
  </tr>
  <tr>
    <td width="187"><strong>Núm. NFE Saída:</strong></td>
    <td width="605" colspan="2"><?php echo $linha2[num_nfe];?></td>
  </tr>
  <tr>
    <td width="187"><strong>Qtde Volumes:</strong></td>
    <td width="605" colspan="2"><?php echo $linha2[qtde_vol];?></td>
  </tr>
  <tr>
    <td><strong>Peso em KG:</strong></td>
    <td colspan="2"><?php echo $linha2[peso_kg]." "."KG";?></td>
  </tr>
  <tr>
    <td><strong>Transportadora:</strong></td>
    <td colspan="2"><?php echo $linha2[transportadora_exp];?></td>
  </tr>
  <tr>
    <td><strong>Valor Frete:</strong></td>
    <td colspan="2"><?php
                       
                        echo "R$" .number_format($linha2[vfrete_exp],2, ',','.');?>
    
    
  </tr>
  <tr>
    <td><strong>Prev. Entrega Transportadora:</strong></td>
    <td width="605" colspan="2"><?php echo $linha2[prev_entrega_exp];?></td>
    
    
  </tr>
  <tr>
    <td><strong>Data da expedição:</strong></td>
    <td colspan="2"><?php
                        echo date('d/m/Y', strtotime($linha2[data_exp]));?>
    </td>
  </tr>
</table>
<?php
$sql = "SELECT * FROM notaempenho,financeiro
                    WHERE notaempenho.id_ne=financeiro.id_ne
                    and notaempenho.id_ne={$linha_cod_lote[id_ne]}
                          ";
$res = mysql_query($sql) or die("Erro seleção - res_ne");
$linha3 = mysql_fetch_assoc($res);

?>

<table align="center" class="A" width="1010" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="3"><div align="center">
      <h2>DADOS FINANCEIROS</h2>
    </div></td>
  </tr>
  <tr>
    <td width="187"><strong>Previsão Recbto Pgto:</strong></td>
    <td width="605" colspan="2"><?php
                                    $data_inicial = $linha2[data_exp];
                                    $nova_data = SomarData($data_inicial,$linha_cod_lote[data_prev_pgto]);
                                    
                                    $data_inicial2 = $nova_data;
                                    $nova_data2 = SomarData($data_inicial2,$linha2[prev_entrega_exp]);
                                    //echo inverte_data($nova_data); 
                                    echo date('d/m/Y', strtotime($nova_data2));?></td>
  </tr>
  <tr>
    <td><strong>Lucro Líquido:</strong></td>
    <td colspan="2"><?php
                        $vimposto=0;       
                        if (($linha_cod_lote[uf]=="Ceará - CE")or($linha_cod_lote[uf]=="Mato Grosso do Sul - MS")or($linha_cod_lote[uf]=="Mato Grosso - MT")){
                        $porc_ceara=11;
                            }
                            else{
                                $porc_ceara=0;
                                }            
                        $vimposto=($vo*($porc_sn+$linha_cod_lote[perc_icms]+$porc_ceara)/100);

    
    
                        if ($valor_custo_total){
                            $ll = ($vo-($valor_custo_total+($vimposto)+$linha2[vfrete_exp]+$vs+$vsedex));
                            echo "R$" .number_format($ll,2, ',','.');
                            //echo "R$" .number_format($vs,2, ',','.');
                            //echo "R$" .number_format($vsedex,2, ',','.');
                        }
                        else {
                            $ll = ($vo-($vc+($vimposto)+$linha2[vfrete_exp]));
                            echo "R$" .number_format($ll,2, ',','.');
                            //echo "R$" .number_format($linha2[vfrete_exp],2, ',','.');
                            //echo $linha[vofertado]
                            }
                        ?>
    </td>
  </tr>
  <tr>
    <td><strong>Lucro(%):</strong></td>
    <td colspan="2"><?php
                        $number = ($ll*100)/$vo;
                        echo number_format($number,2, ',','.')."%";
?>
    </td>
  </tr>
  <tr>
    <td><strong>Data do Recbto Pgto:</strong></td>
    <td colspan="2">
        <?php
            
            if ((empty($linha3[data_pgto])) or ($linha3[data_pgto]=="0000-00-00")){
                echo "";
            }
                else{
                    echo date('d/m/Y', strtotime($linha3[data_pgto]));
                }
            
            
            ?>
        
        
      
    </td>
  </tr>
  <tr>
    <td><strong>Licitante:</strong></td>
    <td colspan="2"><?php echo $linha_cod_lote[licitante];?></td>
  </tr>
  <tr>
    <td><strong>Valor da comissão:</strong></td>
    <td colspan="2"><?php
                        $com = $ll*4/100;
                        echo "R$" .number_format($com,2, ',','.');
                        //echo $linha[vofertado]
                    ?>
    </td>
  </tr>
  <tr>
    <td><strong>Status comissionamento:</strong></td>
    <td colspan="2"><?php echo $linha3[status_comissao];?></td>
  </tr>
</table>

<table align="center" class="A" width="1010" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="3"><div align="center">
      <h2>OUTRAS INFORMAÇÕES</h2>
    </div></td>
  </tr>
  <tr>
    <td width="187"><strong>Status da NE:</strong></td>
    <td width="605" colspan="2"><?php echo $linha_cod_lote[status_ne];?></td>
  </tr>
  <tr>
    <td><strong>Histórico da NE:</strong></td>
    <td width="605" colspan="2"><?php echo $linha3[historico_obs_finan];?></td>
  </tr>
  
</table>
</table>
</html>
        
