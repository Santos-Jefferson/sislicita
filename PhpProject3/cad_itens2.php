<?php
require ("cabecalho_reduzido.php");
require ("cabecalho_lote.php");
require "conecta.php";



//if(empty($_GET[order])) $_GET[order] = 'item';

//require ("corpo_menu.php");
//exibir a tabela com os pré-cadastros feitos.
//require ("pesquisa_licita.php");

//======================VALIDAÇÃO E CONVERSÃO DE DADOS=====================
//validação só funcionará quando não for a primeira vez que entra-se no formulario
//!empty (se não for vazio, faça os testes abaixo)

$sql = "SELECT * FROM itens WHERE id_lote = {$_REQUEST[id_lote]}";
$res = mysql_query($sql) or die("Erro seleção itens e lote - frete");
$v = 0; //conterá a somatória dos valores
$c = 0; //total de registros
//pega a primeira linha do resultado
$linha = mysql_fetch_assoc($res);



                     




if (!empty($_POST)){

//-------------CAMPO itens-------------------------

//não pode ser vazio o campo (campo obrigatório)
  if (empty($_POST[item])){
        $erro = $erro_item = true;
        }
    
//-------------CAMPO qtde-------------------------

//não pode ser vazio o campo (campo obrigatório)
    if (empty($_POST[qtde])){
        $erro = $erro_qtde = true;
        }
        
    if (empty($_POST[tipo_equip])){
        $erro = $erro_tipo_equip = true;
        }   
    
//-------------CAMPO produto-------------------------

//não pode ser vazio o campo (campo obrigatório)
//    if (empty($_POST[produto])){
  //      $erro = $erro_produto = true;
    //    }
    
//--------------CAMPO data-------------------------
//teste se é uma data gregoriana válida
//quebra a data em 3 partes
//após o slit, teremos o vetor $v em 3 pedaços: v[0] = dia, v[1] = mes, v[2] = ano
//$v = split('[/.-]', $_POST[data]);

//testa se a data é válida

//@ na frente da função é para inibir o warning, use com cuidado!!!
//if(!@checkdate($v[1], $v[0], $v[2])){
        //$erro = $erro_data = true;
//}
//se deu certo, converte a data
//else {
   // $_POST[data] = $v[2].'-'.$v[1].'-'.$v[0];
//}

//-------------CAMPO v unit custo-------------------------
//não pode ser vazio o campo (campo obrigatório)
    //if (empty($_POST[vunitcusto])){
      //  $erro = $erro_vunitcusto = true;
        //}
    
    
//-------------CAMPO fornecedor-------------------------
//não pode ser vazio o campo (campo obrigatório)
    //if (empty($_POST[forn])){
      //  $erro = $erro_forn = true;
        //}
        
        
        //-------------CAMPO v frete-------------------------
//não pode ser vazio o campo (campo obrigatório)
    //if (empty($_POST[vfrete])){
      //  $erro = $erro_vfrete = true;
        //}
        
        //-------------CAMPO o fertado-------------------------
//não pode ser vazio o campo (campo obrigatório)
    //if (empty($_POST[vofertado])){
      //  $erro = $erro_vofertado = true;
        //}
        
        //-------------CAMPO % lucro-------------------------
//não pode ser vazio o campo (campo obrigatório)
    //if (empty($_POST[porc_lucro])){
      //  $erro = $erro_porc_lucro = true;
        //}
        
        
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
include "js_cad_alt_itens.php";



?>
                     
           
<form action="<?php if ($erro or empty($_POST)) echo "cad_itens2.php";
                        else echo "grava_itens2.php"; ?>" method="POST" name="cad_itens2">
    <table align="center" border="0" width="1010" class="A" cellpading="0" cellspacing="0">
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
                            echo "<option>$_POST[tipo_equip]</option>";

                            while ($tipo_equip_row=mysql_fetch_array($tipo_equip_result)) {
                            $tipo_equip=$tipo_equip_row[tipo_equip];
                                echo "<option>
                                    $tipo_equip
                                </option>";
                            }
                        ?>
                    </select>
                        <?php
                            if($erro_tipo_equip){
                              echo "<font color=red>*** Campo obrigatório</font>";
                            }
                        ?>
                </td>
                <td align="right">Forn.:<a href="cad_fornecedor.php" target="_black"><img src="imagens/inserir.png" border="0"/><a></td>
                <td colspan="4">
                    <select id="nome_forn" name="forn">
                        <?php
            
                            $nome_forn_query="SELECT nome_forn FROM cad_fornecedor ORDER BY nome_forn ASC";
                            $nome_forn_result=mysql_query($nome_forn_query) or die ("Falha ao recuperar o NOME_FORN da base de dados: ".mysql_error());
                            echo "<option>$_POST[forn]</option>";

                            while ($nome_forn_row=mysql_fetch_array($nome_forn_result)) {
                            $nome_forn=$nome_forn_row[nome_forn];
                                echo "<option>$nome_forn</option>";
                                }
                            
                        ?>
                    </select>
                    
                </td>
                <td align="right">Item n°:</td>
                <td ><input type="text" name="item" size="4" maxlength="20" value="<?php echo $_POST[item]; ?>">
                    <?php
                        if($erro_item){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
                <td align="right">Reg. Oport.?:<br></td>
                <td align="left">
                    <select name="ro_item" size="0" >
                        <option><?php echo $_POST[ro_item]; ?></option>
                        <option>Sim</option>
                        <option>Não</option>
                    </select>
                    <?php
                        //if($erro_ro_item){
                          //  echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                    ?>
                </td>
                
                
            </tr>
            <tr>
                
                    
                
            </tr>
            <tr>
                <td align="right">Qtde:</td>
                <td><input type="text" name="qtde" size="10" maxlength="20" value="<?php echo $_POST[qtde]; ?>">
                    <?php
                        if($erro_qtde){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
                <td align="right">Nome Item:<br>
                <td colspan="4"><input type="text" name="nome_item" size="10" maxlength="20" value="<?php echo $_REQUEST[nome_item]; ?>"></td>
                <td align="right">Marca:<br>
                <td><input type="text" name="marca_item" size="7" maxlength="20" value="<?php echo $_REQUEST[marca_item]; ?>"></td>
                <td align="right">V.Un.Custo:R$</td>
                <td><input type="text" name="vunitcusto" size="6" maxlength="10" value="<?php echo $_POST[vunitcusto]; ?>">
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
                    
                
                <td align="right">Modelo:<br>
                <td colspan="9"><input type="text" name="modelo_item" size="110" maxlength="20000" value="<?php echo $_REQUEST[modelo_item]; ?>">
                <td colspan="1" align="center"><input type="submit" value="Cadastrar" /></td>
                    
                                    <!--<a href="cad_itens_det.php?id_item=<?php //echo $linha_itens[id_itens] ?>" target="popupwindow" onclick='window.open("cad_itens_det.php", "popupwindow", "scrollbars=yes,width=750,height=400");return true'>(Adicionar sub-itens)</a></td>-->
                <!--<td colspan="6"><textarea name="produto" rows="5" cols="55">
                        <?php
                            //$sql = "SELECT * FROM subitens WHERE id_subitens = {$_GET[id_subitens]} and id_item = {$_GET[id_item]}";
                            //$res = mysql_query($sql) or die("Erro seleção");
                            //$linha = mysql_fetch_assoc($res);
                        
                                //echo $_POST[produto]; ?>
                    </textarea>
                -->
                    <!--<input type="textarea" name="produto" size="50" maxlength="80" value="<?php //echo $_POST[produto]; ?>">-->
                    <?php
                       // if($erro_produto){
                         //   echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                    ?>
                </td>
            </tr>
            <tr>
                <td><input type="hidden" name="codigo" value="<?php echo $_REQUEST[codigo]; ?>">
                </td>
                <td><input type="hidden" name="lote" value="<?php echo $_REQUEST[lote]; ?>">
                </td>
                <td><input type="hidden" name="id_lote" value="<?php echo $_REQUEST[id_lote]; ?>">
                </td>
                <td colspan="9"><input type="hidden" name="id_cod" value="<?php echo $_REQUEST[id_cod]; ?>">
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
        

