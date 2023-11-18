function confirmarInativo(idFuncionario) {
    var confirmacao = confirm("Tem certeza de que deseja colocar o funcionário como inativo?");
    if (confirmacao) {
        // Fazer uma solicitação AJAX para atualizar o status do funcionário
        var url = "../../controller/funcionarioController.php?acao=inativo&idFuncionario=" + idFuncionario;
        var xhr = new XMLHttpRequest();
        xhr.open("GET", url, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Atualizar o status na tabela na página atual
                var rows = document.querySelectorAll('.funcionario-row[data-id="' + idFuncionario + '"]');
                for (var i = 0; i < rows.length; i++) {
                    var cells = rows[i].getElementsByTagName('td');
                    if (cells.length > 7) { // Verifica se há pelo menos 8 colunas (a coluna de status é a 8ª)
                        cells[7].textContent = 'Inativo';
                    }
                }
                alert("Funcionário marcado como inativo.");
            }
        };
        xhr.send();
    }
}
function confirmarExclusaoCheckbox() {
    var checkboxes = document.querySelectorAll('input[name="checkbox[]"]:checked');
    var ids = [];
    checkboxes.forEach(function(checkbox) {
        ids.push(checkbox.value);
    });
    if (ids.length === 0) {
        alert("Nenhum funcionário selecionado.");
        return;
    }
    var confirmacao = confirm("Tem certeza de que deseja colocar os funcionários como inativos?");
    if (confirmacao) {
        // Fazer uma solicitação AJAX para atualizar o status dos funcionários selecionados
        var url = "../../controller/funcionarioController.php?acao=inativosSelecionados";
        var xhr = new XMLHttpRequest();
        var formData = new FormData();
        ids.forEach(function(id) {
            formData.append("checkbox[]", id);
        });
        xhr.open("POST", url, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Atualizar o status na tabela na página atual
                ids.forEach(function(id) {
                    var rows = document.querySelectorAll('.funcionario-row[data-id="' + id + '"]');
                    for (var i = 0; i < rows.length; i++) {
                        var cells = rows[i].getElementsByTagName('td');
                        if (cells.length > 7) { // Verifica se há pelo menos 8 colunas (a coluna de status é a 8ª)
                            cells[7].textContent = 'Inativo';
                        }
                    }
                });
                alert("Funcionários marcados como inativos.");
            }
        };
        xhr.send(formData);
    }
}