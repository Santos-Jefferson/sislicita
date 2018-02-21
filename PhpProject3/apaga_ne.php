<?php
    
    require "conecta.php";
    require "cabecalho_reduzido.php";
    //require "cabecalho_lote.php";
        

        //
        //print_r($_REQUEST);
        
        
        //para cada campo do get[apaga]
        //foreach($_GET[apagar] as $v) {
            $s = "DELETE FROM notaempenho WHERE id_ne={$_GET[apagar]}";    
            mysql_query($s) or die ("Erro apagando");
        
       //require "lista_precad_exc.php";
?>

    <tr>
        <td colspan="2" align="left" bgcolor="#FFFF00" class="A" scope="col">
            ITEM selecionado excluído com sucesso!
            <input type='button' value='VOLTAR'
               onclick='document.location.href="cad_ne.php?id_cod=<?php echo $_GET[id_cod];?>&id_lote=<?php echo $_GET[id_lote];?>&id_itens=<?php echo $_REQUEST[id_itens];?>"'>
        </td>
</tr>
