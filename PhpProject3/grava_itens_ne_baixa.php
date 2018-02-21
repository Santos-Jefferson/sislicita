<?php

require "cabecalho_reduzido.php";
require "conecta.php";
/*print_r ($_REQUEST);
die;*/
$sql_baixa = "SELECT * from cad_produto WHERE id_cad_prod ='{$_POST[id_cad_prod]}'";
$sql_res = mysql_query($sql_baixa) or die ("erro SELECT baixa estoque");
$linha_baixa = mysql_fetch_assoc($sql_res);

if(($_POST[qtde_baixa])>($linha_baixa[qtde_estoque])){
    $desc_prod_estoque=$linha_baixa[desc_prod]." "."PRODUTO SEM ESTOQUE - VERIFICAR";
    echo "<tr><td colspan='5' bgcolor='red' class='A'><b>$desc_prod_estoque";
    echo "<input type='button' value='VOLTAR PARA BAIXA' onclick=document.location.href='cad_itens_ne_baixa.php?id_ne=$_POST[id_ne]&id_itens_ne=$_POST[id_itens_ne]&num_ne=$_POST[num_ne]'>";
    echo "</td></tr>";
    
    //mysql_query($sql_up) or die("Erro gravando escrevendo_desc_prod - SEM ESTOQUE!!!"); 
    die;
}
else{
    $saldo_est=$linha_baixa[qtde_estoque]-$_POST[qtde_baixa];
    $sql_up = "UPDATE cad_produto SET qtde_estoque=$saldo_est WHERE id_cad_prod='{$_POST[id_cad_prod]}'";
    mysql_query($sql_up) or die("Erro gravando baixa_estoque_itens_det_ne!!!");



    if(isset($_POST[id_cad_prod_baixa])){
        $sql =
        "UPDATE cad_produto_baixa SET qtde_baixa='{$_POST[qtde_baixa]}',desc_prod_baixa='{$_POST[desc_prod_baixa]}',
            valor_custo_baixa='{$_POST[valor_custo_baixa]}',id_ne='{$_POST[id_ne]}',id_itens_ne='{$_REQUEST[id_itens_ne]}'
                WHERE id_cad_prod_baixa='{$_POST[id_cad_prod_baixa]}'
            ";
            
    //volta para a seleção e alteração
$lugar="cad_itens_ne_baixa.php?id_ne=$_REQUEST[id_ne]";
}
    else {
    $sql = "INSERT into cad_produto_baixa (qtde_baixa,desc_prod_baixa,valor_custo_prod,id_cad_prod,id_ne,id_itens_ne)
                       VALUES ('{$_POST[qtde_baixa]}','{$_POST[desc_prod_baixa]}','{$linha_baixa[valor_custo_forn]}','{$_POST[id_cad_prod]}',
                              '{$_POST[id_ne]}','{$_POST[id_itens_ne]}'
                               )";
    $lugar="cad_itens_ne_baixa.php?id_ne=$_REQUEST[id_ne]&num_ne=$_REQUEST[num_ne]&id_itens_ne=$_POST[id_itens_ne]";
    }
}

mysql_query($sql) or die("Erro gravando baixa itens ne!!!");
header("location:$lugar");
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
                       onclick='document.location.href="cad_.php"'>
                    <input type='button' value='Listar'
                       onclick='document.location.href="lista_cad_fornecedor_tudo.php?codigo=<?php echo $_REQUEST[codigo] ?>"'>
                    </td>


            </tr>