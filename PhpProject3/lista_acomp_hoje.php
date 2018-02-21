<?php
require "conecta.php";
require "css.php";
require_once "cabecalho_reduzido.php";
require_once "cabecalho_lote.php";
//print_r ($usuario);
//print_r ($senha);
//die;

// se o GET[order] for vazio, então será preenchido com um valor padrão
if(empty($_GET[order])) $_GET[order] = 'data';
if(empty($_GET[order2])) $_GET[order2] = 'hora';

//if($usuario == "admin"){

    $sql = "SELECT * FROM codigo,lote WHERE codigo.id_cod=lote.id_cod and lote.data_acomp = '{$_GET[hoje]}' and lote.data_acomp!='0000-00-00' ORDER BY hora_acomp  "; //and tipo_licitacao LIKE '%{$_GET[codigo]}%' or codigo LIKE '%{$_GET[codigo]}%' or pregao LIKE '%{$_GET[codigo]}%' or orgao LIKE '%{$_GET[codigo]}%' or licitante LIKE '%{$_GET[codigo]}%' ORDER BY {$_GET[order]} DESC, {$_GET[order2]} ASC";
    //}
    //else{
    
      //  $sql = "SELECT * FROM codigo WHERE licitante = '$usuario' and codigo LIKE '%{$_GET[codigo]}%' ORDER BY {$_GET[order]} DESC, {$_GET[order2]} ASC";
    //}
    
$res = mysql_query($sql) or die("Erro seleção - linha");

$v = 0; //conterá a somatória dos valores
$c = 0; //total de registros

//pega a primeira linha do resultado
$linha = mysql_fetch_assoc($res);


                
                
                //if(isset($linha_lote[data_acomp])){
                

/*$sql2 = "SELECT * from lote WHERE id_cod = $linha[id_cod]";

$lotes2 = mysql_query($sql2) or die ("Erro seleção lotes2");

$linha_lote2 = mysql_fetch_assoc($lotes2);


$sql3 = "SELECT * from itens WHERE id_lote = $linha_lote2[id_lote]";

$lotes3 = mysql_query($sql3) or die ("Erro seleção lotes3");

$linha_lote3 = mysql_fetch_assoc($lotes3);
*/

//require_once "pes_rapida_cad_tudo.php";
?>
<style>
#pop{display:none;position:absolute;top:50%;left:50%;margin-left:-150px;margin-top:-100px;padding:10px;width:300px;height:200px;border:1px solid #d0d0d0}
</style>

<table width="1010" align="center" class="A" border="1" cellpadding="2" cellspacing="0">
<tr class="">
    <td colspan="10">
    <marquee><h1><font color="red">###ATENÇÃO### - LICITAÇÕES A ACOMPANHAR - <?php echo date('d/m/Y', strtotime($_GET[hoje]));?>
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
            <th>Status/Colocação</th>
            <th><a href="lista_licita_tudo.php?order=orgao">Órgão</a></th>
            
            <th>Hora Acomp</th>
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
         <td align="center">&nbsp;<?php echo $linha[codigo].'/'.$linha[local_licitacao];?>
        
        </td>
        <td align="center">&nbsp;<?php echo $linha[pregao]                          ?>
        
        </td>
    
        <td align="center">
        <?php
        /*
        $sql = "SELECT * from codigo,lote WHERE codigo.id_cod=lote.id_cod and lote.id_cod = $linha[id_cod] and data_acomp!='0000-00-00' ORDER BY hora_acomp  ";
                $lotes = mysql_query($sql) or die ("Erro seleção lotes4");
                $linha_lote = mysql_fetch_assoc($lotes);
        
        
        
                while($linha_lote){*/
                    
                    echo "<a href='cad_itens2.php?id_cod=$linha[id_cod]&id_lote=$linha[id_lote]&lote=$linha[lote]&codigo=$linha[codigo]&licitante=$linha[licitante]&data=$linha[data]&hora=$linha[hora]&orgao=$linha[orgao]&uf=$linha[uf]&pregao=$linha[pregao]&tipo_licitacao=$linha[tipo_licitacao]'>{$linha[lote]}</a>";
                    //echo "<input type='button' value='+i'
                      //       onclick='cad_itens.php?id_lote=$linha_lote[id_lote]&lote=$linha_lote[lote]&codigo=$linha[codigo]'>$linha_lote[lote]";
                   //$linha_lote = mysql_fetch_assoc($lotes);
                
               // }
                    
                
                
                ?>
                <!--<a href="cad_lote.php?id_cod=<?php echo $linha[id_cod] ?>&codigo=<?php echo $linha[codigo] ?>"><img src="imagens/inserir.png"></a>-->
                <!--<input type='button' value='+'
                               onclick='document.location.href="cad_lote.php?id_cod=<?php //echo $linha[id_cod] ?>&codigo=<?php //echo $linha[codigo] ?>"'-->
                
        </td>
        <td align="center">&nbsp;<?php echo $linha[colocacao]                             ?></td>
        
        <td>&nbsp;<?php echo $linha[orgao]                             ?></td>
        
        <td align="center">&nbsp;<?php echo $linha[hora_acomp]                               ?></td>
        <td align="center">&nbsp;<?php echo $linha[licitante]                               ?></td>
                  <td align="center">
                    <?php
                    
                    echo $linha[ro_item];
                                
                        
                   
                  ?>
                  </td>
        
        <td align="center">
            
            <?php
            //print_r ($linha[licitante]);
            //die;
            //echo $usuario;
            if (($linha[licitante]) == ($usuario)){
                
                echo "<a href='altera_lote.php?alterar=$linha[id_lote]&codigo=$linha[codigo]&lote=$linha[lote]&orgao=$linha[orgao]&data=$linha[data]&hora=$linha[hora]&licitante=$linha[licitante]&id_lote=$linha[id_lote]&id_itens=$linha[id_itens]&id_cod=$linha[id_cod]'><img src='imagens/edit.png' border='0'/></a>";
                //echo "<a href='conf_licita_exc.php?apagar=$linha[id_cod]&codigo=$linha[codigo]'><img src='imagens/delete.png' border='0'/></a>";
            }
            
            elseif (($usuario == "admin") or ($usuario == "jessica")){
                 echo "<a href='altera_lote.php?alterar=$linha[id_lote]&codigo=$linha[codigo]&lote=$linha[lote]&orgao=$linha[orgao]&data=$linha[data]&hora=$linha[hora]&licitante=$linha[licitante]&id_lote=$linha[id_lote]&id_itens=$linha[id_itens]&id_cod=$linha[id_cod]'><img src='imagens/edit.png' border='0'/></a>";
                //echo "<a href='conf_licita_exc.php?apagar=$linha[id_cod]&codigo=$linha[codigo]'><img src='imagens/delete.png' border='0'/></a>"; 
                
            }
           
   
            ?>
           </div> 
            
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
    </tr>