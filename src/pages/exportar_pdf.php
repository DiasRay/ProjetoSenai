<?php
require_once('../tcpdf/tcpdf.php');
include_once('conexao.php');

if (isset($_GET['id_projeto'])) {
    $id_projeto = $_GET['id_projeto'];
    $query = "SELECT * FROM projetos WHERE id = $id_projeto";
    $consulta = mysqli_query($conn, $query);

    if ($consulta) {
        $exibirProjetos = mysqli_fetch_array($consulta);
        $id = $exibirProjetos[0];
        $nome = $exibirProjetos[1];
        $turma = $exibirProjetos[2];
        $data = $exibirProjetos[3];

        $dataFormatada = date_create_from_format('Y-m-d', $data);
        $dataBR = $dataFormatada->format('d/m/Y');

        date_default_timezone_set('America/Sao_Paulo');
        $data_hora = date('d/m/Y H:i:s');

        // Cria o PDF
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetFont('helvetica', '', 12);
        $pdf->setHeaderData('', 0, '', '');
        $pdf->setPrintHeader(false);
        $pdf->AddPage();

        // Cabeçalho
        $image_file = '../images/SENAI_São_Paulo_logo.jpeg';
$pdf->Image($image_file, 10, 10, 48, 10, 'JPEG', '', '', true, 300, '', false, false, 0, false, false, false);


$pdf->SetFont('helvetica', 'B', 12);
$pdf->SetXY(60, 10);
$pdf->SetCellPaddings(0, 2, 0, 0);
$pdf->MultiCell(0, 10, 'Avaliação de TCC', 1, 'C', false);
$pdf->SetFont('helvetica', '', 9);
$texto1 = 'ESCOLA SENAI "ROBERTO SIMONSEN"';

$texto2 = 'Endereço: Rua Monsenhor Andrade, 298';

$texto3 = ' - Brás - São Paulo - CEP: 03008-000 - Telefone: (11) 3322-5000';

$pdf->SetFont('helvetica', 'B', 9);

$pdf ->setCellPaddings(2, 1, 1, 1);

$pdf->SetXY(10, 22); 

$pdf->MultiCell(0, 15, $texto1 . "\n\n" . $texto2, 1, 'L', false);


$pdf->SetFont('helvetica', 'B', 9);
$pdf->SetXY(80, 22); 
$pdf->MultiCell(0, 15, "\n\n". $texto3, 0, 'L', false);

$pdf->SetXY(10,37);
$pdf->MultiCell(0, 5, "Turma: " . $turma, 1, 'L', false);
$pdf->SetFont('helvetica', '', 9);

$pdf->SetFont('helvetica', 'B', 9); 
$pdf->SetXY(130,37);
$pdf->MultiCell(0, 5, "Data de emissão: ", 1, 'L', false);

$pdf->SetXY(158,37);
$pdf->SetFont('helvetica', '', 9); 
$pdf->MultiCell(0, 5, $data_hora, 0, 'L', false);

$pdf->SetFont('helvetica', 'B', 9);
$pdf->SetXY(10,45);
$pdf->MultiCell(0, 5, "Nome do Projeto ", 1, 'L', false);

$pdf->SetXY(125,45);
$pdf->MultiCell(0,5,'Data de avaliação', 1, 'L', false);

$pdf->SetXY(160,45);
$pdf->MultiCell(0, 5, "ID ", 1, 'L', false);
$pdf->SetXY(10,51);
$pdf->MultiCell(0, 5, $nome, 1, 'L', false);

$pdf->SetXY(160,51);
$pdf->MultiCell(0, 5, $id, 1, 'L', false);


$pdf->SetXY(125,51);
$pdf->MultiCell(0, 5, $dataBR, 1, 'L', false);
$pdf->SetXY(10,62);
$pdf->MultiCell(0, 7, "Avaliação", 1, 'C', false);
$somaMedias = 0;
$numAvaliacoes = 0;
        // Avaliações
        $queryAvaliacoes = "SELECT * FROM avaliacoes WHERE id_projeto = $id";
        $consultaAvaliacoes = mysqli_query($conn, $queryAvaliacoes);

        while ($exibirAvaliacoes = mysqli_fetch_array($consultaAvaliacoes)) {
            $id_avaliacao = $exibirAvaliacoes[1];
            $criterio1 = $exibirAvaliacoes[3];
            $criterio2 = $exibirAvaliacoes[4];
            $criterio3 = $exibirAvaliacoes[5];
            $criterio4 = $exibirAvaliacoes[6];
            $criterio5 = $exibirAvaliacoes[7];
            $criterio6 = $exibirAvaliacoes[8];
            $criterio7 = $exibirAvaliacoes[9];
            $criterio8 = $exibirAvaliacoes[10];
            $observacoes = $exibirAvaliacoes[11];

            $notas = array($criterio1, $criterio2, $criterio3, $criterio4, $criterio5, $criterio6, $criterio7, $criterio8);
            $media = number_format(array_sum($notas) / count($notas), 4)*10;
            $somaMedias += $media;
            $numAvaliacoes++;

            // Executar a consulta para obter o nome do docente
            $query_docente = "SELECT `nome` FROM `docentes` WHERE `nif` LIKE '%" . $exibirAvaliacoes[2] . "%'";
            $resultado_docente = mysqli_query($conn, $query_docente);
            $linha_docente = mysqli_fetch_array($resultado_docente);
            $nome_docente = $linha_docente['nome'];

            // Adiciona os dados da avaliação ao PDF
            $pdf->SetFont('helvetica', 'B', 9);
            $pdf->SetXY(10, $pdf->GetY() + 2);
            $pdf->Cell(25, 5, 'Docente', 1, 0, 'L');
            $pdf->SetFont('helvetica', '', 9);
            $pdf->Cell(165, 5, $nome_docente, 1, 1, 'L');

            $pdf->SetFont('helvetica', 'B', 9);
            $pdf->SetXY(10, $pdf->GetY());
            $pdf->Cell(25, 5, 'Critérios', 1, 0, 'L');
            $pdf->Cell(18, 5, '1º', 1, 0, 'C');
            $pdf->Cell(18, 5, '2º', 1, 0, 'C');
            $pdf->Cell(18, 5, '3º', 1, 0, 'C');
            $pdf->Cell(18, 5, '4º', 1, 0, 'C');
            $pdf->Cell(18, 5, '5º', 1, 0, 'C');
            $pdf->Cell(18, 5, '6º', 1, 0, 'C');
            $pdf->Cell(18, 5, '7º', 1, 0, 'C');
            $pdf->Cell(18, 5, '8º', 1, 0, 'C');
            $pdf->Cell(21, 5, "Média", 1, 1, 'C');

            $pdf->Cell(25, 5, 'Notas', 1, 0, 'L');
            $pdf->SetFont('helvetica', '', 9);
            $pdf->Cell(18, 5, $criterio1, 1, 0, 'C');
            $pdf->Cell(18, 5, $criterio2, 1, 0, 'C');
            $pdf->Cell(18, 5, $criterio3, 1, 0, 'C');
            $pdf->Cell(18, 5, $criterio4, 1, 0, 'C');
            $pdf->Cell(18, 5, $criterio5, 1, 0, 'C');
            $pdf->Cell(18, 5, $criterio6, 1, 0, 'C');
            $pdf->Cell(18, 5, $criterio7, 1, 0, 'C');
            $pdf->Cell(18, 5, $criterio8, 1, 0, 'C');
            $pdf->Cell(21, 5, $media, 1, 1, 'C');
            $pdf->SetFont('helvetica', '', 9);

            $observacao = "";

            $pdf->SetFont('helvetica', 'B', 9);
            $pdf->SetXY(10, $pdf->GetY() + 2);
            $pdf->MultiCell(0, 1, 'Observações', 1, 'L', false);

            // Obter a posição atual para usar como referência
            $posX = $pdf->GetX();
            $posY = $pdf->GetY();

            // Definir a largura e a altura da célula para as observações
            $larguraCelula = 0; // Largura da célula (0 para ocupar toda a largura)
            $alturaCelula = 15; // Altura da célula para exibir as observações

            $pdf->SetFont('helvetica', '', 8);
            $pdf->SetXY($posX, $posY);
            $pdf->MultiCell($larguraCelula, $alturaCelula, $observacoes, 1, 'L', false);
        }

        $mediaFinal = $somaMedias / $numAvaliacoes;

        // Determinar a cor de acordo com a situação
        if($mediaFinal >= 50){
            $situacao = "Aprovado";
            $corFundo = array(0, 255, 0); // Verde
            $corTexto = array(0, 0, 0); // Preto
        } elseif($mediaFinal < 50 && $mediaFinal > 45){
            $situacao = "Análise em conselho";
            $corFundo = array(255, 255, 0); // Amarelo
            $corTexto = array(0, 0, 0); // Preto
        } else{
            $situacao = "Reprovado";
            $corFundo = array(255, 0, 0); // Vermelho
            $corTexto = array(255, 255, 255); // Branco
        }

        // Adiciona a célula da média final
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetXY(10, $pdf->GetY() + 2);
        $pdf->MultiCell(0, 7, "Média Final: ", 1, 'C', false);
        $pdf->MultiCell(0, 7, number_format($mediaFinal, 2), 1, 'C', false);

        // Adiciona a célula da situação abaixo da média final com as cores definidas
        $pdf->SetXY(10, $pdf->GetY() + 2);
        $pdf->SetFillColor($corFundo[0], $corFundo[1], $corFundo[2]);
        $pdf->SetTextColor($corTexto[0], $corTexto[1], $corTexto[2]);
        $pdf->MultiCell(0, 7, "Situação: " . $situacao, 1, 'C', true); // Adicione 'true' para preencher com a cor de fundo


        // Rodapé
        $pdf->SetXY(10, $pdf->GetY() + 2);
        $pdf->SetFont('helvetica', 'B', 7);
        $pdf->SetTextColor(0, 0, 0); // Definir cor preta para o texto do rodapé

        $cri1 = "1º Critério: Avaliação Domínio do conteúdo apresentado.    ";
        $cri2 = "2° Critério: Relevância das Informações.    ";
        $cri3 = "3° Critério: Qualidade de recursos audiovisuais (slides).    ";
        $cri4 = "4° Critério: Conteúdo do vídeo (elevator pitch).    ";
        $cri5 = "5° Critério: Inovação.    ";
        $cri6 = "6° Critério: Controle do tempo.    ";
        $cri7 = "7° Critério: Aplicabilidade do Projeto.    ";
        $cri8 = "8° Critério: Ideia como plano de projeto.    ";

        $texto = $cri1 . $cri2 . $cri3 . "\n" . $cri4 . $cri5 . $cri6 . $cri7 . "\n\n" . $cri8;

        $pdf->MultiCell(0, 10, $texto, 1, 'L', false); // Adiciona o conteúdo do rodapé na mesma página

        $pdf->Output("TCC$nome - $turma.pdf", 'D'); // Saída do PDF

    } else {
        // Handle query error
        die('Error executing query: ' . mysqli_error($conn));
    }
} else {
    // Tratar caso o parâmetro não seja passado
    die('Parâmetro id_projeto não foi fornecido.');
}

?>
