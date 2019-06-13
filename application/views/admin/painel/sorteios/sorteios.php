<button class="btn btn-primary pull-left margB15" id="openFiltro" onclick="openModalNewSorteio()"><i class="glyphicon glyphicon-plus"></i> Novo</button>

<?php if ($sorteios) { ?>
    <table class="table table-bordered table-hover extratosTable">
        <tr>
            <th>Número</th>
            <th>Participantes</th>
            <th>Bilhetes</th>
            <th>Prêmio</th>
            <th>Preco</th>
            <th>Min. Tickets</th>
            <th>Tipo</th>
            <th>Data</th>
            <th>Ações</th>
        </tr>

        <?php foreach ($sorteios as $sorteio) { ?>
            <tr>
                <td class="linkSorteio"><?php echo $sorteio->numero_sorteio ?></td>
                <td><?php echo is_array($sorteio->usuarios) ? count($sorteio->usuarios) : $sorteio->usuarios ?></td>
                <td><?php echo is_array($sorteio->bilhetes) ? count($sorteio->bilhetes) : $sorteio->bilhetes ?></td>
                <td><?php echo number_format($sorteio->premio, 2, ',', '.') ?></td>
                <td><?php echo $sorteio->preco ?></td>
                <td><?php echo $sorteio->min_bilhetes ?></td>
                <td><?php echo $sorteio->show_users == 1 ? 'Roleta' : 'Loteria' ?></td>
                <td><?php echo date('d/m/Y à\s H:i', strtotime($sorteio->data_sorteio)) ?></td>
                <td><i title="Ver sorteio <?php echo $sorteio->id_sorteio ?>" class="glyphicon glyphicon-eye-open iconAcoes text-success" onclick="linkSorteio('<?php echo $sorteio->id_sorteio ?>')"></i> / <i title="Editar sorteio <?php echo $sorteio->id_sorteio ?>" class="glyphicon glyphicon-edit iconAcoes text-primary" onclick='openModalEditSorteio(<?php echo json_encode($sorteio) ?>)'></i> / <i title="Deletar sorteio <?php echo $sorteio->id_sorteio ?>" class="glyphicon glyphicon-remove iconAcoes text-danger" onclick="deleteSorteio(<?php echo $sorteio->id_sorteio ?>)"></i></td>
            </tr>
        <?php } ?>
    </table>
<?php } else { ?>
    <div class="col-xs-12">
        Nenhum sorteio encontrado.
    </div>
<?php } ?>

<?php $this->load->view('admin/painel/sorteios/modal_new_sorteio') ?>
<?php $this->load->view('admin/painel/sorteios/modal_edit_sorteio') ?>
