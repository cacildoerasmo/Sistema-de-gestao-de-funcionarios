<?php include 'indexGer.php'; ?>
<?php

include_once("config.php");

$filtro = isset($_GET['filtro'])?$_GET['filtro']:"";

$sql = "SELECT * FROM justificarfalta where nome like '%$filtro%' order by id_JFalta";
$consulta = mysqli_query($conexao,$sql);
$registros = mysqli_num_rows($consulta);



?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de gestão de fucionários</title>


    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!--<link rel="stylesheet" href="_css/administrador.css">-->
<style>
.bg{
    background-color: #f4f4f4;
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
    left: 50px;
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
border:2px solid #dddddd;
border-collapse:collapse;
width:800px;
border-spacing:0px;
}
form{
    position: relative;
    left: 150px;
    top: -30px;
}
p#texto1{
    position: relative;
    left: 150px;
    top: -25px;
}
p#texto2{
    position: relative;
    left: 150px;
    top: -70px;
}
th{
    font-size: 13px;
    color: lightseagreen;
}
td#idPferias{
    color: lightseagreen;
}
td{
    font-size: 14px; 
}
  
a:hover{
    text-decoration: none;
    color: inherit;
}

.btn-info a{
    color: white;
}
    
  
</style>
</head>
<body>
<script>
        function imprimirPDF() {
            // Redireciona para o script PHP que gera o PDF
            window.location.href = 'imprimirFJustificadas.php';
        }
    </script>
    <section class="container-fluid bg">
  <section class="row justify-content-center">
<div>
          <h3>Relatórios Faltas Justificadas</h3>
          <hr></br></br>

          <form method="get" action="">
            Filtrar por nome: <input type="text" name="filtro" class="campo" required autofocus>
         
        <input type="submit" value="Pesquisar">
        <!--<button type="submit" class="btn btn-info"><a href="#">Voltar</a></button>-->
        <button onclick="imprimirPDF()">Gerar PDF</button>
          </form>

          <?php
print "<p id='texto1'>Resultado da pesquisa do nome $filtro</p></br></br>";
print "<p id='texto2'>$registros registos encontrados.</p>";

print "</br></br>";

// Cabeçalho da tabela
echo "<table border='1' id='tabela'>
        <tr>
          <th>Id_JFalta</th>
          <th>Nome</th>
          <th>Email</th>
          <th>Data</th>
          <th>BI</th>
          <th>Recibo</th>
          <th>Departamento</th>
          <th>Telefone</th>
          <th>Documento</th>
          <th>Comentário</th>
          <th>Código</th>
        </tr>";

while ($exibirRegistros = mysqli_fetch_array($consulta)) {
    $id_JFalta = $exibirRegistros[0];
    $nome = $exibirRegistros[1];
    $email = $exibirRegistros[2];
    $data = $exibirRegistros[3];
    $bi = $exibirRegistros[4];
    $recibo = $exibirRegistros[5];
    $departamento = $exibirRegistros[6];
    $telefone = $exibirRegistros[7];
    $documento = $exibirRegistros[8];
    $comentario = $exibirRegistros[9];
    $codigo = $exibirRegistros[10];
    
    // Linha da tabela
    echo "<tr>
            <td id='idPferias'>$id_JFalta</td>
            <td>$nome</td>
            <td>$email</td>
            <td>$data</td>
            <td>$bi</td>
            <td>$recibo</td>
            <td>$departamento</td>
            <td>$telefone</td>
            <td><a href='download.php?filename=" . urlencode($documento)  . "'>$documento</a></td>
            <td>$comentario</td>
            <td>$codigo</td>

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



           