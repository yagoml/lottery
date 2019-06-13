<div id="modalEditUsuarios" class="modal">
    <div class="col-md-6 col-sm-8 col-xs-12 sorteForms">
        <i class="glyphicon glyphicon-remove close" onclick="closeModal()"></i>
        <form id="editUserFormAdm">
            <label class="text-center">Novo Usuário</label>
            <div class="col-sm-6 col-xs-12">
                <label>
                    <span class="labelForm"><i class="glyphicon glyphicon-user"></i> Nome Completo</span>
                    <input type="text" name="nome" id="meu_nome" placeholder="Nome" required maxlength="80" pattern="^[a-zà-úA-ZÀ-Ú]{3,50}(\s[a-zà-úA-ZÀ-Ú]{2,50})+$">
                </label>
                <label>
                    <span class="labelForm"><i class="glyphicon glyphicon-user"></i> Apelido</span>
                    <input type="text" name="apelido" id="meu_apelido" placeholder="Apelido" required maxlength="20" pattern="([a-zà-ú0-9]){3,20}">
                </label>
                <label>
                    <span class="labelForm"><i class="glyphicon glyphicon-user"></i> Celular</span>
                    <input type="text" name="celular" id="meu_celular" placeholder="Celular" maxlength="15" pattern="\([0-9]{2}\)[0-9]{4,5}-[0-9]{4}$">
                </label>
                <label>
                    <span class="labelForm"> E-mail <i class="glyphicon glyphicon-asterisk"></i></span>
                    <input type="email" name="email" id="meu_email" placeholder="E-mail" required maxlength="255">
                </label>
            </div>
            <div class="col-sm-6 col-xs-12">
                <label>
                    <span class="labelForm"><i class="glyphicon glyphicon-user"></i> CPF</span>
                    <input type="text" name="cpf" id="meu_cpf" placeholder="CPF" maxlength="15">
                </label>
                <label>
                    <span class="labelForm"><i class="glyphicon glyphicon-asterisk"></i> Nova Senha</span>
                    <input type="password" name="password" id="meu_newPass" placeholder="Nova Senha" maxlength="255">
                </label>
                <label>
                    <span class="labelForm"> Confirme a Senha <i class="glyphicon glyphicon-asterisk"></i></span>
                    <input type="password" name="conf_password" id="conf_password" placeholder="Confirme a Senha" maxlength="255">
                </label>

                <input type="hidden" name="id" id="meu_id">

                <div class="text-center margT20">
                    <button class="btn btn-primary" type="submit" id="btnCadastro">Salvar</button>
                </div>
            </div>
        </form>
    </div>

    <div id="subModal1" class="modal">
        <div id="responseFiltro1" class="responseMsg alert">

        </div>
    </div>
</div>