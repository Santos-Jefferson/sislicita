<?php
require "cabecalho_reduzido.php";
require "conecta.php";
$sql = "SELECT * FROM notaempenho WHERE id_ne LIKE '%{$_GET[apagar]}%'";

$res = mysql_query($sql) or die("Erro seleção");

//pega a primeira linha do resultado
$linha = mysql_fetch_assoc($res);
//print_r ($_REQUEST);
?>




   <tr>
        <td colspan="3" align="left" bgcolor="red" class="A" scope="col">
            Remover NE N° <h1><b><?php echo $linha[num_ne]; ?></b></h1>
            <input type='button' value='SIM'
               onclick='document.location.href="apaga_ne.php?apagar=<?php echo $_GET[apagar]; ?>&id_cod=<?php echo $_GET[id_cod];?>&id_lote=<?php echo $linha[id_lote];?>&id_itens=<?php echo $_REQUEST[id_itens];?>"'>
            <input type='button' value='NÃO'
               onclick='document.location.href="cad_ne.php?id_cod=<?php echo $_GET[id_cod];?>&id_lote=<?php echo $linha[id_lote];?>&id_itens=<?php echo $_REQUEST[id_itens];?>"'>
        </td>
</tr>

