<?php

class ingredienteModel
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

    public function validar_campos($descricao)
    {
        if (!empty($descricao)) {
            $descricao = filter_var(FILTER_SANITIZE_SPECIAL_CHARS);
            return $descricao;
        } else {
            $this->erros[] = "Por gentileza, preencha todos os campos.";
            return false;
        }
    } //fim validar campos

    public function create($nome, $descricao)
    {
        $query =   "INSERT INTO Ingrediente 
                    (nome, descricao) 
                    VALUE
                    (?,?);";

        // * Preparar a declaração
        $stmt = $this->link->prepare($query);

        // Verificar se a preparação da declaração foi bem-sucedida
        if ($stmt) {
            // Vincular os parâmetros da declaração com os valores
            $stmt->bind_param("ss", $nome, $descricao);

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

    public function read()
    {
        $query =   "SELECT *
                    FROM ingrediente;";
        $ingredientes = array();

        if ($result = mysqli_query($this->link, $query)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $ingredientes[] = $row;
            }
            mysqli_free_result($result);
        }

        return $ingredientes;
    } // fim read

    public function delete($id)
    {
        $query =   "DELETE 
                    FROM ingrediente 
                    WHERE idIngrediente = ?";

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
    } // fim delete

    public function update($id, $nome, $descricao)
    {
        $query =   "UPDATE ingrediente 
                    SET nome = ?, descricao = ?
                    WHERE idIngrediente = ?";

        $stmt = $this->link->prepare($query);

        if ($stmt) {
            $stmt->bind_param("ssi", $nome, $descricao, $id);

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
} // fim class 
