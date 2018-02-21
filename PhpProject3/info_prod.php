<?php
require "conecta.php";
require_once "cabecalho_html.php";
//require_once "cabecalho.php";
require_once "css.php";

//print_r ($usuario);
//print_r ($senha);
//die;

    $sql = "SELECT * FROM cad_produto WHERE part_number='{$_GET[part_number]}'";
    $res = mysql_query($sql) or die("Erro seleção - linha");
    $linha = mysql_fetch_assoc($res);

?>
<table width="1010" align="center" class="A" border="1" cellpadding="2" cellspacing="0">
    <!--</table>-->
<!--<table width="1020" align="center" class="A" border="1" cellpadding="2" cellspacing="0">-->
    <tr class="forms">
            
            <th colspan="2" align="center"><H1>DADOS COMPLETOS - PRODUTO:<br><?php echo $linha[tipo_prod]." "."-"." ".$linha[marca_prod]." "."-"." ".$linha[desc_prod]; ?></th>
        </tr>
        
        <tr class="">
            <!--<th>Cod_int</th>-->
            <th align="right" width="185">INFORMAÇÕES ADICIONAIS:</th>
            <td align="left"><?php echo $linha[info_adic_prod]; ?></td>
        </tr>
        <tr>
            <th align="right">FOTO:</th>
            <td align="left"><?php echo $linha[foto_prod]; ?></td>
        </tr>
              
            
            
            