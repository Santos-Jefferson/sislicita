<?php
require "conecta.php";
require_once "cabecalho_reduzido.php";
require_once "cabecalho_lote.php";

//$sql = "SELECT * from lote WHERE id_lote = {$_GET[id_lote]}";
//$lote = mysql_query($sql) or die ("Erro seleção lote");
//$linha_lote = mysql_fetch_assoc($lote);

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
                        <option><?php echo $_POST[status_ne]; ?></option>
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
                <td align="right">Status comissão:</td>
                <td align="left">
                    <select name="status_comissao" size="0" >
                        <option><?php echo $_POST[status_comissao]; ?></option>
                        
                        <option>Todos</option>
                        <option>A Pagar</option>
                        <option>Pago</option>
                        <option>Não comissionado</option>
                    </select>
                      
                </td>
            </tr>
            <tr>
                <td align="right">Ano de Referência:</td>
                <td align="left">
                    <select name="ano_ref" size="0" >
                        <option><?php echo $_POST[ano_ref]; ?></option>
                        
                        <option>Todos</option>
                        <option>2017</option>
                        <option>2016</option>
                        <option>2015</option>
                        <option>2014</option>
                        <option>2014</option>
                        <option>2013</option>
                        <option>2012</option>
                        <option>2011</option>
                        
                    </select>
                      
                </td>
            </tr>
            <tr>
                <td align="right">Mês de Referência:</td>
                <td align="left">
                    <select name="mes_ref" size="0" >
                        <option><?php echo $_POST[mes_ref]; ?></option>
                        
                        <option>Todos</option>
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

