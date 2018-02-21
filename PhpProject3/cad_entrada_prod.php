<?php
//require ("cabecalho_reduzido.php");
//require ("cabecalho_lote.php");
require ("cabecalho_geral.php");
require ("conecta.php");
//require ("corpo_menu.php");
//exibir a tabela com os pré-cadastros feitos.
//require ("pesquisa_licita.php");
//print_r($_POST);die;
//======================VALIDAÇÃO E CONVERSÃO DE DADOS=====================
//validação só funcionará quando não for a primeira vez que entra-se no formulario
//!empty (se não for vazio, faça os testes abaixo)
if (!empty($_POST)){

//-------------CAMPO codigo-------------------------
if (empty($_POST[forn_prod_ent])){
        $erro = $erro_forn_prod_ent = true;
        }  
        
    if (empty($_POST[prod_ent])){
        $erro = $erro_prod_ent = true;
        }
    
    if (empty($_POST[tipo_mov])){
        $erro = $erro_tipo_mov = true;
        }    
    
/*if (empty($_POST[num_doc])){
        $erro = $erro_num_doc = true;
        }*/
    
    
//não pode ser vazio o campo (campo obrigatório)
    if (empty($_POST[qtde_ent])){
        $erro = $erro_qtde_ent = true;
        }
    
//-------------CAMPO orgão-------------------------

//não pode ser vazio o campo (campo obrigatório)
    /*if (empty($_POST[num_serie])){
        $erro = $erro_num_serie = true;
        }*/
        
        
    if (empty($_POST[valor_forn_ent])){
        $erro = $erro_valor_forn_ent = true;
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
    <form action="<?php if ($erro or empty($_POST)) echo "cad_entrada_prod.php";
                            else echo "grava_cad_entrada_prod.php"; ?>" method="POST" name="cad_entrada_prod">
                            
       <table width="1010" align="center" border="1" class="A" cellpading="0" cellspacing="0">
            <tr border="1">
                <td border="1">
        <table align="center" width="1000" border="0" class="A" cellpading="0" cellspacing="0" >
            <tr class="forms">
            
            <th colspan="9" bgcolor="red" align="center"><strong>ENTRADA DE PRODUTOS NO ESTOQUE AQUI</th>
            </tr>
            <tr>
                <td colspan="2"width="100" align="right">[Forn:<a href="javascript:abrir('cad_fornecedor.php?');"><img src="imagens/inserir.png" border="0"/></a>][Transp:<a href="javascript:abrir('cad_transportadora.php?');"><img src="imagens/inserir.png" border="0"/></a>][Assist:<a href="javascript:abrir('cad_assistencias.php?');"><img src="imagens/inserir.png" border="0"/></a>][Cliente:<a href="javascript:abrir('cad_clientes.php?');"><img src="imagens/inserir.png" border="0"/></a>]</td>
                <td colspan="8">
                    <select id="forn_prod_ent" name="forn_prod_ent">
                        <?php
            
                            $sql="SELECT nome_forn FROM cad_fornecedor ORDER BY nome_forn ASC";
                            $sql2="SELECT nome_assist FROM cad_assistencias ORDER BY nome_assist ASC";
                            $sql3="SELECT nome_trans FROM cad_transportadora ORDER BY nome_trans ASC";
                            $res=mysql_query($sql) or die ("Falha ao recuperar o nome_marca da base de dados: ".mysql_error());
                            $res2=mysql_query($sql2) or die ("Falha ao recuperar o nome_marca da base de dados: ".mysql_error());
                            $res3=mysql_query($sql3) or die ("Falha ao recuperar o nome_marca da base de dados: ".mysql_error());
                            echo "<option>$_POST[forn_prod_ent]</option>";
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
                        ?>
                    </select>
                    <?php
                     if($erro_forn_prod_ent){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                        ?>
                </td>
            </tr>
            <tr>
                
                <td width="" align="right">Produto:<a href="javascript:abrir('cad_produto.php?');"><img src="imagens/inserir.png" border="0"/></a></td>
                <td width=""colspan="8">
                    <select id="prod_ent" name="prod_ent">
                        <?php
            
                            $sql_prod="SELECT * FROM cad_produto ORDER BY tipo_prod ASC";
                            $sql_prod_res=mysql_query($sql_prod) or die ("Falha ao recuperar o PRODUTO da base de dados: ".mysql_error());
                            //$linha_sql_b=  mysql_fetch_array($sql_prod_res);
                            echo "<option>$_POST[prod_ent]</option>";
                            

                            while ($sql_prod_row=mysql_fetch_array($sql_prod_res)) {
                                $prod_baixa=$sql_prod_row[tipo_prod]." "."|"." ".$sql_prod_row[marca_prod]." "."|"." ".$sql_prod_row[desc_prod]." "."|"." ".$sql_prod_row[part_number]." "."|"." "."Qtde"." "."="." ".$sql_prod_row[qtde_estoque]." "."|"." "."id"." ".$sql_prod_row[id_cad_prod];
                                echo "<option>$prod_baixa</option>";
                                $id_cad_prod = substr("$_POST[prod_ent]",-3);
                                
                            }
                            
                            
                        ?>
                    </select>
                    <?php
                     if($erro_prod_ent){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                        ?>
                </td>
            </tr>
            <tr>
                
                
                <td align="right">Tipo Movimento:</td>
                <td>
                    <select name="tipo_mov" size="0" >
                        <option><?php echo $_POST[tipo_mov]; ?></option>
                        <option>Compra - Entrada</option>
                        <option>Retorno Garantia - Entrada</option>
                        <option>Extravio - Saída</option>
                        <option>Remessa Garantia - Saída</option>
                        <option>Venda - Saída</option>
                        
                        
                        
                    </select>
                           
                        <?php
                            if($erro_tipo_mov){
                                echo "<font color=red>*** Campo obrigatório</font>";
                            }
                        ?>
                
                </td>
                <td align="right">Data:</td>
                <td><input type="text" name="data_entrada" size="8" maxlength="8" value="<?php echo date('d/m/Y'); ?>" disabled>
                    
                </td>
                
                <td width="" align="right">Núm. Danfe/Doc:</td>
                <td colspan="4"><input type="text" name="num_doc" size="20" maxlength="100" value="<?php echo $_POST[num_doc]; ?>">
                    <?php
                        if($erro_cod_num_doc){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
                
            </tr>
            <tr>
                <td width="" align="right">Quantidade:</td>
                <td><input type="text" name="qtde_ent" size="3" maxlength="100" value="<?php echo $_POST[qtde_ent]; ?>">
                    <?php
                        if($erro_qtde_ent){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
                <td width="" align="right">Valor Custo Forn. (R$):</td>
                <td colspan=""><input type="text" name="valor_forn_ent" size="10" maxlength="100" onKeyPress="return(MascaraMoeda(this,'.',',',event))" value="<?php  echo $_POST[valor_forn_ent]; ?>">
                    <?php
                        if($erro_valor_valor_forn_ent){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                        

                    ?>
                </td>
                <td><input type="hidden" name="data_entrada" value="<?php echo date('Y-m-d'); ?>">
                </td>
                <td><input type="hidden" name="id_cad_prod" value="<?php echo $id_cad_prod; ?>">
                </td>
                
            
            
            
            
            <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                    echo '<script language="javascript">document.cad_entrada_prod.submit()</script>';
                }
            
            ?> 
           

                <td colspan="3" align=""><input type="submit" value="Cadastrar" class='botao' /></td>
                
                
                
            </tr>
            
            
        </form>  

</table>
        <?php
                require "lista_cad_entrada_prod_tudo.php";
            
            ?> 