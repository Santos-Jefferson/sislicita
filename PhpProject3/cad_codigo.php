<?php
require ("cabecalho_reduzido.php");
require ("cabecalho_lote.php");
//require ("corpo_menu.php");
//exibir a tabela com os pré-cadastros feitos.
//require ("pesquisa_licita.php");

//======================VALIDAÇÃO E CONVERSÃO DE DADOS=====================
//validação só funcionará quando não for a primeira vez que entra-se no formulario
//!empty (se não for vazio, faça os testes abaixo)
if (!empty($_POST)){

//-------------CAMPO codigo-------------------------
if (empty($_POST[modalidade])){
        $erro = $erro_modalidade = true;
        }  
    
    if (empty($_POST[local_licitacao])){
        $erro = $erro_local_licitacao = true;
        }    
    
if (empty($_POST[tipo_licitacao])){
        $erro = $erro_tipo_licitacao = true;
        }
    
    
//não pode ser vazio o campo (campo obrigatório)
    if (empty($_POST[codigo])){
        $erro = $erro_codigo = true;
        }
    
//-------------CAMPO orgão-------------------------

//não pode ser vazio o campo (campo obrigatório)
    if (empty($_POST[pregao])){
        $erro = $erro_pregao = true;
        }
        
        
    if (empty($_POST[orgao])){
        $erro = $erro_orgao = true;
        }
        
    if (empty($_POST[uf])){
        $erro = $erro_uf = true;
        }
    
//--------------CAMPO data-------------------------
//teste se é uma data gregoriana válida
//quebra a data em 3 partes
//após o slit, teremos o vetor $v em 3 pedaços: v[0] = dia, v[1] = mes, v[2] = ano
$v = split('[/.-]', $_POST[data]);

//testa se a data é válida

//@ na frente da função é para inibir o warning, use com cuidado!!!
if(!@checkdate($v[1], $v[0], $v[2])){
        $erro = $erro_data = true;
}
//se deu certo, converte a data
else {
    $_POST[data] = $v[2].'-'.$v[1].'-'.$v[0];
}

//-------------CAMPO hora-------------------------
//não pode ser vazio o campo (campo obrigatório)
    if (empty($_POST[hora])){
        $erro = $erro_hora = true;
        }
    
    
//-------------CAMPO licitante-------------------------
//não pode ser vazio o campo (campo obrigatório)
   if (empty($_POST[licitante])){
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
    <form action="<?php if ($erro or empty($_POST)) echo "cad_codigo.php";
                            else echo "grava_cad.php"; ?>" method="POST" name="cad_codigo">
                            
       <table width="1020" align="center" border="1" class="A" cellpading="0" cellspacing="0">
            <tr border="1">
                <td border="1">
        <table align="center" width="1010" border="0" class="A" cellpading="0" cellspacing="0" >
            <tr>
                <td colspan="2" align="center"><strong>CADASTRE AQUI SUA LICITAÇÃO PELA 1° VEZ<hr></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td align="right">Modalidade:</td>
                <td>
                    <select name="modalidade" size="0" >
                        <option><?php echo $_POST[modalidade]; ?></option>
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
                <td align="right">Local/Portal:</td>
                <td>
                    <select name="local_licitacao" size="0" >
                        <option><?php echo $_POST[local_licitacao]; ?></option>
                        <option>Ecompras(Curitiba)</option>
                        <option>Licitações-e(BB)</option>
                        <option>CidadeCompras</option>
                        <option>Comprasnet</option>
                        <option>Presencial</option>
                        <option>BEC(SP)</option>
                        <option>BBMNet</option>
                        <option>Outros</option>
                        <option>Caixa</option>
                        <option>BLL</option>
                        
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
                        <option><?php echo $_POST[tipo_licitacao]; ?></option>
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
                <td width="140" align="right">Cód. BB/Uasg/Pregão:</td>
                <td><input type="text" name="codigo" size="20" maxlength="100" value="<?php echo $_POST[codigo]; ?>">
                    <?php
                        if($erro_codigo){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Pregão n°:</td>
                <td><input type="text" name="pregao" size="20" maxlength="30" value="<?php echo $_POST[pregao]; ?>">
                    <?php
                        if($erro_pregao){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            
            
            <tr>
                <td align="right">Órgão:</td>
                <td><input type="text" name="orgao" size="70" maxlength="70" value="<?php echo $_POST[orgao]; ?>">
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
                        <option><?php echo $_POST[uf]; ?></option>
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
                <td><input type="text" name="data" size="8" maxlength="8" onkeyup="Formatadata(this,event)" value="<?php echo $_POST[data]; ?>">
                    <?php 
                        if ($erro_data){
                            echo "<font color=red>*** Data inserida erroneamente. Insira novamente</font>";
                        }
                        echo "<font color=blue>   Ex.: 25/12/11</font>";
                    ?>
                    
                </td>
            </tr>
            
            <tr>
                <td align="right">Hora Disp.:</td>
                <td><input type="text" name="hora" size="5" maxlength="5" value="<?php echo $_POST[hora]; ?>" onkeyup="Formatahora(this,event)">
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
                    <select name="licitante" size="0" >
                        <option><?php echo $usuario; ?></option>-->
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
                <td><input type="text" name="perc_icms" size="3" maxlength="3" value="<?php echo $_POST[perc_icms]; ?>">
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
                    echo '<script language="javascript">document.cad_codigo.submit()</script>';
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