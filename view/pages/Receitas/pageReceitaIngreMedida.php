<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once('../../../controller/protectSubFolders.php');
include_once('../../../controller/ingredienteController.php');
include_once('../../../controller/medidaController.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOSTRAP  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="../../components/style.css">

    <link rel="stylesheet" href="../../css/styleReceita.css">
    <link rel="icon" href="../../css/iconsSVG/iconReceita.svg">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <title>Lista de Ingredientes e Medidas</title>
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
            <div class="box-sair">
                <a href="pageReceitaCadastro.php">Voltar</a>
            </div>
            <div class="container text-center">
                <div class="row">
                    <div class="col">
                        <!-- Ingrediente -->
                        <section>
                            <div class="continer">
                                <div class="box-form">
                                    <h4>Ingrediente</h4>
                                    <!-- Formulário de Cadastro ingrediente-->
                                    <form method="POST" action="../../../controller/ingredienteController.php">
                                        <div class="conteiner-dados">
                                            <input type="hidden" name="acao" id="acao" value="salvar">
                                            <input type="hidden" name="idIngrediente" id="idIngrediente" value="">
                                            <div class="mb-3">
                                                <label for="nome" class="form-label">Nome Ingrediente</label>
                                                <input type="text" class="form-control form-control-sm" id="nome_ingrediente" name="nome_ingrediente" placeholder="" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="descricao" class="form-label">Descrição:</label>
                                                <input type="text" class="form-control form-control-sm" id="descricao" name="descricao">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" name="salvar_ingredientes" class="btn btn-primary">Salvar</button>
                                        </div>
                                    </form>
                                </div>

                                <div class="table-lista">
                                    <h4>Lista de Ingredientes</h4>
                                    <table class="table" id="table"  border="1">
                                        <thead>
                                            <tr>
                                                <th class="select-column"> </th>
                                                <th>Nome</th>
                                                <th>Descrição</th>
                                                <th class="operacao">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Gerando de acordo com o que foi cadastrado -->
                                            <?php foreach ($dados_ingredientes as $index => $ingrediente) : ?>
                                                <tr class="<?php echo ($index % 2 == 0) ? 'even-row' : 'odd-row'; ?>">
                                                    <td></td>
                                                    <td> <?php echo $ingrediente['nome']; ?> </td>
                                                    <td> <?php echo $ingrediente['descricao']; ?> </td>
                                                    <td>
                                                        <a onclick="" class="remover-restaurante" href="pageReceitaIngreMedida.php?idIngrediente=<?php echo $ingrediente['idIngrediente']; ?>&acao=delete">
                                                            <span class="material-symbols-outlined"> delete </span> 
                                                        </a>
                                                        <a onclick="editarIngrediente(<?php echo $ingrediente['idIngrediente'] ?>, '<?php echo $ingrediente['nome'] ?>', '<?php echo $ingrediente['descricao']; ?>')" href="#" class="editar-ingrediente" id="btn-salvar-ingrediente" data-id="<?php echo $ingrediente['idIngrediente']; ?>"> 
                                                            <span class="material-symbols-outlined"> edit </span> 
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col">
                        <!-- Medida -->
                        <section>

                            <div class="continer">
                                <div class="box-form">
                                    <h4>Medida</h4>
                                    <!-- Formulário de Cadastro -->
                                    <form method="POST" action="../../../controller/medidaController.php">
                                        <input type="hidden" name="acaoM" id="acaoM" value="salvarM">
                                        <input type="hidden" name="idMedida" id="idMedida" value="">
                                        <div class="mb-3">
                                            <label for="medida" class="form-label">Medida</label>
                                            <input type="text" class="form-control form-control-sm"  id="medida" name="medida" required>
                                        </div>

                                        <div class="mb-3">
                                            <button type="submit" name="salvar_medida" class="btn btn-primary">Salvar</button>
                                        </div>
                                    </form>
                                </div> 

                                <div class="table-lista">
                                    <h4>Lista de Medida</h4>
                                    <table class="table" id="table"  border="1">
                                        <thead>
                                            <tr>
                                                <th class="select-column"> </th>
                                                <th>Medida</th>
                                                <th class="operacao">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Gerando de acordo com o que foi cadastrado -->
                                            <?php foreach ($dados_medidas as $index => $medida) : ?>
                                                <tr class="<?php echo ($index % 2 == 0) ? 'even-row' : 'odd-row'; ?>">
                                                    <td></td>
                                                    <td> <?php echo $medida['descricao']; ?> </td>
                                                    <td>
                                                        <a onclick="" class="remover-medida" href="pageReceitaIngreMedida.php?idMedida=<?php echo $medida['idMedida'];  ?>&acao=deleteM">
                                                            <span class="material-symbols-outlined"> delete </span>  
                                                        </a>
                                                        <a onclick="editarMedida(<?php echo $medida['idMedida'] ?>, '<?php echo $medida['descricao']; ?>')" href="#" class="editar-medida" id="btn-salvar-medida" data-id="<?php echo $media['idMedida']; ?>">
                                                            <span class="material-symbols-outlined"> edit </span> 
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>




        </div>

        <script src="../../js/ingredienteAlteracao.js"></script>
        <script src="../../js/medidaAlteracao.js"></script>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>