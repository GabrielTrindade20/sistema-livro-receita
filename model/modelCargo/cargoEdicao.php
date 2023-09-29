<?php
include_once('../../configuration/connect.php');
include_once('cargoModel.php');

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

<!-- Estrutura do formulário de edição -->
<section class="container-conteudo">
    <h1>Editar Cargo</h1>
    <form method="POST" action="atualizar_cargo.php">
        <label for="nome">Nome do Cargo:</label>
        <input type="text" id="descricao" name="descricao"
            value="<?php echo isset($descricaoCargo) ? $descricaoCargo : ''; ?>" required>
        <input type="hidden" name="idCargo" value="<?php echo $idCargo; ?>">
        <button type="submit" name="editar">Editar</button>
        <a href="pageCargo.php">Cancelar</a>
    </form>
</section>