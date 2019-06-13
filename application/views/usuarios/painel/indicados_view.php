<?php if ($indicados) { ?>
    <table class="table table-bordered table-striped table-hover extratosTable">
        <tr>
            <th>Data Cadastro</th>
            <th>Nome</th>
            <th>Apelido</th>
            <th>Nível</th>
        </tr>

        <?php foreach ($indicados as $indicado) { ?>
            <tr>
                <td><?php echo $indicado->data_cadastro ?></td>
                <td><?php echo $indicado->nome ?></td>
                <td><?php echo $indicado->apelido ?></td>
                <td><?php echo $indicado->nivel ?></td>
            </tr>
        <?php } ?>
    </table>

    <div class="col-xs-12 paginator">
        <?php echo $links ?>
    </div>
<?php } else { ?>
    <center class="alert alert-warning responseMsg">Você ainda não possui nenhum indicado.</center>
<?php } ?>
