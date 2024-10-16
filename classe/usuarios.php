<?php

    class Usuario
    {
        private $pdo;
        public $msgErro = "";//tudo ok
        public function conectar($nome, $host, $usuario, $senha){

            global $pdo;
            global $msgErro;
            try{
                 $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
            }catch(PDOException $e){
                $msgErro = $e->getMessage();
            }
           

        }

        public function cadastrar($nome, $telefone, $email, $senha, $painel){
            global $pdo;
            //verificar se ja existe o email cadastrado
            $sql = $pdo->prepare("SELECT id_usuario from loginusuario WHERE email = :e");
            $sql->bindValue(":e",$email);
            $sql->execute();
            if($sql->rowCount() > 0){

                return false;//Ja esta cadastrado
            }else{
                //caso nao, cadastrar
                $sql = $pdo->prepare("INSERT INTO loginusuario(nome,telefone,email,senha,painel) values (:n, :t, :e, :s, :p)");
                $sql->bindValue(":n",$nome);
                $sql->bindValue(":t",$telefone);
                $sql->bindValue(":e",$email);
                $sql->bindValue(":s",$senha);
                $sql->bindValue(":p",$painel);
                $sql->execute();
                return true;
           
            }

        }

        public function logar($email, $senha){
            global $pdo;
        
        
            // Verificar se o email e senha estão cadastrados
            $sql = $pdo->prepare("SELECT id_usuario, painel FROM loginusuario WHERE email = :e AND senha = :s");
            $sql->bindValue(":e", $email);
            $sql->bindValue(":s", $senha);
            $sql->execute();
        
            if ($sql->rowCount() > 0) {
                // Entrar no sistema (sessão)
                $dado = $sql->fetch();
                session_start();
                $_SESSION['id_usuario'] = $dado['id_usuario'];
        
                // Verificar o painel do usuário
                if ($dado['painel'] == 'admin') {
                    header("Location: index.php"); 
                    exit();
                } elseif ($dado['painel'] == 'funcionario') {
                    header("Location: indexFunc.php");
                    exit();
                } elseif ($dado['painel'] == 'gerente') {
                    header("Location: indexGer.php");
                    exit();
                }
        
                return true; // Cadastrado com sucesso
            } else {
                return false; // Não foi possível logar
            }
            return false; // Não foi possível logar
        

            




        }

    }
    




?>