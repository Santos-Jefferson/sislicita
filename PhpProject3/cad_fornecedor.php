<?php
//require ("cabecalho_reduzido.php");
require ("conecta.php");
require ("cabecalho_geral.php");
//require ("corpo_menu.php");
//exibir a tabela com os pré-cadastros feitos.
//require ("pesquisa_licita.php");

//======================VALIDAÇÃO E CONVERSÃO DE DADOS=====================
//validação só funcionará quando não for a primeira vez que entra-se no formulario
//!empty (se não for vazio, faça os testes abaixo)
if (!empty($_POST)){

//-------------CAMPO codigo-------------------------
    if (empty($_POST[nome_forn])){
        $erro = $erro_nome_forn = true;
        }
        
    if (empty($_POST[website_forn])){
        $erro = $erro_website_forn = true;
        }
        
    if (empty($_POST[usuario_forn])){
        $erro = $erro_usuario_forn = true;
        }
        
    if (empty($_POST[senha_forn])){
        $erro = $erro_senha_forn = true;
        }
    
    if (empty($_POST[contato_forn])){
        $erro = $erro_contato_forn = true;
        }
        
    if (empty($_POST[msn_forn])){
        $erro = $erro_msn_forn = true;
        }
    
    if (empty($_POST[email_forn])){
        $erro = $erro_email_forn = true;
        }
        
    if (empty($_POST[fone_forn])){
        $erro = $erro_fone_forn = true;
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
    <form action="<?php if ($erro or empty($_POST)) echo "cad_fornecedor.php";
                            else echo "grava_cad_forn.php"; ?>" method="POST" name="cad_fornecedor_temp">
                            
       <table width="1010" align="center" border="1" class="A" cellpading="0" cellspacing="0">
            <tr border="1">
                <td border="1">
        <table align="center" width="1010" border="0" class="A" cellpading="0" cellspacing="0" >
            <tr>
            <td colspan="2" align="center"><h1><strong>CADASTRO FORNECEDORES<hr></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td width="180" align="right">Razão Social:</td>
                <td><input type="text" name="razao_social" size="70" maxlength="100" value="<?php echo $_POST[razao_social]; ?>">
                    
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Nome Fantasia:</td>
                <td><input type="text" name="nome_forn" size="70" maxlength="100" value="<?php echo $_POST[nome_forn]; ?>">
                    <?php
                        if($erro_nome_forn){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Endereço(Rua, n°, Bairro e Cep):</td>
                <td><input type="text" name="end_completo" size="100" maxlength="100" value="<?php echo $_POST[end_completo]; ?>">
                    
                </td>
            </tr>
            <tr>
                <td align="right">UF:</td>
                <td><select id="estado" name="estado">
                        <option value="<?php echo $_POST[estado]; ?>"></option>
                    </select></td>
            </tr>
            <tr>
                <td align="right">CIDADE :</td>
                <td><select id="cidade" name="cidade">
                        <option value="<?php echo $_POST[cidade]; ?>"></option>
                    </select></td>
                
            </tr>
            <tr>
                <td align="right">CNPJ:</td>
                <td><input type="text" name="cnpj" size="30" maxlength="18" onKeyDown="Mascara(this,Cnpj);" onKeyPress="Mascara(this,Cnpj);" onKeyUp="Mascara(this,Cnpj);" value="<?php echo $_POST[cnpj]; ?>">
                    
                </td>
            </tr>
            <tr>
                <td width="140" align="right">IE:</td>
                <td><input type="text" name="ie" size="30" maxlength="20" value="<?php echo $_POST[ie]; ?>">
                    
                </td>
            </tr>
            <tr>
                <td width="140" align="right">WebSite:</td>
                <td><input type="text" name="website_forn" size="30" maxlength="50" value="<?php echo $_POST[website_forn]; ?>">
                    <?php
                        if($erro_website_forn){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            
            <tr>
                <td width="140" align="right">Usuário:</td>
                <td><input type="text" name="usuario_forn" size="30" maxlength="50" value="<?php echo $_POST[usuario_forn]; ?>">
                    <?php
                        if($erro_usuario_forn){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
                        
                <td width="140" align="right">Senha:</td>
                <td><input type="text" name="senha_forn" size="50" maxlength="50" value="<?php echo $_POST[senha_forn]; ?>">
                    <?php
                        if($erro_senha_forn){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Contato Comercial:</td>
                <td><input type="text" name="contato_forn" size="50" maxlength="1000" value="<?php echo $_POST[contato_forn]; ?>">
                    <?php
                        if($erro_contato_forn){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Skype:</td>
                <td><input type="text" name="msn_forn" size="50" maxlength="1000" value="<?php echo $_POST[msn_forn]; ?>">
                    <?php
                        if($erro_msn_forn){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Email:</td>
                <td><input type="text" name="email_forn" size="50" maxlength="1000" value="<?php echo $_POST[email_forn]; ?>">
                    <?php
                        if($erro_email_forn){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                    ?>
                </td>
            </tr>
            <tr>
                <td align="right">Fone:</td>
                <td><input type="text" name="fone_forn" size="20" maxlength="50" onKeyDown="Mascara(this,Telefone);" onKeyPress="Mascara(this,Telefone);" onKeyUp="Mascara(this,Telefone);" value="<?php echo $_POST[fone_forn]; ?>">
                    <?php
                        if($erro_fone_forn){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            
            <tr>
                <td width="140" align="right">Contato RMA:</td>
                <td><input type="text" name="contato_rma" size="50" maxlength="1000" value="<?php echo $_POST[contato_rma]; ?>">
                    
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Skype:</td>
                <td><input type="text" name="skype_rma" size="50" maxlength="1000" value="<?php echo $_POST[skype_rma]; ?>">
                    
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Email:</td>
                <td><input type="text" name="email_rma" size="50" maxlength="1000" value="<?php echo $_POST[email_rma]; ?>">
                    
                </td>
            </tr>
            <tr>
                <td align="right">Fone:</td>
                <td><input type="text" name="fone_rma" size="20" maxlength="50" onKeyDown="Mascara(this,Telefone);" onKeyPress="Mascara(this,Telefone);" onKeyUp="Mascara(this,Telefone);" value="<?php echo $_POST[fone_rma]; ?>">
                    
                </td>
            </tr>
            
            <tr>
                <td width="140" align="right">Contato Financeiro:</td>
                <td><input type="text" name="contato_fin" size="50" maxlength="1000" value="<?php echo $_POST[contato_fin]; ?>">
                    
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Skype:</td>
                <td><input type="text" name="skype_fin" size="50" maxlength="1000" value="<?php echo $_POST[skype_fin]; ?>">
                    
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Email:</td>
                <td><input type="text" name="email_fin" size="50" maxlength="1000" value="<?php echo $_POST[email_fin]; ?>">
                    
                </td>
            </tr>
            <tr>
                <td align="right">Fone:</td>
                <td><input type="text" name="fone_fin" size="20" maxlength="50" onKeyDown="Mascara(this,Telefone);" onKeyPress="Mascara(this,Telefone);" onKeyUp="Mascara(this,Telefone);" value="<?php echo $_POST[fone_fin]; ?>">
                    
                </td>
            </tr>
            
            <tr>
                <td align="right">Segmento Predominante:</td>
                <td>
                    <select id="nome_forn" name="segmento_forn">
                        <?php
            
                            $nome_forn_query="SELECT nome_tipo_forn FROM tipo_fornecedor ORDER BY nome_tipo_forn ASC";
                            $nome_forn_result=mysql_query($nome_forn_query) or die ("Falha ao recuperar o NOME_FORN da base de dados: ".mysql_error());
                            echo "<option>$_POST[segmento_forn]</option>";

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
                    echo '<script language="javascript">document.cad_fornecedor.submit()</script>';
                }
            
            ?> 
           <tr>
                <td></td>
                <td colspan="1" align="left"><input type="submit" value="Cadastrar" class='botao' /></td>
                
            </tr>
        </form>  
</tr>
</table>
</table>