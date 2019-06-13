<form id="editUserForm">
    <div class="col-sm-12 col-xs-12 sorteForms">
        <div class="col-sm-6 col-xs-12">
            <label>
                <span class="labelForm"><i class="glyphicon glyphicon-asterisk"></i> Senha Atual</span>
                <input type="password" name="oldPassword" id="password" placeholder="Senha Atual" maxlength="255">
            </label>
            <label>
                <span class="labelForm"><i class="glyphicon glyphicon-asterisk"></i> Nova Senha</span>
                <input type="password" name="password" id="newPass" placeholder="Nova Senha" maxlength="255">
            </label>
            <label>
                <span class="labelForm"> Confirme a Senha <i class="glyphicon glyphicon-asterisk"></i></span>
                <input type="password" name="conf_password" id="conf_password" placeholder="Confirme a Senha" maxlength="255">
            </label>
        </div>

        <div class="col-sm-6 col-xs-12">
            <label>
                <span class="labelForm"><i class="glyphicon glyphicon-user"></i> Nome Completo</span>
                <input type="text" name="nome" id="nome" value="<?php echo $userInfo->nome ?>" placeholder="Nome" required maxlength="80" pattern="[a-zà-úA-ZÀ-Ú]{3,50}(\s[a-zà-úA-ZÀ-Ú]{2,50})+$">
            </label>
            <label>
                <span class="labelForm"><i class="glyphicon glyphicon-user"></i> Celular</span>
                <input type="text" name="celular" id="celular" <?php echo $userInfo->celular ? 'value="' . $userInfo->celular . '"' : '' ?> placeholder="Celular" required maxlength="15" pattern="\([0-9]{2}\) [0-9]{4,5}-[0-9]{4}$">
            </label>
            <div class="text-center">
                <div class="g-recaptcha" data-theme="dark" data-sitekey="<?php echo \Repository\Config_system::ggApiKey() ?>" style="margin: 20px 0;"></div>
            </div>

            <div class="text-center">
                <button type="reset" class="btn btn-default">Limpar</button>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </div>
    </div>
</form>

<?php include_once 'lib/plugins/modal/modal_view.html' ?>

<script src='https://www.google.com/recaptcha/api.js'></script>