<?php

//Conexao com o banco de dados

$server = 'Localhost';
$username = 'root';
$password = '';
$dbname = 'avaliacao_tcc';

$conn = new mysqli($server, $username, $password, $dbname);

//Verificar conexao com o banco

if($conn->connect_error) {
    die ("Erro na conexão com o banco de dados: " . $conn->connect_error);
} 

?>