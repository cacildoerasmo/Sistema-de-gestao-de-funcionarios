<?php include 'indexGer.php'; ?>
<?php

    include_once("config.php");

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $sexo = $_POST['sexo'];
    $data_de_nascimento = $_POST['data_de_nascimento'];
    $bi = $_POST['bi'];
    $estadocivil = $_POST['estadocivil'];
    $nacionalidade = $_POST['nacionalidade'];
    $cidade = $_POST['cidade'];
    $departamento = $_POST['departamento'];
    $telefone = $_POST['telefone'];
    $nome_do_pai = $_POST['nome_do_pai'];
    $nome_da_mae = $_POST['nome_da_mae'];
    $codigo = $_POST['codigo'];

    $sql = "INSERT INTO cadfuncionario (nome,email,sexo,data_de_nascimento,bi,estadocivil,nacionalidade,cidade,departamento,telefone,nome_do_pai,nome_da_mae,codigo) values ('$nome','$email','$sexo','$data_de_nascimento','$bi','$estadocivil','$nacionalidade','$cidade','$departamento','$telefone','$nome_do_pai','$nome_da_mae','$codigo')";
    $cadastrar = mysqli_query($conexao,$sql);

    $linhas = mysqli_affected_rows($conexao);
    mysqli_close($conexao);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de gestão de funcionários</title>

    <script src="lib/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <!--<link rel="stylesheet" href="_css/administrador.css">-->
<style>
body{
    background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
  
  
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
.justify-content-center{
    position: absolute;
    top: 10vh;
    left: 80vh;
    background-color: #fff;
    padding: 20px;
    width: 800px;
    height: 400px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
}
h3{
    color: lightseagreen;
    
}
hr{
    background-color: lightseagreen;
}

</style>
</head>
<body>

    
    <section class="container-fluid bg">
  <section class="row justify-content-center">
<div>
          <h3>Confirma&ccedil;&atilde;o de Cadastro</h3>
          <hr></br></br>
          
          <?php
                if($linhas == 1){
                    print "<h4><p style='color: green;'>Cadastro efectuado com sucesso!</p></h4>";
                }else{
                    print "<p style='color: red;'>Cadastro N&Atilde;O efectuado!</br>Ja existe um usuario com este e-mail.</p>";
                }
          ?>

    </section>
    </section>
</div>

    </body>
    </html>