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
        
if (empty($_POST[nome_comprador])){
        $erro = $erro_nome_comprador = true;
        }
        
if (empty($_POST[email_orgao])){
        $erro = $erro_email_orgao = true;
        }
if (empty($_POST[fone_comprador])){
        $erro = $erro_fone_comprador = true;
        }
if (empty($_POST[end_completo])){
        $erro = $erro_end_completo = true;
        }


    
    
//não pode ser vazio o campo (campo obrigatório)
    if (empty($_POST[item])){
        $erro = $erro_item = true;
        }
        
    if (empty($_POST[cnpj_orgao])){
        $erro = $erro_cnpj_orgao = true;
        }
        
    if (empty($_POST[pn_lenovo])){
        $erro = $erro_pn_lenovo = true;
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




</table><br>    
<tr>
    <th colspan="2" height="159" align="left" class="A" scope="col">
    <form action="<?php if ($erro or empty($_POST)) echo "ro_lenovo.php?id_cod=$_GET[id_cod]";
                            else echo "envia_ro_lenovo.php"; ?>" method="POST" name="ro_lenovo">
        <td><input type="hidden" name="redirect" value="cabecalho.php">
                </td>
                            
       <table width="1020" align="center" border="1" class="A" cellpading="0" cellspacing="0">
            <tr border="1">
                <td border="1">
        <table align="center" width="1010" border="0" class="A" cellpading="0" cellspacing="0" >
            <tr>
                <td colspan="2" align="center"><strong>CADASTRE AQUI SUA RO LENOVO<hr></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            
            
            <tr>
                <td width="140" align="right">CNPJ órgão:</td>
               <td><input type="text" name="cnpj_orgao" size="20" maxlength="20" onKeyDown="Mascara(this,Cnpj);" onKeyPress="Mascara(this,Cnpj);" onKeyUp="Mascara(this,Cnpj);" value="<?php echo $_POST[cnpj_orgao]; ?>">
                    <?php
                        if($erro_cnpj_orgao){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            
            <tr>
                <td width="140" align="right">NOME Comprador:</td>
                <td><input type="text" name="nome_comprador" size="40" maxlength="40" value="<?php echo $_POST[nome_comprador]; ?>">
                    <?php
                        if($erro_nome_comprador){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            
            <tr>
                <td width="140" align="right">E-MAIL do Órgão:</td>
                <td><input type="text" name="email_orgao" size="40" maxlength="40" value="<?php echo $_POST[email_orgao]; ?>">
                    <?php
                        if($erro_email_orgao){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            
            <tr>
                <td width="140" align="right">FONE do Comprador:</td>
                <td><input type="text" name="fone_comprador" size="20" maxlength="50" onKeyDown="Mascara(this,Telefone);" onKeyPress="Mascara(this,Telefone);" onKeyUp="Mascara(this,Telefone);" value="<?php echo $_POST[fone_comprador]; ?>">
                    <?php
                        if($erro_fone_comprador){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                
            </tr>
            
            <tr>
                <td width="140" align="right">ENDEREÇO com CEP:</td>
                <td><input type="text" name="end_completo" size="100" maxlength="100" value="<?php echo $_POST[end_completo]; ?>">
                    <?php
                        if($erro_end_completo){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            
            <tr>
                <td width="140" align="right">QTDE:</td>
                <td><input type="text" name="qtde" size="30" maxlength="30" value="<?php echo $_POST[qtde]; ?>">
                    <?php
                        if($erro_qtde){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            
            <tr>
                <td width="140" align="right">PN Lenovo:</td>
                <td><input type="text" name="pn_lenovo" size="100" maxlength="100" value="<?php echo $_POST[pn_lenovo]; ?>">
                    <?php
                        if($erro_pn_lenovo){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            
            <tr>
                <td align="right">TIPO Equipamento:</td>
                <td>
                    <select name="tipo_equipamento" size="0" >
                        <option><?php echo $_POST[tipo_equipamento]; ?></option>
                        <option>All in one</option>
                        <option>Desktop e Notebook</option>
                        <option>Desktop</option>
                        <option>Notebook</option>
                        <option>Servidor</option>
                        <option>Tablet</option>
                    </select>
                           
                        <?php
                            if($erro_tipo_equipamento){
                                echo "<font color=red>*** Campo obrigatório</font>";
                            }
                        ?>
                
                </td>
            </tr>
            
                <td width="140" align="right">LOTE:</td>
                <td><input type="text" name="lote" size="20" maxlength="20" value="<?php echo $_POST[lote]; ?>">
                    <?php
                        if($erro_lote){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="140" align="right">ITEM:</td>
                <td><input type="text" name="item" size="30" maxlength="30" value="<?php echo $_POST[item]; ?>">
                    <?php
                        if($erro_item){
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
                    echo '<script language="javascript">document.ro_lenovo.submit()</script>';
                }
            
            ?> 
           <tr>
                <td></td>
                <td colspan="2" align="left"><input type="submit" value="Enviar RO - LENOVO" /></td>
                
            </tr>
        </form>  
</tr>
</table>
</table>