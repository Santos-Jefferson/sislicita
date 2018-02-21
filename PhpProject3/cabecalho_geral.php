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

require ("conecta.php");
//Query pra pegar as datas das licitações de hoje para comparar com o horário atual e emitir audio de aviso.
/*$sql = "SELECT * FROM codigo,lote WHERE codigo.id_cod=lote.id_cod and codigo.data = CURDATE() and lote.id_lote != '' group by codigo.id_cod ORDER BY hora ASC"; //and tipo_licitacao LIKE '%{$_GET[codigo]}%' or codigo LIKE '%{$_GET[codigo]}%' or pregao LIKE '%{$_GET[codigo]}%' or orgao LIKE '%{$_GET[codigo]}%' or licitante LIKE '%{$_GET[codigo]}%' ORDER BY {$_GET[order]} DESC, {$_GET[order2]} ASC";
$res = mysql_query($sql) or die("Erro seleção - linha");
$linha = mysql_fetch_assoc($res);
if (date('H:i',strtotime($linha[hora])) == date('H:i'))
    {
        echo "<embed src='audio/audio01.mp3'width='1' height='1'>";
    }*/
?>

    <tr>
        <th colspan=2" height="38" align="left" class="A" scope="col">
           
            
            <input type='button' value='LICITAÇÕES' class='botao'
               onclick='document.location.href="menu_licitacoes.php?usuario=<?php echo "$user_logged"; ?>"'>          
            <input type='button' value='METAS' class='botao'
               onclick='document.location.href="selec_relatorio_meta_adj.php?usuario=<?php echo "$user_logged"; ?>"'>
            <input type='button' value='FORNECEDORES' class='botao'
               onclick='document.location.href="lista_cad_fornecedor_tudo.php?usuario=<?php echo "$user_logged"; ?>"'>
            <!--<input type='button' value='CLIENTES' class='botao'
               onclick='document.location.href="lista_cad_clientes_tudo.php?usuario=<?php echo "$user_logged"; ?>"'>-->
            <input type='button' value='TRANSPORTADORAS' class='botao'
               onclick='document.location.href="lista_cad_transportadora_tudo.php?usuario=<?php echo "$user_logged"; ?>"'>
            <input type='button' value='ASSISTÊNCIAS' class='botao'
               onclick='document.location.href="lista_cad_assistencias_tudo.php?usuario=<?php echo "$user_logged"; ?>"'>
            <input type='button' value='RELATÓRIOS' class='botao'
               onclick='document.location.href="#.php?usuario=<?php echo "$user_logged"; ?>"'>
            <!--<input type='button' value='META MÊS'
               onclick='document.location.href="selec_relatorio_meta.php"'>-->
            <input type='button' value='CERTIDÕES' class='botao'
               onclick='document.location.href="cad_certidoes.php"'>
            <!--<input type='button' value='FINANCEIRO' class='botao'
               onclick='document.location.href="menu_financeiro.php"'>-->
             
        <td colspan="2" align="center" class="A" scope="col">
        <form action="
            <?php
                if (isset($_GET[exc])) echo "lista_precad_exc.php";
                    elseif (isset($_GET[alt])) echo "lista_precad_alt.php";
                    else echo "lista_licita_tudo.php";?>" method="GET">
                Buscar: <input type="text" name="codigo" maxlength="10" size="10">
            <input type="submit" value="Buscar" class='botao'>
        </form>
        </td>
            
            
            
         
    </tr>
</table>
   
<?php

//echo "<br><br><br><br><br><br>";
$pagina = end(explode("/", $_SERVER['PHP_SELF']));
//echo $pagina;
if ($pagina == "cabecalho_geral.php"){
    echo "<br>";
    
    require_once "lista_cad_certidoes_dash.php";
    require_once "lista_licita_hoje_data.php";
    echo "<br>";
    require_once "lista_licita_mes_todos.php";
    
}
//echo $url;
//require_once "premios_meta_mes.php";

?>



