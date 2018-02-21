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

$sql = "SELECT * FROM cad_clientes WHERE nome_cl = '{$_POST[nome_cl]}' and cnpj_cl = '{$_POST[cnpj_cl]}'";
$res = mysql_query($sql) or die("Erro seleção");

if (mysql_num_rows($res) and !isset($_POST[id_cad_cl])){
    
    require_once "validacao_cad_cl.php";
    die;
   
 }
    elseif(isset($_POST[id_cad_cl])){
        $sql =
        "UPDATE cad_clientes SET razao_social_cl='{$_POST[razao_social_cl]}',nome_cl='{$_POST[nome_cl]}',uasg_cl='{$_POST[uasg_cl]}',endereco_fat='{$_POST[endereco_fat]}',estado='{$_POST[estado]}',
                                   cidade='{$_POST[cidade]}',cnpj_cl='{$_POST[cnpj_cl]}',ie_cl='{$_POST[ie_cl]}',website_cl='{$_POST[website_cl]}',contato_lic='{$_POST[contato_lic]}',email_lic='{$_POST[email_lic]}',
                                   fone_lic='{$_POST[fone_lic]}',contato_ti='{$_POST[contato_ti]}',email_ti='{$_POST[email_ti]}',fone_ti='{$_POST[fone_ti]}',contato_fin_cl='{$_POST[contato_fin_cl]}',email_fin_cl='{$_POST[email_fin_cl]}',
                                   fone_fin_cl='{$_POST[fone_fin_cl]}',contato_almox='{$_POST[contato_almox]}',endereco_ent='{$_POST[endereco_ent]}',email_almox='{$_POST[email_almox]}',
                                   fone_almox='{$_POST[fone_almox]}',obs_info_cl='{$_POST[obs_info_cl]}'
                                       WHERE id_cad_cl='{$_POST[id_cad_cl]}'";
            
    //volta para a seleção e alteração
    $lugar=('lista_lote_alt.php');
}
    else {
    $sql = "INSERT into cad_clientes (razao_social_cl,nome_cl,uasg_cl,endereco_fat,estado,cidade,cnpj_cl,ie_cl,website_cl,contato_lic,email_lic,fone_lic,contato_ti,email_ti,
                                       fone_ti,contato_fin_cl,email_fin_cl,fone_fin_cl,contato_almox,endereco_ent,email_almox,fone_almox,obs_info_cl)
                       VALUES ('{$_POST[razao_social_cl]}','{$_POST[nome_cl]}','{$_POST[uasg_cl]}','{$_POST[endereco_fat]}','{$_POST[estado]}','{$_POST[cidade]}','{$_POST[cnpj_cl]}','{$_POST[ie_cl]}',
                               '{$_POST[website_cl]}','{$_POST[contato_lic]}','{$_POST[email_lic]}','{$_POST[fone_lic]}','{$_POST[contato_ti]}','{$_POST[email_ti]}','{$_POST[fone_ti]}','{$_POST[contato_fin_cl]}',
                               '{$_POST[email_fin_cl]}','{$_POST[fone_fin_cl]}','{$_POST[contato_almox]}','{$_POST[endereco_ent]}','{$_POST[email_almox]}','{$_POST[fone_almox]}','{$_POST[obs_info_cl]}'
                               )";
    $lugar=('lista_licita_tudo.php');
    }

//echo $sql;die;
mysql_query($sql) or die("Erro gravando cad clientes!!!");

//require_once "$lugar";


//header mexe com cabeçahos do APACHE, não pode haver HTML antes do HEADER, pois o mesmo pode não funcionar.
//die;
//header mexe com cabeçahos do APACHE, não pode haver HTML antes do HEADER, pois o mesmo pode não funcionar.
//header ("location:precad_licita.php");

     
?>
            <tr>
                <td colspan="2" align="left" bgcolor="#FFFF00" class="A" scope="col">
                    OK, CLIENTE cadastrado com sucesso!
                    <input type='button' value='Novo'
                       onclick='document.location.href="cad_clientes.php"'>
                    <input type='button' value='Listar'
                       onclick='document.location.href="lista_cad_clientes_tudo.php?codigo=<?php echo $_REQUEST[codigo] ?>"'>
                    </td>


            </tr>
