<?php
include_once('../../../controller/protectSubFolders.php');
include_once('../../../configuration/connect.php');
include_once('../../../model/restauranteModel.php');


include_once('../../../controller/referenciaControllerEditar.php');
include_once('../../../controller/funcionarioController.php');
include_once('../../../controller/restauranteController.php');

if (isset($_GET['idFuncionario'])) {
    $idFuncionario = $_GET['idFuncionario'];
    $referenciaModel = new referenciaModel($link);
    $recuperarNome = $referenciaModel->pegarNomedFuncionario($idFuncionario);
    $dados_referencias = $referenciaModel->read($idFuncionario);

    // $stringVar = var_export($recuperar, true);
    // highlight_string("<?php\n\$recuperar = $stringVar;\n");
    // if($recuperar) {
    //     $nomeFun = $recuperar['nomeFun'];
    // }

}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOSTRAP  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="../../css/styleAllConteinerPages.css">
    <link rel="stylesheet" href="../../css/styleRestaurante.css">

    <link rel="icon" href="../../css/iconsSVG/iconReceita.svg">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Restaurante</title>

</head>

<body>
    <!-- Menu lateral - vem de outra página -->
    <?php require_once('../../components/menuSubFolders2.php'); ?>


    <section class="conteiner-conteudo-cadastro">
        <div class="titulo-res">
            <h1>Informações</h1>
        </div>


        <div class="conteiner-abas">


            <!-- Formulário de Alteraçao -->
            <form method="POST" action="../../../controller/referenciaControllerEditar.php">
                <div class="infor-fun">
                    <h2>Funcionário</h2>
                    <p> Nome: <?php echo $recuperarNome; ?> </p>
                </div>
                <div class="conteiner-dados">
                    <input type="hidden" name="acao" id="acao" value="salvar">
                    <input type="hidden" name="idFuncionario" id="idFuncionario" value="<?php echo $idFuncionario; ?>">
                    <input type="hidden" name="idRestaurante" id="idRestaurante" value="">
                    <label for="restaurante">Data de Início</label>
                    <input type="date" name="data_inicio" id="data_inicio">
                    <label for="restaurante">Data de Fim</label>
                    <input type="date" name="data_fim" id="data_fim">
                </div>

                <div class="conteiner-operacoes">
                    <!-- Botão para salvar o cargo -->
                    <button type="submit" name="alterar" class="button" id="btn-salvar-referencia">Salvar</button>

                    <!-- Botão para cancelar e voltar à página principal -->
                    <a href="../pageRestaurante.php">Cancelar</a>
                </div>
            </form>
            <!-- Notificação de erro ou não -->
            <div class="mensagens">
                <?php
                if (isset($_SESSION["errosE"])) {
                    $erro = $_SESSION["errosE"];
                    echo $erro . "<br>";

                    unset($_SESSION["errosE"]);
                } elseif (isset($_SESSION["sucessoE"])) {
                    $sucesso = $_SESSION["sucessoE"];
                    echo $sucesso . "<br>";

                    unset($_SESSION["sucessoE"]);
                }
                ?>
            </div>
            <div class="infor-fun">
                <h2>Restaurantes Cadastrados</h2>
            </div>

            <div class="scrollable">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="select-column">Restaurantes</th>
                            <th>Contato</th>
                            <th>Data início</th>
                            <th>Data fim</th>
                            <th class="operation">Operações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Tabela de restaurantes csdastrado -->
                        <?php foreach ($dados_referencias as $index => $referencia) : ?>
                            <tr>
                                <td>
                                    <?php echo $referencia['nomeRes']; ?>
                                </td>
                                <td>
                                    <?php echo $referencia['contato']; ?>
                                </td>
                                <td>
                                    <?php echo $referencia['data_inicio'] = implode("/", array_reverse(explode("-", $referencia['data_inicio']))); ?>
                                </td>
                                <td>
                                    <?php echo $referencia['data_fim'] = implode("/", array_reverse(explode("-", $referencia['data_fim'])));  ?>
                                </td>
                                <td class="operation">
                                    <a onclick="editarReferencia(<?php echo $referencia['idFuncionario']; ?>, '<?php echo $referencia['idRestaurante']; ?>', '<?php echo $referencia['data_inicio']; ?>','<?php echo $referencia['data_fim']; ?>')" href="#" class="editar-restaurante" id="btn-salvar-referencia" data-idR="<?php echo $referencia['idRestaurante']; ?>" data-idF="<?php echo $referencia['idFuncionario']; ?>">
                                        <span class="material-symbols-outlined"> edit </span>
                                    </a>
                                    <a class="remover-referencia" href="pageRestauranteAlteracao.php?idFuncionario=<?php echo $referencia['idFuncionario']; ?>&idRestaurante=<?php echo $referencia['idRestaurante']; ?>&acao=delete">
                                        <span class="material-symbols-outlined"> delete </span>
                                    </a>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>


    </section>
    <script src="../../js/referencia.js"></script>
</body>

</html>