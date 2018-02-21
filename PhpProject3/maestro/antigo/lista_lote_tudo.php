<?php
require "conecta.php";
require_once "cabecalho_reduzido.php";
require_once "cabecalho_lote.php";





// se o GET[order] for vazio, então será preenchido com um valor padrão
if(empty($_GET[order])) $_GET[order] = 'codigo';
    
$sql = "SELECT * FROM codigo WHERE codigo LIKE '%{$_GET[codigo]}%' ORDER BY {$_GET[order]}";

$res = mysql_query($sql) or die("Erro seleção");

$v = 0; //conterá a somatória dos valores
$c = 0; //total de registros

//pega a primeira linha do resultado
$linha = mysql_fetch_assoc($res);



require_once "pes_rapida_cad_tudo.php";

require "tab_cab_lotes_tudo.php";
?>
<?php

//enquanto houver linha
while($linha){
    $c++;                   //incrementa o total de linhas;
    //$v += $linha[valor];    //incrementa a $v o campo valor
    ?>
    
     <tr>
        <!--<td>&nbsp;<?php// echo $linha[id_cadastro]                        ?></td>-->
        <td>&nbsp;<a href="cad_lote.php?id_cod=<?php echo $linha[id_cod] ?>&codigo=<?php echo $linha[codigo] ?>">
            <?php echo $linha[codigo]                          ?></a></td>
    
        <td><?php 
        
                $sql = "SELECT * from lote WHERE id_cod = $linha[id_cod]";
                $lotes = mysql_query($sql) or die ("Erro seleção lotes");
                $linha_lote = mysql_fetch_assoc($lotes);

                while($linha_lote){
                    echo "<a href='cad_itens2.php?id_lote=$linha_lote[id_lote]&lote=$linha_lote[lote]&codigo=$linha[codigo]'>{$linha_lote[lote]}</a>    -     ";
                    
                   $linha_lote = mysql_fetch_assoc($lotes);
                
                }
                ?>
        </td>
        <td>&nbsp;<?php echo $linha[orgao]                             ?></td>
        <td>&nbsp;<?php echo $linha[data]                               ?></td>
        <td>&nbsp;<?php echo $linha[hora]                               ?></td>
        <td>&nbsp;<?php echo $linha[licitante]                               ?></td>
 </tr>
<?php

        

    
    //mostra a linha
    //$linha agora é um vetor com as posições:
    //$linha[cod], $linha[nome], $linha[valor], etc...

//  Declarado aqui as variáveis que irão compor as colunas para utilizar na hora 
//  do pregão (criado as fórmulas para adicionar ao banco)
//  chama o arquivo que contem as variáveis
//require "var_formulas.php"


//require "tab_cont_lotes_tudo.php";

    //pega a próxima linha
    $linha = mysql_fetch_assoc($res);
}
echo '<br>';
//require_once "rel_licita.php";
?>
    <tr>
        <td colspan="19">Total de registros: <?php echo $c ?></td><br>
    </tr><br>