<?php
include_once('../../controller/protect.php');

include_once('../../configuration/connect.php');
include_once('../../model/modelCargo/cargoModel.php');

$cargoModel = new CargoModel($link);
$cargos = $cargoModel->read(); // Use o método read() para listar os cargos
$numCargos = count($cargos);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOSTRAP  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link rel="stylesheet" href="../components/style.css">

    <link rel="stylesheet" href="../css/styleAllConteinerPages.css">
    <link rel="stylesheet" href="../css/styleCabecalhoPesquisa.css">
    <link rel="stylesheet" href="../css/styleNoti.css">
    <link rel="stylesheet" href="../css/stylePesquisar.css">
    <link rel="stylesheet" href="../css/styleTable3.css">
    <link rel="icon" href="../css/iconsSVG/iconReceita.svg">

    <title>Cargos</title>

    <script>
        function confirmarExclusao(idCargo) {
            var confirmacao = confirm("Tem certeza de que deseja excluir esta cargo?");

            if (confirmacao) {
                // Se o usuário confirmar a exclusão, redirecione para o script de exclusão com o ID
                window.location.href = "../../controller/cargoController.php?acao=excluir&idCargo=" + idCargo;
            } else {
                // Se o usuário cancelar, não faça nada
            }
        }

        function confirmarExclusaoCheckbox() {
            if (confirm("Tem certeza de que deseja excluir as cargos selecionadas?")) {
                document.forms["excluirSelect"].submit();
            }
        }
    </script>

</head>

<body>
    <!-- Menu lateral - vem de outra página -->
    <?php include '../components/testemenu.php'; ?>
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
            <section>
                <div class="paginação">
                    <a href="homePage.php">Homepage </a> >
                    <a href="#" class="pagina-atual">Categoria</a>
                </div>
                <div class="containerPesquisa">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 conteiner-info">
                            <div>
                                <h1>Lista de Cargos</h1>
                            </div>

                            <div class="info-qtd">
                                <a href="#">
                                    <?php echo "( $numCargos ) Cargos"; ?>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12 conteiner-func">
                            <form method="post" action="../../controller/cargoController.php" class="form-p">
                                <button>
                                    <svg width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="search">
                                        <path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9" stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                                <input class="input-p" placeholder="Pesquisar" required="" type="search" name="descricao">
                            </form>

                            <!-- Criar -->
                            <div class="button-nova">
                                <a href="Cargo/cargoCadastro.php">
                                    <button class="nova-button">Cadastrar</button>
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
                                echo $sucesso . "<br>";
                            }
                            unset($_SESSION["sucesso"]);
                        }
                        ?>
                    </div>
            </section>

            <section>
                <div class="conteiner-button-select">
                    <button onclick="confirmarExclusaoCheckbox()">Excluir Selecionados</button>
                </div>
                <form id="excluirSelect" action="../../controller/cargoController.php?acao=excluirSelecionados" method="post">
                    <table class="table table-sm table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="select-column">-</th>
                                <th>Cargo</th>
                                <th class="operation">Operações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cargos as $index => $cargo) : ?>
                                <tr>
                                    <td class="select-column">
                                        <input type="checkbox" name="checkbox[]" value="<?php echo $cargo['idCargo']; ?>">
                                    </td>
                                    <td>
                                        <?php echo $cargo['descricao']; ?>
                                    </td>
                                    <td class="operation">
                                        <a href="Cargo/cargoEdicao.php?idCargo=<?php echo $cargo['idCargo']; ?>">
                                            <span class="material-symbols-outlined"> edit </span>
                                        </a>

                                        <a href="#" onclick="confirmarExclusao(<?php echo $cargo['idCargo']; ?>);" class="button">
                                            <span class="material-symbols-outlined"> delete </span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </form>
            </section>
        </div>


</body>

</html>