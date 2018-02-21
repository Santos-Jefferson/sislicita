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

//não pode ser vazio o campo (campo obrigatório)
    if (empty($_POST[codigo])){
        $erro = $erro_codigo = true;
        }
    
//-------------CAMPO lote/grupo-------------------------

//não pode ser vazio o campo (campo obrigatório)
    if (empty($_POST[lote])){
        $erro = $erro_lote = true;
        }
    
//-------------CAMPO orgão-------------------------

//não pode ser vazio o campo (campo obrigatório)
    if (empty($_POST[orgao])){
        $erro = $erro_orgao = true;
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
<tr>
    <th colspan="2" height="159" align="left" class="A" scope="col">
    <!-- o form deve conter a tag name="" para que possa ser submetido automatica-->
    
    <form action="<?php if ($erro or empty($_POST)) echo "cad_licita.php"; 
                            else echo "grava_cad.php"; ?>" method="POST" name="cad_licita">
        
        <table border="0">
            
            <tr>
                <td colspan="2" align="center"><strong>PRÉ-CADASTRE AQUI SUA LICITAÇÃO A PARTICIPAR<hr></td>
            </tr>
            
            <tr>
                <td align="right">Cód. BB/Uasg/Pregão:</td>
                <td><input type="text" name="codigo" size="20" maxlength="20" value="<?php echo $_POST[codigo]; ?>">
                    <?php
                        if($erro_codigo){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            
            <!--<tr>
                <td align="right">Lote/Grupo:</td>
                <td><input type="text" name="lote" size="2" maxlength="2" value="<?php echo $_POST[lote]; ?>">
                    <?php
                        if($erro_lote){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            -->
            
            <tr>
                <td align="right">Órgão:</td>
                <td><input type="text" name="orgao" size="50" maxlength="50" value="<?php echo $_POST[orgao]; ?>">
                    <?php
                        if($erro_orgao){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            
            <tr>
                <td align="right">Data Disp.:</td>
                <td><input type="text" name="data" size="20" maxlength="20" value="<?php echo $_POST[data]; ?>">
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
                <td><input type="text" name="hora" size="20" maxlength="20" value="<?php echo $_POST[hora]; ?>">
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
                        <option><?php echo $_POST[licitante]; ?></option>
                        <option>Dyuliane</option>
                        <option>Getulio</option>
                        <option>Marcelo</option>
                    </select>
                        <?php
                            if($erro_licitante){
                                echo "<font color=red>*** Campo obrigatório</font>";
                            }
                        ?>
                </td>
            </tr>
            
            <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                    echo '<script language="javascript">document.cad_licita.submit()</script>';
                }
            
            ?>
            <tr>
                <td></td>
                <td colspan="2" align="left"><input type="submit" value="Cadastrar" /></td>
                
            </tr>
        </form>  
</tr>
