<?php

require "cabecalho_reduzido.php";
require "conecta.php";

$sql = "SELECT * FROM subitens_ne2 WHERE id_itens_ne='{$_GET[id_itens_ne]}'";
$res = mysql_query($sql) or die ("erro selecionar id_subitens");

//$sql2 = "SELECT * FROM itens_ne WHERE id_itens='{$_GET[id_itens]}'";
//$res2 = mysql_query($sql2) or die ("erro selecionar id_subitens2");
//$linha2 = mysql_fetch_array($res2);
if (mysql_num_rows($res)){
    require "validacao_copia_subitens_ne.php";
    die;
}

//print_r($_REQUEST); die;
//copia os campos do registro da tabela itens para itens_ne
$sql = "INSERT into subitens_ne2 (id_subitem,marca_si,modelo_si,qtde_si,nome_subitem,vunitcusto_si,
            forn_si,ro_si,id_item)
        SELECT id_subitem,marca_si,modelo_si,qtde_si,nome_subitem,vunitcusto_si,
            forn_si,ro_si,id_item
        FROM subitens2 where id_item ='{$_GET[id_itens]}'";
mysql_query($sql) or die("erro gravando subitens_ne");
//copia os campos do registro da tabela subitens para subitens_ne
//$sql = "INSERT into subitens_ne SELECT * FROM subitens where id_item = '$_POST[id_itens]'";
//$res = mysql_query($sql) or die("erro gravando subitens_ne");

$sql3 = "SELECT * from subitens_ne2 order by id_subitem_ne DESC limit 1";
$res3 = mysql_query($sql3) or die ("erro selecionar id_itens para update");
$linha = mysql_fetch_array($res3);

$sql2 = "UPDATE subitens_ne2 SET id_itens_ne = '{$_GET[id_itens_ne]}' WHERE id_item = '{$linha[id_item]}' and id_itens_ne = '{$linha[id_itens_ne]}'";      

mysql_query($sql2) or die("erro gravando itens_ne_2");



?>
    <tr>
        <td colspan="2" align="left" bgcolor="#FFFF00" class="A" scope="col">
            OK, subitens copiados com exito!
            <input type='button' value='VOLTAR'
               onclick='document.location.href="cad_ne.php?id_cod=<?php echo $_GET[id_cod] ?>&id_lote=<?php echo $_GET[id_lote]?>&id_itens=<?php echo $_REQUEST[id_itens];?>"'>
            <!--<input type='button' value='Listar Notas de Empenho'
               onclick='document.location.href="lista_licita_tudo.php?codigo=<?php echo $_REQUEST[codigo] ?>"'>
            <input type='button' value='Listagem Geral'
               onclick='document.location.href="lista_licita_tudo.php"'>-->
        </td>
        
            
    </tr>
