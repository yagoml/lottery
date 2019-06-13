<script type="text/javascript" src="<?php echo base_url('lib/plugins/clipboard.min.js') ?>"></script>

<div class="container-fluid margB20">
    <h4 class="text-center">Bem vindo <?php echo '<u>' . explode(' ', $this->session->userdata['user']['nome'])[0] . ' (<i>' . $this->session->userdata['user']['apelido'] . '</i>)</u>' ?></h4>

    Link para indicações: <u><b class="pad5 alert-info"><?php echo base_url('/usuarios/novo/' . $this->session->userdata('user')['id']) ?></b></u> <button id="linkIndicacao" class="btn btn-default" title="Copiar" data-clipboard-text="<?php echo base_url('/usuarios/novo/' . $this->session->userdata('user')['id']) ?>"><i class="glyphicon glyphicon-duplicate"></i></button>
    <button class="btn btn-success pull-right" onclick="openTransfTickets()">Transferir Tickets</button>
</div>

<?php $this->load->view("usuarios/painel/modal_transf_tickets") ?>
<?php include_once 'lib/plugins/modal/modal_view.html' ?>

<script type="text/javascript">
    new Clipboard('#linkIndicacao');
</script>
