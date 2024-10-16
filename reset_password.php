<?php 
require 'config.php'; // Altere para o caminho correto do seu arquivo de conexão com o banco de dados 

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $token = $_POST['token']; 
    $expires = date('U'); // Armazenar o resultado de date('U') em uma variável
    $new_password = $_POST['password']; 
    
    // Verifique se o token é válido e não expirou 
    $query = $conexao->prepare("SELECT * FROM password_resets WHERE token = ? AND expires >= ?"); 
    $query->bind_param("si", $token, $expires); // Bind dos parâmetros
    $query->execute(); 
    $reset = $query->get_result()->fetch_assoc(); 
    
    if ($reset) { 
        // Atualize a senha no banco de dados 
        $update_stmt = $conexao->prepare("UPDATE loginusuario SET senha = ? WHERE email = ?");
        $update_stmt->bind_param("ss", $new_password, $reset['email']);
        $update_stmt->execute(); 
        
        // Delete o token após o uso 
        $delete_stmt = $conexao->prepare("DELETE FROM password_resets WHERE token = ?");
        $delete_stmt->bind_param("s", $token);
        $delete_stmt->execute(); 
        
        echo 'Senha redefinida com sucesso.'; 
    } else { 
        echo 'Token inválido ou expirado.'; 
    } 
} 
?>