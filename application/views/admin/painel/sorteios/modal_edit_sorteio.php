<div id="modalEditSorteios" class="modal">
    <div class="col-md-3 col-sm-6 col-xs-12 sub-modal-box buscaSorteios boxNewSorteio">
        <i class="glyphicon glyphicon-remove close" onclick="closeModal()"></i>
        <form id="editSorteio">
            <fieldset>Editar Sorteio</fieldset>
            <div class="col-sm-6 col-xs-12 margT20">
                <div class="row">
                    <div class="col-xs-12 formBoxEdit">
                        <input type="text" id="dataSorteio" name="data" class="form-control date"> <span>Data</span>
                    </div>
                    <div class="col-xs-12 formBoxEdit">
                        <input type="time" id="horaSorteio" name="hora" class="form-control"> <span>Hora</span>
                    </div>
                    <div class="col-xs-12">
                        <input type="checkbox" id="showUsersSorteio" name="showUsers"> Detalhado
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xs-12 margT20">
                <div class="row">
                    <div class="col-xs-12 formBoxEdit">
                        <input type="number" id="minBilhetesSorteio" name="minBilhetes" class="form-control"> <span>Mín. Tickets</span>
                    </div>
                    <div class="col-xs-12 formBoxEdit">
                        <input type="number" id="precoSorteio" name="preco" class="form-control"> <span>Preço</span>
                    </div>

                    <div class="col-xs-12 margT20">
                        <button type="reset" class="btn btn-default">Resetar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>

            <input type="hidden" id="id" name='id'>

            <div id="subModal3" class="modal">
                <div id="responseFiltro3" class="responseMsg alert">

                </div>
            </div>
        </form>
    </div>
</div>