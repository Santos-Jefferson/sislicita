#!/usr/bin/php
<?php
require "conecta.php";
$hoje = date('Y-m-d');
$hoje2 = date('Y-m-d',strtotime("-2 days"));

//echo $hoje;
//echo "<BR>";

//$sql = "SELECT * FROM codigo WHERE data = '{$hoje}' order by hora";
$sql = "SELECT * FROM codigo,lote WHERE codigo.id_cod=lote.id_cod and codigo.data = CURDATE() and lote.id_lote != '' group by codigo.id_cod ORDER BY hora ASC";
$res = mysql_query($sql) or die("erro envia email");
$linha = mysql_fetch_assoc($res);

$sql_2 = "SELECT * FROM codigo WHERE data = '{$hoje2}' order by hora";
$res_2 = mysql_query($sql_2) or die("erro envia email");
$linha_2 = mysql_fetch_assoc($res_2);

//print_r($linha);
//$total = mysql_numrows($res);

$sql2 = "Select * from usuarios where usuario='$linha[licitante]'";
$res2 = mysql_query($sql2) or die("Erro seleção - usuarios");
$linha2 = mysql_fetch_assoc($res2); 


while($linha){
    
    $sql3 = "Select * from codigo,usuarios where codigo.data='{$hoje}' and codigo.licitante='{$linha[licitante]}' and usuarios.usuario='{$linha[licitante]}'";
    $res3 = mysql_query($sql3) or die("Erro seleção - usuarios");
    $linha3 = mysql_fetch_assoc($res3); 

    $sql4 = "Select * from codigo,usuarios where codigo.data='{$hoje2}' and codigo.licitante='{$linha[licitante]}' and usuarios.usuario='{$linha[licitante]}'";
    $res4 = mysql_query($sql4) or die("Erro seleção - usuarios");
    $linha4 = mysql_fetch_assoc($res); 

    //PREGÃO ELETRONICO
    $h2 = date('H:i',(strtotime("$linha[hora] - 5 minutes")));
    //PREGÃO PRESENCIAL
    if($linha3[modalidade]=="Presencial"){
    $h3 = date('H:i',(strtotime("$linha[hora] -2880 minutes")));
}
//echo "<BR>";
//echo $h3;

if($h2 == (date('H:i'))){
        
ini_set('default_charset','UTF-8');
$orgao = $linha[orgao];
$uf = $linha[uf];
$local_licitacao = $linha[local_licitacao];
$modalidade = $linha[modalidade];
$codigo = $linha[codigo];
$pregao = $linha[pregao];
$horario = date('H:i',(strtotime($linha[hora])));
//echo $horario;

$mensagem = "Caro(a) $linha3[usuario], sua Licitação em $local_licitacao - $codigo - $orgao - $pregao, iniciará as $horario Hs. Fique atento e boa SORTE.";
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
$mail->SMTPSecure = 'tls';

// Define o remetente
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->From = "contato@maestroinformatica.net"; // Seu e-mail
$mail->Sender = "contato@maestroinformatica.net"; // Seu e-mail
$mail->FromName = "SISLICITA"; // Seu nome

// Define os destinatário(s)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->AddAddress($linha3[email]);
//$mail->AddAddress('silvanapositivoinformatica@gmail.com');
//$mail->AddAddress('jefferson2004@gmail.com');
$mail->AddCC('direcao@maestroinformatica.net'); // Copia
//$mail->AddBCC($usuarios[email],$usuarios[usuario]); // Cópia Oculta
//$mail->AddReplyTo($usuarios[email],$usuarios[usuario]); // Cópia Oculta

// Define os dados técnicos da Mensagem
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
$mail->CharSet = 'UTF-8'; // Charset da mensagem (opcional)

// Define a mensagem (Texto e Assunto)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->Subject = "##ATENÇÃO## - $linha3[usuario] - LEMBRETE($horario Hs)-$codigo-$pregao"; // Assunto da mensagem
$mail->Body = $mensagem;
$mail->AltBody = 'LEMBRETE';

$mail->SMTPDebug = 1;
echo $mail->IsSMTP();

// Envia o e-mail
$enviado = $mail->Send();

//header("Location: $redirect");


    echo "<BR>";
    
    echo "OK, EMAIL ENVIADO!!!".$h2;
    
    }
    
    else {
        echo "<BR>";
        echo "BAD".$h2;
        
    }
    
//SE FOR LICITAÇÃO PRESENCIAL, AVISAR COM 4 DIAS DE ANTECEDÊNCIA    
if($h3 == (date('H:i'))){
        
    ini_set('default_charset','UTF-8');
    $orgao = $linha[orgao];
    $uf = $linha[uf];
    $local_licitacao = $linha[local_licitacao];
    $modalidade = $linha[modalidade];
    $codigo = $linha[codigo];
    $pregao = $linha[pregao];
    $horario = date('H:i',(strtotime($linha[hora])));
    $data = date('d,m,Y',strtotime($linha[data]));

    //echo $horario;

    $mensagem = "Caro(a) $linha3[usuario], sua Licitação em $local_licitacao - $codigo - $orgao - $pregao, ocorrerá dia $data as $horario Hs. Fique atento e BOA SORTE.";
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
    $mail->SMTPSecure = 'tls';

    // Define o remetente
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->From = "contato@maestroinformatica.net"; // Seu e-mail
    $mail->Sender = "contato@maestroinformatica.net"; // Seu e-mail
    $mail->FromName = "SISLICITA"; // Seu nome

    // Define os destinatário(s)
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->AddAddress($linha3[email]);
    //$mail->AddAddress('silvanapositivoinformatica@gmail.com');
    //$mail->AddAddress('jefferson2004@gmail.com');
    $mail->AddCC('direcao@maestroinformatica.net'); // Copia
    //$mail->AddBCC($usuarios[email],$usuarios[usuario]); // Cópia Oculta
    //$mail->AddReplyTo($usuarios[email],$usuarios[usuario]); // Cópia Oculta

    // Define os dados técnicos da Mensagem
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
    $mail->CharSet = 'UTF-8'; // Charset da mensagem (opcional)

    // Define a mensagem (Texto e Assunto)
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->Subject = "##LIGAR - PRESENCIAL## - $linha3[usuario] - LEMBRETE($data / $horario Hs)-$codigo-$pregao"; // Assunto da mensagem
    $mail->Body = $mensagem;
    $mail->AltBody = 'LEMBRETE';

    $mail->SMTPDebug = 1;
    echo $mail->IsSMTP();

    // Envia o e-mail
    $enviado = $mail->Send();

    //header("Location: $redirect");


        echo "<BR>";

        echo "OK, EMAIL ENVIADO!!!".$h2;

        }

        else {
            echo "<BR>";
            echo "BAD".$h2;

        }

    $linha = mysql_fetch_assoc($res);
}
?>
