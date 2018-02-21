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


if(($_POST[tipo_mov]=='Compra - Entrada')or($_POST[tipo_mov]=='Retorno Garantia - Entrada')or($_POST[tipo_mov]=='Troca - Entrada')){

    //Converte o valor passado em REAIS via JavaScript (máscara) no formulário em cad_entrada_prod.php e converte com "." para gravar no BD Mysql
    $valor_conv = str_replace(',','.',str_replace('.','',$_POST[valor_forn_ent]));


    $sql = "SELECT * FROM cad_produto_entrada WHERE num_doc = '{$_POST[num_doc]}' and qtde_ent = '{$_POST[qtde_ent]}' and id_cad_prod = '{$_POST[id_cad_prod]}' and tipo_mov = '{$_POST[tipo_mov]}'";
    $res = mysql_query($sql) or die("Erro seleção");



    if (mysql_num_rows($res) and !isset($_POST[id_cad_prod_ent])){

        require_once "validacao_cad_geral.php";
        die;

     }
        elseif(isset($_POST[id_cad_prod_ent])){
            $sql_ent = "SELECT * from cad_produto WHERE id_cad_prod ='{$_POST[id_cad_prod]}'";
            $sql_res = mysql_query($sql_ent) or die ("erro SELECT baixa estoque");
            $linha_ent = mysql_fetch_assoc($sql_res); 

            $sql_saldo = "SELECT * from cad_produto_entrada WHERE id_cad_prod_ent='{$_POST[id_cad_prod_ent]}'";
            $res_saldo = mysql_query($sql_saldo) or die ("erro SELECT baixa estoque");
            $linha_saldo = mysql_fetch_assoc($res_saldo); 
            $saldo = $linha_saldo[qtde_ent];



            $sql =
            "UPDATE cad_produto_entrada SET forn_prod_ent='{$_POST[forn_prod_ent]}',prod_ent='{$_POST[prod_ent]}',tipo_mov='{$_POST[tipo_mov]}',data_entrada='{$_POST[data_entrada]}',
                                       num_doc='{$_POST[num_doc]}',qtde_ent='{$_POST[qtde_ent]}',valor_forn_ent='$valor_conv'
                                           WHERE id_cad_prod_ent='{$_POST[id_cad_prod_ent]}'";

        //volta para a seleção e alteração
        if(($_POST[tipo_mov]=='Compra - Entrada')or($_POST[tipo_mov]=='Retorno Garantia - Entrada')){                                           
        $saldo_atual = ($linha_ent[qtde_estoque]-$saldo)+($_POST[qtde_ent]);

        $sql_up = "UPDATE cad_produto SET qtde_estoque=$saldo_atual WHERE id_cad_prod='{$_POST[id_cad_prod]}'";
        mysql_query($sql_up) or die("Erro gravando baixa_estoque_itens_det_ne!!!");
        }


        //$lugar=('lista_lote_alt.php');
        mysql_query($sql) or die("Erro gravando grava_cad_entrada_prod!!!");

        $sql_saldo2 = "SELECT * from cad_produto_entrada WHERE id_cad_prod='{$_POST[id_cad_prod]}'";
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
        $media_ent=$valor_ent_total/$qtde_ent_total;

        /*echo $qtde_ent_total."<br>";
        echo $valor_ent_total."<br>";
        echo $media_ent."<br>";
        die;*/

        $sql_up2= "UPDATE cad_produto SET valor_custo_forn=$media_ent WHERE id_cad_prod='{$_POST[id_cad_prod]}'";
        mysql_query($sql_up2) or die("Erro gravando baixa_estoque_itens_det_ne!!!");

    }
        else {

        $sql_ent = "SELECT * from cad_produto WHERE id_cad_prod ='{$_POST[id_cad_prod]}'";
        $sql_res = mysql_query($sql_ent) or die ("erro SELECT baixa estoque");
        $linha_ent = mysql_fetch_assoc($sql_res); 
        
        if(($_POST[tipo_mov]=='Compra - Entrada')or($_POST[tipo_mov]=='Retorno Garantia - Entrada')){                                           
        $saldo_atual2 = $linha_ent[qtde_estoque]+$_POST[qtde_ent];
        $sql_up = "UPDATE cad_produto SET qtde_estoque=$saldo_atual2 WHERE id_cad_prod='{$_POST[id_cad_prod]}'";
        mysql_query($sql_up) or die("Erro gravando baixa_estoque_itens_det_ne!!!"); 
        }
        /*echo $media[qtde_estoque];
        echo $media[valor_custo_forn];
        die;*/
        $total_est = ($linha_ent[qtde_estoque]*$linha_ent[valor_custo_forn]);
        $media_unit = ($linha_ent[qtde_estoque]*$linha_ent[valor_custo_forn])/($linha_ent[qtde_estoque]);
        /*echo $total_est."<br>";
        echo $media_unit."<br>";*/
        //die;

        //atribuir custo médio unitário ao produto que está no estoque
        $total_ent = ($_POST[qtde_ent]*$valor_conv);
        $soma_valor = ($total_est+$total_ent);
        $soma_est = ($linha_ent[qtde_estoque]+$_POST[qtde_ent]);
        /*echo $total_ent."total_ent"."<br>";
        echo $soma_valor."soma_valor"."<br>";
        echo $soma_est."soma_est"."<br>";*/

        $media_final = ($soma_valor/$soma_est);
        //$valor_conv2 = str_replace(',','.',str_replace('.','',$media_final));


        /*echo $media_final."media_final"."<br>";
        echo $valor_conv2."<br>";
        die;*/
        $sql_up2 = "UPDATE cad_produto SET valor_custo_forn=$media_final WHERE id_cad_prod='{$_POST[id_cad_prod]}'";
        mysql_query($sql_up2) or die("Erro gravando baixa_estoque_itens_det_ne!!!");                       

        $sql = "INSERT into cad_produto_entrada (forn_prod_ent,prod_ent,tipo_mov,data_entrada,num_doc,qtde_ent,valor_forn_ent,id_cad_prod)
                           VALUES ('{$_POST[forn_prod_ent]}','{$_POST[prod_ent]}','{$_POST[tipo_mov]}','{$_POST[data_entrada]}','{$_POST[num_doc]}','{$_POST[qtde_ent]}','{$valor_conv}','{$_POST[id_cad_prod]}'
                                   )";

        //$lugar=('lista_licita_tudo.php');

        mysql_query($sql) or die("Erro gravando grava_cad_entrada_prod!!!");

        }

    /*echo $saldo_atual."<br>";
    echo $saldo."<br>";
    echo $linha_ent[qtde_estoque]."<br>";
    echo $_POST[qtde_ent]."<br>";

    die;*/



    //require_once "$lugar";


    //header mexe com cabeçahos do APACHE, não pode haver HTML antes do HEADER, pois o mesmo pode não funcionar.
    //die;
    //header mexe com cabeçahos do APACHE, não pode haver HTML antes do HEADER, pois o mesmo pode não funcionar.
    //header ("location:precad_licita.php");
    if ((!empty($_POST[id_itens_ne]))and(!empty($_POST[num_ne]))and(!empty($_POST[id_ne]))){
        $valor_conv = str_replace(',','.',str_replace('.','',$_POST[valor_forn_ent]));
        
        $sql_baixa = "SELECT * from cad_produto WHERE id_cad_prod ='{$_REQUEST[id_cad_prod]}'";
        $sql_res = mysql_query($sql_baixa) or die ("erro SELECT baixa estoque");
        $linha_baixa = mysql_fetch_assoc($sql_res);

            $saldo_estoque=(($linha_baixa[qtde_estoque])-(-$_POST[qtde_ent]));
            $sql_up = "UPDATE cad_produto SET qtde_estoque=$saldo_estoque WHERE id_cad_prod='{$_REQUEST[id_cad_prod]}'";
            mysql_query($sql_up) or die("Erro gravando baixa_estoque_itens_det_ne!!!");
        

        $sql = "INSERT into cad_produto_baixa (qtde_baixa,desc_prod_baixa,valor_custo_prod,id_cad_prod,id_ne,id_itens_ne)
                       VALUES ('{$_POST[qtde_ent]}','{$_POST[prod_ent]}','-$valor_conv','{$_POST[id_cad_prod]}',
                              '{$_POST[id_ne]}','{$_POST[id_itens_ne]}'
                               )";
        $lugar="cad_itens_ne_baixa.php?id_ne=$_REQUEST[id_ne]&num_ne=$_REQUEST[num_ne]&id_itens_ne=$_REQUEST[id_itens_ne]";
        mysql_query($sql) or die("Erro gravando troca produto - dif estoque e valores!!!");
                              
        }  
        header("location:$lugar");
}
elseif(($_POST[tipo_mov]=='Extravio - Saída')or($_POST[tipo_mov]=='Remessa Garantia - Saída')or($_POST[tipo_mov]=='Venda - Saída')){
     //Converte o valor passado em REAIS via JavaScript (máscara) no formulário em cad_entrada_prod.php e converte com "." para gravar no BD Mysql
    $valor_conv = str_replace(',','.',str_replace('.','',$_POST[valor_forn_ent]));


    $sql = "SELECT * FROM cad_produto_entrada WHERE num_doc = '{$_POST[num_doc]}' and qtde_ent = '{$_POST[qtde_ent]}' and id_cad_prod = '{$_POST[id_cad_prod]}' and qtde_ent = '{$_POST[qtde_ent]}'";
    $res = mysql_query($sql) or die("Erro seleção");



    if (mysql_num_rows($res) and !isset($_POST[id_cad_prod_ent])){

        require_once "validacao_cad_geral.php";
        die;

     }
        elseif(isset($_POST[id_cad_prod_ent])){
            $sql_ent = "SELECT * from cad_produto WHERE id_cad_prod ='{$_POST[id_cad_prod]}'";
            $sql_res = mysql_query($sql_ent) or die ("erro SELECT baixa estoque");
            $linha_ent = mysql_fetch_assoc($sql_res); 

            $sql_saldo = "SELECT * from cad_produto_entrada WHERE id_cad_prod_ent='{$_POST[id_cad_prod_ent]}'";
            $res_saldo = mysql_query($sql_saldo) or die ("erro SELECT baixa estoque");
            $linha_saldo = mysql_fetch_assoc($res_saldo); 
            $saldo = $linha_saldo[qtde_ent];



            $sql =
            "UPDATE cad_produto_entrada SET forn_prod_ent='{$_POST[forn_prod_ent]}',prod_ent='{$_POST[prod_ent]}',tipo_mov='{$_POST[tipo_mov]}',data_entrada='{$_POST[data_entrada]}',
                                       num_doc='{$_POST[num_doc]}',qtde_ent='{$_POST[qtde_ent]}',valor_forn_ent='$valor_conv'
                                           WHERE id_cad_prod_ent='{$_POST[id_cad_prod_ent]}'";

        //volta para a seleção e alteração
        $saldo_atual = ($linha_ent[qtde_estoque]+$saldo)-($_POST[qtde_ent]);

        $sql_up = "UPDATE cad_produto SET qtde_estoque=$saldo_atual WHERE id_cad_prod='{$_POST[id_cad_prod]}'";
        mysql_query($sql_up) or die("Erro gravando baixa_estoque_itens_det_ne!!!");


        //$lugar=('lista_lote_alt.php');
        mysql_query($sql) or die("Erro gravando grava_cad_entrada_prod!!!");

        $sql_saldo2 = "SELECT * from cad_produto_entrada WHERE id_cad_prod='{$_POST[id_cad_prod]}'";
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
        $media_ent=$valor_ent_total/$qtde_ent_total;

        /*echo $qtde_ent_total."<br>";
        echo $valor_ent_total."<br>";
        echo $media_ent."<br>";
        die;*/

        $sql_up2= "UPDATE cad_produto SET valor_custo_forn=$media_ent WHERE id_cad_prod='{$_POST[id_cad_prod]}'";
        mysql_query($sql_up2) or die("Erro gravando baixa_estoque_itens_det_ne!!!");

    }
        else {

        $sql_ent = "SELECT * from cad_produto WHERE id_cad_prod ='{$_POST[id_cad_prod]}'";
        $sql_res = mysql_query($sql_ent) or die ("erro SELECT baixa estoque");
        $linha_ent = mysql_fetch_assoc($sql_res); 

        $saldo_atual2 = $linha_ent[qtde_estoque]-$_POST[qtde_ent];
        $sql_up = "UPDATE cad_produto SET qtde_estoque=$saldo_atual2 WHERE id_cad_prod='{$_POST[id_cad_prod]}'";
        mysql_query($sql_up) or die("Erro gravando baixa_estoque_itens_det_ne!!!"); 

        /*echo $media[qtde_estoque];
        echo $media[valor_custo_forn];
        die;*/
        $total_est = ($linha_ent[qtde_estoque]*$linha_ent[valor_custo_forn]);
        $media_unit = ($linha_ent[qtde_estoque]*$linha_ent[valor_custo_forn])/($linha_ent[qtde_estoque]);
        /*echo $total_est."<br>";
        echo $media_unit."<br>";*/
        //die;

        //atribuir custo médio unitário ao produto que está no estoque
        $total_ent = ($_POST[qtde_ent]*$valor_conv);
        $soma_valor = ($total_est+$total_ent);
        $soma_est = ($linha_ent[qtde_estoque]+$_POST[qtde_ent]);
        /*echo $total_ent."total_ent"."<br>";
        echo $soma_valor."soma_valor"."<br>";
        echo $soma_est."soma_est"."<br>";*/

        $media_final = ($soma_valor/$soma_est);
        //$valor_conv2 = str_replace(',','.',str_replace('.','',$media_final));


        /*echo $media_final."media_final"."<br>";
        echo $valor_conv2."<br>";
        die;*/
        $sql_up2 = "UPDATE cad_produto SET valor_custo_forn=$media_final WHERE id_cad_prod='{$_POST[id_cad_prod]}'";
        mysql_query($sql_up2) or die("Erro gravando baixa_estoque_itens_det_ne!!!");                       

        $sql = "INSERT into cad_produto_entrada (forn_prod_ent,prod_ent,tipo_mov,data_entrada,num_doc,qtde_ent,valor_forn_ent,id_cad_prod)
                           VALUES ('{$_POST[forn_prod_ent]}','{$_POST[prod_ent]}','{$_POST[tipo_mov]}','{$_POST[data_entrada]}','{$_POST[num_doc]}','{$_POST[qtde_ent]}','{$valor_conv}','{$_POST[id_cad_prod]}'
                                   )";

        $lugar=('lista_licita_tudo.php');

        mysql_query($sql) or die("Erro gravando grava_cad_entrada_prod!!!");

        }

    /*echo $saldo_atual."<br>";
    echo $saldo."<br>";
    echo $linha_ent[qtde_estoque]."<br>";
    echo $_POST[qtde_ent]."<br>";

    die;*/



    //require_once "$lugar";


    //header mexe com cabeçahos do APACHE, não pode haver HTML antes do HEADER, pois o mesmo pode não funcionar.
    //die;
    //header mexe com cabeçahos do APACHE, não pode haver HTML antes do HEADER, pois o mesmo pode não funcionar.
    //header ("location:precad_licita.php");
    
}

?>
    <tr>
        <td colspan="2" align="left" bgcolor="#FFFF00" class="A" scope="col">
            OK, ENTRADA/SAÍDA DE PRODUTOS cadastrado com sucesso!
            <input type='button' value='Novo'
               onclick='document.location.href="cad_entrada_prod.php"'>
            <input type='button' value='Listar'
               onclick='document.location.href="lista_cad_entrada_prod_tudo.php"'>
            </td>
        
            
    </tr>
