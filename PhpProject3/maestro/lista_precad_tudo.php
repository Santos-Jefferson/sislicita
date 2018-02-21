<?php
require "conecta.php";
require_once "cabecalho_reduzido.php";
require_once "cabecalho_precad.php";



// se o GET[order] for vazio, então será preenchido com um valor padrão
if(empty($_GET[order])) $_GET[order] = 'codigo';
    
$sql = "SELECT * FROM precadastro WHERE codigo LIKE '%{$_GET[codigo]}%' ORDER BY {$_GET[order]}";

$res = mysql_query($sql) or die("Erro seleção");

$v = 0; //conterá a somatória dos valores
$c = 0; //total de registros

//pega a primeira linha do resultado
$linha = mysql_fetch_assoc($res);



//require_once "pes_rapida_precad_tudo.php";

?>

<table width="1020" align="center" class="A" border="1" cellpadding="3" cellspacing="0">
        <tr>
            <!--<th>Cod_int</th>-->
            <th><a href="lista_precad_tudo.php?order=licitante">Licitante</a></th>
            <th><a href="lista_precad_tudo.php?order=codigo">Cód. BB/UASG/PREGÃO</a></th>
            <th><a href="lista_precad_tudo.php?order=data">D/H - Inclusão</a></th>
            <th><a href="lista_precad_tudo.php?order=status">Status</a></th>
            <th>Alterar/Excluir</th>

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
        <td align="center">&nbsp;<?php echo $linha[licitante]          ?></td>
        <td align="center">&nbsp;<?php echo $linha[codigo]         ?></td>
        <td align="center">&nbsp;<?php
                                    $data = "$linha[data]";
                                    echo date('d/m/Y - H:i:s' , strtotime($data));
                                    ?>
        </td>
        <td align="center">&nbsp;<?php echo $linha[status]  ?></td>
        
        <!--<td align="center">&nbsp;<a href="altera_precad.php?alterar=
                                    <?php //echo $linha[id]; ?>">
                                        <img src="imagens/alterar.jpg" width="20" height="20">
                                 </a> / 
                                 <a href="conf_precad_exc.php?apagar=
                                    <?php //echo $linha[codigo]; ?>">
                                        <img src="imagens/excluir2.jpg" width="20" height="20">
                                 </a>
        </td>-->
        <td align="center">&nbsp;<input type='button' value='Alterar'
               onclick='document.location.href="altera_precad.php?alterar=<?php echo $linha[id]; ?>"'> / 
                                 <input type='button' value='Excluir'
               onclick='document.location.href="conf_precad_exc.php?apagar=<?php echo $linha[codigo]; ?>"'>
        </td>
        
    </tr>
    
<?php
    //pega a próxima linha
    $linha = mysql_fetch_assoc($res);
}
echo '<br>';
//require_once "rel_licita.php";
?>
    <tr>
        <td colspan="5">Total de registros: <?php echo $c ?></td><br>
    </tr><br>
</tr>

