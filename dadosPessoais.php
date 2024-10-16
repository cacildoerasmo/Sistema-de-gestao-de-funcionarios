<?php include 'indexFunc.php'; ?>

<?php

include_once("config.php");

// Iniciar a sessão (certifique-se de chamar session_start() no início do seu script)


// Verificar se o ID do usuário está definido na sessão
if (!isset($_SESSION['id_usuario'])) {
    // Redirecionar ou tratar de acordo com a lógica do seu aplicativo
    echo "ID do usuário não encontrado na sessão";
    exit;
}

// Obter o ID do usuário da sessão
$id_usuario = $_SESSION['id_usuario'];

// Consulta preparada para a tabela loginfuncionario
$sql = "SELECT nome, email FROM loginusuario WHERE id_usuario = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_usuario);
mysqli_stmt_execute($stmt);
$consulta = mysqli_stmt_get_result($stmt);

if ($consulta) {
    $usuario = mysqli_fetch_assoc($consulta);

    if ($usuario) {
        // Se o usuário existe, agora vamos buscar na bd22 usando o e-mail
        $email = $usuario['email'];
        $sql_bd22 = "SELECT * FROM cadfuncionario WHERE email = ?";
        $stmt_bd22 = mysqli_prepare($conexao, $sql_bd22);
        mysqli_stmt_bind_param($stmt_bd22, "s", $email);
        mysqli_stmt_execute($stmt_bd22);
        $consulta_bd22 = mysqli_stmt_get_result($stmt_bd22);

        if ($consulta_bd22) {
            $info_bd22 = mysqli_fetch_assoc($consulta_bd22);

            if ($info_bd22) {
                // Aqui você pode acessar as informações da bd22
                $nome_bd22 = $info_bd22['nome'];
                $outro_campo_bd22 = $info_bd22['email'];

                // Faça o que for necessário com as informações da bd22
                //echo "Nome: $nome_bd22<br>";
                //echo "Outro Campo: $outro_campo_bd22<br>";
            } else {
                echo "Usuário não encontrado na bd22";
            }
        } else {
            echo "Erro na consulta da bd22: " . mysqli_error($conexao);
        }
    } else {
        echo "Usuário não encontrado na tabela loginfuncionario";
    }
} else {
    echo "Erro na consulta da tabela loginfuncionario: " . mysqli_error($conexao);
}

// Fechar as declarações preparadas
mysqli_stmt_close($stmt);
mysqli_stmt_close($stmt_bd22);

// Fechar a conexão
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
    <!--<link rel="stylesheet" href="cssEstilo/estiloCadFunc.css">-->
    <script src="js/bootstrap.min.js"></script>

    <style>
@media only screen and (max-width: 600px) {
    
}
@media only screen and (max-width: 900px) {
    
}
    
