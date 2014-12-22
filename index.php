<?php
error_reporting(E_ALL);

$sitePath = realpath(dirname(__FILE__));

define ('__SITE_PATH', $sitePath);

require_once 'includes/init.php';

$registry->router = new router($registry);
$registry->router->setPath (__SITE_PATH . '/controller');
$registry->template = new template($registry);
$registry->router->loader();
