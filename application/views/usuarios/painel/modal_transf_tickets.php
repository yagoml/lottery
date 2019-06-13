<div id="transfTickets" class="modal">
    <div class="col-md-3 col-sm-4 col-xs-12 sub-modal-box buscaSorteios">
        <i class="glyphicon glyphicon-remove close" onclick="closeModal()"></i>
        <form id="formTransfTickets">
            <fieldset><b>Transferência de Tickets</b></fieldset>

            <div class="col-xs-12 margB15">
                <select name="usuario" class="form-control usuario" style="width: 100%;" required>
                    <option value="">Apelido Usuário</option>
                </select>
            </div>

            <div class="col-xs-6 margB15 formBox">
                <input type="number" name="qtd" class="form-control" required> <span>Quantidade</span>
            </div>

            <div class="col-xs-12 margB15 formBox">
                <div class="g-recaptcha" data-theme="dark" data-sitekey="<?php echo \Repository\Config_system::ggApiKey() ?>" style="margin: 20px 0;"></div>
            </div>

            <div id="subModal" class="modal">
                <div id="responseFiltro" class="responseMsg alert alert-danger">

                </div>
            </div>

            <div class="col-xs-12 text-right">
                <button type="reset" class="btn btn-default">Resetar</button>
                <button type="submit" class="btn btn-primary">Transferir</button>
            </div>
        </form>
    </div>
</div>

<script src="https://www.google.com/recaptcha/api.js?"></script>