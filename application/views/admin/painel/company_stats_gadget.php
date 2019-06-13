<ul class="listUnstyled alert-info">
    <li>Tickets Dist.: <b><?php echo $company['bilhetesDist'] ?></b></li>
    <li>Total R$: <b><?php echo number_format($company['bilhetesDist'] * 2, 2, ',', '.') ?></b></li>
    <li>Sorteios: <b><?php echo $company['qtdSorteios'] ?></b></li>
    <li>Caixa: <b>R$ <?php echo number_format($company['caixa'], 2, ',', '.') ?></b></li>
</ul>