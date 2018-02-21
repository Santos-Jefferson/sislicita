<?php
//require ("cabecalho_reduzido.php");
//require ("cabecalho_lote.php");
require "cabecalho_html.php";
require "conecta.php";
include "css.php";
include "cabecalho_reduzido.php";
//print_r($_REQUEST);die;

    
$sql = "SELECT * FROM codigo,lote,itens_ne WHERE codigo.id_cod=lote.id_cod and lote.id_lote=itens_ne.id_lote and itens_ne.id_ne={$_GET[id_ne]}";
$res = mysql_query($sql) or die ("erro selecionar tudo codigo,lote,itens_ne");
$linha_cod_lote = mysql_fetch_assoc($res);

$sql = "SELECT * FROM codigo,lote,itens_ne WHERE codigo.id_cod=lote.id_cod and lote.id_lote=itens_ne.id_lote and itens_ne.id_ne={$_GET[id_ne]}";
$res = mysql_query($sql) or die ("erro selecionar tudo codigo,lote,itens_ne");
$linha_cod_lote = mysql_fetch_assoc($res);

include "js_cad_alt_itens.php";
?>

<br>
<table align="center" class="A" border="0" width="1010">
<table align="center" class="A" width="1010" border="1" cellpadding="3" cellspacing="0">
    
       
    <tr>
        <td class="forms" colspan="10" bgcolor="LemonChiffon" align="center"><strong>LISTAGEM LICITAÇÃO N°<a href="lista_licita_tudo.php?codigo=<?php echo $linha_cod_lote[codigo];?>"><?php echo $linha_cod_lote[codigo] ?></a> e LOTE/GRUPO N° <?php echo $linha_cod_lote[lote] ?></td>
    </tr>
    
  <tr>
    <th width="" >TIPO</th>
    <!--<th width="" scope="col">CÓDIGO</th>-->
    <th width="" >PREGÃO</th>  
    <th width="" >ÓRGÃO</th>
    <!--<th width="" scope="col">DATA/HORA</th>-->
    <!--<th width="" scope="col">LOTE/GRUPO</th>-->
    <th width="" scope="col">LICITANTE</th>
    <!--<th >AÇÃO</th>-->
    <th >STATUS LOTE</th>
    <th >NÚM NE</th>
    
  </tr>
  <tr>
    <td align="center"><?php echo $linha_cod_lote[tipo_licitacao] ?></td>
    <!--<td align="center"><?php //echo $linha_cod_lote[codigo] ?></td>-->
    <td align="center"><?php echo $linha_cod_lote[pregao] ?></td>
    <td align="center"><?php echo $linha_cod_lote[orgao] ?></td>
    
    
    <td align="center"><?php echo $linha_cod_lote[licitante] ?></td>
    
    <td class="" align="center"><?php echo $linha_cod_lote[colocacao] ?></td>
    <td class="" align="center"><a href="cad_ne.php?id_itens=<?php echo $linha_cod_lote[id_itens];?>&id_lote=<?php echo $linha_cod_lote[id_lote]; ?>&id_cod=<?php echo $linha_cod_lote[id_cod]; ?>"><?php echo $_GET[num_ne] ?></td></a>
    
  </tr>
  
  </table><br>


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

<form action="<?php if ($erro or empty($_POST)) echo "cad_itens_ne_baixa.php?id_ne=$_GET[id_ne]";
                            else echo "grava_itens_ne_baixa.php"; ?>" method="POST" name="cad_itens_ne_baixa">
                   <br>
<table align="center" border="1" width="1010" class="A" cellpading="0" cellspacing="0">
            <tr border="1">
                <td border="1">
        <table align="center" width="1000" border="0" class="A" cellpading="0" cellspacing="0" >
            
            <tr>
                <td class="forms" colspan="5" bgcolor="LemonChiffon" align="center"><strong>BAIXA NO ESTOQUE - PRODUTOS</td>
            </tr>
            
            <tr>
                
                <td width="30" align="right">Qtde:</td>
                <td width="40"><input type="text" name="qtde_baixa" size="3" maxlength="10" value="<?php echo $_POST[qtde_baixa]; ?>">
                </td>
                    
                <td width="20" align="right">Produto:<a href="javascript:abrir('cad_produto.php?');"><img src="imagens/inserir.png" border="0"/></a></td>
                <td colspan="">
                    <select id="desc_prod_baixa" name="desc_prod_baixa">
                        <?php
            
                            $sql_prod="SELECT * FROM cad_produto ORDER BY tipo_prod ASC";
                            $sql_prod_res=mysql_query($sql_prod) or die ("Falha ao recuperar o PRODUTO da base de dados: ".mysql_error());
                            //$linha_sql_b=  mysql_fetch_array($sql_prod_res);
                            echo "<option>$_POST[desc_prod_baixa]</option>";
                            

                            while ($sql_prod_row=mysql_fetch_array($sql_prod_res)) {
                            $prod_baixa=$sql_prod_row[tipo_prod]." "."|"." ".$sql_prod_row[marca_prod]." "."|"." ".$sql_prod_row[desc_prod]." "."|"." ".$sql_prod_row[part_number]." "."|"." "."Qtde"." "."="." ".$sql_prod_row[qtde_estoque]." "."|"." "."R$"." ".str_replace('.',',',$sql_prod_row[valor_custo_forn])." "."|"." "."id"." ".$sql_prod_row[id_cad_prod];
                            echo "<option>$prod_baixa</option>";
                            $id_cad_prod = substr("$_POST[desc_prod_baixa]",-3);
                            }
                            
                        ?>
                    </select>
                    <?php
                     /*if($erro_prod_baixa){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }*/
                        ?>
                </td>
                <td colspan="" align="right"><input type="submit" value="Baixar" /></td>
                
                
            <!--<td width="" align="right">Valor Custo (R$):</td>
                <td colspan=""><input type="text" name="valor_custo_prod" size="7" maxlength="100" onKeyPress="return(MascaraMoeda(this,'.',',',event))" value="<?php  //echo $_POST[valor_custo_prod]; ?>">
                    
                </td>-->
                            
           <tr>
                
                <td colspan="2"><input type="hidden" name="id_ne" value="<?php echo $_GET[id_ne]; ?>">
                </td>
                <td colspan="2"><input type="hidden" name="num_ne" value="<?php echo $_REQUEST[num_ne]; ?>">
                </td>
                <td colspan="2"><input type="hidden" name="id_itens_ne" value="<?php echo $_REQUEST[id_itens_ne]; ?>">
                </td>
                <td colspan="3"><input type="hidden" name="id_cad_prod" value="<?php echo $id_cad_prod; ?>">
                </td>
                
                
                
            </tr>
            <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                  echo '<script language="javascript">document.cad_itens_ne_baixa.submit()</script>';
                }
            ?>
            
        </form>  
</table>
<?php
//print_r ($_REQUEST);
require "lista_itens_ne_baixa_tudo.php";
?>