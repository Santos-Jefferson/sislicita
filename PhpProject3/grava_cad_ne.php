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

//copia os campos do registro da tabela itens para itens_ne
//$sql = "INSERT into itens_ne SELECT * FROM itens where id_lote = '$_POST[id_lote]'";
//$res = mysql_query($sql) or die("erro gravando itens_ne");
//copia os campos do registro da tabela subitens para subitens_ne
//$sql = "INSERT into subitens_ne SELECT * FROM subitens where id_item = '$_POST[id_itens]'";
//$res = mysql_query($sql) or die("erro gravando subitens_ne");



//se é um alterar cadastro, utiliza a instrução UPDATE, se for cadastro novo, INSERT.
        //isset = existe ou não existe (se existe post[cod], então faz update. se não existe, faz cadastro novo
$sql_cod = "Select * From codigo Where id_cod = '{$_POST[id_cod]}'";
$res_cod = mysql_query($sql_cod) or die ("Erro selecação sql_cod");
$linha_cod = mysql_fetch_array($res_cod);

$sql = "SELECT * FROM notaempenho WHERE num_ne = '{$_POST[num_ne]}'";
$res = mysql_query($sql) or die("Erro seleção");

if (mysql_num_rows($res) and !isset($_POST[id_ne])){
    
    require_once "validacao_cad_ne.php";
    die;
   
 }
    elseif(isset($_POST[id_ne])){
        $sql =
        "UPDATE notaempenho SET data_rec_ne='{$_POST[data_rec_ne]}',prazo_ent_ne='{$_POST[prazo_ent_ne]}',data_proposta='{$_POST[data_proposta]}',
            val_proposta='{$_POST[val_proposta]}',num_ne='{$_POST[num_ne]}',data_prev_pgto='{$_POST[data_prev_pgto]}',status_ne='{$_POST[status_ne]}'
           WHERE id_ne='{$_POST[id_ne]}'
            ";
                                  
    //volta para a seleção e alteração
    $lugar=('lista_lote_alt.php');
}
    else {
    $sql = "INSERT into notaempenho (data_rec_ne,prazo_ent_ne,data_proposta,val_proposta,num_ne,data_prev_pgto,status_ne,id_lote)
                       VALUES ('{$_POST[data_rec_ne]}','{$_POST[prazo_ent_ne]}','{$_POST[data_proposta]}','{$_POST[val_proposta]}',
                               '{$_POST[num_ne]}','{$_POST[data_prev_pgto]}','Em cotação','{$_POST[id_lote]}'
                               )";
            if($linha_cod[tipo_licitacao]=="RP"){           
                $sql_2 =
                    "UPDATE lote SET colocacao='Solicitado Parcial'
                    WHERE id_lote='{$_POST[id_lote]}'";
            }
           else{
               $sql_2 =
                    "UPDATE lote SET colocacao='Em expedição'
                    WHERE id_lote='{$_POST[id_lote]}'
           ";}
                               
                               
                               
    $lugar=('lista_licita_tudo.php');
    }
    

//echo $sql;die;
mysql_query($sql) or die("Erro gravando sql!!!");
mysql_query($sql_2);// or die("Erro gravando sql_2!!!");


//require_once "$lugar";


//header mexe com cabeçahos do APACHE, não pode haver HTML antes do HEADER, pois o mesmo pode não funcionar.
//die;
//header mexe com cabeçahos do APACHE, não pode haver HTML antes do HEADER, pois o mesmo pode não funcionar.
//header ("location:precad_licita.php");

        
?>
    <tr>
        <td colspan="2" align="left" bgcolor="#FFFF00" class="A" scope="col">
            OK, Nota de empenho cadastrada com sucesso!
            <input type='button' value='VOLTAR'
               onclick='document.location.href="cad_ne.php?id_cod=<?php echo $_POST[id_cod] ?>&id_lote=<?php echo $_POST[id_lote]?>&id_itens=<?php echo $_POST[id_itens];?>"'>
            <!--<input type='button' value='Listar Notas de Empenho'
               onclick='document.location.href="lista_licita_tudo.php?codigo=<?php echo $_REQUEST[codigo] ?>"'>
            <input type='button' value='Listagem Geral'
               onclick='document.location.href="lista_licita_tudo.php"'>-->
        </td>
        
            
    </tr>
