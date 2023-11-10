<?php
$mensagem = ''; // Defina a variável com um valor padrão
class FuncionarioModel
{
    private $conexao;
    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }
    public function criarFuncionario($rg, $nome, $data_ingresso, $salario, $nome_fantasia, $idCargo)
    {
        $sql = "INSERT INTO funcionarios (rg, nome, data_ingresso, salario, nome_fantasia, idCargo, situacao) VALUES ('$rg', '$nome', '$data_ingresso', '$salario', '$nome_fantasia', '$idCargo', 'Ativo')";
        return mysqli_query($this->conexao, $sql);
    }
    public function listarFuncionarios()
    {
        $sql = "SELECT * FROM funcionarios";
        $resultado = mysqli_query($this->conexao, $sql);
        $funcionarios = [];
        while ($row = mysqli_fetch_assoc($resultado)) {
            $funcionarios[] = $row;
        }
        return $funcionarios;
    }
    public function obterFuncionarioPorID($id)
    {
        $sql = "SELECT * FROM funcionarios WHERE idFuncionario = $id";
        $resultado = mysqli_query($this->conexao, $sql);
        if ($resultado) {
            return mysqli_fetch_assoc($resultado);
        } else {
            return null; // Retornar null em caso de erro na consulta
        }
    }
    public function atualizarFuncionario($id, $nome, $pseudonimo, $cargo)
    {
        $sql = "UPDATE funcionarios SET nome = '$nome', pseudonimo = '$pseudonimo', cargo = '$cargo' WHERE idFuncionario = $id";
        return mysqli_query($this->conexao, $sql);
    }
    public function excluirFuncionario($id)
    {
        $sql = "DELETE FROM funcionarios WHERE idFuncionario = $id";
        return mysqli_query($this->conexao, $sql);
    }
}
// Verifique se o formulário foi enviado
if (isset($_POST['salvar'])) {
    // Obtenha os dados do funcionário do formulário
    $nome = $_POST['nome'];
    $pseudonimo = $_POST['pseudonimo'];
    $cargo = $_POST['cargo'];
    // Verifique se os dados do funcionário não estão vazios
    if (empty($nome) || empty($pseudonimo) || empty($cargo)) {
        $mensagem = 'Por favor, preencha todos os campos.';
    } else {
        // Prepare e execute a consulta SQL para inserir o novo funcionário
        $sql = "INSERT INTO funcionarios (nome, pseudonimo, cargo) VALUES ('$nome', '$pseudonimo', '$cargo')";
        $resultado = mysqli_query($link, $sql);
        if ($resultado) {
            $mensagem = 'Funcionário cadastrado com sucesso!';
            header("Location: ../../view/pageFuncionario.php?mensagem=" . urlencode($mensagem));
            exit();
        } else {
            $mensagem = 'Erro ao cadastrar o funcionário.';
        }
    }
}
?>