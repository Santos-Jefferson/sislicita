<?php
    
    require "conecta.php";
    require "cabecalho_reduzido.php";
    //require "cabecalho_lote.php";
    /*print_r ($_REQUEST);
    die;
    */
    
    $sql = "SELECT * from cad_produto WHERE id_cad_prod ='{$_GET[id_cad_prod]}'";
    $res = mysql_query($sql) or die ("erro SELECT PRODUTO estoque");
    $linha = mysql_fetch_assoc($res);
    
    $sql_baixa = "SELECT * from cad_produto_baixa WHERE id_cad_prod_baixa ='{$_GET[apagar]}'";
    $sql_res = mysql_query($sql_baixa) or die ("erro SELECT baixa estoque");
    $linha_baixa = mysql_fetch_assoc($sql_res);
    
    //$saldo_estoque=0;
    /*$saldo_baixa=($linha_baixa[qtde_baixa]-$linha_baixa[qtde_baixa]);
    $sql_up = "UPDATE cad_produto_baixa SET qtde_baixa=$saldo_baixa WHERE id_cad_prod='{$_GET[id_cad_prod]}'";
    mysql_query($sql_up) or die("Erro gravando baixa_estoque_baixa!!!");
    */
    
    /*//Repetindo a leitura do linha_baixa com o estoque zerado
    $sql_baixa = "SELECT * from cad_produto_baixa WHERE id_cad_prod ='{$_GET[id_cad_prod]}'";
    $sql_res = mysql_query($sql_baixa) or die ("erro SELECT baixa estoque");
    $linha_baixa = mysql_fetch_assoc($sql_res);
    */
    /*echo $linha[qtde_estoque];
    echo $linha_baixa[qtde_baixa];
    die;
    */
    
    if ($linha_baixa[valor_custo_prod]<0){
        $saldo_estoque=($linha[qtde_estoque]-$linha_baixa[qtde_baixa]);
    }
        else{
        $saldo_estoque=($linha[qtde_estoque]+$linha_baixa[qtde_baixa]);
        }
    $sql_up = "UPDATE cad_produto SET qtde_estoque=$saldo_estoque WHERE id_cad_prod='{$_GET[id_cad_prod]}'";
    mysql_query($sql_up) or die("Erro gravando baixa_estoque_itens_det_ne!!!");
        

        //
        //print_r($_REQUEST);
        
        
        //para cada campo do get[apaga]
        //foreach($_GET[apagar] as $v) {
            $s = "DELETE FROM cad_produto_baixa WHERE id_cad_prod_baixa={$_GET[apagar]}";    
            mysql_query($s) or die ("Erro apagando");
        
       //require "lista_precad_exc.php";
?>

    <tr>
        <td colspan="2" align="left" bgcolor="#FFFF00" class="A" scope="col">
            ITEM selecionado excluído com sucesso!
            <input type='button' value='Voltar' onclick='document.location.href="cad_itens_ne_baixa.php?id_ne=<?php echo $_GET[id_ne];?>&num_ne=<?php echo $_REQUEST[num_ne];?>&id_itens_ne=<?php echo $_GET[id_itens_ne]; ?>"'>
        </td>
    </tr>
