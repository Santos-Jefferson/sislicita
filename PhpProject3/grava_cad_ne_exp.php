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
$sql = "SELECT * FROM expedicao WHERE id_ne = '{$_POST[id_ne]}'";
$res = mysql_query($sql) or die("Erro seleção cad_ne_exp");

if (mysql_num_rows($res) and !isset($_POST[id_exp])){
    
    require_once "validacao_cad_ne_exp.php";
    die;
   
 }
    elseif(isset($_POST[id_exp])){
        $sql =
        "UPDATE expedicao SET
                num_nfe='{$_POST[num_nfe]}',
                qtde_vol='{$_POST[qtde_vol]}',
                peso_kg='{$_POST[peso_kg]}',
                transportadora_exp='{$_POST[transportadora_exp]}',
                vfrete_exp='{$_POST[vfrete_exp]}',
                prev_entrega_exp='{$_POST[prev_entrega_exp]}',
                data_exp='{$_POST[data_exp]}'
        WHERE id_ne='{$_POST[id_ne]}'
        ";
            
    //volta para a seleção e alteração
    $lugar=('lista_lote_alt.php');
}
    else {
    $sql = "INSERT into expedicao (num_nfe,qtde_vol,peso_kg,transportadora_exp,vfrete_exp,prev_entrega_exp,data_exp,id_ne)
                       VALUES ('{$_POST[num_nfe]}',
                               '{$_POST[qtde_vol]}',
                               '{$_POST[peso_kg]}',
                               '{$_POST[transportadora_exp]}',
                               '{$_POST[vfrete_exp]}',
                               '{$_POST[prev_entrega_exp]}',
                               '{$_POST[data_exp]}',
                               '{$_POST[id_ne]}'
                        )";
    $lugar=('lista_licita_tudo.php');
    $sql_ne =
    "UPDATE notaempenho SET
        status_ne='NE despachada'
    WHERE id_ne='{$_POST[id_ne]}'";
    mysql_query($sql_ne) or die ("erro update status_ne");
    
    }

//echo $sql;die;
mysql_query($sql) or die("Erro gravando cad_ne_exp!!!");

//require_once "$lugar";


//header mexe com cabeçahos do APACHE, não pode haver HTML antes do HEADER, pois o mesmo pode não funcionar.
//die;
//header mexe com cabeçahos do APACHE, não pode haver HTML antes do HEADER, pois o mesmo pode não funcionar.
//header ("location:precad_licita.php");

        
?>
    <tr>
        <td colspan="2" align="left" bgcolor="#FFFF00" class="A" scope="col">
            OK, Informações de expedição cadastrado com sucesso!
            <input type='button' value='VOLTAR'
               onclick='document.location.href="cad_ne.php?id_cod=<?php echo $_POST[id_cod] ?>&id_lote=<?php echo $_POST[id_lote]?>"'>
            <!--<input type='button' value='Listar Notas de Empenho'
               onclick='document.location.href="lista_licita_tudo.php?codigo=<?php echo $_REQUEST[codigo] ?>"'>
            <input type='button' value='Listagem Geral'
               onclick='document.location.href="lista_licita_tudo.php"'>-->
        </td>
        
            
    </tr>
