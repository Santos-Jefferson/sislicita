<?php
require ("cabecalho_reduzido.php");
require ("cabecalho_lote.php");
//require ("corpo_menu.php");
//exibir a tabela com os pré-cadastros feitos.
//require ("pesquisa_licita.php");

//======================VALIDAÇÃO E CONVERSÃO DE DADOS=====================
//validação só funcionará quando não for a primeira vez que entra-se no formulario
//!empty (se não for vazio, faça os testes abaixo)
//print_r ($_POST);



if (!empty($_POST)){

//-------------CAMPO itens-------------------------

//não pode ser vazio o campo (campo obrigatório)
  if (empty($_POST[item])){
        $erro = $erro_item = true;
        }
    
//-------------CAMPO qtde-------------------------

//não pode ser vazio o campo (campo obrigatório)
    if (empty($_POST[qtde])){
        $erro = $erro_qtde = true;
        }
    
//-------------CAMPO produto-------------------------

//não pode ser vazio o campo (campo obrigatório)
//    if (empty($_POST[produto])){
  //      $erro = $erro_produto = true;
    //    }
    
//--------------CAMPO data-------------------------
//teste se é uma data gregoriana válida
//quebra a data em 3 partes
//após o slit, teremos o vetor $v em 3 pedaços: v[0] = dia, v[1] = mes, v[2] = ano
//$v = split('[/.-]', $_POST[data]);

//testa se a data é válida

//@ na frente da função é para inibir o warning, use com cuidado!!!
//if(!@checkdate($v[1], $v[0], $v[2])){
        //$erro = $erro_data = true;
//}
//se deu certo, converte a data
//else {
   // $_POST[data] = $v[2].'-'.$v[1].'-'.$v[0];
//}

//-------------CAMPO v unit custo-------------------------
//não pode ser vazio o campo (campo obrigatório)
    //if (empty($_POST[vunitcusto])){
      //  $erro = $erro_vunitcusto = true;
        //}
    
    
//-------------CAMPO fornecedor-------------------------
//não pode ser vazio o campo (campo obrigatório)
    //if (empty($_POST[forn])){
      //  $erro = $erro_forn = true;
        //}
        
        
        //-------------CAMPO v frete-------------------------
//não pode ser vazio o campo (campo obrigatório)
    //if (empty($_POST[vfrete])){
      //  $erro = $erro_vfrete = true;
        //}
        
        //-------------CAMPO o fertado-------------------------
//não pode ser vazio o campo (campo obrigatório)
    //if (empty($_POST[vofertado])){
      //  $erro = $erro_vofertado = true;
        //}
        
        //-------------CAMPO % lucro-------------------------
//não pode ser vazio o campo (campo obrigatório)
    //if (empty($_POST[porc_lucro])){
      //  $erro = $erro_porc_lucro = true;
        //}
        
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

<tr>
    <th colspan="2" height="159" align="left" class="A" scope="col">
    <!-- o form deve conter a tag name="" para que possa ser submetido automatica-->
    
    <form action="<?php if ($erro or empty($_POST)) echo "cad_itens.php";
                            else echo "grava_itens.php"; ?>" method="POST" name="cad_itens">
        
        <table border="0">
            
            
            <tr>
                <td align="right">CÓDIGO LICITAÇÃO:</td>
                <td><input type="text" name="codigo" size="20" maxlength="20" value="<?php echo $_REQUEST[codigo]; ?>" disabled>
                </td>
            </tr>
            <tr>
                <td align="right">LOTE:</td>
                <td><input type="text" name="lote" size="20" maxlength="20" value="<?php echo $_REQUEST[lote]; ?>" disabled>
                </td>
            </tr>
            
            <tr>
                <td align="right">Item n°:</td>
                <td><input type="text" name="item" size="3" maxlength="3" value="<?php echo $_POST[item]; ?>">
                    <?php
                        if($erro_item){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            
            <tr>
                <td align="right">Qtde:</td>
                <td><input type="text" name="qtde" size="5" maxlength="5" value="<?php echo $_POST[qtde]; ?>">
                    <?php
                        if($erro_qtde){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            
            <tr>
                <td align="right">Descrição/Produto:</td>
                <td><input type="text" name="produto" size="80" maxlength="80" value="<?php echo $_POST[produto]; ?>">
                    <?php
                       // if($erro_produto){
                         //   echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                    ?>
                </td>
            </tr>
            
            <tr>
                <td align="right">V.Unit.Custo:</td>
                <td><input type="text" name="vunitcusto" size="10" maxlength="10" value="<?php echo $_POST[vunitcusto]; ?>">
                    <?php
                      //  if($erro_vunitcusto){
                        //    echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                    ?>
                    
                </td>
            </tr>
            
            <tr>
                <td align="right">Fornecedor:</td>
                <td><input type="text" name="forn" size="20" maxlength="20" value="<?php echo $_POST[forn]; ?>">
                    <?php
                       // if($erro_forn){
                        //    echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                        
                    ?>
                    
                </td>
            </tr>
            
            <tr>
                <td align="right">Valor Frete:</td>
                <td><input type="text" name="vfrete" size="10" maxlength="10" value="<?php echo $_POST[vfrete]; ?>">
                    <?php
                        //if($erro_vfrete){
                         //   echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                        
                    ?>
                    
                </td>
            </tr>
            
            <tr>
                <td align="right">Valor Ofertado:</td>
                <td><input type="text" name="vofertado" size="10" maxlength="10" value="<?php echo $_POST[vofertado]; ?>">
                    <?php
                        //if($erro_vofertado){
                         //   echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                        
                    ?>
                    
                </td>
            </tr>
            
            <tr>
                <td align="right">% de lucro:</td>
                <td><input type="text" name="porc_lucro" size="3" maxlength="3" value="<?php echo $_POST[porc_lucro]; ?>">
                    <?php
                        //if($erro_porc_lucro){
                         //   echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                        
                    ?>
                    
                </td>
            </tr>
            
            <tr>
                
                <td><input type="hidden" name="lote" value="<?php echo $_REQUEST[lote]; ?>">
                </td>   
                
            </tr>
            
            <tr>
                
                <td><input type="hidden" name="codigo" value="<?php echo $_REQUEST[codigo]; ?>">
                </td>
                <td><input type="hidden" name="lote" value="<?php echo $_REQUEST[lote]; ?>">
                </td>
                <td><input type="hidden" name="id_lote" value="<?php echo $_REQUEST[id_lote]; ?>">
                </td> 
                
                
            </tr>
            
            
            
            
            <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                  echo '<script language="javascript">document.cad_itens.submit()</script>';
                }
            
            ?>
            <tr>
                <td></td>
                <td colspan="2" align="left"><input type="submit" value="Cadastrar" /></td>
                
            </tr>
        </form>  
</tr>
<?php 

require "lista_itens_tudo.php";

?>