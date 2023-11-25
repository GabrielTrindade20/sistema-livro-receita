// formatar a data para retornar no input (YYYY-MM-DD)
function formatarDataParaInput(dataTabela) {
    // A variável dataTabela deve estar no formato "DD/MM/YYYY"
    var partesData = dataTabela.split('/'); // Divide a data em partes
    if (partesData.length === 3) {
        // Formate a data como "YYYY-MM-DD" para um campo de input do tipo date
        return partesData[2] + '-' + partesData[1] + '-' + partesData[0];
    }
    return 'erro'; // Retorno vazio se o formato estiver incorreto
}

function editarReferencia(idFuncionario, idRestaurante, data_inicio, data_fim) {
    document.getElementById('idFuncionario').value = idFuncionario;
    document.getElementById('idRestaurante').value = idRestaurante;
    document.getElementById('data_inicio').value = formatarDataParaInput(data_inicio);
    document.getElementById('data_fim').value = formatarDataParaInput(data_fim);

    // Altere o valor do campo "acao" para "atualizar"
    // document.getElementById('acao').value = 'atualizar';

    console.log('idFuncionario:', idFuncionario);
    console.log('idRestaurante:', idRestaurante);
    console.log('data_inicio:', formatarDataParaInput(data_inicio));
    console.log('data_fim:', formatarDataParaInput(data_fim));

    // Adicione um evento de clique ao botão de salvar para chamar a função de atualização
    document.getElementById('btn-salvar-referencia').addEventListener('click', function (event) {
        event.preventDefault();
        atualizarReferencia();
    });
}

// Adicione uma nova função para enviar a solicitação de atualização via AJAX
function atualizarReferencia() {
    var idFuncionario = document.getElementById('idFuncionario').value;
    var idRestaurante = document.getElementById('idRestaurante').value;
    var dataInicio = document.getElementById('data_inicio').value;
    var dataFim = document.getElementById('data_fim').value;
    
    console.log('idFuncionario:', idFuncionario);
    console.log('idRestaurante:', idRestaurante);
    console.log('data_inicio:', dataInicio);
    console.log('data_fim:', dataFim);
    // Realize uma solicitação AJAX para o script PHP de atualização
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../../../controller/referenciaControllerEditar.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
            
        }
    };
    // Envie os dados para o script PHP de atualização
    xhr.send('idFuncionario=' + idFuncionario + '&idRestaurante=' + idRestaurante + '&data_inicio=' + dataInicio + '&data_fim=' + dataFim);
}
