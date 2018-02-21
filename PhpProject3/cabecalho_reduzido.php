
<?php
//testao se o usuário foi autenticado.
//não pode haver HTML ANTES deste PHP.
session_start();            //abri a sessão
//print_r ($_SESSION[autenticado]);
//die;
if(!isset($_SESSION[autenticado])){
   echo '<a href="login.php">Efetue seu login para ter acesso ao sitema</a>';
  die;
}
//$_SESSION[usuario] = $usuario;
//print_r($_SESSION);
//die;
$usuario = $_SESSION[usuario];
$senha = $_SESSION[senha];
require "cabecalho_reduzido_sem_teste.php";
include "css.php";
?>