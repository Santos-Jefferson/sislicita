<?php
//require ("cabecalho_reduzido.php");
//require ("cabecalho_lote.php");
require "cabecalho_html.php";
require "cabecalho_reduzido.php";
require "conecta.php";
include "css.php";

$sql = "SELECT * FROM financeiro WHERE id_finan={$_GET[alterar]}";
//executa a query
$res = mysql_query($sql) or die("Erro selecionando (altera_licita.php)");
//desmonta o resutaldo e coloca os elementos do registro na linha
$linha = mysql_fetch_assoc($res);
//require ("corpo_menu.php");
//exibir a tabela com os pré-cadastros feitos.
//require ("pesquisa_licita.php");
//print_r($_REQUEST);die;
//======================VALIDAÇÃO E CONVERSÃO DE DADOS=====================
//validação só funcionará quando não for a primeira vez que entra-se no formulario
//!empty (se não for vazio, faça os testes abaixo)
/*if (!empty($_POST)){

//--------------CAMPO data-------------------------
//teste se é uma data gregoriana válida
//quebra a data em 3 partes
//após o slit, teremos o vetor $v em 3 pedaços: v[0] = dia, v[1] = mes, v[2] = ano


//--------------CAMPO data-------------------------
//teste se é uma data gregoriana válida
//quebra a data em 3 partes
//após o slit, teremos o vetor $v em 3 pedaços: v[0] = dia, v[1] = mes, v[2] = ano
$v = split('[/.-]', $_POST[data_pgto]);

//testa se a data é válida

//@ na frente da função é para inibir o warning, use com cuidado!!!
if(!@checkdate($v[1], $v[0], $v[2])){
        $erro = $erro_data_exp = true;
}
//se deu certo, converte a data
else {
    $_POST[data_pgto] = $v[2].'-'.$v[1].'-'.$v[0];
}

    }
 
 */
    
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


<?php

//print_r ($_REQUEST);
// se o GET[order] for vazio, então será preenchido com um valor padrão
//if(empty($_GET[order])) $_GET[order] = 'item';
    
$sql_cod_lote = "SELECT * FROM codigo,lote WHERE codigo.id_cod={$_REQUEST[id_cod]} and lote.id_lote={$_REQUEST[id_lote]}";
//$sql_cod_lote2 = "SELECT * FROM codigo,lote,itens WHERE codigo.id_cod=lote.id_lote and lote.id_lote=itens.id_lote and codigo.id_cod={$_REQUEST[id_cod]} and lote.id_lote={$_REQUEST[id_lote]}";
//and SELECT * FROM lote WHERE id_lote = {$_GET[id_lote]} order by {$_GET[order]}";

$res_cod_lote = mysql_query($sql_cod_lote) or die("Erro seleção - res_ne");
//$res_cod_lote2 = mysql_query($sql_cod_lote2) or die("Erro seleção - res_ne2");

$linha_cod_lote = mysql_fetch_assoc($res_cod_lote);
//$linha_cod_lote2 = mysql_fetch_assoc($res_cod_lote2);


?>



<br>
<table align="center" class="A" border="0" width="">
<table align="center" class="A" width="" border="1" cellpadding="3" cellspacing="0">
    
       
    <tr>
        <td class="forms" colspan="10" bgcolor="LemonChiffon" align="center"><strong>LISTAGEM LICITAÇÃO N°<a href="lista_licita_tudo.php?codigo=<?php echo $linha_cod_lote[codigo];?>"><?php echo $linha_cod_lote[codigo] ?></a> e LOTE/GRUPO N° <?php echo $linha_cod_lote[lote] ?></td>
    </tr>
    
  <tr>
    <th width="" >TIPO</th>
    <!--<th width="" scope="col">CÓDIGO</th>-->
    <th width="" >PREGÃO</th>  
    <th width="" >ÓRGÃO</th>
    <!--<th width="" scope="col">DATA/HORA</th>-->
    <!--<th width="" scope="col">LOTE/GRUPO</th>-->
    <th width="" scope="col">LICITANTE</th>
    <!--<th >AÇÃO</th>-->
    <th >STATUS LOTE</th>
    <th >NÚM NE</th>
    
  </tr>
  <tr>
    <td align="center"><?php echo $linha_cod_lote[tipo_licitacao] ?></td>
    <!--<td align="center"><?php //echo $linha_cod_lote[codigo] ?></td>-->
    <td align="center"><?php echo $linha_cod_lote[pregao] ?></td>
    <td align="center"><?php echo $linha_cod_lote[orgao] ?></td>
    
    
    <td align="center"><?php echo $linha_cod_lote[licitante] ?></td>
    
    <td class="" align="center"><?php echo $linha_cod_lote[colocacao] ?></td>
    <td class="" align="center"><?php echo $_GET[num_ne] ?></td>
    
  </tr>
  
  </table><br>    

