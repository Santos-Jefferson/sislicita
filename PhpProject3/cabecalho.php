
<?php
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

    <tr>
        <th colspan="3" height="38" align="left" class="A" scope="col">
           
            
            <input type='button' value='Pré-cadastro' class='botao'
               onclick='document.location.href="menu_precad.php?usuario=<?php echo "$user_logged"; ?>"'>          
            <input type='button' value='Cadastro completo' class='botao'
               onclick='document.location.href="menu_cad.php?usuario=<?php echo "$user_logged"; ?>"'>
            <input type='button' value='Produtos' class='botao'
               onclick='document.location.href="lista_cad_produto_tudo.php?usuario=<?php echo "$user_logged"; ?>"'>
            <input type='button' value='Fornecedores' class='botao'
               onclick='document.location.href="lista_cad_fornecedor_tudo.php?usuario=<?php echo "$user_logged"; ?>"'>
            <input type='button' value='Transportadoras' class='botao'
               onclick='document.location.href="lista_cad_transportadora_tudo.php?usuario=<?php echo "$user_logged"; ?>"'>
            <input type='button' value='Assistências' class='botao'
               onclick='document.location.href="lista_cad_assistencias_tudo.php?usuario=<?php echo "$user_logged"; ?>"'>
            <!--<input type='button' value='META MÊS'
               onclick='document.location.href="selec_relatorio_meta.php"'>-->
            <input type='button' value='META MÊS ADJ' class='botao'
               onclick='document.location.href="selec_relatorio_meta_adj.php"'>
            <input type='button' value='Relatório Positivo' class='botao'
               onclick='document.location.href="rel_ro_positivo.php"'>
            <input type='button' value='Relatório Geral' class='botao'
               onclick='document.location.href="rel_todas_licitacoes.php"'>
            <!--<input type='button' value='PRÓXIMO DIA'
               onclick='document.location.href="selec_relatorio_proxdiautil.php"'>-->
         
    </tr>
</table>
<br>
    
<?php


require_once "lista_licita_mes_todos.php";
//echo $url;
//require_once "premios_meta_mes.php";
?>



