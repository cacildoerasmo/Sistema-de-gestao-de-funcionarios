<?php include 'index.php'; ?>
<?php

include_once("config.php");

$id_usuario = filter_input(INPUT_GET, 'id_usuario', FILTER_SANITIZE_NUMBER_INT);
$sql = "SELECT * FROM loginusuario where id_usuario ='$id_usuario'";
$consulta = mysqli_query($conexao,$sql);
$registros = mysqli_fetch_assoc($consulta);



?>
<?php

$painelSelecionado = $registros['painel'] ?? '';
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

    <!--<link rel="stylesheet" href="_css/form.css">-->

    <style>


body{
    background-color: #f4f4f4;
  width: 100%;
  height: 100vh;
  font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
}
div#msg-sucesso{
    width: 420px;
    margin: 10px auto;
    padding: 10px;
    background-color: rgba(50, 205, 50,.3);
    border: 1px solid rgb(34,139,34);
    position: absolute;
top:600px;
left:450px;
}

div.msg-erro{
width: 500px;
position: absolute;
top:600px;
left:600px;
margin: 10px auto;
padding: 10px;
background-color: rgba(250, 128, 114,.3);
border: 1px solid rgb(165,42,42);
}

form{
    position: absolute;
    top: 6vh;
    left: 600px;
    background-color: #fff;
    padding: 30px;
    width: 500px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
}

.form-control-sm:focus{
    border-color: lightseagreen;
    -webkit-box-shadow: none;
    box-shadow: none;
}

input#inputPassword4{
    width: 150px;
}

input#senha2{
width: 150px;
}

input#example-tel-input{
    width: 200px;
}

input#inputEmail4{
width: 250px;
}

input#name{
    width: 300px;
}

h3{
    color: lightseagreen;
}

hr{
    background-color: lightseagreen;
}

label{
    text-align: center;
    font-family:sans-serif;
	font-weight:normal;
    font-size:12pt;
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
.btn-info{
    border-radius: 4px;
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
    box-shadow: 1px 1px 2px teal;
    -moz-box-shadow: 1px 1px 2px teal;
    -webkit-box-shadow: 1px 1px 2px teal;
    background-color: while;
    width: 135px;
    height: 35px;
    color: while;
    position: relative;
    left: 1px;
    top: 20px; 
}
    </style>
</head>
<body>


<section class="container-fluid bg">
  <section class="row justify-content-center">
      <form method="POST" action="proc_editAdmin.php">
          
          <h3>Editar Admin</h3>
          <hr>
          
         
          <div class="form-group"> 
    <input type="hidden" name="id_usuario" class="form-control form-control-sm" id="nome" maxlength="40" value="<?php echo $registros['id_usuario']; ?>" required autofocus>
 </div>
            <label for="name">Nome</label></br>
   <input class="form-control form-control-sm" type="text" name="nome" id="name" placeholder="Nome Completo" maxlength="30" value="<?php echo $registros['nome']; ?>"required autofocus>
   </div>


<div class="form-group">
<label for="example-tel-input">Telefone</label>
    <input class="form-control form-control-sm" name="telefone" type="tel"  id="example-tel-input"  maxlength="40" value="<?php echo $registros['telefone']; ?>" required>
</div> 

<div class="form-group">
    <label for="inputEmail4">Email</label>
<input type="email" class="form-control form-control-sm" name="email" id="inputEmail4" placeholder="exemplo@gmail.com" maxlength="40" value="<?php echo $registros['email']; ?>"required>
</div>

<div class="input-group mb-3"> 
<div class="input-group-prepend"> 
<label class="input-group-text" for="inputGroupSelect01">Painel</label>
 </div>

 <select class="custom-select form-control-sm" id="inputGroupSelect01" name="painel">
    <option value="admin" <?php echo ($painelSelecionado === 'admin') ? 'selected' : ''; ?>>admin</option>
    <option value="funcionario" <?php echo ($painelSelecionado === 'funcionario') ? 'selected' : ''; ?>>funcionario</option>
    <option value="gerente" <?php echo ($painelSelecionado === 'gerente') ? 'selected' : ''; ?>>gerente</option>
</select>
</div> 
</div>
<!--
    <div class="form-group">
    <label for="inputPassword4">Senha</label>
     <input type="password" class="form-control form-control-sm" name="senha" id="inputPassword4" placeholder="********" maxlength="16">
    </div>

    <div class="form-group">
        <label for="senha2">Confirmar Senha</label>
         <input type="password" class="form-control form-control-sm" name="confSenha" id="senha2" placeholder="********" maxlength="16">
        </div>-->

    <button type="submit" class="btn btn-info">Cadastrar</button>
    <!--<button type="submit" class="btn btn-info"><a href="consultaAdmin.php">Voltar</a></button>-->
    </form>
    </section>
    </section>



</body>
</html>