<?php include 'indexGer.php'; ?>
<?php

include_once("config.php");

$filtro = isset($_GET['filtro'])?$_GET['filtro']:"";


$sql = "SELECT * FROM pedidodispensa where estado='Submetido' order by id_Pdispensa";
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
/*.bg{
    background-color: lightseagreen;
  width: 100%;
  height: -50vh;
  
}*/

/*.justify-content-center{
    position: absolute;
    top: 4vh;
    left: 70vh;
    background-color: #fff;
    padding: 20px;
    width: 800px;
    height: 290px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
    
}*/
/*h3{
    position: relative;
    left:-50px;
    color: lightseagreen;
    
}*/
hr{
    position: relative;
    top: 90px;
    left: 70px;
     width: 800px;
    background-color: lightseagreen;
}
body{
    background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
}
/*article{
width: 100%;
box-sizing: border-box;
padding: 10px;
background-color: #d6d5d5;
margin-bottom: 5px;
}*/

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
    width: 130px;
    height: 32px;
    position: relative;
    left: 20px;
    top: -4px; 
}
table#tabela{
position: relative;
top: 50px;
left: 125px;
border:2px solid #dddddd;
border-collapse:collapse;
width:800px;
border-spacing:0px;
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
    color: white;
}
td#idPdispensa{
    color: lightseagreen;
}
body{
    overflow: hidden;
}
b#aprovar{
    color: green;
}
b#recusar{
    color: red;
}
  
</style>
</head>
<body>

    
    <section class="container-fluid bg">
  <section class="row justify-content-center">
<div>
          <h3 style="position: absolute; top: 50px; left: 437px; color: lightseagreen;">Pedidos submetidos</h3>
         <hr>

          <!--<form method="get" action="">
            Filtrar por painel: <input type="text" name="filtro" class="campo" required autofocus>
         
        <input type="submit" value="Pesquisar">-->
        <!--<button type="submit" class="btn btn-info"><a href="#">Voltar</a></button>-->
          <!--</form>-->

          <?php
/*print "<p id='texto1'>Resultado da pesquisa do painel $filtro</p></br></br>";
print "<p id='texto2'>$registros registros encontrados.</p>";*/

print "</br></br>";

// Cabeçalho da tabela
echo "<table border='1' id='tabela'>
        <tr>
          <th>Id_Pdispensa</th>
          <th>Nome</th>
          <th>Email</th>
          <th>Data</th>
          <th>Estado</th>
          <th>Departamento</th>
          <th>Telefone</th>
          <th>Documento</th>
          <th>Comentário</th>
          <th>Código</th>
          <th>Acções</th>
        </tr>";

while ($exibirRegistros = mysqli_fetch_array($consulta)) {
    $id_Pdispensa = $exibirRegistros[0];
    $nome = $exibirRegistros[1];
    $email = $exibirRegistros[2];
    $data = $exibirRegistros[3];
    $estado = $exibirRegistros[4];
    $departamento = $exibirRegistros[5];
    $telefone = $exibirRegistros[6];
    $documento = $exibirRegistros[7];
    $comentario = $exibirRegistros[8];
    $codigo = $exibirRegistros[9];
    
    // Linha da tabela
    echo "<tr>
            <td id='idPdispensa'><b>$id_Pdispensa</b></td>
            <td>$nome</td>
            <td>$email</td>
            <td>$data</td>
            <td>$estado</td>
            <td>$departamento</td>
            <td>$telefone</td>
            <td>$documento</td>
            <td>$comentario</td>
            <td>$codigo</td>
            <td>
                <a href='editPdispensa.php?idPdispensa=$id_Pdispensa&acao=aprovar'><b id='aprovar'>Aprovar</b></a>&nbsp;&nbsp;&nbsp;
                <a href='editPdispensa.php?idPdispensa=$id_Pdispensa&acao=recusar'><b id='recusar'>Recusar</b></a>
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
   

<script src="lib/jquery-3.4.1.min.js"></script>
              <script src="js/bootstrap.min.js"></script>
              <script src="javascript/persolConfirm.js"></script>

    </body>
    </html>