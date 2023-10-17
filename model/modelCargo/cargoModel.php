<?php
$mensagem = ''; // Defina a variável com um valor padrão

class CargoModel
{
    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    public function criarCargo($nome)
    {
        $sql = "INSERT INTO cargo (nome) VALUES ('$nome')";
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

    public function obterCargoPorID($id)
    {
        $sql = "SELECT * FROM cargo WHERE idCargo = $id";
        $resultado = mysqli_query($this->conexao, $sql);

        if ($resultado) {
            return mysqli_fetch_assoc($resultado);
        } else {
            return null; // Retornar null em caso de erro na consulta
        }
    }

    public function atualizarCargo($id, $descricao)
    {
        $sql = "UPDATE cargo SET descricao = '$descricao' WHERE idCargo = $id";
        return mysqli_query($this->conexao, $sql);
    }





    public function excluirCargo($id)
    {
        $sql = "DELETE FROM cargo WHERE idCargo = $id";
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
        $sql = "INSERT INTO cargo (descricao) VALUES ('$descricaoCargo')";
        $resultado = mysqli_query($link, $sql);

        if ($resultado) {
            $mensagem = 'Cargo cadastrado com sucesso!';
            header("Location: ../../view/pageCargo.php?mensagem=" . urlencode($mensagem));
            exit();
        } else {
            $mensagem = 'Erro ao cadastrar o cargo.';
        }
    }
}

?>