<?php
        require "conecta.php";
        

        //
        //print_r($_GET[apaga]);
        
        //para cada campo do get[apaga]
        foreach($_GET[apaga] as $v) {
            $s = "DELETE FROM precadastro WHERE cod=$v";    
            mysql_query($s) or die ("Erro apagando");
        }
        
        header("location:pesquisa_licita.php");
?>
