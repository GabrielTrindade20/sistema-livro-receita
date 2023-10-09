<?php
include_once('../../configuration/connect.php');
include_once('cargoModel.php');
include_once('../../controller/protectSubFolders.php');

$mensagem = '';

// Verifique se o ID do cargo foi passado na URL
if (isset($_GET['idCargo'])) {
    $idCargo = $_GET['idCargo'];

    // Crie uma instância do modelo CargoModel
    $cargoModel = new CargoModel($link);

    // Consulta SQL para obter os detalhes do cargo com base no ID
    $cargo = $cargoModel->obterCargoPorID($idCargo);

    // Verifique se o cargo foi encontrado
    if ($cargo) {
        // O cargo foi encontrado, agora você pode preencher o formulário com os dados do cargo
        $descricaoCargo = $cargo['descricao'];
    } else {
        // O cargo não foi encontrado, trate o erro aqui, por exemplo, redirecionando de volta à página anterior
        header("Location: pageCargo.php?mensagem=" . urlencode("Cargo não encontrado."));
        exit();
    }
} else {
    // O ID do cargo não foi passado na URL, trate o erro aqui, por exemplo, redirecionando de volta à página anterior
    header("Location: pageCargo.php?mensagem=" . urlencode("ID do cargo não fornecido."));
    exit();
}
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../view/css/styleMenu.css">
    <link rel="stylesheet" href="../../view/css/cssEdicao/styleEdicaoCarg.css">
    <link rel="icon" href="../../view/css/iconsSVG/iconReceita.svg">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Página Principal</title>
</head>
<body>
    <!-- Menu lateral - vem de outra página -->
    <?php require_once('../../view/components/menuSubFolders.php') ?>  

    <!-- Estrutura do formulário de edição -->
    <section class="container-conteudo">
        <div>
            <h1>Editar Cargo</h1>
        </div>

        <div class="conteiner-abas">
            <h2>Nome do Cargo</h2>
            <form method="POST" action="atualizar_cargo.php">

                <div class="conteiner-dados">
                    <label for="nome">Nome do Cargo:</label>
                    <input type="text" id="descricao" name="descricao"
                        value="<?php echo isset($descricaoCargo) ? $descricaoCargo : ''; ?>" required>
                </div>
                <br>

                <div class="conteiner-operacoes">
                    <input type="hidden" name="idCargo" value="<?php echo $idCargo; ?>">
                    <button type="submit" name="editar">Editar</button>
                    
                    <a href="../../view/pages/pageCargo.php">Cancelar</a>
                </div>
            </form>
        </div>
    </section>


</body>

</html>