<div class="container-fluid">
    <div class="container">
        <div class="row text-center">
            <h3>Novo Jogador</h3>
        </div>

        <div class="row">
            <div class="text-center">
                <form id="newUserForm">
                    <div class="col-sm-offset-2 col-sm-8 col-xs-12 sorteForms">
                        <div class="col-sm-6 col-xs-12">
                            <label>
                                <span class="labelForm"><i class="glyphicon glyphicon-user"></i> Nome Completo</span>
                                <input type="text" name="nome" id="nome" placeholder="Nome" required maxlength="80" pattern="[a-zà-úA-ZÀ-Ú]{3,50}(\s[a-zà-úA-ZÀ-Ú]{2,50})+$">
                            </label>
                            <label>
                                <span class="labelForm"><i class="glyphicon glyphicon-sunglasses"></i> Apelido</span>
                                <input type="text" name="apelido" id="apelido" placeholder="Apelido" required maxlength="25" pattern="([a-zà-ú0-9_])+$">
                            </label>
                            <label>
                                <span class="labelForm"><i class="glyphicon glyphicon-envelope"></i> E-mail</span>
                                <input type="email" name="email" id="email" placeholder="E-mail" required maxlength="255" pattern="[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$">
                            </label>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <label>
                                <span class="labelForm"><i class="glyphicon glyphicon-asterisk"></i> Senha</span>
                                <input type="password" name="password" id="password" placeholder="Senha" required maxlength="255">
                            </label>
                            <label>
                                <span class="labelForm"> Confirme a Senha <i class="glyphicon glyphicon-asterisk"></i></span>
                                <input type="password" name="conf_password" id="conf_password" placeholder="Confirme a Senha" required maxlength="255">
                            </label>

                            <input type="checkbox" name="aceite" required> Concordo com os <a href="<?php echo base_url('usuarios/termos') ?>" target="blank">Termos e Condições</a>
                            
                            <input type="hidden" name="patrocinador" value="<?php echo $this->uri->segment(3) ? (int) $this->uri->segment(3) : 0 ?>">
                            
                            <div class="g-recaptcha" data-theme="dark" data-sitekey="<?php echo \Repository\Config_system::ggApiKey() ?>" style="margin: 20px 0;"></div>

                            <button type="reset" class="btn btn-default">Limpar</button>
                            <button class="btn btn-primary" type="submit" id="btnCadastro">Cadastrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once 'lib/plugins/modal/modal_view.html' ?>

<script src="https://www.google.com/recaptcha/api.js?"></script>