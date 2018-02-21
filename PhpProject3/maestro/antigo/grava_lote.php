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
$sql = "SELECT * FROM lote WHERE lote = {$_POST[lote]} and id_cod = {$_POST[id_cod]}";
$res = mysql_query($sql) or die("Erro seleção");

if (mysql_num_rows($res) and !isset($_POST[id_lote])){
    
    require_once "validacao_cad_lote.php";
    die;
   
 }
    elseif(isset($_POST[id_lote])){
        $sql =
        "UPDATE codigo SET codigo='{$_POST[codigo]}',
            orgao='{$_POST[orgao]}',data='{$_POST[data]}',hora='{$_POST[hora]}',
            licitante='{$_POST[licitante]}'
        WHERE id_lote='{$_POST[id_lote]}'
            ";
            
    //volta para a seleção e alteração
    $lugar=('lista_lote_alt.php');
}
    else {
    $sql = "INSERT into lote (lote,id_cod)
                       VALUES ('{$_POST[lote]}','{$_POST[id_cod]}'
                               )";
    $lugar=('lista_lote_tudo.php');
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
            OK, LOTE cadastrado com sucesso!
            <input type='button' value='Novo'
               onclick='document.location.href="cad_lote.php?id_cod=<?php echo $_POST[id_cod]; ?>&codigo=<?php echo $_POST[codigo]; ?>"'>
            <input type='button' value='Listagem'
               onclick='document.location.href="lista_lote_tudo.php"'>
        </td>
        
            
    </tr>
