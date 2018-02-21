<?php
require "conecta.php";
require "constantes_metas.php";
//require_once "cabecalho.php";
require_once "selec_relatorio_meta_adj.php";
include "css.php";
//print_r ($_REQUEST);
//print_r ($senha);
//die;

// se o GET[order] for vazio, então será preenchido com um valor padrão
if(empty($_GET[order])) $_GET[order] = 'data';
if(empty($_GET[order2])) $_GET[order2] = 'hora';

if($_POST[licitante]=="Todos" and $_POST[ano]=="$_POST[ano]" and $_POST[mes]=="$_POST[mes]"){

    //if($usuario == "admin"){
    $sql = "SELECT *
                FROM codigo inner join lote
                WHERE codigo.id_cod=lote.id_cod
                        and codigo.tipo_licitacao='RP'
                        and lote.adj_data !='0000-00-00'
                        and lote.validade_rpfinal >= '{$_POST[ano]}-{$_POST[mes]}-00'
                        and lote.adj_data <= '{$_POST[ano]}-{$_POST[mes]}-31'
                            
                            ORDER BY codigo.data";
    }

elseif($_POST[licitante]=="$_POST[licitante]" and $_POST[ano]=="$_POST[ano]" and $_POST[mes]=="$_POST[mes]"){

    //if($usuario == "admin"){
    $sql = "SELECT *
                FROM codigo inner join lote
                WHERE codigo.id_cod=lote.id_cod
                        and codigo.licitante='{$_POST[licitante]}'
                        and codigo.tipo_licitacao='RP'

                        and lote.adj_data !='0000-00-00'
                        and lote.validade_rpfinal >= '{$_POST[ano]}-{$_POST[mes]}-00'
                        and lote.adj_data <= '{$_POST[ano]}-{$_POST[mes]}-31'
                            
                            ORDER BY codigo.data";
    }
    

$res = mysql_query($sql) or die("Erro seleção - linha - meta ");
$v = 0; //conterá a somatória dos valores
$c = 0; //total de registros
//pega a primeira linha do resultado
$linha = mysql_fetch_assoc($res);



?>
<table width="1020" align="center" class="A" border="1" cellpadding="2" cellspacing="0">
<tr class="">
    <td colspan="11">
        <b>LICITANTE:</b><?php echo " "."$_POST[licitante]";?>
    </td>
</tr>
<tr class="">
    <td colspan="11">
        <b>TIPO:</b>RP = Registro de Preços
    </td>
</tr>
<!--</table>-->
<!--<table width="1020" align="center" class="A" border="1" cellpadding="2" cellspacing="0">-->
        <tr class="forms">
            <!--<th>Cod_int</th>-->
            <th align="center">Tipo</th>
            <th align="center">Cód. Licitação</a></th>
            <th align="center">Pregão n°</a></th>
            <th>Lote/Grupo</th>
            <th>Órgão</th>
            <th>Data da Adjudicação</th>
            <th>Validade da ATA RP</th>
            <th>Licitante</th>
            <th>Valor Adjudicado</th>
            <th>L.Líq./Val. ATA RP</th>
            <!--<th>RO?</th>-->
            <th>Ação</th>
        </tr>

            
            
            
