<?php
require "conecta.php";
require_once "cabecalho.php";

// se o GET[order] for vazio, então será preenchido com um valor padrão
if(empty($_GET[order])) $_GET[order] = 'data_hora';
    
$sql = "SELECT * FROM cadastro WHERE codigo LIKE '%{$_GET[codigo]}%' ORDER BY {$_GET[order]}";

$res = mysql_query($sql) or die("Erro seleção");

$v = 0; //conterá a somatória dos valores
$c = 0; //total de registros

//pega a primeira linha do resultado
$linha = mysql_fetch_assoc($res);

require_once "pesquisa_cad.php";
?>

<form action="apaga_cad.php">
    <table width="1020" align="center" class="A" border="1" cellpadding="2" cellspacing="0">    
        <tr>
            <th><a href="lista_cad.php?order=licitante">Licitante</a></th>
            <th><a href="lista_cad.php?order=data_hora">Data/Hora</a></th>
            <th><a href="lista_cad.php?order=codigo">Código</a></th>
            <th>Lote</th>
            <th>Item</th>
            <th>Qtde</th>
            <th>Produto</th>
            <th>V. Unit. Custo</th>
            <th>V. Tot. Custo</th>
            <th>Fornecedor</th>
            <th>Valor frete</th>
            <th>Imposto</th>
            <th>Custo Aprox.</th>
            <th>Lucro Liq.</th>
            <th>V. Min/Lote</th>
            <th>V. Min/Item</th>
            <th>% de Lucro</th>
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
        <td>&nbsp;<?php echo $linha[licitante]                          ?></td>
        <td>&nbsp;<?php echo $linha[data_hora]                          ?></td>
        <td>&nbsp;<?php echo $linha[codigo]                             ?></td>
        <td>&nbsp;<?php echo $linha[lote]                               ?></td>
        <td>&nbsp;<?php echo $linha[item]                               ?></td>
        <td>&nbsp;<?php echo $linha[qtde]                               ?></td>
        <td>&nbsp;<?php echo $linha[produto]                            ?></td>
        <td>&nbsp;<?php echo $linha[valor_unit_custo]                   ?></td>
        <td>&nbsp;<?php echo $linha[valor_tot_custo]                    ?></td>
        <td>&nbsp;<?php echo $linha[forn]                               ?></td>
        <td>&nbsp;<?php echo $linha[valor_frete]                        ?></td>
        <td>&nbsp;<?php echo $linha[imposto]                            ?></td>
        <td>&nbsp;<?php echo $linha[custo_aprox]                        ?></td>
        <td>&nbsp;<?php echo $linha[lucro_liq]                          ?></td>
        <td>&nbsp;<?php echo $linha[vminlote]                           ?></td>
        <td>&nbsp;<?php echo $linha[vminitem]                           ?></td>
        <td>&nbsp;<?php echo $linha[porcentagem_lucro]                  ?></td>
        <td align="center"><input type="checkbox" name="apaga[]" value="<?php echo $linha[id_cadastro] ?>"</td>
    </tr>
    
<?php
    //pega a próxima linha
    $linha = mysql_fetch_assoc($res);
}
echo '<br>';
//require_once "rel_licita.php";
?>
    <tr>
        <td colspan="17">Total de registros: <?php echo $c ?></td><br>
        <td align="center"><input type="submit" value="Apagar"></td>
    </tr><br>
</form>
