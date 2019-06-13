<div class="alert alert-info text-center" style="margin-bottom: 20px;">
    Usuários Online: <b><?php echo $usuariosOnline ?></b>
    <br>
    Visitantes Online: <b><?php echo $visitantes ?></b> 
    <br>
    Usuários cadastrados: <b><?php echo $inscritos ?></b>
</div>

<div class="space alert alert-success text-center">
    <div class="">
        Tickets Premiados: <b><?php echo $estatisticas['qtdBilhetesPremiados'] ?></b>
    </div>
    <div class="">
        Usuários Premiados: <b><?php echo count($estatisticas['usuariosPremiados']) ?></b>
    </div>
    <div class="">
        Valor já Premiado: <b>R$ <?php echo number_format($estatisticas['totalPremiado'], 2, ',', '.') ?></b>
    </div>
    <div class="">
        Comissões Pagas: <b>R$ <?php echo number_format($estatisticas['comissoesPagas'], 2, ',', '.') ?></b>
    </div>
    <div class="">
        Total Pago: <b>R$ <?php echo number_format($estatisticas['totalPago'], 2, ',', '.') ?></b>
    </div>
</div>

<div class="ranking">
    <a href="<?php echo base_url('sorteios/concluidos/loteria') ?>" title="Últimos Sorteios">
        <div class="topApost">
            Últimos da Loteria
        </div>
        <table class="table table-bordered table-hover tableDefault">
            <tr><th>Sorteio</th><th>Prêmio</th><th>Ganhador</th></tr>

            <?php foreach ($sorteios as $pos => $sorteio) { ?>
                <?php if (!$sorteio->show_users) { ?>
                    <tr><td><?php echo $sorteio->numero_sorteio ?></td><td>R$ <?php echo number_format($sorteio->premio, 2, ',', '.') ?></td><td><i><?php echo $sorteio->ganhador . '</i> [' . $sorteio->nivel . ']' ?></td></tr>
                <?php } ?>
            <?php } ?>
        </table>
    </a>
</div>

<div class="ranking">
    <a href="<?php echo base_url('sorteios/concluidos/roleta') ?>" title="Últimos Sorteios">
        <div class="topApost">
            Últimos Roletas
        </div>
        <table class="table table-bordered table-hover tableDefault">
            <tr><th>Roleta</th><th>Prêmio</th><th>Ganhador</th></tr>

            <?php foreach ($sorteios as $pos => $sorteio) { ?>
                <?php if ($sorteio->show_users) { ?>
                    <tr><td><?php echo $sorteio->numero_sorteio ?></td><td>R$ <?php echo number_format($sorteio->premio, 2, ',', '.') ?></td><td><i><?php echo $sorteio->ganhador . '</i> [' . $sorteio->nivel . ']' ?></td></tr>
                <?php } ?>
            <?php } ?>
        </table>
    </a>
</div>