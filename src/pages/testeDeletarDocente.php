<?php
session_start();
if (!isset($_SESSION['nif'])) {
    unset($_SESSION['nif']);

    echo "<script>alert('Apenas funcionários com permissões podem acessar!');</script>";
    echo "<script>javascript:history.back()</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
 <form method="post" action="../../deletarDocente.php">
                        <table border="1">
                            <thead>
                                <tr>
                                    <th>NIF</th>
                                    <th>NOME</th>
                                    <th>Deletar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include_once('../../conexao.php');

                                $sql = "SELECT * FROM docentes";
                                $resultado_registro = $conn->query($sql);


                                    while ($row_registro = mysqli_fetch_assoc($resultado_registro)) {
                                        echo "<tr>";
                                        echo "<td>" . $row_registro['nif'] . "</td>";
                                        echo "<td>" . $row_registro['nome'] . "</td>";
                                        echo "<td>";
                                        echo "<p>";
                                        echo "<input type='checkbox' name='excluir[]' value='" . $row_registro['nif'] . "' >";
                                        echo "</p>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                </table>
                <button class="botao" type="submit" name="excluir_registros" id="btnExcluir">Excluir</button>
            <a href="testeRegistro.php" class="botao" id="btnVoltar">Voltar</a>
 </form>
</body>
</html>