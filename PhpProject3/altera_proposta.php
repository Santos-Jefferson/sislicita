<?php
require "conecta.php";
require ("cabecalho_reduzido.php");
require ("cabecalho.php");
//print_r ($_REQUEST);
//die;
//require ("corpo_menu.php");
//exibir a tabela com os pré-cadastros feitos.
//require ("pesquisa_licita.php");


$sql="SELECT * FROM proposta WHERE id_lote=$_REQUEST[id_lote]";
$res=mysql_query($sql) or die("erro seleção proposta");
$linha=mysql_fetch_assoc($res);


//======================VALIDAÇÃO E CONVERSÃO DE DADOS=====================
//validação só funcionará quando não for a primeira vez que entra-se no formulario
//!empty (se não for vazio, faça os testes abaixo)
if (!empty($_POST)){

//-------------CAMPO codigo-------------------------
    if (empty($_POST[val_proposta])){
        $erro = $erro_val_proposta = true;
        }
    
    if (empty($_POST[gar_proposta])){
        $erro = $erro_gar_proposta = true;
        }
        if (empty($_POST[tipo_garantia])){
        $erro = $erro_tipo_garantia = true;
        }
        if (empty($_POST[prazo_entrega])){
        $erro = $erro_prazo_entrega = true;
        }
        if (empty($_POST[prazo_pagamento])){
        $erro = $erro_prazo_pagamento = true;
        }
        if (empty($_POST[local_entrega])){
        $erro = $erro_local_entrega = true;
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
    <form action="<?php if ($erro or empty($_POST)) echo "selec_proposta.php";
                            else echo "gera_proposta.php"; ?>" method="POST" name="selec_proposta">
                            
       <table width="1020" align="center" border="1" class="A" cellpading="0" cellspacing="0">
            <tr border="1">
                <td border="1">
        <table align="center" width="1010" border="0" class="A" cellpading="0" cellspacing="0" >
            <tr>
                <td colspan="4" align="center"><strong>SELECIONE AS OPÇÕES ABAIXO:<hr></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td width="" align="right">Validade da Proposta (em dias):</td>
                <td><input type="text" name="val_proposta" size="3" maxlength="3" value="<?php echo $linha[validade_prop]; ?>">
                    <?php
                        if($erro_val_proposta){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="" align="right">Garantia (em meses):</td>
                <td><input type="text" name="gar_proposta" size="3" maxlength="3" value="<?php echo $linha[garantia_prop]; ?>">
                    <?php
                        if($erro_gar_proposta){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                    ?>
                </td>
                
            </tr>
            <tr>
                <td width="" align="right">Tipo Garantia:</td>
                <td>
                    <select name="tipo_garantia" size="0" >
                        <option><?php echo $linha[tipo_garantia]; ?></option>
                        <option>Balcão</option>
                        <option>On Site</option>
                    </select>
                    <?php
                        if($erro_tipo_garantia){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                    ?>
                </td>
                
            </tr>
            <tr>
                <td width="" align="right">Prazo de Entrega (em dias):</td>
                <td><input type="text" name="prazo_entrega" size="3" maxlength="3" value="<?php echo $linha[prazo_entrega]; ?>">
                    <?php
                        if($erro_prazo_entrega){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="" align="right">Tipo Entrega:</td>
                <td>
                    <select name="tipo_entrega" size="0" >
                        <option><?php echo $linha[tipo_entrega]; ?></option>
                        <option>Dias corridos</option>
                        <option>Dias úteis</option>
                    </select>
                    <?php
                        if($erro_tipo_entrega){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                    ?>
                </td>
             </tr>
            
            <tr>
                <td width="" align="right">Prazo de Pagamento (em dias):</td>
                <td><input type="text" name="prazo_pagamento" size="3" maxlength="3" value="<?php echo $linha[prazo_pgto]; ?>">
                    <?php
                        if($erro_prazo_pagamento){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                    ?>
                </td>
            </tr>
            
            <tr>
                <td width="" align="right">Local de Entrega:</td>
                <td><input type="text" name="local_entrega" size="100" maxlength="1000" value="<?php echo $linha[local_entrega]; ?>">
                    <?php
                        if($erro_local_entrega){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="" align="right">Linha adicional 1:</td>
                <td><input type="text" name="linha_adic_1" size="100" maxlength="5000" value="<?php echo $linha[linha_adic_1]; ?>">
                </td>
            </tr>
            <tr>
                <td width="" align="right">Linha adicional 2:</td>
                <td><input type="text" name="linha_adic_2" size="100" maxlength="5000" value="<?php echo $linha[linha_adic_2]; ?>">
                </td>
            </tr>
            
            <!--<tr>
                <td align="right">Data Proposta:</td>
                <td><input type="text" name="data_prop" size="8" maxlength="8" onkeyup="Formatadata(this,event)" value="
                    <?php/*
                        if(($linha[data_prop])=="0000-00-00"){
                            echo strftime("%d/%m/%Y");
                        }
                        else{
                        echo (date('d/m/Y', strtotime($linha[data_prop])));
                        }*/
                        ?>
                    ">
                    
                </td>
            </tr>-->
            <!--<tr>
                <td width="140" align="right">Linha adicional 3:</td>
                <td><input type="text" name="linha_adic_3" size="100" maxlength="2000" value="<?php echo $linha[linha_adic_3]; ?>">
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Linha adicional 4:</td>
                <td><input type="text" name="linha_adic_4" size="100" maxlength="2000" value="<?php echo $_POST[linha_adic_4]; ?>">
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Linha adicional 5:</td>
                <td><input type="text" name="linha_adic_5" size="100" maxlength="2000" value="<?php echo $_POST[linha_adic_5]; ?>">
                </td>
            </tr>-->
            <tr>
                <td width="" align="right">Representante Legal:</td>
                <td>
                    <select name="rep_legal" size="0" >
                        <option><?php echo $linha[rep_legal]; ?></option>
                        <option>Jefferson Santos</option>
                        <option>Vinicius de Quadros Mayer</option>
                    </select>
                    <?php
                        if($erro_rep_legal){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                    ?>
                </td>
            </tr>
                       
            <tr>
                <td><input type="hidden" name="orgao" value="<?php echo $_REQUEST[orgao]; ?>"></td>
                <td><input type="hidden" name="pregao" value="<?php echo $_REQUEST[pregao]; ?>"></td>
                <td><input type="hidden" name="codigo" value="<?php echo $_REQUEST[codigo]; ?>"></td>
                <td><input type="hidden" name="lote" value="<?php echo $_REQUEST[lote]; ?>"></td>
                <td><input type="hidden" name="licitante" value="<?php echo $_REQUEST[licitante]; ?>"></td>
                <td><input type="hidden" name="id_itens" value="<?php echo $_REQUEST[id_itens]; ?>"></td>
                <td><input type="hidden" name="id_cod" value="<?php echo $_REQUEST[id_cod]; ?>"></td>
                <td><input type="hidden" name="id_lote" value="<?php echo $_REQUEST[id_lote]; ?>"></td>
                <td><input type="hidden" name="id_proposta" value="<?php echo $linha[id_proposta]; ?>"></td>
                
                
            </tr>
            
            
            
            <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                    echo '<script language="javascript">document.selec_proposta.submit()</script>';
                }
            
            ?> 
           <tr>
                <td></td>
                <td colspan="2" align="left"><input type="submit" value="Gerar Proposta" /></td>
                
            </tr>
        </form>  
</tr>
</table>
</table>