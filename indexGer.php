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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!--<link rel="stylesheet" href="cssEstilo/estiloIndex.css">-->
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


<body>

<div class="list-group">
<ul> 
    <a href="cadastroFuncionario.php"><li class="list-group-item" id="cadFunc">CADASTRO DE FUNCIONÁRIOS</li></a>
    <!--<a href="#"><li class="list-group-item bg-info text-white">JUSTIFICAR FALTAS</li></a>-->
    <a href="concedeDispensa.php"><li class="list-group-item" id="conDispensa">CONCEDER DISPENSA</li></a> 
    <a href="faltas.php"><li class="list-group-item" id="lanFaltas">LANÇAMENTO DE FALTAS</li></a>
    <a href="consultaFunc.php"><li class="list-group-item" id="conFun">PESQUISAR FUNCIONÁRIOS</li></a> 
    <a href="consultaRRDispensa.php"><li class="list-group-item" id="conRRDispensa">RELATÓRIO DE PEDIDOS DE DISPENSA</li></a> 
    <a href="consultaRHTrabalhadas.php"><li class="list-group-item" id="conRHTrabalhada">RELATÓRIO DAS HORAS TRABALHADAS</li></a> 
    <a href="consultaFJustificadas.php"><li class="list-group-item" id="conRFJustificadas">RELATÓRIO DAS FALTAS JUSTIFICADAS</li></a>
    <a href="sair.php"><li class="list-group-item" id="sair">SAIR</li></a>
    </ul>
</div>

<script>
 const pathName = window.location.pathname;
 const pageName = pathName.split("/").pop();

 if(pageName === "cadastroFuncionario.php"){
    document.querySelector("#cadFunc").classList.add("activeLink");
 }
 if(pageName === "concedeDispensa.php"){
    document.querySelector("#conDispensa").classList.add("activeLink");
 }
 if(pageName === "faltas.php"){
    document.querySelector("#lanFaltas").classList.add("activeLink");
 }
 if(pageName === "consultaFunc.php"){
    document.querySelector("#conFun").classList.add("activeLink");
 }
 if(pageName === "consultaRRDispensa.php"){
    document.querySelector("#conRRDispensa").classList.add("activeLink");
 }
 if(pageName === "consultaRHTrabalhadas.php"){
    document.querySelector("#conRHTrabalhada").classList.add("activeLink");
 }
 if(pageName === "consultaFJustificadas.php"){
    document.querySelector("#conRFJustificadas").classList.add("activeLink");
 }
 if(pageName === "sair.php"){
    document.querySelector("#sair").classList.add("activeLink");
 }

</script>
  
</body>
</html>
