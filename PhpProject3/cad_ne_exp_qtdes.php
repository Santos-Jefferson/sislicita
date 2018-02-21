<?php

require "cabecalho_html.php";
require "conecta.php";
include "css.php";
//print_r($_REQUEST);die;

    
$sql_cod_lote = "SELECT * FROM codigo,lote,itens WHERE codigo.id_cod={$_REQUEST[id_cod]} and lote.id_lote={$_REQUEST[id_lote]}";
$res_cod_lote = mysql_query($sql_cod_lote) or die("Erro seleção - res_ne");
$linha_cod_lote = mysql_fetch_assoc($res_cod_lote);

include "js_cad_alt_itens.php";
?>

<br>
<table align="center" class="A" border="0" width="">
<table align="center" class="A" width="" border="1" cellpadding="3" cellspacing="0">
    
       
    <tr>
        <td class="forms" colspan="0" bgcolor="LemonChiffon" align="center"><strong>LISTAGEM LICITAÇÃO N°<a href="lista_licita_tudo.php?codigo=<?php echo $linha_cod_lote[codigo];?>"><?php echo $linha_cod_lote[codigo] ?></a> e LOTE/GRUPO N° <?php echo $linha_cod_lote[lote] ?></td>
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
    <td align="center"><?php echo $linha_cod_lote[tipo_licitacao] ?></td>
    <!--<td align="center"><?php //echo $linha_cod_lote[codigo] ?></td>-->
    <td align="center"><?php echo $linha_cod_lote[pregao] ?></td>
    <td align="center"><?php echo $linha_cod_lote[orgao] ?></td>
    
    
    <td align="center"><?php echo $linha_cod_lote[licitante] ?></td>
    
    <td class="" align="center"><?php echo $linha_cod_lote[colocacao] ?></td>
    <td class="" align="center"><?php echo $_GET[num_ne] ?></td>
    
  </tr>
  
  </table><br> 


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
                <td class="forms" colspan="0" bgcolor="LemonChiffon" align="center"><strong>ALTERE AQUI O ITEM SELECIONADO</td>
            </tr>
            
            <tr>
               
                <td align="right">Nome Item:</td>
                <td><input type="text" name="nome_item" size="20" maxlength="20" value="<?php echo $linha_cod_lote[nome_item]; ?>">
                    
                <td align="right">Marca:</td>
                <td><input type="text" name="marca_item" size="20" maxlength="20" value="<?php echo $linha_cod_lote[marca_item]; ?>">
                    
                <td align="right">Modelo:</td>
                <td colspan="2"><input type="text" name="modelo_item" size="50" maxlength="2000" value="<?php echo $linha[modelo_item]; ?>">
                 
                    
                    
                <!--<td align="right">Descrição/Produto:<br>-->
                                    <a href="cad_itens_det.php?id_item=<?php echo $linha[id_itens] ?>&id_subitem=<?php echo $linha_subitens[id_subitem]; ?>" target="popupwindow" onclick='window.open("cad_itens_det.php", "popupwindow", "scrollbars=yes,width=1050,height=450");return true'>(Adicionar/Alterar sub-itens)</a></td>
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
            </tr>
            
            <tr>
            
            
                <td align="right">Item n°:</td>
                <td><input type="text" name="item" size="5" maxlength="5" value="<?php echo $linha_cod_lote[item]; ?>">
                    <?php
                        if($erro_item){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            
            
            
                <td align="right">Qtde Empenhada:</td>
                <td><input type="text" name="qtde" size="5" maxlength="5" id="res_qtde" value="<?php echo $linha_cod_lote[qtde]; ?>">
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
            
            
                
                <td class="" align="right">Valor Unit.:</td>
                <td><input type="text" class="" name="vitem" size="10" maxlength="10" id="res_vitem" onblur="cal_vminitem()" value="<?php echo $linha_cod_lote[vitem]; ?>">
                    <?php
                        //if($erro_vofertado){
                         //   echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                        
                    ?>
                    
                </td>
                
                              
               <td class="" align="right">Lucro Liquido:</td>
                <td><input type="text" class="" name="lucro_liq" size="10" maxlength="10" id="res_lucro_liq" onblur="cal_custo_aprox()" value="<?php echo $linha[lucro_liq]; ?>">
                    <?php
                        //if($erro_vofertado){
                         //   echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                        
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

    
    require "lista_itens_ne_tudo.php";
    
?>