

<?php

//para adicionar itens, sempre dar um SELECT tabela WHERE codigo=



//require "conecta.php";
//require_once "cabecalho_reduzido.php";
//require_once "cabecalho_cad.php";



// se o GET[order] for vazio, então será preenchido com um valor padrão
if(empty($_GET[order])) $_GET[order] = 'data_hora';
    
$sql = "SELECT * FROM cadastro WHERE codigo LIKE '%{$_GET[codigo]}%' ORDER BY {$_GET[order]}";

$res = mysql_query($sql) or die("Erro seleção");

$v = 0; //conterá a somatória dos valores
$c = 0; //total de registros

//pega a primeira linha do resultado
$linha = mysql_fetch_assoc($res);

require_once "pes_rapida_cad_tudo.php";
require "var_formulas.php"

?>

<table align="center" class="A" border="0">
<table align="center" class="A" width="1020" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <th width="377" >ÓRGÃO</th>
    <th width="132" scope="col">CÓDIGO</th>
    <th width="132" scope="col">DATA/HORA</th>
    <th width="132" scope="col">LOTE/GRUPO</th>
    <th width="213" scope="col">LICITANTE</th>
  </tr>
  <tr>
    <td><?php echo $linha[orgao] ?></td>
    <td><?php echo $linha[codigo] ?></td>
    <td><?php echo $linha[data_hora] ?></td>
    <td><?php echo $linha[lote] ?></td>
    <td><?php echo $linha[licitante] ?></td>
  </tr>
</table>
<table align="center" class="A" width="1020" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <th width="30" scope="col">ITEM</th>
    <th width="30" scope="col">QTDE</th>
    <th width="241" scope="col">PRODUTO</th>
    <th width="60" scope="col">V.UN.CUSTO</th>
    <th width="60" scope="col">V.TO.CUSTO</th>
    <th width="72" scope="col">FORN</th>
    <th width="58" scope="col">V.FRETE</th>
    <th width="57" scope="col">IMPOSTO</th>
    <th width="58" scope="col">C.APROX.</th>
    <th width="58" scope="col">L.LIQ.</th>
    <th width="58" scope="col">V.OFERT</th>
    <th width="60" scope="col">V.MIN.OFER</th>
    <th width="58" scope="col">V.ITEM</th>
    <th width="58" scope="col">V.MIN.ITEM</th>
    <th width="30" scope="col">%</th>
  </tr>
  <tr>
    <td>&nbsp;<?php echo $linha[item] ?></td>
    <td>&nbsp;<?php echo $linha[qtde] ?></td>
    <td>&nbsp;<?php echo $linha[produto] ?></td>
    <td>&nbsp;<?php echo $linha[valor_unit_custo] ?></td>
    <td>&nbsp;<?php echo $linha[valor_tot_custo] ?></td>
    <td>&nbsp;<?php echo $linha[forn] ?></td>
    <td>&nbsp;<?php echo $linha[valor_frete] ?></td>
    <td>&nbsp;<?php echo $linha[imposto] ?></td>
    <td>&nbsp;<?php echo $linha[custo_aprox] ?></td>
    <td>&nbsp;<?php echo $linha[lucro_liq] ?></td>
    <td>&nbsp;<?php echo $linha[vofertado] ?></td>
    <td>&nbsp;<?php echo $linha[vminofertar] ?></td>
    <td>&nbsp;<?php echo $linha[vitem] ?></td>
    <td>&nbsp;<?php echo $linha[vminitem] ?></td>
    <td>&nbsp;<?php echo $linha[porcentagem_lucro] ?></td>
  </tr>
  <tr>
    <th colspan="4" scope="row">TOTAIS</th>
    <td>R$</td>
    <td>&nbsp;</td>
    <td>R$</td>
    <td>R$</td>
    <td>R$</td>
    <td>R$</td>
    <td>R$</td>
    <td>R$</td>
    <td>R$</td>
    <td>R$</td>
    <td>%</td>
  </tr>
</table>
</tr>
</table>




