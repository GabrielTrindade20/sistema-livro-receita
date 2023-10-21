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

    public function validar_campos( $rg, $nome, $data_ingresso, $salario, $nome_fantasia, $cargo ) {
        if (!empty($rg) && !empty($nome) && !empty($data_ingresso) && !empty($salario) && !empty($nome_fantasia) && !empty($cargo)) {
            $rg = filter_var(FILTER_SANITIZE_SPECIAL_CHARS);
            $nome = filter_var(FILTER_SANITIZE_SPECIAL_CHARS);
            $data_ingresso = filter_var(FILTER_SANITIZE_SPECIAL_CHARS);
            $salario = filter_var(FILTER_SANITIZE_SPECIAL_CHARS);
            $nome_fantasia = filter_var(FILTER_SANITIZE_SPECIAL_CHARS);
            //$cargo = filter_var(FILTER_SANITIZE_SPECIAL_CHARS);
            return array($rg, $nome, $data_ingresso, $salario, $nome_fantasia, $cargo);
        } else {
            $this->erros[] = "Por gentileza, preencha todos os campos.";
            return false;
        }
    }//fim validar campos

    public function create( $rg, $nome, $data_ingresso, $salario, $nome_fantasia, $cargo )
    {
        $query =   "INSERT INTO funcionario
                    (rg, nome, data_ingresso, salario, nome_fantasia, idCargo)
                    VALUE
                    (?, ?, ?, ?, ?, ?);";

        // * Preparar a declaração
        $stmt = $this->link->prepare($query);

        // Verificar se a preparação da declaração foi bem-sucedida
        if ($stmt) {
            // Vincular os parâmetros da declaração com os valores
            $stmt->bind_param("sssssi", $rg, $nome, $data_ingresso, $salario, $nome_fantasia, $cargo );

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
    
    public function read( )
    {
        $query =   "SELECT f.idFuncionario, f.rg, f.nome, f.data_ingresso, f.salario, f.nome_fantasia, c.descricao AS cargo
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
    }// fim read

    public function update( $id, $rg, $nome, $data_ingresso, $salario, $nome_fantasia, $cargo )
    {
        $query =   "UPDATE funcionario 
                    SET rg = ?,
                    nome = ?,
                    data_ingresso = ?,
                    salario = ?,
                    nome_fantasia = ?,
                    idCargo = ?
                    WHERE idFuncionario = ?";

        $stmt = $this->link->prepare($query);

        if ($stmt) {
            $stmt->bind_param("sssssii", $rg, $nome, $data_ingresso, $salario, $nome_fantasia, $cargo, $id);

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

    public function delete( $id )
    {
        $query =   "DELETE 
                    FROM funcionario 
                    WHERE idFuncionario = ?";

        $stmt = $this->link->prepare($query);

        if ($stmt) {
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                $this->sucesso[] = "Exclusão efetuada com sucesso!";
                return true;
            } else {
                $this->erros[] = "Erro ao excluir: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $this->erros[] = "Erro ao preparar a declaração: " . $this->link->error;
        }

        return false; 
    }// fim delete

    public function recuperaFuncionario($id)
    {
        // lista cursos já cadastrados
        $query =   "SELECT idFuncionario, rg, nome, data_ingresso, salario, nome_fantasia, idCargo
                    FROM funcionario
                    WHERE idFuncionario = '$id';";

        $resultado = mysqli_query($this->link, $query);

        if ($resultado) {
            return mysqli_fetch_assoc($resultado);
        } else {
            return null; // Retornar null em caso de erro na consulta
        }
    }// fim de recuperar

    public function search($descricao)
    {
        $query = "SELECT * FROM categoria WHERE descricao LIKE ?";
        $stmt = $this->link->prepare($query);

        if ($stmt) {
            $descricao = "%" . $descricao . "%"; // Adicione curingas à descrição
            $stmt->bind_param("s", $descricao);

            if ($stmt->execute()) {
                $result = $stmt->get_result(); // Obter o conjunto de resultados

                // Você pode iterar pelos resultados da seguinte maneira:
                // while ($row = $result->fetch_assoc()) {
                //     // Processar cada linha do resultado aqui
                // }
                
                // Se você deseja retornar os resultados como um array, você pode fazer algo como:
                $resultsArray = $result->fetch_all(MYSQLI_ASSOC);
                
                $stmt->close();
                
                return $resultsArray;
            } else {
                $this->erros[] = "Erro ao pesquisar: " . $stmt->error;
            }
        } else {
            $this->erros[] = "Erro ao preparar a declaração: " . $this->link->error;
        }
        
        return false;
    }

    

}// fim class
?>