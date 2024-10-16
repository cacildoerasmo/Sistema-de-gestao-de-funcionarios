

<?php

include_once("config.php");
/*
$id_Pferias = filter_input(INPUT_GET, 'id_Pferias', FILTER_SANITIZE_NUMBER_INT);
$sql = "SELECT * FROM pedidoferias where id_Pferias ='$id_Pferias'";
$consulta = mysqli_query($conexao,$sql);
$registros = mysqli_fetch_assoc($consulta);*/

$id_Pdispensa = $_GET['idPdispensa'];
$acao = $_GET['acao'];

if($acao == 'aprovar') {
    // Atualize o status para ativo (ou o valor que representa ativo na sua base de dados)
    mysqli_query($conexao, "UPDATE pedidodispensa SET estado = 'aprovado' WHERE id_Pdispensa = $id_Pdispensa");
    header("Location: procAprova.php");
} elseif($acao == 'recusar') {
    // Atualize o status para inativo (ou o valor que representa inativo na sua base de dados)
    mysqli_query($conexao, "UPDATE pedidodispensa SET estado = 'recusado' WHERE id_Pdispensa = $id_Pdispensa");
    header("Location: procRecusa.php");
   
}

// Redirecione de volta para a página anterior

exit;

?>
<?php include 'indexGer.php'; ?>

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
<form method="post" action="proc_pedirDispensa.php">
    

    <h3>Pedido de Dispensa</h3>
    <hr>
    <div class="form-row">
     <div class="col-5"> 
        <label for="nome">Nome</label> 
    <input type="text" name="nome" class="form-control form-control-sm" id="nome" placeholder="Nome Completo" maxlength="40" required autofocus> 
 </div>
 
    <div class="col-3"> 
         <label for="inputEmail4">Email</label>
 <input type="email" name="email" class="form-control form-control-sm" id="inputEmail4" placeholder="exemplo@gmail.com" maxlength="50" required>
 </div> 


 <div class="col-4"> 
    <label for="inputDate">Data</label>
     <input type="date" name="dataHoje"class="form-control form-control-sm" id="inputDate"> 
    </div>

    <div class="col"> 
           <label for="estadosivil">Estado</label>
             <input type="text" name="estado" class="form-control form-control-sm" id="estadosivil" value="Nao aprovado" maxlength="40"> 
            </div> 
          

                    <div class="col"> 
            <label for="profissao">Departamento</label>
             <input type="text" name="departamento" class="form-control form-control-sm" id="departamento" maxlength="40" required> 
            </div>   

                    <div class="col-5">
                        <label for="example-tel-input">Telefone</label>
                        <input class="form-control form-control-sm" name="telefone" type="tel"  id="example-tel-input" maxlength="40" required>
                    </div>

                        <div class="col-5">
        Selecione o Documento
        <input type="file" class="form-control-file" name="documento" id="file" onchange="getImagePreview(event)"/>
        <div id="preview"></div>
      
    </div>
    <div class="col">
<label>Comentário</label>
<textarea class="form-control" name="comentario" rows="3" ></textarea>
</div>

 <div class="col-7">
 <label for="codigo">C&oacute;digo</label>
  <input type="text" name="codigo" class="form-control form-control-sm" style="width:200px;"id="codigo" maxlength="20" size="20" required>
 </div>
 </div>

 <button type="submit" name="submit" class="btn btn-info">Submeter</button>

 </form>
 
</section>
</section>



</body>
</html>