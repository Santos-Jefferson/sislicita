<?php
require "conecta.php";
require_once "cabecalho_reduzido.php";
require_once "cabecalho_lote.php";

// se o GET[order] for vazio, então será preenchido com um valor padrão
if(empty($_GET[order])) $_GET[order] = 'data_hora';
    
$sql = "SELECT * FROM cadastro WHERE codigo LIKE '%{$_GET[codigo]}%' ORDER BY {$_GET[order]}";

$res = mysql_query($sql) or die("Erro seleção");

$v = 0; //conterá a somatória dos valores
$c = 0; //total de registros

//pega a primeira linha do resultado
$linha = mysql_fetch_assoc($res);

//Declarado aqui as variáveis que irão compor as colunas para utilizar na hora 
//do pregão (criado as fórmulas para adicionar ao banco)



require_once "pes_rapida_cad_alt.php";
?>

<form action="apaga_cad.php">
<?php

require_once "tab_cab_lotes_alt.php"

?>
        
<?php

//enquanto houver linha
while($linha){
    $c++;                   //incrementa o total de linhas;
    $v += $linha[valor];    //incrementa a $v o campo valor

    //mostra a linha
    //$linha agora é um vetor com as posições:
    //$linha[cod], $linha[nome], $linha[valor], etc...

//require "var_formulas.php"
    
    
    
require "tab_cont_lotes_alt.php";

    //pega a próxima linha
    $linha = mysql_fetch_assoc($res);
}
echo '<br>';
//require_once "rel_licita.php";
?>
    <tr>
        <td colspan="6">Total de registros: <?php echo $c ?></td><br>
        <td align="center"><input type="submit" value="Alterar"></td>
    </tr><br>
</form>
