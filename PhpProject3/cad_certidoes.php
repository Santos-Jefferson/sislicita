<?php
//require ("cabecalho_reduzido.php");
//require ("cabecalho_lote.php");
require "cabecalho_geral.php";
//require ("menu_financeiro.php");
require ("conecta.php");
require ("js_formata_data.php");
//require ("corpo_menu.php");
//exibir a tabela com os pré-cadastros feitos.
//require ("pesquisa_licita.php");
//print_r($_POST);die;
if (!empty($_GET[novo])){
    $sql = "SELECT * FROM cad_certidoes order by id_contas DESC LIMIT 1";
    $res = mysql_query($sql) or die("Erro seleção - linha cad contas o mesmo");
//pega a primeira linha do resultado
    $linha = mysql_fetch_assoc($res);
    
}
//
//
//======================VALIDAÇÃO E CONVERSÃO DE DADOS=====================
//validação só funcionará quando não for a primeira vez que entra-se no formulario
//!empty (se não for vazio, faça os testes abaixo)
if (!empty($_POST)){

//-------------CAMPO codigo-------------------------
/*if (empty($_POST[cod_prod_forn])){
        $erro = $erro_cod_prod_forn = true;
        }  */
        
    if (empty($_POST[tipo_emissao])){
        $erro = $erro_tipo_emissao = true;
        }
    
    if (empty($_POST[nome_cert])){
        $erro = $erro_nome_cert = true;
        }    
    
if (empty($_POST[data_venc])){
        $erro = $erro_data_venc = true;
        }
    
    
//não pode ser vazio o campo (campo obrigatório)
    /*if (empty($_POST[prazo_val])){
        $erro = $erro_num_doc = true;
        }
    */
        
    if (empty($_POST[link_emissao])){
        $erro = $erro_link_emissao = true;
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

<script language="JavaScript">
function abrir(URL) {
 
  var width = 600;
  var height = 170;
 
  var left = 99;
  var top = 99;
 
  window.open(URL,'janela', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');
 
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
		</script>
                


</table><br>    
<tr>
    <th colspan="2" height="159" align="left" class="A" scope="col">
    <form action="<?php if ($erro or empty($_POST)) echo "cad_certidoes.php";
                            else echo "grava_cad_certidoes.php"; ?>" method="POST" name="cad_certidoes">
                            
       <table width="1010" align="center" border="1" class="A" cellpading="0" cellspacing="0">
            <tr border="1">
                <td border="1">
        <table align="center" width="1010" border="0" class="A" cellpading="0" cellspacing="0" >
            <tr class="forms">
            
            <th colspan="12" bgcolor="" align="center"><strong>CERTIDÕES</th>
            </tr>
            <tr>
                <td width="" align="right" colspan=''>Tipo Emissão:</td>
                <td colspan=""><select name="tipo_emissao" size="0" >
                        <option>
                            <?php if ($linha){
                                echo $linha[tipo_emissao];
                        
                                }
                                    else{
                                        echo $_POST[tipo_emissao];
                                    }
                             ?>
                        </option>
                        
                        <option>Online</option>
                        <option>Presencial</option>
                        
                    </select>
                    <?php
                     if($erro_tipo_emissao){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                        ?>
                </td>
                
                <td width="" colspan="" align="right">Nome Certidão/Doc:</td>
                <td colspan=""><select name="nome_cert" size="0" >
                        <option><?php if ($linha){
                                echo $linha[nome_cert];
                        
                                }
                                    else{
                                        echo $_POST[nome_cert];
                                    }
                             ?></option>
                        <option>Alvará</option>
                        <option>Balanço Patrimonial</option>
                        <option>Cartão CNPJ</option>
                        <option>CRC Estado Bahia</option>
                        <option>CICAD PR</option>
                        <option>Certidão Estadual PR</option>
                        <option>Certidão Estadual BA</option>
                        <option>Certidão Federal e INSS</option>
                        <option>Certidão FGTS</option>
                        <option>Certidão Foro</option>
                        <option>SINTEGRA PR</option>
                        <option>Cadastro Insc. Estadual PR</option>
                        <option>Cadastro Insc. Municipal CWB</option>
                        <option>Certidão Simp. Junta</option>
                        <option>Certidão Justiça Trabalho</option>
                        <option>Certidão Municipal CWB</option>
                        <option>Certidão Negativa Falência</option>
                        <option>Certidão Reg. Contadores</option>
                        <option>Certidão SICAF</option>
                        <option>CRC SUCAF BH</option>
                        <option>CRC SUCAF BH</option>
                                                
                    </select>
                    <?php
                     if($erro_nome_cert){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                        ?>
                </td>
                
                
                <td width="" align="right">Data Venc:</td>
                <td><input type= "date" name="data_venc" value="<?php if ($linha){
                                echo date('d/m/Y',strtotime($linha[data_venc]));
                        
                                }
                                    else{
                                        echo $_POST[data_venc];
                                    }
                             ?>">
                
                    <?php
                     if($erro_data_venc){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                        ?>
                </td>
                <td width="" align="right">Prazo Validade(em dias):</td>
                <td colspan=""><select name="prazo_val" size="0" >
                            <option><?php if ($linha){
                                echo $linha[prazo_val];
                        
                                }
                                    else{
                                        echo $_POST[prazo_val];
                                    }
                             ?></option>
                            <option>30</option>
                            <option>60</option>
                            <option>90</option>
                            <option>180</option>
                            <option>360</option>
                            
                        </select>
                    <?php
                        if($erro_prazo_val){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                        ?>
                </td>
            </tr>
            <tr>
                <td width="" align="right">Link Emissão/Local:</td>
                <td colspan="5"><input type="text" name="link_emissao" size="100" maxlength="500" value="<?php if ($linha){
                                echo $linha[link_emissao];
                        
                                }
                                    else{
                                        echo $_POST[link_emissao];
                                    }
                             ?>">
                    <?php
                        if($erro_link_emissao){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
                <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                    echo '<script language="javascript">document.cad_certidoes.submit()</script>';
                }
            
            ?> 
                <td colspan="2" align="center"><input type="submit" value="Cadastrar"  class='botao'/></td>
                
            </tr>
            
        </form>  

</table>
        <?php
                require_once "lista_cad_certidoes.php";
            ?> 