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
$valor_conv_ch = str_replace(',','.',str_replace('.','',$_POST[valor_chamado]));
$valor_conv_re = str_replace(',','.',str_replace('.','',$_POST[valor_retorno]));

$sql = "SELECT * FROM cad_assistencias WHERE cnpj = '{$_POST[cnpj]}'";
$res = mysql_query($sql) or die("Erro seleção assist");

if (mysql_num_rows($res) and !isset($_POST[id_cad_assist])){
    
    require_once "validacao_cad_assist.php";
    die;
   
 }
    elseif(isset($_POST[id_cad_assist])){
        $sql =
        "UPDATE cad_assistencias SET razao_social='{$_POST[razao_social]}',nome_assist='{$_POST[nome_assist]}',end_completo='{$_POST[end_completo]}',cnpj='{$_POST[cnpj]}',ie='{$_POST[ie]}',cod_banco='{$_POST[cod_banco]}',ag_cc='{$_POST[ag_cc]}',contato_assist='{$_POST[contato_assist]}',email_assist='{$_POST[email_assist]}',obs_info='{$_POST[obs_info]}',
            fone_assist='{$_POST[fone_assist]}',fone_assist2='{$_POST[fone_assist2]}',fone_assist3='{$_POST[fone_assist3]}',estado='{$_POST[estado]}',cidade='{$_POST[cidade]}',aut_positivo='{$_POST[aut_positivo]}',valor_chamado='{$valor_conv_ch}',valor_retorno='{$valor_conv_re}'
        WHERE id_cad_assist='{$_POST[id_cad_assist]}'
            ";
            
    //volta para a seleção e alteração
    $lugar=('lista_lote_alt.php');
}
    else {
    $sql = "INSERT into cad_assistencias (razao_social,nome_assist,end_completo,cnpj,ie,cod_banco,ag_cc,contato_assist,email_assist,obs_info,fone_assist,fone_assist2,fone_assist3,estado,cidade,aut_positivo,valor_chamado,valor_retorno)
                       VALUES ('{$_POST[razao_social]}','{$_POST[nome_assist]}','{$_POST[end_completo]}','{$_POST[cnpj]}','{$_POST[ie]}','{$_POST[cod_banco]}','{$_POST[ag_cc]}','{$_POST[contato_assist]}','{$_POST[email_assist]}','{$_POST[obs_info]}',
                                '{$_POST[fone_assist]}','{$_POST[fone_assist2]}','{$_POST[fone_assist3]}','{$_POST[estado]}','{$_POST[cidade]}','{$_POST[aut_positivo]}','{$valor_conv_ch}','{$valor_conv_re}'
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
            OK, ASSISTÊNCIA TÉCNICA cadastrada com sucesso!
            <input type='button' value='Novo'
               onclick='document.location.href="cad_assistencias.php"'>
            <input type='button' value='Listar'
               onclick='document.location.href="lista_cad_assistencias_tudo.php?codigo=<?php echo $_REQUEST[codigo] ?>"'>
            </td>
        
            
    </tr>
