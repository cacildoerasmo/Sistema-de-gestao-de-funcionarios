<?php
    session_start();
    if(!isset($_SESSION['id_usuario'])){
        header("location: telaPrincipal.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de gestão de funcionários</title>

    <script src="lib/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="css/

bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>

    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .list-group {
            width: 330px; /* Ajuste a largura conforme necessário */
            height: 100vh; /* Faz o menu ocupar a altura total da tela */
            overflow-y: auto;
            background-color: #fff;
            border-radius: 8px;

            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            position: fixed; /* Fixa o menu no lado esquerdo */
            top: 0;
            left: 0;
            margin: 20px;
        }

        .list-group-item {
            border: none;
            border-bottom: 1px solid #ddd;
            padding: 15px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .list-group-item:hover {
            background-color: #f0f0f0;
            transform: translateX(5px);
        }


        .list-group-item.activeLink {
            background-color: lightseagreen;
            color: white;
            font-weight: bold;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        li {
            color: #333;
            text-align: left; /* Alinha o texto à esquerda */
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

        .content {
            margin-left: 320px; /* Garante que o conteúdo principal começa após o menu */
            padding: 20px;
            flex: 1;
        }
    </style>
</head>
<body>

<div class="list-group">
    <ul>
        <a href="administrador.php"><li class="list-group-item" id="administrador">ADMINISTRADOR</li></a>

        <a href="consultaAdmin.php"><li class="list-group-item" id="consultaAdmin">VERIFICAR ACESSOS</li></a> 
        <a href="sair.php"><li class="list-group-item" id="sair">SAIR</li></a>
    </ul>
</div>

<div class="content" id="content">
    <!-- Conteúdo dinâmico carregado aqui -->
</div>

<script>
 const pathName = window.location.pathname;
 const pageName = pathName.split("/").pop();

 if(pageName === "administrador.php"){

    document.querySelector("#administrador").classList.add("activeLink");
 }
 if(pageName === "consultaAdmin.php"){
    document.querySelector("#consultaAdmin").classList.add("activeLink");
 }
 if(pageName === "sair.php"){
    document.querySelector("#sair").classList.add("activeLink");
 }
</script>

</body>
</html>

