<?php
    
    require "cabecalho_reduzido.php";
    require "conecta.php";
        

        //
        //print_r($_GET[apaga]);
        
        //para cada campo do get[apaga]
        foreach($_GET[apaga] as $v) {
            $s = "DELETE FROM lote WHERE id_lote=$v";    
            mysql_query($s) or die ("Erro apagando");
        }
        
        require_once "lista_lote_exc.php";
?>        



<!--    <tr>
        <th height="15" align="left" bgcolor="#AAFF00" class="A" scope="col">
            <h5>OK, Cadastro excluído com sucesso!</h5>
    </tr>

-->
