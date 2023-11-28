<?php

class receitaModel
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

    // public function validar_campos(
    //     $nome,
    //     $data_criacao,
    //     $modo_preparo,
    //     $qtd_porcao,
    //     $degustador,
    //     $data_degustacao,
    //     $nota_degustacao,
    //     $ind_inedita,
    //     $id_cozinheiro,
    //     $id_categoria,
    // ) {
    //     if (
    // //       !empty($rg) && !empty($nome) && !empty($data_ingresso) && !empty($salario) && !empty($nome_fantasia)
    //         && !empty($cargo) && !empty($situacao)
    //     ) {
    //         $rg = filter_var(FILTER_SANITIZE_SPECIAL_CHARS);
    //         $nome = filter_var(FILTER_SANITIZE_SPECIAL_CHARS);
    //         $data_ingresso = filter_var(FILTER_SANITIZE_SPECIAL_CHARS);
    //         $salario = filter_var(FILTER_SANITIZE_SPECIAL_CHARS);
    //         $nome_fantasia = filter_var(FILTER_SANITIZE_SPECIAL_CHARS);

    //         return array($rg, $nome, $data_ingresso, $salario, $nome_fantasia, $situacao, $cargo);
    //     } else {
    //         $this->erros[] = "Por gentileza, preencha todos os campos.";
    //         return false;
    //     }
    // } //fim validar campos

    public function create(
        $nome_receita,
        $data_criacao,
        $modo_preparo,
        $qtd_porcao,
        $degustador,
        $data_degustacao,
        $nota_degustacao,
        $ind_inedita,
        $id_cozinheiro,
        $id_categoria,
        $id_foto_receita,
        $path_foto_receita
    ) {
        $query =   "INSERT INTO receita
                    (nome_receita, data_criacao, modo_preparo, qtd_porcao, degustador,
                    data_degustacao, nota_degustacao, ind_inedita, id_cozinheiro,  id_categoria, id_foto_receita, path_foto_receita)
                    VALUE
                    (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

        // * Preparar a declaração
        $stmt = $this->link->prepare($query);

        // Verificar se a preparação da declaração foi bem-sucedida
        if ($stmt) {
            // Vincular os parâmetros da declaração com os valores
            $stmt->bind_param(
                "sssiisssiiss",
                $nome_receita,
                $data_criacao,
                $modo_preparo,
                $qtd_porcao,
                $degustador,
                $data_degustacao,
                $nota_degustacao,
                $ind_inedita,
                $id_cozinheiro,
                $id_categoria,
                $id_foto_receita,
                $path_foto_receita
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

    public function read()
    {
        $query =   "SELECT 
                    r.nome_receita, 
                    r.data_criacao, 
                    r.modo_preparo, 
                    r.qtd_porcao, 
                    f_degustador.nome AS nome_degustador, -- Nome do degustador
                    f_cozinheiro.nome AS nome_cozinheiro, -- Nome do cozinheiro
                    r.data_degustacao, 
                    r.nota_degustacao, 
                    r.ind_inedita, 
                    r.id_cozinheiro AS cozinheiro_id, 
                    c.descricao AS categoria_nome, -- Nome da categoria
                    r.id_categoria AS categoria_id, 
                    fr.nome_foto, -- Nome da foto
                    fr.path AS path_foto
                FROM 
                    receita r
                    -- Join com a tabela de funcionário para obter o nome do degustador
                    INNER JOIN funcionario f_degustador ON r.degustador = f_degustador.idFuncionario
                    -- Join com a tabela de funcionário para obter o nome do cozinheiro
                    INNER JOIN funcionario f_cozinheiro ON r.id_cozinheiro = f_cozinheiro.idFuncionario
                    -- Join com a tabela de categoria para obter o nome da categoria
                    INNER JOIN categoria c ON r.id_categoria = c.idCategoria
                    -- Join com a tabela de foto_receita para obter dados da foto
                    LEFT JOIN foto_receita fr ON r.id_foto_receita = fr.id_foto_receita;";

        $receitas = array();

        if ($result = mysqli_query($this->link, $query)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $receitas[] = $row;
            }
            mysqli_free_result($result);
        }

        return $receitas;
    } // fim read

    public function delete( $nome_receita )
    {
        $query =   "DELETE 
                    FROM receita 
                    WHERE nome_receita = ?";

        $stmt = $this->link->prepare($query);

        if ($stmt) {
            $stmt->bind_param("s", $nome_receita);

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

    public function recuperaReceita($nome_receita)
    {
        $query =   "SELECT *
                    FROM 
                        receita 
                    WHERE nome_receita = ?";

        $stmt = $this->link->prepare($query);
        $stmt->bind_param("s", $nome_receita);
        $stmt->execute();
        $result = $stmt->get_result();
        $receita = $result->fetch_assoc();

        return $receita;
    } // fim de recuperaReceita

    public function viewReceita($nome_receita)
    {
        $query =   "SELECT 
                    r.nome_receita, 
                    r.data_criacao, 
                    r.modo_preparo, 
                    r.qtd_porcao, 
                    f_degustador.nome AS nome_degustador, -- Nome do degustador
                    f_cozinheiro.nome AS nome_cozinheiro, -- Nome do cozinheiro
                    r.data_degustacao, 
                    r.nota_degustacao, 
                    r.ind_inedita, 
                    r.id_cozinheiro AS cozinheiro_id, 
                    c.descricao AS categoria_nome, -- Nome da categoria
                    r.id_categoria AS categoria_id, 
                    fr.nome_foto, -- Nome da foto
                    fr.path AS path_foto
                FROM 
                    receita r
                    -- Join com a tabela de funcionário para obter o nome do degustador
                    INNER JOIN funcionario f_degustador ON r.degustador = f_degustador.idFuncionario
                    -- Join com a tabela de funcionário para obter o nome do cozinheiro
                    INNER JOIN funcionario f_cozinheiro ON r.id_cozinheiro = f_cozinheiro.idFuncionario
                    -- Join com a tabela de categoria para obter o nome da categoria
                    INNER JOIN categoria c ON r.id_categoria = c.idCategoria
                    -- Join com a tabela de foto_receita para obter dados da foto
                    LEFT JOIN foto_receita fr ON r.id_foto_receita = fr.id_foto_receita
                WHERE r.nome_receita = ?;";

        // $receitas = array();

        // $stmt = $this->link->prepare($query);
        // $stmt->bind_param("s", $nome_receita);
        // $stmt->execute();
        // $result = $stmt->get_result();

        $stmt = $this->link->prepare($query);
        $stmt->bind_param("s", $nome_receita);
        $stmt->execute();
        $result = $stmt->get_result();
        $receita = $result->fetch_assoc();

        return $receita;
    } // fim de recuperaReceita

}// fim class
