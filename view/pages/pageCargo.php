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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link rel="stylesheet" href="../css/styleInativaCheckBox.css">
    <link rel="stylesheet" href="../css/styleConteudoPages.css">
    <link rel="stylesheet" href="../css/styleCabeçalhoPesquisa.css">
    <link rel="stylesheet" href="../css/stylePesquisar.css">
    <link rel="stylesheet" href="../css/styleTable1.css">
    <link rel="icon" href="../css/iconsSVG/iconReceita.svg">
    <link rel="stylesheet" href="../css/styleResponsivo.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Página de Receitas</title>

    <script>
        function confirmarExclusao(idCargo) {
            var confirmacao = confirm("Tem certeza de que deseja excluir esta cargo?");

            if (confirmacao) {
                // Se o usuário confirmar a exclusão, redirecione para o script de exclusão com o ID
                window.location.href = "../../controller/controllerCargo/cargoController.php?acao=excluir&idCargo=" + idCargo;
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
    <?php require_once('../components/menu.php'); ?>

    <section class="conteiner-conteudo2">
        <div class="paginação">
            <a href="homePage.php">Homepage > </a>
            <a href="pageCargo.php">Cargo</a>
        </div>

        <div class="containerPesquisa">
            <div class="row">
                <div class="col-md-6 col-sm-12 conteiner-info">
                    <div>
                        <h1>Lista de Cargos</h1>
                    </div>

                    <div class="info-qtd">
                        <a href="#">
                            <?php echo "($numCargos) Salvos"; ?>
                        </a>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 conteiner-func">
                    <!-- Search -->
                    <form class="form-p">
                        <button>
                            <svg width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img"
                                aria-labelledby="search">
                                <path
                                    d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9"
                                    stroke="currentColor" stroke-width="1.333" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                        </button>
                        <input class="input-p" placeholder="Pesquisar" required="" type="search">
                    </form>

                    <div class="button-nova">
                        <a href="Cargo/cargoCadastro.php">
                            <button class="nova-button">Cadastrar</button>
                        </a>
                    </div>
                </div><!-- Search -->
            </div>
        </div>

        <div class="conteiner-button-inativar">
            <button class="inativar-button" onclick="confirmarExclusaoCheckbox()">Inativar Selecionados</button>
        </div>
    </section>

    <section class="conteiner-conteudo2">

        <table class="table">
            <thead>
                <tr>
                    <th class="select-column">-</th>
                    <th class="nome-col" colspan="3">Nome</th>
                    <th class="operacao-col">Operações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cargos as $index => $cargo): ?>
                    <tr class="<?php echo ($index % 2 == 0) ? 'even-row' : 'odd-row'; ?>">
                        <td class="select-column">
                            <input type="checkbox" name="checkbox[]" value="<?php echo $cargo['idCargo']; ?>">
                        </td>
                        <td colspan="3">
                            <?php echo $cargo['descricao']; ?>
                        </td>
                        <td class="td-operacao">
                            <a href="../../model/modelCargo/cargoEdicao.php?idCargo=<?php echo $cargo['idCargo']; ?>">
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
    </section>

</body>

</html>