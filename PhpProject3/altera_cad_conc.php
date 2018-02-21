<?php
require "conecta.php";
require "lib_datas.php";
require "css.php";
require_once "cabecalho_reduzido.php";
require_once "cabecalho_lote.php";
require_once "js_formata_data.php";

$sql = "SELECT * from lote WHERE id_lote = {$_GET[id_lote]}";
$lote = mysql_query($sql) or die ("Erro seleção lote");
$linha_lote = mysql_fetch_assoc($lote);

$sql2 = "SELECT * from codigo WHERE id_cod = {$_GET[id_cod]}";
$cod = mysql_query($sql2) or die ("Erro seleção codigo");
$linha_cod = mysql_fetch_assoc($cod);

//print_r ($_GET);
//print_r ($_REQUEST);
//die;
//seleciona a linha q marquei no radio
//$sql2 = "SELECT * FROM itens WHERE id_itens={$_REQUEST[alterar]}";
//executa a query
//$res = mysql_query($sql2) or die("Erro selecionando (altera_precad.php)");
//desmonta o resutaldo e coloca os elementos do registro na linha
//$linha = mysql_fetch_assoc($res);
//agora temos a linha preenchida com os dados do registro (acima)

//======================VALIDAÇÃO E CONVERSÃO DE DADOS=====================
//validação só funcionará quando não for a primeira vez que entra-se no formulario
//!empty (se não for vazio, faça os testes abaixo)
//if (!empty($_POST)){

//-------------CAMPO codigo-------------------------

//não pode ser vazio o campo (campo obrigatório)
    //if (empty($_POST[lote])){
        //$erro = $erro_lote = true;
        //}
//}

    
?>
</table><br>
<tr>
    <th colspan="2" height="159" align="left" class="A" scope="col">
    
    <!-- o form deve conter a tag name="" para que possa ser submetido automatica-->
<form action="grava_cad_concorrencia.php" method="POST" <!--name="altera_lote"-->
    <!--<form action="<?php /*if ($erro or empty($_POST)){
                            echo "altera_lote.php?alterar=$_GET[id_lote]&codigo=$_GET[codigo]&lote=$_GET[lote]&orgao=$_GET[orgao]&data=$_GET[data]&hora=$_GET[hora]&licitante=$_GET[licitante]&id_lote=$_GET[id_lote]&id_itens=$linha[id_itens]&id_cod=$_GET[id_cod]";
                            }
                            else {
                                    echo "grava_lote.php";
                            }*/
                            ?>"
                    method="POST" name="altera_lote">-->
        
       <table width="1020" border="1" align="center" class="A" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                
          <table width="1010" border="0" align="center" class="A" cellpadding="0" cellspacing="0">
            <tr>
                <td width="20%"></td>
            </tr>
              <tr>
                <td colspan="2" align="center"><strong>ANÁLISE CONCORRÊNCIA<hr></td>
                
            </tr>
<?php
//DATA ADJUDICAÇÃO

    
    if (($linha_lote[colocacao] == "A receber Ata/Contrato") or ($linha_lote[colocacao] == "A receber NE") or
        ($linha_lote[colocacao] == "A receber Pgto")or ($linha_lote[colocacao] == "Em expedição") or ($linha_lote[colocacao] == "Solicitado Parcial")){
    echo "<tr><td align='right' bgcolor='Cornsilk'>Empresa 2° Lugar:</td>
                <td><input type='text' name='emp_2adj' size='50' maxlength='50'></td></tr>";
    echo "<tr><td align='right' bgcolor='Cornsilk'>Marca 2° Lugar:</td>
                <td><input type='text' name='mar_2adj' size='20' maxlength='20'></td></tr>";
    echo "<tr><td align='right' bgcolor='Cornsilk'>Modelo 2° Lugar:</td>
                <td><input type='text' name='mod_2adj' size='20' maxlength='20'></td></tr>";
    echo "<tr><td align='right' bgcolor='Cornsilk'>V. Unit.  2° Lugar:</td>
                <td><input type='text' name='val_2adj' size='20' maxlength='20'></td></tr>";
    }
    else if ($linha_lote[colocacao] == "Arquivado"){
    echo "<tr><td align='right' bgcolor='Cornsilk'>Empresa Adjudicada:</td>
                <td><input type='text' name='emp_adj' size='50' maxlength='50'></td></tr>";
    echo "<tr><td align='right' bgcolor='Cornsilk'>Marca Adjudicada:</td>
                <td><input type='text' name='mar_adj' size='20' maxlength='20'></td></tr>";
    echo "<tr><td align='right' bgcolor='Cornsilk'>Modelo Adjudicado:</td>
                <td><input type='text' name='mod_adj' size='20' maxlength='20'></td></tr>";
    echo "<tr><td align='right' bgcolor='Cornsilk'>V. Unit. Adjudicado:</td>
                <td><input type='text' name='val_adj' size='20' maxlength='20'></td></tr>";                       
    }
