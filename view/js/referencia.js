function adicionarFuncionario(idFuncionario, nome ) {
    document.getElementById('idFuncionario').value = idFuncionario;
    document.getElementById('nome').value = nome;

    // Altere o valor do campo "acao" para "atualizar"
    document.getElementById('acao').value = 'atualizar';
    
    console.log('idIngrediente:', idFuncionario);
    console.log('nome_ingrediente:', nome);
    
    // Adicione um evento de clique ao botão de salvar para chamar a função de atualização
    document.getElementById('btn-salvar-ingrediente').addEventListener('click', function (event) {
        event.preventDefault();
        atualizarIngrediente();
    });
}

// Adicione uma nova função para enviar a solicitação de atualização via AJAX
function atualizarIngrediente() {
    var idIngrediente = document.getElementById('idIngrediente').value;
    var nome_ingrediente = document.getElementById('nome_ingrediente').value;
    var descricao = document.getElementById('descricao').value;

    // Realize uma solicitação AJAX para o script PHP de atualização
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../../controller/referenciaControllerEditar.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
        }
    };
    // Envie os dados para o script PHP de atualização
    xhr.send('idIngrediente=' + idIngrediente + '&nome_ingrediente=' + nome_ingrediente + '&descricao=' + descricao);
}


document.addEventListener('DOMContentLoaded', function () {
    // Adicione um ouvinte de evento de clique ao documento
    document.addEventListener('click', function (event) {
        if (event.target && event.target.classList.contains('adicionar-restaurante')) {
            var nomeRestaurante = event.target.getAttribute('data-nome');
            var idRestaurante = event.target.getAttribute('data-id');

            // pegar o nome e o id do restaurante para o form depois de escolher o restaurante da na tabela
            document.querySelector('input[name="restaurante"]').value = nomeRestaurante;
            document.querySelector('input[name="idRestaurante"]').value = idRestaurante;

            
            // Exiba os valores no console para verificar
            console.log('Nome do Restaurante:', nomeRestaurante);
            console.log('ID do Restaurante:', idRestaurante);
        }
    });

    // Adicione um ouvinte de evento de clique ao documento
    document.addEventListener('click', function (event) {
        if (event.target && event.target.classList.contains('adicionar-funcionario')) {
            var nomeFuncionario= event.target.getAttribute('data-nome');
            var idFuncionario = event.target.getAttribute('data-id');

            // pegar o nome e o id do restaurante para o form depois de escolher o restaurante da na tabela
            document.querySelector('input[name="nome"]').value = nomeFuncionario;
            document.querySelector('input[name="idFuncionario"]').value = idFuncionario;

            console.log('Nome do Funcionario:', nomeFuncionario);
            console.log('ID do Funcionario:', idFuncionario);
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
        document.getElementById('form2').submit();
    });
});