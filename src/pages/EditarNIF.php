<?php
include_once('conexao.php');

session_start();
if (!isset($_SESSION['nif'])) {
    unset($_SESSION['nif']);

    echo "<script>alert('Apenas funcionários com permissões podem acessar!');</script>";
    echo "<script>javascript:history.back()</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_docente = $_POST['id_docente'];
    $nifAtualizado = filter_var($_POST['nif'], FILTER_SANITIZE_NUMBER_INT);
    $docenteAtualizado = filter_var($_POST['nome'], FILTER_SANITIZE_STRING);
    $permAtualizado = $_POST['perm'];

    // Verificar se o novo NIF já existe no banco de dados, exceto para o registro atual
    $check_query = "SELECT id_docente from docentes WHERE nif = ? AND id_docente != ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("ii", $nifAtualizado, $id_docente);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        echo "<script>alert('O NIF já existe. Por favor, insira outro NIF.');</script>";
        echo "<script>javascript:history.back()</script>";
    } else {
        // Atualizar os dados do docente, exceto se for o mesmo NIF da sessão
        if ($_SESSION['nif'] != $nifAtualizado) {
            $update_query = "UPDATE docentes SET nif = ?, nome = ?, perm = ? WHERE id_docente = ?";
            $stmt = $conn->prepare($update_query);
            $stmt->bind_param("issi", $nifAtualizado, $docenteAtualizado, $permAtualizado, $id_docente);

            if ($stmt->execute()) {
                echo "<script>alert('Atualização realizada com sucesso!');</script><br>";
                echo "<script>window.location.href = 'homeAdmin.php';</script>";
            } else {
                echo "Erro ao atualizar os dados: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "<script>alert('Você não pode modificar sua própria permissão de admin.');</script>";
            echo "<script>javascript:history.back()</script>";
        }
    }

    $check_stmt->close();
} else if (isset($_GET["id_docente"]) && !empty($_GET["id_docente"])) {
    $id_docente = $_GET["id_docente"];
    $select_query = "SELECT * FROM docentes WHERE id_docente = ?";
    $stmt = $conn->prepare($select_query);
    $stmt->bind_param("i", $id_docente);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $docente = $result->fetch_assoc();
        $nif = $docente['nif'];
        $nome = $docente['nome'];
        $perm = $docente['perm'];
    } else {
        echo "<script>alert('Docente não encontrado.');</script>";
    }
} else {
    echo "<script>alert('Parâmetros ausentes.')</script>";
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Docente</title>
</head>
<body>
    <form action="" method="POST">
        <input type="hidden" name="id_docente" value="<?php echo $id_docente; ?>">

        <label for="nif">NIF:</label>
        <input type="text" name="nif" value="<?php echo $nif; ?>"><br>
        <label for="docente">Nome:</label>
        <input type="text" name="nome" value="<?php echo $nome; ?>"><br>
        <label for="perm">Permissão de Admin:</label>
        <select name="perm">
            <option value="1" <?php if ($perm == 1) echo 'selected'; ?>>Sim</option>
            <option value="0" <?php if ($perm == 0) echo 'selected'; ?>>Não</option>
        </select>

        <input type="submit" value="Atualizar">
        <br>
        <a href="homeAdmin.php" class="botao" id="btnVoltar">Voltar</a>
    </form>
</body>
</html>
