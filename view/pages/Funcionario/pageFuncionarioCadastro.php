<?php
if(!isset($_SESSION)) {
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
    <link rel="stylesheet" href="../../css/styleEdica.css">
    <link rel="icon" href="../../css/iconsSVG/iconReceita.svg">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Funcionário</title>
</head>

<body>
    <!-- Menu lateral - vem de outra página -->
    <?php //require_once('../../components/menuSubFolders.php'); ?>  

    <section class="conteiner-conteudo">
        <h1 class="titulo">Funcionário</h1>

        <!-- Botão para cancelar e voltar à página principal -->
        <a href="../../pages/pageFuncionario.php">Sair</a>

        <!-- Notificação de erro ou não -->
        <div class="mensagens">
            <?php
                if (isset($_SESSION["erros"])) {
                    $erros = $_SESSION["erros"];
                    // Exibir as mensagens de erro
                    foreach ($erros as $erro) {
                        echo $erro . "<br>";
                    }
                    // Limpar as mensagens de erro da sessão
                    unset($_SESSION["erros"]);
                } elseif (isset($_SESSION["sucesso"])) {
                    $sucessos = $_SESSION["sucesso"];
                    foreach ($sucessos as $sucesso) {
                        echo $sucesso. "<br>";
                    }
                    unset($_SESSION["sucesso"]);
                }
            ?>
        </div>

        <div class="conteiner-abas">
            <!-- Formulário de Cadastro Funcionario -->
            <form class="form_funcionario" method="POST" action="../../../controller/funcionarioController.php">
                <div class="conteiner-dados">
                    <label for="rg">RG:</label>
                    <input type="text" id="rg" name="rg" value="<?php echo isset($_SESSION['rg']) ? $_SESSION['rg'] : ''; ?>" required>

                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" value="<?php echo isset($_SESSION['nomeF']) ? $_SESSION['nomeF'] : ''; ?>" required>

                    <label for="data_ingresso">Data Ingresso:</label>
                    <input type="date" id="data_ingresso" name="data_ingresso" value="<?php echo isset($_SESSION['data_ingresso']) ? $_SESSION['data_ingresso'] : ''; ?>" required>

                    <label for="salario">Salário:</label>
                    <input type="text" id="salario" name="salario" value="<?php echo isset($_SESSION['salario']) ? $_SESSION['salario'] : ''; ?>" required>

                    <label for="nome_fantasia">Nome Fantasia:</label>
                    <input type="text" id="nome_fantasia" name="nome_fantasia" value="<?php echo isset($_SESSION['nome_fantasia']) ? $_SESSION['nome_fantasia'] : ''; ?>" required>

                    <label for="cargo">Cargo:</label>

                    <?php 
                        monta_select_cargo(isset($_SESSION['cargo']) ? $_SESSION['cargo'] : '');
                    ?>  <br>
                </div>
 
                <div class="">
                    <!-- Botão para salvar o funcionario -->
                    <button type="submit" name="salvar" class="button">Salvar</button>
                </div>
            </form>                
        </div>
    </section>

    <section class="conteiner-referencia" align="right">
        <div class="box-search">
            <h2>Cadastro de Restaurante<h2>

            <input type="search" name="pesquisar" id="pesquisarReferencia" placeholder="Pesquisar"> 
            <button onclick="searchData()" >pesquisar</button>
        </div>

        <div align="right">
            <h3>Restaurantes</h3>

            <table class="table" id="table1" border="1">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Contato</th>
                        <th>Operações</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Tabela de restaurantes -->
                    <?php foreach ($restaurantes as $index => $restaurante): ?>
                        <tr class="<?php echo ($index % 2 == 0) ? 'even-row' : 'odd-row'; ?>">
                            <td>
                                <?php echo $restaurante['nome']; ?>
                            </td>
                            <td>
                                <?php echo $restaurante['contato']; ?>
                            </td>
                            <td>
                                <button class="adicionar-restaurante" data-nome="<?php echo $restaurante['nome']; ?>" data-id="<?php echo $restaurante['idRestaurante'];?>" > Adicionar + </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <br>
        <div class="form-referencia">
            <form method="POST" action="#" onsubmit="adicionarRestaurante(event)">
                <div>
                    <input type="hidden" name="idRestaurante" id="idRestaurante">
                    <label for="restaurante">Restaurante</label>
                    <input type="text" name="restaurante" id="restaurante">
                    <br>
                    <label for="restaurante">Data de Início</label>
                    <input type="date" name="data_inicio" id="data_inicio"> 
                    <br>
                    <label for="restaurante">Data de Fim</label>
                    <input type="date" name="data_fim" id="data_fim"> 
                </div>

                <button type="submit" name="salvar_restaurante" class="salvar-edicao">Salvar restaurante</button>
            </form>
        </div>

        <div>
            <h3>Restaurantes Cadastrados</h3>

            <table class="table" id="table2" border="1" align="right">
                <thead>
                    <tr>
                        <th class="select-column">-</th>
                        <th>NOME</th>
                        <th>DATA INÍCIO</th>
                        <th>DATA FIM</th>
                        <th class="operacao" colspan="2">OPERAÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Gerando de acordo com o que foi cadastrado -->
                </tbody>
            </table>

            <button id="salvar-todos" value="salvar_referencia" name="salvar_referencia" onclick="passarReferenciaParaPHP()">Salvar Todos</button>
        
            <br>
        </div>
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

        xhr.onload = function() {
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
        }
        else {
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

        console.log(JSON.stringify(data));
        // Fazer a requisição AJAX para enviar os dados para o PHP
        $.ajax({
            type: "POST",
            url: "../../../controller/referenciaController.php",
            data: JSON.stringify({ data: data }), // Serializa os dados como JSON
            success: function(response) {
                console.log("response"); // Mensagem de confirmação do PHP
                // Faça o que for necessário após o salvamento bem-sucedido
            },
            error: function() {
                console.log('Erro ao enviar os dados para o PHP');
            }
        });
    }


</script>
</html>