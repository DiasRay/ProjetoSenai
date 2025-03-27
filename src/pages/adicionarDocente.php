<?php
    // Verifica se o formulario foi enviado
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $nif = $_POST["nif"];
        $docente = $_POST["nome"];
        $perm = $_POST['perm'];

        include_once('conexao.php');

        $check = "SELECT nif FROM docentes WHERE nif = '$nif'";
        $result = $conn->query($check);
        if($result->num_rows > 0) {
            echo "<script>alert('O NIF já está cadastrado em nosso sistema, insira outro')</script>";
        } else {
             // Prepara e executa a query de inserção
        $sql = "INSERT INTO docentes (nif, nome, perm) VALUES ('$nif', '$docente', '$perm')";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Dados inseridos com sucesso')</script>";
            } else {
                echo "Erro ao inserir dados: " . $conn->error;
            }
        }
        $conn->close();
    }
?>
<script>
    window.location.href = "homeAdmin.php";
</script> 