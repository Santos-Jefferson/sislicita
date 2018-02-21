<?php
require "conecta.php";
require_once "cabecalho.php";
require_once "selec_relatorio_meta.php";
include "css.php";
//print_r ($_REQUEST);
//print_r ($senha);
//die;

// se o GET[order] for vazio, então será preenchido com um valor padrão
if(empty($_GET[order])) $_GET[order] = 'data';
if(empty($_GET[order2])) $_GET[order2] = 'hora';

//if($usuario == "admin"){
$sql = "SELECT *
            FROM codigo inner join lote
            WHERE codigo.id_cod=lote.id_cod
                    and codigo.licitante='{$_POST[licitante]}'
                    and (YEAR(codigo.data) = '{$_POST[ano]}')
                    and (MONTH(codigo.data) = '{$_POST[mes]}')
                    and lote.colocacao !=''
                    and lote.colocacao !='Cancelada'
                    and lote.colocacao !='Suspensa'
                    and lote.colocacao !='Desclassificado'
                    and lote.colocacao !='Reaberto'
                    and lote.colocacao !='Rescindido contrato/ata'
                        GROUP BY codigo.codigo
                        ORDER BY codigo.data";

/*    $sql = "SELECT *
            FROM codigo,lote
            WHERE codigo.id_cod=lote.id_cod
                    and (YEAR(codigo.data) = YEAR(now()))
                    and (MONTH(codigo.data) = MONTH(now()))
                    and (DAYOFWEEK(codigo.data)<=DAYOFWEEK(now()))
                    and lote.colocacao !=''
                        ORDER BY codigo.data ASC and
                        ORDER BY lote.colocacao ASC";*/
    //}
    //else{
    
      //  $sql = "SELECT * FROM codigo WHERE licitante = '$usuario' and codigo LIKE '%{$_GET[codigo]}%' ORDER BY {$_GET[order]} DESC, {$_GET[order2]} ASC";
    //}
    
$res = mysql_query($sql) or die("Erro seleção - linha - meta ");

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
?>
<table width="1020" align="center" class="A" border="1" cellpadding="2" cellspacing="0">
<tr class="">
    <td colspan="10">
        <b>LICITANTE:</b><?php echo " "."$_POST[licitante]";?>
    </td>
</tr>
<tr class="">
    <td colspan="10">
        <b>LEGENDA TIPO:</b> AT = Aquisição Total, RP = Registro de Preços, DL = Dispensa Licitação, CC = Carta Convite
    </td>
</tr>
<!--</table>-->
<!--<table width="1020" align="center" class="A" border="1" cellpadding="2" cellspacing="0">-->
        <tr class="forms">
            <!--<th>Cod_int</th>-->
            <th align="center">Tipo</th>
            <th align="center"><a href="lista_licita_tudo.php?order=codigo">Cód. Licitação</a></th>
            <th align="center">Pregão n°</a></th>
            <th>Lote/Grupo</th>
            <th><a href="lista_licita_tudo.php?order=orgao">Órgão</a></th>
            <th><a href="lista_licita_tudo.php?order=data&order2=hora">Data</th>
            <th>Hora</th>
            <th><a href="lista_licita_tudo.php?order=licitante">Licitante</th>
            <th>RO?</th>
            <th>Ação</th>
        </tr>
<?php
//enquanto houver linha
while($linha){
    $c++;                   //incrementa o total de linhas;
    //$v += $linha[valor];    //incrementa a $v o campo valor
    ?>
    
     <tr>
        <!--<td>&nbsp;<?php// echo $linha[id_cadastro]                        ?></td>-->
        <td align="center">&nbsp;<?php echo $linha[tipo_licitacao]                          ?>
        
        </td>
         <td align="center">&nbsp;<?php echo $linha[codigo]                          ?>
        
        </td>
        <td align="center">&nbsp;<?php echo $linha[pregao]                          ?>
        
        </td>
    
        <td><?php 
        
                $sql = "SELECT * from lote WHERE id_cod = $linha[id_cod] ORDER BY lote";
                $lotes = mysql_query($sql) or die ("Erro seleção lotes4");
                $linha_lote = mysql_fetch_assoc($lotes);
                
                
                while($linha_lote){
                    echo "<a href='cad_itens2.php?id_cod=$linha[id_cod]&id_lote=$linha_lote[id_lote]&lote=$linha_lote[lote]&codigo=$linha[codigo]&licitante=$linha[licitante]&data=$linha[data]&hora=$linha[hora]&orgao=$linha[orgao]&uf=$linha[uf]&pregao=$linha[pregao]&tipo_licitacao=$linha[tipo_licitacao]'>{$linha_lote[lote]}</a>    -     ";
                    //echo "<input type='button' value='+i'
                      //       onclick='cad_itens.php?id_lote=$linha_lote[id_lote]&lote=$linha_lote[lote]&codigo=$linha[codigo]'>$linha_lote[lote]";
                
                    
                   $linha_lote = mysql_fetch_assoc($lotes);
                   
                }
                ?>
                <a href="cad_lote.php?id_cod=<?php echo $linha[id_cod] ?>&codigo=<?php echo $linha[codigo] ?>"><img src="imagens/inserir.png"></a>
                <!--<input type='button' value='+'
                               onclick='document.location.href="cad_lote.php?id_cod=<?php //echo $linha[id_cod] ?>&codigo=<?php //echo $linha[codigo] ?>"'-->
                
        </td>
        
        <td>&nbsp;<?php echo $linha[orgao]                             ?></td>
        <td>&nbsp;<?php
                        $data = "$linha[data]";
                        echo date('d/m/Y', strtotime($data));
                        ?>
        </td>
        <td>&nbsp;<?php echo $linha[hora]                               ?></td>
        <td>&nbsp;<?php echo $linha[licitante]                               ?></td>
                  <td><?php
                    $sql_ro = "Select * from codigo,lote,itens,subitens where codigo.id_cod=lote.id_cod and lote.id_lote=itens.id_lote and itens.id_itens=subitens.id_item and codigo.id_cod=$linha[id_cod]";
                    $res_ro = mysql_query($sql_ro) or die ("res_ro erro");
                    $linha_ro = mysql_fetch_Array($res_ro);
                    while($linha_ro){
                       
                        if (($linha_ro[ro_item]=="Sim") or ($linha_ro[ro_subitem]=="Sim")){
                           $ro="1";
                        }
                        else{
                            $ro="0";
                            
                        }
                            $linha_ro = mysql_fetch_array($res_ro);
                            
                            
                    }
                    //echo "sim";
                                
                                
                            
                            
                        
                        
                   
                  ?>
                  </td>
        
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
    