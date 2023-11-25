<?php
include_once('../../../controller/protectSubFolders.php');
include_once('../../../controller/funcionarioController.php');
include_once('../../../controller/restauranteController.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
=======
    <!-- BOOSTRAP  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="../../components/style.css">

    <link rel="stylesheet" href="../../css/styleAllConteinerPages.css">
    <link rel="stylesheet" href="../../css/styleRestaurante.css">
>>>>>>> 4fb2ba83548940f58276ae656f8cf4388badf223
    <link rel="icon" href="../../css/iconsSVG/iconReceita.svg">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Restaurante</title>

</head>

<body>
    <!-- Menu lateral - vem de outra página -->
    <?php include '../../components/menuSub1.php'; ?>
    <!-- Page Content -->
    <div id="content">
        <div class="container-fluid">
            <header>
                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fas fa-align-left"></i>
                </button>
            </header>
        </div>
        <div class="conteudo">
            <div class="paginação-sub">
                <a href="../homePage.php">Homepage </a> >
                <a href="../pageRestaurante.php"> Referência </a> >
                <a href="pageRestauranteCadastro.php"> Referência Cadastro </a> >
                <a href="#" class="pagina-atual"> Restaurante Cadastro</a>
            </div>
            <section>
                <div class="titulo">
                    <h1>Restaurante</h1>
                </div>

                <div class="conteiner-abas"> <!-- Notificação de erro ou não -->

                    <!-- Formulário de Cadastro -->
                    <form method="POST" action="../../../controller/restauranteController.php">
                        <input type="hidden" name="acao" id="acao" value="salvar">
                        <input type="hidden" name="idRestaurante" id="idRestaurante" value="">
                        <div class="conteiner-dados position-absolute top-50 start-50 translate-middle">
                            <div class="row g-3">
                                <div class="col">
                                    <label for="nome" class="form-label">Nome</label>
                                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome" required>
                                </div>
                                <div class="col">
                                    <label for="contato" class="form-label">Contato</label>
                                    <input class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="11" id="contato" name="contato" placeholder="Digite o contato" maxlength="12" required>
                                </div>
                            </div>
                        </div>

                        <div class="conteiner-operacoes">
                            <!-- Botão para salvar o cargo -->
                            <button type="submit" name="salvar_restaurante" class="button">Salvar</button>

                            <!-- Botão para cancelar e voltar à página principal -->
                            <a href="pageRestauranteCadastro.php">
                                <span class="material-symbols-outlined"> arrow_back</span>
                            </a>
                        </div>
                    </form>
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
                    <div class="dados">

                        <div class="scrollable">
                            <table class="table table-sm table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Contato</th>
                                        <th class="operation">Operações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Tabela de restaurantes -->
                                    <?php foreach ($restaurantes as $index => $restaurante) : ?>
                                        <tr>
                                            <td>
                                                <?php echo $restaurante['nome']; ?>
                                            </td>
                                            <td>
                                                <?php echo $restaurante['contato']; ?>
                                            </td>
                                            <td class="operation">
                                                <a onclick="editarRestaurante(<?php echo $restaurante['idRestaurante'] ?>, '<?php echo $restaurante['nome'] ?>', '<?php echo $restaurante['contato']; ?>')" href="#" class="editar-restaurante" id="btn-salvar-restaurante" data-id="<?php echo $restaurante['idRestaurante']; ?>">
                                                    <span class="material-symbols-outlined"> edit </span>
                                                </a>
                                                <a class="remover-restaurante" href="cadastrarRestaurante.php?idRestaurante=<?php echo $restaurante['idRestaurante']; ?>&acao=delete">
                                                    <span class="material-symbols-outlined"> delete </span>
                                                </a>

                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </section>
        </div>
    </div>

    <script src="../../js/restauranteAleracao.js"></script>
    <!-- BOOSTRAP JAVASCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>