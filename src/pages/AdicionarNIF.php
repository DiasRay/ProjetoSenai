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
    <link rel="stylesheet" href="../css/AdicionarNif.css">
    <title>Adicionar docente</title>
</head>
<body>
    <form action="adicionarDocente.php" method="POST">
        <label for="nif">NIF:</label>
        <input type="text" name="nif">
        <br>
        <label for="nome">Docente:</label><br>
        <input type="text" name="nome">
        <br>
        <label>Permissão de Admin</label><br>
        <select name="perm">
            <option value="1">Sim</option>
            <option value="0">Não</option>
        </select>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>