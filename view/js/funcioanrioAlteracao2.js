var search = document.getElementById('pesquisarReferencia');

// quando pesquisar restaurante so atualizar a tabela nao a pagina
function searchData() {
    var searchTerm = search.value;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'pagePesquisaReferencia.php?search=' + searchTerm, true);

    xhr.onload = function () {
        if (xhr.status == 200) {
            // Atualize a tabela com os resultados da pesquisa
            var table1 = document.getElementById('table1');
            table1.querySelector('tbody').innerHTML = xhr.responseText;
        }
    };

    xhr.send();
}

document.addEventListener('DOMContentLoaded', function () {
    // Adicione um ouvinte de evento de clique ao documento
    document.addEventListener('click', function (event) {
        if (event.target && event.target.classList.contains('adicionar-restaurante')) {
            var nomeRestaurante = event.target.getAttribute('data-nome');
            var idRestaurante = event.target.getAttribute('data-id');

            var idFuncionario = document.getElementById('form2').getAttribute('data-idFuncionario');

            // pegar o nome e o id do restaurante para o form depois de escolher o restaurante da na tabela
            document.querySelector('input[name="restaurante"]').value = nomeRestaurante;
            document.querySelector('input[name="idRestaurante"]').value = idRestaurante;
            document.querySelector('input[name="idFuncionario"]').value = idFuncionario;

            // Exiba os valores no console para verificar
            console.log('Nome do Restaurante:', nomeRestaurante);
            console.log('ID do Restaurante:', idRestaurante);
            console.log('ID do idFuncionario:', idFuncionario);
        }
    });

    // Adicionar um ouvinte de evento para o envio do formulário
    document.getElementById('btn-salvar-restaurante').addEventListener('click', function (event) {
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


// formatar a data para retornar no input (YYYY/MM/DD)
function formatarDataParaInput(dataTabela) {
    // A variável dataTabela deve estar no formato "DD/MM/YYYY"
    var partesData = dataTabela.split('/'); // Divide a data em partes
    if (partesData.length === 3) {
        // Formate a data como "YYYY-MM-DD" para um campo de input do tipo date
        return partesData[2] + '-' + partesData[1] + '-' + partesData[0];
    }
    return ''; // Retorno vazio se o formato estiver incorreto
}

function editarRestaurante(idRestaurante, nome, dataInicio, dataFim) {
    document.getElementById('idRestaurante').value = idRestaurante;
    document.getElementById('restaurante').value = nome;
    document.getElementById('data_inicio').value = formatarDataParaInput(dataInicio);
    document.getElementById('data_fim').value = formatarDataParaInput(dataFim);

    // Altere o valor do campo "acao" para "atualizar"
    document.getElementById('acao').value = 'atualizar';

    // Adicione um evento de clique ao botão de salvar para chamar a função de atualização
    document.getElementById('btn-salvar-restaurante').addEventListener('click', function (event) {
        event.preventDefault();
        atualizarRestaurante();
    });
}

// Adicione uma nova função para enviar a solicitação de atualização via AJAX
function atualizarRestaurante() {
    var idRestaurante = document.getElementById('idRestaurante').value;
    var idFuncionario = document.getElementById('idFuncionario').value;
    var dataInicio = formatarDataParaInput(document.getElementById('data_inicio').value);
    var dataFim = formatarDataParaInput(document.getElementById('data_fim').value);

    // Realize uma solicitação AJAX para o script PHP de atualização
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../../controller/referenciaControlerEditar.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Lide com a resposta, se necessário
            console.log(xhr.responseText);
        }
    };
    // Envie os dados para o script PHP de atualização
    xhr.send('idFuncionario=' + idFuncionario + '&idRestaurante=' + idRestaurante + '&data_inicio=' + dataInicio + '&data_fim=' + dataFim);
}
