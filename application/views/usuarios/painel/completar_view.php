<style>
    .g-recaptcha{
        transform: scale(0.70);
        transform-origin: 0 0;
    }
</style>

<form id="completeCadastroForm">
    <div class="col-sm-offset-3 col-md-4 col-sm-6 col-xs-12 sorteForms">
        <label>
            <span class="labelForm"><i class="glyphicon glyphicon-user"></i> CPF</span>
            <input type="text" name="cpf" id="nome" placeholder="CPF" required maxlength="15" pattern="[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}$">
        </label>
        <label>
            <span class="labelForm"><i class="glyphicon glyphicon-user"></i> Celular</span>
            <input type="text" name="celular" id="celular" placeholder="Celular" required maxlength="15" pattern="\([0-9]{2}\) [0-9]{4,5}-[0-9]{4}$">
        </label>

        <div class="text-center">
            <div class="g-recaptcha" data-theme="dark" data-sitekey="<?php echo \Repository\Config_system::ggApiKey() ?>" style="margin: 20px 0;"></div>
        </div>

        <div class="text-right">
            <button type="reset" class="btn btn-default">Limpar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </div>
</form>

<script src="https://www.google.com/recaptcha/api.js?"></script>

<?php include_once 'lib/plugins/modal/modal_view.html' ?>