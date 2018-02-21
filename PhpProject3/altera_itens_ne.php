<?php
require "cabecalho_html.php";
require "conecta.php";
include "css.php";

$sql = "SELECT * from lote WHERE id_cod = {$_GET[id_cod]}";
$lote = mysql_query($sql) or die ("Erro seleção lote");
$linha_lote = mysql_fetch_assoc($lote);

//print_r ($_GET);
//print_r ($_REQUEST);
//seleciona a linha q marquei no radio

$sql = "SELECT * FROM codigo,lote,itens_ne WHERE codigo.id_cod=lote.id_cod and lote.id_lote=itens_ne.id_lote and itens_ne.id_itens_ne={$_GET[alterar]}";
$res = mysql_query($sql) or die ("erro selecionar tudo codigo,lote,itens_ne");
$linha_tudo = mysql_fetch_assoc($res);

$sql2 = "SELECT * FROM itens_ne WHERE id_itens_ne={$_REQUEST[alterar]}";
//executa a query
$res = mysql_query($sql2) or die("Erro selecionando (altera_precad.php)");
//desmonta o resutaldo e coloca os elementos do registro na linha
$linha = mysql_fetch_assoc($res);
//agora temos a linha preenchida com os dados do registro (acima)

$sql_subitens = "SELECT * FROM subitens_ne2 WHERE id_item={$linha[id_itens]}";
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

<br>
<table align="center" class="A" border="0" width="">
<table align="center" class="A" width="" border="1" cellpadding="3" cellspacing="0">
    
       
    <tr>
        <td class="forms" colspan="10" bgcolor="LemonChiffon" align="center"><strong>LISTAGEM LICITAÇÃO N°<a href="lista_licita_tudo.php?codigo=<?php echo $linha_tudo[codigo];?>"><?php echo $linha_tudo[codigo] ?></a> e LOTE/GRUPO N° <?php echo $linha_tudo[lote] ?></td>
    </tr>
    
  <tr>
    <th width="" >TIPO</th>
    <!--<th width="" scope="col">CÓDIGO</th>-->
    <th width="" >PREGÃO</th>  
    <th width="" >ÓRGÃO</th>
    <!--<th width="" scope="col">DATA/HORA</th>-->
    <!--<th width="" scope="col">LOTE/GRUPO</th>-->
    <th width="" scope="col">LICITANTE</th>
    <!--<th >AÇÃO</th>-->
    <th >STATUS LOTE</th>
    <th >NÚM NE</th>
    
  </tr>
  <tr>
    <td align="center"><?php echo $linha_tudo[tipo_licitacao] ?></td>
    <!--<td align="center"><?php //echo $linha_cod_lote[codigo] ?></td>-->
    <td align="center"><?php echo $linha_tudo[pregao] ?></td>
    <td align="center"><?php echo $linha_tudo[orgao] ?></td>
    
    
    <td align="center"><?php echo $linha_tudo[licitante] ?></td>
    
    <td class="" align="center"><?php echo $linha_tudo[colocacao] ?></td>
    <td class="" align="center"><a href="cad_ne.php?id_itens_ne=<?php echo $linha_tudo[id_itens_ne];?>&id_lote=<?php echo $linha_tudo[id_lote]; ?>&id_cod=<?php echo $linha_tudo[id_cod]; ?>"><?php echo $_GET[num_ne] ?></td></a>
    
  </tr>
  
  </table><br>





<!--qtde: <input type="text" id="qtde" value="0"><br>
vunitcusto: <input type="text" id="vunitcusto" value="0" onblur="multiplicacao()"><br>
<b>vtotcusto:<input type="text" id="vtotcusto"></b>-->



