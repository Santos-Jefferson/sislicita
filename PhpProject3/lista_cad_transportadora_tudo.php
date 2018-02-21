<?php
require "conecta.php";
//require_once "cabecalho_reduzido.php";
require_once "cabecalho_geral.php";
require_once "css.php";

//print_r ($usuario);
//print_r ($senha);
//die;

// se o GET[order] for vazio, então será preenchido com um valor padrão
if(empty($_GET[order])) $_GET[order] = 'nome_trans';
//if(empty($_GET[order2])) $_GET[order2] = 'hora';

//if($usuario == "admin"){

    $sql = "SELECT * FROM cad_transportadora ORDER BY {$_GET[order]} ASC";
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
?>
<table width="1020" align="center" class="A" border="1" cellpadding="2" cellspacing="0">
    <!--</table>-->
<!--<table width="1020" align="center" class="A" border="1" cellpadding="2" cellspacing="0">-->
    <tr class="forms">
            
            <th colspan="10" align="center">TRANSPORTADORAS - SANTOS & MAYER</th>
        </tr>
    <tr>
        <td colspan="10">
            <input type='button' value='Cadastrar Nova Transportadora' class='botao'
               onclick='document.location.href="cad_transportadora.php?usuario=<?php echo "$user_logged"; ?>"'>
            <input type='button' value='Gerar Relaório Transportadora' class='botao'
               onclick='document.location.href="#.php?usuario=<?php echo "$user_logged"; ?>"'>
            <input type='button' value='Exportar Emails' class='botao'
               onclick='document.location.href="#.php?usuario=<?php echo "$user_logged"; ?>"'>
        </td>
    </tr>
        
        <tr class="">
            <!--<th>Cod_int</th>-->
            <th align="center"><a href="lista_cad_transportadora_tudo.php?order=nome_trans">NOME<img src="imagens/seta1.jpg"></a></th>
            <th align="center">EMAIL</th>
            <th align="center">MSN/SKYPE</th>
            <th align="center">USUÁRIO</th>
            <th align="center">SENHA</th>
            <th align="center"><a href="lista_cad_transportadora_tudo.php?order=regiao_trans">REGIÃO ATENDIDA<img src="imagens/seta1.jpg"></a></th>
            <th>AÇÃO</th>
        </tr>
<?php
//enquanto houver linha
while($linha){
    $c++;                   //incrementa o total de linhas;
    //$v += $linha[valor];    //incrementa a $v o campo valor
    ?>
    
     <tr>
        <!--<td>&nbsp;<?php// echo $linha[id_cadastro]                        ?></td>-->
        <td align="center" width="">&nbsp;<a href="http://<?php echo $linha[website_trans];?>" title="<?php echo "contato:".$linha[contato_trans]." / "."fone:".$linha[fone_trans];?>" target="_blank"><?php echo $linha[nome_trans]                          ?></a>
        
        </td>
        
        <td align="center">&nbsp;<a href="mailto:<?php echo $linha[email_trans];?>?subject=Cotação"><?php echo $linha[email_trans]                          ?></a>
        
        </td>
        <td align="center">&nbsp;<?php echo $linha[msn_trans]                          ?></a>
        
        </td>
        <td align="center" width="">&nbsp;<?php echo $linha[usuario_trans]                          ?>
            
        </td>
        <td align="center" width="">&nbsp;<?php echo $linha[senha_trans]                          ?>
            
        </td>
        <td align="center" width="">&nbsp;<?php echo $linha[regiao_trans]                          ?>
            
        </td>
        
        <td align="center" width="40">
            
            <?php
            //print_r ($linha[licitante]);
            //die;
            //echo $usuario;
            if (($linha[licitante]) == ($usuario)){
                
                echo "<a href='altera_trans.php?alterar=$linha[id_cad_trans]'><img src='imagens/edit.png' border='0'/></a>";
                echo "<a href='conf_trans_exc.php?apagar=$linha[id_cad_trans]&nome_trans=$linha[nome_trans]'><img src='imagens/delete.png' border='0'/></a>";
            }
            
            elseif (($usuario == "admin") or ($usuario == "adm")){
                echo "<a href='altera_trans.php?alterar=$linha[id_cad_trans]'><img src='imagens/edit.png' border='0'/></a>";
                echo "<a href='conf_trans_exc.php?apagar=$linha[id_cad_trans]&nome_trans=$linha[nome_trans]'><img src='imagens/delete.png' border='0'/></a>";
                
            }
            ?>
            
            
            <!--<a href="altera_licita.php?alterar=<?php echo $linha[id_trans]; ?>"><img src="imagens/edit.png" border="0"/></a>
            <a href="conf_licita_exc.php?apagar=<?php echo $linha[id_trans]; ?>&codigo=<?php echo $linha[codigo];?>"><img src="imagens/delete.png" border="0"/></a>
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
        <td colspan="9">Total de registros: <?php echo $c ?></td><br>
    </tr><br>