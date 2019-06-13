<form class="formsAdmin" id="formConfigSorteios">
    <div class="col-md-2 col-sm-3 col-xs-12">
        <label>Preço Bilhete</label>
        <input type="text" name="preco_bilhete" class="form-control center-block" placeholder="Preço Bilhete" maxlength="10" <?php echo $configSorteios && $configSorteios->preco_bilhete ? 'value="' . str_replace('.', ',', $configSorteios->preco_bilhete) . '"' : '' ?>>
    </div>
    <div class="col-md-2 col-sm-3 col-xs-12">
        <label>Desc. Arrecadado</label>
        <input type="number" name="desc_arrecadado" class="form-control center-block" placeholder="% Desc." min="0" max="100" <?php echo $configSorteios && $configSorteios->desc_arrecadado ? 'value="' . str_replace('.', ',', $configSorteios->desc_arrecadado) . '"' : '' ?>>
    </div>
    <div class="col-md-2 col-sm-3 col-xs-12">
        <label>*xp Bilhetes</label>
        <input type="number" name="mult_bilhete" class="form-control center-block" placeholder="* X xp" min="1" max="100" <?php echo $configSorteios && $configSorteios->mult_bilhete ? 'value="' . str_replace('.', ',', $configSorteios->mult_bilhete) . '"' : '' ?>>
    </div>
    <div class="col-md-2 col-sm-3 col-xs-12">
        <label>*xp Prêmios</label>
        <input type="number" name="mult_premio" class="form-control center-block" placeholder="bilhetes * X" min="1" max="100" <?php echo $configSorteios && $configSorteios->mult_premio ? 'value="' . str_replace('.', ',', $configSorteios->mult_premio) . '"' : '' ?>>
    </div>
    <div class="col-md-2 col-sm-3 col-xs-12">
        <label>*xp Bônus Bilhetes</label>
        <input type="number" name="mult_bonus_xp_bilhetes" class="form-control center-block" placeholder="* X xp" min="1" max="100" <?php echo $configSorteios && $configSorteios->mult_bonus_xp_bilhetes ? 'value="' . str_replace('.', ',', $configSorteios->mult_bonus_xp_bilhetes) . '"' : '' ?>>
    </div>
    <div class="col-md-2 col-sm-3 col-xs-12">
        <label>*xp Bônus Prêmio</label>
        <input type="text" name="mult_bonus_xp_premio" class="form-control center-block" placeholder="* X xp" <?php echo $configSorteios && $configSorteios->mult_bonus_xp_premio ? 'value="' . str_replace('.', ',', $configSorteios->mult_bonus_xp_premio) . '"' : '' ?>>
    </div>

    <div class="col-xs-12 text-center">
        <button type="submit" class="btn btn-primary btnEntrar">Salvar</button>
        <button class="btn btn-default" type="reset">Resetar</button>
    </div>
</form>

<?php include_once 'lib/plugins/modal/modal_view.html' ?>