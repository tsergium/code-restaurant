<?php
    error_reporting(E_ALL);
    $sitePath = realpath(dirname(__FILE__)."/../");
    define ('__SITE_PATH', $sitePath);

    require_once __SITE_PATH . '/application/' . 'controller_base.class.php';
    require_once __SITE_PATH . '/application/' . 'registry.class.php';
    require_once __SITE_PATH . '/application/' . 'router.class.php';
    require_once __SITE_PATH . '/application/' . 'template.class.php';
    require_once __SITE_PATH . '/application/' . 'db.class.php';

    function __autoload($class_name)
    {
        $filename = strtolower($class_name) . '.class.php';
        $file = __SITE_PATH . '/model/' . $filename;
        if (file_exists($file) == false)
        {
            return false;
        }
        include ($file);
    }

    $registry = new registry;
    
    $registry->db = Db::getInstance();
    
    $registry->router = new router($registry);
    $registry->router->setPath(__SITE_PATH . '/controller');
    $registry->template = new template($registry);
    $registry->router->loader();
    