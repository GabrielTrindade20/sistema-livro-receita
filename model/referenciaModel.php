<?php

class referenciaModel
{
    private $link;
    private $erros = array();
    private $sucesso = array();
    public $verificaSim;
    public $verificaNao;

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
        $query = "SELECT funcionario.idFuncionario, funcionario.nome as nomeFun, restaurante.idRestaurante, restaurante.nome as nomeRes,  restaurante.contato, referencia.data_inicio, referencia.data_fim
        FROM funcionario
        INNER JOIN referencia ON funcionario.idFuncionario = referencia.idFuncionario
        INNER JOIN restaurante ON referencia.idRestaurante = restaurante.idRestaurante
        WHERE funcionario.idFuncionario = ?;";

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
              WHERE idFuncionario = ? AND idRestaurante= ?;";

        $stmt = $this->link->prepare($query);

        if ($stmt) {
            $stmt->bind_param("issii", $idRestaurante, $data_inicio, $data_fim, $idFuncionario, $idRestaurante);

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

    public function recuperaReferencia($idFuncionario)
    {
        $query =   "SELECT funcionario.idFuncionario, funcionario.nome as nomeFun, restaurante.idRestaurante, restaurante.nome as nomeRes,  restaurante.contato, referencia.data_inicio, referencia.data_fim
        FROM funcionario
        INNER JOIN referencia ON funcionario.idFuncionario = referencia.idFuncionario
        INNER JOIN restaurante ON referencia.idRestaurante = restaurante.idRestaurante
        WHERE funcionario.idFuncionario = '$idFuncionario';";


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

    public function leitura()
    {
        $query = "SELECT funcionario.idFuncionario, funcionario.nome as nomeFun, COUNT(restaurante.idRestaurante) as countRes
        FROM funcionario
        INNER JOIN referencia ON funcionario.idFuncionario = referencia.idFuncionario
        INNER JOIN restaurante ON referencia.idRestaurante = restaurante.idRestaurante
        Where funcionario.idFuncionario
        GROUP BY funcionario.idFuncionario, funcionario.nome;";

        $referencias = array();
        if ($resultados = mysqli_query($this->link, $query)) {
            while ($row = mysqli_fetch_assoc($resultados)) {
                $referencias[] = $row;
            }
            mysqli_free_result($resultados);
        }

        return $referencias;
    } // fim read

    public function verificarExisteBanco($idFuncionario, $idRestaurante)
    {
        $query = "SELECT * FROM referencia WHERE idFuncionario = ? AND idRestaurante = ?;";

        // Preparar a declaração
        $stmt = $this->link->prepare($query);

        // Verifica se a consulta foi bem-sucedida
        if ($stmt) {
            // Vincula os parâmetros
            $stmt->bind_param("ii", $idFuncionario, $idRestaurante);

            // Executa a consulta
            $stmt->execute();

            // Armazena o resultado
            $stmt->store_result();

            // Verifica se há algum resultado retornado (ou seja, se o registro já existe)
            if ($stmt->num_rows > 0) {
                $this->verificaSim = "O registro já existe no banco de dados.";
            } else {
                $this->verificaNao = "O registro não existe no banco de dados. Você pode adicioná-lo.";
            }

            // Fecha a declaração
            $stmt->close();
        } else {
            // Se houver um erro na consulta
            echo "Erro na consulta: " . $this->link->error;
        }
    }
} // fim class
