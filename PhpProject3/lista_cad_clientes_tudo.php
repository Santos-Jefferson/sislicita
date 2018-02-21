<?php
require "conecta.php";
//require_once "cabecalho_reduzido.php";
require_once "cabecalho_geral.php";
require_once "css.php";

//print_r ($usuario);
//print_r ($senha);
//die;

// se o GET[order] for vazio, então será preenchido com um valor padrão
if(empty($_GET[order])) $_GET[order] = 'nome_cl';
//if(empty($_GET[order2])) $_GET[order2] = 'hora';

//if($usuario == "admin"){

    $sql = "SELECT * FROM cad_clientes ORDER BY {$_GET[order]} ASC";
    //}
    //else{
    
      //  $sql = "SELECT * FROM codigo WHERE licitante = '$usuario' and codigo LIKE '%{$_GET[codigo]}%' ORDER BY {$_GET[order]} DESC, {$_GET[order2]} ASC";
    //}
    
$res = mysql_query($sql) or die("Erro seleção - linha");

//$v = 0; //conterá a somatória dos valores
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

<script language="JavaScript">
function abrir(URL) {
 
  var width = 1100;
  var height = 300;
 
  var left = 99;
  var top = 99;
 
  window.open(URL,'janela', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');
 
}
</script>
 


<table width="1020" align="center" class="A" border="1" cellpadding="2" cellspacing="0">
    <!--</table>-->
<!--<table width="1020" align="center" class="A" border="1" cellpadding="2" cellspacing="0">-->
    <tr class="forms">
            
            <th colspan="10" align="center">CLIENTES - SANTOS & MAYER</th>
        </tr>
    <tr>
        <td colspan="10">
            <input type='button' value='Cadastrar Novo Cliente' class='botao'
               onclick='document.location.href="cad_clientes.php?usuario=<?php echo "$user_logged"; ?>"'>
            <!--
            <input type='button' value='Gerar Relaório Assistências'
               onclick='document.location.href="#.php?usuario=<?php echo "$user_logged"; ?>"'>
            <input type='button' value='Exportar Emails'
               onclick='document.location.href="#.php?usuario=<?php echo "$user_logged"; ?>"'>-->
        </td>
    </tr>
        
        <tr class="">
            <!--<th>Cod_int</th>-->
            <td align="center"><a href="lista_cad_clientes_tudo.php?order=razao_social_cl">RAZÃO SOCIAL<img src="imagens/seta1.jpg"></a></td>
            <th align="center"><a href="lista_cad_clientes_tudo.php?order=nome_cl">NOME FANT.<img src="imagens/seta1.jpg"></a></th>
            <th align="center">CONTATO</th>
            <th align="center">EMAIL</th>
            <th align="center">FONES</th>
            <!--<th align="center">FONE 2</th>
            <th align="center">FONE 3</th>-->
            <th align="center"><a href="lista_cad_clientes_tudo.php?order=estado">UF<img src="imagens/seta1.jpg"></a></th>
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
        <td align="center" width="">&nbsp;<a href="javascript:abrir('info_clientes.php?cnpj=<?php echo $linha[cnpj_cl];?>');"><?php echo $linha[razao_social_cl]                          ?></a></td>
        <td align="center" width="">&nbsp;<?php echo $linha[nome_cl]                          ?></a></td>
        <td align="center">&nbsp;<?php echo $linha[contato_lic]                          ?></td>
        <td align="center">&nbsp;<a href="mailto:<?php echo $linha[email_lic];?>?subject=Informações"><?php echo $linha[email_lic]                          ?></a></td>
        <td width ="100" align="center"><?php echo "$linha[fone_lic]\n$linha[fone_ti]\n$linha[fone_almox]\n$linha[fone_fin_cl]";?></td>
        
        </td>
        <td align="center" width="">&nbsp;<?php echo $linha[estado]                          ?></td>
        
        <td align="center" width="40">
            
            <?php
            //print_r ($linha[licitante]);
            //die;
            //echo $usuario;
            if (($linha[licitante]) == ($usuario)){
                
                echo "<a href='altera_assist.php?alterar=$linha[id_cad_assist]'><img src='imagens/edit.png' border='0'/></a>";
                echo "<a href='conf_assist_exc.php?apagar=$linha[id_cad_assist]&nome_assist=$linha[nome_assist]'><img src='imagens/delete.png' border='0'/></a>";
            }
            
            elseif (($usuario == "admin") or ($usuario == "adm") or ($usuario == "vinicius")){
                echo "<a href='altera_assist.php?alterar=$linha[id_cad_assist]'><img src='imagens/edit.png' border='0'/></a>";
                echo "<a href='conf_assist_exc.php?apagar=$linha[id_cad_assist]&nome_assist=$linha[nome_assist]'><img src='imagens/delete.png' border='0'/></a>";
            }
            ?>
            
        </td>
            
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