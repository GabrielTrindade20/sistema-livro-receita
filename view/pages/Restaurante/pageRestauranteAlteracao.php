<?php
include_once('../../../controller/protect.php');
include_once('../../../configuration/connect.php');
include_once('../../../model/restauranteModel.php');


include_once('../../../controller/referenciaControllerEditar.php');
include_once('../../../controller/funcionarioController.php');
include_once('../../../controller/restauranteController.php');

if (isset($_GET['idRestaurante'])) {
    $idRestaurante = $_GET['idRestaurante'];
    $restauranteModel = new restauranteModel($link);
    $recuperar = $restauranteModel->recuperaRestaurante($idRestaurante);

    if ($recuperar) {
        $nome = $recuperar['nome'];
        $contato = $recuperar['contato'];
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
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Restaurante</title>
</head>

<body>
    <!-- Menu lateral - vem de outra página -->
    <?php require_once('../../components/menuSubFolders.php'); ?>  


    <section class="conteiner-conteudo">
        <h1 class="titulo">Funcionário</h1>

        <div class="conteiner-abas">
            <!-- Formulário de Alteraçao -->
            <table class="table" border="1" align="right">
                <thead>
                    <tr>
                        <th class="select-column">-</th>
                        <th>NOME</th>
                        <th class="operacao" colspan="2">OPERAÇÔES</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Tabela de funcionario -->
                    <?php foreach ($funcionarios as $index => $funcionario): ?>
                        <tr class="<?php echo ($index % 2 == 0) ? 'even-row' : 'odd-row'; ?> funcionario-row" data-id="<?php echo $funcionario['idFuncionario']; ?>">
                            <td class="select-column">
                                <input type="checkbox" name="checkbox[]" value="<?php echo $funcionario['idFuncionario']; ?>">
                            </td>
                            <td>
                                <?php echo $funcionario['nome']; ?>
                            </td>
                            
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>   
    </section>

    <section class="conteiner-conteudo">
        <h1 class="titulo">Restaurante</h1>

        <div class="conteiner-abas">
            <!-- Formulário de Alteraçao -->
            <form method="POST" action="../../../controller/restauranteController.php">
                <div class="conteiner-dados">
                    <input type="hidden" name="idRestaurante" value="<?php echo $recuperar["idRestaurante"];?>">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" value="<?php echo isset($nome) ? $nome : ''; ?>" required>
                    <label for="contato">Contato:</label>
                    <input type="text" id="contato" name="contato" value="<?php echo isset($contato) ? $contato : ''; ?>" required>
                </div>
                <br>
                <div class="conteiner-operacoes">
                    <!-- Botão para salvar o cargo -->
                    <button type="submit" name="alterar" class="button">Salvar</button>

                    <!-- Botão para cancelar e voltar à página principal -->
                    <a href="../pageRestaurante.php">Cancelar</a>
                </div>
            </form>
        </div>   
    </section>

    
    <section class="conteiner-referencia" align="right">
        <div class="box-search">
            <h2>Cadastro de Restaurante<h2>

                    <div class="box-input-search">
                        <input type="search" name="pesquisar" id="pesquisarReferencia" placeholder="Pesquisar">
                        <button onclick="searchData()">pesquisar</button>
                    </div>
        </div>

        <div class="conteiner-table" align="right">
            <h3>Restaurantes</h3>

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
                                <button class="adicionar-restaurante" data-nome="<?php echo $restaurante['nome']; ?>" data-id="<?php echo $restaurante['idRestaurante']; ?>"> Adicionar + </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="box-form-referencia">
            <form id="form2" method="POST" action="../../../controller/referenciaControllerEditar.php" data-idFuncionario="<?php echo $idFuncionario; ?>" >
                <div class="form-input">
                    <input type="hidden" name="acao" id="acao" value="salvar"> 
                    <input type="hidden" name="idFuncionario" id="idFuncionario" value="<?php echo $idFuncionario; ?>">
                    <input type="hidden" name="idRestaurante" id="idRestaurante">
                    <label for="restaurante">Restaurante</label>
                    <input type="text" name="restaurante" id="restaurante">
                    <br>
                    <label for="restaurante">Data de Início</label>
                    <input type="date" name="data_inicio" id="data_inicio">
                    <br>
                    <label for="restaurante">Data de Fim</label>
                    <input type="date" name="data_fim" id="data_fim">
                </div>

                <div class="box-button">
                    <button type="submit" name="salvar_restaurante_novo" value="salvar_restaurante_novo" class="salvar-edicao-nova" id="btn-salvar-restaurante">Salvar restaurante</button>
                </div>
            </form>
        </div>

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
                    <?php foreach ($dados_referencia as $referencia) : ?>
                        <tr>
                            <td><?php echo $referencia['idFuncionario']; ?></td>
                            <td><?php echo $referencia['idRestaurante']; ?></td>
                            <td><?php echo $referencia['nome']; ?></td>
                            <td><?php echo $referencia['data_inicio'] = implode("/",array_reverse(explode("-", $referencia['data_inicio']))); ; ?></td>
                            <td><?php echo $referencia['data_fim'] = implode("/",array_reverse(explode("-", $referencia['data_fim']))); ; ?></td>
                            <td>
                                <a onclick="" class="remover-restaurante" href="pageFuncionarioAlteracao.php?idFuncionario=<?php echo $idFuncionario; ?>&idRestaurante=<?php echo  $referencia['idRestaurante']; ?>&acao=delete"> Remover </a>
                                <a onclick="editarRestaurante(<?php echo $referencia['idRestaurante']; ?>, '<?php echo $referencia['nome']; ?>', '<?php echo $referencia['data_inicio']; ?>', '<?php echo $referencia['data_fim']; ?>')"
                                href="#" class="editar-restaurante"  id="btn-salvar-restaurante"> Editar </a>
                            </td>
                            
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
    <script src="../../js/funcioanrioAlteracao.js"></script>
</body>
</html>