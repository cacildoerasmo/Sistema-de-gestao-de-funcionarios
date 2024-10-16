<?php include 'indexFunc.php'; ?>
<?php

    include_once("config.php");

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $dataHoje = $_POST['dataHoje'];
    $bi = $_POST['bi'];
    $recibo = $_POST['recibo'];
    $departamento = $_POST['departamento'];
    $telefone = $_POST['telefone'];
    $documento = $_POST['documento'];
    $comentario = $_POST['comentario'];
    $codigo = $_POST['codigo'];

    $sql = "INSERT INTO justificarfalta (nome,email,dataHoje,bi,recibo,departamento,telefone,documento,comentario,codigo) values ('$nome','$email','$dataHoje','$bi','$recibo','$departamento','$telefone','$documento','$comentario','$codigo')";
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
                    print "<h4><p style='color: green;'>Submetido com sucesso!</p></h4>";
                }else{
                    print "<p style='color: red;'>Cadastro N&Atilde;O efectuado!</p>";
                }
          ?>

    </section>
    </section>
</div>

    </body>
    </html>