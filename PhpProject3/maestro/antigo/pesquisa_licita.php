<?php
require "conecta.php";
require_once "cabecalho.php";

// se o GET[order] for vazio, então será preenchido com um valor padrão
if(empty($_GET[order])) $_GET[order] = 'codigo';
    
$sql = "SELECT * FROM precadastro WHERE codigo LIKE '%{$_GET[codigo]}%' ORDER BY {$_GET[order]}";

$res = mysql_query($sql) or die("Erro seleção");

$v = 0; //conterá a somatória dos valores
$c = 0; //total de registros

//pega a primeira linha do resultado
$linha = mysql_fetch_assoc($res);

require_once "rel_licita.php";
?>

<form action="apaga_licita.php">
    <table width="1020" align="center" class="A" border="1" cellpadding="2" cellspacing="0">    
        <tr>
            <th><a href="pesquisa_licita.php?order=licitante">Licitante</a></th>
            <th><a href="pesquisa_licita.php?order=codigo">Cód. Licitação</a></th>
            <th><a href="pesquisa_licita.php?order=data">Data / Hora</a></th>
            <th align="center">Excluir</th>
        </tr>
        
<?php

//enquanto houver linha
while($linha){
    $c++;                   //incrementa o total de linhas;
    $v += $linha[valor];    //incrementa a $v o campo valor

    //mostra a linha
    //$linha agora é um vetor com as posições:
    //$linha[cod], $linha[nome], $linha[valor], etc...
?>

    <tr>
        <td>&nbsp;<?php echo $linha[licitante]          ?></td>
        <td>&nbsp;<?php echo $linha[codigo]         ?></td>
        <td align="center">&nbsp;<?php echo $linha[data]  ?></td>
        <td align="center"><input type="checkbox" name="apaga[]" value="<?php echo $linha[id]?>"</td>
    </tr>
    
<?php
    //pega a próxima linha
    $linha = mysql_fetch_assoc($res);
}
echo '<br>';
//require_once "rel_licita.php";
?>
    <tr>
        <td colspan="3">Total de registros: <?php echo $c ?></td><br>
        <td align="center"><input type="submit" value="Apagar"></td>
    </tr><br>
</form>
