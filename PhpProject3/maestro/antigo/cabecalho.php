<?php
//testao se o usuário foi autenticado.
//não pode haver HTML ANTES deste PHP.
session_start();            //abri a sessão
if(!isset($_SESSION[autenticado])){
    echo '<a href="login.php">Efetue seu login para ter acesso ao sitema</a>';
    die;
}
require_once "cabecalho_reduzido.php";
?>

    <tr>
        <th colspan="2" height="38" align="left" class="A" scope="col">
            <input type='button' value='Pré-cadastro'
               onclick='document.location.href="menu_precad.php"'><br><br>
            <input type='button' value='Cadastro completo'
               onclick='document.location.href="menu_cad.php"'>
        
       </tr>
    



