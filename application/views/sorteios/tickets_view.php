<?php if ($this->session->userdata('user')['id']) { ?>
    <link rel="stylesheet" href="<?php echo base_url('lib/plugins/select2/dist/css/select2.min.css') ?>">

    <div class="container-fluid">
        <?php $this->load->view('breadcrumb_view') ?>

        <div class="container">
            <div class="col-xs-12 text-center">
                <form id="compraBilhetes" method="post">
                    <div class="col-xs-12">
                        <label for="qtd">Quantos bilhetes você deseja comprar?</label>
                        <input class="form-control" type="number" value="5" name="qtd" id="qtd" min="1" max="9999" style="width: 70px;" required>
                        <span class="alert-info pad5">Valor: <b>R$ <span id="valor">10</span></b></span>
                    </div>

                    <div id="tiposPgto" class="col-xs-12 margT20">
                        <label>Selecione o método de Pagamento</label>
                        <input type="radio" value="pagSeguro" name="tipoPgto" required> Cartão
                        <input type="radio" value="pagSeguro" name="tipoPgto" required> PagSeguro
                        <input type="radio" value="boleto" name="tipoPgto" required> Boleto
                        <input type="radio" value="ted" name="tipoPgto" required> TED
                        <input type="radio" value="voucher" name="tipoPgto" required> Voucher
                        <?php if ($saldo >= 2) { ?>
                        <input type="radio" value="saldo" name="tipoPgto" required> Saldo (<b>R$ <?php echo number_format($saldo, '2', ',', '.') ?></b>)
                        <?php } ?>
                    </div>

                    <div id="voucher" class="col-xs-12 text-center">

                    </div>

                    <button type="button" class="btn btn-danger" id="presente"><i class="glyphicon glyphicon-gift"></i> Presentear</button>
                    <div id="gift" class="text-center margT20">

                    </div>

                    <div class="col-xs-12">
                        <div class="g-recaptcha" data-theme="dark" data-sitekey="<?php echo \Repository\Config_system::ggApiKey() ?>" style="margin: 20px 0;"></div>
                        <button type="submit" class="btn btn-primary" id="btnSubmit">Comprar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include_once 'lib/plugins/modal/modal_view.html' ?>
    <script src="https://www.google.com/recaptcha/api.js?"></script>
    <script type="text/javascript" src="<?php echo base_url('lib/plugins/select2/dist/js/select2.min.js') ?>"></script>
<?php } ?>