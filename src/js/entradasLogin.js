document.getElementById("formulario").addEventListener('submit', function(event) {

    // Obter os valores dos campos do formulário
    let nomeProjeto = document.getElementById('nome-projeto').value;
    let turma = document.getElementById('turma').value;

    // Remover acentos e transformar em maiúsculas (para cada campo)
    nomeProjeto = nomeProjeto.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toUpperCase();
    turma = turma.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toUpperCase();

    // Remover espaços desnecessários (para cada campo)
    nomeProjeto = nomeProjeto.replace(/\s+/g, ' ').trim();
    turma = turma.replace(/\s+/g, ' ').trim();

    // Atualizar os valores dos campos do formulário com os valores tratados
    document.getElementById('nome-projeto').value = nomeProjeto;
    document.getElementById('turma').value = turma;

  });