<?php
    include "css.php";
    require "conecta.php";
    
    //require "cabecalho_lote.php";
        

        //
        //print_r($_REQUEST);
        
        
        //para cada campo do get[apaga]
        //foreach($_GET[apagar] as $v) {
            $s = "DELETE FROM subitens WHERE id_subitem={$_GET[apagar]}";    
            mysql_query($s) or die ("Erro apagando");
        
       //require "lista_precad_exc.php";
?>
<table>
    <tr>
        <td colspan="2" align="left" bgcolor="#FFFF00" class="A" scope="col">
            SUB-ITEM selecionado excluído com sucesso!
            <input type='button' value='Voltar'
               onclick='document.location.href="cad_itens_det.php?id_item=<?php echo $_GET[id_item]; ?>">
        </td>
    </tr>
</table>