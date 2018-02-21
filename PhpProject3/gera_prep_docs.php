
<?php
//print_r ($_POST);
//require "cabecalho_reduzido.php";
require "conecta.php";

/*$sql_uf = "SELECT * FROM codigo WHERE id_cod = {$_REQUEST[id_cod]}";

$res_uf = mysql_query($sql_uf) or die("Erro seleção UF");

//pega a primeira linha do resultado
$linha_uf = mysql_fetch_assoc($res_uf);
*/
require "prep_docs.php";


$D360 = "$_POST[D360]";
$D580 = "$_POST[D580]";
$N190 = "$_POST[N190]";
$N170 = "$_POST[N170]";

$bios = "$_POST[bios]";
$epeat = "$_POST[epeat]";
$es_epeat = "$_POST[es_epeat]";
$iec = "$_POST[iec]";
$iso9296 = "$_POST[iso9296]";
$hcl = "$_POST[hcl]";
$linuxsuse = "$_POST[linuxsuse]";
$linuxall = "$_POST[linuxall]";
$rohs = "$_POST[rohs]";
$dmtf = "$_POST[dmtf]";
$dmtf_pc = "$_POST[dmtf_pc]";
$fonte_300_torre = "$_POST[fonte_300_torre]";
$fonte_300_slim = "$_POST[fonte_300_slim]";
$fonte_250_slim = "$_POST[fonte_250_slim]";
$inpi = "$_POST[inpi]";
$iso9001 = "$_POST[iso9001]";
$iso14001 = "$_POST[iso14001]";
$microsoft = "$_POST[microsoft]";
$ppb = "$_POST[ppb]";
$ibama = "$_POST[ibama]";
$cert_anatel = "$_POST[cert_anatel]";
$cert_mb = "$_POST[cert_mb]";
    ?>
<table width="1010" align="center" border="1" class="A" cellpading="0" cellspacing="0">
            <tr border="1">
                <td bgcolor="yellow" align="center" border="1">
<?php

//INÍCIO - CRIA UM DIRETÓRIO NO CAMINHO INDICADO
$pasta = "Cod."." ".str_replace("/",".",$_REQUEST[codigo])."---".str_replace("/",".",$_REQUEST[orgao])."---"."Pregao"." ".str_replace("/",".",$_REQUEST[pregao])."-"."Lote"." ".$_REQUEST[lote];
mkdir ("emprocesso/$pasta", 0777 );   // aqui e o diretorio aonde será criado tipo home/public-html/
    echo "Pasta <b>$pasta </b> criada com sucesso!!<br><br>";
//FIM
    //echo $pasta;
    
//INICIO -  Insira aqui a pasta que deseja salvar o arquivo*/
$EP="emprocesso/";    
$uploaddir = $EP.$pasta."/";

//echo $uploaddir;
//echo "<br>";

$uploadfile = $uploaddir . $_FILES['edital']['name'];

//echo $uploadfile;
//echo "<br>";


if (move_uploaded_file($_FILES['edital']['tmp_name'], $uploadfile)){
echo "EDITAL Enviado";}
else {echo "EDITAL não enviado<br>";}
//FIM    
    
    
/*//INÍCIO - LISTANDO DIRETÓRIO CERTIDÕES NO BROWSER
$path = "emprocesso/";
$diretorio = dir($path);

echo "Lista de Arquivos do diretório '<strong>".$path."</strong>':<br />";    
    while($arquivo = $diretorio -> read()){
        echo "<a href='".$path.$arquivo."'>".$arquivo."</a><br />";
        }
$diretorio -> close();
*///FIM - LISTANDO DIRETÓRIO CERTIDÕES NO BROWSER
    
/*//INICIO - TESTAR SE ARQUIVO EXISTE
$filename = 'positivo/D360/EPEATGOLD-D360.pdf';

if (file_exists($filename)) {
   echo "O arquivo $filename existe<br>";
} else {
   echo "O arquivo $filename não existe<br>";
}
*///FIM
    
//CAMINHO DOS ARQUIVOS
$CT="certidoes/";    
$EP="emprocesso/";
    
//HABILITAÇÃO JURIDICA
$l_cont_social="contrato-social.pdf";
$l_alt1_cont_social="1_alteracao-contrato.pdf";
$l_alt2_cont_social="2_alteracao-contrato.pdf";
$l_alt2_cont_proc_docs="2_alt-contrato_proc_docs.pdf";
$l_alt3_cont_vini="3_alt-contrato.pdf";
$l_alt3_cont_proc_dyuli="3_alt-contrato_proc_dyuli.pdf";
$l_alt3_cont_proc_jeff="3_alt-contrato_proc_jeff.pdf";
$l_alt4_contrato="4_alt-contrato.pdf";
$l_alt5_contrato="5_alt-contrato_autenticado.pdf";
$l_procuracao="procuracao_2-alteracao.pdf";
$l_procuracao3_dyuli="procuracao_dyuli.pdf";
$l_procuracao3_jeff="procuracao_jeff.pdf";
$l_docs_procuradores="cnh_vini_jeff.pdf";
$l_doc3_vini="cnh_vinicius.pdf";
$l_doc3_dyuli="cnh_dyuli.pdf";
$l_doc3_jeff="cnh_jeff.pdf";
$l_sicaf_doc="cert_sicaf.pdf";
$l_alvara_doc="alvara-2013.pdf";

