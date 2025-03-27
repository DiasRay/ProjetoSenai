<?php
include_once('conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["excluir_registros"]) && isset($_POST["excluir"])) {
    $excluir = $_POST["excluir"];

    foreach ($excluir as $deletarNIF) {
        $sql = "DELETE FROM docentes WHERE nif = '$deletarNIF'";
        if ($conn->query($sql) !== TRUE) {
            echo "Erro ao excluir o NIF $deletarNIF: " . $conn->error;
        }
    }

    echo "<script>alert('Docente excluido com sucesso');</script>";
   
} else {
    echo "<script>alert('Nenhum usuario foi selecionado para exclusão.');</script>";
}

$conn->close();
?>
 <script>window.location.href = "homeAdmin.php";</script>