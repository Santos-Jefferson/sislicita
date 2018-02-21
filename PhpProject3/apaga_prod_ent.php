<?php
    
    require "conecta.php";
    require "cabecalho_reduzido.php";
    //require "cabecalho_lote.php";
    //print_r ($_REQUEST);die;
    
     $sql_ent = "SELECT * from cad_produto WHERE id_cad_prod ='{$_REQUEST[id_cad_prod]}'";
        $sql_res = mysql_query($sql_ent) or die ("erro SELECT baixa estoque");
        $linha_ent = mysql_fetch_assoc($sql_res); 
        
        $sql_saldo = "SELECT * from cad_produto_entrada WHERE id_cad_prod_ent ='{$_REQUEST[id_cad_prod_ent]}'";
        $res_saldo = mysql_query($sql_saldo) or die ("erro SELECT baixa estoque");
        $linha_saldo = mysql_fetch_assoc($res_saldo); 
        
        if (($linha_saldo[tipo_mov]=='Extravio - Saída')or($linha_saldo[tipo_mov]=='Remessa Garantia - Saída')or($linha_saldo[tipo_mov]=='Venda - Saída')){
        $saldo_atual = $linha_ent[qtde_estoque]+$linha_saldo[qtde_ent];
        }
        else{
            $saldo_atual = $linha_ent[qtde_estoque]-$linha_saldo[qtde_ent];
            }
        
        //echo $saldo_atual;
    
    $sql_up = "UPDATE cad_produto SET qtde_estoque='{$saldo_atual}' WHERE id_cad_prod='{$_REQUEST[id_cad_prod]}'";
    mysql_query($sql_up) or die("Erro gravando baixa_estoque_itens_det_ne!!!");
    
    
    //echo $sql_up;die;    

        //
        //print_r($_REQUEST);
        
        
        //para cada campo do get[apaga]
        //foreach($_GET[apagar] as $v) {
            $s = "DELETE FROM cad_produto_entrada WHERE id_cad_prod_ent={$_GET[apagar]}";    
            mysql_query($s) or die ("Erro apagando");
            
            $sql_saldo2 = "SELECT * from cad_produto_entrada WHERE id_cad_prod='{$_REQUEST[id_cad_prod]}'";
    $res_saldo2 = mysql_query($sql_saldo2) or die ("erro SELECT baixa estoque");
    $entradas = mysql_fetch_assoc($res_saldo2); 
    
    while($entradas){
        
        /*echo $entradas[qtde_ent]."entradas[qtde_ent]"."<br>";
        echo $entradas[valor_forn_ent]."entradas[valor_forn_ent]"."<br>";*/
        $qtde_ent += $entradas[qtde_ent];
        $valor_ent += ($entradas[qtde_ent]*$entradas[valor_forn_ent]);
        $entradas = mysql_fetch_assoc($res_saldo2);
        }
    
    $qtde_ent_total = $qtde_ent;
    $valor_ent_total = $valor_ent;
    
    if(($qtde_ent_total==0) and ($valor_ent_total ==0)){
        $media_ent=0;
    }
       else{
    
    $media_ent=$valor_ent_total/$qtde_ent_total;
       }
    /*echo $qtde_ent_total."<br>";
    echo $valor_ent_total."<br>";
    echo $media_ent."<br>";
    die;*/
    
    $sql_up2= "UPDATE cad_produto SET valor_custo_forn=$media_ent WHERE id_cad_prod='{$_REQUEST[id_cad_prod]}'";
    mysql_query($sql_up2) or die("Erro gravando baixa_estoque_itens_det_ne!!!");
        
       //require "lista_precad_exc.php";
?>

    <tr>
        <td colspan="2" align="left" bgcolor="#FFFF00" class="A" scope="col">
            ENTRADA DO PRODUTO selecionado excluído com sucesso!
            <input type='button' value='Voltar' onclick='document.location.href="lista_cad_entrada_prod_tudo.php"'>
        </td>
    </tr>
