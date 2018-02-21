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
        
    //if (empty($_POST[ro_item])){
      //  $erro = $erro_ro_item = true;
        //}   
    
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




<!--qtde: <input type="text" id="qtde" value="0"><br>
vunitcusto: <input type="text" id="vunitcusto" value="0" onblur="multiplicacao()"><br>
<b>vtotcusto:<input type="text" id="vtotcusto"></b>-->

<tr>
    <th colspan="2" height="159" align="left" class="A">
    <!-- o form deve conter a tag name="" para que possa ser submetido automatica-->
    
    <form action="<?php if ($erro or empty($_POST)) echo "cad_itens.php";
                            else echo "grava_itens.php"; ?>" method="POST" name="cad_itens">
        <table align="center" border="1" width="1020" class="A" cellpading="0" cellspacing="0">
            <tr border="1">
                <td border="1">
        <table align="center" width="1010" border="0" class="A" cellpading="0" cellspacing="0" >
            
            <tr>
                <td class="forms" colspan="10" bgcolor="LemonChiffon" align="center"><strong>CADASTRE AQUI OS ITENS PARA O LOTE ESCOLHIDO</td>
            </tr>
            
            <tr>
                <td align="right"><a href="lista_licita_tudo.php?codigo=<?php echo $_REQUEST[codigo]; ?>"><strong>CÓDIGO LICITAÇÃO:</td>
                <td><input type="text" name="codigo" size="20" maxlength="20" value="<?php echo $_REQUEST[codigo]; ?>" disabled></a>
                </td>
            
            
                <td align="right"><strong>LOTE:</td>
                <td><input type="text" name="lote" size="3" maxlength="3" value="<?php echo $_REQUEST[lote]; ?>" disabled>
                
                
                    
                    
                <td align="right">Nome Item:<br>
                <td><input type="text" name="nome_item" size="10" maxlength="20" value="<?php echo $_REQUEST[nome_item]; ?>">
                    
                <td align="right">Marca:<br>
                <td><input type="text" name="marca_item" size="10" maxlength="20" value="<?php echo $_REQUEST[marca_item]; ?>">
                    
                <td align="right">Modelo:<br>
                <td colspan="2"><input type="text" name="modelo_item" size="25" maxlength="2000" value="<?php echo $_REQUEST[modelo_item]; ?>">
                
                    
                    
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
                    
                </td>
            
            </tr>
            
            <tr>
            
            
                <td align="right">Item n°:</td>
                <td><input type="text" name="item" size="5" maxlength="5" value="<?php echo $_POST[item]; ?>">
                    <?php
                        if($erro_item){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            
            
            
                <td align="right">Qtde:</td>
                <td><input type="text" name="qtde" size="5" maxlength="5" id="res_qtde" value="<?php echo $_POST[qtde]; ?>">
                    <?php
                        if($erro_qtde){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            
                <td align="right">V.Unit.Custo: R$</td>
                <td><input type="text" name="vunitcusto" size="10" maxlength="10" id="res_vunitcusto" onblur="cal_vtotcusto()" value="<?php echo $_POST[vunitcusto]; ?>">
                    <?php
                      //  if($erro_vunitcusto){
                        //    echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                    ?>
                    
                </td>
                
                <td class="forms" align="right">V.Tot.Custo: R$</td>
                
                <td colspan="0" ><input class="forms" type="text" name="vtotcusto" size="10" maxlength="10" id="res_vtotcusto" value="<?php echo $_POST[vtotcusto]; ?>">
                    <?php
                      //  if($erro_vunitcusto){
                        //    echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                    ?>
                    
                </td>
                <?php
                /*$rp10 = 30;
                                $rp0 = 20;
                                $at10 = 27;
                                $at0 = 17;


                                /////////////////////////////////////////////////////////////////////
                                //testa o estado e o tipo de licitação para colocar em PORC_LUCRO
                                if (($_GET[tipo_licitacao] == 'RP') and ($_GET[uf] == "Ceará - CE")){
                                    //echo $rp10;
                                        $_POST[porc_lucro] = $rp10;
                                        }
                                    elseif (($_GET[tipo_licitacao] == 'RP') and !($_GET[uf] == "Ceará - CE")){
                                        $_POST[porc_lucro] = $rp0;
                                        }
                                    elseif (($_GET[tipo_licitacao] == 'AT') and ($_GET[uf] == "Ceará - CE")){
                                        $_POST[porc_lucro] = $at10;
                                        }
                                    elseif (($_GET[tipo_licitacao] == 'AT') and !($_GET[uf] == "Ceará - CE")){
                                        $_POST[porc_lucro] = $at0;
                                        }   
                                        else {
                                            $_POST[porc_lucro] = "17";
                                            }
                  */                          
                                            ?>
                
                <td class="" align="right">% de lucro:</td>
                <td><input type="text" name="porc_lucro" size="3" maxlength="5" id="res_porc_lucro"
                    value="<?php
                    
                                
                    
                                        echo $_POST[porc_lucro]; ?>">%
                            <?php
                        //if($erro_porc_lucro){1
                         //   echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                        
                    ?>
                    
                </td>
                
            </tr>
            <tr>
                <td align="right">Forn.:</td>
                <td><input type="text" name="forn" size="20" maxlength="20" value="<?php echo $_POST[forn]; ?>">
                    <?php
                       // if($erro_forn){
                        //    echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                        
                    ?>
                    
                </td>
            
            
                <td class="" align="right">Valor Frete:</a></td>
                <td><input type="text" name="vfrete" size="10" maxlength="10" id="res_vfrete" value="<?php echo $_POST[vfrete]; ?>"> <!--onblur="cal_vimposto()"-->
                    <?php
                        //if($erro_vfrete){
                         //   echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                        
                    ?>
                    
                </td>
                
                <td class="forms" align="right">V. Imposto: R$</td>
                <td><input type="text" class="forms" name="imposto" size="10" maxlength="10" id="res_imposto" value="<?php echo $_POST[imposto]; ?>">
                    <?php
                        //if($erro_vfrete){
                         //   echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                        
                    ?>
                    
                </td>
                
                <td class="forms and debito" align="right">C. Aprox.: R$</td>
                <td><input type="text" class="forms" name="custo_aprox" size="10" maxlength="10" id="res_custo_aprox" value="<?php echo $_POST[custo_aprox]; ?>">
                    <?php
                        //if($erro_vfrete){
                         //   echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                        
                    ?>
                    
                </td>
            
                <td class="credito and green" align="right">V. Ofert/Ganho: R$</td>
                <td colspan="2"><input type="text" name="vofertado" size="25" maxlength="10" id="res_vofertado" onblur="cal_vimposto() & cal_custo_aprox() & cal_vminofertar()"  value="<?php echo $_POST[vofertado]; ?>">
                    <?php
                        //if($erro_vofertado){
                         //   echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                        
                    ?>
                    
                </td>
            </tr>
            <tr>
                
                <td class="forms and yellow" align="right">V. Min. Ofertar: R$</td>
                <td><input type="text" class="forms" name="vminofertar" size="10" maxlength="10" id="res_vminofertar" onblur="cal_vitem()" value="<?php echo $_POST[vminofertar]; ?>">
                    <?php
                        //if($erro_vofertado){
                         //   echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                        
                    ?>
                    
                </td>
                
                <td class="forms" align="right">V. Item: R$</td>
                <td><input type="text" class="forms" name="vitem" size="10" maxlength="10" id="res_vitem" onblur="cal_vminitem()" value="<?php echo $_POST[vitem]; ?>">
                    <?php
                        //if($erro_vofertado){
                         //   echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                        
                    ?>
                    
                </td>
                
                <td class="forms and yellow" align="right">V. Min. Item: R$</td>
                <td><input type="text" class="forms" name="vminitem" size="10" maxlength="10" id="res_vminitem" onblur="cal_lucro_liq()" value="<?php echo $_POST[vminitem]; ?>">
                    <?php
                        //if($erro_vofertado){
                         //   echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                        
                    ?>
                    
                </td>
               
               <td class="forms and credito" align="right">Lucro Liq.: R$</td>
                <td><input type="text" class="forms" name="lucro_liq" size="10" maxlength="10" id="res_lucro_liq" onblur="cal_custo_aprox()" value="<?php echo $_POST[lucro_liq]; ?>">
                    <?php
                        //if($erro_vofertado){
                         //   echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                        
                    ?>
                    
                </td> 
                
                <td align="right">Reg. Oport.?:<br>
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
                <!--<td colspan="1" align="center">R.O?: <?php //echo $_GET[]?></td>-->
                
                <td colspan="1" align="center"><input type="submit" value="Cadastrar Item" /></td>
                
            </tr>
            
           <tr>
                
                <td><input type="hidden" name="codigo" value="<?php echo $_REQUEST[codigo]; ?>">
                </td>
                <td><input type="hidden" name="lote" value="<?php echo $_REQUEST[lote]; ?>">
                </td>
                <td><input type="hidden" name="id_lote" value="<?php echo $_REQUEST[id_lote]; ?>">
                </td>
                <td><input type="hidden" name="id_cod" value="<?php echo $_REQUEST[id_cod]; ?>">
                </td>
                
                
                
                
            </tr>
            <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                  echo '<script language="javascript">document.cad_itens.submit()</script>';
                }
            ?>
            
        </form>  
</table>
<?php

    
    require "lista_itens_tudo.php";
    
?>
        

