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

//declarado aqui as variáveis que irão compor as colunas para utilizar na hora 
//do pregão (criado as fórmulas para adicionar ao banco)
$imposto = 6/100;
$linha[valor_tot_custo] = $linha[qtde]*$linha[valor_unit_custo];
$linha[imposto] = $linha[vminitem]*$imposto;
$linha[custo_aprox] = $linha[valor_tot_custo]+$linha[valor_frete]+$linha[imposto];
$linha[lucro_liq] = $linha[vminitem]-$linha[custo_aprox];
$linha[vminlote] = ($linha[porcentagem_lucro]*$linha[custo_aprox])/100;




require_once "pesquisa2_cad.php";
?>

<form action="altera_cad.php">
    <table width="1020" align="center" class="A" border="1" cellpadding="2" cellspacing="0">    
        <tr>
            <!--<th>Cod_int</th>-->
            <th><a href="sel_cad.php?order=licitante">Licitante</a></th>
            <th><a href="sel_cad.php?order=data_hora">Data/Hora</a></th>
            <th><a href="sel_cad.php?order=codigo">Código</a></th>
            <th>Lote</th>
            <th>Item</th>
            <th>Qtde</th>
            <th>Produto</th>
            <th>V.Unit.Custo</th>
            <th>V.Tot.Custo</th>
            <th>Forn</th>
            <th>V.Frete</th>
            <th>Imposto</th>
            <th>C.Aprox.</th>
            <th>L.Liq.</th>
            <th>V.Min/Lote</th>
            <th>V.Min/Item</th>
            <th>%Lucro</th>
            <th align="center">Alterar</th>
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
        <!--<td>&nbsp;<?php// echo $linha[id_cadastro]                        ?></td>-->
        <td>&nbsp;<?php echo $linha[licitante]                          ?></td>
        <td>&nbsp;<?php echo $linha[data_hora]                          ?></td>
        <td>&nbsp;<?php echo $linha[codigo]                             ?></td>
        <td>&nbsp;<?php echo $linha[lote]                               ?></td>
        <td>&nbsp;<?php echo $linha[item]                               ?></td>
        <td>&nbsp;<?php echo $linha[qtde]                               ?></td>
        <td>&nbsp;<?php echo $linha[produto]                            ?></td>
        <td>R$ <?php echo $linha[valor_unit_custo]                      ?></td>
        <td>R$ <?php echo $linha[valor_tot_custo]                       ?></td>
        <td>&nbsp;<?php echo $linha[forn]                               ?></td>
        <td>R$ <?php echo $linha[valor_frete]                           ?></td>
        <td>R$ <?php echo $linha[imposto]                              ?></td>
        <td>R$ <?php echo $linha[custo_aprox]                        ?></td>
        <td>R$ <?php echo $linha[lucro_liq]                          ?></td>
        <td>R$ <?php echo $linha[vminlote]                           ?></td>
        <td>R$ <?php echo $linha[vminitem]                           ?></td>
        <td><?php echo $linha[porcentagem_lucro]                  ?> %</td>
        <td align="center"><input type="radio" name="alterar" value="<?php echo $linha[id_cadastro]?>"</td>
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
        <td align="center"><input type="submit" value="Alterar"></td>
    </tr><br>
</form>
