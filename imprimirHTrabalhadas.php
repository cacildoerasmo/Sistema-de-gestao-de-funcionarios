<?php
// Inclua a biblioteca TCPDF
require_once('gerarpdf/tcpdf.php');

//Librerias para generar PDF
//FPDF
//mPDF
//DOMPDF

class MYPDF extends TCPDF {

	
	public function Header() {
		$path = dirname( __FILE__ );
		//$logo = $path.'/img/acesa.png';

		/**Logo Derecha */
		$bMargin = $this->getBreakMargin();
		$auto_page_break = $this->AutoPageBreak;
		$this->SetAutoPageBreak(false, 0);
		//$img_file = '/img/logo.png';
		$img_file = dirname( __FILE__ ) .'/img/escola.jpg';
		$this->Image($img_file, 25, 10, 25, 25, '', '', '', false, 30, '', false, false, 0);
		$this->SetAutoPageBreak($auto_page_break, $bMargin);
		$this->setPageMark();

		$this->Ln(20);
		/**Logo Izquierdo  $this->Image('src imagen', Eje X, Eje Y, Tamaño de la Imagen );*/ 
		//$this->Image($logo, 180, 12, 15 );

		$this->SetFont('helvetica','B',8); //Tipo de fuente y tamaño de letra
		$this->SetXY(145, 29);
		$this->SetTextColor(56,0,71, 0);;
		$this->Write(0, 'Maputo '. date('d-m-Y h:i A'));

		$this->Ln(-15);
		$this->SetFont('helvetica','B',20); //('helvetica','B',8)
		$this->Cell(30);
		$this->Cell(105,1, 'Escola Privada Mãe Ligia',0,0,'C');
		
		/*$this->Ln(5); //Salto de Linea
		$this->SetFont('helvetica','I',10);
		$this->Cell(10);
		$this->Cell(135,35, 'Bienvenidos ...!',0,0,'C');*/

	}



		public function Footer() {
			$this->SetY(-15);
			$this->SetFont('helvetica', '', 8);
			//Mostrar cantidad de paginas
			//$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
			$this->html = '<p style="border-top:1px solid #999; text-align:center;">
							Escola de Ensino Primário em: <strong> Maputo </strong> 
							</p>';
			$this->writeHTML($this->html, true, false, true, false, '');
		}
}



//CREANDO NUEVO DOCUMNETO PDF
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

//establecer margenes
$pdf->SetMargins(25, 35, 25);
$pdf->SetHeaderMargin(20);
$pdf->SetTitle('Relatório de Horas Trabalhadas');
$pdf->setPrintFooter(true); //Defino el estado del footer
$pdf->setPrintHeader(true); //Defino el estado del Header
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
<title>Relatório de Horas Trabalhadas</title>
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
    th{
        color: black;
        border: 1px solid black;
        padding: 8px;
        text-align: left;
        background-color:rgb(56,0,71, 0);
        }
h2{
    text-align: center;
}


</style>
</head>
<body>
<h2>Relatório de Horas Trabalhadas</h2>

<table border='1'>
<tr>
<th>ID</th>
<th>Nome</th>
<th>Data</th>
<th>Hora Inicio</th>
<th>Hora Termino</th>
<th>Hora Trabalhada</th>
<th>Tipo Aula</th>
<th>Departamento</th>
<th>Telefone</th>
<!--<th>Documento</th>-->
<th>Comentário</th>
<th>Código</th>
</tr>";

include_once("config.php");

$sql="SELECT * FROM horastrabalhadas";
$consulta = mysqli_query($conexao,$sql);

while ($exibirRegistros = mysqli_fetch_array($consulta)) {
    $id_HTrabalhadas = $exibirRegistros[0];
    $nome = $exibirRegistros[1];
    $dataHoje = $exibirRegistros[2];
    $horainicio = $exibirRegistros[3];
    $horatermino = $exibirRegistros[4];
    $horatrabalhada = $exibirRegistros[5];
    $tipoaula = $exibirRegistros[6];
    $departamento = $exibirRegistros[7];
    $telefone = $exibirRegistros[8];
    $documento = $exibirRegistros[9];
    $comentario = $exibirRegistros[10];
    $codigo = $exibirRegistros[11];
    
    $html .= "<tr>
    <td>$id_HTrabalhadas</td>
    <td>$nome</td>
    <td>$dataHoje</td>
    <td>$horainicio</td>
    <td>$horatermino</td>
    <td>$horatrabalhada</td>
    <td>$tipoaula</td>
    <td>$departamento</td>
    <td>$telefone</td>
    <!--<td><a href='download.php?filename=" . urlencode($documento) .  "'>$documento</a></td>-->
    <td>$comentario</td>
    <td>$codigo</td>
  </tr>";
}

$html .= "</table></body></html>";

// Escreve o conteúdo HTML no PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Fecha o PDF e envia para o navegador
$pdf->Output('relatorio_horas_trabalhadas.pdf', 'I');

mysqli_close($conexao);
?>