<?php
require "conecta.php";
require "cabecalho.php";
//require "cabecalho_reduzido.php";
require "cabecalho_html.php";
$redirect = $_POST["redirect"];



//print_r ($_REQUEST);
//die;

$sql = "SELECT * FROM codigo WHERE id_cod={$_POST[id_cod]}";
$res = mysql_query($sql) or die("Erro seleção - linha");
$linha = mysql_fetch_assoc($res);

$sql = "Select * from usuarios where usuario='$usuario'";
$res = mysql_query($sql) or die("Erro seleção - usuarios");
$usuarios = mysql_fetch_assoc($res); 


ini_set('default_charset','UTF-8');
$orgao = $linha[orgao];
$uf = $linha[uf];
$local_licitacao = $linha[local_licitacao];
$modalidade = $linha[modalidade];
$codigo = $linha[codigo];
$pregao = $linha[pregao];
$lote = $_POST[lote];
$item = $_POST[item];
$qtde = $_POST[qtde];
$tipo_equipamento = $_POST[tipo_equipamento];
$pn_lenovo = $_POST[pn_lenovo];
$cnpj_orgao = $_POST[cnpj_orgao];
$nome_comprador = $_POST[nome_comprador];
$email_orgao = $_POST[email_orgao];     
$fone_comprador = $_POST[fone_comprador];
$end_completo = $_POST[end_completo];
$hoje = date('Y-m-d');

//$tipo_licitacao = $linha[tipo_licitacao];
if ( 
        ($linha[tipo_licitacao])=="AT" or ($linha[tipo_licitacao])=="CC" or ($linha[tipo_licitacao])=="DL"){
    $tipo_licitacao = "Aquisição Total";
}
elseif (($linha[tipo_licitacao])=="RP"){
    $tipo_licitacao = "Registro de Preços";
}
    
$data = date("d/m/y", strtotime($linha[data]));


$mensagem = <<<HTML
<html>
	<head>
		<title></title>
	</head>
	<body class="A1">
        
		
		<p align="center">
			<strong><u>REGISTRO / ANÁLISE DE OPORTUNIDADE - LICITAÇÕES</u></strong></p>
		
		<ol>
			<li>
				<strong>Dados do Órgão Público:</strong>
				<ul>
					<li>
						NOME: $orgao</li>
                                        <li>            
						CNPJ: $cnpj_orgao</li>
                                        <li>            
						COMPRADOR: $nome_comprador</li>
                                        <li>            
						E-MAIL: $email_orgao</li>
                                        <li>            
						FONE: $fone_comprador</li>
                                        <li>            
						ENDEREÇO: $end_completo</li>

					<li>
						UF: $uf</li>
					<li>
						N° Pregão: $pregao</li>
					<li>
						Código UASG-Comprasnet/ID do BB (caso seja eletrônico): $local_licitacao / $codigo</li>
                                        <li>
						LOTE / ITEM: $lote / $item</li>
					<li>
						Data da Licitação: $data</li>
                                </ul>
                                <hr>
                        <li>
				<strong>Dados do Equipamento:</strong>
			
                                <ul>
                                        <li>
                                            
                                                Descrição do equipamento: $tipo_equipamento</li>
                                        <li>
                                                Quantidade: $qtde</li>
                                        <li>
                                                PN Lenovo: $pn_lenovo</li>
                                                    
                                        <li>
                                                Modalidade Pregão: $modalidade / $tipo_licitacao</li>
                                        
				</ul>
                                <hr>
                        <li>
                                            <strong>Responsáveis pelo Registro:</strong>
                                
                                <ul>
                                        
                                        <li>
                                                Revenda: Santos & Mayer LTDA - EPP</li>
                                        <li>
                                                CNPJ: 09.457.677/0001-28</li>
                                        <li>
                                                Responsável pela Revenda: Jefferson Santos</li>
                                        
                                </ul>
                                <hr>
                        </li>
                                    <li>
                                            <strong>Qual a finalidade da cotação ?</strong></li>
                                            <ul>
                                                <li>
                                                    Licitação ( x )</li>
                                                <li>
                                                    Pre&ccedil;o e Sugest&otilde;es T&eacute;cnicas e Comerciais (&nbsp; )</li>
                                            </ul>
                                </ol>
	</body>
