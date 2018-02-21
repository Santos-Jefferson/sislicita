<?php
//require ("cabecalho_reduzido.php");
//require ("cabecalho_lote.php");
require ("menu_financeiro.php");
require ("conecta.php");
require ("js_formata_data.php");
//require ("corpo_menu.php");
//exibir a tabela com os pré-cadastros feitos.
//require ("pesquisa_licita.php");
//print_r($_POST);die;
if (!empty($_GET[novo])){
    $sql = "SELECT * FROM contas_pagar_receber order by id_contas DESC LIMIT 1";
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
        
    if (empty($_POST[tipo_op_contas])){
        $erro = $erro_tipo_op_contas = true;
        }
    
    if (empty($_POST[desc_contas])){
        $erro = $erro_desc_contas = true;
        }    
    
if (empty($_POST[data_venc])){
        $erro = $erro_data_venc = true;
        }
    
    
//não pode ser vazio o campo (campo obrigatório)
    if (empty($_POST[num_doc])){
        $erro = $erro_num_doc = true;
        }
    
//-------------CAMPO orgão-------------------------

//não pode ser vazio o campo (campo obrigatório)
    /*if (empty($_POST[num_serie])){
        $erro = $erro_num_serie = true;
        }*/
        
        
   /* if (empty($_POST[part_number])){
        $erro = $erro_part_number = true;
        }
        */
    /*if (empty($_POST[info_adic_prod])){
        $erro = $erro_info_adic_prod = true;
        }*/
        
    if (empty($_POST[valor_contas])){
        $erro = $erro_valor_contas = true;
        }        
if (empty($_POST[tipo_contas])){
        $erro = $erro_tipo_contas = true;
        }        
        if (empty($_POST[cat_contas])){
        $erro = $erro_cat_contas = true;
        }        
        if (empty($_POST[cl_forn_contas])){
        $erro = $erro_cl_forn_contas = true;
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
    <form action="<?php if ($erro or empty($_POST)) echo "cad_contas_pagar_receber.php";
                            else echo "grava_cad_contas_pagar_receber.php"; ?>" method="POST" name="cad_contas_pagar_receber">
                            
       <table width="1010" align="center" border="1" class="A" cellpading="0" cellspacing="0">
            <tr border="1">
                <td border="1">
        <table align="center" width="1010" border="0" class="A" cellpading="0" cellspacing="0" >
            <tr class="forms">
            
            <th colspan="12" bgcolor="" align="center"><strong>CONTAS A PAGAR / RECEBER</th>
            </tr>
            <tr>
                <td width="" align="right" colspan=''>Operação:</td>
                <td colspan=""><select name="tipo_op_contas" size="0" >
                        <option>
                            <?php if ($linha){
                                echo $linha[tipo_op_contas];
                        
                                }
                                    else{
                                        echo $_POST[tipo_op_contas];
                                    }
                             ?>
                        </option>
                        
                        <option>A Pagar</option>
                        <option>A Receber</option>
                        
                    </select>
                    <?php
                     if($erro_tipo_op_contas){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                        ?>
                </td>
                
                <td width="" colspan="" align="right">Desc/Hist:</td>
                <td colspan=""><select name="desc_contas" size="0" >
                        <option><?php if ($linha){
                                echo $linha[desc_contas];
                        
                                }
                                    else{
                                        echo $_POST[desc_contas];
                                    }
                             ?></option>
                        <option>Aluguel Imóvel</option>
                        <option>Conta Água</option>
                        <option>Conta Luz</option>
                        <option>Conta Fone+Internet</option>
                        <option>Conta Celular</option>
                        <option>Investimentos</option>
                        <option>Pgto Fornecedor</option>
                        <option>Pgto Contadores</option>
                        <option>Pgto Gps</option>
                        <option>Pgto Fgts</option>
                        <option>Pgto DAS</option>
                        <option>Rcto Licitações</option>
                        <option>Rcto Outros</option>
                        
                    </select>
                    <?php
                     if($erro_desc_contas){
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
                <!--<td colspan=""><input type="text" size="7" maxlength="10" name="data_venc"  OnKeyUp="mascaradata_venc(this);" maxlength="10" value="<?php/* if ($linha){
                                echo date('d/m/Y',strtotime($linha[data_venc]));
                        
                                }
                                    else{
                                        echo $_POST[data_venc];
                                    }
                             */?>">-->
                    <?php
                     if($erro_data_venc){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                        ?>
                </td>
                
                <td width="" align="right">Número Doc:</td>
                <td><input type="text" name="num_doc" size="7" maxlength="20" value="<?php if ($linha){
                                echo $linha[num_doc];
                        
                                }
                                    else{
                                        echo $_POST[num_doc];
                                    }
                             ?>">
                    <?php
                        if($erro_num_doc){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
                
                <td width="" align="right">Valor(R$):</td>
                <td colspan=""><input type="text" name="valor_contas" size="7" maxlength="100" onKeyPress="return(MascaraMoeda(this,'.',',',event))" value="<?php if ($linha){
                                $linha[valor_contas]=abs($linha[valor_contas]);//transforma o valor de negativo para absoluto (sem o - na frente)
                                echo number_format($linha[valor_contas],2,",",".");
                        
                                }
                                    else{
                                        echo $_POST[valor_contas];
                                    }
                             ?>">
                    <?php
                        if($erro_valor_contas){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                        ?>
                </td>
            </tr>
            <tr>
                
                <td width="" align="right">Tipo Conta/Doc:</td>
                <td colspan=""><select name="tipo_contas" size="0" >
                            <option><?php if ($linha){
                                echo $linha[tipo_contas];
                        
                                }
                                    else{
                                        echo $_POST[tipo_contas];
                                    }
                             ?></option>
                            <option>Boleto</option>
                            <option>Cartão BNDES</option>
                            <option>Cartão Crédito</option>
                            <option>DOC</option>
                            <option>Fatura</option>
                            <option>TED</option>
                            <option>TRANSF</option>
                            
                            
                            <option>Nfe</option>
                        </select>
                    <?php
                        if($erro_tipo_contas){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                        ?>
                </td>
               <td width="" align="right">Banco:</td>
               <td>
                    <select id="banco_contas" name="banco_contas">
                        <?php
            
                            $nome_marca_query="SELECT nome_banco FROM cad_bancos ORDER BY nome_banco ASC";
                            $nome_marca_result=mysql_query($nome_marca_query) or die ("Falha ao recuperar o TIPO_PROD da base de dados: ".mysql_error());
                            echo "<option>$_POST[banco_contas]</option>";

                            while ($nome_marca_row=mysql_fetch_array($nome_marca_result)) {
                            $nome_marca=$nome_marca_row[nome_banco];
                                echo "<option>
                                    $nome_marca
                                </option>";
                            }
                        ?>
                    </select>
            
            </td>
                
                 <td width="" colspan="" align="right">Categ. Conta:</td>
                <td colspan="4"><select name="cat_contas" size="0" >
                        <option><?php if ($linha){
                                echo $linha[cat_contas];
                        
                                }
                                    else{
                                        echo $_POST[cat_contas];
                                    }
                             ?></option>
                        <option>Alimentação (Supermercado, Refeições)</option>
                        <option>Assistências Técnicas</option>
                        <option>Automóveis (Combustível, Pedágio, Estac)</option>
                        <option>Bancos (Taxas, Juros)</option>
                        <option>Folha de Pgto (Salários, Comissões, Bonus, FGTS, GPS)</option>
                        <option>Fretes (Transportadora, Correios)</option>
                        <option>Imóvel (Luz, Água, Fone, Internet, Vigilância, Limpeza)</option>
                        <option>Impostos (Simples Nacional - DAS)</option>
                        <option>Investimentos (Terrenos, Finan Imóveis)</option>
                        <option>Material de Escritório(Toner, Papel)</option>
                        <option>Pgto Empréstimos(Giro e outros)</option>
                        <option>Pgto Fornecedores(Produtos e Serviços)</option>
                        <option>Rcto Clientes(Licitações)</option>
                        <option>Rcto Clientes(Outros)</option>
                        <option>Previdência Privada)</option>
                        <option>Taxas Licitações (Bll, BB, Cid. Compras, Cartório, Correios)</option>
                        <option>Viagens</option>
                        
                    </select>
                    <?php
                        if($erro_cat_contas){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                        ?>
                </td>
            </tr>
            <tr>
                
                 <td colspan="2"width="100" align="right">[Forn:<a href="javascript:abrir('cad_fornecedor.php?');"><img src="imagens/inserir.png" border="0"/></a>][Transp:<a href="javascript:abrir('cad_transportadora.php?');"><img src="imagens/inserir.png" border="0"/></a>][Assist:<a href="javascript:abrir('cad_assistencias.php?');"><img src="imagens/inserir.png" border="0"/></a>][Cliente:<a href="javascript:abrir('cad_clientes.php?');"><img src="imagens/inserir.png" border="0"/></a>]</td>
                <td colspan="4">
                    <select id="forn_prod_ent" name="cl_forn_contas">
                        <?php
                            if ($linha){
                        
            
                            echo "<option>$linha[cl_forn_contas]</option>";
                            }
                            else{
                                   $sql="SELECT nome_forn FROM cad_fornecedor ORDER BY nome_forn ASC";
                                    $sql2="SELECT nome_assist FROM cad_assistencias ORDER BY nome_assist ASC";
                                    $sql3="SELECT nome_trans FROM cad_transportadora ORDER BY nome_trans ASC";
                                    $res=mysql_query($sql) or die ("Falha ao recuperar o nome_marca da base de dados: ".mysql_error());
                                    $res2=mysql_query($sql2) or die ("Falha ao recuperar o nome_marca da base de dados: ".mysql_error());
                                    $res3=mysql_query($sql3) or die ("Falha ao recuperar o nome_marca da base de dados: ".mysql_error());
                                    echo "<option>$_POST[cl_forn_contas]</option>";
                                    while($forn_entrada_row=mysql_fetch_array($res)){
                                    $forn_entrada=$forn_entrada_row[nome_forn];
                                        echo "<option>
                                            $forn_entrada
                                        </option>";
                                    }
                                    while($forn_entrada_row=mysql_fetch_array($res2)){
                                    $forn_entrada2=$forn_entrada_row[nome_assist];
                                        echo "<option>
                                            $forn_entrada2
                                        </option>";
                                    }
                                    while($forn_entrada_row=mysql_fetch_array($res3)){
                                    $forn_entrada3=$forn_entrada_row[nome_trans];
                                        echo "<option>
                                            $forn_entrada3
                                        </option>";
                            }
                            }
                        ?>
                    </select>
                    <?php
                     if($erro_cl_forn_contas){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                        ?>
                </td>
                
            <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                    echo '<script language="javascript">document.cad_contas_pagar_receber.submit()</script>';
                }
            
            ?> 
                <td colspan="" align="left"><input type="submit" value="Cadastrar"  class='botao'/></td>
                
            </tr>
        </form>  

</table>
        <?php
                require_once "lista_cad_contas_pagar_receber.php";
            
            ?> 