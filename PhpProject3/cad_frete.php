<?php
require ("cabecalho_reduzido.php");
require ("conecta.php");
//require ("cabecalho.php");
//require ("corpo_menu.php");
//exibir a tabela com os pré-cadastros feitos.
//require ("pesquisa_licita.php");


$sql = "SELECT * FROM codigo,lote,itens WHERE itens.id_itens = {$_GET[id_itens]} and itens.id_lote=lote.id_lote and lote.id_cod=codigo.id_cod";
$res = mysql_query($sql) or die("Erro seleção - codigo,lote,itens");
$linha = mysql_fetch_assoc($res);
    



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
        
    if (empty($_POST[email_forn])){
        $erro = $erro_email_forn = true;
        }
        
    //if (empty($_POST[msn_forn])){
      //  $erro = $erro_msn_forn = true;
        //}
        
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
    <form action="<?php if ($erro or empty($_POST)) echo "cad_frete.php";
                            else echo "grava_cad_frete.php"; ?>" method="POST" name="cad_frete">
                            
       <table width="1020" align="center" border="1" class="A" cellpading="0" cellspacing="0">
            <tr border="1">
                <td border="1">
        <table align="center" width="1010" border="0" class="A" cellpading="0" cellspacing="0" >
            <tr>
                <td colspan="2" align="center"><strong>CADASTRO/CALCULO FRETE<hr></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td align="right">Modalidade do Frete:</td>
                <td>
                    <select name="modal_frete" size="0" >
                        <option><?php echo $_POST[modal_frete]; ?></option>-->
                        <option>Rodoviário</option>
                        <option>Aéreo</option>
                    </select>
                           
                        <?php
                            if($erro_modal_frete){
                                echo "<font color=red>*** Campo obrigatório</font>";
                            }
                        ?>
                </td>
            </tr>
            <tr>
                <td align="right">Tipo Equipamento:</td>
                <td>
                    <select name="tipo_equipamento" size="0" >
                        <option><?php echo $_POST[tipo_equipamento]; ?></option>-->
                        <option>Notebook</option>
                        <option>Desktop SFF</option>
                        <option>Desktop</option>
                        <option>Workstation</option>
                        <option>Monitor</option>
                        <option>Gabinete(vazio)</option>
                        <option>Servidor(torre)</option>
                        <option>Impressora (Peq.Porte)</option>
                        <option>Impressora (Meq.Porte)</option>
                        <option>Impressora (Grd.Porte)</option>
                        <option>Nobreak (0 a 1.9KVA)</option>
                        <option>Nobreak (2 a 4.9KVA)</option>
                        <option>Nobreak (5 a 10KVA)</option>
                        <option>Nobreak (Grd.Porte)</option>
                        <option>Peças (Peq.Porte)</option>
                        <option>Peças (Meq.Porte)</option>
                        <option>Peças (Grd.Porte)</option>
                        <option>TV (32,40,42 Pol.)</option>
                        
                    </select>
                           
                        <?php
                            if($erro_modal_frete){
                                echo "<font color=red>*** Campo obrigatório</font>";
                            }
                        ?>
                </td>
            </tr>
            
            <tr>
                <td width="140" align="right">UF Destino:</td>
                <td>
                    <input type="text" name="uf" size="50" maxlength="500" value="<?php echo $linha[uf]; ?>" disabled>
                </td>
            </tr>
            
                        
            <tr>
                <td width="140" align="right">Valor da Nota(R$):</td>
                <td>
                    <input type="text" name="valor_nota" size="50" maxlength="50" value="<?php echo $linha[vofertado]; ?>" disabled>
                </td>
            </tr>
            
            
            <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                    echo '<script language="javascript">document.cad_frete.submit()</script>';
                }
            
            ?> 
           <tr>
                <td></td>
                <td colspan="2" align="left"><input type="submit" value="Cadastrar" /></td>
                
            </tr>
        </form>  
</tr>
</table>
</table>
    
<?php
    require "lista_frete_tudo.php";
?>