<?php
/*$v = split('[/.-]', $_POST[adj_data]);
$t = split('[/.-]', $_POST[validade_rpfinal]);

$dini = mktime(0,0,0,$v[1],$v[0],$v[2]); // timestamp da data inicial
$dfim = mktime(0,0,0,$t[1],$t[0],$t[2]); // timestamp da data final

if ($dini <= $dfim)//se uma data for inferior a outra
{      
   //$dt = date("d/m/Y",$dini);//convertendo a data no formato dia/mes/ano
   //echo $dt."<br>"; //exibindo a data
   //$dini += 86400; // adicionando mais 1 dia (em segundos) na data inicial
*/


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
        
        <td align="center">&nbsp;<a href=cad_itens2.php?id_cod=<?php echo $linha[id_cod];?>&id_lote=<?php echo $linha[id_lote];?>&lote=<?php echo $linha[lote];?>&codigo=<?php echo $linha[codigo];?>&licitante=<?php echo $linha[licitante];?>&data=<?php echo $linha[data];?>&hora=<?php echo $linha[hora];?>&orgao=<?php echo $linha[orgao];?>><?php echo $linha[lote]                           ?></td></a>
        
        </td>
    
        <!--<td><?php /*
        
                $sql = "SELECT * from lote WHERE id_cod = $linha[id_cod] ORDER BY lote";
                $lotes = mysql_query($sql) or die ("Erro seleção lotes4");
                $linha_lote = mysql_fetch_assoc($lotes);
                
                
                while($linha_lote){
                    echo "<a href='cad_itens2.php?id_cod=$linha[id_cod]&id_lote=$linha_lote[id_lote]&lote=$linha_lote[lote]&codigo=$linha[codigo]&licitante=$linha[licitante]&data=$linha[data]&hora=$linha[hora]&orgao=$linha[orgao]&uf=$linha[uf]&pregao=$linha[pregao]&tipo_licitacao=$linha[tipo_licitacao]'>{$linha_lote[lote]}</a>    -     ";
                    //echo "<input type='button' value='+i'
                      //       onclick='cad_itens.php?id_lote=$linha_lote[id_lote]&lote=$linha_lote[lote]&codigo=$linha[codigo]'>$linha_lote[lote]";
                
                    
                   $linha_lote = mysql_fetch_assoc($lotes);
                   
                }*/
                ?>
                <a href="cad_lote.php?id_cod=<?php echo $linha[id_cod] ?>&codigo=<?php echo $linha[codigo] ?>"><img src="imagens/inserir.png"></a>
                <!--<input type='button' value='+'
                               onclick='document.location.href="cad_lote.php?id_cod=<?php //echo $linha[id_cod] ?>&codigo=<?php //echo $linha[codigo] ?>"'
                
        </td>-->
        
        <td>&nbsp;<?php echo $linha[orgao]                             ?></td>
        <td align="center">&nbsp;<?php
                        $data = "$linha[adj_data]";
                        echo date('d/m/Y', strtotime($data));
                        ?>
        </td>
        <td align="center">&nbsp;<?php echo $linha[validade_rp]." "."Meses"                             ?></td>
        
        <td align="center">&nbsp;<?php echo $linha[licitante]                               ?></td>
                  
                  
        <?php

            $sql2 = "SELECT * FROM codigo,lote,itens2
                    WHERE codigo.id_cod='{$linha[id_cod]}' and lote.id_lote='{$linha[id_lote]}' and codigo.id_cod=lote.id_cod and lote.id_lote=itens2.id_lote ORDER BY orgao ASC, codigo ASC, lote ASC";


                //echo "$sql";
                //die;
                $res2 = mysql_query($sql2) or die("erro sql2");
                $linha2 = mysql_fetch_assoc($res2);
                $vo = 0;
                $ll = 0;

                while ($linha2){
               
                    $vo += $linha2[vofertado];
                    $ll += $linha2[lucro_liquido];
                    //$linha2 = mysql_fetch_assoc($res2);
                    $linha2 = mysql_fetch_assoc($res2);
                }
                $lucrogeral += $ll/$linha[validade_rp];
                $vogeral += $vo;
                
                ?>
        <td align="center">&nbsp;<?php
                                    $number="$vo";
                                    echo "R$" .number_format($number,2, ',','.');
                                    ?>
        </td>
        <td align="center">&nbsp;<?php
                                    
                                    if ($linha[tipo_licitacao]=="RP"){
                                    $number=$ll/$linha[validade_rp];
                                    echo "R$" .number_format($number,2, ',','.');
                                    }
                                    else{
                                        $number="$ll";
                                        echo "R$" .number_format($number,2, ',','.');
                                    }
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
//}
//echo '<br>';
//require_once "rel_licita.php";
?>
    <tr>
        <td colspan="8">Total de registros: <?php echo $c ?></td><br>
    <td colspan="1"><b>Total V. Adjudicado:<?php
                                                    $number = $vogeral;
                                                    echo "R$" .number_format($number,2, ',','.');
                                                ?>
        </td>
        <td colspan="1"><b>Total Lucro:<?php
                                                    $number = $lucrogeral;
                                                    echo "R$" .number_format($number,2, ',','.');
                                                ?>
        </td>
        
