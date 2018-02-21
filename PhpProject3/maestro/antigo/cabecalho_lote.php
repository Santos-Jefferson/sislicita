<?php

//session_start();            //abri a sessão
//if(!isset($_SESSION[autenticado])){
 //   echo '<a href="login.php">Efetue seu login para ter acesso ao sitema</a>';
  //  die;
//}

?>


<tr>
    <th colspan="2" align="center" class="A" scope="col">CADASTROS COMPLETOS - LICITAÇÕES</th>
  </tr>
<tr>
        <th colspan="2" height="38" align="left" class="A" scope="col">
            <input type='button' value='Menu Principal'
               onclick='document.location.href="cabecalho.php"'><br><br>
            <input type='button' value='Cadastrar Licitação'
               onclick='document.location.href="cad_codigo.php"'>
            <input type='button' value='Listagem Lic/Lotes/Grupos'
               onclick='document.location.href="lista_lote_tudo.php"'>
            <input type='button' value='Alterar Lot/Gru'
               onclick='document.location.href="lista_lote_alt.php"'>
            <input type='button' value='Excluir Lot/Gru'
               onclick='document.location.href="lista_lote_exc.php"'>
    </tr>