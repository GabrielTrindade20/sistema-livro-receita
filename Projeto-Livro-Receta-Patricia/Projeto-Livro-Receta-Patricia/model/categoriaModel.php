<?php
include_once('../configuration/connect.php');

class categoriaModel {

    private $link;
    public $mesagens= array();

    public function __construct($link) {
        $this->link = $link;
    }

    public function create( $descricao )
    {
        $query =   "INSERT INTO Categoria 
                    (descricao) 
                    VALUE
                    ('$descricao');";
        if ($result = mysqli_query($this->link, $query)) {
            $mesagens = "Inclusão efetuada com sucesso";
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
        $query = "UPDATE Categoria SET descricao = '$descricao' WHERE idCategoria = '$id';";
        return mysqli_query($this->link, $query);
    }// fim upadate

    public function delete( $param )
    {

    }// fim delete

    function recuperaCategoria($id){

        global $link;
        // lista cursos já cadastrados
        $query =   "SELECT idCategoria, descricao
                    FROM Categoria
                    WHERE idCategoria = '$id';";
        if ($result = mysqli_query($link, $query)) {
                 // busca os dados lidos do banco de dados
            while ($row = mysqli_fetch_assoc($result)) {
                      return $row;
                }           
              
            // libera a área de memória onde está o resultado
            mysqli_free_result($result);
        }
    }

}
?>