<button class="btn btn-primary" onclick="openModalNewPercComissao()">Adicionar</button>

<div class="col-xs-12 margB20">

</div>

<div class="col-sm-6 col-xs-12">
    <?php if (isset($percentComissoes['bilhetes'])) { ?>
        <table class="table table-hover extratosTable">
            <tr><th colspan="4">Comissão Tickets</th></tr>
            <tr>
                <th>Ordem</th>
                <th>Faixa de Nível</th>
                <th>Porcentagem</th>
                <th>Ação</th>
            </tr>

            <?php foreach ($percentComissoes['bilhetes'] as $comissaoB) { ?>
                <tr>
                    <td><?php echo $comissaoB->ordem ?></td>
                    <td><?php echo $comissaoB->niveis ?></td>
                    <td><?php echo $comissaoB->percent ?> %</td>
                    <td><i class="glyphicon glyphicon-edit iconAcoes text-primary" onclick='openModalEditPercComissao(<?php echo json_encode($comissaoB) ?>)'></i> / <i class="glyphicon glyphicon-remove iconAcoes text-danger" onclick="deleteComission(<?php echo $comissaoB->id ?>)"></i></td>
                </tr>
            <?php } ?>
        </table>
    <?php } ?>
</div>
<div class="col-sm-6 col-xs-12">
    <?php if (isset($percentComissoes['premios'])) { ?>
        <table class="table table-hover extratosTable">
            <tr><th colspan="4">Comissão Prêmios</th></tr>
            <tr>
                <th>Ordem</th>
                <th>Faixa de Nível</th>
                <th>Porcentagem</th>
                <th>Ação</th>
            </tr>

            <?php foreach ($percentComissoes['premios'] as $comissaoP) { ?>
                <tr>
                    <td><?php echo $comissaoP->ordem ?></td>
                    <td><?php echo $comissaoP->niveis ?></td>
                    <td><?php echo $comissaoP->percent ?> %</td>
                    <td><i class="glyphicon glyphicon-edit iconAcoes text-primary" onclick='openModalEditPercComissao(<?php echo json_encode($comissaoP) ?>)'></i> / <i class="glyphicon glyphicon-remove iconAcoes text-danger" onclick="deleteComission(<?php echo $comissaoP->id ?>)"></i></td>
                </tr>
            <?php } ?>
        </table>
    <?php } ?>
</div>

<?php include_once 'lib/plugins/modal/modal_view.html' ?>
<?php $this->load->view("admin/painel/config_comissoes/modal_edit_perc_comissao") ?>
<?php $this->load->view("admin/painel/config_comissoes/modal_new_comissao") ?>