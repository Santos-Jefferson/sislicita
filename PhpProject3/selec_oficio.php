
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
    if (empty($_POST[dec_nome])){
        $erro = $erro_dec_nome = true;
        }
        if (empty($_POST[conteudo_dec])){
        $erro = $erro_conteudo_dec = true;
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
    <form action="<?php if ($erro or empty($_POST)) echo "selec_oficio.php";
                            else echo "gera_oficios.php"; ?>" method="POST" name="selec_dec_personalizado">
                            
       <table width="1020" align="center" border="1" class="A" cellpading="0" cellspacing="0">
            <tr border="1">
                <td border="1">
        <table align="center" width="1010" border="0" class="A" cellpading="0" cellspacing="0" >
            <tr>
                <td colspan="4" align="center"><strong>PREENCHA AS INFORMAÇÕES ABAIXO:<hr></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            
            <tr>
                <td width="" align="right">Ofício Referente à:</td>
                <td><input type="text" name="dec_nome" size="100" maxlength="2000" value="<?php echo $_POST[dec_nome]; ?>">
                    <?php
                        if($erro_dec_nome){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="" align="right">Conteúdo do Ofício:</td>
                <td><textarea  name="conteudo_dec" cols="75" rows="30"><?php echo $_POST[conteudo_dec]; ?></textarea>
                    <?php
                        if($erro_conteudo_dec){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                            echo "<font color=blue>   Ex.: vem por meio deste....</font>";
                    ?>
                </td>
            </tr>
            
                       
            <tr>
                <td><input type="hidden" name="orgao" value="<?php echo $_REQUEST[orgao]; ?>"></td>
                <td><input type="hidden" name="pregao" value="<?php echo $_REQUEST[pregao]; ?>"></td>
                <td><input type="hidden" name="codigo" value="<?php echo $_REQUEST[codigo]; ?>"></td>
                <td><input type="hidden" name="lote" value="<?php echo $_REQUEST[lote]; ?>"></td>
                <td><input type="hidden" name="licitante" value="<?php echo $_REQUEST[licitante]; ?>"></td>
                <td><input type="hidden" name="id_itens" value="<?php echo $_REQUEST[id_itens]; ?>"></td>
                <td><input type="hidden" name="id_cod" value="<?php echo $_REQUEST[id_cod]; ?>"></td>
                <td><input type="hidden" name="id_lote" value="<?php echo $_REQUEST[id_lote]; ?>"></td>
                <td><input type="hidden" name="rep_legal" value="<?php echo $_REQUEST[rep_legal]; ?>"></td>
                
                
                
            </tr>
            
            
            
            <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                    echo '<script language="javascript">document.selec_dec_personalizado.submit()</script>';
                }
            
            ?> 
           <tr>
                <td></td>
                <td colspan="2" align="left"><input type="submit" value="Gerar Declaração" /></td>
                
            </tr>
        </form>  
</tr>
</table>
</table>