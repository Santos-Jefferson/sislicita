<?php

require "cabecalho_reduzido.php";
require "conecta.php";

       
//comando para testar variáveis que vem do formulário
//print_r($_REQUEST);die;


//INÍCIO - CRIA UM DIRETÓRIO NO CAMINHO INDICADO
$pasta = "Cod."." ".str_replace("/",".",$_REQUEST[codigo])."---".str_replace("/",".",$_REQUEST[orgao])."---"."Pregao"." ".str_replace("/",".",$_REQUEST[pregao])."-"."Lote"." ".$_REQUEST[lote];
mkdir ("emprocesso/$pasta/Contrato", 0777 );   // aqui e o diretorio aonde será criado tipo home/public-html/
    echo "Pasta <b>Contrato </b> criada com sucesso!!<br><br>";
//FIM
    //echo $pasta;
    
//INICIO -  Insira aqui a pasta que deseja salvar o arquivo*/
$EP="emprocesso/";
$DEST="Contrato/";
$uploaddir = $EP.$pasta."/".$DEST;
echo $uploaddir;
echo "<br>";
$uploadfile = $uploaddir . $_FILES['contrato']['name'];
echo $uploadfile;
echo "<br>";

if (move_uploaded_file($_FILES['contrato']['tmp_name'], $uploadfile)){
echo "Contrato Enviado";}
else {echo "Contrato não enviado<br>";}
//FIM    
