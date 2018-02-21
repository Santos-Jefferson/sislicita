<?php

//session_start();            //abri a sessão
//if(!isset($_SESSION[autenticado])){
 //   echo '<a href="login.php">Efetue seu login para ter acesso ao sitema</a>';
  //  die;
//}

?>

<tr>
    <td colspan="" align="center" class="A"><strong>CADASTROS COMPLETOS - LICITAÇÕES</td>
    <td><input type='button' value='Menu Principal' onclick='document.location.href="cabecalho.php"'></td>
</tr>
<tr>
        <td colspan="1" align="left" class="A" >
            
            <input type='button' value='Cadastrar Licitação'
               onclick='document.location.href="cad_codigo.php"'>
            <input type='button' value='Listar Licitações'
               onclick='document.location.href="lista_licita_tudo.php"'>
            <!--<input type='button' value='Alterar Lot/Gru'
               onclick='document.location.href="lista_lote_alt.php"'>
            <input type='button' value='Excluir Lot/Gru'
               onclick='document.location.href="lista_lote_exc.php"'>-->
        </td>
        
        <td colspan="0" align="center" class="A" scope="col">
        <form action="
            <?php
                if (isset($_GET[exc])) echo "lista_precad_exc.php";
                    elseif (isset($_GET[alt])) echo "lista_precad_alt.php";
                    else echo "lista_licita_tudo.php";?>" method="GET">
                Busca (cód. lic.): <input type="text" name="codigo" maxlength="10" size="10">
            <input type="submit" value="Buscar">
        </form>
        </td>
</tr>
</table>
