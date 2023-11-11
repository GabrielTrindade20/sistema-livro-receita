var search = document.getElementById('pesquisarReferencia');
var indiceEditando = -1;

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

// formatar data para DD/MM/YYYY
function formatarData(data) {
    var dataPartes = data.split('-'); // Divide a data em ano, mês e dia
    return dataPartes[2] + '/' + dataPartes[1] + '/' + dataPartes[0]; // Formato: DD/MM/YYYY
}

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

// pegar nome e id de restaurante e colocar no form
document.addEventListener('DOMContentLoaded', function () {
    // Adicione um ouvinte de evento de clique ao documento
    document.addEventListener('click', function (event) {
        if (event.target && event.target.classList.contains('adicionar-restaurante')) {
            var nomeRestaurante = event.target.getAttribute('data-nome');
            var idRestaurante = event.target.getAttribute('data-id');

            // Agora você tem o nome e o id do restaurante
            document.querySelector('input[name="restaurante"]').value = nomeRestaurante;
            document.querySelector('input[name="idRestaurante"]').value = idRestaurante;

            // Exiba os valores no console para verificar
            console.log('Nome do Restaurante:', nomeRestaurante);
            console.log('ID do Restaurante:', idRestaurante);
        }
    });
});

// adicionar um novo ou editado cadastrado
function adicionarRestaurante(event) {
    event.preventDefault(); // Evita a recarga da página

    var idFuncionario = document.getElementById('idFuncionario').value;
    var idRestaurante = document.getElementById('idRestaurante').value;
    var restaurante = document.getElementById('restaurante').value;
    var dataInicio = formatarData(document.getElementById('data_inicio').value);
    var dataFim = formatarData(document.getElementById('data_fim').value);

    var table2 = document.getElementById('table2');

    // Se um registro estiver sendo editado, atualize a linha existente
    if (indiceEditando !== -1) {
        var row = table2.rows[indiceEditando];
        row.cells[0].innerHTML = idFuncionario;
        row.cells[1].innerHTML = idRestaurante;
        row.cells[2].innerHTML = restaurante;
        row.cells[3].innerHTML = dataInicio;
        row.cells[4].innerHTML = dataFim;

        // Reinicie o índice de edição
        indiceEditando = -1;
    } else {
        // Caso contrário, adicione uma nova linha
        var newRow = table2.insertRow(-1); // Insere a linha no final da tabela
        newRow.setAttribute('data-new-row', 'true');  // Adiciona o atributo indicando uma nova linha

        var cells = [];
        for (var i = 0; i < 7; i++) {
            cells[i] = newRow.insertCell(i);
        }

        cells[0].innerHTML = idFuncionario;
        cells[1].innerHTML = idRestaurante;
        cells[2].innerHTML = restaurante;
        cells[3].innerHTML = dataInicio;
        cells[4].innerHTML = dataFim;
        cells[5].innerHTML = '<button class="remover-restaurante" data-nome="' + restaurante + '"  data-id="' + idRestaurante + '" >Remover</button>';
        cells[6].innerHTML = '<button class="editar-restaurante" data-nome="' + restaurante + '"  data-id="' + idRestaurante + '" data-idfuncionario="' + idFuncionario + '" >Editar</button>';
    }

    // Limpe os campos do formulário
    document.getElementById('idRestaurante').value = '';
    document.getElementById('restaurante').value = '';
    document.getElementById('data_inicio').value = '';
    document.getElementById('data_fim').value = '';

    return false;
}

// remover linha
document.addEventListener('click', function (event) {
    if (event.target && event.target.classList.contains('remover-restaurante')) {
        var nomeRestaurante = event.target.getAttribute('data-nome');
        var idLinha = event.target.getAttribute('data-id'); // Recupere o valor do atributo "data-id" para identificar a linha

        // Encontre a linha que está sendo editada com base no "idLinha"
        var linhaEditada = document.querySelector('tr[data-id="' + idLinha + '"]');

        // Encontre o elemento pai da linha (tr) e remova-o
        var row = event.target.closest('tr');
        if (row) {
            row.remove();
        }
    }
});

// editar linha
function editarRestaurante(event) {
    var button = event.target;
    var row = button.closest('tr'); // Encontrar a linha mais próxima

    // Preencha o formulário com os detalhes do registro que está sendo editado
    document.getElementById('idRestaurante').value = button.getAttribute('data-id');
    document.getElementById('restaurante').value = row.cells[2].innerHTML.trim();
    document.getElementById('data_inicio').value = formatarDataParaInput(row.cells[3].innerHTML.trim());
    document.getElementById('data_fim').value = formatarDataParaInput(row.cells[4].innerHTML.trim());

    // Atualize o índice de edição (se necessário)
    indiceEditando = row.rowIndex;

    console.log('Índice de edição:', indiceEditando);
}

// verificar se o botao editar foi clicado e chamar a função editar
document.addEventListener('click', function (event) {
    if (event.target.classList.contains('editar-restaurante')) {
        editarRestaurante(event);
    }
});

// passar dados atualizados pra o controller para salvar no banco
function passarNovaReferenciaParaPHP() {
    console.log('Chamando atualizar DadosNoBanco');

    var table2 = document.getElementById('table2');
    var data = [];

    for (var i = 1; i < table2.rows.length; i++) {
        var idFuncionario = table2.rows[i].cells[0].innerHTML.trim();
        var idRestaurante = table2.rows[i].cells[1].innerHTML.trim();
        var dataInicio = formatarDataParaInput(table2.rows[i].cells[3].innerHTML.trim());
        var dataFim = formatarDataParaInput(table2.rows[i].cells[4].innerHTML.trim());
        
        // Dentro da função passarNovaReferenciaParaPHP
        var isNewRow = table2.rows[i].querySelector('[data-isnewrow]');

        data.push({
            idFuncionario: idFuncionario,
            idRestaurante: idRestaurante,
            data_inicio: dataInicio,
            data_fim: dataFim,
            isNewRow: isNewRow
        });
    }

    console.log('Dados a serem enviados: ', data);

    // Envie os dados para o servidor
    fetch('../../../controller/referenciaController.php?acao=alteracao&idFuncionario=${idFuncionario}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => response.text())
        .then(data => {
            console.log('Resposta do servidor:', data);
        })
        .catch(error => {
            console.error('Erro ao enviar os dados para o servidor:', error);
        });
}
