<div id="modalEditPercComissao" class="modal">
    <div class="col-md-4 col-sm-6 col-xs-12 sub-modal-box buscaSorteios">
        <i class="glyphicon glyphicon-remove close" onclick="closeModal()"></i>
        <form id="editPercComission">
            <fieldset>Editar Perc. Comissão</fieldset>
            <div class="col-sm-6 col-xs-12 margT20">
                <div class="row">
                    <div class="col-xs-6 formBoxEdit">
                        <input type="number" id="ordem" name="ordem" class="form-control center-block" placeholder="Ordem" max="100"> <span>Ordem</span>
                    </div>
                    <div class="col-xs-6 formBoxEdit">
                        <input type="number" id="percComissao" name="percComissao" class="form-control center-block" placeholder="Ordem" max="100"> <span>Perc. Comissão</span>
                    </div>
                    <div class="col-xs-12 formBoxEdit">
                        <select id="codComissao" name="codComissao" class="form-control">
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
                    <div class="col-xs-6 formBoxEdit">
                        <input type="number" id="rangeMin" name="rangeMin" class="form-control center-block" placeholder="De" max="100"> <span>De</span>
                    </div>
                    <div class="col-xs-6 formBoxEdit">
                        <input type="number" id="rangeMax" name="rangeMax" class="form-control center-block" placeholder="Até" max="100"> <span>Até</span>
                    </div>

                    <button type="reset" class="btn btn-default">Resetar</button>
                    <button type="submit" onclick="editPercComission()" class="btn btn-primary">Salvar</button>

                </div>
            </div>
            
            <input type="hidden" id="idPercCom" name="idPercCom">

            <div id="subModal3" class="modal">
                <div id="responseFiltro3" class="responseMsg alert">

                </div>
            </div>
        </form>
    </div>
</div>