
<?php
require_once "cabecalho_geral.php";
include "css.php";
//testao se o usuário foi autenticado.
//não pode haver HTML ANTES deste PHP.
session_start();            //abri a sessão
if(!isset($_SESSION[autenticado])){
    echo '<a href="login.php">Efetue seu login para ter acesso ao sitema</a>';
    die;
}
require_once "cabecalho_reduzido.php";
//$user_logged=$_GET[usuario];
//$url = file_get_contents('https://www.comprasnet.gov.br/pregao/fornec/Mensagens_Sessao_Publica.asp?prgCod=489827');

?>
<table width="1010" align="center" class="A" border="1" cellpadding="2" cellspacing="0">
    <tr>
        <th colspan="3" height="38" align="left" class="A" scope="col">
           
            
            <input type='button' value='Contas a Pagar/Receber' class='botao'
               onclick='document.location.href="cad_contas_pagar_receber.php?usuario=<?php echo "$user_logged"; ?>"'>          
            <input type='button' value='Caixa' class='botao'
               onclick='document.location.href="caixa.php?usuario=<?php echo "$user_logged"; ?>"'>
            
         
    </tr>
</table>

    
<?php


//require_once "lista_licita_mes_todos.php";
//echo $url;
//require_once "premios_meta_mes.php";
?>



