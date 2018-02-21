<?php
    
    require "cabecalho.php";
    require "conecta.php";
        

        //
        //print_r($_GET[apaga]);
        
        //para cada campo do get[apaga]
        foreach($_GET[apaga] as $v) {
            $s = "DELETE FROM precadastro WHERE id=$v";    
            mysql_query($s) or die ("Erro apagando");
        }
        
        //header("location:pesquisa_licita.php");
?>

    <tr>
        <th height="15" align="left" bgcolor="#BBFF00" class="A" scope="col">
            <h5>OK, Pré-cadastro excluído com sucesso!</h5>
            
    </tr>
