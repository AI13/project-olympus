<?php

error_reporting(E_ALL);
define('PHALCON_START', microtime(true));

try {

    defined('APP_PATH') || define('APP_PATH', realpath(dirname(__FILE__)) . '/../app');
    defined('BASE_PATH') || define('BASE_PATH', realpath(dirname(__FILE__)) . '/..');

    /**
     * Read the configuration
     */
    $config = include __DIR__ . "/../app/config/config.php";

    $default_env = 'production';
    $envMapping  = include APP_PATH . '/config/env.php';
    $env_path    = isset($_SERVER['HTTP_HOST']) && isset($envMapping[$_SERVER['HTTP_HOST']])
    ? $envMapping[$_SERVER['HTTP_HOST']] . '/'
    : '';

    //path for unit testing configuration
    if(PHP_SAPI == 'cli') {
        if(strpos($_SERVER['argv'][0], 'phpunit') !== FALSE) {
            
            $env_path = 'testing';
        }
    }
    /**
     * Read the configuration
     */
    if ($env_path != '' && file_exists(APP_PATH . '/config/' . $env_path . '/config.php')) {
        $env    = rtrim($env_path, '/');
        $config = include APP_PATH . '/config/' . $env_path . '/config.php';
        // echo APP_PATH . '/config/' . $env_path . "config.php";
    } else {
        $env    = $default_env;
        $config = include APP_PATH . '/config/config.php';
    }
    $config = include APP_PATH . '/config/config.php';
    var_dump($config);
    // Define ENV
    defined('ENV') || define('ENV', $env);

    /**
     * Read auto-loader
     */
    include __DIR__ . "/../app/config/loader.php";

    /**
     * Read services
     */
    include __DIR__ . "/../app/config/services.php";

    // require APP_PATH . '/helpers/constant.php';

    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo $e->getMessage();
}
