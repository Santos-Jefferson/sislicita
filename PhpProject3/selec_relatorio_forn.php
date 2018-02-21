<?php
require "conecta.php";
require_once "cabecalho.php";


?>


</table><br>
<tr>
    <th colspan="2" height="159" align="left" class="A" scope="col">
    
    <!-- o form deve conter a tag name="" para que possa ser submetido automatica-->
    <form action="lista_email_forn.php" method="POST">
    <!--<form action="mailto:contato@maestroinformatica.net?bcc=jefferson2004@gmail.com,jeff@tes.com&subject=Cotação" method="POST">-->
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
                <td align="right">Segmento:</td>
                <td align="left">
                     <select id="segmento_forn" name="segmento_forn">
                        <?php
            
                            $segmento_forn_query="SELECT nome_tipo_forn FROM tipo_fornecedor ORDER BY nome_tipo_forn ASC";
                            $segmento_forn_result=mysql_query($segmento_forn_query) or die ("Falha ao recuperar o NOME_FORN da base de dados: ".mysql_error());
                            echo "<option>$_POST[segmento_forn]</option>";

                            while ($segmento_forn_row=mysql_fetch_array($segmento_forn_result)) {
                            $segmento_forn=$segmento_forn_row[nome_tipo_forn];
                                echo "<option>$segmento_forn</option>";
                                }
                            
                        ?>
                    </select>
                      
    </td>
            </tr>
            
           
            
           <?php/*
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                    echo '<script language="javascript">document.altera_lote.submit()</script>';
                }*/
            
            ?>
            <tr>
                <td></td>
                <td colspan="2" align="left"><input type="submit" value="Criar relatório" /></td>
                <td><br><br></td>
                
            </tr>
            </form>
</tr>
</table>
</table>

