<?php

error_reporting(0);
$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'db' => 'collab_db'
    ),
    'remember' => array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800
    ),
    'session' => array(
        'session_name' => 'user',
        'token_name' => 'token'
    )
);
spl_autoload_register(function($class) {
    if (file_exists('classes/' . $class . '.php')) {
        require_once 'classes/' . $class . '.php';
        return TRUE;
    }
        return FALSE;


});
require_once 'functions/functions.php';
?>