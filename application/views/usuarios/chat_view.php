<div class="col-xs-12 text-center titleChat">
    CHAT
</div>
<div class="col-xs-12 text-left" id="page-wrap">
    <div class="row">
        <?php if ($this->session->userdata('user')['id']) { ?>
            <p id="name-area"></p>
        <?php } ?>
        <div id="chat-wrap"><div id="chat-area"></div></div>
        <?php if ($this->session->userdata('user')['id']) { ?>
            <form id="send-message-area">
                <textarea id="sendie" maxlength = '100' placeholder="Mensagem + Enter"></textarea>
            </form>
        <?php } else { ?>
            Entre para mandar mensagens. <a class="btn btn-primary" href="<?php echo base_url('auth') ?>">Entrar</a>
        <?php } ?>
    </div>
</div>