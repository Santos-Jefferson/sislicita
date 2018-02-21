<?php
require "conecta.php";

if(empty($_GET[order])) $_GET[order] = 'codigo';

$sql = "SELECT * FROM precadastro ORDER BY {$_GET[order]}";

$res = mysql_query($sql) or die("Erro seleção");

$v = 0; //conterá a somatória dos valores
$c = 0; //total de registros

//pega a primeira linha do resultado
$linha = mysql_fetch_assoc($res);
?>
<head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
    </head>
    <form action="apaga_licita.php">
<table border="1" cellpadding="0" cellspacing="0">
    <tr>
        <th><a href="lista_aluno.php?order=cod">Código</a></th>
        <th><a href="lista_aluno.php?order=nome">Nome</a></th>
        <th><a href="lista_aluno.php?order=data_inicio">Data Início</a></th>
        <th><a href="lista_aluno.php?order=idade">Idade</a></th>
        <th><a href="lista_aluno.php?order=valor">Valor</a></th>
        <th>&nbsp</th>
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
        <td>&nbsp;<?php echo $linha[cod]                                    ?></td>
        <td>&nbsp;<?php echo $linha[nome]                                   ?></td>
        <td>&nbsp;<?php echo $linha[data_inicio]                            ?></td>
        <td>&nbsp;<?php echo $linha[idade]                                  ?></td>
        <td align="right">&nbsp;<?php echo $linha[valor]                    ?></td>
        <!-- para delete múltiplo com checkbox, necessário inserir em nome uma matriz HTML, representada por neste caso
        apaga[]-->
        <td><input type="checkbox" name="apaga[]" value="<?php echo $linha[cod]    ?>"</td>
        
    </tr>
    
    <?php
    //pega a próxima linha
    $linha = mysql_fetch_assoc($res);
}
?>
    
    <tr>
        <td colspan="4">Total de registros: <?php echo $c ?></td>
        <td align="right"> <?php echo $v ?></td>
    </tr>
</table><br>
    <input type="submit" value="Apagar Selecionados">
    </form>
    
    <input type='button' value='Menu'
               onclick='document.location.href="menu.php"'><br><br>