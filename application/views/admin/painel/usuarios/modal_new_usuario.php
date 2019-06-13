<div id="modalNewUsuario" class="modal">
    <div class="col-md-6 col-sm-8 col-xs-12 sorteForms">
        <i class="glyphicon glyphicon-remove close" onclick="closeModal()"></i>

        <form id="newUserFormAdm">
            <label class="text-center">Novo Usuário</label>
            <div class="col-sm-6 col-xs-12">
                <label>
                    <span class="labelForm"><i class="glyphicon glyphicon-user"></i> Nome Completo</span>
                    <input type="text" name="nome" id="nome" placeholder="Nome" required maxlength="80" pattern="[a-zà-úA-ZÀ-Ú]{3,50}(\s[a-zà-úA-ZÀ-Ú]{2,50})+$">
                </label>
                <label>
                    <span class="labelForm"><i class="glyphicon glyphicon-sunglasses"></i> Apelido</span>
                    <input type="text" name="apelido" id="apelido" placeholder="Apelido" required maxlength="20" pattern="([a-zà-ú0-9_])+$">
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

                <label>
                    <span class="labelForm"> Patrocinador <i class="glyphicon glyphicon-asterisk"></i></span>
                    <select class="usuario" style="width: 100%;" name="patrocinador">
                        <option value="0">Selecione</option>
                    </select>
                </label>

                <div class="margT15">

                </div>
                <button type="reset" class="btn btn-default">Limpar</button>
                <button class="btn btn-primary" type="submit">Cadastrar</button>
            </div>
        </form>

    </div>

    <div id="subModal" class="modal">
        <div id="responseFiltro" class="responseMsg alert">

        </div>
    </div>
</div>