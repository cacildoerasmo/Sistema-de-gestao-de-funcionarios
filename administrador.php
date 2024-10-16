<?php
    require_once 'classe/usuarios.php';
    $u = new Usuario;
?>
<?php include 'index.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de gestão de funcionários</title>

    <script src="lib/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <!--<link rel="stylesheet" href="cssEstilo/estiloAdmin.css">-->

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
    width: 550px;
    margin: 10px auto;
    padding: 10px;
    background-color: rgba(50, 205, 50,.3);
    border: 1px solid rgb(34,139,34);
    position: absolute;
top:600px;
left:450px;
}

div.msg-erro{
width: 550px;
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
    top: 3vh;
    left: 600px;
    background-color: #fff;
    padding: 30px;
    width: 550px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
}

.form-control-sm:focus{
    border-color: lightseagreen;
    -webkit-box-shadow: none;
    box-shadow: none;
}

input#inputPassword4{
    width: 230px;
}

input#senha2{
width: 250px;
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

a{
    text-decoration: none;

            display: block;
            color: inherit;
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
    color: white;
    position: relative;
    left: 1px;
    top: 20px; 
}
.input-group-prepend{
    position: relative;
    top: 29px;
    width: 250px;
}
.form-group{
    position: relative;
    top: -50px;
    left: 256px;
    width: 350px;
}
#senha3{
    position: relative;
    top: 13px;

}
    </style>

    
</head>
<body>

    
    <section class="container-fluid bg">
  <section class="row justify-content-center">
      <form method="POST">
          
          <h3>Administrador</h3>
          <hr>
          
          <div class="form-row"> 
            <div class="col-xs-2"> 
            <label for="name">Nome</label></br>
   <input class="form-control form-control-sm" type="text" name="nome" id="name" placeholder="Nome Completo" maxlength="30">
   </div>


<div class="col-2">
    <label for="example-tel-input">Telefone</label>
    <input class="form-control form-control-sm" type="text"  name="telefone" id="example-tel-input" maxlength="30">
</div> 

<div class="col-xs-2">
    <label for="inputEmail4">Email</label>
<input type="email" class="form-control form-control-sm" name="email" id="inputEmail4" placeholder="exemplo@gmail.com" maxlength="40">
</div>

<div class="col-5"> 
<div class="input-group-prepend"> 
    <div class="col-xs-2">
<label class="input-group-text" for="inputGroupSelect01">Painel</label>
 </div>
  <select class="custom-select form-control-sm" name="painel" id="inputGrou">
 <!--<option selected>Opções...</option>-->
 <option value="admin">admin</option>
 <option value="funcionario">funcionario</option>
 <option value="gerente">gerente</option>
 </select>
</div> 
</div>
</div>

    <div class="col-xs-2" id="senha3">
    <label for="inputPassword4">Senha</label>
     <input type="password" class="form-control form-control-sm" name="senha" id="inputPassword4" placeholder="********" maxlength="16">
    </div>

    <div class="form-group">
        <label for="senha2">Confirmar Senha</label>
         <input type="password" class="form-control form-control-sm" name="confSenha" id="senha2" placeholder="********" maxlength="16">
        </div>
</div>
    <button type="submit" class="btn btn-info">Cadastrar</button>
    <!--<button type="submit" class="btn btn-info"><a href="#">Voltar</a></button>-->
    </form>
    </section>
    </section>
<?php
//verificar se clicou no botao
if(isset($_POST['nome']))
{
$nome = addslashes($_POST['nome']);
$telefone = addslashes($_POST['telefone']);
$email = addslashes($_POST['email']);
$senha = addslashes($_POST['senha']);
$confirmarSenha = addslashes($_POST['confSenha']);
$painel = addslashes($_POST['painel']);

//verificar se esta vazio
if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha) && !empty($painel))
{
    $u->conectar("tcc_sgfuncionarios","localhost","root","");
    if($u->msgErro == "")//se esta tudo ok
    {
        if($senha == $confirmarSenha)
        {
        if($u->cadastrar($nome,$telefone,$email,$senha,$painel))
        {
            ?>
            <div id="msg-sucesso" style="position: absolute; left: 600px; top: 450px;">
            Usuário cadastrado com sucesso.
            </div>
            <?php
        }else
        {
            ?>
            <div class="msg-erro" style="position: absolute; left: 600px; top: 450px;">
            Email j&aacute; cadastrado.
            </div>
            <?php
        }
        }else
        {
            
            ?>
            <div class="msg-erro" style="position: absolute; left: 600px; top: 450px;">
            Senha e confirmar senha n&atilde;o correspondem. Tente novamente!
            </div>
            <?php
        }
        
    }else
    {
        ?>
        <div class="msg-erro">
        <?php echo "Erro: ".$u->msgErro;?>
        </div>
        <?php
    }

}else
{
    ?>
            <div class="msg-erro" style="position: absolute; left: 600px; top: 450px;">
            Preencha todos os campos!
            </div>
          
            <?php
}
}


?>



</body>
</html>