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

// // pegar nome e id de restaurante e colocar no form
// document.addEventListener('DOMContentLoaded', function () {
//     // Adicione um ouvinte de evento de clique ao documento
//     document.addEventListener('click', function (event) {
//         if (event.target && event.target.classList.contains('adicionar-restaurante')) {
//             var nomeRestaurante = event.target.getAttribute('data-nome');
//             var idRestaurante = event.target.getAttribute('data-id');

//             var idFuncionario = document.getElementById('form2').getAttribute('data-idFuncionario');

//             // pegar o nome e o id do restaurante para o form depois de escolher o restaurante da na tabela
//             document.querySelector('input[name="restaurante"]').value = nomeRestaurante;
//             document.querySelector('input[name="idRestaurante"]').value = idRestaurante;
//             document.querySelector('input[name="idFuncionario"]').value = idFuncionario;

//             // Exiba os valores no console para verificar
//             console.log('Nome do Restaurante:', nomeRestaurante);
//             console.log('ID do Restaurante:', idRestaurante);
//             console.log('ID do idFuncionario:', idFuncionario);
//         }
//     });
// });

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
