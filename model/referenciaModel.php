<?php

class referenciaModel {
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

    public function validar_campos($data_inicio, $data_fim) {
        if (!empty($data_inicio) && !empty($data_fim)) {
            return array($data_inicio, $data_fim);
        } else {
            $this->erros[] = "Por gentileza, preencha todos os campos.";
            return false;
        }
    }//fim validar campos

    public function create( $idFuncionario, $idRestaurante, $data_inicio, $data_fim )
    {
        $query =   "INSERT INTO referencia 
                    (idFuncionario, idRestaurante, data_inicio, data_fim) 
                    VALUE
                    (?, ?, ?, ?);";

         // * Preparar a declaração
         $stmt = $this->link->prepare($query);

         // Verificar se a preparação da declaração foi bem-sucedida
         if ($stmt) {
             // Vincular os parâmetros da declaração com os valores
             $stmt->bind_param("iiss", $idFuncionario, $idRestaurante, $data_inicio, $data_fim);
 
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
        $query = "SELECT idFuncionario, idRestaurante, data_inicio, data_fim FROM referencia;";
        $referencia = array();

        if ($result = mysqli_query($this->link, $query)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $referencia[] = $row;
            }
            mysqli_free_result($result);
        }

        return $referencia;
    }// fim read
    
    public function update( $idFuncionario, $idRestaurante, $data_inicio, $data_fim )
    {
        $query =   "UPDATE restaurante 
                    SET nome = ?, contato = ?
                    WHERE idRestaurante = ?";

        $stmt = $this->link->prepare($query);

        if ($stmt) {
            $stmt->bind_param("iiss", $idFuncionario, $idRestaurante, $data_inicio, $data_fim);

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

    public function delete( $idFuncionario, $idRestaurante )
    {
        $query =   "DELETE 
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
    }// fim delete

    public function recuperaRestaurante(  $idFuncionario, $idRestaurante )
    {
        // lista cursos já cadastrados
        $query =   "SELECT idFuncionario, idRestaurante, data_inicio, data_fim
                    FROM referencia
                    WHERE idFuncionario = '$idFuncionario'
                    AND idRestaurante = '$idRestaurante';";

        $resultado = mysqli_query($this->link, $query);

        if ($resultado) {
            return mysqli_fetch_assoc($resultado);
        } else {
            return null; // Retornar null em caso de erro na consulta
        }
    }// fim de recuperar

    public function pesquisarRestaurantesPorNome($termo_pesquisa) {
        $sql = "SELECT * FROM restaurantes WHERE nome LIKE :termo";
        $stmt = $this->link->prepare($sql);
        $termo_pesquisa = "%" . $termo_pesquisa . "%";
        $stmt->bindParam(':termo', $termo_pesquisa);
        $stmt->execute();
        return $stmt->fetchAll();
    }


}// fim class
?>