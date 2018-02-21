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
$sql2 = "SELECT * FROM itens WHERE id_itens={$_REQUEST[alterar]}";
//executa a query
$res = mysql_query($sql2) or die("Erro selecionando (altera_precad.php)");
//desmonta o resutaldo e coloca os elementos do registro na linha
$linha = mysql_fetch_assoc($res);
//agora temos a linha preenchida com os dados do registro (acima)

$sql_subitens = "SELECT * FROM subitens WHERE id_item={$linha[id_itens]}";
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
    
    <form action="grava_itens.php" method="POST">
    <!--<form action="<?php //if ($erro or empty($_POST)) echo "altera_precad.php";
                            //else echo "grava_precad.php"; ?>" method="POST" name="altera_precad">-->
                            
        <table align="center" border="1" width="1020" class="A" cellpading="0" cellspacing="0">
            <tr border="1">
                <td border="1">
        <table align="center" width="1010" border="0" class="A" cellpading="0" cellspacing="0" >
            
            <tr>
                <td class="forms" colspan="10" bgcolor="LemonChiffon" align="center"><strong>ALTERE AQUI O ITEM SELECIONADO</td>
            </tr>
            
            <tr>
                <td align="right"><a href="lista_licita_tudo.php?codigo=<?php echo $_REQUEST[codigo]; ?>"><strong>CÓDIGO LICITAÇÃO:</td>
                <td><input type="text" name="codigo" size="20" maxlength="20" value="<?php echo $_REQUEST[codigo]; ?>" disabled></a>
                </td>
            
            
                <td align="right"><strong>LOTE:</td>
                <td><input type="text" name="lote" size="3" maxlength="3" value="<?php echo $_REQUEST[lote]; ?>" disabled>
                    
                <td align="right">Nome Item:</td>
                <td><input type="text" name="nome_item" size="10" maxlength="20" value="<?php echo $linha[nome_item]; ?>">
                    
                <td align="right">Marca:</td>
                <td><input type="text" name="marca_item" size="10" maxlength="20" value="<?php echo $linha[marca_item]; ?>">
                    
                <td align="right">Modelo:</td>
                <td colspan="2"><input type="text" name="modelo_item" size="30" maxlength="2000" value="<?php echo $linha[modelo_item]; ?>">
                 
                    
                    
                <!--<td align="right">Descrição/Produto:<br>-->
                                    <a href="cad_itens_det.php?id_item=<?php echo $linha[id_itens] ?>&id_subitem=<?php echo $linha_subitens[id_subitem]; ?>" target="popupwindow" onclick='window.open("cad_itens_det.php", "popupwindow", "scrollbars=yes,width=1100,height=450");return true'>(Adicionar/Alterar sub-itens)</a></td>
                <!--<td colspan="6"><textarea name="produto" rows="5" cols="55"><?php
    
    
                            //$sql2 = "SELECT * FROM subitens WHERE id_item = $linha[id_itens]";
                            //$res2 = mysql_query($sql2) or die("Erro seleção linha2");
                            //$linha2 = mysql_fetch_assoc($res2);
                            
                            //if (empty($linha2[id_subitem]))
                            //echo $linha[produto];
                            //else{
                            
                              //  while($linha2){
                            
                                //    echo "$linha2[qtde_si]-$linha2[sub_itens] $linha2[marca_si] $linha2[modelo_si], ";
                                    
                                  //  $linha2 = mysql_fetch_assoc($res2);
                                    //}
                            //}
                                    ?></textarea>-->
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
                <td><input type="text" name="item" size="5" maxlength="5" value="<?php echo $linha[item]; ?>">
                    <?php
                        if($erro_item){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            
            
            
                <td align="right">Qtde:</td>
                <td><input type="text" name="qtde" size="5" maxlength="5" id="res_qtde" value="<?php echo $linha[qtde]; ?>">
                    <?php
                        if($erro_qtde){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            
                <td align="right">V.Unit.Custo:</td>
                <td><input type="text" name="vunitcusto" size="10" maxlength="10" id="res_vunitcusto" onblur="cal_vtotcusto()" value="<?php
                        
                            $sql3 = "SELECT * FROM subitens WHERE id_item = $linha[id_itens]";
                            $res3 = mysql_query($sql3) or die("Erro seleção linha3");
                            $linha3 = mysql_fetch_assoc($res3);
                            $soma = 0;
                            if (empty($linha3[id_subitem])) echo "$linha[vunitcusto]";
                            else{
                            
                                while($linha3){
                                    
                                    $soma += $linha3[vtotcusto_si];
                                    
                                    $linha3 = mysql_fetch_assoc($res3);
                                    }
                                    echo $soma;
                            }
                            
                            ?>
                           ">
                    <?php
                      //  if($erro_vunitcusto){
                        //    echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                    ?>
                    
                </td>
                
                <td class="forms" align="right">V.Tot.Custo:</td>
                
                <td colspan="0" ><input class="forms" type="text" name="vtotcusto" size="10" maxlength="10" id="res_vtotcusto" value="<?php echo $linha[vtotcusto]; ?>">
                    <?php
                      //  if($erro_vunitcusto){
                        //    echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                    ?>
                    
                </td>
                
                <td class="credito" align="right">% de lucro:</td>
                <td><input type="text" name="porc_lucro" size="5" maxlength="5" id="res_porc_lucro" value="<?php echo $linha[porc_lucro]; ?>">
                    <?php
                        //if($erro_porc_lucro){
                         //   echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                        
                    ?>
                    
                </td>
                
            </tr>
            <tr>
                <td align="right">Fornecedor:</td>
                <td><input type="text" name="forn" size="20" maxlength="20" value="<?php
    
    
                            $sql2 = "SELECT * FROM subitens WHERE id_item = $linha[id_itens]";
                            $res2 = mysql_query($sql2) or die("Erro seleção linha2");
                            $linha2 = mysql_fetch_assoc($res2);
                            
                            if (empty($linha2[id_subitem])) echo $linha[forn];
                            else{
                            
                                while($linha2){
                            
                                    echo "$linha2[obs_si], ";
                                    
                                    $linha2 = mysql_fetch_assoc($res2);
                                    }
                            }
                                    ?>">
                    <?php
                       // if($erro_forn){
                        //    echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                        
                    ?>
                    
                </td>
            
            
                <td class="debito" align="right"><a href="javascript:abrir('cad_frete.php?id_itens=<?php echo $linha[id_itens];?>');">Valor Frete:</a></td>
                <td><input type="text" name="vfrete" size="10" maxlength="10" id="res_vfrete" value="<?php echo $linha[vfrete]; ?>"> <!--onblur="cal_vimposto()"-->
                    <?php
                        //if($erro_vfrete){
                         //   echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                        
                    ?>
                    
                </td>
                
                <td class="forms and debito" align="right">Valor Imposto:</td>
                <td><input type="text" class="forms" name="imposto" size="10" maxlength="10" id="res_imposto" value="<?php echo $linha[imposto]; ?>">
                    <?php
                        //if($erro_vfrete){
                         //   echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                        
                    ?>
                    
                </td>
                
                <td class="forms" align="right">Custo Aproximado:</td>
                <td><input type="text" class="forms" name="custo_aprox" size="10" maxlength="10" id="res_custo_aprox" value="<?php echo $linha[custo_aprox]; ?>">
                    <?php
                        //if($erro_vfrete){
                         //   echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                        
                    ?>
                    
                </td>
            
                <td class="credito" align="right">V. Ofert/Ganho:</td>
                <td colspan="2"><input type="text" name="vofertado" size="30" maxlength="30" id="res_vofertado" onblur="cal_vimposto() & cal_custo_aprox() & cal_vminofertar()"  value="<?php echo $linha[vofertado]; ?>">
                    <?php
                        //if($erro_vofertado){
                         //   echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                        
                    ?>
                    
                </td>
            </tr>
            <tr>
                
                <td class="forms" align="right">Valor Min. Ofertar:</td>
                <td><input type="text" class="forms" name="vminofertar" size="10" maxlength="10" id="res_vminofertar" onblur="cal_vitem()" value="<?php echo $linha[vminofertar]; ?>">
                    <?php
                        //if($erro_vofertado){
                         //   echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                        
                    ?>
                    
                </td>
                
                <td class="forms" align="right">Valor Item:</td>
                <td><input type="text" class="forms" name="vitem" size="10" maxlength="10" id="res_vitem" onblur="cal_vminitem()" value="<?php echo $linha[vitem]; ?>">
                    <?php
                        //if($erro_vofertado){
                         //   echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                        
                    ?>
                    
                </td>
                
                <td class="forms" align="right">Valor Min. Item:</td>
                <td><input type="text" class="forms" name="vminitem" size="10" maxlength="10" id="res_vminitem" onblur="cal_lucro_liq()" value="<?php echo $linha[vminitem]; ?>">
                    <?php
                        //if($erro_vofertado){
                         //   echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                        
                    ?>
                    
                </td>
               
               <td class="forms and credito" align="right">Lucro Liquido:</td>
                <td><input type="text" class="forms" name="lucro_liq" size="10" maxlength="10" id="res_lucro_liq" onblur="cal_custo_aprox()" value="<?php echo $linha[lucro_liq]; ?>">
                    <?php
                        //if($erro_vofertado){
                         //   echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                        
                    ?>
                    
                </td> 
                <td align="right">Reg. Oport.?:<br>
                <td align="left">
                    <select name="ro_item" size="0" >
                        <option><?php echo $linha[ro_item]; ?></option>
                        <option>Sim</option>
                        <option>Não</option>
                    </select>
                    <?php
                        if($erro_ro_item){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                
                
                </td>
                <td colspan="1" align="center"><input type="submit" value="Alterar Item" /></td>
                
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
                  echo '<script language="javascript">document.cad_itens.submit()</script>';
                }
            ?>
            
        </form>  
</table>
<?php

    
    require "lista_itens_tudo.php";
    
?>