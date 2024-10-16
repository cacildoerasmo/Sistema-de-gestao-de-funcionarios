<?php include 'index.php'; ?>
<?php

include_once("config.php");

$filtro = isset($_GET['filtro'])?$_GET['filtro']:"";


$sql = "SELECT * FROM loginusuario where painel like '%$filtro%' order by id_usuario";
$consulta = mysqli_query($conexao,$sql);
$registros = mysqli_num_rows($consulta);



?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de gestão de funcionários</title>


    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!--<link rel="stylesheet" href="_css/administrador.css">-->
<style>
.bg{
    background-color: #f4f4f4;
  width: 100%;
  height: 100vh;
  font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
  
}

.justify-content-center{
    position: absolute;
    top: 4vh;
    left: 70vh;
    background-color: #fff;
    padding: 20px;
    width: 800px;
    height: 290px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
    
}
h3{
    position: relative;
    left:50px;
    color: lightseagreen;
    
    
}
hr{
    width: 700px;
    background-color: lightseagreen;
}
body{
    background-color: #f4f4f4;
    font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
}
article{
width: 100%;
box-sizing: border-box;
padding: 10px;
background-color: #d6d5d5;
margin-bottom: 5px;
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
.btn-info a{
    color: white;
}
.btn-info{
    border-radius: 4px;
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
    box-shadow: 1px 1px 2px teal;
    -moz-box-shadow: 1px 1px 2px teal;
    -webkit-box-shadow: 1px 1px 2px teal;
    width: 130px;
    height: 32px;
    position: relative;
    left: 20px;
    top: -4px; 
}
table#tabela{
position: relative;
top: -45px;
left: 0px;
border: 2px solid #dddddd;
border-collapse: collapse;
width: 800px;
border-spacing: 0px;
}
form{
    position: relative;
    left: 50px;
    top: -30px;
}
p#texto1{
    position: relative;
    left: 50px;
    top: -25px;
}
p#texto2{
    position: relative;
    left: 50px;
    top: -70px;
}
th{
    color: lightseagreen;
}
td#idusuario{
    color: lightseagreen;
}
b#editar{
    color: green;
}
b#remover{
    color: red;
}
</style>
</head>
<body>

    
    <section class="container-fluid bg">
  <section class="row justify-content-center">
<div>
          <h3>Consultas</h3>
          <hr></br></br>

          <form method="get" action="">
            Filtrar por painel: <input type="text" name="filtro" class="campo" required autofocus>
         
        <input type="submit" value="Pesquisar">
        <!--<button type="submit" class="btn btn-info"><a href="#">Voltar</a></button>-->
          </form>

          <?php
print "<p id='texto1'>Resultado da pesquisa do painel $filtro</p></br></br>";
print "<p id='texto2'>$registros registos encontrados.</p>";

print "</br></br>";

// Cabeçalho da tabela
echo "<table border='1' id='tabela'>
        <tr>
          <th>Id_Usuário</th>
          <th>Nome</th>
          <th>Telefone</th>
          <th>Email</th>
          <th>Painel</th>
          <th>Acções</th>
        </tr>";

while ($exibirRegistros = mysqli_fetch_array($consulta)) {
    $id_usuario = $exibirRegistros[0];
    $nome = $exibirRegistros[1];
    $telefone = $exibirRegistros[2];
    $email = $exibirRegistros[3];
    $senha = $exibirRegistros[4];
    $painel = $exibirRegistros[5];

    // Linha da tabela
    echo "<tr>
            <td id='idusuario'>$id_usuario</td>
            <td>$nome</td>
            <td>$telefone</td>
            <td>$email</td>
            <td>$painel</td>
            <td>
                <a href='editAdmin.php?id_usuario=$id_usuario'><b id='editar'>Editar</b></a>&nbsp;&nbsp;&nbsp;
                <a href='proc_eliminarAdmin.php?id_usuario=$id_usuario' data-confirm='Tem certeza de que deseja excluir o usuário selecionado?'><b id='remover'>Remover</b></a>
            </td>
          </tr>";
}

// Fechamento da tabela
echo "</table>";

mysqli_close($conexao);
?>
 </section>
    </section>
</div>

<script>
$(document).ready(function(){
    $('a[data-confirm]').click(function(ev){
        var href = $(this).attr('href');
        if (!$('#confirm-delete').length){
            $('body').append('<div class="modal" style="position: relative; top: 100px; left: -420px;" id="confirm-delete" tabindex="-1" role="dialog"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header bg-danger text-white">REMOVER USUÁRIO<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">Tem a certeza de que deseja remover o usuário selecionado?</div><div class="modal-footer"><button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button><a class="btn btn-danger text-white" id="dataConfirmOK">Remover</a></div></div></div></div>');
        }
        $('#dataConfirmOK').attr('href', href);
        $('#confirm-delete').modal({show: true});
        return false;
    });
});
</script>

<script src="lib/jquery-3.4.1.min.js"></script>
              <script src="js/bootstrap.min.js"></script>
              <!--<script src="javascript/persolConfirm.js"></script>-->

    </body>
    </html>