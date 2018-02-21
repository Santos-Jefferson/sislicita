<?php
require "conecta.php";
require_once "cabecalho_reduzido.php";
require_once "cabecalho_lote.php";
require "js_cad_alt_forn.php";
//print_r ($_GET);
//print_r ($_REQUEST);
//seleciona a linha q marquei no radio
$sql = "SELECT * FROM cad_produto_entrada WHERE id_cad_prod_ent={$_GET[alterar]}";
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


</table><br>    
<tr>
    <th colspan="2" height="159" align="left" class="A" scope="col">
    <form action="grava_cad_entrada_prod.php" method="POST" name="altera_prod_entrada">
    <!--<form action="<?php //if ($erro or empty($_POST)) echo "altera_prod_entrada.php";
                            //else echo "grava_cad_entrada_prod.php"; ?>" method="POST" name="altera_prod_entrada">-->
                            
       <table width="1010" align="center" border="1" class="A" cellpading="0" cellspacing="0">
            <tr border="1">
                <td border="1">
        <table align="center" width="1000" border="0" class="A" cellpading="0" cellspacing="0" >
            <tr class="forms">
            
            <th colspan="6" align="center"><strong>ALTERA ENTRADA/SAÍDA DE PRODUTOS NO ESTOQUE</th>
            </tr>
            <tr>
                <td width="" align="right">Fornecedor:<a href="javascript:abrir('cad_fornecedor.php?');"><img src="imagens/inserir.png" border="0"/></a></td>
                <td colspan="5">
                    <select id="forn_prod_ent" name="forn_prod_ent">
                        <?php
            
                            $sql="SELECT nome_forn FROM cad_fornecedor ORDER BY nome_forn ASC";
                            $res=mysql_query($sql) or die ("Falha ao recuperar o nome_marca da base de dados: ".mysql_error());
                            echo "<option>$linha[forn_prod_ent]</option>";
                            while($forn_entrada_row=mysql_fetch_array($res)){
                            $forn_entrada=$forn_entrada_row[nome_forn];
                                echo "<option>
                                    $forn_entrada
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
                <td colspan="10">
                    <select id="prod_ent" name="prod_ent">
                        <?php
            
                            $sql_prod="SELECT * FROM cad_produto ORDER BY desc_prod ASC";
                            $sql_prod_res=mysql_query($sql_prod) or die ("Falha ao recuperar o PRODUTO da base de dados: ".mysql_error());
                            //$linha_sql_b=  mysql_fetch_array($sql_prod_res);
                            echo "<option>$linha[prod_ent]</option>";
                            

                            while ($sql_prod_row=mysql_fetch_array($sql_prod_res)) {
                                $prod_baixa=$sql_prod_row[tipo_prod]." "."|"." ".$sql_prod_row[marca_prod]." "."|"." ".$sql_prod_row[desc_prod]." "."|"." ".$sql_prod_row[part_number]." "."|"." "."Qtde"." "."="." ".$sql_prod_row[qtde_estoque]." "."|"." "."forn"." ".$sql_prod_row[cod_prod_forn]." "."|"." "."id"." ".$sql_prod_row[id_cad_prod];
                                echo "<option>$prod_baixa</option>";
                                $id_cad_prod = substr("$linha[prod_ent]",-3);
                                
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
                        <option><?php echo $linha[tipo_mov]; ?></option>
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
                <td colspan=""><input type="text" name="num_doc" size="20" maxlength="100" value="<?php echo $linha[num_doc]; ?>">
                    <?php
                        if($erro_cod_num_doc){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
                
            </tr>
            <tr>
                <td width="" align="right">Quantidade:</td>
                <td><input type="text" name="qtde_ent" size="3" maxlength="100" value="<?php echo $linha[qtde_ent]; ?>">
                    <?php
                        if($erro_qtde_ent){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
                <td width="" align="right">Valor Custo Forn. (R$):</td>
                <td colspan=""><input type="text" name="valor_forn_ent" size="10" maxlength="100" onKeyPress="return(MascaraMoeda(this,'.',',',event))" value="<?php  echo str_replace('.',',',$linha[valor_forn_ent]); ?>">
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
                <td><input type="hidden" name="id_cad_prod_ent" value="<?php echo $linha[id_cad_prod_ent]; ?>">
                </td>
                
            
            
            
            
            <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                    echo '<script language="javascript">document.altera_prod_entrada.submit()</script>';
                }
            
            ?> 
           

                <td colspan="1" align=""><input type="submit" value="Cadastrar" /></td>
                <td></td>
                
                
            </tr>
            
            
        </form>  

</table>
        <?php
                require "lista_cad_entrada_prod_tudo.php";
            
            ?> 