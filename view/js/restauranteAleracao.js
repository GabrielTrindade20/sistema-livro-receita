function editarRestaurante(idIngrediente, nome, contato ) {
    document.getElementById('idRestaurante').value = idIngrediente;
    document.getElementById('nome').value = nome;
    document.getElementById('contato').value = contato;

    // Altere o valor do campo "acao" para "atualizar"
    document.getElementById('acao').value = 'atualizar';
    
    console.log('idRestaurante:', idRestaurante);
    console.log('nome_ingrediente:', nome);
    console.log('descricao:', contato);
    
    // Adicione um evento de clique ao botão de salvar para chamar a função de atualização
    document.getElementById('btn-salvar-restaurante').addEventListener('click', function (event) {
        event.preventDefault();
        atualizarRestaurante();
    });
}

// Adicione uma nova função para enviar a solicitação de atualização via AJAX
function atualizarRestaurante() {
    var idRestaurante = document.getElementById('idRestaurante').value;
    var nome = document.getElementById('nome').value;
    var contato = document.getElementById('contato').value;

    // Realize uma solicitação AJAX para o script PHP de atualização
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../../controller/restauranteController.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
        }
    };
    // Envie os dados para o script PHP de atualização
    xhr.send('idRestaurante=' + idRestaurante + '&nome=' + nome + '&contato=' + contato);
}
