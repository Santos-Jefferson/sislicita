<?php
require "conecta.php";
require_once "cabecalho_reduzido.php";
//require_once "cabecalho_lote.php";
include "css.php";
include "lib_datas.php";


//print_r ($_REQUEST);
// se o GET[order] for vazio, então será preenchido com um valor padrão
//if(empty($_GET[order])) $_GET[order] = 'item';
    
//$sql = "SELECT * FROM lote,itens,cad_frete WHERE id_lote = {$_GET[id_lote]} and lote.id_lote=itens.id_lote and itens.id_itens=cad_frete.id_itens order by {$_GET[order]}";

//$res = mysql_query($sql) or die("Erro seleção lista_tudo_frete");

//$v = 0; //conterá a somatória dos valores
//$c = 0; //total de registros

//pega a primeira linha do resultado
//$linha = mysql_fetch_assoc($res);
?>

<br>
<table align="center" class="A" border="0" width="1010">
<table align="center" class="A" width="1000" border="1" cellpadding="3" cellspacing="0">
  <table align="center" class="A" width="1000" border="1" cellpadding="3" cellspacing="0">
       
  <tr align="center" class="forms">
    <th width="" >ITEM</th>
    <th width="" >MODALIDADE</th>
    <th width="" >UF DESTINO:</th>
    <th colspan="" >QTDE VOLUMES</th>
    <th colspan="" >VALOR NOTA</th>
    <th colspan="" >TIPO EQUIPAMENTO</th>
    <th colspan="" >VALOR DO FRETE</th>
    <th colspan="" >AÇÃO</th>
        
</tr>

   <?php

//enquanto houver linha
while($linha){
    $c++;                   //incrementa o total de linhas;
    
?>

<tr align="center">
    <td>
        <?php
            echo $linha[item];
        ?>
    </td>
    <td>
        <?php
            echo $linha[modal_frete];
        ?>
    </td>
    <td>
        <?php
            echo $linha[uf];
        ?>
    </td>
    <td>
        <?php
            //echo $linha[calculo volumes???];
        ?>
    </td>
    <td>
        <?php
            echo $linha[vofertado];
        ?>
    </td>
    <td>
        <?php
            echo $linha[tipo_equipamento];
        ?>
    </td>
    <td>
        <?php
            //echo $linha[calculo valor frete];
        ?>
    </td>
    
    
    
    <td>
        <a href="copia_itens_ne.php?id_lote=<?php echo $linha[id_lote]; ?>&id_ne=<?php echo $linha[id_ne];?>&id_cod=<?php echo $_GET[id_cod];?>&id_itens=<?php echo $_REQUEST[id_itens];?>"><img src="imagens/copiar.png" border="0"/></a>
        <a href="cad_itens_ne.php?id_lote=<?php echo $linha[id_lote]; ?>&id_ne=<?php echo $linha[id_ne];?>&num_ne=<?php echo $linha[num_ne];?>&id_cod=<?php echo $_GET[id_cod];?>"><img src="imagens/cadastrar.png" border="0"/></a>
        <a href="altera_ne.php?alterar=<?php echo $linha[id_ne]; ?>&codigo=<?php echo $_GET[codigo]; ?>&lote=<?php echo $_GET[lote]; ?>&orgao=<?php echo $_GET[orgao]; ?>&data=<?php echo $_GET[data]; ?>&hora=<?php echo $_GET[hora]; ?>&licitante=<?php echo $_GET[licitante]; ?>&id_lote=<?php echo $_GET[id_lote]; ?>&id_itens=<?php echo $linha[id_itens]; ?>&id_cod=<?php echo $_GET[id_cod]; ?>"><img src="imagens/edit.png" border="0"/></a>
        <a href="conf_ne_exc.php?apagar=<?php echo $linha[id_ne]; ?>&num_ne=<?php echo $linha[num_ne]; ?>&id_cod=<?php echo $linha_codigo[id_cod]; ?>&id_itens=<?php echo $_REQUEST[id_itens];?>"><img src="imagens/delete.png" border="0"/></a>
        
      
</tr>

  <?php
//require "tab_cont_itens_tudo.php";

    //pega a próxima linha
    $linha = mysql_fetch_assoc($res);
}



//require_once "rel_licita.php";

//echo '<br>';
?>
  

    <tr>
        <td colspan="19">Total de notas de empenho: <?php echo $c ?></td>
        
    </tr>
</table><br>
  </table>
  <br><br>
</table>
