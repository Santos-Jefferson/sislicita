<?php
require ("cabecalho_reduzido.php");
require ("cabecalho_lote.php");
//require ("corpo_menu.php");
//exibir a tabela com os pré-cadastros feitos.
//require ("pesquisa_licita.php");

//======================VALIDAÇÃO E CONVERSÃO DE DADOS=====================
//validação só funcionará quando não for a primeira vez que entra-se no formulario
//!empty (se não for vazio, faça os testes abaixo)
if (!empty($_POST)){

//-------------CAMPO codigo-------------------------

//não pode ser vazio o campo (campo obrigatório)
    if (empty($_POST[lote])){
        $erro = $erro_lote = true;
        }
}
    
?>
<tr>
    <th colspan="2" height="159" align="left" class="A" scope="col">
    
    <!-- o form deve conter a tag name="" para que possa ser submetido automatica-->
    <form action="<?php if ($erro or empty($_POST)) echo "cad_lote.php"; 
                            else echo "grava_lote.php"; ?>" method="POST" name="cad_lote">
        
       <table width="1020" border="1" align="center" class="A" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                
          <table width="1010" border="0" align="center" class="A" cellpadding="0" cellspacing="0">
            <tr>
                <td></td>
            </tr>
              <tr>
                <td colspan="2" align="center"><strong>CADASTRE AQUI OS LOTES DA SUA LICITAÇÃO<hr></td>
            </tr>
            <tr>
                <td><br><br></td>
            </tr>
            
            <tr>
                <td width="120" align="right">CÓDIGO LICITAÇÃO:</td>
                <td><input type="text" name="codigo" size="20" maxlength="20" value="<?php echo $_REQUEST[codigo]; ?>" disabled>
                </td>
            </tr>
            
            <tr>
                <td align="right">Lote/Grupo:</td>
                <td><input type="text" name="lote" size="20" maxlength="20" value="<?php echo $_POST[lote]; ?>">
                    <?php
                        if($erro_lote){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            
            <tr>
                
                <td><input type="hidden" name="codigo" value="<?php echo $_REQUEST[codigo]; ?>">
                </td>
                <td><input type="hidden" name="id_cod" value="<?php echo $_REQUEST[id_cod]; ?>">
                </td> 
                
                
            </tr>
            
            <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                    echo '<script language="javascript">document.cad_lote.submit()</script>';
                }
            
            ?>
            <tr>
                <td><br><br></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2" align="left"><input type="submit" value="Cad. Lote" /></td>
                
            </tr>
        </form>  
</tr>
