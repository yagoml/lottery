<div id="mainAdmin" class="container-fluid">
    <div class="col-sm-2 col-xs-12 padL0sm">
        <ul class="listMenu">
            <li><a href="<?php echo base_url('admin/extrato') ?>" <?php echo $_SERVER['REDIRECT_QUERY_STRING'] == '/admin/extrato' ? 'class="activeMenuLink"' : '' ?>>Extrato</a></li>
            <li><a href="<?php echo base_url('admin/sorteios') ?>" <?php echo $_SERVER['REDIRECT_QUERY_STRING'] == '/admin/sorteios' ? 'class="activeMenuLink"' : '' ?>>Sorteios</a></li>
            <li><a href="<?php echo base_url('admin/sorteiosConcluidos') ?>" <?php echo $_SERVER['REDIRECT_QUERY_STRING'] == '/admin/sorteiosConcluidos' ? 'class="activeMenuLink"' : '' ?>>Sorteios Concluídos</a></li>
            <li><a href="<?php echo base_url('admin/vouchers') ?>" <?php echo $_SERVER['REDIRECT_QUERY_STRING'] == '/admin/vouchers' ? 'class="activeMenuLink"' : '' ?>>Vouchers</a></li>
            <li><a href="<?php echo base_url('admin/usuarios') ?>" <?php echo $_SERVER['REDIRECT_QUERY_STRING'] == '/admin/usuarios' ? 'class="activeMenuLink"' : '' ?>>Usuários</a></li>
            <li><a class="openDropdown" onclick="openDropdown($(this))">Configurações &nbsp;<i class="glyphicon glyphicon-triangle-bottom pull-right"></i></a>
                <ul class="dropdownVertical hideDrop">
                    <li><a href="<?php echo base_url('admin/configSystem') ?>" <?php echo $_SERVER['REDIRECT_QUERY_STRING'] == '/admin/configSystem' ? 'class="activeMenuLink"' : '' ?>>Config. Sistema</a></li>
                    <li><a href="<?php echo base_url('admin/configSorteios') ?>" <?php echo $_SERVER['REDIRECT_QUERY_STRING'] == '/admin/configSorteios' ? 'class="activeMenuLink"' : '' ?>>Config. Sorteios</a></li>
                    <li><a href="<?php echo base_url('admin/configComissoes') ?>" <?php echo $_SERVER['REDIRECT_QUERY_STRING'] == '/admin/configComissoes' ? 'class="activeMenuLink"' : '' ?>>Config. Comissões</a></li>
                    <li><a href="<?php echo base_url('admin/configEmail') ?>" <?php echo $_SERVER['REDIRECT_QUERY_STRING'] == '/admin/configEmail' ? 'class="activeMenuLink"' : '' ?>>Config. E-mail</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="col-sm-8 col-xs-12" id="panelContent">
        <?php $this->load->view($paginaInterna) ?>
    </div>
    <div class="col-sm-2 col-xs-12 padR0">
        <?php Repository\Gadgets::companyStats() ?>
    </div>
</div>