<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta TCC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha1/css/bootstrap.min.css" integrity="sha512-KyZXEAg3QhqLMpG8r+Knujsl7/1L_dstPt3HV5HzF6Gvk/e3s4Wz6iJgD/+ub2oU" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/consulta.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBud7TlRbs/ic4AwGcFZOxg5DpPt8EgeUIgIwzjWfXQKWA8+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <header>
        <div class="header-topo">
            <img class="logo" src="../images/SENAI_São_Paulo_logo.png" alt="">
        </div>

    </header>

    <br>

    <section class="titulo_01">
        <h3>Consultar arquivos de Avaliação</h3>
    </section>

    <div class="seta">
        <a href="../../index.php"><img class="seta-esquerda" src="../images/seta_esquerda.png"></a>
    </div>

    <div>



        <section>

            <?php
            include_once('conexao.php');

            if (isset($_GET['nome'])) {
                $nomeConsulta = $_GET['nome'];
            }

            if (isset($_GET['turma'])) {
                $turmaConsulta = $_GET['turma'];
            }

            if (isset($nomeConsulta) && !empty($nomeConsulta)) {
                $_SESSION['nome'] = $nomeConsulta;
            }

            if (isset($turmaConsulta) && !empty($turmaConsulta)) {
                $_SESSION['turma'] = $turmaConsulta;
            }

            $nomeFiltro = isset($_SESSION['nome']) ? $_SESSION['nome'] : '';
            $turmaFiltro = isset($_SESSION['turma']) ? $_SESSION['turma'] : '';

            $query = "SELECT * FROM `projetos` WHERE nome LIKE '%$nomeFiltro%'";

            if (!empty($turmaFiltro)) {
                $query .= " AND turma = '$turmaFiltro'";
            }

            $query .= " ORDER BY `nome`";

            $consulta = mysqli_query($conn, $query);
            $registros = mysqli_num_rows($consulta);

            // Consulta para obter todas as turmas
            $queryTurmas = "SELECT distinct turma FROM `projetos`";
            $resultadoTurmas = mysqli_query($conn, $queryTurmas);

            // Verifica se há resultados
            if (mysqli_num_rows($resultadoTurmas) > 0) {
                $optionsTurmas = ""; // Inicializa uma string vazia para armazenar as opções

                // Monta as opções do dropdown com os resultados da consulta
                while ($row = mysqli_fetch_assoc($resultadoTurmas)) {

                    $nomeTurma = $row['turma'];
                    $optionsTurmas .= "<option value='$nomeTurma'>$nomeTurma</option>";
                }
            } else {
                $optionsTurmas = "<option value=''>Nenhuma turma encontrada</option>";
            }
            ?>

            <form method="get" action="" class="form">
                <div class="form-nome">
                    <label for="nome">Filtrar por nome:</label>
                    <input type="text" name="nome" id="nome" autofocus>
                </div>
                <div class="form-turma">
                    <!-- Campo de seleção preenchido dinamicamente -->
                    <label for="turma">Filtrar por turma:</label>
                    <select name="turma" id="turma">
                        <option value="">Selecione a turma</option>
                        <?php echo $optionsTurmas; ?>
                    </select>
                </div>

                <input type="submit" value="Pesquisar">
            </form>

            <div class="accordion-container">
                <?php
                echo $registros . " registro(s) encontrado(s).";

                print "<br><br>";

                while ($exibirProjetos = mysqli_fetch_array($consulta)) {
                    $id = $exibirProjetos[0];
                    $nome = $exibirProjetos[1];
                    $turma = $exibirProjetos[2];
                    $somaMedias = 0;
                    $numAvaliacoes = 0;

                    print "<div class='accordion' id='accordionExample'>";
                    print "<article class='accordion-item'>";
                    print "<h2 class='accordion-header' id='heading$id'>";
                    print "<button class='accordion-button' type='button' data-bs-toggle='collapse' data-bs-target='#collapse$id' aria-expanded='true' aria-controls='collapse$id'>";

                    print " <div class='conteudo-flex'>";
                    print " <span class='projeto'>Nome do Projeto: $nome</span>";
                    print " <span class='turma'>Turma: $turma</span>";
                  
                    print " </div>";

                    print "</button>";
                    print "</h2>";
                    print "  <div id='collapse$id' class='accordion-collapse collapse' aria-labelledby='heading$id' data-bs-parent='#accordionExample'>";
                    print "    <div class='accordion-body'>";

                    $queryAvaliacoes = "SELECT * FROM avaliacoes WHERE id_projeto = $id";
                    $consultaAvaliacoes = mysqli_query($conn, $queryAvaliacoes);

                    // Verifica se há avaliações retornadas pela consulta
                    if (mysqli_num_rows($consultaAvaliacoes) > 0) {
                        // Se houver avaliações, itera sobre elas e exibe na página
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

                            // Executar a consulta para obter o nome do docente
                            $query_docente = "SELECT `nome` FROM `docentes` WHERE `nif` LIKE '%" . $exibirAvaliacoes[2] . "%'";
                            $resultado_docente = mysqli_query($conn, $query_docente);
                            $linha_docente = mysqli_fetch_array($resultado_docente);
                            $nome_docente = $linha_docente['nome'];


                            print "<p><strong>Docente: </strong>$nome_docente</p>";
                            print "<p><strong>1° Critério:</strong> Avaliação Domínio do conteúdo apresentado  <strong>Nota:</strong> $criterio1</p>";
                            print "<p><strong>2° Critério:</strong> Relevância das Informações  <strong>Nota:</strong> $criterio2</p>";
                            print "<p><strong>3° Critério:</strong> Qualidade de recursos audiovisuais (slides) <strong>Nota:</strong> $criterio3</p>";
                            print "<p><strong>4° Critério:</strong> Conteúdo do vídeo (elevator pitch) <strong>Nota:</strong> $criterio4</p>";
                            print "<p><strong>5° Critério:</strong> Inovação <strong>Nota:</strong> $criterio5</p>";
                            print "<p><strong>6° Critério:</strong> Controle do tempo <strong>Nota:</strong> $criterio6</p>";
                            print "<p><strong>7° Critério:</strong> Aplicabilidade do Projeto <strong>Nota:</strong> $criterio7</p>";
                            print "<p><strong>8° Critério:</strong> Ideia como plano de projeto <strong>Nota:</strong> $criterio8</p>";
                            print "<p><strong>9° Critério:</strong> Observações: $observacoes</p>";

                            $notas = array($criterio1, $criterio2, $criterio3, $criterio4, $criterio5, $criterio6, $criterio7, $criterio8);
                            $media = number_format(array_sum($notas) / count($notas), 4) * 10;
                            $somaMedias += $media;
                            $numAvaliacoes++;

                            print "<p><strong>Média Avaliação: </strong>$media</p>";
                            print "<hr>";
                        }

                        $mediaFinal = number_format($somaMedias / $numAvaliacoes, 2);
                        print "<p><strong>Média Final                    Nota:</strong> $mediaFinal</p>";

                        print "<div class='alinharbotao'><button type='button' class='botaoPDF'><a href='exportar_pdf.php?id_projeto=$id'>Gerar PDF</a></button></div>";
                    } else {
                        // Se não houver avaliações, exibe uma mensagem indicando isso
                        print "<p style='text-align: center; font-weight: bold;
                        border-bottom-left-radius: 17px;
                        border-bottom-right-radius: 17px;'>Não há avaliações disponíveis para este projeto.</p>";
                    }

                    print "</div>";
                    print "</div>";
                    print "</div>";
                    print "</article>";
                }
                ?>
            </div>
        </section>
    </div>

    <script>
        $('.accordion-button').on('click', function() {
            // Fecha todos os outros painéis
            $('.collapse').collapse('hide');
            // Abre o painel clicado
            $(this).parent().next().removeClass('collapsed');
        });
    </script>

</body>

</html>