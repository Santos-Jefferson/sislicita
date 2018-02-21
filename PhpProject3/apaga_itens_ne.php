<?php
    
    require "conecta.php";
    require "cabecalho_reduzido.php";
    //require "cabecalho_lote.php";
        

        //
        //print_r($_REQUEST);
        
        
        //para cada campo do get[apaga]
        //foreach($_GET[apagar] as $v) {
            $s = "DELETE FROM itens_ne WHERE id_itens_ne={$_GET[apagar]}";    
            mysql_query($s) or die ("Erro apagando");
        
       //require "lista_precad_exc.php";
?>

    <tr>
        <td colspan="2" align="left" bgcolor="#FFFF00" class="A" scope="col">
            ITEM selecionado excluído com sucesso!
            <input type='button' value='Voltar' onclick='document.location.href="relatorio_ne_tudo.php?id_lote=<?php echo $_GET[id_lote];?>&id_cod=<?php echo $_GET[id_cod];?>&id_ne=<?php echo $_GET[id_ne]; ?>&num_ne=<?php echo $_GET[num_ne]; ?>"'>
        </td>
    </tr>
