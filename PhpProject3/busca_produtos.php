<?php
require "conecta.php";
require_once "cabecalho_reduzido.php";
require_once "cabecalho_lote.php";

//print_r ($usuario);
//print_r ($senha);
//die;





// se o GET[order] for vazio, então será preenchido com um valor padrão
//if(empty($_GET[order])) $_GET[order] = 'data';
//if(empty($_GET[order2])) $_GET[order2] = 'hora';

//if($usuario == "admin"){

    $sql = "SELECT * FROM itens,subitens WHERE itens.produto or subitens.modelo_si LIKE '%{$_GET[produto]}%'";// ORDER BY {$_GET[order]} DESC, {$_GET[order2]} ASC";
    //}
    //else{
    
      //  $sql = "SELECT * FROM codigo WHERE licitante = '$usuario' and codigo LIKE '%{$_GET[codigo]}%' ORDER BY {$_GET[order]} DESC, {$_GET[order2]} ASC";
    //}
    
$res = mysql_query($sql) or die("Erro seleção - linha");

$v = 0; //conterá a somatória dos valores
$c = 0; //total de registros

//pega a primeira linha do resultado
$linha = mysql_fetch_assoc($res);

/*$sql2 = "SELECT * from lote WHERE id_cod = $linha[id_cod]";

$lotes2 = mysql_query($sql2) or die ("Erro seleção lotes2");

$linha_lote2 = mysql_fetch_assoc($lotes2);


$sql3 = "SELECT * from itens WHERE id_lote = $linha_lote2[id_lote]";

$lotes3 = mysql_query($sql3) or die ("Erro seleção lotes3");

$linha_lote3 = mysql_fetch_assoc($lotes3);
*/

//require_once "pes_rapida_cad_tudo.php";

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
        <td align="center">&nbsp;<?php echo $linha[codigo]                          ?>
        
        </td>
        <td align="center">&nbsp;<?php echo $linha[pregao]                          ?>
        
        </td>
    
        <td><?php 
        
                $sql = "SELECT * from lote WHERE id_cod = $linha[id_cod] ORDER BY lote";
                $lotes = mysql_query($sql) or die ("Erro seleção lotes4");
                $linha_lote = mysql_fetch_assoc($lotes);
                
                
                while($linha_lote){
                    echo "<a href='cad_itens2.php?id_cod=$linha[id_cod]&id_lote=$linha_lote[id_lote]&lote=$linha_lote[lote]&codigo=$linha[codigo]&licitante=$linha[licitante]&data=$linha[data]&hora=$linha[hora]&orgao=$linha[orgao]'>{$linha_lote[lote]}</a>    -     ";
                    //echo "<input type='button' value='+i'
                      //       onclick='cad_itens.php?id_lote=$linha_lote[id_lote]&lote=$linha_lote[lote]&codigo=$linha[codigo]'>$linha_lote[lote]";
                
                    
                   $linha_lote = mysql_fetch_assoc($lotes);
                   
                }
                ?>
                <input type='button' value='+'
                               onclick='document.location.href="cad_lote.php?id_cod=<?php echo $linha[id_cod] ?>&codigo=<?php echo $linha[codigo] ?>"'
                
        </td>
        <td>&nbsp;<?php echo $linha[orgao]                             ?></td>
        <td>&nbsp;<?php
                        $data = "$linha[data]";
                        echo date('d/m/Y', strtotime($data));
                        ?>
        </td>
        <td>&nbsp;<?php echo $linha[hora]                               ?></td>
        <td>&nbsp;<?php echo $linha[licitante]                               ?></td>
        <td align="center">
            
            <?php
            //print_r ($linha[licitante]);
            //die;
            //echo $usuario;
            if (($linha[licitante]) == ($usuario)){
                
                echo "<a href='altera_licita.php?alterar=$linha[id_cod]'><img src='imagens/edit.png' border='0'/></a>";
                echo "<a href='conf_licita_exc.php?apagar=$linha[id_cod]&codigo=$linha[codigo]'><img src='imagens/delete.png' border='0'/></a>";
            }
            
            elseif (($usuario == "admin") or ($usuario == "jessica")){
                echo "<a href='altera_licita.php?alterar=$linha[id_cod]'><img src='imagens/edit.png' border='0'/></a>";
                echo "<a href='conf_licita_exc.php?apagar=$linha[id_cod]&codigo=$linha[codigo]'><img src='imagens/delete.png' border='0'/></a>";
            }
            ?>
            
            
            <!--<a href="altera_licita.php?alterar=<?php echo $linha[id_cod]; ?>"><img src="imagens/edit.png" border="0"/></a>
            <a href="conf_licita_exc.php?apagar=<?php echo $linha[id_cod]; ?>&codigo=<?php echo $linha[codigo];?>"><img src="imagens/delete.png" border="0"/></a>
            -->
        </td>
            
            
            <!--&nbsp;<input type='button' value='Alterar'
               onclick='document.location.href="altera_licita.php?alterar=<?php //echo $linha[id_cod]; ?>"'> / 
                                 <input type='button' value='Excluir'
               onclick='document.location.href="conf_licita_exc.php?apagar=<?php //echo $linha[id_cod]; ?>&codigo=<?php// echo $linha[codigo];?>"'>
        </td>-->
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
//echo '<br>';
//require_once "rel_licita.php";
?>
    <tr>
        <td colspan="19">Total de registros: <?php echo $c ?></td><br>
    </tr><br>