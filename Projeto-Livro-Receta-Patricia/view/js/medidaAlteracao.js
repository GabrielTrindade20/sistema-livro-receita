function editarMedida(idMedida, descricao ) {
    document.getElementById('idMedida').value = idMedida;
    document.getElementById('medida').value = descricao;

    // Altere o valor do campo "acao" para "atualizar"
    document.getElementById('acaoM').value = 'atualizarM';
    console.log('idMedida:', idMedida);
    console.log('descricao:', descricao);

    // Adicione um evento de clique ao botão de salvar para chamar a função de atualização
    document.getElementById('btn-salvar-medida').addEventListener('click', function (event) {
        event.preventDefault();
        atualizarIngrediente();
    });
}

// Adicione uma nova função para enviar a solicitação de atualização via AJAX
function atualizarMedida() {
    var idMedida = document.getElementById('idMedida').value;
    var descricao = document.getElementById('medida').value;

    // Realize uma solicitação AJAX para o script PHP de atualização
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../../controller/referenciaControlerEditar.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
        }
    };
    // Envie os dados para o script PHP de atualização
    xhr.send('idMedida=' + idMedida + '&descricao=' + descricao);
}
