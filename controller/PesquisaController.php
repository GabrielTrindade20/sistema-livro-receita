<?php
// SearchController.php
include_once('./model/PesquisaModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['busca'])) {
        $termo_de_pesquisa = $_POST['busca'];
        
        // Aqui você chama o modelo para realizar a pesquisa
        $searchModel = new PesquisaModel();
        $resultados = $searchModel->pesquisar($termo_de_pesquisa);

        // Após obter os resultados, você pode redirecionar para a visualização
        include_once('../view/search.php');
    }
}
?>
