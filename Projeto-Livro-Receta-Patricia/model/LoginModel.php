<?php
include_once('../configuration/connect.php');

class LoginModel {
    public function validarLogin($nome, $senha) {
        global $link;
        $query = "SELECT * FROM login WHERE nome = ? AND senha = ?;";
        $stmt = $link->prepare($query);
        $stmt->bind_param("ss", $nome, $senha);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            return $result->fetch_assoc(); // Retorna os dados do usuário.
        } else {
            return null; // Retorna null se o login falhar.
        }
    }
}

?>