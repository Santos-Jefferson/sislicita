<?php
//testao se o usuário foi autenticado.
//não pode haver HTML ANTES deste PHP.
session_start();            //abri a sessão
if(!isset($_SESSION[autenticado])){
   echo '<a href="login.php">Efetue seu login para ter acesso ao sitema</a>';
  die;
}
require "cabecalho_reduzido_sem_teste.php";
?>

