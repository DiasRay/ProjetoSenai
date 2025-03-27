<?php
include_once('conexao.php');

$idProjeto = $_GET['id'] ? $_GET['id'] : "";
$nifProf = $_GET['nif'] ? $_GET['nif'] : "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nota1 = strval($_POST['Criterio1']);
        $nota2 = strval($_POST['Criterio2']);
        $nota3 = strval($_POST['Criterio3']);
        $nota4 = strval($_POST['Criterio4']);
        $nota5 = strval($_POST['Criterio5']);
        $nota6 = strval($_POST['Criterio6']);
        $nota7 = strval($_POST['Criterio7']);
        $nota8 = strval($_POST['Criterio8']);
        $observacoes = $_POST['obs'];

        var_dump($nota1);

    if ($nota1 !== null && $nota2 !== null && $nota3 !== null && $nota4 !== null && $nota5 !== null && $nota6 !== null && $nota7 !== null && $nota8 !== null) {

        $nota1 = intval($_POST['Criterio1']);
        $nota2 = intval($_POST['Criterio2']);
        $nota3 = intval($_POST['Criterio3']);
        $nota4 = intval($_POST['Criterio4']);
        $nota5 = intval($_POST['Criterio5']);
        $nota6 = intval($_POST['Criterio6']);
        $nota7 = intval($_POST['Criterio7']);
        $nota8 = intval($_POST['Criterio8']);

        // Inserir a nota no banco de dados
        $insertQuery = "INSERT INTO `avaliacoes` (`id_projeto`, `nif_docente`, `criterio1`, `criterio2`, `criterio3`, `criterio4`, `criterio5`, `criterio6`, `criterio7`, `criterio8`, `observacoes`) VALUES ( ?, ? , ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $insertStmt = mysqli_prepare($conn, $insertQuery);

        if ($insertStmt === false) {
            die("Erro na preparação da consulta: " . mysqli_error($conn));
        }

        // Corrigir os tipos de dados nos parâmetros
        mysqli_stmt_bind_param($insertStmt, "ssiiiiiiiis", $idProjeto, $nifProf, $nota1, $nota2, $nota3, $nota4, $nota5, $nota6, $nota7, $nota8, $observacoes);

        $insertResult = mysqli_stmt_execute($insertStmt);

        if ($insertResult) {

            echo "<script>alert('Avaliação cadastrada com sucesso!!')</script>";
            echo "<script>window.location.href = './../../index.php'</script>";
        } else {
            die("Erro ao executar a consulta: " . mysqli_error($conn));
        }

        mysqli_stmt_close($insertStmt);
    } else {
        echo ("<script>
            alert('Por favor, insira todas as notas');
        </script>");
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Critérios de Avaliação</title>

    <link rel="stylesheet" href="../css/criterios.css">
    <link rel="stylesheet" href="../css/responsivo_pagina_criterio.css">

    <script>

    </script>


</head>

<body>
    <header>
        <div class="header-topo">
            <img class="logo" src="../images/SENAI_São_Paulo_logo.png" alt="">
        </div>
    </header>

    <br>

    <section class="titulo_01">
        <h3>Critérios de Avaliações</h3>
    </section>

    <div class="seta">
        <a href="../../index.php" target="_self"><img class="seta-esquerda" src="../images/seta_esquerda.png"></a>
    </div>

    <main>

        <section>

            <div class="container_retangulos">

                <form action="" method="post">

                    <div class="bloco">

                        <div class="retangulo A" id="primeiro">

                            <div class="criterio">
                                <h3>1. Avaliação Domínio do conteúdo apresentado:</h3>
                            </div>

                            <div class="nota">

                                <a href="#" onclick="AvaliarDominio(0)">
                                    <div class="quadradinho">0</div>
                                </a>
                                <a href="#" onclick="AvaliarDominio(1)">
                                    <div class="quadradinho">1</div>
                                </a>
                                <a href="#" onclick="AvaliarDominio(2)">
                                    <div class="quadradinho">2</div>
                                </a>
                                <a href="#" onclick="AvaliarDominio(3)">
                                    <div class="quadradinho">3</div>
                                </a>
                                <a href="#" onclick="AvaliarDominio(4)">
                                    <div class="quadradinho">4</div>
                                </a>
                                <a href="#" onclick="AvaliarDominio(5)">
                                    <div class="quadradinho">5</div>
                                </a>
                                <a href="#" onclick="AvaliarDominio(6)">
                                    <div class="quadradinho">6</div>
                                </a>
                                <a href="#" onclick="AvaliarDominio(7)">
                                    <div class="quadradinho">7</div>
                                </a>
                                <a href="#" onclick="AvaliarDominio(8)">
                                    <div class="quadradinho">8</div>
                                </a>
                                <a href="#" onclick="AvaliarDominio(9)">
                                    <div class="quadradinho">9</div>
                                </a>
                                <a href="#" onclick="AvaliarDominio(10)">
                                    <div class="quadradinho">10</div>
                                </a>

                            </div>


                            <input id="Criterio1" name="Criterio1" value="" hidden required></input>

                        </div>

                        <div class="retangulo B">

                            <div class="criterio">
                                <h3>2.Relevância das informações:</h3>
                            </div>

                            <div class="nota obrigat">

                                <a href="#" onclick="AvaliarRelevancia(0)">
                                    <div class="quadradinho2">0</div>
                                </a>
                                <a href="#" onclick="AvaliarRelevancia(1)">
                                    <div class="quadradinho2">1</div>
                                </a>
                                <a href="#" onclick="AvaliarRelevancia(2)">
                                    <div class="quadradinho2">2</div>
                                </a>
                                <a href="#" onclick="AvaliarRelevancia(3)">
                                    <div class="quadradinho2">3</div>
                                </a>
                                <a href="#" onclick="AvaliarRelevancia(4)">
                                    <div class="quadradinho2">4</div>
                                </a>
                                <a href="#" onclick="AvaliarRelevancia(5)">
                                    <div class="quadradinho2">5</div>
                                </a>
                                <a href="#" onclick="AvaliarRelevancia(6)">
                                    <div class="quadradinho2">6</div>
                                </a>
                                <a href="#" onclick="AvaliarRelevancia(7)">
                                    <div class="quadradinho2">7</div>
                                </a>
                                <a href="#" onclick="AvaliarRelevancia(8)">
                                    <div class="quadradinho2">8</div>
                                </a>
                                <a href="#" onclick="AvaliarRelevancia(9)">
                                    <div class="quadradinho2">9</div>
                                </a>
                                <a href="#" onclick="AvaliarRelevancia(10)">
                                    <div class="quadradinho2">10</div>
                                </a>

                            </div>

                            <input id="Criterio2" name="Criterio2" value="" hidden required></input>

                        </div>

                        <div class="retangulo A">
                            <div class="criterio">
                                <h3>3.Qualidade de recursos audiovisuais (slide):</h3>
                            </div>

                            <div class="nota">
                                <a href="#" onclick="AvaliarQualidade(0)">
                                    <div class="quadradinho3">0</div>
                                </a>
                                <a href="#" onclick="AvaliarQualidade(1)">
                                    <div class="quadradinho3">1</div>
                                </a>
                                <a href="#" onclick="AvaliarQualidade(2)">
                                    <div class="quadradinho3">2</div>
                                </a>
                                <a href="#" onclick="AvaliarQualidade(3)">
                                    <div class="quadradinho3">3</div>
                                </a>
                                <a href="#" onclick="AvaliarQualidade(4)">
                                    <div class="quadradinho3">4</div>
                                </a>
                                <a href="#" onclick="AvaliarQualidade(5)">
                                    <div class="quadradinho3">5</div>
                                </a>
                                <a href="#" onclick="AvaliarQualidade(6)">
                                    <div class="quadradinho3">6</div>
                                </a>
                                <a href="#" onclick="AvaliarQualidade(7)">
                                    <div class="quadradinho3">7</div>
                                </a>
                                <a href="#" onclick="AvaliarQualidade(8)">
                                    <div class="quadradinho3">8</div>
                                </a>
                                <a href="#" onclick="AvaliarQualidade(9)">
                                    <div class="quadradinho3">9</div>
                                </a>
                                <a href="#" onclick="AvaliarQualidade(10)">
                                    <div class="quadradinho3">10</div>
                                </a>

                            </div>

                            <input id="Criterio3" name="Criterio3" value="" hidden required></input>
                        </div>

                        <div class="retangulo B">
                            <div class="criterio">
                                <h3>4.Conteúdo do vídeo (elevator pitch):</h3>
                            </div>

                            <div class="nota">
                                <a href="#" onclick="AvaliarConteudo(0)">
                                    <div class="quadradinho4">0</div>
                                </a>
                                <a href="#" onclick="AvaliarConteudo(1)">
                                    <div class="quadradinho4">1</div>
                                </a>
                                <a href="#" onclick="AvaliarConteudo(2)">
                                    <div class="quadradinho4">2</div>
                                </a>
                                <a href="#" onclick="AvaliarConteudo(3)">
                                    <div class="quadradinho4">3</div>
                                </a>
                                <a href="#" onclick="AvaliarConteudo(4)">
                                    <div class="quadradinho4">4</div>
                                </a>
                                <a href="#" onclick="AvaliarConteudo(5)">
                                    <div class="quadradinho4">5</div>
                                </a>
                                <a href="#" onclick="AvaliarConteudo(6)">
                                    <div class="quadradinho4">6</div>
                                </a>
                                <a href="#" onclick="AvaliarConteudo(7)">
                                    <div class="quadradinho4">7</div>
                                </a>
                                <a href="#" onclick="AvaliarConteudo(8)">
                                    <div class="quadradinho4">8</div>
                                </a>
                                <a href="#" onclick="AvaliarConteudo(9)">
                                    <div class="quadradinho4">9</div>
                                </a>
                                <a href="#" onclick="AvaliarConteudo(10)">
                                    <div class="quadradinho4">10</div>
                                </a>
                            </div>

                            <input id="Criterio4" name="Criterio4" value="" hidden required></input>
                        </div>

                        <div class="retangulo A" id="segundo">
                            <div class="criterio">
                                <h3>5.Inovação:</h3>
                            </div>

                            <div class="nota">
                                <a href="#" onclick="AvaliarInovacao(0)">
                                    <div class="quadradinho5">0</div>
                                </a>
                                <a href="#" onclick="AvaliarInovacao(1)">
                                    <div class="quadradinho5">1</div>
                                </a>
                                <a href="#" onclick="AvaliarInovacao(2)">
                                    <div class="quadradinho5">2</div>
                                </a>
                                <a href="#" onclick="AvaliarInovacao(3)">
                                    <div class="quadradinho5">3</div>
                                </a>
                                <a href="#" onclick="AvaliarInovacao(4)">
                                    <div class="quadradinho5">4</div>
                                </a>
                                <a href="#" onclick="AvaliarInovacao(5)">
                                    <div class="quadradinho5">5</div>
                                </a>
                                <a href="#" onclick="AvaliarInovacao(6)">
                                    <div class="quadradinho5">6</div>
                                </a>
                                <a href="#" onclick="AvaliarInovacao(7)">
                                    <div class="quadradinho5">7</div>
                                </a>
                                <a href="#" onclick="AvaliarInovacao(8)">
                                    <div class="quadradinho5">8</div>
                                </a>
                                <a href="#" onclick="AvaliarInovacao(9)">
                                    <div class="quadradinho5">9</div>
                                </a>
                                <a href="#" onclick="AvaliarInovacao(10)">
                                    <div class="quadradinho5">10</div>
                                </a>
                            </div>
                            <input id="Criterio5" name="Criterio5" value="" hidden required></input>
                        </div>
                    </div>

                    <div class="bloco_2">

                        <div class="retangulo A" id=primeiro>
                            <div class="criterio">
                                <h3>6.Controle do tempo:</h3>
                            </div>

                            <div class="nota">
                                <a href="#" onclick="AvaliarControle(0)">
                                    <div class="quadradinho6">0</div>
                                </a>
                                <a href="#" onclick="AvaliarControle(1)">
                                    <div class="quadradinho6">1</div>
                                </a>
                                <a href="#" onclick="AvaliarControle(2)">
                                    <div class="quadradinho6">2</div>
                                </a>
                                <a href="#" onclick="AvaliarControle(3)">
                                    <div class="quadradinho6">3</div>
                                </a>
                                <a href="#" onclick="AvaliarControle(4)">
                                    <div class="quadradinho6">4</div>
                                </a>
                                <a href="#" onclick="AvaliarControle(5)">
                                    <div class="quadradinho6">5</div>
                                </a>
                                <a href="#" onclick="AvaliarControle(6)">
                                    <div class="quadradinho6">6</div>
                                </a>
                                <a href="#" onclick="AvaliarControle(7)">
                                    <div class="quadradinho6">7</div>
                                </a>
                                <a href="#" onclick="AvaliarControle(8)">
                                    <div class="quadradinho6">8</div>
                                </a>
                                <a href="#" onclick="AvaliarControle(9)">
                                    <div class="quadradinho6">9</div>
                                </a>
                                <a href="#" onclick="AvaliarControle(10)">
                                    <div class="quadradinho6">10</div>
                                </a>
                            </div>

                            <input id="Criterio6" name="Criterio6" value="" hidden required></input>
                        </div>

                        <div class="retangulo B">
                            <div class="criterio">
                                <h3>7.Aplicabilidade do projeto:</h3>
                            </div>

                            <div class="nota">
                                <a href="#" onclick="AvaliarAplicabilidade(0)">
                                    <div class="quadradinho7">0</div>
                                </a>
                                <a href="#" onclick="AvaliarAplicabilidade(1)">
                                    <div class="quadradinho7">1</div>
                                </a>
                                <a href="#" onclick="AvaliarAplicabilidade(2)">
                                    <div class="quadradinho7">2</div>
                                </a>
                                <a href="#" onclick="AvaliarAplicabilidade(3)">
                                    <div class="quadradinho7">3</div>
                                </a>
                                <a href="#" onclick="AvaliarAplicabilidade(4)">
                                    <div class="quadradinho7">4</div>
                                </a>
                                <a href="#" onclick="AvaliarAplicabilidade(5)">
                                    <div class="quadradinho7">5</div>
                                </a>
                                <a href="#" onclick="AvaliarAplicabilidade(6)">
                                    <div class="quadradinho7">6</div>
                                </a>
                                <a href="#" onclick="AvaliarAplicabilidade(7)">
                                    <div class="quadradinho7">7</div>
                                </a>
                                <a href="#" onclick="AvaliarAplicabilidade(8)">
                                    <div class="quadradinho7">8</div>
                                </a>
                                <a href="#" onclick="AvaliarAplicabilidade(9)">
                                    <div class="quadradinho7">9</div>
                                </a>
                                <a href="#" onclick="AvaliarAplicabilidade(10)">
                                    <div class="quadradinho7">10</div>
                                </a>
                            </div>
                            <input id="Criterio7" name="Criterio7" value="" hidden required></input>
                        </div>

                        <div class="retangulo A">
                            <div class="criterio">
                                <h3>8.Ideia como plano de negócio:</h3>
                            </div>

                            <div class="nota">
                                <a href="#" onclick="AvaliarIdeia(0)">
                                    <div class="quadradinho8">0</div>
                                </a>
                                <a href="#" onclick="AvaliarIdeia(1)">
                                    <div class="quadradinho8">1</div>
                                </a>
                                <a href="#" onclick="AvaliarIdeia(2)">
                                    <div class="quadradinho8">2</div>
                                </a>
                                <a href="#" onclick="AvaliarIdeia(3)">
                                    <div class="quadradinho8">3</div>
                                </a>
                                <a href="#" onclick="AvaliarIdeia(4)">
                                    <div class="quadradinho8">4</div>
                                </a>
                                <a href="#" onclick="AvaliarIdeia(5)">
                                    <div class="quadradinho8">5</div>
                                </a>
                                <a href="#" onclick="AvaliarIdeia(6)">
                                    <div class="quadradinho8">6</div>
                                </a>
                                <a href="#" onclick="AvaliarIdeia(7)">
                                    <div class="quadradinho8">7</div>
                                </a>
                                <a href="#" onclick="AvaliarIdeia(8)">
                                    <div class="quadradinho8">8</div>
                                </a>
                                <a href="#" onclick="AvaliarIdeia(9)">
                                    <div class="quadradinho8">9</div>
                                </a>
                                <a href="#" onclick="AvaliarIdeia(10)">
                                    <div class="quadradinho8">10</div>
                                </a>
                            </div>

                            <input id="Criterio8" name="Criterio8" value="" hidden required></input>
                        </div>

                        <div class="retangulo B" id="segundo">
                            <div class="criterio">

                                <label>9.Observações:</label>
                            </div>

                            <div class="caixa_observacao">
                                <textarea type="text" id="obs" name="obs" class="search_text" placeholder="Comente aqui..." rows="4" cols="50"></textarea>
                            </div>
                        </div>
                    </div>

            </div>

            <div class="botoes">
                <button type="submit" class="botao-salvar">Salvar</button>
                <button type="reset" class="botao-apagar" onclick="ResetarFormulario()">Apagar</button>
            </div>


            </form>

        </section>

    </main>

    <script>
        window.onload(iniciarVariaveis());

        function iniciarVariaveis() {
            document.getElementById('Criterio1').value = '';
            document.getElementById('Criterio2').value = '';
            document.getElementById('Criterio3').value = '';
            document.getElementById('Criterio4').value = '';
            document.getElementById('Criterio5').value = '';
            document.getElementById('Criterio6').value = '';
            document.getElementById('Criterio7').value = '';
            document.getElementById('Criterio8').value = '';
            document.getElementById('nome_docente').value = '';
        }

        function AvaliarDominio(notaSelec) {
            const inputCriterio1 = document.getElementById('Criterio1');
            const stars = document.querySelectorAll('.quadradinho');
            let avaliacao = notaSelec;
            console.log(avaliacao);

            for (let i = 0; i <= 10; i++) {
                if (i === notaSelec) {
                    stars[i].classList.toggle('active');
                    avaliacao = notaSelec;
                } else {
                    stars[i].classList.remove('active');
                }
            }
            
            inputCriterio1.value = avaliacao;
        }



        function AvaliarRelevancia(notaSelec) {
            const inputCriterio2 = document.getElementById('Criterio2');
            const stars = document.querySelectorAll('.quadradinho2');
            let avaliacao = notaSelec;
            console.log(avaliacao);

            for (let i = 0; i <= 10; i++) {
                if (i === notaSelec) {
                    stars[i].classList.toggle('active');
                    avaliacao = notaSelec;
                } else {
                    stars[i].classList.remove('active');
                }
            }

            // Atualiza o valor do campo hidden
            inputCriterio2.value = avaliacao;
        }

        function AvaliarQualidade(notaSelec) {
            const inputCriterio3 = document.getElementById('Criterio3');
            const stars = document.querySelectorAll('.quadradinho3');
            let avaliacao = notaSelec;
            console.log(avaliacao);

            for (let i = 0; i <= 10; i++) {
                if (i === notaSelec) {
                    stars[i].classList.toggle('active');
                    avaliacao = notaSelec;
                } else {
                    stars[i].classList.remove('active');
                }
            }

            // Atualiza o valor do campo hidden
            inputCriterio3.value = avaliacao;
        }

        function AvaliarConteudo(notaSelec) {
            const inputCriterio4 = document.getElementById('Criterio4');
            const stars = document.querySelectorAll('.quadradinho4');
            let avaliacao = notaSelec;
            console.log(avaliacao);

            for (let i = 0; i <= 10; i++) {
                if (i === notaSelec) {
                    stars[i].classList.toggle('active');
                    avaliacao = notaSelec;
                } else {
                    stars[i].classList.remove('active');
                }
            }

            // Atualiza o valor do campo hidden
            inputCriterio4.value = avaliacao;
        }

        function AvaliarInovacao(notaSelec) {
            const inputCriterio5 = document.getElementById('Criterio5');
            const stars = document.querySelectorAll('.quadradinho5');
            let avaliacao = notaSelec;
            console.log(avaliacao);

            for (let i = 0; i <= 10; i++) {
                if (i === notaSelec) {
                    stars[i].classList.toggle('active');
                    avaliacao = notaSelec;
                } else {
                    stars[i].classList.remove('active');
                }
            }

            // Atualiza o valor do campo hidden
            inputCriterio5.value = avaliacao;
        }

        function AvaliarControle(notaSelec) {
            const inputCriterio6 = document.getElementById('Criterio6');
            const stars = document.querySelectorAll('.quadradinho6');
            let avaliacao = notaSelec;
            console.log(avaliacao);

            for (let i = 0; i <= 10; i++) {
                if (i === notaSelec) {
                    stars[i].classList.toggle('active');
                    avaliacao = notaSelec;
                } else {
                    stars[i].classList.remove('active');
                }
            }

            // Atualiza o valor do campo hidden
            inputCriterio6.value = avaliacao;
        }

        function AvaliarAplicabilidade(notaSelec) {
            const inputCriterio7 = document.getElementById('Criterio7');
            const stars = document.querySelectorAll('.quadradinho7');
            let avaliacao = notaSelec;
            console.log(avaliacao);

            for (let i = 0; i <= 10; i++) {
                if (i === notaSelec) {
                    stars[i].classList.toggle('active');
                    avaliacao = notaSelec;
                } else {
                    stars[i].classList.remove('active');
                }
            }

            // Atualiza o valor do campo hidden
            inputCriterio7.value = avaliacao;
        }

        function AvaliarIdeia(notaSelec) {
            const inputCriterio8 = document.getElementById('Criterio8');
            const stars = document.querySelectorAll('.quadradinho8');
            let avaliacao = notaSelec;
            console.log(avaliacao);

            for (let i = 0; i <= 10; i++) {
                if (i === notaSelec) {
                    stars[i].classList.toggle('active');
                    avaliacao = notaSelec;
                } else {
                    stars[i].classList.remove('active');
                }
            }

            // Atualiza o valor do campo hidden
            inputCriterio8.value = avaliacao;
        }

        function Valida() {
            if (document.getElementById('Criterio1').value != '' && document.getElementById('Criterio2').value != '' && document.getElementById('Criterio3').value != '' && document.getElementById('Criterio4').value != '' && document.getElementById('Criterio5').value != '' && document.getElementById('Criterio6').value != '' && document.getElementById('Criterio7').value != '' && document.getElementById('Criterio8').value != '' && document.getElementById('nome_docente').value != '') {

            } else {
                alert("Informe todas as notas.");
            }


        }

        function ResetarFormulario() {
            const stars = document.querySelectorAll('.quadradinho, .quadradinho2, .quadradinho3, .quadradinho4, .quadradinho5, .quadradinho6, .quadradinho7, .quadradinho8');

            // Remover a classe 'active' de todos os quadradinhos
            stars.forEach(star => star.classList.remove('active'));

            // Resetar a nota para 0
            document.getElementById('Criterio1').value = '';
            document.getElementById('Criterio2').value = '';
            document.getElementById('Criterio3').value = '';
            document.getElementById('Criterio4').value = '';
            document.getElementById('Criterio5').value = '';
            document.getElementById('Criterio6').value = '';
            document.getElementById('Criterio7').value = '';
            document.getElementById('Criterio8').value = '';
        }

    </script>
</body>

</html>