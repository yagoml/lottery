<?php if ($sorteio) { ?>
    <div class="container-fluid">
        <?php $this->load->view('breadcrumb_view') ?>
    </div>

    <div class="container sorteiosDisps margT20">
        <div class="col-sm-6 col-xs-12 text-center">
            <div class="topApost">
                <?php echo ($sorteio->show_users == 1 ? 'Roleta ' : 'Sorteio ') . $sorteio->numero_sorteio ?>
            </div>

            <div class="descSort">
                <table class="table text-left">
                    <tr><th>Tickets</th><td><b><?php echo $sorteio->bilhetes . ' / ' . $sorteio->min_bilhetes ?></b></td></tr>
                    <tr><th>Participantes</th><td><b><?php echo $numInscritos ?></b></td></tr>
                    <tr><th>Sorteado</th><td><b><?php echo date('d/m/Y, H:i:s', strtotime($sorteio->data_sorteio)) ?></b></td></tr>
                    <tr><th>Prêmio</th><td><b class="cash">R$ <?php echo number_format($sorteio->premio, 2, ',', '.') ?></b></td></tr>
                    <tr><th>Ganhador</th><td><b class="alert-info pad5"><?php echo $sorteio->ganhador . ' [' . $sorteio->nivel . ']' ?></b></td></tr>
                    <?php if (!$sorteio->show_users) { ?>
                        <tr><th>Bilhete Premiado</th><td><b class="alert-info pad5"><?php echo $ticketPremiado->numero ?></b></td></tr>
                    <?php } ?>
                    <tr><th>Ganhou com</th><td><?php echo '<b>' . $ganhouCom . '</b> Ticket(s)' ?> (<b><?php echo number_format($ganhouCom / $sorteio->bilhetes * 100, 2, ',', '.') ?> %</b>)</td></tr>
                    <tr><th>Aposta mínima</th><td><b><?php echo $sorteio->preco ?></b> Ticket(s)</td></tr>
                    <tr><th>Detalhado</th><td><b><?php echo $sorteio->show_users ? 'Sim' : 'Não' ?></b></td></tr>
                </table>
            </div>
            <a href="javascript:window.history.go(-1)" class="btn btn-default">Voltar</a>

            <div class="margT50">
                <div id="fb-root"></div>
                <script>
                    (function (d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id))
                            return;
                        js = d.createElement(s);
                        js.id = id;
                        js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.8";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));
                </script>
                <div class="fb-comments" data-href="<?php echo base_url('sorteios / concluido / ' . $sorteio->id_sorteio) ?>" data-width="100%" data-numposts="10"></div>
            </div>
        </div>

        <?php if (isset($inscritos)) { ?>
            <div class="col-sm-6 col-xs-12">
                <div class="topApost">
                    Participantes
                </div>
                <table class="table table-bordered table-hover tableDefault">
                    <tr><th>Nome</th><th>Tickets</th></tr>
                    <?php foreach ($inscritos as $inscrito) { ?>
                        <?php if ($inscrito->id_usuario == $sorteio->id_usuario) { ?>
                            <tr class="winner"><td><i class="glyphicon glyphicon-star" style="color: #fff600;"></i> <b><i><?php echo $inscrito->apelido ?></i><?php echo ' [' . $inscrito->nivel . ']' ?></b></td><td><?php echo '<b>' . $inscrito->bilhetes . '</b> (' . number_format($inscrito->bilhetes / $sorteio->bilhetes * 100, 2, ',', '.') . '%)' ?></td></tr>
                        <?php } else { ?>
                            <tr><td><i><?php echo $inscrito->apelido ?></i><?php echo ' [' . $inscrito->nivel . ']' ?></td><td><?php echo '<b>' . $inscrito->bilhetes . '</b> (' . number_format($inscrito->bilhetes / $sorteio->bilhetes * 100, 2, ',', '.') . '%)' ?></td></tr>
                        <?php } ?>
                    <?php } ?>
                </table>
                <div class="col-xs-12 paginator">
                    <?php echo $links ?>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>