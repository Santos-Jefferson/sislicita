<?php
require "conecta.php";
require_once "cabecalho_reduzido.php";
require_once "cabecalho_lote.php";

//seleciona a linha q marquei no radio
$sql = "SELECT * FROM cadastro WHERE id_cadastro={$_GET[alterar]}";
//executa a query
$res = mysql_query($sql) or die("Erro selecionando");
//desmonta o resutaldo e coloca os elementos do registro na linha
$linha = mysql_fetch_assoc($res);
//agora temos a linha preenchida com os dados do registro (acima)

?>

<tr>
    <th colspan="2" height="159" align="left" class="A" scope="col">
    <!-- o form deve conter a tag name="" para que possa ser submetido automatica-->
    
    <form action="<?php if ($erro or empty($_POST)) echo "cad_licita.php"; 
                            else echo "grava_cad.php"; ?>" method="POST" name="cad_licita">
        
        <table border="0">
            <tr>
                <td align="right">Cód. BB/Uasg/Pregão:</td>
                <td><input type="text" name="codigo" size="20" maxlength="20" value="<?php echo $_POST[codigo]; ?>">
                    <?php
                        if($erro_codigo){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            
            <tr>
                <td align="right">Lote/Grupo:</td>
                <td><input type="text" name="lote" size="2" maxlength="2" value="<?php echo $_POST[lote]; ?>">
                    <?php
                        if($erro_lote){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            
            <tr>
                <td align="right">Órgão:</td>
                <td><input type="text" name="orgao" size="50" maxlength="50" value="<?php echo $_POST[orgao]; ?>">
                    <?php
                        if($erro_orgao){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            
            <tr>
                <td align="right">Data Disp.:</td>
                <td><input type="text" name="data" size="20" maxlength="20" value="<?php echo $_POST[data]; ?>">
                    <?php 
                        if ($erro_data){
                            echo "<font color=red>*** Data inserida erroneamente. Insira novamente</font>";
                        }
                        echo "<font color=blue>   Ex.: 25/12/2011</font>";
                    ?>
                    
                </td>
            </tr>
            
            <tr>
                <td align="right">Hora Disp.:</td>
                <td><input type="text" name="hora" size="20" maxlength="20" value="<?php echo $_POST[hora]; ?>">
                    <?php
                        if($erro_hora){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                        echo "<font color=blue>   Ex.: 09:00</font>";
                    ?>
                    
                </td>
            </tr>
            
            <tr>
                <td align="right">Licitante:</td>
                <td>
                    <select name="licitante" size="0" >
                        <option><?php echo $_POST[licitante]; ?></option>
                        <option>Dyuliane</option>
                        <option>Getulio</option>
                        <option>Marcelo</option>
                    </select>
                        <?php
                            if($erro_licitante){
                                echo "<font color=red>*** Campo obrigatório</font>";
                            }
                        ?>
                </td>
            </tr>
    
<tr>
    <th colspan="2" height="159" align="left" class="A" scope="col">
    <form action="grava_cad.php" method="POST">
        <input type="hidden" name="id_cadastro" size="3" maxlength="3" value="<?php echo $linha[id_cadastro]?>"><br><br>
        
            <p>Licitante:
              <select  name="licitante" size="0">
                <option><?php echo $linha[licitante] ?></option>
                <option>Dyuliane</option>
                <option>Getulio</option>
                <option>Marcelo</option>
              </select>
              <br><br>
        
            Data Disp./Hora: <input type="text" name="data_hora" size="20" maxlength="20" value="<?php echo $linha[data_hora]?>"><br><br>
            Cód. BB/UASG/PREGÃO: <input type="text" name="codigo" size="16" maxlength="16" value="<?php echo $linha[codigo]?>"><br><br>
            Lote: <input type="text" name="lote" size="2" maxlength="2" value="<?php echo $linha[lote]?>"><br><br>
            Item: <input type="text" name="item" size="3" maxlength="3" value="<?php echo $linha[item]?>"><br><br>
            Qtde: <input type="text" name="qtde" size="6" maxlength="6" value="<?php echo $linha[qtde]?>"><br><br>
            Produto/Descrição: <input type="text" name="produto" size="70" maxlength="70" value="<?php echo $linha[produto]?>"><br><br>
            Valor unit custo.: <input type="text" name="valor_unit_custo" size="10" maxlength="10" value="<?php echo $linha[valor_unit_custo]?>"><br><br>
            <!--Valor tot custo: <input type="text" name="valor_tot_custo" size="10" maxlength="10"><br><br>-->
            Fornecedor: <input type="text" name="forn" size="20" maxlength="20" value="<?php echo $linha[forn]?>"><br><br>
            Valor frete: <input type="text" name="valor_frete" size="10" maxlength="10" value="<?php echo $linha[valor_frete]?>"><br><br>
            <!--Imposto: <input type="text" name="imposto" size="10" maxlength="10"><br><br>-->
            <!--Custo aprox: <input type="text" name="custo_aprox" size="10" maxlength="10"><br><br>-->
            <!--Lucro liq: <input type="text" name="lucro_liq" size="10" maxlength="10"><br><br>-->
            <!--V. min./lote: <input type="text" name="vminlote" size="10" maxlength="10"><br><br>-->
            V. Ofertado: <input type="text" name="vofertado" size="10" maxlength="10" value="<?php echo $linha[vofertado]?>"><br><br>
            % de lucro: <input type="text" name="porcentagem_lucro" size="3" maxlength="3" value="<?php echo $linha[porcentagem_lucro]?>"><br><br>            
            <input type="submit" value="Alterar" />
         </p>
    </form>  
</tr>