<?php include 'indexFunc.php'; ?>


<?php
include_once("config.php");

// Iniciar a sessão
//session_start();

// Verificar se o ID do usuário está definido na sessão
if (!isset($_SESSION['id_usuario'])) {
    echo "ID do usuário não encontrado na sessão";
    exit;
}

$id_usuario = $_SESSION['id_usuario'];

// Obter o filtro, se existir
$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : "";

// Consulta preparada para a tabela loginusuario
$sql = "SELECT email FROM loginusuario WHERE id_usuario = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_usuario);
mysqli_stmt_execute($stmt);
$consulta = mysqli_stmt_get_result($stmt);

if ($consulta) {
    $usuario = mysqli_fetch_assoc($consulta);

    if ($usuario) {
        // Se o usuário existe, agora vamos buscar na pedidodispensa usando o e-mail
        $email = $usuario['email'];

        // Adicionar o filtro à consulta
        $sql_bd22 = "SELECT * FROM pedidodispensa WHERE email = ? AND (nome LIKE ? OR estado LIKE ?) ORDER BY id_Pdispensa";
        $stmt_bd22 = mysqli_prepare($conexao, $sql_bd22);
        $filtro_sql = '%' . $filtro . '%';
        mysqli_stmt_bind_param($stmt_bd22, "sss", $email, $filtro_sql, $filtro_sql);
        mysqli_stmt_execute($stmt_bd22);
        $consulta_bd22 = mysqli_stmt_get_result($stmt_bd22);

        if ($consulta_bd22) {
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
                      <th>Codigo</th>
                    </tr>";

            // Iterar sobre todos os registros encontrados
            while ($info_bd22 = mysqli_fetch_assoc($consulta_bd22)) {
                $id_Pdispensa = $info_bd22['id_Pdispensa'] ?? '';
                $nome = $info_bd22['nome'] ?? '';
                $dataHoje = $info_bd22['dataHoje'] ?? '';
                $estado = $info_bd22['estado'] ?? '';
                $departamento = $info_bd22['departamento'] ?? '';
                $telefone = $info_bd22['telefone'] ?? '';
                $documento = $info_bd22['documento'] ?? '';
                $comentario = $info_bd22['comentario'] ?? '';
                $codigo = $info_bd22['codigo'] ?? '';

                // Exibir informações na tabela
                echo "<tr>
                        <td id='idPdispensa'><b>$id_Pdispensa</b></td>
                        <td>$nome</td>
                        <td>$email</td>
                        <td>$dataHoje</td>
                        <td>$estado</td>
                        <td>$departamento</td>
                        <td>$telefone</td>
                        <td><a href='download.php?filename=" . urlencode($documento) . "'>$documento</a></td>
                        <td>$comentario</td>
                        <td>$codigo</td>
                      </tr>";
            }

            // Fechamento da tabela
            echo "</table>";
        } else {
            echo "Erro na consulta da pedidodispensa: " . mysqli_error($conexao);
        }
    } else {
        echo "Usuário não encontrado na tabela loginusuario";
    }
} else {
    echo "Erro na consulta da tabela loginusuario: " . mysqli_error($conexao);
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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .bg {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .justify-content-center {
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

        h3 {

            position: relative;
            left: 20px;
            color: lightseagreen;
        }

        hr {
            position: relative;
            top: 5px;
            left: 20px;
            width: 700px;
            background-color: lightseagreen;
        }

        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }

        article {
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

        .btn-info a {
            color: white;
        }

        .btn-info {
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

        table#tabela {
            position: absolute;
            top: 330px;
            left: 470px;
            border: 2px solid #dddddd;
            border-collapse: collapse;
            width: 800px;
            border-spacing: 0px;
        }

        form {
            position: relative;
            left: 18px;
            top: -5px;

        }

        p#texto1 {
            position: relative;
            left: 18px;
            top: -1px;
        }

        p#texto2 {
            position: relative;
            left: 18px;
            top: -60px;
        }

        th {
            font-size: 14px;
            color: lightseagreen;
        }

        td#idPdispensa {
            color: lightseagreen;

        }

        body {
            overflow: hidden;
        }

        td {
            font-size: 15px;
        }

        .highlight-email {
            color: #f4f4f4;
        }
    </style>
</head>
<body>

<script>
    function imprimirPDF() {
        // Redireciona para o script PHP que gera o PDF
        window.location.href = 'imprimir.php';
    }
</script>

<section class="container-fluid bg">
    <section class="row justify-content-center">
        <div>
            <h3>Relatório de Pedido de Dispensa</h3>
            <hr>
            <form method="get" action="">
                Filtrar por estado: <input type="text" name="filtro" class="campo" value="<?php echo htmlspecialchars($filtro); ?>" required autofocus>
                <input type="submit" value="Pesquisar">
                <!--<button type="submit" class="btn btn-info"><a href="#">Voltar</a></button>-->
                <button onclick="imprimirPDF()">Gerar PDF</button>
            </form>

            <?php
            print "<p id='texto1'>Resultado da pesquisa do estado $filtro</p></br></br>";
            print "</br></br>";
            ?>

        </div>
    </section>
</section>

<script src="lib/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="javascript/persolConfirm.js"></script>

</body>
</html>

