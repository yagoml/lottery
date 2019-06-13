<section id="sorteiosTickets" class="container-fluid">
    <?php $this->load->view('breadcrumb_view') ?>
    <?php if ($sorteios) { ?>
        <link rel="stylesheet" href="<?php echo base_url('lib/css/timeTo.css') ?>"/>
        <script src="<?php echo base_url('lib/js/jquery.time-to.min.js') ?>"></script>
        <h5 class="text-center">Clique em um sorteio para ver mais informações.</h5>

        <div class="container sorteiosDisps">
            <?php foreach ($sorteios as $sorteio) { ?>
                <div class="col-sm-4 col-xs-12 boxSorteio text-center">
                    <a href="<?php echo base_url('sorteios/disponivel/' . $sorteio->id_sorteio) ?>" title="<?php echo ($sorteio->show_users == 1 ? 'Roleta ' : 'Sorteio '). $sorteio->numero_sorteio ?>">
                        <div class="topApost">
                            <?php echo ($sorteio->show_users == 1 ? 'Roleta ' : 'Sorteio '). $sorteio->numero_sorteio ?>
                        </div>

                        <div class="col-xs-12 descSort">
                            <table class="table table-condensed tableSorts">
                                <tr><th>Tickets</th>
                                    <?php $bilhetes = is_array($sorteio->bilhetes) ? count($sorteio->bilhetes) : $sorteio->bilhetes ?>
                                    <?php $needleBar = $bilhetes / $sorteio->min_bilhetes * 100 ?>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $needleBar ?>"
                                                 aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $needleBar ?>%;">
                                                     <?php echo $bilhetes . '/' . $sorteio->min_bilhetes ?>
                                            </div>
                                        </div>
                                    </td></tr>
                                <tr><th>Prêmio</th><td><b class="cash">R$ <?php echo number_format($sorteio->premio, 2, ',', '.') ?></b></td></tr>
                                <tr><th>Data</th><td><b><?php echo date('d/m/Y à\s H:i', strtotime($sorteio->data_sorteio)) ?></b></td></tr>
                                <tr><th>Tempo Restante</th><td><b class="timers" id="timer-<?php echo $sorteio->id_sorteio ?>" seconds-left="<?php echo strtotime($sorteio->data_sorteio) - time() ?>"></b></td></tr>
                                <tr><th>Aposta Mínima</th><td><b><?php echo $sorteio->preco ?></b> Bilhete(s)</td></tr>
                            </table>
                        </div>
                    </a>
                </div>
            <?php } ?>
            <div class="col-xs-12 paginator">
                <?php echo $links ?>
            </div>
        </div>
    <?php } else { ?>
        <div class="col-xs-12 text-center">
            <div class="responseMsg alert alert-info" style="display: flex;">
                Sem Sorteios no momento. Tente novamente mais tarde.
            </div>
            <br><br>
            <a href="javascript:window.history.go(-1)" class="btn btn-default">Voltar</a>
        </div>
    <?php } ?>
</section>
