<?php;
//userStatusOnline();
//guestStatusOnline();
?>
<html lang="pt-br">
    <head>
        <title><?php echo (isset($title) ? $title . ' - ' : '') . Repository\Config_system::titulo() ?></title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">         
        <meta name="description" content="<?php echo isset($description) ? $description : Repository\Config_system::titulo() ?>">
        <meta name="keywords" content="<?php  ?>">
        <meta name="author" content="<?php echo Repository\Config_system::titulo() ?>">

        <meta property="og:locale" content="pt_BR">
        <meta property="og:url" content="<?php echo base_url() ?>">
        <meta property="og:title" content="<?php echo (isset($title) ? $title . ' - ' : '') . Repository\Config_system::titulo() ?>">
        <meta property="og:site_name" content="<?php echo Repository\Config_system::titulo() ?>">
        <meta property="og:description" content="<?php echo isset($description) ? $description : Repository\Config_system::titulo() ?>">
        <meta property="og:image" content="<?php echo base_url('lib/images/logo.jpg') ?>">
        <meta property="og:image:type" content="image/jpeg">
        <meta property="og:image:width" content="800">
        <meta property="og:image:height" content="600">

        <link rel="shortcut icon" href="<?php echo base_url('lib/images/icon.png') ?>" type="image/gif">
        <!-- Moment está sendo importando aqui pq o require n consegue importa-lo -->
        <script type="text/javascript" src="<?php echo base_url('lib/moment/moment.js') ?>"></script>
        <script type="text/javascript">window.baseUrl = '<?php echo base_url() ?>';</script>
        <script data-main="<?php echo base_url('src/js/config_require') ?>" src="<?php echo base_url('lib/require.min.js') ?>"></script>
    </head>
    <body></body>
</html>