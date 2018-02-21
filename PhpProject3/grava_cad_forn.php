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

$sql = "SELECT * FROM cad_fornecedor WHERE nome_forn = '{$_POST[nome_forn]}'";
$res = mysql_query($sql) or die("Erro seleção");

if (mysql_num_rows($res) and !isset($_POST[id_cad_forn])){
    
    require_once "validacao_cad_forn.php";
    die;
   
 }
    elseif(isset($_POST[id_cad_forn])){
        $sql =
        "UPDATE cad_fornecedor SET razao_social='{$_POST[razao_social]}',nome_forn='{$_POST[nome_forn]}',end_completo='{$_POST[end_completo]}',estado='{$_POST[estado]}',
                                   cidade='{$_POST[cidade]}',cnpj='{$_POST[cnpj]}',ie='{$_POST[ie]}',website_forn='{$_POST[website_forn]}',usuario_forn='{$_POST[usuario_forn]}',
                                   senha_forn='{$_POST[senha_forn]}',contato_forn='{$_POST[contato_forn]}',msn_forn='{$_POST[msn_forn]}',email_forn='{$_POST[email_forn]}',
                                   fone_forn='{$_POST[fone_forn]}',contato_rma='{$_POST[contato_rma]}',skype_rma='{$_POST[skype_rma]}',email_rma='{$_POST[email_rma]}',
                                   fone_rma='{$_POST[fone_rma]}',contato_fin='{$_POST[contato_fin]}',skype_fin='{$_POST[skype_fin]}',email_fin='{$_POST[email_fin]}',
                                   fone_fin='{$_POST[fone_fin]}',segmento_forn='{$_POST[segmento_forn]}',obs_info='{$_POST[obs_info]}'
                                       WHERE id_cad_forn='{$_POST[id_cad_forn]}'";
            
    //volta para a seleção e alteração
    $lugar=('lista_lote_alt.php');
}
    else {
    $sql = "INSERT into cad_fornecedor (razao_social,nome_forn,end_completo,estado,cidade,cnpj,ie,website_forn,usuario_forn,senha_forn,contato_forn,email_forn,msn_forn,
                                        fone_forn,contato_rma,skype_rma,email_rma,fone_rma,contato_fin,skype_fin,email_fin,fone_fin,segmento_forn,obs_info)
                       VALUES ('{$_POST[razao_social]}','{$_POST[nome_forn]}','{$_POST[end_completo]}','{$_POST[estado]}','{$_POST[cidade]}','{$_POST[cnpj]}','{$_POST[ie]}',
                               '{$_POST[website_forn]}','{$_POST[usuario_forn]}','{$_POST[senha_forn]}','{$_POST[contato_forn]}','{$_POST[email_forn]}','{$_POST[msn_forn]}',
                               '{$_POST[fone_forn]}','{$_POST[contato_rma]}','{$_POST[skype_rma]}','{$_POST[email_rma]}','{$_POST[fone_rma]}','{$_POST[contato_fin]}',
                               '{$_POST[skype_fin]}','{$_POST[email_fin]}','{$_POST[fone_fin]}','{$_POST[segmento_forn]}','{$_POST[obs_info]}'
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
                    OK, FORNECEDOR cadastrado com sucesso!
                    <input type='button' value='Novo'
                       onclick='document.location.href="cad_fornecedor.php"'>
                    <input type='button' value='Listar'
                       onclick='document.location.href="lista_cad_fornecedor_tudo.php?codigo=<?php echo $_REQUEST[codigo] ?>"'>
                    </td>


            </tr>
