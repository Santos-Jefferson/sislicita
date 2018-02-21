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

print_r ($_REQUEST);
// se o GET[order] for vazio, então será preenchido com um valor padrão
//if(empty($_GET[order])) $_GET[order] = 'item';
    
$sql_cod_lote = "SELECT * FROM codigo,lote WHERE codigo.id_cod={$_REQUEST[id_cod]} and lote.id_lote={$_REQUEST[id_lote]}";
$sql_cod_lote2 = "SELECT * FROM codigo,lote,itens WHERE codigo.id_cod=lote.id_lote and lote.id_lote=itens.id_lote and codigo.id_cod={$_REQUEST[id_cod]} and lote.id_lote={$_REQUEST[id_lote]}";
//and SELECT * FROM lote WHERE id_lote = {$_GET[id_lote]} order by {$_GET[order]}";

$res_cod_lote = mysql_query($sql_cod_lote) or die("Erro seleção - res_ne");
$res_cod_lote2 = mysql_query($sql_cod_lote2) or die("Erro seleção - res_ne2");

$linha_cod_lote = mysql_fetch_assoc($res_cod_lote);
$linha_cod_lote2 = mysql_fetch_assoc($res_cod_lote2);

//$v = 0; //conterá a somatória dos valores
//$c = 0; //total de registros

//pega a primeira linha do resultado



//$sql_coloc = "SELECT * FROM lote WHERE id_lote = {$_GET[id_lote]}";

//$res_coloc = mysql_query($sql_coloc) or die("Erro seleção colocacao");

//pega a primeira linha do resultado
//$linha_coloc = mysql_fetch_assoc($res_coloc);

//print_r ($_REQUEST);
//require_once "pes_rapida_cad_tudo.php";


//require "tab_cab_itens_tudo.php";
?>



<br>
<table align="center" class="A" border="0" width="1010">
<table align="center" class="A" width="1000" border="1" cellpadding="3" cellspacing="0">
    
       
    <tr>
        <td class="forms" colspan="0" bgcolor="LemonChiffon" align="center"><strong>LISTAGEM LICITAÇÃO N° <?php echo $linha_cod_lote[codigo] ?> e LOTE/GRUPO N° <?php echo $linha_cod_lote[lote] ?></td>
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
    
    <!--<td align="center"><?php/*
                        $data = "$linha_cod_lote[data]";
                        $hora = "$linha_cod_lote[hora]";
                        echo date('d/m/Y', strtotime($data))." / ";
                        echo "$linha_cod_lote[hora]";
                        */?>
    </td>-->
    <!--<td align="center"><?php //echo $linha_cod_lote[lote] ?></td>-->
    <td align="center"><?php echo $linha_cod_lote[licitante] ?></td>
    <!--<td align="center">
            
            <a href="altera_lote.php?alterar=<?php /*echo $_GET[id_lote]; ?>&codigo=<?php echo $_GET[codigo]; ?>&lote=<?php echo $_GET[lote]; ?>&orgao=<?php echo $_GET[orgao]; ?>&data=<?php echo $_GET[data]; ?>&hora=<?php echo $_GET[hora]; ?>&licitante=<?php echo $_GET[licitante]; ?>&id_lote=<?php echo $_GET[id_lote]; ?>&id_itens=<?php echo $linha[id_itens]; ?>&id_cod=<?php echo $_GET[id_cod]; ?>"><img src="imagens/edit.png" border="0"/></a>
            <a href="conf_lote_exc.php?apagar=<?php echo $_GET[id_lote]; ?>&lote=<?php echo $_GET[lote];?>"><img src="imagens/delete.png" border="0"/></a>
            <a href="cad_ne.php?id_lote=<?php echo $_GET[id_lote]; */?>"><img src="imagens/ne.png" border="0"/></a>
        </td>-->
    <td class="" align="center"><?php echo $linha_cod_lote[colocacao] ?></td>
    
  </tr>
  
  <tr>
    <th width="" >ITEM(S) PROPOSTO(S)</th>
    <!--<th width="" scope="col">CÓDIGO</th>-->
    <th width="" >V.UNIT.EMPENHADO</th>  
    <th width="" >V.TOT.EMPENHADO</th>
    <!--<th width="" scope="col">DATA/HORA</th>-->
    <!--<th width="" scope="col">LOTE/GRUPO</th>-->
    
  </tr>
  <tr>
    <td align="center"><?php echo $linha_cod_lote2[produto] ?></td>
    <!--<td align="center"><?php //echo $linha_cod_lote[codigo] ?></td>-->
    <td align="center"><?php echo $linha_cod_lote[pregao] ?></td>
    <td align="center"><?php echo $linha_cod_lote[orgao] ?></td>
    
    
    
  </tr>
  

