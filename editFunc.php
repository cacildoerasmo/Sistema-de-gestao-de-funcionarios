<?php include 'indexGer.php'; ?>

<?php

include_once("config.php");

$id_funcionario = filter_input(INPUT_GET, 'id_funcionario', FILTER_SANITIZE_NUMBER_INT);
$sql = "SELECT * FROM cadfuncionario where id_funcionario ='$id_funcionario'";
$consulta = mysqli_query($conexao,$sql);
$registros = mysqli_fetch_assoc($consulta);



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
    

    <h3>Editar Funcion&aacute;rios</h3>
    <hr>
    <div class="form-group"> 
    <input type="hidden" name="id_funcionario" class="form-control form-control-sm" id="nome" maxlength="40" value="<?php echo $registros['id_funcionario']; ?>" required autofocus>
 </div>
    <div class="form-row">
     <div class="col-6"> 
        <label for="nome">Nome</label> 
    <input type="text" name="nome" class="form-control form-control-sm" id="nome" placeholder="Nome Completo" maxlength="40" value="<?php echo $registros['nome']; ?>" required autofocus> 
 </div>
 
    <div class="col"> 
         <label for="inputEmail4">Email</label>
 <input type="email" name="email" class="form-control form-control-sm" id="inputEmail4" placeholder="exemplo@gmail.com" maxlength="50" value="<?php echo $registros['email']; ?>" required>
 </div> 

 <div class="form-group">
 <legend class="col-form-label col-sm-2 pt-1">Sexo</legend>
 <div class="form-check form-check-inline">
 <input class="form-check-input" type="radio" name="sexo" value="<?php echo $registros['sexo']; ?>" id="inlineRadio1" value="M" checked>
 <label class="form-check-label" for="inlineRadio1">M</label>
 </div>
  <div class="form-check form-check-inline">
 <input class="form-check-input" type="radio" name="sexo" id="inlineRadio2" value="F">
  <label class="form-check-label" for="inlineRadio2">F</label>
 </div>
 </div>

 <div class="col-5"> 
    <label for="inputDate">Data de Nascimento</label>
     <input type="date" name="data_de_nascimento"class="form-control form-control-sm" id="inputDate" value="<?php echo $registros['data_de_nascimento']; ?>"> 
    </div>

    <div class="col"> 
        <label for="bicadastro">BI</label>
         <input type="text" name="bi" class="form-control form-control-sm" id="bicadastro" placeholder="N&deg; de Bilhete de Identidade" maxlength="20" value="<?php echo $registros['bi']; ?>" required> 
        </div>

        <div class="form-group"> 
           <label for="estadosivil">Estado Civil</label>
             <input type="text" name="estadocivil" class="form-control form-control-sm" id="estadosivil" placeholder="Solteiro, Casado..." maxlength="40" value="<?php echo $registros['estadocivil']; ?>" required> 
            </div>  

        

            <div class="col-6"> 
                <label for="nacionalidade">Nacionalidade</label>
                 <input type="text" name="nacionalidade" class="form-control form-control-sm" id="nacionalidade" placeholder="A sua nacionalidade" maxlength="40" value="<?php echo $registros['nacionalidade']; ?>" required> 
                </div>    

                <div class="form-group"> 
                    <label for="cidade">Cidade</label>
                     <input type="text" name="cidade" class="form-control form-control-sm" id="cidade" placeholder="A sua cidade atual" maxlength="40" value="<?php echo $registros['cidade']; ?>" required> 
                    </div>       

                    <div class="col"> 
            <label for="profissao">Departamento</label>
             <input type="text" name="departamento" class="form-control form-control-sm" id="departamento" maxlength="40" value="<?php echo $registros['departamento']; ?>" required> 
            </div>   

                    <div class="form-group">
                        <label for="example-tel-input">Telefone</label>
                        <input class="form-control form-control-sm" value="<?php echo $registros['telefone']; ?>" name="telefone" type="tel"  id="example-tel-input" value="+258 " maxlength="40" required>
                    </div> 

                    <div class="col-5">
                        <label for="nomepai">Nome do pai</label>
                        <input type="text" name="nome_do_pai" class="form-control form-control-sm" id="nomepai" placeholder="Nome Completo" maxlength="40" value="<?php echo $registros['nome_do_pai']; ?>" required>
                        </div>

                          <div class="col">
                               <label for="nomemae">Nome da m&atilde;e</label>
                             <input type="text" name="nome_da_mae" class="form-control form-control-sm" id="nomemae" placeholder="Nome  Completo" maxlength="40" value="<?php echo $registros['nome_da_mae']; ?>" required> 
                            </div>

 <div class="col-7">
 <label for="codigo">C&oacute;digo</label>
  <input type="text" name="codigo" class="form-control form-control-sm" style="width:200px;"id="codigo" maxlength="20" size="20" value="<?php echo $registros['codigo']; ?>" required>
 </div>
 </div>

 <button type="submit" class="btn btn-info">Cadastrar</button>
<!--<button type="submit" class="btn btn-info"><a href="#">Voltar</a></button>-->
 </form>
 
</section>
</section>



</body>
</html>