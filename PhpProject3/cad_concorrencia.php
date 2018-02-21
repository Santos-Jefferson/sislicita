<?php
require ("cabecalho_reduzido.php");
require ("cabecalho_lote.php");
//require ("corpo_menu.php");
//exibir a tabela com os pré-cadastros feitos.
//require ("pesquisa_licita.php");

$sql = "SELECT * from lote,cad_concorrencia_adj,cad_concorrencia_2adj
        WHERE id_lote = {$_REQUEST[id_lote]} AND (lote.id_lote=cad_concorrencia_adj.id_lote OR lote.id_lote=cad_concorrencia_2adj.id_lote)";
$lote = mysql_query($sql) or die ("Erro seleção lote");
$linha_lote = mysql_fetch_assoc($lote);

$sql2 = "SELECT * from codigo WHERE id_cod = {$_GET[id_cod]}";
$cod = mysql_query($sql2) or die ("Erro seleção codigo");
$linha_cod = mysql_fetch_assoc($cod);



//======================VALIDAÇÃO E CONVERSÃO DE DADOS=====================
//validação só funcionará quando não for a primeira vez que entra-se no formulario
//!empty (se não for vazio, faça os testes abaixo)
if (!empty($_POST)){

//-------------CAMPO codigo-------------------------
if (empty($_POST[emp_adj])){
        $erro = $erro_modalidade = true;
        }  
    
    if (empty($_POST[mar_adj])){
        $erro = $erro_local_licitacao = true;
        }    
    
if (empty($_POST[mod_adj])){
        $erro = $erro_tipo_licitacao = true;
        }
    
    
//não pode ser vazio o campo (campo obrigatório)
    if (empty($_POST[val_adj])){
        $erro = $erro_codigo = true;
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

<script type="text/javascript">
			function Formatadata(Campo, teclapres)
			{
				var tecla = teclapres.keyCode;
				var vr = new String(Campo.value);
				vr = vr.replace("/", "");
				vr = vr.replace("/", "");
				vr = vr.replace("/", "");
				tam = vr.length + 1;
				if (tecla != 8 && tecla != 8)
				{
					if (tam > 0 && tam < 2)
						Campo.value = vr.substr(0, 2) ;
					if (tam > 2 && tam < 4)
						Campo.value = vr.substr(0, 2) + '/' + vr.substr(2, 2);
					if (tam > 4 && tam < 7)
						Campo.value = vr.substr(0, 2) + '/' + vr.substr(2, 2) + '/' + vr.substr(4, 7);
				}
			}
                        
                        function Formatahora(Campo, teclapres)
			{
				var tecla = teclapres.keyCode;
				var vr = new String(Campo.value);
				vr = vr.replace(":", "");
				tam = vr.length + 1;
				if (tecla != 5 && tecla != 5)
				{
					if (tam > 0 && tam < 2)
						Campo.value = vr.substr(0, 2) ;
					if (tam > 2 && tam < 4)
						Campo.value = vr.substr(0, 2) + ':' + vr.substr(2, 2);
					
				}
			}
		</script>


</table><br>    
<tr>
    <th colspan="2" height="159" align="left" class="A" scope="col">
    <form action="<?php if ($erro or empty($_POST)) echo "cad_concorrencia.php";
                            else echo "grava_cad_concorrencia.php"; ?>" method="POST" name="cad_codigo">
                            
       <table width="1020" align="center" border="1" class="A" cellpading="0" cellspacing="0">
            <tr border="1">
                <td border="1">
        <table align="center" width="1010" border="0" class="A" cellpading="0" cellspacing="0" >
            <tr>
                <td colspan="2" align="center"><strong>ANÁLISE DA CONCORRÊNCIA<hr></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            
            <?php
              if (!empty($linha_lote[id_lote])){
                
                echo
                "<tr><td width='140' align='right'>Empresa Adjudicada:</td>
                    <td><input type='text' name='emp_adj' size='80' maxlength='100' value='$linha_lote[emp_adj]'>
                    
                    </td>
                </tr>";
                }
                else{
                echo "<tr><td width='140' align='right'>Empresa Adjudicada:</td>
                    <td><input type='text' name='emp_adj' size='80' maxlength='100' value='$_POST[emp_adj]'>
                    
                    </td>
                </tr>";
                }
            ?>
            
              <tr>
                <td width="140" align="right">Empresa Adjudicada:</td>
                <td><input type="text" name="emp_adj" size="80" maxlength="100" value="<?php echo $_POST[emp_adj]; ?>">
                    <?php
                        if($erro_emp_adj){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Marca Adjudicada:</td>
                <td><input type="text" name="mar_adj" size="20" maxlength="30" value="<?php echo $_POST[mar_adj]; ?>">
                    <?php
                        if($erro_mar_adj){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            
            
            <tr>
                <td align="right">Modelo Adjudicado:</td>
                <td><input type="text" name="mod_adj" size="20" maxlength="50" value="<?php echo $_POST[mod_adj]; ?>">
                    <?php
                        if($erro_mod_adj){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            
            <tr>
                <td align="right">Valor Lote/Item Adjudicado:</td>
                <td><input type="text" name="val_adj" size="10" maxlength="50" value="<?php echo $_POST[val_adj]; ?>">
                    <?php
                        if($erro_val_adj){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
                <td><input type="hidden" name="id_lote" size="10" maxlength="50" value="<?php echo $_REQUEST[id_lote]; ?>">
            </tr>
            
           
            
            <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                    echo '<script language="javascript">document.cad_concorrencia.submit()</script>';
                }
            
            ?> 
           <tr>
                <td></td>
                <td colspan="2" align="left"><input type="submit" value="Cadastrar" /></td>
                
            </tr>
        </form>  
</tr>
</table>
</table>