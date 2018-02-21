<?php

require "cabecalho_reduzido.php";
require "conecta.php";
        
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

$sql = "SELECT * FROM precadastro WHERE codigo = '{$_POST[codigo]}'";
$res = mysql_query($sql) or die("Erro seleção");

if (mysql_num_rows($res) and !isset($_POST[id])){
    
    require_once "validacao_precad_codigo.php";
    die;
   
 }
    elseif(isset($_POST[id])){
        $sql =
        "UPDATE precadastro SET licitante='{$_POST[licitante]}',
            codigo='{$_POST[codigo]}', data='{$_POST[data]}',
            status='{$_POST[status]}' WHERE id='{$_POST[id]}'
            ";
            
    //volta para a seleção e alteração
    $lugar=('lista_precad_alt.php');
}
else {
$sql = "INSERT into precadastro (licitante,codigo,data,status)
                       VALUES ('{$_POST[licitante]}','{$_POST[codigo]}',
                               '{$_POST[data]}','{$_POST[status]}'
                               )";
    $lugar=('lista_precad_tudo.php');
}


//echo $sql;die;
mysql_query($sql) or die("Erro gravando!!!");

//require_once ($lugar);
?>
   <tr>
        <td colspan="2" align="left" bgcolor="#FFFF00" class="A" scope="col">
            Licitação pré-cadastrada com sucesso!
            <input type='button' value='Novo'
               onclick='document.location.href="precad_licita.php"'>
            <input type='button' value='Listagem'
               onclick='document.location.href="lista_precad_tudo.php"'>
        </td>
        
            
    </tr>



