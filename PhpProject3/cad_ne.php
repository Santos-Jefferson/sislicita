<?php
require ("cabecalho_reduzido.php");
require ("cabecalho_lote.php");
require "conecta.php";
include "css.php";
//require ("corpo_menu.php");
//exibir a tabela com os pré-cadastros feitos.
//require ("pesquisa_licita.php");

//======================VALIDAÇÃO E CONVERSÃO DE DADOS=====================
//validação só funcionará quando não for a primeira vez que entra-se no formulario
//!empty (se não for vazio, faça os testes abaixo)
if (!empty($_POST)){

//--------------CAMPO data-------------------------
//teste se é uma data gregoriana válida
//quebra a data em 3 partes
//após o slit, teremos o vetor $v em 3 pedaços: v[0] = dia, v[1] = mes, v[2] = ano
$v = split('[/.-]', $_POST[data_rec_ne]);

//testa se a data é válida

//@ na frente da função é para inibir o warning, use com cuidado!!!
if(!@checkdate($v[1], $v[0], $v[2])){
        $erro = $erro_data_rec_ne = true;
}
//se deu certo, converte a data
else {
    $_POST[data_rec_ne] = $v[2].'-'.$v[1].'-'.$v[0];
}


//--------------CAMPO data-------------------------
//teste se é uma data gregoriana válida
//quebra a data em 3 partes
//após o slit, teremos o vetor $v em 3 pedaços: v[0] = dia, v[1] = mes, v[2] = ano
$v = split('[/.-]', $_POST[data_proposta]);

//testa se a data é válida

//@ na frente da função é para inibir o warning, use com cuidado!!!
if(!@checkdate($v[1], $v[0], $v[2])){
        $erro = $erro_data_proposta = true;
}
//se deu certo, converte a data
else {
    $_POST[data_proposta] = $v[2].'-'.$v[1].'-'.$v[0];
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


<?php

$sql_dados = "SELECT * from notaempenho where ";

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
<table align="center" class="A" border="0" width="1010">
<table align="center" class="A" width="1000" border="1" cellpadding="3" cellspacing="0">
    
       
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
  </tr>
  <tr>
    <td align="center"><?php echo $linha_cod_lote[tipo_licitacao] ?></td>
    <!--<td align="center"><?php //echo $linha_cod_lote[codigo] ?></td>-->
    <td align="center"><?php echo $linha_cod_lote[pregao] ?></td>
    <td align="center"><?php echo $linha_cod_lote[orgao] ?></td>
    
    
    <td align="center"><?php echo $linha_cod_lote[licitante] ?></td>
    
    <td class="" align="center"><?php echo $linha_cod_lote[colocacao] ?></td>
    
  </tr>
  
  </table><br>    

<tr>
    <th colspan="2" height="159" align="left" class="A" scope="col">
    <form action="<?php if ($erro or empty($_POST)) echo "cad_ne.php?id_item=$_REQUEST[id_itens]&id_lote=$_REQUEST[id_lote]&id_cod=$_REQUEST[id_cod]";
                            else echo "grava_cad_ne.php"; ?>" method="POST" name="cad_ne">
                            
       <table width="1020" align="center" border="1" class="A" cellpading="0" cellspacing="0">
            <tr border="1">
                <td border="1">
        <table align="center" width="1010" border="0" class="A" cellpading="0" cellspacing="0" >
            <tr>
                <td colspan="10" align="center"><strong>CADASTRE AQUI SUA NOTE DE EMPENHO<hr></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            
            <tr>
                <td width="140" align="right">Data Recebimento NE:</td>
                <td><input type="text" name="data_rec_ne" size="8" maxlength="8" onkeyup="Formatadata(this,event)" value="<?php echo $_POST[data_rec_ne]; ?>">
                    <?php 
                        if ($erro_data_rec_ne){
                            echo "<font color=red>*** Data inserida erroneamente. Insira novamente</font>";
                        }
                        echo "<font color=blue>   Ex.: 25/12/11</font>";
                    ?>
                    
                </td>
            </tr>
            <tr>
            
                <td width="140" align="right">Prazo Entrega:</td>
                <td><input type="text" name="prazo_ent_ne" size="3" maxlength="3" value="<?php echo $_POST[prazo_ent_ne]; ?>">
                    <?php
                        //if($erro_prazo_ent_ne){
                          //  echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                    echo "<font color=blue>   (Em dias corridos conforme edital)</font>";
                    //echo "<font color=red>   </font>";
                    ?>
                </td>
            </tr>
            
                
               <tr>
                <td width="140" align="right">Data Proposta:</td>
                <td><input type="text" name="data_proposta" size="8" maxlength="8" onkeyup="Formatadata(this,event)" value="<?php echo $_POST[data_proposta]; ?>">
                    <?php 
                        if ($erro_data_proposta){
                            echo "<font color=red>*** Data inserida erroneamente. Insira novamente</font>";
                        }
                        echo "<font color=blue>   Ex.: 25/12/11</font>";
                    ?>
                    
                </td>
            </tr>
            <tr>
                
                <td width="140" align="right">Validade Proposta:</td>
                <td><input type="text" name="val_proposta" size="3" maxlength="3" value="<?php echo $_POST[val_proposta]; ?>">
                    <?php
                        //if($erro_val_proposta){
                          //  echo "<font color=red>*** Campo obrigatório</font>";
                       // }
                   echo "<font color=blue>   (Em dias corridos conforme edital)</font>";
                    ?>
                    
                </td>
            </tr>
            
                
            <tr>    
            <td width="140" align="right">Número da Nota de Empenho:</td>
                <td><input type="text" name="num_ne" size="20" maxlength="50" value="<?php echo $_POST[num_ne]; ?>">
                    <?php
                        //if($erro_num_ne){
                          //  echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                    ?>
                </td>
            </tr>
                <tr>
                <td width="140" align="right">Data Prev. Pgto NE:</td>
                <td><input type="text" name="data_prev_pgto" size="3" maxlength="3" value="<?php echo $_POST[data_prev_pgto]; ?>">
                    <?php
                        //if($erro_num_ne){
                          //  echo "<font color=red>*** Campo obrigatório</font>";
                        //}
                    echo "<font color=blue>   (Em dias corridos conforme edital)</font>";
                    ?>
                </td>
                </tr>
                
                
            <tr>
                <?php
                //$sql_itens_sub = "SELECT * FROM itens,subitens WHERE itens.id_itens={$_REQUEST[id_itens]} and subitens.id_item={$_REQUEST[id_itens]}";
                
                //$res_itens_sub = mysql_query($sql_itens_sub) or die("Erro seleção - itens_sub");
                
                //$linha_itens_sub = mysql_fetch_assoc($res_itens_sub);
                //$linha_cod_lote2 = mysql_fetch_assoc($res_cod_lote2);
                
                ?>
                <td></td>
                <td colspan="2" align="left"><input type="submit" value="Cadastrar" /></td>
                
                <td><input type="hidden" name="id_cod" value="<?php echo $_REQUEST[id_cod]; ?>">
                </td>
                <td><input type="hidden" name="id_lote" value="<?php echo $_REQUEST[id_lote]; ?>">
                </td>
                <td><input type="hidden" name="id_itens" value="<?php echo $_REQUEST[id_itens]; ?>">
                </td>
                
            </tr>
            
                  <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                    echo '<script language="javascript">document.cad_ne.submit()</script>';
                }
            
            ?>
            
        </form>  
</tr>
</table>
                    
<?php
require "lista_ne_tudo.php";
?>

                   
                          