/*    
//DATA ACOMPANHAMENTO
    
    if (!empty($linha_lote[data_acomp]) and ($linha_lote[data_acomp])!="0000-00-00"){
    $timestamp = strtotime($linha_lote[data_acomp]);
    $nova_data=date('d/m/Y',$timestamp);
    echo "<tr><td align='right' bgcolor='Salmon'>Data Acompanhamento:</td>
                <td><input type='text' name='data_acomp' size='8' maxlength='8' onkeyup='Formatadata(this,event)' value='$nova_data'><font color='blue'>Ex.: 15/10/13</td></tr>";
    }
    else{
    echo "<tr><td align='right' bgcolor='Salmon'>Data Acompanhamento:</td>
                <td><input type='text' name='data_acomp' size='8' maxlength='8' onkeyup='Formatadata(this,event)' value='$_POST[data_acomp]'><font color='blue'>Ex.: 15/10/13</td></tr>";
                           
    }
    
    if (!empty($linha_lote[hora_acomp]) and ($linha_lote[hora_acomp])!="00:00:00"){
    echo "<tr><td align='right' bgcolor='Salmon'>Hora Acompanhamento:</td>
                <td><input type='text' name='hora_acomp' size='8' maxlength='5' onkeyup='Formatahora(this,event)' value='$linha_lote[hora_acomp]'><font color='blue'>Ex.: 09:00</td></tr>";
    }
    else{
    echo "<tr><td align='right' bgcolor='Salmon'>Hora Acompanhamento:</td>
                <td><input type='text' name='hora_acomp' size='8' maxlength='5' onkeyup='Formatahora(this,event)' value='$_POST[hora_acomp]'><font color='blue'>Ex.: 09:00</td></tr>";
                           
    }

*/
   
    
    ?>


<!--HORA ACOMPANHAMENTO

    <tr>
        <td align="right">Hora Acompanhamento:</td>
        <td>
            <input type="text" name="hora_acomp" size="5" maxlength="5" value="<?php echo $linha_lote[hora_acomp]; ?>" onkeyup="Formatahora(this,event)">
        </td>
    </tr>
    -->
    
    <!--<tr>
    <td align="right">Histórico/OBS:<br>
                                    <!--<a href="cad_itens_det.php?id_item=<?php //echo $linha_itens[id_itens] ?>" target="popupwindow" onclick='window.open("cad_itens_det.php", "popupwindow", "scrollbars=yes,width=750,height=400");return true'>(Adicionar sub-itens)</a></td>
                <td colspan=""><textarea name="historico" rows="5" cols="55">
                        <?php
                            //$sql = "SELECT * FROM subitens WHERE id_subitens = {$_GET[id_subitens]} and id_item = {$_GET[id_item]}";
                            //$res = mysql_query($sql) or die("Erro seleção");
                            //$linha = mysql_fetch_assoc($res);
                        if (!empty($linha_lote[historico])){
                            echo $linha_lote[historico]." ### ";
                            echo date("Y/m/d - H:i:s")."(".$usuario.")";
                        }
                        if (empty($linha_lote[historico])){
                                echo date("Y/m/d - H:i:s:")."(".$usuario.")";
                            }
                        ?>
                    </textarea>
                    <!--<input type="textarea" name="produto" size="50" maxlength="80" value="<?php //echo $_POST[produto]; ?>">
                    <?php
                       // if($erro_produto){
                         //   echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                    ?>
                </td>
                
                
    </tr>
    
    
            </tr>-->
                <tr>
                <td><input type="hidden" name="codigo" value="<?php echo $_GET[codigo]; ?>">
                </td>
                <td><input type="hidden" name="id_cod" value="<?php echo $linha_lote[id_cod]; ?>">
                </td> 
                <td><input type="hidden" name="colocacao" value="<?php echo $linha_lote[colocacao]; ?>">
                </td> 
                <td><input type="hidden" name="id_lote" value="<?php echo $linha_lote[id_lote]; ?>">
                </td>
                
                
                
                
            </tr>
            
            <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                    echo '<script language="javascript">document.altera_conc.submit()</script>';
                }
            
            ?>
            

            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2" align="left"><input type="submit" value="Inserir Dados Concorrência" /></td>
                <td><br><br></td>
                
            </tr>
            </form>
</tr>

