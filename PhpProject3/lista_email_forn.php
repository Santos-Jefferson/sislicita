<?php
require "conecta.php";
require_once "cabecalho_reduzido.php";
require_once "cabecalho.php";
require_once "css.php";
require "selec_relatorio_forn.php";


$sql = "SELECT email_forn FROM cad_fornecedor WHERE segmento_forn='$_POST[segmento_forn]' and email_forn LIKE '%@%'";
$res = mysql_query($sql) or die("Erro seleção - emails_forn");

//pega a primeira linha do resultado
$linha = mysql_fetch_assoc($res);



?>
<table width="1020" align="center" class="A" border="1" cellpadding="2" cellspacing="0">
    <!--</table>-->
<!--<table width="1020" align="center" class="A" border="1" cellpadding="2" cellspacing="0">-->
    <tr class="forms">
            
            <th colspan="10" align="center">EMAILS SELECIONADO - SANTOS & MAYER</th>
        </tr>
    
        
        
<?php
//enquanto houver linha
while($linha){
    $emails .=$linha[email_forn].";";
    $c++;                   //incrementa o total de linhas;
    //$v += $linha[valor];    //incrementa a $v o campo valor
    ?>
    
     <tr>
        
        <td align="center">&nbsp;<a href="mailto:<?php echo $linha[email_forn];?>?subject=Cotação"><?php echo $linha[email_forn]                          ?></a>
        </td>
        
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
//print_r ($emails);
?>
        <tr>
        <td colspan="10" align="center">
            <input type='button' value='ENVIAR EMAILS PARA TODOS'
               onclick='document.location.href="mailto:contato@maestroinformatica.net?bcc=<?php echo "$emails"; ?>&subject=Cotação"'>
            
        </td>
    </tr>
    <tr>
        <td colspan="9">Total de registros: <?php echo $c ?></td><br>
    </tr><br>