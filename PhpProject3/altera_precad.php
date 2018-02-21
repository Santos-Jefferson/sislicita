<?php
require "conecta.php";
require_once "cabecalho_reduzido.php";
require_once "cabecalho_precad.php";
//print_r ($_GET);
//print_r ($_REQUEST);
//seleciona a linha q marquei no radio
$sql = "SELECT * FROM precadastro WHERE id={$_REQUEST[alterar]}";
//executa a query
$res = mysql_query($sql) or die("Erro selecionando (altera_precad.php)");
//desmonta o resutaldo e coloca os elementos do registro na linha
$linha = mysql_fetch_assoc($res);
//agora temos a linha preenchida com os dados do registro (acima)


/*if (!empty($linha)){
    
if (empty($linha[licitante]))    {
    $erro = $erro_licitante = true;
    }
  
if (empty($linha[codigo])){
    $erro = $erro_codigo = true;
    }

if (empty($linha[status])){
    $erro = $erro_status = true;
    }
}*/


    
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




<tr>
        <th colspan="2" height="159" align="left" class="A" scope="col">
        <form action="grava_precad.php" method="POST">
    <!--<form action="<?php //if ($erro or empty($_POST)) echo "altera_precad.php";
                            //else echo "grava_precad.php"; ?>" method="POST" name="altera_precad">-->
                            <br>
       <table align="center" border="1" width="1020" class="A" cellpading="0" cellspacing="0">
            <tr border="1">
                <td border="1">
        <table align="center" width="1010" border="0" class="A" cellpading="0" cellspacing="0" >
            <tr>
                <td colspan="2" align="center"><strong>ALTERE AQUI SUA LICITAÇÃO<hr></td>
            </tr>
            <tr>
                <td><br><br></td>
            </tr>
            
            <tr>
                <input type="hidden" name="id" size="3" maxlength="3" value="<?php echo $linha[id]?>">
                <td align="right">Licitante:</td>
                <td>
                    <select id="licitante" name="licitante">
                        <?php
            
                            $licitante_query="SELECT usuario FROM usuarios WHERE tipo_usuario='licitante' ORDER BY usuario ASC";
                            $licitante_result=mysql_query($licitante_query) or die ("Falha ao recuperar o NOME_FORN da base de dados: ".mysql_error());
                            echo "<option>$linha[licitante]</option>";

                            while ($licitante_row=mysql_fetch_array($licitante_result)) {
                            $licitante=$licitante_row[usuario];
                                echo "<option>$licitante</option>";
                                }
                            
                        ?>
                    </select>
                        <?php
                            if($erro_licitante){
                                echo "<font color=red>*** Campo obrigatório</font>";
                            }
                        ?>
                </td>
            </tr>
            <!--<tr>
                <input type="hidden" name="id" size="3" maxlength="3" value="<?php echo $linha[id]?>">
                <td width="150" align="right">Licitante:</td>
                <td>
                    <select name="licitante" size="0" >
                        <option><?php //echo $linha[licitante]; ?></option>
                        <!--<option>Dyuliane</option>
                        <option>Getulio</option>
                        <option>Marcelo</option>
                    </select>
                        <?php
                            //if($erro_licitante){
                              //  echo "<font color=red>*** Campo obrigatório</font>";
                            //}
                        ?>
                </td>
            </tr>-->
            <tr>
                <td align="right">Cód. BB/UASG/PREGÃO:</td>
                <td><input type="text" name="codigo" size="16" maxlength="16" value="<?php echo $linha[codigo]; ?>">
                <?php
                        //if($erro_codigo){
                          //  echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                        //elseif ($erro_codigo_exite){
                          //  echo "<font color=red>*** CÓDIGO JÁ EXISTE!!!</font>";
                        //}
                    ?>
                
                </td>
            </tr>
            <tr>
                <td align="right">D/H - Inclusão:</td>
                <td><input type="text" name="data" size="20" maxlength="10" value="<?php echo $linha[data]; ?>" disabled></td>
                <td><input type="hidden" name="data" size="20" maxlength="10" value="<?php echo $linha[data]; ?>"></td>
            </tr>
            <tr>
                <td align="right">Status:</td>
                <td><select name="status" size="0">
                        <option><?php echo $linha[status]; ?></option>
                        <option>Aguardando pregao</option>
                        <option>Arquivado</option>
                        <option>Encerrada-Acompanhar</option>
                        <option>Encerrada-Arrematado</option>
                    </select>
                        <?php
                          //  if($erro_status){
                            //    echo "<font color=red>*** Campo obrigatório</font>";
                            //}
                        ?>
              </td>
            </tr>
            
            <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                //if(!$erro and !empty($_POST)){
                  //  echo '<script language="javascript">document.altera_precad.submit()</script>';
                //}
            //print_r ($_REQUEST);
            ?>
            
            <tr>
                <td></td>
                <td colspan="2" align="left"><input type="submit" value="Alterar" /></td>
            </tr>
         </form>  
  </tr>
  
    



<!--<tr>
    <th colspan="2" height="159" align="left" class="A" scope="col">
    <form action="grava_precad.php" method="POST">
            <input type="hidden" name="id" size="3" maxlength="3" value="<?php //echo $linha[id]?>"><br><br>

            <p>Licitante:
              <select  name="licitante" size="0">
                <option><?php //echo $linha[licitante] ?></option>
                <option>Dyuliane</option>
                <option>Getulio</option>
                <option>Marcelo</option>
              </select>
              <br><br>
            
            Cód. BB/UASG/PREGÃO: <input type="text" name="codigo" size="16" maxlength="16" value="<?php //echo $linha[codigo]?>"><br><br>
            D/H - Inclusão: <input type="text" name="data" size="20" maxlength="10" value="<?php //echo $linha[data]?>"><br><br>
            Status:
              <select name="status" size="0" default="<?php //echo $linha[status]?>">
                <option>Aguardando pregao</option>
                <option>Encerrada-Acompanhar</option>
                <option>Encerrada-Arrematado</option>
                <option>Arquivado</option>
              </select><br><br>
            <input type="submit" value="Pré-Cadastrar" />
         </p>
    </form>  
  </tr>-->