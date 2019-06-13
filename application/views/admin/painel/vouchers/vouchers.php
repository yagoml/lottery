<div class="col-xs-12 text-center margB15">
    <?php if ($vouchers) { ?>
        <button class="btn btn-default pull-left" onclick="openModalFiltroVoucher()"><i class="glyphicon glyphicon-search"></i> Filtrar busca</button>
    <?php } ?>
    <button class="btn btn-primary pull-left" onclick="openModalNewVoucher()"><i class="glyphicon glyphicon-plus"></i> Novo</button>
</div>

<?php if (isset($filters)) { ?>
    <?php if ($filtroInfo) { ?>
        <div id="filtroInfo" class="col-xs-12">
            <b>Filtro:</b>
            <div class="filtroInfo">
                <?php echo $filtroInfo ?>
            </div>
        </div>
    <?php } ?>
<?php } ?>

<div id="vouchersTable" class="col-xs-12">
    <?php if ($vouchers) { ?>
        <table class="table table-hover extratosTable">
            <tr>
                <th>ID</th>
                <th>Voucher</th>
                <th>Descrição</th>
                <th>Bilhetes</th>
                <th>Usado</th>
                <th>Usuário</th>
                <th>Ativo?</th>
                <th>Validade</th>
                <th>Ações</th>
            </tr>

            <?php foreach ($vouchers as $voucher) { ?>
                <tr>
                    <td><?php echo $voucher->id_voucher ?></td>
                    <td><?php echo $voucher->voucher ?></td>
                    <td><?php echo $voucher->descricao ?></td>
                    <td><?php echo $voucher->bilhetes ?></td>
                    <td><?php echo $voucher->usado ? date('d/m/Y, H:i', strtotime($voucher->usado)) : 'Não' ?></td>
                    <td><?php echo $voucher->usuario ? $voucher->usuario : '-' ?></td>
                    <td><?php echo $voucher->ativo ? 'Sim' : 'Não' ?></td>
                    <td><?php echo $voucher->validade = date('d/m/Y', strtotime($voucher->validade)) ?></td>
                    <td><i title="Editar voucher <?php echo $voucher->id_voucher ?>" class="glyphicon glyphicon-edit iconAcoes text-primary" onclick='openModalEditVoucher(<?php echo json_encode($voucher) ?>)'></i> / <i title="Deletar voucher <?php echo $voucher->id_voucher ?>" class="glyphicon glyphicon-remove iconAcoes text-danger" onclick="deleteVoucher(<?php echo $voucher->id_voucher ?>)"></i></td>
                </tr>
            <?php } ?>
        </table>
        <div class="col-xs-12 paginator">
            <?php echo $links ?>
        </div>
    <?php } ?>
</div>

<?php $this->load->view('admin/painel/vouchers/modal_filtro_vouchers') ?>
<?php $this->load->view('admin/painel/vouchers/modal_new_voucher') ?>
<?php $this->load->view('admin/painel/vouchers/modal_edit_voucher') ?>