<?php
require ("cabecalho_geral.php");
require ("conecta.php");
require ("js_formata_data.php");
//require ("corpo_menu.php");
//exibir a tabela com os pré-cadastros feitos.
//require ("pesquisa_licita.php");
//print_r($_POST);die;
if (!empty($_GET[novo])){
    $sql = "SELECT * FROM cad_certidoes order by id_cad_certidoes DESC LIMIT 1";
    $res = mysql_query($sql) or die("Erro seleção - linha cad certidoes altera");
//pega a primeira linha do resultado
    $linha = mysql_fetch_assoc($res);
    
}
$sql2 = "SELECT * FROM cad_certidoes WHERE id_cad_certidoes={$_GET[alterar]}";
//executa a query
$res2 = mysql_query($sql2) or die("Erro selecionando (altera_cad_certidoes.php)");
//desmonta o resutaldo e coloca os elementos do registro na linha
$linha2 = mysql_fetch_assoc($res2);
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
    <form action="grava_cad_certidoes.php" method="POST" name="altera_cad_certidoes">
                            
                            
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
                                        echo $linha2[tipo_emissao];
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
                                        echo $linha2[nome_cert];
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
                        <option>Certidão Simpp. Junta</option>
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
                <td colspan=""><input type="text" size="7" maxlength="10" name="data_venc"  OnKeyUp="mascaradata_venc(this);" maxlength="10" value="<?php if ($linha){
                                echo date('d/m/Y',strtotime($linha[data_venc]));
                        
                                }
                                    else{
                                        echo date('d/m/Y',strtotime($linha2[data_venc]));;
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
                                        echo $linha2[prazo_val];
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
                                        echo $linha2[link_emissao];
                                    }
                             ?>">
                    <?php
                        if($erro_link_emissao){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
                <input type="hidden" name="id_cad_certidoes" size="3" maxlength="3" value="<?php echo $linha2[id_cad_certidoes]?>">
                <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                    echo '<script language="javascript">document.altera_cad_certidoes.submit()</script>';
                }
            
            ?> 
                <td colspan="2" align="center"><input type="submit" value="Alterar"  class='botao'/></td>
                
            </tr>
            
        </form>  

</table>
        <?php
                //require_once "lista_cad_certidoes.php";
            ?> 