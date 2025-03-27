document.addEventListener('DOMContentLoaded', function(){
    var quadradinhos = document.querySelectorAll('.quadradinho');

    quadradinhos.forEach(function(quadradinho){
        quadradinho.addEventListener('click', function(){
            var criterio = this.closest('.retangulo'); // Encontra o critério atual

            var quadradosDoCriterio = criterio.querySelectorAll('.quadradinho');

            quadradosDoCriterio.forEach(function(quadradinhoDoCriterio) {
                if (quadradinhoDoCriterio !== quadradinho) {
                    quadradinhoDoCriterio.classList.remove('active');
                }
            });

            if (!this.classList.contains('active')) {
                // Se o quadradinho não tem a classe 'active', adiciona
                this.classList.add('active');
            } else {
                // Se o quadradinho já tem a classe 'active', remove
                this.classList.remove('active');
            }

            console.log('Valores selecionados:', getSelectedValues());
        });
    });

    function getSelectedValues() {
        var selectedValues = [];
        quadradinhos.forEach(function(quadradinho) {
            if (quadradinho.classList.contains('active')) {
                selectedValues.push(quadradinho.textContent.trim());
            }
        });

        if(selectedValues < 8){
            alert("Avalie todos os critérios!")
        } else{
        return selectedValues;
        }
    }
});