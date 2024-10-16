<?php include 'indexGer.php'; ?>
<?php

    include_once("config.php");
    $id_funcionario = filter_input(INPUT_GET, 'id_funcionario', FILTER_SANITIZE_NUMBER_INT);
   
 $sql = "DELETE FROM cadfuncionario WHERE id_funcionario='$id_funcionario'";
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
.bg{
    background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
  
}
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
    left: 75vh;
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
          <h3>Confirma&ccedil;&atilde;o da Remoção</h3>
          <hr></br></br>
          
          <?php
          
                if($linhas == 1){
                    print "<p style='color:green;'>Funcionário removido com sucesso!</p>";
                }else{
                    print "<p style='color:red;'>O funcionário <b>N&Atilde;O</b> foi removido! Tente novamente.</p>";

                }
                
          ?>

    </section>
    </section>
</div>

    </body>
    </html>