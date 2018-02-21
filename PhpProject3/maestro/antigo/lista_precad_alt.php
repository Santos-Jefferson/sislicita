<?php
require "conecta.php";
require_once "cabecalho_reduzido.php";
require_once "cabecalho_precad.php";

// se o GET[order] for vazio, então será preenchido com um valor padrão
if(empty($_GET[order])) $_GET[order] = 'data';
    
$sql = "SELECT * FROM precadastro WHERE codigo LIKE '%{$_GET[codigo]}%' ORDER BY {$_GET[order]}";

$res = mysql_query($sql) or die("Erro seleção");

$v = 0; //conterá a somatória dos valores
$c = 0; //total de registros

//pega a primeira linha do resultado
$linha = mysql_fetch_assoc($res);

//Declarado aqui as variáveis que irão compor as colunas para utilizar na hora 
//do pregão (criado as fórmulas para adicionar ao banco)



require_once "pes_rapida_precad_alt.php";
?>

<form action="altera_precad.php">
    <table width="1020" align="center" class="A" border="1" cellpadding="2" cellspacing="0">    
        <tr>
            <!--<th>Cod_int</th>-->
            <th><a href="lista_precad_alt.php?order=licitante">Licitante</a></th>
            <th><a href="lista_precad_alt.php?order=codigo">Codigo</a></th>
            <th><a href="lista_precad_alt.php?order=data">D/H - Inclusão</a></th>
            <th><a href="lista_precad_alt.php?order=status">Status</a></th>
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

/*$imposto = 6/100;
$linha[valor_tot_custo] = $linha[qtde]*$linha[valor_unit_custo];
$linha[imposto] = $linha[vminitem]*$imposto;
$linha[custo_aprox] = $linha[valor_tot_custo]+$linha[valor_frete]+$linha[imposto];
$linha[lucro_liq] = $linha[vminitem]-$linha[custo_aprox];
$linha[vminlote] = ($linha[porcentagem_lucro]*$linha[custo_aprox])/100;
*/
    
    ?>

    <tr>
        <!--<td>&nbsp;<?php// echo $linha[id_cadastro]                        ?></td>-->
        <td>&nbsp;<?php echo $linha[licitante]                          ?></td>
        <td>&nbsp;<?php echo $linha[codigo]                          ?></td>
        <td>&nbsp;<?php echo $linha[data]                             ?></td>
        <td>&nbsp;<?php echo $linha[status]                               ?></td>
        <td align="center"><input type="radio" name="alterar" value="<?php echo $linha[id]?>"</td>
    </tr>
    
<?php
    //pega a próxima linha
    $linha = mysql_fetch_assoc($res);
}
echo '<br>';
//require_once "rel_licita.php";
?>
    <tr>
        <td colspan="4">Total de registros: <?php echo $c ?></td><br>
        <td align="center"><input type="submit" value="Alterar"></td>
    </tr><br>
</form>
