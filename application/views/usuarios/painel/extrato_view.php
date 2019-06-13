<div class="container-fluid margB20">
    <form id="extratoForm" class="datesFilter" method="get">
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

<?php if (isset($extratos)) { ?>
    <?php if ($extratos) { ?>
        <table class="table table-hover extratosTable">
            <tr>
                <th>Data</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Saldo</th>
            </tr>

            <?php foreach ($extratos as $key => $extrato) { ?>
                <tr>
                    <td><?php echo date('d/m/Y à\s H:i', strtotime($extrato->data)) ?></td>
                    <td><?php echo $extrato->nome ?></td>
                    <td class="text-<?php echo $extrato->tipo === 'C' ? 'success' : 'danger' ?>"><?php echo ($extrato->tipo === 'C' ? '+ ' : '- ') . number_format($extrato->valor, 2, ',', '.') ?></td>
                    <td><?php echo number_format($extrato->saldo, 2, ',', '.') ?></td>
                </tr>
            <?php } ?>
        </table>

        <div class="col-xs-12 paginator">
            <?php echo $links ?>
        </div>
    <?php } else { ?>
        <div class="responseMsg alert alert-info text-center">
            <i class="glyphicon glyphicon-remove close" onclick="closeResponseMsg()"></i>
            Nenhuma transação nesse período.
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