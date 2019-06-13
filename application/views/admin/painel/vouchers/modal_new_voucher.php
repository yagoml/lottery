<div id="ymlModal2" class="modal">
    <div class="col-md-3 col-sm-6 col-xs-12 sub-modal-box buscaSorteios boxNewVoucher">
        <i class="glyphicon glyphicon-remove close" onclick="closeModal()"></i>
        <form id="newVoucher">
            <fieldset>Novo Voucher</fieldset>
            <div class="col-sm-8 col-xs-12 margT20">
                <div class="row">
                    <div class="col-xs-12 formBox">
                        <input type="text" id="descricao" name="descricao" class="form-control"> <span>Descrição</span>
                    </div>
                    <div class="col-xs-12 formBox">
                        <input type="text" id="validade" name="validade" class="form-control date"> <span>Validade</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-xs-12 margT20">
                <div class="row">
                    <div class="col-xs-12 formBox">
                        <input type="number" id="bilhetes" name="bilhetes" class="form-control"> <span>Bilhetes</span>
                    </div>
                    <div class="col-xs-12 formBox">
                        <input type="checkbox" name="inativo"> Inativo
                    </div>
                </div>
            </div>

            <div id="subModal2" class="modal">
                <div id="responseFiltro2" class="responseMsg alert">

                </div>
            </div>

            <div class="col-xs-12 text-right">
                <button type="reset" class="btn btn-default">Resetar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
</div>