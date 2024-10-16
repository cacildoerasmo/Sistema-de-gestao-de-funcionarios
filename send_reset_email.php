<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="UTF-8">
<title>Sistema de gestão de funcionários</title>

<script src="lib/jquery-3.4.1.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>

<style>
    body{
        background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
  
    }
.mensagem-erro{
    color: red;
    font-size: 20px;
    font-weight: bold;
    margin: 20px;
    padding: 10px;
    border: 2px solid red;
    border-radius: 5px;
    background-color: #fdd;
    text-align: center;
    position: relative;
    left: 500px;
    top: 180px;
    width: 500px;
    height: 100px;
}
.mensagem-sucesso{
color: green;
font-size: 20px;
font-weight: bold;
margin: 20px;
padding: 10px;
border: 2px solid green;
border-radius: 5px;
background-color: #dfd;
text-align: center;
position: relative;
left: 500px;
top: 180px;
width: 500px;
height: 100px;

}
a {
            text-decoration: none;

            display: block;
            color: inherit; /* Garante que a cor do texto é herdada */
        }
      a:hover{
    text-decoration: none;
    color: inherit;
}
</style>

</head>
<body>

<?php 
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 

require 'src/Exception.php'; 
require 'src/PHPMailer.php'; 
require 'src/SMTP.php'; 
require 'config.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $email = $_POST['email']; 

    // Verifique se o email existe no banco de dados 
    $query = $conexao->prepare("SELECT * FROM loginusuario WHERE email = ?"); 
    $query->bind_param('s', $email); // 's' indica que o parâmetro é uma string
    $query->execute(); 
    $result = $query->get_result();
    $user = $result->fetch_assoc(); 

    if ($user) { 
        // Gere um token seguro 
        $token = bin2hex(random_bytes(50)); 
        // Salve o token e a data de expiração no banco de dados 
        $expires = date('U') + 1800; // 30 minutos a partir de agora

        $insert = $conexao->prepare("INSERT INTO password_resets (email, token, expires) VALUES (?, ?, ?)");
        $insert->bind_param('ssi', $email, $token, $expires); // 'ssi' indica os tipos dos parâmetros: string, string, integer
        $insert->execute();

        // Envie o email com o link de redefinição 
        $mail = new PHPMailer(true); 
        try { 
            $mail->isSMTP(); 
            $mail->Host = 'smtp.gmail.com'; 
            $mail->SMTPAuth = true; 
            $mail->Username = 'cacildoerasmo@gmail.com'; 
            $mail->Password = 'lfbihesiushkvecl'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
            $mail->Port = 587; 
            $mail->setFrom('cacildoerasmo@gmail.com', 'Caerma Developer'); 
            $mail->addAddress($email); 
            $mail->isHTML(true); 
            $mail->Subject = 'Escola Privada Mãe Ligia'; 
            $url ="http://localhost/bootstrap-4.4.1-dist-TCC/reset_request.php?token=$token"; 
            $mail->Body = "Clique <a href='$url'>aqui</a> para redefinir sua senha."; 
            $mail->send(); 
            echo '<div class="mensagem-sucesso">Um link de redefinição de senha foi enviado para seu email.</div>'; 
        } catch (Exception $e) { 
            echo "Não foi possível enviar o email. Erro: {$mail->ErrorInfo}"; 
        } 
    } else { 
        echo '<div class="mensagem-erro">Email não encontrado.</div>'; 
    } 
} 
?> 

</body>

</html>