<?php include 'index.php'; ?>
<?php

    include_once("config.php");
    $id_usuario = filter_input(INPUT_POST, 'id_usuario',FILTER_SANITIZE_NUMBER_INT);
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $painel = $_POST['painel'];

    $sql = "UPDATE loginusuario set nome='$nome',telefone='$telefone',email='$email',painel='$painel' WHERE id_usuario='$id_usuario'";
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

.justify-content-center{
    position: absolute;
    top: 10vh;
    left: 70vh;
    background-color: #fff;
    padding: 20px;
    width: 800px;
    height: 400px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
}
h3{
    color: lightseagreen;
    text-align: center;
}
hr{
    background-color: lightseagreen;
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

    
    <section class="container-fluid bg">
  <section class="row justify-content-center">
<div>
          <h3>Confirma&ccedil;&atilde;o da Edi&ccedil;&atilde;o</h3>
          <hr></br></br></br>
          
          <?php
                if($linhas == 1){
                    
                    print "<h4><p style='color:green;'>Usu&aacute;rio editado com sucesso!</p></h4>";
                }else{
                    print "<h4><p style='color:red;'>Edi&ccedil;&atilde;o <b>N&Atilde;O</b> feita! Tente novamente.</p></h4>";
                }
          ?>

    </section>
    </section>
</div>

    </body>
    </html>