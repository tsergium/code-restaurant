<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    $sitePath = realpath(dirname(__FILE__)."/../");
    define ('__SITE_PATH', $sitePath);

    require_once __SITE_PATH . '/application/traits/' . 'request.traits.php';
    require_once __SITE_PATH . '/application/traits/' . 'csv.traits.php';
    
    spl_autoload_register(function($class)
    {
        if(strpos($class, "Model_") !== false){
            $filename = str_replace("Model_", "", $class . '.php');
            $file = __SITE_PATH . '/model/' . $filename;
        }else{
             $file = __SITE_PATH . '/application/' . $class . '.php';
        }
        include $file;
    });
    

    $registry = new Registry;
    $registry->db = Db::getInstance();
    $registry->template = new Template($registry);
    
    // set router
    $registry->router = new Router($registry);
    $registry->router->setPath(__SITE_PATH . '/controller');
    $registry->router->loader();
    