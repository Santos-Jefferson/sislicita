<?php
require "conecta.php";
require_once "cabecalho_html.php";
//require_once "cabecalho.php";
require_once "css.php";

//print_r ($usuario);
//print_r ($senha);
//die;

    $sql = "SELECT * FROM cad_fornecedor WHERE cnpj='{$_GET[cnpj]}'";
    $res = mysql_query($sql) or die("Erro seleção - linha");
    $linha = mysql_fetch_assoc($res);

?>
<table width="1020" align="center" class="A" border="1" cellpadding="2" cellspacing="0">
    <!--</table>-->
<!--<table width="1020" align="center" class="A" border="1" cellpadding="2" cellspacing="0">-->
    <tr class="forms">
            
            <th colspan="2" align="center"><H1>DADOS COMPLETOS - FORNECEDOR:<br><?php echo $linha[razao_social]." "."-"." ".$linha[cnpj]; ?></th>
        </tr>
        
        <tr class="">
            <!--<th>Cod_int</th>-->
            <th align="right" width="185">RAZÃO SOCIAL:</th>
            <td align="left"><?php echo $linha[razao_social]; ?></td>
        </tr>
        <tr>
            <th align="right">NOME FANTASIA:</th>
            <td align="left"><?php echo $linha[nome_forn]; ?></td>
        </tr>
        <tr>
            <th align="right">ENDEREÇO:</th>
            <td align="left"><?php echo $linha[end_completo]." "."-"." ".$linha[cidade]."/".$linha[estado]; ?></td>
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
            <th align="right">WEBSITE:</th>
            <td align="left"><?php echo $linha[website_forn]; ?></td>
            
        </tr>
        <tr>            
            <th align="right">USUÁRIO / SENHA::</th>
            <td align="left"><?php echo $linha[usuario_forn]." "."/"." ".$linha[senha_forn]; ?></td>
            
        </tr>
        <tr bgcolor="coral">
            <th align="right">CONTATO COMERCIAL:</th>
            <td align="left"><?php echo $linha[contato_forn]                          ?></td>
               
        </tr>
         <tr bgcolor="coral">
            <th align="right">EMAIL COMERCIAL:</th>
            <td align="left"><a href="mailto:<?php echo $linha[email_forn];?>?subject=Cotação"><?php echo $linha[email_forn]                          ?></a></td>
        </tr>
         <tr bgcolor="coral">
            <th align="right">SKYPE COMERCIAL:</th>
            <td align="left"><?php echo $linha[msn_forn]                          ?></td>
               
        </tr>
         <tr bgcolor="coral">
            <th align="right">FONE COMERCIAL:</th>
            <td align="left"><?php echo $linha[fone_forn];?></td>
        </tr>
        <tr bgcolor="CORNSILK">
            <th align="right">CONTATO RMA:</th>
            <td align="left"><?php echo $linha[contato_rma]                          ?></td>
               
        </tr>
        <tr bgcolor="CORNSILK">
            <th align="right">EMAIL RMA:</th>
            <td align="left"><a href="mailto:<?php echo $linha[email_rma];?>?subject=Cotação"><?php echo $linha[email_rma]                          ?></a></td>
        </tr>
        <tr bgcolor="CORNSILK">
            <th align="right">SKYPE RMA:</th>
            <td align="left"><?php echo $linha[skype_rma]                          ?></td>
               
        </tr>
        <tr bgcolor="CORNSILK">
            <th align="right">FONE RMA:</th>
            <td align="left"><?php echo $linha[fone_rma];?></td>
        </tr>
        <tr bgcolor="AQUAMARINE">
            <th align="right">CONTATO FINANCEIRO:</th>
            <td align="left"><?php echo $linha[contato_fin]                          ?></td>
               
        </tr>
        <tr bgcolor="AQUAMARINE">
            <th align="right">EMAIL FINANCEIRO:</th>
            <td align="left"><a href="mailto:<?php echo $linha[email_fin];?>?subject=Cotação"><?php echo $linha[email_fin]                          ?></a></td>
        </tr>
        <tr bgcolor="AQUAMARINE">
            <th align="right">SKYPE FINANCEIRO:</th>
            <td align="left"><?php echo $linha[skype_fin]                          ?></td>
               
        </tr>
        <tr bgcolor="AQUAMARINE">
            <th align="right">FONE FINANCEIRO:</th>
            <td align="left"><?php echo $linha[fone_fin];?></td>
        </tr>
        <tr>
            <th align="right">SEGMENTO PREDOMINANTE:</th>
            <td align="left" ><?php echo $linha[segmento_forn]                          ?></td>
        </tr>
        <tr>
            <th align="right">OBS / INFO ADICIONAL:</th>
            <td align="left" ><?php echo $linha[obs_info]                          ?></td>
        </tr>
        
            
            
            