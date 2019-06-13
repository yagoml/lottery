<div class="container-fluid">
    <?php $this->load->view('breadcrumb_view') ?>
    <div class="container">
        <?php if ($topJogadores) { ?>
            <div class="ranking">
                <table class="table table-hover tableRanks">
                    <tr><th>Posição</th><th>Usuário</th><th>Bilhetes</th></tr>
                    <?php foreach ($topJogadores as $pos => $top) { ?>
                        <tr <?php echo $pos == 0 ? 'class="winner"' : '' ?>><td><?php echo $pos + 1 . 'º' ?></td><td><b><i><?php echo ($pos == 0 ? '<i class="glyphicon glyphicon-king" style="color: yellow;"></i> ' : '') . $top->apelido . '</b></i> [' . $top->nivel . ']' ?></i></td><td><?php echo $top->bilhetes ?></td></tr>
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