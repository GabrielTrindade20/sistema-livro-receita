<?php
include_once('../configuration/connect.php');

class cargoModel
{

    private $link;

    public function __construct($link)
    {
        $this->link = $link;
    }

    public function create($object)
    {

    } // fim create

    public function read()
    {
        $query = "SELECT idCargo, descricao FROM Cargo;";
        $cargos = array();

        if ($result = mysqli_query($this->link, $query)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $cargos[] = $row;
            }
            mysqli_free_result($result);
        }

        return $cargos;
    } // fim read

    public function update($id, $descricao)
    {
        $query = "UPDATE Cargo SET descricao = '$descricao' WHERE idCargo = '$id';";
        return mysqli_query($this->link, $query);
    } // fim upadate

    public function delete($param)
    {

    } // fim delete

    function recuperaCargo($id)
    {

        global $link;
        // lista cursos já cadastrados
        $query = "SELECT idCargo, descricao
                    FROM Cargo
                    WHERE idCargo = '$id';";
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