</table>
<?php

if($_POST[licitante]=="Todos" and $_POST[ano]=="$_POST[ano]" and $_POST[mes]=="$_POST[mes]"){

$sql = "SELECT *
            FROM codigo inner join lote
            WHERE codigo.id_cod=lote.id_cod
                    
                    and ((codigo.tipo_licitacao='AT') or (codigo.tipo_licitacao='DL') or (codigo.tipo_licitacao='CC'))
                    and (YEAR(lote.adj_data) = '{$_POST[ano]}')
                    and (MONTH(lote.adj_data) = '{$_POST[mes]}')
                    and lote.adj_data !='0000-00-00'
                        
                        ORDER BY codigo.data";
}

elseif($_POST[licitante]=="$_POST[licitante]" and $_POST[ano]=="$_POST[ano]" and $_POST[mes]=="$_POST[mes]"){
    $sql = "SELECT *
            FROM codigo inner join lote
            WHERE codigo.id_cod=lote.id_cod
                    and codigo.licitante='{$_POST[licitante]}'
                    and ((codigo.tipo_licitacao='AT') or (codigo.tipo_licitacao='DL') or (codigo.tipo_licitacao='CC'))
                    and (YEAR(lote.adj_data) = '{$_POST[ano]}')
                    and (MONTH(lote.adj_data) = '{$_POST[mes]}')
                    and lote.adj_data !='0000-00-00'
                        ORDER BY codigo.data";
}


$res = mysql_query($sql) or die("Erro seleção - linha - meta ");
$v = 0; //conterá a somatória dos valores
$c = 0; //total de registros
//pega a primeira linha do resultado
$linha_at = mysql_fetch_assoc($res);
?>

<table width="1020" align="center" class="A" border="1" cellpadding="2" cellspacing="0">
<tr class="">
    <td colspan="11">
        <b>LICITANTE:</b><?php echo " "."$_POST[licitante]";?>
    </td>
</tr>
<tr class="">
    <td colspan="11">
        <b>TIPO:</b>AT = Aquisição Total / DL = Dispensa Licitação / CC = Carta Convite
    </td>
</tr>
<!--</table>-->
<!--<table width="1020" align="center" class="A" border="1" cellpadding="2" cellspacing="0">-->
        <tr class="forms">
            <!--<th>Cod_int</th>-->
            <th align="center">Tipo</th>
            <th align="center">Cód. Licitação</a></th>
            <th align="center">Pregão n°</a></th>
            <th>Lote/Grupo</th>
            <th>Órgão</a></th>
            <th>Data da Adjudicação</th>
            <th>Licitante</th>
            <th>Valor Adjudicado</th>
            <th>Lucro Líquido</th>
            <!--<th>RO?</th>-->
            <th>Ação</th>
        </tr>
