<?php
include_once('conexao.php');
session_start();
if (!isset($_SESSION['nif'])) {
    unset($_SESSION['nif']);

    echo "<script>alert('Apenas funcionários com permissões podem acessar!');</script>";
    echo "<script>javascript: history.back()</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/registros.css">


    <title>Registros de NIF</title>
</head>

<body>

    <header>
        <div class="header-topo">
            <img class="logo" src="../images/SENAI_São_Paulo_logo.png" alt="">
        </div>
    </header>

    <br>

    <section class="titulo_01">
        <h3>Registros de NIF</h3>
    </section>


    <br>

    <div class="seta">
        <a href="./../../index.php"><img class="seta-esquerda" src="../images/seta_esquerda.png"></a>
    </div>
    <br>

    <table>
        <thead>
            <tr>
                <th>NIFs</th>
                <th>Docentes</th>
                <th>Permissão de Administrador</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
                    $sql = "SELECT * FROM docentes";
                    $resultado_registro = $conn->query($sql);

                    if ($resultado_registro->num_rows > 0) {
                        while ($row_registro = mysqli_fetch_assoc($resultado_registro)) {
                            echo "<tr>";
                            echo "<td hidden>" . $row_registro['id_docente'] . "</td>";
                            echo "<td>" . $row_registro['nif'] . "</td>";
                            echo "<td>" . $row_registro['nome'] . "</td>";
                            echo "<td>" . ($row_registro['perm'] == 1 ? 'Sim' : 'Não') . "</td>";
                            echo "<td><a href='EditarNIF.php?id_docente=" . $row_registro['id_docente'] . "'>Editar</a></td>";
                            echo "</tr>";
                        }
                    }
                    ?>
        </tbody>
    </table>
    
    <div class="button-container">
        <a href="AdicionarNIF.php">Adicionar</a>
        <!-- <a href="DeletarDocente.php">Excluir</a> -->
    </div>
</body>

</html>