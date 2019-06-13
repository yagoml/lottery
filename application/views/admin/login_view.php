<div class="container-fluid">
    <?php $this->load->view('breadcrumb_view') ?>
</div>

<div class="container">
    <div class="col-sm-offset-4 col-sm-4 boxLogin">
        <img class="img-responsive center-block" src="<?php echo base_url(\Repository\Config_system::logo()) ?>">
        <form id="formAdmLogin" method="post">
            <input type="text" name="login" class="form-control center-block" placeholder="Login" maxlength="255" required>
            <input type="password" name="password" class="form-control center-block" id="password" placeholder="Senha" maxlength="255" required>

            <div class="g-recaptcha" data-theme="dark" data-sitekey="<?php echo \Repository\Config_system::ggApiKey() ?>" style="margin: 20px 0;"></div>

            <button type="submit" class="btn btn-primary pull-right btnEntrar">Entrar</button>
        </form>
    </div>
    <br>
</div>

<?php include_once 'lib/plugins/modal/modal_view.html' ?>

<script src="https://www.google.com/recaptcha/api.js?"></script>