//REGULARIDADE FISCAL
$l_cartao_cnpj="cartao_cnpj.pdf";
$l_cert_federal_inss="cert_federal_inss.pdf";
$l_cert_estadual="cert_estadual.pdf";
$l_comp_insc_estadual="cert_insc-estadual.pdf";
$l_cert_municipal="cert_municipal.pdf";
$l_comp_insc_municipal="cert_insc-municipal.pdf";
$l_cert_fgts="cert_fgts.pdf";
//$l_cert_inss="cert_inss.pdf";
$l_cert_just_trabalho="cert_just_trabalho.pdf";
$l_cert_simples="cert_simples_nacional.pdf";
$l_cert_contador="cert_reg_prof_contadores.pdf";

//QUALIFICAÇÃO ECONOMICA-FINANCEIRA-TECNICA
$l_cert_falencia="cert_neg_falencia.pdf";
$l_cert_foro="cert_foro.pdf";
$l_balanco_patrimonial="balanco_2016_SPED.pdf";
$l_coef_balanco="coef_analise_2016.pdf";
$l_cert_junta="cert_junta.pdf";

//QUALIFICAÇÃO TÉCNICA
$l_celg="CELG-1200m-caboderededados-CN-ok.pdf";
$l_cesan="Cesan-22camdigital-CN-ok.pdf";
$l_copagas="Copagas-diversos-proj-peças-estab-CN-0017-ok.pdf";
$l_copel="Copel-230hd-CN-ok.pdf";
$l_cprm="CPRM-29note-CN-ok.pdf";
$l_etica="Etica-diversos-rede-licencas-SN-ok.pdf";
$l_fcaa="FCAA-diversos-peças-rede-CN-ok.pdf";
$l_govpr="GovPR-1720fonesouv-CN-ok.pdf";
$l_govrj="GovRJ-192pcs-CN-ok.pdf";
$l_sescoop="Sescoop-20note-CN-335-ok.pdf";
$l_toner10pc="Toner-10pc-02note-SN-ok.pdf";
$l_toner12pc="Toner-12pc-05impre-SN-ok.pdf";
$l_toner50pc="Toner-50pc-35imp-40note-SN-ok.pdf";
$l_trt23="TRT23-2pcmacpro-4monapple-CN-ok.pdf";
$l_unisol="Unisol-03proj-CN-442-ok.pdf";
$l_usp="USP-10note-CN-ok.pdf";

//MONITORES
$ips236v="MONITOR-IPS236V.pdf";
$w1946p="MONITOR-W1946P.pdf";
$fit85x="MONITOR-FIT85x.pdf";
$e2241vp="MONITOR-E2241VP.pdf";
$e2041s="MONITOR-E2041S.pdf";
$e2011p="MONITOR-E2011P.pdf";
$b1940w="MONITOR-B1940W.pdf";
$m19eb13t="MONITOR-19EB13T.pdf";
$m19eb13p="MONITOR-19EB13P.pdf";
$p971wal="MONITOR-P971WAL.pdf";

//FOLDERS D580
$d580_1="D570-WIN7PRO64B-I53550-2X2GB-1333-500GB.pdf";
$d580_2="D570-WIN7PRO64B-I53550-2X4GB-1333-500GB.pdf";
$d580_3="D570-WIN7PRO64B-I53550-2X2GB-1333-1TB.pdf";
$d580_4="D570-WIN7PRO64B-I53550-2X4GB-1333-1TB.pdf";
$d580_5="D570-WIN7PRO64B-I53550-2X2GB-1600-500GB.pdf";
$d580_6="D570-WIN7PRO64B-I53550-2X4GB-1600-500GB.pdf";
$d580_7="D570-WIN7PRO64B-I53550-2X2GB-1600-1TB.pdf";
$d580_8="D570-WIN7PRO64B-I53550-2X4GB-1600-1TB.pdf";




