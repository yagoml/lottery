<form class="formsAdmin" id="formConfigMail">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <label>Host</label>
        <input type="text" name="smtp_host" class="form-control center-block" placeholder="Host" maxlength="255" <?php echo $configEmail ? 'value="' . $configEmail->smtp_host . '"' : '' ?>>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <label>User</label>
        <input type="text" name="smtp_user" class="form-control center-block" placeholder="Usuário" maxlength="255" <?php echo $configEmail ? 'value="' . $configEmail->smtp_user . '"' : '' ?>>
    </div>
    <div class="col-md-2 col-sm-3 col-xs-12">
        <label>Porta</label>
        <input type="number" name="smtp_port" class="form-control center-block" placeholder="Porta" min="1" max="65535" <?php echo $configEmail ? 'value="' . $configEmail->smtp_port . '"' : '' ?>>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <label>Senha</label>
        <input type="password" name="smtp_pass" class="form-control center-block" placeholder="Senha" maxlength="255">
    </div>

    <div class="col-xs-12 text-center">
        <button type="submit" class="btn btn-primary btnEntrar">Salvar</button>
        <button class="btn btn-default" type="reset">Resetar</button>
    </div>
</form>

<?php include_once 'lib/plugins/modal/modal_view.html' ?>