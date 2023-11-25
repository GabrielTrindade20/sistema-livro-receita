<?php

class composicaoModel
{
    private $link;
    private $erros = array();
    private $sucesso = array();

    public function __construct($link)
    {
        $this->link = $link;
    }

    public function getErros()
    {
        return $this->erros;
    }

    public function getSucesso()
    {
        return $this->sucesso;
    }


    public function create($nome_receita, $ingrediente, $medida, $quantidade)
    {
        $query =   "INSERT INTO composicao
                    (nome_receita, idIngrediente, idMedida, qtd_medida)
                    VALUE
                    (?, ?, ?, ?);";

        // * Preparar a declaração
        $stmt = $this->link->prepare($query);

        // Verificar se a preparação da declaração foi bem-sucedida
        if ($stmt) {
            // Vincular os parâmetros da declaração com os valores
            $stmt->bind_param(
                "siii",
                $nome_receita,
                $ingrediente,
                $medida,
                $quantidade
            );

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
    } // fim create

    public function read($nome_receita)
    {
        $query =   "SELECT composicao.nome_receita, composicao.idIngrediente, ingrediente.nome, composicao.idMedida, medida.descricao, composicao.qtd_medida
        FROM composicao
        JOIN receita ON composicao.nome_receita = receita.nome_receita
        JOIN ingrediente ON composicao.idIngrediente = ingrediente.idIngrediente
        JOIN medida ON composicao.idMedida = medida.idMedida
        WHERE composicao.nome_receita = ?;";

        $composicao = array();

        // * Preparar a declaração
        $stmt = $this->link->prepare($query);

        // Verificar se a preparação da declaração foi bem-sucedida
        if ($stmt) {
            // Vincular o parâmetro da declaração com o valor
            $stmt->bind_param("s", $nome_receita);

            // Executar a declaração preparada
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    $composicao[] = $row;
                }
                $result->free();
            } else {
                $this->erros[] = "Erro ao consultar: " . $stmt->error;
            }

            // Fechar a declaração preparada
            $stmt->close();
        } else {
            $this->erros[] = "Erro ao preparar a declaração: " . $this->link->error;
        }

        return $composicao;
    } // fim read

    public function update($id, $rg, $nome, $data_ingresso, $salario, $nome_fantasia, $situacao, $cargo)
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
    } // fim update

    public function recuperaDegustador()
    {
        // lista cursos já cadastrados
        $query =   "SELECT f.idFuncionario, f.nome, c.descricao AS cargo
                    FROM funcionario f
                    JOIN Cargo c ON f.idCargo = c.idCargo
                    WHERE c.descricao = 'Desgustador';";

        $resultado = mysqli_query($this->link, $query);

        if ($resultado) {
            return mysqli_fetch_assoc($resultado);
        } else {
            return null; // Retornar null em caso de erro na consulta
        }
    } // fim de recuperaDegustador

}// fim class
