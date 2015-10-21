<?php
use Phalcon\DI;

error_reporting(E_ALL);
define('PHALCON_START', microtime(true));

try {

    defined('APP_PATH') || define('APP_PATH', realpath(dirname(__FILE__)) . '/../../app');
    defined('BASE_PATH') || define('BASE_PATH', realpath(dirname(__FILE__)) . '/..');

    /**
     * Read the configuration
     */
    $config = include __DIR__ . "/../../app/config/config.php";

    $default_env = 'production';
    $envMapping  = include APP_PATH . '/config/env.php';
    $env_path    = isset($_SERVER['HTTP_HOST']) && isset($envMapping[$_SERVER['HTTP_HOST']])
    ? $envMapping[$_SERVER['HTTP_HOST']] . '/'
    : '';

    //path for unit testing configuration
    if(PHP_SAPI == 'cli') {
        if(strpos($_SERVER['argv'][0], 'phpunit') !== FALSE) {
            // echo 'aaaa'; var_dump($_SERVER['argv'][0]);
            $env_path = 'testing';
        }
            // or
            // if($_SERVER['argv'][0] == '/usr/bin/phpunit') { echo 'aaaasssss'; }
    }
    /**
     * Read the configuration
     */
    if ($env_path != '' && file_exists(APP_PATH . '/config/' . $env_path . "config.php")) {
        $env    = rtrim($env_path, '/');
        $config = include APP_PATH . '/config/' . $env_path . "config.php";
        // echo APP_PATH . '/config/' . $env_path . "config.php";
    } else {
        $env    = $default_env;
        $config = include APP_PATH . '/config/config.php';
        // echo 'yyyy';
    }

    // Define ENV
    defined('ENV') || define('ENV', $env);

    /**
     * Read the configuration
     */
    // $config = include __DIR__ . "/../app/config/config.php";

    /**
     * Read auto-loader
     */
    include __DIR__ . "/../../app/config/loader.php";

    /**
     * Read services
     */
    // include APP_PATH . "/config/services.php";

    // require APP_PATH . '/helpers/constant.php';

    include __DIR__.'/../../vendor/autoload.php'; // composer autoload

    // $kernel = \AspectMock\Kernel::getInstance();
    // $kernel->init([
    //     'debug' => true,
    //     'includePaths' => [__DIR__.'/../../app']
    // ]);

    /**
     * Handle the request
     */
    // var_dump($di->get('what'));exit;
    // var_dump($di);exit;
    // $application = new \Phalcon\Mvc\Application($di);

    // echo $application->handle()->getContent();
    // DI::reset();

    // add any needed services to the DI here

    // DI::setDefault($di);

} catch (\Exception $e) {
    echo $e->getMessage();
}
