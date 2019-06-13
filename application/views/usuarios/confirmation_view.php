<div class="container-fluid">
    <?php $this->load->view('breadcrumb_view') ?>

    <div class="container">
        <?php if (isset($msg)) { ?>
            <div class="col-xs-12 text-center">
                <div class="responseMsg alert alert-success">
                    <?php echo $msg ?>
                </div>
            </div>
            <div class="col-xs-12 text-center margT20">
                <a href="<?php echo base_url() ?>" title="Início" class="btn btn-primary">Início</a>
                <?php if ($this->session->userdata('user')) { ?>
                    <a href="<?php echo base_url('usuarios/conta') ?>" title="Minha Conta" class="btn btn-success">Minha Conta</a>
                <?php } else { ?>
                    <a href="<?php echo base_url('auth') ?>" title="Entrar" class="btn btn-success">Entrar</a>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>