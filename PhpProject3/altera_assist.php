<?php
require "conecta.php";
require_once "cabecalho_reduzido.php";
require_once "cabecalho_lote.php";
require "js_cad_alt_forn.php";
//print_r ($_GET);
//print_r ($_REQUEST);
//seleciona a linha q marquei no radio
$sql = "SELECT * FROM cad_assistencias WHERE id_cad_assist={$_GET[alterar]}";
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
<script language="javascript">
//-----------------------------------------------------
//Funcao: MascaraMoeda
//Sinopse: Mascara de preenchimento de moeda
//Parametro:
//   objTextBox : Objeto (TextBox)
//   SeparadorMilesimo : Caracter separador de milésimos
//   SeparadorDecimal : Caracter separador de decimais
//   e : Evento
//Retorno: Booleano
//Autor: Gabriel Fróes - www.codigofonte.com.br
//-----------------------------------------------------
function MascaraMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e){
    var sep = 0;
    var key = '';
    var i = j = 0;
    var len = len2 = 0;
    var strCheck = '0123456789';
    var aux = aux2 = '';
    var whichCode = (window.Event) ? e.which : e.keyCode;
    if (whichCode == 13) return true;
    key = String.fromCharCode(whichCode); // Valor para o código da Chave
    if (strCheck.indexOf(key) == -1) return false; // Chave inválida
    len = objTextBox.value.length;
    for(i = 0; i < len; i++)
        if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal)) break;
    aux = '';
    for(; i < len; i++)
        if (strCheck.indexOf(objTextBox.value.charAt(i))!=-1) aux += objTextBox.value.charAt(i);
    aux += key;
    len = aux.length;
    if (len == 0) objTextBox.value = '';
    if (len == 1) objTextBox.value = '0'+ SeparadorDecimal + '0' + aux;
    if (len == 2) objTextBox.value = '0'+ SeparadorDecimal + aux;
    if (len > 2) {
        aux2 = '';
        for (j = 0, i = len - 3; i >= 0; i--) {
            if (j == 3) {
                aux2 += SeparadorMilesimo;
                j = 0;
            }
            aux2 += aux.charAt(i);
            j++;
        }
        objTextBox.value = '';
        len2 = aux2.length;
        for (i = len2 - 1; i >= 0; i--)
        objTextBox.value += aux2.charAt(i);
        objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);
    }
    return false;
}
</script>

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
        <form action="grava_cad_assist.php" method="POST" name="altera_assist">
    <!--<form action="<?php //if ($erro or empty($_POST)) echo "altera_precad.php";
                            //else echo "grava_precad.php"; ?>" method="POST" name="altera_precad">-->
                            <br>
       <table align="center" border="1" width="1020" class="A" cellpading="0" cellspacing="0">
            <tr border="1">
                <td border="1">
        <table align="center" width="1010" border="0" class="A" cellpading="0" cellspacing="0" >
            <tr>
                <td colspan="2" align="center"><strong>ALTERE OS DADOS DA ASSISTÊNCIA<hr></td>
           </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td width="140" align="right">Razão Social:</td>
                <td><input type="text" name="razao_social" size="70" maxlength="100" value="<?php echo $linha[razao_social]; ?>">
                    <?php
                        if($erro_razao_social){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Nome Fantasia:</td>
                <td><input type="text" name="nome_assist" size="70" maxlength="100" value="<?php echo $linha[nome_assist]; ?>">
                    <?php
                        if($erro_nome_fant){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Endereço Completo:</td>
                <td><input type="text" name="end_completo" size="100" maxlength="100" value="<?php echo $linha[end_completo]; ?>">
                    <?php
                        if($erro_end_completo){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                    ?>
                </td>
            </tr>
            
            
            <tr>
                <td align="right">CNPJ:</td>
                <td><input type="text" name="cnpj" size="30" maxlength="18" onKeyDown="Mascara(this,Cnpj);" onKeyPress="Mascara(this,Cnpj);" onKeyUp="Mascara(this,Cnpj);" value="<?php echo $linha[cnpj]; ?>">
                    <?php
                        if($erro_cnpj){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="140" align="right">IE:</td>
                <td><input type="text" name="ie" size="30" maxlength="20" value="<?php echo $linha[ie]; ?>">
                    <?php
                        //if($erro_msn_trans){
                            //echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                    ?>
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Cód. Banco/Nome Banco:</td>
                <td><input type="text" name="cod_banco" size="30" maxlength="50" value="<?php echo $linha[cod_banco]; ?>">
                    <?php
                        //if($erro_msn_trans){
                            //echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                    ?>
                </td>
            </tr>
            
            <tr>
                <td width="140" align="right">Agência / Conta Corrente:</td>
                <td><input type="text" name="ag_cc" size="30" maxlength="50" value="<?php echo $linha[ag_cc]; ?>">
                    <?php
                        //if($erro_msn_trans){
                            //echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                    ?>
                </td>
            </tr>
                        
                <td width="140" align="right">Nome do Técnico/Responsável:</td>
                <td><input type="text" name="contato_assist" size="50" maxlength="50" value="<?php echo $linha[contato_assist]; ?>">
                    <?php
                        if($erro_contato_assist){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Email Abertura Chamados:</td>
                <td><input type="text" name="email_assist" size="50" maxlength="1000" value="<?php echo $linha[email_assist]; ?>">
                    <?php
                        if($erro_email_assist){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                    ?>
                </td>
            </tr>
            <tr>
                <td align="right">Fone 1:</td>
                <td><input type="text" name="fone_assist" size="20" maxlength="50" onKeyDown="Mascara(this,Telefone);" onKeyPress="Mascara(this,Telefone);" onKeyUp="Mascara(this,Telefone);" value="<?php echo $linha[fone_assist]; ?>">
                    <?php
                        if($erro_fone_assist){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            
            <tr>
                <td align="right">Fone 2:</td>
                <td><input type="text" name="fone_assist2" size="20" maxlength="50" onKeyDown="Mascara(this,Telefone);" onKeyPress="Mascara(this,Telefone);" onKeyUp="Mascara(this,Telefone);" value="<?php echo $linha[fone_assist2]; ?>">
                    <?php
                        if($erro_fone_assist2){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            
            <tr>
                <td align="right">Fone 3:</td>
                <td><input type="text" name="fone_assist3" size="20" maxlength="50" onKeyDown="Mascara(this,Telefone);" onKeyPress="Mascara(this,Telefone);" onKeyUp="Mascara(this,Telefone);" value="<?php echo $linha[fone_assist3]; ?>">
                    <?php
                        /*if($erro_fone_assist3){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }*/
                    ?>
                </td>
            </tr>
            
            <tr>
                <td align="right">UF:</td>
                <td>
                    <select id="estado" name="estado" size="0" >
                        <option><?php echo $linha[estado];?>
                        </option>
                    </select>
                    
            </tr>
            <tr>
                <td align="right">CIDADE Atendida:</td>
                <td><select id="cidade" name="cidade">
                        <option><?php echo $linha[cidade]; ?></option>
                    </select></td>
                
            </tr>
            
            <tr>
                <td align="right">Autorizada POSITIVO?</td>
                <td align="left">
                    <select name="aut_positivo" size="0" >
                        <option><?php echo $linha[aut_positivo]; ?></option>
                        <option>Sim</option>
                        <option>Não</option>
                    </select>
                      
                </td>
            </tr>
            <tr>
            <td width="" align="right">Valor Chamado (R$):</td>
                <td colspan=""><input type="text" name="valor_chamado" size="10" maxlength="100" onKeyPress="return(MascaraMoeda(this,'.',',',event))" value="<?php  echo $linha[valor_chamado]; ?>">
                    <?php/*
                        if($erro_valor_chamado){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }*/
                        

                    ?>
                </td>
                </tr>
                <tr>
                <td width="" align="right">Valor Retorno/Adic. (R$):</td>
                <td colspan=""><input type="text" name="valor_retorno" size="10" maxlength="100" onKeyPress="return(MascaraMoeda(this,'.',',',event))" value="<?php  echo $linha[valor_retorno]; ?>">
                    <?php/*
                        if($erro_valor_chamado){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }*/
                        

                    ?>
                </td>
                </tr>
            
            <tr>
                <td width="140" align="right">Obs / Inf. Adic.:</td>
                <td><input type="text" name="obs_info" size="100" maxlength="200" value="<?php echo $linha[obs_info]; ?>">
                    <?php
                        //if($erro_msn_trans){
                            //echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                    ?>
                </td>
            </tr>
            
            
            <tr>
            <td><input type="hidden" name="id_cad_assist" value="<?php echo $linha[id_cad_assist]?>"></td>
            </tr>
            <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                    echo '<script language="javascript">document.cad_assistencias.submit()</script>';
                }
            
            ?> 
           <tr>
                <td></td>
                <td colspan="2" align="left"><input type="submit" value="Alterar" /></td>
                
            </tr>
        </form>  
</tr>
</table>
</table>