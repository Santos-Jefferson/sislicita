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
$res = mysql_query($sql2) or die("Erro selecionando (altera_subitens.php)");
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
    <form action="grava_itens_det_ne.php" method="POST">
    <!--<form action="<?php //if ($erro or empty($_POST)) echo "altera_subitens.php?id_item=$_GET[id_item]&alterar=$_GET[id_item]";
                            //else echo "grava_itens_det.php?id_subitem=$linha[id_subitem]"; ?>" method="POST" name="alt_itens_det">-->
                            
       
        <table align="center" width="1000" border="1" class="A" cellpading="0" cellspacing="0" >
            <tr class="debito">
                <td colspan="8" align="center"><strong>ALTERE AQUI OS SUB-ITENS DO SEU ITEM<hr></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            
            <tr class="forms">
                <th>QTDE</th>
                <th>SUB-ITEM</th>
                <th>MARCA</th>
                <th>MODELO/DESCRIÇÃO</th>
                <th>V.UNIT.CUSTO</th>
                <th>REG> OPORT.?</th>
                <th>OBS/FORNECEDOR</th>
                
            </tr>

            <tr>
                <td width=""><input type="text" name="qtde_si" size="5" maxlength="5" id="res_qtde_si" value="<?php echo $linha[qtde_si]; ?>">
                <?php
                        //if($erro_qtde_si){
                          //  echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                    ?>
                </td>
                
                
                <td width=""><input type="text" name="sub_itens" size="10" maxlength="50" value="<?php echo $linha[nome_subitem]; ?>">
                    <?php
                        //if($erro_sub_itens){
                          //  echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                    ?>
                </td>
                
                <td width=""><input type="text" name="marca_si" size="10" maxlength="50" value="<?php echo $linha[marca_si]; ?>">
                <?php
                        //if($erro_marca_si){
                          //  echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                    ?>
                </td>
                <td width=""><input type="text" name="modelo_si" size="50" maxlength="1000" value="<?php echo $linha[modelo_si]; ?>">
                <?php
                        //if($erro_modelo_si){
                          //  echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                    ?>
                </td>
                
                <td width=""><input type="text" name="vunitcusto_si" size="10" maxlength="10" id="res_vunitcusto_si" onblur="cal_vtotcusto_si()"value="<?php echo $linha[vunitcusto_si]; ?>">
                <?php
                        //if($erro_vunitcusto_si){
                          //  echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                    ?>
                </td>
                
                <td align="left">
                    <select name="ro_si" size="0" >
                        <option><?php echo $linha[ro_si]; ?></option>
                        <option>Sim</option>
                        <option>Não</option>
                    </select></td>
                    
                    <td width=""><input type="text" name="forn_si" size="10" maxlength="500" value="<?php echo $linha[forn_si]; ?>">
                <?php
                        //if($erro_marca_si){
                          //  echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                    ?>
                </td>
            </tr>
            <tr>
                <td><input type="hidden" name="id_item" value="<?php echo $linha[id_item]; ?>"></td>
                <td><input type="hidden" name="id_subitem" value="<?php echo $linha[id_subitem]; ?>"></td>
                <td><input type="hidden" name="id_subitem_ne" value="<?php echo $linha[id_subitem_ne]; ?>"></td>
                <td><input type="hidden" name="id_itens_ne" value="<?php echo $linha[id_itens_ne]; ?>"></td>
            </tr>
            
            
            
            <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                    echo '<script language="javascript">document.alt_itens_det.submit()</script>';
                }
            
            ?>
            <tr>
                <td colspan="8" align="right"><input type="submit" value="Alterar" /></td>
                
            </tr>
        </form>  
</tr>
</table>
<?php

    
    //require "lista_itens_det_tudo.php";
    
?>