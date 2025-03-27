<?php
if(isset($_POST['avancar'])){
  include_once('./src/pages/conexao.php');

  $resultadoID="";
  $nif="";

  if(isset($_POST['professor']) && !empty($_POST['professor'])){
    if(isset($_POST['nome-projeto']) && !empty($_POST['nome-projeto'])){
      if (isset($_POST['turma']) && !empty($_POST['turma'])){

        $nome = $_POST['nome-projeto'];
        $turma = $_POST['turma'];
        $nif = $_POST['professor'];

        //Selecionar um projeto se tiver algum com o mesmo nome e turma informados
        $query = "SELECT * FROM `projetos` WHERE `nome`=? AND turma=?";
        $stmt = mysqli_prepare($conn, $query);

        mysqli_stmt_bind_param($stmt, "ss", $nome, $turma);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        
        $todosResultados = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
          $todosResultados[] = $row;
        }
          //Criar novo projeto
          if(empty($todosResultados)){
            
        } else{
          $queryID = "SELECT * FROM `projetos` WHERE `nome`=? AND turma=?";
          $stmtID = mysqli_prepare($conn, $queryID);

          mysqli_stmt_bind_param($stmtID, "ss", $nome, $turma);
          mysqli_stmt_execute($stmtID);

          $resultadoID = mysqli_fetch_assoc(mysqli_stmt_get_result($stmtID));

          header("Location: ./src/pages/validacao.php?id=".$resultadoID['id']."&nif=".$nif);
          mysqli_close($conn);
          exit;
        }
      }
    }
  }else{
    echo '<script type="text/javascript">';
    echo 'alert("Por favor, preencha todos os campos para poder avançar!");';
    echo '</script>';
  }
}

if(isset($_POST['consultar'])){

  $nome = $_POST['nome-projeto'];
  $turma = $_POST['turma'];

  header("Location:./src/pages/consulta.php?nome=".$nome."&turma=".$turma);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./src/css/reset.css">
    <link rel="stylesheet" href="./src/css/style.css">
    <link rel="stylesheet" href="./src/css/responsivo_pagina_inicial.css">

    <title>Avaliação de Projetos de TCC</title>

</head> 

<body>

  <div class="pagina-inicial">

    <div class="img">
        <img class="senai-fundo" src="./src/images/fundo-senai.png">
       
    </div>

      

    <div class="container">
      
      <div class="logo-senai">
          <img class="logo" src="./src/images/SENAI_São_Paulo_logo.png">
      </div>
      <div class="teste">
        <div class="caixa-cadastro">
            <h1 class="titulo">Avaliação de Projetos TCC</h1>
            
            <form id="formulario" action="" method="POST">
              <div class="campo">
                <label for="nome-projeto" class="nome-projeto">Nome do Projeto:</label>
                <input type="text" id="nome-projeto" name="nome-projeto">
              </div>

              <div class="campo">
                <label for="turma" class="turma-cadastro">Turma:</label>
                <input type="text" id="turma" name="turma">
              </div>

              <div class="campo">
                <label for="nif-professor" class="nif-professor">NIF Professor:</label>
                <input type="text" id="professor" name="professor">
              </div>
      
              <div class="botoes">
                <button type="submit" name="avancar" class="botao">Avançar</button>
                <button type="submit" name="consultar" class="botao">Consultar</button>
                  
                  <a href="./src/pages/admin.php"><button type="button" class="botao" id="admin">Admin</button></a>
                
              </div>  
            </form>
          </div>
  
      </div>
     
    </div>

  </div>
  
  <script src="./src/js/entradasLogin.js"></script>

</body>
</html>
