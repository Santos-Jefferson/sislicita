<?php
require "conecta.php";
require_once "cabecalho_reduzido.php";
require_once "cabecalho_precad.php";

//seleciona a linha q marquei no radio
$sql = "SELECT * FROM precadastro WHERE id={$_GET[alterar]}";
//executa a query
$res = mysql_query($sql) or die("Erro selecionando");
//desmonta o resutaldo e coloca os elementos do registro na linha
$linha = mysql_fetch_assoc($res);
//agora temos a linha preenchida com os dados do registro (acima)

?>
    
<tr>
    <th colspan="2" height="159" align="left" class="A" scope="col">
    <form action="grava_precad.php" method="POST">
            <input type="hidden" name="id" size="3" maxlength="3" value="<?php echo $linha[id]?>"><br><br>

            <p>Licitante:
              <select  name="licitante" size="0">
                <option><?php echo $linha[licitante] ?></option>
                <option>Dyuliane</option>
                <option>Getulio</option>
                <option>Marcelo</option>
              </select>
              <br><br>
            
            Cód. BB/UASG/PREGÃO: <input type="text" name="codigo" size="16" maxlength="16" value="<?php echo $linha[codigo]?>"><br><br>
            D/H - Inclusão: <input type="text" name="data" size="20" maxlength="10" value="<?php echo $linha[data]?>"><br><br>
            Status:
              <select name="status" size="0" default="<?php echo $linha[status]?>">
                <option>Aguardando pregão</option>
                <option>Encerrada-Acompanhar</option>
                <option>Encerrada-Arrematado</option>
                <option>Arquivado</option>
              </select><br><br>
            <input type="submit" value="Pré-Cadastrar" />
         </p>
    </form>  
  </tr>
  
  
  
  