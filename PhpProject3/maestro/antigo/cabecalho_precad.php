<?php
//session_start();            //abri a sessão
//if(!isset($_SESSION[autenticado])){
 //   echo '<a href="login.php">Efetue seu login para ter acesso ao sitema</a>';
  //  die;
//}
?>

<tr>
    <th colspan="2" align="center" class="A" scope="col">PRÉ-CADASTROS - LICITAÇÕES</th>
  </tr>
<tr>
        <th colspan="2" height="38" align="left" class="A" scope="col">
            <input type='button' value='Menu Principal'
               onclick='document.location.href="cabecalho.php"'><br><br>
            <input type='button' value='Cadastrar pré-licitação'
               onclick='document.location.href="precad_licita.php"'>
            <input type='button' value='Listagem geral'
               onclick='document.location.href="lista_precad_tudo.php"'>
            <input type='button' value='Alterar pré-cadastro'
               onclick='document.location.href="lista_precad_alt.php"'>
            <input type='button' value='Excluir pré-cadastro'
               onclick='document.location.href="lista_precad_exc.php"'>
</tr>