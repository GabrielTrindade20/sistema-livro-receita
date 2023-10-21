<?php
if(!isset($_SESSION)) {
    session_start();
}
include_once('../../controller/protect.php');
include_once('../../controller/funcionarioController.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/stylePesq.css">
    <link rel="stylesheet" href="../css/styleResponsivo.css">
    <link rel="icon" href="../css/iconsSVG/iconReceita.svg">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" 
    />
    
    <title>Funcionário</title>

    <script>
        function confirmarExclusao(idFuncionario) {
            var confirmacao = confirm("Tem certeza de que deseja excluir esta funcionário ?");

            if (confirmacao) {
                // Se o usuário confirmar a exclusão, redirecione para o script de exclusão com o ID
                window.location.href = "../../controller/funcionarioController.php?acao=excluir&idFuncionario=" + idFuncionario;
            } else {
                // Se o usuário cancelar, não faça nada
            }
        }
        function confirmarExclusaoCheckbox() {
            if (confirm("Tem certeza de que deseja excluir as funcionarios selecionadas?")) {
                document.forms["excluirSelect"].submit();
            }
        }
    </script>

</head>
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
                        <input type="text" class="search-box-input" name="busca" placeholder="Pesquisar">
                        <input name="sendPesqFuncinario" type="submit" class="">
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
    </section>

    <section class="conteiner-conteudo">
        <button onclick="confirmarExclusaoCheckbox()">Excluir Selecionados</button>

        <form id="excluirSelect" action="../../controller/funcinarioController.php?acao=excluirSelecionados" method="post">
            <table class="table" border="1" align="right">
                <thead>
                    <tr>
                        <th class="select-column">-</th>
                        <th>RG</th>
                        <th>NOME</th>
                        <th>DATA INGRESSO</th>
                        <th>SALÁRIO</th>
                        <th>NOME FANTASIA</th>
                        <th>CARGO</th>
                        <th class="operacao" colspan="2">OPERAÇÔES</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Tabela de funcionario -->
                    <?php foreach ($funcionarios as $index => $funcionario): ?>
                        <tr class="<?php echo ($index % 2 == 0) ? 'even-row' : 'odd-row'; ?>">
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
                                <a href="../pages/Funcionario/pageFuncionarioAlteracao.php?idFuncionario=<?php echo $funcionario['idFuncionario']; ?>">
                                    <span class="material-symbols-outlined"> edit </span>
                                </a>
                            </td>
                            <td>
                                <a href="#" onclick="confirmarExclusao(<?php echo $funcionario['idFuncionario']; ?>);" class="button">
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