<tr>
    <th colspan="2" height="159" align="left" class="A">
    <!-- o form deve conter a tag name="" para que possa ser submetido automatica-->
    
    <form action="grava_itens_ne.php" method="POST">
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
                
                <td align="right">Nome Item:</td>
                <td><input type="text" name="nome_item" size="10" maxlength="20" value="<?php echo $linha[nome_item]; ?>">
                    
                <td align="right">Marca:</td>
                <td><input type="text" name="marca_item" size="10" maxlength="20" value="<?php echo $linha[marca_item]; ?>">
                    
                <td align="right">Modelo:</td>
                <td colspan="2"><input type="text" name="modelo_item" size="30" maxlength="2000" value="<?php echo $linha[modelo_item]; ?>">
                 
                    
                    
                <!--<td align="right">Descrição/Produto:<br>-->
                                    <td><a href="cad_itens_det_ne.php?id_itens_ne=<?php echo $linha[id_itens_ne] ?>&id_subitem_ne=<?php echo $linha_subitens[id_subitem_ne]; ?>" target="popupwindow" onclick='window.open("cad_itens_det.php", "popupwindow", "scrollbars=yes,width=1100,height=450");return true'>(Adic/Alt s.itens)</a></td>
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
                        
                            $sql3 = "SELECT * FROM subitens_ne2 WHERE id_itens_ne = $linha[id_itens_ne]";
                            $res3 = mysql_query($sql3) or die("Erro seleção linha3");
                            $linha3 = mysql_fetch_assoc($res3);
                            $soma = 0;
                            if (empty($linha3[id_subitem])) echo "$linha[vunitcusto]";
                            else{
                            
                                while($linha3){
                                    
                                    $soma += ($linha3[vunitcusto_si]*$linha3[qtde_si]);
                                    
                                    $linha3 = mysql_fetch_assoc($res3);
                                    }
                                    echo $soma;
                            }
                            
                            ?>
                           ">
                    
                    
                </td>
                <td align="right">Verba MKT (V. Unit):</td>
                <td><input type="text" name="verba_mkt" size="5" maxlength="8" id="res_verba_mkt" value="<?php echo $linha[verba_mkt]; ?>">
                    <?php
                        if($erro_verba_mkt){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
                
                <!--<td class="forms" align="right">V.Tot.Custo:</td>
                
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
                -->
            </tr>
            <tr>
                <td align="right">Fornecedor:</td>
                <td><input type="text" name="forn" size="20" maxlength="500" value="<?php
    
    
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
            
                <!--
                <td class="debito" align="right">Valor Frete:</td>
                <td><input type="text" name="vfrete" size="10" maxlength="10" id="res_vfrete" value="<?php echo $linha[vfrete]; ?>"> <!--onblur="cal_vimposto()"
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
                -->
                <td class="" align="right">V. Item NE:</td>
                <td><input type="text" class="" name="vitem" size="10" maxlength="10" value="<?php echo $linha[vitem]; ?>">
                    <?php
                        //if($erro_vofertado){
                         //   echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                        
                    ?>
                    
                </td>
                
                
                
                <!--<td class="credito" align="right">V. Total Item:</td>
                <td colspan="2"><input type="text" name="vofertado" size="30" maxlength="30" id="res_vofertado" onblur="cal_vimposto() & cal_custo_aprox() & cal_vminofertar()"  value="<?php echo $linha[vofertado]; ?>">
                    <?php
                        //if($erro_vofertado){
                         //   echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                        
                    ?>
                    
                </td>
                
                <td class="forms" align="right">Valor Min. Ofertar:</td>
                <td><input type="text" class="forms" name="vminofertar" size="10" maxlength="10" id="res_vminofertar" onblur="cal_vitem()" value="<?php echo $linha[vminofertar]; ?>">
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
                
                
                </td>-->
                <td colspan="2" align="center"><input type="submit" value="Alterar Item" /></td>
                
            </tr>
            
           <tr>
                
                <td><input type="hidden" name="codigo" value="<?php echo $linha_tudo[codigo]; ?>">
                </td>
                <td><input type="hidden" name="lote" value="<?php echo $linha_tudo[lote]; ?>">
                </td>
                <td><input type="hidden" name="id_lote" value="<?php echo $linha_tudo[id_lote]; ?>">
                </td>
                <td><input type="hidden" name="id_itens" value="<?php echo $linha[id_itens]; ?>">
                </td>
                <td><input type="hidden" name="id_itens_ne" value="<?php echo $linha_tudo[id_itens_ne]; ?>">
                </td>
                <td><input type="hidden" name="id_cod" value="<?php echo $linha_tudo[id_cod]; ?>">
                </td>
                <td><input type="hidden" name="id_ne" value="<?php echo $linha_tudo[id_ne]; ?>">
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

    
    require "lista_itens_ne_tudo.php";
    
?>
 