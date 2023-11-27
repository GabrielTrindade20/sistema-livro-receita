function excluirComposicao(link, nome_receita, idIngrediente, idMedida) {
    // if (confirm("Tem certeza que deseja excluir esta composição?")) {
        $.ajax({
            type: 'GET',
            url: '../../../controller/receitaComposicaoControllerEdicao.php',
            data: {
                nome_receita: nome_receita,
                idIngrediente: idIngrediente,
                idMedida: idMedida,
                acao: 'delete'
            },
            success: function(data) {
                // Manipule a resposta, se necessário
                console.log(data);

                $(link).closest('tr').remove();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    // }
}

function editarComposicao(nome_receita, idIngrediente,ingrediente, idMedida,  medida, quantidade ) {
    document.getElementById('nome_receita').value = nome_receita;
    document.getElementById('idIngrediente').value = idIngrediente;
    document.getElementById('idMedida').value = idMedida;
    document.getElementById('ingrediente').value = ingrediente;
    document.getElementById('medida').value = medida;
    document.getElementById('quantidade').value = quantidade;

    // Altere o valor do campo "acao" para "atualizar"
    document.getElementById('acao').value = 'atualizar';
    
    console.log('nome_receita:', nome_receita);
    console.log('idIngrediente:', idIngrediente);
    console.log('idMedida:', idMedida);
    console.log('ingrediente:', ingrediente);
    console.log('medida:', medida);
    console.log('quantidade:', quantidade);
    console.log(document.getElementById('acao'));
    
    // Adicione um evento de clique ao botão de salvar para chamar a função de atualização
    document.getElementById('btn-salvar-composicao').addEventListener('click', function (event) {
        event.preventDefault();
        atualizarComposicao();
    });
}

// Adicione uma nova função para enviar a solicitação de atualização via AJAX
function atualizarComposicao() {
    var nome_receita = document.getElementById('nome_receita').value;
    var idIngrediente = document.getElementById('idIngrediente').value;
    var idMedida = document.getElementById('idMedida').value;
    var quantidade = document.getElementById('quantidade').value;

    console.log('nome_receita:', nome_receita);
    console.log('idIngrediente:', idIngrediente);
    console.log('idMedida:', idMedida);
    console.log('quantidade:', quantidade);
    console.log(document.getElementById('acao'));
    
    // Realize uma solicitação AJAX para o script PHP de atualização
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../../../controller/receitaComposicaoControllerEdicao.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
        }
    };
    // Envie os dados para o script PHP de atualização
    xhr.send('nome_receita=' + nome_receita + '&idIngrediente=' + idIngrediente + '&idMedida=' + idMedida + '&quantidade=' + quantidade);
}
