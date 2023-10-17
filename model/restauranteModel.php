<?php

class restauranteModel {
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

    public function validar_campos($nome, $contato) {
        if (!empty($nome) && !empty($contato)) {
            $nome = filter_var(FILTER_SANITIZE_SPECIAL_CHARS);
            $contato = filter_var(FILTER_SANITIZE_SPECIAL_CHARS);
            return array($nome, $contato);
        } else {
            $this->erros[] = "Por gentileza, preencha todos os campos.";
            return false;
        }
    }//fim validar campos

    public function create( $nome, $contato )
    {
        $query =   "INSERT INTO restaurante 
                    (nome, contato) 
                    VALUE
                    (?,?);";

         // * Preparar a declaração
         $stmt = $this->link->prepare($query);

         // Verificar se a preparação da declaração foi bem-sucedida
         if ($stmt) {
             // Vincular os parâmetros da declaração com os valores
             $stmt->bind_param("ss", $nome, $contato);
 
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
        $query = "SELECT idRestaurante, nome, contato FROM restaurante;";
        $restaurantes = array();

        if ($result = mysqli_query($this->link, $query)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $restaurantes[] = $row;
            }
            mysqli_free_result($result);
        }

        return $restaurantes;
    }// fim read
    
    public function update( $id, $nome, $contato )
    {
        $query =   "UPDATE restaurante 
                    SET nome = ?, contato = ?
                    WHERE idRestaurante = ?";

        $stmt = $this->link->prepare($query);

        if ($stmt) {
            $stmt->bind_param("ssi", $nome, $contato, $id);

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
                    FROM restaurante 
                    WHERE idRestaurante = ?";

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

    public function recuperaRestaurante( $id )
    {
        // lista cursos já cadastrados
        $query =   "SELECT idRestaurante, nome, contato
                    FROM restaurante
                    WHERE idRestaurante = '$id';";

        $resultado = mysqli_query($this->link, $query);

        if ($resultado) {
            return mysqli_fetch_assoc($resultado);
        } else {
            return null; // Retornar null em caso de erro na consulta
        }
    }// fim de recuperar

    /*
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
    }*/

}// fim class
?>