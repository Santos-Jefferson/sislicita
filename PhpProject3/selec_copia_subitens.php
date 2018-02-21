
<?php
require "conecta.php";
require ("cabecalho_reduzido.php");
require ("cabecalho.php");
//print_r ($_REQUEST);
//die;
//require ("corpo_menu.php");
//exibir a tabela com os pré-cadastros feitos.
//require ("pesquisa_licita.php");

//======================VALIDAÇÃO E CONVERSÃO DE DADOS=====================
//validação só funcionará quando não for a primeira vez que entra-se no formulario
//!empty (se não for vazio, faça os testes abaixo)
if (!empty($_POST)){

//-------------CAMPO codigo-------------------------
    if (empty($_POST[num_lote_orig])){
        $erro = $erro_num_lote_orig = true;
        }
    
    if (empty($_POST[num_item_orig])){
        $erro = $erro_num_item_orig = true;
        }
        
    }
    
//DESATIVADO
//----------------CAMPO vofertado-------------------
//validação só funcionará quando não for a primeira vez que entra-se no formulario
//!empty (se não for vazio, faça os testes abaixo)
//if (!empty($_POST)){
//    //troca , por .
//   $_POST[vofertado] = (str_replace(',','.',$_POST[vofertado]));
//    //
//    //testa se é numérico ou nao
//    if(!is_numeric($_POST[vofertado])){
//       $erro = $erro_vofertado = true;
//       }
//    //TESTE SE O valor está na faixa permitida
//    elseif($_POST[vofertado] <0 or $_POST[vofertado] > 100){
//        $erro = $erro_vofertado_faixa = true;
//    }
//}

?>


</table><br>    
<tr>
    <th colspan="2" height="159" align="left" class="A" scope="col">
    <form action="<?php if ($erro or empty($_POST)) echo "selec_copia_subitens.php";
                            else echo "copia_subitens.php"; ?>" method="POST" name="selec_copia_subitens">
                            
       <table width="1020" align="center" border="1" class="A" cellpading="0" cellspacing="0">
            <tr border="1">
                <td border="1">
        <table align="center" width="1010" border="0" class="A" cellpading="0" cellspacing="0" >
            <tr>
                <td colspan="4" align="center"><strong>DIGITE OS n° UASG/CÓDIGO, LOTE/GRUPO e ITEM ORIGEM A SER COPIADO PARA O ITEM CRIADO:<hr></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td width="" align="right">UASG/CÓDIGO BB:</td>
                <td><input type="text" name="num_cod_orig" size="20" maxlength="300" value="<?php echo $_POST[num_cod_orig]; ?>">
                    <?php
                        if($erro_num_lote_orig){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="" align="right">LOTE/GRUPO:</td>
                <td><input type="text" name="num_lote_orig" size="3" maxlength="3" value="<?php echo $_POST[num_lote_orig]; ?>">
                    <?php
                        if($erro_num_lote_orig){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="" align="right">ITEM:</td>
                <td><input type="text" name="num_item_orig" size="3" maxlength="3" value="<?php echo $_POST[num_item_orig]; ?>">
                    <?php
                        if($erro_num_item_orig){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                    ?>
                </td>
                
            </tr>
                       
            <tr>
                
                <td><input type="hidden" name="codigo" value="<?php echo $_REQUEST[codigo]; ?>"></td>
                <td><input type="hidden" name="id_cod" value="<?php echo $_REQUEST[id_cod]; ?>"></td>
                <td><input type="hidden" name="id_lote" value="<?php echo $_REQUEST[id_lote]; ?>"></td>
                <td><input type="hidden" name="id_item_novo" value="<?php echo $_REQUEST[id_item_novo]; ?>"></td>
                
                
                
            </tr>
            
            
            
            <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                    echo '<script language="javascript">document.selec_copia_subitens.submit()</script>';
                }
            
            ?> 
           <tr>
                <td></td>
                <td colspan="2" align="left"><input type="submit" value="Copiar subitens" /></td>
                
            </tr>
        </form>  
</tr>
</table>
</table>