<?php

class referenciaModel
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

    public function validar_campos($data_inicio, $data_fim)
    {
        if (!empty($data_inicio) && !empty($data_fim)) {
            return array($data_inicio, $data_fim);
        } else {
            $this->erros[] = "Por gentileza, preencha todos os campos.";
            return false;
        }
    } //fim validar campos

    public function create($idFuncionario, $idRestaurante, $dataInicio, $dataFim)
    {
        $query = "INSERT INTO referencia 
                    (idFuncionario, idRestaurante, data_inicio, data_fim) 
                    VALUES
                    (?, ?, ?, ?);";

        // * Preparar a declaração
        $stmt = $this->link->prepare($query);

        // Verificar se a preparação da declaração foi bem-sucedida
        if ($stmt) {
            // Vincular os parâmetros da declaração com os valores
            $stmt->bind_param('iiss', $idFuncionario, $idRestaurante, $dataInicio, $dataFim);

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

    public function read($idFuncionario)
    {
        $query = "SELECT r.idFuncionario, r.data_inicio, r.data_fim, rr.nome AS restaurante
                    FROM referencia r
                    JOIN restaurante rr ON r.idRestaurante = rr.idRestaurante
                    WHERE r.idFuncionario = ?;";

        $referencias = array();

        // * Preparar a declaração
        $stmt = $this->link->prepare($query);

        // Verificar se a preparação da declaração foi bem-sucedida
        if ($stmt) {
            // Vincular o parâmetro da declaração com o valor
            $stmt->bind_param("i", $idFuncionario);

            // Executar a declaração preparada
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    $referencias[] = $row;
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

        return $referencias;
    }

    public function update($idFuncionario, $idRestaurante, $data_inicio, $data_fim)
    {
        $query = "UPDATE referencia 
              SET idRestaurante = ?, data_inicio = ?, data_fim = ?
              WHERE idFuncionario = ?;";

        $stmt = $this->link->prepare($query);

        if ($stmt) {
            $stmt->bind_param("issi", $idRestaurante, $data_inicio, $data_fim, $idFuncionario);

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

    public function delete($idFuncionario, $idRestaurante)
    {
        $query = "DELETE 
                    FROM referencia 
                    WHERE idFuncionario = ? AND
                    idRestaurante = ?;";

        $stmt = $this->link->prepare($query);

        if ($stmt) {
            $stmt->bind_param("ii", $idFuncionario, $idRestaurante);

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
    } // fim delete

    public function recuperaReferencia($idFuncionario, $idRestaurante)
    {
        // lista cursos já cadastrados
        $query = "SELECT idFuncionario, idRestaurante, data_inicio, data_fim
                    FROM referencia
                    WHERE idFuncionario = '$idFuncionario'
                    AND idRestaurante = '$idRestaurante';";

        $resultado = mysqli_query($this->link, $query);

        if ($resultado) {
            return mysqli_fetch_assoc($resultado);
        } else {
            return null; // Retornar null em caso de erro na consulta
        }
    } // fim de recuperar

    public function pegarUltimoIdFuncionario()
    {
        $sql = "SELECT idFuncionario FROM funcionario  
                WHERE idFuncionario = (select max(idFuncionario) from funcionario);";

        $result = mysqli_query($this->link, $sql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['idFuncionario'];
        } else {
            return false; // Ou qualquer outro valor que indique um erro
        }
    }


} // fim class
?>