<?php

require "cabecalho_reduzido.php";
require "conecta.php";
        
// comando para testar variáveis que vem do formulário
//print_r($_REQUEST);die;
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
/*if (isset($_POST[baixa_contas])){
    foreach($_POST[baixa_contas] as $b){
        $s = "UPDATE contas_pagar_receber SET obs_contas='baixado' WHERE id_contas='$b'";    
        mysql_query($s) or die ("Erro baixando");
        
    }
    header ("location:lista_cad_contas_pagar_receber.php");
    die;
}
*/



if ($_POST[tipo_op_contas]=="A Receber"){
    $valor_conv = str_replace(',','.',str_replace('.','',$_POST[valor_contas]));
    }
    else {
        $valor_conv = -(str_replace(',','.',str_replace('.','',$_POST[valor_contas])));
        }
        
$data_conv = split('[/.-]', $_POST[data_venc]);

if ($_POST[id_contas]){
$_POST[data_venc] = $data_conv[2].'-'.$data_conv[1].'-'.$data_conv[0];
}
$_POST[data_emissao] = date('Y-m-d');
//echo $valor_conv;
//die;

$sql = "SELECT * FROM contas_pagar_receber WHERE num_doc = '{$_POST[num_doc]}' and data_venc = '{$_POST[data_venc]}' and cl_forn_contas = '{$_POST[cl_forn_contas]}'";
$res = mysql_query($sql) or die("Erro seleção");

if (mysql_num_rows($res) and !isset($_POST[id_contas])){
    
    require_once "validacao_cad_geral.php";
    die;
   
 }
    elseif(isset($_POST[id_contas])){
        $sql =
        "UPDATE contas_pagar_receber SET tipo_op_contas='{$_POST[tipo_op_contas]}',data_venc='{$_POST[data_venc]}',num_doc='{$_POST[num_doc]}',
                                   valor_contas='{$valor_conv}',tipo_contas='{$_POST[tipo_contas]}',desc_contas='{$_POST[desc_contas]}',cat_contas='{$_POST[cat_contas]}',cl_forn_contas='{$_POST[cl_forn_contas]}',banco_contas='{$_POST[banco_contas]}',obs_contas='{$_POST[obs_contas]}'
                                       WHERE id_contas='{$_POST[id_contas]}'";
            
    //volta para a seleção e alteração
    $lugar=('lista_lote_alt.php');
}
    else {
    $sql = "INSERT into contas_pagar_receber (tipo_op_contas,data_emissao,data_venc,num_doc,valor_contas,tipo_contas,desc_contas,cat_contas,cl_forn_contas,banco_contas,obs_contas)
                       VALUES ('{$_POST[tipo_op_contas]}','{$_POST[data_emissao]}','{$_POST[data_venc]}','{$_POST[num_doc]}','{$valor_conv}','{$_POST[tipo_contas]}','{$_POST[desc_contas]}','{$_POST[cat_contas]}',
                               '{$_POST[cl_forn_contas]}','{$_POST[banco_contas]}','{$_POST[obs_contas]}'
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
            OK, CONTAS cadastrado com sucesso!
            <input type='button' value='Novo - Mesmo Cliente/Fornecedor'
               onclick='document.location.href="cad_contas_pagar_receber.php?novo=mesmocl_forn"'>
            <input type='button' value='Novo'
               onclick='document.location.href="cad_contas_pagar_receber.php"'>
            <input type='button' value='Listar'
               onclick='document.location.href="lista_cad_contas_pagar_receber.php"'>
            </td>
        
            
    </tr>
