<?php

require "cabecalho_reduzido.php";
require "conecta.php";
        
// comando para testar variáveis que vem do formulário
//print_r($_POST);die;
/*echo $sql = "UPDATE cadastro SET licitante='{$_POST[licitante]}',
            data_hora='{$_POST[data_hora]}', codigo='{$_POST[codigo]}',
            lote='{$_POST[lote]}',item='{$_POST[item]}',qtde='{$_POST[qtde]}',
            produto='{$_POST[produto]}',valor_unit_custo='{$_POST[valor_unit_custo]}',
            forn='{$_POST[forn]}',valor_frete='{$_POST[valor_frete]}',
            porcentagem_lucro='{$_POST[porcentagem_lucro]}' WHERE id_cadastro='{$_POST[id_cadastro]}'
            }";*/

//se é um alterar cadastro, utiliza a instrução UPDATE, se for cadastro novo, INSERT.
//isset = existe ou não existe (se existe post[cod], então faz update. se não existe, faz cadastro novo

//Converte o valor passado em REAIS via JavaScript (máscara) no formulário em cad_produto.php e converte com "." para gravar no BD Mysql
$valor_conv = str_replace(',','.',str_replace('.','',$_POST[valor_custo_forn]));

$sql = "SELECT * FROM cad_produto WHERE part_number = '{$_POST[part_number]}'";
$res = mysql_query($sql) or die("Erro seleção");

if (mysql_num_rows($res) and !isset($_POST[id_cad_prod])){
    
    require_once "validacao_cad_geral.php";
    die;
   
 }
    elseif(isset($_POST[id_cad_prod])){
        $sql =
        "UPDATE cad_produto SET cod_prod_forn='{$_POST[cod_prod_forn]}',desc_prod='{$_POST[desc_prod]}',un_prod='{$_POST[un_prod]}',num_serie='{$_POST[num_serie]}',
                                   tipo_prod='{$_POST[tipo_prod]}',marca_prod='{$_POST[marca_prod]}',part_number='{$_POST[part_number]}',info_adic_prod='{$_POST[info_adic_prod]}',valor_custo_forn='{$valor_conv}',qtde_estoque='{$_POST[qtde_estoque]}'
                                       WHERE id_cad_prod='{$_POST[id_cad_prod]}'";
            
    //volta para a seleção e alteração
    $lugar=('lista_lote_alt.php');
}
    else {
    $sql = "INSERT into cad_produto (cod_prod_forn,desc_prod,un_prod,num_serie,tipo_prod,marca_prod,part_number,info_adic_prod,valor_custo_forn,qtde_estoque)
                       VALUES ('{$_POST[cod_prod_forn]}','{$_POST[desc_prod]}','{$_POST[un_prod]}','{$_POST[num_serie]}','{$_POST[tipo_prod]}','{$_POST[marca_prod]}','{$_POST[part_number]}','{$_POST[info_adic_prod]}',
                               '{$valor_conv}','{$_POST[qtde_estoque]}'
                               )";
    $lugar=('lista_licita_tudo.php');
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
            OK, PRODUTO cadastrado com sucesso!
            <input type='button' value='Novo'
               onclick='document.location.href="cad_produto.php"'>
            <input type='button' value='Listar'
               onclick='document.location.href="lista_cad_produto_tudo.php"'>
            </td>
        
            
    </tr>
