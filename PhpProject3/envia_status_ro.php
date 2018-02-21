<?php
require "conecta.php";
require "cabecalho.php";
//require "cabecalho_reduzido.php";
require "cabecalho_html.php";
$redirect = $_POST["redirect"];

//print_r ($_REQUEST);
//die;

$sql_lote = "SELECT * FROM codigo,lote WHERE id_cod={$_POST[id_cod]} and id_lote={$_POST[id_lote]}";
$res = mysql_query($sql_lote) or die("Erro seleção - lote");
$linha_lote = mysql_fetch_assoc($res);


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
$colocacao = $_POST[colocacao];
$tipo_equipamento = $_POST[tipo_equipamento];
$cod_positivo = $_POST[cod_positivo];

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
        <img src="imagens/logo-ro.jpg">
		
		<p align="center">
			<strong><u>STATUS DA LICITAÇÃO</u></strong></p>
		<hr>
		<p>
			STATUS/COLOCAÇÃO: $colocacao;
		<hr>
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
$mail->AddAddress('silvanad@positivo.com.br');
//$mail->AddAddress('smariab@positivo.com.br');
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
$mail->Subject = "RO - $orgao - $local_licitacao - Data Pregão: $data - CÓD: $codigo - Pregão: $pregao - Lote: $lote - Item: $item - Qtde: $qtde - Mod: $modalidade"; // Assunto da mensagem
$mail->Body = $mensagem;
$mail->AltBody = 'RO POSITIVO';

$mail->SMTPDebug = 1;
echo $mail->IsSMTP();

// Envia o e-mail
$enviado = $mail->Send();

// Exibe uma mensagem de resultado
if ($enviado) {
    
    echo "<br>
        <table class=A width=1010 align=center border=1>
        <tr>
        <td>
            <table width=1000 align=center border=0>
                <tr colspan=>
                    <td>
                        <b><center>EMAIL ENVIADO COM SUCESSO<br><br><a href='ro_positivo.php?id_cod=$linha[id_cod]'>PARA NOVO REGISTRO POSITIVO - Clique aqui</a>
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