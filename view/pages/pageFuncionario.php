<?php
if(!isset($_SESSION)) {
    session_start();
}
include_once('../../controller/protect.php');
include_once('../../controller/funcionarioController.php');

// Limpe as variáveis de sessão 
unset($_SESSION['rg']);
unset($_SESSION['nomeF']);
unset($_SESSION['data_ingresso']);
unset($_SESSION['salario']);
unset($_SESSION['nome_fantasia']);
unset($_SESSION['cargo']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/stylePesq.css">
    <link rel="stylesheet" href="../css/styleTable.css">
    <link rel="icon" href="../css/iconsSVG/iconReceita.svg">
    <link rel="stylesheet" href="../css/stylePesq.css">
    <link rel="stylesheet" href="../css/styleResponsivo.css">
    <link rel="icon" href="../css/iconsSVG/iconReceita.svg">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" 
    />
    <style>
        .search-box {
            display: flex;
            align-items: center;
        }

        .search-box-input-container {
            display: flex;
            align-items: center;
            margin-right: 10px;
        }

        .search-box-input {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchBoxInput = document.querySelector(".search-box-input");

            searchBoxInput.addEventListener("keydown", function(event) {
                if (event.key === "Enter") {
                    event.preventDefault(); // Impede que o formulário seja enviado
                    // Adicione aqui a função que você deseja executar ao pressionar "Enter"
                    realizarPesquisa();
                }
            });
        });

        function realizarPesquisa() {
            // Coloque aqui o código para realizar a pesquisa
            alert("Pesquisa realizada"); // Exemplo: mostrar um alerta
        }
    </script>
</head>
    <title>Funcionário</title>
</head>
<body>
    <!-- Menu lateral - vem de outra página -->
    <?php require_once('../components/menu.php');?>

    <div class="paginação">
        <a href="homePage.php">Homepage > </a>
        <a href="pagefuncionario.php">funcionario</a>
    </div>

    <section class="conteiner-pesquisa">
        <div class="titulos" id="titulo">
            <div class="conteiner-titulo">
                <div>
                    <h1>Lista de Funcionários</h1>
                </div>

                <div class="info-receitas">
                    <?php echo "(" . $countFuncionarios. ") Funcionários"; ?>
                </div>
            </div>

            <div class="search-container">
                <!-- Search -->
                <div class="search-box">
    <form method="POST" action="">
        <div class="search-box-input-container">
            <input type="text" class="search-box-input" name="busca" placeholder="Pesquisar">
            <button type="submit" class="search-box-button">Enviar</button>
        </div>
    </form>
</div>
                <!-- Criar -->
                <div class="button-nova">
                    <a href="./Funcionario/pageFuncionarioCadastro.php">
                        <button class="nova-receita-button">Cadastrar</button>
                    </a>
                </div>
            </div>
        </div>

        <button onclick="confirmarExclusaoCheckbox()" align="right">Inativar Selecionados</button>
    </section>

    <section class="conteiner-conteudo">
        <form id="excluirSelect" action="../../controller/funcionarioController.php?acao=inativosSelecionados" method="post">
            <table class="table center-table" border="1">
                <thead>
                    <tr>
                        <th class="select-column">-</th>
                        <th>RG</th>
                        <th>NOME</th>
                        <th>DATA INGRESSO</th>
                        <th>SALÁRIO</th>
                        <th>NOME FANTASIA</th>
                        <th>CARGO</th>
                        <th>SITUAÇÃO</th>
                        <th class="operacao" colspan="2">OPERAÇÔES</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Tabela de funcionario -->
                    <?php foreach ($funcionarios as $index => $funcionario): ?>
                        <tr class="<?php echo ($index % 2 == 0) ? 'even-row' : 'odd-row'; ?> funcionario-row" data-id="<?php echo $funcionario['idFuncionario']; ?>">
                            <td class="select-column">
                                <input type="checkbox" name="checkbox[]" value="<?php echo $funcionario['idFuncionario']; ?>">
                            </td>
                            <td>
                                <?php echo $funcionario['rg']; ?>
                            </td>
                            <td>
                                <?php echo $funcionario['nome']; ?>
                            </td>
                            <td>
                                <?php echo $funcionario['data_ingresso'] = implode("/",array_reverse(explode("-", $funcionario['data_ingresso']))); ?>
                            </td>
                            <td>
                                <?php echo 'R$' . $funcionario['salario']; ?>
                            </td>
                            <td>
                                <?php echo $funcionario['nome_fantasia']; ?>
                            </td>
                            <td>
                                <?php echo $funcionario['cargo']; ?>
                            </td>
                            <td>
                                <?php  
                                    if ($funcionario['situacao'] == '0') {
                                        echo 'Ativo';
                                    } elseif ($funcionario['situacao'] == '1') {
                                        echo 'Inativo';
                                    } else {
                                        echo 'Desconhecido';
                                    } 
                                ?>
                            </td>
                            <td>
                                <a href="../pages/Funcionario/pageFuncionarioAlteracao.php?idFuncionario=<?php echo $funcionario['idFuncionario']; ?>">
                                    <span class="material-symbols-outlined"> edit </span>
                                </a>
                            </td>
                            <td>
                                <a href="#" onclick="confirmarInativo(<?php echo $funcionario['idFuncionario']; ?>);" class="button">
                                    <span class="material-symbols-outlined"> delete </span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </form>
    </section>
</body>
</html>
