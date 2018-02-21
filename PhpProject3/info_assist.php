<?php
require "conecta.php";
require_once "cabecalho_html.php";
//require_once "cabecalho.php";
require_once "css.php";

//print_r ($usuario);
//print_r ($senha);
//die;

    $sql = "SELECT * FROM cad_assistencias WHERE cnpj='{$_GET[cnpj]}'";
    $res = mysql_query($sql) or die("Erro seleção - linha");
    $linha = mysql_fetch_assoc($res);

?>
<table width="1020" align="center" class="A" border="1" cellpadding="2" cellspacing="0">
    <!--</table>-->
<!--<table width="1020" align="center" class="A" border="1" cellpadding="2" cellspacing="0">-->
    <tr class="forms">
            
            <th colspan="2" align="center"><H1>DADOS COMPLETOS - ASSISTÊNCIA:<br><?php echo $linha[razao_social]." "."-"." ".$linha[cnpj]; ?></th>
        </tr>
        
        <tr class="">
            <!--<th>Cod_int</th>-->
            <th align="right" width="185">RAZÃO SOCIAL:</th>
            <td align="left"><?php echo $linha[razao_social]; ?></td>
        </tr>
        <tr>
            <th align="right">NOME FANTASIA:</th>
            <td align="left"><?php echo $linha[nome_assist]; ?></td>
        </tr>
        <tr>
            <th align="right">ENDEREÇO:</th>
            <td align="left"><?php echo $linha[end_completo]; ?></td>
        </tr>
        <tr>
            <th align="right">CNPJ:</th>
            <td align="left"><?php echo $linha[cnpj]; ?></td>
        </tr>
        <tr>
            <th align="right">IE:</th>
            <td align="left"><?php echo $linha[ie]; ?></td>
            
        </tr>
        <tr>
            <th align="right">CÓDIGO BANCO / NOME DO BANCO:</th>
            <td align="left"><?php echo $linha[cod_banco]; ?></td>
            
        </tr>
        <tr>            
            <th align="right">AGENCIA / CONTA CORRENTE:</th>
            <td align="left"><?php echo $linha[ag_cc]; ?></td>
            
        </tr>
        <tr>
            <th align="right">CONTATO:</th>
            <td align="left"><?php echo $linha[contato_assist]                          ?></td>
               
        </tr>
        <tr>
            <th align="right">EMAIL:</th>
            <td align="left"><a href="mailto:<?php echo $linha[email_assist];?>?subject=Assistência Técnica"><?php echo $linha[email_assist]                          ?></a></td>
        </tr>
        <tr>
            <th align="right">FONES:</th>
            <td align="left"><?php echo "$linha[fone_assist]\n$linha[fone_assist2]\n$linha[fone_assist3]";?></td>
        </tr>
        <tr>
            <th align="right">CIDADE ATENDIDA:</th>
            <td align="left" ><?php echo $linha[cidade]                          ?></td>
        </tr>
        <tr>
            <th align="right">UF:</th>
            <td align="left" ><?php echo $linha[estado]                          ?></td>
        </tr>
        <tr>
            <th align="right">AUT. POSITIVO?:</th>
            <td align="left"><?php echo $linha[aut_positivo]                          ?></td>
            
        </tr>
        <tr>
            <th align="right">VALOR CHAMADO:</th>
            <td align="left"><?php echo "R$"." ".number_format($linha[valor_chamado],2, ',','.');           ?></td>
            
        </tr>
        <tr>
            <th align="right">VALOR RETORNO/ADIC.:</th>
            <td align="left"><?php echo "R$"." ".number_format($linha[valor_retorno],2, ',','.');                         ?></td>
            
        </tr>
        <tr>
            <th align="right">OBS / MAIS INFO</th>
            <td align="left"><?php echo $linha[obs_info]                          ?></td>
        </tr>
            
            
            