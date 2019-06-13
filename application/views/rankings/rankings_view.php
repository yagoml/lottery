<div class="text-center alert alert-warning topFive">
    <i class="glyphicon glyphicon-king"></i> TOP FIVE <i class="glyphicon glyphicon-king"></i> <i>Os 5 Maiores:</i>
</div>

<div class="ranking">
    <a href="<?php echo base_url('rankings/topNivel') ?>" title="Ranking Top Nível">
        <div class="topApost">
            <i class="glyphicon glyphicon-king" style="color: yellow;"></i> Níveis
        </div>
        <table class="table table-bordered table-hover tableDefault">
            <tr><th>Pos.</th><th>Jogador</th><th>Nível</th></tr>
            <?php foreach ($topNivel as $pos => $nivel) { ?>
                <tr <?php echo $pos == 0 ? 'class="winner"' : '' ?>><td><?php echo $pos + 1 ?>º</td><td><i><?php echo ($pos == 0 ? '<i class="glyphicon glyphicon-king" style="color: yellow;"></i> ' : '') . $nivel->apelido ?></i></td><td><?php echo $nivel->nivel ?></td></tr>
            <?php } ?>
        </table>
    </a>
</div>

<div class="ranking">
    <a href="<?php echo base_url('rankings/topJogadores') ?>" title="Ranking Top Jogadores">
        <div class="topApost">
            <i class="glyphicon glyphicon-tag" style="color: yellow;"></i> Tickets
        </div>
        <table class="table table-bordered table-hover tableDefault">
            <tr><th>Pos.</th><th>Jogador</th><th>Bilhetes</th></tr>
            <?php foreach ($topJogadores as $pos => $apostador) { ?>
                <tr <?php echo $pos == 0 ? 'class="winner"' : '' ?>><td><?php echo $pos + 1 ?>º</td><td><i><?php echo ($pos == 0 ? '<i class="glyphicon glyphicon-king" style="color: yellow;"></i> ' : '') . $apostador->apelido . '</i> [' . $apostador->nivel . ']' . '</td><td>' . $apostador->bilhetes ?></td></tr>
            <?php } ?>
        </table>
    </a>
</div>

<div class="ranking">
    <a href="<?php echo base_url('rankings/topFaturamento') ?>" title="Ranking Top Faturamento">
        <div class="topApost">
            <i class="glyphicon glyphicon-usd" style="color: yellow;"></i> Faturamento
        </div>
        <table class="table table-bordered table-hover tableDefault">
            <tr><th>Pos.</th><th>Jogador</th><th>Faturamento</th></tr>
            <?php foreach ($topFaturamento as $pos => $nome) { ?>
                <tr <?php echo $pos == 0 ? 'class="winner"' : '' ?>><td><?php echo $pos + 1 ?>º</td><td><i><?php echo ($pos == 0 ? '<i class="glyphicon glyphicon-king" style="color: yellow;"></i> ' : '') . $nome->apelido . '</i> [' . $nome->nivel . ']' . '</td><td>R$ ' . number_format($nome->ganhos, 2, ',', '.') ?></td></tr>
            <?php } ?>
        </table>
    </a>
</div>

<div class="ranking">
    <a href="<?php echo base_url('rankings/topGanhadores') ?>" title="Ranking Top Ganhadores">
        <div class="topApost">
            <i class="glyphicon glyphicon-king" style="color: yellow;"></i> Ganhadores
        </div>
        <table class="table table-bordered table-hover tableDefault">
            <tr><th>Pos.</th><th>Jogador</th><th>Sorteado</th></tr>
            <?php foreach ($topGanhadores as $pos => $nome) { ?>
                <tr <?php echo $pos == 0 ? 'class="winner"' : '' ?>><td><?php echo $pos + 1 ?>º</td><td><i><?php echo ($pos == 0 ? '<i class="glyphicon glyphicon-king" style="color: yellow;"></i> ' : '') . $nome->apelido . '</i> [' . $nome->nivel . ']' . '</td><td>' . $nome->sorteios_ganhos ?></td></tr>
            <?php } ?>
        </table>
    </a>
</div>

<div class="ranking">
    <a href="<?php echo base_url('rankings/topIndicacoes') ?>" title="Ranking Top Indicacoes">
        <div class="topApost">
            <i class="glyphicon glyphicon-plus" style="color: yellow;"></i>  Indicações
        </div>
        <table class="table table-bordered table-hover tableDefault">
            <tr><th>Pos.</th><th>Jogador</th><th>Filhos</th></tr>
            <?php foreach ($topIndicacoes as $pos => $patrocinador) { ?>
                <tr <?php echo $pos == 0 ? 'class="winner"' : '' ?>><td><?php echo $pos + 1 ?>º</td><td><i><?php echo ($pos == 0 ? '<i class="glyphicon glyphicon-king" style="color: yellow;"></i> ' : '') . $patrocinador->apelido . '</i> [' . $patrocinador->nivel . ']' . '</td><td>' . $patrocinador->indicacoes . '</td>' ?></tr>
            <?php } ?>
        </table>
    </a>
</div>