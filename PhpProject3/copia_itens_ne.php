<?php

require "cabecalho_reduzido.php";
require "conecta.php";
        
$sql = "SELECT * FROM itens_ne WHERE id_ne='{$_GET[id_ne]}'";
$res = mysql_query($sql) or die ("erro selecionar id_itens");


if (mysql_num_rows($res)){
    require "validacao_copia_itens_ne.php";
    die;
}

//print_r($_REQUEST); die;
//copia os campos do registro da tabela itens para itens_ne
$sql = "INSERT into itens_ne (id_itens,tipo_equip,forn,item,ro_item,qtde,nome_item,marca_item,modelo_item,
            produto,vunitcusto,vofertado,id_lote)
        SELECT id_itens,tipo_equip,forn,item,ro_item,qtde,nome_item,marca_item,modelo_item,
            produto,vunitcusto,vofertado,id_lote
        FROM itens2 where id_lote ='{$_GET[id_lote]}'";
mysql_query($sql) or die("erro gravando itens_ne");
        

$sql3 = "SELECT * from itens_ne order by id_itens_ne DESC limit 1";
$res3 = mysql_query($sql3) or die ("erro selecionar id_itens para update");
$linha = mysql_fetch_array($res3);

$sql2 = "UPDATE itens_ne SET id_ne = '{$_GET[id_ne]}' WHERE id_ne = '{$linha[id_ne]}'";      

mysql_query($sql2) or die("erro gravando itens_ne_2");
//copia os campos do registro da tabela subitens para subitens_ne
//$sql = "INSERT into subitens_ne SELECT * FROM subitens where id_item = '$_POST[id_itens]'";
//$res = mysql_query($sql) or die("erro gravando subitens_ne");




?>
    <tr>
        <td colspan="2" align="left" bgcolor="#FFFF00" class="A" scope="col">
            OK, itens copiados com exito!
            <input type='button' value='VOLTAR'
               onclick='document.location.href="cad_ne.php?id_cod=<?php echo $_GET[id_cod] ?>&id_lote=<?php echo $_GET[id_lote]?>&id_itens=<?php echo $_REQUEST[id_itens];?>"'>
            <!--<input type='button' value='Listar Notas de Empenho'
               onclick='document.location.href="lista_licita_tudo.php?codigo=<?php echo $_REQUEST[codigo] ?>"'>
            <input type='button' value='Listagem Geral'
               onclick='document.location.href="lista_licita_tudo.php"'>-->
        </td>
        
            
    </tr>
