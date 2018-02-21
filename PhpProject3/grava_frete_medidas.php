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

$sql = "SELECT * FROM frete_medidas WHERE tipo_equip = '{$_POST[tipo_equip]}'";
$res = mysql_query($sql) or die("Erro seleção");

if (mysql_num_rows($res) and !isset($_POST[id_frete_medidas])){
    
    require_once "validacao_cad_forn.php";
    die;
   
 }
    elseif(isset($_POST[id_frete_medidas])){
        $sql =
        "UPDATE frete_medidas SET tipo_equip='{$_POST[tipo_equip]}',alt_equip='{$_POST[alt_equip]}',larg_equip='{$_POST[larg_equip]}',
            comp_equip='{$_POST[comp_equip]}',peso_equip='{$_POST[peso_equip]}'
        WHERE id_frete_medidas='{$_POST[id_frete_medidas]}'
            ";
            
    //volta para a seleção e alteração
    $lugar=('lista_lote_alt.php');
}
    else {
    $sql = "INSERT into frete_medidas (tipo_equip,alt_equip,larg_equip,comp_equip,peso_equip)
                       VALUES ('{$_POST[tipo_equip]}','{$_POST[alt_equip]}','{$_POST[larg_equip]}','{$_POST[comp_equip]}',
                               '{$_POST[peso_equip]}'
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
               onclick='document.location.href="cad_frete_medidas.php"'>
            <input type='button' value='Listar'
               onclick='document.location.href="lista_cad_frete_medidas.php?codigo=<?php echo $_REQUEST[codigo] ?>"'>
            </td>
        
            
    </tr>
