<?php
require "conecta.php";
//require_once "cabecalho_reduzido_sem_teste.php";
//require_once "cabecalho_lote.php";
require_once "cabecalho_geral.php";
require_once "css.php";

//print_r ($usuario);
//print_r ($senha);
//die;

// se o GET[order] for vazio, então será preenchido com um valor padrão
if(empty($_GET[order])) $_GET[order] = 'data_entrada';
if(empty($_GET[ascdesc])) $_GET[ascdesc] = 'DESC';
//if(empty($_GET[order2])) $_GET[order2] = 'hora';

//if($usuario == "admin"){

    $sql = "SELECT * FROM cad_produto_entrada ORDER BY {$_GET[order]} {$_GET[ascdesc]}";
    //}
    //else{
    
      //  $sql = "SELECT * FROM codigo WHERE licitante = '$usuario' and codigo LIKE '%{$_GET[codigo]}%' ORDER BY {$_GET[order]} DESC, {$_GET[order2]} ASC";
    //}
    
$res = mysql_query($sql) or die("Erro seleção - linha");

$v = 0; //conterá a somatória dos valores
$c = 0; //total de registros

//pega a primeira linha do resultado
$linha = mysql_fetch_assoc($res);

?>

<script language="JavaScript">
function abrir(URL) {
 
  var width = 1100;
  var height = 450;
 
  var left = 99;
  var top = 99;
 
  window.open(URL,'janela', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');
 
}
</script>
<table width="1000" align="center" class="A" border="1" cellpadding="2" cellspacing="0">
    <!--</table>-->
<!--<table width="1020" align="center" class="A" border="1" cellpadding="2" cellspacing="0">-->
    <tr class="forms">
            
            <th colspan="11" bgcolor="red" align="center">ENTRADAS DE PRODUTOS - SANTOS & MAYER</th>
        </tr>
    <tr>
        <td colspan="11">
            <input type='button' value='Cadastrar Novo Produto' class='botao'
               onclick='document.location.href="cad_produto.php?usuario=<?php echo "$user_logged"; ?>"'>
            <input type='button' value='Entrada/Saída Notas Fiscais' class='botao'
               onclick='document.location.href="cad_entrada_prod.php"'>
        </td>
    </tr>
        
        <tr class="">
            <!--<th>Cod_int</th>-->
            <th align="center"><a href="lista_cad_entrada_prod_tudo.php?order=data_entrada&ascdesc=DESC"><img src="imagens/cima.png"></a>DATA<a href="lista_cad_entrada_prod_tudo.php?order=data_entrada&ascdesc=ASC"><img src="imagens/baixo.png"></a></th>
            <th width="50" align="center"><a href="lista_cad_entrada_prod_tudo.php?order=tipo_mov&ascdesc=DESC"><img src="imagens/cima.png"></a>TIPO<a href="lista_cad_entrada_prod_tudo.php?order=tipo_mov&ascdesc=ASC"><img src="imagens/baixo.png"></a></th>
            <th align="center"><a href="lista_cad_entrada_prod_tudo.php?order=forn_prod_ent&ascdesc=DESC"><img src="imagens/cima.png"></a>FORN.<a href="lista_cad_entrada_prod_tudo.php?order=forn_prod_ent&ascdesc=ASC"><img src="imagens/baixo.png"></a></th>
            <th width="60" align="center"><a href="lista_cad_entrada_prod_tudo.php?order=num_doc&ascdesc=DESC"><img src="imagens/cima.png"></a>N°DOC<a href="lista_cad_entrada_prod_tudo.php?order=num_doc&ascdesc=ASC"><img src="imagens/baixo.png"></a></th>
            <th width="50" align="center"><a href="lista_cad_entrada_prod_tudo.php?order=qtde_ent&ascdesc=DESC"><img src="imagens/cima.png"></a>QTDE<a href="lista_cad_entrada_prod_tudo.php?order=qtde_ent&ascdesc=ASC"><img src="imagens/baixo.png"></a></th>
            <th align="center"><a href="lista_cad_entrada_prod_tudo.php?order=prod_ent&ascdesc=DESC"><img src="imagens/cima.png"></a>PRODUTO<a href="lista_cad_entrada_prod_tudo.php?order=prod_ent&ascdesc=ASC"><img src="imagens/baixo.png"></a></th>
            <th width="80" align="center"><a href="lista_cad_entrada_prod_tudo.php?order=valor_forn_ent&ascdesc=DESC"><img src="imagens/cima.png"></a>VALOR UN.<a href="lista_cad_entrada_prod_tudo.php?order=valor_forn_ent&ascdesc=ASC"><img src="imagens/baixo.png"></a></th>
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
         <td align="center">&nbsp;<?php echo date('d/m/Y', strtotime($linha[data_entrada]));   ?></a></td>
         <td align="center">&nbsp;<?php echo $linha[tipo_mov]                          ?></a>
         <td align="center">&nbsp;<?php echo $linha[forn_prod_ent]                          ?></a>
         <td align="center">&nbsp;<?php echo $linha[num_doc]                          ?></a>
         <td align="center">&nbsp;<?php echo $linha[qtde_ent]                          ?></a>
         <td align="center">&nbsp;<?php echo $linha[prod_ent]                          ?></a>
         <td align="right">&nbsp;<?php echo "R$"." ".number_format($linha[valor_forn_ent],2, ',','.');?></a>
         <!--<td align="center">&nbsp;<a href="javascript:abrir('info_prod.php?part_number=<?php //echo $linha[part_number];?>');"><?php //echo $linha[part_number]?></a>-->
         
             <td align="center" width="40">
            
            <?php
            //print_r ($linha[licitante]);
            //die;
            //echo $usuario;
            if (($linha[licitante]) == ($usuario)){
                
                echo "<a href='altera_prod_entrada.php?alterar=$linha[id_cad_prod_ent]'><img src='imagens/edit.png' border='0'/></a>";
                echo "<a href='conf_entrada_prod_exc.php?apagar=$linha[id_cad_prod_ent]&prod_ent=$linha[prod_ent]&id_cad_prod=$linha[id_cad_prod]&id_cad_prod_ent=$linha[id_cad_prod_ent]'><img src='imagens/delete.png' border='0'/></a>";
            }
            
            elseif (($usuario == "admin") or ($usuario == "adm")){
                echo "<a href='altera_prod_entrada.php?alterar=$linha[id_cad_prod_ent]'><img src='imagens/edit.png' border='0'/></a>";
                echo "<a href='conf_entrada_prod_exc.php?apagar=$linha[id_cad_prod_ent]&prod_ent=$linha[prod_ent]&id_cad_prod=$linha[id_cad_prod]&id_cad_prod_ent=$linha[id_cad_prod_ent]'><img src='imagens/delete.png' border='0'/></a>";
                
            }
            ?>
            
        </td>
                  
 </tr>
<?php

    //pega a próxima linha
    $linha = mysql_fetch_assoc($res);
}
//echo '<br>';
//require_once "rel_licita.php";
?>
    <tr>
        <td colspan="11">Total de registros: <?php echo $c ?></td><br>
    </tr><br>