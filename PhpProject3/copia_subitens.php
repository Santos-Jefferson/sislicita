<?php

require "cabecalho_reduzido.php";
require "conecta.php";
//print_r ($_REQUEST);

$sql = "SELECT * FROM subitens2 WHERE id_item='{$_REQUEST[id_item_novo]}'";
$res = mysql_query($sql) or die ("erro selecionar id_subitens");

//$sql2 = "SELECT * FROM itens_ne WHERE id_itens='{$_GET[id_itens]}'";
//$res2 = mysql_query($sql2) or die ("erro selecionar id_subitens2");
//$linha2 = mysql_fetch_array($res2);
if (mysql_num_rows($res)){
    require "validacao_copia_subitens.php";
    die;
}

$sql = "SELECT * from codigo,lote,itens2 WHERE codigo.id_cod=lote.id_cod and lote.id_lote=itens2.id_lote and codigo.codigo='{$_POST[num_cod_orig]}' and lote.lote='{$_POST[num_lote_orig]}' and itens2.item='{$_POST[num_item_orig]}'";
$res = mysql_query($sql) or die ("Erro selecionando subitens orig");
$linha_orig=mysql_fetch_array($res);

//print_r ($sql);
//die;

//print_r($_REQUEST); die;
//copia os campos do registro da tabela itens para itens_ne
$sql = "INSERT into subitens2 (marca_si,modelo_si,qtde_si,nome_subitem,vunitcusto_si,forn_si,ro_si,id_item)
        SELECT marca_si,modelo_si,qtde_si,nome_subitem,vunitcusto_si,forn_si,ro_si,'{$_REQUEST[id_item_novo]}' as id_item
        FROM subitens2 WHERE id_item='{$linha_orig[id_itens]}' ORDER BY id_subitem";
mysql_query($sql) or die("erro gravando subitens2");
//copia os campos do registro da tabela subitens para subitens_ne
//$sql = "INSERT into subitens_ne SELECT * FROM subitens where id_item = '$_POST[id_itens]'";
//$res = mysql_query($sql) or die("erro gravando subitens_ne");

$sql3 = "SELECT * from subitens2 order by id_subitem DESC limit 1";
$res3 = mysql_query($sql3) or die ("erro selecionar id_itens para update");
$linha = mysql_fetch_array($res3);

//$sql2 = "UPDATE subitens2 SET id_item = '{$_GET[id_ite]}' WHERE id_item = '{$linha[id_item]}' and id_itens_ne = '{$linha[id_itens_ne]}'";      
//mysql_query($sql2) or die("erro gravando itens_ne_2");



?>
    <tr>
        <td colspan="2" align="left" bgcolor="#FFFF00" class="A" scope="col">
            OK, subitens copiados com exito!
            <input type='button' value='VOLTAR'
               onclick='document.location.href="lista_licita_tudo.php?codigo=<?php echo $_REQUEST[codigo] ?>"'>
            <!--<input type='button' value='Listar Notas de Empenho'
               onclick='document.location.href="lista_licita_tudo.php?codigo=<?php //echo $_REQUEST[codigo] ?>"'>
            <input type='button' value='Listagem Geral'
               onclick='document.location.href="lista_licita_tudo.php"'>-->
        </td>
        
            
    </tr>
