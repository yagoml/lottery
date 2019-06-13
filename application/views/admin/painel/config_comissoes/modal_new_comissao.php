<div id="modalNewPercComissao" class="modal">
    <div class="col-md-4 col-sm-6 col-xs-12 sub-modal-box buscaSorteios">
        <i class="glyphicon glyphicon-remove close" onclick="closeModal()"></i>
        <form id="newPercComission">
            <fieldset>Add Perc. Comissão</fieldset>
            <div class="col-sm-6 col-xs-12 margT20">
                <div class="row">
                    <div class="col-xs-6 formBox">
                        <input type="number" id="ordemNew" name="ordem" class="form-control center-block" max="100"> <span>Ordem</span>
                    </div>
                    <div class="col-xs-6 formBox">
                        <input type="number" id="percComissaoNew" name="percComissao" class="form-control center-block" max="100"> <span>% Com.</span>
                    </div>
                    <div class="col-xs-12 formBox">
                        <select id="codComissaoNew" name="codComissao" class="form-control">
                            <option value="">Selecione</option>
                            <?php foreach ($comissoes as $comissao) { ?>
                                <option value="<?php echo $comissao->codigo ?>"><?php echo $comissao->nome ?></option>
                            <?php } ?>
                        </select>
                    </div>                    
                </div>
            </div>
            <div class="col-sm-6 col-xs-12 margT20">
                <div class="row">                    
                    <label>Faixa Níveis</label>
                    <div class="col-xs-6 formBox">
                        <input type="number" id="rangeMinNew" name="rangeMin" class="form-control center-block" max="100"> <span>De</span>
                    </div>
                    <div class="col-xs-6 formBox">
                        <input type="number" id="rangeMaxNew" name="rangeMax" class="form-control center-block" max="100"> <span>Até</span>
                    </div>

                    <button type="reset" class="btn btn-default">Resetar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>

            <div id="subModal2" class="modal">
                <div id="responseFiltro2" class="responseMsg alert">

                </div>
            </div>
        </form>
    </div>
</div>