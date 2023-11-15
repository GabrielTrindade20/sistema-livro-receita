<?php

class fotoModel
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

    public function create($id_foto_receita, $nome_foto, $path, $id_usuario)
    {
        $query =   "INSERT INTO foto_receita
                    (id_foto_receita, nome_foto,  path, id_usuario)
                    VALUE
                    (?, ?, ?,? );";

        // * Preparar a declaração
        $stmt = $this->link->prepare($query);

        // Verificar se a preparação da declaração foi bem-sucedida
        if ($stmt) {
            // Vincular os parâmetros da declaração com os valores
            $stmt->bind_param("sssi", $id_foto_receita, $nome_foto, $path, $id_usuario);

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
                    FROM foto_receita;";
        $funcionarios = array();

        if ($result = mysqli_query($this->link, $query)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $funcionarios[] = $row;
            }
            mysqli_free_result($result);
        }

        return $funcionarios;
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
    public function delete($id)
    {
        $query =   "DELETE 
                    FROM foto_receita 
                    WHERE id_foto_receita = ?";

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
    
    public function recuperaFoto()
    {
        // lista cursos já cadastrados
        $query =   "SELECT *
                    FROM foto_receita
                    WHERE id_foto_receita=(select max(id_foto_receita) from foto_receita);";

        $result = mysqli_query($this->link, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row; // Retorna o array associativo completo
        } else {
            return false; // Ou qualquer outro valor que indique um erro
        }
    } // fim de recuperaFoto

}// fim class
