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
    <link rel="stylesheet" href="../css/stylePesq.css">
    <link rel="stylesheet" href="../css/styleTable.css">
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

    <div id="sub-titulo">
        <a href="">links paginas</a>
    </div>

    <section class="conteiner-pesquisa">

        <div class="titulos" id="titulo">
            <div class="conteiner-titulo">
                <div>
                    <h1>Lista de Cargos</h1>
                </div>

                <div class="info-receitas">
                    <a href="#">
                        <?php echo "($numCargos) Cargos"; ?>
                    </a>
                </div>
            </div>

            <div class="search-container">
                <div class="search-box">
                    <form method="post" action="#">
                        <div class="search-box-input-container">
                            <input type="text" class="search-box-input" name="busca" placeholder="Pesquisa">
                            <button class="search-box-button"><i class="search-box-icone icon icon-search"></i></button>
                        </div>
                    </form>
                </div>

                <div class="button-nova">
                    <a href="Cargo/cargoCadastro.php">
                        <button class="nova-receita-button">Cadastrar</button>
                    </a>
                </div>
            </div><!-- Search -->
        </div>
    </section>

    <section class="conteiner-conteudo">

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