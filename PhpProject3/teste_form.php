<?
if($valor <> ""){
$cont = count($valor);
for($i=0; $i<$cont; $i++){
    if($valor[$i] == "") continue;
        echo "INSERT INTO tabela (nome, valor) VALUES ('$nome[$i]','$valor[$i]');<br>";
    }
}
?>

<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<form name="form1" method="post" action="<? echo $PHP_SELF;?>">
teste1
<input type="text" name="valor[]">
<input type="hidden" name="nome[]" value="teste1">
<br>
teste2
<input type="text" name="valor[]">
<input type="hidden" name="nome[]" value="teste2">
<br>
teste3
<input type="text" name="valor[]">
<input type="hidden" name="nome[]" value="teste3">
<br>
<input type="submit" name="Submit" value="Enviar">
<br>
</form>

</body>