<div class="container-fluid margB20">
    <form id="transferForm" class="datesFilter" method="get">
        <div class="col-xs-12 text-center">
            <label>
                <span class="labelForm"> De</span>
                <input type="text" class="date" name="startDate" id="startDate" <?php echo isset($startDate) ? 'value="' . str_replace('-', '/', $startDate) . '"' : '' ?> required>
            </label>

            <label>
                <span class="labelForm"> Até</span>
                <input type="text" class="date" name="endDate" id="endDate" <?php echo isset($endDate) ? 'value="' . str_replace('-', '/', $endDate) . '"' : '' ?>>
            </label>
        </div>

        <div class="col-xs-12 text-center">
            <div class="g-recaptcha" data-theme="dark" data-sitekey="<?php echo \Repository\Config_system::ggApiKey() ?>" style="margin: 20px 0;"></div>
            <button type="reset" class="btn btn-default">Limpar</button>
            <button type="submit" class="btn btn-primary" data-loading="Buscando...">Buscar</button>
        </div>
    </form>
</div>

<?php if (isset($transfers)) { ?>
    <?php if ($transfers) { ?>
        <span class="pad5 alert-danger pull-right margL5">Debitado: <b><?php echo $totalTransfers['debitos'] ? $totalTransfers['debitos'] : 0 ?></b></span>
        <span class="pad5 alert-success pull-right">Creditado: <b><?php echo $totalTransfers['creditos'] ? $totalTransfers['creditos'] : 0 ?></b></span>
        <table class="table table-hover extratosTable">
            <tr>
                <th>Data</th>
                <th>Usuário</th>
                <th>Tickets</th>
            </tr>

            <?php foreach ($transfers as $key => $transfer) { ?>
                <tr>
                    <td><?php echo date('d/m/Y à\s H:i', strtotime($transfer->data)) ?></td>
                    <td><?php echo \Repository\Usuarios::getUsuario($transfer->remetente == $this->session->userdata['user']['id'] ? $transfer->destino : $transfer->remetente)->apelido ?></td>
                    <td class="text-<?php echo $transfer->remetente != $this->session->userdata['user']['id'] ? 'success' : 'danger' ?>"><?php echo ($transfer->remetente != $this->session->userdata['user']['id'] ? '+ ' : '- ') . $transfer->quantidade ?></td>
                </tr>
            <?php } ?>
        </table>

        <div class="col-xs-12 paginator">
            <?php echo $links ?>
        </div>
    <?php } else { ?>
        <div class="responseMsg alert alert-info text-center">
            <i class="glyphicon glyphicon-remove close" onclick="closeResponseMsg()"></i>
            Nenhuma transferência nesse período.
        </div>
    <?php } ?>
<?php } ?>

<?php if (isset($msg)) { ?>
    <div class="col-xs-12 text-center">
        <div class="responseMsg alert alert-danger">
            <i class="glyphicon glyphicon-remove close" onclick="closeResponseMsg()"></i>
            <?php echo $msg ?>
        </div>
    </div>
<?php } ?>

<script src="https://www.google.com/recaptcha/api.js?"></script>