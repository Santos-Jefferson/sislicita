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

$sql = "SELECT * FROM expedicao_qtdes WHERE id_ne = '{$_GET[id_ne]}'";// and id_item = '{$_GET[id_item]}'";
$res = mysql_query($sql) or die("Erro seleção cad_ne_exp_qtdes");

if (mysql_num_rows($res) and !isset($_POST[id_qtde_exp])){
    
    require_once "validacao_cad_ne_exp_qtdes.php";
    die;
   
 }
    elseif(isset($_POST[id_qtde_exp])){
        $sql =
        "UPDATE expedicao SET transportadora_exp='{$_POST[transportadora_exp]}',
                vfrete_exp='{$_POST[vfrete_exp]}',
                data_exp='{$_POST[data_exp]}'
        ";
            
    //volta para a seleção e alteração
    $lugar=('lista_lote_alt.php');
}
    else {
        
        if($_POST[qtde_exp] <> ""){
        $cont = count($_POST[qtde_exp]);
        //echo "$cont";
        for($i=0; $i<$cont; $i++){
            if($_POST[qtde_exp][$i] == "") continue;
            $sql= "INSERT INTO expedicao_qtdes (qtde_exp,id_item,id_ne) VALUES ('{$_POST[qtde_exp][$i]}','{$_POST[id_item][$i]}','{$_POST[id_ne][$i]}');";
            mysql_query($sql) or die("Erro gravando cad_ne_exp_qtdes!!!");
            }  
        }       
    }
//echo $sql;die;
//mysql_query($sql) or die("Erro gravando cad_ne_exp!!!");
    
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
