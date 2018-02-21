<?php
    
    require "conecta.php";
    require "cabecalho_reduzido.php";
    //require "cabecalho_lote.php";
    
    $sql_codigo = "SELECT * FROM codigo WHERE id_cod = {$_REQUEST[id_cod]}";
$res_codigo = mysql_query($sql_codigo) or die("Erro seleção linha_codigo_grava_itens");
$linha_codigo = mysql_fetch_assoc($res_codigo);

$sql_lote = "SELECT * FROM lote WHERE id_cod = {$_REQUEST[id_cod]}";
$res_lote = mysql_query($sql_lote) or die("Erro seleção linha_lote_grava_itens");
$linha_lote = mysql_fetch_assoc($res_lote);
        

        //
        //print_r($_REQUEST);
        
        
        //para cada campo do get[apaga]
        //foreach($_GET[apagar] as $v) {
            $s = "DELETE FROM itens2 WHERE id_itens={$_GET[apagar]}";    
            mysql_query($s) or die ("Erro apagando");
        
       //require "lista_precad_exc.php";
?>

    <tr>
        <td colspan="2" align="left" bgcolor="#FFFF00" class="A" scope="col">
            ITEM selecionado excluído com sucesso!
            <input type='button' value='Voltar' onclick='document.location.href="cad_itens2.php?id_cod=<?php echo $linha_lote[id_cod]; ?>&id_lote=<?php echo $_GET[id_lote]; ?>&lote=<?php echo $_REQUEST[lote]; ?>&codigo=<?php echo $linha_codigo[codigo]; ?>&licitante=<?php echo $linha_codigo[licitante]; ?>&data=<?php echo $linha_codigo[data];?>&hora=<?php echo $linha_codigo[hora]; ?>&orgao=<?php echo $linha_codigo[orgao]; ?>"'>
        </td>
    </tr>
