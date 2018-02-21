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
            Remover item N° <?php echo $_GET[item]; ?>?
            <input type='button' value='SIM'
               onclick='document.location.href="apaga_itens_ne.php?apagar=<?php echo $_GET[apagar]; ?>&id_lote=<?php echo $_GET[id_lote];?>&id_cod=<?php echo $_GET[id_cod];?>&id_ne=<?php echo $_GET[id_ne]; ?>&num_ne=<?php echo $_GET[num_ne]; ?>"'>
            <input type='button' value='NÃO'
               onclick='document.location.href="lista_licita_tudo.php">
        </td>
        
            
    </tr>

