
<?php
require "conecta.php";
require ("cabecalho_reduzido.php");
require ("cabecalho.php");
require_once "css.php";
//print_r ($_REQUEST);
//die;
//require ("corpo_menu.php");
//exibir a tabela com os pré-cadastros feitos.
//require ("pesquisa_licita.php");

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
    

?>


</table>
</table>
<br>    

       <table width="1020" align="center" border="1" class="A" cellpading="0" cellspacing="0">
            <tr>
                <td>
                    <table width="1010" align="center" border="0" class="A" cellpading="0" cellspacing="0">
                
                <td colspan="4" align="center"><strong>SELECIONE AS CERTIDÕES ABAIXO:<hr></td>
            </tr>
            <tr>
                <td colspan="4" align="left"><strong>HABILITAÇÃO JURÍDICA<hr></td>
            </tr>
            <tr>
                <td width="200" height="30" align="left"><a href="certidoes/contrato-social.pdf" target="_blank">CONTRATO SOCIAL</a></td>
                <td width="" align="left">Ato constitutivo, estatuto ou contrato em vigor, devidamente registrado, em se tratando de sociedades comerciais e no caso de sociedade por ações, acompanhado dos documentos de eleição de seus atuais administradores;</td>
            </tr>
            <tr>
                <td width="200" height="30" align="left"><a href="certidoes/1_alteracao-contrato.pdf" target="_blank">1° ALTERAÇÃO CONTRATUAL</a></td>
                <td width="" align="left">1° Alteração do contrato social (enviar somente se solicitado, senão enviar somente a 2° Alteração do contrato social, junto com a procuração e documentos dos procuradores;</td>
            </tr>
            <tr>
                <td width="200" height="30" align="left"><a href="certidoes/2_alteracao-contrato.pdf" target="_blank">2° ALTERAÇÃO CONTRATUAL</a></td>
                <td width="" align="left">2° Alteração do contrato social. (enviar sempre com a procuração e documentos dos procuradores);</td>
            </tr>
            <tr>
                <td width="" height="30" align="left"><a href="certidoes/procuracao_2-alteracao.pdf" target="_blank">PROCURAÇÃO</a></td>
                <td width="" align="left">Necessário enviar junto com a 2° alteração contratual;</td>
            </tr>
            <tr>
                <td width="" height="30" align="left"><a href="certidoes/cnh_vini_jeff.pdf" target="_blank">DOC_PROCURADORES</a></td>
                <td width="" align="left">Encaminhar sempre que a procuração for enviada.</td>
            </tr>
            <tr>
                <td width="" height="30" align="left"><a href="certidoes/cert_sicaf.pdf" target="_blank">SICAF</a></td>
                <td width="" align="left">SICAF - necessário assinatura;</td>
            </tr>
            <tr>
                <td width="" height="30" align="left"><a href="certidoes/alvara-2013.pdf" target="_blank">ALVARÁ</a></td>
                <td width="" align="left">Alvará de funcionamento da SANTOS & MAYER atual.</td>
            </tr>
            <tr>
                <td colspan="4" align="left"><strong><BR>REGULARIDADE FISCAL<hr></td>
            </tr>
            <tr>
                <td width="" height="30" align="left"><a href="certidoes/cartao_cnpj.pdf" target="_blank">CARTÃO CNPJ</a></td>
                <td width="" align="left">Prova de inscrição no Cadastro Nacional de Pessoa Jurídica – CNPJ;</td>
            </tr>
            <tr>
                <td width="" height="30" align="left"><a href="certidoes/cert_federal.pdf" target="_blank">CERTIDÃO FEDERAL</a></td>
                <td width="" align="left">Prova de regularidade para com a Fazenda Pública Federal;</td>
            </tr>
            <tr>
                <td width="" height="30" align="left"><a href="certidoes/cert_estadual.pdf" target="_blank">CERTIDÃO ESTADUAL</a></td>
                <td width="" align="left">Prova de regularidade para com a Fazenda Pública Estadual;</td>
            </tr>
            <tr>
                <td width="" height="30" align="left"><a href="certidoes/cert_insc-estadual.pdf" target="_blank">COMPROVANTE INSC. ESTADUAL</a></td>
                <td width="" align="left">Comprovante de Inscrição Estadual;</td>
            </tr>
            <tr>
                <td width="" height="30" align="left"><a href="certidoes/cert_municipal.pdf" target="_blank">CERTIDÃO MUNICIPAL</a></td>
                <td width="" align="left">Prova de regularidade para com a Fazenda Pública Municipal;</td>
            </tr>
            <tr>
                <td width="" height="30" align="left"><a href="certidoes/cert_insc-municipal.pdf" target="_blank">COMPROVANTE INSC. MUNICIPAL</a></td>
                <td width="" align="left">Comprovante de Inscrição Municipal;</td>
            </tr>
            <tr>
                <td width="" height="30" align="left"><a href="certidoes/cert_fgts.pdf" target="_blank">CERTIDÃO FGTS</a></td>
                <td width="" align="left">Prova de Regularidade com o Fundo de Garantia por Tempo de Serviço - FGTS;</td>
            </tr>
            <tr>
                <td width="" height="30" align="left"><a href="certidoes/cert_inss.pdf" target="_blank">CERTIDÃO INSS</a></td>
                <td width="" align="left">Prova de Regularidade com a Seguridade Social - INSS;</td>
            </tr>
            <tr>
                <td width="" height="30" align="left"><a href="certidoes/cert_just_trabalho.pdf" target="_blank">CERTIDÃO JUSTIÇA TRABALHO</a></td>
                <td width="" align="left">Prova de inexistência de débitos inadimplidos perante a Justiça do Trabalho;</td>
            </tr>
            <tr>
                <td width="" height="30" align="left"><a href="certidoes/cert_simples_nacional.pdf" target="_blank">CERTIDÃO SIMPLES NACIONAL</a></td>
                <td width="" align="left">Optante pelo SIMPELS NACIONAL.</td>
            </tr>
            <tr>
                <td colspan="4" align="left"><strong><BR>QUALIFICAÇÃO ECONÔMICO-FINANCEIRA<hr></td>
            </tr>
            <tr>
                <td width="" height="30" align="left"><a href="certidoes/cert_neg_falencia.pdf" target="_blank">CERTIDÃO NEGATIVA/FALÊNCIA</a></td>
                <td width="" align="left">Certidão Negativa de Falência;</td>
            </tr>
            <tr>
                <td width="" height="30" align="left"><a href="certidoes/cert_foro.pdf" target="_blank">CERTIDÃO FORO/DISTRIBUIDORES</a></td>
                <td width="" align="left">Certidão Negativa em Distribuidores/Cartórios da região;</td>
            </tr>
            <tr>
                <td width="" height="30" align="left"><a href="certidoes/balanco_2012_ldiario_assinaturas.pdf" target="_blank">BALANÇO PATRIMONIAL</a></td>
                <td width="" align="left">Balanço Patrimonial atual/vigente até 30/04 de cada ano;</td>
            </tr>
            <tr>
                <td width="" height="30" align="left"><a href="certidoes/coef_analise_2011.pdf" target="_blank">COEFICIENTES BALANÇO</a></td>
                <td width="" align="left">Coeficientes de análise - Balanço Patrimonial;</td>
            </tr>
            <tr>
                <td width="" height="30" align="left"><a href="certidoes/cert_junta.pdf" target="_blank">CERTIDÃO JUNTA COMERCIAL PR</a></td>
                <td width="" align="left">Certidão Simplificada da Junta Comercial do PR.</td>
            </tr>
                       
     
</table>
</table>
