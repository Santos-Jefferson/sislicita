<?php
require "conecta.php";
require_once "cabecalho_reduzido.php";
require_once "cabecalho_lote.php";

//$sql = "SELECT * from lote WHERE id_lote = {$_GET[id_lote]}";
//$lote = mysql_query($sql) or die ("Erro seleção lote");
//$linha_lote = mysql_fetch_assoc($lote);

//print_r ($_GET);
//print_r ($_REQUEST);
//die;
//seleciona a linha q marquei no radio
//$sql2 = "SELECT * FROM itens WHERE id_itens={$_REQUEST[alterar]}";
//executa a query
//$res = mysql_query($sql2) or die("Erro selecionando (altera_precad.php)");
//desmonta o resutaldo e coloca os elementos do registro na linha
//$linha = mysql_fetch_assoc($res);
//agora temos a linha preenchida com os dados do registro (acima)

//======================VALIDAÇÃO E CONVERSÃO DE DADOS=====================
//validação só funcionará quando não for a primeira vez que entra-se no formulario
//!empty (se não for vazio, faça os testes abaixo)
//if (!empty($_POST)){

//-------------CAMPO codigo-------------------------

//não pode ser vazio o campo (campo obrigatório)
    //if (empty($_POST[lote])){
        //$erro = $erro_lote = true;
        //}
//}
    
?>
</table><br>
<tr>
    <th colspan="2" height="159" align="left" class="A" scope="col">
    
    <!-- o form deve conter a tag name="" para que possa ser submetido automatica-->
    <form action="gera_relatorio.php" method="POST">
    <!--<form action="<?php //if ($erro or empty($_POST)) echo "altera_lote.php"; 
                            //else echo "grava_lote.php"; ?>" method="POST" name="altera_lote">-->
        
       <table width="1020" border="1" align="center" class="A" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                
          <table width="1010" border="0" align="center" class="A" cellpadding="0" cellspacing="0">
            <tr>
                <td></td>
            </tr>
              <tr>
                <td colspan="2" align="center"><strong>ESCOLHA O STATUS PARA GERAR O RELATÓRIO<hr></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            
            <tr>
                <td align="right">Licitante:</td>
                <td align="left">
                     <select id="licitante" name="licitante">
                        <?php
            
                            $licitante_query="SELECT usuario FROM usuarios WHERE tipo_usuario='licitante' ORDER BY usuario ASC";
                            $licitante_result=mysql_query($licitante_query) or die ("Falha ao recuperar o NOME_FORN da base de dados: ".mysql_error());
                            echo "<option>$_POST[licitante]</option>";

                            while ($licitante_row=mysql_fetch_array($licitante_result)) {
                            $licitante=$licitante_row[usuario];
                                echo "<option>$licitante</option>";
                                }
                            
                        ?>
                    </select>
                      
    </td>
            </tr>
            
            <tr>
                <td align="right">Status:</td>
                <td align="left">
                    <select name="status" size="0" >
                        <option><?php echo "$_POST[status]"; ?></option>
                        
                        <option>Todos</option>
                        <option>RP Vigentes</option>
                        <option>Adjudicado</option>
                        <option>Arrematado</option>
                        <option>Arquivado</option>
                        <option>A receber Pgto</option>
                        <option>A receber Ata/Contrato</option>
                        <option>A receber NE</option>
                        <option>Docs reprovados</option>
                        <option>Solicitado Parcial</option>
                        <option>Cancelada/Suspensa</option>
                        <option>Desclassificado</option>
                        <option>Descl. Neg. Pregoeiro</option>
                        <option>Em expedição</option>
                        <option>Reaberto</option>
                        <option>Rescindido contrato/ata</option>
                        <option>Pgto efetuado</option>
                        <option>2° Lugar</option>
                        <option>3° Lugar</option>
                        <option>4° Lugar</option>
                        <option>5° Lugar</option>
                        <option>6° Lugar</option>
                        <option>7° Lugar</option>
                        <option>8° Lugar</option>
                        <option>9° Lugar</option>
                        <option>10° Lugar</option>
                        <option>11° Lugar</option>
                        <option>12° Lugar</option>
                        <option>13° Lugar</option>
                        <option>14° Lugar</option>
                        <option>15° Lugar</option>
                        <option>16° Lugar</option>
                        <option>17° Lugar</option>
                        <option>18° Lugar</option>
                        <option>19° Lugar</option>
                        <option>20° Lugar</option>
                        <option>21° Lugar</option>
                        <option>22° Lugar</option>
                        <option>23° Lugar</option>
                        <option>24° Lugar</option>
                        <option>25° Lugar</option>
                        <option>26° Lugar</option>
                        <option>27° Lugar</option>
                        <option>28° Lugar</option>
                        <option>29° Lugar</option>
                        <option>31° Lugar</option>
                        <option>32° Lugar</option>
                        <option>33° Lugar</option>
                        <option>34° Lugar</option>
                        <option>35° Lugar</option>
                        <option>36° Lugar</option>
                        <option>37° Lugar</option>
                        <option>38° Lugar</option>
                        <option>39° Lugar</option>
                        <option>40° Lugar</option>
                        
                    </select>
                      
    </td>
            </tr>
            
            <tr>
                <td align="right">Ano:</td>
                <td align="left">
                    <select name="ano" size="0" >
                        <option><?php echo "$_POST[ano]"; ?></option>
                        
                        <option>Todos</option>
                        <option>2016</option>
                        <option>2015</option>
                        <option>2014</option>
                        <option>2013</option>
                        
                    </select>
                      
    </td>
            </tr>
                
           
            
            <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                    echo '<script language="javascript">document.altera_lote.submit()</script>';
                }
            
            ?>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2" align="left"><input type="submit" value="Criar relatório" /></td>
                <td><br><br></td>
                
            </tr>
            </form>
</tr>
</table>
</table>


                            