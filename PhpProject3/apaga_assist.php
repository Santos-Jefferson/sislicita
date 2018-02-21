<?php
    
    require "conecta.php";
    require "cabecalho_reduzido.php";
    //require "cabecalho_lote.php";
        

        //
        //print_r($_REQUEST);
        
        
        //para cada campo do get[apaga]
        //foreach($_GET[apagar] as $v) {
            $s = "DELETE FROM cad_assistencias WHERE id_cad_assist={$_GET[apagar]}";    
            mysql_query($s) or die ("Erro apagando");
        
       //require "lista_precad_exc.php";
?>

    <tr>
        <td colspan="2" align="left" bgcolor="#FFFF00" class="A" scope="col">
            ASSISTÊNCIA selecionada excluída com sucesso!
            <input type='button' value='Voltar' onclick='document.location.href="lista_cad_assistencias_tudo.php"'>
        </td>
    </tr>
