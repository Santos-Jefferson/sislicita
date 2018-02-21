<?php

require "conecta.php";

print_r ($_REQUEST);
die;

$sql_baixa = "SELECT * from cad_produto WHERE id_cad_prod ='{$_POST[id_cad_prod]}'";
$sql_res = mysql_query($sql_baixa) or die ("erro SELECT baixa estoque");
$linha_baixa = mysql_fetch_assoc($sql_res);

if(($_POST[qtde_si])>($linha_baixa[qtde_estoque])){
    $desc_prod_estoque=$linha_baixa[desc_prod]." "."PRODUTO SEM ESTOQUE - VERIFICAR";
    $sql_up = "UPDATE subitens_ne2 SET modelo_si='$desc_prod_estoque' WHERE id_subitem_ne='{$_POST[id_subitem_ne]}'";
    mysql_query($sql_up) or die("Erro gravando escrevendo_desc_prod - SEM ESTOQUE!!!");    
    
    require "cabecalho_reduzido.php";    
    
}
else{
    $saldo_estoque=$linha_baixa[qtde_estoque]-$_POST[qtde_si];
    $sql_up = "UPDATE cad_produto SET qtde_estoque=$saldo_estoque WHERE id_cad_prod='{$_POST[id_cad_prod]}'";
    mysql_query($sql_up) or die("Erro gravando baixa_estoque_itens_det_ne!!!");
    

//die ("erro");


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
$sql = "SELECT * FROM subitens_ne2 where id_item = {$_POST[id_item]}"; //{$_POST[qtde_si]}"; //WHERE sub_itens = {$_POST[id_item]}";
$res = mysql_query($sql) or die("Erro_seleção_grava_itens_det");

//if (mysql_num_rows($res) and !isset($_POST[id_subitem])){
    
   // require_once "validacao_cad_itens_det.php";
    //die;
   
 //}
    if(isset($_POST[id_subitem_ne])){
        $sql =
        "UPDATE subitens_ne2 SET qtde_si='{$_POST[qtde_estoque]}', marca_si='{$_POST[marca_prod]}',
                               modelo_si='{$_POST[desc_prod]}',nome_subitem='{$_POST[tipo_prod]}',
                               vunitcusto_si='{$_POST[vunitcusto_si]}',id_item='{$_POST[id_item]}'
                WHERE id_subitem_ne='{$_POST[id_subitem_ne]}'
            ";
                $lugar="cad_itens_det_ne.php?id_itens_ne=$_POST[id_itens_ne]&id_subitens_ne=$_POST[id_subitens_ne]";
         
            
    }
    else {
    $sql = "INSERT into subitens_ne2 (qtde_si,marca_si,modelo_si,nome_subitem,vunitcusto_si,forn_si,ro_si,id_item)
                       VALUES ('{$_POST[qtde_si]}','{$_POST[marca_si]}',
                               '{$_POST[modelo_si]}','{$_POST[nome_subitem]}',
                               '{$_POST[vunitcusto_si]}',
                               '{$_POST[forn_si]}','{$_POST[ro_si]}','{$_POST[id_item]}'
                               )";
    $lugar="cad_itens_det_ne.php?id_item=$_POST[id_item]";
    
    }
}
header("location:$lugar");
//echo $sql;die;
mysql_query($sql) or die("Erro gravando!!!");

//require_once ($lugar);
//}

//header mexe com cabeçahos do APACHE, não pode haver HTML antes do HEADER, pois o mesmo pode não funcionar.
//die;
//header mexe com cabeçahos do APACHE, não pode haver HTML antes do HEADER, pois o mesmo pode não funcionar.


$lugar="cad_itens_det_ne.php?id_itens_ne=$_POST[id_itens_ne]&id_subitens_ne=$_POST[id_subitens_ne]";
header("location:$lugar");

?>
<table align="center" width="1010" border="1" class="A" cellpading="0" cellspacing="0" >
    <tr>
        <td colspan="2" align="left" bgcolor="#FFFF00" class="A" scope="col">
            <input type='button' value='PRODUTO SEM ESTOQUE PARA A QUANTIDADE INFORMADA - (CLIQUE AQUI PARA VOLTAR)'
               onclick='document.location.href="cad_itens_det_ne.php?id_itens_ne=<?php echo $_POST[id_itens_ne];?>&id_subitens_ne=<?php echo $_POST[id_subitens_ne]; ?>"'>
            
        </td>
            
    </tr>
