<?php
$file = fopen ("imagens/logo.jpg", "r");
if (!$file) {
    echo "<p>Incapaz de abrir arquivo remoto.\n";
    exit;
}
while (!feof ($file)) {
    $line = fgets ($file, 1024);
    /* Isso só funciona se o título e suas tags estiverem na mesma linha */
    if (eregi ("<title>(.*)</title>", $line, $out)) {
        $title = $out[1];
        break;
    }
}
fclose($file);
?>