<?php

require "cabecalho_reduzido.php";
require "conecta.php";
//require "gera_cad_contrato.php";
       

if (!empty($_POST[data_ass_cont])){

//--------------CAMPO data-------------------------
//teste se é uma data gregoriana válida
//quebra a data em 3 partes
//após o slit, teremos o vetor $v em 3 pedaços: v[0] = dia, v[1] = mes, v[2] = ano
$v = split('[/.-]', $_POST[data_ass_cont]);

//testa se a data é válida

//@ na frente da função é para inibir o warning, use com cuidado!!!
/*if(!@checkdate($v[1], $v[0], $v[2])){
        $erro = $erro_data_ass_cont = true;
}
//se deu certo, converte a data
else {*/
    $_POST[data_ass_cont] = $v[2].'-'.$v[1].'-'.$v[0];
    //echo $_POST[data_ass_cont];

//comando para testar variáveis que vem do formulário
//print_r($_REQUEST);die;
}
/*
//INÍCIO - CRIA UM DIRETÓRIO NO CAMINHO INDICADO
$pasta = "Cod."." ".str_replace("/",".",$_REQUEST[codigo])."---".str_replace("/",".",$_REQUEST[orgao])."---"."Pregao"." ".str_replace("/",".",$_REQUEST[pregao])."-"."Lote"." ".$_REQUEST[lote];
mkdir ("emprocesso/$pasta", 0777 );   // aqui e o diretorio aonde será criado tipo home/public-html/
    echo "Pasta <b>$pasta </b> criada com sucesso!!<br><br>";
//FIM
    //echo $pasta;
    
//INICIO -  Insira aqui a pasta que deseja salvar o arquivo
$EP="emprocesso/";    
$uploaddir = $EP.$pasta."/";

echo $uploaddir;
echo "<br>";

$uploadfile = $uploaddir.$_FILES['contrato']['name'];

echo $uploadfile;
echo "<br>";


if (move_uploaded_file($_FILES['contrato']['tmp_name'], $uploadfile)){
echo "CONTRATO Enviado";}
else {echo "CONTRATO não enviado<br>";}
//FIM    
*/




//FIM    



//se é um alterar cadastro, utiliza a instrução UPDATE, se for cadastro novo, INSERT.
        //isset = existe ou não existe (se existe post[cod], então faz update. se não existe, faz cadastro novo
$sql_cod = "Select * From codigo Where id_cod = '{$_POST[id_cod]}'";
$res_cod = mysql_query($sql_cod) or die ("Erro selecação sql_cod");
$linha_cod = mysql_fetch_array($res_cod);

$sql = "SELECT * FROM contrato WHERE num_cont = '{$_POST[num_cont]}' or id_lote = '{$_POST[id_lote]}'";
$res = mysql_query($sql) or die("Erro seleção");

if (mysql_num_rows($res) and !isset($_POST[id_contrato])){
    
    require_once "validacao_cad_cont.php";
    die;
   
 }
    elseif(isset($_POST[id_contrato])){
        $sql =
        "UPDATE contrato SET data_ass_cont='{$_POST[data_ass_cont]}',num_cont='{$_POST[num_cont]}',prazo_gar='{$_POST[prazo_gar]}',mod_gar='{$_POST[mod_gar]}',vale_emp='{$_POST[vale_emp]}'
            WHERE id_contrato='{$_POST[id_contrato]}'
            ";
                                  
    //volta para a seleção e alteração
    //$lugar=('lista_lote_alt.php');
}
    else {
    $sql = "INSERT into contrato (data_ass_cont,num_cont,prazo_gar,mod_gar,vale_emp,id_lote)
                       VALUES ('{$_POST[data_ass_cont]}','{$_POST[num_cont]}','{$_POST[prazo_gar]}','{$_POST[mod_gar]}','{$_POST[vale_emp]}','{$_POST[id_lote]}'
                               )";
            /*if($linha_cod[tipo_licitacao]=="RP"){           
                $sql_2 =
                    "UPDATE lote SET colocacao='A receber NE'
                    WHERE id_lote='{$_POST[id_lote]}'
           ";}
           else{*/
               $sql_2 =
                    "UPDATE lote SET colocacao='A receber NE'
                    WHERE id_lote='{$_POST[id_lote]}'
           ";
                               
                               
                               
    $lugar=('lista_licita_tudo.php');
    }

    
    

//echo $sql;die;
mysql_query($sql) or die("Erro gravando sql1!!!");
mysql_query($sql_2);// or die("Erro gravando sql_2!!!");


$pasta = "Cod."." ".str_replace("/",".",$_REQUEST[codigo])."---".str_replace("/",".",$_REQUEST[orgao])."---"."Pregao"." ".str_replace("/",".",$_REQUEST[pregao])."-"."Lote"." ".$_REQUEST[lote];
mkdir ("emprocesso/$pasta/Contrato", 0777 );   // aqui e o diretorio aonde será criado tipo home/public-html/
    //echo "Pasta <b>Contrato </b> criada com sucesso!!<br><br>";
//FIM
    //echo $pasta;
    
//INICIO -  Insira aqui a pasta que deseja salvar o arquivo*/
$EP="emprocesso/";
$DEST="Contrato/";
$uploaddir = $EP.$pasta."/".$DEST;
//echo $uploaddir;
//echo "<br>";
$uploadfile = $uploaddir . $_FILES['contrato']['name'];
//echo $uploadfile;
//echo "<br>";

if (move_uploaded_file($_FILES['contrato']['tmp_name'], $uploadfile))
{
    $envio = "Contrato Enviado";  
}
        else
        {
            $envio = "<b>UPLOAD(Contrato) não enviado!";
        }




        
?>
    <tr>
        <td colspan="4" align="left" bgcolor="#FFFF00" class="A" scope="col">
            OK, CONTRATO cadastrado com sucesso e <?php echo $envio;?>
            <input type='button' value='VOLTAR'
               onclick='document.location.href="cad_contrato.php?id_cod=<?php echo $_POST[id_cod] ?>&id_lote=<?php echo $_POST[id_lote]?>&id_itens=<?php echo $_POST[id_itens];?>"'>
            <input type='button' value='CONTRATOS'
               onclick='document.location.href="gera_relatorio_cont.php?id_cod=<?php echo $_POST[id_cod] ?>&id_lote=<?php echo $_POST[id_lote]?>&id_itens=<?php echo $_POST[id_itens];?>"'>
            <!--<input type='button' value='Listar Notas de Empenho'
               onclick='document.location.href="lista_licita_tudo.php?codigo=<?php echo $_REQUEST[codigo] ?>"'>
            <input type='button' value='Listagem Geral'
               onclick='document.location.href="lista_licita_tudo.php"'>-->
        </td>
        
            
    </tr>

