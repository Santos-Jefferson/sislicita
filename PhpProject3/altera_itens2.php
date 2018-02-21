<?php
require "conecta.php";
require_once "cabecalho_reduzido.php";
require_once "cabecalho_lote.php";

$sql = "SELECT * from lote WHERE id_cod = {$_GET[id_cod]}";
$lote = mysql_query($sql) or die ("Erro seleção lote");
$linha_lote = mysql_fetch_assoc($lote);

//print_r ($_GET);
//print_r ($_REQUEST);
//seleciona a linha q marquei no radio
$sql2 = "SELECT * FROM itens2 WHERE id_itens={$_REQUEST[alterar]}";
//executa a query
$res = mysql_query($sql2) or die("Erro selecionando (altera_precad.php)");
//desmonta o resutaldo e coloca os elementos do registro na linha
$linha = mysql_fetch_assoc($res);
//agora temos a linha preenchida com os dados do registro (acima)

$sql_subitens = "SELECT * FROM subitens2 WHERE id_item={$linha[id_itens]}";
//executa a query
$res_subitens = mysql_query($sql_subitens) or die("Erro selecionando (sql_subitens-altera_itens.php)");
//desmonta o resutaldo e coloca os elementos do registro na linha
$linha_subitens = mysql_fetch_assoc($res_subitens);
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

include "js_cad_alt_itens.php";

?>







<!--qtde: <input type="text" id="qtde" value="0"><br>
vunitcusto: <input type="text" id="vunitcusto" value="0" onblur="multiplicacao()"><br>
<b>vtotcusto:<input type="text" id="vtotcusto"></b>-->



