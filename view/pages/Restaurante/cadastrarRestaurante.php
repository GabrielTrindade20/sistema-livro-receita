<?php
include_once('../../../controller/protect.php');
include_once('../../../controller/funcionarioController.php');
include_once('../../../controller/restauranteController.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/styleEdica.css">
    <link rel="icon" href="../../css/iconsSVG/iconReceita.svg">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Restaurante</title>
</head>

<body>
    <!-- Menu lateral - vem de outra página -->
    <?php require_once('../../components/menuSubFolders.php'); ?>

    <section class="conteiner-conteudo">
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
                    echo $sucesso . "<br>";
                }
                unset($_SESSION["sucesso"]);
            }
            ?>
        </div>
        <h1 class="titulo">Restaurante</h1>

        <div class="conteiner-abas">
            <!-- Formulário de Cadastro -->
            <form method="POST" action="../../../controller/restauranteController.php">

                <div class="conteiner-dados">
                    <input type="hidden" name="acao" id="acao" value="salvar">
                    <input type="hidden" name="idRestaurante" id="idRestaurante" value="">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required>
                    <label for="contato">Contato:</label>
                    <input type="text" id="contato" name="contato" required>
                </div>
                <br>

                <div class="conteiner-operacoes">
                    <!-- Botão para salvar o cargo -->
                    <button type="submit" name="salvar_restaurante" class="button">Salvar</button>

                    <!-- Botão para cancelar e voltar à página principal -->
                    <a href="../../pages/Restaurante/pageRestauranteCadastro.php">Voltar</a>
                </div>
            </form>
        </div>

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
                <?php foreach ($restaurantes as $index => $restaurante) : ?>
                    <tr class="<?php echo ($index % 2 == 0) ? 'even-row' : 'odd-row'; ?>">
                        <td>
                            <?php echo $restaurante['nome']; ?>
                        </td>
                        <td>
                            <?php echo $restaurante['contato']; ?>
                        </td>
                        <td>
                            <a class="remover-restaurante" href="cadastrarRestaurante.php?idRestaurante=<?php echo $restaurante['idRestaurante']; ?>&acao=delete">
                            Remover </a>
                            <a onclick="editarRestaurante(<?php echo $restaurante['idRestaurante'] ?>, '<?php echo $restaurante['nome'] ?>', '<?php echo $restaurante['contato']; ?>')" href="#" class="editar-restaurante"
                            id="btn-salvar-restaurante" data-id="<?php echo $restaurante['idRestaurante']; ?>"> Editar </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <script src="../../js/restauranteAleracao.js"></script>
</body>

</html>