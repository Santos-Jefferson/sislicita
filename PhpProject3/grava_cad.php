<?php
require "cabecalho_reduzido.php";
require "conecta.php";
        
// comando para testar variáveis que vem do formulário
//print_r($_REQUEST);
/*echo $sql = "UPDATE cadastro SET licitante='{$_POST[licitante]}',
            data_hora='{$_POST[data_hora]}', codigo='{$_POST[codigo]}',
            lote='{$_POST[lote]}',item='{$_POST[item]}',qtde='{$_POST[qtde]}',
            produto='{$_POST[produto]}',valor_unit_custo='{$_POST[valor_unit_custo]}',
            forn='{$_POST[forn]}',valor_frete='{$_POST[valor_frete]}',
            porcentagem_lucro='{$_POST[porcentagem_lucro]}' WHERE id_cadastro='{$_POST[id_cadastro]}'
            }";*/

//se é um alterar cadastro, utiliza a instrução UPDATE, se for cadastro novo, INSERT.
        //isset = existe ou não existe (se existe post[cod], então faz update. se não existe, faz cadastro novo
$sql = "SELECT * FROM codigo WHERE codigo = '{$_POST[codigo]}'";
$res = mysql_query($sql) or die("Erro seleção");

if (mysql_num_rows($res) and !isset($_POST[id_cod])){
    
    require_once "validacao_cad_codigo.php";
    die;
   
 }
    elseif(isset($_POST[id_cod])){
        if (isset($_POST[data])){
            $v = split('[/.-]', $_POST[data]);
            $_POST[data] = $v[2].'-'.$v[1].'-'.$v[0];
        }
        $sql =
        "UPDATE codigo SET modalidade='{$_POST[modalidade]}',tipo_licitacao='{$_POST[tipo_licitacao]}',codigo='{$_POST[codigo]}',pregao='{$_POST[pregao]}',
            orgao='{$_POST[orgao]}',uf='{$_POST[uf]}',data='{$_POST[data]}',hora='{$_POST[hora]}',
            licitante='{$_POST[licitante]}',perc_icms='{$_POST[perc_icms]}',local_licitacao='{$_POST[local_licitacao]}'
        WHERE id_cod='{$_POST[id_cod]}'
            ";
            
    //volta para a seleção e alteração
    $lugar=('lista_lote_alt.php');
}
    else {
    $sql = "INSERT into codigo (modalidade,tipo_licitacao,codigo,pregao,orgao,uf,data,hora,licitante,perc_icms,local_licitacao)
                       VALUES ('{$_POST[modalidade]}','{$_POST[tipo_licitacao]}','{$_POST[codigo]}','{$_POST[pregao]}','{$_POST[orgao]}',
                               '{$_POST[uf]}','{$_POST[data]}','{$_POST[hora]}',
                               '{$_POST[licitante]}','{$_POST[perc_icms]}','{$_POST[local_licitacao]}'
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
            OK, Licitação cadastrada com sucesso!
            <input type='button' value='Novo'
               onclick='document.location.href="cad_codigo.php"'>
            <input type='button' value='Listar'
               onclick='document.location.href="lista_licita_tudo.php?codigo=<?php echo $_REQUEST[codigo] ?>"'>
            <input type='button' value='Listagem Geral'
               onclick='document.location.href="lista_licita_tudo.php"'>
            <input type='button' value='RO POSITIVO'
               onclick='document.location.href="ro_positivo.php"'>
        </td>
        
            
    </tr>