body{
    background-color: #f4f4f4;
  width: 100%;
  height: 100vh;
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
  .btn-info{
      border-radius: 4px;
      -moz-border-radius: 4px;
      -webkit-border-radius: 4px;
      box-shadow: 1px 1px 2px teal;
      -moz-box-shadow: 1px 1px 2px teal;
      -webkit-box-shadow: 1px 1px 2px teal;
      width: 135px;
      height: 35px;
      position: relative;
      left: 1px;
      top: 20px; 
  }
  
  form{
      position: absolute;
      top: 5vh;
      left: 55vh;
      background-color: #fff;
      padding: 30px;
      width: 960px;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
  }
  
  .form-control:focus{
      border-color: lightseagreen;
      -webkit-box-shadow: none;
      box-shadow: none;
     
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
    <!--<img src="img/close.png">-->
<form method="POST" action="proc_editFunc.php">
    

    <h3>Dados Pessoais</h3>
    <hr>
    <div class="form-group"> 
    <input type="hidden" name="id_usuario" class="form-control form-control-sm" id="nome" maxlength="40" value="<?php echo $info_bd22['id_usuario']; ?>" required autofocus>
 </div>
    <div class="form-row">
     <div class="col-6"> 
        <label for="nome">Nome</label> 
    <input type="text" name="nome" class="form-control form-control-sm" id="nome" placeholder="Nome Completo" maxlength="40" value="<?php echo $info_bd22['nome']; ?>" required autofocus readonly> 
 </div>
 
    <div class="col"> 
         <label for="inputEmail4">Email</label>
 <input type="email" name="email" class="form-control form-control-sm" id="inputEmail4" placeholder="exemplo@gmail.com" maxlength="50" value="<?php echo $info_bd22['email']; ?>" required readonly>
 </div> 

 <div class="form-group">
 <legend class="col-form-label col-sm-2 pt-1">Sexo</legend>
 <div class="form-check form-check-inline">
 <input class="form-check-input" type="radio" name="sexo" value="<?php echo $info_bd22['sexo']; ?>" id="inlineRadio1" value="M" checked readonly>
 <label class="form-check-label" for="inlineRadio1">M</label>
 </div>
  <div class="form-check form-check-inline">
 <input class="form-check-input" type="radio" name="sexo" id="inlineRadio2" value="F">
  <label class="form-check-label" for="inlineRadio2">F</label>
 </div>
 </div>

 <div class="col-5"> 
    <label for="inputDate">Data de Nascimento</label>
     <input type="date" name="data_de_nascimento"class="form-control form-control-sm" id="inputDate" value="<?php echo $info_bd22['data_de_nascimento']; ?>" readonly> 
    </div>

    <div class="col"> 
        <label for="bicadastro">BI</label>
         <input type="text" name="bi" class="form-control form-control-sm" id="bicadastro" placeholder="N&deg; de Bilhete de Identidade" maxlength="20" value="<?php echo $info_bd22['bi']; ?>" required readonly> 
        </div>

        <div class="form-group"> 
           <label for="estadosivil">Estado Civil</label>
             <input type="text" name="estadocivil" class="form-control form-control-sm" id="estadosivil" placeholder="Solteiro, Casado..." maxlength="40" value="<?php echo $info_bd22['estadocivil']; ?>" required readonly> 
            </div>  

        

            <div class="col-6"> 
                <label for="nacionalidade">Nacionalidade</label>
                 <input type="text" name="nacionalidade" class="form-control form-control-sm" id="nacionalidade" placeholder="A sua nacionalidade" maxlength="40" value="<?php echo $info_bd22['nacionalidade']; ?>" required readonly> 
                </div>    

                <div class="form-group"> 
                    <label for="cidade">Cidade</label>
                     <input type="text" name="cidade" class="form-control form-control-sm" id="cidade" placeholder="A sua cidade atual" maxlength="40" value="<?php echo $info_bd22['cidade']; ?>" required readonly> 
                    </div>       

                    <div class="col"> 
            <label for="profissao">Departamento</label>
             <input type="text" name="departamento" class="form-control form-control-sm" id="departamento" maxlength="40" value="<?php echo $info_bd22['departamento']; ?>" required readonly> 
            </div>   

                    <div class="form-group">
                        <label for="example-tel-input">Telefone</label>
                        <input class="form-control form-control-sm" value="<?php echo $info_bd22['telefone']; ?>" name="telefone" type="tel"  id="example-tel-input" value="+258 " maxlength="40" required readonly>
                    </div> 

                    <div class="col-5">
                        <label for="nomepai">Nome do Pai</label>
                        <input type="text" name="nome_do_pai" class="form-control form-control-sm" id="nomepai" placeholder="Nome Completo" maxlength="40" value="<?php echo $info_bd22['nome_do_pai']; ?>" required readonly>
                        </div>

                          <div class="col">
                               <label for="nomemae">Nome da M&atilde;e</label>
                             <input type="text" name="nome_da_mae" class="form-control form-control-sm" id="nomemae" placeholder="Nome  Completo" maxlength="40" value="<?php echo $info_bd22['nome_da_mae']; ?>" required readonly> 
                            </div>

 <div class="col-7">
 <label for="codigo">C&oacute;digo</label>
  <input type="text" name="codigo" class="form-control form-control-sm" style="width:200px;"id="codigo" maxlength="20" size="20" value="<?php echo $info_bd22['codigo']; ?>" required readonly>
 </div>
 </div>

 <!--<button type="submit" class="btn btn-info">Cadastrar</button>-->
<!--<button type="submit" class="btn btn-info"><a href="#">Voltar</a></button>-->
 </form>
 
</section>
</section>



</body>
</html>