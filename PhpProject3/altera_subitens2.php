<?php
require "conecta.php";
require_once "cabecalho_reduzido.php";
//require_once "cabecalho_lote.php";

//$sql = "SELECT * from lote WHERE id_cod = {$_GET[id_cod]}";
//$lote = mysql_query($sql) or die ("Erro seleção lote");
//$linha_lote = mysql_fetch_assoc($lote);

//print_r ($_GET);
//print_r ($_REQUEST);
//seleciona a linha q marquei no radio
$sql2 = "SELECT * FROM subitens2 WHERE id_subitem={$_REQUEST[alterar]}";
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
   <form action="grava_itens_det2.php" method="POST">
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
                            echo "<option>$linha[forn_si]</option>";

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
                        <option><?php echo $linha[ro_si]; ?></option>
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
                <td><input type="text" name="qtde_si" size="10" maxlength="20" value="<?php echo $linha[qtde_si]; ?>">
                    <?php
                        if($erro_qtde){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
                <td align="right">Nome Item:<br>
                <td colspan="0"><input type="text" name="nome_subitem" size="10" maxlength="20" value="<?php echo $linha[nome_subitem]; ?>"></td>
                <td align="right">Marca:<br>
                <td><input type="text" name="marca_si" size="10" maxlength="20" value="<?php echo $linha[marca_si]; ?>"></td>
                <td align="right">V.Un.Custo:R$</td>
                <td><input type="text" name="vunitcusto_si" size="10" maxlength="10" value="<?php echo $linha[vunitcusto_si]; ?>">
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
                <td colspan="9"><input type="text" name="modelo_si" size="130" maxlength="50000" value="<?php echo $linha[modelo_si]; ?>">
                <td colspan="2" align="center"><input type="submit" value="Alterar Subitem" /></td>
     
                </td>
            </tr>
            <tr>
                <td><input type="hidden" name="id_item" value="<?php echo $linha[id_item]; ?>"></td>
                <td><input type="hidden" name="id_subitem" value="<?php echo $linha[id_subitem]; ?>"></td>
                
            </tr>
            <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                  echo '<script language="javascript">document.cad_subitens2.submit()</script>';
                }
            ?>
          
          
            
        </form>    
</tr>
</table>
<?php

    
    //require "lista_itens_det_tudo.php";
    
?>