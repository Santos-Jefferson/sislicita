<?php
require "conecta.php";
require_once "cabecalho_reduzido.php";
require_once "cabecalho_lote.php";
require_once "js_formata_data.php";
//print_r ($_GET);
//print_r ($_REQUEST);
//seleciona a linha q marquei no radio
$sql = "SELECT * FROM codigo WHERE id_cod={$_GET[alterar]}";
//executa a query
$res = mysql_query($sql) or die("Erro selecionando (altera_licita.php)");
//desmonta o resutaldo e coloca os elementos do registro na linha
$linha = mysql_fetch_assoc($res);
//agora temos a linha preenchida com os dados do registro (acima)



?>
<!--<script type="text/javascript">
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
					if (tam > 4 && tam < 9)
						Campo.value = vr.substr(0, 2) + '/' + vr.substr(2, 2) + '/' + vr.substr(4, 9);
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
		</script>-->
<?php

//======================VALIDAÇÃO E CONVERSÃO DE DADOS=====================
//validação só funcionará quando não for a primeira vez que entra-se no formulario
//!empty (se não for vazio, faça os testes abaixo)
if (!empty($linha)){

//-------------CAMPO codigo-------------------------

//não pode ser vazio o campo (campo obrigatório)
    if (empty($linha[codigo])){
        $erro = $erro_codigo = true;
        }
        
    if (empty($linha[pregao])){
        $erro = $erro_pregao = true;
        }
    
//-------------CAMPO orgão-------------------------

//não pode ser vazio o campo (campo obrigatório)
    if (empty($linha[orgao])){
        $erro = $erro_orgao = true;
        }
    
//--------------CAMPO data-------------------------
//teste se é uma data gregoriana válida
//quebra a data em 3 partes
//após o slit, teremos o vetor $v em 3 pedaços: v[0] = dia, v[1] = mes, v[2] = ano
$v = split('[/.-]', $linha[data]);

//testa se a data é válida

//@ na frente da função é para inibir o warning, use com cuidado!!!
if(!@checkdate($v[1], $v[0], $v[2])){
        $erro = $erro_data = true;
}
//se deu certo, converte a data
else {
    $linha[data] = $v[2].'-'.$v[1].'-'.$v[0];
}

//-------------CAMPO hora-------------------------
//não pode ser vazio o campo (campo obrigatório)
    if (empty($linha[hora])){
        $erro = $erro_hora = true;
        }
    
    
//-------------CAMPO licitante-------------------------
//não pode ser vazio o campo (campo obrigatório)
    if (empty($linha[licitante])){
        $erro = $erro_licitante = true;
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
             



<tr>
        <th colspan="2" height="159" align="left" class="A" scope="col">
        <form action="grava_cad.php" method="POST" name="altera_licita">
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
                <td></td>
            </tr>
            <tr>
                <td align="right">Modalidade:</td>
                <td>
                    <select name="modalidade" size="0" >
                        <option><?php echo $linha[modalidade]; ?></option>
                        <option>Eletrônico</option>
                        <option>Presencial</option>
                    </select>
                           
                        <?php
                            if($erro_modalidade){
                                echo "<font color=red>*** Campo obrigatório</font>";
                            }
                        ?>
                
                </td>
            </tr>
            <tr>
                <td align="right">Local:</td>
                <td>
                    <select name="local_licitacao" size="0" >
                        <option><?php echo $linha[local_licitacao]; ?></option>
                        <option>Licitações-e(BB)</option>
                        <option>Comprasnet</option>
                        <option>CidadeCompras</option>
                        <option>BLL</option>
                        <option>Ecompras(Curitiba)</option>
                        <option>Outros</option>
                    </select>
                           
                        <?php
                            if($erro_local_licitacao){
                                echo "<font color=red>*** Campo obrigatório</font>";
                            }
                        ?>
                
                </td>
            </tr>
            
            <tr>
                <td align="right">Tipo:</td>
                <td>
                    <select name="tipo_licitacao" size="0" >
                        <option><?php echo $linha[tipo_licitacao]; ?></option>
                        <option>AT</option>
                        <option>RP</option>
                        <option>DL</option>
                        <option>CC</option>
                        <option>PP</option>
                    </select>
                           
                        <?php
                            if($erro_tipo_licitacao){
                                echo "<font color=red>*** Campo obrigatório</font>";
                            }
                        ?>
                <b>(LEGENDA:</b> AT = Aquisição Total, RP = Registro de Preços, DL = Dispensa Licitação, CC = Carta Convite)
                </td>
            </tr>
            
            <tr>
                <input type="hidden" name="id_cod" size="3" maxlength="3" value="<?php echo $linha[id_cod]?>">
                <td width="140" align="right">Cód. BB/Uasg/Pregão:</td>
                <td><input type="text" name="codigo" size="20" maxlength="100" value="<?php echo $linha[codigo]; ?>">
                    <?php
                        if($erro_codigo){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>

            <tr>
            <td width="140" align="right">Pregão n°:</td>
                <td><input type="text" name="pregao" size="20" maxlength="30" value="<?php echo $linha[pregao]; ?>">
                    <?php
                        if($erro_pregao){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            
            <tr>
                <td align="right">Órgão:</td>
                <td><input type="text" name="orgao" size="50" maxlength="50" value="<?php echo $linha[orgao]; ?>">
                    <?php
                        if($erro_orgao){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            
            <tr>
                <td align="right">UF/Entrega Mat:</td>
                <td>
                    <select name="uf" size="0" >
                        <option><?php echo $linha[uf]; ?></option>
                        <option>Acre - AC</option>
                        <option>Alagoas - AL</option>
                        <option>Amapá - AP</option>
                        <option>Amazonas - AM</option>
                        <option>Bahia  - BA</option>
                        <option>Ceará - CE</option>
                        <option>Distrito Federal  - DF</option>
                        <option>Espírito Santo - ES</option>
                        <option>Goiás - GO</option>
                        <option>Maranhão - MA</option>
                        <option>Mato Grosso - MT</option>
                        <option>Mato Grosso do Sul - MS</option>
                        <option>Minas Gerais - MG</option>
                        <option>Pará - PA</option></option>
                        <option>Paraíba - PB</option></option>
                        <option>Paraná - PR</option>
                        <option>Pernambuco - PE</option>
                        <option>Piauí - PI</option>
                        <option>Rio de Janeiro - RJ</option>
                        <option>Rio Grande do Norte - RN</option>
                        <option>Rio Grande do Sul - RS</option>
                        <option>Rondônia - RO</option>
                        <option>Roraima - RR</option>
                        <option>Santa Catarina - SC</option>
                        <option>São Paulo - SP</option>
                        <option>Sergipe - SE</option>
                        <option>Tocantins - TO</option>
                    </select>
                    <?php
                            if($erro_uf){
                                echo "<font color=red>*** Campo obrigatório</font>";
                            }
                        ?>
                </td>
            </tr>
            
            
            
            
            <tr>
                <td align="right">Data Disp.:</td>
                <td><input type="text" name="data" size="10" maxlength="10" onkeyup="Formatadata(this,event)" value="<?php echo (date('d/m/Y', strtotime($linha[data]))); ?>" >
                    <?php 
                        if ($erro_data){
                            echo "<font color=red>*** Data inserida erroneamente. Insira novamente</font>";
                        }
                        echo "<font color=blue>   Ex.: 25/12/2011</font>";
                    ?>
                    
                </td>
            </tr>
            
            <tr>
                <td align="right">Hora Disp.:</td>
                <td><input type="text" name="hora" size="5" maxlength="5" value="<?php echo $linha[hora]; ?>" onkeyup="Formatahora(this,event)">
                    <?php
                        if($erro_hora){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                        echo "<font color=blue>   Ex.: 09:00</font>";
                    ?>
                    
                </td>
            </tr>
            
            <tr>
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
            <tr>
                <td width="140" align="right">Icms(%):</td>
                <td><input type="text" name="perc_icms" size="3" maxlength="3" value="<?php echo $linha[perc_icms]; ?>">
                    <?php
                        if($erro_perc_icms){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                    Digitar a porcentagem do ICMS equalizado ou diferenciado (ex.: 7, 10, 12, 18)
                </td>
            </tr>
            
            <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                    echo '<script language="javascript">document.altera_licita.submit()</script>';
                }
            
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