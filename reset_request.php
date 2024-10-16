<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="UTF-8">
<title>Sistema de gestão de funcionários</title>

<script src="lib/jquery-3.4.1.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<!--<link rel="stylesheet" href="cssEstilo/estiloTelaPrincipal.css">-->
<script src="js/bootstrap.min.js"></script>

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
.form-container{
    position: relative;
    top: 15vh;
    left: 475px;
}
.text-left{
    color: teal;
}

.btn-primary{
    background-color: teal;
}

.form-control:focus{
    border-color: lightseagreen;
    -webkit-box-shadow: none;
    box-shadow: none;
   
}

.btn-success{
    position: unset;
    top: 305px;
    left: 60px;
    width: 115px;
}

h3{
    text-align: center;
    color: lightseagreen;
    width: 300px;
}

hr{
    background-color: lightseagreen;
    width: 300px;
}

label{
    font-family:sans-serif;
	font-weight:normal;
    font-size:12pt;
    width: 300px;
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
                    <section class="col-12 col-sm-6 col-md-3">
                    <form action="reset_password.php" method="post" class="form-container"> 
                        <h3>Redefinir Senha</h3>
                        <hr>
                        <div class="form-group">
                        <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>"> 
                        <label for="password">Nova Senha:</label> 
                        <input type="password" class="form-control" style="width: 300px; " name="password" required> 
                        </div>

                        <p><button type="submit" class="btn btn-info btn-block" style="width: 300px; Background-color: lightseagreen;">Redefinir Senha</button></p>
                    </form> 


                        </section>
                </section>

            </section>

          
                    
</body>

</html>