<?php

require "conecta.php";


//print_r ($_REQUEST);
//die;
// comando para testar variáveis que vem do formulário
//print_r($_POST[id_cadastro]);die;
/*echo $sql = "UPDATE cadastro SET licitante='{$_POST[licitante]}',
            data_hora='{$_POST[data_hora]}', codigo='{$_POST[codigo]}',
            lote='{$_POST[lote]}',item='{$_POST[item]}',qtde='{$_POST[qtde]}',
            produto='{$_POST[produto]}',valor_unit_custo='{$_POST[valor_unit_custo]}',
            forn='{$_POST[forn]}',valor_frete='{$_POST[valor_frete]}',
            porcentagem_lucro='{$_POST[porcentagem_lucro]}' WHERE id_cadastro='{$_POST[id_cadastro]}'
            }";*/

//se é um alterar cadastro, utiliza a instrução UPDATE, se for cadastro novo, INSERT.
        //isset = existe ou não existe (se existe post[cod], então faz update. se não existe, faz cadastro novo
$sql = "SELECT * FROM subitens2 where id_item = {$_POST[id_item]}"; //{$_POST[qtde_si]}"; //WHERE sub_itens = {$_POST[id_item]}";
$res = mysql_query($sql) or die("Erro_seleção_grava_itens_det2");

//if (mysql_num_rows($res) and !isset($_POST[id_subitem])){
    
   // require_once "validacao_cad_itens_det.php";
    //die;
   
 //}
    if(isset($_POST[id_subitem])){
        $sql2 = "UPDATE subitens2 SET    marca_si='{$_POST[marca_si]}',
                                        modelo_si='{$_POST[modelo_si]}',
                                        qtde_si='{$_POST[qtde_si]}',
                                        nome_subitem='{$_POST[nome_subitem]}',
                                        vunitcusto_si='{$_POST[vunitcusto_si]}',
                                        forn_si='{$_POST[forn_si]}',
                                        ro_si='{$_POST[ro_si]}',
                                        id_item='{$_POST[id_item]}'
                WHERE id_subitem='{$_POST[id_subitem]}'
            ";
                $lugar="cad_itens_det2.php?id_item=$_POST[id_item]";
         
            
    }
    else {
    $sql2 = "INSERT into subitens2 (qtde_si,marca_si,modelo_si,nome_subitem,vunitcusto_si,forn_si,ro_si,id_item)
                       VALUES ('{$_POST[qtde_si]}','{$_POST[marca_si]}',
                               '{$_POST[modelo_si]}','{$_POST[nome_subitem]}',
                               '{$_POST[vunitcusto_si]}',
                               '{$_POST[forn_si]}','{$_POST[ro_si]}','{$_POST[id_item]}'
                               )";
                               
    $lugar="cad_itens_det2.php?id_item=$_POST[id_item]";
    }

//echo $sql;die;
mysql_query($sql2) or die("Erro gravando det2!!!");

//require_once ($lugar);


//header mexe com cabeçahos do APACHE, não pode haver HTML antes do HEADER, pois o mesmo pode não funcionar.
//die;
//header mexe com cabeçahos do APACHE, não pode haver HTML antes do HEADER, pois o mesmo pode não funcionar.
header ("location:$lugar");

        
?>
    <!--<tr>
        <td colspan="2" align="left" bgcolor="#FFFF00" class="A" scope="col">
            <?php
                if (isset($_POST[id_subitem])){
                    echo "OK, SUB-ITEM alterado com sucesso!";
                }   
                elseif (!isset($_POST[id_subitem])){
                    echo "OK, SUB-ITEM adicionado com sucesso!";
                }
                ?>
            <!--<input type='button' value='Voltar'
               onclick='document.location.href="cad_itens.php?id_lote=<?php //echo $_POST[id_lote]; ?>&lote=<?php //echo $_POST[lote]; ?>&codigo=<?php //echo $_POST[codigo]; ?>"'>-->
            <input type='button' value='Novo SUB-ITEM'
               onclick='document.location.href="cad_itens_det.php?id_item=<?php echo $_POST[id_item]; ?>"'>
            
        </td>
        
            
    </tr>