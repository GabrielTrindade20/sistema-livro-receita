<?php

class medidaModel {
    private $link;
    private $erros = array();
    private $sucesso = array();
    public $verificaSim;
    public $verificaNao;

    public function __construct($link) {
        $this->link = $link;
    }

    public function getErros() {
        return $this->erros;
    }
    
    public function getSucesso() {
        return $this->sucesso;
    }

    public function validar_campos($descricao) {
        if (!empty($descricao)) {
            $descricao = filter_var(FILTER_SANITIZE_SPECIAL_CHARS);
            return $descricao;
        } else {
            $this->erros[] = "Por gentileza, preencha todos os campos.";
            return false;
        }
    }//fim validar campos

    public function create( $descricao )
    {
        $query =   "INSERT INTO medida 
                    (descricao) 
                    VALUE
                    (?);";

         // * Preparar a declaração
         $stmt = $this->link->prepare($query);

         // Verificar se a preparação da declaração foi bem-sucedida
         if ($stmt) {
             // Vincular os parâmetros da declaração com os valores
             $stmt->bind_param("s", $descricao);
 
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
        $query =   "SELECT *
                    FROM medida;";
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
                    FROM medida 
                    WHERE idMedida = ?";

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

    public function update($id, $descricao)
    {
        $query =   "UPDATE medida 
                    SET descricao = ?
                    WHERE idMedida = ?";

        $stmt = $this->link->prepare($query);

        if ($stmt) {
            $stmt->bind_param("si", $descricao, $id);

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

    public function verificarExisteBanco($descricao)
    {
        $query = "SELECT * FROM medida WHERE descricao = ? ;";

        // Preparar a declaração
        $stmt = $this->link->prepare($query);

        // Verifica se a consulta foi bem-sucedida
        if ($stmt) {
            // Vincula os parâmetros
            $stmt->bind_param("s", $descricao );

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
}// fim class
?>