<?php
require "conecta.php";
require_once "cabecalho_reduzido.php";
require_once "cabecalho_lote.php";
require "js_cad_alt_forn.php";
//print_r ($_GET);
//print_r ($_REQUEST);
//seleciona a linha q marquei no radio
$sql = "SELECT * FROM cad_transportadora WHERE id_cad_trans={$_GET[alterar]}";
//executa a query
$res = mysql_query($sql) or die("Erro selecionando (altera_trans.php)");
//desmonta o resutaldo e coloca os elementos do registro na linha
$linha = mysql_fetch_assoc($res);
//agora temos a linha preenchida com os dados do registro (acima)


//======================VALIDAÇÃO E CONVERSÃO DE DADOS=====================
//validação só funcionará quando não for a primeira vez que entra-se no formulario
//!empty (se não for vazio, faça os testes abaixo)
if (!empty($linha)){

//-------------CAMPO codigo-------------------------

//não pode ser vazio o campo (campo obrigatório)
    if (empty($linha[codigo])){
        $erro = $erro_codigo = true;
        }
        
    if (empty($linha[pregao])){
        $erro = $erro_pregao = true;
        }
    
//-------------CAMPO orgão-------------------------

//não pode ser vazio o campo (campo obrigatório)
    if (empty($linha[orgao])){
        $erro = $erro_orgao = true;
        }
    
//--------------CAMPO data-------------------------
//teste se é uma data gregoriana válida
//quebra a data em 3 partes
//após o slit, teremos o vetor $v em 3 pedaços: v[0] = dia, v[1] = mes, v[2] = ano
$v = split('[/.-]', $linha[data]);

//testa se a data é válida

//@ na frente da função é para inibir o warning, use com cuidado!!!
if(!@checkdate($v[1], $v[0], $v[2])){
        $erro = $erro_data = true;
}
//se deu certo, converte a data
else {
    $linha[data] = $v[2].'-'.$v[1].'-'.$v[0];
}

//-------------CAMPO hora-------------------------
//não pode ser vazio o campo (campo obrigatório)
    if (empty($linha[hora])){
        $erro = $erro_hora = true;
        }
    
    
//-------------CAMPO licitante-------------------------
//não pode ser vazio o campo (campo obrigatório)
    if (empty($linha[regiao_trans])){
        $erro = $erro_licitante = true;
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
             



<tr>
        <th colspan="2" height="159" align="left" class="A" scope="col">
        <form action="grava_cad_trans.php" method="POST" name="altera_trans">
    <!--<form action="<?php //if ($erro or empty($_POST)) echo "altera_precad.php";
                            //else echo "grava_precad.php"; ?>" method="POST" name="altera_precad">-->
                            <br>
       <table align="center" border="1" width="1020" class="A" cellpading="0" cellspacing="0">
            <tr border="1">
                <td border="1">
        <table align="center" width="1010" border="0" class="A" cellpading="0" cellspacing="0" >
            <tr>
                <td colspan="2" align="center"><strong>ALTERE OS DADOS DO FORNECEDOR<hr></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            
            <tr>
                <td width="140" align="right">Nome do Fornecedor:</td>
                <td><input type="text" name="nome_trans" size="50" maxlength="50" value="<?php echo $linha[nome_trans]; ?>">
                    <?php
                        if($erro_nome_trans){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Website:</td>
                <td><input type="text" name="website_trans" size="50" maxlength="500" value="<?php echo $linha[website_trans]; ?>">
                    <?php
                        if($erro_website_trans){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Usuário:</td>
                <td><input type="text" name="usuario_trans" size="50" maxlength="100" value="<?php echo $linha[usuario_trans]; ?>">
                    <?php
                        if($erro_usuario_trans){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Senha:</td>
                <td><input type="text" name="senha_trans" size="50" maxlength="50" value="<?php echo $linha[senha_trans]; ?>">
                    <?php
                        if($erro_senha_trans){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Contato:</td>
                <td><input type="text" name="contato_trans" size="50" maxlength="50" value="<?php echo $linha[contato_trans]; ?>">
                    <?php
                        if($erro_contato_trans){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Email:</td>
                <td><input type="text" name="email_trans" size="50" maxlength="50" value="<?php echo $linha[email_trans]; ?>">
                    <?php
                        if($erro_email_trans){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Msn:</td>
                <td><input type="text" name="msn_trans" size="50" maxlength="50" value="<?php echo $linha[msn_trans]; ?>">
                    <?php
                        //if($erro_msn_trans){
                            //echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                    ?>
                </td>
            </tr>
            
            
            <tr>
                <td align="right">Fone:</td>
                <td><input type="text" name="fone_trans" size="50" maxlength="50" onKeyDown="Mascara(this,Telefone);" onKeyPress="Mascara(this,Telefone);" onKeyUp="Mascara(this,Telefone);" value="<?php echo $linha[fone_trans]; ?>">
                    <?php
                        if($erro_fone_trans){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            
            <tr>
                <td align="right">Região Atendida:</td>
                <td>
                    <select name="regiao_trans" size="0" >
                        <option><?php echo $linha[regiao_trans]; ?></option>-->
                        <option>Sul</option>
                        <option>Sudeste</option>
                        <option>Centro-Oeste</option>
                        <option>Norte</option>
                        <option>Nordeste</option>
                        <option>Sul/Sudeste/Centro-Oeste</option>
                        <option>Sul/Sudeste</option>
                        <option>Norte/Nordeste/Centro-Oeste</option>
                        <option>Norte/Nordeste</option>
                        <option>Todo Brasil</option>
                    </select>
                           
                        <?php
                            if($erro_regiao_trans){
                                echo "<font color=red>*** Campo obrigatório</font>";
                            }
                        ?>
                </td>
            </tr>
            
            <input type="hidden" name="id_cad_trans" size="3" maxlength="3" value="<?php echo $linha[id_cad_trans]?>">
            
            <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                    echo '<script language="javascript">document.altera_trans.submit()</script>';
                }
            
            ?>
            <tr>
                <td></td>
                <td colspan="2" align="left"><input type="submit" value="Alterar" /></td>
                
            </tr>
        </form>  
</tr>
  
    



<!--<tr>
    <th colspan="2" height="159" align="left" class="A" scope="col">
    <form action="grava_precad.php" method="POST">
            <input type="hidden" name="id" size="3" maxlength="3" value="<?php //echo $linha[id]?>"><br><br>

            <p>Licitante:
              <select  name="licitante" size="0">
                <option><?php //echo $linha[licitante] ?></option>
                <option>Dyuliane</option>
                <option>Getulio</option>
                <option>Marcelo</option>
              </select>
              <br><br>
            
            Cód. BB/UASG/PREGÃO: <input type="text" name="codigo" size="16" maxlength="16" value="<?php //echo $linha[codigo]?>"><br><br>
            D/H - Inclusão: <input type="text" name="data" size="20" maxlength="10" value="<?php //echo $linha[data]?>"><br><br>
            Status:
              <select name="status" size="0" default="<?php //echo $linha[status]?>">
                <option>Aguardando pregao</option>
                <option>Encerrada-Acompanhar</option>
                <option>Encerrada-Arrematado</option>
                <option>Arquivado</option>
              </select><br><br>
            <input type="submit" value="Pré-Cadastrar" />
         </p>
    </form>  
  </tr>--><?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
