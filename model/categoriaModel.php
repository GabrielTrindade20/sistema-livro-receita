<?php

class categoriaModel {
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
        $query =   "INSERT INTO Categoria 
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
    
    public function read( )
    {
        $query = "SELECT idCategoria, descricao FROM Categoria;";
        $categorias = array();

        if ($result = mysqli_query($this->link, $query)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $categorias[] = $row;
            }
            mysqli_free_result($result);
        }

        return $categorias;
    }// fim read
    
    public function update( $id, $descricao )
    {
        /*$query = "UPDATE Categoria SET descricao = '$descricao' WHERE idCategoria = '$id';";
        return mysqli_query($this->link, $query);*/

        $query =   "UPDATE Categoria 
                    SET descricao = ? 
                    WHERE idCategoria = ?";

        // Preparar a declaração
        $stmt = $this->link->prepare($query);

        // Verificar se a preparação da declaração foi bem-sucedida
        if ($stmt) {
            // Vincular os parâmetros da declaração com os valores
            $stmt->bind_param("ss", $descricao, $id);

            // Executar a declaração preparada
            if ($stmt->execute()) {
                $this->sucesso[] = "Atualização efetuada com sucesso!";
                return true;
            } else {
                $this->erros[] = "Erro ao atualizar: " . $stmt->error;
            }

            // Fechar a declaração preparada
            $stmt->close();
        } else {
            $this->erros[] = "Erro ao preparar a declaração: " . $this->link->error;
        }

        return false; // Retorna falso em caso de erro
    }// fim update

    public function delete( $id )
    {
        $query =   "DELETE 
                    FROM Categoria 
                    WHERE idCategoria = ?";

        // Preparar a declaração
        $stmt = $this->link->prepare($query);

        // Verificar se a preparação da declaração foi bem-sucedida
        if ($stmt) {
            // Vincular os parâmetros da declaração com os valores
            $stmt->bind_param("i", $id);

            // Executar a declaração preparada
            if ($stmt->execute()) {
                $this->sucesso[] = "Exclusão efetuada com sucesso!";
                return true;
            } else {
                $this->erros[] = "Erro ao excluir: " . $stmt->error;
            }

            // Fechar a declaração preparada
            $stmt->close();
        } else {
            $this->erros[] = "Erro ao preparar a declaração: " . $this->link->error;
        }

        return false; // Retorna falso em caso de erro
    }// fim delete

    public function recuperaCategoria($id){
        // lista cursos já cadastrados
        $query =   "SELECT idCategoria, descricao
                    FROM categoria
                    WHERE idCategoria = '$id';";

        $resultado = mysqli_query($this->link, $query);

        if ($resultado) {
            return mysqli_fetch_assoc($resultado);
        } else {
            return null; // Retornar null em caso de erro na consulta
        }
    }// fim de recuperar

}
?>