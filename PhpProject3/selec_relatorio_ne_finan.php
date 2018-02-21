<?php
require "conecta.php";
require_once "cabecalho_reduzido.php";
require_once "cabecalho_lote.php";

   
?>
</table><br>
<tr>
    <th colspan="2" height="159" align="left" class="A" scope="col">
    
    <!-- o form deve conter a tag name="" para que possa ser submetido automatica-->
    <form action="gera_relatorio_ne.php" method="POST">
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
                <td align="right">Status:</td>
                <td align="left">
                    <select name="status_ne" size="0" >
                        <!--<option><?php //echo $_GET[opcao]; ?></option>-->
                        <option>Todos</option>
                        <option>Aguardando Parecer Órgão</option>
                        <option>Cancelada</option>
                        <option>Compra efetuada</option>
                        <option>Em cotação</option>
                        <option>NE despachada</option>
                        <option>Pagamento efetuado</option>
                        
                    </select>
                      
                </td>
            </tr>
            <tr>
                <td align="right">Licitante:</td>
                <td align="left">
                    <select id="licitante" name="licitante">
                        <?php
            
                            $licitante_query="SELECT usuario FROM usuarios WHERE tipo_usuario='licitante' ORDER BY usuario ASC";
                            $licitante_result=mysql_query($licitante_query) or die ("Falha ao recuperar o NOME_FORN da base de dados: ".mysql_error());
                            echo "<option>Todos</option>";

                            while ($licitante_row=mysql_fetch_array($licitante_result)) {
                            $licitante=$licitante_row[usuario];
                                echo "<option>$licitante</option>";
                                }
                            
                        ?>
                    </select>
                      
                </td>
            </tr>
            <tr>
                <td align="right">Status comissão:</td>
                <td align="left">
                    <select name="status_comissao" size="0" >
                        <!--<option><?php //echo $_GET[opcao]; ?></option>-->
                        
                        <option>Todos</option>
                        <option>A Pagar</option>
                        <option>Pago</option>
                        <option>Não comissionado</option>
                    </select>
                      
                </td>
            </tr>
            <tr>
                <td align="right">Buscar:</td>
                <td> <input type="text" name="buscarne" maxlength="30" size="10"></td>
            </tr>
                
        
        </td>
            </tr>
                
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
                <td colspan="2" align="left"><input type="submit" value="Criar relatório" /></td>
                <td><br><br></td>
                
            </tr>
            </form>
</tr>
</table>
</table>
<?php
//require "gera_relatorio_ne.php";
?>

