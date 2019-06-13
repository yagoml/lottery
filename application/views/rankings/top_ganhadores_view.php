<div class="container-fluid">
    <?php $this->load->view('breadcrumb_view') ?>
    <div class="container">
        <?php if ($topGanhadores) { ?>
            <div class="ranking">
                <table class="table table-hover tableRanks">
                    <tr><th>Posição</th><th>Usuário</th><th>Sorteado</th></tr>
                    <?php foreach ($topGanhadores as $pos => $nome) { ?>
                        <tr <?php echo $pos == 0 ? 'class="winner"' : '' ?>><td><?php echo $pos + 1 ?>º</td><td><i><?php echo ($pos == 0 ? '<i class="glyphicon glyphicon-king" style="color: yellow;"></i> ' : '') . $nome->apelido . '</i> [' . $nome->nivel . ']' . '</td><td>' . $nome->sorteios_ganhos ?></td></tr>
                    <?php } ?>
                </table>
            </div>
        <?php } else { ?>
            <div class="responseMsg text-center alert alert-warning">
                Sem Jogadores ainda.
            </div>
            <center class="margT15">
                <a href="javascript:window.history.go(-1)" class="btn btn-default">Voltar</a>
            </center>
        <?php } ?>
    </div>
</div>