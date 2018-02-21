<?php
//require ("cabecalho_reduzido.php");
//require ("cabecalho.php");
require ("cabecalho_geral.php");
//require ("corpo_menu.php");
//exibir a tabela com os pré-cadastros feitos.
//require ("pesquisa_licita.php");

//======================VALIDAÇÃO E CONVERSÃO DE DADOS=====================
//validação só funcionará quando não for a primeira vez que entra-se no formulario
//!empty (se não for vazio, faça os testes abaixo)
if (!empty($_POST)){

//-------------CAMPO codigo-------------------------
    if (empty($_POST[nome_assist])){
        $erro = $erro_nome_trans = true;
        }
    
    if (empty($_POST[contato_assist])){
        $erro = $erro_contato_trans = true;
        }
        
    if (empty($_POST[email_assist])){
        $erro = $erro_email_trans = true;
        }
        
    //if (empty($_POST[msn_trans])){
      //  $erro = $erro_msn_trans = true;
        //}
        
    if (empty($_POST[fone_assist])){
        $erro = $erro_fone_trans = true;
        }
    
//--------------CAMPO data-------------------------
//teste se é uma data gregoriana válida
//quebra a data em 3 partes
//após o slit, teremos o vetor $v em 3 pedaços: v[0] = dia, v[1] = mes, v[2] = ano

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


<script type="text/javascript">
/*
*    Script:    Mascaras em Javascript
*    Autor:    Matheus Biagini de Lima Dias
*    Data:    26/08/2008
*    Obs:    
*/
    /*Função Pai de Mascaras*/
    function Mascara(o,f){
        v_obj=o
        v_fun=f
        setTimeout("execmascara()",1)
    }
    
    /*Função que Executa os objetos*/
    function execmascara(){
        v_obj.value=v_fun(v_obj.value)
    }
    
    /*Função que Determina as expressões regulares dos objetos*/
    function leech(v){
        v=v.replace(/o/gi,"0")
        v=v.replace(/i/gi,"1")
        v=v.replace(/z/gi,"2")
        v=v.replace(/e/gi,"3")
        v=v.replace(/a/gi,"4")
        v=v.replace(/s/gi,"5")
        v=v.replace(/t/gi,"7")
        return v
    }
    
    /*Função que permite apenas numeros*/
    function Integer(v){
        return v.replace(/\D/g,"")
    }
    
    /*Função que padroniza telefone (11) 4184-1241*/
    function Telefone(v){
        v=v.replace(/\D/g,"")                 
        v=v.replace(/^(\d\d)(\d)/g,"($1) $2") 
        v=v.replace(/(\d{4})(\d)/,"$1-$2")
        
        return v
    }
    
    
    /*Função que padroniza telefone (11) 41841241*/
    function TelefoneCall(v){
        v=v.replace(/\D/g,"")                 
        v=v.replace(/^(\d\d)(\d)/g,"($1) $2")
        return v
    }
    
    /*Função que padroniza CPF*/
    function Cpf(v){
        v=v.replace(/\D/g,"")                    
        v=v.replace(/(\d{3})(\d)/,"$1.$2")       
        v=v.replace(/(\d{3})(\d)/,"$1.$2")       
                                                 
        v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2") 
        return v
    }
    
    /*Função que padroniza CEP*/
    function Cep(v){
        v=v.replace(/D/g,"")                
        v=v.replace(/^(\d{5})(\d)/,"$1-$2") 
        return v
    }
    
    /*Função que padroniza CNPJ*/
    function Cnpj(v){
        v=v.replace(/\D/g,"")                   
        v=v.replace(/^(\d{2})(\d)/,"$1.$2")     
        v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3") 
        v=v.replace(/\.(\d{3})(\d)/,".$1/$2")           
        v=v.replace(/(\d{4})(\d)/,"$1-$2")              
        return v
    }
    
    /*Função que permite apenas numeros Romanos*/
    function Romanos(v){
        v=v.toUpperCase()             
        v=v.replace(/[^IVXLCDM]/g,"") 
        
        while(v.replace(/^M{0,4}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/,"")!="")
            v=v.replace(/.$/,"")
        return v
    }
    
    /*Função que padroniza o Site*/
    function Site(v){
        v=v.replace(/^http:\/\/?/,"")
        dominio=v
        caminho=""
        if(v.indexOf("/")>-1)
            dominio=v.split("/")[0]
            caminho=v.replace(/[^\/]*/,"")
            dominio=dominio.replace(/[^\w\.\+-:@]/g,"")
            caminho=caminho.replace(/[^\w\d\+-@:\?&=%\(\)\.]/g,"")
            caminho=caminho.replace(/([\?&])=/,"$1")
        if(caminho!="")dominio=dominio.replace(/\.+$/,"")
            v="http://"+dominio+caminho
        return v
    }

    /*Função que padroniza DATA*/
    function Data(v){
        v=v.replace(/\D/g,"") 
        v=v.replace(/(\d{2})(\d)/,"$1/$2") 
        v=v.replace(/(\d{2})(\d)/,"$1/$2") 
        return v
    }
    
    /*Função que padroniza DATA*/
    function Hora(v){
        v=v.replace(/\D/g,"") 
        v=v.replace(/(\d{2})(\d)/,"$1:$2")  
        return v
    }
    
    /*Função que padroniza valor monétario*/
    function Valor(v){
        v=v.replace(/\D/g,"") //Remove tudo o que não é dígito
        v=v.replace(/^([0-9]{3}\.?){3}-[0-9]{2}$/,"$1.$2");
        //v=v.replace(/(\d{3})(\d)/g,"$1,$2")
        v=v.replace(/(\d)(\d{2})$/,"$1.$2") //Coloca ponto antes dos 2 últimos digitos
        return v
    }
    
    /*Função que padroniza Area*/
    function Area(v){
        v=v.replace(/\D/g,"") 
        v=v.replace(/(\d)(\d{2})$/,"$1.$2") 
        return v
        
    }
</script>


<script type="text/javascript">
			function Formatadata(Campo, teclapres)
			{
				var tecla = teclapres.keyCode;
				var vr = new String(Campo.value);
				vr = vr.replace("/", "");
				vr = vr.replace("/", "");
				vr = vr.replace("/", "");
				tam = vr.length + 1;
				if (tecla != 8 && tecla != 8)
				{
					if (tam > 0 && tam < 2)
						Campo.value = vr.substr(0, 2) ;
					if (tam > 2 && tam < 4)
						Campo.value = vr.substr(0, 2) + '/' + vr.substr(2, 2);
					if (tam > 4 && tam < 7)
						Campo.value = vr.substr(0, 2) + '/' + vr.substr(2, 2) + '/' + vr.substr(4, 7);
				}
			}
                        
                        function Formatahora(Campo, teclapres)
			{
				var tecla = teclapres.keyCode;
				var vr = new String(Campo.value);
				vr = vr.replace(":", "");
				tam = vr.length + 1;
				if (tecla != 5 && tecla != 5)
				{
					if (tam > 0 && tam < 2)
						Campo.value = vr.substr(0, 2) ;
					if (tam > 2 && tam < 4)
						Campo.value = vr.substr(0, 2) + ':' + vr.substr(2, 2);
					
				}
			}
                            function Telefone(v){
                                        v=v.replace(/\D/g,"")                 
                                        v=v.replace(/^(\d\d)(\d)/g,"($1) $2") 
                                        v=v.replace(/(\d{4})(\d)/,"$1-$2")    
                                        return v
                                    }
                                    
</script>


</table><br>    
<tr>
    <th colspan="2" height="159" align="left" class="A" scope="col">
    <form action="<?php if ($erro or empty($_POST)) echo "cad_assistencias.php";
                            else echo "grava_cad_assist.php"; ?>" method="POST" name="cad_assistencias">
                            
       <table width="1010" align="center" border="1" class="A" cellpading="0" cellspacing="0">
            <tr border="1">
                <td border="1">
        <table align="center" width="1010" border="0" class="A" cellpading="0" cellspacing="0" >
            <tr>
                <td colspan="2" align="center"><h1><strong>CADASTRO ASSISTÊNCIAS TÉCNICAS<hr></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td width="140" align="right">Razão Social:</td>
                <td><input type="text" name="razao_social" size="70" maxlength="100" value="<?php echo $_POST[razao_social]; ?>">
                    <?php
                        if($erro_razao_social){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Nome Fantasia:</td>
                <td><input type="text" name="nome_assist" size="70" maxlength="100" value="<?php echo $_POST[nome_assist]; ?>">
                    <?php
                        if($erro_nome_fant){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Endereço Completo:</td>
                <td><input type="text" name="end_completo" size="100" maxlength="100" value="<?php echo $_POST[end_completo]; ?>">
                    <?php
                        if($erro_end_completo){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                    ?>
                </td>
            </tr>
            <tr>
                <td align="right">CNPJ:</td>
                <td><input type="text" name="cnpj" size="30" maxlength="18" onKeyDown="Mascara(this,Cnpj);" onKeyPress="Mascara(this,Cnpj);" onKeyUp="Mascara(this,Cnpj);" value="<?php echo $_POST[cnpj]; ?>">
                    <?php
                        if($erro_cnpj){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="140" align="right">IE:</td>
                <td><input type="text" name="ie" size="30" maxlength="20" value="<?php echo $_POST[ie]; ?>">
                    <?php
                        //if($erro_msn_trans){
                            //echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                    ?>
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Cód. Banco/Nome Banco:</td>
                <td><input type="text" name="cod_banco" size="30" maxlength="50" value="<?php echo $_POST[cod_banco]; ?>">
                    <?php
                        //if($erro_msn_trans){
                            //echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                    ?>
                </td>
            </tr>
            
            <tr>
                <td width="140" align="right">Agência / Conta Corrente:</td>
                <td><input type="text" name="ag_cc" size="30" maxlength="50" value="<?php echo $_POST[ag_cc]; ?>">
                    <?php
                        //if($erro_msn_trans){
                            //echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                    ?>
                </td>
            </tr>
                        
                <td width="140" align="right">Nome do Técnico/Responsável:</td>
                <td><input type="text" name="contato_assist" size="50" maxlength="50" value="<?php echo $_POST[contato_assist]; ?>">
                    <?php
                        if($erro_contato_assist){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Email Abertura Chamados:</td>
                <td><input type="text" name="email_assist" size="50" maxlength="1000" value="<?php echo $_POST[email_assist]; ?>">
                    <?php
                        if($erro_email_assist){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                    ?>
                </td>
            </tr>
            <tr>
                <td align="right">Fone 1:</td>
                <td><input type="text" name="fone_assist" size="20" maxlength="50" onKeyDown="Mascara(this,Telefone);" onKeyPress="Mascara(this,Telefone);" onKeyUp="Mascara(this,Telefone);" value="<?php echo $_POST[fone_assist]; ?>">
                    <?php
                        if($erro_fone_assist){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            
            <tr>
                <td align="right">Fone 2:</td>
                <td><input type="text" name="fone_assist2" size="20" maxlength="50" onKeyDown="Mascara(this,Telefone);" onKeyPress="Mascara(this,Telefone);" onKeyUp="Mascara(this,Telefone);" value="<?php echo $_POST[fone_assist2]; ?>">
                    <?php
                        if($erro_fone_assist2){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            
            <tr>
                <td align="right">Fone 3:</td>
                <td><input type="text" name="fone_assist3" size="20" maxlength="50" onKeyDown="Mascara(this,Telefone);" onKeyPress="Mascara(this,Telefone);" onKeyUp="Mascara(this,Telefone);" value="<?php echo $_POST[fone_assist3]; ?>">
                    <?php
                        /*if($erro_fone_assist3){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }*/
                    ?>
                </td>
            </tr>
            
            <tr>
                <td align="right">UF:</td>
                <td><select id="estado" name="estado">
                        <option value="<?php echo $_POST[estado]; ?>"></option>
                    </select></td>
            </tr>
            <tr>
                <td align="right">CIDADE Atendida:</td>
                <td><select id="cidade" name="cidade">
                        <option value="<?php echo $_POST[cidade]; ?>"></option>
                    </select></td>
                
            </tr>
            
            <tr>
                <td align="right">Autorizada POSITIVO?</td>
                <td align="left">
                    <select name="aut_positivo" size="0" >
                        <option><?php echo $_POST[aut_positivo]; ?></option>
                        <option>Sim</option>
                        <option>Não</option>
                    </select>
                      
                </td>
            </tr>
            <tr>
            <td width="" align="right">Valor Chamado (R$):</td>
                <td colspan=""><input type="text" name="valor_chamado" size="10" maxlength="100" onKeyPress="return(MascaraMoeda(this,'.',',',event))" value="<?php  echo $_POST[valor_chamado]; ?>">
                    
                </td>
                </tr>
                <tr>
                <td width="" align="right">Valor Retorno/Adic. (R$):</td>
                <td colspan=""><input type="text" name="valor_retorno" size="10" maxlength="100" onKeyPress="return(MascaraMoeda(this,'.',',',event))" value="<?php  echo $_POST[valor_retorno]; ?>">
                    
                </td>
                </tr>
            
            
            <tr>
                <td width="140" align="right">Obs / Inf. Adic.:</td>
                <td><input type="text" name="obs_info" size="100" maxlength="200" value="<?php echo $_POST[obs_info]; ?>">
                    <?php
                        //if($erro_msn_trans){
                            //echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                    ?>
                </td>
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
                <td colspan="2" align="left"><input type="submit" value="Cadastrar" class='botao'/></td>
                
            </tr>
        </form>  
</tr>
</table>
</table>