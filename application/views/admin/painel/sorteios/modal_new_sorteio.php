<div id="ymlModal2" class="modal">
    <div class="col-md-3 col-sm-6 col-xs-12 sub-modal-box buscaSorteios boxNewSorteio">
        <i class="glyphicon glyphicon-remove close" onclick="closeModal()"></i>
        <form id="newSorteio">
            <fieldset>Novo Sorteio</fieldset>
            <div class="col-sm-6 col-xs-12 margT20">
                <div class="row">
                    <div class="col-xs-12 formBox">
                        <input type="text" id="data" name="data" class="form-control date"> <span>Data</span>
                    </div>
                    <div class="col-xs-12 formBox">
                        <input type="time" id="hora" name="hora" class="form-control"> <span>Hora</span>
                    </div>
                    <div class="col-xs-12">
                        <input type="checkbox" name="showUsers"> Roleta
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xs-12 margT20">
                <div class="row">
                    <div class="col-xs-12 formBox">
                        <input type="number" id="minBilhetes" name="minBilhetes" class="form-control"> <span>Mín. Tickets</span>
                    </div>
                    <div class="col-xs-12 formBox">
                        <input type="number" id="preco" name="preco" class="form-control"> <span>Preço</span>
                    </div>

                    <div class="col-xs-12 margT20">
                        <button type="reset" class="btn btn-default">Resetar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>

            <div id="subModal2" class="modal">
                <div id="responseFiltro2" class="responseMsg alert">

                </div>
            </div>
        </form>
    </div>
</div>