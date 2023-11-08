<?php include_once('../../../controller/referenciaPesquisarController.php');?>

<table class="table" id="table1" border="1">
    <tbody>
        <?php foreach ($restaurantes as $index => $restaurante): ?>
            <tr class="<?php echo ($index % 2 == 0) ? 'even-row' : 'odd-row'; ?>">
                <td>
                    <?php echo $restaurante['nome']; ?>
                </td>
                <td>
                    <?php echo $restaurante['contato']; ?>
                </td>
                <td>
                    <button class="adicionar-restaurante" data-nome="<?php echo $restaurante['nome']; ?>" data-id="<?php echo $restaurante['idRestaurante'];?>" > Adicionar + </button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
