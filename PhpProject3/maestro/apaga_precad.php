<?php
    
    require "conecta.php";
    require "cabecalho_reduzido.php";
    //require "cabecalho_precad.php";
        

        //
        //print_r($_REQUEST);
        
        
        //para cada campo do get[apaga]
        //foreach($_GET[apagar] as $v) {
            $s = "DELETE FROM precadastro WHERE codigo={$_GET[apagar]}";    
            mysql_query($s) or die ("Erro apagando");
        
       //require "lista_precad_exc.php";
?>

    <tr>
        <td colspan="2" align="left" bgcolor="#FFFF00" class="A" scope="col">
            Pré-licitação excluída com sucesso!
            <input type='button' value='Listagem'
               onclick='document.location.href="lista_precad_tudo.php"'>
        </td>
    </tr>