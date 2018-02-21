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
        
    if (empty($_POST[ro_si])){
        $erro = $erro_ro_si = true;
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
    if (empty($_POST[nome_subitem])){
        $erro = $erro_nome_subitem = true;
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

    <form action="<?php if ($erro or empty($_POST)) echo "cad_itens_det2.php?id_item=$_GET[id_item]";
                            else echo "grava_itens_det2.php"; ?>" method="POST" name="cad_itens_det2">
    <table align="center" border="0" width="1020" class="A" cellpading="0" cellspacing="0">
        <tr>
            <td>
            <table align="center" width="1010" border="0" class="A" cellpading="0" cellspacing="0" >
            
            <tr>
                <td class="forms" colspan="12" bgcolor="LemonChiffon" align="center"><strong>CADASTRE AQUI OS SUB-ITENS PARA O LOTE ESCOLHIDO</td>
                
                
            </tr>
            
            <tr>
                
                
                <td align="right">Forn.:<a href="cad_fornecedor.php" target="_black"><img src="imagens/inserir.png" border="0"/><a></td>
                <td colspan="0">
                    <select id="nome_forn" name="forn_si">
                        <?php
            
                            $nome_forn_query="SELECT nome_forn FROM cad_fornecedor ORDER BY nome_forn ASC";
                            $nome_forn_result=mysql_query($nome_forn_query) or die ("Falha ao recuperar o NOME_FORN da base de dados: ".mysql_error());
                            echo "<option>$_POST[forn_si]</option>";

                            while ($nome_forn_row=mysql_fetch_array($nome_forn_result)) {
                            $nome_forn=$nome_forn_row[nome_forn];
                                echo "<option>$nome_forn</option>";
                                }
                            
                        ?>
                    </select>
                    
                </td>
                
                <td align="right">Reg. Oport.?:<br></td>
                <td align="left">
                    <select name="ro_si" size="0" >
                        <option><?php echo $_POST[ro_si]; ?></option>
                        <option>Sim</option>
                        <option>Não</option>
                    </select>
                    <?php
                        //if($erro_ro_item){
                          //  echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                    ?>
                </td>
                
                <td align="right">Qtde:</td>
                <td><input type="text" name="qtde_si" size="4" maxlength="20" value="<?php echo $_POST[qtde_si]; ?>">
                    <?php
                        if($erro_qtde){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
                <td align="right">Nome Item:<br>
                <td colspan="0"><input type="text" name="nome_subitem" size="10" maxlength="20" value="<?php echo $_REQUEST[nome_subitem]; ?>"></td>
                <td align="right">Marca:<br>
                <td><input type="text" name="marca_si" size="10" maxlength="20" value="<?php echo $_REQUEST[marca_si]; ?>"></td>
                <td align="right">V.Un.Custo:R$</td>
                <td><input type="text" name="vunitcusto_si" size="10" maxlength="10" value="<?php echo $_POST[vunitcusto_si]; ?>">
                    <?php
                      //  if($erro_vunitcusto){
                        //    echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                    ?>
                    
                </td>
            </tr>
            <tr>
                
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
            
            <tr>
                    
                
                <td align="right">Modelo:<br>
                <td colspan="9"><input type="text" name="modelo_si" size="110" maxlength="50000" value="<?php echo $_REQUEST[modelo_si]; ?>">
                <td colspan="2" align="center"><input type="submit" value="Cadastrar Subitem" /></td>
     
                </td>
            </tr>
            <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                  echo '<script language="javascript">document.cad_itens_det2.submit()</script>';
                }
            ?>
          
          
            
        </form>  
</tr>
</table>

<?php
//print_r ($_REQUEST);
require "lista_itens_det_tudo2.php";
?>