if(!empty($_POST[contrato_social])){
    if (copy ($CT.$l_cont_social, $EP.$pasta."/"."NI"."-".$l_cont_social)){
         echo ("Arquivo '$l_cont_social' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[alt1_contrato])){
    if (copy ($CT.$l_alt1_cont_social, $EP.$pasta."/"."NI"."-".$l_alt1_cont_social)){
         echo ("Arquivo '$l_alt1_cont_social' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[alt2_contrato])){
    if (copy ($CT.$l_alt2_cont_social, $EP.$pasta."/"."NI"."-".$l_alt2_cont_social)){
         echo ("Arquivo '$l_alt2_cont_social' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[alt2_cont_proc_docs])){
    if (copy ($CT.$l_alt2_cont_proc_docs, $EP.$pasta."/"."NI"."-".$l_alt2_cont_proc_docs)){
         echo ("Arquivo '$l_alt2_cont_proc_docs' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[alt3_cont_vini])){
    if (copy ($CT.$l_alt3_cont_vini, $EP.$pasta."/"."NI"."-".$l_alt3_cont_vini)){
         echo ("Arquivo '$l_alt3_cont_vini' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[alt4_contrato])){
    if (copy ($CT.$l_alt4_contrato, $EP.$pasta."/"."NI"."-".$l_alt4_contrato)){
         echo ("Arquivo '$l_alt4_contrato' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}

if(!empty($_POST[alt5_contrato])){
    if (copy ($CT.$l_alt5_contrato, $EP.$pasta."/".$l_alt5_contrato)){
         echo ("Arquivo '$l_alt5_contrato' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}


if(!empty($_POST[alt3_cont_proc_dyuli])){
    if (copy ($CT.$l_alt3_cont_proc_dyuli, $EP.$pasta."/"."NI"."-".$l_alt3_cont_proc_dyuli)){
         echo ("Arquivo '$l_alt3_cont_proc_dyuli' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[alt3_cont_proc_jeff])){
    if (copy ($CT.$l_alt3_cont_proc_jeff, $EP.$pasta."/"."NI"."-".$l_alt3_cont_proc_jeff)){
         echo ("Arquivo '$l_alt3_cont_proc_jeff' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}

if(!empty($_POST[procuracao])){
    if (copy ($CT.$l_procuracao, $EP.$pasta."/"."NI"."-".$l_procuracao)){
         echo ("Arquivo '$l_procuracao' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[docs_procuradores])){
    if (copy ($CT.$l_docs_procuradores, $EP.$pasta."/"."NI"."-".$l_docs_procuradores)){
         echo ("Arquivo '$l_docs_procuradores' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[doc3_vini])){
    if (copy ($CT.$l_doc3_vini, $EP.$pasta."/".$l_doc3_vini)){
         echo ("Arquivo '$l_doc3_vini' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[doc3_dyuli])){
    if (copy ($CT.$l_doc3_dyuli, $EP.$pasta."/".$l_doc3_dyuli)){
         echo ("Arquivo '$l_doc3_dyuli' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[doc3_jeff])){
    if (copy ($CT.$l_doc3_jeff, $EP.$pasta."/".$l_doc3_jeff)){
         echo ("Arquivo '$l_doc3_jeff' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}




if(!empty($_POST[sicaf])){
    if (copy ($CT.$l_sicaf_doc, $EP.$pasta."/".$l_sicaf_doc)){
         echo ("Arquivo '$l_sicaf_doc' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[alvara])){
    if (copy ($CT.$l_alvara_doc, $EP.$pasta."/".$l_alvara_doc)){
         echo ("Arquivo '$l_alvara_doc' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}



if(!empty($_POST[cartao_cnpj])){
    if (copy ($CT.$l_cartao_cnpj, $EP.$pasta."/".$l_cartao_cnpj)){
         echo ("Arquivo '$l_cartao_cnpj' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[cert_federal_inss])){
    if (copy ($CT.$l_cert_federal_inss, $EP.$pasta."/".$l_cert_federal_inss)){
         echo ("Arquivo '$l_cert_federal_inss' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[cert_estadual])){
    if (copy ($CT.$l_cert_estadual, $EP.$pasta."/".$l_cert_estadual)){
         echo ("Arquivo '$l_cert_estadual' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[comp_insc_estadual])){
    if (copy ($CT.$l_comp_insc_estadual, $EP.$pasta."/".$l_comp_insc_estadual)){
         echo ("Arquivo '$l_comp_insc_estadual' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[cert_municipal])){
    if (copy ($CT.$l_cert_municipal, $EP.$pasta."/".$l_cert_municipal)){
         echo ("Arquivo '$l_cert_municipal' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[comp_insc_municipal])){
    if (copy ($CT.$l_comp_insc_municipal, $EP.$pasta."/".$l_comp_insc_municipal)){
         echo ("Arquivo '$l_comp_insc_municipal' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[cert_fgts])){
    if (copy ($CT.$l_cert_fgts, $EP.$pasta."/".$l_cert_fgts)){
         echo ("Arquivo '$l_cert_fgts' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
/*if(!empty($_POST[cert_inss])){
    if (copy ($CT.$l_cert_inss, $EP.$pasta."/".$l_cert_inss)){
         echo ("Arquivo '$l_cert_inss' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}*/
if(!empty($_POST[cert_just_trabalho])){
    if (copy ($CT.$l_cert_just_trabalho, $EP.$pasta."/".$l_cert_just_trabalho)){
         echo ("Arquivo '$l_cert_just_trabalho' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[cert_simples])){
    if (copy ($CT.$l_cert_simples, $EP.$pasta."/".$l_cert_simples)){
         echo ("Arquivo '$l_cert_simples' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[cert_contador])){
    if (copy ($CT.$l_cert_contador, $EP.$pasta."/".$l_cert_contador)){
         echo ("Arquivo '$l_cert_contador' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}


if(!empty($_POST[cert_neg_falencia])){
    if (copy ($CT.$l_cert_falencia, $EP.$pasta."/"."NI"."-".$l_cert_falencia)){
         echo ("Arquivo '$l_cert_falencia' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[cert_foro])){
    if (copy ($CT.$l_cert_foro, $EP.$pasta."/".$l_cert_foro)){
         echo ("Arquivo '$l_cert_foro' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[bal_patrimonial])){
    if (copy ($CT.$l_balanco_patrimonial, $EP.$pasta."/".$l_balanco_patrimonial)){
         echo ("Arquivo '$l_balanco_patrimonial' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[coef_balanco])){
    if (copy ($CT.$l_coef_balanco, $EP.$pasta."/"."NI"."-".$l_coef_balanco)){
         echo ("Arquivo '$l_coef_balanco' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[cert_simp_junta])){
    if (copy ($CT.$l_cert_junta, $EP.$pasta."/".$l_cert_junta)){
         echo ("Arquivo '$l_cert_junta' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }  
}



if(!empty($_POST[celg])){
    if (copy ($CT.$l_celg, $EP.$pasta."/"."NI"."-".$l_celg)){
         echo ("Arquivo '$l_celg' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[cesan])){
    if (copy ($CT.$l_cesan, $EP.$pasta."/"."NI"."-".$l_cesan)){
         echo ("Arquivo '$l_cesan' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[copagas])){
    if (copy ($CT.$l_copagas, $EP.$pasta."/"."NI"."-".$l_copagas)){
         echo ("Arquivo '$l_copagas' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[copel])){
    if (copy ($CT.$l_copel, $EP.$pasta."/"."NI"."-".$l_copel)){
         echo ("Arquivo '$l_copel' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[cprm])){
    if (copy ($CT.$l_cprm, $EP.$pasta."/"."NI"."-".$l_cprm)){
         echo ("Arquivo '$l_cprm' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[etica])){
    if (copy ($CT.$l_etica, $EP.$pasta."/"."NI"."-".$l_etica)){
         echo ("Arquivo '$l_etica' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[fcaa])){
    if (copy ($CT.$l_fcaa, $EP.$pasta."/"."NI"."-".$l_fcaa)){
         echo ("Arquivo '$l_fcaa' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[govpr])){
    if (copy ($CT.$l_govpr, $EP.$pasta."/"."NI"."-".$l_govpr)){
         echo ("Arquivo '$l_govpr' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[govrj])){
    if (copy ($CT.$l_govrj, $EP.$pasta."/"."NI"."-".$l_govrj)){
         echo ("Arquivo '$l_govrj' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[sescoop])){
    if (copy ($CT.$l_sescoop, $EP.$pasta."/"."NI"."-".$l_sescoop)){
         echo ("Arquivo '$l_sescoop' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[toner10pc])){
    if (copy ($CT.$l_toner10pc, $EP.$pasta."/"."NI"."-".$l_toner10pc)){
         echo ("Arquivo '$l_toner10pc' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[toner12pc])){
    if (copy ($CT.$l_toner12pc, $EP.$pasta."/"."NI"."-".$l_toner12pc)){
         echo ("Arquivo '$l_toner12pc' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[toner50pc])){
    if (copy ($CT.$l_toner50pc, $EP.$pasta."/"."NI"."-".$l_toner50pc)){
         echo ("Arquivo '$l_toner50pc' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[trt23])){
    if (copy ($CT.$l_trt23, $EP.$pasta."/"."NI"."-".$l_trt23)){
         echo ("Arquivo '$l_trt23' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[unisol])){
    if (copy ($CT.$l_unisol, $EP.$pasta."/"."NI"."-".$l_unisol)){
         echo ("Arquivo '$l_unisol' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[usp])){
    if (copy ($CT.$l_usp, $EP.$pasta."/"."NI"."-".$l_usp)){
         echo ("Arquivo '$l_usp' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}

//MONITORES
if(!empty($_POST[ips236v])){
    if (copy ($CT.$ips236v, $EP.$pasta."/".$ips236v)){
         echo ("Arquivo '$ips236v' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[w1946p])){
    if (copy ($CT.$w1946p, $EP.$pasta."/".$w1946p)){
         echo ("Arquivo '$w1946p' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[fit85x])){
    if (copy ($CT.$fit85x, $EP.$pasta."/".$fit85x)){
         echo ("Arquivo '$fit85x' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[e2241vp])){
    if (copy ($CT.$e2241vp, $EP.$pasta."/".$e2241vp)){
         echo ("Arquivo '$e2241vp' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[e2041s])){
    if (copy ($CT.$e2041s, $EP.$pasta."/".$e2041s)){
         echo ("Arquivo '$e2041s' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[e2011p])){
    if (copy ($CT.$e2011p, $EP.$pasta."/".$e2011p)){
         echo ("Arquivo '$e2011p' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[b1940w])){
    if (copy ($CT.$b1940w, $EP.$pasta."/".$b1940w)){
         echo ("Arquivo '$b1940w' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[m19eb13t])){
    if (copy ($CT.$m19eb13t, $EP.$pasta."/".$m19eb13t)){
         echo ("Arquivo '$m19eb13t' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[m19eb13p])){
    if (copy ($CT.$m19eb13p, $EP.$pasta."/".$m19eb13p)){
         echo ("Arquivo '$m19eb13p' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[p971wal])){
    if (copy ($CT.$p971wal, $EP.$pasta."/".$p971wal)){
         echo ("Arquivo '$p971wal' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}

//FOLDERS D580
if(!empty($_POST[d580_1])){
    if (copy ($CT.$d580_1, $EP.$pasta."/".$d580_1)){
         echo ("Arquivo '$d580_1' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[d580_2])){
    if (copy ($CT.$d580_2, $EP.$pasta."/".$d580_2)){
         echo ("Arquivo '$d580_2' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[d580_3])){
    if (copy ($CT.$d580_3, $EP.$pasta."/".$d580_3)){
         echo ("Arquivo '$d580_3' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[d580_4])){
    if (copy ($CT.$d580_4, $EP.$pasta."/".$d580_4)){
         echo ("Arquivo '$d580_4' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[d580_5])){
    if (copy ($CT.$d580_5, $EP.$pasta."/".$d580_5)){
         echo ("Arquivo '$d580_5' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[d580_6])){
    if (copy ($CT.$d580_6, $EP.$pasta."/".$d580_6)){
         echo ("Arquivo '$d580_6' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[d580_7])){
    if (copy ($CT.$d580_7, $EP.$pasta."/".$d580_7)){
         echo ("Arquivo '$d580_7' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if(!empty($_POST[d580_8])){
    if (copy ($CT.$d580_8, $EP.$pasta."/".$d580_8)){
         echo ("Arquivo '$d580_8' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}






$d360_bios = "BIOS-D360.pdf";
$d360_epeat = "EPEATGOLD-D360.pdf";
$d360_hcl = "HCL-D360.pdf";
$d360_iec = "IEC61000-IEC60950-CISPR-D570-D360.pdf";
$d360_iso9296 = "ISO9296-NBR10152-D360.pdf";
$d360_linuxsuse = "LINUXSUSE-D360.pdf";
$d360_rohs = "ROHS-D360.pdf";
$d360_dmtf_pc = "DMTF-D570-D360.pdf";
$d360_fonte_300_torre = "FONTE-300W-BRONZE-GABTORRE.pdf";
$d360_fonte_300_slim = "FONTE-300W-BRONZE-GABSLIM.pdf";
$d360_fonte_250_slim = "FONTE-DELTA-250W-GOLD.pdf";

$pos_dmtf = "DMTF-MEMBERLIST-POSITIVO.pdf";
$pos_inpi = "INPI-POSITIVO.pdf";
$pos_iso9001 = "ISO9001-POSITIVO.pdf";
$pos_iso14001 = "ISO14001-POSITIVO.pdf";
$pos_microsoft = "MICROSOFT-GOLD-POSITIVO.pdf";
$pos_ppb = "PPB-POSITIVO.pdf";
$pos_ibama = "CR-IBAMA-SUST-AMBIENTAL.pdf";







if((!empty($D360)) and (!empty($bios))){
    if (copy ("positivo/D360/$d360_bios", "emprocesso/$pasta/$d360_bios")){
         echo ("Arquivo '$d360_bios' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($D360)) and (!empty($epeat))){
    if (copy ("positivo/D360/$d360_epeat", "emprocesso/$pasta/$d360_epeat")){
         echo ("Arquivo '$d360_epeat' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($D360)) and (!empty($iec))){
    if (copy ("positivo/D360/$d360_iec", "emprocesso/$pasta/$d360_iec")){
         echo ("Arquivo '$d360_iec' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($D360)) and (!empty($iso9296))){
    if (copy ("positivo/D360/$d360_iso9296", "emprocesso/$pasta/$d360_iso9296")){
         echo ("Arquivo '$d360_iso9296' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($D360)) and (!empty($hcl))){
    if (copy ("positivo/D360/$d360_hcl", "emprocesso/$pasta/$d360_hcl")){
         echo ("Arquivo '$d360_hcl' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($D360)) and (!empty($linuxsuse))){
    if (copy ("positivo/D360/$d360_linuxsuse", "emprocesso/$pasta/$d360_linuxsuse")){
         echo ("Arquivo '$d360_linuxsuse' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}

if((!empty($D360)) and (!empty($rohs))){
    if (copy ("positivo/D360/$d360_rohs", "emprocesso/$pasta/$d360_rohs")){
         echo ("Arquivo '$d360_rohs' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($D360)) and (!empty($dmtf_pc))){
    if (copy ("positivo/D360/$d360_dmtf_pc", "emprocesso/$pasta/$d360_dmtf_pc")){
         echo ("Arquivo '$d360_dmtf_pc' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($D360)) and (!empty($fonte_300_torre))){
    if (copy ("positivo/D360/$d360_fonte_300_torre", "emprocesso/$pasta/$d360_fonte_300_torre")){
         echo ("Arquivo '$d360_fonte_300_torre' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($D360)) and (!empty($fonte_300_slim))){
    if (copy ("positivo/D360/$d360_fonte_300_slim", "emprocesso/$pasta/$d360_fonte_300_slim")){
         echo ("Arquivo '$d360_fonte_300_slim' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($D360)) and (!empty($fonte_250_slim))){
    if (copy ("positivo/D360/$d360_fonte_250_slim", "emprocesso/$pasta/$d360_fonte_250_slim")){
         echo ("Arquivo '$d360_fonte_250_slim' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}



if((!empty($D360)) and (!empty($dmtf))){
    if (copy ("positivo/MARCA_POSITIVO/$pos_dmtf", "emprocesso/$pasta/$pos_dmtf")){
         echo ("Arquivo '$pos_dmtf' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($D360)) and (!empty($inpi))){
    if (copy ("positivo/MARCA_POSITIVO/$pos_inpi", "emprocesso/$pasta/$pos_inpi")){
         echo ("Arquivo '$pos_inpi' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($D360)) and (!empty($iso9001))){
    if (copy ("positivo/MARCA_POSITIVO/$pos_iso9001", "emprocesso/$pasta/$pos_iso9001")){
         echo ("Arquivo '$pos_iso9001' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($D360)) and (!empty($iso14001))){
    if (copy ("positivo/MARCA_POSITIVO/$pos_iso14001", "emprocesso/$pasta/$pos_iso14001")){
         echo ("Arquivo '$pos_iso14001' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($D360)) and (!empty($microsoft))){
    if (copy ("positivo/MARCA_POSITIVO/$pos_microsoft", "emprocesso/$pasta/$pos_microsoft")){
         echo ("Arquivo '$pos_microsoft' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($D360)) and (!empty($ppb))){
    if (copy ("positivo/MARCA_POSITIVO/$pos_ppb", "emprocesso/$pasta/$pos_ppb")){
         echo ("Arquivo '$pos_ppb' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($D360)) and (!empty($ibama))){
    if (copy ("positivo/MARCA_POSITIVO/$pos_ibama", "emprocesso/$pasta/$pos_ibama")){
         echo ("Arquivo '$pos_ibama' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}


$d580_bios = "D580-BIOS.pdf";
$d580_epeat = "D580-EPEATGOLD.pdf";
$d580_es_epeat = "D580-EPEATGOLD-ENERGYSTAR.pdf";
$d580_hcl = "D580-HCLWIN7EWIN8.pdf";
$d580_iec = "D580-IEC60950.pdf";
$d580_iso9296 = "D580-ISO9296-7779-10052.pdf";
$d580_linuxsuse = "D580-LINUXSUSE-ALL.pdf";
//$d580_linuxall = "LINUX-XTEST-D570.pdf";
$d580_rohs = "D580-ROHS.pdf";
$d580_dmtf_pc = "DMTF-D365-D580.pdf";
$d580_fonte_300_torre = "FONTE-300W-BRONZE-GABTORRE.pdf";
$d580_fonte_300_slim = "FONTE-300W-BRONZE-GABSLIM.pdf";
$d580_fonte_250_slim = "FONTE-DELTA-250W-GOLD.pdf";
$d580_cert_mb = "D580-PLACAMAE.pdf";


if((!empty($D580)) and (!empty($bios))){
    if (copy ("positivo/D580/$d580_bios", "emprocesso/$pasta/$d580_bios")){
         echo ("Arquivo '$d580_bios' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($D580)) and (!empty($epeat))){
    if (copy ("positivo/D580/$d580_epeat", "emprocesso/$pasta/$d580_epeat")){
         echo ("Arquivo '$d580_epeat' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}

if((!empty($D580)) and (!empty($es_epeat))){
    if (copy ("positivo/D580/$d580_es_epeat", "emprocesso/$pasta/$d580_es_epeat")){
         echo ("Arquivo '$d580_es_epeat' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}

if((!empty($D580)) and (!empty($cert_mb))){
    if (copy ("positivo/D580/$d580_cert_mb", "emprocesso/$pasta/$d580_cert_mb")){
         echo ("Arquivo '$d580_cert_mb' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}

if((!empty($D580)) and (!empty($iec))){
    if (copy ("positivo/D580/$d580_iec", "emprocesso/$pasta/$d580_iec")){
         echo ("Arquivo '$d580_iec' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($D580)) and (!empty($iso9296))){
    if (copy ("positivo/D580/$d580_iso9296", "emprocesso/$pasta/$d580_iso9296")){
         echo ("Arquivo '$d580_iso9296' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($D580)) and (!empty($hcl))){
    if (copy ("positivo/D580/$d580_hcl", "emprocesso/$pasta/$d580_hcl")){
         echo ("Arquivo '$d580_hcl' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($D580)) and (!empty($linuxsuse))){
    if (copy ("positivo/D580/$d580_linuxsuse", "emprocesso/$pasta/$d580_linuxsuse")){
         echo ("Arquivo '$d580_linuxsuse' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($D580)) and (!empty($linuxall))){
    if (copy ("positivo/D580/$d580_linuxall", "emprocesso/$pasta/$d580_linuxall")){
         echo ("Arquivo '$d580_linuxall' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}

if((!empty($D580)) and (!empty($rohs))){
    if (copy ("positivo/D580/$d580_rohs", "emprocesso/$pasta/$d580_rohs")){
         echo ("Arquivo '$d580_rohs' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($D580)) and (!empty($dmtf_pc))){
    if (copy ("positivo/D580/$d580_dmtf_pc", "emprocesso/$pasta/$d580_dmtf_pc")){
         echo ("Arquivo '$d580_dmtf_pc' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($D580)) and (!empty($fonte_300_torre))){
    if (copy ("positivo/D360/$d580_fonte_300_torre", "emprocesso/$pasta/$d580_fonte_300_torre")){
         echo ("Arquivo '$d580_fonte_300_torre' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($D580)) and (!empty($fonte_300_slim))){
    if (copy ("positivo/D360/$d580_fonte_300_slim", "emprocesso/$pasta/$d580_fonte_300_slim")){
         echo ("Arquivo '$d580_fonte_300_slim' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($D580)) and (!empty($fonte_250_slim))){
    if (copy ("positivo/D360/$d580_fonte_250_slim", "emprocesso/$pasta/$d580_fonte_250_slim")){
         echo ("Arquivo '$d580_fonte_250_slim' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}


if((!empty($D580)) and (!empty($dmtf))){
    if (copy ("positivo/MARCA_POSITIVO/$pos_dmtf", "emprocesso/$pasta/$pos_dmtf")){
         echo ("Arquivo '$pos_dmtf' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($D580)) and (!empty($inpi))){
    if (copy ("positivo/MARCA_POSITIVO/$pos_inpi", "emprocesso/$pasta/$pos_inpi")){
         echo ("Arquivo '$pos_inpi' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($D580)) and (!empty($iso9001))){
    if (copy ("positivo/MARCA_POSITIVO/$pos_iso9001", "emprocesso/$pasta/$pos_iso9001")){
         echo ("Arquivo '$pos_iso9001' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($D580)) and (!empty($iso14001))){
    if (copy ("positivo/MARCA_POSITIVO/$pos_iso14001", "emprocesso/$pasta/$pos_iso14001")){
         echo ("Arquivo '$pos_iso14001' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($D580)) and (!empty($microsoft))){
    if (copy ("positivo/MARCA_POSITIVO/$pos_microsoft", "emprocesso/$pasta/$pos_microsoft")){
         echo ("Arquivo '$pos_microsoft' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($D580)) and (!empty($ppb))){
    if (copy ("positivo/MARCA_POSITIVO/$pos_ppb", "emprocesso/$pasta/$pos_ppb")){
         echo ("Arquivo '$pos_ppb' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($D580)) and (!empty($ibama))){
    if (copy ("positivo/MARCA_POSITIVO/$pos_ibama", "emprocesso/$pasta/$pos_ibama")){
         echo ("Arquivo '$pos_ibama' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}

$n190_bios = "N190-BIOS.pdf";
$n190_epeat = "N190-EPEAT-GOLD.pdf";
$n190_hcl = "N190-HCL-WIN7eWIN8.pdf";
$n190_iec = "N190-IEC61000-IEC60950-CISPR.pdf";
//$n190_iso9296 = "ISO9296-NBR10152-D580.pdf";
//$d580_linuxsuse = "LINUXSUSE-D580.pdf";
//$d580_linuxall = "LINUX-XTEST-D580.pdf";
$n190_rohs = "N190-ROHS.pdf";
$n190_dmtf_pc = "N190-DMTF.pdf";
$n190_cert_anatel = "N190-N170-CERT-ANATEL.pdf";


if((!empty($N190)) and (!empty($bios))){
    if (copy ("positivo/N190/$n190_bios", "emprocesso/$pasta/$n190_bios")){
         echo ("Arquivo '$n190_bios' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo $n190_bios ");
    }    
}
if((!empty($N190)) and (!empty($epeat))){
    if (copy ("positivo/N190/$n190_epeat", "emprocesso/$pasta/$n190_bios")){
         echo ("Arquivo '$n190_epeat' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo $n190_bios");
    }    
}
if((!empty($N190)) and (!empty($iec))){
    if (copy ("positivo/N190/$n190_iec", "emprocesso/$pasta/$n190_iec")){
         echo ("Arquivo '$n190_iec' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo $n190_iec");
    }    
}
/*if((!empty($N190)) and (!empty($iso9296))){
    if (copy ("positivo/N190/$n190_iso9296", "emprocesso/$pasta/$n190_iso9296")){
         echo ("Arquivo '$n190_iso9296' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo $n190_iso9296");
    }    
}*/
if((!empty($N190)) and (!empty($hcl))){
    if (copy ("positivo/N190/$n190_hcl", "emprocesso/$pasta/$n190_hcl")){
         echo ("Arquivo '$n190_hcl' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo $n190_hcl");
    }    
}

if((!empty($N190)) and (!empty($rohs))){
    if (copy ("positivo/N190/$n190_rohs", "emprocesso/$pasta/$n190_rohs")){
         echo ("Arquivo '$n190_rohs' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo $n190_rohs");
    }    
}
if((!empty($N190)) and (!empty($dmtf_pc))){
    if (copy ("positivo/N190/$n190_dmtf_pc", "emprocesso/$pasta/$n190_dmtf_pc")){
         echo ("Arquivo '$n190_dmtf_pc' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo $n190_dmtf_pc");
    }    
}
if((!empty($N190)) and (!empty($n190_cert_anatel))){
    if (copy ("positivo/N190/$n190_cert_anatel", "emprocesso/$pasta/$n190_cert_anatel")){
         echo ("Arquivo '$n190_cert_anatel' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo $n190_cert_anatel");
    }    
}

if((!empty($N190)) and (!empty($dmtf))){
    if (copy ("positivo/MARCA_POSITIVO/$pos_dmtf", "emprocesso/$pasta/$pos_dmtf")){
         echo ("Arquivo '$pos_dmtf' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($N190)) and (!empty($inpi))){
    if (copy ("positivo/MARCA_POSITIVO/$pos_inpi", "emprocesso/$pasta/$pos_inpi")){
         echo ("Arquivo '$pos_inpi' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($N190)) and (!empty($iso9001))){
    if (copy ("positivo/MARCA_POSITIVO/$pos_iso9001", "emprocesso/$pasta/$pos_iso9001")){
         echo ("Arquivo '$pos_iso9001' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($N190)) and (!empty($iso14001))){
    if (copy ("positivo/MARCA_POSITIVO/$pos_iso14001", "emprocesso/$pasta/$pos_iso14001")){
         echo ("Arquivo '$pos_iso14001' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($N190)) and (!empty($microsoft))){
    if (copy ("positivo/MARCA_POSITIVO/$pos_microsoft", "emprocesso/$pasta/$pos_microsoft")){
         echo ("Arquivo '$pos_microsoft' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($N190)) and (!empty($ppb))){
    if (copy ("positivo/MARCA_POSITIVO/$pos_ppb", "emprocesso/$pasta/$pos_ppb")){
         echo ("Arquivo '$pos_ppb' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}
if((!empty($N190)) and (!empty($ibama))){
    if (copy ("positivo/MARCA_POSITIVO/$pos_ibama", "emprocesso/$pasta/$pos_ibama")){
         echo ("Arquivo '$pos_ibama' copiado para $pasta <br>");
    }
    else{
            die ("Erro ao copiar arquivo");
    }    
}

    
    
/*    
$origem="positivo/D360/EPEATGOLD-D360.pdf";    
$destino="emprocesso/Cod. 984371-22 2013 Orgao PREFEITURA MUNICIPAL DE CONTAGEM Pregao 22 2013";

//if((!empty($D360)) and (!empty($epeat))){
    copy($origem,$destino);
    //echo "Arquivo $epeat copiado com êxito";
    
*/





  
    

?>



