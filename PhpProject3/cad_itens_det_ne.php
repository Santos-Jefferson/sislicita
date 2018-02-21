<?php
require "conecta.php";
require "cabecalho_html.php";
//require ("cabecalho_reduzido.php");
//require ("cabecalho_lote.php");
//require ("corpo_menu.php");
//exibir a tabela com os pré-cadastros feitos.
//require ("pesquisa_licita.php");

//======================VALIDAÇÃO E CONVERSÃO DE DADOS=====================
//validação só funcionará quando não for a primeira vez que entra-se no formulario
//!empty (se não for vazio, faça os testes abaixo)
if (!empty($_POST)){

//-------------CAMPO codigo-------------------------

//não pode ser vazio o campo (campo obrigatório)
    if (empty($_POST[qtde_si])){
        $erro = $erro_qtde_si = true;
        }
        
    if (empty($_POST[ro_subitem])){
        $erro = $erro_ro_subitem = true;
        }
    
//-------------CAMPO orgão-------------------------

//não pode ser vazio o campo (campo obrigatório)
   // if (empty($_POST[marca_si])){
        //$erro = $erro_marca_si = true;
        //}
    
//--------------CAMPO data-------------------------
//teste se é uma data gregoriana válida
//quebra a data em 3 partes
//após o slit, teremos o vetor $v em 3 pedaços: v[0] = dia, v[1] = mes, v[2] = ano
//$v = split('[/.-]', $_POST[data]);

//testa se a data é válida

//@ na frente da função é para inibir o warning, use com cuidado!!!
//if(!@checkdate($v[1], $v[0], $v[2])){
  //      $erro = $erro_data = true;
//}
//se deu certo, converte a data
//else {
    //$_POST[data] = $v[2].'-'.$v[1].'-'.$v[0];
//}

//-------------CAMPO hora-------------------------
//não pode ser vazio o campo (campo obrigatório)
   // if (empty($_POST[modelo_si])){
      //  $erro = $erro_modelo_si = true;
       // }
        
//-------------CAMPO licitante-------------------------
//não pode ser vazio o campo (campo obrigatório)
    if (empty($_POST[sub_itens])){
        $erro = $erro_sub_itens = true;
        }
    
    
//-------------CAMPO licitante-------------------------
//não pode ser vazio o campo (campo obrigatório)
    if (empty($_POST[vunitcusto_si])){
        $erro = $erro_vunitcusto_si = true;
        }
    }
    
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

    <form action="<?php if ($erro or empty($_POST)) echo "cad_itens_det_ne.php?id_item=$_GET[id_item]";
                            else echo "grava_itens_det_ne.php"; ?>" method="POST" name="cad_itens_det_ne">
                            
       
        <table align="center" width="" border="1" class="A" cellpading="0" cellspacing="0" >
            <tr class="debito">
                <td colspan="8" align="center"><strong>CADASTRE AQUI OS SUB-ITENS DO SEU ITEM<hr></td>
            </tr>
            
            
            <tr class="forms">
                <th>QTDE</th>
                <th>SUB-ITEM</th>
                <th>MARCA</th>
                <th>MODELO/DESCRIÇÃO</th>
                <th>V.UNIT.CUSTO</th>
                <th>V.TOT.CUSTO</th>
                <th>OBS/FORNECEDOR</th>
                <th>REG.OPORT.?</th>
            </tr>

            <tr>
                <td width=""><input type="text" name="qtde_si" size="5" maxlength="5" id="res_qtde_si" value="<?php echo $_POST[qtde_si]; ?>">
                <?php
                        if($erro_qtde_si){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
                
                
                <td width=""><input type="text" name="sub_itens" size="10" maxlength="50" value="<?php echo $_POST[sub_itens]; ?>">
                    <?php
                        if($erro_sub_itens){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
                
                <td width=""><input type="text" name="marca_si" size="10" maxlength="50" value="<?php echo $_POST[marca_si]; ?>">
                <?php
                        if($erro_marca_si){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
                <td width=""><input type="text" name="modelo_si" size="50" maxlength="2000" value="<?php echo $_POST[modelo_si]; ?>">
                <?php
                        if($erro_modelo_si){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
                
                <td width=""><input type="text" name="vunitcusto_si" size="10" maxlength="10" id="res_vunitcusto_si" onblur="cal_vtotcusto_si()"value="<?php echo $_POST[vunitcusto_si]; ?>">
                <?php
                        if($erro_vunitcusto_si){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
                <td width=""><input type="text" class="forms"name="vtotcusto_si" size="10" maxlength="10" id="res_vtotcusto_si" value="<?php echo $_POST[vtotcusto_si]; ?>"></td>
                <td width=""><input type="text" name="obs_si" size="20" maxlength="100" value="<?php echo $_POST[obs_si]; ?>"></td>                        
                
                <td align="left">
                    <select name="ro_subitem" size="0" >
                        <option><?php echo $_POST[ro_subitem]; ?></option>
                        <option>Sim</option>
                        <option>Não</option>
                    </select>
                    <?php
                        if($erro_ro_subitem){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="10"><input type="hidden" name="id_item" value="<?php echo $_GET[id_item]; ?>"></td>
                <?php
                //$sql = "Select * from subitens where id_item = {$_GET[id_item]}";
                //$res = mysql_query($sql);
                //$linha = mysql_fetch_assoc($res);
                ?>
                <!--<td><input type="hidden" name="id_subitem" value="<?php //echo $linha[id_subitem]; ?>"></td>-->
                
            </tr>
            
            
            
            <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                    echo '<script language="javascript">document.cad_itens_det_ne.submit()</script>';
                }
            
            ?>
            <tr>
                <td colspan="8" align="right"><input type="submit" value="Cadastrar" /></td>
                
            </tr>
        </form>  
</tr>
</table>

<?php
//print_r ($_REQUEST);
require "lista_itens_det_tudo_ne.php";
?>