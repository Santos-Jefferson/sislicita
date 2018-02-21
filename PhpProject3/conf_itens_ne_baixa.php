<?php
require "cabecalho_reduzido.php";
require "conecta.php";
//$sql = "SELECT * FROM precadastro WHERE codigo LIKE '%{$_GET[codigo]}%' ORDER BY {$_GET[order]}";

//$res = mysql_query($sql) or die("Erro seleção");

//pega a primeira linha do resultado
//$linha = mysql_fetch_assoc($res);
//print_r ($_REQUEST);
?>




   <tr>
        <td colspan="2" align="left" bgcolor="red" class="A" scope="col">
            Remover Produto <?php echo $_GET[desc_prod_baixa]; ?>?
            <input type='button' value='SIM'
               onclick='document.location.href="apaga_itens_ne_baixa.php?apagar=<?php echo $_GET[apagar]; ?>&id_cad_prod=<?php echo $_GET[id_cad_prod];?>&id_ne=<?php echo $_GET[id_ne]; ?>&id_itens_ne=<?php echo $_GET[id_itens_ne]; ?>&num_ne=<?php echo $_GET[num_ne]; ?>"'>
            <input type='button' value='NÃO'
               onclick='document.location.href="cad_itens_ne_baixa.php?id_ne=<?php echo $_GET[id_ne]; ?>&id_itens_ne=<?php echo $_GET[id_itens_ne]; ?>"'>
        </td>
        
            
    </tr>