</html>
HTML;

//$mensagem = "NOME: $nome <br> EMAIL: $email <br> TELEFONE: $telefone <br> DATA ENVIO: ". date('d/m/Y h:i:s') ."<br><br> OBSERVAÇÃO: <br>$observacao";

// Inclui o arquivo class.phpmailer.php localizado na pasta phpmailer || TROQUE PELO SEU CAMINHO DA CLASSE
require_once('phpmailer/class.phpmailer.php');

// Inicia a classe PHPMailer
$mail = new PHPMailer();
//$mail->SMTPDebug = 2;
// Define os dados do servidor e tipo de conexão
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsSMTP(); // Define que a mensagem será SMTP
$mail->Host = "smtp.maestroinformatica.net"; // Endereço do servidor SMTP (caso queira utilizar a autenticação, utilize o host smtp.seudomínio.com.br)
$mail->SMTPAuth = true; // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
$mail->Username = 'contato@maestroinformatica.net'; // Usuário do servidor SMTP
$mail->Password = 'sant0550'; // Senha do servidor SMTP
//$mail->SMTPSecure = 'tls';

// Define o remetente
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->From = "$usuarios[email]"; // Seu e-mail
$mail->Sender = "$usuarios[email]"; // Seu e-mail
$mail->FromName = "Santos & Mayer (Licitações)"; // Seu nome

// Define os destinatário(s)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
if($tipo_equipamento != "Servidor"){
    $mail->AddAddress('adriano.zanini@agis.com.br');
    $mail->AddAddress('veridiana.lima@agis.com.br');
    }
    else{
        $mail->AddAddress('lidiane.pires@agis.com.br');
        $mail->AddAddress('veridiana.lima@agis.com.br');
    }
//$mail->AddAddress('jefferson2004@gmail.com');
$mail->AddCC('direcao@maestroinformatica.net', 'Direção - Santos & Mayer'); // Copia
$mail->AddBCC($usuarios[email],$usuarios[usuario]); // Cópia Oculta
$mail->AddReplyTo($usuarios[email],$usuarios[usuario]); // Cópia Oculta

// Define os dados técnicos da Mensagem
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
$mail->CharSet = 'UTF-8'; // Charset da mensagem (opcional)

// Define a mensagem (Texto e Assunto)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->Subject = "RO LENOVO - $orgao - CNPJ: $cnpj_orgao - Qtde: $qtde - PN: $pn_lenovo - $local_licitacao - CÓD: $codigo - Pregão: $pregao"; // Assunto da mensagem
$mail->Body = $mensagem;
$mail->AltBody = 'RO LENOVO';

$mail->SMTPDebug = 1;
echo $mail->IsSMTP();

// Envia o e-mail
$enviado = $mail->Send();




// Define os anexos (opcional)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
//$mail->AddAttachment($arquivo_caminho, $arquivo_nome); // Insere um anexo


// Limpa os destinatários e os anexos
//$mail->ClearAllRecipients();
//$mail->ClearAttachments();

// Exibe uma mensagem de resultado
if ($enviado) {
    
    echo "<br>
        <table class=A width=1010 align=center border=1>
        <tr>
        <td>
            <table width=1000 align=center border=0>
                <tr colspan=>
                    <td>
                        <b><center>EMAIL ENVIADO COM SUCESSO<br><br><a href='ro_lenovo.php?id_cod=$linha[id_cod]'>PARA NOVO REGISTRO LENOVO - Clique aqui</a>
                    </td>
                </tr>
                <tr>
                <td><br>
                </td>
                </tr>
                <tr colspan=>
                    <td>
                        <b><center><a href='lista_licita_hoje.php?hoje=$hoje'>PARA VOLTAR A LICITAÇÕES HOJE - Clique aqui</a>
                    </td>
                </tr>
                <tr>
                <td><br>
                </td>
                </tr>
                <tr colspan=>
                    <td>
                        <b><center><a href='cad_codigo.php'>PARA CADASTRAR NOVA LICIAÇÃO - Clique aqui</a>
                    </td>
                </tr>
            </table>
        </td>
        </tr>
        </table>";
            
    
    }
else {
    echo "Não foi possível enviar o e-mail.";
    echo "Informações do erro:" . $mail->ErrorInfo;
    }


