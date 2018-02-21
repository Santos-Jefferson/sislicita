<?php
include "../css.php"; 
include "../cabecalho_html.php"; 

if (!empty($_POST)){

//-------------CAMPO codigo-------------------------
if (empty($_POST[nome])){
        $erro = $erro_nome = true;
        }  
    
    if (empty($_POST[fixo])){
        $erro = $erro_fixo = true;
        }    
    
if (empty($_POST[celular])){
        $erro = $erro_celular = true;
        }
    
    
//não pode ser vazio o campo (campo obrigatório)
    if (empty($_POST[email])){
        $erro = $erro_email = true;
        }
}

?>

<html>
    
<img src="../imagens/hinode.jpg" border="0">

<form action="<?php if ($erro or empty($_POST)) echo "index.php";
                            else echo "envia.php"; ?>" method="POST" name="envia" enctype="multipart/form-data">

<!--<form method="post" action="envia.php" enctype="multipart/form-data">-->
<input type="HIDDEN" name="redirect" value="https://www.hinode.com.br/portalhinode/vo/mw-arquivos/Universo_Ciclos_Nov_Dez_2013.pdf">
 <table class="A" width="" border="0">
 <tbody>


<!--<h2>SEJA UM(A) CONSULTOR(A) COM 100% DE LUCRO SOBRE SUAS VENDAS!!!<h2>
<h2>TRAGA SUA EQUIPE PARA HINODE!!!<h2>-->
 <h3>Informe seus dados abaixo para iniciarmos seu CADASTRO GRATUITO!!!<br><br>
Ou se preferir, entre em contato:<br><br>
    (41) 9114-0519 - VIVO<br>
    (41) 9714-9444 - TIM<br>
    (41) 8426-3889 - OI<br>
    (41) 8866-6128 - CLARO<br>
    EMAIL: dyulifialla@gmail.com<br><br>
    SUPERVISORA DE EQUIPE: Dyuliane Fialla (ID: 96805)<br>
    </h3>
 <hr>

    
          
 <tr>
 <td height="19" width="25%" style="text-align: right;">NOME:
 </td>
 <td height="19" width="75%">
 <input type="text" name="nome" style="width: 300px;" value="<?php echo $_POST[nome]; ?>">
 <?php
                            if($erro_nome){
                                echo "<font color=red>*** Campo obrigatório</font>";
                            }
                        ?>
 </td>
 </tr>
 <tr>
 <td height="19" width="25%" style="text-align: right;">CPF:
 </td>
 <td height="19" width="75%">
 <input type="text" name="cpf" id="email" style="width: 300px;">
 </td>
 </tr>
 <tr>
 <td height="19" width="25%" style="text-align: right;">RG:
 </td>
 <td height="19" width="75%">
 <input type="text" name="rg" id="email" style="width: 300px;">
 </td>
 </tr>
 <tr>
 <td height="19" width="25%" style="text-align: right;">E-MAIL:
 </td>
 <td height="19" width="75%">
 <input type="text" name="email" id="email" style="width: 300px;" value="<?php echo $_POST[email]; ?>">
 <?php
                            if($erro_email){
                                echo "<font color=red>*** Campo obrigatório</font>";
                            }
                        ?>
 </td>
 </tr>
 <tr>
 <td height="19" width="25%" style="text-align: right;">TELEFONE FIXO:</td>
 <td height="19" width="75%">
 <input type="text" name="fixo" style="width: 300px;" value="<?php echo $_POST[fixo]; ?>">
 <?php
                            if($erro_fixo){
                                echo "<font color=red>*** Campo obrigatório</font>";
                            }
                        ?>
 </td>
 </tr>
 <tr>
     <tr>
 <td height="19" width="25%" style="text-align: right;">CELULAR:</td>
 <td height="19" width="75%">
 <input type="text" name="celular" style="width: 300px;" value="<?php echo $_POST[celular]; ?>">
 <?php
                            if($erro_celular){
                                echo "<font color=red>*** Campo obrigatório</font>";
                            }
                        ?>
 </td>
 </tr>
 <tr>
 <td height="19" width="25%" style="text-align: right;">ENDEREÇO Completo com CEP, Cidade e Estado:
 </td>
 <td height="19" width="75%">
 <input type="text" name="endereco" style="width: 900px;">
 </td>
 </tr>
 <tr>
 <tr>
 <tr>
 <td height="19" width="25%">
 </td>
 
 <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                    echo '<script language="javascript">document.envia.submit()</script>';
                }
            
            ?> 
 
 
 <td height="19" width="75%">
 <input type="submit" name="Submit" value="CADASTRAR e ver CATÁLOGO HINODE">
 <input type="reset" name="Reset" value="Limpar">
 </td>
 </tr>
 </tbody></table>
</form>
</html>