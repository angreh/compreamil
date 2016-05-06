<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//pega endereço relativo para links
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/');

//codificação usada
define('UNICODE_CHARSET', 'utf8');
//definição do caminho do framework
define('LIBRARY_PATH', 'app/vendors/');
//definição do caminho das configurações
define('CONFIG_PATH', 'app/config/');

define( 'MODULES_PATH', 'app/modules/' );

//inclusão do arquivo do framework
require LIBRARY_PATH . 'tmz/TmzFw.class.php';

//GrehFw Start
$fw = new TmzFw();