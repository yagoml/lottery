<div class="container-fluid">
    <?php $this->load->view('breadcrumb_view') ?>
    <div class="container">
        <div class="col-sm-2 col-xs-12">
            <div class="row">
                <ul class="listMenu">
                    <li><a href="<?php echo base_url('usuarios/conta') ?>" <?php echo $_SERVER['REDIRECT_QUERY_STRING'] == '/usuarios/conta' ? 'class="activeMenuLink"' : '' ?>>Minha Conta</a></li>
                    <?php if (!\Repository\Usuarios::getUsuario($this->session->userdata['user']['id'])->cpf) { ?>
                        <li><a href="<?php echo base_url('usuarios/completar') ?>" <?php echo $_SERVER['REDIRECT_QUERY_STRING'] == '/usuarios/completar' ? 'class="activeMenuLink"' : '' ?>>Completar Cadastro</a></li>
                    <?php } ?>
                    <li><a href="<?php echo base_url('usuarios/meusSorteios') ?>" <?php echo $_SERVER['REDIRECT_QUERY_STRING'] == '/usuarios/meusSorteios' ? 'class="activeMenuLink"' : '' ?>>Meus Sorteios</a></li>
                    <li><a href="<?php echo base_url('usuarios/editar') ?>" <?php echo $_SERVER['REDIRECT_QUERY_STRING'] == '/usuarios/editar' ? 'class="activeMenuLink"' : '' ?>>Editar Informações</a></li>
                    <li><a href="<?php echo base_url('usuarios/extrato') ?>" <?php echo $_SERVER['REDIRECT_QUERY_STRING'] == '/usuarios/extrato' ? 'class="activeMenuLink"' : '' ?>>Extrato</a></li>
                    <li><a href="<?php echo base_url('usuarios/transferencias') ?>" <?php echo $_SERVER['REDIRECT_QUERY_STRING'] == '/usuarios/transferencias' ? 'class="activeMenuLink"' : '' ?>>Transferências</a></li>
                    <li><a href="<?php echo base_url('usuarios/comissoes') ?>" <?php echo $_SERVER['REDIRECT_QUERY_STRING'] == '/usuarios/comissoes' ? 'class="activeMenuLink"' : '' ?>>Comissões</a></li>
                    <li><a href="<?php echo base_url('usuarios/indicados') ?>" <?php echo $_SERVER['REDIRECT_QUERY_STRING'] == '/usuarios/indicados' ? 'class="activeMenuLink"' : '' ?>>Indicados</a></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-8 col-xs-12" id="panelContent">
            <?php $this->load->view($paginaInterna) ?>
        </div>
        <div class="col-sm-2 col-xs-12">
            <div class="row">
                <?php Repository\Gadgets::userStats() ?>
            </div>
        </div>
    </div>
</div>