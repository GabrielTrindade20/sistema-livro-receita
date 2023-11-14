function editarIngrediente(idIngrediente, nome, descricao ) {
    document.getElementById('idIngrediente').value = idIngrediente;
    document.getElementById('nome_ingrediente').value = nome;
    document.getElementById('descricao').value = descricao;

    // Altere o valor do campo "acao" para "atualizar"
    document.getElementById('acao').value = 'atualizar';
    
    console.log('idIngrediente:', idIngrediente);
    console.log('nome_ingrediente:', nome);
    console.log('descricao:', descricao);
    
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
    xhr.open('POST', '../../controller/ingredienteController.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
        }
    };
    // Envie os dados para o script PHP de atualização
    xhr.send('idIngrediente=' + idIngrediente + '&nome_ingrediente=' + nome_ingrediente + '&descricao=' + descricao);
}
