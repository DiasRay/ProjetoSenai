function iniciarVariaveis(){
    document.getElementById('Criterio1').value = '';
    document.getElementById('Criterio2').value = '';
    document.getElementById('Criterio3').value = '';
    document.getElementById('Criterio4').value = '';
    document.getElementById('Criterio5').value = '';
    document.getElementById('Criterio6').value = '';
    document.getElementById('Criterio7').value = '';
    document.getElementById('Criterio8').value = '';
    document.getElementById('nome_docente').value = '';
    
}

function AvaliarDominio(notaSelec) {
    const inputCriterio1 = document.getElementById('Criterio1');
    const stars = document.querySelectorAll('.quadradinho');
    let avaliacao = 0;
    
    for (let i = 0; i <= 10; i++) {
        if (i === notaSelec) {
            stars[i].classList.toggle('active');
            avaliacao = notaSelec;
        } else {
            stars[i].classList.remove('active');
        }
    }

    // Atualiza o valor do campo hidden
    inputCriterio1.value = avaliacao;
}

function AvaliarRelevancia(notaSelec) {
    const inputCriterio2 = document.getElementById('Criterio2');
    const stars = document.querySelectorAll('.quadradinho2');
    let avaliacao = 0;

    for (let i = 0; i <= 10; i++) {
        if (i === notaSelec) {
            stars[i].classList.toggle('active');
            avaliacao = notaSelec;
        } else {
            stars[i].classList.remove('active');
        }
    }

    // Atualiza o valor do campo hidden
    inputCriterio2.value = avaliacao;
}

function AvaliarQualidade(notaSelec) {
    const inputCriterio3 = document.getElementById('Criterio3');
    const stars = document.querySelectorAll('.quadradinho3');
    let avaliacao = 0;

    for (let i = 0; i <= 10; i++) {
        if (i === notaSelec) {
            stars[i].classList.toggle('active');
            avaliacao = notaSelec;
        } else {
            stars[i].classList.remove('active');
        }
    }

    // Atualiza o valor do campo hidden
    inputCriterio3.value = avaliacao;
}

function AvaliarConteudo(notaSelec) {
    const inputCriterio4 = document.getElementById('Criterio4');
    const stars = document.querySelectorAll('.quadradinho4');
    let avaliacao = 0;

    for (let i = 0; i <= 10; i++) {
        if (i === notaSelec) {
            stars[i].classList.toggle('active');
            avaliacao = notaSelec;
        } else {
            stars[i].classList.remove('active');
        }
    }

    // Atualiza o valor do campo hidden
    inputCriterio4.value = avaliacao;
}

function AvaliarInovacao(notaSelec) {
    const inputCriterio5 = document.getElementById('Criterio5');
    const stars = document.querySelectorAll('.quadradinho5');
    let avaliacao = 0;

    for (let i = 0; i <= 10; i++) {
        if (i === notaSelec) {
            stars[i].classList.toggle('active');
            avaliacao = notaSelec;
        } else {
            stars[i].classList.remove('active');
        }
    }

    // Atualiza o valor do campo hidden
    inputCriterio5.value = avaliacao;
}

function AvaliarControle(notaSelec) {
    const inputCriterio6 = document.getElementById('Criterio6');
    const stars = document.querySelectorAll('.quadradinho6');
    let avaliacao = 0;

    for (let i = 0; i <= 10; i++) {
        if (i === notaSelec) {
            stars[i].classList.toggle('active');
            avaliacao = notaSelec;
        } else {
            stars[i].classList.remove('active');
        }
    }

    // Atualiza o valor do campo hidden
    inputCriterio6.value = avaliacao;
}

function AvaliarAplicabilidade(notaSelec) {
    const inputCriterio7 = document.getElementById('Criterio7');
    const stars = document.querySelectorAll('.quadradinho7');
    let avaliacao = 0;

    for (let i = 0; i <= 10; i++) {
        if (i === notaSelec) {
            stars[i].classList.toggle('active');
            avaliacao = notaSelec;
        } else {
            stars[i].classList.remove('active');
        }
    }

    // Atualiza o valor do campo hidden
    inputCriterio7.value = avaliacao;
}

function AvaliarIdeia(notaSelec) {
    const inputCriterio8 = document.getElementById('Criterio8');
    const stars = document.querySelectorAll('.quadradinho8');
    let avaliacao = 0;

    for (let i = 0; i <= 10; i++) {
        if (i === notaSelec) {
            stars[i].classList.toggle('active');
            avaliacao = notaSelec;
        } else {
            stars[i].classList.remove('active');
        }
    }

    // Atualiza o valor do campo hidden
    inputCriterio8.value = avaliacao;
}

function Valida(){
    if(document.getElementById('Criterio1').value != '' && document.getElementById('Criterio2').value != '' && document.getElementById('Criterio3').value != '' && document.getElementById('Criterio4').value != '' && document.getElementById('Criterio5').value != '' && document.getElementById('Criterio6').value != '' && document.getElementById('Criterio7').value != '' && document.getElementById('Criterio8').value != '' && document.getElementById('nome_docente').value != '')
    {
        
    } else{
        alert("Informe todas as notas.");
    }

    
}

function ResetarFormulario() {
    const stars = document.querySelectorAll('.quadradinho, .quadradinho2, .quadradinho3, .quadradinho4, .quadradinho5, .quadradinho6, .quadradinho7, .quadradinho8');

    // Remover a classe 'active' de todos os quadradinhos
    stars.forEach(star => star.classList.remove('active'));

    // Resetar a nota para 0
    document.getElementById('Criterio1').value = '';
    document.getElementById('Criterio2').value = '';
    document.getElementById('Criterio3').value = '';
    document.getElementById('Criterio4').value = '';
    document.getElementById('Criterio5').value = '';
    document.getElementById('Criterio6').value = '';
    document.getElementById('Criterio7').value = '';
    document.getElementById('Criterio8').value = '';
}