<?php
//enquanto houver linha
while($linha_at){
    $c++;                   //incrementa o total de linhas;
    //$v += $linha[valor];    //incrementa a $v o campo valor
    ?>
    
     <tr>
        <!--<td>&nbsp;<?php// echo $linha[id_cadastro]                        ?></td>-->
        <td align="center">&nbsp;<?php echo $linha_at[tipo_licitacao]                          ?>
        
        </td>
         <td align="center">&nbsp;<?php echo $linha_at[codigo]                          ?>
        
        </td>
        <td align="center">&nbsp;<?php echo $linha_at[pregao]                          ?>
        
        </td>
        
        <td align="center">&nbsp;<a href=cad_itens2.php?id_cod=<?php echo $linha_at[id_cod];?>&id_lote=<?php echo $linha_at[id_lote];?>&lote=<?php echo $linha_at[lote];?>&codigo=<?php echo $linha_at[codigo];?>&licitante=<?php echo $linha_at[licitante];?>&data=<?php echo $linha_at[data];?>&hora=<?php echo $linha_at[hora];?>&orgao=<?php echo $linha_at[orgao];?>><?php echo $linha_at[lote]                           ?></td></a>
        
        </td>
    
        
        <td>&nbsp;<?php echo $linha_at[orgao]                             ?></td>
        <td align="center">&nbsp;<?php
                        $data = "$linha_at[adj_data]";
                        echo date('d/m/Y', strtotime($data));
                        ?>
        </td>
        
        
        <td align="center">&nbsp;<?php echo $linha_at[licitante]                               ?></td>
                  
                  
        <?php

            $sql2 = "SELECT * FROM codigo,lote,itens2
                    WHERE codigo.id_cod='{$linha_at[id_cod]}' and lote.id_lote='{$linha_at[id_lote]}' and codigo.id_cod=lote.id_cod and lote.id_lote=itens2.id_lote and ((codigo.tipo_licitacao='AT') or (codigo.tipo_licitacao='DL') or (codigo.tipo_licitacao='CC')) ORDER BY orgao ASC, codigo ASC, lote ASC";


                //echo "$sql";
                //die;
                $res2 = mysql_query($sql2) or die("erro sql2");
                $linha2 = mysql_fetch_assoc($res2);
                $vo_at = 0;
                $ll_at = 0;

                while ($linha2){
               
                    $vo_at += $linha2[vofertado];
                    $ll_at += $linha2[lucro_liquido];
                    //$linha2 = mysql_fetch_assoc($res2);
                    $linha2 = mysql_fetch_assoc($res2);
                }
                $lucrogeral_at += $ll_at;
                $vogeral_at += $vo_at;
                
                ?>
        <td align="center">&nbsp;<?php
                                    $number="$vo_at";
                                    echo "R$" .number_format($number,2, ',','.');
                                    ?>
        </td>
        <td align="center">&nbsp;<?php
                                    
                                        $number="$ll_at";
                                        echo "R$" .number_format($number,2, ',','.');
                                    
                                    ?>
        </td>
        
        <td align="center">
            
            <?php
            //print_r ($linha[licitante]);
            //die;
            //echo $usuario;
            if (($linha_at[licitante]) == ($usuario)){
                
                echo "<a href='altera_licita.php?alterar=$linha_at[id_cod]'><img src='imagens/edit.png' border='0'/></a>";
                echo "<a href='conf_licita_exc.php?apagar=$linha_at[id_cod]&codigo=$linha_at[codigo]'><img src='imagens/delete.png' border='0'/></a>";
            }
            
            elseif (($usuario == "admin") or ($usuario == "jessica")){
                echo "<a href='altera_licita.php?alterar=$linha_at[id_cod]'><img src='imagens/edit.png' border='0'/></a>";
                echo "<a href='conf_licita_exc.php?apagar=$linha_at[id_cod]&codigo=$linha_at[codigo]'><img src='imagens/delete.png' border='0'/></a>";
                
            }
            ?>
            
            
            <!--<a href="altera_licita.php?alterar=<?php echo $linha_at[id_cod]; ?>"><img src="imagens/edit.png" border="0"/></a>
            <a href="conf_licita_exc.php?apagar=<?php echo $linha_at[id_cod]; ?>&codigo=<?php echo $linha_at[codigo];?>"><img src="imagens/delete.png" border="0"/></a>
            -->
        </td>
</tr>
<?php

    $linha_at = mysql_fetch_assoc($res);
}
//echo '<br>';
//require_once "rel_licita.php";
?>
    <tr>
        <td colspan="7"">Total de registros: <?php echo $c ?></td><br>
        <td colspan="1"><b>Total V. Ofertado:<?php
                                                    $number = $vogeral_at;
                                                    echo "R$" .number_format($number,2, ',','.');
                                                ?>
        </td>
        <td colspan="1"><b>Total Lucro liquido:<?php
                                                    $number = $lucrogeral_at;
                                                    echo "R$" .number_format($number,2, ',','.');
                                                ?>
        </td>
        <!--<td colspan=""align="right">-->
    </tr>
</table><br>

<table width="1020" align="center" class="A" border="1" cellpadding="2" cellspacing="0">
<tr class="">
        <td colspan="7"><b><h1>Total Lucro Adjudicado Mês:</td>
        <td colspan="3" align="right"><b><h1>
                    <?php
                        $number = $lucrogeral_at+$lucrogeral;
                        echo "R$" .number_format($number,2, ',','.');
                    ?>
                    </td>
                    
