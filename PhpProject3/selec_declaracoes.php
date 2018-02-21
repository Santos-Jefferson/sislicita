
<?php
require "conecta.php";
require ("cabecalho_reduzido.php");
require ("cabecalho.php");
//print_r ($_POST);
//die;
//require ("corpo_menu.php");
//exibir a tabela com os pré-cadastros feitos.
//require ("pesquisa_licita.php");

//======================VALIDAÇÃO E CONVERSÃO DE DADOS=====================
//validação só funcionará quando não for a primeira vez que entra-se no formulario
//!empty (se não for vazio, faça os testes abaixo)
if (!empty($_POST)){

//-------------CAMPO codigo-------------------------
    if (empty($_POST[dec_nome])){
        $erro = $erro_dec_nome = true;
        }
    
    if (empty($_POST[rep_legal])){
        $erro = $erro_rep_legal = true;
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


</table><br>    
<tr>
    <th colspan="2" height="159" align="left" class="A" scope="col">
    <form action="<?php if ($erro or empty($_POST)) echo "selec_declaracoes.php";
                            elseif ($_POST[dec_nome]=="Ofício") echo "gera_oficios.php";
                                else echo "gera_declaracoes.php"; ?>" method="POST" name="selec_declaracoes">
                            
       <table width="1020" align="center" border="1" class="A" cellpading="0" cellspacing="0">
            <tr border="1">
                <td border="1">
        <table align="center" width="1010" border="0" class="A" cellpading="0" cellspacing="0" >
            <tr>
                <td colspan="2" align="center"><strong>SELECIONE AS OPÇÕES ABAIXO:<hr></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td width="140" align="right">Declaração/Documento:</td>
                <td>
                    <select name="dec_nome" size="0" >
                        <option><?php echo $_POST[dec_nome]; ?></option>
                        <option>Trabalho de Menores / Menor Idade</option>
                        <option>Inexistência de Fato Superveniente Impeditivo</option>
                        <option>Idoneidade</option>
                        <option>Cumprimento Dos Requisitos De Habilitação</option>
                        <option>Elaboração Independente De Proposta</option>
                        <option>Cadastramento de Domicílio Bancário</option>
                        <option>Microempresa(Me) e Empresa de Pequeno Porte(Epp)</option>
                        <option>Declarações Conjuntas</option>
                        <option>Personalizado / Outros</option>
                        <option>Ofício</option>
                        
                        
                    </select>
                    <?php
                        if($erro_dec_nome){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="140" align="right">Representante Legal:</td>
                <td>
                    <select name="rep_legal" size="0" >
                        <option><?php echo $_POST[rep_legal]; ?></option>
                        <option>Jefferson Santos</option>
                        <option>Vinicius de Quadros Mayer</option>
                        <option>Dyuliane Fialla Santos</option>
                    </select>
                    <?php
                        if($erro_rep_legal){
                            echo "<font color=red>*** Campo obrigatório</font>";
                            }
                    ?>
                </td>
            </tr>
            
            <tr>
                <td width="" align="right">Assinatura Digital:</td>
                <td>
                    <select name="ass_digital" size="0" >
                        <option><?php echo $_POST[ass_digital]; ?></option>
                        <option>Sim</option>
                        <option>Não</option>
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
                <td><input type="hidden" name="id_cod" value="<?php echo $_REQUEST[id_cod]; ?>"></td>
                
            </tr>
            
            
            
            <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                    echo '<script language="javascript">document.selec_declaracoes.submit()</script>';
                }
            
            ?> 
           <tr>
                <td></td>
                <td colspan="2" align="left"><input type="submit" value="Gerar Declaração" /></td>
                
            </tr>
        </form>  
</tr>
</table>
</table>