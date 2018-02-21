<?php
require "conecta.php";
require_once "cabecalho_reduzido.php";
require_once "cabecalho_lote.php";
require "js_cad_alt_forn.php";
//print_r ($_GET);
//print_r ($_REQUEST);
//seleciona a linha q marquei no radio
$sql = "SELECT * FROM cad_produto WHERE id_cad_prod={$_GET[alterar]}";
//executa a query
$res = mysql_query($sql) or die("Erro selecionando (altera_prod.php)");
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



<tr>
        <th colspan="2" height="159" align="left" class="A" scope="col">
        <form action="grava_cad_produto.php" method="POST" name="altera_prod">
    <!--<form action="<?php //if ($erro or empty($_POST)) echo "altera_precad.php";
                            //else echo "grava_precad.php"; ?>" method="POST" name="altera_precad">-->
                            <br>
       <table align="center" border="1" width="1010" class="A" cellpading="0" cellspacing="0">
            <tr border="1">
                <td border="1">
        <table align="center" width="1000" border="0" class="A" cellpading="0" cellspacing="0" >
            <tr>
                <td colspan="6" align="center"><strong>CADASTRE AQUI OS PRODUTOS<hr></td>
            </tr>
            <tr>
                <td width="" align="right">Código Fornecedor:</td>
                <td colspan=""><input type="text" name="cod_prod_forn" size="20" maxlength="100" value="<?php echo $linha[cod_prod_forn]; ?>">
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
                            echo "<option>$linha[tipo_prod]</option>";

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
                            echo "<option>$linha[marca_prod]</option>";

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
                <td colspan="5"><input type="text" name="desc_prod" size="133" maxlength="500" value="<?php echo $linha[desc_prod]; ?>">
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
                        <option><?php echo $linha[un_prod]; ?></option>
                        <option>Un</option>
                        <option>Cx</option>
                        <option>Mt</option>
                        <option>Pc</option>
                        <option>Kg</option>
                    </select>
                           
                        <?php
                            if($erro_un_prod){
                                echo "<font color=red>*** Campo obrigatório</font>";
                            }
                        ?>
                
                </td>
                <td width="" align="right">Número de Série (S/N):</td>
                <td><input type="text" name="num_serie" size="20" maxlength="100" value="<?php echo $linha[num_serie]; ?>">
                    <?php
                        if($erro_num_serie){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
                <td width="" align="right">Part Number (P/N):</td>
                <td><input type="text" name="part_number" size="20" maxlength="100" value="<?php echo $linha[part_number]; ?>">
                    <?php
                        if($erro_part_number){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            
            <tr>
                <td width="" align="right">Info Adic / Obs:</td>
                <td colspan="5"><input type="text" name="info_adic_prod" size="133" maxlength="2000" value="<?php echo $linha[info_adic_prod]; ?>">
                    <?php
                        if($erro_info_adic_prod){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            
            <tr>
                <td width="" align="right">Quantidade Estoque:</td>
                <td><input type="text" name="qtde_estoque" size="3" maxlength="100" value="<?php echo $linha[qtde_estoque]; ?>">
                    <?php
                        if($erro_qtde_estoque){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
                <td width="" align="right">Valor Custo Forn. (R$):</td>
                <td colspan=""><input type="text" name="valor_custo_forn" size="10" maxlength="100" onKeyPress="return(MascaraMoeda(this,'.',',',event))" value="<?php  echo str_replace('.',',',$linha[valor_custo_forn]); ?>">
                    <?php
                        if($erro_valor_custo_forn){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                        

                    ?>
                </td>
            
            
            <input type="hidden" name="id_cad_prod" size="3" maxlength="3" value="<?php echo $linha[id_cad_prod]?>">
            
            <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                    echo '<script language="javascript">document.altera_forn.submit()</script>';
                }
            
            ?>
            
                  <td colspan="1" align="right"><input type="submit" value="Alterar" /></td>
                <td></td>
                
            </tr>
        </form>  
</tr>
  


  <?php
                require "lista_cad_produto_tudo.php";
            
            ?> 
