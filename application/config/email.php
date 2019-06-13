<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$config['smtp_host'] = Repository\Config_email::host();
$config['smtp_port'] = Repository\Config_email::port();
$config['smtp_user'] = Repository\Config_email::email();
$config['smtp_pass'] = Repository\Config_email::pass();
$config['protocol'] = 'smtp';
$config['validate'] = TRUE;
$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['newline'] = "\r\n";
