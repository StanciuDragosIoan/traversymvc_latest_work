<?php
    //load config
    require_once 'config/config.php';
    //load libraries
    // require_once 'libraries/Core.php';
    // require_once 'libraries/Controller.php';
    // require_once 'libraries/Database.php';

    //autoload libraries
    spl_autoload_register(function($className){
        require_once 'libraries/' . $className . '.php';
    });