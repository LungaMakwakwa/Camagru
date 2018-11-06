<?php
    session_start();

    $GLOBALS['config'] = array(
    //conneting to the local host//
        'mysql' => array(
            'host' => 'localhost',
            'username' => 'root',
            'password' => '19971228',
            //'password' => '',
            'db' => 'camagru'
        ),
    //remembering cookies for login
        'remember' => array(
            'cookie_name' => 'hash',
            'cookie_expiry' => 604800
        ),
    //your session array
        'session' => array(
            'session_name' => 'user',
            'token_name' => 'token'
        )
);

/*require_once 'classes/config.php';
require_once 'classes/cookie.php';
require_once 'classes/db.php';*/

//including all functions in the classes folder
/*spl_autoload_register(function($class){
    require_once 'classes/'. $class .'.php';
});

//including functions on santizer
require_once 'functions/sanitize.php';
*/
?>