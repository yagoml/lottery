<header>
    <div class="container-fluid">
        <nav class="navbar navbar-default">
            <div class="row-fluid" style="padding:0;">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse navbar-menu" id="bs-example-navbar-collapse-1" style="padding: 0;">
                    <div class="container" style="padding: 0;">
                        <ul class="nav navbar-nav" style='width: 100%;'>
                            <li>
                                <a href="<?php echo base_url() ?>" <?php echo !isset($_SERVER['REDIRECT_QUERY_STRING']) ? 'class="activeLinkHeader"' : '' ?>><i class="glyphicon glyphicon-home"></i> Início</a>
                            </li>

                            <li>
                                <a class="botao-menu <?php echo $this->uri->segment(1) == 'sorteios' && $_SERVER['REDIRECT_QUERY_STRING'] != '/sorteios/tickets' ? 'activeLinkHeader' : '' ?>"><i class="glyphicon glyphicon-usd"></i> Sorteios <span class="caret"></span></a>
                                <ul class="dropdown-menu drop-menu">
                                    <li>
                                        <a href="<?php echo base_url('sorteios') ?>">Loteria</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('sorteios/roletas') ?>">Roletas</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('sorteios/concluidos/loteria') ?>">Tickets Premiados</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('sorteios/concluidos/roleta') ?>">Roletas Premiadas</a>
                                    </li>
                                    <?php if ($this->session->userdata('user')['id']) { ?>
                                        <li>
                                            <a href="<?php echo base_url('usuarios/meusSorteios') ?>">Meus Sorteios</a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>

                            <li>
                                <a class="botao-menu <?php echo $this->uri->segment(1) == 'rankings' ? 'activeLinkHeader' : '' ?>"><i class="glyphicon glyphicon-usd"></i> Rankings <span class="caret"></span></a>
                                <ul class="dropdown-menu drop-menu">
                                    <li>
                                        <a href="<?php echo base_url('rankings/topNivel') ?>">Nível</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('rankings/topJogadores') ?>">Tickets</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('rankings/topFaturamento') ?>">Faturamento</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('rankings/topGanhadores') ?>">Ganhadores</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('rankings/topIndicacoes') ?>">Indicações</a>
                                    </li>
                                </ul>
                            </li>

                            <!--                            <li class="dropdown">
                                                            <a><i class="glyphicon glyphicon-question-sign"></i> Como Funciona</a>
                                                        </li>-->

                            <li class="dropdown">
                                <a href="<?php echo $this->session->userdata('user')['id'] ? base_url('sorteios/tickets') : base_url('auth') ?>" <?php echo isset($_SERVER['REDIRECT_QUERY_STRING']) && $_SERVER['REDIRECT_QUERY_STRING'] == '/sorteios/tickets' ? 'class="activeLinkHeader"' : '' ?>><i class="glyphicon glyphicon-tags"></i> &nbsp;Comprar Tickets</a>
                            </li>

                            <?php if ($this->session->userdata('admin')) { ?>
                                <li class="dropdown pull-right">
                                    <a class="col-xs-12" title="Sair" href="<?php echo base_url('auth/logout') ?>"><i class="glyphicon glyphicon-log-out"></i> Sair</a>
                                </li>

                                <li class="pull-right">
                                    <a href="<?php echo base_url('admin') ?>" title="Painel ADM">
                                        <i class="glyphicon glyphicon-king"></i> <b>ADM</b>
                                    </a>
                                </li>

                            <?php } else { ?>
                                <?php if (!$this->session->userdata('user')['id']) { ?>
                                    <li class="dropdown pull-right">
                                        <a <?php echo $this->uri->segment(1) == 'usuarios' ? 'class="activeLinkHeader"' : '' ?> href="<?php echo base_url('usuarios') ?>"><i class="glyphicon glyphicon-user"></i> Cadastro</a>
                                    </li>
                                <?php } ?>

                                <li class="dropdown pull-right">
                                    <?php if ($this->session->userdata('user')['id']) { ?>
                                        <a class="col-xs-12" title="Sair" href="<?php echo base_url('auth/logout') ?>"><i class="glyphicon glyphicon-log-out"></i> Sair</a>
                                    <?php } else { ?>
                                        <a class="col-xs-12 <?php echo $this->uri->segment(1) == 'auth' ? 'activeLinkHeader' : '' ?>" title="Entrar" href="<?php echo base_url('auth') ?>"><i class="glyphicon glyphicon-log-in"></i> Entrar</a>
                                    <?php } ?>
                                </li>

                                <?php if ($this->session->userdata('user')['id']) { ?>
                                    <li class="pull-right">
                                        <a href="<?php echo base_url('usuarios/conta') ?>" title="Minha Conta"<?php echo $this->uri->segment(1) == 'usuarios' ? 'class="activeLinkHeader"' : '' ?> >
                                            <i class="glyphicon glyphicon-user"></i> Minha Conta
                                        </a>
                                    </li>
                                <?php } ?>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>