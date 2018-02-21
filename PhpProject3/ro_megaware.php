<?php
require "conecta.php";
require ("cabecalho_reduzido.php");
require ("cabecalho_lote.php");

//print_r ($_GET);

$sql = "SELECT * FROM codigo WHERE id_cod={$_GET[id_cod]}";
$res = mysql_query($sql) or die("Erro seleção - linha");
$linha = mysql_fetch_assoc($res);

//require ("corpo_menu.php");
//exibir a tabela com os pré-cadastros feitos.
//require ("pesquisa_licita.php");

//======================VALIDAÇÃO E CONVERSÃO DE DADOS=====================
//validação só funcionará quando não for a primeira vez que entra-se no formulario
//!empty (se não for vazio, faça os testes abaixo)
if (!empty($_POST)){

//-------------CAMPO codigo-------------------------
if (empty($_POST[tipo_equipamento])){
        $erro = $erro_tipo_equipamento = true;
        }    
    
if (empty($_POST[lote])){
        $erro = $erro_lote = true;
        }
    
    
//não pode ser vazio o campo (campo obrigatório)
    if (empty($_POST[item])){
        $erro = $erro_item = true;
        }
    
//-------------CAMPO orgão-------------------------

//não pode ser vazio o campo (campo obrigatório)
    if (empty($_POST[qtde])){
        $erro = $erro_qtde = true;
        }
    
//-------------CAMPO licitante-------------------------
//não pode ser vazio o campo (campo obrigatório)
    }
?>


</table><br>    
<tr>
    <th colspan="2" height="159" align="left" class="A" scope="col">
    <form action="<?php if ($erro or empty($_POST)) echo "ro_megaware.php?id_cod=$_GET[id_cod]";
                            else echo "envia_ro_megaware.php"; ?>" method="POST" name="ro_megaware">
        <td><input type="hidden" name="redirect" value="cabecalho.php">
                </td>
                            
       <table width="1020" align="center" border="1" class="A" cellpading="0" cellspacing="0">
            <tr border="1">
                <td border="1">
        <table align="center" width="1010" border="0" class="A" cellpading="0" cellspacing="0" >
            <tr>
                <td colspan="2" align="center"><strong>CADASTRE AQUI SUA LICITAÇÃO PELA 1° VEZ<hr></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td align="right">Tipo Equipamento:</td>
                <td>
                    <select name="tipo_equipamento" size="0" >
                        <option><?php echo $_POST[tipo_equipamento]; ?></option>
                        <option>Notebook</option>
                        <option>Desktop</option>
                        
                    </select>
                           
                        <?php
                            if($erro_tipo_equipamento){
                                echo "<font color=red>*** Campo obrigatório</font>";
                            }
                        ?>
                
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Lote:</td>
                <td><input type="text" name="lote" size="20" maxlength="100" value="<?php echo $_POST[lote]; ?>">
                    <?php
                        if($erro_lote){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Item:</td>
                <td><input type="text" name="item" size="20" maxlength="100" value="<?php echo $_POST[item]; ?>">
                    <?php
                        if($erro_item){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Qtde:</td>
                <td><input type="text" name="qtde" size="20" maxlength="100" value="<?php echo $_POST[qtde]; ?>">
                    <?php
                        if($erro_qtde){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            
            <tr>
                <td><input type="hidden" name="id_cod" size="20" maxlength="100" value="<?php echo $_GET[id_cod]; ?>">
                </td>
                <td><input type="hidden" name="redirect" value="cabecalho.php">
                </td>
            </tr>
            
            
            <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                    echo '<script language="javascript">document.ro_megaware.submit()</script>';
                }
            
            ?> 
           <tr>
                <td></td>
                <td colspan="2" align="left"><input type="submit" value="Enviar RO - MEGAWARE" /></td>
                
            </tr>
        </form>  
</tr>
</table>
</table>