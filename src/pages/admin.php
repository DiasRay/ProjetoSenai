<?php
include_once('conexao.php');
session_start(); // Inicia a sessão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nif = $_POST["nif"];

    $verificarNIF = "SELECT nif FROM docentes WHERE nif = '$nif' AND perm = '1'";
    $result = $conn->query($verificarNIF);

    if ($result->num_rows > 0) {
        $_SESSION['nif'] = $nif; 
        echo "<script>window.location.href = 'homeAdmin.php'</script>";
    } else {
        unset($_SESSION['nif']);
        echo "<script>alert('Esse NIF não tem permissão para acessar')</script>";
    }
} ?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/autenticacao.css">
    <title>Acesso Administrador</title>
</head>

<body>

    <header>
        <div class="header-topo">
            <img class="logo" src="../images/SENAI_São_Paulo_logo.jpeg" alt="">
        </div>
    </header>

    <br>

    <section class="titulo_01">
        <h3>Autenticação Administrador</h3>
    </section>


    <br>
    
    <div class="seta">
        <a href="./../../index.php"><img class="seta-esquerda" src="../images/seta_esquerda.png"></a>
    </div>
    <br>
    
    <div class="caixa-cadastro">
        <form class="formulario" method="post" action="">
            <p class = "texto"> Insira o NIF de acesso:</p>
            <input type="text" name="nif" required>
            <div class="botao">
                <input type="submit" value="Verificar">
            </div>
         </form>
    </div>
</body>

</html>