<tr>
    <th colspan="2" height="159" align="left" class="A" scope="col">
    <form action="grava_cad_ne_finan.php" method="POST">
                            
       <table width="" align="center" border="1" class="A" cellpading="0" cellspacing="0">
            <tr border="1">
                <td border="1">
        <table align="center" width="" border="0" class="A" cellpading="0" cellspacing="0" >
            <tr>
                <td colspan="10" align="center"><strong>CADASTRE AQUI INFORMAÇÕES FINANCEIRAS<hr></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td width="140" align="right">Data Recbto Pgto:</td>
                <td><input type="text" name="data_pgto" size="10" maxlength="10" value="<?php echo /*date('d/m/Y', strtotime(*/$linha[data_pgto]; ?>" >
                    <?php 
                        if ($erro_data_pgto){
                            echo "<font color=red>*** Data inserida erroneamente. Insira novamente</font>";
                        }
                        echo "<font color=blue>   Ex.: 25/12/11</font>";
                    ?>
                    
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Status Comissionamento:</td>
                <td><select name="status_comissao" size="0" >
                        <option><?php echo $linha[status_comissao]; ?></option>
                        <option>Pago</option>
                        <option>A Pagar</option>
                        <option>Não comissionado</option>
                        
                        
                    </select>
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Histórico/Obs NE:</td>
                <td>
                    <textarea name="historico_obs_finan" rows="4" cols="40">
                        <?php
                            //$sql = "SELECT * FROM subitens WHERE id_subitens = {$_GET[id_subitens]} and id_item = {$_GET[id_item]}";
                            //$res = mysql_query($sql) or die("Erro seleção");
                            //$linha = mysql_fetch_assoc($res);
                        if (!empty($linha[historico_obs_finan])){
                            echo $linha[historico_obs_finan]." ### ";
                            echo date("Y/m/d - H:i:s")."(".$usuario.")".":"."$_POST[status_comissao]";
                        }
                        if (empty($linha[historico_obs_finan])){
                                echo date("Y/m/d - H:i:s:")."(".$usuario.")".":"."$_POST[status_comissao]";
                            }
                        ?>
                    </textarea>

                    <!--<input type="text" name="prev_entrega_exp" size="10" maxlength="10000" value="<?php //echo $_POST[historico_obs_finan]; ?>">-->
                    <?php
                        //if($erro_prazo_ent_ne){
                          //  echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                    //echo "<font color=blue>   (Prev. Entrega - dias corridos)</font>";
                    ?>
                </td>
                
                    
                
            </tr>
                
               
            <tr>
                <td></td>
                <td colspan="2" align="left"><input type="submit" value="Cadastrar" /></td>
                
                <td><input type="hidden" name="id_cod" value="<?php echo $_REQUEST[id_cod]; ?>">
                </td>
                <td><input type="hidden" name="id_ne" value="<?php echo $_REQUEST[id_ne]; ?>">
                </td>
                <td><input type="hidden" name="id_lote" value="<?php echo $linha_cod_lote[id_lote]; ?>">
                </td>
                <td><input type="hidden" name="id_finan" value="<?php echo $linha[id_finan]; ?>">
                </td>
                
            </tr>
            
                  <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                //if(!$erro and !empty($_POST)){
                  //  echo '<script language="javascript">document.cad_ne_finan.submit()</script>';
                //}
            
            ?>
            
        </form>  
</tr>
</table>
                    
<?php
//require "lista_ne_tudo.php";
?>

                   
                          