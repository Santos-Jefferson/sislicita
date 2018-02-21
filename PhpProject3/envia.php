<?php

$quebra_linha = "/n";
$destino = "jefferson2004@gmail.com";
$remetente = $email;
$assunto = $titulo;
$mensagem= $texto;

$headers = "Content-Type: text/html; charset=iso-8859-1\n";
$headers.="From:".$rementente."\n";

if(!mail($destino, $assunto, $mensagem, $headers ,"-r".$remetente)){ // Se for Postfix
    $headers .= "Return-Path: " . $remetente . $quebra_linha; // Se "não for Postfix"
    mail($destino, $assunto, $mensagem, $headers );
}


//mail("$destino", "$assunto", "$mensagem","$headers");

?>
<html>
<body>
<center>
Obrigado !!!
<br>
Seu email foi enviado com sucesso !!!
</center>
</body>
</html>
