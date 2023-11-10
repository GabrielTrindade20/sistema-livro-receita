<?php
include_once('../../../controller/protect.php');
include_once('../../../configuration/connect.php');
include_once('../../../model/funcionarioModel.php');
include_once('../../../model/referenciaModel.php');

include_once('../../../controller/referenciaPesquisarController.php');
include_once('../../../controller/referenciaController.php');


if (isset($_GET['idFuncionario'])) {
    $idFuncionario = $_GET['idFuncionario'];
    $funcionarioModel = new funcionarioModel($link);
    $recuperar = $funcionarioModel->recuperaFuncionario($idFuncionario);
     
// recuperar funcionario
if ($recuperar) {
        $rg = $recuperar["rg"];
        $nome = $recuperar["nome"];
        $data_ingresso = $recuperar["data_ingresso"];
        $salario = $recuperar["salario"];
        $nome_fantasia = $recuperar["nome_fantasia"];
        $situacao = $recuperar["situacao"];
        $cargo = $recuperar["idCargo"];
    } else {
        header("Location: pageFuncionario.php?mensagem=" . urlencode("Funcionário não encontrado."));
        exit();
    }
}
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
    <!-- <?php require_once('../../components/menuSubFolders.php'); ?>  -->

    <section class="conteiner-conteudo">
        <h1 class="titulo">Funcionário</h1>

        <div class="conteiner-abas">
            <!-- Formulário de Alteraçao -->
            <form method="POST" action="../../../controller/funcionarioController.php">
                <div class="conteiner-dados">
                    <!-- <input type="hidden" name="idFuncionario" value="<?php echo $recuperar["idFuncionario"]; ?>"> -->
                    <input type="hidden" name="idFuncionario" value="<?php echo $idFuncionario; ?>">

                    <label for="rg">RG:</label>
                    <input type="text" id="rg" name="rg" required value="<?php echo isset($rg) ? $rg : ''; ?>">

                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required value="<?php echo isset($nome) ? $nome : ''; ?>">

                    <label for="data_ingresso">Data Ingresso:</label>
                    <input type="date" id="data_ingresso" name="data_ingresso" required
                        value="<?php echo isset($data_ingresso) ? $data_ingresso : ''; ?>">

                    <label for="salario">Salário:</label>
                    <input type="text" id="salario" name="salario" required
                        value="<?php echo isset($salario) ? $salario : ''; ?>">

                    <label for="nome_fantasia">Nome Fantasia:</label>
                    <input type="text" id="nome_fantasia" name="nome_fantasia" required
                        value="<?php echo isset($nome_fantasia) ? $nome_fantasia : ''; ?>">

                    <p>Situação:</p>
                    <label for="ativo">Ativo</label>
                    <input type="radio" id="ativo" name="situacao" value="0" <?php echo ($situacao === '0') ? 'checked' : ''; ?>>

                    <label for="inativo">Inativo</label>
                    <input type="radio" id="inativo" name="situacao" value="1" <?php echo ($situacao === '1') ? 'checked' : ''; ?>>

                    <label for="cargo">Cargo:</label>
                    <?php
                    include_once('../../../configuration/connect.php');
                    include '../../../model/funcoes.php';

                    monta_select_cargo2($cargo);
                    ?>
                    <br>
                </div>
                <br>
                <div class="conteiner-operacoes">
                    <!-- Botão para salvar o cargo -->
                    <button type="submit" name="alterar" class="button">Salvar</button>

                    <!-- Botão para cancelar e voltar à página principal -->
                    <a href="../pageFuncionario.php">Cancelar</a>
                </div>
            </form>
        </div>
    </section>

    <section class="conteiner-referencia" align="right">
        <div class="box-search">
            <h2>Cadastro de Restaurante<h2>
            
            <div class="box-input-search">
                <input type="search" name="pesquisar" id="pesquisarReferencia" placeholder="Pesquisar">
                <button onclick="searchData()">pesquisar</button>
            </div> 
        </div>

        <div class="conteiner-table" align="right">
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
                                <button class="adicionar-restaurante" data-nome="<?php echo $restaurante['nome']; ?>"
                                    data-id="<?php echo $restaurante['idRestaurante']; ?>"> Adicionar + </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div class="box-form-referencia">
            <form method="POST" action="#" onsubmit="adicionarRestaurante(event)">
                <div class="form-input">
                    <input type="hidden" name="idFuncionario" id="idFuncionario" value="<?php echo $idFuncionario; ?>">
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

                <div class="box-button">
                    <button type="submit" name="salvar_restaurante_novo" class="salvar-edicao-nova">Salvar restaurante</button>
                </div>
            </form>
        </div>

        <div class="box-form-table">
            <h3>Restaurantes Cadastrados</h3>

            <table class="table" id="table2" border="1" align="right">
                <thead>
                    <tr>
                        <th class="select-column">-</th>
                        <th class="select-column">-</th>
                        <th>NOME</th>
                        <th>DATA INÍCIO</th>
                        <th>DATA FIM</th>
                        <th class="operacao" colspan="2">OPERAÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                     <!-- Tabela de restaurantes csdastrado -->
                    <?php foreach ($recuperar_referencia as $index => $referencia): ?>
                        <tr  class="<?php echo ($index % 2 == 0) ? 'even-row' : 'odd-row'; ?>">
                            <td>
                                <?php echo $referencia['idFuncionario']; ?>
                            </td>
                            <td>
                                <?php echo $referencia['idRestaurante']; ?>
                            </td>
                            <td>
                                <?php echo $referencia['nome']; ?>
                            </td>
                            <td>
                                <?php echo $referencia['data_inicio']  = implode("/",array_reverse(explode("-", $referencia['data_inicio']))); ?>
                            </td>
                            <td>
                                <?php echo $referencia['data_fim']  = implode("/",array_reverse(explode("-", $referencia['data_fim'])));?>
                            </td>
                            <td>
                                <button class="remover-restaurante" data-nome="<?php echo $referencia['nome']; ?>"
                                    data-id="<?php echo $referencia['idRestaurante']; ?>"> Remover </button>
                            </td>
                            <td>
                                <button class="editar-restaurante" data-nome="<?php echo $referencia['nome']; ?>"
                                    data-indice="<?php echo $index; ?>"  data-id="<?php echo $referencia['idRestaurante']; ?>"> Editar </button>
                            </td>
                        </tr>
                    <?php  endforeach; echo "CERO:". $index;?>
                </tbody>
            </table>

            <div class="box-button">
                <button id="salvar-todos" name="alterar_refe" onclick="passarReferenciaParaPHP()">Salvar Todos</button>
            </div>
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
        var idLinha = document.getElementById('idRestaurante').value;
        var row = document.querySelector('tr[data-id="' + idLinha + '"]');
        
        // Verifique se os campos estão preenchidos
        if (!restaurante || !dataInicio || !dataFim) {
            alert("Preencha todos os campos antes de salvar.");
            return;
        }
        else {
            if (indiceEditando !== -1) {
                // Se um registro estiver sendo editado, atualize a linha existente
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
                var cell1 = newRow.insertCell(0);
                var cell2 = newRow.insertCell(1);
                var cell3 = newRow.insertCell(2);
                var cell4 = newRow.insertCell(3);
                var cell5 = newRow.insertCell(4);
                var cell6 = newRow.insertCell(5);
                var cell7 = newRow.insertCell(6);

                cell1.innerHTML = idFuncionario;
                cell2.innerHTML = idRestaurante;
                cell3.innerHTML = restaurante;
                cell4.innerHTML = dataInicio;
                cell5.innerHTML = dataFim;
                cell6.innerHTML = '<button class="remover-restaurante" data-nome="' + restaurante + '"  data-id="'+idRestaurante+'" >Remover</button>';
                cell7.innerHTML = '<button class="editar-restaurante" data-nome="' + restaurante + '"  data-id="'+idRestaurante+'">Editar</button>';
            }
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

    // editar cadastrado
    function editarRestaurante(event) {
        
        var indice = event.target.getAttribute('data-indice');
        var restauranteID = "restaurante_" + indice;
        var dataInicioID = "data_inicio_" + indice;
        var dataFimID = "data_fim_" + indice;

        // Preencha o formulário com os detalhes do registro que está sendo editado
        document.getElementById('idRestaurante').value = table2.rows[indice].cells[1].innerHTML;
        document.getElementById('restaurante').value = document.getElementById(restauranteID).innerHTML.trim();
        document.getElementById('data_inicio').value = formatarDataParaInput(document.getElementById(dataInicioID).innerHTML.trim());
        document.getElementById('data_fim').value = formatarDataParaInput(document.getElementById(dataFimID).innerHTML.trim());

        // Atualize o índice de edição
        indiceEditando = indice;
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
        
        // Carregue novamente os dados na tabela após salvar ou editar
        carregarDadosDoServidor();
    }

</script>

</html>