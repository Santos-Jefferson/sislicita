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
            Remover o Produto <b><?php echo $_GET[prod_ent]; ?>?
            <input type='button' value='SIM'
               onclick='document.location.href="apaga_prod_ent.php?apagar=<?php echo $_GET[apagar]; ?>&id_cad_prod=<?php echo $_GET[id_cad_prod]; ?>&id_cad_prod_ent=<?php echo $_GET[id_cad_prod_ent]; ?>"'>
            <input type='button' value='NÃO'
               onclick='document.location.href="lista_cad_entrada_prod_tudo.php"'>
        </td>
    </tr>

