<?php
require "conecta.php";
require_once ("cabecalho_reduzido.php");
require_once ("cabecalho_precad.php");
    
//require ("corpo_menu.php");
//exibir a tabela com os pré-cadastros feitos.
//require ("pesquisa_licita.php");

//======================VALIDAÇÃO E CONVERSÃO DE DADOS=====================
//validação só funcionará quando não for a primeira vez que entra-se no formulario
//!empty (se não for vazio, faça os testes abaixo)



//pega a primeira linha do resultado
//$linha = mysql_fetch_assoc($res);


if (!empty($_POST)){
    
if (empty($_POST[licitante]))    {
    $erro = $erro_licitante = true;
    }
  
if (empty($_POST[codigo])){
    $erro = $erro_codigo = true;
    }

    if (empty($_POST[status])){
    $erro = $erro_status = true;
    }
}
    

    
//DESATIVADO
//----------------CAMPO vofertado-------------------
//validação só funcionará quando não for a primeira vez que entra-se no formulario
//!empty (se não for vazio, faça os testes abaixo)
//if (!empty($_POST)){
//    //troca , por .
//   $_POST[vofertado] = (str_replace(',','.',$_POST[vofertado]));
//    //
//    //testa se é numérico ou nao
//    if(!is_numeric($_POST[vofertado])){
//       $erro = $erro_vofertado = true;
//       }
//    //TESTE SE O valor está na faixa permitida
//    elseif($_POST[vofertado] <0 or $_POST[vofertado] > 100){
//        $erro = $erro_vofertado_faixa = true;
//    }
//}

?>
</table><br>    
<tr>
    <th colspan="2" height="159" align="left" class="A" scope="col">
    <form action="<?php if ($erro or empty($_POST)) echo "precad_licita.php";
                            else echo "grava_precad.php"; ?>" method="POST" name="precad_licita">
                            
       <table align="center" border="1" width="1020" class="A" cellpading="0" cellspacing="0">
            <tr border="1">
                <td border="1">
        <table align="center" width="1010" border="0" class="A" cellpading="0" cellspacing="0" >
            <tr>
                <td colspan="2" align="center"><strong>PRÉ-CADASTRE AQUI SUA LICITAÇÃO A PARTICIPAR<hr></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            
            
            <tr>
                <td width="150" align="right">Licitante:</td>
                <td>
                    <select name="licitante" size="0" >
                        <option><?php echo $_POST[licitante]; ?></option>
                        <option>Dyuliane</option>
                        <option>Getulio</option>
                        <option>Marcelo</option>
                    </select>
                        <?php
                            if($erro_licitante){
                                echo "<font color=red>*** Campo obrigatório</font>";
                            }
                        ?>
                </td>
            </tr>
            <tr>
                <td align="right">Cód. BB/UASG/PREGÃO:</td>
                <td><input type="text" name="codigo" size="16" maxlength="16" value="<?php echo $_POST[codigo]; ?>">
                <?php
                        if($erro_codigo){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                        elseif ($erro_codigo_exite){
                            echo "<font color=red>*** CÓDIGO JÁ EXISTE!!!</font>";
                        }
                    ?>
                
                </td>
            </tr>
            <tr>
                <td align="right">D/H - Inclusão:</td>
                <td><input type="text" name="data" size="20" maxlength="10" value="<?php echo date("Y/m/d - H:i:s"); ?>"></td>
            </tr>
            <tr>
                <td align="right">Status:</td>
                <td><select name="status" size="0">
                        <option><?php echo $_POST[status]; ?></option>
                        <option>Aguardando pregao</option>
                        <option>Arquivado</option>
                        <option>Encerrada-Acompanhar</option>
                        <option>Encerrada-Arrematado</option>
                    </select>
                        <?php
                            if($erro_status){
                                echo "<font color=red>*** Campo obrigatório</font>";
                            }
                        ?>
              </td>
            </tr>
            
            <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                    echo '<script language="javascript">document.precad_licita.submit()</script>';
                }
            
            ?>
            
            <tr>
                <td></td>
                <td colspan="2" align="left"><input type="submit" value="Pré-Cadastrar" /></td>
            </tr>
            
            
        </form>  
  </tr>
