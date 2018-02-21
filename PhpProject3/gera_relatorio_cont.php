<?php
require "conecta.php";
require_once "cabecalho_reduzido.php";
require_once "cabecalho_lote.php";
//require_once "selec_relatorio_ne.php";
include "css.php";
include "lib_datas.php";
include "constantes.php";
//print_r ($_POST[buscarne]);
//print_r ($_POST[status_ne]);
//print_r ($_POST[licitante]);
//print_r ($_POST[status_comissao]);
//die;


/*if (!empty($_POST[buscarcont])){
    $sql = "SELECT * FROM codigo,lote,notaempenho
        WHERE (codigo.codigo LIKE '%{$_POST[buscarcont]}%' or codigo.pregao LIKE '%{$_POST[buscarcont]}%' or notaempenho.num_ne LIKE '%{$_POST[buscarcont]}%' or codigo.orgao LIKE '%{$_POST[buscarcont]}%' or codigo.licitante LIKE '%{$_POST[buscarcont]}%') and (codigo.id_cod=lote.id_cod and lote.id_lote=notaempenho.id_lote)";
}

else {*/
    $sql = "SELECT * FROM codigo,lote,contrato
                WHERE codigo.id_cod=lote.id_cod
                    AND lote.id_lote=contrato.id_lote
                    
                        ORDER BY (date_add(data_ass_cont, interval prazo_gar month))
                            ASC";
    
    $sql2 = "SELECT * FROM codigo,lote,contrato,notaempenho,expedicao
                WHERE codigo.id_cod=lote.id_cod
                    AND lote.id_lote=contrato.id_lote
                    AND contrato.id_lote=notaempenho.id_lote
                    AND notaempenho.id_ne=expedicao.id_ne
                        ORDER BY (date_add(data_exp, interval prazo_gar month))
                            ASC";




//$sql = "SELECT codigo.*,lote.*,itens.*,subitens.* FROM
  //      codigo,lote,itens,subitens
    //    WHERE codigo.id_cod=lote.id_cod and lote.id_lote=itens.id_lote and itens.id_itens=subitens.id_item and lote.colocacao = 'arrematado'"
      //  ;
//echo "$sql";
//die;
$res = mysql_query($sql) or die("erro");
$res2 = mysql_query($sql2) or die("erro2");
$linha = mysql_fetch_assoc($res);
$linha2 = mysql_fetch_assoc($res2);
$registros = 0;
$llg = 0;

//echo $linha2[data_exp];
//print_r($linha);
//die;

?>
<br>
<table width="1020" align="center" class="A" border="1" cellpadding="2" cellspacing="0">
     <tr>
                <td colspan="9" align="center">
                    <font size="6"><b><strong>CONTRATOS SANTOS & MAYER<hr></td>
            </tr>
    
    
    
        <tr class="forms">
            
            <!--<th>Cod_int</th>-->
            <th align="center">Código</th>
            <th align="center">Pregão</a></th>
            <th align="center">Órgão</th>
            <th align="center">N° Contrato</th>
            <th align="center">Data Assinatura</a></th>
            <th align="center">Prazo Garantia</th>
            <th align="center">Vigência Garantia</th>
            <th align="center">Vale Como Empenho?</th>
            <th align="center">Baixar Contrato</th>
            
       </tr>
       
<?php
while($linha){
    $registros ++;
    ?>
    <tr>
        
        <td align="center">&nbsp;<?php echo $linha[codigo];?></td>
        <td align="center">&nbsp;<?php echo $linha[pregao];?></td>
        <td align="center">&nbsp;<?php echo $linha[orgao];?></td>        
        <td align="center">&nbsp;<a href="cad_contrato.php?id_lote=<?php echo $linha[id_lote]; ?>&id_cod=<?php echo $linha[id_cod];?>&num_cont=<?php echo $linha[num_cont]; ?>&id_contrato=<?php echo $linha[id_contrato];?>"><?php echo $linha[num_cont]                      ?></a></td>
        
        
        
        <td align="center">&nbsp;
            <?php
                    
                    $data_inicial = $linha[data_ass_cont];
                    $nova_data = SomarData($data_inicial,$linha[prazo_ent_ne]);
                    echo date('d/m/Y', strtotime($nova_data));
                    //echo inverte_data($nova_data);    
    
              ?>    
        </td>
        
        <td align="center">
            <?php 
                    if (!isset($linha[prazo_gar]))
                        echo " ";
                    else echo $linha[prazo_gar]." "."Meses"." ".$linha[mod_gar];?>
            
        </td>
        
        <td align="center">
            <?php 
                if ($linha2[id_contrato] == $linha[id_contrato]){
                    //while($linha2){

                        $vigencia_garantia = SomarData($linha2[data_exp],0,$linha[prazo_gar],0);
                        if ($vigencia_garantia >= date('Y/m/d'))
                        {
                            //echo date('d/m/Y');
                            echo date('d/m/Y', strtotime($vigencia_garantia))." - "."<font color='blue'>EM GARANTIA";
                        }
                        else if (!isset($linha[data_ass_cont]))
                        {
                            echo " ";
                        }
                        else
                        {
                            //echo date('d/m/Y');
                            echo date('d/m/Y', strtotime($vigencia_garantia))." - "."<font color='red'>GARANTIA VENCIDA";
                        }
                        //$linha2 = mysql_fetch_assoc($res2);
                    //}
                }
                else{
                    echo "AGUARDAR DATA EXP";
                }
                //}
                ?>
            
        </td>
        
        <td align="center">
            <?php if ($linha[vale_emp] == "Não")
                    {
                        echo $linha[vale_emp]." - "."<b>Aguardar chegada do empenho";
                    }
                        else if ($linha[vale_emp] == "Sim")
                        {
                            echo $linha[vale_emp]." - "."<b>Cadastrar empenho SISLICITA";
                        }
                        else echo " ";
                         
                                
                            
                       
                ?>
            
        </td>
        
        <td align="center">
            <?php
            
            $pasta = "Cod."." ".str_replace("/",".",$linha[codigo])."---".str_replace("/",".",$linha[orgao])."---"."Pregao"." ".str_replace("/",".",$linha[pregao])."-"."Lote"." ".$linha[lote];
            $EP="emprocesso/";
            $DEST="Contrato/";
            $uploaddir = $EP.$pasta."/".$DEST;
            
            include "lista_contratos_dir.php";
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
        <td colspan="9"><b>Total de registros:<?php echo $registros ?></td>
        <!--<td align="right"></td>-->
        
    </tr><br>