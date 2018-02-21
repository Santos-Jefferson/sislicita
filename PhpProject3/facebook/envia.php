<?php
ini_set('default_charset','UTF-8');
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$rg = $_POST['rg'];
$email = $_POST['email'];
$fixo = $_POST['fixo'];
$celular = $_POST['celular'];
$endereco = $_POST['endereco'];

$redirect = $_POST["redirect"];

$mensagem = "NOME: $nome <br> CPF: $cpf <br> RG: $rg <br> E-MAIL: $email <br> TEL FIXO: $fixo <br> CELULAR: $celular <br> ENDEREÇO: $endereco <br> DATA ENVIO: ". date('d/m/Y h:i:s') ."<br><br> OBSERVAÇÃO: <br>$observacao";
// Inclui o arquivo class.phpmailer.php localizado na pasta phpmailer || TROQUE PELO SEU CAMINHO DA CLASSE
require_once('../phpmailer/class.phpmailer.php');

// Inicia a classe PHPMailer
$mail = new PHPMailer();
$mail->SMTPDebug = 2;
// Define os dados do servidor e tipo de conexão
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsSMTP(); // Define que a mensagem será SMTP
$mail->Host = "smtp.maestroinformatica.net"; // Endereço do servidor SMTP (caso queira utilizar a autenticação, utilize o host smtp.seudomínio.com.br)
$mail->SMTPAuth = true; // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
$mail->Username = 'jefferson@maestroinformatica.net'; // Usuário do servidor SMTP
$mail->Password = 'aaml0509'; // Senha do servidor SMTP

// Define o remetente
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->From = "jefferson@maestroinformatica.net"; // Seu e-mail
$mail->Sender = "jefferson@maestroinformatica.net"; // Seu e-mail
$mail->FromName = "Hinode"; // Seu nome

// Define os destinatário(s)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->AddAddress('dyulifialla@gmail.com');
//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
//$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta

// Define os dados técnicos da Mensagem
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
$mail->CharSet = 'UTF-8'; // Charset da mensagem (opcional)

// Define a mensagem (Texto e Assunto)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->Subject = "PROSPECTO HINODE"; // Assunto da mensagem
$mail->Body = $mensagem;
$mail->AltBody = 'AQUI VOCÊ PODE CONFIGURAR UMA MENSAGEM SEM FORMATAÇÃO HTML';

// Define os anexos (opcional)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
//$mail->AddAttachment($arquivo_caminho, $arquivo_nome); // Insere um anexo

// Envia o e-mail
$enviado = $mail->Send();

// Limpa os destinatários e os anexos
$mail->ClearAllRecipients();
$mail->ClearAttachments();

// Exibe uma mensagem de resultado
if ($enviado) {
echo "E-mail enviado com sucesso!";
} else {
echo "Não foi possível enviar o e-mail.

";
echo "Informações do erro:
" . $mail->ErrorInfo;
}

header("Location: $redirect");

?>