</table><br>
  <tr>
    <td align="right">asdf</td>
    <td><form id="form3" name="form2" method="post" action="">
      <label for="textfield2"></label>
      <input type="text" name="textfield3" id="textfield2" />
    </form></td>
    <td width="146" align="right">asdf</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">asdf</td>
    <td><form id="form4" name="form2" method="post" action="">
      <label for="textfield2"></label>
      <input type="text" name="textfield4" id="textfield2" />
    </form></td>
    <td align="right">sadf</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">asf</td>
    <td><form id="form5" name="form2" method="post" action="">
      <label for="textfield2"></label>
      <input type="text" name="textfield5" id="textfield2" />
    </form></td>
    <td align="right">asdf</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">adfs</td>
    <td><form id="form6" name="form2" method="post" action="">
      <label for="textfield2"></label>
      <input type="text" name="textfield6" id="textfield2" />
    </form></td>
    <td align="right">af</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">asdf</td>
    <td><form id="form7" name="form2" method="post" action="">
      <label for="textfield2"></label>
      <input type="text" name="textfield7" id="textfield2" />
    </form></td>
    <td align="right">sdfa</td>
    <td colspan="2">&nbsp;</td>
  </tr>
   
                
            
            
         
            <tr>
                <td></td>
                <td colspan="2" align="left"><input type="submit" value="Cadastrar" /></td>
                
                         <td width="293"><input type="hidden" name="id_cod" value="<?php echo $_REQUEST[id_cod]; ?>">
                </td>
                <td width="308"><input type="hidden" name="id_lote" value="<?php echo $_REQUEST[id_lote]; ?>">
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
</table>
                            
                            </table><br>  
<table align="center" class="A" border="0" width="1010">
<table align="center" class="A" width="1000" border="1" cellpadding="3" cellspacing="0">
  <tr>
    <th width="" >DATA ENTREGA:</th>
    <th width="" scope="col">PRODUTO PROPOSTO:</th>
    <th width="" >V.UNIT.PROPOSTA</th>  
    <th width="" >V.TOT.PROPOSTA</th>
    <!--<th width="" scope="col">DATA/HORA</th>-->
    <th width="" scope="col"></th>
    <th width="" scope="col"></th>
    <!--<th >AÇÃO</th>-->
    <th >STATUS LOTE</th>
  </tr>
  <tr>
    <td align="center"><?php echo $linha_cod_lote[tipo_licitacao] ?></td>
    <td align="center"><?php echo $linha_cod_lote[codigo] ?></td>
    <td align="center"><?php echo $linha_cod_lote[pregao] ?></td>
    <td align="center"><?php echo $linha_cod_lote[orgao] ?></td>
    
    <!--<td align="center"><?php/*
                        $data = "$linha_cod_lote[data]";
                        $hora = "$linha_cod_lote[hora]";
                        echo date('d/m/Y', strtotime($data))." / ";
                        echo "$linha_cod_lote[hora]";
                        */?>
    </td>-->
    <td align="center"><?php echo $linha_cod_lote[lote] ?></td>
    <td align="center"><?php echo $linha_cod_lote[licitante] ?></td>
    <!--<td align="center">
            
            <a href="altera_lote.php?alterar=<?php /*echo $_GET[id_lote]; ?>&codigo=<?php echo $_GET[codigo]; ?>&lote=<?php echo $_GET[lote]; ?>&orgao=<?php echo $_GET[orgao]; ?>&data=<?php echo $_GET[data]; ?>&hora=<?php echo $_GET[hora]; ?>&licitante=<?php echo $_GET[licitante]; ?>&id_lote=<?php echo $_GET[id_lote]; ?>&id_itens=<?php echo $linha[id_itens]; ?>&id_cod=<?php echo $_GET[id_cod]; ?>"><img src="imagens/edit.png" border="0"/></a>
            <a href="conf_lote_exc.php?apagar=<?php echo $_GET[id_lote]; ?>&lote=<?php echo $_GET[lote];?>"><img src="imagens/delete.png" border="0"/></a>
            <a href="cad_ne.php?id_lote=<?php echo $_GET[id_lote]; */?>"><img src="imagens/ne.png" border="0"/></a>
        </td>-->
    <td class="" align="center"><?php echo $linha_cod_lote[colocacao] ?></td>
    
  </tr>
</table>