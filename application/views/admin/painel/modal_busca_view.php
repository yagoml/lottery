<div id="ymlModal" class="modal">
    <div class="col-sm-6 col-xs-12 sub-modal-box buscaSorteios">
        <i class="glyphicon glyphicon-remove close" onclick="closeModal()"></i>
        <form id="admBuscaSorteio">
            <fieldset>Filtrar Sorteios</fieldset>
            <div class="col-sm-6 col-xs-12 margT20">
                <div class="row">
                    <div class="col-xs-6 margB15">
                        <label>Número</label>
                        <input type="number" id="numero" name="numero" class="form-control">
                    </div>
                    <div class="col-xs-6 formBox">
                        <label>Tipo</label>
                        <input type="radio" name="tipo" value="0" required> Loteria
                        <input type="radio" name="tipo" value="1" required> Roletas
                    </div>
                    <div class="col-xs-12 margB15">
                        <label>Ganhador</label>
                        <select name="usuario" class="form-control usuario" style="width: 100%;">
                            <option value="">Selecione</option>
                        </select>
                    </div>
                    <label>Data</label>
                    <div class="col-xs-6 formBox">
                        <input type="text" id="startDate" name="startDate" class="form-control date"> <span>De</span>
                    </div>
                    <div class="col-xs-6 formBox">
                        <input type="text" id="endDate" name="endDate" class="form-control date"> <span>Até</span>
                    </div>

                    <label>Prêmio</label>
                    <div class="col-xs-6 formBox">
                        <input type="text" id="minPremio" name="minPremio" class="form-control"> <span>Mínimo</span>
                    </div>
                    <div class="col-xs-6 formBox">
                        <input type="text" id="maxPremio" name="maxPremio" class="form-control"> <span>Máximo</span>
                    </div>
                    <label>Participantes</label>
                    <div class="col-xs-6 formBox">
                        <input type="number" id="minParticipantes" name="minParticipantes" class="form-control"> <span>Mínimo</span>
                    </div>
                    <div class="col-xs-6 formBox">
                        <input type="number" id="maxParticipantes" name="maxParticipantes" class="form-control"> <span>Máximo</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xs-12 margT20">
                <div class="row">
                    <label>Preço</label>
                    <div class="col-xs-6 formBox">
                        <input type="number" name="minPreco" class="form-control"> <span>Mínimo</span>
                    </div>
                    <div class="col-xs-6 formBox">
                        <input type="number" name="maxPreco" class="form-control"> <span>Máximo</span>
                    </div>

                    <label>Bilhetes Apostados</label>
                    <div class="col-xs-6 formBox">
                        <input type="number" id="minBilhetes" name="minBilhetes" class="form-control"> <span>Mínimo</span>
                    </div>
                    <div class="col-xs-6 formBox">
                        <input type="number" id="maxBilhetes" name="maxBilhetes" class="form-control"> <span>Máximo</span>
                    </div>

                    <label>Bilhetes Necessários</label>
                    <div class="col-xs-6 formBox">
                        <input type="number" id="minBilhetesNec" name="minBilhetesNec" class="form-control"> <span>Mínimo</span>
                    </div>
                    <div class="col-xs-6 formBox">
                        <input type="number" id="maxBilhetesNec" name="maxBilhetesNec" class="form-control"> <span>Máximo</span>
                    </div>

                    <label>Ganhador Apostou (bilhetes)</label>
                    <div class="col-xs-6 formBox">
                        <input type="number" name="minAposta" class="form-control"> <span>Mínimo</span>
                    </div>
                    <div class="col-xs-6 formBox">
                        <input type="number" name="maxAposta" class="form-control"> <span>Máximo</span>
                    </div>

                    <div class="col-xs-12 margT20"></div>
                    <button type="reset" class="btn btn-default">Resetar</button>
                    <button type="submit" class="btn btn-primary">Aplicar</button>
                </div>
            </div>          
        </form>
    </div>
</div>

<div class="subModal">
    <div id="responseFiltro" class="responseMsg alert alert-danger">

    </div>
</div>