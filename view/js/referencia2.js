document.addEventListener('DOMContentLoaded', function () {
    // Adicione um ouvinte de evento de clique ao documento
    document.addEventListener('click', function (event) {
        if (event.target && event.target.classList.contains('adicionar-restaurante')) {
            var nomeRestaurante = event.target.getAttribute('data-nome');
            var idRestaurante = event.target.getAttribute('data-idR');

            // pegar o nome e o id do restaurante para o form depois de escolher o restaurante da na tabela
            document.querySelector('input[name="restaurante"]').value = nomeRestaurante;
            document.querySelector('input[name="idRestaurante"]').value = idRestaurante;

            // Exiba os valores no console para verificar
            console.log('Nome do Restaurante:', nomeRestaurante);
            console.log('ID do Restaurante:', idRestaurante);
        }
    });

    document.addEventListener('click', function (event) {
        if (event.target && event.target.classList.contains('adicionar-funcionario')) {
            var nome = event.target.getAttribute('data-nome');
            var idFuncionario = event.target.getAttribute('data-id');

            document.querySelector('input[name="nome"]').value = nome;
            document.querySelector('input[name="idFuncionario"]').value = idFuncionario;

            // Exiba os valores no console para verificar
            console.log('Nome:', nome);
            console.log('ID do idFuncionario:', idFuncionario);
        }
    });

    // Adicionar um ouvinte de evento para o envio do formulário
    document.getElementById('btn-salvar-referencia').addEventListener('click', function (event) {
        event.preventDefault(); // Impedir o envio padrão do formulário

        // Obter os valores dos campos não preenchidos com JavaScript
        var dataInicio = document.getElementById('data_inicio').value;
        var dataFim = document.getElementById('data_fim').value;

        // Adicionar os valores aos campos ocultos do formulário
        document.querySelector('input[name="data_inicio"]').value = dataInicio;
        document.querySelector('input[name="data_fim"]').value = dataFim;

        // Exiba os valores no console para verificar
        console.log('i', dataInicio);
        console.log('f:', dataInicio);

        // Enviar o formulário
        document.getElementById('form').submit();
    });
});

