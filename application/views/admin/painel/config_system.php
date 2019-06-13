<link rel="stylesheet" href="<?php echo base_url('lib/plugins/jquery-upload-file/css/uploadfile.css') ?>"/>

<form class="formsAdmin" id="formConfigSystem" method="post" enctype="multipart/form-data">
    <div class="col-md-3 col-sm-4 col-xs-12">
        <img class="img-responsive logoP" id="imgPreview" src="<?php echo base_url($configSystem->logo) ?>">
        <label class="center-block" for="image">Alterar Logo</label>
        <input name="logo" id="image" onchange="readURL(this, 'imgPreview')" type="file">
    </div>
    <div class="col-md-3 col-sm-4 col-xs-12">
        <label>Título</label>
        <input type="text" name="titulo" class="form-control center-block" placeholder="Título / Nome" maxlength="255" <?php echo $configSystem && $configSystem->titulo ? 'value="' . $configSystem->titulo . '"' : '' ?>>
    </div>
    <div class="col-md-5 col-sm-6 col-xs-12">
        <label>Google API Key (Public)</label>
        <input type="text" name="google_api_key" class="form-control center-block" placeholder="Google API Key" maxlength="255" <?php echo $configSystem && $configSystem->google_api_key ? 'value="' . $configSystem->google_api_key . '"' : '' ?>>
    </div>
    <div class="col-md-5 col-sm-6 col-xs-12">
        <label>Google API Key (Secret)</label>
        <input type="text" name="google_api_key_sec" class="form-control center-block" placeholder="Google API Key Secret" maxlength="255" <?php echo $configSystem && $configSystem->google_api_key_sec ? 'value="' . $configSystem->google_api_key_sec . '"' : '' ?>>
    </div>

    <div class="col-xs-12 text-center">
        <button type="submit" class="btn btn-primary btnEntrar">Salvar</button>
        <button class="btn btn-default" type="reset">Resetar</button>
    </div>
</form>

<script type="text/javascript" src="<?php echo base_url('lib/plugins/jquery-upload-file/js/jquery.uploadfile.min.js') ?>"></script>

<?php include_once 'lib/plugins/modal/modal_view.html' ?>