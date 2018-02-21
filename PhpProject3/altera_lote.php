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
<form action="grava_lote.php" method="POST" <!--name="altera_lote"-->
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
                <td></td>
            </tr>
              <tr>
                <td colspan="2" align="center"><strong>ALTERE AQUI O LOTE DA SUA LICITAÇÃO<hr></td>
                
            </tr>
            <tr>
                <td></td>
            </tr>
            
            <tr>
                <td width="150" align="right"><strong>CÓDIGO LICITAÇÃO:</td>
                <td><input type="text" name="codigo" size="20" maxlength="20" value="<?php echo $_GET[codigo]; ?>" disabled>
                
                </td>
                
            </tr>
            
            <tr>
                <td align="right">Lote/Grupo:</td>
                <td><input type="text" name="lote" size="20" maxlength="20" value="<?php echo $linha_lote[lote]; ?>">
                    <?php
                        //if($erro_lote){
                            //echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                    ?>
                </td>
                
                
            </tr>
            
            <tr>
                <td align="right">Colocação Lote/Grupo:</td>
                <td align="left">
                    <select name="colocacao" size="0" >
                        <option><?php echo $linha_lote[colocacao]; ?></option>
                        <option>Arrematado</option>
                        <option>Adjudicado</option>
                        <option>Declarado Vencedor</option>
                        <option>Arquivado</option>
                        <option>A receber Pgto</option>
                        <option>A receber Ata/Contrato</option>
                        <option>A receber NE</option>
                        <option>Docs reprovados</option>
                        <option>Solicitado Parcial</option>
                        <option>Cancelada</option>
                        <option>Suspensa</option>
                        <option>Fracassada</option>
                        <option>Desclassificado</option>
                        <option>Descl. Neg. Pregoeiro</option>
                        <option>Em expedição</option>
                        <option>Reaberto</option>
                        <option>Rescindido contrato/ata</option>
                        <option>Pgto efetuado</option>
                        <option>2° Lugar</option>
                        <option>3° Lugar</option>
                        <option>4° Lugar</option>
                        <option>5° Lugar</option>
                        <option>6° Lugar</option>
                        <option>7° Lugar</option>
                        <option>8° Lugar</option>
                        <option>9° Lugar</option>
                        <option>10° Lugar</option>
                        <option>11° Lugar</option>
                        <option>12° Lugar</option>
                        <option>13° Lugar</option>
                        <option>14° Lugar</option>
                        <option>15° Lugar</option>
                        <option>16° Lugar</option>
                        <option>17° Lugar</option>
                        <option>18° Lugar</option>
                        <option>19° Lugar</option>
                        <option>20° Lugar</option>
                        <option>21° Lugar</option>
                        <option>22° Lugar</option>
                        <option>23° Lugar</option>
                        <option>24° Lugar</option>
                        <option>25° Lugar</option>
                        <option>26° Lugar</option>
                        <option>27° Lugar</option>
                        <option>28° Lugar</option>
                        <option>29° Lugar</option>
                        <option>31° Lugar</option>
                        <option>32° Lugar</option>
                        <option>33° Lugar</option>
                        <option>34° Lugar</option>
                        <option>35° Lugar</option>
                        <option>36° Lugar</option>
                        <option>37° Lugar</option>
                        <option>38° Lugar</option>
                        <option>39° Lugar</option>
                        <option>40° Lugar</option>
                        
                        
                    </select>
                      
    </td>
    
    
    
</tr>


<?php
//DATA ADJUDICAÇÃO

    
    if (!empty($linha_lote[adj_data]) and ($linha_lote[adj_data])!="0000-00-00"){
    $timestamp = strtotime($linha_lote[adj_data]);
    $nova_data=date('d/m/Y',$timestamp);
    echo "<tr><td align='right' bgcolor='Cornsilk'>Data Adjudicação:</td>
                <td><input type='text' name='adj_data' size='8' maxlength='10' onkeyup='Formatadata(this,event)' value='$nova_data'><font color='blue'>Ex.: 15/10/13</td></tr>";
    }
    else{
    echo "<tr><td align='right' bgcolor='Cornsilk'>Data Adjudicação:</td>
                <td><input type='text' name='adj_data' size='8' maxlength='10' onkeyup='Formatadata(this,event)' value='$_POST[adj_data]'><font color='blue'>Ex.: 15/10/13</td></tr>";
                           
    }
    if (!empty($linha_lote[validade_rp]) and ($linha_lote[validade_rp])!="0" and ($linha_cod[tipo_licitacao]=="RP")){
    echo "<tr><td align='right' bgcolor='Cornsilk'>Validade da Ata de RP:</td>
                <td><input type='text' name='validade_rp' size='8' maxlength='10' value='$linha_lote[validade_rp]'><font color='red'>Meses ***Obrigatório, senão não contabiliza para a meta!!!</td></tr>";
    }
    elseif ($linha_cod[tipo_licitacao]=="RP"){
    echo "<tr>
            <td align='right' bgcolor='Cornsilk'>Validade da Ata de RP:</td>
            <td><input type='text' name='validade_rp' size='8' maxlength='10' value='$_POST[validade_rp]'><font color='red'>Meses ***Obrigatório, senão não contabiliza para a meta!!!</td></tr>";
    
    }
    
    
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


   
    
    ?>


<!--HORA ACOMPANHAMENTO

    <tr>
        <td align="right">Hora Acompanhamento:</td>
        <td>
            <input type="text" name="hora_acomp" size="5" maxlength="5" value="<?php echo $linha_lote[hora_acomp]; ?>" onkeyup="Formatahora(this,event)">
        </td>
    </tr>
    -->
    
    <tr>
    <td align="right">Histórico/OBS:<br>
                                    <!--<a href="cad_itens_det.php?id_item=<?php //echo $linha_itens[id_itens] ?>" target="popupwindow" onclick='window.open("cad_itens_det.php", "popupwindow", "scrollbars=yes,width=750,height=400");return true'>(Adicionar sub-itens)</a></td>-->
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
                    <!--<input type="textarea" name="produto" size="50" maxlength="80" value="<?php //echo $_POST[produto]; ?>">-->
                    <?php
                       // if($erro_produto){
                         //   echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                    ?>
                </td>
                
                
    </tr>
    
    
            </tr>
                <tr>
                <td><input type="hidden" name="codigo" value="<?php echo $_GET[codigo]; ?>">
                </td>
                <td><input type="hidden" name="id_cod" value="<?php echo $linha_lote[id_cod]; ?>">
                </td> 
                <td><input type="hidden" name="id_lote" value="<?php echo $linha_lote[id_lote]; ?>">
                </td>
                
                
                
                
            </tr>
            
            <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                    echo '<script language="javascript">document.altera_lote.submit()</script>';
                }
            
            ?>
            

            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2" align="left"><input type="submit" value="Alterar Lote" /></td>
                <td><br><br></td>
                
            </tr>
            </form>
</tr>

