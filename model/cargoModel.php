<?php
$mensagem = ''; // Defina a variável com um valor padrão

class CargoModel
{
    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    public function criarCargo($cargo)
    {
        $sql = "INSERT INTO cargo (cargo) VALUES ('$cargo')";
        return mysqli_query($this->conexao, $sql);
    }

    public function listarCargos()
    {
        $sql = "SELECT * FROM cargo";
        $resultado = mysqli_query($this->conexao, $sql);
        $cargos = [];

        while ($row = mysqli_fetch_assoc($resultado)) {
            $cargos[] = $row;
        }

        return $cargos;
    }

    public function atualizarCargo($id, $novocargo)
    {
        $sql = "UPDATE cargos SET cargo = '$novocargo' WHERE id = $id";
        return mysqli_query($this->conexao, $sql);
    }

    public function excluirCargo($id)
    {
        $sql = "DELETE FROM cargos WHERE id = $id";
        return mysqli_query($this->conexao, $sql);
    }
}

// Verifique se o formulário foi enviado
if (isset($_POST['salvar'])) {
    // Obtenha a descrição do cargo do formulário
    $descricaoCargo = $_POST['nome'];

    // Verifique se a descrição do cargo não está vazia
    if (empty($descricaoCargo)) {
        $mensagem = 'Por favor, preencha a descrição do cargo.';
    } else {
        // Prepare e execute a consulta SQL para inserir o novo cargo
        $sql = "INSERT INTO cargo (cargo) VALUES ('$descricaoCargo')";
        $resultado = mysqli_query($link, $sql);

        if ($resultado) {
            $mensagem = 'Cargo cadastrado com sucesso!';
        } else {
            $mensagem = 'Erro ao cadastrar o cargo.';
        }
    }
}
?>