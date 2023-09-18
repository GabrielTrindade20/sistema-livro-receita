<?php
include_once('../configuration/connect.php');

class categoriaModel {

    private $link;

    public function __construct($link) {
        $this->link = $link;
    }

    public function create( $object )
    {

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
    
    public function update( $object )
    {

    }// fim upadate
    public function delete( $param )
    {

    }// fim delete

}

?>