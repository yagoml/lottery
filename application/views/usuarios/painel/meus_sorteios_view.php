<?php if ($meusSorteios) { ?>
    <table class="table table-bordered table-hover extratosTable">
        <tr>
            <th title="Número">Núm.</th>
            <th>Aposta</th>
            <th>Prêmio</th>
            <th>Tipo</th>
            <th title="Participantes">Part.</th>
            <th>Bilhetes</th>
            <th>Chance</th>
            <th>Data</th>
        </tr>

        <?php foreach ($meusSorteios as $sorteio) { ?>
            <tr class="linkSorteio" onclick="linkSorteio('<?php echo $sorteio->id_sorteio ?>')">
                <td><?php echo $sorteio->id_sorteio ?></td>
                <td><?php echo $sorteio->bilhetesUser ?></td>
                <td><?php echo number_format($sorteio->premio, 2, ',', '.') ?></td>
                <td><?php echo $sorteio->show_users == 1 ? 'Roleta' : 'Loteria' ?></td>
                <td><?php echo $sorteio->show_users == 1 ? count($sorteio->usuarios) : '?' ?></td>
                <td><?php echo $sorteio->show_users == 1 ? count($sorteio->bilhetes) : '?' ?></td>
                <td><?php echo $sorteio->show_users == 1 ? number_format($sorteio->bilhetesUser * 100 / count($sorteio->bilhetes), 2, ',', '.') . ' %' : '?' ?></td>
                <td><?php echo date('d/m/Y à\s H:i', strtotime($sorteio->data_sorteio)) ?></td>
            </tr>
        <?php } ?>
    </table>
<?php } else { ?>
    <div class="col-xs-12">
        Você não está participando de nenhum sorteio.
        <br><br>
        <a class="btn btn-success" href="<?php echo base_url('sorteios') ?>">Loteria</a>
        <a class="btn btn-primary" href="<?php echo base_url('sorteios/roletas') ?>">Roletas</a>
    </div>
<?php } ?>
