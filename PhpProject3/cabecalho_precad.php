<?php
//session_start();            //abri a sessão
//if(!isset($_SESSION[autenticado])){
 //   echo '<a href="login.php">Efetue seu login para ter acesso ao sitema</a>';
  //  die;
//}
include "css.php";
?>

<tr>
    <td colspan="" align="center" class="A" scope="col"><strong>PRÉ-CADASTROS - LICITAÇÕES</td>
    <td colspan="2"align="center"><input type='button' value='Menu Principal' class='botao'
               onclick='document.location.href="cabecalho.php"'></td>
  </tr>
    <tr>
        <th colspan="1" align="left" class="A" scope="col">
            
            <input type='button' value='Cadastrar pré-licitação' class='botao'
               onclick='document.location.href="precad_licita.php"'>
            <input type='button' value='Listar pré-licitações' class='botao'
               onclick='document.location.href="lista_precad_tudo.php"'>
            <!--<input type='button' value='Alterar pré-cadastro'
               onclick='document.location.href="lista_precad_alt.php?alt=alt"'>
            <input type='button' value='Excluir pré-cadastro'
               onclick='document.location.href="lista_precad_exc.php?exc=exc"'>-->
<?php

//echo ($_GET[exc]);
//echo ($_GET[alt]);
?>

     <td colspan="3" align="center" class="A" scope="col">
        <form action="
                            <?php   if (isset($_GET[exc])) echo "lista_precad_exc.php";
                                elseif (isset($_GET[alt])) echo "lista_precad_alt.php";
                                    else echo "lista_precad_tudo.php";?>" method="GET">
            Busca (cód. lic.): <input type="text" name="codigo" maxlength="200" size="10">
            <input type="submit" value="Buscar" class='botao'>
        </form>
     </td>
</tr>
</table>

