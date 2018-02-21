<?php
require "conecta.php";



//print_r ($_POST);
$usuario = $_GET[usuario];
$senha = $_GET[senha];

$sql = "SELECT * FROM usuarios WHERE usuario='{$_GET[usuario]}' and senha=MD5('{$_GET[senha]}')";

$res = mysql_query($sql) or die("Erro de usuário e/ou senha");

//testa se houve retorno de 1 linha. Se houve, sinal que usuário e senha estão corretos.

//testa se for admin, cai em outro cabeçalho para privilegios de administrador
//if(isset($_GET[usuario]) and ($_GET[usuario] == "admin")){
//    session_start();                    //Abre a sessão
//    $_SESSION['autenticado'] = TRUE;
//    require "cabecalho.php";
//    }
if(mysql_num_rows($res)== 1){
    session_start();                    //Abre a sessão
    $_SESSION['autenticado'] = TRUE;    //Cria uma variável de sessão para testes
    $_SESSION['usuario'] = $usuario;
    $_SESSION['senha'] = $senha;
    header("Location:cabecalho_geral.php?usuario=$usuario");
    }

?>

<tr>
    <td align="center" bgcolor="red" class="A" colspan="2">
        <strong>Usuário e/ou Senha incorretos.</strong><br>
        Favor <a href="login.php">tente novamente</a> ou entre em contato
        com o administrador do sistema.
    </td>
</tr>
