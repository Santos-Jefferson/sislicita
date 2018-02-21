<?php

if($acao == "criar"){
    $pasta = "$_POST[codigo]-$_POST[orgao]-$_POST[pregao]";
    mkdir ("certidoes/$pasta", 0770 );   // aqui e o diretorio aonde será criado tipo home/public-html/
        echo "Pasta <b>$pasta </b> criada com sucesso!!";
}
?>