<tr>
    <th colspan="2" height="159" align="left" class="A">
    <!-- o form deve conter a tag name="" para que possa ser submetido automatica-->
    
    <form action="grava_itens2.php" method="POST">
    <table align="center" border="0" width="1000" class="A" cellpading="0" cellspacing="0">
        <tr>
            <td>
            <table align="center" width="1000" border="0" class="A" cellpading="0" cellspacing="0" >
            
            <tr>
                <td class="forms" colspan="4" bgcolor="LemonChiffon" align="center"><strong>CADASTRE AQUI OS ITENS PARA O LOTE ESCOLHIDO</td>
                <td class="forms" colspan="3" align="right">
                    <a href="lista_licita_tudo.php?codigo=<?php echo $_REQUEST[codigo]; ?>"><strong>CÓD./UASG:
                </td>
                    <td class="forms" colspan="2">
                            <input type="text" name="codigo" size="20" maxlength="20" value="<?php echo $_REQUEST[codigo]; ?>" disabled></a>
                    </td>
                
                <td class="forms" align="right"><strong>LOTE:</td>
                <td class="forms"><input type="text" name="lote" size="3" maxlength="3" value="<?php echo $_REQUEST[lote]; ?>" disabled>
                
                
            </tr>
            
            <tr>
                
                
                <td align="right">Tipo(Frete).:<a href="cad_frete_medidas.php" target="_black"><img src="imagens/inserir.png" border="0"/><a></td>
                <td colspan="">
                    <select id="tipo_equip" name="tipo_equip">
                        <?php
            
                            $tipo_equip_query="SELECT tipo_equip FROM frete_medidas ORDER BY tipo_equip ASC";
                            $tipo_equip_result=mysql_query($tipo_equip_query) or die ("Falha ao recuperar o tipo_equip da base de dados: ".mysql_error());
                            echo "<option>$linha[tipo_equip]</option>";

                            while ($tipo_equip_row=mysql_fetch_array($tipo_equip_result)) {
                            $tipo_equip=$tipo_equip_row[tipo_equip];
                                echo "<option>
                                    $tipo_equip
                                </option>";
                            }
                        ?>
                    </select>
                        <?php
                            //if($erro_licitante){
                              //  echo "<font color=red>*** Campo obrigatório</font>";
                            //}
                        ?>
                </td>
                <td align="right">Forn.:<a href="cad_fornecedor.php" target="_black"><img src="imagens/inserir.png" border="0"/><a></td>
                <td colspan="4">
                    <select id="nome_forn" name="forn">
                        <?php
            
                            $nome_forn_query="SELECT nome_forn FROM cad_fornecedor ORDER BY nome_forn ASC";
                            $nome_forn_result=mysql_query($nome_forn_query) or die ("Falha ao recuperar o NOME_FORN da base de dados: ".mysql_error());
                            echo "<option>$linha[forn]</option>";

                            while ($nome_forn_row=mysql_fetch_array($nome_forn_result)) {
                            $nome_forn=$nome_forn_row[nome_forn];
                                echo "<option>$nome_forn</option>";
                                }
                            
                        ?>
                    </select>
                    
                </td>
                <td align="right">Item n°:</td>
                <td ><input type="text" name="item" size="4" maxlength="20" value="<?php echo $linha[item]; ?>">
                    <?php
                        if($erro_item){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
                <td align="right">Reg. Oport.?:<br></td>
                <td align="left">
                    <select name="ro_item" size="0" >
                        <option><?php echo $linha[ro_item]; ?></option>
                        <option>Sim</option>
                        <option>Não</option>
                    </select>
            <?php/*
                $sql_custo = "SELECT * FROM subitens2 WHERE id_item={$_REQUEST[id_itens]}";
                $res_custo = mysql_query($sql_custo) or die("Erro seleção lista itens det tudo2 CUSTO");
                $linha_custo = mysql_fetch_assoc($res_custo);
                
                while($linha_custo){
                
                $vtc += ($linha_custo[qtde_si]*$linha_custo[vunitcusto_si]);
                }*/
            ?>
                </td>
                
                
            </tr>
            <tr>
                
                    
                
            </tr>
            <tr>
                <td align="right">Qtde:</td>
                <td><input type="text" name="qtde" size="10" maxlength="20" value="<?php echo $linha[qtde]; ?>">
                    <?php
                        if($erro_qtde){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
                <td align="right">Nome Item:<br>
                <td colspan="4"><input type="text" name="nome_item" size="10" maxlength="20" value="<?php echo $linha[nome_item]; ?>"></td>
                <td align="right">Marca:<br>
                <td><input type="text" name="marca_item" size="10" maxlength="20" value="<?php echo $linha[marca_item]; ?>"></td>
                
                
                <td align="right">V.Un.Custo:R$</td>
                <td><input type="text" name="vunitcusto" size="10" maxlength="10" value="<?php echo $linha[vunitcusto]; ?>">
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
                    
                
                <td align="right"><a href="cad_itens_det2.php?id_item=<?php echo $linha[id_itens] ?>&id_subitem=<?php echo $linha_subitens[id_subitem]; ?>&tipo_equip=<?php echo $linha[tipo_equip]; ?>" target="popupwindow" onclick='window.open("cad_itens_det2.php?id_item=<?php echo $linha[id_itens] ?>&id_subitem=<?php echo $linha_subitens[id_subitem]; ?>&tipo_equip=<?php echo $linha[tipo_equip]; ?>", "popupwindow", "scrollbars=yes,width=1100,height=450");return true'>Modelo/Sub:</a><br></td>
                <td colspan="6"><input type="text" name="modelo_item" size="70" maxlength="200000" value="<?php echo $linha[modelo_item]; ?>"></td>
                
                <td align="right"><strong>Ofertado/Ganho:<br></td>
                <td colspan="0"><input type="text" name="vofertado" size="10" maxlength="50" value="<?php if ((isset($linha[vofertado])) and ($linha[vofertado]!=0)){
                                                                                                                echo $linha[vofertado];
                                                                                                                }
                                                                                                                else{
                                                                                                                    echo ($linha[qtde]*$linha[vunitcusto]);
                                                                                                                    }
                                                                                                                     ?>"></td>
                
                <td colspan="2" align="center"><input type="submit" value="Alterar Item" /></td>
                
            </tr>
            
            
           <tr>
                
                <td><input type="hidden" name="codigo" value="<?php echo $_GET[codigo]; ?>">
                </td>
                <td><input type="hidden" name="lote" value="<?php echo $_GET[lote]; ?>">
                </td>
                <td><input type="hidden" name="id_lote" value="<?php echo $_GET[id_lote]; ?>">
                </td>
                <td><input type="hidden" name="id_itens" value="<?php echo $linha[id_itens]; ?>">
                </td>
                <td><input type="hidden" name="id_cod" value="<?php echo $_REQUEST[id_cod]; ?>">
                </td>
                
                
            </tr>
            <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                  echo '<script language="javascript">document.cad_itens2.submit()</script>';
                }
            ?>
            
        </form>  
</table>
<?php

    
    require "lista_itens_minimos.php";
    
?>