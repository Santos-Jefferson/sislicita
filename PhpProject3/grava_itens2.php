<?php

require "cabecalho_reduzido.php";
require "conecta.php";
//print_r ($_REQUEST);
//die;


$sql_codigo = "SELECT * FROM codigo WHERE id_cod = {$_REQUEST[id_cod]}";
$res_codigo = mysql_query($sql_codigo) or die("Erro seleção linha_codigo_grava_itens");
$linha_codigo = mysql_fetch_assoc($res_codigo);

$sql_lote = "SELECT * FROM lote WHERE id_cod = {$_REQUEST[id_cod]}";
$res_lote = mysql_query($sql_lote) or die("Erro seleção linha_lote_grava_itens");
$linha_lote = mysql_fetch_assoc($res_lote);


//print_r ($_REQUEST);
//die;
// comando para testar variáveis que vem do formulário
//print_r($_POST[id_cadastro]);die;
/*echo $sql = "UPDATE cadastro SET licitante='{$_POST[licitante]}',
            data_hora='{$_POST[data_hora]}', codigo='{$_POST[codigo]}',
            lote='{$_POST[lote]}',item='{$_POST[item]}',qtde='{$_POST[qtde]}',
            produto='{$_POST[produto]}',valor_unit_custo='{$_POST[valor_unit_custo]}',
            forn='{$_POST[forn]}',valor_frete='{$_POST[valor_frete]}',
            porcentagem_lucro='{$_POST[porcentagem_lucro]}' WHERE id_cadastro='{$_POST[id_cadastro]}'
            }";*/

//se é um alterar cadastro, utiliza a instrução UPDATE, se for cadastro novo, INSERT.
        //isset = existe ou não existe (se existe post[cod], então faz update. se não existe, faz cadastro novo
$sql = "SELECT * FROM itens2 WHERE item = {$_POST[item]} and id_lote = {$_POST[id_lote]}";
$res = mysql_query($sql) or die("Erro seleção");

if (mysql_num_rows($res) and !isset($_POST[id_itens])){
    
    require_once "validacao_cad_itens.php";
    die;
   
 }
    elseif(isset($_POST[id_itens])){
        $sql =
        "UPDATE itens2 SET tipo_equip='{$_POST[tipo_equip]}',
            forn='{$_POST[forn]}',item='{$_POST[item]}',
            ro_item='{$_POST[ro_item]}',qtde='{$_POST[qtde]}',
            nome_item='{$_POST[nome_item]}',marca_item='{$_POST[marca_item]}',
            modelo_item='{$_POST[modelo_item]}',
            vunitcusto='{$_POST[vunitcusto]}',vofertado='{$_POST[vofertado]}'
                WHERE id_itens='{$_POST[id_itens]}'";
            
    //volta para a seleção e alteração
    //$lugar= ('cad_itens.php'
            //p?id_lote=echo $_POST[id_lote];
              //  &lote=echo $_POST[lote];
                //&codigo=echo $_POST[codigo];
           //     );
}
    else {
    $sql = "INSERT into itens2 (tipo_equip,forn,item,ro_item,qtde,nome_item,marca_item,modelo_item,vunitcusto,vofertado,id_lote)
                       VALUES ( '{$_POST[tipo_equip]}','{$_POST[forn]}',
                                '{$_POST[item]}','{$_POST[ro_item]}',
                                '{$_POST[qtde]}','{$_POST[nome_item]}',
                                '{$_POST[marca_item]}','{$_POST[modelo_item]}',
                                '{$_POST[vunitcusto]}','{$_POST[vofertado]}',
                                '{$_POST[id_lote]}'
                               )";
                                
                                
    $lugar=('lista_itens_tudo.php');
    }

//echo $sql;die;
mysql_query($sql) or die("Erro gravando - altera itens2!!!");

?>
    <tr>
        <td colspan="2" align="left" bgcolor="#FFFF00" class="A" scope="col">
            <?php
                if (isset($_POST[id_itens])){
                    echo "OK, ITEM alterado com sucesso!";
                }   
                elseif (!isset($_POST[id_itens])){
                    echo "OK, ITEM adicionado com sucesso!";
                }
                ?>
            <!--<input type='button' value='Voltar'
               onclick='document.location.href="cad_itens.php?id_lote=<?php echo $_POST[id_lote]; ?>&lote=<?php echo $_POST[lote]; ?>&codigo=<?php echo $_POST[codigo]; ?>"'>-->
            <input type='button' value='Listar Licitações'
               onclick='document.location.href="lista_licita_tudo.php"'>
            <input type='button' value='Novo - Itens'
               onclick='document.location.href="cad_itens2.php?id_cod=<?php echo $linha_lote[id_cod]; ?>&id_lote=<?php echo $_POST[id_lote]; ?>&lote=<?php echo $_REQUEST[lote]; ?>&codigo=<?php echo $linha_codigo[codigo]; ?>&licitante=<?php echo $linha_codigo[licitante]; ?>&data=<?php echo $linha_codigo[data];?>&hora=<?php echo $linha_codigo[hora]; ?>&orgao=<?php echo $linha_codigo[orgao]; ?>"'>
            
        </td>
        
            
    </tr>
