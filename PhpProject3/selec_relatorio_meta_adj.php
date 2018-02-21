<?php
require "conecta.php";
require_once "cabecalho.php";

    
?>
</table><br>
<tr>
    <th colspan="2" height="159" align="left" class="A" scope="col">
    
    <!-- o form deve conter a tag name="" para que possa ser submetido automatica-->
    <form action="lista_licita_mes_meta_adj.php" method="POST">
    <!--<form action="<?php //if ($erro or empty($_POST)) echo "altera_lote.php"; 
                            //else echo "grava_lote.php"; ?>" method="POST" name="altera_lote">-->
        
       <table width="1020" border="1" align="center" class="A" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                
          <table width="1010" border="0" align="center" class="A" cellpadding="0" cellspacing="0">
            <tr>
                <td></td>
            </tr>
              <tr>
                <td colspan="2" align="center"><strong>ESCOLHA O STATUS PARA GERAR O RELATÓRIO<hr></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            
            <tr>
                <td align="right">Licitante:</td>
                <td align="left">
                     <select id="licitante" name="licitante">
                        <?php
            
                            $licitante_query="SELECT usuario FROM usuarios WHERE tipo_usuario='licitante' ORDER BY usuario ASC";
                            $licitante_result=mysql_query($licitante_query) or die ("Falha ao recuperar o NOME_FORN da base de dados: ".mysql_error());
                            echo "<option>$_POST[licitante]</option>";

                            while ($licitante_row=mysql_fetch_array($licitante_result)) {
                            $licitante=$licitante_row[usuario];
                                echo "<option>$licitante</option>";
                                }
                            
                        ?>
                    </select>
                      
    </td>
            </tr>
            
            <tr>
                <td align="right">Ano:</td>
                <td align="left">
                    <select name="ano" size="0" >
                        <option><?php echo $_POST[ano]; ?></option>
                        <option>2014</option>
                        <option>2013</option>
                        <option>2015</option>
                        <option>2016</option>
                        <option>2017</option>
                        
                        
                    </select>
                      
    </td>
            </tr>
            <tr>
                <td align="right">Mês:</td>
                <td align="left">
                    
                    <select name="mes" size="0" >
                        <option><?php echo $_POST[mes]; ?></option>
                        <option>01</option>
                        <option>02</option>
                        <option>03</option>
                        <option>04</option>
                        <option>05</option>
                        <option>06</option>
                        <option>07</option>
                        <option>08</option>
                        <option>09</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                        
                        
                    </select>
                      
    </td>
            </tr>
                
            
            <tr>
                <td></td>
                <td colspan="2" align="left"><input type="submit" value="Criar relatório" /></td>
                <td><br><br></td>
                
            </tr>
            </form>
</tr>
</table>
</table>

