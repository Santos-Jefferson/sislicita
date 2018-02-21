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
/*if (empty($_POST[cod_prod_forn])){
        $erro = $erro_cod_prod_forn = true;
        }  */
        
    if (empty($_POST[tipo_prod])){
        $erro = $erro_tipo_prod = true;
        }
    
    if (empty($_POST[marca_prod])){
        $erro = $erro_marca_prod = true;
        }    
    
if (empty($_POST[desc_prod])){
        $erro = $erro_desc_prod = true;
        }
    
    
//não pode ser vazio o campo (campo obrigatório)
    if (empty($_POST[un_prod])){
        $erro = $erro_un_prod = true;
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
        
    if (empty($_POST[qtde_estoque])){
        $erro = $erro_qtde_estoque = true;
        }        
        
    if (empty($_POST[valor_custo_forn])){
        $erro = $erro_valor_custo_forn = true;
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
    <form action="<?php if ($erro or empty($_POST)) echo "cad_produto.php";
                            else echo "grava_cad_produto.php"; ?>" method="POST" name="cad_produto">
                            
       <table width="1010" align="center" border="1" class="A" cellpading="0" cellspacing="0">
            <tr border="1">
                <td border="1">
        <table align="center" width="1010" border="0" class="A" cellpading="0" cellspacing="0" >
            <tr class="forms">
            
            <th colspan="6" bgcolor="yellow" align="center"><strong>CADASTRE OS PRODUTOS AQUI</th>
            </tr>
            <tr>
                <td width="" align="right">Cód. Prod. Fornecedor:</td>
                <td colspan=""><input type="text" name="cod_prod_forn" size="20" maxlength="100" value="<?php echo $_POST[cod_prod_forn]; ?>">
                    <?php
                        if($erro_cod_prod_forn){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
                <td width="" align="right">Tipo Produto:<a href="javascript:abrir('cad_bd_tipo_prod.php?');"><img src="imagens/inserir.png" border="0"/></a></td>
                <td colspan="">
                    <select id="tipo_prod" name="tipo_prod">
                        <?php
            
                            $nome_tipo_prod_query="SELECT nome_tipo_prod FROM bd_tipo_prod ORDER BY nome_tipo_prod ASC";
                            $nome_tipo_prod_result=mysql_query($nome_tipo_prod_query) or die ("Falha ao recuperar o nome_marca da base de dados: ".mysql_error());
                            echo "<option>$_POST[tipo_prod]</option>";

                            while ($nome_tipo_prod_row=mysql_fetch_array($nome_tipo_prod_result)) {
                            $nome_tipo_prod=$nome_tipo_prod_row[nome_tipo_prod];
                                echo "<option>
                                    $nome_tipo_prod
                                </option>";
                            }
                        ?>
                    </select>
                    <?php
                     if($erro_tipo_prod){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                        ?>
                </td>
                <td width="" align="right">Marca Produto:<a href="javascript:abrir('cad_bd_marcas.php?');"><img src="imagens/inserir.png" border="0"/></a></td>
                <td colspan="">
                    <select id="marca_prod" name="marca_prod">
                        <?php
            
                            $nome_marca_query="SELECT nome_marca FROM bd_marcas ORDER BY nome_marca ASC";
                            $nome_marca_result=mysql_query($nome_marca_query) or die ("Falha ao recuperar o nome_marca da base de dados: ".mysql_error());
                            echo "<option>$_POST[marca_prod]</option>";

                            while ($nome_marca_row=mysql_fetch_array($nome_marca_result)) {
                            $nome_marca=$nome_marca_row[nome_marca];
                                echo "<option>
                                    $nome_marca
                                </option>";
                            }
                        ?>
                    </select>
                    <?php
                     if($erro_marca_prod){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                        ?>
                </td>
            </tr>
            
            <tr>
                <td width="" colspan="" align="right">Descrição do Produto:</td>
                <td colspan="5"><input type="text" name="desc_prod" size="128" maxlength="75" value="<?php echo $_POST[desc_prod]; ?>">
                    <?php
                        if($erro_desc_prod){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td align="right">Unidade:</td>
                <td>
                    <select name="un_prod" size="0" >
                        <option><?php echo $_POST[un_prod]; ?></option>
                        <option>Pc</option>
                        <option>Cx</option>
                        <option>Mt</option>
                        <option>Un</option>
                        <option>Kg</option>
                        <option>Rl</option>
                    </select>
                           
                        <?php
                            if($erro_un_prod){
                                echo "<font color=red>*** Campo obrigatório</font>";
                            }
                        ?>
                
                </td>
                <td width="" align="right">Número de Série (S/N):</td>
                <td><input type="text" name="num_serie" size="20" maxlength="100" value="<?php echo $_POST[num_serie]; ?>">
                    <?php
                        /*if($erro_num_serie){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }*/
                    ?>
                </td>
                <td width="" align="right">Part Number (P/N):</td>
                <td><input type="text" name="part_number" size="20" maxlength="100" value="<?php echo $_POST[part_number]; ?>">
                    <?php
                        if($erro_part_number){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            
            <tr>
                <td width="" align="right">Info Adic / Obs:</td>
                <td colspan="5"><input type="text" name="info_adic_prod" size="128" maxlength="2000" value="<?php echo $_POST[info_adic_prod]; ?>">
                    <?php
                        /*if($erro_info_adic_prod){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }*/
                    ?>
                </td>
            </tr>
            
            <tr>
                <td width="" align="right">Quantidade Estoque:</td>
                <td><input type="text" name="qtde_estoque" size="3" maxlength="100" value="<?php echo $_POST[qtde_estoque]; ?>">
                    <?php
                        if($erro_qtde_estoque){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
                <td width="" align="right">Valor Custo Forn. (R$):</td>
                <td colspan=""><input type="text" name="valor_custo_forn" size="10" maxlength="100" onKeyPress="return(MascaraMoeda(this,'.',',',event))" value="<?php  echo $_POST[valor_custo_forn]; ?>">
                    <?php
                        if($erro_valor_custo_forn){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                        

                    ?>
                </td>
            
            
            
            
            
            <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                    echo '<script language="javascript">document.cad_produto.submit()</script>';
                }
            
            ?> 
           

                <td colspan="1" align="right"><input type="submit" value="Cadastrar"  class='botao'/></td>
                <td></td>
                
            </tr>
        </form>  

</table>
        <?php
                require "lista_cad_produto_tudo.php";
            
            ?> 