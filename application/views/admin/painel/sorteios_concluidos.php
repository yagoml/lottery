<button class="btn btn-default pull-left margB15" id="openFiltro" onclick="openModal()"><i class="glyphicon glyphicon-search"></i> Filtrar busca</button>

<?php if (isset($filters)) { ?>
    <?php if (isset($filtroInfo)) { ?>
        <div id="filtroInfo" class="col-xs-12">
            <b>Filtro:</b>
            <div class="filtroInfo">
                <?php echo $filtroInfo ?>
            </div>
        </div>
    <?php } ?>
<?php } ?>

<?php if ($sorteios) { ?>
    <table class="table table-bordered table-hover extratosTable">
        <tr>
            <th>ID</th>
            <th>Data</th>
            <th>Participantes</th>
            <th>Bilhetes</th>
            <th>Prêmio</th>
            <th>Ganhador</th>
            <th>Aposta</th>
            <th>Tipo</th>
        </tr>

        <?php foreach ($sorteios as $sorteio) { ?>
            <tr class="linkSorteio" onclick="linkSorteioConcluido('<?php echo $sorteio->id_sorteio ?>')">
                <td><?php echo $sorteio->id_sorteio ?></td>
                <td><?php echo date('d/m/Y à\s H:i', strtotime($sorteio->data_sorteio)) ?></td>
                <td><?php echo is_array($sorteio->usuarios) ? count($sorteio->usuarios) : $sorteio->usuarios ?></td>
                <td><?php echo $sorteio->bilhetes ?></td>
                <td><?php echo number_format($sorteio->premio, 2, ',', '.') ?></td>
                <td><?php echo $sorteio->id_usuario . ' - ' . $sorteio->ganhador . ' [' . $sorteio->nivel . ']' ?></td>
                <td><?php echo $sorteio->ganhouCom ?></td>
                <td><?php echo $sorteio->show_users == 1 ? 'Roletas' : 'Loteria' ?></td>
            </tr>
        <?php } ?>
    </table>
    <div class="col-xs-12 paginator">
        <?php echo $links ?>
    </div>
<?php } else { ?>
    <div class="col-xs-12">
        Nenhum sorteio encontrado.
    </div>
<?php } ?>

<?php $this->load->view('admin/painel/modal_busca_view') ?>