<?php
    //echo "$_POST[licitante]";
    $sql = "Select * from usuarios where usuario='{$_POST[licitante]}'";
    $res = mysql_query($sql) or die("Erro seleção - usuarios - meta ");
    $usuarios = mysql_fetch_assoc($res); 

    //echo $c;
    //echo $usuarios[meta_qtde];
    if ($number>($usuarios[montante_adj])){
        $OK="<font color='limegreen'>OK";
    }
    else{
        $OK="<font color='orangered'>NÃO ATINGIDO";
    }

?>
        <td colspan="7"><center><b><h1>META:</td>
        <td colspan="3" align="right"><b><h1>
                    <?php
                        
                        echo $OK;
                    ?>
        </td>
                    
                    
                    <?php
                    //precisa ter o group by codigo.codigo senão exibe todos os lotes como licitações participadas.
                    if($_POST[licitante]=="Todos" and $_POST[ano]=="$_POST[ano]" and $_POST[mes]=="$_POST[mes]"){
                        
                        $sql = "SELECT *
                                    FROM codigo inner join lote
                                    WHERE codigo.id_cod=lote.id_cod
                                            
                                            and (YEAR(codigo.data) = '{$_POST[ano]}')
                                            and (MONTH(codigo.data) = '{$_POST[mes]}')
                                            and lote.colocacao !=''
                                            and lote.colocacao !='Cancelada/Suspensa'
                                            and lote.colocacao !='Desclassificado'
                                            and lote.colocacao !='Reaberto'
                                            and lote.colocacao !='Rescindido contrato/ata'
                                                GROUP BY codigo.codigo
                                                ORDER BY codigo.data";
                                            $res = mysql_query($sql) or die("Erro seleção - linha - meta ");
                    }
                        
                                           
                    elseif($_POST[licitante]=="$_POST[licitante]" and $_POST[ano]=="$_POST[ano]" and $_POST[mes]=="$_POST[mes]"){
                        
                    $sql = "SELECT *
                                    FROM codigo inner join lote
                                    WHERE codigo.id_cod=lote.id_cod
                                            and codigo.licitante='{$_POST[licitante]}'
                                            and (YEAR(codigo.data) = '{$_POST[ano]}')
                                            and (MONTH(codigo.data) = '{$_POST[mes]}')
                                            and lote.colocacao !=''
                                            and lote.colocacao !='Cancelada/Suspensa'
                                            and lote.colocacao !='Desclassificado'
                                            and lote.colocacao !='Reaberto'
                                            and lote.colocacao !='Rescindido contrato/ata'
                                                GROUP BY codigo.codigo
                                                ORDER BY codigo.data";
                                            $res = mysql_query($sql) or die("Erro seleção - linha - meta ");
                    }
                        
                      
                        $linha = mysql_fetch_assoc($res);
                        $v = 0; //conterá a somatória dos valores
                        $c = 0; //total de registros
                        while($linha){
                            $c++;
                                $linha = mysql_fetch_assoc($res);
                                
                        }
                        
                       
                    ?>
<tr class="">
        <td colspan="7"><b><h1>Total Licitações Participadas Mês:</td>
        <td colspan="3" align="right"><b><h1>
                    <?php
                        
                        echo $c;
                        
                        
                    ?>
        </td>

<?php
    //echo "$_POST[licitante]";
    $sql = "Select * from usuarios where usuario='{$_POST[licitante]}'";
    $res = mysql_query($sql) or die("Erro seleção - usuarios - meta ");
    $usuarios = mysql_fetch_assoc($res); 

    //echo $c;
    //echo $usuarios[meta_qtde];
    if ($c>=($usuarios[meta_qtde])){
        $OK="<font color='limegreen'>OK";
    }
    else{
        $OK="<font color='orangered'>NÃO ATINGIDO";
    }

?>
        <td colspan="7"><center><b><h1>META:</td>
        <td colspan="3" align="right"><b><h1>
                    <?php
                        
                        echo $OK;
                    ?>
        </td>
                    
                    
                    
</tr>




</table>


    
        
    