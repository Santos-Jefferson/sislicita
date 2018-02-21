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
$sql = "SELECT * FROM itens WHERE item = {$_POST[item]} and id_lote = {$_POST[id_lote]}";
$res = mysql_query($sql) or die("Erro seleção");

if (mysql_num_rows($res) and !isset($_POST[id_itens])){
    
    require_once "validacao_cad_itens.php";
    die;
   
 }
    elseif(isset($_POST[id_itens])){
        $sql =
        "UPDATE itens SET item='{$_POST[item]}',qtde='{$_POST[qtde]}', produto='{$_POST[produto]}',
            vunitcusto='{$_POST[vunitcusto]}',vtotcusto='{$_POST[vtotcusto]}',
            forn='{$_POST[forn]}',vfrete='{$_POST[vfrete]}',imposto='{$_POST[imposto]}',
            custo_aprox='{$_POST[custo_aprox]}',lucro_liq='{$_POST[lucro_liq]}',
            vofertado='{$_POST[vofertado]}',vminofertar='{$_POST[vminofertar]}',
            vitem='{$_POST[vitem]}',vminitem='{$_POST[vminitem]}',porc_lucro='{$_POST[porc_lucro]}'
                WHERE id_itens='{$_POST[id_itens]}'
            ";
            
    //volta para a seleção e alteração
    //$lugar= ('cad_itens.php'
            //p?id_lote=echo $_POST[id_lote];
              //  &lote=echo $_POST[lote];
                //&codigo=echo $_POST[codigo];
           //     );
}
    else {
    $sql = "INSERT into itens (item,qtde,produto,vunitcusto,vtotcusto,forn,vfrete,imposto,custo_aprox,lucro_liq,vofertado,vminofertar,vitem,vminitem,porc_lucro,id_lote)
                       VALUES ('{$_POST[item]}','{$_POST[qtde]}','{$_POST[produto]}',
                               '{$_POST[vunitcusto]}','{$_POST[vtotcusto]}','{$_POST[forn]}',
                               '{$_POST[vfrete]}','{$_POST[imposto]}','{$_POST[custo_aprox]}',
                               '{$_POST[lucro_liq]}','{$_POST[vofertado]}','{$_POST[vminofertar]}',
                               '{$_POST[vitem]}','{$_POST[vminitem]}',
                               '{$_POST[porc_lucro]}','{$_POST[id_lote]}'
                               )";
    $lugar=('lista_itens_tudo.php');
    }

//echo $sql;die;
mysql_query($sql) or die("Erro gravando!!!");

//require_once "$lugar";


//header mexe com cabeçahos do APACHE, não pode haver HTML antes do HEADER, pois o mesmo pode não funcionar.
//die;
//header mexe com cabeçahos do APACHE, não pode haver HTML antes do HEADER, pois o mesmo pode não funcionar.
//header ("location:precad_licita.php");

        
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
               onclick='document.location.href="cad_itens.php?id_cod=<?php echo $linha_lote[id_cod]; ?>&id_lote=<?php echo $_POST[id_lote]; ?>&lote=<?php echo $linha_lote[lote]; ?>&codigo=<?php echo $linha_codigo[codigo]; ?>&licitante=<?php echo $linha_codigo[licitante]; ?>&data=<?php echo $linha_codigo[data];?>&hora=<?php echo $linha_codigo[hora]; ?>&orgao=<?php echo $linha_codigo[orgao]; ?>"'>
        </td>
        
            
    </tr>
