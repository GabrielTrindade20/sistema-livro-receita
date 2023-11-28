<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once('../../../controller/protectSubFolders.php');
include_once('../../../configuration/connect.php');
include_once('../../../controller/receitaController.php');
include_once('../../../controller/receitaComposicaoController.php');
include_once('../../../model/fotoModel.php');
include_once('../../../model/receitaModel.php');
include_once('../../../model/composicaoModel.php');


if (isset($_GET['nome_receita'])) {
    $nome_receita = $_GET['nome_receita'];
    $receitaModel = new receitaModel($link);
    $recuperar = $receitaModel->viewReceita($nome_receita);

    $composicaoModel = new composicaoModel($link);
    $recuperar_composicao = $composicaoModel->recuperaReceitaComposicao($nome_receita);


    if ($recuperar) {
        $nome_receita = $recuperar["nome_receita"];
        $data_criacao = $recuperar["data_criacao"];
        $modo_preparo = $recuperar["modo_preparo"];
        $qtd_porcao = $recuperar["qtd_porcao"];
        $degustador = $recuperar["nome_degustador"];
        $data_degustacao = $recuperar["data_degustacao"];
        $nota_degustacao = $recuperar["nota_degustacao"];
        $ind_inedita = $recuperar["ind_inedita"];
        $id_cozinheiro = $recuperar["nome_cozinheiro"];
        $id_categoria = $recuperar["categoria_nome"];
        $id_foto_receita = $recuperar["nome_foto"];
        $path_foto_receita = $recuperar["path_foto"];
    }

    if (isset($id_foto_receita) && isset($path_foto_receita)) {
        // Verifica se o arquivo da foto existe no repositório
        if (file_exists($path_foto_receita)) {
            $id_foto_receita =  $id_foto_receita;
            $img_receita = "<img src=" . $path_foto_receita . " >";
        } else {
            $img_receita = '';
            $erroFoto = "Foto não encontrada no repositório.";
        }
    } else {
        $img_receita = '';
        $erroFoto = "Dados da foto não disponíveis.";
    }
} else {
    header("Location: pageReceita.php?mensagem=" . urlencode("Receita não encontrado."));
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOSTRAP  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="../../components/style.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link rel="stylesheet" href="../../css/styleAllConteinerPages.css">
    <link rel="stylesheet" href="../../css/styleReceita.css">
    <link rel="icon" href="../../css/iconsSVG/iconReceita.svg">

    <title>Receita Visualização</title>
</head>

<body>
    <!-- Menu lateral -->
    <?php include '../../components/menuSub1.php';
    ?>
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
                <a href="../pageReceitas.php"> Receitas </a> >
                <a href="#" class="pagina-atual"> Receita Visualização</a>
            </div>
            <div class="view_receita">
                <div class="container mt-4">
                    <?php if (isset($erroFoto)) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $erroFoto; ?>
                        </div>
                    <?php } else { ?>
                        <div class="row">

                            <div class="box-foto">
                                <?php echo $img_receita; ?>
                            </div>

                            <?php } ?>

                            <h2><?php echo $nome_receita; ?></h2>
                            <p><strong>Data de Criação:</strong> <?php echo date('d/m/Y', strtotime($data_criacao)); ?></p>
                            <p><strong>Quantidade por Porção:</strong> <?php echo $qtd_porcao; ?></p>
                            <p><strong>Degustador:</strong> <?php echo $degustador; ?></p>
                            <p><strong>Data de Degustação:</strong> <?php echo ($data_degustacao) ? date('d/m/Y', strtotime($data_degustacao)) : 'N/A'; ?></p>
                            <p><strong>Nota de Degustação:</strong> <?php echo ($nota_degustacao) ? $nota_degustacao : 'N/A'; ?></p>
                            <p><strong>Receita Inédita:</strong> <?php echo ($ind_inedita === 'S') ? 'Sim' : 'Não'; ?></p>
                            <p><strong>Criado por:</strong> <?php echo $id_cozinheiro; ?></p>
                            <p><strong>Categoria:</strong> <?php echo $id_categoria; ?></p>
                            
                        <div>
                        <p><strong>Ingredientes:</strong></p>
                            <!-- Gerando de acordo com o que foi cadastrado -->
                            <?php foreach ($recuperar_composicao as $index => $composicao) : ?>
                                <p>
                                <?php echo $composicao['qtd_medida']; ?>
                                <?php echo $composicao['descricao']; ?>
                                <?php echo $composicao['nome']; ?>
                                </p>
                            <?php endforeach; ?>
                        </div>

                            <div class="modo-preparo">
                                <strong>Modo de Preparo</strong>
                                <p><?= nl2br($modo_preparo) ?></p>
                            </div>

                        </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- BOOSTRAP JAVASCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>