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
$sql = "SELECT * FROM financeiro WHERE id_ne = '{$_POST[id_ne]}'";
$res = mysql_query($sql) or die("Erro seleção cad_ne_finan");

if (mysql_num_rows($res) and !isset($_POST[id_finan])){
    
    require_once "validacao_cad_ne_finan.php";
    die;
   
 }
    elseif(isset($_POST[id_finan])){
        $sql =
        "UPDATE financeiro SET
                data_pgto='{$_POST[data_pgto]}',
                status_comissao='{$_POST[status_comissao]}',
                historico_obs_finan='{$_POST[historico_obs_finan]}'
        WHERE id_ne='{$_POST[id_ne]}'
                ";
            
    //volta para a seleção e alteração
    $lugar=('lista_lote_alt.php');
}
    else {
    $sql = "INSERT into financeiro (data_pgto,status_comissao,historico_obs_finan,id_ne)
                       VALUES ('{$_POST[data_pgto]}',
                               '{$_POST[status_comissao]}',
                               '{$_POST[historico_obs_finan]}',
                               '{$_POST[id_ne]}'
                               
                        )";
    $lugar=('lista_licita_tudo.php');
    }
    $sql_ne =
    "UPDATE notaempenho SET
        status_ne='Pagamento efetuado'
    WHERE id_ne='{$_POST[id_ne]}'";
    mysql_query($sql_ne) or die ("erro update status_ne");

//echo $sql;die;
mysql_query($sql) or die("Erro gravando cad_ne_finan!!!");

//require_once "$lugar";


//header mexe com cabeçahos do APACHE, não pode haver HTML antes do HEADER, pois o mesmo pode não funcionar.
//die;
//header mexe com cabeçahos do APACHE, não pode haver HTML antes do HEADER, pois o mesmo pode não funcionar.
//header ("location:precad_licita.php");

        
?>
    <tr>
        <td colspan="2" align="left" bgcolor="#FFFF00" class="A" scope="col">
            OK, Informações financeiras cadastrado com sucesso!
            <input type='button' value='VOLTAR'
               onclick='document.location.href="cad_ne.php?id_cod=<?php echo $_POST[id_cod] ?>&id_lote=<?php echo $_POST[id_lote]?>"'>
            <!--<input type='button' value='Listar Notas de Empenho'
               onclick='document.location.href="lista_licita_tudo.php?codigo=<?php echo $_REQUEST[codigo] ?>"'>
            <input type='button' value='Listagem Geral'
               onclick='document.location.href="lista_licita_tudo.php"'>-->
        </td>
        
            
    </tr>
