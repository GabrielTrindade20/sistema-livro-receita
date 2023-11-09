<?php

class funcionarioModel {
    private $link;
    private $erros = array();
    private $sucesso = array();

    public function __construct($link) {
        $this->link = $link;
    }

    public function getErros() {
        return $this->erros;
    }
    
    public function getSucesso() {
        return $this->sucesso;
    }

    public function validar_campos( $rg, $nome, $data_ingresso, $salario, $nome_fantasia, $situacao, $cargo ) {
        if (!empty($rg) && !empty($nome) && !empty($data_ingresso) && !empty($salario) && !empty($nome_fantasia) 
            && !empty($cargo) && !empty($situacao) ) {
            $rg = filter_var(FILTER_SANITIZE_SPECIAL_CHARS);
            $nome = filter_var(FILTER_SANITIZE_SPECIAL_CHARS);
            $data_ingresso = filter_var(FILTER_SANITIZE_SPECIAL_CHARS);
            $salario = filter_var(FILTER_SANITIZE_SPECIAL_CHARS);
            $nome_fantasia = filter_var(FILTER_SANITIZE_SPECIAL_CHARS);

            return array($rg, $nome, $data_ingresso, $salario, $nome_fantasia, $situacao, $cargo );
        } else {
            $this->erros[] = "Por gentileza, preencha todos os campos.";
            return false;
        }
    }//fim validar campos

    public function create( $rg, $nome, $data_ingresso, $salario, $nome_fantasia, $situacao, $cargo )
    {
        $query =   "INSERT INTO funcionario
                    (rg, nome, data_ingresso, salario, nome_fantasia, status, idCargo)
                    VALUE
                    (?, ?, ?, ?, ?, ?, ?);";

        // * Preparar a declaração
        $stmt = $this->link->prepare($query);

        // Verificar se a preparação da declaração foi bem-sucedida
        if ($stmt) {
            // Vincular os parâmetros da declaração com os valores
            $stmt->bind_param("ssssssi", $rg, $nome, $data_ingresso, $salario, $nome_fantasia, $status, $cargo );

            // Executar a declaração preparada
            if ($stmt->execute()) {
                $this->sucesso[] = "Cadastro efetuado com sucesso!";
                return true;
            } else {
                $this->erros[] = "Erro ao salvar: " . $stmt->error;
            }
            // Fechar a declaração preparada
            $stmt->close();
        } else {
            $this->erros[] = "Erro ao preparar a declaração: " . $this->link->error;
        }
    }// fim create
    
    public function read()
{
    $query =   "SELECT f.idFuncionario, f.rg, f.nome, f.data_ingresso, f.salario, f.nome_fantasia, f.situacao, c.descricao AS cargo
                FROM funcionario f
                JOIN Cargo c ON f.idCargo = c.idCargo;";
    $funcionarios = array();

    if ($result = mysqli_query($this->link, $query)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $funcionarios[] = $row;
        }
        mysqli_free_result($result);
    }

    return $funcionarios;
}
    }// fim read

    public function update( $id, $rg, $nome, $data_ingresso, $salario, $nome_fantasia, $situacao, $cargo )
    {
        $query =   "UPDATE funcionario 
                    SET rg = ?,
                    nome = ?,
                    data_ingresso = ?,
                    salario = ?,
                    nome_fantasia = ?,
                    situacao = ?,
                    idCargo = ?
                    WHERE idFuncionario = ?";

        $stmt = $this->link->prepare($query);

        if ($stmt) {
            $stmt->bind_param("ssssssii", $rg, $nome, $data_ingresso, $salario, $nome_fantasia, $situacao, $cargo, $id);

            if ($stmt->execute()) {
                $this->sucesso[] = "Atualização efetuada com sucesso!";
                return true;
            } else {
                $this->erros[] = "Erro ao atualizar: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $this->erros[] = "Erro ao preparar a declaração: " . $this->link->error;
        }

        return false;
    }// fim update

    public function situacao_inativo( $id, $situacao )
    {
        $query =   "UPDATE funcionario 
                    SET situacao = ?
                    WHERE idFuncionario = ?";
    
        $stmt = $this->link->prepare($query);
    
        if ($stmt) {
            $stmt->bind_param("si", $situacao, $id);
    
            if ($stmt->execute()) {
                $this->sucesso[] = "Inativo, atualização efetuada com sucesso!";
                return true;
            } else {
                $this->erros[] = "Erro ao excluir: " . $stmt->error;
            }
    
            $stmt->close();
        } else {
            $this->erros[] = "Erro ao preparar a declaração: " . $this->link->error;
        }
    
        return false; 
    }

    public function recuperaFuncionario($id)
    {
        // lista cursos já cadastrados
        $query =   "SELECT idFuncionario, rg, nome, data_ingresso, salario, nome_fantasia, situacao, idCargo
                    FROM funcionario
                    WHERE idFuncionario = '$id';";

        $resultado = mysqli_query($this->link, $query);

        if ($resultado) {
            return mysqli_fetch_assoc($resultado);
        } else {
            return null; // Retornar null em caso de erro na consulta
        }
    }// fim de recuperar

}// fim class
?>