<?php
require "conecta.php";
require_once "cabecalho.php";


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
    <form action="lista_licita_meta_proxdiautil.php" method="POST">
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
                    <select name="licitante" size="0" >
                        <option><?php echo $_POST[licitante]; ?></option>
                        <option>elton</option>
                        <option>gustavo</option>
                        <option>gustavo.sbrissia</option>
                        
                      
                    </select>
                      
  
                
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

