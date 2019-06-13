<div class="col-xs-12 sorteiosDisps">
    <?php $this->load->view('breadcrumb_view') ?>
    <?php if ($sorteios) { ?>
        <div class="col-xs-12 text-center">
            <button class="btn btn-primary pull-left" onclick="openModalFiltroSorteios()"><i class="glyphicon glyphicon-search"></i> Filtrar busca</button>
            <a href="javascript:window.history.go(-1)" class="btn btn-default pull-left margL5">Voltar</a>
            <span>Clique em um sorteio para ver mais informações.</span>
        </div>

        <?php if (isset($filters)) { ?>
            <?php if ($filtroInfo) { ?>
                <div id="filtroInfo" class="col-xs-12 margT20">
                    <b>Filtro:</b>
                    <div class="filtroInfo">
                        <?php echo $filtroInfo ?>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>

        <?php foreach ($sorteios as $sorteio) { ?>
            <div class="col-md-3 col-sm-4 col-xs-12 boxSorteio text-center">
                <a href="<?php echo base_url('sorteios/concluido/' . $sorteio->id_sorteio) ?>" title="<?php echo ($sorteio->show_users == 1 ? 'Roleta ' : 'Sorteio ') . $sorteio->numero_sorteio ?>">
                    <div class="topApost">
                        <?php echo ($sorteio->show_users == 1 ? 'Roleta ' : 'Sorteio ') . $sorteio->numero_sorteio ?>
                    </div>
                    <div class="col-xs-12 descSort">
                        <table class="table table-condensed tableSorts">
                            <tr><th>Tickets</th><td><b><?php echo $sorteio->bilhetes . ' / ' . $sorteio->min_bilhetes ?></b></td></tr>
                            <tr><th>Sorteado</th><td><b><?php echo date('d/m/Y, H:i:s', strtotime($sorteio->data_sorteio)) ?></b></td></tr>
                            <tr><th>Prêmio</th><td><b class="cash">R$ <?php echo number_format($sorteio->premio, 2, ',', '.') ?></b></td></tr>
                            <tr><th>Ganhador</th><td><b class="alert-info pad5"><?php echo $sorteio->ganhador ?></b></td></tr>
                        </table>
                    </div>
                </a>
            </div>
        <?php } ?>
        <div class="col-xs-12 paginator">
            <?php echo $links ?>
        </div>
    <?php } else { ?>
        <div class="responseMsg alert alert-warning" style="margin: 20px auto;">
            Sem <?php echo $this->uri->segment(3) == 'loteria' ? 'Sorteios' : 'Roletas' ?> no momento. Tente novamente mais tarde.
        </div>
        <center><a href="<?php echo base_url('sorteios/concluidos/loteria') ?>" class="btn btn-default">Voltar</a></center>
        <?php } ?>
</div>

<?php $this->load->view('sorteios/modal_busca_view') ?>

<script src="https://www.google.com/recaptcha/api.js?onload=onLoadCaptcha&amp;render=explicit" async defer></script>