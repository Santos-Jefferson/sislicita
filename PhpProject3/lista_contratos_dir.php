<?php

$path = $uploaddir;
$diretorio = dir($path);


//echo "Lista de Arquivos do diretório '<strong>".$path."</strong>':<br />";

while($arquivo = $diretorio -> read()){
    echo "<a href='".$path.$arquivo."' target='_blank'>".$arquivo."</a>";
    
}
$diretorio -> close();

?>

