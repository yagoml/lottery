<?php if ($sorteio) { ?>
    <link rel="stylesheet" href="<?php echo base_url('lib/plugins/chat/style.css') ?>">
    <div class="container-fluid">
        <?php $this->load->view('breadcrumb_view') ?>
    </div>

    <div class="container sorteiosDisps margT20 margB30">
        <div class="col-sm-6 col-xs-12 text-center">
            <div class="topApost">
                <?php echo ($sorteio->show_users == 1 ? 'Roleta ' : 'Sorteio ') . $sorteio->numero_sorteio ?>
            </div>

            <div class="descSort">
                <table class="table text-left">
                    <tr><th>Tickets</th>
                        <?php $needleBar = $sorteio->bilhetes / $sorteio->min_bilhetes * 100 ?>
                        <td>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $needleBar ?>"
                                     aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $needleBar ?>%;">
                                         <?php echo $sorteio->bilhetes . ' / ' . $sorteio->min_bilhetes ?>
                                </div>
                            </div>
                        </td></tr>
                    <?php if ($sorteio->show_users) { ?>
                        <tr><th>Participantes</th><td><b><?php echo $numInscritos ?></b></td></tr>                   
                        <tr><th>Data</th><td><b><?php echo date('d/m/Y à\s H:i', strtotime($sorteio->data_sorteio)) ?></b></td></tr>
                        <tr><th>Tempo Restante</th><td><b id="timer" seconds-left="<?php echo strtotime($sorteio->data_sorteio) - time() ?>"></b></td></tr>
                    <?php } ?>
                    <tr><th>Prêmio</th><td><b class="cash">R$ <?php echo number_format($sorteio->premio, 2, ',', '.') ?></b></td></tr>
                    <?php if ($this->session->userdata('user')['id'] && $sorteio->show_users) { ?>
                        <tr><th>Probabilidade Ganho</th><td><b><?php echo $qtdTicketsUser ? number_format($qtdTicketsUser * 100 / $sorteio->bilhetes, 2, ',', '.') : 0 ?>%</b> (<b><?php echo $qtdTicketsUser ?></b> <?php echo $qtdTicketsUser > 1 ? 'Bilhetes' : 'Bilhete' ?>)</td></tr>
                    <?php } ?>
                    <tr><th>Aposta Mínima</th><td><b><?php echo $sorteio->preco ?></b> <?php echo $sorteio->preco > 1 ? 'Bilhetes' : 'Bilhete' ?></td></tr>
                </table>
            </div>

            <a href="javascript:window.history.go(-1)" class="btn btn-default">Voltar</a>
            <?php if (!$this->session->userdata('user')['id']) { ?>
                <a href="<?php echo base_url('auth') ?>" class="btn btn-success">Entrar</a>
            <?php } else { ?>
                <button class="btn btn-success" id="participar" sorteio="<?php echo $sorteio->id_sorteio ?>">Participar</button>
            <?php } ?>


            <div class="col-xs-12 margT50"></div>
            <?php $this->load->view('usuarios/chat_view'); ?>
        </div>

        <div class="col-sm-6 col-xs-12">
            <?php if ($sorteio->show_users) { ?>
                <?php if ($inscritos) { ?>
                    <div class="col-xs-12 margB30">
                        <?php include_once 'lib/plugins/winwheel/index.php'; ?>
                    </div>

                    <div class="col-xs-12 topApost">
                        Participantes
                    </div>
                    <table id="participantes" class="table table-bordered tableDefault">
                        <tr><th>Nome</th><th>Bilhetes</th></tr>
                        <?php foreach ($inscritos as $pos => $inscrito) { ?>
                            <tr><td class="nomeInscrito" id="<?php echo $inscrito->id_usuario ?>"><i><?php echo ($pos == 0 ? '<i class="glyphicon glyphicon-king" style="color: yellow;"></i> ' : '') . $inscrito->apelido ?></i><?php echo ' [' . $inscrito->nivel . ']' ?></td><td><?php echo $inscrito->bilhetes . ' (' . number_format($inscrito->bilhetes / $sorteio->bilhetes * 100, 2, ',', '.') ?> %)</td></tr>
                        <?php } ?>
                    </table>
                    <div class="col-xs-12 paginator">
                        <?php echo $links ?>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="col-xs-12 text-center margB30">
                    <div id="descTimeSorteio">
                        Tempo Restante
                    </div>
                    <div id="output">
                        <b id="timer2" class="font20" seconds-left="<?php echo strtotime($sorteio->data_sorteio) - time() ?>"></b>
                    </div>
                    <div id="outputName" class="outputName"><time class="font15"><?php echo date('d/m/Y à\s H:i', strtotime($sorteio->data_sorteio)) ?></time></div>
                </div>

                <?php if ($this->session->userdata('user')['id']) { ?>
                    <?php if ($ticketsUser) { ?>
                        <div class="col-xs-12 topApost">
                            Meus Tickets (<?php echo $qtdTicketsUser ?>)
                        </div>
                        <div class="col-xs-12 boxTickets">
                            <?php foreach ($ticketsUser as $ticket) { ?>
                                <label id="<?php echo $ticket->numero ?>" class="alert-info ticketNumber"><?php echo $ticket->numero ?></label>
                            <?php } ?>
                        </div>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </div>
    </div>

    <?php include_once 'lib/plugins/modal/modal_view.html' ?>
    <script type="text/javascript" src="<?php echo base_url('lib/plugins/chat/chat.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('lib/plugins/chat/chat_control.js') ?>"></script>
<?php } ?>