<?php
session_start();            //abri a sessão
session_destroy();      //destroi uma possível sessão existente
//if(!isset($_SESSION[autenticado])){
//    require_once("login.php");
//    die;
//}

require ("login.php")

?>