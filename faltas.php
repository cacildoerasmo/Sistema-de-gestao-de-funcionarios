<?php include 'indexGer.php'; ?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de gestão de funcionário</title>

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
<form method="post" action="proc_lancar_faltas.php">
    

    <h3>Lançar Falta</h3>
    <hr>
    <div class="form-row">

    
    <div class="col"> 
            <label for="funcionario_id">Funcionário ID</label>
             <input type="number" name="funcionario_id" class="form-control form-control-sm" id="funcionario_id" required> 
            </div>   
 <div class="col-4"> 
    <label for="inputDate">Data da Falta</label>
     <input type="date" name="data_falta" class="form-control form-control-sm" id="inputDate" required> 
    </div>


             
    <div class="col-6">
<label>Motivo</label>
<textarea class="form-control" name="motivo" rows="3" ></textarea>
</div>


 <button type="submit" name="submit" class="btn btn-info">Submeter</button>

 </form>
 
</section>
</section>



</body>
</html>