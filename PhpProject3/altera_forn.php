<?php
require "conecta.php";
require_once "cabecalho_reduzido.php";
require_once "cabecalho_lote.php";
require "js_cad_alt_forn.php";
//print_r ($_GET);
//print_r ($_REQUEST);
//seleciona a linha q marquei no radio
$sql = "SELECT * FROM cad_fornecedor WHERE id_cad_forn={$_GET[alterar]}";
//executa a query
$res = mysql_query($sql) or die("Erro selecionando (altera_forn.php)");
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
    if (empty($linha[licitante])){
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
      <script type="text/javascript" src="http://cidades-estados-js.googlecode.com/files/cidades-estados-v0.2.js"></script>
<script type="text/javascript">
    window.onload = function() {
        new dgCidadesEstados(
            document.getElementById('estado'),
            document.getElementById('cidade'),
            true
        );
    }
</script>       



<tr>
        <th colspan="2" height="159" align="left" class="A" scope="col">
        <form action="grava_cad_forn.php" method="POST" name="altera_forn">
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
                <td width="180" align="right">Razão Social:</td>
                <td><input type="text" name="razao_social" size="70" maxlength="100" value="<?php echo $linha[razao_social]; ?>">
                    
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Nome Fantasia:</td>
                <td><input type="text" name="nome_forn" size="70" maxlength="100" value="<?php echo $linha[nome_forn]; ?>">
                    
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Endereço(Rua, n°, Bairro e Cep):</td>
                <td><input type="text" name="end_completo" size="100" maxlength="100" value="<?php echo $linha[end_completo]; ?>">
                    
                </td>
            </tr>
            <tr>
                <td align="right">UF:</td>
                <td><select id="estado" name="estado">
                        <option value="<?php echo $linha[estado]; ?>"></option>
                    </select></td>
            </tr>
            <tr>
                <td align="right">CIDADE :</td>
                <td><select id="cidade" name="cidade">
                        <option value="<?php echo $linha[cidade]; ?>"></option>
                    </select></td>
                
            </tr>
            <tr>
                <td align="right">CNPJ:</td>
                <td><input type="text" name="cnpj" size="30" maxlength="18" onKeyDown="Mascara(this,Cnpj);" onKeyPress="Mascara(this,Cnpj);" onKeyUp="Mascara(this,Cnpj);" value="<?php echo $linha[cnpj]; ?>">
                    
                </td>
            </tr>
            <tr>
                <td width="140" align="right">IE:</td>
                <td><input type="text" name="ie" size="30" maxlength="20" value="<?php echo $linha[ie]; ?>">
                    
                </td>
            </tr>
            <tr>
                <td width="140" align="right">WebSite:</td>
                <td><input type="text" name="website_forn" size="30" maxlength="50" value="<?php echo $linha[website_forn]; ?>">
                    
                </td>
            </tr>
            
            <tr>
                <td width="140" align="right">Usuário:</td>
                <td><input type="text" name="usuario_forn" size="30" maxlength="50" value="<?php echo $linha[usuario_forn]; ?>">
                    
                </td>
            </tr>
                        
                <td width="140" align="right">Senha:</td>
                <td><input type="text" name="senha_forn" size="50" maxlength="50" value="<?php echo $linha[senha_forn]; ?>">
                    
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Contato Comercial:</td>
                <td><input type="text" name="contato_forn" size="50" maxlength="1000" value="<?php echo $linha[contato_forn]; ?>">
                    
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Skype:</td>
                <td><input type="text" name="msn_forn" size="50" maxlength="1000" value="<?php echo $linha[msn_forn]; ?>">
                    
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Email:</td>
                <td><input type="text" name="email_forn" size="50" maxlength="1000" value="<?php echo $linha[email_forn]; ?>">
                    
                </td>
            </tr>
            <tr>
                <td align="right">Fone:</td>
                <td><input type="text" name="fone_forn" size="20" maxlength="50" onKeyDown="Mascara(this,Telefone);" onKeyPress="Mascara(this,Telefone);" onKeyUp="Mascara(this,Telefone);" value="<?php echo $linha[fone_forn]; ?>">
                    
                </td>
            </tr>
            
            <tr>
                <td width="140" align="right">Contato RMA:</td>
                <td><input type="text" name="contato_rma" size="50" maxlength="1000" value="<?php echo $linha[contato_rma]; ?>">
                    
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Skype:</td>
                <td><input type="text" name="skype_rma" size="50" maxlength="1000" value="<?php echo $linha[skype_rma]; ?>">
                    
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Email:</td>
                <td><input type="text" name="email_rma" size="50" maxlength="1000" value="<?php echo $linha[email_rma]; ?>">
                    
                </td>
            </tr>
            <tr>
                <td align="right">Fone:</td>
                <td><input type="text" name="fone_rma" size="20" maxlength="50" onKeyDown="Mascara(this,Telefone);" onKeyPress="Mascara(this,Telefone);" onKeyUp="Mascara(this,Telefone);" value="<?php echo $linha[fone_rma]; ?>">
                    
                </td>
            </tr>
            
            <tr>
                <td width="140" align="right">Contato Financeiro:</td>
                <td><input type="text" name="contato_fin" size="50" maxlength="1000" value="<?php echo $linha[contato_fin]; ?>">
                    
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Skype:</td>
                <td><input type="text" name="skype_fin" size="50" maxlength="1000" value="<?php echo $linha[skype_fin]; ?>">
                    
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Email:</td>
                <td><input type="text" name="email_fin" size="50" maxlength="1000" value="<?php echo $linha[email_fin]; ?>">
                    
                </td>
            </tr>
            <tr>
                <td align="right">Fone:</td>
                <td><input type="text" name="fone_fin" size="20" maxlength="50" onKeyDown="Mascara(this,Telefone);" onKeyPress="Mascara(this,Telefone);" onKeyUp="Mascara(this,Telefone);" value="<?php echo $linha[fone_fin]; ?>">
                    
                </td>
            </tr>
            
            <tr>
                <td align="right">Segmento Predominante:</td>
                <td>
                    <select id="nome_forn" name="segmento_forn">
                        <?php
            
                            $nome_forn_query="SELECT nome_tipo_forn FROM tipo_fornecedor ORDER BY nome_tipo_forn ASC";
                            $nome_forn_result=mysql_query($nome_forn_query) or die ("Falha ao recuperar o NOME_FORN da base de dados: ".mysql_error());
                            echo "<option>$linha[segmento_forn]</option>";

                            while ($nome_forn_row=mysql_fetch_array($nome_forn_result)) {
                            $nome_forn=$nome_forn_row[nome_tipo_forn];
                                echo "<option>$nome_forn</option>";
                                }
                            
                        ?>
                    </select>
                           
                        
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Obs / Inf. Adic.:</td>
                <td><input type="text" name="obs_info" size="100" maxlength="200" value="<?php echo $linha[obs_info]; ?>">
                    
                </td>
            </tr>
            
            
            <input type="hidden" name="id_cad_forn" size="3" maxlength="3" value="<?php echo $linha[id_cad_forn]?>">
            
            <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                    echo '<script language="javascript">document.altera_forn.submit()</script>';
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
