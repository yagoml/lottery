<div id="modalFiltroVouchers" class="modal">
    <div class="col-sm-6 col-xs-12 sub-modal-box buscaSorteios">
        <i class="glyphicon glyphicon-remove close" onclick="closeModal()"></i>
        <form id="filtroVouchers" method="get">
            <fieldset>Filtrar Vouchers</fieldset>
            <div class="col-sm-6 col-xs-12 margT20">
                <div class="row">
                    <div class="col-xs-6 formBox margB15">
                        <input type="number" id="idVoucher" name="idVoucher" class="form-control"> <span>ID</span>
                    </div>
                    <div class="col-xs-6 formBox">
                        <input type="checkbox" name="ativo" checked> Ativo
                    </div>
                    <div class="col-xs-12 margB15">
                        <label>Usuário</label>
                        <select name="usuario" class="form-control usuario" style="width: 100%;">
                            <option value="">Selecione</option>
                        </select>
                    </div>
                    <div class="col-xs-12 formBox margB15">
                        <input type="text" id="vouchers" name="voucher" class="form-control"> <span>Voucher</span>
                    </div>
                    <div class="col-xs-12 formBox">
                        <input type="text" id="descricao" name="descricao" class="form-control"> <span>Descrição</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xs-12 margT20">
                <div class="row">
                    <label>Bilhetes</label>
                    <div class="col-xs-6 formBox">
                        <input type="number" id="minBilhetes" name="minBilhetes" class="form-control"> <span>Mínimo</span>
                    </div>
                    <div class="col-xs-6 formBox">
                        <input type="number" id="maxBilhetes" name="maxBilhetes" class="form-control"> <span>Máximo</span>
                    </div>

                    <label>Validade</label>
                    <div class="col-xs-6 formBox">
                        <input type="text" id="startDate" name="startDate" class="form-control date"> <span>De</span>
                    </div>
                    <div class="col-xs-6 formBox">
                        <input type="text" id="endDate" name="endDate" class="form-control date"> <span>Até</span>
                    </div>
                    <label>Usado</label>
                    <div class="col-xs-6 formBox">
                        <input type="text" id="startUsado" name="startUsado" class="form-control date"> <span>De</span>
                    </div>
                    <div class="col-xs-6 formBox">
                        <input type="text" id="endUsado" name="endUsado" class="form-control date"> <span>Até</span>
                    </div>
                </div>

                <div id="subModal" class="modal">
                    <div id="responseFiltro" class="responseMsg alert alert-danger">

                    </div>
                </div>

                <div class="col-xs-12 text-right">
                    <button type="reset" class="btn btn-default">Resetar</button>
                    <button type="submit" onclick="filtroVouchers()" class="btn btn-primary">Aplicar</button>
                </div>
            </div>
        </form>
    </div>
</div>