<?php

$host = "localhost";
$db = "maestro";
$user = "root";
$pw = "M@35t4010";

mysql_connect($host,$user,$pw) or die("Não conectou");
mysql_select_db("$db") or die ("Erro selecionando banco");
//include "lib_geral_sc.php";
?>
