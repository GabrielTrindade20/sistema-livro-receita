<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once('../../../controller/protect.php');
include_once('../../../configuration/connect.php');
include_once('../../../model/funcoes.php');
include_once('../../../controller/referenciaPesquisarController.php');
include_once('../../../controller/referenciaController.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link rel="stylesheet" href="../../css/styleCabeçalhoEdicao.css">
    <link rel="stylesheet" href="../../css/styleResponsivo.css">
    <link rel="icon" href="css/iconsSVG/iconReceita.svg">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="icon" href="../../css/iconsSVG/iconReceita.svg">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Funcionário</title>

    <style>
        .conteiner-conteudo {
            position: relative;
            margin-top: 150px;
            margin-left: 350px;
            width: 60%;
        }

        .conteiner-conteudo form {
            width: 100%;
            padding: 30px 60px 100px 0;
            border: 1px solid white;
            border-radius: 0px 0px 10px 10px;
            box-shadow: 0px 5px 10px -5px black;
        }

        .conteiner-abas {
            background-color: aquamarine;
            padding: 10px;
            text-align: center;
            width: 100%;
            margin-left: 25px;
            align-items: center;
        }

        .conteiner-dados input {
            width: 100%;
        }
    </style>
</head>

<body>
    <!-- Menu lateral - vem de outra página -->
    <?php require_once('../../components/menuSubFolders2.php'); ?>

    <!-- Cadastro do funcionario -->
    <section class="conteiner-conteudo">
        <div class="titulo">
            <h2>Informações</h2>
        </div>

        <div class="conteiner-abas">
            <form class="form_funcionario" method="POST" action="../controller/funcionarioController.php">
                <div class="conteiner-abas">
                    <div class="row">
                        <div class="col">
                            <label for="nome">Nome:</label>
                            <input type="text" id="nome" name="nome"
                                value="<?php echo isset($_SESSION['nome_funcionarioF']) ? $_SESSION['nome_funcionarioF'] : ''; ?>"
                                required>

                            <label for="rg">RG:</label>
                            <input type="text" id="rg" name="rg"
                                value="<?php echo isset($_SESSION['rg']) ? $_SESSION['rg'] : ''; ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <label for="data_ingresso">Data Ingresso:</label>
                        <input type="date" id="data_ingresso" name="data_ingresso"
                            value="<?php echo isset($_SESSION['data_ingresso']) ? $_SESSION['data_ingresso'] : ''; ?>"
                            required>
                    </div>

                    <div class="row">
                        <label for="salario">Salário:</label>
                        <input type="text" id="salario" name="salario"
                            value="<?php echo isset($_SESSION['salario']) ? $_SESSION['salario'] : ''; ?>" required>
                    </div>

                    <div class="row">
                        <label for="nome_fantasia">Nome Fantasia:</label>
                        <input type="text" id="nome_fantasia" name="nome_fantasia"
                            value="<?php echo isset($_SESSION['nome_fantasia']) ? $_SESSION['nome_fantasia'] : ''; ?>"
                            required>
                    </div>

                    <div class="row">
                        <label for="cargo">Cargo:</label>
                        <?php
                        monta_select_cargo2(isset($_SESSION['cargo_funcionario']) ? $_SESSION['cargo_funcionario'] : '');
                        ?> <br>
                    </div>

                    <div class="row">
                        <label for="nome">Restaurante:</label>
                        <?php
                        monta_select_restaurante(isset($_SESSION['idRestaurante']) ? $_SESSION['idRestaurante'] : '');
                        ?>
                    </div>
                </div>

        </div>
        <div class="cancelar">
            <button type="submit" name="salvar" class="button">Salvar</button>
            <a href="../../pages/pageFuncionario.php">Cancelar</a>
        </div>
        </form>
    </section>

</body>

<script>
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

    // adicionar um novo ou editado cadastrado
    function adicionarRestaurante(event) {
        event.preventDefault(); // Evita a recarga da página

        var idRestaurante = document.getElementById('idRestaurante').value;
        var restaurante = document.getElementById('restaurante').value;
        var dataInicio = formatarData(document.getElementById('data_inicio').value);
        var dataFim = formatarData(document.getElementById('data_fim').value);

        var table2 = document.getElementById('table2');

        // Verifique se os campos estão preenchidos
        if (!restaurante || !dataInicio || !dataFim) {
            alert("Preencha todos os campos antes de salvar.");
            return;
        } else {
            if (indiceEditando !== -1) {
                // Se um registro estiver sendo editado, atualize a linha existente
                var row = table2.rows[indiceEditando];
                row.cells[0].innerHTML = idRestaurante;
                row.cells[1].innerHTML = restaurante;
                row.cells[2].innerHTML = dataInicio;
                row.cells[3].innerHTML = dataFim;

                // Reinicie o índice de edição
                indiceEditando = -1;
            } else {
                // Caso contrário, adicione uma nova linha
                var newRow = table2.insertRow(-1); // Insere a linha no final da tabela
                var cell1 = newRow.insertCell(0);
                var cell2 = newRow.insertCell(1);
                var cell3 = newRow.insertCell(2);
                var cell4 = newRow.insertCell(3);
                var cell5 = newRow.insertCell(4);
                var cell6 = newRow.insertCell(5);

                cell1.innerHTML = idRestaurante;
                cell2.innerHTML = restaurante;
                cell3.innerHTML = dataInicio;
                cell4.innerHTML = dataFim;
                cell5.innerHTML = '<button class="remover-restaurante" data-nome="' + restaurante + '">Remover</button>';
                cell6.innerHTML = '<button class="editar-restaurante" data-nome="' + restaurante + '">Editar</button>';
            }
        }

        // Limpe os campos do formulário
        document.getElementById('restaurante').value = '';
        document.getElementById('data_inicio').value = '';
        document.getElementById('data_fim').value = '';

        return false;
    }

    // editar cadastrado
    function editarRestaurante(event) {
        var restaurante = event.target.getAttribute('data-nome');
        var table2 = document.getElementById('table2');

        for (var i = 1; i < table2.rows.length; i++) {
            if (table2.rows[i].cells[1].innerHTML === restaurante) {
                // Preencha o formulário com os detalhes do registro que está sendo editado
                document.getElementById('restaurante').value = restaurante;
                document.getElementById('data_inicio').value = formatarDataParaInput(table2.rows[i].cells[2].innerHTML);
                document.getElementById('data_fim').value = formatarDataParaInput(table2.rows[i].cells[3].innerHTML);

                // Atualize o índice de edição
                indiceEditando = i;

                break;
            }
        }
    }

    // verificar se o botao editar foi clicado e chamar a função editar
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('editar-restaurante')) {
            editarRestaurante(event);
        }
    });

    function passarReferenciaParaPHP() {
        console.log('Chamando salvarDadosNoBanco');

        var table2 = document.getElementById('table2');
        var data = [];

        for (var i = 1; i < table2.rows.length; i++) {
            var idRestaurante = table2.rows[i].cells[0].innerHTML;
            var dataInicio = formatarDataParaInput(table2.rows[i].cells[2].innerHTML);
            var dataFim = formatarDataParaInput(table2.rows[i].cells[3].innerHTML);

            data.push({
                idRestaurante: idRestaurante,
                data_inicio: dataInicio,
                data_fim: dataFim
            });
        }

        console.log('Dados a serem enviados: ', data);

        // Envie os dados para o servidor
        fetch('../../../controller/referenciaController.php', {
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
</script>

</html>