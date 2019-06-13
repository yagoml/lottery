<div id="modalEditVouchers" class="modal">
    <div class="col-md-3 col-sm-6 col-xs-12 sub-modal-box buscaSorteios boxNewVoucher">
        <i class="glyphicon glyphicon-remove close" onclick="closeModal()"></i>
        <form id="editVoucher">
            <fieldset>Editar Voucher</fieldset>
            <div class="col-sm-8 col-xs-12 margT20">
                <div class="row">
                    <div class="col-xs-12 formBoxEdit">
                        <input type="text" id="descricaoEdit" name="descricao" class="form-control"> <span>Descrição</span>
                    </div>
                    <div class="col-xs-12 formBoxEdit">
                        <input type="text" id="validadeEdit" name="validade" class="form-control date"> <span>Validade</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-xs-12 margT20">
                <div class="row">
                    <div class="col-xs-12 formBoxEdit">
                        <input type="number" id="bilhetesEdit" name="bilhetes" class="form-control"> <span>Bilhetes</span>
                    </div>
                    <div class="col-xs-12">
                        <input type="checkbox" id="inativoEdit" name="inativo"> Inativo
                    </div>
                </div>
            </div>
            
            <input type="hidden" id="id" name='id'>

            <div id="subModal3" class="modal">
                <div id="responseFiltro3" class="responseMsg alert">

                </div>
            </div>

            <div class="col-xs-12 text-right">
                <button type="reset" class="btn btn-default">Resetar</button>
                <button type="submit" id="btnEdit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
</div>