<?php

include_once('conexao.php');

$idProjeto = isset($_GET['id'])? $_GET['id'] : "";
$nifProf = isset($_GET['nif'])? $_GET['nif'] : "";

if(!empty($idProjeto) && !empty($nifProf)){
    // Executar uma consulta
    $query = "SELECT * FROM `docentes` WHERE `nif` LIKE '%$nifProf%'";
    $result = $conn->query($query);

    // Verificar se a consulta retornou resultados
    if ($result->num_rows > 0) {
        // Obter o valor como um array associativo
        $row = $result->fetch_assoc();
        
        $nif = (int) $row['nif'];
        $nome = $row['nome'];
        
        $query = "SELECT * FROM `avaliacoes` WHERE `nif_docente` LIKE '%$nif%' and `id_projeto` like '%$idProjeto%'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<script>alert('Professor ". $nome . ", você já avaliou esse projeto.');</script>";
            echo "<script>javascript:history.back()</script>"; 
        } else{
            header("Location: criterios.php?id=".$idProjeto."&nif=".$nif);
        }


    } else {
        echo "<script>alert('o NIF informado não existe');</script>";
        echo "<script>javascript:history.back()</script>";  
    }

    // Fechar a conexão
    $conn->close();

}


?>