<?php
include_once('../../../controller/protect.php');
include_once('../../../configuration/connect.php');
include_once('../../../model/restauranteModel.php');


include_once('../../../controller/referenciaControllerEditar.php');
include_once('../../../controller/funcionarioController.php');
include_once('../../../controller/restauranteController.php');

if (isset($_GET['idFuncionario'])) {
    $idFuncionario = $_GET['idFuncionario'];
    $referenciaModel = new referenciaModel($link);
    $recuperar = $referenciaModel->recuperaReferencia($idFuncionario);
    $dados_referencias = $referenciaModel->read($idFuncionario);

    if ($recuperar) {
        $idFuncionario = $recuperar['idFuncionario'];
        $nomeFun = $recuperar['nomeFun'];
        $idRestaurante = $recuperar['idRestaurante'];
        $nomeRes = $recuperar['nomeRes'];
        $contato = $recuperar['contato'];
        $data_inicio = $recuperar['data_inicio'];
        $data_fim = $recuperar['data_fim'];
    } else {
        header("Location: pageRestaurante.php?mensagem=" . urlencode("Restaurante não encontrado."));
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Restaurante</title>
</head>

<body>
    <!-- Menu lateral - vem de outra página -->
    <?php require_once('../../components/menuSubFolders.php'); ?>


    <section class="conteiner-conteudo">
        <h1 class="titulo">Funcionário</h1>

        <p> Nome: <?php echo $nomeFun; ?> </p>
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
                    <?php foreach ($dados_referencias as $index => $referencia) : ?>
                        <tr class="<?php echo ($index % 2 == 0) ? 'even-row' : 'odd-row'; ?>">
                            <td>
                                <?php echo $referencia['nomeFun']; ?>
                            </td>
                            <td>
                                <?php echo $referencia['nomeRes']; ?>
                            </td>
                            <td>
                                <?php echo $referencia['contato']; ?>
                            </td>
                            <td>
                                <?php echo $referencia['data_inicio']; ?>
                            </td>
                            <td>
                                <?php echo $referencia['data_fim']; ?>
                            </td>
                            <td>
                                <a class="remover-referencia" href="pageRestauranteAlteracao.php?idFuncionario=<?php echo $referencia['idFuncionario']; ?>&idRestaurante=<?php echo $referencia['idRestaurante']; ?>&acao=delete">
                                    Remover </a>
                                <a onclick="editarReferencia(<?php echo $referencia['idFuncionario']; ?>, '<?php echo $referencia['idRestaurante']; ?>', '<?php echo $referencia['data_inicio']; ?>','<?php echo $referencia['data_fim']; ?>')" 
                                href="#" class="editar-restaurante"  id="btn-salvar-referencia"
                                data-idR="<?php echo $referencia['idRestaurante']; ?>" data-idF="<?php echo $referencia['idFuncionario']; ?>"> 
                                Editar </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <section class="conteiner-conteudo">
        <h1 class="titulo">Restaurante</h1>
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
            <div class="conteiner-abas">
                <!-- Formulário de Alteraçao -->
                <form method="POST" action="../../../controller/referenciaControllerEditar.php">
                    <div class="conteiner-dados">
                        <input type="hidden" name="acao" id="acao" value="salvar">
                        <input type="hidden" name="idFuncionario" id="idFuncionario" value="<?php echo $idFuncionario; ?>">
                        <input type="hidden" name="idRestaurante" id="idRestaurante" value="">
                        <!-- <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome" value="" required>
                        <label for="contato">Contato:</label>
                        <input type="text" id="contato" name="contato" value="" required> -->
                        <label for="restaurante">Data de Início</label>
                        <input type="date" name="data_inicio" id="data_inicio">
                        <label for="restaurante">Data de Fim</label>
                        <input type="date" name="data_fim" id="data_fim">
                    </div>
                    <br>
                    <div class="conteiner-operacoes">
                        <!-- Botão para salvar o cargo -->
                        <button type="submit" name="alterar" class="button" id="btn-salvar-referencia">Salvar</button>

                        <!-- Botão para cancelar e voltar à página principal -->
                        <a href="../pageRestaurante.php">Cancelar</a>
                    </div>
                </form>
            </div>


    </section>
    <script src="../../js/referencia.js"></script>
</body>

</html>