<?php
    
    require "conecta.php";
    require "cabecalho_reduzido.php";
    require "cabecalho_precad.php";
        

        //
        //print_r($_GET[apaga]);
        
        //para cada campo do get[apaga]
        foreach($_GET[apaga] as $v) {
            $s = "DELETE FROM precadastro WHERE id=$v";    
            mysql_query($s) or die ("Erro apagando");
        }
        
       require "lista_precad_exc.php";
?>

    <!--<tr>
        <th height="15" align="left" bgcolor="#BBFF00" class="A" scope="col">
            <h5>OK, Pré-cadastro excluído com sucesso!</h5>
            
    </tr>
    -->
