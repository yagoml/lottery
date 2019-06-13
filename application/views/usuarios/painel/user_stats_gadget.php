<ul class="listUnstyled alert-info">
    <li>Nível: <b><?php echo $user->nivel ?></b></li>
    <li>
        <div class="progress">
            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $expBar ?>"
                 aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $expBar ?>%">
                <?php echo number_format($expBar, 2, ',', '.') ?>%
            </div>
        </div>
    </li>
    <li>Experiência: <b><?php echo $user->xp ?></b></li>
    <li>Ganhos: R$ <b><?php echo number_format($user->ganhos, 2, ',', '.') ?></b></li>
</ul>

<ul class="listUnstyled alert-success">
    <li>Tickets: <b><?php echo $user->bilhetes ?></b></li>
    <li>Saldo: <b>R$ <?php echo number_format($user->saldo, 2, ',', '.') ?></b></li>
</ul>