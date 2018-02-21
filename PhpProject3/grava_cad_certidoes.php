<?php

require "cabecalho_reduzido.php";
require "conecta.php";
        
/*if ($_POST[tipo_op_contas]=="A Receber"){
    $valor_conv = str_replace(',','.',str_replace('.','',$_POST[valor_contas]));
    }
    else {
        $valor_conv = -(str_replace(',','.',str_replace('.','',$_POST[valor_contas])));
        }
  */      
$data_conv = split('[/.-]', $_POST[data_venc]);

if ($_POST[id_cad_certidoes]){
$_POST[data_venc] = $data_conv[2].'-'.$data_conv[1].'-'.$data_conv[0];
}
//$_POST[data_emissao] = date('Y-m-d');
//echo $valor_conv;
//die;

$sql = "SELECT * FROM cad_certidoes WHERE nome_cert = '{$_POST[nome_cert]}'";
$res = mysql_query($sql) or die("Erro seleção cad certidoes");

if (mysql_num_rows($res) and !isset($_POST[id_cad_certidoes])){
    
    require_once "validacao_cad_geral.php";
    die;
   
 }
    elseif(isset($_POST[id_cad_certidoes])){
        $sql =
        "UPDATE cad_certidoes SET tipo_emissao='{$_POST[tipo_emissao]}',nome_cert='{$_POST[nome_cert]}',data_venc='{$_POST[data_venc]}',prazo_val='{$_POST[prazo_val]}',
                                   link_emissao='{$_POST[link_emissao]}'
                                       WHERE id_cad_certidoes='{$_POST[id_cad_certidoes]}'";
            
    //volta para a seleção e alteração
    $lugar=('lista_lote_alt.php');
}
    else {
    $sql = "INSERT into cad_certidoes (tipo_emissao,nome_cert,data_venc,prazo_val,link_emissao)
                       VALUES ('{$_POST[tipo_emissao]}','{$_POST[nome_cert]}','{$_POST[data_venc]}','{$_POST[prazo_val]}','{$_POST[link_emissao]}'
                               )";
    $lugar=('lista_licita_tudo.php');
    }

//echo $sql;die;
mysql_query($sql) or die("Erro gravando cad certidões!!!");

//require_once "$lugar";


//header mexe com cabeçahos do APACHE, não pode haver HTML antes do HEADER, pois o mesmo pode não funcionar.
//die;
//header mexe com cabeçahos do APACHE, não pode haver HTML antes do HEADER, pois o mesmo pode não funcionar.
//header ("location:precad_licita.php");

     
?>
    <tr>
        <td colspan="2" align="left" bgcolor="#FFFF00" class="A" scope="col">
            OK, CERTIDÃO/DOCUMENTO cadastrada com sucesso!
            <input type='button' value='Novo'
               onclick='document.location.href="cad_certidoes.php"'>
            <input type='button' value='Listar'
               onclick='document.location.href="cad_certidoes.php"'>
            </td>
    </tr>
