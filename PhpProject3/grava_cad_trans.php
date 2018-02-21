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

$sql = "SELECT * FROM cad_transportadora WHERE nome_trans = '{$_POST[nome_trans]}'";
$res = mysql_query($sql) or die("Erro seleção transp");

if (mysql_num_rows($res) and !isset($_POST[id_cad_trans])){
    
    require_once "validacao_cad_trans.php";
    die;
   
 }
    elseif(isset($_POST[id_cad_trans])){
        $sql =
        "UPDATE cad_transportadora SET nome_trans='{$_POST[nome_trans]}',website_trans='{$_POST[website_trans]}',usuario_trans='{$_POST[usuario_trans]}',
            senha_trans='{$_POST[senha_trans]}',contato_trans='{$_POST[contato_trans]}',email_trans='{$_POST[email_trans]}',msn_trans='{$_POST[msn_trans]}',
            fone_trans='{$_POST[fone_trans]}',regiao_trans='{$_POST[regiao_trans]}'
        WHERE id_cad_trans='{$_POST[id_cad_trans]}'
            ";
            
    //volta para a seleção e alteração
    $lugar=('lista_lote_alt.php');
}
    else {
    $sql = "INSERT into cad_transportadora (nome_trans,website_trans,usuario_trans,senha_trans,contato_trans,email_trans,msn_trans,fone_trans,regiao_trans)
                       VALUES ('{$_POST[nome_trans]}','{$_POST[website_trans]}','{$_POST[usuario_trans]}','{$_POST[senha_trans]}',
                               '{$_POST[contato_trans]}','{$_POST[email_trans]}','{$_POST[msn_trans]}',
                               '{$_POST[fone_trans]}','{$_POST[regiao_trans]}'
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
            OK, TRANSPORTADORA cadastrada com sucesso!
            <input type='button' value='Novo'
               onclick='document.location.href="cad_transportadora.php"'>
            <input type='button' value='Listar'
               onclick='document.location.href="lista_cad_transportadora_tudo.php?codigo=<?php echo $_REQUEST[codigo] ?>"'>
            </td>
        
            
    </tr>
