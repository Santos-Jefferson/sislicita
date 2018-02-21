
<?php
require "conecta.php";
require ("cabecalho_reduzido.php");
//require ("cabecalho.php");
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

?>
<script language=javascript>
<!--
function CheckAll() { 
   for (var i=0;i<document.prep_docs.elements.length;i++) {
     var x = document.prep_docs.elements[i];
     if (x.name == 'UIDL') { 
x.checked = document.prep_docs.selall.checked;
} 
} 
} 
//-->
</script>


</table><br>    
<tr>
    <th colspan="2" height="159" align="left" class="A" scope="col">
    <form action="<?php echo "gera_prep_docs.php";?>" method="POST" name="prep_docs" enctype="multipart/form-data">
                            
       <table width="1010" align="center" border="1" class="A" cellpading="0" cellspacing="0">
            <tr border="1">
                <td border="1">
                    
                    <table align="center" class="A" width="1000" border="1" cellpadding="3" cellspacing="0">
        
    <tr>
        <td class="forms" colspan="10" bgcolor="LemonChiffon" align="center"><strong>LISTAGEM LICITAÇÃO N°<a href="lista_licita_tudo.php?codigo=<?php echo $_GET[codigo];?>"><?php echo $_GET[codigo] ?></a> e LOTE/GRUPO N° <?php echo $_GET[lote] ?></td>
    </tr>
    
  <tr>
    <th width="" >TIPO</th>
    <th width="" >PREGÃO</th>  
    <th width="" >ÓRGÃO</th>
    <th width="" scope="col">CÓDIGO</th>
    <th width="" scope="col">DATA/HORA</th>
    <th width="" scope="col">LOTE/GRUPO</th>
    <th width="" scope="col">LICITANTE</th>
    
  </tr>
  <tr>
    <td align="center"><?php echo $_GET[tipo_licitacao] ?></td>
    <td align="center"><?php echo $_GET[pregao] ?></td>
    <td align="center"><?php echo $_GET[orgao]."/".$_GET[uf] ?></td>
    <td align="center"><?php echo $_GET[codigo] ?></td>
    <td align="center"><?php
                        $data = "$_GET[data]";
                        $hora = "$_GET[hora]";
                        echo date('d/m/Y', strtotime($data))." / ";
                        echo "$_GET[hora]";
                        ?>
    </td>
    <td align="center"><?php echo $_GET[lote] ?></td>
    <td align="center"><?php echo $_GET[licitante] ?></td>
    
  </tr>
                    
        <table align="center" width="1010" border="0" class="A" cellpading="0" cellspacing="0" >
            <tr>
                <td colspan="5" align="center"><strong><H2>PREPARAÇÃO DE DOCUMENTAÇÃO DE HABILITAÇÃO<hr></td>
            </tr>
            <tr>
                <td colspan="5" align="center"><strong><font color="red">SELECIONE O EDITAL AQUI: <input type="file" name="edital" size="20"><hr></td>
            </tr>
            

            
            <tr>
                <td valign="top"><strong>HABILITAÇÃO JURÍDICA:<hr></td>
                <td valign="top"><strong>REGULARIDADE FISCAL:<hr></td>
                <td valign="top"><strong>QUALIFICAÇÃO ECONOMICA/FINANCEIRA:<hr></td>
                        <td valign="top"><strong>QUALIFICAÇÃO TÉCNICA:<hr></td>
            </tr>
            <tr>
                <td valign="top">
                    <!--<input type=checkbox name="selall" onclick="CheckAll()">Selecionar todas as opções<br>-->
                    <!--<input type="checkbox" name="contrato_social" value="contrato_social">Contrato Social<br>-->
                    <!--<input type="checkbox" name="alt1_contrato" value="alt1_contrato">1° Alteração C. Social<br>
                    <input type="checkbox" name="alt2_contrato" value="alt2_contrato">2° Alteração C. Social<br>
                    <input type="checkbox" name="alt2_cont_proc_docs" value="alt2_cont_proc_docs">2° Alteração C. Social + Procuração + CNH<br>-->
                    <!--<input type="checkbox" name="alt3_cont_vini" value="alt3_cont_vini">3° Alteração C. Social(só Vinicius)<br>
                    <input type="checkbox" name="alt3_cont_proc_dyuli" value="alt3_cont_proc_dyuli">3° Alteração C. Social + Procuração + Dyuli<br>
                    <input type="checkbox" name="alt3_cont_proc_jeff" value="alt3_cont_proc_jeff">3° Alteração C. Social + Procuração + Jeff<br>
                    <input type="checkbox" name="alt4_contrato" value="alt4_contrato">4° Alteração C. Social<br>
                    <!--<input type="checkbox" name="procuracao" value="procuracao">Procuração 2° Alteração<br>
                    <input type="checkbox" name="docs_procuradores" value="docs_procuradores">Docs Procuração 2°alteração<br>
                    <input type="checkbox" name="procuracao3_dyuli" value="procuracao3_dyuli">Procuração 3° Alteração Dyuli<br>
                    <input type="checkbox" name="procuracao3_jeff" value="procuracao3_jeff">Procuração 3° Alteração Jeff<br>-->
                    <input type="checkbox" name="alt5_contrato" value="alt4_contrato">5° Alteração C. Social - Autenticado<br>
                    <input type="checkbox" name="doc3_vini" value="doc3_vini">Doc/CNH Vinicius<br>
                    <input type="checkbox" name="doc3_dyuli" value="doc3_dyuli">Doc/CNH Dyuli<br>
                    <input type="checkbox" name="doc3_jeff" value="doc3_jeff">Doc/CNH Jeff<br>
                    <input type="checkbox" name="sicaf" value="sicaf">Sicaf<br>
                    <input type="checkbox" name="alvara" value="alvara">Alvará<br>
                </td>
              <td valign="top">
                    <input type="checkbox" name="cartao_cnpj" value="cartao_cnpj">Cartão CNPJ<br>
                    <input type="checkbox" name="cert_federal_inss" value="cert_federal_inss">Certidão Federal e INSS<br>
                    <input type="checkbox" name="cert_estadual" value="cert_estadual">Certidão Estadual<br>
                    <input type="checkbox" name="comp_insc_estadual" value="comp_insc_estadual">Comprovante Insc. Estadual<br>
                    <input type="checkbox" name="cert_municipal" value="cert_municipal">Certidão Municipal<br>
                    <input type="checkbox" name="comp_insc_municipal" value="comp_insc_municipal">Comprovante Insc. Municipal<br>
                    <input type="checkbox" name="cert_fgts" value="cert_fgts">Certidão FGTS<br>
                    <input type="checkbox" name="cert_just_trabalho" value="cert_just_trabalho">Certidão Trabalhista<br>
                    <!--<input type="checkbox" name="cert_simples" value="cert_simples">Certidão Simples Nacional<br>-->
                    
                </td>
             <td valign="top">
                    <input type="checkbox" name="cert_neg_falencia" value="cert_neg_falencia">Certidão Negativa Falência<br>
                    <input type="checkbox" name="cert_foro" value="cert_foro">Certidão Foro/Distribuidores<br>
                    <input type="checkbox" name="bal_patrimonial" value="bal_patrimonial">Balanço Patrimonial<br>
                    <input type="checkbox" name="coef_balanco" value="coef_balanco">Coeficientes Balanço<br>
                    <input type="checkbox" name="cert_simp_junta" value="cert_simp_junta">Certidão Simp. Junta Comercial<br>
                    <input type="checkbox" name="cert_contador" value="cert_contador">Certidão Reg. Prof. - Contadores<br>
                    
                    
             </td>
             <td valign="top">
                    <input type="checkbox" name="celg" value="celg">CELG-1200m-caboderededados-CN<br>
                    <input type="checkbox" name="cesan" value="cesan">Cesan-22camdigital-CN<br>
                    <input type="checkbox" name="copagas" value="copagas">Copagas-diversos-proj-peças-estab-CN-0017<br>
                    <input type="checkbox" name="copel" value="copel">Copel-230hd-CN<br>
                    <input type="checkbox" name="cprm" value="cprm">CPRM-29note-CN<br>
                    <input type="checkbox" name="etica" value="etica">Etica-diversos-rede-licencas-SN<br>
                    <input type="checkbox" name="fcaa" value="fcaa">FCAA-diversos-peças-rede-CN<br>
                    <input type="checkbox" name="govpr" value="govpr">GovPR-1720fonesouv-CN<br>
                    <input type="checkbox" name="govrj" value="govrj">GovRJ-192pcs-CN<br>
                    <input type="checkbox" name="sescoop" value="sescoop">Sescoop-20note-CN-335<br>
                    <input type="checkbox" name="toner10pc" value="toner10pc">Toner-10pc-02note-SN<br>
                    <input type="checkbox" name="toner12pc" value="toner12pc">Toner-12pc-05impre-SN<br>
                    <input type="checkbox" name="toner50pc" value="toner50pc">Toner-50pc-35imp-40note-SN<br>
                    <input type="checkbox" name="trt23" value="trt23">TRT23-2pcmacpro-4monapple-CN<br>
                    <input type="checkbox" name="unisol" value="unisol">Unisol-03proj-CN-442<br>
                    <input type="checkbox" name="usp" value="usp">USP-10note-CN<br>
                    
                    
             </td>
               
            </tr>
            <tr>
                <td colspan="3">
                    <br><br>
                </td>
            </tr>
            <tr>
                <td valign="top"><strong>MODELO - EQUIPAMENTO POSITIVO:<hr></td>
                <td valign="top"><strong>CERTIFICADOS POR EQUIPAMENTO:<hr></td>
                <td colspan="" valign="top"><strong>CERTIFICADOS DA MARCA POSITIVO:<hr></td>
                <td colspan="" valign="top"><strong>FOLDERS PEÇAS/MONITORES:<hr></td>
            </tr>
            <tr>
                <td valign="top">
            
                    <input type="radio" name="D360" value="D360">DESKTOP D360<br>
                    <input type="radio" name="D580" value="D580">DESKTOP D580<br>
                    <input type="radio" name="N190" value="N190">NOTEBOOK N190<br><br><B>FOLDER:</B><hr>
                    <!--<input type="checkbox" name="d570_1" value="d570_1">D570-W7P-I53550-2X2G-1333-500GB<br>
                    <input type="checkbox" name="d570_2" value="d570_2">D570-W7P-I53550-2X4G-1333-500GB<br>
                    <input type="checkbox" name="d570_3" value="d570_3">D570-W7P-I53550-2X2G-1333-1TB<br>
                    <input type="checkbox" name="d570_4" value="d570_4">D570-W7P-I53550-2X4G-1333-1TB<br>
                    
                    <input type="checkbox" name="d570_5" value="d570_5">D570-W7P-I53550-2X2G-1600-500GB<br>
                    <input type="checkbox" name="d570_6" value="d570_6">D570-W7P-I53550-2X4G-1600-500GB<br>
                    <input type="checkbox" name="d570_7" value="d570_7">D570-W7P-I53550-2X2G-1600-1TB<br>
                    <input type="checkbox" name="d570_8" value="d570_8">D570-W7P-I53550-2X4G-1600-1TB<br>
                    
                    <input type="radio" name="N170" value="N170">Notebook N170<br><br>-->
                    
                    
                </td>
                
                <td valign="top">

                    <input type="checkbox" name="bios" value="bios">BIOS(Direitos CopyRight)<br>
                    <input type="checkbox" name="epeat" value="epeat">EPEAT GOLD(TI Verde)<br>
                    <input type="checkbox" name="es_epeat" value="es_epeat">ENERGY STAR(EPEAT)<br>
                    <input type="checkbox" name="iec" value="iec">IEC61000/IEC60950/CISPR22/24(InMetro)<br>
                    <input type="checkbox" name="iso9296" value="iso9296">ISO9296/NBR10152(Ruído)<br>
                    <input type="checkbox" name="hcl" value="hcl">HCL WINDOWS<br>
                    <input type="checkbox" name="linuxsuse" value="linuxsuse">HCL LINUX-SUSE<br>
                    <input type="checkbox" name="linuxall" value="linuxall">HCL LINUX-ALL<br>
                    <input type="checkbox" name="rohs" value="rohs">ROHS(TI Verde)<br>
                    <input type="checkbox" name="dmtf_pc" value="dmtf_pc">DMTF EQUIPAMENTO(DMI, Ger. Remoto)<br>
                    <input type="checkbox" name="fonte_300_torre" value="fonte_300_torre">FONTE 300W BRONZE GAB. TORRE<br>
                    <input type="checkbox" name="fonte_300_slim" value="fonte_300_slim">FONTE 300W BRONZE GAB. SLIM<br>
                    <input type="checkbox" name="fonte_250_slim" value="fonte_250_slim">FONTE 250W GOLD GAB. SLIM<br>
                    <input type="checkbox" name="cert_anatel" value="cert_anatel">HOMOLOGAÇÃO ANATEL<br>
                    <input type="checkbox" name="cert_mb" value="cert_mb">FOLDER PLACA MÃE<br>
                </td>
                <td valign="top">
                    <input type="checkbox" name="dmtf" value="dmtf">DMTF(DMI, Ger. Remoto)<br>
                    <input type="checkbox" name="inpi" value="inpi">INPI(Marca Reg. POSITIVO)<br>
                    <input type="checkbox" name="iso9001" value="iso9001">ISO9001<br>
                    <input type="checkbox" name="iso14001" value="iso14001">ISO14001(TI Verde)<br>
                    <input type="checkbox" name="microsoft" value="microsoft">MICROSOFT GOLD PARTNER<br>
                    <input type="checkbox" name="ppb" value="ppb">PPB<br>
                    <input type="checkbox" name="ibama" value="ibama">SUST AMBIENTAL-IBAMA<br><br>
                </td>
                <td valign="top">
                     <input type="checkbox" name="e2011p" value="e2011p">Monitor E2011P<br>
                     <input type="checkbox" name="b1940w" value="b1940w">Monitor B1940W<br>
                     <input type="checkbox" name="fit85x" value="fit85x">Monitor FIT85X<br>
                     <input type="checkbox" name="p971wal" value="p971wal">Monitor P971WAL<br>
                    <input type="checkbox" name="ips236v" value="ips236v">Monitor IPS236V<br>
                    <input type="checkbox" name="m19eb13p" value="m19eb13p">Monitor 19EB13P<br>
                    <input type="checkbox" name="m19eb13t" value="m19eb13t">Monitor 19EB13T<br>
                    <input type="checkbox" name="e2041s" value="e2041s">Monitor E2041S<br>
                    <input type="checkbox" name="e2241vp" value="e2241vp">Monitor E2241VP<br>
                    <input type="checkbox" name="fit85x" value="fit85x">Monitor FIT85X<br>
                    <input type="checkbox" name="w1946p" value="w1946p">Monitor W1946P<br>
                    
                    
                    </td>
            </tr>
            
                       
            <tr>
                <td><input type="hidden" name="orgao" value="<?php echo $_REQUEST[orgao]; ?>"></td>
                <td><input type="hidden" name="pregao" value="<?php echo $_REQUEST[pregao]; ?>"></td>
                <td><input type="hidden" name="codigo" value="<?php echo $_REQUEST[codigo]; ?>"></td>
                <td><input type="hidden" name="lote" value="<?php echo $_REQUEST[lote]; ?>"></td>
                <td><input type="hidden" name="id_cod" value="<?php echo $_REQUEST[id_cod]; ?>"></td>
                
            </tr>
            
            
            
            <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                    echo '<script language="javascript">document.prep_docs.submit()</script>';
                }
            
            ?> 
           <tr>
                
                <td colspan="2" align="left"><input type="submit" value="Criar Pasta" /></td>
                
            </tr>
        </form>  
</tr>
</table>
</table>
