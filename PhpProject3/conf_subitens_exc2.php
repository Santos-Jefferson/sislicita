<?php
include "css.php";
//require "conecta.php";
//$sql = "SELECT * FROM precadastro WHERE codigo LIKE '%{$_GET[codigo]}%' ORDER BY {$_GET[order]}";

//$res = mysql_query($sql) or die("Erro seleção");

//pega a primeira linha do resultado
//$linha = mysql_fetch_assoc($res);
//print_r ($_REQUEST);
?>



<table>
   <tr>
        <td colspan="2" align="left" bgcolor="red" class="A" scope="col">
            Remover o sub-item <?php echo $_GET[apagar]; ?>?
            <input type='button' value='SIM'
               onclick='document.location.href="apaga_subitens2.php?apagar=<?php echo $_GET[id_subitem]; ?>&id_item=<?php echo $_GET[id_item]; ?>"'>
            <input type='button' value='NÃO'
               onclick='document.location.href="cad_itens_det2.php?id_item=<?php echo $_GET[id_item]; ?>"'>
        </td>
        
            
    </tr>
</table>

