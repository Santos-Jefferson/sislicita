<?php

require "cabecalho_reduzido.php";
require "conecta.php";
require "lib_datas.php";
        
// comando para testar variáveis que vem do formulário
//print_r($_POST);
//die;
/*echo $sql = "UPDATE cadastro SET licitante='{$_POST[licitante]}',
            data_hora='{$_POST[data_hora]}', codigo='{$_POST[codigo]}',
            lote='{$_POST[lote]}',item='{$_POST[item]}',qtde='{$_POST[qtde]}',
            produto='{$_POST[produto]}',valor_unit_custo='{$_POST[valor_unit_custo]}',
            forn='{$_POST[forn]}',valor_frete='{$_POST[valor_frete]}',
            porcentagem_lucro='{$_POST[porcentagem_lucro]}' WHERE id_cadastro='{$_POST[id_cadastro]}'
            }";*/


//se é um alterar cadastro, utiliza a instrução UPDATE, se for cadastro novo, INSERT.
        //isset = existe ou não existe (se existe post[cod], então faz update. se não existe, faz cadastro novo
$sql = "SELECT * FROM lote WHERE id_cod = {$_POST[id_cod]} and lote = {$_POST[lote]}";
$res = mysql_query($sql) or die("Erro seleção");

if (mysql_num_rows($res) and !isset($_POST[id_lote])){
    
    require_once "validacao_cad_lote.php";
    die;
   
 }
    elseif(isset($_POST[id_lote])){
        $validade_rpfinal = SomarData2("$_POST[adj_data]", 0, "$_POST[validade_rp]", 0);
        $v = split('[/.-]', $validade_rpfinal);
        $validade_rpfinal = $v[2].'-'.$v[1].'-'.$v[0];
        
        if (isset($_POST[adj_data])){
            $v = split('[/.-]', $_POST[adj_data]);
            $_POST[adj_data] = $v[2].'-'.$v[1].'-'.$v[0];
        }
        if (isset($_POST[data_acomp])){
            $v = split('[/.-]', $_POST[data_acomp]);
            $_POST[data_acomp] = $v[2].'-'.$v[1].'-'.$v[0];
        }
        //print_r($validade_rpfinal);
        //die;
        $sql =
        "UPDATE lote SET lote='{$_POST[lote]}',colocacao='{$_POST[colocacao]}',adj_data='{$_POST[adj_data]}',validade_rp='{$_POST[validade_rp]}',validade_rpfinal='{$validade_rpfinal}',
                        historico='{$_POST[historico]}',data_acomp='{$_POST[data_acomp]}',hora_acomp='{$_POST[hora_acomp]}'
        WHERE id_lote='{$_POST[id_lote]}'
            ";
            
    //volta para a seleção e alteração
    $lugar=('lista_licita_tudo.php');
}
    else {
    $sql = "INSERT into lote (lote,colocacao,id_cod)
                       VALUES ('{$_POST[lote]}','{$_POST[colocacao]}','{$_POST[id_cod]}'
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
            <?php
                if (isset($_POST[id_lote])){
                    echo "OK, LOTE alterado com sucesso!";
                }   
                elseif (!isset($_POST[id_lote])){
                    echo "OK, LOTE adicionado com sucesso!";
                }
                ?>
            <input type='button' value='Novo'
               onclick='document.location.href="cad_lote.php?id_cod=<?php echo $_REQUEST[id_cod]; ?>&codigo=<?php echo $_REQUEST[codigo]; ?>"'>
            <input type='button' value='Listar'
               onclick='document.location.href="lista_licita_tudo.php?codigo=<?php echo $_REQUEST[codigo]?>"'>
            <input type='button' value='Listagem Geral'
               onclick='document.location.href="lista_licita_tudo.php"'>
        
        </td>
        
            
    </tr>

