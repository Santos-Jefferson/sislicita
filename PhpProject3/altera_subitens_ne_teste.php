<?php
require "conecta.php";
//require_once "cabecalho_reduzido.php";
//require_once "cabecalho_lote.php";

//$sql = "SELECT * from lote WHERE id_cod = {$_GET[id_cod]}";
//$lote = mysql_query($sql) or die ("Erro seleção lote");
//$linha_lote = mysql_fetch_assoc($lote);

//print_r ($_GET);
//print_r ($_REQUEST);
//seleciona a linha q marquei no radio
$sql2 = "SELECT * FROM subitens_ne2 WHERE id_subitem_ne={$_REQUEST[alterar]}";
//executa a query
$res = mysql_query($sql2) or die("Erro selecionando (altera_subitens_ne_teste.php)");
//desmonta o resutaldo e coloca os elementos do registro na linha
$linha = mysql_fetch_assoc($res);
//agora temos a linha preenchida com os dados do registro (acima)


/*if (!empty($linha)){
    
if (empty($linha[licitante]))    {
    $erro = $erro_licitante = true;
    }
  
if (empty($linha[codigo])){
    $erro = $erro_codigo = true;
    }

if (empty($linha[status])){
    $erro = $erro_status = true;
    }
}*/


    
//DESATIVADO
//----------------CAMPO vofertado-------------------
//validação só funcionará quando não for a primeira vez que entra-se no formulario
//!empty (se não for vazio, faça os testes abaixo)
//if (!empty($_POST)){
//    //troca , por .
//   $_POST[vofertado] = (str_replace(',','.',$_POST[vofertado]));
//    //
//    //testa se é numérico ou nao
//    if(!is_numeric($_POST[vofertado])){
//       $erro = $erro_vofertado = true;
//       }
//    //TESTE SE O valor está na faixa permitida
//    elseif($_POST[vofertado] <0 or $_POST[vofertado] > 100){
//        $erro = $erro_vofertado_faixa = true;
//    }
//}
include "css.php";
include "js_cad_alt_itens.php";
?>
<script language="Javascript">
function cal_vtotcusto_si(){
<!--calcula o vtotcusto no campo do formulário automaticamente ao ser inserido qtde e vunitcusto-->
document.getElementById("res_vtotcusto_si").value = '0'
var res_qtde_si = parseFloat(document.getElementById("res_qtde_si").value);
var res_vunitcusto_si = parseFloat(document.getElementById("res_vunitcusto_si").value);
document.getElementById("res_vtotcusto_si").value = res_qtde_si * res_vunitcusto_si;

}
</script>
    <!--<form action="grava_baixa_prod_ne.php" method="POST">-->
    <form action="<?php if ($erro or empty($_POST)) echo "altera_subitens_ne_teste.php?alterar=$_GET[alterar]";
                            else echo "grava_baixa_prod_ne.php"; ?>" method="POST" name="altera_subitens_ne_teste">
                            
       
        <table align="center" width="1000" border="0" class="A" cellpading="0" cellspacing="0" >
            <tr class="debito">
                <td colspan="10" align="center"><strong>ALTERE AQUI OS SUB-ITENS DO SEU ITEM<hr></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            
            <tr class="forms">
                <th>QTDE</th>
                <th>PRODUTO</th>
                <th>V.UNIT.CUSTO</th>
                
            </tr>

            <tr>
                <td width=""><input type="text" name="qtde_si" size="5" maxlength="5" id="res_qtde_si" value="<?php echo $linha[qtde_si]; ?>">
                <?php
                        //if($erro_qtde_si){
                          //  echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                    ?>
                </td>
                
                
                
                <td width="" align="left"><a href="javascript:abrir('cad_produto.php?');"><img src="imagens/inserir.png" border="0"/></a>
                 <select id="prod_baixa" name="prod_baixa">
                        <?php
            
                            $sql_prod="SELECT * FROM cad_produto";
                            $sql_prod_res=mysql_query($sql_prod) or die ("Falha ao recuperar o PRODUTO da base de dados");
                            //$sql_prod_row=mysql_fetch_array($sql_prod_res);
                            
                            while($sql_prod_row=mysql_fetch_assoc($sql_prod_res)){
                            $prod_baixa=$sql_prod_row[tipo_prod]." "."|"." ".$sql_prod_row[marca_prod]." "."|"." ".$sql_prod_row[desc_prod]." "."|"." ".$sql_prod_row[part_number]." "."|"." "."Qtde"." "."="." ".$sql_prod_row[qtde_estoque];
                            echo "<option>$prod_baixa</option>";
                            
                            //$id=$prod_baixa;    
                            }
                            
                        ?>
                     
                    </select>
                    
                </td>
                
                <td colspan="10" width=""><input type="text" name="vunitcusto_si" size="10" maxlength="10" id="res_vunitcusto_si" onblur="cal_vtotcusto_si()"value="<?php echo $linha[vunitcusto_si]; ?>">
                </td>
                
            </tr>
            <?php
                //print_r ($sql_prod_row);
                //die;
                $sql = "SELECT * FROM cad_produto where id_cad_prod='{$linha_id[id_cad_prod]}'";
                $res = mysql_query($sql) or die ("erro linha baixa");
                $linha_baixa = mysql_fetch_assoc($res);
                ?>
            <tr>
                <td><input type="hidden" name="id_item" value="<?php echo $linha[id_item]; ?>"></td>
                <td><input type="hidden" name="id_subitem" value="<?php echo $linha[id_subitem]; ?>"></td>
                <td><input type="hidden" name="id_subitem_ne" value="<?php echo $linha[id_subitem_ne]; ?>"></td>
                <td><input type="hidden" name="id_itens_ne" value="<?php echo $linha[id_itens_ne]; ?>"></td>
                <td ><input type="hidden" name="tipo_prod" value="<?php echo $linha_baixa[tipo_prod]; ?>">
                <td ><input type="hidden" name="marca_prod" value="<?php echo $linha_baixa[marca_prod]; ?>">
                <td ><input type="hidden" name="desc_prod" value="<?php echo $linha_baixa[desc_prod]; ?>">
                <td ><input type="hidden" name="id_cad_prod" value="<?php echo $linha_baixa[id_cad_prod]; ?>">
                
            </tr>
            
            <tr>
            
            
            <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                
                if(!$erro and !empty($_POST)){
                    echo '<script language="javascript">document.altera_subitens_ne_teste.submit()</script>';
                }
            
            ?>
            
                <td colspan="10" align="right"><input type="submit" value="Baixar Produto / Alterar" /></td>
                
            </tr>
        </form>  
</tr>
</table>
<?php

    
    //require "lista_itens_det_tudo.php";
    
?>