<?php
// Inclua a biblioteca TCPDF
require_once('gerarpdf/tcpdf.php');

class MYPDF extends TCPDF {
    public function Header() {
        $path = dirname(__FILE__);
        $bMargin = $this->getBreakMargin();
        $auto_page_break = $this->AutoPageBreak;
        $this->SetAutoPageBreak(false, 0);
        $img_file = dirname(__FILE__) . '/img/escola.jpg';
        $this->Image($img_file, 25, 10, 25, 25, '', '', '', false, 30, '', false, false, 0);
        $this->SetAutoPageBreak($auto_page_break, $bMargin);
        $this->setPageMark();
        $this->Ln(20);
        $this->SetFont('helvetica', 'B', 8);
        $this->SetXY(145, 29);
        $this->SetTextColor(56, 0, 71, 0);
        $this->Write(0, 'Maputo ' . date('d-m-Y h:i A'));
        $this->Ln(-15);
        $this->SetFont('helvetica', 'B', 20);
        $this->Cell(30);
        $this->Cell(105, 1, 'Escola Privada Mãe Ligia', 0, 0, 'C');
    }

    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', '', 8);
        $this->html = '<p style="border-top:1px solid #999; text-align:center;">
                        Escola de Ensino Primário em: <strong> Maputo </strong> 
                        </p>';
        $this->writeHTML($this->html, true, false, true, false, '');
    }
}

// Criando novo documento PDF
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Estabelecer margens
$pdf->SetMargins(25, 35, 25);
$pdf->SetHeaderMargin(20);
$pdf->SetTitle('Relatório de Pedidos de Dispensa');
$pdf->setPrintFooter(true);
$pdf->setPrintHeader(true);
$pdf->SetAutoPageBreak(false);

// Define a fonte padrão
$pdf->SetFont('helvetica', '', 10);

// Adiciona uma página
$pdf->AddPage();

// Define o conteúdo HTML
$html = "<!DOCTYPE html>
<html lang='pt-br'>
<head>
<meta charset='UTF-8'>
<title>Relatório de Pedidos de Dispensa</title>
<link rel='stylesheet' href='css/bootstrap.min.css'>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }
    th {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
        background-color: rgb(56,0,71, 0);
    }
    h2 {
        text-align: center;
    }
</style>
</head>
<body>
<h2>Relatório de Pedidos de Dispensa</h2>

<table border='1'>
<tr>
<th>ID</th>
<th>Nome</th>
<th>Email</th>
<th>Data</th>
<th>Estado</th>
<th>Departamento</th>
<th>Telefone</th>
<!--<th>Documento</th>-->
<th>Comentário</th>
<th>Código</th>
</tr>";

include_once("config.php");
session_start();

// Verificar se o ID do usuário está definido na sessão
if (!isset($_SESSION['id_usuario'])) {
    echo "ID do usuário não encontrado na sessão";
    exit;
}

// Obter o ID do usuário da sessão
$id_usuario = $_SESSION['id_usuario'];

// Consulta preparada para a tabela loginusuario
$sql = "SELECT nome, email FROM loginusuario WHERE id_usuario = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_usuario);
mysqli_stmt_execute($stmt);
$consulta = mysqli_stmt_get_result($stmt);

if ($consulta) {
    $usuario = mysqli_fetch_assoc($consulta);

    if ($usuario) {
        // Se o usuário existe, agora vamos buscar na pedidodispensa usando o e-mail
        $email = $usuario['email'];
        $sql_bd22 = "SELECT * FROM pedidodispensa WHERE email = ?";
        $stmt_bd22 = mysqli_prepare($conexao, $sql_bd22);
        mysqli_stmt_bind_param($stmt_bd22, "s", $email);
        mysqli_stmt_execute($stmt_bd22);
        $consulta_bd22 = mysqli_stmt_get_result($stmt_bd22);

        if ($consulta_bd22) {
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

                // Adicionar informações à tabela HTML
                $html .= "<tr>
                            <td>$id_Pdispensa</td>
                            <td>$nome</td>
                            <td>$email</td>
                            <td>$dataHoje</td>
                            <td>$estado</td>
                            <td>$departamento</td>
                            <td>$telefone</td>
                            <!--<td><a href='download.php?filename=" . urlencode($documento) . "'>$documento</a></td>-->
                            <td>$comentario</td>
                            <td>$codigo</td>
                          </tr>";
            }
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

// Fechar a tabela HTML
$html .= "</table></body></html>";

// Escreve o conteúdo HTML no PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Fecha o PDF e envia para o navegador
$pdf->Output('relatorio_pedidos_dispensa.pdf', 'I');
?>